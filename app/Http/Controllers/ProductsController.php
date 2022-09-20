<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductsController extends Controller
{
    public function showAllProducts(){
        return DB::table('products')->get();
    }

    public function showProduct(Request $request){
        // code...
    }

    public function addNewProduct(Request $request){
        // code...
    }
}
