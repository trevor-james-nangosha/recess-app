<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


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
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
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
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'type' => ['required'],
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
                'type' => $data['type'],
                'dateOfBirth' => $data['dateOfBirth'],
                'password' => Hash::make($data['password']),
            ]);
        }else if(array_key_exists('shippingAddress', $data)){
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => $data['type'],
                'shippingAddress' => $data['shippingAddress'],
                'password' => Hash::make($data['password']),
            ]);
        }else{
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'type' => $data['type'],
                'password' => Hash::make($data['password']),
            ]);
        }
    }

}

// TODO;
// add some fields in the  web pages forms to cater for this.
// you can tell the users the fields they need to fill for
// their respective user roles
