<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\Cart;

class ShopController extends Controller
{

    public function index(Request $req)
    {
        if($req){
            $products = Product::where("title","LIKE","%{$req->name}%")->get();
        }
        else {
        $products = Product::all();
        }
        return view('shop.index', ['products' => $products]);
    }

}