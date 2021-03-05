@extends('layouts.app')

@section('title','Sign Up')

@push('css')


@endpush

@section('content')


    <div class="row">
        <div class="col-md-8 col-offset-2">
            <div class="JoinForm">
                <h1>Connect with your email</h1>
                <div class="JoinForm-tabs">
              <span class="JoinForm-tab ">
                <h3>Create new user</h3>
              </span>
                </div>

                <div class="JoinForm-form">

                    <form method="POST" action="{{ route('register') }}" class="Form Form--wide Form--transparent" name="signUpForm">
                        @csrf
                        <label for="name" class="Form-label">{{ __('Name') }}<span style="color: red"> *</span></label>
                        <input class="Form-field" id="name" type="text" placeholder="Name" name="name" minlength="2" maxlength="20" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        <label for="user_type" class="Form-label">{{ __('Sign Up as a') }}<span style="color: red"> *</span></label>
                        <select class="Form-select" type="text" id="user_type" name="user_type" required autofocus>
                            <option value="">Select User Type</option>
                            @foreach($roles_id as $role_id)
                                <option value="{{ $role_id->id }}">{{ $role_id->name }}</option>
                            @endforeach
                        </select>

                        <label for="email" class="Form-label">{{ __('Email') }}<span style="color: red"> *</span></label>
                        <input class="Form-field" id="email" type="email" placeholder="Email address" name="email" value="{{ old('email') }}" required autocomplete="email">

                        <label for="location" class="Form-label">{{ __('Location') }}<span style="color: red"> *</span></label>
                        <input class="Form-field" id="location" placeholder="Location address" name="location" required>

                        <label for="about" class="Form-label">{{ __('About') }}</label>
                        <textarea class="Form-field" id="about" name="about"></textarea>

                        <label for="password" class="Form-label">{{ __('Password') }}<span style="color: red"> *</span></label>
                        <input class="Form-field" id="password" type="password" placeholder="Password" name="password" minlength="6" maxlength="20" required autocomplete="new-password">

                        <label for="password-confirm" class="Form-label">{{ __('Confirm Password') }}<span style="color: red"> *</span></label>
                        <input class="Form-field" id="password-confirm" type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password" minlength="6" maxlength="20">

                        <div class="JoinForm-submit">
                            <button class="Button Button--fullWidth" type="submit">Sign Up</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



@push('js')
    <!--------Js for google map---------->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYG5g2aJ9TjMlbYk7E_VuFYKSvHC1Ee6Y&libraries=places" type="text/javascript"></script>
    <script>
        var searchBox = new google.maps.places.SearchBox(document.getElementById('location'));
    </script>

@endpush

@endsection
