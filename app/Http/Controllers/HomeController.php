<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    protected function index(Request $request)
    {
        return view('welcome',[
            'bestParticipant' => $this->getBestParticipant($request)
        ]);
    }

    protected function getBestParticipant(Request $request){
        return DB::table('points')
            ->join('users', 'points.participantID', '=', 'users.id')
            ->orderByDesc('numberOfPoints')
            ->select('users.name', 'points.numberOfPoints')
            // ->where('points.participantID', $request->user()->id)
            ->limit(1)
            ->get();
     }
}
