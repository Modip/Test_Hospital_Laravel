<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Department;
use App\Models\Payment;
use App\Models\Personne;
use App\Models\Om;

use DB;



class OrderController extends Controller
{
    //
    public function addOrder(Request $request){

        $payments = Payment::orderBy("nom", "asc")->get();
        $departments = Department::orderBy("nom", "asc")->get();

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

        $amount=$request->montant;
        $pId= $request->payment_id;

        if($pId==1){
            $clientOm = Om::where('phone', '=', $request->phone)->first();
            $solde=$clientOm->solde;
            $newSolde=$solde-$amount;
            
            if($newSolde>=0){
                // error_log($newSolde);
                $clientOm->solde= $newSolde;
                $clientOm->save();
                $res = $order->save();
                return back()->with('success', 'Paiement bien reussi');

            }else{
                return back()->with('message', 'Solde insuffisant');
            }
        }else if($pId==2){

            $clientWave = Wave::where('phone', '=', $request->phone)->first();
            $solde=$client->solde;
            $newSolde=$solde-$amount;
            // 
            if($newSolde>=0){
                // error_log($newSolde);
                $clientWave->solde= $newSolde;
                $clientWave->save();
                $res = $order->save();
                return back()->with('success', 'Paiement bien reussi');

            }else{
                return back()->with('fail', 'Erreur');
            }
        }else{
            $res = $order->save();
            if ($res) {
            return back()->with('success', 'Paiement bien reussi');
            }else{
                return back()->with('fail', 'Erreur');
            }
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

    public function UpdateSomme (){

        $personnes = Personne::where('phone', $phone->phone)->get();

    }
}
