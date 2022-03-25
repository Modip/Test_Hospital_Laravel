<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Payment;
use App\Models\Department;
use App\Models\Order;

use DB;

class UserController extends Controller
{
    //

    public function index(){

        $payments = Payment::orderBy("nom", "asc")->get();
        $departments = Department::orderBy("nom", "asc")->get();

        return view("user.index", compact("payments"), compact("departments")
    );

    }

    public function homeManager()
    {
        $orders = Order::orderBy("nom", "asc")->get();
        return view('manager.homeManager', compact("orders"));
    }

    public function homeAdmin()
    {
        $orders = Order::orderBy("nom", "asc")->get();
        return view('admin.homeAdmin', compact("orders"));
    }

    public function editOrder($id)
    {
        $payments = Payment::all();
        $departments = Department::all();
        $order = DB::table('orders')->where('id', $id)->first();

        return view('admin.editOrder', compact('order', 'payments', 'departments'));

    }

    public function managerEditOrder($id)
    {
        $payments = Payment::all();
        $departments = Department::all();
        $order = DB::table('orders')->where('id', $id)->first();

        return view('manager.editOrder', compact('order', 'payments', 'departments'));

    }

}
