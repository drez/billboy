<?php

namespace App;


/**
 *  @version 1.1
 *  Generated Form class on the 'CostLine' table.
 *  
 */
use Psr\Http\Message\ServerRequestInterface as Request;
use ApiGoat\Utility\FormHelper as Helper;

class CostLineForm extends CostLine
{

    use Helper;
    use \ApiGoat\ACL\AuthyACL;

    /**
    *   Virtual name of the object (class)
    */
    public $request = null;
    public $args = null;
    public $model_name = '';
    public $isChild;
    public $IdPk;
    public $queryObj;
    public $in;
    public $TableName;
    public $tableDescription;
    public $uiTabsId;
    public $maxPerPage;
    public $childMaxPerPage;
    public $VirtualClassName;
    public $virtualClassName;
    public $listActionCell = '';

    public $setReadOnly;
    public $forceInlineEdit;
    public $forcePopUpEdit;
    public $arrayData;
    
    public $searchAr;
    public $searchMs;
    public $searchOrder;

    public $hookFormTop;
    public $hookFormInnerTop;
    public $hookFormBottom;
    public $hookFormInnerBottom;

    public $hookFormReadyJsFirst;
    public $hookFormReadyJs;
    public $hookFormIncludeJs;

    public $hookFormRoTop;
    public $hookFormRoBottom;

    public $hookChildListRoTop;
    public $hookChildListRoBottom;

    public $hookListTop;
    public $hookListBottom;
    public $hookListColumns;
    public $hookListSearchTop;
    public $hookListSearchButton;
    public $hookListReadyJs;
    public $hookListReadyJsFirst;
    public $setListRemoveDelete;
    public $hookSwHeader;
    public $printLink;
    public $formTitle;
    public $ccStdFormOptions;
    public $cCMainTableHeader;
    
    public $canDelete;

    
    
    /**
    *   Ressource object for the database
    *   @type object
    **/
    public $pmpoData;
    
    /**
     * Constructor
     *
     * @param Request|array|null $request
     * @param array $args
     */
    function __construct(Request|array|null $request, array $args)
    {
        $this->request = $request;
        $this->args = $args;
        $this->model_name = 'CostLine';
        $this->virtualClassName = 'CostLine';
        $this->childMaxPerPage = (defined('app_child_max_per_page')) ? app_child_max_per_page : 30;
        $this->maxPerPage = (defined('app_max_per_page')) ? app_max_per_page : 50;
        $this->hookFormBottom = '';
        $this->hookFormReadyJs = '';
        
    }	

