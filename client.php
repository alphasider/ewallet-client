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
  $client->__setLocation( 'http://ewallet-server/service.php' );

  $param                  = new PerformTransactionArguments();
  $param->amount          = 150000;
  $param->password        = 'pwd';
  $param->username        = 'user';
  $param->serviceId       = 1;
  $param->transactionId   = 437;
  $param->transactionTime = ( new DateTime( 'now' ) )->format( DATE_ATOM );
  $param->parameters      = [
    new GenericParam( 'customer_id', '6324357' ),
    new GenericParam( 'pin', '12345678' ),
  ];

  $infoParams             = new GetInformationArguments();
  $infoParams->password   = hash( 'sha256', '12345' );
  $infoParams->username   = 'elon_musk';
  $infoParams->serviceId  = 3;
  $infoParams->parameters = [
    new GenericParam( 'client_id', '1' ),
    new GenericParam( 'pin', '12345678' ),
  ];

  try {
    dump( $client->GetInformation( $infoParams ) );
    echo $client->__getLastResponse();
  } catch ( SoapFault $exception ) {
    dump( $exception );
  }
