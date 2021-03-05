@extends('layouts.app')

@section('title','Reset Password')


@section('content')

{{--<div class="container">--}}
    {{--<div class="row justify-content-center">--}}
        {{--<div class="col-md-8">--}}
            {{--<div class="card">--}}
                {{--<div class="card-header">{{ __('Reset Password') }}</div>--}}

                {{--<div class="card-body">--}}
                    {{--<form method="POST" action="{{ route('password.update') }}">--}}
                        {{--@csrf--}}

                        {{--<input type="hidden" name="token" value="{{ $token }}">--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>--}}

                                {{--@error('email')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

                                {{--@error('password')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                {{--@enderror--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row">--}}
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group row mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--{{ __('Reset Password') }}--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}




<div class="row">
    <div class="col-md-8 col-offset-2">
        <div class="JoinForm">
            <h1>{{ __('Reset Password') }}</h1>


            <div class="JoinForm-form">

                <form method="POST" action="{{ route('password.update') }}" class="Form Form--wide Form--transparent">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <label for="email" class="Form-label">{{ __('Email') }}</label>
                    <input class="Form-field" id="email" type="email" placeholder="Your Email" name="email" required autocomplete="email" autofocus>

                    <label for="password" class="Form-label">{{ __('Password') }}</label>
                    <input class="Form-field" id="password" type="password" placeholder="Password" name="password" required autocomplete="new-password">

                    <label for="password-confirm" class="Form-label">{{ __('Confirm Password') }}</label>
                    <input class="Form-field" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">

                    <div class="JoinForm-submit">

                        <button class="Button Button--fullWidth" type="submit">
                            {{ __('Reset Password') }}
                        </button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection
