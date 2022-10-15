<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoppingController extends Controller
{
    public function showOrderPage(Request $request){
        $products = DB::table('products')
                        ->join('users', 'users.id', '=', 'products.userID')
                        ->where('users.type', 'PARTICIPANT')
                        ->select('users.name as participantName', 'products.name as productName', 'products.description', 'products.ratePerItem')
                        ->get();
        return view('pages.shop', [
            'products' => $products,
            'userID' => $request->user()->id,
        ]);
        // return $products;
    }
}
