@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="hero bg-white overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">USER AUTHENTICATION</h3>
                    </div>
                    <span class="alert alert-info"> <i class="fa fa-info-circle"></i> Verify your email to log in. </span>
                    <div class="block-content block-content-full">
                        {!! Form::open(['action' => 'App\Http\Controllers\StudentRegistration@login', 'method' => 'POST']) !!}
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
                                        <input type="text" class="form-control" name="regStudentNumber" placeholder="Registration number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-key"></i>
                                                    </span>
                                        </div>
                                        <input type="password" class="form-control" name="password" placeholder="User password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-sm btn-info" value="Sign in">
                                </div>
                                <div class="form-group">
                                    <a href="{{ url('/') }}"> I need an account </a> | <a href="{{ route('openResetEmail') }}">Forgot password?</a>
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
    <!-- END Hero -->
@endsection
