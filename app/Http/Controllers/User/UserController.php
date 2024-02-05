<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }


          //change password
    public function changePassword(Request $request){
        //  1. all field must be filled
        //  2. new password and confirm password length must be greater than 6
        //  3. new password and confirm password must be same
        //  4. client old password must be same with db password
        //  5. password change
        $this->passwordValidationCheck($request);

        $currentUserId = Auth::user()->id;
        $user = User::where('id',$currentUserId)->first();
        $dbHashValue = $user->password;
        $data = [
            'password' => Hash::make($request->newPassword),
        ];

        if(Hash::check($request->oldPassword, $dbHashValue)){
            User::where('id',$currentUserId)->update($data);
            // Auth::logout();
            return back()->with(['changeSuccess' => 'Password change success....']);
        }
        else{
            return back()->with(['notMatch'=>'The old password not match,Try again.....']);
        }
        // Hash::make('ayeyu');

    }

    //user account change
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //user account change
    public function accountChange($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image
        if($request->hasFile('image')){
            //old image name | check =>delete |store
            $dbImage = User::where('id' ,$id)->first();
            $dbImage = $dbImage->image;
            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }
                $fileName = uniqid() . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public',$fileName);
                $data['image'] = $fileName;


        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess' => 'Admin Account Updated......']);
    }

    //filter pizza
    public function filter($id){
        $pizza = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //direct pizza details
    public function pizzaDetails($id){
        $piz = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        return view('user.main.detail',compact('piz','pizzaList'));
    }


    //cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizzaName','products.price as pizzaPrice','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();
        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizzaPrice * $c->qty;
        }

        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //account delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'User account deleted.....']);
    }


    //direct history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history',compact('order'));
    }

     //dircet user list page
     public function userList(){
        $users = User::where('role','user')->get();
        return view('admin.user.list',compact('users'));
    }

    //change user role
    public function userChangeRole(Request $request){
        $updateSource = [
            'role' => $request->status
        ];
        User::where('id',$request->userId)->update($updateSource);
    }

    //direct contact page
    public function contactPage(){
        return view('user.main.contact');
    }

    //contact
    public function contact(Request $request){

        $this->contactValidationCheck($request);
        $data = $this->requestContactInfo($request);
        Contact::create($data);
        return back()->with(['sendSuccess'=>'Thank you for contacting us.....']);

    }

     //password validation check
     private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6',
            'newPassword'=>'required|min:6',
            'confirmPassword'=>'required|min:6|same:newPassword',
        ])->validate();
    }

      //request user data
      private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'updated_at' =>Carbon::now()
        ];
    }

    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required' ,
            'email' => 'required' ,
            'address' => 'required' ,
            'phone' => 'required' ,
            'image' =>'mimes:png,jpg,jpeg,webp|file',
            'gender' => 'required' ,

        ])->validate();
    }

    //request contact info
    private function requestContactInfo($request){
        return[
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }

    //contact validation check
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'message'=>'required|min:10',
        ])->validate();
    }
}
