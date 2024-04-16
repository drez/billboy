<?php

namespace App;


/**
 * Skeleton subclass for representing a services for the CostLineForm entity.
 *
 * User
 *
 * You should add additional methods/hooks to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.GoatCheese.
 */
class CostLineFormWrapper extends CostLineForm
{
    public function __construct($request, $args)
    {
        parent::__construct($request, $args);
    }

    /**
     * Hook form after the data getter
     * @param array $data
     * @param CostLine $dataObj
     * @return void
    **/

    public function afterFormObj( array $data, CostLine &$dataObj)
    {
         if (is_null($dataObj->getSpendDate())) {
            $this->hookFormReadyJs = "
        $('#formCostLine #SpendDate').val('".date('Y-m-d')."');
            ";
        }
    }

    public function beforeSave(CostLineService $Class, array &$data, bool $isNew, string|null &$messages, array|false &$extValidationErr){
        $data['Total'] = bcmul($data['Quantity'], $data['Amout']);
    }
}
