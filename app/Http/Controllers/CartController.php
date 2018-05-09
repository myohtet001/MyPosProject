<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class CartController extends Controller
{
    public function getCart($id){
        $pd=product::where('id',$id)->first();
        $oldCart=Session::has('cart')? Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->add($pd,$pd->id);
        Session::put('cart',$cart);
        return redirect()->back();

}
public function getDecreaseCart($id){
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $cart->decrease($id);
        if(count($cart->items) >=1){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
}
public function getIncreaseCart($id){
    $oldCart=Session::get('cart');
    $cart=new Cart($oldCart);
    $cart->increase($id);
    Session::put('cart',$cart);
    return redirect()->back();
}
public function postCheck(Request $request){
    $tableNo=$request['tableNo'];
    $cart=Session::get('cart');
    $user_id=Auth::User()->id;
    $or=new Order();
    $or->tableNo=$tableNo;
    $or->cart=serialize($cart);
    $or->user_id=$user_id;
    $or->save();
    Session::forget('cart');
    return redirect()->back();
}
public function getReport(){
    $cart=Order::OrderBy('id','desc')->paginate('5');
    $cart->transform(function ($item, $key){
        $item->cart=unserialize($item->cart);
        return $item;

    });

    return view('admin.product.report')->with(['cart'=>$cart]);
}
public function getPrintOrder($id){
    $cart=Order::OrderBy('id','desc')->get();
    $cart->transform(function ($item, $key){
        $item->cart=unserialize($item->cart);
        return $item;

    });

    return view('admin.product.print')->with(['cart'=>$cart]);
}
}
