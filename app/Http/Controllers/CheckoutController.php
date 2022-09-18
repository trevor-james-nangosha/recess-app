<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Provider\NullProvider;

class CheckoutController extends Controller
{
    // assume this is the cart that has been
    // sent from the client at the time of checkout
    protected $cart = [
        [
            'customerID' => 7
        ],

        [
            'productID' =>  3,
            'quantity' => 12
        ],

        [
            'productID' =>  4,
            'quantity' => 31
        ],

        [
            'productID' =>  5,
            'quantity' => 16
        ]
    ];

    protected function processCheckout($cart){
        $this->populateHasBoughtsTable($cart);
        $this->awardUserPoints($cart);
        $this->updateProductStock($cart);
        $this->recordOrders($cart);
    }

    protected function populateHasBoughtsTable($cart){
        $customerId = $cart[0]['customerID'];
        foreach (array_slice($cart, 1) as $product) {
            $purchasePoints = 0;
            $productId = $product['productID'];

            // TODO;
            // is an empty result null in php?????

            $match = DB::table('has_boughts')->where('customerID', $customerId)->where('productID', $productId)->get();
            if($match == null){ //if we dont get results.(you are a first time buyer)
                DB::table('has_boughts')->insert([
                    'customerID' => $customerId,
                    'productID' => $productId,
                    'numberOfTimes' => 1,
                    'returnPurchase' => false
                ]);
                continue; // go on to the next product
            }

            $numberOfTimes = $match->numberOfTimes;

             // to be used for updating
            $returnPurchase = true;
            $numberOfTimes += 1;

            DB::table('has_boughts')->where('customerID', $customerId)->where('productID', $productId)->update([
                'numberOfTimes' => $numberOfTimes,
                'returnPurchase' => $returnPurchase,
            ]);
        }
    }

    protected function awardUserPoints($cart){
        $customerId = $cart[0]['customerID'];
        foreach (array_slice($cart, 1) as $product) {
            // get participant associated with the product.
            $productId = $product['productID'];
            $participantId = DB::table('products')->where('id', $productId)->value('userID');
            $quantity = $product['quantity'];

            // we go to the has_boughts table and see the number of times this
            // specific customer has bought this product
            $match = DB::table('has_boughts')->where('customerID', $customerId)->where('productID', $productId)->get();
            $currentPoints = DB::table('points')->where('userID', $participantId)->value('numberOfPoints');

            if($match->returnPurchase == false){
                // update user purchase points by one
                DB::table('points')->where('userID', $participantId)->updateOrInsert([
                    'numberOfPoints' => $currentPoints + 1
                ]);
            }elseif($match->returnPurchase == true && $quantity == 1){
                // ...by two
                DB::table('points')->where('userID', $participantId)->updateOrInsert([
                    'numberOfPoints' => $currentPoints + 2
                ]);
            }elseif($match->returnPurchase == true && $quantity > 1){
                // ..by four
                DB::table('points')->where('userID', $participantId)->updateOrInsert([
                    'numberOfPoints' => $currentPoints + 3
                ]);
            }

        }

    }

    protected function updateProductStock($cart){
        foreach (array_slice($cart, 1) as $product) {
            $productId = $product['productID'];
            $quantity = $product['quantity'];

            DB::table('products')->where('id', $productId)->decrement('quantityAvailable', $quantity);
        }
    }

    protected function recordOrders($cart){
        $customerId = $cart[0]['customerID'];
        foreach (array_slice($cart, 1) as $product) {
            $productId = $product['productID'];
            $quantityOrdered = $product['quantity'];
            $unitPrice = DB::table('products')->where('id', $productId)->value('ratePerItem');

            DB::table('orders')->insert([
                'date' =>  Date ('Y/m/d'), // fix this
                'userID' => $customerId,
                'productID' => $productId,
                'quantityOrdered' => $quantityOrdered,
                'totalAmount' => $quantityOrdered*$unitPrice,
            ]);

        }
    }

}

// TODO;
// dates in php. how to put them in the yyyy-mm-dd format
