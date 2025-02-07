<?php

namespace App;


/**
 * Skeleton subclass for representing a services for the CurrencyService entity.
 *
 * User
 *
 * You should add additional methods/hooks to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.GoatCheese.
 */
class CurrencyServiceWrapper extends CurrencyService
{
    public function __construct($request, $response, $args)
    {
        parent::__construct($request, $response, $args);

        $this->Form = new CurrencyFormWrapper($request, $args);
    }


}
