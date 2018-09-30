<?php

namespace App\Soap\Request;

use App\Soap\Data\Authentication;

class GetTransactionInformation
{
  /**
   * @var array
   */
  protected $auth;

  /**
   * @var integer
   */
  protected $transactionID; 

  /**
   * GetTransactionInformation constructor.
   *
   * @param Authentication $auth
   * @param integer $transactionId
   */
  public function __construct(Authentication $auth, $transactionId) 
  {
    $this->auth = $auth->toArray();
    $this->transactionID = $transactionId;
  }

  /**
   * @return string
   */
  public function getAuth()
  {
    return $this->auth;
  }
  
  /**
   * @return integer
   */
  public function getTransactionID()
  {
    return $this->transactionID;
  }
}
