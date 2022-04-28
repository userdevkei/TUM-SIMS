@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="hero bg-white overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">Phone Verification :  {{ Auth::user()->regStudentPhone }}</h3>
                    </div>
                    <div class="block-content block-content-full">
                        {!! Form::open(['action' => 'App\Http\Controllers\StudentRegistration@verify', 'method' => 'POST']) !!}
                        {{--                        <form action="{{ route('storeDetails') }}" method="POST">--}}
                        <div class="row">
                            <div class="col-lg-4 text-center">
                            </div>
                            <div class="col-lg-8 col-xl-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                        </div>
                                        <input type="hidden" name="student_phone" value="{{ Auth::user()->regStudentPhone }}">
                                        <input type="text" class="form-control" name="verification_code" placeholder="Enter OTP to verify phone number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-sm btn-info" value="Verify">
                                </div>
                            </div>
                        </div>
                        {{--                        </form>--}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END Hero -->
@endsection
