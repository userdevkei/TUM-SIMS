<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Mail\VerifyMail;
use App\Models\PasswordResets;
use App\Models\User;
use App\Models\VerifyPhone;
use App\Models\VerifyUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client;
use Auth;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Validator;
use Illuminate\Support\Arr;


class StudentRegistration extends Controller
{
    public function index(){

        /*------------------ Return the registration form ---------------------------*/

        $regstudents = DB::connection('mysql')->table('users')->orderBy('created_at', 'DESC')->paginate(10);

        return view('auth.register')->with('regstudents', $regstudents);
    }

    public function storeDetails(Request $request){

        /*----------------------------------- Validate user registration details ------------------*/

        $this->validate($request, [
            'reg_number' => 'required',
            'student_email' => 'required',
            'student_phone' => 'required',
            'id_number' => 'required',
            'CaptchaCode' => 'required',
            'personal_email' => 'required',
            'campus' => 'required'
        ]);

        /*--------------------------------- Check if the provided student details exist in the e-registrar database --------------*/

        $oldstudent = DB::connection('sqlsrv')->table('tblstudents')
            ->where('RegStud_NO_PK', '=', $request->input('reg_number'))
            ->where('RegStud_Email', '=', $request->input('student_email'))
            ->select('regStud_Name1', 'regStud_Name2', 'regStud_Name3', 'RegStud_Phone', 'regStud_Gender')->first();

        if($oldstudent === null){
            return redirect('/')->with('error', 'You are not a current student.');
        }else {

        /*----------------------check if the student exists in the new database-------------------------------------------------
            --------------------Aims to minimise on number of register requests send -------------------------------------------
        */
            $newstudent = DB::connection('mysql')->table('users')
                ->where('regStudentNumber', '=', $request->input('reg_number'))
                ->where('regStudentEmail', '=', $request->input('student_email'))
                ->where('regStudentPhone', '=', preg_replace('/0/', '+254', $request->input('student_phone'), 1))
                ->where('regStudentIDNO', '=', $request->input('id_number'))
                ->first();

            if ($newstudent == true){
                return redirect('openLogin')->with('success', 'You are already registered, try to login');
            }else{

        /*------------------------------ Validate details submitted before saving them to the database -----------------------*/

                $this->validate($request, [
                    'reg_number' => ['required', 'string'],
                    'student_email' => ['required', 'string'],
                    'student_phone' => 'required|regex:/(0)[0-9]{9}/',
                    'id_number' => 'required|numeric|max:59999999|digits_between:7,8|',
                    'CaptchaCode' => 'required|captcha',

                ]);

                $user = new User;
                $user->regStudentNumber = $request->input('reg_number');
                $user->regStudentEmail = $request->input('student_email');
                $user->Campus = $request->input('campus');
                $user->PersonalEmail = $request->input('personal_email');
                $user->regStudentName = $oldstudent->regStud_Name1 . " " . $oldstudent->regStud_Name2 . " " . $oldstudent->regStud_Name3;
                $user->regStudentPhone = preg_replace('/0/', '+254', $request->input('student_phone'), 1);
                $user->regStudentGender = $oldstudent->regStud_Gender;
                $user->regStudentIDNO = $request->input('id_number');
                $user->password = Hash::make($request->input('id_number'));
                $user->save();

        /*---------------------------------- generate a token and send it to student email -----------------*/
                VerifyUser::create([
                    'user_id' => $user->id,
                    'token' => Str::random(60),
                ]);

                Mail::to($user->regStudentEmail)->send(new VerifyMail($user));


        /*---------------------------------------- send a sms verification code to the students phone number -----*/

                $code = rand(1, 999999);

                Http::withBasicAuth('demo', 'tum@swsap1')->asForm()->post('http://apis.tum.ac.ke/v1/sms/dispatch',[
                    'mobile_number' => preg_replace('/0/', '+254', $request['student_phone'], 1),
                    'text_message' => "Your phone verification code is"." ".$code.". ".""."Do not share this code with anyone"
                ]);

                VerifyPhone::create([
                    'user_id' => $user->id,
                    'verificationCode' => $code
                ]);

                return redirect()->route('openVerify')->with(['success' => 'Please verify your phone number', 'student_phone' => preg_replace('/0/', '+254', $request['student_phone'], 1)]);
            }
        }
    }

