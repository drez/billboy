<?php

namespace App;


/**
 *  @version 1.1
 *  Generated Form class on the 'TimeLine' table.
 *
 */
use Psr\Http\Message\ServerRequestInterface as Request;
use ApiGoat\Utility\FormHelper as Helper;

class TimeLineForm extends TimeLine
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
        $this->model_name = 'TimeLine';
        $this->virtualClassName = 'TimeLine';
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

        $q = new TimeLineQuery();
        $q = $this->setAclFilter($q);
        if (method_exists($this, 'beforeListSearch')){ $this->beforeListSearch($q, $search);}

        if(is_array( $this->searchMs )){
            # main search form
            $q::create()
                ;
                
                
        }else{
            if(json_decode($IdParent)){
                        $q = new TimeLineQuery();
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
                                $(\"#TimeLineListForm [th='sorted'][c='".$col."']\").attr('sens', '".strtolower($sens)."')
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
                $trHead = th(_("Title"), " th='sorted' c='Name' title='" . _('Title')."' ")
.th(_("Date"), " th='sorted' c='Date' title='" . _('Date')."' ")
.th(_("Note"), " th='sorted' c='Note' title='" . _('Note')."' ")
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
                if($_SESSION[_AUTH_VAR]->hasRights('TimeLine', 'a') && !$this->setReadOnly){
                
                                $this->listAddButton = htmlLink(
                                    _("Add new")
                                ,_SITE_URL.$this->virtualClassName."/edit/", "id='addTimeLine' title='"._('Add')."' class='button-link-blue add-button'");
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
        $tr = '';
        $hook = [];
        $editEvent = '';
        $return = ['html', 'js', 'onReadyJs'];
        $cCmoreCols = '';

        

        $this->uiTabsId = $uiTabsId;

        
        $this->IdParent = $IdParent;

        // if Search params
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'TimeLine/');

        // order
        $this->searchOrder = $this->setOrderVar($request['order'] ?? '', 'TimeLine/');

        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'TimeLine/');

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
                if($_SESSION[_AUTH_VAR]->hasRights('TimeLine', 'd')){
                    $this->canDelete = htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteTimeLine' ");
                }
            }
        
            foreach($pcData as $data) {
                $this->listActionCell = '';
                
                

                if (method_exists($this, 'beforeListTr')){ $this->beforeListTr($altValue, $data, $i, $hook, $cCmoreCols);}
                

                $actionCell =  td($this->canDelete . $this->listActionCell, " class='actionrow' ");

                $tr .= $hook['tr_before'].tr(
                td(span((($altValue['Name']) ? $altValue['Name'] : $data->getName()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Name' class=''  j='editTimeLine'") . 
                td(span((($altValue['Date']) ? $altValue['Date'] : $data->getDate()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Date' class=''  j='editTimeLine'") . 
                td(span((($altValue['Note']) ? $altValue['Note'] : substr(strip_tags($data->getNote()), 0, 100)) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Note' class=''  j='editTimeLine'") . 
                td(span((($altValue['Quantity']) ? $altValue['Quantity'] : str_replace(',', '.', $data->getQuantity())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Quantity' class='right'  j='editTimeLine'") . 
                td(span((($altValue['Amount']) ? $altValue['Amount'] : str_replace(',', '.', $data->getAmount())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Amount' class='right'  j='editTimeLine'") . 
                td(span((($altValue['Total']) ? $altValue['Total'] : str_replace(',', '.', $data->getTotal())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Total' class='right'  j='editTimeLine'") . $hook['td'].$cCmoreCols.$actionCell
                , " ".$hook['tr']."
                        rid='".json_encode($data->getPrimaryKey())."' data-iterator='".$pcData->getPosition()."'
                        r='data'
                        class='".$hook['class']." '
                        id='TimeLineRow".$data->getPrimaryKey()."'")
                .$hook['tr_after'];
                $i++;
                unset($altValue);
            }
            $tr .= input('hidden', 'rowCountTimeLine', $i);
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
                
                .div($controlsContent,'TimeLineControlsList', "class='custom-controls'")
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
                        table($trHead.$tr, "id='TimeLineTable' class='tablesorter' style='width:100%;'")
                     ,'',' class="content" ')
                ,'listForm',' class="ac-list" ')
                .$this->hookListBottom
                .$bottomRow
            , 'TimeLineListForm');

          #no parent

    $editUi = (empty($IdParent)) ? 'tabsContain' : 'editDialog';

    $editEvent .= "$(\"#TimeLineListForm td[j='editTimeLine']\").bindEdit({
                    modelName:'" . $this->virtualClassName . "',
                    destUi: '{$editUi}'
                });
                
    $(\"#TimeLineListForm [j='deleteTimeLine']\").bindDelete({
        modelName:'" . $this->virtualClassName . "',
        ui:'".$uiTabsId."',
        title: '".addslashes($this->tableDescription)."',
        message: '".addslashes(message_label('delete_row_confirm_msg'))."'
    });";

        $editEvent .= "
        $('#TimeLinePager').bindPaging({
            tableName:'TimeLine'
            ,uiTabsId:'".$uiTabsId."'
            ,ajaxPageActParent:'".$this->virtualClassName."'
        });
";



        $return['onReadyJs'] =
            $HelpDivJs
            
            ."
        
        
        
        $('#tabsContain .js-select-label').SelectBox();
        ".$this->hookListReadyJsFirst.$editEvent."
       $(\"#{$uiTabsId} [th='sorted']\").bindSorting({
            modelName:'".$this->virtualClassName."',
            destUi:'".$uiTabsId."'
        });

        if($('#addTimeLineAutoc').length > 0) {
            $('#addTimeLineAutoc').bind('click', function () {
                $.post('"._SITE_URL."GuiManager', {a:'ixmemautoc', p:'{$this->virtualClassName}',}, function(data) {
                    document.location = '"._SITE_URL.$this->virtualClassName."/edit/';
                });
            });
        }
        
        
        ".$this->orderReadyJsOrder."
        ".$this->hookListReadyJs;
        $return['js'] .= "";
        return $return;
    }
    /*
    *	Make sure default value are set before save
    */
    public function setCreateDefaultsTimeLine($data)
    {

        unset($data['IdCostLine']);
        $e = new TimeLine();
        
        
        $e->fromArray($data );

        #
        
        $e->setDate( ($data['Date'] == '' || $data['Date'] == 'null' || substr($data['Date'],0,10) == '-0001-11-30') ? null : $data['Date'] );
        //integer not required
        $e->setNote( ($data['Note'] == '' ) ? null : $data['Note']);
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
    public function setUpdateDefaultsTimeLine($data)
    {

        
        $e = TimeLineQuery::create()->findPk(json_decode($data['i']));
        
        
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
     * Produce a formated form of TimeLine
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

        $je = "TimeLineTable";

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
                
                case 'Project':
                    $data['IdProject'] = $data['ip'];
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
        if(($_SESSION[_AUTH_VAR]->hasRights('TimeLine', 'a') and !$id ) || ( $_SESSION[_AUTH_VAR]->hasRights('TimeLine', 'w') and $id) || $this->setReadOnly) {
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
                $('#formTimeLine #saveTimeLine').unbind('click.saveTimeLine');
                $('#formTimeLine #saveTimeLine').remove();";
        }

        if($_SESSION[_AUTH_VAR]->hasRights('TimeLine', 'a') && !$this->setReadOnly) {
            $this->formAddButton = htmlLink(_("Add new"), 'Javascript:;' , "id='addTimeLine' title='"._('Add')."' class='button-link-blue add-button'");
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
            

            $q = TimeLineQuery::create()
            
            ;
            


            $dataObj = $q->filterByIdCostLine($id)->findOne();
            
        }
        
        if($dataObj == null){
            $this->TimeLine['isNew'] = 'yes';
        }
    
        
        
        if($dataObj == null){
            $dataObj = new TimeLine();
            $this->TimeLine['isNew'] = 'yes';
            if(is_array($data ))
               $dataObj->fromArray(array_filter($data));
            
        }else{
                $this->TimeLine['isNew'] = 'no';
        }
        $this->dataObj = $dataObj;
            
        



        
        
        
        
        
        
        
$this->fields['TimeLine']['Name']['html'] = stdFieldRow(_("Title"), input('text', 'Name', htmlentities($dataObj->getName()), "   placeholder='".str_replace("'","&#39;",_('Title'))."' size='35'  v='NAME' s='d' class=''  ")."", 'Name', "", $this->commentsName, $this->commentsName_css, '', ' ', 'no');
$this->fields['TimeLine']['Date']['html'] = stdFieldRow(_("Date"), input('date', 'Date', $dataObj->getDate(), "  j='date' autocomplete='off' placeholder='YYYY-MM-DD' size='10'  s='d' class='' title='Date'"), 'Date', "", $this->commentsDate, $this->commentsDate_css, '', ' ', 'no');
$this->fields['TimeLine']['Note']['html'] = stdFieldRow(_("Note"), textarea('Note', htmlentities($dataObj->getNote()) ,"placeholder='".str_replace("'","&#39;",_('Note'))."' cols='71' v='NOTE' s='d'  class=' ' style='' spellcheck='false'"), 'Note', "", $this->commentsNote, $this->commentsNote_css, '', ' ', 'no');
$this->fields['TimeLine']['Quantity']['html'] = stdFieldRow(_("Quantity"), input('text', 'Quantity', $dataObj->getQuantity(), "  placeholder='".str_replace("'","&#39;",_('Quantity'))."'  v='QUANTITY' size='5' s='d' class=''"), 'Quantity', "", $this->commentsQuantity, $this->commentsQuantity_css, '', ' ', 'no');
$this->fields['TimeLine']['Amount']['html'] = stdFieldRow(_("Amount"), input('text', 'Amount', $dataObj->getAmount(), "  placeholder='".str_replace("'","&#39;",_('Amount'))."'  v='AMOUNT' size='5' s='d' class='req'"), 'Amount', "", $this->commentsAmount, $this->commentsAmount_css, '', ' ', 'no');
$this->fields['TimeLine']['Total']['html'] = stdFieldRow(_("Total"), input('text', 'Total', $dataObj->getTotal(), "  placeholder='".str_replace("'","&#39;",_('Total'))."'  v='TOTAL' size='5' s='d' class=''"), 'Total', "", $this->commentsTotal, $this->commentsTotal_css, '', ' ', 'no');


        $this->lockFormField(array(0=>'Total',), $dataObj);

        // Whole form read only
        if($this->setReadOnly == 'all' ) {
            $this->lockFormField('all', $dataObj);
        }

        
        
        
        if(!$this->setReadOnly){
            $this->formSaveBar = div(	div( input('button', 'saveTimeLine', _('Save'),' class="button-link-blue can-save"')
                                .input('hidden', 'formChangedTimeLine','', 'j="formChanged"')
                                .input('hidden', 'idPk', urlencode($id), "s='d'")
                            .input('hidden', 'IdCostLine', $dataObj->getIdCostLine(), " s='d' pk").input('hidden', 'IdProject', $dataObj->getIdProject(), " s='d' nodesc").input('hidden', 'IdGroupCreation', $dataObj->getIdGroupCreation(), " s='d' nodesc").input('hidden', 'IdCreation', $dataObj->getIdCreation(), " s='d' nodesc").input('hidden', 'IdModification', $dataObj->getIdModification(), " s='d' nodesc")
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
            $jqueryDatePicker = " $(\"#formTimeLine [j='date']\").attr('type', 'text');
            $(\"#formTimeLine [j='date']\").each(function(){
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
                div('Time', '', "class='panel-heading'").
                $header_top_onglet.
                
                $this->hookFormInnerTop
                
                .
$this->fields['TimeLine']['Name']['html']
.$this->fields['TimeLine']['Date']['html']
.$this->fields['TimeLine']['Note']['html']
.$this->fields['TimeLine']['Quantity']['html']
.$this->fields['TimeLine']['Amount']['html']
.$this->fields['TimeLine']['Total']['html']
                
                .$this->formSaveBar
                .$this->hookFormInnerBottom
            ,"divCntTimeLine", "class='divStdform' CntTabs=1 ".$this->ccStdFormOptions)
        , "id='formTimeLine' class='mainForm formContent' ")
        .$this->hookFormBottom;


        

        if($id and $_SESSION['mem']['TimeLine']['ogf']) {
            $tabs_act = "$('[href=\"".$_SESSION['mem']['TimeLine']['ogf']."\"]').click();";
        }

        if($_SESSION['mem']['TimeLine']['ixmemautocapp'] and $_GET['Autocapp'] == 1) {
            $Autocapp = $_SESSION['mem']['TimeLine']['ixmemautocapp'];
            unset($_SESSION['mem']['TimeLine']['ixmemautocapp']);
        }

        $return['data'] .= $data;
        $return['js'] .= $childTable['js']
        . script($this->hookFormIncludeJs) ."
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
            $(\"#formTimeLine [s='d'], #formTimeLine .js-select-label, #formTimeLine [j='autocomplete']\")
                .bindFormKeypress({modelName: '" . $this->virtualClassName . "'});
            $('#formTimeLine .js-select-label').SelectBox();
        }, 400);
        ";
        return $return;
    }

    function lockFormField($fields, $dataObj)
    {
        
        $this->fieldsRo['TimeLine']['Name']['html'] = stdFieldRow(_("Title"), div( $dataObj->getName(), 'Name_label' , "class='readonly' s='d'")
                .input('hidden', 'Name', $dataObj->getName(), "s='d'"), 'Name', "", $this->commentsName, $this->commentsName_css, 'readonly', ' ', 'no');

        $this->fieldsRo['TimeLine']['Date']['html'] = stdFieldRow(_("Date"), div( $dataObj->getDate(), 'Date_label' , "class='readonly' s='d'")
                .input('hidden', 'Date', $dataObj->getDate(), "s='d'"), 'Date', "", $this->commentsDate, $this->commentsDate_css, 'readonly', ' ', 'no');

        $this->fieldsRo['TimeLine']['Note']['html'] = stdFieldRow(_("Note"), div( $dataObj->getNote(), 'Note_label' , "class='readonly' s='d'")
                .input('hidden', 'Note', $dataObj->getNote(), "s='d'"), 'Note', "", $this->commentsNote, $this->commentsNote_css, 'readonly', ' ', 'no');

        $this->fieldsRo['TimeLine']['Quantity']['html'] = stdFieldRow(_("Quantity"), div( $dataObj->getQuantity(), 'Quantity_label' , "class='readonly' s='d'")
                .input('hidden', 'Quantity', $dataObj->getQuantity(), "s='d'"), 'Quantity', "", $this->commentsQuantity, $this->commentsQuantity_css, 'readonly', ' ', 'no');

        $this->fieldsRo['TimeLine']['Amount']['html'] = stdFieldRow(_("Amount"), div( $dataObj->getAmount(), 'Amount_label' , "class='readonly' s='d'")
                .input('hidden', 'Amount', $dataObj->getAmount(), "s='d'"), 'Amount', "", $this->commentsAmount, $this->commentsAmount_css, 'readonly', ' ', 'no');

        $this->fieldsRo['TimeLine']['Total']['html'] = stdFieldRow(_("Total"), div( $dataObj->getTotal(), 'Total_label' , "class='readonly' s='d'")
                .input('hidden', 'Total', $dataObj->getTotal(), "s='d'"), 'Total', "", $this->commentsTotal, $this->commentsTotal_css, 'readonly', ' ', 'no');


        if($fields == 'all') {
            foreach($this->fields['TimeLine'] as $field => $ar) {
                $this->fields['TimeLine'][$field]['html'] = $this->fieldsRo['TimeLine'][$field]['html'];
            }
        } elseif(is_array($fields)) {
            foreach($fields as $field) {
                $this->fields['TimeLine'][$field]['html'] = $this->fieldsRo['TimeLine'][$field]['html'];
            }
        }
    }
}
