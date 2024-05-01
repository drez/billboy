<?php

namespace App;


/**
 *  @version 1.1
 *  Generated Form class on the 'Expense' table.
 *  
 */
use Psr\Http\Message\ServerRequestInterface as Request;
use ApiGoat\Html\Tabs;
use ApiGoat\Utility\FormHelper as Helper;

class ExpenseForm extends Expense
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
        $this->model_name = 'Expense';
        $this->virtualClassName = 'Expense';
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

        $q = new ExpenseQuery();
        $q = $this->setAclFilter($q);
        

        if(is_array( $this->searchMs )){
            # main search form
            $q::create()
                
                #default
                ->leftJoinWith('BillingCategory')
                #alias default
                ->leftJoinWith('ProjectRelatedByIdClient a7')
                #alias default
                ->leftJoinWith('ProjectRelatedByIdProject a9')
                #alias default
                ->leftJoinWith('AuthyRelatedByIdAssign a11')
                #default
                ->leftJoinWith('Supplier');
                
                
        }else{
            
            ## standard list
            $hasParent = json_decode($IdParent);
            if(empty($hasParent)) {
                $q::create()
                
                #default
                ->leftJoinWith('BillingCategory')
                #alias default
                ->leftJoinWith('ProjectRelatedByIdClient a7')
                #alias default
                ->leftJoinWith('ProjectRelatedByIdProject a9')
                #alias default
                ->leftJoinWith('AuthyRelatedByIdAssign a11')
                #default
                ->leftJoinWith('Supplier');
                
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
                                $(\"#ExpenseListForm [th='sorted'][c='".$col."']\").attr('sens', '".strtolower($sens)."')
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
                $trHead = th(_("Date"), " th='sorted' c='Date' title='" . _('Date')."' ")
.th(_("Quantity"), " th='sorted' c='Quantity' title='" . _('Quantity')."' ")
.th(_("Amount"), " th='sorted' c='Amount' title='" . _('Amount')."' ")
.th(_("Total"), " th='sorted' c='Total' title='" . _('Total')."' ")
.th(_("Title"), " th='sorted' c='Title' title='" . _('Title')."' ")
.th(_("Category"), " th='sorted' c='BillingCategory.Name' title='"._('BillingCategory.Name')."' ")
.th(_("Note"), " th='sorted' c='NoteExpenseLigne' title='" . _('Note')."' ")
.th(_("Client"), " th='sorted' c='ProjectRelatedByIdClient.Name' title='"._('ProjectRelatedByIdClient.Name')."' ")
.th(_("Project"), " th='sorted' c='ProjectRelatedByIdProject.Name' title='"._('ProjectRelatedByIdProject.Name')."' ")
.th(_("User fullname"), " th='sorted' c='AuthyRelatedByIdAssign.Fullname' title='"._('AuthyRelatedByIdAssign.Fullname')."' ")
.th(_("Supplier"), " th='sorted' c='Supplier.Name' title='"._('Supplier.Name')."' ")
.th(_("Invoice no."), " th='sorted' c='InvoiceNo' title='" . _('Invoice no.')."' ")
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
                
        $this->arrayIdBillingCategoryOptions = $this->selectBoxExpense_IdBillingCategory($this, $emptyVar, $data);
        $this->arrayIdClientOptions = $this->selectBoxExpense_IdClient($this, $emptyVar, $data);
        $this->arrayIdProjectOptions = $this->selectBoxExpense_IdProject($this, $emptyVar, $data);
        $this->arrayIdAssignOptions = $this->selectBoxExpense_IdAssign($this, $emptyVar, $data);
        $this->arrayIdSupplierOptions = $this->selectBoxExpense_IdSupplier($this, $emptyVar, $data);
                
                ;
                return $trSearch;

            case 'add':
            ###### ADD
                if($_SESSION[_AUTH_VAR]->hasRights('Expense', 'a') && !$this->setReadOnly){
                
                                $this->listAddButton = htmlLink(
                                    _("Add new")
                                ,_SITE_URL.$this->virtualClassName."/edit/", "id='addExpense' title='"._('Add')."' class='button-link-blue add-button'");
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
        $this->TableName = 'Expense';
        $altValue = array (
  'IdExpense' => '',
  'Date' => '',
  'Quantity' => '',
  'Amount' => '',
  'Total' => '',
  'Title' => '',
  'IdBillingCategory' => '',
  'NoteExpenseLigne' => '',
  'IdClient' => '',
  'IdProject' => '',
  'IdAssign' => '',
  'IdSupplier' => '',
  'InvoiceNo' => '',
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
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Expense/');

        // order
        $this->searchOrder = $this->setOrderVar($request['order'] ?? '', 'Expense/');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Expense/');

        
        
        $default_order[]['Date']='DESC';
        if(empty($this->searchOrder)){
            $this->searchOrder = $default_order;
        }
        
        
        
        

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
                if($_SESSION[_AUTH_VAR]->hasRights('Expense', 'd')){
                    $this->canDelete = true;
                }
            }
        
            foreach($pcData as $data) {
                $this->listActionCell = '';
                
                
                
                                    $BillingCategory_Name = "";
                                    if($data->getBillingCategory()){
                                        $BillingCategory_Name = $data->getBillingCategory()->getName();
                                    }
                                    $ProjectRelatedByIdClient_Name = "";
                                    if($data->getProjectRelatedByIdClient()){
                                        $ProjectRelatedByIdClient_Name = $data->getProjectRelatedByIdClient()->getName();
                                    }
                                    $ProjectRelatedByIdProject_Name = "";
                                    if($data->getProjectRelatedByIdProject()){
                                        $ProjectRelatedByIdProject_Name = $data->getProjectRelatedByIdProject()->getName();
                                    }
        $altValue['AuthyRelatedByIdAssign_Fullname'] = "";
        if($data->getAuthyRelatedByIdAssign()){
            $altValue['AuthyRelatedByIdAssign_Fullname'] = $data->getAuthyRelatedByIdAssign()->getFullname();
        }
                                    $Supplier_Name = "";
                                    if($data->getSupplier()){
                                        $Supplier_Name = $data->getSupplier()->getName();
                                    }
                    

                $actionCell =  td(
        htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteExpense' ") . $this->listActionCell, " class='actionrow' ");

                $tr .= tr(
                td(span(\htmlentities((($altValue['Date']) ? $altValue['Date'] : $data->getDate()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Date' class=''  j='editExpense'") . 
                td(span(\htmlentities((($altValue['Quantity']) ? $altValue['Quantity'] : str_replace(',', '.', $data->getQuantity())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Quantity' class='right'  j='editExpense'") . 
                td(span(\htmlentities((($altValue['Amount']) ? $altValue['Amount'] : str_replace(',', '.', $data->getAmount())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Amount' class='right'  j='editExpense'") . 
                td(span(\htmlentities((($altValue['Total']) ? $altValue['Total'] : str_replace(',', '.', $data->getTotal())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Total' class='right'  j='editExpense'") . 
                td(span(\htmlentities((($altValue['Title']) ? $altValue['Title'] : $data->getTitle()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Title' class=''  j='editExpense'") . 
                td(span(\htmlentities((($altValue['IdBillingCategory']) ? $altValue['IdBillingCategory'] : $BillingCategory_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdBillingCategory' class=''  j='editExpense'") . 
                td(span(\htmlentities((($altValue['NoteExpenseLigne']) ? $altValue['NoteExpenseLigne'] : substr(strip_tags($data->getNoteExpenseLigne()), 0, 100)) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='NoteExpenseLigne' class=''  j='editExpense'") . 
                td(span(\htmlentities((($altValue['IdClient']) ? $altValue['IdClient'] : $ProjectRelatedByIdClient_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdClient' class=''  j='editExpense'") . 
                td(span(\htmlentities((($altValue['IdProject']) ? $altValue['IdProject'] : $ProjectRelatedByIdProject_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdProject' class=''  j='editExpense'") . 
                td(span(\htmlentities((($altValue['IdAssign']) ? $altValue['IdAssign'] : $altValue['AuthyRelatedByIdAssign_Fullname']) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdAssign' class=''  j='editExpense'") . 
                td(span(\htmlentities((($altValue['IdSupplier']) ? $altValue['IdSupplier'] : $Supplier_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdSupplier' class=''  j='editExpense'") . 
                td(span(\htmlentities((($altValue['InvoiceNo']) ? $altValue['InvoiceNo'] : $data->getInvoiceNo()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='InvoiceNo' class=''  j='editExpense'") . $cCmoreCols.$actionCell
                , " 
                        rid='".json_encode($data->getPrimaryKey())."' data-iterator='".$pcData->getPosition()."'
                        r='data'
                        class='".$hook['class']." '
                        id='ExpenseRow".$data->getPrimaryKey()."'")
                ;
                $i++;
            }
            $tr .= input('hidden', 'rowCountExpense', $i);
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
                
                .div($controlsContent,'ExpenseControlsList', "class='custom-controls'")
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
                        table($trHead.$tr, "id='ExpenseTable' class='tablesorter' style='width:100%;'")
                     ,'',' class="content" ')
                ,'listForm',' class="ac-list" ')
                .$this->hookListBottom
                .$bottomRow
            , 'ExpenseListForm');

          #no parent

    $editUi = (empty($IdParent)) ? 'tabsContain' : 'editDialog';

    $editEvent .= "$(\"#ExpenseListForm td[j='editExpense']\").bindEdit({
                    modelName:'" . $this->virtualClassName . "',
                    destUi: '{$editUi}'
                });
                
    $(\"#ExpenseListForm [j='deleteExpense']\").bindDelete({
        modelName:'" . $this->virtualClassName . "',
        ui:'".$uiTabsId."',
        title: '".addslashes($this->tableDescription)."',
        message: '".addslashes(message_label('delete_row_confirm_msg'))."'
    });";
        
        $editEvent .= "
        $('#ExpensePager').bindPaging({
            tableName:'Expense'
            ,uiTabsId:'".$uiTabsId."'
            ,ajaxPageActParent:'".$this->virtualClassName."'
        });
";

        if(!isMobile()) {
            $jqueryDatePicker = "
                $(\"#formMsExpense [j='date']\").attr('type', 'input');
                $(\"#formMsExpense [j='date']\").each(function(){
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
            
        if($('#addExpenseAutoc').length > 0) {
            $('#addExpenseAutoc').bind('click', function () {
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
    public function setCreateDefaultsExpense($data)
    {

        unset($data['IdExpense']);
        $e = new Expense();
        
        
        $e->fromArray($data );
        
        #
        
        $e->setDate( ($data['Date'] == '' || $data['Date'] == 'null' || substr($data['Date'],0,10) == '-0001-11-30') ? null : $data['Date'] );
        //integer not required
        $e->setQuantity( ($data['Quantity'] == '' ) ? null : $data['Quantity']);
        //integer not required
        $e->setAmount( ($data['Amount'] == '' ) ? null : $data['Amount']);
        //integer not required
        $e->setTotal( ($data['Total'] == '' ) ? null : $data['Total']);
        //foreign
        $e->setIdBillingCategory(( $data['IdBillingCategory'] == '' ) ? null : $data['IdBillingCategory']);
        //integer not required
        $e->setNoteExpenseLigne( ($data['NoteExpenseLigne'] == '' ) ? null : $data['NoteExpenseLigne']);
        //foreign
        $e->setIdClient(( $data['IdClient'] == '' ) ? null : $data['IdClient']);
        //foreign
        $e->setIdProject(( $data['IdProject'] == '' ) ? null : $data['IdProject']);
        //foreign
        $e->setIdAssign(( $data['IdAssign'] == '' ) ? null : $data['IdAssign']);
        //foreign
        $e->setIdSupplier(( $data['IdSupplier'] == '' ) ? null : $data['IdSupplier']);
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
    public function setUpdateDefaultsExpense($data)
    {

        
        $e = ExpenseQuery::create()->findPk(json_decode($data['i']));
        
        
        $e->fromArray($data );
        
        
        
        if(isset($data['Date'])){
            $e->setDate( ($data['Date'] == '' || $data['Date'] == 'null' || substr($data['Date'],0,10) == '-0001-11-30') ? null : $data['Date'] );
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
        if( isset($data['IdBillingCategory']) ){
            $e->setIdBillingCategory(( $data['IdBillingCategory'] == '' ) ? null : $data['IdBillingCategory']);
        }
        if( isset($data['IdClient']) ){
            $e->setIdClient(( $data['IdClient'] == '' ) ? null : $data['IdClient']);
        }
        if( isset($data['IdProject']) ){
            $e->setIdProject(( $data['IdProject'] == '' ) ? null : $data['IdProject']);
        }
        if( isset($data['IdAssign']) ){
            $e->setIdAssign(( $data['IdAssign'] == '' ) ? null : $data['IdAssign']);
        }
        if( isset($data['IdSupplier']) ){
            $e->setIdSupplier(( $data['IdSupplier'] == '' ) ? null : $data['IdSupplier']);
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
     * Produce a formated form of Expense
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
        
        $je = "ExpenseTable";
        
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
                
                case 'BillingCategory':
                    $data['IdBillingCategory'] = $data['ip'];
                    break;
                case 'Project':
                    $data['IdProject'] = $data['ip'];
                    break;
                case 'Authy':
                    $data['IdModification'] = $data['ip'];
                    break;
                case 'Supplier':
                    $data['IdSupplier'] = $data['ip'];
                    break;
                case 'AuthyGroup':
                    $data['IdGroupCreation'] = $data['ip'];
                    break;
            }
            $IdParent = $data['ip'];
        }
        
        if($error == ''){
            unset($error);
        }

        
        
        // save button and action
        $this->SaveButtonJs = "";
        if(($_SESSION[_AUTH_VAR]->hasRights('Expense', 'a') and !$id ) || ( $_SESSION[_AUTH_VAR]->hasRights('Expense', 'w') and $id) || $this->setReadOnly) {
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
                $('#formExpense #saveExpense').unbind('click.saveExpense');
                $('#formExpense #saveExpense').remove();";
        }

        if($_SESSION[_AUTH_VAR]->hasRights('Expense', 'a') && !$this->setReadOnly) {
            $this->formAddButton = htmlLink(_("Add new"), 'Javascript:;' , "id='addExpense' title='"._('Add')."' class='button-link-blue add-button'");
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
            

            $q = ExpenseQuery::create()
            
                #default
                ->leftJoinWith('BillingCategory')
                #alias default
                ->leftJoinWith('ProjectRelatedByIdClient a7')
                #alias default
                ->leftJoinWith('ProjectRelatedByIdProject a9')
                #alias default
                ->leftJoinWith('AuthyRelatedByIdAssign a11')
                #default
                ->leftJoinWith('Supplier')
            ;
            


            $dataObj = $q->filterByIdExpense($id)->findOne();
            
        }
        
        if($dataObj == null){
            $this->Expense['isNew'] = 'yes';
        }
    
        
        
        if($dataObj == null){
            $dataObj = new Expense();
            $this->Expense['isNew'] = 'yes';
            if(is_array($data ))
               $dataObj->fromArray(array_filter($data));
            
        }else{
                $this->Expense['isNew'] = 'no';
        }
        $this->dataObj = $dataObj;
            
        


                                    ($dataObj->getBillingCategory())?'':$dataObj->setBillingCategory( new BillingCategory() );
                                    ($dataObj->getProjectRelatedByIdClient())?'':$dataObj->setProjectRelatedByIdClient( new Project() );
                                    ($dataObj->getProjectRelatedByIdProject())?'':$dataObj->setProjectRelatedByIdProject( new Project() );
                                    ($dataObj->getAuthyRelatedByIdAssign())?'':$dataObj->setAuthyRelatedByIdAssign( new Authy() );
                                    ($dataObj->getSupplier())?'':$dataObj->setSupplier( new Supplier() );

        
        $this->arrayIdBillingCategoryOptions = $this->selectBoxExpense_IdBillingCategory($this, $dataObj, $data);
        $this->arrayIdClientOptions = $this->selectBoxExpense_IdClient($this, $dataObj, $data);
        $this->arrayIdProjectOptions = $this->selectBoxExpense_IdProject($this, $dataObj, $data);
        $this->arrayIdAssignOptions = $this->selectBoxExpense_IdAssign($this, $dataObj, $data);
        $this->arrayIdSupplierOptions = $this->selectBoxExpense_IdSupplier($this, $dataObj, $data);
        
        
        
        
        
        
$this->fields['Expense']['Date']['html'] = stdFieldRow(_("Date"), input('date', 'Date', $dataObj->getDate(), "  j='date' autocomplete='off' placeholder='YYYY-MM-DD' size='10'  s='d' class=''"), 'Date', "", $this->commentsDate, $this->commentsDate_css, '', ' ', 'no');
$this->fields['Expense']['Quantity']['html'] = stdFieldRow(_("Quantity"), input('text', 'Quantity', $dataObj->getQuantity(), "  placeholder='".str_replace("'","&#39;",_('Quantity'))."'  v='QUANTITY' size='5' s='d' class=''"), 'Quantity', "", $this->commentsQuantity, $this->commentsQuantity_css, '', ' ', 'no');
$this->fields['Expense']['Amount']['html'] = stdFieldRow(_("Amount"), input('text', 'Amount', $dataObj->getAmount(), "  placeholder='".str_replace("'","&#39;",_('Amount'))."'  v='AMOUNT' size='5' s='d' class='req'"), 'Amount', "", $this->commentsAmount, $this->commentsAmount_css, '', ' ', 'no');
$this->fields['Expense']['Total']['html'] = stdFieldRow(_("Total"), input('text', 'Total', $dataObj->getTotal(), "  placeholder='".str_replace("'","&#39;",_('Total'))."'  v='TOTAL' size='5' s='d' class=''"), 'Total', "", $this->commentsTotal, $this->commentsTotal_css, '', ' ', 'no');
$this->fields['Expense']['Title']['html'] = stdFieldRow(_("Title"), input('text', 'Title', htmlentities($dataObj->getTitle()), "   placeholder='".str_replace("'","&#39;",_('Title'))."' size='35'  v='TITLE' s='d' class=''  ")."", 'Title', "", $this->commentsTitle, $this->commentsTitle_css, '', ' ', 'no');
$this->fields['Expense']['IdBillingCategory']['html'] = stdFieldRow(_("Category"), selectboxCustomArray('IdBillingCategory', $this->arrayIdBillingCategoryOptions, _('Category'), "v='ID_BILLING_CATEGORY'  s='d'  val='".$dataObj->getIdBillingCategory()."'", $dataObj->getIdBillingCategory()), 'IdBillingCategory', "", $this->commentsIdBillingCategory, $this->commentsIdBillingCategory_css, '', ' ', 'no');
$this->fields['Expense']['NoteExpenseLigne']['html'] = stdFieldRow(_("Note"), textarea('NoteExpenseLigne', htmlentities($dataObj->getNoteExpenseLigne()) ,"placeholder='".str_replace("'","&#39;",_('Note'))."' cols='71' v='NOTE_EXPENSE_LIGNE' s='d'  class=' tinymce ' style='' spellcheck='false'"), 'NoteExpenseLigne', "", $this->commentsNoteExpenseLigne, $this->commentsNoteExpenseLigne_css, 'istinymce', ' ', 'no');
$this->fields['Expense']['IdClient']['html'] = stdFieldRow(_("Client"), selectboxCustomArray('IdClient', $this->arrayIdClientOptions, _('Client'), "v='ID_CLIENT'  s='d'  val='".$dataObj->getIdClient()."'", $dataObj->getIdClient()), 'IdClient', "", $this->commentsIdClient, $this->commentsIdClient_css, '', ' ', 'no');
$this->fields['Expense']['IdProject']['html'] = stdFieldRow(_("Project"), selectboxCustomArray('IdProject', $this->arrayIdProjectOptions, _('Project'), "v='ID_PROJECT'  s='d'  val='".$dataObj->getIdProject()."'", $dataObj->getIdProject()), 'IdProject', "", $this->commentsIdProject, $this->commentsIdProject_css, '', ' ', 'no');
$this->fields['Expense']['IdAssign']['html'] = stdFieldRow(_("Responsable"), selectboxCustomArray('IdAssign', $this->arrayIdAssignOptions, _('Responsable'), "v='ID_ASSIGN'  s='d'  val='".$dataObj->getIdAssign()."'", $dataObj->getIdAssign()), 'IdAssign', "", $this->commentsIdAssign, $this->commentsIdAssign_css, '', ' ', 'no');
$this->fields['Expense']['IdSupplier']['html'] = stdFieldRow(_("Supplier"), selectboxCustomArray('IdSupplier', $this->arrayIdSupplierOptions, _('Supplier'), "v='ID_SUPPLIER'  s='d'  val='".$dataObj->getIdSupplier()."'", $dataObj->getIdSupplier()), 'IdSupplier', "", $this->commentsIdSupplier, $this->commentsIdSupplier_css, '', ' ', 'no');
$this->fields['Expense']['InvoiceNo']['html'] = stdFieldRow(_("Invoice no."), input('text', 'InvoiceNo', htmlentities($dataObj->getInvoiceNo()), "   placeholder='".str_replace("'","&#39;",_('Invoice no.'))."' size='35'  v='INVOICE_NO' s='d' class=''  ")."", 'InvoiceNo', "", $this->commentsInvoiceNo, $this->commentsInvoiceNo_css, '', ' ', 'no');


        $this->lockFormField(array(0=>'Total',), $dataObj);

        // Whole form read only
        if($this->setReadOnly == 'all' ) { 
            $this->lockFormField('all', $dataObj); 
        }

        
        $ongletf =
            div(
                ul(li(htmlLink(_('Expense'),'#ogf_Expense',' j="ogf" p="Expense" class="ui-tabs-anchor" '))
                    .li(htmlLink(_('Note'),'#ogf_note_expense_ligne',' j="ogf" class="ui-tabs-anchor" p="Expense" '))
                    .li(htmlLink(_('Client'),'#ogf_id_assign',' j="ogf" class="ui-tabs-anchor" p="Expense" '))
                    .li(htmlLink(_('Description'),'#ogf_title',' j="ogf" class="ui-tabs-anchor" p="Expense" ')))
            ,'cntOngletExpense',' class="cntOnglet"')
        ;
        
        if(!$this->setReadOnly){
            $this->formSaveBar = div(	div( input('button', 'saveExpense', _('Save'),' class="button-link-blue can-save"')
                                .input('hidden', 'formChangedExpense','', 'j="formChanged"')
                                .input('hidden', 'idPk', urlencode($id), "s='d'")
                            .input('hidden', 'IdExpense', $dataObj->getIdExpense(), " s='d' pk").input('hidden', 'IdGroupCreation', $dataObj->getIdGroupCreation(), " s='d' nodesc").input('hidden', 'IdCreation', $dataObj->getIdCreation(), " s='d' nodesc").input('hidden', 'IdModification', $dataObj->getIdModification(), " s='d' nodesc")
                            .$this->hookListSearchButton
                        ,"", " class='divtd' colspan='2' style='text-align:right;'"),""," class='divtr divbut' ");
        }
        
        

        //Form header
        $header_top = div(
                            div(href(span(_('Display/Hide menu')),'javascript:','class="toggle-menu button-link-blue trigger-menu"')
                        .$this->formAddButton,'','class="default-controls"')
                        .$this->printLink
                            .$this->hookSwHeader.$HelpDiv
                        , '', 'class="sw-header"');
        $header_top_onglet = $this->formTitle.$ongletf;

        if(!isMobile()) {
            $jqueryDatePicker = " $(\"#formExpense [j='date']\").attr('type', 'text');
            $(\"#formExpense [j='date']\").each(function(){
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
                div('Expense', '', "class='panel-heading'").
                $header_top_onglet.
                
                $this->hookFormInnerTop
                
                .
                    '<div id="ogf_Expense">'.
$this->fields['Expense']['Date']['html']
.$this->fields['Expense']['Quantity']['html']
.$this->fields['Expense']['Amount']['html']
.$this->fields['Expense']['Total']['html']
.'</div><div id="ogf_title"  class=" ui-tabs-panel">'
.$this->fields['Expense']['Title']['html']
.$this->fields['Expense']['IdBillingCategory']['html']
.'</div><div id="ogf_note_expense_ligne"  class=" ui-tabs-panel">'
.$this->fields['Expense']['NoteExpenseLigne']['html']
.$this->fields['Expense']['IdClient']['html']
.$this->fields['Expense']['IdProject']['html']
.'</div><div id="ogf_id_assign"  class=" ui-tabs-panel">'
.$this->fields['Expense']['IdAssign']['html']
.$this->fields['Expense']['IdSupplier']['html']
.$this->fields['Expense']['InvoiceNo']['html'].'</div>'
                
                .$this->formSaveBar
                .$this->hookFormInnerBottom
            ,"divCntExpense", "class='divStdform' CntTabs=1 ".$this->ccStdFormOptions)
        , "id='formExpense' class='mainForm formContent' ")
        .$this->hookFormBottom;


        
        
        if($id and $_SESSION['mem']['Expense']['ogf']) {
            $tabs_act = "$('[href=\"".$_SESSION['mem']['Expense']['ogf']."\"]').click();";
        }

        if($_SESSION['mem']['Expense']['ixmemautocapp'] and $_GET['Autocapp'] == 1) {
            $Autocapp = $_SESSION['mem']['Expense']['ixmemautocapp'];
            unset($_SESSION['mem']['Expense']['ixmemautocapp']);
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

    setTimeout(function (){
        $('#formExpense .tinymce').each(function() {
           $(this).ckeditor();
        });
    }, 200);
            $('.cntOnglet').parent().tabs();
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
            $(\"#formExpense [s='d'], #formExpense .js-select-label, #formExpense [j='autocomplete']\")
                .bindFormKeypress({modelName: '" . $this->virtualClassName . "'});
            $('#formExpense .js-select-label').SelectBox();
        }, 400);
        ";
        return $return;
    }

    function lockFormField($fields, $dataObj)	
    {
        
        $this->fieldsRo['Expense']['Date']['html'] = stdFieldRow(_("Date"), div( $dataObj->getDate(), 'Date_label' , "class='readonly' s='d'")
                .input('hidden', 'Date', $dataObj->getDate(), "s='d'"), 'Date', "", $this->commentsDate, $this->commentsDate_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['Quantity']['html'] = stdFieldRow(_("Quantity"), div( $dataObj->getQuantity(), 'Quantity_label' , "class='readonly' s='d'")
                .input('hidden', 'Quantity', $dataObj->getQuantity(), "s='d'"), 'Quantity', "", $this->commentsQuantity, $this->commentsQuantity_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['Amount']['html'] = stdFieldRow(_("Amount"), div( $dataObj->getAmount(), 'Amount_label' , "class='readonly' s='d'")
                .input('hidden', 'Amount', $dataObj->getAmount(), "s='d'"), 'Amount', "", $this->commentsAmount, $this->commentsAmount_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['Total']['html'] = stdFieldRow(_("Total"), div( $dataObj->getTotal(), 'Total_label' , "class='readonly' s='d'")
                .input('hidden', 'Total', $dataObj->getTotal(), "s='d'"), 'Total', "", $this->commentsTotal, $this->commentsTotal_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['Title']['html'] = stdFieldRow(_("Title"), div( $dataObj->getTitle(), 'Title_label' , "class='readonly' s='d'")
                .input('hidden', 'Title', $dataObj->getTitle(), "s='d'"), 'Title', "", $this->commentsTitle, $this->commentsTitle_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['IdBillingCategory']['html'] = stdFieldRow(_("Category"), div( ($dataObj->getBillingCategory())?$dataObj->getBillingCategory()->getName():'', 'IdBillingCategory_label' , "class='readonly' s='d'")
                .input('hidden', 'IdBillingCategory', $dataObj->getIdBillingCategory(), "s='d'"), 'IdBillingCategory', "", $this->commentsIdBillingCategory, $this->commentsIdBillingCategory_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['NoteExpenseLigne']['html'] = stdFieldRow(_("Note"), div( $dataObj->getNoteExpenseLigne(), 'NoteExpenseLigne_label' , "class='readonly' s='d'")
                .input('hidden', 'NoteExpenseLigne', $dataObj->getNoteExpenseLigne(), "s='d'"), 'NoteExpenseLigne', "", $this->commentsNoteExpenseLigne, $this->commentsNoteExpenseLigne_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['IdClient']['html'] = stdFieldRow(_("Client"), div( ($dataObj->getProjectRelatedByIdClient())?$dataObj->getProjectRelatedByIdClient()->getName():'', 'IdClient_label' , "class='readonly' s='d'")
                .input('hidden', 'IdClient', $dataObj->getIdClient(), "s='d'"), 'IdClient', "", $this->commentsIdClient, $this->commentsIdClient_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['IdProject']['html'] = stdFieldRow(_("Project"), div( ($dataObj->getProjectRelatedByIdProject())?$dataObj->getProjectRelatedByIdProject()->getName():'', 'IdProject_label' , "class='readonly' s='d'")
                .input('hidden', 'IdProject', $dataObj->getIdProject(), "s='d'"), 'IdProject', "", $this->commentsIdProject, $this->commentsIdProject_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['IdAssign']['html'] = stdFieldRow(_("Responsable"), div( ($dataObj->getAuthyRelatedByIdAssign())?$dataObj->getAuthyRelatedByIdAssign()->getFullname():'', 'IdAssign_label' , "class='readonly' s='d'")
                .input('hidden', 'IdAssign', $dataObj->getIdAssign(), "s='d'"), 'IdAssign', "", $this->commentsIdAssign, $this->commentsIdAssign_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['IdSupplier']['html'] = stdFieldRow(_("Supplier"), div( ($dataObj->getSupplier())?$dataObj->getSupplier()->getName():'', 'IdSupplier_label' , "class='readonly' s='d'")
                .input('hidden', 'IdSupplier', $dataObj->getIdSupplier(), "s='d'"), 'IdSupplier', "", $this->commentsIdSupplier, $this->commentsIdSupplier_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Expense']['InvoiceNo']['html'] = stdFieldRow(_("Invoice no."), div( $dataObj->getInvoiceNo(), 'InvoiceNo_label' , "class='readonly' s='d'")
                .input('hidden', 'InvoiceNo', $dataObj->getInvoiceNo(), "s='d'"), 'InvoiceNo', "", $this->commentsInvoiceNo, $this->commentsInvoiceNo_css, 'readonly', ' ', 'no');


        if($fields == 'all') {
            foreach($this->fields['Expense'] as $field => $ar) {
                $this->fields['Expense'][$field]['html'] = $this->fieldsRo['Expense'][$field]['html'];
            }
        } elseif(is_array($fields)) {
            foreach($fields as $field) {
                $this->fields['Expense'][$field]['html'] = $this->fieldsRo['Expense'][$field]['html'];
            }
        }
    }

    /**
     * Query for Expense_IdBillingCategory selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxExpense_IdBillingCategory(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = BillingCategoryQuery::create();

            $q->select(array('Name', 'IdBillingCategory'));
            $q->orderBy('Name', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }

    /**
     * Query for Expense_IdClient selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxExpense_IdClient(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = ProjectQuery::create();

            $q->select(array('Name', 'IdClient'));
            $q->orderBy('Name', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }

    /**
     * Query for Expense_IdProject selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxExpense_IdProject(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = ProjectQuery::create();

            $q->select(array('Name', 'IdProject'));
            $q->orderBy('Name', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }

    /**
     * Query for Expense_IdAssign selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxExpense_IdAssign(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = AuthyQuery::create();

            $q->addAsColumn('selDisplay', ''.AuthyPeer::FULLNAME.' ');
            $q->select(array('selDisplay', 'IdCreation'));
            $q->orderBy('selDisplay', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }

    /**
     * Query for Expense_IdSupplier selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxExpense_IdSupplier(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = SupplierQuery::create();

            $q->select(array('Name', 'IdSupplier'));
            $q->orderBy('Name', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }
}