    protected function verify(Request $request)
    {

    /*--------------------------Validate phone verification details -------------------------*/
        $this->validate($request, [
            'verification_code' => ['required', 'numeric'],
            'student_phone' => ['required', 'string'],
        ]);

    /*----------------------------------Verify the code send to the phone number ----------------------*/
        $verifyNumber = VerifyPhone::where('verificationCode', $request->verification_code)->first();

           if (isset($verifyNumber)){

                $user = $verifyNumber->user;

                if (!$user->isVerified){
                    $user->isVerified = 1;
                    $user->save();

                    return redirect('openLogin')->with(['success' => 'Phone number verified']);

                    VerifyPhone::where('verificationCode', $verificationCode)->delete();
                }
               return back()->with(['student_phone' => $request['student_phone'], 'error' => 'Invalid verification code entered!']);
            }

    }

//    protected function reVerify(Request $request){
//
//    /*--------------------------If for whatever reason phone number is required to be verified a fresh ------------------*/
//        $this->validate($request, [
//            'verification_code' => ['required', 'numeric'],
//            'student_phone' => ['required', 'string'],
//        ]);
//
//        $token = getenv("TWILIO_AUTH_TOKEN");
//        $twilio_sid = getenv("TWILIO_SID");
//        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
//        $twilio = new Client($twilio_sid, $token);
//        $verification = $twilio->verify->v2->services($twilio_verify_sid)
//            ->verificationChecks
//            ->create($request['verification_code'], array('to' => preg_replace('/0/', '+254', $request['student_phone'], 1)));
//        if ($verification->valid) {
//            $student = tap(User::where('regStudentPhone', preg_replace('/0/', '+254', $request['student_phone'], 1)))->update(['isVerified' => true]);
//
//            return redirect('dashboard')->with(['success' => 'Phone number verified']);
//        }
//        return back()->with(['student_phone' => $request['student_phone'], 'error' => 'Invalid verification code entered!']);
//    }
    /*------------------------------------------ Generate a new captcha to confirm thr user is not a robot ---------------------------*/
    public function reloadCaptcha(){

        return response()->json(['captcha'=> captcha_img()]);
    }
    /*----------------------------------- to be implemented on the dashboard for user confirmation
    protected function requestOTP($id){

        $student = User::find($id);

        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($student->regStudentPhone, "sms");

        return view('re-verify')->with(['success' => 'OTP was send to your phone number', 'student' => $student]);
    }
    --------------------------------------------------------------*/


    /*---------------------------------------------------fetch student data in Json format ---------------------------------------*/
    public function viewStudents (Request $request){
        $oldstudent = DB::connection('sqlsrv')->table('tblstudents')->orderBy('colID', 'DESC')
            ->where('studentsource', 'current')
            ->where('regstud_email', 'LIKE', '%@students.tum.ac.ke%')
            ->select('regStud_NO_PK','regStud_email','regStud_Name1', 'regStud_Name2', 'regStud_Name3', 'RegStud_Phone', 'regStud_Gender')
            ->get();

        return $oldstudent;
    }

    public function all(){
        $oldstudent = DB::connection('sqlsrv')->table('tblstudents')->orderBy('colID', 'DESC')
            ->where('studentsource', 'current')->get();
    }

    /*----------------------------------------return login view---------------------------------------*/
    public function openLogin(){

        return view('auth.login')->with('success', 'You can now login and update your profile');
    }


    /*---------------------------------------Authenticate user,
     *------------------------------------A user must confirm both the email and phone number to login to the system
     *
     */
    public function login(Request $request){
        $request->validate([
            'regStudentNumber' => 'required',
            'password' => 'required'
        ]);

        $logins = $request->only('regStudentNumber', 'password');

        if (Auth::attempt($logins)){

            if (Auth::user()->email_verified_at == null){

                Auth::logout();

                return redirect()->back()->with('error', 'You need to verify your email address to login');
            }

            return redirect()->intended('dashboard');
        }

        return redirect('openLogin')->with('error', 'Registration number or password is wrong');
    }

