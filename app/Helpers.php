<?php

use Artisaninweb\SoapWrapper\SoapWrapper;
use App\Soap\Request\GetTransactionInformation;
use App\Soap\Data\Authentication;
use App\Soap\Data\Person;
use Illuminate\Support\Facades\Auth;

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

/**
 * Get a buller Person instance
 *
 * @return App\Soap\Data\Person
 */
function getBuyerPerson()
{
    $person = new Person(); 
    $person->document = config('placetopay.buyer_document');
    $person->documentType = config('placetopay.buyer_document_type');
    $person->firstName = config('placetopay.buyer_first_name');
    $person->lastName = config('placetopay.buyer_last_name');
    $person->emailAddress = config('placetopay.buyer_email');

    return $person;
}

/**
 * Get a shipping Person instance
 *
 * @return App\Soap\Data\Person
 */
function getShippingPerson()
{
    $person = new Person(); 
    $person->document = config('placetopay.shipping_document');
    $person->documentType = config('placetopay.shipping_document_type');
    $person->firstName = config('placetopay.shipping_first_name');
    $person->lastName = config('placetopay.shipping_last_name');
    $person->emailAddress = config('placetopay.shipping_email');  

    return $person;
}

/**
 * Get a Payer Person instance
 *
 * @return App\Soap\Data\Person
 */
function getPayerPerson()
{
    // Get the currently authenticated user
    $user = Auth::user();
    $name = explode(' ', $user->name);

    $person = new Person(); 
    $person->document = '24415088';
    $person->documentType = 'CC';
    $person->firstName = $name[0]; 
    $person->lastName = isset($name[1]) ? $name[1]:'';
    $person->emailAddress = $user->email;  

    return $person;
}