    /**
     * function getListSearch
     * @param integer $IdParent
     * @param array $search
     * @return type
     */
    public function getListSearch($IdParent='', $search='')
    {
        $this->in = 'getListSearch';

        $q = new CostLineQuery();
        $q = $this->setAclFilter($q);
        

        if(is_array( $this->searchMs )){
            # main search form
            $q::create()
                ;
                
                
        }else{
            if(json_decode($IdParent)){
                        $q = new CostLineQuery();
                        $pmpoData = $q::create()
                            ->filterBy(json_decode($IdParent))
                            
                            

                            ->paginate($page, $maxPerPage);
                    }
            ## standard list
            $hasParent = json_decode($IdParent);
            if(empty($hasParent)) {
                $q::create()
                ;
                
            }
        }
        
        
            if(!empty($this->searchOrder)){
                $f=0;
                foreach($this->searchOrder as $order){
                    foreach($order as $col => $sens){
                        if($sens){
                            $tOrd = explode('.',$col);
                            if($tOrd[1]){
                                $q->join($tOrd[0]." order".$f);
                                $orderBy = "use".$tOrd[0]."Query";
                                $q->$orderBy("order".$f, 'left join')->orderBy($tOrd[1], $sens)->endUse();
                            }else{
                                $q->orderBy($col,$sens);
                            }
                            $this->orderReadyJsOrder .="
                                $(\"#CostLineListForm [th='sorted'][c='".$col."']\").attr('sens', '".strtolower($sens)."')
                                    .attr('order', 'on').addClass('sorted');
                            ";
                        }
                        $f++;
                    }
                }
            }
            
        
        
        
        $this->pmpoData =  $q;
        
        
        return $this->pmpoData;
    }

    /**
     * function getListHeader
     * @param string $act
     * @return string
     */
    public function getListHeader($act)
    {
        $this->in = 'getListHeader';
        
        switch($act) {
            case 'head':
                $trHead = th(_("Title"), " th='sorted' c='Title' title='" . _('Title')."' ")
.th(_("Date"), " th='sorted' c='SpendDate' title='" . _('Date')."' ")
.th(_("Note"), " th='sorted' c='NoteBillingLigne' title='" . _('Note')."' ")
.th(_("Quantity"), " th='sorted' c='Quantity' title='" . _('Quantity')."' ")
.th(_("Amount"), " th='sorted' c='Amount' title='" . _('Amount')."' ")
.th(_("Total"), " th='sorted' c='Total' title='" . _('Total')."' ")
. $this->cCmoreColsHeader;
                if(!$this->setReadOnly){
                    $trHead .= th('&nbsp;',' class="actionrow delete" ');
                }
                $trHead = thead(tr($trHead));
                return $trHead;

            case 'list-button':
                $listButton = '';
                
                
                return $listButton;

            case 'search':
                
                
                ;
                return $trSearch;

            case 'add':
            ###### ADD
                if($_SESSION[_AUTH_VAR]->hasRights('CostLine', 'a') && !$this->setReadOnly){
                
                                $this->listAddButton = htmlLink(
                                    _("Add new")
                                ,_SITE_URL.$this->virtualClassName."/edit/", "id='addCostLine' title='"._('Add')."' class='button-link-blue add-button'");
            }

            return $this->listAddButton;
            break;
            case 'quickadd': 
                return $trHeadMod;
        }
    }

    /**
     * produce a list of table items
     * @param	string $uiTabsId	html destination container Id
     * @param	string $page		nbr. of line per pages
     * param	string $IdParent	Parent id (if necessary)
     * param	obj $pmpoDataIn	PropelModelPager reference to show instead of default search OR a standard propel collection
     * @param	array $search		search params for custom search query
     * 						[ms]	pre set with progXform/search_items behavior
     *					custom search
     *						[f]	filter	[v]	value	use by progXform/child_menu_query
     *						[u]	use		[f]	filter	[uv] use filter value
     * @return string
     */
    public function getList( $request, $uiTabsId = 'tabsContain', $IdParent = null , $pmpoDataIn = null)
    {
        $this->in = 'getList';
        $this->isChild = '';
        $this->TableName = 'CostLine';
        $altValue = array (
  'IdCostLine' => '',
  'IdBilling' => '',
  'CalcId' => '',
  'Title' => '',
  'SpendDate' => '',
  'NoteBillingLigne' => '',
  'Quantity' => '',
  'Amount' => '',
  'Total' => '',
  'DateCreation' => '',
  'DateModification' => '',
  'IdGroupCreation' => '',
  'IdCreation' => '',
  'IdModification' => '',
);
        $tr = '';
        $hook = [];
        $editEvent = '';
        $return = ['html', 'js', 'onReadyJs'];

        

        $this->uiTabsId = $uiTabsId;
        
        
        $this->IdParent = $IdParent;

        // if Search params
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'CostLine/');

        // order
        $this->searchOrder = $this->setOrderVar($request['order'] ?? '', 'CostLine/');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'CostLine/');

        
        
        
        
        
        

        $maxPerPage = $this->maxPerPage;

        if(empty($pmpoDataIn)) {
            $pmpoData = $this->getListSearch($IdParent, $search);
            $pmpoData = $pmpoData->paginate($search['page'], $maxPerPage);
            $resultsCount = $pmpoData->getNbResults();

        }else{
            $pmpoData = $pmpoDataIn;
        }

