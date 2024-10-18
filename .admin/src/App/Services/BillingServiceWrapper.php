<?php

namespace App;

use ApiGoat\Handlers\BuilderReturn;

/**
 * Skeleton subclass for representing a services for the BillingService entity.
 *
 * User
 *
 * You should add additional methods/hooks to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.GoatCheese.
 */
class BillingServiceWrapper extends BillingService
{
    public function __construct($request, $response, $args)
    {
        parent::__construct($request, $response, $args);
        $this->customActions['print'] = 'print';
        $this->customActions['copy'] = 'copy';

        $this->Form = new BillingFormWrapper($request, $args);
    }

    public function copy($request)
    {
        $Billing = BillingQuery::create()->findPk($request['i']);
        $BillingCopy = $Billing->copy(true);
        $BillingCopy->setState('New');
        $BillingCopy->setDate(date('Y-m-d'));
        $BillingCopy->save();

        $this->request['action'] = "list";
        $BuilderReturn = new BuilderReturn($this->request);
        $BuilderReturn->setReturnFunction('update_return');
        return $BuilderReturn->return();
    }

    public function print($request)
    {
        $q = TemplateQuery::create()->filterBySubject('print_billing_header')->orderBy('DateCreation', 'DESC');
        if ($request['query']['IdTemplate']) {
            $q->filterByIdTemplate($request['query']['IdTemplate']);
        }

        $Template = $q->findOne();

        if ($Template) {
            $headerContent = $Template->getBody();

            $header = div(
                $headerContent
                ,
                "header",
                "class='header'"
            );

            if ($Template->getColor1()) {
                $colors = style("
                .head1 {color:" . $Template->getColor1() . "; }
                .head1 td {border-color:" . $Template->getColor1() . "; }
            ");
            }

            $Billing = BillingQuery::create()
                ->leftJoin('Client')
                ->findPk($request['i']);

            $clientContent = div(
                div(table(
                    tr(
                        td("Client", "style='width:30%;'")
                        . td($Billing?->getClient()?->getName())
                        , "class=''")
                    . tr(
                        td("Address", "style='width:30%;'")
                        . td($Billing?->getClient()?->getAddress1()
                            . (($Billing?->getClient()?->getAddress2()) ? "<br>" : "" . $Billing?->getClient()?->getAddress2())
                            . (($Billing?->getClient()?->getAddress3()) ? "<br>" : "" . $Billing?->getClient()?->getAddress3())
                        )
                        , "class=''")
                    . tr(
                        td("Phone", "style='width:30%;'")
                        . td($Billing?->getClient()?->getPhone())
                        , "class=''")
                ), '', "style='padding:20px;'")
                , 'client', "class='no-break client'");

            if ($Billing->getNoteBilling()) {
                $billingNote = table(tr(
                    td("Note")
                    ,
                    "class='head1 col-2' "
                )) . div(
                    $Billing->getNoteBilling()
                    , 'details', "class='billingDetails'");
            }

            $q = BillingLineQuery::create()->filterByIdBilling($request['i']);

            if ($request['query']['IdAssign']) {
                $q->filterByIdAssign($request['query']['IdAssign']);
            }

            if ($request['query']['IdProject']) {
                $q->filterByIdProject($request['query']['IdProject']);
            }

            $BillingItems = $q->find();

            if ($BillingItems) {
                $total = 0;
                if ($Billing->getType() == 'Quote') {
                    foreach ($BillingItems as $BillingItem) {
                        $items .= tr(
                            td($BillingItem->getTitle())
                            . td($BillingItem->getQuantity(), "style='text-align:right;'")
                            . td($BillingItem->getAmount(), "style='text-align:right;'")
                            . td($BillingItem->getTotal(), "style='text-align:right;'")
                            , "class='item'")
                        . tr(
                            td($BillingItem->getNoteBillingLigne(), "colspan='4' class='itemDescription'")
                        );

                        $total = bcadd($total, $BillingItem->getTotal(), 2);
                    }
                } else {
                    foreach ($BillingItems as $BillingItem) {
                        $items .= tr(
                            td($BillingItem->getNoteBillingLigne())
                            . td($BillingItem->getWorkDate())
                            . td($BillingItem->getQuantity(), "style='text-align:right;'")
                            . td($BillingItem->getAmount(), "style='text-align:right;'")
                            . td($BillingItem->getTotal(), "style='text-align:right;'")
                            , "class=''");

                        $total = bcadd($total, $BillingItem->getTotal(), 2);
                    }
                }
            }

            if ($Billing->getType() == 'Quote') {
                $headRow = tr(
                    td("Description")
                    . td("Qty.", "style='text-align:right;'")
                    . td("Unit price	", "style='text-align:right;'")
                    . td("Total<sup>1,2</sup>", "style='text-align:right;'")
                    ,
                    "class='head1 col-2' "
                );
                $colspan = 2;
            } else {
                $headRow = tr(
                    td("Description")
                    . td("Date", "style='min-width:90px;'")
                    . td("Qty.", "style='text-align:right;'")
                    . td("Unit price	", "style='text-align:right;'")
                    . td("Total", "style='text-align:right;'")
                    ,
                    "class='head1 col-2' "
                );
                $colspan = 3;
            }

            $itemsContent = div(
                table(
                    $headRow
                    . $items
                    . tr(td("&nbsp;", "colspan='$colspan'") . td("Total <sup>1,2,3</sup>") . td($total), "class='totalRow'")
                )
                , "items");

            $disclaimer = div(
                ul(
                    li("All quotes are valid for a period of 1 month.")
                    . li("Payment is due within 30 days. Service may be suspended if the account becomes delinquent after this period.")
                    . li("All amounts are in US dollars unless otherwise stated.")
                    . li("Any additional work requested that is not included in the original brief will be quoted separately and added to the final invoice.")
                    . li("Recurring payments for hosting or other services will be billed annually on December 31.")

                )
                , 'disclaimer', "class='disclaimer'");
            $BillingLineForm = new BillingLineForm(null, $request);
            $arrayIdAssignOptions = $BillingLineForm->selectBoxBillingLine_IdAssign();
            $arrayIdProjectOptions = $BillingLineForm->selectBoxBillingLine_IdProject($null, BillingLineQuery::create()->filterByBilling($Billing)->findOne());
            $arrayIdHeaderOptions = array_map(fn($a) => array_values($a), TemplateQuery::create()->select(['Name', 'IdTemplate'])->filterBySubject('print_billing_header')->find()->toArray());

            $filters = "";
            $scriptReady = "";
            if ($request['query']['aa'] != 'filter') {
                $scriptReady = "
                    $('.js-select-label').SelectBox();
                    $('#filterForm #postFilter').click(()=>{
                        $.get('" . _SITE_URL . "Billing/print/" . $request['i'] . "', $('#filterForm').serialize(), (data)=>{
                            $('#main').html(data);
                        });
                    });
                    ";

                $filters = div(
                    div("Filters", "", "class='panel-heading'")
                    . div(
                        form(
                            stdFieldRow(_("Assigned to"), selectboxCustomArray('IdAssign', $arrayIdAssignOptions, _('Assigned to'), "", $request['query']['IdAssign']), 'IdAssign', "", '', '', '', ' ', 'no')
                            . stdFieldRow(_("Project"), selectboxCustomArray('IdProject', $arrayIdProjectOptions, _('Project'), "", $request['query']['IdProject']), 'IdProject', "", '', '', '', ' ', 'no')
                            . stdFieldRow(_("Header"), selectboxCustomArray('IdTemplate', $arrayIdHeaderOptions, _('Header'), "", $request['query']['IdTemplate']), 'IdTemplate', "", '', '', '', ' ', 'no')
                            . div(div(input('button', 'postFilter', _('Filter'), ' class="button-link-blue can-save"')
                                . input('hidden', 'idPk', $request['i'], "s='d'")
                                . input('hidden', 'aa', 'filter', "s='d'")
                                , "", " class='divtd' colspan='2' style='text-align:right;'"), "", " class='divtr divbut' ")
                            , "id='filterForm'")

                        , '', "class='divStdform ui-tabs ui-widget ui-widget-content ui-corner-all '")
                    , "", "class='mainForm'");
            }

            $content =
            $colors
            . div(
                $header
                . table(
                    tr(
                        td($Billing->getType() . " # " . bcadd($Billing->getPrimaryKey(), 333))
                        . td("" . $Billing->getDate(), " style='text-align:right;'")
                        , "class='head1 col-2'")
                )
                . $clientContent
                . $billingNote
                . $itemsContent
                . $disclaimer
                ,
                "main",
                "class='print'"
            );

            $this->request['ui'] = 'blank';

            if ($request['query']['aa'] == 'filter') {
                return $content;
            }

            return docType()
            . htmlTag(
                htmlHeader($Billing->getType() . " " . bcadd($Billing->getPrimaryKey(), 333), loadCss(_SITE_URL . "public/css/print.css"))
                . body(
                    loadjs(_SITE_URL . 'vendor/components/jquery/jquery.min.js')
                    . loadjs(_SITE_URL . 'public/js/selectbox.js')
                    . loadcss(_SITE_URL . 'public/css/main.css')
                    . loadcss(_SITE_URL . 'public/css/apigoat.css')
                    . scriptReady($scriptReady) .
                    $filters
                    . $content)
            );
        } else {
            return "Missing 'print_billing_header' template";
        }

    }

}
