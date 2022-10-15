<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\HasBought;
use App\Models\Order;
use App\Models\Point;

class CheckoutController extends Controller
{

    protected function processCheckout(Request $request){
        $cartData = $this->storeCart($request);
        $cart = json_decode($cartData->cartData, true)[0];
        $products = json_decode($cartData->cartData, true);

        $this->populateHasBoughtsTable($cart, $products);
        $this->awardUserPoints($cart, $products);
        $this->updateProductStock($products);
        $this->recordOrders($cart, $products);
    }

    protected function populateHasBoughtsTable($cart, $products){
        $customerId = $cart['userID'];

        foreach (array_slice($products, 1) as $product) {
            $productId = $product['id'];

            $match = DB::table('has_boughts')->where('customerID', $customerId)->where('productID', $productId)->get();
            if($match->count() == 0){ //if we dont get results.(you are a first time buyer)
                HasBought::create([
                    'customerID' => $customerId,
                    'productID' => $productId,
                    'numberOfTimes' => 1,
                    'returnPurchase' => false
                ]);
                continue; // go on to the next product
            }elseif($match->count() > 0){
                $numberOfTimes = $match->value('numberOfTimes');

                // to be used for updating
                $returnPurchase = true;
                $numberOfTimes += 1;

                DB::table('has_boughts')->where('customerID', $customerId)->where('productID', $productId)->update([
                    'numberOfTimes' => $numberOfTimes,
                    'returnPurchase' => $returnPurchase,
                ]);
            }
        }
    }

    protected function awardUserPoints($cart, $products){
        $customerId = $cart['userID'];
        foreach (array_slice($products, 1) as $product) {
            // get participant associated with the product.
            $productId = $product['id'];
            $participantId = DB::table('products')->where('id', $productId)->value('userID');

            $quantity = $product['quantity'];

            // we go to the has_boughts table and see the number of times this
            // specific customer has bought this product(are they a return customer????)
            $match = DB::table('has_boughts')->where('customerID', $customerId)->where('productID', $productId)->get();
            $currentPoints = DB::table('points')->where('participantID', $participantId)->value('numberOfPoints');

            if($match->count() > 0){
                if($match->value('returnPurchase') == false){
                    // update user purchase points by one
                    Point::create([
                        'participantID' => $participantId,
                        'numberOfPoints' => $currentPoints + 1
                    ]);
                }
                elseif($match->value('returnPurchase') == true && $quantity == 1){
                    // ...by two
                    DB::table('points')->where('participantID', $participantId)->increment('numberOfPoints', 2);
                }elseif($match->value('returnPurchase') == true && $quantity > 1){
                    // ..by four
                    DB::table('points')->where('participantID', $participantId)->increment('numberOfPoints', 4);
                }
            }
        }
    }


    protected function updateProductStock($products){
        foreach (array_slice($products, 1) as $product) {
            $productId = $product['id'];
            $quantity = $product['quantity'];

            DB::table('products')->where('id', $productId)->decrement('quantityAvailable', $quantity);
        }
    }

    protected function recordOrders($cart, $products){
        $customerId = $cart['userID'];
        foreach (array_slice($products, 1) as $product) {
            $productId = $product['id'];
            $quantityOrdered = $product['quantity'];
            $unitPrice = DB::table('products')->where('id', $productId)->value('ratePerItem');

            Order::create([
                'userID' => $customerId,
                'productID' => $productId,
                'quantityOrdered' => $quantityOrdered,
                'totalAmount' => $quantityOrdered*$unitPrice,
            ]);
        }
    }

    protected function storeCart(Request $request){
        return Cart::create([
            'cartData' => json_encode($request->input()),
            'customerID' => $request->user()->id
        ]);
    }

    protected function finalisePurchase(){
        // code....
    }

}

// TODO;
// fix some issue with the "points awarding" logic.
// and the storeCart() method.


// i have added the totalQuantityPosted and totalQuantitySold fields to my database
// add logic in this controller to account for those changes.
