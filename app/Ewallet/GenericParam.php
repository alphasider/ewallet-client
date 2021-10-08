<?php
  declare( strict_types = 1 );

  namespace Ewallet;

  class GenericParam {
    public string $paramKey;
    public string $paramValue;

    public function __construct( $paramKey, $paramValue ) {
      $this->paramKey   = $paramKey;
      $this->paramValue = $paramValue;
    }
  }