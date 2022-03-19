<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Department;
use App\Models\Payment;
use DB;



class OrderController extends Controller
{
    //
    public function addOrder(Request $request){
        $request->validate([
            'prenom'=>'required',
            'nom'=>'required',
            'phone'=>'required',
            'montant'=>'required',
            'department_id'=>'required',
            'payment_id'=>'required'

        ]);
        $order = new Order();
        $order->prenom=$request->prenom;
        $order->nom=$request->nom;
        $order->phone=$request->phone;
        $order->montant=$request->montant;
        $order->department_id=$request->department_id;
        $order->payment_id=$request->payment_id;
        $order->number=rand(0000,9999).date('mdYhis');
        
        error_log($order);

        $res = $order->save();

            if($res){
                return back()->with('success', 'Paiement bien reussi');

            }else {
                return back()->with('fail', 'Erreur');
        }
    }

    public function editOrder($id)
    {
        $payments = Payment::all();
        $departments=Department::all();
        $order = DB::table('orders')->where('id', $id)->first();

        return view('edit-order', compact('order', 'fonctions', 'departments'));

    }

    public function updateOrder(Request $request)
    {

        $payments = Payment::all();
        $departments=Department::all();
        DB::table('orders')->where('id', $request->id)->update([
            'prenom'=>$request->prenom,
            'nom'=>$request->nom,
            'montant'=>$request->montant,
            'payment_id'=>$request->payment_id,
            'department_id'=>$request->department_id,
            'number'=>rand(0000,9999).date('mdYhis')



        ]);
        return back()->with('update_order', "Paiement bien modifiée", compact("payments", "departments"));
          
    } 



    public function deleteOrder($id){
        DB::table('orders')->where('id', $id)->delete();

        return back()->with('delete_order', "Payement bien supprimer");
          
        
    }
}
