<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Auth;
use DB;
class CartController extends Controller
{
	public function addToCart(Request $request){
		
		if(\Auth::check()){
			//return $input = $request->all();
			$cart = Cart::where('user_id',Auth::user()->id)->where('product_id',$request->priduct_id)->first();
		    if(!empty($cart)) { 
		    	$update = Cart::where('product_id',$request->priduct_id)->update(['quantity'=>$cart->quantity+$request->quantity]);
		        $request->session()->flash('alert-success', 'cart updated successfully!');
		        return redirect()->back();
		    }else{
		    	$insert = new Cart();
		    	$insert->user_id = Auth::user()->id;
		    	$insert->product_id = $request->priduct_id;
		    	$insert->quantity = $request->quantity;
		    	$insert->price = $request->price;
		    	$insert->save();
		    	$request->session()->flash('alert-success', 'Product added to cart successfully!');
		        return redirect()->back();
		    }
		}else{
			return redirect('/login');
		}
	    
	}
	public function checkout(){
	  if(\Auth::check()){
		$carts = Cart::where('user_id',Auth::user()->id)->get();
		return view('checkout',compact('carts'));
	  }else{
	  	return redirect('/login');
	  }
	}
	public function search(Request $request){
		$input = $request->all();
		$products  = DB::table('products')
        ->select('products.*','categories.category_name')
        ->join('categories','categories.id','=','products.category_id')
        ->join('sub_category','sub_category.id','=','products.sub_category_id')
        ->where('peoduct_name', 'LIKE', '%' . $input['search'] . '%')
        ->orWhere('sub_category_name', 'LIKE', '%' . $input['search'] . '%')
        ->orWhere('category_name', 'LIKE', '%' . $input['search'] . '%')->get();
        return view('search_result',compact('products'));
	}
}
