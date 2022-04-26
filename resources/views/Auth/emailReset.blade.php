@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="hero bg-white overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">Reset Password </h3>
                    </div>
                    <div class="block-content block-content-full">
                        {!! Form::open(['action' => 'App\Http\Controllers\StudentRegistration@resetPasswordEmail', 'method' => 'POST']) !!}
                        {{--                        <form action="{{ route('storeDetails') }}" method="POST">--}}
                        <div class="row">
                            <div class="col-lg-4 text-center">
                            </div>
                            <div class="col-lg-8 col-xl-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-envelope-open-text"></i>
                                                    </span>
                                        </div>
                                        <input type="email" class="form-control" name="email" placeholder="Provide your student email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-sm btn-info" value="Send verification link">
                                </div>

                                <div class="form-group">
                                    <a href="{{ route('openLogin') }}">Sign in</a>
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
