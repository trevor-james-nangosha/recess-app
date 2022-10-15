<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function sendDashboardData(){
        // total sales per participant logic
        $response = [];
        $result = DB::table('products')
                        ->leftJoin('orders', 'products.id', '=', 'orders.productID')
                        ->rightJoin('users', 'products.userID', '=', 'users.id')
                        ->where('users.type', 'PARTICIPANT')
                        ->select('users.name', 'orders.totalAmount')
                        ->get();


        // total points per participant
        $totalPoints = DB::table('users')
                            ->leftJoin('points', 'users.id', '=', 'points.participantID')
                            ->where('users.type', 'PARTICIPANT')
                            ->select('users.name', 'points.numberOfPoints')
                            ->get();

        //participant name, quantity present, quantity sold.
        $percentageSale = DB::table('products')
                            ->rightJoin('users', 'products.userID', '=', 'users.id')
                            ->where('users.type', 'PARTICIPANT')
                            ->select('users.name', 'products.totalQuantityPosted', 'products.totalQuantitySold')
                            ->get();

        //number of return purchases
        $returnPurchases = DB::table('products')
                            ->leftJoin('has_boughts', 'products.id', '=', 'has_boughts.productID')
                            ->rightJoin('users', 'products.userID', '=', 'users.id')
                            ->where('users.type', 'PARTICIPANT')
                            ->select('users.name', 'products.name as productName', 'has_boughts.numberOfTimes')
                            ->get();

        array_push($response, $result, $totalPoints, $percentageSale, $returnPurchases);
        return $response;

    }

    protected function sendDashboardParticipantsTable(){
        return DB::table('users')
                    ->where('type', 'PARTICIPANT')
                    ->select('users.id', 'users.email', 'users.name') // substitute this with something meaningful
                    ->get();
    }

    protected function sendDashboardCustomersTable(){
        return DB::table('users')
                ->where('type', 'CUSTOMER')
                ->select('users.id', 'users.email', 'users.name', 'users.shippingAddress')
                ->get();
    }

    protected function sendAdminDashboard(){
        return view('dashboard', [
            'participants' => $this->sendDashboardParticipantsTable(),
            'customers' => $this->sendDashboardCustomersTable(),
        ]);
    }

    protected function sendAdminTableProductsInfo(){
        return DB::table('products')
                ->select('products.name', 'products.totalQuantitySold', 'products.quantityAvailable', 'products.ratePerItem')
                ->get();
    }

    protected function sendAdminTableOrdersInfo(){
        return DB::table('orders')
            ->select('orders.date', 'orders.productID', 'orders.quantityOrdered', 'orders.totalAmount')
            ->orderBy('date', 'desc')
            ->limit(10)
            ->get();
    }

    protected function sendAdminTables(){
        return view('admin_tables', [
            'products' => $this->sendAdminTableProductsInfo(),
            'orders' => $this->sendAdminTableOrdersInfo(),
        ]);
    }

    public function tableWithCustomerData(Request $request){
        return DB::table('products')
        ->rightJoin('orders', 'products.id', '=', 'orders.productID')
        ->where('orders.userID', $request->user()->id)
        ->select('products.name', 'orders.quantityOrdered', 'orders.totalAmount')
        ->get();
    }


    protected function sendCustomerDashboard(Request $request){
        return view('customer_dashboard', [
            'orders' => $this->tableWithCustomerData($request)
        ]);
    }


    protected function tableWithParticipantProductsPerformance(Request $request){
        return DB::table('users')
                ->rightJoin('products', 'users.id', '=', 'products.userID')
                ->where('products.userID', $request->user()->id)
                ->select('products.name', 'products.totalQuantitySold', 'products.ratePerItem')
                ->get();
    }

    protected function sendParticipantDashboard(Request $request){
        return view('participant_dashboard', [
            // 'products' => $this->tableWithParticipantProductsPerformance($request),
        ]);
    }
}

//TODO;
// use unions for all the logic(s) above.
// an issue with the percentage sale logic

