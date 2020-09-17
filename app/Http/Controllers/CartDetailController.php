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

    	$notification = "Producto agregado correctamente al carro de compras.";
		return back()->with(compact('notification'));
    }

    public function destroy(Request $request)
    {
    	$cartDetail = CartDetail::find($request->cart_detail_id);
    	if($cartDetail->cart_id == auth()->user()->cart->id)
    		$cartDetail->delete();

    	$notification = "Producto eliminado correctamente del carro de compras.";
		return back()->with(compact('notification', ));
    }
}
