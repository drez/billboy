<?php

namespace App;


/**
 *  @version 1.1
 *  Generated Form class on the 'Project' table.
 *
 */
use Psr\Http\Message\ServerRequestInterface as Request;
use ApiGoat\Html\Tabs;
use ApiGoat\Utility\FormHelper as Helper;

class ProjectForm extends Project
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
    public $hookLogin;

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
        $this->model_name = 'Project';
        $this->virtualClassName = 'Project';
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

        $q = new ProjectQuery();
        $q = $this->setAclFilter($q);
        if (method_exists($this, 'beforeListSearch')){ $this->beforeListSearch($q, $search);}

        if(is_array( $this->searchMs )){
            # main search form
            $q::create()
                
                #default
                ->leftJoinWith('Client');

        if($this->searchMs['IdClient'] == '_null' || $this->searchMs['IdClient'] == '_null') {
            $q->filterByIdClient( null );
        } else
        if( isset($this->searchMs['IdClient']) ) {
            $criteria = \Criteria::EQUAL;
            $value = $this->searchMs['IdClient'];

            $q->filterByIdClient($value, $criteria);
        }
        if( isset($this->searchMs['Date']) ) {
            $criteria = \Criteria::EQUAL;


            $value = $this->setCriteria($this->searchMs['Date'], $criteria);

            $q->filterByDate($value, $criteria);
        }
        if( isset($this->searchMs['Title']) ) {
            $criteria = \Criteria::LIKE;


            $value = $this->setCriteria($this->searchMs['Title'], $criteria);

            $q->filterByTitle($value, $criteria);
        }
                
        }else{
            
            ## standard list
            $hasParent = json_decode($IdParent);
            if(empty($hasParent)) {
                $q::create()
                
                #default
                ->leftJoinWith('Client');
                
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
                                $(\"#ProjectListForm [th='sorted'][c='".$col."']\").attr('sens', '".strtolower($sens)."')
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
                $trHead = th(_("Name"), " th='sorted' c='Name' title='" . _('Name')."' ")
.th(_("Client"), " th='sorted' c='Client.Name' title='"._('Client.Name')."' ")
.th(_("Start date"), " th='sorted' c='Date' title='" . _('Start date')."' ")
.th(_("State"), " th='sorted' c='State' title='" . _('State')."' ")
.th(_("Budget"), " th='sorted' c='Budget' title='" . _('Budget')."' ")
.th(_("Spent"), " th='sorted' c='Spent' title='" . _('Spent')."' ")
.th(_("Payment Reference"), " th='sorted' c='Reference' title='" . _('Payment Reference')."' ")
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
                
        $this->arrayIdClientOptions = $this->selectBoxProject_IdClient($this, $emptyVar, $data);
                $data = [];
            

            $trSearch = button(span(_("Show search")),'class="trigger-search button-link-blue"')

            .div(
                form(div(selectboxCustomArray('IdClient', $this->arrayIdClientOptions, 'Client' , "v='ID_CLIENT'  s='d' ", $this->searchMs['IdClient'], '', true), '', ' class="ac-search-item "').div(input('date', 'Date', $this->searchMs['Date'], '  j="date"  placeholder="'._('Date').'"',''),'','class="ac-search-item"').div(input('text', 'Title', $this->searchMs['Title'], '  placeholder="'._('Title').'"',''),'','class="ac-search-item"').$this->hookListSearchTop
                    .div(
                       button(span(_("Search")),'id="msProjectBt" title="'._('Search').'" class="icon search"')
                       .button(span(_("Clear")),' title="'._('Clear search').'" id="msProjectBtClear"')
                       .input('hidden', 'Seq', $data['Seq'] )
                    ,'','class="ac-search-item ac-action-buttons"')
                    ,"id='formMsProject'")
            ,"", "  class='msSearchCtnr'");;
                return $trSearch;

            case 'add':
            ###### ADD
                if($_SESSION[_AUTH_VAR]->hasRights('Project', 'a') && !$this->setReadOnly){
                
                                $this->listAddButton = htmlLink(
                                    _("Add new")
                                ,_SITE_URL.$this->virtualClassName."/edit/", "id='addProject' title='"._('Add')."' class='button-link-blue add-button'");
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
        $this->TableName = 'Project';
        $altValue = array (
  'IdProject' => '',
  'CalcId' => '',
  'Name' => '',
  'IdClient' => '',
  'Date' => '',
  'Type' => '',
  'State' => '',
  'Budget' => '',
  'Spent' => '',
  'Reference' => '',
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
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Project/');

        // order
        $this->searchOrder = $this->setOrderVar($request['order'] ?? '', 'Project/');

        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Project/');

        if (method_exists($this, 'beforeList')){ $this->beforeList($request, $pmpoDataIn );}
        
        
        
        
        

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
                if($_SESSION[_AUTH_VAR]->hasRights('Project', 'd')){
                    $this->canDelete = htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteProject' ");
                }
            }
        
            foreach($pcData as $data) {
                $this->listActionCell = '';
                
                
                
                                    $Client_Name = "";
                                    if($data->getClient()){
                                        $Client_Name = $data->getClient()->getName();
                                    }
                if (method_exists($this, 'beforeListTr')){ $this->beforeListTr($altValue, $data, $i, $hook, $cCmoreCols);}
                

                $actionCell =  td($this->canDelete . $this->listActionCell, " class='actionrow' ");

                $tr .= $hook['tr_before'].tr(
                td(span((($altValue['Name']) ? $altValue['Name'] : $data->getName()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Name' class=''  j='editProject'") . 
                td(span((($altValue['IdClient']) ? $altValue['IdClient'] : $Client_Name) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdClient' class=''  j='editProject'") . 
                td(span((($altValue['Date']) ? $altValue['Date'] : $data->getDate()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Date' class=''  j='editProject'") . 
                td(span((($altValue['State']) ? $altValue['State'] : isntPo($data->getState())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='State' class='center'  j='editProject'") . 
                td(span((($altValue['Budget']) ? $altValue['Budget'] : str_replace(',', '.', $data->getBudget())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Budget' class='right'  j='editProject'") . 
                td(span((($altValue['Spent']) ? $altValue['Spent'] : str_replace(',', '.', $data->getSpent())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Spent' class='right'  j='editProject'") . 
                td(span((($altValue['Reference']) ? $altValue['Reference'] : $data->getReference()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Reference' class=''  j='editProject'") . $hook['td'].$cCmoreCols.$actionCell
                , " ".$hook['tr']."
                        rid='".json_encode($data->getPrimaryKey())."' data-iterator='".$pcData->getPosition()."'
                        r='data'
                        class='".$hook['class']." '
                        id='ProjectRow".$data->getPrimaryKey()."'")
                .$hook['tr_after'];
                $i++;
                unset($altValue);
            }
            $tr .= input('hidden', 'rowCountProject', $i);
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
                
                .div($controlsContent,'ProjectControlsList', "class='custom-controls'")
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
                        table($trHead.$tr, "id='ProjectTable' class='tablesorter' style='width:100%;'")
                     ,'',' class="content" ')
                ,'listForm',' class="ac-list" ')
                .$this->hookListBottom
                .$bottomRow
            , 'ProjectListForm');

          #no parent

    $editUi = (empty($IdParent)) ? 'tabsContain' : 'editDialog';

    $editEvent .= "$(\"#ProjectListForm td[j='editProject']\").bindEdit({
                    modelName:'" . $this->virtualClassName . "',
                    destUi: '{$editUi}'
                });
                
    $(\"#ProjectListForm [j='deleteProject']\").bindDelete({
        modelName:'" . $this->virtualClassName . "',
        ui:'".$uiTabsId."',
        title: '".addslashes($this->tableDescription)."',
        message: '".addslashes(message_label('delete_row_confirm_msg'))."'
    });";

        $editEvent .= "
        $('#ProjectPager').bindPaging({
            tableName:'Project'
            ,uiTabsId:'".$uiTabsId."'
            ,ajaxPageActParent:'".$this->virtualClassName."'
        });
";



        $return['onReadyJs'] =
            $HelpDivJs
            
            ."
        

    $('#msProjectBt').click(function() {
        sw_message('".addslashes(_('Search in progress...'))."',false ,'search-progress', true);
        $('#msProjectBt button').attr('disabled', 'disabled');

        $.post('"._SITE_URL.$this->virtualClassName."', {ui: '".$uiTabsId."', ms:$('#formMsProject').serialize() },  function(data){
            $('#".$uiTabsId."').html(data);
            $('#formMsProject .js-select-label').SelectBox();
            $('#formMsProject input[type=text]').first().focus();
            $('#formMsProject input[type=text]').first().putCursorAtEnd();
            $('#msProjectBt button').attr('disabled', '');
            sw_message_remove('search-progress');
        });

        return false;
    });

    $('#formMsProject').keydown(function(e) {
        if(e.which == 13) {
            $('#msProjectBt').click();
        }
    });

    $('#msProjectBtClear').bind('click', function (){
        sw_message('".addslashes(_('Search cleared...'))."', false,'search-reset', true);

        $.post('"._SITE_URL.$this->virtualClassName."', {ui: '".$uiTabsId."', ms:'clear' },  function(data){
                $('#".$uiTabsId."').html(data);
                $('#formMsProject input[type=text]:first-of-type').focus().putCursorAtEnd();
                sw_message_remove('search-reset');
        });

        return false;
    });
        
        
        $('#tabsContain .js-select-label').SelectBox();
        ".$this->hookListReadyJsFirst.$editEvent."
       $(\"#{$uiTabsId} [th='sorted']\").bindSorting({
            modelName:'".$this->virtualClassName."',
            destUi:'".$uiTabsId."'
        });

        if($('#addProjectAutoc').length > 0) {
            $('#addProjectAutoc').bind('click', function () {
                $.post('"._SITE_URL."GuiManager', {a:'ixmemautoc', p:'{$this->virtualClassName}',}, function(data) {
                    document.location = '"._SITE_URL.$this->virtualClassName."/edit/';
                });
            });
        }
        
        
        ".$this->orderReadyJsOrder."
        ".$this->hookListReadyJs;
        $return['js'] .= " ";
        return $return;
    }
    /*
    *	Make sure default value are set before save
    */
    public function setCreateDefaultsProject($data)
    {

        unset($data['IdProject']);
        $e = new Project();
        
        
        if( $data['Type'] == '' )unset($data['Type']);
        if( $data['State'] == '' )unset($data['State']);
        $e->fromArray($data );

        #
        
        //foreign
        $e->setIdClient(( $data['IdClient'] == '' ) ? null : $data['IdClient']);
        $e->setDate( ($data['Date'] == '' || $data['Date'] == 'null' || substr($data['Date'],0,10) == '-0001-11-30') ? null : $data['Date'] );
        $e->setType(($data['Type'] == '' ) ? null : $data['Type']);
        $e->setState(($data['State'] == '' ) ? null : $data['State']);
        //integer not required
        $e->setBudget( ($data['Budget'] == '' ) ? null : $data['Budget']);
        //integer not required
        $e->setSpent( ($data['Spent'] == '' ) ? null : $data['Spent']);
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
    public function setUpdateDefaultsProject($data)
    {

        
        $e = ProjectQuery::create()->findPk(json_decode($data['i']));
        
        
        if( $data['Type'] == '' )unset($data['Type']);
        if( $data['State'] == '' )unset($data['State']);
        $e->fromArray($data );

        
        
        if( isset($data['IdClient']) ){
            $e->setIdClient(( $data['IdClient'] == '' ) ? null : $data['IdClient']);
        }
        if(isset($data['Date'])){
            $e->setDate( ($data['Date'] == '' || $data['Date'] == 'null' || substr($data['Date'],0,10) == '-0001-11-30') ? null : $data['Date'] );
        }
        if(isset($data['Type'])){
            $e->setType(($data['Type'] == '' ) ? null : $data['Type']);
        }
        if(isset($data['State'])){
            $e->setState(($data['State'] == '' ) ? null : $data['State']);
        }
        if(isset($data['Budget'])){
            $e->setBudget( ($data['Budget'] == '' ) ? null : $data['Budget']);
        }
        if(isset($data['Spent'])){
            $e->setSpent( ($data['Spent'] == '' ) ? null : $data['Spent']);
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
     * Produce a formated form of Project
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

        $je = "ProjectTable";

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
                
                case 'Client':
                    $data['IdClient'] = $data['ip'];
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
        if(($_SESSION[_AUTH_VAR]->hasRights('Project', 'a') and !$id ) || ( $_SESSION[_AUTH_VAR]->hasRights('Project', 'w') and $id) || $this->setReadOnly) {
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
                $('#formProject #saveProject').unbind('click.saveProject');
                $('#formProject #saveProject').remove();";
        }

        if($_SESSION[_AUTH_VAR]->hasRights('Project', 'a') && !$this->setReadOnly) {
            $this->formAddButton = htmlLink(_("Add new"), 'Javascript:;' , "id='addProject' title='"._('Add')."' class='button-link-blue add-button'");
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
            

            $q = ProjectQuery::create()
            
                #default
                ->leftJoinWith('Client')
            ;
            


            $dataObj = $q->filterByIdProject($id)->findOne();
            
        }
        
        if($dataObj == null){
            $this->Project['isNew'] = 'yes';
        }
    
        
        
        if($dataObj == null){
            $dataObj = new Project();
            $this->Project['isNew'] = 'yes';
            if(is_array($data ))
               $dataObj->fromArray(array_filter($data));
            
        }else{
                $this->Project['isNew'] = 'no';
        }
        $this->dataObj = $dataObj;
            
        


                                    ($dataObj->getClient())?'':$dataObj->setClient( new Client() );

        
        $this->arrayIdClientOptions = $this->selectBoxProject_IdClient($this, $dataObj, $data);
        
        
        
        
        
        
$this->fields['Project']['Name']['html'] = stdFieldRow(_("Name"), input('text', 'Name', htmlentities($dataObj->getName()), "   placeholder='".str_replace("'","&#39;",_('Name'))."' size='35'  v='NAME' s='d' class='req'  ")."", 'Name', "", $this->commentsName, $this->commentsName_css, '', ' ', 'no');
$this->fields['Project']['IdClient']['html'] = stdFieldRow(_("Client"), selectboxCustomArray('IdClient', $this->arrayIdClientOptions, _('Client'), "v='ID_CLIENT'  s='d'  val='".$dataObj->getIdClient()."'", $dataObj->getIdClient()), 'IdClient', "", $this->commentsIdClient, $this->commentsIdClient_css, '', ' ', 'no');
$this->fields['Project']['Date']['html'] = stdFieldRow(_("Start date"), input('date', 'Date', $dataObj->getDate(), "  j='date' autocomplete='off' placeholder='YYYY-MM-DD' size='10'  s='d' class=''"), 'Date', "", $this->commentsDate, $this->commentsDate_css, '', ' ', 'no');
$this->fields['Project']['State']['html'] = stdFieldRow(_("State"), selectboxCustomArray('State', array( '0' => array('0'=>_("New"), '1'=>"New"),'1' => array('0'=>_("Approved"), '1'=>"Approved"),'2' => array('0'=>_("Cancelled"), '1'=>"Cancelled"),'3' => array('0'=>_("Closed"), '1'=>"Closed"), ), _('State'), "s='d'  ", $dataObj->getState(), '', true), 'State', "", $this->commentsState, $this->commentsState_css, '', ' ', 'no');
$this->fields['Project']['Budget']['html'] = stdFieldRow(_("Budget"), input('text', 'Budget', $dataObj->getBudget(), "  placeholder='".str_replace("'","&#39;",_('Budget'))."'  v='BUDGET' size='5' s='d' class=''"), 'Budget', "", $this->commentsBudget, $this->commentsBudget_css, '', ' ', 'no');
$this->fields['Project']['Spent']['html'] = stdFieldRow(_("Spent"), input('text', 'Spent', $dataObj->getSpent(), "  placeholder='".str_replace("'","&#39;",_('Spent'))."'  v='SPENT' size='5' s='d' class=''"), 'Spent', "", $this->commentsSpent, $this->commentsSpent_css, '', ' ', 'no');
$this->fields['Project']['Reference']['html'] = stdFieldRow(_("Payment Reference"), input('text', 'Reference', htmlentities($dataObj->getReference()), "   placeholder='".str_replace("'","&#39;",_('Payment Reference'))."' size='35'  v='REFERENCE' s='d' class=''  ")."", 'Reference', "", $this->commentsReference, $this->commentsReference_css, '', ' ', 'no');


        $this->lockFormField(array(0=>'Spent',), $dataObj);

        // Whole form read only
        if($this->setReadOnly == 'all' ) {
            $this->lockFormField('all', $dataObj);
        }


        if( !isset($this->Project['request']['ChildHide']) ) {

            # define child lists 'Entries'
            $ongletTab['0']['t'] = _('Entries');
            $ongletTab['0']['p'] = 'BillingLine';
            $ongletTab['0']['lkey'] = 'IdProject';
            $ongletTab['0']['fkey'] = 'IdProject';
            # define child lists 'Time'
            $ongletTab['1']['t'] = _('Time');
            $ongletTab['1']['p'] = 'TimeLine';
            $ongletTab['1']['lkey'] = 'IdProject';
            $ongletTab['1']['fkey'] = 'IdProject';
        if(!empty($ongletTab) and $dataObj->getIdProject()){
            foreach($ongletTab as $value){
                if($_SESSION[_AUTH_VAR]->hasRights($value['p'], 'r')){

                    $getLocalKey = "get".$value['lkey']."";
                    if($dataObj->$getLocalKey()){
                        $ChildOnglet .= li(
                                        htmlLink(	_($value['t'])
                                            ,'javascript:',"p='".$value['p']."' act='list' j=conglet_Project ip='".$dataObj->$getLocalKey()."' class='ui-state-default' ")
                                    ,"  class='' j=sm  ");
                    }
                }
            }

            if($ChildOnglet){
                $childTable['onReadyJs'] ="
                     $('[j=conglet_Project]').bind('click', function (data){
                         pp = $(this).attr('p');
                         $('#cntProjectChild').html( $('<img>').attr('src', '"._SITE_URL."public/img/Ellipsis-3.9s-200px.svg') );
                         $.get('"._SITE_URL."Project/'+pp+'/'+$(this).attr('ip'), { ui: pp+'Table', 'pui':'".$uiTabsId."', pc:'".$data['pc']."'}, function(data){
                            $('#cntProjectChild').html(data);
                            $('[j=conglet_Project]').parent().attr('class','ui-state-default');
                            $('[j=conglet_Project][p='+pp+']').parent().attr('class',' ui-state-default ui-state-active');
                         });
                    });
                ";
                if($_SESSION['mem']['Project']['child']['list'][$dataObj->$getLocalKey()]){
                    $onglet_p = $_SESSION['mem']['Project']['child']['list'][$dataObj->$getLocalKey()];
                    $childTable['onReadyJs'] .= " $('[j=conglet_Project][p=".$onglet_p."]').first().click();";
                }else{
                    $childTable['onReadyJs'] .= " $('[j=conglet_Project]').first().click();";
                }
            }
        }
        }
        $ongletf =
            div(
                ul(li(htmlLink(_('Project'),'#ogf_Project',' j="ogf" p="Project" class="ui-tabs-anchor" '))
                    .li(htmlLink(_('Budget'),'#ogf_budget',' j="ogf" class="ui-tabs-anchor" p="Project" ')))
            ,'cntOngletProject',' class="cntOnglet"')
        ;
        
        if(!$this->setReadOnly){
            $this->formSaveBar = div(	div( input('button', 'saveProject', _('Save'),' class="button-link-blue can-save"')
                                .input('hidden', 'formChangedProject','', 'j="formChanged"')
                                .input('hidden', 'idPk', urlencode($id), "s='d'")
                            .input('hidden', 'IdProject', $dataObj->getIdProject(), " s='d' pk").input('hidden', 'IdGroupCreation', $dataObj->getIdGroupCreation(), " s='d' nodesc").input('hidden', 'IdCreation', $dataObj->getIdCreation(), " s='d' nodesc").input('hidden', 'IdModification', $dataObj->getIdModification(), " s='d' nodesc")
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

        /*if(!isMobile()) {
            $jqueryDatePicker = " $(\"#formProject [j='date']\").attr('type', 'text');
            $(\"#formProject [j='date']\").each(function(){
                $(this).datepicker({dateFormat: 'yy-mm-dd ',changeYear: true, changeMonth: true, yearRange: '1940:2040', showOtherMonths: true, selectOtherMonths: true});
            });";
        }*/

        // Form
        $return['html'] =
        $this->hookFormTop
        .$mceInclude
        .$header_top
        .form(

            div(
                div('Project', '', "class='panel-heading'").
                $header_top_onglet.
                
                $this->hookFormInnerTop
                
                .
                    '<div id="ogf_Project">'.
$this->fields['Project']['Name']['html']
.$this->fields['Project']['IdClient']['html']
.$this->fields['Project']['Date']['html']
.$this->fields['Project']['State']['html']
.'</div><div id="ogf_budget"  class=" ui-tabs-panel">'
.$this->fields['Project']['Budget']['html']
.$this->fields['Project']['Spent']['html']
.$this->fields['Project']['Reference']['html'].'</div>'
                
                .$this->formSaveBar
                .$this->hookFormInnerBottom
            ,"divCntProject", "class='divStdform' CntTabs=1 ".$this->ccStdFormOptions)
        , "id='formProject' class='mainForm formContent' ")
        .$this->hookFormBottom;


        //if not new, show child table
        if($dataObj->getIdProject()) {
            if($ChildOnglet) {
                $return['html'] .= div(
                                        div('Child(s)', '', "class='panel-heading'")
                                        . ul($ChildOnglet, " class=' ui-tabs-nav ' ")
                                        . div('','cntProjectChild',' class="" ')
                                    , 'pannelProject', " class='child_pannel ui-tabs childCntClass'");
            }
        }

        if($id and $_SESSION['mem']['Project']['ogf']) {
            $tabs_act = "$('[href=\"".$_SESSION['mem']['Project']['ogf']."\"]').click();";
        }

        if($_SESSION['mem']['Project']['ixmemautocapp'] and $_GET['Autocapp'] == 1) {
            $Autocapp = $_SESSION['mem']['Project']['ixmemautocapp'];
            unset($_SESSION['mem']['Project']['ixmemautocapp']);
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
        $('#formProject .tinymce').each(function() {
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
            $(\"#formProject [s='d'], #formProject .js-select-label, #formProject [j='autocomplete']\")
                .bindFormKeypress({modelName: '" . $this->virtualClassName . "'});
            $('#formProject .js-select-label').SelectBox();
        }, 400);
        ";
        return $return;
    }

    function lockFormField($fields, $dataObj)
    {
        
        $this->fieldsRo['Project']['Name']['html'] = stdFieldRow(_("Name"), div( $dataObj->getName(), 'Name_label' , "class='readonly' s='d'")
                .input('hidden', 'Name', $dataObj->getName(), "s='d'"), 'Name', "", $this->commentsName, $this->commentsName_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Project']['IdClient']['html'] = stdFieldRow(_("Client"), div( ($dataObj->getClient())?$dataObj->getClient()->getName():'', 'IdClient_label' , "class='readonly' s='d'")
                .input('hidden', 'IdClient', $dataObj->getIdClient(), "s='d'"), 'IdClient', "", $this->commentsIdClient, $this->commentsIdClient_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Project']['Date']['html'] = stdFieldRow(_("Start date"), div( $dataObj->getDate(), 'Date_label' , "class='readonly' s='d'")
                .input('hidden', 'Date', $dataObj->getDate(), "s='d'"), 'Date', "", $this->commentsDate, $this->commentsDate_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Project']['State']['html'] = stdFieldRow(_("State"), div( $dataObj->getState(), 'State_label' , "class='readonly' s='d'")
                .input('hidden', 'State', $dataObj->getState(), "s='d'"), 'State', "", $this->commentsState, $this->commentsState_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Project']['Budget']['html'] = stdFieldRow(_("Budget"), div( $dataObj->getBudget(), 'Budget_label' , "class='readonly' s='d'")
                .input('hidden', 'Budget', $dataObj->getBudget(), "s='d'"), 'Budget', "", $this->commentsBudget, $this->commentsBudget_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Project']['Spent']['html'] = stdFieldRow(_("Spent"), div( $dataObj->getSpent(), 'Spent_label' , "class='readonly' s='d'")
                .input('hidden', 'Spent', $dataObj->getSpent(), "s='d'"), 'Spent', "", $this->commentsSpent, $this->commentsSpent_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Project']['Reference']['html'] = stdFieldRow(_("Payment Reference"), div( $dataObj->getReference(), 'Reference_label' , "class='readonly' s='d'")
                .input('hidden', 'Reference', $dataObj->getReference(), "s='d'"), 'Reference', "", $this->commentsReference, $this->commentsReference_css, 'readonly', ' ', 'no');


        if($fields == 'all') {
            foreach($this->fields['Project'] as $field => $ar) {
                $this->fields['Project'][$field]['html'] = $this->fieldsRo['Project'][$field]['html'];
            }
        } elseif(is_array($fields)) {
            foreach($fields as $field) {
                $this->fields['Project'][$field]['html'] = $this->fieldsRo['Project'][$field]['html'];
            }
        }
    }

    /**
     * Query for Project_IdClient selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxProject_IdClient(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = ClientQuery::create();

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
     * Query for BillingLine_IdAssign selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxBillingLine_IdAssign(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = AuthyQuery::create();

    if(method_exists($this, 'beginSelectboxBillingLine_IdAssign') and $array)
        $ret = $this->beginSelectboxBillingLine_IdAssign($q, $dataObj, $data, $obj);
    if($ret !== false)
            $q->addAsColumn('selDisplay', ''.AuthyPeer::FULLNAME.'');
            $q->select(array('selDisplay', 'IdCreation'));
            $q->orderBy('selDisplay', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }

                if(function_exists('selectboxDataBillingLine_IdAssign')){ $this->selectboxDataBillingLine_IdAssign($pcDataO, $q); }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }

    /**
     * Query for BillingLine_IdProject selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxBillingLine_IdProject(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = ProjectQuery::create();

    if(method_exists($this, 'beginSelectboxBillingLine_IdProject') and $array)
        $ret = $this->beginSelectboxBillingLine_IdProject($q, $dataObj, $data, $obj);
    if($ret !== false)
            $q->select(array('Name', 'IdProject'));
            $q->orderBy('Name', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }

                if(function_exists('selectboxDataBillingLine_IdProject')){ $this->selectboxDataBillingLine_IdProject($pcDataO, $q); }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }

    /**
     * Query for BillingLine_IdBillingCategory selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxBillingLine_IdBillingCategory(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = BillingCategoryQuery::create();

    if(method_exists($this, 'beginSelectboxBillingLine_IdBillingCategory') and $array)
        $ret = $this->beginSelectboxBillingLine_IdBillingCategory($q, $dataObj, $data, $obj);
    if($ret !== false)
            $q->select(array('Name', 'IdBillingCategory'));
            $q->orderBy('Name', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }

                if(function_exists('selectboxDataBillingLine_IdBillingCategory')){ $this->selectboxDataBillingLine_IdBillingCategory($pcDataO, $q); }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }	
    /**
     * function getBillingLineList
     * @param string $IdProject
     * @param integer $page
     * @param string $uiTabsId
     * @param string $parentContainer
     * @param string $mja_list
     * @param array $search
     * @param array $params
     * @return string
     */
    public function getBillingLineList(String $IdProject, array $request)
    {

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
        $dataObj = null;
        $search = ['order' => null, 'page' => null, ];
        $uiTabsId = (empty($request['cui'])) ? 'cntProjectChild' : $request['cui'];
        $parentContainer = $request['pc'];
        $orderReadyJs = '';
        $param = [];
        $total_child = '';

        // if Search params
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Project/BillingLine');

        // order
        $search['order'] = $this->setOrderVar($request['order'] ?? '', 'Project/BillingLine');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Project/BillingLine');
       
        
        

        /*column hide*/
        
        if($parentContainer == 'editDialog'){
            $diagNoClose = "diag:\"noclose\", ";
            $diagNoCloseEscaped = "diag:\\\"noclose\\\", ";
        }
        
        if(isset($this->Project['request']['noHeader']) && $this->Project['request']['noHeader'] == 'true'){
            $noHeader = "'noHeader':'true',";
        }
        
        $data['IdProject'] = $IdProject;
        if($dataObj == null){
            $dataObj = new Project();
            $dataObj->setIdProject($IdProject);
        }

        $this->BillingLine['list_add'] = "";
        $this->BillingLine['list_delete'] = "";

        if($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'r')){
            $this->BillingLine['list_edit'] = "";
        }

        #filters validation
        
        $filterKey = $IdProject;
        $this->IdPk = $IdProject;
        
        
        #main query
        
        // Normal query
        $maxPerPage = ( $request['maxperpage'] ) ? $request['maxperpage'] : $this->childMaxPerPage;
        $q = BillingLineQuery::create();
        
        
        $q
                #alias default
                ->leftJoinWith('AuthyRelatedByIdAssign a0')
                #default
                ->leftJoinWith('Project')
                #default
                ->leftJoinWith('BillingCategory') 
            
            ->filterByIdProject( $filterKey );; 
               // Search
        
               // orderring
           
        if( is_array( $search['order'] ) ) {
            foreach ($search['order'] as $order) {
                foreach ($order as $col => $sens) {
                    if( $sens ) {
                        $tOrd = explode('.', $col);
                        $orderBy = "use" . $tOrd[0] . "Query";
                        if( $tOrd[1] && method_exists( $q, $orderBy )) {
                            $q->$orderBy( '', \Criteria::LEFT_JOIN )->orderBy( $tOrd[1], $sens )->endUse();
                        }elseif( method_exists( $q, 'filterBy' . $col )) {
                            $q->orderBy( $col, $sens );
                        }

                        $orderReadyJs .= "
                            $(\"#{$uiTabsId} [th='sorted'][c='".$col."'], #{$uiTabsId} [th='sorted'][rc='".$col."']\").attr('sens','".$sens."');
                            $(\"#{$uiTabsId} [th='sorted'][c='".$col."'], #{$uiTabsId} [th='sorted'][rc='".$col."']\").attr('order','on');
                        ";
                    }
                }
            }
        }
            // group by
           
        
            //custom hook
            if (method_exists($this, 'beforeChildSearchBillingLine')){ $this->beforeChildSearchBillingLine($q);}
        $this->queryObj = $q;
        
        $pmpoData =$q->paginate($search['page'], $maxPerPage);
        $resultsCount = $pmpoData->getNbResults();
        
            //custom hook
            if (method_exists($this, 'beforeChildListBillingLine')){ $this->beforeChildListBillingLine($q, $filterKey, $param);}
         
        #options building
        
        $this->arrayIdAssignOptions = $this->selectBoxBillingLine_IdAssign($this, $dataObj, $data);
        $this->arrayIdProjectOptions = $this->selectBoxBillingLine_IdProject($this, $dataObj, $data);
        $this->arrayIdBillingCategoryOptions = $this->selectBoxBillingLine_IdBillingCategory($this, $dataObj, $data);
        
        
          
        
        if(isset($this->Project['request']['noHeader']) && $this->Project['request']['noHeader'] == 'true'){
            $trSearch = "";
        }

        $actionRowHeader ='';
        if($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'd')){
            $actionRowHeader = "";
        }

        $header = tr( th(_("User fullname"), " th='sorted' c='AuthyRelatedByIdAssign.Fullname' title='"._('AuthyRelatedByIdAssign.Fullname')."' " . $param['th']['IdAssign']."")
.th(_("Project"), " th='sorted' c='Project.Name' title='"._('Project.Name')."' " . $param['th']['IdProject']."")
.th(_("Title"), " th='sorted' c='Title' title='" . _('Title')."' " . $param['th']['Title']."")
.th(_("Date"), " th='sorted' c='WorkDate' title='" . _('Date')."' " . $param['th']['WorkDate']."")
.th(_("Quantity"), " th='sorted' c='Quantity' title='" . _('Quantity')."' " . $param['th']['Quantity']."")
.th(_("Amount"), " th='sorted' c='Amount' title='" . _('Amount')."' " . $param['th']['Amount']."")
.th(_("Total"), " th='sorted' c='Total' title='" . _('Total')."' " . $param['th']['Total']."")
.th(_("Category"), " th='sorted' c='BillingCategory.Name' title='"._('BillingCategory.Name')."' " . $param['th']['IdBillingCategory']."")
.th(_("Note"), " th='sorted' c='NoteBillingLigne' title='" . _('Note')."' " . $param['th']['NoteBillingLigne']."")
.'' . $actionRowHeader, " ln='BillingLine' class=''");

        

        $i=0;
        if( $pmpoData->isEmpty() ){
            $tr .= tr(	td(p(span(_("No Entries found")),'class="no-results"'), "style='font-size:16px;' t='empty' ln='BillingLine' colspan='100%' "));
            
        }else{
            //$pcData = $pmpoData->getResults();
            foreach($pmpoData as $data){
                $this->listActionCellBillingLine = '';
                $actionRow = '';
                
            // custom hooks
            if (method_exists($this, 'startChildListRowBillingLine')){ $this->startChildListRowBillingLine($altValue, $data, $i, $param, $this, $hookListColumnsBillingLine, $actionRow);}
            
                
                
                if($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'd')){
                    $actionRow = "";
                }
                
                
                
                
                
                $actionRow = $actionRow;
                $actionRow = (!empty($actionRow)) ? td($this->listActionCellBillingLine.$actionRow," class='actionrow'") : "";
                
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
                
                
                ;
                
                
                
                $tr .= $param['tr_before'].
                        tr(
                            (isset($hookListColumnsBillingLineFirst)?$hookListColumnsBillingLineFirst:'').
                            
                td(span((($altValue['IdAssign']) ? $altValue['IdAssign'] : $altValue['AuthyRelatedByIdAssign_Fullname']) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdAssign' class='' " . $param['IdAssign']." j='editBillingLine'") . 
                td(span((($altValue['IdProject']) ? $altValue['IdProject'] : $Project_Name) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdProject' class='' " . $param['IdProject']." j='editBillingLine'") . 
                td(span((($altValue['Title']) ? $altValue['Title'] : $data->getTitle()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Title' class='' " . $param['Title']." j='editBillingLine'") . 
                td(span((($altValue['WorkDate']) ? $altValue['WorkDate'] : $data->getWorkDate()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='WorkDate' class='' " . $param['WorkDate']." j='editBillingLine'") . 
                td(span((($altValue['Quantity']) ? $altValue['Quantity'] : str_replace(',', '.', $data->getQuantity())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Quantity' class='right' " . $param['Quantity']." j='editBillingLine'") . 
                td(span((($altValue['Amount']) ? $altValue['Amount'] : str_replace(',', '.', $data->getAmount())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Amount' class='right' " . $param['Amount']." j='editBillingLine'") . 
                td(span((($altValue['Total']) ? $altValue['Total'] : str_replace(',', '.', $data->getTotal())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Total' class='right' " . $param['Total']." j='editBillingLine'") . 
                td(span((($altValue['IdBillingCategory']) ? $altValue['IdBillingCategory'] : $BillingCategory_Name) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdBillingCategory' class='' " . $param['IdBillingCategory']." j='editBillingLine'") . 
                td(span((($altValue['NoteBillingLigne']) ? $altValue['NoteBillingLigne'] : substr(strip_tags($data->getNoteBillingLigne()), 0, 100)) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='NoteBillingLigne' class='' " . $param['NoteBillingLigne']." j='editBillingLine'") . 
                            (isset($hookListColumnsBillingLine)?$hookListColumnsBillingLine:'').
                            $actionRow
                        ,"id='BillingLineRow{$data->getPrimaryKey()}' rid='{$data->getPrimaryKey()}' ln='BillingLine' ".$param['tr']." ")
                        .$param['tr_after'];
                
                $i++;
            }
            
            
        }

    $add_button_child = "";
    if(($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'a')) ){
        $add_button_child = "";
    }

    //@PAGINATION
    $pagerRow = $this->getPager($pmpoData, $resultsCount, $search, true);

    $return['html'] =
            div(
                 $this->hookBillingLineListTop
                .div(
                    div($add_button_child
                    .$trSearch, '' ,'class="ac-list-form-header-child"')
                    .div(
                        div(
                            div(
                                table(	
                                    thead($header)
                                    .$tr
                                    .$this->hookBillingLineTableFooter
                                , "id='BillingLineTable' class='tablesorter'")
                            , 'childlistBillingLine')
                            .$this->hookBillingLineListBottom
                        ,'',' class="content" ')
                    ,'listFormChild',' class="ac-list" ')
                    .$pagerRow
                ,'BillingLineListForm')
            ,'cntBillingLinedivChild', "class='childListWrapper'");

            
            

            $return['onReadyJs'] =
                $this->hookListReadyJsFirstBillingLine
                .""
                .$this->BillingLine['list_add']
                .$this->BillingLine['list_delete']
                .$this->BillingLine['list_edit']
            ."
            
            
            
            /*checkboxes*/
            
                
        /* PAGINATION */
        $('#BillingLinePager').bindPaging({
            tableName:'BillingLine'
            , parentId:'".$IdProject."'
            , uiTabsId:'{$uiTabsId}'
            , ajaxPageActParent:'".$this->virtualClassName."/BillingLine/$IdProject'
            , pui:'".$uiTabsId."'
        });  

        $(\"#{$uiTabsId} [th='sorted']\").bindSorting({
            modelName:'BillingLine',
            url:'".$this->virtualClassName."/BillingLine/$IdProject',
            destUi:'".$uiTabsId."'
        });
        
        $('#cntProjectChild .js-select-label').SelectBox();

        {$orderReadyJs}
        ";

        $return['onReadyJs'] .= "
                "
                . $this->hookListReadyJsBillingLine;
        return $return;
    }	
    /**
     * function getTimeLineList
     * @param string $IdProject
     * @param integer $page
     * @param string $uiTabsId
     * @param string $parentContainer
     * @param string $mja_list
     * @param array $search
     * @param array $params
     * @return string
     */
    public function getTimeLineList(String $IdProject, array $request)
    {

        $this->TableName = 'TimeLine';
        $altValue = array (
  'IdCostLine' => '',
  'IdProject' => '',
  'CalcId' => '',
  'Name' => '',
  'Date' => '',
  'Note' => '',
  'Quantity' => '',
  'Amount' => '',
  'Total' => '',
  'DateCreation' => '',
  'DateModification' => '',
  'IdGroupCreation' => '',
  'IdCreation' => '',
  'IdModification' => '',
);
        $dataObj = null;
        $search = ['order' => null, 'page' => null, ];
        $uiTabsId = (empty($request['cui'])) ? 'cntProjectChild' : $request['cui'];
        $parentContainer = $request['pc'];
        $orderReadyJs = '';
        $param = [];
        $total_child = '';

        // if Search params
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Project/TimeLine');

        // order
        $search['order'] = $this->setOrderVar($request['order'] ?? '', 'Project/TimeLine');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Project/TimeLine');
       
        
        

        /*column hide*/
        
        if($parentContainer == 'editDialog'){
            $diagNoClose = "diag:\"noclose\", ";
            $diagNoCloseEscaped = "diag:\\\"noclose\\\", ";
        }
        
        if(isset($this->Project['request']['noHeader']) && $this->Project['request']['noHeader'] == 'true'){
            $noHeader = "'noHeader':'true',";
        }
        
        $data['IdProject'] = $IdProject;
        if($dataObj == null){
            $dataObj = new Project();
            $dataObj->setIdProject($IdProject);
        }

        $this->TimeLine['list_add'] = "
        $('#TimeLineListForm #addTimeLine').bindEdit({
                modelName: 'TimeLine',
                destUi: 'editDialog',
                pc:'{$this->virtualClassName}',
                ip:'".$IdProject."',
                jet:'refreshChild',
                tp:'TimeLine',
                description: 'Time'
        });
        ";
        $this->TimeLine['list_delete'] = "
        $(\"[j='deleteTimeLine']\").bindDelete({
            modelName:'TimeLine',
            ui:'cntTimeLinedivChild',
            title: 'Time',
            message: '".addslashes(message_label('delete_row_confirm_msg') ?? '')."'
        });";

        if($_SESSION[_AUTH_VAR]->hasRights('TimeLine', 'r')){
            $this->TimeLine['list_edit'] = "
        $(\"#TimeLineTable tr td[j='editTimeLine']\").bind('click', function (){
            
        $('#editDialog').html( $('<div>').append( $('<img>').attr('src', '"._SITE_URL."public/img/Ellipsis-3.9s-200px.svg').css('width', '300px')).css('width', '300px').css('margin', 'auto') );
        $('#editDialog').dialog({width:'auto'}).dialog('open');
        $.get('"._SITE_URL."TimeLine/edit/'+$(this).attr('i'),
                { ip:'".$IdProject."', ui:'editDialog', pc:'{$this->virtualClassName}', je:'TimeLineTableCntnr', jet:'refreshChild', 'it-pos':$(this).data('iterator-pos') },
            function(data){ 
                dialogWidthClass($('#editDialog')); 
                $('#editDialog').html(data).dialog({width:'auto'});  
        });
        });";
        }

        #filters validation
        
        $filterKey = $IdProject;
        $this->IdPk = $IdProject;
        
        
        #main query
        
        // Normal query
        $maxPerPage = ( $request['maxperpage'] ) ? $request['maxperpage'] : $this->childMaxPerPage;
        $q = TimeLineQuery::create();
        
        
        $q 
            
            ->filterByIdProject( $filterKey );; 
               // Search
        
               // orderring
           
        if( is_array( $search['order'] ) ) {
            foreach ($search['order'] as $order) {
                foreach ($order as $col => $sens) {
                    if( $sens ) {
                        $tOrd = explode('.', $col);
                        $orderBy = "use" . $tOrd[0] . "Query";
                        if( $tOrd[1] && method_exists( $q, $orderBy )) {
                            $q->$orderBy( '', \Criteria::LEFT_JOIN )->orderBy( $tOrd[1], $sens )->endUse();
                        }elseif( method_exists( $q, 'filterBy' . $col )) {
                            $q->orderBy( $col, $sens );
                        }

                        $orderReadyJs .= "
                            $(\"#{$uiTabsId} [th='sorted'][c='".$col."'], #{$uiTabsId} [th='sorted'][rc='".$col."']\").attr('sens','".$sens."');
                            $(\"#{$uiTabsId} [th='sorted'][c='".$col."'], #{$uiTabsId} [th='sorted'][rc='".$col."']\").attr('order','on');
                        ";
                    }
                }
            }
        }
            // group by
           
        
            //custom hook
            if (method_exists($this, 'beforeChildSearchTimeLine')){ $this->beforeChildSearchTimeLine($q);}
        $this->queryObj = $q;
        
        $pmpoData =$q->paginate($search['page'], $maxPerPage);
        $resultsCount = $pmpoData->getNbResults();
        
            //custom hook
            if (method_exists($this, 'beforeChildListTimeLine')){ $this->beforeChildListTimeLine($q, $filterKey, $param);}
         
        #options building
        
        
        
          
        
        if(isset($this->Project['request']['noHeader']) && $this->Project['request']['noHeader'] == 'true'){
            $trSearch = "";
        }

        $actionRowHeader ='';
        if($_SESSION[_AUTH_VAR]->hasRights('TimeLine', 'd')){
            $actionRowHeader = th('&nbsp;', " r='delrow' class='actionrow' ");
        }

        $header = tr( th(_("Title"), " th='sorted' c='Name' title='" . _('Title')."' " . $param['th']['Name']."")
.th(_("Date"), " th='sorted' c='Date' title='" . _('Date')."' " . $param['th']['Date']."")
.th(_("Note"), " th='sorted' c='Note' title='" . _('Note')."' " . $param['th']['Note']."")
.th(_("Quantity"), " th='sorted' c='Quantity' title='" . _('Quantity')."' " . $param['th']['Quantity']."")
.th(_("Amount"), " th='sorted' c='Amount' title='" . _('Amount')."' " . $param['th']['Amount']."")
.th(_("Total"), " th='sorted' c='Total' title='" . _('Total')."' " . $param['th']['Total']."")
.'' . $actionRowHeader, " ln='TimeLine' class=''");

        

        $i=0;
        if( $pmpoData->isEmpty() ){
            $tr .= tr(	td(p(span(_("No Time found")),'class="no-results"'), "style='font-size:16px;' t='empty' ln='TimeLine' colspan='100%' "));
            
        }else{
            //$pcData = $pmpoData->getResults();
            foreach($pmpoData as $data){
                $this->listActionCellTimeLine = '';
                $actionRow = '';
                
            // custom hooks
            if (method_exists($this, 'startChildListRowTimeLine')){ $this->startChildListRowTimeLine($altValue, $data, $i, $param, $this, $hookListColumnsTimeLine, $actionRow);}
            
                
                
                if($_SESSION[_AUTH_VAR]->hasRights('TimeLine', 'd')){
                    $actionRow = htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteTimeLine' i='".json_encode($data->getPrimaryKey())."'");
                }
                
                
                
                
                
                $actionRow = $actionRow;
                $actionRow = (!empty($actionRow)) ? td($this->listActionCellTimeLine.$actionRow," class='actionrow'") : "";
                
                
                
                ;
                
                
                
                $tr .= $param['tr_before'].
                        tr(
                            (isset($hookListColumnsTimeLineFirst)?$hookListColumnsTimeLineFirst:'').
                            
                td(span((($altValue['Name']) ? $altValue['Name'] : $data->getName()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Name' class='' " . $param['Name']." j='editTimeLine'") . 
                td(span((($altValue['Date']) ? $altValue['Date'] : $data->getDate()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Date' class='' " . $param['Date']." j='editTimeLine'") . 
                td(span((($altValue['Note']) ? $altValue['Note'] : substr(strip_tags($data->getNote()), 0, 100)) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Note' class='' " . $param['Note']." j='editTimeLine'") . 
                td(span((($altValue['Quantity']) ? $altValue['Quantity'] : str_replace(',', '.', $data->getQuantity())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Quantity' class='right' " . $param['Quantity']." j='editTimeLine'") . 
                td(span((($altValue['Amount']) ? $altValue['Amount'] : str_replace(',', '.', $data->getAmount())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Amount' class='right' " . $param['Amount']." j='editTimeLine'") . 
                td(span((($altValue['Total']) ? $altValue['Total'] : str_replace(',', '.', $data->getTotal())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Total' class='right' " . $param['Total']." j='editTimeLine'") . 
                            (isset($hookListColumnsTimeLine)?$hookListColumnsTimeLine:'').
                            $actionRow
                        ,"id='TimeLineRow{$data->getPrimaryKey()}' rid='{$data->getPrimaryKey()}' ln='TimeLine' ".$param['tr']." ")
                        .$param['tr_after'];
                
                $i++;
            }
            
            
        }

    $add_button_child = 
                            div(
                                div(
                                    div($total_child,'','class="nolink"')
                            ,'trTimeLine'," ln='TimeLine' class=''").$this->cCMainTableHeader, '', "class='listHeaderItem' ");
    if(($_SESSION[_AUTH_VAR]->hasRights('TimeLine', 'a')) ){
        $add_button_child = htmlLink(span(_("Add")), "Javascript:","title='Add "._('Time')."' id='addTimeLine' class='button-link-blue add-button'");
    }

    //@PAGINATION
    $pagerRow = $this->getPager($pmpoData, $resultsCount, $search, true);

    $return['html'] =
            div(
                 $this->hookTimeLineListTop
                .div(
                    div($add_button_child
                    .$trSearch, '' ,'class="ac-list-form-header-child"')
                    .div(
                        div(
                            div(
                                table(	
                                    thead($header)
                                    .$tr
                                    .$this->hookTimeLineTableFooter
                                , "id='TimeLineTable' class='tablesorter'")
                            , 'childlistTimeLine')
                            .$this->hookTimeLineListBottom
                        ,'',' class="content" ')
                    ,'listFormChild',' class="ac-list" ')
                    .$pagerRow
                ,'TimeLineListForm')
            ,'cntTimeLinedivChild', "class='childListWrapper'");

            
            

            $return['onReadyJs'] =
                $this->hookListReadyJsFirstTimeLine
                .""
                .$this->TimeLine['list_add']
                .$this->TimeLine['list_delete']
                .$this->TimeLine['list_edit']
            ."
            
            
            
            /*checkboxes*/
            
                
        /* PAGINATION */
        $('#TimeLinePager').bindPaging({
            tableName:'TimeLine'
            , parentId:'".$IdProject."'
            , uiTabsId:'{$uiTabsId}'
            , ajaxPageActParent:'".$this->virtualClassName."/TimeLine/$IdProject'
            , pui:'".$uiTabsId."'
        });  

        $(\"#{$uiTabsId} [th='sorted']\").bindSorting({
            modelName:'TimeLine',
            url:'".$this->virtualClassName."/TimeLine/$IdProject',
            destUi:'".$uiTabsId."'
        });
        
        $('#cntProjectChild .js-select-label').SelectBox();

        {$orderReadyJs}
        ";

        $return['onReadyJs'] .= "
                "
                . $this->hookListReadyJsTimeLine;
        return $return;
    }
}
