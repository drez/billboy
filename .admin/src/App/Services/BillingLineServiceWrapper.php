<?php

namespace App;


/**
 * Skeleton subclass for representing a services for the BillingLineService entity.
 *
 * User
 *
 * You should add additional methods/hooks to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.GoatCheese.
 */
class BillingLineServiceWrapper extends BillingLineService
{
    public function __construct($request, $response, $args)
    {
        parent::__construct($request, $response, $args);

        $this->Form = new BillingLineFormWrapper($request, $args);
    }

    public function beforeSave(BillingLineService $Class, array &$data, bool $isNew, string|null &$messages, array|false &$extValidationErr)
    {
        $data['Total'] = bcmul($data['Quantity'], $data['Amount']);
    }

    public function afterSave(BillingLine $Class, array &$data, bool $isNew, string|null &$messages, array|false &$extValidationErr)
    {
        $this->setBillingTotal($data['IdBilling']);
        $this->setProjectSpent($Class);
    }

    private function setBillingTotal(int $IdBilling)
    {
        $total = 0;
        $BillingLine = BillingLineQuery::Create()->findByIdBilling($IdBilling);

        if ($BillingLine) {
            foreach ($BillingLine as $line) {
                $total += $line->getTotal();
            }

            $Billing = BillingQuery::Create()->findOneByIdBilling($IdBilling);
            if ($Billing) {
                $Billing->setGross($total);
                $Billing->save();
            }
        }
    }

    public function setProjectSpent(BillingLine $BillingLine){
        $total = 0;
        if ($BillingLine?->getIdProject()) {
            $BillingLine = BillingLineQuery::Create()->filterByIdProject($BillingLine->getIdProject())->find();

            if ($BillingLine) {
                foreach ($BillingLine as $line) {

                    $total += $line->getTotal();
                }

                $Project = ProjectQuery::Create()->findpk($line->getIdProject());
                    if ($Project) {
                        $Project->setSpent($total);
                        $Project->save();
                    }
                
            }
        }
        
    }


}
