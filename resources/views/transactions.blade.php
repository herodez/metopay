@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>
                        Transactions 
                    </h5>
                </div>

                <div class="card-body card-body-notpadding">
                    <table class="table table-striped table-hover">
                        <thead class="thead-metopay">
                            <tr>
                                <th scope="col">Transaction</th>
                                <th scope="col">Session</th>
                                <th scope="col">Authorization</th>
                                <th scope="col">Amount</th>
                                <th scope="col">State</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <th>
                                        <a href="{{ route('transaction_show', $transaction->metopay_id) }}">
                                            {{$transaction->transaction_id}}
                                        <a>
                                    </th>
                                    <td>{{$transaction->session_id }}</td>
                                    <td>{{$transaction->authorization}}</td>
                                    <td>{{$transaction->amount}} $</td>
                                    <td>{{$transaction->state}}</td>
                                    <td>{{$transaction->created_at->toDayDateTimeString()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center card-footer text-muted">
                        {{$transactions->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
