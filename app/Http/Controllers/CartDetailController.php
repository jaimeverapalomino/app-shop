<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;

class CartDetailController extends Controller
{
    public function store(Request $request)
    {
    	$cartDetail = new CartDetail();
    	$cartDetail->cart_id = Auth()->user()->cart->id; //function getCartIdAttribute() // user.php
    	$cartDetail->product_id = $request->product_id;
    	$cartDetail->quantity = $request->quantity;
		$cartDetail->save();

		return back();
    }
}
