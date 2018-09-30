<?php

namespace App\Soap\Response;

class CreateTransactionResponse {
  
  /**
   * @var StdClass
   */
  protected $createTransactionResult;

  /**
   * CreateTransactionResponse constructor.
   *
   * @param StdClass $createTransactionResult
   */
  public function __construct($createTransactionResult)
  {
    $this->createTransactionResult = $createTransactionResult;
  }

  /**
   * @return array
   */
  public function getTransactionResult()
  {
    return $this->createTransactionResult;
  }
}