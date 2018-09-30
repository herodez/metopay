<?php

namespace App\Soap\Response;

use App\Soap\Data\Bank;

class GetBankListResponse
{
  /**
   * @var StdClass
   */
  protected $getBankListResult;

  /**
   * GetBankListResponse constructor.
   *
   * @param StdClass $getBankListResult
   */
  public function __construct($getBankListResult)
  {
    $this->getBankListResult = $getBankListResult;
  }

  /**
   * @return array
   */
  public function getBankListResult()
  {
    $bankList = collect();

    //Create a collection of banks
    foreach($this->getBankListResult->item as $bank){
      $bankList->push( new Bank( get_object_vars($bank) ));
    }

    return $bankList;
  }
}