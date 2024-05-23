<?php

namespace App\Http\Controllers;


use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

     //direct contact list page
   public function list($contactId) {
    $contact =Contact::paginate(5);
    return view('admin.contact.list',compact('contact'));
   }

    public function delete($contactId) {
        Contact::where('id',$contactId)->delete();
        return back()->with(['deleteSuccess'=>'Message delete Success']);
    }

}
