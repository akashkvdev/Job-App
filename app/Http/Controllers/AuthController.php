<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
//User Registeration
    public function loadRegister(){
        if(Auth::user() && Auth::user()->role=='Admin'){
            return redirect('/admin/dashboard');
        } 
        else if(Auth::user() && Auth::user()->role=='User'){
            return redirect('/dashboard');   
        }
        return view('register');
    }

    public function UsersRegister(Request $request){
        $request->validate([
            'name'=>'string|required|min:2',
            'email'=>'string|email|required|max:100|unique:users',
            'password'=>'string|required|confirmed|min:5',
            'contact'=>'string|required',
            'gender'=>'string|required',
            'address'=>'string|required',
        ]);


        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->contact=$request->contact;
        $user->gender=$request->gender;
        $user->address=$request->address;
        $user->save();

        return back()->with('success','Your Registration has been successfully');
        
    }




//Load Login
public function loadLogin(){

    if(Auth::user() && Auth::user()->role=='Admin'){
        return redirect('/admin/dashboard');
    } 
    else if(Auth::user() && Auth::user()->role=='User'){
        return redirect('/dashboard');   
    }
    return view('login');
}

//Login
public function userLogin(Request $request){
    $request->validate([
        'email' => 'string|required|email',
        'password' => 'string|required',
    ]);

    $userCredentials = $request->only('email', 'password');

    if(Auth::attempt($userCredentials)){
        $user = Auth::user();

        if($user->role == 'Admin'){
            // Storing user data in session for the admin dashboard
            session(['userName' => $user->name, 'userId' => $user->id]);
            return redirect('/admin/dashboard');
        } else {
            // Storing user data in session for the regular dashboard
            session(['userName' => $user->name, 'userId' => $user->id]);
            return redirect('/dashboard');
        }
    } else {
        return back()->with('error', 'Invalid Username And Password');
    }
}


//Logout
    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }


//Load Dashboard based On User

   // AdminDashboard Load=============>
   public function adminDahsboard(){
    return view('admin.admindashboard');
    }

// user Dashboard
    public function loadDahsboard(){
        $skills = Skill::all();
        return view('users.userdashbaord',compact('skills'));
    }

}
