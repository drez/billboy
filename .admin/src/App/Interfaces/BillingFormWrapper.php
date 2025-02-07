<?php
namespace App;

/**
 * Skeleton subclass for representing a services for the BillingForm entity.
 *
 * User
 *
 * You should add additional methods/hooks to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.GoatCheese.
 */
class BillingFormWrapper extends BillingForm
{
    public function __construct($request, $args)
    {
        parent::__construct($request, $args);
    }

    /**
     * Hook form after the data getter
     * @param array $data
     * @param Billing $dataObj
     * @return void
     **/

    public function afterFormObj(array $data, Billing &$dataObj)
    {
        if ($dataObj->isNew()) {
            $this->hookFormReadyJs = "
        $('#IdClient').on('change', (e)=>{
            $.post('" . _SITE_URL . "Billing/getClientDefault', {IdClient:$('#IdClient').val()}, (data)=>{
                if(data?.json){
                    $('#formBilling #DefaultCurrency').val(data.json?.DefaultCurrency);
                    $('#formBilling #IdBillingCategory').val(data.json?.DefaultCategory);
                }
            }, 'json');
        });
            ";
        }

        if (is_null($dataObj->getDate())) {
            $this->hookFormReadyJs .= "
        $('#formBilling #Date').val('" . date('Y-m-d') . "');
            ";
        }

        $this->hookFormReadyJs .= "
            $('.sw-header .default-controls').append( $('<a>').html('Print').addClass('button-link-blue header-controls').attr('href', 'Javascript:;').attr('id', 'billPrint') );
            $('#billPrint').click(()=>{
                window.open('" . _SITE_URL . "Billing/print/'+$('#formBilling #idPk').val(), 'BillingPrint');
            });
            $('.sw-header .default-controls').append( $('<a>').html('Pdf').addClass('button-link-blue header-controls').attr('href', 'Javascript:;').attr('id', 'billPdf') );
            $('#billPdf').click(()=>{
                window.open('" . _SITE_URL . "Billing/pdf/'+$('#formBilling #idPk').val(), '_blank')
            });
        ";
    }

    public function beforeListTr(&$altValue, $data, $i, &$hook, $cCmoreCols)
    {
        if ($data->getState() == "New") {
            $altValue['State'] = span($data->getState(), "style='color:#bfc400;'");
        }

        if ($data->getState() == "Sent") {
            $altValue['State'] = span($data->getState(), "style='color:#00c462;'");
        }

        if ($data->getState() == "Approved") {
            $altValue['State'] = span($data->getState(), "style='color:#00c411;'");
        }

        if ($data->getState() == "Partial payment") {
            $altValue['State'] = span($data->getState(), "style='color:#c49600;'");
        }

        $hook['td'] = td(
            htmlLink("<i class='ri-file-copy-2-line'></i>", "Javascript:", "class='ac-delete-link' i='" . $data->getPrimaryKey() . "' j='copyBilling' "));
    }
    public function beforeList(&$request, &$pmpoData)
    {

        if (empty(array_filter($this->searchMs))) {
            $this->searchMs['State'] = ['New', 'Sent', 'Approved', 'Partial payment'];
            $this->searchMs['Type']  = 'Bill';
        }
        $this->hookListReadyJs = "
            $('[j=copyBilling]').click((e)=>{
                $.post('" . _SITE_URL . $this->virtualClassName . "/copy/'+$(e.currentTarget).attr('i'), {ui:'list'}, (data)=>{
                    $('body').append(data);
                });
            });
        ";
    }

}
