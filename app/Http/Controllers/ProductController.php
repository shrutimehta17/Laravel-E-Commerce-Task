<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Auth;

class ProductController extends Controller
{
    public function index(){
        try{
            $products = Product::all();
            return view('layouts.app', compact('products'));
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function addToCart($id){
        try{
            Cart::create(
                [
                    'user_id' => auth()->user()->id,
                    'product_id' => $id,
                ]
            );
            return redirect()->back()->with('success', 'Product is added into the cart!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
