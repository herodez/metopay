<?php

namespace App\Soap\Request;

use App\Soap\Data\Authentication;
use App\Soap\Data\PSETransactionRequest;

class CreateTransaction
{
  /**
   * @var array
   */
  protected $auth;

  /**
   * @var array
   */
  protected $transaction;

  /**
   * PSETransaction constructor.
   *
   * @param array $auth
   */
  public function __construct(Authentication $auth, PSETransactionRequest $transaction) 
  {
    $this->auth = $auth->toArray();
    $this->transaction = $transaction->toArray(); 
  }

  /**
   * @return string
   */
  public function getAuth()
  {
    return $this->auth;
  }    
}