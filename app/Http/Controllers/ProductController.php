<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

use App\Models\Cart;

use App\Models\Order;

use Session;

use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Product::orderBy('price','desc')->paginate(5);
		return view('product.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

public function store(Request $request){
	$result = $request->validate([
		'title' => 'required|regex:/^[A-z0-9\/\-\s]+$/|max:150|unique:products',
		'code' => 'required|regex:/^[A-z0-9\-\_]+$/|max:50|unique:products',
		'description' => 'required|regex:/^[A-z0-9\-\.\ç\á\é\ã\%\/\,\s]+$/|max:1500',
		'price' => 'required|numeric|between:0,500',
		'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg',
	]);
	//deal with the image, if any
		if( array_key_exists('image', $result) ){
		//there is an image to insert
			if( $request->file('image')->isValid() ){
			$filename = time() . "_" . $request->file('image')->getClientOriginalName();
			$result = $request->file('image')->move('storage/', $filename);
			}
			else{
			//error - return message
			return Redirect::to('products.create')->with('error','Something went wrong with the file: please try again later.');
			}
		}
	//get data to insert into the table
	$data = $request->all();
	//remove token, if it exists
		if( array_key_exists('_token', $data) ){
		unset($data['_token']);
		}
		if ( !isset($filename) ){
		//there is no image to insert so use the default one
		$data['image'] = "defaultImage.jpg";
		}
		else{
		$data['image'] = $filename;
		}
	//insert new product
	Product::create($data);
	return redirect('products')->with('success','Product Inserted!');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
		//check if ‘id’ exists, as it is passed by get
		if ( empty($product) ){
			return Redirect::to('products')->with('error','Invalid operation selected.');
		}
			return view('product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

public function update(Request $request, $id){
	//validate fields. In this case, only price and image (may or may not be changed)
	$receivedProductData = $request->validate([
		'price' => 'required|numeric|between:0,500',
		'image' => 'nullable|sometimes|image|mimes:jpeg,png,jpg',
	]);
	$originalProduct = Product::find($id);
		if ( !empty($originalProduct) ){
		//the table entry exists in the database
		//price must exist and be filled. Here is has a correct value.
		$originalProduct['price'] = $receivedProductData['price'];
		//image may not exist - nothing needs to change then
			if( array_key_exists('image', $receivedProductData) ){
			//there is a valid image to replace the existing one
				if( $request->file('image')->isValid() ){
				$filename = time() . "_" . $request->file('image')->getClientOriginalName();
				$result = $request->file('image')->move('storage/', $filename);
				//add the new filename to the array and erase the previous file if it is not the default image
					if ( $originalProduct['image'] != 'defaultImage.jpg'){
					unlink('storage/' . $originalProduct['image']);
					}
					$originalProduct['image'] = $filename;
				}
			else{
				//error - return message
				return redirect('products')->with('error','Something went wrong with the file: please try again later.');
			}
			} //update data
			$originalProduct->save();
			return redirect('products')->with('success','Product data updated!');
		}
		else{
		//error - return message
		return redirect('products')->with('error','Invalid operation detected.');
		}
}
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
		
		if ( !empty($product) && $product['image'] != 'defaultImage.jpg' && file_exists('storage/'. $product['image']) ){
			unlink('storage/' . $product['image'] );
			Product::where('id',$id)->delete();
			return redirect('products')->with('sucess','Product removed from list');
		}
		elseif ( !empty($product) ){
			Product::where('id',$id)->delete();
			return redirect('products')->with('success','Product removed from list');
		}
		else{
			return redirect('products')->with('error','Invalid Operation Detected.');
		}
    }
	
	public function getAddToCart(Request $request, $id){
		
		$product = Product::find($id);
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->add($product, $product->id);
		
		$request->session()->put('cart', $cart);
		//dd($request->session()->get('cart'));
		return redirect('shops');
	}
	
	
	public function getReduceByOne($id){
		
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->reduceByOne($id);
		
		if(count($cart->items) > 0){
			Session::put('cart', $cart);
		}
		else{
			Session::forget('cart');
		}
		return redirect()->route('product.shoppingCart');
	}
	
	public function getRemoveItem($id){
		
		$oldCart = Session::has('cart') ? Session::get('cart') : null;
		$cart = new Cart($oldCart);
		$cart->removeItem($id);
		
		if(count($cart->items) > 0){
			Session::put('cart', $cart);
		}
		else{
			Session::forget('cart');
		}
		
		return redirect()->route('product.shoppingCart');
	}
	
	public function getCart(){
		if (!Session::has('cart')){
			return view('shop.shopping-cart', ['products' => null]);
		}
		$oldCart = Session::get('cart');
		$cart = new Cart($oldCart);
		return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
	}
	
	public function getCheckout(){
        if (!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout(Request $request)
    {
		
        if (!Session::has('cart')) {
            return redirect()->route('shop.shoppingCart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
		
		
        try {
			
			$validate = $request->validate([
			'name' => ['required', 'string', 'max:255', 'min:4'],
			'nif' => ['required','numeric','digits:9'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'address' => 'required|regex:/^[A-z0-9\-\.\ç\á\é\ã\%\/\,\s]+$/|max:1500',
			]);
			
			$order = new Order();
			
			$order->cart = serialize($cart);
			$order->name = $request['name'];
			$order->nif = $request['nif'];
			$order->email = $request['email'];	
			$order->address = $request['address'];
			
			Auth::user()->orders()->save($order);

			
        } catch (\Exception $e) {
            return redirect()->route('checkout')->with('error', 'Incorrect or incomplete fields!' );
        }

        Session::forget('cart');
        return redirect()->route('shop.index')->with('success', 'Successfully purchased products!');
    }
	
}