        $trHead = $this->getListHeader('head');

        if( $pmpoData->isEmpty() ) {
            $tr .= tr(	td(p(span(_("Nothing here at the moment")),'class="no-results"'), "t='empty' colspan='100%' "));

        }else{
            if( get_class($pmpoData) == 'PropelModelPager' ) {
                $pcData = $pmpoData->getResults();
            }else{
                $pcData = $pmpoData;
            }

            $this->arrayData = $pcData->toArray();
            
            /**
            *	Main list loop
            **/
            $i=0;
            
            if(!$this->setReadOnly && !$this->setListRemoveDelete){
                if($_SESSION[_AUTH_VAR]->hasRights('CostLine', 'd')){
                    $this->canDelete = true;
                }
            }
        
            foreach($pcData as $data) {
                $this->listActionCell = '';
                
                
                
                    

                $actionCell =  td(
        htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteCostLine' ") . $this->listActionCell, " class='actionrow' ");

                $tr .= tr(
                td(span(\htmlentities((($altValue['Title']) ? $altValue['Title'] : $data->getTitle()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Title' class=''  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['SpendDate']) ? $altValue['SpendDate'] : $data->getSpendDate()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='SpendDate' class=''  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['NoteBillingLigne']) ? $altValue['NoteBillingLigne'] : substr(strip_tags($data->getNoteBillingLigne()), 0, 100)) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='NoteBillingLigne' class=''  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['Quantity']) ? $altValue['Quantity'] : str_replace(',', '.', $data->getQuantity())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Quantity' class='right'  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['Amount']) ? $altValue['Amount'] : str_replace(',', '.', $data->getAmount())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Amount' class='right'  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['Total']) ? $altValue['Total'] : str_replace(',', '.', $data->getTotal())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Total' class='right'  j='editCostLine'") . $cCmoreCols.$actionCell
                , " 
                        rid='".json_encode($data->getPrimaryKey())."' data-iterator='".$pcData->getPosition()."'
                        r='data'
                        class='".$hook['class']." '
                        id='CostLineRow".$data->getPrimaryKey()."'")
                ;
                $i++;
            }
            $tr .= input('hidden', 'rowCountCostLine', $i);
        }

        

        ## @Paging
        $pagerRow = $this->getPager($pmpoData, $resultsCount, $search);
        $bottomRow = div($pagerRow,'bottomPagerRow', "class='tablesorter'");

        

        $controlsContent = $this->getListHeader('list-button');
        
        $return['html'] =
            $this->hookListTop
            .div(
                href(span(_('Open/close menu')),'javascript:','class="toggle-menu button-link-blue trigger-menu"')
                .$this->getListHeader('add')
                
                .div($controlsContent,'CostLineControlsList', "class='custom-controls'")
                .$this->hookSwHeader.$HelpDiv
            ,'','class="sw-header"')

            .$this->getListHeader('search')
            /*.div(
                $this->getListHeader('add')
                .button('', 'class="scroll-top" type="button"')
            , '' ,'class="ac-list-form-header ac-show-scroll"')*/
            .div(
                input('hidden', 'rowCount', $i, "s='d'")
                .input('hidden', 'ip', $IdParent, "s='d'")
                 .div(
                     div(
                        table($trHead.$tr, "id='CostLineTable' class='tablesorter' style='width:100%;'")
                     ,'',' class="content" ')
                ,'listForm',' class="ac-list" ')
                .$this->hookListBottom
                .$bottomRow
            , 'CostLineListForm');

          #no parent

    $editUi = (empty($IdParent)) ? 'tabsContain' : 'editDialog';

    $editEvent .= "$(\"#CostLineListForm td[j='editCostLine']\").bindEdit({
                    modelName:'" . $this->virtualClassName . "',
                    destUi: '{$editUi}'
                });
                
    $(\"#CostLineListForm [j='deleteCostLine']\").bindDelete({
        modelName:'" . $this->virtualClassName . "',
        ui:'".$uiTabsId."',
        title: '".addslashes($this->tableDescription)."',
        message: '".addslashes(message_label('delete_row_confirm_msg'))."'
    });";
        
        $editEvent .= "
        $('#CostLinePager').bindPaging({
            tableName:'CostLine'
            ,uiTabsId:'".$uiTabsId."'
            ,ajaxPageActParent:'".$this->virtualClassName."'
        });
";

        if(!isMobile()) {
            $jqueryDatePicker = "
                $(\"#formMsCostLine [j='date']\").attr('type', 'input');
                $(\"#formMsCostLine [j='date']\").each(function(){
                    $(this).datepicker({dateFormat: 'yy-mm-dd ',changeYear: true, changeMonth: true, yearRange: '1940:2040', showOtherMonths: true, selectOtherMonths: true});
                });
            ";
        }

        $return['onReadyJs'] = 
            $HelpDivJs
            
            ."
        
        
        
        $('#tabsContain .js-select-label').SelectBox();
        ".$this->hookListReadyJsFirst.$editEvent."
       $(\"#{$uiTabsId} [th='sorted']\").bindSorting({
            modelName:'".$this->virtualClassName."',
            destUi:'".$uiTabsId."'
        });
            
        if($('#addCostLineAutoc').length > 0) {
            $('#addCostLineAutoc').bind('click', function () {
                $.post('"._SITE_URL."GuiManager', {a:'ixmemautoc', p:'{$this->virtualClassName}',}, function(data) {
                    document.location = '"._SITE_URL.$this->virtualClassName."/edit/';
                });
            });
        }
        
        
        ".$jqueryDatePicker."
        ".$this->orderReadyJsOrder."
        ".$this->hookListReadyJs;
        $return['js'] .= " ";
        return $return;
    }
    /*
    *	Make sure default value are set before save
    */
    public function setCreateDefaultsCostLine($data)
    {

        unset($data['IdCostLine']);
        $e = new CostLine();
        
        
        $e->fromArray($data );
        
        #
        
        $e->setSpendDate( ($data['SpendDate'] == '' || $data['SpendDate'] == 'null' || substr($data['SpendDate'],0,10) == '-0001-11-30') ? null : $data['SpendDate'] );
        //integer not required
        $e->setNoteBillingLigne( ($data['NoteBillingLigne'] == '' ) ? null : $data['NoteBillingLigne']);
        //integer not required
        $e->setQuantity( ($data['Quantity'] == '' ) ? null : $data['Quantity']);
        //integer not required
        $e->setAmount( ($data['Amount'] == '' ) ? null : $data['Amount']);
        //integer not required
        $e->setTotal( ($data['Total'] == '' ) ? null : $data['Total']);
        $e->setDateCreation( ($data['DateCreation'] == '' || $data['DateCreation'] == 'null' || substr($data['DateCreation'],0,10) == '-0001-11-30') ? null : $data['DateCreation'] );
        $e->setDateModification( ($data['DateModification'] == '' || $data['DateModification'] == 'null' || substr($data['DateModification'],0,10) == '-0001-11-30') ? null : $data['DateModification'] );
        //foreign
        $e->setIdGroupCreation(( $data['IdGroupCreation'] == '' ) ? null : $data['IdGroupCreation']);
        //foreign
        $e->setIdCreation(( $data['IdCreation'] == '' ) ? null : $data['IdCreation']);
        //foreign
        $e->setIdModification(( $data['IdModification'] == '' ) ? null : $data['IdModification']);
        #
        
        return $e;
    }
    
