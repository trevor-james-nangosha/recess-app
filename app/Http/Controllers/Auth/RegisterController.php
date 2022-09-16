<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Customer;
use App\Models\Admin;
use App\Models\Participant;
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
        $this->middleware('guest:customer');
        $this->middleware('guest:admin');
        $this->middleware('guest:participant');
    }

    public function showAdminRegisterPage()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    // TODO;
    // remember the participants are not supposed to register from the web interface
    // so, we leave out their part. we only do the customers and admins.
    // actually, there is no point an admin should register from the web interface,
    // so i may take his part out.

    public function showCustomerRegisterPage()
    {
        return view('auth.register', ['url' => 'writer']);
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function createCustomer(Request $request)
    {
        $this->validator($request->all())->validate();
        $customer = Customer::create([
            'name' => $request['name'],
            'shipping_address' => $request['shipping_address'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/customer');
    }

    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/admin');
    }

    protected function createParticipant(Request $request)
    {
        $this->validator($request->all())->validate();
        $participant = Participant::create([
            'name' => $request['name'],
            'dateOfBirth' => $request['dateOfBirth'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/writer'); // we are not supposed to redirect
        // remember this is called from the terminal
        // so maybe we could send back a status signal showing success or failure.
    }

}
