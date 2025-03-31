<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user_profile(){
        return view('admin.user.user_profile_update');
    }

    public function user_profile_update(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        $user = User::find(Auth::id());
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return back()->with('update', 'User Profile Updated!');
    }

    public function user_password_update(Request $request){
        $user = User::find(Auth::id());
        if(Hash::check($request->current_password, $user->password)){
            User::find(Auth::id())->update([
                'password' => Hash::make($request->password),
            ]);
            return back()->with('password', 'Password Updated!');
        }
        else{

        }
    }

    public function user_photo_update(Request $request){
        $user = User::find(Auth::id());
        $file_name = $user->photo;

        if($user && $user->photo && file_exists(public_path('uploads/user/'.$user->photo))){
            unlink(public_path('uploads/user/'.$user->photo));
        }
        if($request->hasFile('photo')){
            $user_photo = $request->file('photo');
            $file_name = time().'.'.$user_photo->getClientOriginalExtension();
            $user_photo->move(public_path('uploads/user'),$file_name);
        }

        $user->update([
            'photo' => $file_name,
        ]);

        return back()->with('photo', 'User Photo Updated!');
    }





    // User Create Here
    public function user_list(){
        $users = User::where('id', '!=', Auth::id())->get();
        return view('admin.user.user_list',compact('users'));
    }

    public function user_create(){
        return view('admin.user.user_create');
    }

    public function user_store(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.list')->with('success', 'User Added Successfully');
    }

    public function user_delete($id){
        $user = User::find($id);
        if($user && $user->photo && file_exists(public_path('uploads/user/'.$user->photo))){
            unlink(public_path('uploads/user/'.$user->photo));
        }
        $user->delete();
        return back()->with('delete', 'User has been Deleted!');
    }

}
