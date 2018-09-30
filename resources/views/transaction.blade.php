@extends('layouts.app')

@section('title')
   | Transaction: {{$transaction->transaction_id}}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('transactions')}}">Transactions</a></li>
    <li class="breadcrumb-item active" aria-current="page">Transaction: {{$transaction->transaction_id}}</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Transaction: {{$transaction->transaction_id}}
                    <span class="float-right">State: {{$transaction->state}}</span>
                </div>

                <div class="card-body card-body-notpadding">
                    <table class="table" >
                        <thead class="thead-metopay">
                            <tr>
                                <th>Transaction:</th>
                                <th>Authorization:</th>
                                <th>Amount</th>
                                <th>State:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$transaction->transaction_id}}</td>
                                <td>{{$transaction->authorization}}</td>
                                <td>{{$transaction->amount}} $</td>
                                <td>{{$transaction->state}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
