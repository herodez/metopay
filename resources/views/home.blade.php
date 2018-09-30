@extends('layouts.app')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Home</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    New PSE pay
                    <a href="{{route('transactions')}}" class="btn btn-secondary btn-sm float-right">View transactions</a>
                </div>

                <div class="card-body">
                    @if(!$errors->isEmpty())
                       <div class="alert alert-danger" role="alert">
                           {{$errors->first()}}
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                           </button>
                        </div> 
                    @endif
                    <form method="post" action="{{route('createPseTransaction')}}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Client type</label>
                                <select class="form-control" name="client" id="">
                                    <option value="0" @if(old('client') == '0') selected @endif>Person</option>
                                    <option value="1" @if(old('client') == '1') selected @endif>Company</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Bank</label>
                                <select class="form-control" name="bank" id="">
                                    @foreach ($banks as $bank)
                                        <option value="{{$bank->bankCode}}" 
                                            @if(old('bank') == $bank->bankCode) selected @endif>{{$bank->bankName}}</option>                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1">Amount to pay</label>
                            <input type="number" name="amount" value="{{old('amount')}}" class="form-control" placeholder="Amount in colombian pesos">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create transaction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
