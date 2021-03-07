@extends('layouts.app')

@section('title','Edit Profile')

@push('css')


@endpush

@section('content')


    <div class="row">
        <div class="col-md-8 col-offset-2">
            <div class="JoinForm">
                <div class="JoinForm-tabs">
                  <span class="JoinForm-tab ">
                    <h3>Update your profile</h3>
                  </span>
                </div>

                <div class="JoinForm-form">

                    <form method="POST" action="{{ route('guide.update.profile',$user->id) }}" class="Form Form--wide Form--transparent" enctype="multipart/form-data" >
                        @csrf
                        <label for="name" class="Form-label">{{ __('Name') }}<span style="color: red"></span></label>
                        <input class="Form-field" id="name" type="text" placeholder="Name" name="name" minlength="2" maxlength="20" value="{{ $user->name }}" required autocomplete="name" autofocus>

                        <label for="user_type" class="Form-label">{{ __('Sign Up as a') }}<span style="color: red"></span></label>
                        <select class="Form-select" type="text" id="user_type" name="user_type" required autofocus>
                            <option >Select User Type</option>
                            @foreach($user_type as $type)
                                <option value="{{ $type->id }}"{{ $user->role_id == $type->id ? 'selected' : ''}}>{{ $type->name }}</option>
                            @endforeach
                        </select>

                        <label for="email" class="Form-label">{{ __('Email') }}<span style="color: red"></span></label>
                        <input class="Form-field" id="email" type="email" placeholder="Email address" name="email" value="{{ $user->email }}" required autocomplete="email">

                        <label for="location" class="Form-label">{{ __('Location') }}<span style="color: red"></span></label>
                        <input class="Form-field" id="location" value="{{ $user->location }}" placeholder="Location address" name="location" required>

                        <label for="price" class="Form-label">{{ __('Fee ($ per hour)') }}<span style="color: red"></span></label>
                        <input type="number" class="Form-field" id="price" value="{{ $user->price }}" name="price">

                        <label for="phone" class="Form-label">{{ __('Phone') }}<span style="color: red"></span></label>
                        <input class="Form-field" id="phone" value="{{ $user->phone }}" name="phone">

                        <label for="motto" class="Form-label">{{ __('Motto (less than 2 lines)') }}<span style="color: red"></span></label>
                        <input class="Form-field" id="motto" value="{{ $user->motto }}" name="motto">

                        <label for="about" class="Form-label">{{ __('About') }}</label>
                        <textarea class="Form-field" id="about" name="about">{{ $user->about }}</textarea>

                        <label for="pro_pic" class="Form-label">{{ __('Picture') }}<span style="color: red"></span></label>
                        <input type="file" class="Form-field" id="pro_pic" value="{{ $user->pro_pic }}" name="pro_pic">



                        <div class="JoinForm-submit">
                            <button class="Button Button--fullWidth" type="submit">Update</button>
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
