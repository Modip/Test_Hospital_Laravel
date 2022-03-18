<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Payment;
use App\Models\Department;
use App\Models\Order;

class UserController extends Controller
{
    //

    public function index(){

        $payments = Payment::orderBy("nom", "asc")->get();
        $departments = Department::orderBy("nom", "asc")->get();

        return view("user.index", compact("payments"), compact("departments")
    );

    }
    public function redirect()
    {if(Auth::id())
        {
            if(Auth::user()->usertype=='0')
            {
                $payments = Payment::orderBy("nom", "asc")->get();
                $departments = Department::orderBy("nom", "asc")->get();
                return view('user.homeUser',compact("payments"),compact("departments"));
            }
            else
            {
                return view('admin.home');
            }
        }
        else
        {
            return redirect()->back();
        }
    }

}
