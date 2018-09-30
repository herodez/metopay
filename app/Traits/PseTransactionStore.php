<?php

namespace App\Traits;

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Data\Person;
use App\Soap\Data\Authentication;
use App\Soap\Request\CreateTransaction;
use App\Soap\Response\createTransactionResponse;
use App\Soap\Data\PSETransactionRequest;
use App\Transaction;

trait PseTransactionStore
{
    /**
     * Create a new transaction
     *
     * @param array $data
     * @return bool
     */
    protected function createTransaction($data)
    {
        $metopayId = $this->generateMetopayId();        
        $redirect  = $this->generateRedirect($metopayId);

        $trans = $this->prepareRequestTransaction($data, $redirect); 
        $response = $this->makeRequest($trans);
        $this->storeTransaction($response, $metopayId, $data['amount']);

        $transResult = $response->getTransactionResult();
        if($transResult->returnCode == 'SUCCESS'){
            return $transResult->bankURL;
        }

        return false;
    }
    
    /**
     * Prepare the data to send 
     *
     * @param array $data
     * @param string $redirect
     * @return App\Soap\Data\PSETransactionRequest
     */
    protected function prepareRequestTransaction($data, $redirect)
    {
        return new PSETransactionRequest(
            array(
            'bankCode' => $data['bank'],
            'bankInterface' => $data['client'],
            'returnURL' => $redirect,
            'reference' => 'mario-122',
            'description' => 'Pago test',
            'language' => 'EN',
            'currency' => 'COP',
            'totalAmount' => $data['amount'],
            'payer' => $data['payer']->toArray(),
            'buyer' => $data['buyer']->toArray(),
            'shipping' => $data['shipping']->toArray(),
            'ipAddress' => $data['ip'],
            'userAgent' => $data['agent']
            )
        );
    }

    /**
     * Make a soap request to create a transaction
     *
     * @param PSETransactionRequest $transaction
     * @return void
     */
    protected function makeRequest(PSETransactionRequest $transaction)
    {
        $soap = resolve(SoapWrapper::class);
        return $soap->call('placeToPay.createTransaction', array(
            new CreateTransaction(resolve(Authentication::class), $transaction)
        ));
    }
    
    /**
     * Store a response transaction data into database
     *
     * @param createTransactionResponse $response
     * @param integer $metopayId
     * @param float   $amount
     * @return void
     */
    protected function storeTransaction(createTransactionResponse $response, $metopayId, $amount)
    {
        $transResult = $response->getTransactionResult();
        $newTransaction = new Transaction();
        $newTransaction->transaction_id = $transResult->transactionID;
        $newTransaction->session_id = $transResult->sessionID;
        $newTransaction->authorization = $transResult->trazabilityCode;
        $newTransaction->state = $transResult->responseCode;
        $newTransaction->metopay_id = $metopayId;
        $newTransaction->amount = $amount;
        $newTransaction->save();
    }

    /**
     * Generate a unique id for the transaction register
     *
     * @return void
     */
    protected function generateMetopayId()
    {
        return uniqid();
    }
    
    /**
     * Generate redirect for transaction register
     *
     * @param [type] $metopayId
     * @return string
     */
    protected function generateRedirect($metopayId)
    {
       return route("transaction_show", $metopayId);
    }
}
