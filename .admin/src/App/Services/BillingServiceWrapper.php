<?php
namespace App;

use ApiGoat\Handlers\BuilderReturn;
use Dompdf\Dompdf;

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
        $this->customActions['print']            = 'print';
        $this->customActions['pdf']              = 'print';
        $this->customActions['copy']             = 'copy';
        $this->customActions['getClientDefault'] = 'getClientDefault';

        $this->Form = new BillingFormWrapper($request, $args);
    }

    public function getClientDefault($request)
    {
        $Client = ClientQuery::create()->findPk($request['data']['IdClient']);

        return ['json' => [
            'DefaultCurrency' => $Client->getDefaultCurrency(),
            'DefaultCategory' => $Client->getDefaultCategory(),
            'DefaultUser'     => $Client->getDefaultUser(),
            'DefaultRate'     => $Client->getDefaultRate(),
        ],
        ];
    }

    public function copy($request)
    {
        $Billing     = BillingQuery::create()->findPk($request['i']);
        $BillingCopy = $Billing->copy(true);
        $BillingCopy->setState('New');
        $BillingCopy->setTitle('Copy - ' . $Billing->getTitle());
        $BillingCopy->setDate(date('Y-m-d'));
        $BillingCopy->save();

        $this->request['action'] = "list";
        $BuilderReturn           = new BuilderReturn($this->request);
        $BuilderReturn->setReturnFunction('update_return');
        return $BuilderReturn->return();
    }

    public function print($request)
    {
        $q = TemplateQuery::create()->filterByName('Print Billing Header')->orderBy('DateCreation', 'DESC');
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
@media print {
    size: letter;
}

.head1 {color:" . $Template->getColor1() . "; }
.head1 td {border-color:" . $Template->getColor1() . "; }
body {background: white;}
tr td{
    vertical-align: top;
}
#items table {
    border-collapse: separate;
    border-spacing: 0 1em;
    span b{
        text-transform: capitalize;
    }
}

