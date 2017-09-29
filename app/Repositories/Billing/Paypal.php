<?php

namespace App\Repositories\Billing;

class Paypal
{
  protected $secret;
  protected $clientId;
  public function __construct($secret, $clientId)
  {
      $this->secret = $secret;
      $this->clientId = $clientId ;
  }
}
