<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\PseTransactionStore;
use App\Http\Requests\StorePseTransaction;
use App\Soap\Data\Person;
use App\Transaction;
use Cache;

class TransactionController extends Controller
{   
    use PseTransactionStore; 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get banks list from cache
        $banks =  Cache::get('placetopay_banklist', array());

        return view('home', compact('banks'));
    }

    /**
     * Create a new PSE transaction
     *
     * @param Request $request
     * @return Redirect
     */
    public function store(StorePseTransaction $request)
    {
        $payer = getPayerPerson(); 
        $buyer = getBuyerPerson();
        $shipping = getShippingPerson();

        $data = array(
            'bank' => $request->bank,
            'client' => $request->client,
            'amount' => $request->amount,
            'buyer' => $buyer,
            'payer' => $payer,
            'shipping' => $shipping,
            'ip' => $request->ip(),
            'agent' => $request->header('User-Agent')
        );

        $successUrl = $this->createTransaction($data);

        if(!empty($successUrl)){
            return redirect($successUrl);
        }

        return redirect()->route('dashboard')
                         ->with('failt-transaction', 'the transaction could not be made.');
    }

    /**
     * Return the list of transactions
     *
     * @return App\Transactions
     */
    public function getTransactions(Request $request)
    {
        $transactions = Transaction::orderBy('id', 'desc')->paginate(5);

        return view('transactions', compact('transactions'));
    }

    /**
     * Return a transaction
     *
     * @param Transaction $transaction
     * @return Transaction
     */
    public function show(Transaction $transaction)
    {
        if($transaction->state == 'PENDING'){
            $response = getTransactionResult($transaction->transaction_id);
            $transactionInformation = $response->getTransactionInformationResult();
            $transaction->state = $transactionInformation->responseCode;
            $transaction->save();
        }

        return view('transaction', compact('transaction'));
    }
}
