<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Cart;

use App\Models\Order;

use Illuminate\Support\Facades\Hash;

use Session;

use Auth;

class UserController extends Controller
{
	
	 public function index()
    {
        $data['users'] = User::orderBy('id','desc')->paginate(10);
		return view('users.listUsers',$data);
    }
	
	 public function destroy($id)
    {
        $user = User::find($id);
		
		if ( !empty($user) ){
			User::where('id',$id)->delete();
			return redirect('users')->with('success','User removed from list');
		}
		else{
			return redirect('users')->with('error','Invalid Operation Detected.');
		}
    }
	
	 public function edit()
    {
		if(Auth::user()){
			$user = User::find(Auth::user()->id);
			
			if($user){
				return view('users.edit')->withUser($user);
			}
			else{
				return redirect()->back();
			}
		}
		else{
			return redirect()->back();
		}
		//return view('users.edit')->with('user', auth()->user());
    }
	
	public function update(Request $request)
	{
		$user = auth()->user();
		
		if($user){
			
			$validate = null;
			
			if(Auth::user()->email === $request['email'] && Auth::user()->email === $request['email']){
				
				$validate = $request->validate([
				'name' => ['required', 'string', 'max:255'],
				'email' => ['required', 'string', 'email', 'max:255'],
				'nif' => ['required','digits:9']
				]);
			}
			else{
				$validate = $request->validate([
				'name' => ['required', 'string', 'max:255'],
				'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
				'nif' => ['required','digits:9', 'unique:users']
				]);
			}
			
			if($validate){
				$user->name = $request['name'];
				$user->email = $request['email'];
				$user->nif = $request['nif'];
				
				$user->save();
				
				$request->session()->flash('success','Profile data updated!');
				return redirect()->back();
			}
			else{
				return redirect()->back();
			}		
		}
		else{
			return redirect()->back();
		}
	}
		
		public function passwordEdit(){
			if(Auth::user()){
				return view('users.password');
			}
		
			else{
				return redirect()->back();
			}
		}
		
		
		public function passwordUpdate(Request $request){
			
			$validate = $request->validate([
				'oldPassword' => ['required', 'string', 'min:8'],
				'password' => ['required', 'string', 'min:8', 'required_with:password_confirmation'],
			]);
			
			$user = User::find(Auth::user()->id);
			if($user){
			
				if(Hash::check($request['oldPassword'],$user->password) && $validate){
					$user->password = Hash::make($request['password']);
					
					$user->save();
					
					$request->session()->flash('success','Your password habe been updated!');
					return redirect()->back();
					
				}
				else{
					$request->session()->flash('error','The entered password does not match your current password!');
					return redirect()->route('password.edit');
				}
				
			}
		}
		
		public function editUser($id)
		{
			$user = User::find($id);
			//check if 'id' exists, as it is passed by get
			if ( empty($user) ){
				return Redirect::to('users')->with('error','Invalid operation selected.');
			}
				return view('users.edit', ['user' => $user]);
		}
		
		
		public function updateUser(Request $request, $id){
			
			$user = User::find($id);
			//validate fields. In this case, only price and image (may or may not be changed)
			$receivedUserData = $request->validate([
				'name' => ['required', 'string', 'max:255'],
				'email' => ['required', 'string', 'email', 'max:255'],
				'nif' => ['required','digits:9']
			]);
			$originalUser = User::find($id);
				if ( !empty($originalUser) ){
				//the table entry exists in the database
				//price must exist and be filled. Here is has a correct value.
				$originalUser['name'] = $receivedUserData['name'];
				$originalUser['email'] = $receivedUserData['email'];
				$originalUser['nif'] = $receivedUserData['nif'];
				
				$originalUser->save();
					return redirect('users')->with('success','User data updated!');
				}
				else{
				//error - return message
				return redirect('users')->with('error','Invalid operation detected.');
				}
		}
		
		
		public function getProfile(){
			$orders = Auth::user()->orders;
			$orders->transform(function($order, $key){
				$order->cart = unserialize($order->cart);
				return $order;
			});
			return view('users.profile', ['orders' => $orders]);
		}
		
		public function getAllOrders(){
			$orders = Order::all();
			$orders->transform(function($order, $key){
				$order->cart = unserialize($order->cart);
				return $order;
			});
		return view('users.profile', ['orders' => $orders]);
		}
		

	
	
	
	
	
}
