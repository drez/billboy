<?php

namespace App;


/**
 *  @version 1.1
 *  Generated Form class on the 'BillingLine' table.
 *  
 */
use Psr\Http\Message\ServerRequestInterface as Request;
use ApiGoat\Html\Tabs;
use ApiGoat\Utility\FormHelper as Helper;

class BillingLineForm extends BillingLine
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
    public $cCmoreColsHeader;
    
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
        $this->model_name = 'BillingLine';
        $this->virtualClassName = 'BillingLine';
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

        $q = new BillingLineQuery();
        $q = $this->setAclFilter($q);
        if (method_exists($this, 'beforeListSearch')){ $this->beforeListSearch($q, $search);}

        if(is_array( $this->searchMs )){
            # main search form
            $q::create()
                
                #alias default
                ->leftJoinWith('AuthyRelatedByIdAssign a0')
                #default
                ->leftJoinWith('Project')
                #default
                ->leftJoinWith('BillingCategory');
                
                
        }else{
            if(json_decode($IdParent)){
                        $q = new BillingLineQuery();
                        $pmpoData = $q::create()
                            ->filterBy(json_decode($IdParent))
                            
                #alias default
                ->leftJoinWith('AuthyRelatedByIdAssign a0')
                #default
                ->leftJoinWith('Project')
                #default
                ->leftJoinWith('BillingCategory')
                            

                            ->paginate($page, $maxPerPage);
                    }
            ## standard list
            $hasParent = json_decode($IdParent);
            if(empty($hasParent)) {
                $q::create()
                
                #alias default
                ->leftJoinWith('AuthyRelatedByIdAssign a0')
                #default
                ->leftJoinWith('Project')
                #default
                ->leftJoinWith('BillingCategory');
                
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
                                $(\"#BillingLineListForm [th='sorted'][c='".$col."']\").attr('sens', '".strtolower($sens)."')
                                    .attr('order', 'on').addClass('sorted');
                            ";
                        }
                        $f++;
                    }
                }
            }
            
        
        
        
        $this->pmpoData = $q;
        
        
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
        $trSearch = '';
        $trHeadMod = '';
        
        switch($act) {
            case 'head':
                $trHead = th(_("User fullname"), " th='sorted' c='AuthyRelatedByIdAssign.Fullname' title='"._('AuthyRelatedByIdAssign.Fullname')."' ")
.th(_("Project"), " th='sorted' c='Project.Name' title='"._('Project.Name')."' ")
.th(_("Title"), " th='sorted' c='Title' title='" . _('Title')."' ")
.th(_("Date"), " th='sorted' c='WorkDate' title='" . _('Date')."' ")
.th(_("Quantity"), " th='sorted' c='Quantity' title='" . _('Quantity')."' ")
.th(_("Amount"), " th='sorted' c='Amount' title='" . _('Amount')."' ")
.th(_("Total"), " th='sorted' c='Total' title='" . _('Total')."' ")
.th(_("Category"), " th='sorted' c='BillingCategory.Name' title='"._('BillingCategory.Name')."' ")
.th(_("Note"), " th='sorted' c='NoteBillingLigne' title='" . _('Note')."' ")
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
                
        $this->arrayIdAssignOptions = $this->selectBoxBillingLine_IdAssign($this, $emptyVar, $data);
        $this->arrayIdProjectOptions = $this->selectBoxBillingLine_IdProject($this, $emptyVar, $data);
        $this->arrayIdBillingCategoryOptions = $this->selectBoxBillingLine_IdBillingCategory($this, $emptyVar, $data);
                
                ;
                return $trSearch;

            case 'add':
            ###### ADD
                if($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'a') && !$this->setReadOnly){
                
                                $this->listAddButton = htmlLink(
                                    _("Add new")
                                ,_SITE_URL.$this->virtualClassName."/edit/", "id='addBillingLine' title='"._('Add')."' class='button-link-blue add-button'");
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
        $HelpDivJs = '';
        $HelpDiv = '';
        $this->in = 'getList';
        $this->isChild = '';
        $this->TableName = 'BillingLine';
        $altValue = array (
  'IdBillingLine' => '',
  'IdBilling' => '',
  'CalcId' => '',
  'IdAssign' => '',
  'IdProject' => '',
  'Title' => '',
  'WorkDate' => '',
  'Quantity' => '',
  'Amount' => '',
  'Total' => '',
  'IdBillingCategory' => '',
  'NoteBillingLigne' => '',
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
        $cCmoreCols = '';

        

        $this->uiTabsId = $uiTabsId;
        
        
        $this->IdParent = $IdParent;

        // if Search params
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'BillingLine/');

        // order
        $this->searchOrder = $this->setOrderVar($request['order'] ?? '', 'BillingLine/');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'BillingLine/');

        if (method_exists($this, 'beforeList')){ $this->beforeList($request, $pmpoDataIn );}
        
        $default_order[]['WorkDate']='DESC';
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
                if($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'd')){
                    $this->canDelete = true;
                }
            }
        
            foreach($pcData as $data) {
                $this->listActionCell = '';
                
                
                
        $altValue['AuthyRelatedByIdAssign_Fullname'] = "";
        if($data->getAuthyRelatedByIdAssign()){
            $altValue['AuthyRelatedByIdAssign_Fullname'] = $data->getAuthyRelatedByIdAssign()->getFullname();
        }
                                    $Project_Name = "";
                                    if($data->getProject()){
                                        $Project_Name = $data->getProject()->getName();
                                    }
                                    $BillingCategory_Name = "";
                                    if($data->getBillingCategory()){
                                        $BillingCategory_Name = $data->getBillingCategory()->getName();
                                    }
                if (method_exists($this, 'beforeListTr')){ $this->beforeListTr($altValue, $data, $i, $hook, $cCmoreCols);}
                    

                $actionCell =  td(
        htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteBillingLine' ") . $this->listActionCell, " class='actionrow' ");

                $tr .= $hook['tr_before'].tr(
                td(span((($altValue['IdAssign']) ? $altValue['IdAssign'] : $altValue['AuthyRelatedByIdAssign_Fullname']) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdAssign' class=''  j='editBillingLine'") . 
                td(span((($altValue['IdProject']) ? $altValue['IdProject'] : $Project_Name) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdProject' class=''  j='editBillingLine'") . 
                td(span((($altValue['Title']) ? $altValue['Title'] : $data->getTitle()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Title' class=''  j='editBillingLine'") . 
                td(span((($altValue['WorkDate']) ? $altValue['WorkDate'] : $data->getWorkDate()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='WorkDate' class=''  j='editBillingLine'") . 
                td(span((($altValue['Quantity']) ? $altValue['Quantity'] : str_replace(',', '.', $data->getQuantity())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Quantity' class='right'  j='editBillingLine'") . 
                td(span((($altValue['Amount']) ? $altValue['Amount'] : str_replace(',', '.', $data->getAmount())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Amount' class='right'  j='editBillingLine'") . 
                td(span((($altValue['Total']) ? $altValue['Total'] : str_replace(',', '.', $data->getTotal())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Total' class='right'  j='editBillingLine'") . 
                td(span((($altValue['IdBillingCategory']) ? $altValue['IdBillingCategory'] : $BillingCategory_Name) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdBillingCategory' class=''  j='editBillingLine'") . 
                td(span((($altValue['NoteBillingLigne']) ? $altValue['NoteBillingLigne'] : substr(strip_tags($data->getNoteBillingLigne()), 0, 100)) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='NoteBillingLigne' class=''  j='editBillingLine'") . $hook['td'].$cCmoreCols.$actionCell
                , " ".$hook['tr']."
                        rid='".json_encode($data->getPrimaryKey())."' data-iterator='".$pcData->getPosition()."'
                        r='data'
                        class='".$hook['class']." '
                        id='BillingLineRow".$data->getPrimaryKey()."'")
                .$hook['tr_after'];
                $i++;
            }
            $tr .= input('hidden', 'rowCountBillingLine', $i);
        }

        

        ## @Paging
        $pagerRow = $this->getPager($pmpoData, $resultsCount, $search);
        $bottomRow = div($pagerRow,'bottomPagerRow', "class='tablesorter'");

        if (method_exists($this, 'afterList')){ $this->afterList($this->request, $search, $pmpoData);}

        $controlsContent = $this->getListHeader('list-button');
        
        $return['html'] =
            $this->hookListTop
            .div(
                href(span(_('Open/close menu')),'javascript:','class="toggle-menu button-link-blue trigger-menu"')
                .$this->getListHeader('add')
                
                .div($controlsContent,'BillingLineControlsList', "class='custom-controls'")
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
                        table($trHead.$tr, "id='BillingLineTable' class='tablesorter' style='width:100%;'")
                     ,'',' class="content" ')
                ,'listForm',' class="ac-list" ')
                .$this->hookListBottom
                .$bottomRow
            , 'BillingLineListForm');

          #no parent

    $editUi = (empty($IdParent)) ? 'tabsContain' : 'editDialog';

    $editEvent .= "$(\"#BillingLineListForm td[j='editBillingLine']\").bindEdit({
                    modelName:'" . $this->virtualClassName . "',
                    destUi: '{$editUi}'
                });
                
    $(\"#BillingLineListForm [j='deleteBillingLine']\").bindDelete({
        modelName:'" . $this->virtualClassName . "',
        ui:'".$uiTabsId."',
        title: '".addslashes($this->tableDescription)."',
        message: '".addslashes(message_label('delete_row_confirm_msg'))."'
    });";
        
        $editEvent .= "
        $('#BillingLinePager').bindPaging({
            tableName:'BillingLine'
            ,uiTabsId:'".$uiTabsId."'
            ,ajaxPageActParent:'".$this->virtualClassName."'
        });
";

        if(!isMobile()) {
            $jqueryDatePicker = "
                $(\"#formMsBillingLine [j='date']\").attr('type', 'input');
                $(\"#formMsBillingLine [j='date']\").each(function(){
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
            
        if($('#addBillingLineAutoc').length > 0) {
            $('#addBillingLineAutoc').bind('click', function () {
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
    public function setCreateDefaultsBillingLine($data)
    {

        unset($data['IdBillingLine']);
        $e = new BillingLine();
        
        
        $e->fromArray($data );
        
        #
        
        //foreign
        $e->setIdAssign(( $data['IdAssign'] == '' ) ? null : $data['IdAssign']);
        //foreign
        $e->setIdProject(( $data['IdProject'] == '' ) ? null : $data['IdProject']);
        $e->setWorkDate( ($data['WorkDate'] == '' || $data['WorkDate'] == 'null' || substr($data['WorkDate'],0,10) == '-0001-11-30') ? null : $data['WorkDate'] );
        //integer not required
        $e->setTotal( ($data['Total'] == '' ) ? null : $data['Total']);
        //foreign
        $e->setIdBillingCategory(( $data['IdBillingCategory'] == '' ) ? null : $data['IdBillingCategory']);
        //integer not required
        $e->setNoteBillingLigne( ($data['NoteBillingLigne'] == '' ) ? null : $data['NoteBillingLigne']);
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
    public function setUpdateDefaultsBillingLine($data)
    {

        
        $e = BillingLineQuery::create()->findPk(json_decode($data['i']));
        
        
        $e->fromArray($data );
        
        
        
        if( isset($data['IdAssign']) ){
            $e->setIdAssign(( $data['IdAssign'] == '' ) ? null : $data['IdAssign']);
        }
        if( isset($data['IdProject']) ){
            $e->setIdProject(( $data['IdProject'] == '' ) ? null : $data['IdProject']);
        }
        if(isset($data['WorkDate'])){
            $e->setWorkDate( ($data['WorkDate'] == '' || $data['WorkDate'] == 'null' || substr($data['WorkDate'],0,10) == '-0001-11-30') ? null : $data['WorkDate'] );
        }
        if(isset($data['Total'])){
            $e->setTotal( ($data['Total'] == '' ) ? null : $data['Total']);
        }
        if( isset($data['IdBillingCategory']) ){
            $e->setIdBillingCategory(( $data['IdBillingCategory'] == '' ) ? null : $data['IdBillingCategory']);
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
     * Produce a formated form of BillingLine
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

        $HelpDivJs = '';
        $HelpDiv = '';
        $childTable = [];
        $script_autoc_one = '';
        $ongletf = '';
        $mceInclude = '';
        $ip_save = '';
        $ip_save = '';
        $IdParent = 0;
        $editDialog = ( $data['dialog'] ) ? $data['dialog'] : 'editDialog';
        $uiTabsId = ( $uiTabsId === null ) ? 'tabsContain' : $uiTabsId;
        $jet = 'tr';
        
        $je = "BillingLineTable";
        
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
                case 'Authy':
                    $data['IdModification'] = $data['ip'];
                    break;
                case 'Project':
                    $data['IdProject'] = $data['ip'];
                    break;
                case 'BillingCategory':
                    $data['IdBillingCategory'] = $data['ip'];
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
        if(($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'a') and !$id ) || ( $_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'w') and $id) || $this->setReadOnly) {
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
                $('#formBillingLine #saveBillingLine').unbind('click.saveBillingLine');
                $('#formBillingLine #saveBillingLine').remove();";
        }

        if($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'a') && !$this->setReadOnly) {
            $this->formAddButton = htmlLink(_("Add new"), 'Javascript:;' , "id='addBillingLine' title='"._('Add')."' class='button-link-blue add-button'");
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
            

            $q = BillingLineQuery::create()
            
                #alias default
                ->leftJoinWith('AuthyRelatedByIdAssign a0')
                #default
                ->leftJoinWith('Project')
                #default
                ->leftJoinWith('BillingCategory')
            ;
            


            $dataObj = $q->filterByIdBillingLine($id)->findOne();
            
        }
        
        if($dataObj == null){
            $this->BillingLine['isNew'] = 'yes';
        }
    
        
        
        if($dataObj == null){
            $dataObj = new BillingLine();
            $this->BillingLine['isNew'] = 'yes';
            if(is_array($data ))
               $dataObj->fromArray(array_filter($data));
            
        }else{
                $this->BillingLine['isNew'] = 'no';
        }
        $this->dataObj = $dataObj;
            
        


                                    ($dataObj->getAuthyRelatedByIdAssign())?'':$dataObj->setAuthyRelatedByIdAssign( new Authy() );
                                    ($dataObj->getProject())?'':$dataObj->setProject( new Project() );
                                    ($dataObj->getBillingCategory())?'':$dataObj->setBillingCategory( new BillingCategory() );

        
        $this->arrayIdAssignOptions = $this->selectBoxBillingLine_IdAssign($this, $dataObj, $data);
        $this->arrayIdProjectOptions = $this->selectBoxBillingLine_IdProject($this, $dataObj, $data);
        $this->arrayIdBillingCategoryOptions = $this->selectBoxBillingLine_IdBillingCategory($this, $dataObj, $data);
        
        
        
        
        
        
$this->fields['BillingLine']['IdAssign']['html'] = stdFieldRow(_("Assigned to"), selectboxCustomArray('IdAssign', $this->arrayIdAssignOptions, _('Assigned to'), "v='ID_ASSIGN'  s='d'  val='".$dataObj->getIdAssign()."'", $dataObj->getIdAssign()), 'IdAssign', "", $this->commentsIdAssign, $this->commentsIdAssign_css, '', ' ', 'no');
$this->fields['BillingLine']['IdProject']['html'] = stdFieldRow(_("Project"), selectboxCustomArray('IdProject', $this->arrayIdProjectOptions, _('Project'), "v='ID_PROJECT'  s='d'  val='".$dataObj->getIdProject()."'", $dataObj->getIdProject()), 'IdProject', "", $this->commentsIdProject, $this->commentsIdProject_css, '', ' ', 'no');
$this->fields['BillingLine']['Title']['html'] = stdFieldRow(_("Title"), input('text', 'Title', htmlentities($dataObj->getTitle()), "   placeholder='".str_replace("'","&#39;",_('Title'))."' size='35'  v='TITLE' s='d' class=''  ")."", 'Title', "", $this->commentsTitle, $this->commentsTitle_css, '', ' ', 'no');
$this->fields['BillingLine']['WorkDate']['html'] = stdFieldRow(_("Date"), input('date', 'WorkDate', $dataObj->getWorkDate(), "  j='date' autocomplete='off' placeholder='YYYY-MM-DD' size='10'  s='d' class=''"), 'WorkDate', "", $this->commentsWorkDate, $this->commentsWorkDate_css, '', ' ', 'no');
$this->fields['BillingLine']['Quantity']['html'] = stdFieldRow(_("Quantity"), input('text', 'Quantity', $dataObj->getQuantity(), "  placeholder='".str_replace("'","&#39;",_('Quantity'))."'  v='QUANTITY' size='5' s='d' class=''"), 'Quantity', "", $this->commentsQuantity, $this->commentsQuantity_css, '', ' ', 'no');
$this->fields['BillingLine']['Amount']['html'] = stdFieldRow(_("Amount"), input('text', 'Amount', $dataObj->getAmount(), "  placeholder='".str_replace("'","&#39;",_('Amount'))."'  v='AMOUNT' size='5' s='d' class=''"), 'Amount', "", $this->commentsAmount, $this->commentsAmount_css, '', ' ', 'no');
$this->fields['BillingLine']['Total']['html'] = stdFieldRow(_("Total"), input('text', 'Total', $dataObj->getTotal(), "  placeholder='".str_replace("'","&#39;",_('Total'))."'  v='TOTAL' size='5' s='d' class=''"), 'Total', "", $this->commentsTotal, $this->commentsTotal_css, '', ' ', 'no');
$this->fields['BillingLine']['IdBillingCategory']['html'] = stdFieldRow(_("Category"), selectboxCustomArray('IdBillingCategory', $this->arrayIdBillingCategoryOptions, _('Category'), "v='ID_BILLING_CATEGORY'  s='d'  val='".$dataObj->getIdBillingCategory()."'", $dataObj->getIdBillingCategory()), 'IdBillingCategory', "", $this->commentsIdBillingCategory, $this->commentsIdBillingCategory_css, '', ' ', 'no');
$this->fields['BillingLine']['NoteBillingLigne']['html'] = stdFieldRow(_("Note"), textarea('NoteBillingLigne', htmlentities($dataObj->getNoteBillingLigne()) ,"placeholder='".str_replace("'","&#39;",_('Note'))."' cols='71' v='NOTE_BILLING_LIGNE' s='d'  class=' tinymce ' style='' spellcheck='false'"), 'NoteBillingLigne', "", $this->commentsNoteBillingLigne, $this->commentsNoteBillingLigne_css, 'istinymce', ' ', 'no');


        $this->lockFormField(array(0=>'Total',), $dataObj);

        // Whole form read only
        if($this->setReadOnly == 'all' ) { 
            $this->lockFormField('all', $dataObj); 
        }

        
        $ongletf =
            div(
                ul(li(htmlLink(_('Entries'),'#ogf_BillingLine',' j="ogf" p="BillingLine" class="ui-tabs-anchor" '))
                    .li(htmlLink(_('Note'),'#ogf_note_billing_ligne',' j="ogf" class="ui-tabs-anchor" p="BillingLine" ')))
            ,'cntOngletBillingLine',' class="cntOnglet"')
        ;
        
        if(!$this->setReadOnly){
            $this->formSaveBar = div(	div( input('button', 'saveBillingLine', _('Save'),' class="button-link-blue can-save"')
                                .input('hidden', 'formChangedBillingLine','', 'j="formChanged"')
                                .input('hidden', 'idPk', urlencode($id), "s='d'")
                            .input('hidden', 'IdBillingLine', $dataObj->getIdBillingLine(), " s='d' pk").input('hidden', 'IdBilling', $dataObj->getIdBilling(), " s='d' nodesc").input('hidden', 'IdGroupCreation', $dataObj->getIdGroupCreation(), " s='d' nodesc").input('hidden', 'IdCreation', $dataObj->getIdCreation(), " s='d' nodesc").input('hidden', 'IdModification', $dataObj->getIdModification(), " s='d' nodesc")
                            .$this->hookListSearchButton
                        ,"", " class='divtd' colspan='2' style='text-align:right;'"),""," class='divtr divbut' ");
        }
        if (method_exists($this, 'afterFormObj')){ $this->afterFormObj($data, $dataObj);}
        

        //Form header
        $header_top = div(
                            div(href(span(_('Display/Hide menu')),'javascript:','class="toggle-menu button-link-blue trigger-menu"')
                        .$this->formAddButton,'','class="default-controls"')
                        .$this->printLink
                            .$this->hookSwHeader.$HelpDiv
                        , '', 'class="sw-header"');
        $header_top_onglet = $this->formTitle.$ongletf;

        if(!isMobile()) {
            $jqueryDatePicker = " $(\"#formBillingLine [j='date']\").attr('type', 'text');
            $(\"#formBillingLine [j='date']\").each(function(){
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
                div('Entries', '', "class='panel-heading'").
                $header_top_onglet.
                
                $this->hookFormInnerTop
                
                .
                    '<div id="ogf_BillingLine">'.
$this->fields['BillingLine']['IdAssign']['html']
.$this->fields['BillingLine']['IdProject']['html']
.$this->fields['BillingLine']['Title']['html']
.$this->fields['BillingLine']['WorkDate']['html']
.$this->fields['BillingLine']['Quantity']['html']
.$this->fields['BillingLine']['Amount']['html']
.$this->fields['BillingLine']['Total']['html']
.$this->fields['BillingLine']['IdBillingCategory']['html']
.'</div><div id="ogf_note_billing_ligne"  class=" ui-tabs-panel">'
.$this->fields['BillingLine']['NoteBillingLigne']['html'].'</div>'
                
                .$this->formSaveBar
                .$this->hookFormInnerBottom
            ,"divCntBillingLine", "class='divStdform' CntTabs=1 ".$this->ccStdFormOptions)
        , "id='formBillingLine' class='mainForm formContent' ")
        .$this->hookFormBottom;


        
        
        if($id and $_SESSION['mem']['BillingLine']['ogf']) {
            $tabs_act = "$('[href=\"".$_SESSION['mem']['BillingLine']['ogf']."\"]').click();";
        }

        if($_SESSION['mem']['BillingLine']['ixmemautocapp'] and $_GET['Autocapp'] == 1) {
            $Autocapp = $_SESSION['mem']['BillingLine']['ixmemautocapp'];
            unset($_SESSION['mem']['BillingLine']['ixmemautocapp']);
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
        $('#formBillingLine .tinymce').each(function() {
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
            $(\"#formBillingLine [s='d'], #formBillingLine .js-select-label, #formBillingLine [j='autocomplete']\")
                .bindFormKeypress({modelName: '" . $this->virtualClassName . "'});
            $('#formBillingLine .js-select-label').SelectBox();
        }, 400);
        ";
        return $return;
    }

    function lockFormField($fields, $dataObj)	
    {
        
        $this->fieldsRo['BillingLine']['IdAssign']['html'] = stdFieldRow(_("Assigned to"), div( ($dataObj->getAuthyRelatedByIdAssign())?$dataObj->getAuthyRelatedByIdAssign()->getFullname():'', 'IdAssign_label' , "class='readonly' s='d'")
                .input('hidden', 'IdAssign', $dataObj->getIdAssign(), "s='d'"), 'IdAssign', "", $this->commentsIdAssign, $this->commentsIdAssign_css, 'readonly', ' ', 'no');

        $this->fieldsRo['BillingLine']['IdProject']['html'] = stdFieldRow(_("Project"), div( ($dataObj->getProject())?$dataObj->getProject()->getName():'', 'IdProject_label' , "class='readonly' s='d'")
                .input('hidden', 'IdProject', $dataObj->getIdProject(), "s='d'"), 'IdProject', "", $this->commentsIdProject, $this->commentsIdProject_css, 'readonly', ' ', 'no');

        $this->fieldsRo['BillingLine']['Title']['html'] = stdFieldRow(_("Title"), div( $dataObj->getTitle(), 'Title_label' , "class='readonly' s='d'")
                .input('hidden', 'Title', $dataObj->getTitle(), "s='d'"), 'Title', "", $this->commentsTitle, $this->commentsTitle_css, 'readonly', ' ', 'no');

        $this->fieldsRo['BillingLine']['WorkDate']['html'] = stdFieldRow(_("Date"), div( $dataObj->getWorkDate(), 'WorkDate_label' , "class='readonly' s='d'")
                .input('hidden', 'WorkDate', $dataObj->getWorkDate(), "s='d'"), 'WorkDate', "", $this->commentsWorkDate, $this->commentsWorkDate_css, 'readonly', ' ', 'no');

        $this->fieldsRo['BillingLine']['Quantity']['html'] = stdFieldRow(_("Quantity"), div( $dataObj->getQuantity(), 'Quantity_label' , "class='readonly' s='d'")
                .input('hidden', 'Quantity', $dataObj->getQuantity(), "s='d'"), 'Quantity', "", $this->commentsQuantity, $this->commentsQuantity_css, 'readonly', ' ', 'no');

        $this->fieldsRo['BillingLine']['Amount']['html'] = stdFieldRow(_("Amount"), div( $dataObj->getAmount(), 'Amount_label' , "class='readonly' s='d'")
                .input('hidden', 'Amount', $dataObj->getAmount(), "s='d'"), 'Amount', "", $this->commentsAmount, $this->commentsAmount_css, 'readonly', ' ', 'no');

        $this->fieldsRo['BillingLine']['Total']['html'] = stdFieldRow(_("Total"), div( $dataObj->getTotal(), 'Total_label' , "class='readonly' s='d'")
                .input('hidden', 'Total', $dataObj->getTotal(), "s='d'"), 'Total', "", $this->commentsTotal, $this->commentsTotal_css, 'readonly', ' ', 'no');

        $this->fieldsRo['BillingLine']['IdBillingCategory']['html'] = stdFieldRow(_("Category"), div( ($dataObj->getBillingCategory())?$dataObj->getBillingCategory()->getName():'', 'IdBillingCategory_label' , "class='readonly' s='d'")
                .input('hidden', 'IdBillingCategory', $dataObj->getIdBillingCategory(), "s='d'"), 'IdBillingCategory', "", $this->commentsIdBillingCategory, $this->commentsIdBillingCategory_css, 'readonly', ' ', 'no');

        $this->fieldsRo['BillingLine']['NoteBillingLigne']['html'] = stdFieldRow(_("Note"), div( $dataObj->getNoteBillingLigne(), 'NoteBillingLigne_label' , "class='readonly' s='d'")
                .input('hidden', 'NoteBillingLigne', $dataObj->getNoteBillingLigne(), "s='d'"), 'NoteBillingLigne', "", $this->commentsNoteBillingLigne, $this->commentsNoteBillingLigne_css, 'readonly', ' ', 'no');


        if($fields == 'all') {
            foreach($this->fields['BillingLine'] as $field => $ar) {
                $this->fields['BillingLine'][$field]['html'] = $this->fieldsRo['BillingLine'][$field]['html'];
            }
        } elseif(is_array($fields)) {
            foreach($fields as $field) {
                $this->fields['BillingLine'][$field]['html'] = $this->fieldsRo['BillingLine'][$field]['html'];
            }
        }
    }

    /**
     * Query for BillingLine_IdAssign selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxBillingLine_IdAssign(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
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
     * Query for BillingLine_IdProject selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxBillingLine_IdProject(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = ProjectQuery::create();

            $q->filterByIdClient($dataObj->getBilling()->getIdClient() );
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
     * Query for BillingLine_IdBillingCategory selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxBillingLine_IdBillingCategory(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
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
}
