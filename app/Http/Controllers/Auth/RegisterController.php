<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::PROFILE;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('guest');
    }

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if(array_key_exists('dateOfBirth', $data)){
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => 'PARTICIPANT',
                'dateOfBirth' => $data['dateOfBirth'],
                'password' => Hash::make($data['password']),
            ]);
        }else if(array_key_exists('shippingAddress', $data)){
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => 'CUSTOMER',
                'shippingAddress' => $data['shippingAddress'],
                'password' => Hash::make($data['password']),
            ]);
        }else{
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => 'ADMIN',
                'password' => Hash::make($data['password']),
            ]);
        }
    }

    protected function authenticated(Request $request, $user)
    {

    }

    protected function showAdminRegistrationForm(){
        return view('auth.admin_register');
    }

    protected function showCustomerRegistrationForm(){
        return view('auth.customer_register');
    }

}

// TODO;
// fix the problem of redirecting users to dashboards immediately after registration.
