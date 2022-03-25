@extends('layouts.base')
 @section('content')
 <main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Payement</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="/manager">Dashboard</a></li>
                <li class="breadcrumb-item active">Tables</li>
                </ol>
                    @if(Session::has('delete_order'))                                        
                        <div class="alert alert-success">
                            {{Session::get('update_order')}}
                        </div>
                    @endif
                    <div class="card mb-4">
                        <div class="card-body">
                            <a href="user" class="btn btn-primary">Ajouter payement</a>   
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Liste des Payement
                            </div>
                            <div class="card-body">
                                @if(Session()->has("successDelete"))
                                <div class="alert alert-success">
                                    <h3> {{$Session()->get("successDelete")}} </h3>
                                </div>
                                @endif
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Prenom</th>
                                            <th>Nom</th>
                                            <th>Departement</th>
                                            <th>Mode de payement</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id}}</td>
                                            <td>{{ $order->prenom}}</td>
                                            <td>{{ $order->nom}}</td>
                                            <td>{{ $order->Department->nom}}</td>
                                            <td>{{ $order->Payment->nom}}</td>
                                            <td>
                                            <a href="/manager/edit-order/{{$order->id}}" class="btn btn-info">Modifier</a>
                                            </td>
                                            
                                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection

