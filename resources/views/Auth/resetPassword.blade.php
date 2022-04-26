@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="hero bg-white overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">Change Password </h3>
                    </div>
                    <div class="block-content block-content-full">
                        {!! Form::open(['action' => 'App\Http\Controllers\StudentRegistration@updatedPassword', 'method' => 'POST']) !!}
                        {{--                        <form action="{{ route('storeDetails') }}" method="POST">--}}

                        <input type="hidden" value="{{ $token }}" name="token">
                        <div class="row">
                            <div class="col-lg-4 text-center">
                            </div>
                            <div class="col-lg-8 col-xl-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                        </div>
                                        <input type="email" class="form-control" name="email" placeholder="Provide your student email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-key"></i>
                                                    </span>
                                        </div>
                                        <input type="password" class="form-control" name="password" placeholder="Provide new password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-key"></i>
                                                    </span>
                                        </div>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="btn btn-sm btn-info" value="Reset password">
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