#items .note {

}

            ");
            }

            $Billing = BillingQuery::create()
                ->leftJoin('Client')
                ->leftJoin('Currency')
                ->findPk($request['i']);

            $clientContent = div(
                div(
                    table(
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
                    )
                    , '', "style='padding:20px;'")
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
                            td(span(b($BillingItem->getTitle()))
                                . span($BillingItem->getNoteBillingLigne(), "class='note'"))
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
                    . td("Date", "style='min-width:110px;'")
                    . td("Qty.", "style='text-align:right;'")
                    . td("Unit price	", "style='text-align:right;'")
                    . td("Total", "style='text-align:right;'")
                    ,
                    "class='head1 col-2' "
                );
                $colspan = 2;
            }

            if ($Billing->getGross2()) {
                $currencyTotal = tr(
                    td("&nbsp;", "colspan='$colspan'")
                    . td("Total $" . $Billing->getCurrency()->getName(), "colspan='2'")
                    . td($Billing->getGross2()), "class='totalRow2'");
            }

            $itemsContent = div(
                table(
                    $headRow
                    . $items
                    . tr(
                        td("&nbsp;", "colspan='$colspan'")
                        . td("<sup>1,2,3</sup> Total \$USD", "colspan='2'")
                        . td($total)
                        , "class='totalRow'")
                    . $currencyTotal
                )

                , "items");

            $disclaimer = div(
                ul(
                    li("All quotes are valid for a period of 1 month.")
                    . li("All amounts are in <b>US dollars</b> unless otherwise stated.")
                    . li("Payment is due within 30 days. Service may be suspended if the account becomes delinquent after this period.")
                    . li("Any additional work requested that is not included in the original brief will be quoted separately and added to the final invoice.")
                    . li("Recurring payments for hosting or other services will be billed annually on December 31.")

                )
                , 'disclaimer', "class='disclaimer'");
            $BillingLineForm       = new BillingLineForm(null, $request);
            $arrayIdAssignOptions  = $BillingLineForm->selectBoxBillingLine_IdAssign();
            $arrayIdProjectOptions = $BillingLineForm->selectBoxBillingLine_IdProject($null, BillingLineQuery::create()->filterByBilling($Billing)->findOne());
            $arrayIdHeaderOptions  = array_map(fn($a) => array_values($a), TemplateQuery::create()->select(['Subject', 'IdTemplate'])->filterByName('Print Billing Header')->find()->toArray());

            $filters     = "";
            $scriptReady = "";
            if ($request['query']['aa'] != 'filter') {
                $scriptReady = "
                    $('.js-select-label').SelectBox();
                    $('#filterForm #postFilter').click(()=>{
                        $.get('" . _SITE_URL . "Billing/print/" . $request['i'] . "', $('#filterForm').serialize(), (data)=>{
                            $('#main').html(data);
                        });
                    });

                    $('#filterForm #printPdf').click(()=>{
                        $.get('', $('#filterForm').serialize(), (data)=>{
                            window.open('" . _SITE_URL . "Billing/pdf/" . $request['i'] . "', '_blank')
                        });
                    });


                    $('#filtersHead').click(()=>{
                        console.log('hide');
                        $('#filters').hide()
                    });
                    ";

                $filters = div(
                    div("Filters", "filtersHead", "class='panel-heading'")
                    . div(
                        form(
                            stdFieldRow(_("Assigned to"), selectboxCustomArray('IdAssign', $arrayIdAssignOptions, _('Assigned to'), "", $request['query']['IdAssign']), 'IdAssign', "", '', '', '', ' ', 'no')
                            . stdFieldRow(_("Project"), selectboxCustomArray('IdProject', $arrayIdProjectOptions, _('Project'), "", $request['query']['IdProject']), 'IdProject', "", '', '', '', ' ', 'no')
                            . stdFieldRow(_("Header"), selectboxCustomArray('IdTemplate', $arrayIdHeaderOptions, _('Header'), "", $request['query']['IdTemplate']), 'IdTemplate', "", '', '', '', ' ', 'no')
                            . div(
                                div(input('button', 'postFilter', _('Filter'), ' class="button-link-blue can-save"')
                                    . input('button', 'printPdf', _('Pdf'), ' class="button-link-blue can-save" style="margin-left:20px;"')

                                    . input('hidden', 'idPk', $request['i'], "s='d'")
                                    . input('hidden', 'aa', 'filter', "s='d'")
                                    , "", " class='divtd' colspan='2' style='text-align:right;'"), "", " class='divtr divbut' ")
                            , "id='filterForm'")

                        , '', "class='divStdform ui-tabs ui-widget ui-widget-content ui-corner-all '")
                    , "filters", "class='mainForm' ");
            }

            if ($request['action'] == 'pdf') {
                $cssStyle = file_get_contents(_BASE_DIR . "public/css/main.css");
                $cssStyle .= file_get_contents(_BASE_DIR . "public/css/print.css");
                $cssStyle .= file_get_contents(_BASE_DIR . "public/css/apigoat.css");
                $css = style($cssStyle);
            } else {
                $css = loadcss(_SITE_URL . 'public/css/main.css')
                . loadcss(_SITE_URL . 'public/css/apigoat.css')
                . loadCss(_SITE_URL . "public/css/print.css");
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
                "class='print' style='height:100%'"
            );

            $this->request['ui'] = 'blank';

            if ($request['query']['aa'] == 'filter') {
                return $content;
            }

            if ($request['action'] == 'pdf') {
                $filters = "";
            }

            $out = docType()
            . htmlTag(
                htmlHeader($Billing->getType() . " " . bcadd($Billing->getPrimaryKey(), 333) . " " . $Billing?->getClient()?->getName(), $css)
                . body(
                    loadjs(_SITE_URL . 'vendor/components/jquery/jquery.min.js')
                    . loadjs(_SITE_URL . 'public/js/selectbox.js')
                    . scriptReady($scriptReady)

                    . $filters
                    . $content, "style='height:100%'")
            );
        } else {
            $out = "Missing 'print_billing_header' template";
        }

        if ($request['action'] == 'pdf') {
            /*global $_dompdf_warnings;
            $_dompdf_warnings = [];
            global $_dompdf_show_warnings;
            $_dompdf_show_warnings = true;*/

            sendPdf($out, $Billing->getType() . " " . bcadd($Billing->getPrimaryKey(), 333) . " " . $Billing?->getClient()?->getName() . ".pdf");

            $out = script("window.close();");
            /* $out =
            "Error"
            . print_r($_dompdf_warnings, true)
                . $out;*/

        }

        return $out;

    }

}

function sendPdf($html, $name)
{
    $dom = new \DOMDocument();
    $dom->loadHTML($html);
    $images = $dom->getElementsByTagName('img');
    foreach ($images as $image) {
        $src    = $image->getAttribute('src');
        $type   = pathinfo($src, PATHINFO_EXTENSION);
        $stream = stream_context_create([
            'ssl'  => [
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ],
            'http' => [
                'timeout' => 2,
            ],
        ]);

        $data   = file_get_contents($src, 0, $stream);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $image->setAttribute("src", $base64);
    }
    $html = $dom->saveHTML();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');

// Render the HTML as PDF
    $dompdf->render();

// Output the generated PDF to Browser
    $dompdf->stream($name);

}
