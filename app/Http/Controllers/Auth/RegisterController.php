<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /*
    |--------------------------------------------------------------------------
    |           Multi Auth Logic
    |--------------------------------------------------------------------------
    */
    public function __construct()
    {
        if (Auth::check() && Auth::user()->role->id == 1)
        {
            $this->redirectTo = route('admin.dashboard');
        }
        elseif(Auth::check() && Auth::user()->role->id == 2){

            $this->redirectTo = route('guide.dashboard');
        }
        else{
            $this->redirectTo = route('user.dashboard');
        }

        $this->middleware('guest')->except('logout');
    }
    /*
    |--------------------------------------------------------------------------
    |           Multi Auth Logic Ends
    |--------------------------------------------------------------------------
    */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'user_type' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'location' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        dd($data['user_type']);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => $data['user_type'],
            'location' => $data['location'],
            'about' => $data['about'],
            'password' => Hash::make($data['password']),
        ]);

    }
}