    public function dashboard(){

        if (Auth::check()){

            $verifyPhone = User::where('regStudentNumber', '=', Auth::user()->regStudentNumber)
                ->where('isVerified', '=', false)
                ->first();

            if ($verifyPhone == true){

                $code = rand(1, 999999);

                Http::withBasicAuth('demo', 'tum@swsap1')->asForm()->post('http://apis.tum.ac.ke/v1/sms/dispatch',[
                    'mobile_number' => Auth::user()->regStudentPhone,
                    'text_message' => "Your phone verification code is"." ".$code.". ".""."Do not share this code with anyone"
                ]);

                VerifyPhone::create([
                    'user_id' => Auth::user()->id,
                    'verificationCode' => $code
                ]);

                    return redirect('re-verify')->with('success', 'Re-verify your phone number');
            }

            $verifyEmail = User::where('regStudentNumber', '=', Auth::user()->regStudentNumber)
                ->where('email_verified_at', '=', null)
                ->first();

            if ($verifyEmail == true){

                return redirect('verifyEmail')->with('success', 'Please check your inbox');
            }

            return view('dashboard')->with('success', 'Hurrah you are logged in');
        }

        return redirect('openLogin')->with('error', 'Try to sign in again');
    }

    public function logout(){

        Session::flush();

        Auth::logout();

        return redirect('openLogin')->with('success', 'You are now logged out');
    }

    public function verifyEmail($token){
        $verifiedEmail = VerifyUser::where('token', $token)->first();

        if (isset($verifiedEmail)){
            $user = $verifiedEmail->user;

            if (!$user->email_verified_at){
                $user->email_verified_at = Carbon::now();
                $user->save();

                VerifyUser::where('token', $token)->delete();

                return redirect('dashboard')->with('success', 'Email has been verified');
            }else{
                return redirect('dashboard')->with('success', 'Email has already been verified');
            }
        }else{
            return redirect('openLogin')->with('success', 'Please verify your email');
        }
    }

    public function openResetEmail(){
        return view('auth.emailReset');
    }

    public function resetPasswordEmail(Request $request){

        $user = User::where('regStudentEmail', '=', $request->input('email'))->first();

        if ($user === null){
            return redirect()->back()->with('error', 'Your email does not match any record');
        }else{
            DB::table('password_resets')->insert([

               'email' => $request->input('email'),
                'token' => Str::random(60),
                'created_at' => Carbon::now(),
                'user_id' => $user->id,
            ]);

            Mail::to($user->regStudentEmail)->send(new ResetPassword($user));

            return redirect()->back()->with('success', 'A verification link was send successfully.');

        }
    }
    public function resetPassword($passwordToken){

        return view('auth.resetPassword')->with('token', $passwordToken);
    }

    public function updatedPassword(Request $request){

        $this->validate($request, [
            'email' => 'required',
            'token' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

            $passwordreset = DB::table('password_resets')->where([
                'email' => $request->email,
                'token' => $request->token,
            ])->first();

            if (!$passwordreset){
                return redirect('openResetEmail')->with('error', 'Invalid token. Please request new token');
            }
                $user = User::where('regStudentEmail', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

                DB::table('password_resets')->where(['email' => $request->email])->delete();

                return redirect('openLogin')->with('success', 'Your password was changed successfully');

    }

    public static function apiTest(){

        $code = rand(0, 999999);

        Http::withBasicAuth('demo', 'tum@swsap1')->asForm()->post('http://apis.tum.ac.ke/v1/sms/dispatch',[
            'mobile_number' => "+254729434393",
            'text_message' => "Your verification code is"." ".$code."."
        ]);

       $code = rand(0, 999999);

        dd($code);

        $response = Http::withBasicAuth('demo', 'tum@swsap1')->asForm()->post('http://apis.tum.ac.ke/v1/sms/dispatch',[
            'mobile_number' => '+254729434393',
            'text_message' => 'Hello Developer Kei'
        ]);

        dd($response);
    }
}

