<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Soap\Data\PSETransactionRequest;
use App\Soap\Data\Authentication;
use App\Soap\Request\CreateTransaction;
use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Data\Person;
use App\Transaction;
use Cache;


class TransactionController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    /**
     * Create a new PSE transaction
     *
     * @param Request $request
     * @return Redirect
     */
    public function createTransaction(Request $request)
    {
        $payer = new Person(); 
        $payer->document = '788999033';
        $payer->documentType = 'CC';
        $payer->firstName = 'Mario';
        $payer->lastName = 'Gonzalez';
        $payer->emailAddress = "mario@gmail.com";

        $trans = new PSETransactionRequest(
            array(
            'bankCode' => '1022',
            'bankInterface' => 0,
            'returnURL' => 'http://metopay.test/',
            'reference' => 'mario-122',
            'description' => 'Pago test',
            'language' => 'ES',
            'currency' => 'COP',
            'totalAmount' => 100.00,
            'payer' => $payer->toArray(),
            'buyer' => 'metopay.com',
            'shipping' => 'metopay.com',
            'ipAddress' => '192.168.0.1',
            'userAgent' => 'Google Chorme'
            )
        );

        $soap = resolve(SoapWrapper::class);

        $response = $soap->call('placeToPay.createTransaction', array(
            new CreateTransaction(resolve(Authentication::class), $trans)
        ));

        $transResult = $response->getTransactionResult();
        $newTransaction = new Transaction();
        $newTransaction->transaction_id = $transResult->transactionID;
        $newTransaction->session_id = $transResult->sessionID;
        $newTransaction->authorization = $transResult->trazabilityCode;
        $newTransaction->state = $transResult->responseCode;
        $newTransaction->save();


        if($transResult->returnCode == 'SUCCESS'){
            return redirect($transResult->bankURL);
        }
    }

    /**
     * Return the list of transactions
     *
     * @return App\Transactions
     */
    public function getTransactions(Request $request)
    {
        return Transaction::orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Return the bank list from cache
     *
     * @return array App\Soap\Data\Bank
     */
    public function getBankList()
    {
        return Cache::get('placetopay_banklist', array());
    }
}