    /*
    *	Make sure default value are set before save
    */
    public function setUpdateDefaultsCostLine($data)
    {

        
        $e = CostLineQuery::create()->findPk(json_decode($data['i']));
        
        
        $e->fromArray($data );
        
        
        
        if(isset($data['SpendDate'])){
            $e->setSpendDate( ($data['SpendDate'] == '' || $data['SpendDate'] == 'null' || substr($data['SpendDate'],0,10) == '-0001-11-30') ? null : $data['SpendDate'] );
        }
        if(isset($data['Quantity'])){
            $e->setQuantity( ($data['Quantity'] == '' ) ? null : $data['Quantity']);
        }
        if(isset($data['Amount'])){
            $e->setAmount( ($data['Amount'] == '' ) ? null : $data['Amount']);
        }
        if(isset($data['Total'])){
            $e->setTotal( ($data['Total'] == '' ) ? null : $data['Total']);
        }
        if(isset($data['DateCreation'])){
            $e->setDateCreation( ($data['DateCreation'] == '' || $data['DateCreation'] == 'null' || substr($data['DateCreation'],0,10) == '-0001-11-30') ? null : $data['DateCreation'] );
        }
        if(isset($data['DateModification'])){
            $e->setDateModification( ($data['DateModification'] == '' || $data['DateModification'] == 'null' || substr($data['DateModification'],0,10) == '-0001-11-30') ? null : $data['DateModification'] );
        }
        if( isset($data['IdGroupCreation']) ){
            $e->setIdGroupCreation(( $data['IdGroupCreation'] == '' ) ? null : $data['IdGroupCreation']);
        }
        if( isset($data['IdCreation']) ){
            $e->setIdCreation(( $data['IdCreation'] == '' ) ? null : $data['IdCreation']);
        }
        if( isset($data['IdModification']) ){
            $e->setIdModification(( $data['IdModification'] == '' ) ? null : $data['IdModification']);
        }
        $e->setNew(false);
        return $e;
    }
    /**
     * Produce a formated form of CostLine
     * @param	string $id			PrimaryKey of the record to show
     * @param	string $uiTabsId	Present everywhere, javascript id of the html container
     * @param	string $data 		If present, will skip the query and show the data
     * @param	array $error			Error to display
     * @param	array $jsElement		container to append new event results
     * @param	array $jsElementType	container type to append new event results
     * @return	array standard html retrun array
    */

