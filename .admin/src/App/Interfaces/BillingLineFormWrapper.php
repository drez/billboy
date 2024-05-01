<?php

namespace App;


/**
 * Skeleton subclass for representing a services for the BillingLineForm entity.
 *
 * User
 *
 * You should add additional methods/hooks to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.GoatCheese.
 */
class BillingLineFormWrapper extends BillingLineForm
{
    public function __construct($request, $args)
    {
        parent::__construct($request, $args);
    }

    /**
     * Hook form after the data getter
     * @param array $data
     * @param BillingLine $dataObj
     * @return void
    **/

    public function afterFormObj( array &$data, BillingLine &$dataObj)
    {
        $defaultAmount = (billing_default_unit_amount)?billing_default_unit_amount:'0.00';

        if ($dataObj->isNew()) {
            $this->hookFormReadyJs = "
        $('#formBillingLine #WorkDate').val('".date('Y-m-d')."');
        $('#formBillingLine #Amount').val('$defaultAmount');
        $('#formBillingLine #Quantity').val('1');
            ";
        }
    }

}
