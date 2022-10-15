<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    public function showCustomers(Request $request){
        $customers= User::where('type', 'CUSTOMER')->get();
        return $customers;
    }

    public function showCustomerProfile(Request $request, $id){
        $customer = User::where('type', 'CUSTOMER')->where('id', $id)->get();
        return $customer;
    }

    public function showAdmins(Request $request){
        $admins= User::where('type', 'ADMIN')->get();
        return $admins;
    }

    public function showAdminProfile(Request $request, $id){
        // $products = DB::table('products')->get();
        // $points = DB::table('products')->get();
        // $participants = DB::table('products')->where('type', 'ADMIN')->get();

        return view('dashboard');
    }

    public function showParticipants(Request $request){
        $participants= User::where('type', 'PARTICIPANT')->get();
        return $participants;
    }

    public function showParticipantProfile(Request $request, $id){
        $participant = User::where('type', 'PARTICIPANT')->where('id', $id)->get();
        return $participant;
    }
}
