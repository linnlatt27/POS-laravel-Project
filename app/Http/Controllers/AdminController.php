<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //admin change Passwordpage
     public function changePasswordPage() {
        return view('admin.account.changePassword');
    }

    //admin changepassword
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

    //details direct page
    public function details() {
        return view('admin.account.details');
    }

    //edit acc profile
    public function edit() {
        return view('admin.account.edit');
    }

    //update account
    public function update($id, Request $request) {
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
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Account profile updated']);

    }


    //admin user list
    public function list() {
        $admin = User::when(request('key'),function($query){
                $query->orWhere('name','like','%'.request('key').'%')
                      ->orWhere('email','like','%'.request('key').'%');
        })
                ->where('role','admin')
                ->paginate(3);
         $admin  ->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    public function delete($id) {
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account Deleted']);
    }

    //change role acc
    public function changeRole($id) {
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    public function adminChangeRole(Request $request) {
        $updateSource = [
            'role'=>$request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
    }

    public function change($id,Request $request) {
        $data =$this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //request User Data
    private function requestUserData($request) {
        return [
            'role'=>$request->role
        ];
    }

    //request account data
    private function getUserData ($request) {
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'updated_at'=>Carbon::now(),
        ];
    }

    private function accountValidationCheck($request) {
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'image'=>'mimes:jpg,jpeg,png|file'
        ])->validate();
    }

    //admin pw validation check
    private function passwordValidationCheck($request) {
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:8',
            'newPassword'=>'required|min:8',
            'confirmPassword'=>'required|min:8|same:newPassword'
        ])->validate();
    }
}
