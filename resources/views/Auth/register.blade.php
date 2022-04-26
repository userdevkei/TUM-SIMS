
@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="hero bg-white overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">USER REGISTRATION</h3>
                    </div>
                    <div class="block-content block-content-full">
                        {!! Form::open(['action' => 'App\Http\Controllers\StudentRegistration@storeDetails', 'method' => 'POST']) !!}
{{--                        <form action="{{ route('storeDetails') }}" method="POST">--}}
                            <div class="row">
                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-8 col-xl-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-graduation-cap"></i>
                                                    </span>
                                            </div>
                                            <input type="text" class="form-control" name="reg_number" placeholder="Student registration number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-envelope-open"></i>
                                                    </span>
                                            </div>
                                            <input type="text" class="form-control" name="student_email" placeholder="Eg. btit014j2014@students.tum.ac.ke">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-school"></i>
                                                    </span>
                                            </div>
{{--                                            <input type="text" class="form-control" name="student_phone" placeholder="Student phone number">--}}
                                            <select name="campus" id="campus" class="form-control">
                                                <option value="" disabled selected>-- Select your campus --</option>
                                                <option value="Main">Main</option>
                                                <option value="Kwale">Kwale (Ukunda)</option>
                                                <option value="Lamu">Lamu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                            </div>
                                            <input type="text" class="form-control" name="student_phone" placeholder="Student phone number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-id-card"></i>
                                                    </span>
                                            </div>
                                            <input type="text" class="form-control" name="id_number" placeholder="Your national ID number">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="far fa-envelope"></i>
                                                    </span>
                                            </div>
                                            <input type="text" class="form-control" name="personal_email" placeholder="Provide your personal email">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                            </div>
                                            <input type="text" class="form-control" name="CaptchaCode" placeholder="Enter Captcha below">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class = 'capcha_api'>{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-alt-info" name="reload" id="reload">
                                            ↻
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-sm btn-info" value="Register">
                                    </div>

                                    <div class="form-group">
                                        <a href="{{ route('openLogin') }}"> Already have an account? </a>
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
    <script type="text/javascript">
        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: '{{ route('reloadCaptcha') }}',
                success: function (data) {
                    $(".capcha_api").html(data.captcha);
                }
            });
        });
    </script>
    <!-- END Hero -->
@endsection
