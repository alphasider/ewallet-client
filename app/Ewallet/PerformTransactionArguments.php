<?php
  declare( strict_types = 1 );

  namespace Ewallet;

  use DateTime;

  class PerformTransactionArguments {
    public int    $amount;
    public int    $serviceId;
    public int    $transactionId;
    public        $transactionTime;
    public string $password;
    public string $username;
    public array  $parameters;
  }