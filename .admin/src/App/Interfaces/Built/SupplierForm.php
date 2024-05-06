<?php

namespace App;


/**
 *  @version 1.1
 *  Generated Form class on the 'Supplier' table.
 *  
 */
use Psr\Http\Message\ServerRequestInterface as Request;
use ApiGoat\Html\Tabs;
use ApiGoat\Utility\FormHelper as Helper;

class SupplierForm extends Supplier
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
        $this->model_name = 'Supplier';
        $this->virtualClassName = 'Supplier';
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

        $q = new SupplierQuery();
        $q = $this->setAclFilter($q);
        

        if(is_array( $this->searchMs )){
            # main search form
            $q::create()
                
                #required supplier
                ->leftJoinWith('Country');
                
                
        }else{
            
            ## standard list
            $hasParent = json_decode($IdParent);
            if(empty($hasParent)) {
                $q::create()
                
                #required supplier
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
                                $(\"#SupplierListForm [th='sorted'][c='".$col."']\").attr('sens', '".strtolower($sens)."')
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
                
        $this->arrayIdCountryOptions = $this->selectBoxSupplier_IdCountry($this, $emptyVar, $data);
                
                ;
                return $trSearch;

            case 'add':
            ###### ADD
                if($_SESSION[_AUTH_VAR]->hasRights('Supplier', 'a') && !$this->setReadOnly){
                
                                $this->listAddButton = htmlLink(
                                    _("Add new")
                                ,_SITE_URL.$this->virtualClassName."/edit/", "id='addSupplier' title='"._('Add')."' class='button-link-blue add-button'");
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
        $this->TableName = 'Supplier';
        $altValue = array (
  'IdSupplier' => '',
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
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Supplier/');

        // order
        $this->searchOrder = $this->setOrderVar($request['order'] ?? '', 'Supplier/');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Supplier/');

        
        
        
        
        
        

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
                if($_SESSION[_AUTH_VAR]->hasRights('Supplier', 'd')){
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
        htmlLink("<i class='ri-delete-bin-7-line'></i>", "Javascript:", "class='ac-delete-link' j='deleteSupplier' ") . $this->listActionCell, " class='actionrow' ");

                $tr .= tr(
                td(span(\htmlentities((($altValue['Name']) ? $altValue['Name'] : $data->getName()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Name' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['IdCountry']) ? $altValue['IdCountry'] : $Country_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdCountry' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['Phone']) ? $altValue['Phone'] : $data->getPhone()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Phone' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['PhoneWork']) ? $altValue['PhoneWork'] : $data->getPhoneWork()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='PhoneWork' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['Ext']) ? $altValue['Ext'] : $data->getExt()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Ext' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['Email']) ? $altValue['Email'] : $data->getEmail()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Email' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['Contact']) ? $altValue['Contact'] : $data->getContact()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Contact' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['Email2']) ? $altValue['Email2'] : $data->getEmail2()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Email2' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['PhoneMobile']) ? $altValue['PhoneMobile'] : $data->getPhoneMobile()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='PhoneMobile' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['Address1']) ? $altValue['Address1'] : substr(strip_tags($data->getAddress1()), 0, 100)) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Address1' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['Address2']) ? $altValue['Address2'] : substr(strip_tags($data->getAddress2()), 0, 100)) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Address2' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['Address3']) ? $altValue['Address3'] : substr(strip_tags($data->getAddress3()), 0, 100)) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Address3' class=''  j='editSupplier'") . 
                td(span(\htmlentities((($altValue['Zip']) ? $altValue['Zip'] : $data->getZip()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Zip' class=''  j='editSupplier'") . $cCmoreCols.$actionCell
                , " 
                        rid='".json_encode($data->getPrimaryKey())."' data-iterator='".$pcData->getPosition()."'
                        r='data'
                        class='".$hook['class']." '
                        id='SupplierRow".$data->getPrimaryKey()."'")
                ;
                $i++;
            }
            $tr .= input('hidden', 'rowCountSupplier', $i);
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
                
                .div($controlsContent,'SupplierControlsList', "class='custom-controls'")
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
                        table($trHead.$tr, "id='SupplierTable' class='tablesorter' style='width:100%;'")
                     ,'',' class="content" ')
                ,'listForm',' class="ac-list" ')
                .$this->hookListBottom
                .$bottomRow
            , 'SupplierListForm');

          #no parent

    $editUi = (empty($IdParent)) ? 'tabsContain' : 'editDialog';

    $editEvent .= "$(\"#SupplierListForm td[j='editSupplier']\").bindEdit({
                    modelName:'" . $this->virtualClassName . "',
                    destUi: '{$editUi}'
                });
                
    $(\"#SupplierListForm [j='deleteSupplier']\").bindDelete({
        modelName:'" . $this->virtualClassName . "',
        ui:'".$uiTabsId."',
        title: '".addslashes($this->tableDescription)."',
        message: '".addslashes(message_label('delete_row_confirm_msg'))."'
    });";
        
        $editEvent .= "
        $('#SupplierPager').bindPaging({
            tableName:'Supplier'
            ,uiTabsId:'".$uiTabsId."'
            ,ajaxPageActParent:'".$this->virtualClassName."'
        });
";

        if(!isMobile()) {
            $jqueryDatePicker = "
                $(\"#formMsSupplier [j='date']\").attr('type', 'input');
                $(\"#formMsSupplier [j='date']\").each(function(){
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
            
        if($('#addSupplierAutoc').length > 0) {
            $('#addSupplierAutoc').bind('click', function () {
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
    public function setCreateDefaultsSupplier($data)
    {

        unset($data['IdSupplier']);
        $e = new Supplier();
        
        
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
    public function setUpdateDefaultsSupplier($data)
    {

        
        $e = SupplierQuery::create()->findPk(json_decode($data['i']));
        
        
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
     * Produce a formated form of Supplier
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
        
        $je = "SupplierTable";
        
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
        if(($_SESSION[_AUTH_VAR]->hasRights('Supplier', 'a') and !$id ) || ( $_SESSION[_AUTH_VAR]->hasRights('Supplier', 'w') and $id) || $this->setReadOnly) {
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
                $('#formSupplier #saveSupplier').unbind('click.saveSupplier');
                $('#formSupplier #saveSupplier').remove();";
        }

        if($_SESSION[_AUTH_VAR]->hasRights('Supplier', 'a') && !$this->setReadOnly) {
            $this->formAddButton = htmlLink(_("Add new"), 'Javascript:;' , "id='addSupplier' title='"._('Add')."' class='button-link-blue add-button'");
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
            

            $q = SupplierQuery::create()
            
                #required supplier
                ->leftJoinWith('Country')
            ;
            


            $dataObj = $q->filterByIdSupplier($id)->findOne();
            
        }
        
        if($dataObj == null){
            $this->Supplier['isNew'] = 'yes';
        }
    
        
        
        if($dataObj == null){
            $dataObj = new Supplier();
            $this->Supplier['isNew'] = 'yes';
            if(is_array($data ))
               $dataObj->fromArray(array_filter($data));
            
        }else{
                $this->Supplier['isNew'] = 'no';
        }
        $this->dataObj = $dataObj;
            
        


                                    ($dataObj->getCountry())?'':$dataObj->setCountry( new Country() );

        
        $this->arrayIdCountryOptions = $this->selectBoxSupplier_IdCountry($this, $dataObj, $data);
        
        
        
        
        
        
$this->fields['Supplier']['Name']['html'] = stdFieldRow(_("Name"), input('text', 'Name', htmlentities($dataObj->getName()), "   placeholder='".str_replace("'","&#39;",_('Name'))."' size='35'  v='NAME' s='d' class=''  ")."", 'Name', "", $this->commentsName, $this->commentsName_css, '', ' ', 'no');
$this->fields['Supplier']['IdCountry']['html'] = stdFieldRow(_("Country"), selectboxCustomArray('IdCountry', $this->arrayIdCountryOptions, "", "v='ID_COUNTRY'  s='d'  val='".$dataObj->getIdCountry()."'", $dataObj->getIdCountry()), 'IdCountry', "", $this->commentsIdCountry, $this->commentsIdCountry_css, '', ' ', 'no');
$this->fields['Supplier']['Phone']['html'] = stdFieldRow(_("Phone"), input('text', 'Phone', htmlentities($dataObj->getPhone()), "   placeholder='".str_replace("'","&#39;",_('Phone'))."' size='35'  v='PHONE' s='d' class=''  ")."", 'Phone', "", $this->commentsPhone, $this->commentsPhone_css, '', ' ', 'no');
$this->fields['Supplier']['PhoneWork']['html'] = stdFieldRow(_("Phone work"), input('text', 'PhoneWork', htmlentities($dataObj->getPhoneWork()), "   placeholder='".str_replace("'","&#39;",_('Phone work'))."' size='35'  v='PHONE_WORK' s='d' class=''  ")."", 'PhoneWork', "", $this->commentsPhoneWork, $this->commentsPhoneWork_css, '', ' ', 'no');
$this->fields['Supplier']['Ext']['html'] = stdFieldRow(_("Extension"), input('text', 'Ext', htmlentities($dataObj->getExt()), "   placeholder='".str_replace("'","&#39;",_('Extension'))."' size='15'  v='EXT' s='d' class=''  ")."", 'Ext', "", $this->commentsExt, $this->commentsExt_css, '', ' ', 'no');
$this->fields['Supplier']['Email']['html'] = stdFieldRow(_("Email"), input('text', 'Email', htmlentities($dataObj->getEmail()), "   placeholder='".str_replace("'","&#39;",_('Email'))."' size='35'  v='EMAIL' s='d' class=''  ")."", 'Email', "", $this->commentsEmail, $this->commentsEmail_css, '', ' ', 'no');
$this->fields['Supplier']['Contact']['html'] = stdFieldRow(_("Contact"), input('text', 'Contact', htmlentities($dataObj->getContact()), "   placeholder='".str_replace("'","&#39;",_('Contact'))."' size='35'  v='CONTACT' s='d' class=''  ")."", 'Contact', "", $this->commentsContact, $this->commentsContact_css, '', ' ', 'no');
$this->fields['Supplier']['Email2']['html'] = stdFieldRow(_("Email (contact)"), input('text', 'Email2', htmlentities($dataObj->getEmail2()), "   placeholder='".str_replace("'","&#39;",_('Email (contact)'))."' size='35'  v='EMAIL2' s='d' class=''  ")."", 'Email2', "", $this->commentsEmail2, $this->commentsEmail2_css, '', ' ', 'no');
$this->fields['Supplier']['PhoneMobile']['html'] = stdFieldRow(_("contact"), input('text', 'PhoneMobile', htmlentities($dataObj->getPhoneMobile()), "   placeholder='".str_replace("'","&#39;",_('contact'))."' size='35'  v='PHONE_MOBILE' s='d' class=''  ")."", 'PhoneMobile', "", $this->commentsPhoneMobile, $this->commentsPhoneMobile_css, '', ' ', 'no');
$this->fields['Supplier']['Address1']['html'] = stdFieldRow(_("Address 1"), textarea('Address1', htmlentities($dataObj->getAddress1()) ,"placeholder='".str_replace("'","&#39;",_('Address 1'))."' cols='35' v='ADDRESS_1' s='d'  class=' ' style='' spellcheck='false'"), 'Address1', "", $this->commentsAddress1, $this->commentsAddress1_css, '', ' ', 'no');
$this->fields['Supplier']['Address2']['html'] = stdFieldRow(_("Address 2"), textarea('Address2', htmlentities($dataObj->getAddress2()) ,"placeholder='".str_replace("'","&#39;",_('Address 2'))."' cols='35' v='ADDRESS_2' s='d'  class=' ' style='' spellcheck='false'"), 'Address2', "", $this->commentsAddress2, $this->commentsAddress2_css, '', ' ', 'no');
$this->fields['Supplier']['Address3']['html'] = stdFieldRow(_("Address 3"), textarea('Address3', htmlentities($dataObj->getAddress3()) ,"placeholder='".str_replace("'","&#39;",_('Address 3'))."' cols='35' v='ADDRESS_3' s='d'  class=' ' style='' spellcheck='false'"), 'Address3', "", $this->commentsAddress3, $this->commentsAddress3_css, '', ' ', 'no');
$this->fields['Supplier']['Zip']['html'] = stdFieldRow(_("Zip"), input('text', 'Zip', htmlentities($dataObj->getZip()), "   placeholder='".str_replace("'","&#39;",_('Zip'))."' size='15'  v='ZIP' s='d' class=''  ")."", 'Zip', "", $this->commentsZip, $this->commentsZip_css, '', ' ', 'no');


        

        // Whole form read only
        if($this->setReadOnly == 'all' ) { 
            $this->lockFormField('all', $dataObj); 
        }


        if( !isset($this->Supplier['request']['ChildHide']) ) {

            # define child lists 'Expense'
            $ongletTab['0']['t'] = _('Expense');
            $ongletTab['0']['p'] = 'CostLine';
            $ongletTab['0']['lkey'] = 'IdSupplier';
            $ongletTab['0']['fkey'] = 'IdSupplier';
        if(!empty($ongletTab) and $dataObj->getIdSupplier()){
            foreach($ongletTab as $value){
                if($_SESSION[_AUTH_VAR]->hasRights($value['p'], 'r')){

                    $getLocalKey = "get".$value['lkey']."";
                    if($dataObj->$getLocalKey()){
                        $ChildOnglet .= li(
                                        htmlLink(	_($value['t'])
                                            ,'javascript:',"p='".$value['p']."' act='list' j=conglet_Supplier ip='".$dataObj->$getLocalKey()."' class='ui-state-default' ")
                                    ,"  class='".$class_has_child."' j=sm  ");
                    }
                }
            }

            if($ChildOnglet){
                $childTable['onReadyJs'] ="
                     $('[j=conglet_Supplier]').bind('click', function (data){
                         pp = $(this).attr('p');
                         $('#cntSupplierChild').html( $('<img>').attr('src', '"._SITE_URL."public/img/Ellipsis-3.9s-200px.svg') );
                         $.get('"._SITE_URL."Supplier/'+pp+'/'+$(this).attr('ip'), { ui: pp+'Table', 'pui':'".$uiTabsId."', pc:'".$data['pc']."'}, function(data){
                            $('#cntSupplierChild').html(data);
                            $('[j=conglet_Supplier]').parent().attr('class','ui-state-default');
                            $('[j=conglet_Supplier][p='+pp+']').parent().attr('class',' ui-state-default ui-state-active');
                         });
                    });
                ";
                if($_SESSION['mem']['Supplier']['child']['list'][$dataObj->$getLocalKey()]){
                    $onglet_p = $_SESSION['mem']['Supplier']['child']['list'][$dataObj->$getLocalKey()];
                    $childTable['onReadyJs'] .= " $('[j=conglet_Supplier][p=".$onglet_p."]').first().click();";
                }else{
                    $childTable['onReadyJs'] .= " $('[j=conglet_Supplier]').first().click();";
                }
            }
        }
        }
        
        
        if(!$this->setReadOnly){
            $this->formSaveBar = div(	div( input('button', 'saveSupplier', _('Save'),' class="button-link-blue can-save"')
                                .input('hidden', 'formChangedSupplier','', 'j="formChanged"')
                                .input('hidden', 'idPk', urlencode($id), "s='d'")
                            .input('hidden', 'IdSupplier', $dataObj->getIdSupplier(), " s='d' pk").input('hidden', 'IdGroupCreation', $dataObj->getIdGroupCreation(), " s='d' nodesc").input('hidden', 'IdCreation', $dataObj->getIdCreation(), " s='d' nodesc").input('hidden', 'IdModification', $dataObj->getIdModification(), " s='d' nodesc")
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
            $jqueryDatePicker = " $(\"#formSupplier [j='date']\").attr('type', 'text');
            $(\"#formSupplier [j='date']\").each(function(){
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
                div('Supplier', '', "class='panel-heading'").
                $header_top_onglet.
                
                $this->hookFormInnerTop
                
                .
$this->fields['Supplier']['Name']['html']
.$this->fields['Supplier']['IdCountry']['html']
.$this->fields['Supplier']['Phone']['html']
.$this->fields['Supplier']['PhoneWork']['html']
.$this->fields['Supplier']['Ext']['html']
.$this->fields['Supplier']['Email']['html']
.$this->fields['Supplier']['Contact']['html']
.$this->fields['Supplier']['Email2']['html']
.$this->fields['Supplier']['PhoneMobile']['html']
.$this->fields['Supplier']['Address1']['html']
.$this->fields['Supplier']['Address2']['html']
.$this->fields['Supplier']['Address3']['html']
.$this->fields['Supplier']['Zip']['html']
                
                .$this->formSaveBar
                .$this->hookFormInnerBottom
            ,"divCntSupplier", "class='divStdform' CntTabs=1 ".$this->ccStdFormOptions)
        , "id='formSupplier' class='mainForm formContent' ")
        .$this->hookFormBottom;


        //if not new, show child table
        if($dataObj->getIdSupplier()) {
            if($ChildOnglet) {
                $return['html'] .= div(
                                        div('Child(s)', '', "class='panel-heading'")
                                        . ul($ChildOnglet, " class=' ui-tabs-nav ' ")
                                        . div('','cntSupplierChild',' class="" ')
                                    , 'pannelSupplier', " class='child_pannel ui-tabs childCntClass'");
            }
        }
        
        if($id and $_SESSION['mem']['Supplier']['ogf']) {
            $tabs_act = "$('[href=\"".$_SESSION['mem']['Supplier']['ogf']."\"]').click();";
        }

        if($_SESSION['mem']['Supplier']['ixmemautocapp'] and $_GET['Autocapp'] == 1) {
            $Autocapp = $_SESSION['mem']['Supplier']['ixmemautocapp'];
            unset($_SESSION['mem']['Supplier']['ixmemautocapp']);
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
            $(\"#formSupplier [s='d'], #formSupplier .js-select-label, #formSupplier [j='autocomplete']\")
                .bindFormKeypress({modelName: '" . $this->virtualClassName . "'});
            $('#formSupplier .js-select-label').SelectBox();
        }, 400);
        ";
        return $return;
    }

    function lockFormField($fields, $dataObj)	
    {
        
        $this->fieldsRo['Supplier']['Name']['html'] = stdFieldRow(_("Name"), div( $dataObj->getName(), 'Name_label' , "class='readonly' s='d'")
                .input('hidden', 'Name', $dataObj->getName(), "s='d'"), 'Name', "", $this->commentsName, $this->commentsName_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['IdCountry']['html'] = stdFieldRow(_("Country"), div( ($dataObj->getCountry())?$dataObj->getCountry()->getName():'', 'IdCountry_label' , "class='readonly' s='d'")
                .input('hidden', 'IdCountry', $dataObj->getIdCountry(), "s='d'"), 'IdCountry', "", $this->commentsIdCountry, $this->commentsIdCountry_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['Phone']['html'] = stdFieldRow(_("Phone"), div( $dataObj->getPhone(), 'Phone_label' , "class='readonly' s='d'")
                .input('hidden', 'Phone', $dataObj->getPhone(), "s='d'"), 'Phone', "", $this->commentsPhone, $this->commentsPhone_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['PhoneWork']['html'] = stdFieldRow(_("Phone work"), div( $dataObj->getPhoneWork(), 'PhoneWork_label' , "class='readonly' s='d'")
                .input('hidden', 'PhoneWork', $dataObj->getPhoneWork(), "s='d'"), 'PhoneWork', "", $this->commentsPhoneWork, $this->commentsPhoneWork_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['Ext']['html'] = stdFieldRow(_("Extension"), div( $dataObj->getExt(), 'Ext_label' , "class='readonly' s='d'")
                .input('hidden', 'Ext', $dataObj->getExt(), "s='d'"), 'Ext', "", $this->commentsExt, $this->commentsExt_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['Email']['html'] = stdFieldRow(_("Email"), div( $dataObj->getEmail(), 'Email_label' , "class='readonly' s='d'")
                .input('hidden', 'Email', $dataObj->getEmail(), "s='d'"), 'Email', "", $this->commentsEmail, $this->commentsEmail_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['Contact']['html'] = stdFieldRow(_("Contact"), div( $dataObj->getContact(), 'Contact_label' , "class='readonly' s='d'")
                .input('hidden', 'Contact', $dataObj->getContact(), "s='d'"), 'Contact', "", $this->commentsContact, $this->commentsContact_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['Email2']['html'] = stdFieldRow(_("Email (contact)"), div( $dataObj->getEmail2(), 'Email2_label' , "class='readonly' s='d'")
                .input('hidden', 'Email2', $dataObj->getEmail2(), "s='d'"), 'Email2', "", $this->commentsEmail2, $this->commentsEmail2_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['PhoneMobile']['html'] = stdFieldRow(_("contact"), div( $dataObj->getPhoneMobile(), 'PhoneMobile_label' , "class='readonly' s='d'")
                .input('hidden', 'PhoneMobile', $dataObj->getPhoneMobile(), "s='d'"), 'PhoneMobile', "", $this->commentsPhoneMobile, $this->commentsPhoneMobile_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['Address1']['html'] = stdFieldRow(_("Address 1"), div( $dataObj->getAddress1(), 'Address1_label' , "class='readonly' s='d'")
                .input('hidden', 'Address1', $dataObj->getAddress1(), "s='d'"), 'Address1', "", $this->commentsAddress1, $this->commentsAddress1_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['Address2']['html'] = stdFieldRow(_("Address 2"), div( $dataObj->getAddress2(), 'Address2_label' , "class='readonly' s='d'")
                .input('hidden', 'Address2', $dataObj->getAddress2(), "s='d'"), 'Address2', "", $this->commentsAddress2, $this->commentsAddress2_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['Address3']['html'] = stdFieldRow(_("Address 3"), div( $dataObj->getAddress3(), 'Address3_label' , "class='readonly' s='d'")
                .input('hidden', 'Address3', $dataObj->getAddress3(), "s='d'"), 'Address3', "", $this->commentsAddress3, $this->commentsAddress3_css, 'readonly', ' ', 'no');

        $this->fieldsRo['Supplier']['Zip']['html'] = stdFieldRow(_("Zip"), div( $dataObj->getZip(), 'Zip_label' , "class='readonly' s='d'")
                .input('hidden', 'Zip', $dataObj->getZip(), "s='d'"), 'Zip', "", $this->commentsZip, $this->commentsZip_css, 'readonly', ' ', 'no');


        if($fields == 'all') {
            foreach($this->fields['Supplier'] as $field => $ar) {
                $this->fields['Supplier'][$field]['html'] = $this->fieldsRo['Supplier'][$field]['html'];
            }
        } elseif(is_array($fields)) {
            foreach($fields as $field) {
                $this->fields['Supplier'][$field]['html'] = $this->fieldsRo['Supplier'][$field]['html'];
            }
        }
    }

    /**
     * Query for Supplier_IdCountry selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxSupplier_IdCountry(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
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
     * Query for CostLine_IdSupplier selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxCostLine_IdSupplier(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
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

    /**
     * Query for CostLine_IdProject selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxCostLine_IdProject(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
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
     * Query for CostLine_IdBillingCategory selectBox 
     * @param class $obj
     * @param class $dataObj
     * @param array $data
    **/
    public function selectBoxCostLine_IdBillingCategory(&$obj = '', &$dataObj = '', &$data = '', $emptyVal = false, $array = true){
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
     * function getCostLineList
     * @param string $IdSupplier
     * @param integer $page
     * @param string $uiTabsId
     * @param string $parentContainer
     * @param string $mja_list
     * @param array $search
     * @param array $params
     * @return string
     */
    public function getCostLineList(String $IdSupplier, array $request)
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
        $uiTabsId = (empty($request['cui'])) ? 'cntSupplierChild' : $request['cui'];
        $parentContainer = $request['pc'];
        $orderReadyJs = '';

        // if Search params
        $this->searchMs = $this->setSearchVar($request['ms'] ?? '', 'Supplier/CostLine');

        // order
        $search['order'] = $this->setOrderVar($request['order'] ?? '', 'Supplier/CostLine');
        
        // page
        $search['page'] = $this->setPageVar($request['pg'] ?? '', 'Supplier/CostLine');
       
        
        

        /*column hide*/
        
        if($parentContainer == 'editDialog'){
            $diagNoClose = "diag:\"noclose\", ";
            $diagNoCloseEscaped = "diag:\\\"noclose\\\", ";
        }
        
        if(isset($this->Supplier['request']['noHeader']) && $this->Supplier['request']['noHeader'] == 'true'){
            $noHeader = "'noHeader':'true',";
        }
        
        $data['IdSupplier'] = $IdSupplier;
        if($dataObj == null){
            $dataObj = new Supplier();
            $dataObj->setIdSupplier($IdSupplier);
        }

        $this->CostLine['list_add'] = "
        $('#CostLineListForm #addCostLine').bindEdit({
                modelName: 'CostLine',
                destUi: 'editDialog',
                pc:'{$this->virtualClassName}',
                ip:'".$IdSupplier."',
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
            $parentObjName = (isset($params['pc'])) ? $params['pc'] : 'Supplier';
            $this->CostLine['list_edit'] = "
        $(\"#CostLineTable tr td[j='editCostLine']\").bind('click', function (){
            
        $('#editDialog').html( $('<div>').append( $('<img>').attr('src', '"._SITE_URL."public/img/Ellipsis-3.9s-200px.svg').css('width', '300px')).css('width', '300px').css('margin', 'auto') );
        $('#editDialog').dialog({width:'auto'}).dialog('open');
        $.get('"._SITE_URL."CostLine/edit/'+$(this).attr('i'),
                { ip:'".$IdSupplier."', ui:'editDialog', pc:'{$this->virtualClassName}', je:'CostLineTableCntnr', jet:'refreshChild', 'it-pos':$(this).data('iterator-pos') },
            function(data){ 
                dialogWidthClass($('#editDialog')); 
                $('#editDialog').html(data).dialog({width:'auto'});  
        });
        });";
        }

        #filters validation
        
        $filterKey = $IdSupplier;
        $this->IdPk = $IdSupplier;
        
        
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
            
            ->filterByIdSupplier( $filterKey );; 
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
        
        $this->arrayIdSupplierOptions = $this->selectBoxCostLine_IdSupplier($this, $dataObj, $data);
        $this->arrayIdProjectOptions = $this->selectBoxCostLine_IdProject($this, $dataObj, $data);
        $this->arrayIdBillingCategoryOptions = $this->selectBoxCostLine_IdBillingCategory($this, $dataObj, $data);
        
        
          
        
        if(isset($this->Supplier['request']['noHeader']) && $this->Supplier['request']['noHeader'] == 'true'){
            $trSearch = "";
        }

        $actionRowHeader ='';
        if($_SESSION[_AUTH_VAR]->hasRights('CostLine', 'd')){
            $actionRowHeader = th('&nbsp;', " r='delrow' class='actionrow' ");
        }

        $header = tr( th(_("Title"), " th='sorted' c='Title' title='" . _('Title')."' ")
.th(_("Supplier"), " th='sorted' c='Supplier.Name' title='"._('Supplier.Name')."' ")
.th(_("Invoice no."), " th='sorted' c='InvoiceNo' title='" . _('Invoice no.')."' ")
.th(_("Project"), " th='sorted' c='Project.Name' title='"._('Project.Name')."' ")
.th(_("Category"), " th='sorted' c='BillingCategory.Name' title='"._('BillingCategory.Name')."' ")
.th(_("Date"), " th='sorted' c='SpendDate' title='" . _('Date')."' ")
.th(_("Recuring"), " th='sorted' c='Recuring' title='" . _('Recuring')."' ")
.th(_("Renewal date"), " th='sorted' c='RenewalDate' title='" . _('Renewal date')."' ")
.th(_("Quantity"), " th='sorted' c='Quantity' title='" . _('Quantity')."' ")
.th(_("Amount"), " th='sorted' c='Amount' title='" . _('Amount')."' ")
.th(_("Total"), " th='sorted' c='Total' title='" . _('Total')."' ")
.th(_("Add to bill"), " th='sorted' c='Bill' title='" . _('Add to bill')."' ")
.th(_("Note"), " th='sorted' c='NoteBillingLigne' title='" . _('Note')."' ")
.'' . $actionRowHeader, " ln='CostLine' class=''");

        

        $i=0;
        if( $pmpoData->isEmpty() ){
            $tr .= tr(	td(p(span(_("No Expense found")),'class="no-results"'), "style='font-size:16px;' t='empty' ln='CostLine' colspan='100%' "));
            
        }else{
            //$pcData = $pmpoData->getResults();
            
            foreach($pmpoData as $data){
                $this->listActionCellCostLine = '';
                
                
                $actionRow = '';
                
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
                
                
                
                $tr .= 
                        tr(
                            (isset($hookListColumnsCostLineFirst)?$hookListColumnsCostLineFirst:'').
                            
                td(span(\htmlentities((($altValue['Title']) ? $altValue['Title'] : $data->getTitle()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Title' class=''  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['IdSupplier']) ? $altValue['IdSupplier'] : $Supplier_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdSupplier' class=''  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['InvoiceNo']) ? $altValue['InvoiceNo'] : $data->getInvoiceNo()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='InvoiceNo' class=''  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['IdProject']) ? $altValue['IdProject'] : $Project_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdProject' class=''  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['IdBillingCategory']) ? $altValue['IdBillingCategory'] : $BillingCategory_Name) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='IdBillingCategory' class=''  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['SpendDate']) ? $altValue['SpendDate'] : $data->getSpendDate()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='SpendDate' class=''  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['Recuring']) ? $altValue['Recuring'] : isntPo($data->getRecuring())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Recuring' class='center'  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['RenewalDate']) ? $altValue['RenewalDate'] : $data->getRenewalDate()) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='RenewalDate' class=''  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['Quantity']) ? $altValue['Quantity'] : str_replace(',', '.', $data->getQuantity())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Quantity' class='right'  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['Amount']) ? $altValue['Amount'] : str_replace(',', '.', $data->getAmount())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Amount' class='right'  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['Total']) ? $altValue['Total'] : str_replace(',', '.', $data->getTotal())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Total' class='right'  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['Bill']) ? $altValue['Bill'] : isntPo($data->getBill())) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='Bill' class='center'  j='editCostLine'") . 
                td(span(\htmlentities((($altValue['NoteBillingLigne']) ? $altValue['NoteBillingLigne'] : substr(strip_tags($data->getNoteBillingLigne()), 0, 100)) ?? '')." "), "  i='" . json_encode($data->getPrimaryKey()) . "' c='NoteBillingLigne' class=''  j='editCostLine'") . 
                            (isset($hookListColumnsCostLine)?$hookListColumnsCostLine:'').
                            $actionRow
                        ,"id='CostLineRow{$data->getPrimaryKey()}' rid='{$data->getPrimaryKey()}' ln='CostLine'  ")
                        ;
                
                $i++;
            }
            
            
        }

    $add_button_child = 
                            div(
                                div(
                                    div($total_child,'','class="nolink"')
                            ,'trCostLine'," style='$hide_CostLine' ln='CostLine' class=''").$this->cCMainTableHeader, '', "class='listHeaderItem' ");
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
            , parentId:'".$IdSupplier."'
            , uiTabsId:'{$uiTabsId}'
            , ajaxPageActParent:'".$this->virtualClassName."/CostLine/$IdSupplier'
            , pui:'".$uiTabsId."'
        });  

        $(\"#{$uiTabsId} [th='sorted']\").bindSorting({
            modelName:'CostLine',
            url:'".$this->virtualClassName."/CostLine/$IdSupplier',
            destUi:'".$uiTabsId."'
        });
        
        $('#cntSupplierChild .js-select-label').SelectBox();

        {$orderReadyJs}
        ";

        $return['onReadyJs'] .= "
                "
                . $this->hookListReadyJsCostLine;
        return $return;
    }
}
