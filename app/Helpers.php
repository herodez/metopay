<?php

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Request\GetTransactionInformation;
use App\Soap\Data\Authentication;


/**
 * Get the information result of PSE transaction
 *
 * @param integer $transactionId
 * @return App\Soap\Response\GetTransactionInformationResponse 
 */
function getTransactionResult($transactionId)
{
    $soap = resolve(SoapWrapper::class);

    return $soap->call('placeToPay.getTransactionInformation', array(
        new GetTransactionInformation( 
            resolve(Authentication::class), $transactionId ) 
    ));
}