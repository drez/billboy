<?php

namespace App;


/**
 *  @version 1.1
 *  Generated Form class on the 'Billing' table.
 *
 */
use Psr\Http\Message\ServerRequestInterface as Request;
use ApiGoat\Html\Tabs;
use ApiGoat\Utility\FormHelper as Helper;

class BillingForm extends Billing
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
        $this->model_name = 'Billing';
        $this->virtualClassName = 'Billing';
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

        $q = new BillingQuery();
        $q = $this->setAclFilter($q);
        if (method_exists($this, 'beforeListSearch')){ $this->beforeListSearch($q, $search);}

        if(is_array( $this->searchMs )){
            # main search form
            $q::create()
                
                #required billing
                ->leftJoinWith('Client')
                #default
                ->leftJoinWith('Project')
                #default
                ->leftJoinWith('BillingCategory');

        if( isset($this->searchMs['Type']) ) {
            $criteria = \Criteria::IN;
            $value = $this->searchMs['Type'];

            $q->filterByType($value, $criteria);
        }
        if( isset($this->searchMs['IdClient']) ) {
            $criteria = \Criteria::IN;
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
        if( isset($this->searchMs['State']) ) {
            $criteria = \Criteria::IN;
            $value = $this->searchMs['State'];

            $q->filterByState($value, $criteria);
        }
                
        }else{
            if(json_decode($IdParent)){
                        $q = new BillingQuery();
                        $pmpoData = $q::create()
                            ->filterBy(json_decode($IdParent))
                            
                #required billing
                ->leftJoinWith('Client')
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
                
                #required billing
                ->leftJoinWith('Client')
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
                                $(\"#BillingListForm [th='sorted'][c='".$col."']\").attr('sens', '".strtolower($sens)."')
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
                $trHead = th(_("State"), " th='sorted' c='State' title='" . _('State')."' ")
.th(_("Client"), " th='sorted' c='Client.Name' title='"._('Client.Name')."' ")
.th(_("Title"), " th='sorted' c='Title' title='" . _('Title')."' ")
.th(_("Project"), " th='sorted' c='Project.Name' title='"._('Project.Name')."' ")
.th(_("Date"), " th='sorted' c='Date' title='" . _('Date')."' ")
.th(_("Type"), " th='sorted' c='Type' title='" . _('Type')."' ")
.th(_("Gross"), " th='sorted' c='Gross' title='" . _('Gross')."' ")
.th(_("Currency"), " th='sorted' c='GrossCurrency' title='" . _('Currency')."' ")
.th(_("Gross"), " th='sorted' c='Gross2' title='" . _('Gross')."' ")
.th(_("Due date"), " th='sorted' c='DateDue' title='" . _('Due date')."' ")
.th(_("Paid date"), " th='sorted' c='DatePaid' title='" . _('Paid date')."' ")
.th(_("Net"), " th='sorted' c='Net' title='" . _('Net')."' ")
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
                
        $this->arrayIdClientOptions = $this->selectBoxBilling_IdClient($this, $emptyVar, $data);
        $this->arrayIdProjectOptions = $this->selectBoxBilling_IdProject($this, $emptyVar, $data);
        $this->arrayIdBillingCategoryOptions = $this->selectBoxBilling_IdBillingCategory($this, $emptyVar, $data);
                $data = [];
            

            $trSearch = button(span(_("Show search")),'class="trigger-search button-link-blue"')

            .div(
                form(div(selectboxCustomArray('Type[]', array( '0' => array('0'=>_("Quote"), '1'=>"Quote"),'1' => array('0'=>_("Bill"), '1'=>"Bill"), ), _('Type'), '  size="1" t="1"   multiple  ', $this->searchMs['Type']), '', 'class="multiple-select ac-search-item"').div(selectboxCustomArray('IdClient[]', $this->arrayIdClientOptions, 'Client' , "v='ID_CLIENT'  s='d' class='select-label js-select-label' multiple size='1'  ", $this->searchMs['IdClient'], '', false), '', ' class="ac-search-item multiple-select"').div(input('date', 'Date', $this->searchMs['Date'], '  j="date"  placeholder="'._('Date').'"',''),'','class="ac-search-item"').div(input('text', 'Title', $this->searchMs['Title'], '  placeholder="'._('Title').'"',''),'','class="ac-search-item"').div(selectboxCustomArray('State[]', array( '0' => array('0'=>_("New"), '1'=>"New"),'1' => array('0'=>_("Approved"), '1'=>"Approved"),'2' => array('0'=>_("Sent"), '1'=>"Sent"),'3' => array('0'=>_("Partial payment"), '1'=>"Partial payment"),'4' => array('0'=>_("Paid"), '1'=>"Paid"),'5' => array('0'=>_("Cancelled"), '1'=>"Cancelled"),'6' => array('0'=>_("To send"), '1'=>"To send"), ), _('State'), '  size="1" t="1"   multiple  ', $this->searchMs['State']), '', 'class="multiple-select ac-search-item"').$this->hookListSearchTop
                    .div(
                       button(span(_("Search")),'id="msBillingBt" title="'._('Search').'" class="icon search"')
                       .button(span(_("Clear")),' title="'._('Clear search').'" id="msBillingBtClear"')
                       .input('hidden', 'Seq', $data['Seq'] )
                    ,'','class="ac-search-item ac-action-buttons"')
                    ,"id='formMsBilling'")
            ,"", "  class='msSearchCtnr'");;
                return $trSearch;

            case 'add':
            ###### ADD
                if($_SESSION[_AUTH_VAR]->hasRights('Billing', 'a') && !$this->setReadOnly){
                
                                $this->listAddButton = htmlLink(
                                    _("Add new")
                                ,_SITE_URL.$this->virtualClassName."/edit/", "id='addBilling' title='"._('Add')."' class='button-link-blue add-button'");
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
        $this->TableName = 'Billing';
        $altValue = array (
  'IdBilling' => '',
  'CalcId' => '',
  'State' => '',
  'IdClient' => '',
  'Title' => '',
  'IdProject' => '',
  'IdBillingCategory' => '',
  'Date' => '',
  'Type' => '',
  'Gross' => '',
  'GrossCurrency' => '',
  'Gross2' => '',
  'Tax' => '',
  'DateDue' => '',
  'NoteBilling' => '',
  'DatePaid' => '',
  'Net' => '',
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
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Billing/');

        // order
        $this->searchOrder = $this->setOrderVar($request['order'] ?? '', 'Billing/');

        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Billing/');

        if (method_exists($this, 'beforeList')){ $this->beforeList($request, $pmpoDataIn );}
        
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
                if($_SESSION[_AUTH_VAR]->hasRights('Billing', 'd')){
                    $this->canDelete = htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteBilling' ");
                }
            }
        
            foreach($pcData as $data) {
                $this->listActionCell = '';
                    $total[6] += $data->getGross();
$total[11] += $data->getNet();

                
                
                                    $Client_Name = "";
                                    if($data->getClient()){
                                        $Client_Name = $data->getClient()->getName();
                                    }
                                    $Project_Name = "";
                                    if($data->getProject()){
                                        $Project_Name = $data->getProject()->getName();
                                    }
                if (method_exists($this, 'beforeListTr')){ $this->beforeListTr($altValue, $data, $i, $hook, $cCmoreCols);}
                

                $actionCell =  td($this->canDelete . $this->listActionCell, " class='actionrow' ");

                $tr .= $hook['tr_before'].tr(
                td(span((($altValue['State']) ? $altValue['State'] : isntPo($data->getState())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='State' class='center'  j='editBilling'") . 
                td(span((($altValue['IdClient']) ? $altValue['IdClient'] : $Client_Name) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdClient' class=''  j='editBilling'") . 
                td(span((($altValue['Title']) ? $altValue['Title'] : $data->getTitle()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Title' class=''  j='editBilling'") . 
                td(span((($altValue['IdProject']) ? $altValue['IdProject'] : $Project_Name) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdProject' class=''  j='editBilling'") . 
                td(span((($altValue['Date']) ? $altValue['Date'] : $data->getDate()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Date' class=''  j='editBilling'") . 
                td(span((($altValue['Type']) ? $altValue['Type'] : isntPo($data->getType())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Type' class='center'  j='editBilling'") . 
                td(span((($altValue['Gross']) ? $altValue['Gross'] : str_replace(',', '.', $data->getGross())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Gross' class='right'  j='editBilling'") . 
                td(span((($altValue['GrossCurrency']) ? $altValue['GrossCurrency'] : isntPo($data->getGrossCurrency())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='GrossCurrency' class='center'  j='editBilling'") . 
                td(span((($altValue['Gross2']) ? $altValue['Gross2'] : str_replace(',', '.', $data->getGross2())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Gross2' class='right'  j='editBilling'") . 
                td(span((($altValue['DateDue']) ? $altValue['DateDue'] : $data->getDateDue()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='DateDue' class=''  j='editBilling'") . 
                td(span((($altValue['DatePaid']) ? $altValue['DatePaid'] : $data->getDatePaid()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='DatePaid' class=''  j='editBilling'") . 
                td(span((($altValue['Net']) ? $altValue['Net'] : str_replace(',', '.', $data->getNet())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Net' class='right'  j='editBilling'") . $hook['td'].$cCmoreCols.$actionCell
                , " ".$hook['tr']."
                        rid='".json_encode($data->getPrimaryKey())."' data-iterator='".$pcData->getPosition()."'
                        r='data'
                        class='".$hook['class']." '
                        id='BillingRow".$data->getPrimaryKey()."'")
                .$hook['tr_after'];
                $i++;
                unset($altValue);
            }
            $tr .= input('hidden', 'rowCountBilling', $i);
        }

            $tr .= "".td('').td('').td('').td('').td('').td('').td(number_format($total[6], 2), "class='right total'").td('').td('').td('').td('').td(number_format($total[11], 2), "class='right total'");

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
                
                .div($controlsContent,'BillingControlsList', "class='custom-controls'")
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
                        table($trHead.$tr, "id='BillingTable' class='tablesorter' style='width:100%;'")
                     ,'',' class="content" ')
                ,'listForm',' class="ac-list" ')
                .$this->hookListBottom
                .$bottomRow
            , 'BillingListForm');

          #no parent

    $editUi = (empty($IdParent)) ? 'tabsContain' : 'editDialog';

    $editEvent .= "$(\"#BillingListForm td[j='editBilling']\").bindEdit({
                    modelName:'" . $this->virtualClassName . "',
                    destUi: '{$editUi}'
                });
                
    $(\"#BillingListForm [j='deleteBilling']\").bindDelete({
        modelName:'" . $this->virtualClassName . "',
        ui:'".$uiTabsId."',
        title: '".addslashes($this->tableDescription)."',
        message: '".addslashes(message_label('delete_row_confirm_msg'))."'
    });";

        $editEvent .= "
        $('#BillingPager').bindPaging({
            tableName:'Billing'
            ,uiTabsId:'".$uiTabsId."'
            ,ajaxPageActParent:'".$this->virtualClassName."'
        });
";



        $return['onReadyJs'] =
            $HelpDivJs
            
            ."
        

    $('#msBillingBt').click(function() {
        sw_message('".addslashes(_('Search in progress...'))."',false ,'search-progress', true);
        $('#msBillingBt button').attr('disabled', 'disabled');

        $.post('"._SITE_URL.$this->virtualClassName."', {ui: '".$uiTabsId."', ms:$('#formMsBilling').serialize() },  function(data){
            $('#".$uiTabsId."').html(data);
            $('#formMsBilling .js-select-label').SelectBox();
            $('#formMsBilling input[type=text]').first().focus();
            $('#formMsBilling input[type=text]').first().putCursorAtEnd();
            $('#msBillingBt button').attr('disabled', '');
            sw_message_remove('search-progress');
        });

        return false;
    });

    $('#formMsBilling').keydown(function(e) {
        if(e.which == 13) {
            $('#msBillingBt').click();
        }
    });

    $('#msBillingBtClear').bind('click', function (){
        sw_message('".addslashes(_('Search cleared...'))."', false,'search-reset', true);

        $.post('"._SITE_URL.$this->virtualClassName."', {ui: '".$uiTabsId."', ms:'clear' },  function(data){
                $('#".$uiTabsId."').html(data);
                $('#formMsBilling input[type=text]:first-of-type').focus().putCursorAtEnd();
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

        if($('#addBillingAutoc').length > 0) {
            $('#addBillingAutoc').bind('click', function () {
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
    public function setCreateDefaultsBilling($data)
    {

        unset($data['IdBilling']);
        $e = new Billing();
        
        
        if(!$data['State']){
            $data['State'] = "New";
        } 
        if(!$data['Type']){
            $data['Type'] = "Bill";
        } 
        if( $data['GrossCurrency'] == '' )unset($data['GrossCurrency']);
        $e->fromArray($data );

        #
        
        //foreign
        $e->setIdProject(( $data['IdProject'] == '' ) ? null : $data['IdProject']);
        //foreign
        $e->setIdBillingCategory(( $data['IdBillingCategory'] == '' ) ? null : $data['IdBillingCategory']);
        $e->setDate( ($data['Date'] == '' || $data['Date'] == 'null' || substr($data['Date'],0,10) == '-0001-11-30') ? null : $data['Date'] );
        //integer not required
        $e->setGross( ($data['Gross'] == '' ) ? null : $data['Gross']);
        $e->setGrossCurrency(($data['GrossCurrency'] == '' ) ? null : $data['GrossCurrency']);
        //integer not required
        $e->setGross2( ($data['Gross2'] == '' ) ? null : $data['Gross2']);
        //integer not required
        $e->setTax( ($data['Tax'] == '' ) ? null : $data['Tax']);
        $e->setDateDue( ($data['DateDue'] == '' || $data['DateDue'] == 'null' || substr($data['DateDue'],0,10) == '-0001-11-30') ? null : $data['DateDue'] );
        //integer not required
        $e->setNoteBilling( ($data['NoteBilling'] == '' ) ? null : $data['NoteBilling']);
        $e->setDatePaid( ($data['DatePaid'] == '' || $data['DatePaid'] == 'null' || substr($data['DatePaid'],0,10) == '-0001-11-30') ? null : $data['DatePaid'] );
        //integer not required
        $e->setNet( ($data['Net'] == '' ) ? null : $data['Net']);
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
    public function setUpdateDefaultsBilling($data)
    {

        
        $e = BillingQuery::create()->findPk(json_decode($data['i']));
        
        
        if(!$data['State']){
            $data['State'] = "New";
        } 
        if(!$data['Type']){
            $data['Type'] = "Bill";
        } 
        if( $data['GrossCurrency'] == '' )unset($data['GrossCurrency']);
        $e->fromArray($data );

        
        
        if( isset($data['IdProject']) ){
            $e->setIdProject(( $data['IdProject'] == '' ) ? null : $data['IdProject']);
        }
        if( isset($data['IdBillingCategory']) ){
            $e->setIdBillingCategory(( $data['IdBillingCategory'] == '' ) ? null : $data['IdBillingCategory']);
        }
        if(isset($data['Date'])){
            $e->setDate( ($data['Date'] == '' || $data['Date'] == 'null' || substr($data['Date'],0,10) == '-0001-11-30') ? null : $data['Date'] );
        }
        if(isset($data['Gross'])){
            $e->setGross( ($data['Gross'] == '' ) ? null : $data['Gross']);
        }
        if(isset($data['GrossCurrency'])){
            $e->setGrossCurrency(($data['GrossCurrency'] == '' ) ? null : $data['GrossCurrency']);
        }
        if(isset($data['Gross2'])){
            $e->setGross2( ($data['Gross2'] == '' ) ? null : $data['Gross2']);
        }
        if(isset($data['Tax'])){
            $e->setTax( ($data['Tax'] == '' ) ? null : $data['Tax']);
        }
        if(isset($data['DateDue'])){
            $e->setDateDue( ($data['DateDue'] == '' || $data['DateDue'] == 'null' || substr($data['DateDue'],0,10) == '-0001-11-30') ? null : $data['DateDue'] );
        }
        if(isset($data['DatePaid'])){
            $e->setDatePaid( ($data['DatePaid'] == '' || $data['DatePaid'] == 'null' || substr($data['DatePaid'],0,10) == '-0001-11-30') ? null : $data['DatePaid'] );
        }
        if(isset($data['Net'])){
            $e->setNet( ($data['Net'] == '' ) ? null : $data['Net']);
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
     * Produce a formated form of Billing
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

        $je = "BillingTable";

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
                case 'Project':
                    $data['IdProject'] = $data['ip'];
                    break;
                case 'BillingCategory':
                    $data['IdBillingCategory'] = $data['ip'];
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
        if(($_SESSION[_AUTH_VAR]->hasRights('Billing', 'a') and !$id ) || ( $_SESSION[_AUTH_VAR]->hasRights('Billing', 'w') and $id) || $this->setReadOnly) {
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
                $('#formBilling #saveBilling').unbind('click.saveBilling');
                $('#formBilling #saveBilling').remove();";
        }

        if($_SESSION[_AUTH_VAR]->hasRights('Billing', 'a') && !$this->setReadOnly) {
            $this->formAddButton = htmlLink(_("Add new"), 'Javascript:;' , "id='addBilling' title='"._('Add')."' class='button-link-blue add-button'");
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
            

            $q = BillingQuery::create()
            
                #required billing
                ->leftJoinWith('Client')
                #default
                ->leftJoinWith('Project')
                #default
                ->leftJoinWith('BillingCategory')
            ;
            


            $dataObj = $q->filterByIdBilling($id)->findOne();
            
        }
        
        if($dataObj == null){
            $this->Billing['isNew'] = 'yes';
        }
    
        
        
        if($dataObj == null){
            $dataObj = new Billing();
            $this->Billing['isNew'] = 'yes';
            if(is_array($data ))
               $dataObj->fromArray(array_filter($data));
            
        }else{
                $this->Billing['isNew'] = 'no';
        }
        $this->dataObj = $dataObj;
            
        


                                    ($dataObj->getClient())?'':$dataObj->setClient( new Client() );
                                    ($dataObj->getProject())?'':$dataObj->setProject( new Project() );
                                    ($dataObj->getBillingCategory())?'':$dataObj->setBillingCategory( new BillingCategory() );

        
        $this->arrayIdClientOptions = $this->selectBoxBilling_IdClient($this, $dataObj, $data);
        $this->arrayIdProjectOptions = $this->selectBoxBilling_IdProject($this, $dataObj, $data);
        $this->arrayIdBillingCategoryOptions = $this->selectBoxBilling_IdBillingCategory($this, $dataObj, $data);
        
        
        
        
        
        
$this->fields['Billing']['State']['html'] = stdFieldRow(_("State"), selectboxCustomArray('State', array( '0' => array('0'=>_("New"), '1'=>"New"),'1' => array('0'=>_("Approved"), '1'=>"Approved"),'2' => array('0'=>_("Sent"), '1'=>"Sent"),'3' => array('0'=>_("Partial payment"), '1'=>"Partial payment"),'4' => array('0'=>_("Paid"), '1'=>"Paid"),'5' => array('0'=>_("Cancelled"), '1'=>"Cancelled"),'6' => array('0'=>_("To send"), '1'=>"To send"), ), "", "s='d'  ", $dataObj->getState(), '', false), 'State', "", $this->commentsState, $this->commentsState_css, '', ' ', 'no');
$this->fields['Billing']['IdClient']['html'] = stdFieldRow(_("Client"), selectboxCustomArray('IdClient', $this->arrayIdClientOptions, "", "v='ID_CLIENT'  s='d'  val='".$dataObj->getIdClient()."'", $dataObj->getIdClient()), 'IdClient', "", $this->commentsIdClient, $this->commentsIdClient_css, '', ' ', 'no');
$this->fields['Billing']['Title']['html'] = stdFieldRow(_("Title"), input('text', 'Title', htmlentities($dataObj->getTitle()), "   placeholder='".str_replace("'","&#39;",_('Title'))."' size='35'  v='TITLE' s='d' class='req'  ")."", 'Title', "", $this->commentsTitle, $this->commentsTitle_css, '', ' ', 'no');
$this->fields['Billing']['IdProject']['html'] = stdFieldRow(_("Project"), selectboxCustomArray('IdProject', $this->arrayIdProjectOptions, _('Project'), "v='ID_PROJECT'  s='d'  val='".$dataObj->getIdProject()."'", $dataObj->getIdProject()), 'IdProject', "", $this->commentsIdProject, $this->commentsIdProject_css, '', ' ', 'no');
$this->fields['Billing']['IdBillingCategory']['html'] = stdFieldRow(_("Category"), selectboxCustomArray('IdBillingCategory', $this->arrayIdBillingCategoryOptions, _('Category'), "v='ID_BILLING_CATEGORY'  s='d'  val='".$dataObj->getIdBillingCategory()."'", $dataObj->getIdBillingCategory()), 'IdBillingCategory', "", $this->commentsIdBillingCategory, $this->commentsIdBillingCategory_css, '', ' ', 'no');
$this->fields['Billing']['Date']['html'] = stdFieldRow(_("Date"), input('date', 'Date', $dataObj->getDate(), "  j='date' autocomplete='off' placeholder='YYYY-MM-DD' size='10'  s='d' class=''"), 'Date', "", $this->commentsDate, $this->commentsDate_css, '', ' ', 'no');
$this->fields['Billing']['Type']['html'] = stdFieldRow(_("Type"), selectboxCustomArray('Type', array( '0' => array('0'=>_("Quote"), '1'=>"Quote"),'1' => array('0'=>_("Bill"), '1'=>"Bill"), ), "", "s='d'  ", $dataObj->getType(), '', false), 'Type', "", $this->commentsType, $this->commentsType_css, '', ' ', 'no');
$this->fields['Billing']['Gross']['html'] = stdFieldRow(_("Gross"), input('text', 'Gross', $dataObj->getGross(), "  placeholder='".str_replace("'","&#39;",_('Gross'))."'  v='GROSS' size='5' s='d' class=''"), 'Gross', "", $this->commentsGross, $this->commentsGross_css, '', ' ', 'no');
$this->fields['Billing']['GrossCurrency']['html'] = stdFieldRow(_("Currency"), selectboxCustomArray('GrossCurrency', array( '0' => array('0'=>_("CAD"), '1'=>"CAD"),'1' => array('0'=>_("AUS"), '1'=>"AUS"),'2' => array('0'=>_("SGD"), '1'=>"SGD"), ), _('Currency'), "s='d'  ", $dataObj->getGrossCurrency(), '', true), 'GrossCurrency', "", $this->commentsGrossCurrency, $this->commentsGrossCurrency_css, '', ' ', 'no');
$this->fields['Billing']['Gross2']['html'] = stdFieldRow(_("Gross"), input('text', 'Gross2', $dataObj->getGross2(), "  placeholder='".str_replace("'","&#39;",_('Gross'))."'  v='GROSS_2' size='5' s='d' class=''"), 'Gross2', "", $this->commentsGross2, $this->commentsGross2_css, '', ' ', 'no');
$this->fields['Billing']['Tax']['html'] = stdFieldRow(_("Tax"), input('text', 'Tax', $dataObj->getTax(), "  placeholder='".str_replace("'","&#39;",_('Tax'))."'  v='TAX' size='5' s='d' class=''"), 'Tax', "", $this->commentsTax, $this->commentsTax_css, '', ' ', 'no');
$this->fields['Billing']['DateDue']['html'] = stdFieldRow(_("Due date"), input('date', 'DateDue', $dataObj->getDateDue(), "  j='date' autocomplete='off' placeholder='YYYY-MM-DD' size='10'  s='d' class=''"), 'DateDue', "", $this->commentsDateDue, $this->commentsDateDue_css, '', ' ', 'no');
$this->fields['Billing']['NoteBilling']['html'] = stdFieldRow(_("Note"), textarea('NoteBilling', htmlentities($dataObj->getNoteBilling()) ,"placeholder='".str_replace("'","&#39;",_('Note'))."' cols='71' v='NOTE_BILLING' s='d'  class=' tinymce ' style='' spellcheck='false'"), 'NoteBilling', "", $this->commentsNoteBilling, $this->commentsNoteBilling_css, 'istinymce', ' ', 'no');
$this->fields['Billing']['DatePaid']['html'] = stdFieldRow(_("Paid date"), input('date', 'DatePaid', $dataObj->getDatePaid(), "  j='date' autocomplete='off' placeholder='YYYY-MM-DD' size='10'  s='d' class=''"), 'DatePaid', "", $this->commentsDatePaid, $this->commentsDatePaid_css, '', ' ', 'no');
$this->fields['Billing']['Net']['html'] = stdFieldRow(_("Net"), input('text', 'Net', $dataObj->getNet(), "  placeholder='".str_replace("'","&#39;",_('Net'))."'  v='NET' size='5' s='d' class=''"), 'Net', "", $this->commentsNet, $this->commentsNet_css, '', ' ', 'no');
$this->fields['Billing']['Reference']['html'] = stdFieldRow(_("Payment Reference"), input('text', 'Reference', htmlentities($dataObj->getReference()), "   placeholder='".str_replace("'","&#39;",_('Payment Reference'))."' size='35'  v='REFERENCE' s='d' class=''  ")."", 'Reference', "", $this->commentsReference, $this->commentsReference_css, '', ' ', 'no');


        $this->lockFormField(array(0=>'Gross',1=>'Tax',), $dataObj);

        // Whole form read only
        if($this->setReadOnly == 'all' ) {
            $this->lockFormField('all', $dataObj);
        }


        if( !isset($this->Billing['request']['ChildHide']) ) {

            # define child lists 'Entries'
            $ongletTab['0']['t'] = _('Entries');
            $ongletTab['0']['p'] = 'BillingLine';
            $ongletTab['0']['lkey'] = 'IdBilling';
            $ongletTab['0']['fkey'] = 'IdBilling';
            # define child lists 'Expense'
            $ongletTab['1']['t'] = _('Expense');
            $ongletTab['1']['p'] = 'CostLine';
            $ongletTab['1']['lkey'] = 'IdBilling';
            $ongletTab['1']['fkey'] = 'IdBilling';
            # define child lists 'Payment entry'
            $ongletTab['2']['t'] = _('Payment entry');
            $ongletTab['2']['p'] = 'PaymentLine';
            $ongletTab['2']['lkey'] = 'IdBilling';
            $ongletTab['2']['fkey'] = 'IdBilling';
        if(!empty($ongletTab) and $dataObj->getIdBilling()){
            foreach($ongletTab as $value){
                if($_SESSION[_AUTH_VAR]->hasRights($value['p'], 'r')){

                    $getLocalKey = "get".$value['lkey']."";
                    if($dataObj->$getLocalKey()){
                        $ChildOnglet .= li(
                                        htmlLink(	_($value['t'])
                                            ,'javascript:',"p='".$value['p']."' act='list' j=conglet_Billing ip='".$dataObj->$getLocalKey()."' class='ui-state-default' ")
                                    ,"  class='' j=sm  ");
                    }
                }
            }

            if($ChildOnglet){
                $childTable['onReadyJs'] ="
                     $('[j=conglet_Billing]').bind('click', function (data){
                         pp = $(this).attr('p');
                         $('#cntBillingChild').html( $('<img>').attr('src', '"._SITE_URL."public/img/Ellipsis-3.9s-200px.svg') );
                         $.get('"._SITE_URL."Billing/'+pp+'/'+$(this).attr('ip'), { ui: pp+'Table', 'pui':'".$uiTabsId."', pc:'".$data['pc']."'}, function(data){
                            $('#cntBillingChild').html(data);
                            $('[j=conglet_Billing]').parent().attr('class','ui-state-default');
                            $('[j=conglet_Billing][p='+pp+']').parent().attr('class',' ui-state-default ui-state-active');
                         });
                    });
                ";
                if($_SESSION['mem']['Billing']['child']['list'][$dataObj->$getLocalKey()]){
                    $onglet_p = $_SESSION['mem']['Billing']['child']['list'][$dataObj->$getLocalKey()];
                    $childTable['onReadyJs'] .= " $('[j=conglet_Billing][p=".$onglet_p."]').first().click();";
                }else{
                    $childTable['onReadyJs'] .= " $('[j=conglet_Billing]').first().click();";
                }
            }
        }
        }
        $ongletf =
            div(
                ul(li(htmlLink(_('Billing'),'#ogf_Billing',' j="ogf" p="Billing" class="ui-tabs-anchor" '))
                    .li(htmlLink(_('Note'),'#ogf_note_billing',' j="ogf" class="ui-tabs-anchor" p="Billing" '))
                    .li(htmlLink(_('Payment'),'#ogf_date_paid',' j="ogf" class="ui-tabs-anchor" p="Billing" ')))
            ,'cntOngletBilling',' class="cntOnglet"')
        ;
        
        if(!$this->setReadOnly){
            $this->formSaveBar = div(	div( input('button', 'saveBilling', _('Save'),' class="button-link-blue can-save"')
                                .input('hidden', 'formChangedBilling','', 'j="formChanged"')
                                .input('hidden', 'idPk', urlencode($id), "s='d'")
                            .input('hidden', 'IdBilling', $dataObj->getIdBilling(), " s='d' pk").input('hidden', 'IdGroupCreation', $dataObj->getIdGroupCreation(), " s='d' nodesc").input('hidden', 'IdCreation', $dataObj->getIdCreation(), " s='d' nodesc").input('hidden', 'IdModification', $dataObj->getIdModification(), " s='d' nodesc")
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
            $jqueryDatePicker = " $(\"#formBilling [j='date']\").attr('type', 'text');
            $(\"#formBilling [j='date']\").each(function(){
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
                div('Billing', '', "class='panel-heading'").
                $header_top_onglet.
                
                $this->hookFormInnerTop
                
                .
                    '<div id="ogf_Billing">'.
$this->fields['Billing']['State']['html']
.$this->fields['Billing']['IdClient']['html']
.$this->fields['Billing']['Title']['html']
.$this->fields['Billing']['IdProject']['html']
.$this->fields['Billing']['IdBillingCategory']['html']
.$this->fields['Billing']['Date']['html']
.$this->fields['Billing']['Type']['html']
.$this->fields['Billing']['Gross']['html']
.$this->fields['Billing']['GrossCurrency']['html']
.$this->fields['Billing']['Gross2']['html']
.$this->fields['Billing']['Tax']['html']
.$this->fields['Billing']['DateDue']['html']
.'</div><div id="ogf_note_billing"  class=" ui-tabs-panel">'
.$this->fields['Billing']['NoteBilling']['html']
.'</div><div id="ogf_date_paid"  class=" ui-tabs-panel">'
.$this->fields['Billing']['DatePaid']['html']
.$this->fields['Billing']['Net']['html']
.$this->fields['Billing']['Reference']['html'].'</div>'
                
                .$this->formSaveBar
                .$this->hookFormInnerBottom
            ,"divCntBilling", "class='divStdform' CntTabs=1 ".$this->ccStdFormOptions)
        , "id='formBilling' class='mainForm formContent' ")
        .$this->hookFormBottom;


        //if not new, show child table
        if($dataObj->getIdBilling()) {
            if($ChildOnglet) {
                $return['html'] .= div(
                                        div('Child(s)', '', "class='panel-heading'")
                                        . ul($ChildOnglet, " class=' ui-tabs-nav ' ")
                                        . div('','cntBillingChild',' class="" ')
                                    , 'pannelBilling', " class='child_pannel ui-tabs childCntClass'");
            }
        }

        if($id and $_SESSION['mem']['Billing']['ogf']) {
            $tabs_act = "$('[href=\"".$_SESSION['mem']['Billing']['ogf']."\"]').click();";
        }

        if($_SESSION['mem']['Billing']['ixmemautocapp'] and $_GET['Autocapp'] == 1) {
            $Autocapp = $_SESSION['mem']['Billing']['ixmemautocapp'];
            unset($_SESSION['mem']['Billing']['ixmemautocapp']);
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
        $('#formBilling .tinymce').each(function() {
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
            $(\"#formBilling [s='d'], #formBilling .js-select-label, #formBilling [j='autocomplete']\")
                .bindFormKeypress({modelName: '" . $this->virtualClassName . "'});
            $('#formBilling .js-select-label').SelectBox();
        }, 400);
        ";
        return $return;
    }

    function lockFormField($fields, $dataObj)
    {
        
        $this->fieldsRo['Billing']['State']['html'] = stdFieldRow(_("State"), div( $dataObj->getState(), 'State_label' , "class='readonly' s='d'")
                .input('hidden', 'State', $dataObj->getState(), "s='d'"), 'State', "", $this->commentsState, $this->commentsState_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['IdClient']['html'] = stdFieldRow(_("Client"), div( ($dataObj->getClient())?$dataObj->getClient()->getName():'', 'IdClient_label' , "class='readonly' s='d'")
                .input('hidden', 'IdClient', $dataObj->getIdClient(), "s='d'"), 'IdClient', "", $this->commentsIdClient, $this->commentsIdClient_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['Title']['html'] = stdFieldRow(_("Title"), div( $dataObj->getTitle(), 'Title_label' , "class='readonly' s='d'")
                .input('hidden', 'Title', $dataObj->getTitle(), "s='d'"), 'Title', "", $this->commentsTitle, $this->commentsTitle_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['IdProject']['html'] = stdFieldRow(_("Project"), div( ($dataObj->getProject())?$dataObj->getProject()->getName():'', 'IdProject_label' , "class='readonly' s='d'")
                .input('hidden', 'IdProject', $dataObj->getIdProject(), "s='d'"), 'IdProject', "", $this->commentsIdProject, $this->commentsIdProject_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['IdBillingCategory']['html'] = stdFieldRow(_("Category"), div( ($dataObj->getBillingCategory())?$dataObj->getBillingCategory()->getName():'', 'IdBillingCategory_label' , "class='readonly' s='d'")
                .input('hidden', 'IdBillingCategory', $dataObj->getIdBillingCategory(), "s='d'"), 'IdBillingCategory', "", $this->commentsIdBillingCategory, $this->commentsIdBillingCategory_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['Date']['html'] = stdFieldRow(_("Date"), div( $dataObj->getDate(), 'Date_label' , "class='readonly' s='d'")
                .input('hidden', 'Date', $dataObj->getDate(), "s='d'"), 'Date', "", $this->commentsDate, $this->commentsDate_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['Type']['html'] = stdFieldRow(_("Type"), div( $dataObj->getType(), 'Type_label' , "class='readonly' s='d'")
                .input('hidden', 'Type', $dataObj->getType(), "s='d'"), 'Type', "", $this->commentsType, $this->commentsType_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['Gross']['html'] = stdFieldRow(_("Gross"), div( $dataObj->getGross(), 'Gross_label' , "class='readonly' s='d'")
                .input('hidden', 'Gross', $dataObj->getGross(), "s='d'"), 'Gross', "", $this->commentsGross, $this->commentsGross_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['GrossCurrency']['html'] = stdFieldRow(_("Currency"), div( $dataObj->getGrossCurrency(), 'GrossCurrency_label' , "class='readonly' s='d'")
                .input('hidden', 'GrossCurrency', $dataObj->getGrossCurrency(), "s='d'"), 'GrossCurrency', "", $this->commentsGrossCurrency, $this->commentsGrossCurrency_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['Gross2']['html'] = stdFieldRow(_("Gross"), div( $dataObj->getGross2(), 'Gross2_label' , "class='readonly' s='d'")
                .input('hidden', 'Gross2', $dataObj->getGross2(), "s='d'"), 'Gross2', "", $this->commentsGross2, $this->commentsGross2_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['Tax']['html'] = stdFieldRow(_("Tax"), div( $dataObj->getTax(), 'Tax_label' , "class='readonly' s='d'")
                .input('hidden', 'Tax', $dataObj->getTax(), "s='d'"), 'Tax', "", $this->commentsTax, $this->commentsTax_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['DateDue']['html'] = stdFieldRow(_("Due date"), div( $dataObj->getDateDue(), 'DateDue_label' , "class='readonly' s='d'")
                .input('hidden', 'DateDue', $dataObj->getDateDue(), "s='d'"), 'DateDue', "", $this->commentsDateDue, $this->commentsDateDue_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['NoteBilling']['html'] = stdFieldRow(_("Note"), div( $dataObj->getNoteBilling(), 'NoteBilling_label' , "class='readonly' s='d'")
                .input('hidden', 'NoteBilling', $dataObj->getNoteBilling(), "s='d'"), 'NoteBilling', "", $this->commentsNoteBilling, $this->commentsNoteBilling_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['DatePaid']['html'] = stdFieldRow(_("Paid date"), div( $dataObj->getDatePaid(), 'DatePaid_label' , "class='readonly' s='d'")
                .input('hidden', 'DatePaid', $dataObj->getDatePaid(), "s='d'"), 'DatePaid', "", $this->commentsDatePaid, $this->commentsDatePaid_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['Net']['html'] = stdFieldRow(_("Net"), div( $dataObj->getNet(), 'Net_label' , "class='readonly' s='d'")
                .input('hidden', 'Net', $dataObj->getNet(), "s='d'"), 'Net', "", $this->commentsNet, $this->commentsNet_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Billing']['Reference']['html'] = stdFieldRow(_("Payment Reference"), div( $dataObj->getReference(), 'Reference_label' , "class='readonly' s='d'")
                .input('hidden', 'Reference', $dataObj->getReference(), "s='d'"), 'Reference', "", $this->commentsReference, $this->commentsReference_css, 'readonly', ' ', 'no');


        if($fields == 'all') {
            foreach($this->fields['Billing'] as $field => $ar) {
                $this->fields['Billing'][$field]['html'] = $this->fieldsRo['Billing'][$field]['html'];
            }
        } elseif(is_array($fields)) {
            foreach($fields as $field) {
                $this->fields['Billing'][$field]['html'] = $this->fieldsRo['Billing'][$field]['html'];
            }
        }
    }

    /**
     * Query for Billing_IdClient selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxBilling_IdClient(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
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
     * Query for Billing_IdProject selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxBilling_IdProject(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
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
     * Query for Billing_IdBillingCategory selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxBilling_IdBillingCategory(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
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
     * @param string $IdBilling
     * @param integer $page
     * @param string $uiTabsId
     * @param string $parentContainer
     * @param string $mja_list
     * @param array $search
     * @param array $params
     * @return string
     */
    public function getBillingLineList(String $IdBilling, array $request)
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
        $uiTabsId = (empty($request['cui'])) ? 'cntBillingChild' : $request['cui'];
        $parentContainer = $request['pc'];
        $orderReadyJs = '';
        $param = [];
        $total_child = '';

        // if Search params
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Billing/BillingLine');

        // order
        $search['order'] = $this->setOrderVar($request['order'] ?? '', 'Billing/BillingLine');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Billing/BillingLine');
       
        
                $search_child_default['WorkDate'] = 'DESC';
            if(empty($search['order'])){
                $search['order'] = [$search_child_default];
            }
        

        /*column hide*/
        
        if($parentContainer == 'editDialog'){
            $diagNoClose = "diag:\"noclose\", ";
            $diagNoCloseEscaped = "diag:\\\"noclose\\\", ";
        }
        
        if(isset($this->Billing['request']['noHeader']) && $this->Billing['request']['noHeader'] == 'true'){
            $noHeader = "'noHeader':'true',";
        }
        
        $data['IdBilling'] = $IdBilling;
        if($dataObj == null){
            $dataObj = new Billing();
            $dataObj->setIdBilling($IdBilling);
        }

        $this->BillingLine['list_add'] = "
        $('#BillingLineListForm #addBillingLine').bindEdit({
                modelName: 'BillingLine',
                destUi: 'editDialog',
                pc:'{$this->virtualClassName}',
                ip:'".$IdBilling."',
                jet:'refreshChild',
                tp:'BillingLine',
                description: 'Entries'
        });
        ";
        $this->BillingLine['list_delete'] = "
        $(\"[j='deleteBillingLine']\").bindDelete({
            modelName:'BillingLine',
            ui:'cntBillingLinedivChild',
            title: 'Entries',
            message: '".addslashes(message_label('delete_row_confirm_msg') ?? '')."'
        });";

        if($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'r')){
            $this->BillingLine['list_edit'] = "
        $(\"#BillingLineTable tr td[j='editBillingLine']\").bind('click', function (){
            
        $('#editDialog').html( $('<div>').append( $('<img>').attr('src', '"._SITE_URL."public/img/Ellipsis-3.9s-200px.svg').css('width', '300px')).css('width', '300px').css('margin', 'auto') );
        $('#editDialog').dialog({width:'auto'}).dialog('open');
        $.get('"._SITE_URL."BillingLine/edit/'+$(this).attr('i'),
                { ip:'".$IdBilling."', ui:'editDialog', pc:'{$this->virtualClassName}', je:'BillingLineTableCntnr', jet:'refreshChild', 'it-pos':$(this).data('iterator-pos') },
            function(data){ 
                dialogWidthClass($('#editDialog')); 
                $('#editDialog').html(data).dialog({width:'auto'});  
        });
        });";
        }

        #filters validation
        
        $filterKey = $IdBilling;
        $this->IdPk = $IdBilling;
        
        $data = [];
            
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
            
            ->filterByIdBilling( $filterKey );; 
               // Search

        if($this->searchMs['IdAssign'] == '_null' || $this->searchMs['IdAssign'] == '_null') {
            $q->filterByIdAssign( null );
        } else
        if( isset($this->searchMs['IdAssign']) ) {
            $criteria = \Criteria::EQUAL;
            $value = $this->searchMs['IdAssign'];

            $q->filterByIdAssign($value, $criteria);
        }
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
        
        
          

            $trSearch = button(span(_("Show search")),'class="trigger-search button-link-blue"')

            .div(
                form(div(selectboxCustomArray('IdAssign', $this->arrayIdAssignOptions, 'Assigned to' , "v='ID_ASSIGN'  s='d' ", $this->searchMs['IdAssign'], '', true), '', ' class="ac-search-item "').$this->hookListSearchTop
                    .div(
                       button(span(_("Search")),'id="msBillingLineBt" title="'._('Search').'" class="icon search"')
                       .button(span(_("Clear")),' title="'._('Clear search').'" id="msBillingLineBtClear"')
                       .input('hidden', 'Seq', $data['Seq'] )
                    ,'','class="ac-search-item ac-action-buttons"')
                    ,"id='formMsBillingLine'")
            ,"", "  class='msSearchCtnr'");
        if(isset($this->Billing['request']['noHeader']) && $this->Billing['request']['noHeader'] == 'true'){
            $trSearch = "";
        }

        $actionRowHeader ='';
        if($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'd')){
            $actionRowHeader = th('&nbsp;', " r='delrow' class='actionrow' ");
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
                    $actionRow = htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteBillingLine' i='".json_encode($data->getPrimaryKey())."'");
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
                    $total[6] += $data->getTotal();

                $i++;
            }
            
                $tr .= "".td('').td('').td('').td('').td('').td('').td(number_format($total[6], 2), "class='right total'").td('').td('');
        }

    $add_button_child = 
                            div(
                                div(
                                    div($total_child,'','class="nolink"')
                            ,'trBillingLine'," ln='BillingLine' class=''").$this->cCMainTableHeader, '', "class='listHeaderItem' ");
    if(($_SESSION[_AUTH_VAR]->hasRights('BillingLine', 'a')) ){
        $add_button_child = htmlLink(span(_("Add")), "Javascript:","title='Add "._('Entries')."' id='addBillingLine' class='button-link-blue add-button'");
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
                ."
        $('#formMsProspect input').each(function (i, e){
            if($(e).val() != ''){
                colorField( $(e).attr('id'), 'hsl(196, 100%, 92%)');
            }
        });"
                .$this->BillingLine['list_add']
                .$this->BillingLine['list_delete']
                .$this->BillingLine['list_edit']
            ."

    $('#msBillingLineBt').click(function() {
        sw_message('".addslashes(_('Search in progress...'))."',false ,'search-progress', true);
        $('#msBillingLineBt button').attr('disabled', 'disabled');

        $.post('"._SITE_URL.$this->virtualClassName."/BillingLine/".$IdBilling."', {ui: '".$uiTabsId."', ms:$('#formMsBillingLine').serialize() },  function(data){
            $('#".$uiTabsId."').html(data);
            $('#formMsBillingLine .js-select-label').SelectBox();
            $('#formMsBillingLine input[type=text]').first().focus();
            $('#formMsBillingLine input[type=text]').first().putCursorAtEnd();
            $('#msBillingLineBt button').attr('disabled', '');
            sw_message_remove('search-progress');
        });

        return false;
    });

    $('#formMsBillingLine').keydown(function(e) {
        if(e.which == 13) {
            $('#msBillingLineBt').click();
        }
    });

    $('#msBillingLineBtClear').bind('click', function (){
        sw_message('".addslashes(_('Search cleared...'))."', false,'search-reset', true);

        $.post('"._SITE_URL.$this->virtualClassName."/BillingLine/".$IdBilling."', {ui: '".$uiTabsId."', ms:'clear' },  function(data){
                $('#".$uiTabsId."').html(data);
                $('#formMsBillingLine input[type=text]:first-of-type').focus().putCursorAtEnd();
                sw_message_remove('search-reset');
        });

        return false;
    });
        
            
            
            /*checkboxes*/
            
                
        /* PAGINATION */
        $('#BillingLinePager').bindPaging({
            tableName:'BillingLine'
            , parentId:'".$IdBilling."'
            , uiTabsId:'{$uiTabsId}'
            , ajaxPageActParent:'".$this->virtualClassName."/BillingLine/$IdBilling'
            , pui:'".$uiTabsId."'
        });  

        $(\"#{$uiTabsId} [th='sorted']\").bindSorting({
            modelName:'BillingLine',
            url:'".$this->virtualClassName."/BillingLine/$IdBilling',
            destUi:'".$uiTabsId."'
        });
        
        $('#cntBillingChild .js-select-label').SelectBox();

        {$orderReadyJs}
        ";

        $return['onReadyJs'] .= "
                "
                . $this->hookListReadyJsBillingLine;
        return $return;
    }

    /**
     * Query for CostLine_IdSupplier selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxCostLine_IdSupplier(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = SupplierQuery::create();

    if(method_exists($this, 'beginSelectboxCostLine_IdSupplier') and $array)
        $ret = $this->beginSelectboxCostLine_IdSupplier($q, $dataObj, $data, $obj);
    if($ret !== false)
            $q->select(array('Name', 'IdSupplier'));
            $q->orderBy('Name', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }

                if(function_exists('selectboxDataCostLine_IdSupplier')){ $this->selectboxDataCostLine_IdSupplier($pcDataO, $q); }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }

    /**
     * Query for CostLine_IdProject selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxCostLine_IdProject(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = ProjectQuery::create();

    if(method_exists($this, 'beginSelectboxCostLine_IdProject') and $array)
        $ret = $this->beginSelectboxCostLine_IdProject($q, $dataObj, $data, $obj);
    if($ret !== false)
            $q->select(array('Name', 'IdProject'));
            $q->orderBy('Name', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }

                if(function_exists('selectboxDataCostLine_IdProject')){ $this->selectboxDataCostLine_IdProject($pcDataO, $q); }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }

    /**
     * Query for CostLine_IdBillingCategory selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxCostLine_IdBillingCategory(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = BillingCategoryQuery::create();

    if(method_exists($this, 'beginSelectboxCostLine_IdBillingCategory') and $array)
        $ret = $this->beginSelectboxCostLine_IdBillingCategory($q, $dataObj, $data, $obj);
    if($ret !== false)
            $q->select(array('Name', 'IdBillingCategory'));
            $q->orderBy('Name', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }

                if(function_exists('selectboxDataCostLine_IdBillingCategory')){ $this->selectboxDataCostLine_IdBillingCategory($pcDataO, $q); }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }	
    /**
     * function getCostLineList
     * @param string $IdBilling
     * @param integer $page
     * @param string $uiTabsId
     * @param string $parentContainer
     * @param string $mja_list
     * @param array $search
     * @param array $params
     * @return string
     */
    public function getCostLineList(String $IdBilling, array $request)
    {

        $this->TableName = 'CostLine';
        $altValue = array (
  'IdCostLine' => '',
  'IdBilling' => '',
  'CalcId' => '',
  'Title' => '',
  'IdSupplier' => '',
  'InvoiceNo' => '',
  'IdProject' => '',
  'IdBillingCategory' => '',
  'SpendDate' => '',
  'Recuring' => '',
  'RenewalDate' => '',
  'Quantity' => '',
  'Amount' => '',
  'Total' => '',
  'Bill' => '',
  'NoteBillingLigne' => '',
  'DateCreation' => '',
  'DateModification' => '',
  'IdGroupCreation' => '',
  'IdCreation' => '',
  'IdModification' => '',
);
        $dataObj = null;
        $search = ['order' => null, 'page' => null, ];
        $uiTabsId = (empty($request['cui'])) ? 'cntBillingChild' : $request['cui'];
        $parentContainer = $request['pc'];
        $orderReadyJs = '';
        $param = [];
        $total_child = '';

        // if Search params
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Billing/CostLine');

        // order
        $search['order'] = $this->setOrderVar($request['order'] ?? '', 'Billing/CostLine');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Billing/CostLine');
       
        
        

        /*column hide*/
        
        if($parentContainer == 'editDialog'){
            $diagNoClose = "diag:\"noclose\", ";
            $diagNoCloseEscaped = "diag:\\\"noclose\\\", ";
        }
        
        if(isset($this->Billing['request']['noHeader']) && $this->Billing['request']['noHeader'] == 'true'){
            $noHeader = "'noHeader':'true',";
        }
        
        $data['IdBilling'] = $IdBilling;
        if($dataObj == null){
            $dataObj = new Billing();
            $dataObj->setIdBilling($IdBilling);
        }

        $this->CostLine['list_add'] = "
        $('#CostLineListForm #addCostLine').bindEdit({
                modelName: 'CostLine',
                destUi: 'editDialog',
                pc:'{$this->virtualClassName}',
                ip:'".$IdBilling."',
                jet:'refreshChild',
                tp:'CostLine',
                description: 'Expense'
        });
        ";
        $this->CostLine['list_delete'] = "
        $(\"[j='deleteCostLine']\").bindDelete({
            modelName:'CostLine',
            ui:'cntCostLinedivChild',
            title: 'Expense',
            message: '".addslashes(message_label('delete_row_confirm_msg') ?? '')."'
        });";

        if($_SESSION[_AUTH_VAR]->hasRights('CostLine', 'r')){
            $this->CostLine['list_edit'] = "
        $(\"#CostLineTable tr td[j='editCostLine']\").bind('click', function (){
            
        $('#editDialog').html( $('<div>').append( $('<img>').attr('src', '"._SITE_URL."public/img/Ellipsis-3.9s-200px.svg').css('width', '300px')).css('width', '300px').css('margin', 'auto') );
        $('#editDialog').dialog({width:'auto'}).dialog('open');
        $.get('"._SITE_URL."CostLine/edit/'+$(this).attr('i'),
                { ip:'".$IdBilling."', ui:'editDialog', pc:'{$this->virtualClassName}', je:'CostLineTableCntnr', jet:'refreshChild', 'it-pos':$(this).data('iterator-pos') },
            function(data){ 
                dialogWidthClass($('#editDialog')); 
                $('#editDialog').html(data).dialog({width:'auto'});  
        });
        });";
        }

        #filters validation
        
        $filterKey = $IdBilling;
        $this->IdPk = $IdBilling;
        
        
        #main query
        
        // Normal query
        $maxPerPage = ( $request['maxperpage'] ) ? $request['maxperpage'] : $this->childMaxPerPage;
        $q = CostLineQuery::create();
        
        
        $q
                #default
                ->leftJoinWith('Supplier')
                #default
                ->leftJoinWith('Project')
                #default
                ->leftJoinWith('BillingCategory') 
            
            ->filterByIdBilling( $filterKey );; 
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
            if (method_exists($this, 'beforeChildSearchCostLine')){ $this->beforeChildSearchCostLine($q);}
        $this->queryObj = $q;
        
        $pmpoData =$q->paginate($search['page'], $maxPerPage);
        $resultsCount = $pmpoData->getNbResults();
        
            //custom hook
            if (method_exists($this, 'beforeChildListCostLine')){ $this->beforeChildListCostLine($q, $filterKey, $param);}
         
        #options building
        
        $this->arrayIdSupplierOptions = $this->selectBoxCostLine_IdSupplier($this, $dataObj, $data);
        $this->arrayIdProjectOptions = $this->selectBoxCostLine_IdProject($this, $dataObj, $data);
        $this->arrayIdBillingCategoryOptions = $this->selectBoxCostLine_IdBillingCategory($this, $dataObj, $data);
        
        
          
        
        if(isset($this->Billing['request']['noHeader']) && $this->Billing['request']['noHeader'] == 'true'){
            $trSearch = "";
        }

        $actionRowHeader ='';
        if($_SESSION[_AUTH_VAR]->hasRights('CostLine', 'd')){
            $actionRowHeader = th('&nbsp;', " r='delrow' class='actionrow' ");
        }

        $header = tr( th(_("Title"), " th='sorted' c='Title' title='" . _('Title')."' " . $param['th']['Title']."")
.th(_("Supplier"), " th='sorted' c='Supplier.Name' title='"._('Supplier.Name')."' " . $param['th']['IdSupplier']."")
.th(_("Invoice no."), " th='sorted' c='InvoiceNo' title='" . _('Invoice no.')."' " . $param['th']['InvoiceNo']."")
.th(_("Project"), " th='sorted' c='Project.Name' title='"._('Project.Name')."' " . $param['th']['IdProject']."")
.th(_("Category"), " th='sorted' c='BillingCategory.Name' title='"._('BillingCategory.Name')."' " . $param['th']['IdBillingCategory']."")
.th(_("Date"), " th='sorted' c='SpendDate' title='" . _('Date')."' " . $param['th']['SpendDate']."")
.th(_("Recuring"), " th='sorted' c='Recuring' title='" . _('Recuring')."' " . $param['th']['Recuring']."")
.th(_("Renewal date"), " th='sorted' c='RenewalDate' title='" . _('Renewal date')."' " . $param['th']['RenewalDate']."")
.th(_("Quantity"), " th='sorted' c='Quantity' title='" . _('Quantity')."' " . $param['th']['Quantity']."")
.th(_("Amount"), " th='sorted' c='Amount' title='" . _('Amount')."' " . $param['th']['Amount']."")
.th(_("Total"), " th='sorted' c='Total' title='" . _('Total')."' " . $param['th']['Total']."")
.th(_("Add to bill"), " th='sorted' c='Bill' title='" . _('Add to bill')."' " . $param['th']['Bill']."")
.th(_("Note"), " th='sorted' c='NoteBillingLigne' title='" . _('Note')."' " . $param['th']['NoteBillingLigne']."")
.'' . $actionRowHeader, " ln='CostLine' class=''");

        

        $i=0;
        if( $pmpoData->isEmpty() ){
            $tr .= tr(	td(p(span(_("No Expense found")),'class="no-results"'), "style='font-size:16px;' t='empty' ln='CostLine' colspan='100%' "));
            
        }else{
            //$pcData = $pmpoData->getResults();
            foreach($pmpoData as $data){
                $this->listActionCellCostLine = '';
                $actionRow = '';
                
            // custom hooks
            if (method_exists($this, 'startChildListRowCostLine')){ $this->startChildListRowCostLine($altValue, $data, $i, $param, $this, $hookListColumnsCostLine, $actionRow);}
            
                
                
                if($_SESSION[_AUTH_VAR]->hasRights('CostLine', 'd')){
                    $actionRow = htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteCostLine' i='".json_encode($data->getPrimaryKey())."'");
                }
                
                
                
                
                
                $actionRow = $actionRow;
                $actionRow = (!empty($actionRow)) ? td($this->listActionCellCostLine.$actionRow," class='actionrow'") : "";
                
                                    $Supplier_Name = "";
                                    if($data->getSupplier()){
                                        $Supplier_Name = $data->getSupplier()->getName();
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
                            (isset($hookListColumnsCostLineFirst)?$hookListColumnsCostLineFirst:'').
                            
                td(span((($altValue['Title']) ? $altValue['Title'] : $data->getTitle()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Title' class='' " . $param['Title']." j='editCostLine'") . 
                td(span((($altValue['IdSupplier']) ? $altValue['IdSupplier'] : $Supplier_Name) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdSupplier' class='' " . $param['IdSupplier']." j='editCostLine'") . 
                td(span((($altValue['InvoiceNo']) ? $altValue['InvoiceNo'] : $data->getInvoiceNo()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='InvoiceNo' class='' " . $param['InvoiceNo']." j='editCostLine'") . 
                td(span((($altValue['IdProject']) ? $altValue['IdProject'] : $Project_Name) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdProject' class='' " . $param['IdProject']." j='editCostLine'") . 
                td(span((($altValue['IdBillingCategory']) ? $altValue['IdBillingCategory'] : $BillingCategory_Name) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdBillingCategory' class='' " . $param['IdBillingCategory']." j='editCostLine'") . 
                td(span((($altValue['SpendDate']) ? $altValue['SpendDate'] : $data->getSpendDate()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='SpendDate' class='' " . $param['SpendDate']." j='editCostLine'") . 
                td(span((($altValue['Recuring']) ? $altValue['Recuring'] : isntPo($data->getRecuring())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Recuring' class='center' " . $param['Recuring']." j='editCostLine'") . 
                td(span((($altValue['RenewalDate']) ? $altValue['RenewalDate'] : $data->getRenewalDate()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='RenewalDate' class='' " . $param['RenewalDate']." j='editCostLine'") . 
                td(span((($altValue['Quantity']) ? $altValue['Quantity'] : str_replace(',', '.', $data->getQuantity())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Quantity' class='right' " . $param['Quantity']." j='editCostLine'") . 
                td(span((($altValue['Amount']) ? $altValue['Amount'] : str_replace(',', '.', $data->getAmount())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Amount' class='right' " . $param['Amount']." j='editCostLine'") . 
                td(span((($altValue['Total']) ? $altValue['Total'] : str_replace(',', '.', $data->getTotal())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Total' class='right' " . $param['Total']." j='editCostLine'") . 
                td(span((($altValue['Bill']) ? $altValue['Bill'] : isntPo($data->getBill())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Bill' class='center' " . $param['Bill']." j='editCostLine'") . 
                td(span((($altValue['NoteBillingLigne']) ? $altValue['NoteBillingLigne'] : substr(strip_tags($data->getNoteBillingLigne()), 0, 100)) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='NoteBillingLigne' class='' " . $param['NoteBillingLigne']." j='editCostLine'") . 
                            (isset($hookListColumnsCostLine)?$hookListColumnsCostLine:'').
                            $actionRow
                        ,"id='CostLineRow{$data->getPrimaryKey()}' rid='{$data->getPrimaryKey()}' ln='CostLine' ".$param['tr']." ")
                        .$param['tr_after'];
                
                $i++;
            }
            
            
        }

    $add_button_child = 
                            div(
                                div(
                                    div($total_child,'','class="nolink"')
                            ,'trCostLine'," ln='CostLine' class=''").$this->cCMainTableHeader, '', "class='listHeaderItem' ");
    if(($_SESSION[_AUTH_VAR]->hasRights('CostLine', 'a')) ){
        $add_button_child = htmlLink(span(_("Add")), "Javascript:","title='Add "._('Expense')."' id='addCostLine' class='button-link-blue add-button'");
    }

    //@PAGINATION
    $pagerRow = $this->getPager($pmpoData, $resultsCount, $search, true);

    $return['html'] =
            div(
                 $this->hookCostLineListTop
                .div(
                    div($add_button_child
                    .$trSearch, '' ,'class="ac-list-form-header-child"')
                    .div(
                        div(
                            div(
                                table(	
                                    thead($header)
                                    .$tr
                                    .$this->hookCostLineTableFooter
                                , "id='CostLineTable' class='tablesorter'")
                            , 'childlistCostLine')
                            .$this->hookCostLineListBottom
                        ,'',' class="content" ')
                    ,'listFormChild',' class="ac-list" ')
                    .$pagerRow
                ,'CostLineListForm')
            ,'cntCostLinedivChild', "class='childListWrapper'");

            
            

            $return['onReadyJs'] =
                $this->hookListReadyJsFirstCostLine
                .""
                .$this->CostLine['list_add']
                .$this->CostLine['list_delete']
                .$this->CostLine['list_edit']
            ."
            
            
            
            /*checkboxes*/
            
                
        /* PAGINATION */
        $('#CostLinePager').bindPaging({
            tableName:'CostLine'
            , parentId:'".$IdBilling."'
            , uiTabsId:'{$uiTabsId}'
            , ajaxPageActParent:'".$this->virtualClassName."/CostLine/$IdBilling'
            , pui:'".$uiTabsId."'
        });  

        $(\"#{$uiTabsId} [th='sorted']\").bindSorting({
            modelName:'CostLine',
            url:'".$this->virtualClassName."/CostLine/$IdBilling',
            destUi:'".$uiTabsId."'
        });
        
        $('#cntBillingChild .js-select-label').SelectBox();

        {$orderReadyJs}
        ";

        $return['onReadyJs'] .= "
                "
                . $this->hookListReadyJsCostLine;
        return $return;
    }

    /**
     * Query for PaymentLine_IdBilling selectBox 
     * @param object $obj
     * @param object $dataObj
     * @param array $data
    **/
    public function selectBoxPaymentLine_IdBilling(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = BillingQuery::create();

    if(method_exists($this, 'beginSelectboxPaymentLine_IdBilling') and $array)
        $ret = $this->beginSelectboxPaymentLine_IdBilling($q, $dataObj, $data, $obj);
    if($ret !== false)
            $q->join('Client client');
            $q->addAsColumn('selDisplay', 'CONCAT_WS ( ", ", client.Name, '.BillingPeer::TITLE.', '.BillingPeer::DATE.' )');
            $q->select(array('selDisplay', 'IdBilling'));
            $q->orderBy('selDisplay', 'ASC');
        
            if(!$array){
                return $q;
            }else{
                $pcDataO = $q->find();
            }

                if(function_exists('selectboxDataPaymentLine_IdBilling')){ $this->selectboxDataPaymentLine_IdBilling($pcDataO, $q); }


        $arrayOpt = $pcDataO->toArray();

        return assocToNum($arrayOpt , true);
    }	
    /**
     * function getPaymentLineList
     * @param string $IdBilling
     * @param integer $page
     * @param string $uiTabsId
     * @param string $parentContainer
     * @param string $mja_list
     * @param array $search
     * @param array $params
     * @return string
     */
    public function getPaymentLineList(String $IdBilling, array $request)
    {

        $this->TableName = 'PaymentLine';
        $altValue = array (
  'IdPaymentLine' => '',
  'IdBilling' => '',
  'Reference' => '',
  'Date' => '',
  'Note' => '',
  'Amount' => '',
  'DateCreation' => '',
  'DateModification' => '',
  'IdGroupCreation' => '',
  'IdCreation' => '',
  'IdModification' => '',
);
        $dataObj = null;
        $search = ['order' => null, 'page' => null, ];
        $uiTabsId = (empty($request['cui'])) ? 'cntBillingChild' : $request['cui'];
        $parentContainer = $request['pc'];
        $orderReadyJs = '';
        $param = [];
        $total_child = '';

        // if Search params
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Billing/PaymentLine');

        // order
        $search['order'] = $this->setOrderVar($request['order'] ?? '', 'Billing/PaymentLine');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Billing/PaymentLine');
       
        
        

        /*column hide*/
        
        if($parentContainer == 'editDialog'){
            $diagNoClose = "diag:\"noclose\", ";
            $diagNoCloseEscaped = "diag:\\\"noclose\\\", ";
        }
        
        if(isset($this->Billing['request']['noHeader']) && $this->Billing['request']['noHeader'] == 'true'){
            $noHeader = "'noHeader':'true',";
        }
        
        $data['IdBilling'] = $IdBilling;
        if($dataObj == null){
            $dataObj = new Billing();
            $dataObj->setIdBilling($IdBilling);
        }

        $this->PaymentLine['list_add'] = "
        $('#PaymentLineListForm #addPaymentLine').bindEdit({
                modelName: 'PaymentLine',
                destUi: 'editDialog',
                pc:'{$this->virtualClassName}',
                ip:'".$IdBilling."',
                jet:'refreshChild',
                tp:'PaymentLine',
                description: 'Payment entry'
        });
        ";
        $this->PaymentLine['list_delete'] = "
        $(\"[j='deletePaymentLine']\").bindDelete({
            modelName:'PaymentLine',
            ui:'cntPaymentLinedivChild',
            title: 'Payment entry',
            message: '".addslashes(message_label('delete_row_confirm_msg') ?? '')."'
        });";

        if($_SESSION[_AUTH_VAR]->hasRights('PaymentLine', 'r')){
            $this->PaymentLine['list_edit'] = "
        $(\"#PaymentLineTable tr td[j='editPaymentLine']\").bind('click', function (){
            
        $('#editDialog').html( $('<div>').append( $('<img>').attr('src', '"._SITE_URL."public/img/Ellipsis-3.9s-200px.svg').css('width', '300px')).css('width', '300px').css('margin', 'auto') );
        $('#editDialog').dialog({width:'auto'}).dialog('open');
        $.get('"._SITE_URL."PaymentLine/edit/'+$(this).attr('i'),
                { ip:'".$IdBilling."', ui:'editDialog', pc:'{$this->virtualClassName}', je:'PaymentLineTableCntnr', jet:'refreshChild', 'it-pos':$(this).data('iterator-pos') },
            function(data){ 
                dialogWidthClass($('#editDialog')); 
                $('#editDialog').html(data).dialog({width:'auto'});  
        });
        });";
        }

        #filters validation
        
        $filterKey = $IdBilling;
        $this->IdPk = $IdBilling;
        
        
        #main query
        
        // Normal query
        $maxPerPage = ( $request['maxperpage'] ) ? $request['maxperpage'] : $this->childMaxPerPage;
        $q = PaymentLineQuery::create();
        
        
        $q
                #default
                ->leftJoinWith('Billing') 
            
            ->filterByIdBilling( $filterKey );; 
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
            if (method_exists($this, 'beforeChildSearchPaymentLine')){ $this->beforeChildSearchPaymentLine($q);}
        $this->queryObj = $q;
        
        $pmpoData =$q->paginate($search['page'], $maxPerPage);
        $resultsCount = $pmpoData->getNbResults();
        
            //custom hook
            if (method_exists($this, 'beforeChildListPaymentLine')){ $this->beforeChildListPaymentLine($q, $filterKey, $param);}
         
        #options building
        
        $this->arrayIdBillingOptions = $this->selectBoxPaymentLine_IdBilling($this, $dataObj, $data);
        
        
          
        
        if(isset($this->Billing['request']['noHeader']) && $this->Billing['request']['noHeader'] == 'true'){
            $trSearch = "";
        }

        $actionRowHeader ='';
        if($_SESSION[_AUTH_VAR]->hasRights('PaymentLine', 'd')){
            $actionRowHeader = th('&nbsp;', " r='delrow' class='actionrow' ");
        }

        $header = tr( th(_("Client name"), " th='sorted' c='Billing.Name' title='"._('Billing.Name')."' " . $param['th']['IdBilling']."")
.th(_("Date"), " th='sorted' c='Date' title='" . _('Date')."' " . $param['th']['Date']."")
.th(_("Note"), " th='sorted' c='Note' title='" . _('Note')."' " . $param['th']['Note']."")
.th(_("Amount"), " th='sorted' c='Amount' title='" . _('Amount')."' " . $param['th']['Amount']."")
.'' . $actionRowHeader, " ln='PaymentLine' class=''");

        

        $i=0;
        if( $pmpoData->isEmpty() ){
            $tr .= tr(	td(p(span(_("No Payment entry found")),'class="no-results"'), "style='font-size:16px;' t='empty' ln='PaymentLine' colspan='100%' "));
            
        }else{
            //$pcData = $pmpoData->getResults();
            foreach($pmpoData as $data){
                $this->listActionCellPaymentLine = '';
                $actionRow = '';
                
            // custom hooks
            if (method_exists($this, 'startChildListRowPaymentLine')){ $this->startChildListRowPaymentLine($altValue, $data, $i, $param, $this, $hookListColumnsPaymentLine, $actionRow);}
            
                
                
                if($_SESSION[_AUTH_VAR]->hasRights('PaymentLine', 'd')){
                    $actionRow = htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deletePaymentLine' i='".json_encode($data->getPrimaryKey())."'");
                }
                
                
                
                
                
                $actionRow = $actionRow;
                $actionRow = (!empty($actionRow)) ? td($this->listActionCellPaymentLine.$actionRow," class='actionrow'") : "";
                
        $altValue['Billing_Client_Name'] = "";
        if($data->getBilling() ){
            if($data->getBilling()->getClient() )
                $altValue['Billing_Client_Name'] = $data->getBilling()->getClient()->getName();
        }
                
                
                ;
                
                
                
                $tr .= $param['tr_before'].
                        tr(
                            (isset($hookListColumnsPaymentLineFirst)?$hookListColumnsPaymentLineFirst:'').
                            
                td(span((($altValue['IdBilling']) ? $altValue['IdBilling'] : $altValue['Billing_Client_Name']) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdBilling' class='' " . $param['IdBilling']." j='editPaymentLine'") . 
                td(span((($altValue['Date']) ? $altValue['Date'] : $data->getDate()) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Date' class='' " . $param['Date']." j='editPaymentLine'") . 
                td(span((($altValue['Note']) ? $altValue['Note'] : substr(strip_tags($data->getNote()), 0, 100)) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Note' class='' " . $param['Note']." j='editPaymentLine'") . 
                td(span((($altValue['Amount']) ? $altValue['Amount'] : str_replace(',', '.', $data->getAmount())) ?? ''." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Amount' class='right' " . $param['Amount']." j='editPaymentLine'") . 
                            (isset($hookListColumnsPaymentLine)?$hookListColumnsPaymentLine:'').
                            $actionRow
                        ,"id='PaymentLineRow{$data->getPrimaryKey()}' rid='{$data->getPrimaryKey()}' ln='PaymentLine' ".$param['tr']." ")
                        .$param['tr_after'];
                
                $i++;
            }
            
            
        }

    $add_button_child = 
                            div(
                                div(
                                    div($total_child,'','class="nolink"')
                            ,'trPaymentLine'," ln='PaymentLine' class=''").$this->cCMainTableHeader, '', "class='listHeaderItem' ");
    if(($_SESSION[_AUTH_VAR]->hasRights('PaymentLine', 'a')) ){
        $add_button_child = htmlLink(span(_("Add")), "Javascript:","title='Add "._('Payment entry')."' id='addPaymentLine' class='button-link-blue add-button'");
    }

    //@PAGINATION
    $pagerRow = $this->getPager($pmpoData, $resultsCount, $search, true);

    $return['html'] =
            div(
                 $this->hookPaymentLineListTop
                .div(
                    div($add_button_child
                    .$trSearch, '' ,'class="ac-list-form-header-child"')
                    .div(
                        div(
                            div(
                                table(	
                                    thead($header)
                                    .$tr
                                    .$this->hookPaymentLineTableFooter
                                , "id='PaymentLineTable' class='tablesorter'")
                            , 'childlistPaymentLine')
                            .$this->hookPaymentLineListBottom
                        ,'',' class="content" ')
                    ,'listFormChild',' class="ac-list" ')
                    .$pagerRow
                ,'PaymentLineListForm')
            ,'cntPaymentLinedivChild', "class='childListWrapper'");

            
            

            $return['onReadyJs'] =
                $this->hookListReadyJsFirstPaymentLine
                .""
                .$this->PaymentLine['list_add']
                .$this->PaymentLine['list_delete']
                .$this->PaymentLine['list_edit']
            ."
            
            
            
            /*checkboxes*/
            
                
        /* PAGINATION */
        $('#PaymentLinePager').bindPaging({
            tableName:'PaymentLine'
            , parentId:'".$IdBilling."'
            , uiTabsId:'{$uiTabsId}'
            , ajaxPageActParent:'".$this->virtualClassName."/PaymentLine/$IdBilling'
            , pui:'".$uiTabsId."'
        });  

        $(\"#{$uiTabsId} [th='sorted']\").bindSorting({
            modelName:'PaymentLine',
            url:'".$this->virtualClassName."/PaymentLine/$IdBilling',
            destUi:'".$uiTabsId."'
        });
        
        $('#cntBillingChild .js-select-label').SelectBox();

        {$orderReadyJs}
        ";

        $return['onReadyJs'] .= "
                "
                . $this->hookListReadyJsPaymentLine;
        return $return;
    }
}
