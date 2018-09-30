<?php

namespace App\Soap\Response;

class GetTransactionInformationResponse {
  
  /**
   * @var StdClass
   */
  protected $getTransactionInformationResult;

  /**
   * GetTransactionInformationResponse constructor.
   *
   * @param StdClass $getTransactionInformationResult
   */
  public function __construct($getTransactionInformationResult)
  {
    $this->getTransactionInformationResult = $getTransactionInformationResult;
  }

  /**
   * @return array
   */
  public function getTransactionInformationResult()
  {
    return $this->getTransactionInformationResult;
  }
}