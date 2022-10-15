<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParticipantsController extends Controller
{
    public function browseAllParticipants(){
        return view('participant_tables', [
            'participants' => $this->getAllParticipants()
        ]);
    }

    public function browseParticipant(Request $request){
        $participantID = substr($request->path(), 19, 2);
        $user = DB::table('users')
                    ->where('id', $participantID)
                    ->get();
        return view('participant_info', [
            'participant' => $user,
        ]);
    }

    public function getAllParticipants(){
        return DB::table('users')
            ->leftJoin('products', 'users.id', '=', 'products.userID')
            ->select('users.name', 'products.kind', 'users.email', 'users.dateOfBirth', 'users.id')
            ->where('type', 'PARTICIPANT')
            ->get();
    }
}