    public function getEditForm($id, $uiTabsId = 'tabsContain', $data=[], $error=[], $jsElement='', $jsElementType='')
    {
        $this->in = "getEditForm";

        $ip_save = '';
        $ip_save = '';
        $IdParent = 0;
        $editDialog = ( $data['dialog'] ) ? $data['dialog'] : 'editDialog';
        $uiTabsId = ( $uiTabsId === null ) ? 'tabsContain' : $uiTabsId;
        $jet = 'tr';
        
        $je = "CostLineTable";
        
        if($jsElement)	{
            $je = $jsElement; 
        }
        
        if($jsElementType)	{
            $jet = $jsElementType;
        }

        if($data['data']['ip']){
            $data['ip'] = $data['data']['ip'];
            $data['pc'] = $data['data']['pc'];
            $data['tp'] = $data['data']['tp'];
        }
        
        if($data['pc']) {
            switch($data['pc']){
                
                case 'Billing':
                    $data['IdBilling'] = $data['ip'];
                    break;
                case 'AuthyGroup':
                    $data['IdGroupCreation'] = $data['ip'];
                    break;
                case 'Authy':
                    $data['IdModification'] = $data['ip'];
                    break;
            }
            $IdParent = $data['ip'];
        }
        
        if($error == ''){
            unset($error);
        }

        
        
        // save button and action
        $this->SaveButtonJs = "";
        if(($_SESSION[_AUTH_VAR]->hasRights('CostLine', 'a') and !$id ) || ( $_SESSION[_AUTH_VAR]->hasRights('CostLine', 'w') and $id) || $this->setReadOnly) {
            $this->SaveButtonJs = "
            $('#form" . $this->virtualClassName . " #save" . $this->virtualClassName . "').bindSave({
                modelName: '" . $this->virtualClassName . "',
                destUi: '" . $uiTabsId . "',
                pc:'" . $data['pc'] . "',
                ip:'" . $IdParent . "',
                je:'" . $jsElement . "',
                jet:'" . $jsElementType . "',
                tp:'" . $data['tp'] . "',
                dialog:'" . $editDialog . "'
            });
        ";
        }else{
            $this->SaveButtonJs = "
                $('#formCostLine #saveCostLine').unbind('click.saveCostLine');
                $('#formCostLine #saveCostLine').remove();";
        }

        if($_SESSION[_AUTH_VAR]->hasRights('CostLine', 'a') && !$this->setReadOnly) {
            $this->formAddButton = htmlLink(_("Add new"), 'Javascript:;' , "id='addCostLine' title='"._('Add')."' class='button-link-blue add-button'");
            $this->bindEditJs = "$('.sw-header #add" . $this->virtualClassName . "').bindEdit({
                modelName: '" . $this->virtualClassName . "',
                destUi: '" . $uiTabsId . "',
                pc:'" . $data['pc'] . "',
                ip:'" . $IdParent . "',
                je:'" . $jsElement . "',
                jet:'" . $jsElementType . "'
            });";
        }
        
        if($id && !$data['reload']) {
            

            $q = CostLineQuery::create()
            
            ;
            


            $dataObj = $q->filterByIdCostLine($id)->findOne();
            
        }
        
        if($dataObj == null){
            $this->CostLine['isNew'] = 'yes';
        }
    
        
        
        if($dataObj == null){
            $dataObj = new CostLine();
            $this->CostLine['isNew'] = 'yes';
            if(is_array($data ))
               $dataObj->fromArray(array_filter($data));
            
        }else{
                $this->CostLine['isNew'] = 'no';
        }
        $this->dataObj = $dataObj;
            
        



        
        
        
        
        
        
        
