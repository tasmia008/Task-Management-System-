<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    public function postLogin(Request $request){
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->with('status','You have Successfully loggedin');
        }
  
        return redirect("login")->with('status','Oppes! You have entered invalid credentials');
    }


    public function postRegister(Request $request){
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $request->role_id,

          ]);
        
        return redirect()->route('dashboard')->with('status', 'User Successfully created');
        
         
     

    }

    public function deleteUser(Request $request){

        DB::table('users')->where('id', $request->user_id)->delete();
        return redirect()->route('dashboard')->with('status', 'User has been deleted successfully');

    }

    public function dashboard(){
       
        $users = User::all();
        $roles = Role::all();
        $managers = User::where('role_id' ,2)->get();
        $developers = User::where('role_id' ,3)->get();

        if(auth()->user()->role_id == 1){
            $projects = Project::all();
        }elseif(auth()->user()->role_id == 2){
            $projects = Project::where('manager_id', auth()->user()->id)->get();
        }else{
            $projects = Project::where('developer_id', auth()->user()->id)->get();
        }
        
        return view('dashboard', compact('projects','users','roles','managers','developers'));
    }

   



    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', ' You are logged out!!!');
    }


}
