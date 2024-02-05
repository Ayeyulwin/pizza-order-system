<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list
    public function productList(){
        $products = Product::get();
        return response()->json($products,200);
    }

    //get all category list
    public function categoryList(){
        $categories = Category::orderBy('id','desc')->get();
        return response()->json($categories, 200);
    }

    //get all user list
    public function userList(){
        $users = User::get();
        return response()->json($users, 200);
    }

    //get all order list
    public function orderList(){
        $orders = OrderList::get();
        return response()->json($orders, 200);
    }

    //create category
    public function createCategory(Request $request){
        // dd($request->header('headerData'));
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $response = Category::create($data);
        return response()->json($response , 200);

    }

    //create contact
    public function createContact(Request $request){
        $data = $this->getContactData($request);
        Contact::create($data);
        $contact = Contact::orderBy('id','desc')->get();
        return response()->json($contact, 200);
    }

    //delete category
    public function deleteCategory(Request $request){
        $data = Category::where('id',$request->category_id)->first();

        if(isset($data)){
            Category::where('id',$request->category_id)->delete();
            return response()->json(['status'=>true, 'message'=>"delete success",'deleteData' => $data],200);
        }

        return response()->json(['status'=>false ,'message'=>"There is no category"],500);

    }

    //category details
    public function categoryDetails($id){
        $data = Category::where('id',$id)->first();

        if(isset($data)){
            return response()->json(['status'=>true,'category' => $data],200);
        }

        return response()->json(['status'=>false, 'category'=>"There is no category"],500);

    }

    //category update
    public function categoryUpdate(Request $request){
        $categoryId = $request->category_id;

        $dbSource = Category::where('id',$categoryId)->first();

    if(isset($dbSource)){
        $data = $this->getCategoryData($request);
        Category::where('id',$categoryId)->update($data);
        $response = Category::where('id',$categoryId)->first();
        return response()->json(['status'=> true , 'message'=>"category update success",'category'=>$response],200);

    }

    return response()->json(['status'=>false, 'category'=>"There is no category for update"],500);

    }

    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }

    //get category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ];
    }
}