$this->fields['CostLine']['Title']['html'] = stdFieldRow(_("Title"), input('text', 'Title', htmlentities($dataObj->getTitle()), "   placeholder='".str_replace("'","&#39;",_('Title'))."' size='35'  v='TITLE' s='d' class=''  ")."", 'Title', "", $this->commentsTitle, $this->commentsTitle_css, '', ' ', 'no');
$this->fields['CostLine']['SpendDate']['html'] = stdFieldRow(_("Date"), input('date', 'SpendDate', $dataObj->getSpendDate(), "  j='date' autocomplete='off' placeholder='YYYY-MM-DD' size='10'  s='d' class=''"), 'SpendDate', "", $this->commentsSpendDate, $this->commentsSpendDate_css, '', ' ', 'no');
$this->fields['CostLine']['NoteBillingLigne']['html'] = stdFieldRow(_("Note"), textarea('NoteBillingLigne', htmlentities($dataObj->getNoteBillingLigne()) ,"placeholder='".str_replace("'","&#39;",_('Note'))."' cols='71' v='NOTE_BILLING_LIGNE' s='d'  class=' ' style='' spellcheck='false'"), 'NoteBillingLigne', "", $this->commentsNoteBillingLigne, $this->commentsNoteBillingLigne_css, '', ' ', 'no');
$this->fields['CostLine']['Quantity']['html'] = stdFieldRow(_("Quantity"), input('text', 'Quantity', $dataObj->getQuantity(), "  placeholder='".str_replace("'","&#39;",_('Quantity'))."'  v='QUANTITY' size='5' s='d' class=''"), 'Quantity', "", $this->commentsQuantity, $this->commentsQuantity_css, '', ' ', 'no');
$this->fields['CostLine']['Amount']['html'] = stdFieldRow(_("Amount"), input('text', 'Amount', $dataObj->getAmount(), "  placeholder='".str_replace("'","&#39;",_('Amount'))."'  v='AMOUNT' size='5' s='d' class='req'"), 'Amount', "", $this->commentsAmount, $this->commentsAmount_css, '', ' ', 'no');
$this->fields['CostLine']['Total']['html'] = stdFieldRow(_("Total"), input('text', 'Total', $dataObj->getTotal(), "  placeholder='".str_replace("'","&#39;",_('Total'))."'  v='TOTAL' size='5' s='d' class=''"), 'Total', "", $this->commentsTotal, $this->commentsTotal_css, '', ' ', 'no');


        $this->lockFormField(array(0=>'Total',), $dataObj);

        // Whole form read only
        if($this->setReadOnly == 'all' ) { 
            $this->lockFormField('all', $dataObj); 
        }

        
        
        
        if(!$this->setReadOnly){
            $this->formSaveBar = div(	div( input('button', 'saveCostLine', _('Save'),' class="button-link-blue can-save"')
                                .input('hidden', 'formChangedCostLine','', 'j="formChanged"')
                                .input('hidden', 'idPk', urlencode($id), "s='d'")
                            .input('hidden', 'IdCostLine', $dataObj->getIdCostLine(), " s='d' pk").input('hidden', 'IdBilling', $dataObj->getIdBilling(), " s='d' nodesc").input('hidden', 'IdGroupCreation', $dataObj->getIdGroupCreation(), " s='d' nodesc").input('hidden', 'IdCreation', $dataObj->getIdCreation(), " s='d' nodesc").input('hidden', 'IdModification', $dataObj->getIdModification(), " s='d' nodesc")
                            .$this->hookListSearchButton
                        ,"", " class='divtd' colspan='2' style='text-align:right;'"),""," class='divtr divbut' ");
        }
        $this->afterFormObj($data, $dataObj);
        

        //Form header
        $header_top = div(
                            div(href(span(_('Display/Hide menu')),'javascript:','class="toggle-menu button-link-blue trigger-menu"')
                        .$this->formAddButton,'','class="default-controls"')
                        .$this->printLink
                            .$this->hookSwHeader.$HelpDiv
                        , '', 'class="sw-header"');
        $header_top_onglet = $this->formTitle.$ongletf;

        if(!isMobile()) {
            $jqueryDatePicker = " $(\"#formCostLine [j='date']\").attr('type', 'text');
            $(\"#formCostLine [j='date']\").each(function(){
                $(this).datepicker({dateFormat: 'yy-mm-dd ',changeYear: true, changeMonth: true, yearRange: '1940:2040', showOtherMonths: true, selectOtherMonths: true});
            });";
        }

        // Form
        $return['html'] =
        $this->hookFormTop
        .$mceInclude
        .$header_top
        .form(
            
            div(
                div('Cost entry', '', "class='panel-heading'").
                $header_top_onglet.
                
                $this->hookFormInnerTop
                
                .
$this->fields['CostLine']['Title']['html']
.$this->fields['CostLine']['SpendDate']['html']
.$this->fields['CostLine']['NoteBillingLigne']['html']
.$this->fields['CostLine']['Quantity']['html']
.$this->fields['CostLine']['Amount']['html']
.$this->fields['CostLine']['Total']['html']
                
                .$this->formSaveBar
                .$this->hookFormInnerBottom
            ,"divCntCostLine", "class='divStdform' CntTabs=1 ".$this->ccStdFormOptions)
        , "id='formCostLine' class='mainForm formContent' ")
        .$this->hookFormBottom;


        
        
        if($id and $_SESSION['mem']['CostLine']['ogf']) {
            $tabs_act = "$('[href=\"".$_SESSION['mem']['CostLine']['ogf']."\"]').click();";
        }

        if($_SESSION['mem']['CostLine']['ixmemautocapp'] and $_GET['Autocapp'] == 1) {
            $Autocapp = $_SESSION['mem']['CostLine']['ixmemautocapp'];
            unset($_SESSION['mem']['CostLine']['ixmemautocapp']);
        }

        $return['data'] .= $data;
        $return['js'] .= $childTable['js']
        . $this->hookFormIncludeJs."
        ";
            
        $return['onReadyJs'] = 
        $this->hookFormReadyJsFirst.
        "
        
        ".$jqueryDatePicker."
        $('#ui-datepicker-div').css('font-size', '12px');
        ".$this->bindEditJs."
        ".$this->SaveButtonJs."
        
        ".$childTable['onReadyJs']."
        ".$error['onReadyJs']."
        if($('#form" . $this->virtualClassName . "').inDialog()){
            $('.ui-dialog .sw-header').remove();
        }
        if($('#loader').css('display') == 'block') {
            $('#loader').hide();
        }
        ".$tabs_act."
        ".$this->hookFormReadyJs
        .$script_autoc_one
        .$HelpDivJs."
        
        setTimeout(function() {
            $(\"#formCostLine [s='d'], #formCostLine .js-select-label, #formCostLine [j='autocomplete']\")
                .bindFormKeypress({modelName: '" . $this->virtualClassName . "'});
            $('#formCostLine .js-select-label').SelectBox();
        }, 400);
        ";
        return $return;
    }

    function lockFormField($fields, $dataObj)	
    {
        
        $this->fieldsRo['CostLine']['Title']['html'] = stdFieldRow(_("Title"), div( $dataObj->getTitle(), 'Title_label' , "class='readonly' s='d'")
                .input('hidden', 'Title', $dataObj->getTitle(), "s='d'"), 'Title', "", $this->commentsTitle, $this->commentsTitle_css, 'readonly', ' ', 'no');

        $this->fieldsRo['CostLine']['SpendDate']['html'] = stdFieldRow(_("Date"), div( $dataObj->getSpendDate(), 'SpendDate_label' , "class='readonly' s='d'")
                .input('hidden', 'SpendDate', $dataObj->getSpendDate(), "s='d'"), 'SpendDate', "", $this->commentsSpendDate, $this->commentsSpendDate_css, 'readonly', ' ', 'no');

        $this->fieldsRo['CostLine']['NoteBillingLigne']['html'] = stdFieldRow(_("Note"), div( $dataObj->getNoteBillingLigne(), 'NoteBillingLigne_label' , "class='readonly' s='d'")
                .input('hidden', 'NoteBillingLigne', $dataObj->getNoteBillingLigne(), "s='d'"), 'NoteBillingLigne', "", $this->commentsNoteBillingLigne, $this->commentsNoteBillingLigne_css, 'readonly', ' ', 'no');

        $this->fieldsRo['CostLine']['Quantity']['html'] = stdFieldRow(_("Quantity"), div( $dataObj->getQuantity(), 'Quantity_label' , "class='readonly' s='d'")
                .input('hidden', 'Quantity', $dataObj->getQuantity(), "s='d'"), 'Quantity', "", $this->commentsQuantity, $this->commentsQuantity_css, 'readonly', ' ', 'no');

        $this->fieldsRo['CostLine']['Amount']['html'] = stdFieldRow(_("Amount"), div( $dataObj->getAmount(), 'Amount_label' , "class='readonly' s='d'")
                .input('hidden', 'Amount', $dataObj->getAmount(), "s='d'"), 'Amount', "", $this->commentsAmount, $this->commentsAmount_css, 'readonly', ' ', 'no');

        $this->fieldsRo['CostLine']['Total']['html'] = stdFieldRow(_("Total"), div( $dataObj->getTotal(), 'Total_label' , "class='readonly' s='d'")
                .input('hidden', 'Total', $dataObj->getTotal(), "s='d'"), 'Total', "", $this->commentsTotal, $this->commentsTotal_css, 'readonly', ' ', 'no');


        if($fields == 'all') {
            foreach($this->fields['CostLine'] as $field => $ar) {
                $this->fields['CostLine'][$field]['html'] = $this->fieldsRo['CostLine'][$field]['html'];
            }
        } elseif(is_array($fields)) {
            foreach($fields as $field) {
                $this->fields['CostLine'][$field]['html'] = $this->fieldsRo['CostLine'][$field]['html'];
            }
        }
    }
}
