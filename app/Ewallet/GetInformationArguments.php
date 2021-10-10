<?php
  declare( strict_types = 1 );

  namespace Ewallet;

  class GetInformationArguments extends GenericArguments {
    public int $serviceId;
    public $parameters;
  }