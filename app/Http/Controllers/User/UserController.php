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
  public function home() {
    $pizza = Product::orderBy('created_at','desc')->get();
    $history = Order::where('user_id',Auth::user()->id)->get();
    $category = Category::get();
    $cart =Cart::where('user_id',Auth::user()->id)->get();
    return view('user.main.home',compact('pizza','category','cart','history'));
  }

  //user change pw page
  public function changePasswordPage() {
    return view('user.password.change');
  }

  //filter pizz list
  public function filter($categoryId) {
    $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
    $history = Order::where('user_id',Auth::user()->id)->get();
    $category = Category::get();
    $cart =Cart::where('user_id',Auth::user()->id)->get();
    return view('user.main.home',compact('pizza','category','cart','history'));
  }


  //user order history
  public function history() {
    $order =Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
    return view('user.main.history',compact('order'));
  }



  //direct details page
  public function pizzaDetails($pizzaId) {
    $pizza = Product::where('id',$pizzaId)->first();
    $pizzaList = Product::get();
    return view('user.main.details',compact('pizza','pizzaList'));
  }

  //direct cart
  public function cartList() {
    $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                      ->leftJoin('products','products.id','carts.product_id')
                      ->where('carts.user_id',Auth::user()->id)
                      ->get();
    $totalPrice =0;
    foreach ($cartList as $c) {
        $totalPrice +=$c->pizza_price*$c->qty;
    }
    return view('user.main.cart',compact('cartList','totalPrice'));
  }

  //user change pw
  public function changePassword(Request $request) {
    $this->passwordValidationCheck($request);
    $user=User::select('password')->where('id',Auth::user()->id)->first();
    $dbHashValue =$user->password;

    if(Hash::check($request->oldPassword,$dbHashValue)) {
      $data = [
        'password' =>Hash::make($request->newPassword)
      ];
       User::where('id',Auth::user()->id)->update($data);
       return back()->with(['changeSuccess'=>'Passsword Change Success']);
    }
    return back()->with(['notMatch'=>'The Old Password is not Match.Try Again']);
}

   //direct admin's user list page
   public function userList() {
    $users =User::where('role','user')->paginate(3);
    return view('admin.user.list',compact('users'));
   }

   //user acc change page
   public function accountChangePage() {
    return view('user.profile.account');
   }

   //ajax admin's user list
   public function userChangeRole(Request $request) {
    $updateSource = [
        'role'=>$request->role
    ];
    User::where('id',$request->userId)->update($updateSource);
   }

   //user account profile update
   public function accountChange($id,Request $request) {
    $this->accountValidationCheck($request);
    $data =$this->getUserData($request);

    if($request->hasFile('image')) {
        $dbImage =User::where('id',$id)->first();
        $dbImage =$dbImage->image;

        if($dbImage !=null) {
            Storage::delete('public/'.$dbImage);
        }

        $fileName =uniqid() .$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image'] =$fileName;
    }

    User::where('id',$id)->update($data);
    return back()->with(['updateSuccess'=>'Account profile updated']);

   }

    //user message
  public function contact($contactId) {
    return view('user.main.contact');
  }

  //user contact send info
  public function send(Request $request) {
    $this->contactValidationCheck($request);
    $data =$this->requestContactInfo($request);

    Contact::where('id',Auth::user()->id)->create($data);
    return back()->with(['sendSuccess'=>'Message Success']);
  }

   //request contact info
   private function requestContactInfo($request) {
    return [
        'name'=>$request->name,
        'email'=>$request->email,
        'message'=>$request->message,
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
    ];

}

private function contactValidationCheck($request) {
Validator::make($request->all(),[
    'name'=>'required',
    'email'=>'required',
    'message'=>'required|min:10',
])->validate();
}


   //get user acc date
   private function getUserData ($request) {
    return [
        'name'=>$request->name,
        'email'=>$request->email,
        'phone'=>$request->phone,
        'address'=>$request->address,
        'updated_at'=>Carbon::now(),
    ];
}

   //user acc validation
   private function accountValidationCheck($request) {
    Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required',
        'phone'=>'required',
        'address'=>'required',
        'gender'=>'required',
        'image'=>'mimes:jpg,jpeg,png,webp|file'
    ])->validate();
}


     //user pw validation check
     private function passwordValidationCheck($request) {
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:8',
            'newPassword'=>'required|min:8',
            'confirmPassword'=>'required|min:8|same:newPassword'
        ])->validate();
    }
}
