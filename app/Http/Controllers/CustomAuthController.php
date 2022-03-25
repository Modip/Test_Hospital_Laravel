<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Department;
use App\Models\Order;

use Hash;
use UserController;

class CustomAuthController extends Controller
{
    //
    public function login(){

        return view("auth.login");

    }

    public function registration(){
        return view("auth.registration");
    }

    public function index(){
        return view("user.index");
    }

    public function registerUser(Request $request){

        $request->validate([
            'prenom'=>'required',
            'nom'=>'required',
            'phone'=>'required',
            'adress'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',

        ]);
        $user = new User();
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->phone = $request->phone;
        $user->adress = $request->adress;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        error_log($user);

        
        $res = $user->save();

        if($res){
            return back()->with('success', 'Inscription reussi');

        }else {
            return back()->with('fail', 'Erreur');
        }

    }  
    
    public function loginUser(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5|max:12',

        ]);
        $user = User::where('email', '=', $request->email)->first();

        if($user){
            if(Hash::check($request->password, $user->password)){
                // return redirect('user');
               
                    if($user->usertype=='0')
                    {
                        $payments = Payment::orderBy("nom", "asc")->get();
                        $departments = Department::orderBy("nom", "asc")->get();
                        return view('user.index',compact("payments", "departments"));
                    }
                    else if($user->usertype=='1')
                    {
                        $payments = Payment::orderBy("nom", "asc")->get();
                        $departments = Department::orderBy("nom", "asc")->get();
                        $orders = Order::orderBy("nom", "asc")->get();
                        return view('manager.homeManager',compact("payments", "departments", "orders"));
                    } 
                    else if($user->usertype=='2')
                    {
                        $payments = Payment::orderBy("nom", "asc")->get();
                        $departments = Department::orderBy("nom", "asc")->get();
                        $orders = Order::orderBy("nom", "asc")->get();                    
                        return view('admin.homeAdmin',compact("payments", "departments", "orders"));
                    
                    }
               
               
            }else {
                return back()->with('fail', 'Erreur email et/ou mot de passe invalid');
            }

        }else {
            return back()->with('fail', 'Erreur email et/ou mot de passe invalid');
        }
    }
}
