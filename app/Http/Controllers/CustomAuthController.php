<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

    public function registerUser(Request $request){
        $request->validate([
            'prenom'=>'required',
            'nom'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',

        ]);
        $user = new User();
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
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
                return redirect('user');
            }else {
                return back()->with('fail', 'Erreur email et/ou mot de passe invalid');
            }

        }else {
            return back()->with('fail', 'Erreur email et/ou mot de passe invalid');
        }
    }
}
