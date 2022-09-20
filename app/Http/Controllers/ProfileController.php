<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $admin = User::where('type', 'ADMIN')->where('id', $id)->get();
        return $admin;
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
