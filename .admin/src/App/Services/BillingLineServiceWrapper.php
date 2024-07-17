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

    public function beforeSave(BillingLineService $Class, array &$data, bool $isNew, string|null &$messages, array|false &$extValidationErr, $error)
    {
        $data['Total'] = bcmul($data['Quantity'], $data['Amount']);
    }

    public function afterSave(BillingLine $Class, array &$data, bool $isNew, string|null &$messages, array|false &$extValidationErr, $error)
    {
        $this->setBillingTotal($data['IdBilling']);
        $this->setProjectSpent($Class);
    }

    public function afterDelete(BillingLine $Class, &$request, &$error, &$messages){
        $this->setBillingTotal($Class->getBilling()->getIdBilling());
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
                $tax = $this->getTax($total);
                $Billing->setTax($tax);
                $Billing->setGross($total);
                $Billing->save();
            }
        }
    }

    private function getTax($total)
    {
        if(defined('billing_tax_1')){
            $tax = bcdiv(bcmul($total, billing_tax_1), 100);

            if(defined('billing_tax_2')){
                $tax += bcdiv(bcmul(bcsub($total, $tax), billing_tax_2), 100);
            }
        }

        return $tax;
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
