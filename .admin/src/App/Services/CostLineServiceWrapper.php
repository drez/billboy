<?php

namespace App;


/**
 * Skeleton subclass for representing a services for the CostLineService entity.
 *
 * User
 *
 * You should add additional methods/hooks to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.GoatCheese.
 */
class CostLineServiceWrapper extends CostLineService
{
    public function __construct($request, $response, $args)
    {
        parent::__construct($request, $response, $args);

        $this->Form = new CostLineFormWrapper($request, $args);
    }

    public function beforeSave(CostLineService $Class, array &$data, bool $isNew, string|null &$messages, array|false &$extValidationErr, $error)
    {
        $data['Total'] = bcmul($data['Quantity'], $data['Amount']);
    }

}
