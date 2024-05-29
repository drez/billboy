<?php

namespace App;


/**
 * Skeleton subclass for representing a services for the PaymentLineService entity.
 *
 * User
 *
 * You should add additional methods/hooks to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.GoatCheese.
 */
class PaymentLineServiceWrapper extends PaymentLineService
{
    public function __construct($request, $response, $args)
    {
        parent::__construct($request, $response, $args);

        $this->Form = new PaymentLineFormWrapper($request, $args);
    }

    public function afterSave(PaymentLine $Class, array &$data, bool $isNew, string|null &$messages, array|false &$extValidationErr, $error)
    {
        $this->setBillingPayment($data['IdBilling']);
    }

    private function setBillingPayment($IdBilling){
        $total = 0;
        $PaymentLine = PaymentLineQuery::Create()->findByIdBilling($IdBilling);

        if ($PaymentLine) {
            foreach ($PaymentLine as $line) {
                $total += $line->getAmount();
            }

            $Billing = BillingQuery::Create()->findOneByIdBilling($IdBilling);
            if ($Billing) {
                $Billing->setNet($total);
                $Billing->save();
            }
        }
    }

}
