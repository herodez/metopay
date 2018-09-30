<?php

namespace App\Soap\Request;

use App\Soap\Data\Authentication;

class GetBankList
{
  /**
   * @var array
   */
  protected $auth;

  /**
   * GetBankList constructor.
   *
   * @param array $auth
   */
  public function __construct(Authentication $auth) 
  {
    $this->auth = $auth->toArray();
  }

  /**
   * @return string
   */
  public function getAuth()
  {
    return $this->auth;
  }

}
