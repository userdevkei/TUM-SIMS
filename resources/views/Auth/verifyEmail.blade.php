@extends('layouts.simple')

@section('content')
    <!-- Hero -->
    <div class="hero bg-white overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title"> Welcome {{ $user->regStudentName }} to {{ config('app.name') }}</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <p>
                            Click <a href=" {{ route('verifyEmail', $user->verifyUser->token) }}">this link </a> to verify your email.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END Hero -->
@endsection
