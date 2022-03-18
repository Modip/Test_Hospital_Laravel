<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $order->number=rand(0000,9999);
        error_log($order);

        $orders = $order->save();

            if($orders){
                return back()->with('success', 'Paiement bien reussi');

            }else {
                return back()->with('fail', 'Erreur');
        }
    }
}
