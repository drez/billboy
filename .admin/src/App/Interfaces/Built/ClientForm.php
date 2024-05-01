<?php

namespace App;


/**
 *  @version 1.1
 *  Generated Form class on the 'Client' table.
 *  
 */
use Psr\Http\Message\ServerRequestInterface as Request;
use ApiGoat\Html\Tabs;
use ApiGoat\Utility\FormHelper as Helper;

class ClientForm extends Client
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
        $this->model_name = 'Client';
        $this->virtualClassName = 'Client';
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

        $q = new ClientQuery();
        $q = $this->setAclFilter($q);
        

        if(is_array( $this->searchMs )){
            # main search form
            $q::create()
                
                #required client
                ->leftJoinWith('Country');
                
                
        }else{
            
            ## standard list
            $hasParent = json_decode($IdParent);
            if(empty($hasParent)) {
                $q::create()
                
                #required client
                ->leftJoinWith('Country');
                
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
                                $(\"#ClientListForm [th='sorted'][c='".$col."']\").attr('sens', '".strtolower($sens)."')
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
                $trHead = th(_("Name"), " th='sorted' c='Name' title='" . _('Name')."' ")
.th(_("Country"), " th='sorted' c='Country.Name' title='"._('Country.Name')."' ")
.th(_("Phone"), " th='sorted' c='Phone' title='" . _('Phone')."' ")
.th(_("Phone work"), " th='sorted' c='PhoneWork' title='" . _('Phone work')."' ")
.th(_("Extension"), " th='sorted' c='Ext' title='" . _('Extension')."' ")
.th(_("Email"), " th='sorted' c='Email' title='" . _('Email')."' ")
.th(_("Contact"), " th='sorted' c='Contact' title='" . _('Contact')."' ")
.th(_("Email (contact)"), " th='sorted' c='Email2' title='" . _('Email (contact)')."' ")
.th(_("contact"), " th='sorted' c='PhoneMobile' title='" . _('contact')."' ")
.th(_("Address 1"), " th='sorted' c='Address1' title='" . _('Address 1')."' ")
.th(_("Address 2"), " th='sorted' c='Address2' title='" . _('Address 2')."' ")
.th(_("Address 3"), " th='sorted' c='Address3' title='" . _('Address 3')."' ")
.th(_("Zip"), " th='sorted' c='Zip' title='" . _('Zip')."' ")
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
                
        $this->arrayIdCountryOptions = $this->selectBoxClient_IdCountry($this, $emptyVar, $data);
                
                ;
                return $trSearch;

            case 'add':
            ###### ADD
                if($_SESSION[_AUTH_VAR]->hasRights('Client', 'a') && !$this->setReadOnly){
                
                                $this->listAddButton = htmlLink(
                                    _("Add new")
                                ,_SITE_URL.$this->virtualClassName."/edit/", "id='addClient' title='"._('Add')."' class='button-link-blue add-button'");
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
        $this->TableName = 'Client';
        $altValue = array (
  'IdClient' => '',
  'Name' => '',
  'IdCountry' => '',
  'Phone' => '',
  'PhoneWork' => '',
  'Ext' => '',
  'Email' => '',
  'Contact' => '',
  'Email2' => '',
  'PhoneMobile' => '',
  'Website' => '',
  'Address1' => '',
  'Address2' => '',
  'Address3' => '',
  'Zip' => '',
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
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Client/');

        // order
        $this->searchOrder = $this->setOrderVar($request['order'] ?? '', 'Client/');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Client/');

        
        
        
        
        
        

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
                if($_SESSION[_AUTH_VAR]->hasRights('Client', 'd')){
                    $this->canDelete = true;
                }
            }
        
            foreach($pcData as $data) {
                $this->listActionCell = '';
                
                
                
                                    $Country_Name = "";
                                    if($data->getCountry()){
                                        $Country_Name = $data->getCountry()->getName();
                                    }
                    

                $actionCell =  td(
        htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteClient' ") . $this->listActionCell, " class='actionrow' ");

                $tr .= tr(
                td(span(\htmlentities((($altValue['Name']) ? $altValue['Name'] : $data->getName()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Name' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['IdCountry']) ? $altValue['IdCountry'] : $Country_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdCountry' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['Phone']) ? $altValue['Phone'] : $data->getPhone()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Phone' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['PhoneWork']) ? $altValue['PhoneWork'] : $data->getPhoneWork()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='PhoneWork' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['Ext']) ? $altValue['Ext'] : $data->getExt()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Ext' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['Email']) ? $altValue['Email'] : $data->getEmail()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Email' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['Contact']) ? $altValue['Contact'] : $data->getContact()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Contact' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['Email2']) ? $altValue['Email2'] : $data->getEmail2()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Email2' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['PhoneMobile']) ? $altValue['PhoneMobile'] : $data->getPhoneMobile()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='PhoneMobile' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['Address1']) ? $altValue['Address1'] : substr(strip_tags($data->getAddress1()), 0, 100)) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Address1' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['Address2']) ? $altValue['Address2'] : substr(strip_tags($data->getAddress2()), 0, 100)) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Address2' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['Address3']) ? $altValue['Address3'] : substr(strip_tags($data->getAddress3()), 0, 100)) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Address3' class=''  j='editClient'") . 
                td(span(\htmlentities((($altValue['Zip']) ? $altValue['Zip'] : $data->getZip()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Zip' class=''  j='editClient'") . $cCmoreCols.$actionCell
                , " 
                        rid='".json_encode($data->getPrimaryKey())."' data-iterator='".$pcData->getPosition()."'
                        r='data'
                        class='".$hook['class']." '
                        id='ClientRow".$data->getPrimaryKey()."'")
                ;
                $i++;
            }
            $tr .= input('hidden', 'rowCountClient', $i);
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
                
                .div($controlsContent,'ClientControlsList', "class='custom-controls'")
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
                        table($trHead.$tr, "id='ClientTable' class='tablesorter' style='width:100%;'")
                     ,'',' class="content" ')
                ,'listForm',' class="ac-list" ')
                .$this->hookListBottom
                .$bottomRow
            , 'ClientListForm');

          #no parent

    $editUi = (empty($IdParent)) ? 'tabsContain' : 'editDialog';

    $editEvent .= "$(\"#ClientListForm td[j='editClient']\").bindEdit({
                    modelName:'" . $this->virtualClassName . "',
                    destUi: '{$editUi}'
                });
                
    $(\"#ClientListForm [j='deleteClient']\").bindDelete({
        modelName:'" . $this->virtualClassName . "',
        ui:'".$uiTabsId."',
        title: '".addslashes($this->tableDescription)."',
        message: '".addslashes(message_label('delete_row_confirm_msg'))."'
    });";
        
        $editEvent .= "
        $('#ClientPager').bindPaging({
            tableName:'Client'
            ,uiTabsId:'".$uiTabsId."'
            ,ajaxPageActParent:'".$this->virtualClassName."'
        });
";

        if(!isMobile()) {
            $jqueryDatePicker = "
                $(\"#formMsClient [j='date']\").attr('type', 'input');
                $(\"#formMsClient [j='date']\").each(function(){
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
            
        if($('#addClientAutoc').length > 0) {
            $('#addClientAutoc').bind('click', function () {
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
    public function setCreateDefaultsClient($data)
    {

        unset($data['IdClient']);
        $e = new Client();
        
        
        $e->fromArray($data );
        
        #
        
        //integer not required
        $e->setAddress1( ($data['Address1'] == '' ) ? null : $data['Address1']);
        //integer not required
        $e->setAddress2( ($data['Address2'] == '' ) ? null : $data['Address2']);
        //integer not required
        $e->setAddress3( ($data['Address3'] == '' ) ? null : $data['Address3']);
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
    public function setUpdateDefaultsClient($data)
    {

        
        $e = ClientQuery::create()->findPk(json_decode($data['i']));
        
        
        $e->fromArray($data );
        
        
        
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
     * Produce a formated form of Client
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
        
        $je = "ClientTable";
        
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
                
                case 'Country':
                    $data['IdCountry'] = $data['ip'];
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
        if(($_SESSION[_AUTH_VAR]->hasRights('Client', 'a') and !$id ) || ( $_SESSION[_AUTH_VAR]->hasRights('Client', 'w') and $id) || $this->setReadOnly) {
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
                $('#formClient #saveClient').unbind('click.saveClient');
                $('#formClient #saveClient').remove();";
        }

        if($_SESSION[_AUTH_VAR]->hasRights('Client', 'a') && !$this->setReadOnly) {
            $this->formAddButton = htmlLink(_("Add new"), 'Javascript:;' , "id='addClient' title='"._('Add')."' class='button-link-blue add-button'");
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
            

            $q = ClientQuery::create()
            
                #required client
                ->leftJoinWith('Country')
            ;
            


            $dataObj = $q->filterByIdClient($id)->findOne();
            
        }
        
        if($dataObj == null){
            $this->Client['isNew'] = 'yes';
        }
    
        
        
        if($dataObj == null){
            $dataObj = new Client();
            $this->Client['isNew'] = 'yes';
            if(is_array($data ))
               $dataObj->fromArray(array_filter($data));
            
        }else{
                $this->Client['isNew'] = 'no';
        }
        $this->dataObj = $dataObj;
            
        


                                    ($dataObj->getCountry())?'':$dataObj->setCountry( new Country() );

        
        $this->arrayIdCountryOptions = $this->selectBoxClient_IdCountry($this, $dataObj, $data);
        
        
        
        
        
        
$this->fields['Client']['Name']['html'] = stdFieldRow(_("Name"), input('text', 'Name', htmlentities($dataObj->getName()), "   placeholder='".str_replace("'","&#39;",_('Name'))."' size='35'  v='NAME' s='d' class=''  ")."", 'Name', "", $this->commentsName, $this->commentsName_css, '', ' ', 'no');
$this->fields['Client']['IdCountry']['html'] = stdFieldRow(_("Country"), selectboxCustomArray('IdCountry', $this->arrayIdCountryOptions, "", "v='ID_COUNTRY'  s='d'  val='".$dataObj->getIdCountry()."'", $dataObj->getIdCountry()), 'IdCountry', "", $this->commentsIdCountry, $this->commentsIdCountry_css, '', ' ', 'no');
$this->fields['Client']['Phone']['html'] = stdFieldRow(_("Phone"), input('text', 'Phone', htmlentities($dataObj->getPhone()), "   placeholder='".str_replace("'","&#39;",_('Phone'))."' size='35'  v='PHONE' s='d' class=''  ")."", 'Phone', "", $this->commentsPhone, $this->commentsPhone_css, '', ' ', 'no');
$this->fields['Client']['PhoneWork']['html'] = stdFieldRow(_("Phone work"), input('text', 'PhoneWork', htmlentities($dataObj->getPhoneWork()), "   placeholder='".str_replace("'","&#39;",_('Phone work'))."' size='35'  v='PHONE_WORK' s='d' class=''  ")."", 'PhoneWork', "", $this->commentsPhoneWork, $this->commentsPhoneWork_css, '', ' ', 'no');
$this->fields['Client']['Ext']['html'] = stdFieldRow(_("Extension"), input('text', 'Ext', htmlentities($dataObj->getExt()), "   placeholder='".str_replace("'","&#39;",_('Extension'))."' size='15'  v='EXT' s='d' class=''  ")."", 'Ext', "", $this->commentsExt, $this->commentsExt_css, '', ' ', 'no');
$this->fields['Client']['Email']['html'] = stdFieldRow(_("Email"), input('text', 'Email', htmlentities($dataObj->getEmail()), "   placeholder='".str_replace("'","&#39;",_('Email'))."' size='35'  v='EMAIL' s='d' class=''  ")."", 'Email', "", $this->commentsEmail, $this->commentsEmail_css, '', ' ', 'no');
$this->fields['Client']['Contact']['html'] = stdFieldRow(_("Contact"), input('text', 'Contact', htmlentities($dataObj->getContact()), "   placeholder='".str_replace("'","&#39;",_('Contact'))."' size='35'  v='CONTACT' s='d' class=''  ")."", 'Contact', "", $this->commentsContact, $this->commentsContact_css, '', ' ', 'no');
$this->fields['Client']['Email2']['html'] = stdFieldRow(_("Email (contact)"), input('text', 'Email2', htmlentities($dataObj->getEmail2()), "   placeholder='".str_replace("'","&#39;",_('Email (contact)'))."' size='35'  v='EMAIL2' s='d' class=''  ")."", 'Email2', "", $this->commentsEmail2, $this->commentsEmail2_css, '', ' ', 'no');
$this->fields['Client']['PhoneMobile']['html'] = stdFieldRow(_("contact"), input('text', 'PhoneMobile', htmlentities($dataObj->getPhoneMobile()), "   placeholder='".str_replace("'","&#39;",_('contact'))."' size='35'  v='PHONE_MOBILE' s='d' class=''  ")."", 'PhoneMobile', "", $this->commentsPhoneMobile, $this->commentsPhoneMobile_css, '', ' ', 'no');
$this->fields['Client']['Address1']['html'] = stdFieldRow(_("Address 1"), textarea('Address1', htmlentities($dataObj->getAddress1()) ,"placeholder='".str_replace("'","&#39;",_('Address 1'))."' cols='35' v='ADDRESS_1' s='d'  class=' ' style='' spellcheck='false'"), 'Address1', "", $this->commentsAddress1, $this->commentsAddress1_css, '', ' ', 'no');
$this->fields['Client']['Address2']['html'] = stdFieldRow(_("Address 2"), textarea('Address2', htmlentities($dataObj->getAddress2()) ,"placeholder='".str_replace("'","&#39;",_('Address 2'))."' cols='35' v='ADDRESS_2' s='d'  class=' ' style='' spellcheck='false'"), 'Address2', "", $this->commentsAddress2, $this->commentsAddress2_css, '', ' ', 'no');
$this->fields['Client']['Address3']['html'] = stdFieldRow(_("Address 3"), textarea('Address3', htmlentities($dataObj->getAddress3()) ,"placeholder='".str_replace("'","&#39;",_('Address 3'))."' cols='35' v='ADDRESS_3' s='d'  class=' ' style='' spellcheck='false'"), 'Address3', "", $this->commentsAddress3, $this->commentsAddress3_css, '', ' ', 'no');
$this->fields['Client']['Zip']['html'] = stdFieldRow(_("Zip"), input('text', 'Zip', htmlentities($dataObj->getZip()), "   placeholder='".str_replace("'","&#39;",_('Zip'))."' size='15'  v='ZIP' s='d' class=''  ")."", 'Zip', "", $this->commentsZip, $this->commentsZip_css, '', ' ', 'no');


        

        // Whole form read only
        if($this->setReadOnly == 'all' ) { 
            $this->lockFormField('all', $dataObj); 
        }


        if( !isset($this->Client['request']['ChildHide']) ) {

            # define child lists 'Billing'
            $ongletTab['0']['t'] = _('Billing');
            $ongletTab['0']['p'] = 'Billing';
            $ongletTab['0']['lkey'] = 'IdClient';
            $ongletTab['0']['fkey'] = 'IdClient';
        if(!empty($ongletTab) and $dataObj->getIdClient()){
            foreach($ongletTab as $value){
                if($_SESSION[_AUTH_VAR]->hasRights($value['p'], 'r')){

                    $getLocalKey = "get".$value['lkey']."";
                    if($dataObj->$getLocalKey()){
                        $ChildOnglet .= li(
                                        htmlLink(	_($value['t'])
                                            ,'javascript:',"p='".$value['p']."' act='list' j=conglet_Client ip='".$dataObj->$getLocalKey()."' class='ui-state-default' ")
                                    ,"  class='".$class_has_child."' j=sm  ");
                    }
                }
            }

            if($ChildOnglet){
                $childTable['onReadyJs'] ="
                     $('[j=conglet_Client]').bind('click', function (data){
                         pp = $(this).attr('p');
                         $('#cntClientChild').html( $('<img>').attr('src', '"._SITE_URL."public/img/Ellipsis-3.9s-200px.svg') );
                         $.get('"._SITE_URL."Client/'+pp+'/'+$(this).attr('ip'), { ui: pp+'Table', 'pui':'".$uiTabsId."', pc:'".$data['pc']."'}, function(data){
                            $('#cntClientChild').html(data);
                            $('[j=conglet_Client]').parent().attr('class','ui-state-default');
                            $('[j=conglet_Client][p='+pp+']').parent().attr('class',' ui-state-default ui-state-active');
                         });
                    });
                ";
                if($_SESSION['mem']['Client']['child']['list'][$dataObj->$getLocalKey()]){
                    $onglet_p = $_SESSION['mem']['Client']['child']['list'][$dataObj->$getLocalKey()];
                    $childTable['onReadyJs'] .= " $('[j=conglet_Client][p=".$onglet_p."]').first().click();";
                }else{
                    $childTable['onReadyJs'] .= " $('[j=conglet_Client]').first().click();";
                }
            }
        }
        }
        
        
        if(!$this->setReadOnly){
            $this->formSaveBar = div(	div( input('button', 'saveClient', _('Save'),' class="button-link-blue can-save"')
                                .input('hidden', 'formChangedClient','', 'j="formChanged"')
                                .input('hidden', 'idPk', urlencode($id), "s='d'")
                            .input('hidden', 'IdClient', $dataObj->getIdClient(), " s='d' pk").input('hidden', 'IdGroupCreation', $dataObj->getIdGroupCreation(), " s='d' nodesc").input('hidden', 'IdCreation', $dataObj->getIdCreation(), " s='d' nodesc").input('hidden', 'IdModification', $dataObj->getIdModification(), " s='d' nodesc")
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
            $jqueryDatePicker = " $(\"#formClient [j='date']\").attr('type', 'text');
            $(\"#formClient [j='date']\").each(function(){
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
                div('Client', '', "class='panel-heading'").
                $header_top_onglet.
                
                $this->hookFormInnerTop
                
                .
$this->fields['Client']['Name']['html']
.$this->fields['Client']['IdCountry']['html']
.$this->fields['Client']['Phone']['html']
.$this->fields['Client']['PhoneWork']['html']
.$this->fields['Client']['Ext']['html']
.$this->fields['Client']['Email']['html']
.$this->fields['Client']['Contact']['html']
.$this->fields['Client']['Email2']['html']
.$this->fields['Client']['PhoneMobile']['html']
.$this->fields['Client']['Address1']['html']
.$this->fields['Client']['Address2']['html']
.$this->fields['Client']['Address3']['html']
.$this->fields['Client']['Zip']['html']
                
                .$this->formSaveBar
                .$this->hookFormInnerBottom
            ,"divCntClient", "class='divStdform' CntTabs=1 ".$this->ccStdFormOptions)
        , "id='formClient' class='mainForm formContent' ")
        .$this->hookFormBottom;


        //if not new, show child table
        if($dataObj->getIdClient()) {
            if($ChildOnglet) {
                $return['html'] .= div(
                                        div('Child(s)', '', "class='panel-heading'")
                                        . ul($ChildOnglet, " class=' ui-tabs-nav ' ")
                                        . div('','cntClientChild',' class="" ')
                                    , 'pannelClient', " class='child_pannel ui-tabs childCntClass'");
            }
        }
        
        if($id and $_SESSION['mem']['Client']['ogf']) {
            $tabs_act = "$('[href=\"".$_SESSION['mem']['Client']['ogf']."\"]').click();";
        }

        if($_SESSION['mem']['Client']['ixmemautocapp'] and $_GET['Autocapp'] == 1) {
            $Autocapp = $_SESSION['mem']['Client']['ixmemautocapp'];
            unset($_SESSION['mem']['Client']['ixmemautocapp']);
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
            $(\"#formClient [s='d'], #formClient .js-select-label, #formClient [j='autocomplete']\")
                .bindFormKeypress({modelName: '" . $this->virtualClassName . "'});
            $('#formClient .js-select-label').SelectBox();
        }, 400);
        ";
        return $return;
    }

    function lockFormField($fields, $dataObj)	
    {
        
        $this->fieldsRo['Client']['Name']['html'] = stdFieldRow(_("Name"), div( $dataObj->getName(), 'Name_label' , "class='readonly' s='d'")
                .input('hidden', 'Name', $dataObj->getName(), "s='d'"), 'Name', "", $this->commentsName, $this->commentsName_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['IdCountry']['html'] = stdFieldRow(_("Country"), div( ($dataObj->getCountry())?$dataObj->getCountry()->getName():'', 'IdCountry_label' , "class='readonly' s='d'")
                .input('hidden', 'IdCountry', $dataObj->getIdCountry(), "s='d'"), 'IdCountry', "", $this->commentsIdCountry, $this->commentsIdCountry_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['Phone']['html'] = stdFieldRow(_("Phone"), div( $dataObj->getPhone(), 'Phone_label' , "class='readonly' s='d'")
                .input('hidden', 'Phone', $dataObj->getPhone(), "s='d'"), 'Phone', "", $this->commentsPhone, $this->commentsPhone_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['PhoneWork']['html'] = stdFieldRow(_("Phone work"), div( $dataObj->getPhoneWork(), 'PhoneWork_label' , "class='readonly' s='d'")
                .input('hidden', 'PhoneWork', $dataObj->getPhoneWork(), "s='d'"), 'PhoneWork', "", $this->commentsPhoneWork, $this->commentsPhoneWork_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['Ext']['html'] = stdFieldRow(_("Extension"), div( $dataObj->getExt(), 'Ext_label' , "class='readonly' s='d'")
                .input('hidden', 'Ext', $dataObj->getExt(), "s='d'"), 'Ext', "", $this->commentsExt, $this->commentsExt_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['Email']['html'] = stdFieldRow(_("Email"), div( $dataObj->getEmail(), 'Email_label' , "class='readonly' s='d'")
                .input('hidden', 'Email', $dataObj->getEmail(), "s='d'"), 'Email', "", $this->commentsEmail, $this->commentsEmail_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['Contact']['html'] = stdFieldRow(_("Contact"), div( $dataObj->getContact(), 'Contact_label' , "class='readonly' s='d'")
                .input('hidden', 'Contact', $dataObj->getContact(), "s='d'"), 'Contact', "", $this->commentsContact, $this->commentsContact_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['Email2']['html'] = stdFieldRow(_("Email (contact)"), div( $dataObj->getEmail2(), 'Email2_label' , "class='readonly' s='d'")
                .input('hidden', 'Email2', $dataObj->getEmail2(), "s='d'"), 'Email2', "", $this->commentsEmail2, $this->commentsEmail2_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['PhoneMobile']['html'] = stdFieldRow(_("contact"), div( $dataObj->getPhoneMobile(), 'PhoneMobile_label' , "class='readonly' s='d'")
                .input('hidden', 'PhoneMobile', $dataObj->getPhoneMobile(), "s='d'"), 'PhoneMobile', "", $this->commentsPhoneMobile, $this->commentsPhoneMobile_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['Address1']['html'] = stdFieldRow(_("Address 1"), div( $dataObj->getAddress1(), 'Address1_label' , "class='readonly' s='d'")
                .input('hidden', 'Address1', $dataObj->getAddress1(), "s='d'"), 'Address1', "", $this->commentsAddress1, $this->commentsAddress1_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['Address2']['html'] = stdFieldRow(_("Address 2"), div( $dataObj->getAddress2(), 'Address2_label' , "class='readonly' s='d'")
                .input('hidden', 'Address2', $dataObj->getAddress2(), "s='d'"), 'Address2', "", $this->commentsAddress2, $this->commentsAddress2_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['Address3']['html'] = stdFieldRow(_("Address 3"), div( $dataObj->getAddress3(), 'Address3_label' , "class='readonly' s='d'")
                .input('hidden', 'Address3', $dataObj->getAddress3(), "s='d'"), 'Address3', "", $this->commentsAddress3, $this->commentsAddress3_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Client']['Zip']['html'] = stdFieldRow(_("Zip"), div( $dataObj->getZip(), 'Zip_label' , "class='readonly' s='d'")
                .input('hidden', 'Zip', $dataObj->getZip(), "s='d'"), 'Zip', "", $this->commentsZip, $this->commentsZip_css, 'readonly', ' ', 'no');


        if($fields == 'all') {
            foreach($this->fields['Client'] as $field => $ar) {
                $this->fields['Client'][$field]['html'] = $this->fieldsRo['Client'][$field]['html'];
            }
        } elseif(is_array($fields)) {
            foreach($fields as $field) {
                $this->fields['Client'][$field]['html'] = $this->fieldsRo['Client'][$field]['html'];
            }
        }
    }

    /**
     * Query for Client_IdCountry selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxClient_IdCountry(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
        $q = CountryQuery::create();

            $q->select(array('Name', 'IdCountry'));
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
     * Query for Billing_IdClient selectBox 
     * @param class $obj
     * @param class $dataObj
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
     * @param class $obj
     * @param class $dataObj
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
     * @param class $obj
     * @param class $dataObj
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
     * function getBillingList
     * @param string $IdClient
     * @param integer $page
     * @param string $uiTabsId
     * @param string $parentContainer
     * @param string $mja_list
     * @param array $search
     * @param array $params
     * @return string
     */
    public function getBillingList(String $IdClient, array $request)
    {

        $this->TableName = 'Billing';
        $altValue = array (
  'IdBilling' => '',
  'CalcId' => '',
  'Title' => '',
  'IdClient' => '',
  'IdProject' => '',
  'IdBillingCategory' => '',
  'Date' => '',
  'Type' => '',
  'State' => '',
  'Gross' => '',
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
        $dataObj = null;
        $search = ['order' => null, 'page' => null, ];
        $uiTabsId = (empty($request['cui'])) ? 'cntClientChild' : $request['cui'];
        $parentContainer = $request['pc'];
        $orderReadyJs = '';

        // if Search params
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Client/Billing');

        // order
        $search['order'] = $this->setOrderVar($request['order'] ?? '', 'Client/Billing');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Client/Billing');
       
        
        

        /*column hide*/
        
        if($parentContainer == 'editDialog'){
            $diagNoClose = "diag:\"noclose\", ";
            $diagNoCloseEscaped = "diag:\\\"noclose\\\", ";
        }
        
        if(isset($this->Client['request']['noHeader']) && $this->Client['request']['noHeader'] == 'true'){
            $noHeader = "'noHeader':'true',";
        }
        
        $data['IdClient'] = $IdClient;
        if($dataObj == null){
            $dataObj = new Client();
            $dataObj->setIdClient($IdClient);
        }

        $this->Billing['list_add'] = "
        $('#BillingListForm #addBilling').bindEdit({
                modelName: 'Billing',
                destUi: 'editDialog',
                pc:'{$this->virtualClassName}',
                ip:'".$IdClient."',
                jet:'refreshChild',
                tp:'Billing',
                description: 'Billing'
        });
        ";
        $this->Billing['list_delete'] = "
        $(\"[j='deleteBilling']\").bindDelete({
            modelName:'Billing',
            ui:'cntBillingdivChild',
            title: 'Billing',
            message: '".addslashes(message_label('delete_row_confirm_msg') ?? '')."'
        });";

        if($_SESSION[_AUTH_VAR]->hasRights('Billing', 'r')){
            $parentObjName = (isset($params['pc'])) ? $params['pc'] : 'Client';
            $this->Billing['list_edit'] = "
        $(\"#BillingTable tr td[j='editBilling']\").bind('click', function (){
            location.href = '"._SITE_URL."Billing/edit/'+$(this).attr('i')+'?tp=Billing&ip=".$IdClient."';
        });";
        }

        #filters validation
        
        $filterKey = $IdClient;
        $this->IdPk = $IdClient;
        
        
        #main query
        
        // Normal query
        $maxPerPage = ( $request['maxperpage'] ) ? $request['maxperpage'] : $this->childMaxPerPage;
        $q = BillingQuery::create();
        
        
        $q
                #required billing
                ->leftJoinWith('Client')
                #default
                ->leftJoinWith('Project')
                #default
                ->leftJoinWith('BillingCategory') 
            
            ->filterByIdClient( $filterKey );; 
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
           
        
        $this->queryObj = $q;
        
        $pmpoData =$q->paginate($search['page'], $maxPerPage);
        $resultsCount = $pmpoData->getNbResults();
        
         
        #options building
        
        $this->arrayIdClientOptions = $this->selectBoxBilling_IdClient($this, $dataObj, $data);
        $this->arrayIdProjectOptions = $this->selectBoxBilling_IdProject($this, $dataObj, $data);
        $this->arrayIdBillingCategoryOptions = $this->selectBoxBilling_IdBillingCategory($this, $dataObj, $data);
        
        
          
        
        if(isset($this->Client['request']['noHeader']) && $this->Client['request']['noHeader'] == 'true'){
            $trSearch = "";
        }

        $actionRowHeader ='';
        if($_SESSION[_AUTH_VAR]->hasRights('Billing', 'd')){
            $actionRowHeader = th('&nbsp;', " r='delrow' class='actionrow' ");
        }

        $header = tr( th(_("Title"), " th='sorted' c='Title' title='" . _('Title')."' ")
.th(_("Client"), " th='sorted' c='Client.Name' title='"._('Client.Name')."' ")
.th(_("Project"), " th='sorted' c='Project.Name' title='"._('Project.Name')."' ")
.th(_("Category"), " th='sorted' c='BillingCategory.Name' title='"._('BillingCategory.Name')."' ")
.th(_("Date"), " th='sorted' c='Date' title='" . _('Date')."' ")
.th(_("Type"), " th='sorted' c='Type' title='" . _('Type')."' ")
.th(_("State"), " th='sorted' c='State' title='" . _('State')."' ")
.th(_("Gross"), " th='sorted' c='Gross' title='" . _('Gross')."' ")
.th(_("Tax"), " th='sorted' c='Tax' title='" . _('Tax')."' ")
.th(_("Due date"), " th='sorted' c='DateDue' title='" . _('Due date')."' ")
.th(_("Paid date"), " th='sorted' c='DatePaid' title='" . _('Paid date')."' ")
.th(_("Net"), " th='sorted' c='Net' title='" . _('Net')."' ")
.'' . $actionRowHeader, " ln='Billing' class=''");

        

        $i=0;
        if( $pmpoData->isEmpty() ){
            $tr .= tr(	td(p(span(_("No Billing found")),'class="no-results"'), "style='font-size:16px;' t='empty' ln='Billing' colspan='100%' "));
            
        }else{
            //$pcData = $pmpoData->getResults();
            
            foreach($pmpoData as $data){
                $this->listActionCellBilling = '';
                
                
                $actionRow = '';
                
                if($_SESSION[_AUTH_VAR]->hasRights('Billing', 'd')){
                    $actionRow = htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteBilling' i='".json_encode($data->getPrimaryKey())."'");
                }
                
                
                
                
                
                $actionRow = $actionRow;
                $actionRow = (!empty($actionRow)) ? td($this->listActionCellBilling.$actionRow," class='actionrow'") : "";
                
                                    $Client_Name = "";
                                    if($data->getClient()){
                                        $Client_Name = $data->getClient()->getName();
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
                
                
                
                $tr .= 
                        tr(
                            (isset($hookListColumnsBillingFirst)?$hookListColumnsBillingFirst:'').
                            
                td(span(\htmlentities((($altValue['Title']) ? $altValue['Title'] : $data->getTitle()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Title' class=''  j='editBilling'") . 
                td(span(\htmlentities((($altValue['IdClient']) ? $altValue['IdClient'] : $Client_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdClient' class=''  j='editBilling'") . 
                td(span(\htmlentities((($altValue['IdProject']) ? $altValue['IdProject'] : $Project_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdProject' class=''  j='editBilling'") . 
                td(span(\htmlentities((($altValue['IdBillingCategory']) ? $altValue['IdBillingCategory'] : $BillingCategory_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdBillingCategory' class=''  j='editBilling'") . 
                td(span(\htmlentities((($altValue['Date']) ? $altValue['Date'] : $data->getDate()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Date' class=''  j='editBilling'") . 
                td(span(\htmlentities((($altValue['Type']) ? $altValue['Type'] : isntPo($data->getType())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Type' class='center'  j='editBilling'") . 
                td(span(\htmlentities((($altValue['State']) ? $altValue['State'] : isntPo($data->getState())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='State' class='center'  j='editBilling'") . 
                td(span(\htmlentities((($altValue['Gross']) ? $altValue['Gross'] : str_replace(',', '.', $data->getGross())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Gross' class='right'  j='editBilling'") . 
                td(span(\htmlentities((($altValue['Tax']) ? $altValue['Tax'] : str_replace(',', '.', $data->getTax())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Tax' class='right'  j='editBilling'") . 
                td(span(\htmlentities((($altValue['DateDue']) ? $altValue['DateDue'] : $data->getDateDue()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='DateDue' class=''  j='editBilling'") . 
                td(span(\htmlentities((($altValue['DatePaid']) ? $altValue['DatePaid'] : $data->getDatePaid()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='DatePaid' class=''  j='editBilling'") . 
                td(span(\htmlentities((($altValue['Net']) ? $altValue['Net'] : str_replace(',', '.', $data->getNet())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Net' class='right'  j='editBilling'") . 
                            (isset($hookListColumnsBilling)?$hookListColumnsBilling:'').
                            $actionRow
                        ,"id='BillingRow{$data->getPrimaryKey()}' rid='{$data->getPrimaryKey()}' ln='Billing'  ")
                        ;
                
                $i++;
            }
            
            
        }

    $add_button_child = 
                            div(
                                div(
                                    div($total_child,'','class="nolink"')
                            ,'trBilling'," style='$hide_Billing' ln='Billing' class=''").$this->cCMainTableHeader, '', "class='listHeaderItem' ");
    if(($_SESSION[_AUTH_VAR]->hasRights('Billing', 'a')) ){
        $add_button_child = htmlLink(span(_("Add")), "Javascript:","title='Add "._('Billing')."' id='addBilling' class='button-link-blue add-button'");
    }

    //@PAGINATION
    $pagerRow = $this->getPager($pmpoData, $resultsCount, $search, true);

    $return['html'] =
            div(
                 $this->hookBillingListTop
                .div(
                    div($add_button_child
                    .$trSearch, '' ,'class="ac-list-form-header-child"')
                    .div(
                        div(
                            div(
                                table(	
                                    thead($header)
                                    .$tr
                                    .$this->hookBillingTableFooter
                                , "id='BillingTable' class='tablesorter'")
                            , 'childlistBilling')
                            .$this->hookBillingListBottom
                        ,'',' class="content" ')
                    ,'listFormChild',' class="ac-list" ')
                    .$pagerRow
                ,'BillingListForm')
            ,'cntBillingdivChild', "class='childListWrapper'");

            
            

            $return['onReadyJs'] =
                $this->hookListReadyJsFirstBilling
                .""
                .$this->Billing['list_add']
                .$this->Billing['list_delete']
                .$this->Billing['list_edit']
            ."
            
            
            
            /*checkboxes*/
            
                
        /* PAGINATION */
        $('#BillingPager').bindPaging({
            tableName:'Billing'
            , parentId:'".$IdClient."'
            , uiTabsId:'{$uiTabsId}'
            , ajaxPageActParent:'".$this->virtualClassName."/Billing/$IdClient'
            , pui:'".$uiTabsId."'
        });  

        $(\"#{$uiTabsId} [th='sorted']\").bindSorting({
            modelName:'Billing',
            url:'".$this->virtualClassName."/Billing/$IdClient',
            destUi:'".$uiTabsId."'
        });
        
        $('#cntClientChild .js-select-label').SelectBox();

        {$orderReadyJs}
        ";

        $return['onReadyJs'] .= "
                "
                . $this->hookListReadyJsBilling;
        return $return;
    }
}
