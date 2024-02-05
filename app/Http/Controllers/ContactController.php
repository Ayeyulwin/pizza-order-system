<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //direct contact page
    public function ContactList(){
        $contact = Contact::get();
        return view('admin.contact.list',compact('contact'));
    }

    //contact delete
    public function delete($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Message was deleted.....']);
    }


}
