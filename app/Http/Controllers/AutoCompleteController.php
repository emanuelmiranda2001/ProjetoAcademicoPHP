<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\Product;
   
class AutoCompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shop.autocompleteSearch');
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $res = Product::select("title")
                ->where("title","LIKE","%{$request->term}%")
                ->get();
    
        return response()->json($res);
    }
    
}
