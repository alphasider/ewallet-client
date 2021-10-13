<?php
  declare( strict_types = 1 );

  namespace Ewallet;

  use DateTime;
  use DateTimeInterface;
  use Dotenv\Dotenv;
  use SoapClient;
  use SoapFault;

  require 'vendor/autoload.php';
  Dotenv::createImmutable( __DIR__ )->load();

  $options = [
    'trace'      => true,
    'cache_wsdl' => WSDL_CACHE_NONE,
  ];

  $client = new SoapClient( $_ENV[ 'WSDL_URL' ], $options );
  $client->__setLocation( $_ENV[ 'SOAP_SERVER_LOCATION' ] );

  $transaction                  = new PerformTransactionArguments();
  $transaction->amount          = 150000;
  $transaction->password        = hash( 'sha256', '12345' );
  $transaction->username        = 'elon_musk';
  $transaction->serviceId       = 1;
  $transaction->transactionId   = 437;
  $transaction->transactionTime = ( new DateTime( 'now' ) )->format( DATE_ATOM );
  $transaction->parameters      = [
    new GenericParam( 'customer_id', '2' ),
    new GenericParam( 'wallet_number', '999877208249270' ),
  ];

  /*
    // Example of how to send request to check GetInformation method

    $infoParams             = new GetInformationArguments();
    $infoParams->password   = hash( 'sha256', '12345' );
    $infoParams->username   = 'elon_musk';
    $infoParams->serviceId  = 3;
    $infoParams->parameters = [
      new GenericParam( 'client_id', '1' ),
      new GenericParam( 'pin', '12345678' ),
    ];

    $client->PerformTransaction( $infoParams )
  */

  try {
    dump( $client->PerformTransaction( $transaction ) );
  } catch ( SoapFault $exception ) {
    dump( $exception );
  }
