<?php

namespace App\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'authy' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator..map
 */
class AuthyTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.AuthyTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('authy');
        $this->setPhpName('Authy');
        $this->setClassname('App\\Authy');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_authy', 'IdAuthy', 'INTEGER', true, 10, null);
        $this->addColumn('validation_key', 'ValidationKey', 'VARCHAR', false, 32, null);
        $this->addColumn('username', 'Username', 'VARCHAR', false, 32, null);
        $this->addColumn('fullname', 'Fullname', 'VARCHAR', false, 100, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 100, null);
        $this->addColumn('passwd_hash', 'PasswdHash', 'VARCHAR', true, 32, null);
        $this->addColumn('expire', 'Expire', 'DATE', false, null, '0000-00-00');
        $this->addColumn('deactivate', 'Deactivate', 'ENUM', false, null, 'No');
        $this->getColumn('deactivate', false)->setValueSet(array (
  0 => 'Yes',
  1 => 'No',
));
        $this->addColumn('is_root', 'IsRoot', 'ENUM', true, null, 'No');
        $this->getColumn('is_root', false)->setValueSet(array (
  0 => 'Yes',
  1 => 'No',
));
        $this->addForeignKey('id_authy_group', 'IdAuthyGroup', 'INTEGER', 'authy_group', 'id_authy_group', true, null, 1);
        $this->addColumn('is_system', 'IsSystem', 'ENUM', true, null, 'No');
        $this->getColumn('is_system', false)->setValueSet(array (
  0 => 'Yes',
  1 => 'No',
));
        $this->addColumn('rights_all', 'RightsAll', 'LONGVARCHAR', false, null, null);
        $this->addColumn('rights_group', 'RightsGroup', 'LONGVARCHAR', false, null, null);
        $this->addColumn('rights_owner', 'RightsOwner', 'LONGVARCHAR', false, null, null);
        $this->addColumn('onglet', 'Onglet', 'LONGVARCHAR', false, null, null);
        $this->addColumn('date_creation', 'DateCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('date_modification', 'DateModification', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('id_group_creation', 'IdGroupCreation', 'INTEGER', 'authy_group', 'id_authy_group', false, null, null);
        $this->addForeignKey('id_creation', 'IdCreation', 'INTEGER', 'authy', 'id_authy', false, null, null);
        $this->addForeignKey('id_modification', 'IdModification', 'INTEGER', 'authy', 'id_authy', false, null, null);
        // validators
        $this->addValidator('email', 'required', 'propel.validator.RequiredValidator', '', 'authy_email_required');
        $this->addValidator('email', 'unique', 'propel.validator.UniqueValidator', '', 'authy_email_in_use');
        $this->addValidator('passwd_hash', 'required', 'propel.validator.RequiredValidator', '', 'authy_password_required');
        $this->addValidator('id_authy', 'required', 'propel.validator.RequiredValidator', '', ('Authy_IdAuthy_required'));
        $this->addValidator('id_authy', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Authy_IdAuthy_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('validation_key', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_ValidationKey_type_string'));
        $this->addValidator('username', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_Username_type_string'));
        $this->addValidator('fullname', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_Fullname_type_string'));
        $this->addValidator('email', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_Email_type_string'));
        $this->addValidator('passwd_hash', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_PasswdHash_type_string'));
        $this->addValidator('expire', 'match', 'propel.validator.MatchValidator', '', ('Authy_Expire_match'));
        $this->addValidator('deactivate', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_Deactivate_type_string'));
        $this->addValidator('is_root', 'required', 'propel.validator.RequiredValidator', '', ('Authy_IsRoot_required'));
        $this->addValidator('is_root', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_IsRoot_type_string'));
        $this->addValidator('is_system', 'required', 'propel.validator.RequiredValidator', '', ('Authy_IsSystem_required'));
        $this->addValidator('is_system', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_IsSystem_type_string'));
        $this->addValidator('rights_all', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_RightsAll_type_string'));
        $this->addValidator('rights_group', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_RightsGroup_type_string'));
        $this->addValidator('rights_owner', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_RightsOwner_type_string'));
        $this->addValidator('onglet', 'type', 'propel.validator.TypeValidator', 'string', ('Authy_Onglet_type_string'));
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('AuthyGroupRelatedByIdAuthyGroup', 'App\\AuthyGroup', RelationMap::MANY_TO_ONE, array('id_authy_group' => 'id_authy_group', ), 'CASCADE', null);
        $this->addRelation('AuthyGroupRelatedByIdGroupCreation', 'App\\AuthyGroup', RelationMap::MANY_TO_ONE, array('id_group_creation' => 'id_authy_group', ), null, null);
        $this->addRelation('AuthyRelatedByIdCreation', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_creation' => 'id_authy', ), null, null);
        $this->addRelation('AuthyRelatedByIdModification', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_modification' => 'id_authy', ), null, null);
        $this->addRelation('ClientRelatedByDefaultUser', 'App\\Client', RelationMap::ONE_TO_MANY, array('id_authy' => 'default_user', ), null, null, 'ClientsRelatedByDefaultUser');
        $this->addRelation('BillingLineRelatedByIdAssign', 'App\\BillingLine', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_assign', ), null, null, 'BillingLinesRelatedByIdAssign');
        $this->addRelation('AuthyGroupX', 'App\\AuthyGroupX', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_authy', ), null, 'CASCADE', 'AuthyGroupxes');
        $this->addRelation('AuthyLog', 'App\\AuthyLog', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_authy', ), null, 'CASCADE', 'AuthyLogs');
        $this->addRelation('ClientRelatedByIdCreation', 'App\\Client', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'ClientsRelatedByIdCreation');
        $this->addRelation('ClientRelatedByIdModification', 'App\\Client', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'ClientsRelatedByIdModification');
        $this->addRelation('BillingRelatedByIdCreation', 'App\\Billing', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'BillingsRelatedByIdCreation');
        $this->addRelation('BillingRelatedByIdModification', 'App\\Billing', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'BillingsRelatedByIdModification');
        $this->addRelation('BillingLineRelatedByIdCreation', 'App\\BillingLine', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'BillingLinesRelatedByIdCreation');
        $this->addRelation('BillingLineRelatedByIdModification', 'App\\BillingLine', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'BillingLinesRelatedByIdModification');
        $this->addRelation('PaymentLineRelatedByIdCreation', 'App\\PaymentLine', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'PaymentLinesRelatedByIdCreation');
        $this->addRelation('PaymentLineRelatedByIdModification', 'App\\PaymentLine', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'PaymentLinesRelatedByIdModification');
        $this->addRelation('CostLineRelatedByIdCreation', 'App\\CostLine', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'CostLinesRelatedByIdCreation');
        $this->addRelation('CostLineRelatedByIdModification', 'App\\CostLine', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'CostLinesRelatedByIdModification');
        $this->addRelation('ProjectRelatedByIdCreation', 'App\\Project', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'ProjectsRelatedByIdCreation');
        $this->addRelation('ProjectRelatedByIdModification', 'App\\Project', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'ProjectsRelatedByIdModification');
        $this->addRelation('TimeLineRelatedByIdCreation', 'App\\TimeLine', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'TimeLinesRelatedByIdCreation');
        $this->addRelation('TimeLineRelatedByIdModification', 'App\\TimeLine', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'TimeLinesRelatedByIdModification');
        $this->addRelation('BillingCategoryRelatedByIdCreation', 'App\\BillingCategory', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'BillingCategoriesRelatedByIdCreation');
        $this->addRelation('BillingCategoryRelatedByIdModification', 'App\\BillingCategory', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'BillingCategoriesRelatedByIdModification');
        $this->addRelation('CurrencyRelatedByIdCreation', 'App\\Currency', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'CurrenciesRelatedByIdCreation');
        $this->addRelation('CurrencyRelatedByIdModification', 'App\\Currency', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'CurrenciesRelatedByIdModification');
        $this->addRelation('SupplierRelatedByIdCreation', 'App\\Supplier', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'SuppliersRelatedByIdCreation');
        $this->addRelation('SupplierRelatedByIdModification', 'App\\Supplier', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'SuppliersRelatedByIdModification');
        $this->addRelation('AuthyRelatedByIdAuthy0', 'App\\Authy', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'AuthiesRelatedByIdAuthy0');
        $this->addRelation('AuthyRelatedByIdAuthy1', 'App\\Authy', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'AuthiesRelatedByIdAuthy1');
        $this->addRelation('CountryRelatedByIdCreation', 'App\\Country', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'CountriesRelatedByIdCreation');
        $this->addRelation('CountryRelatedByIdModification', 'App\\Country', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'CountriesRelatedByIdModification');
        $this->addRelation('AuthyGroupRelatedByIdCreation', 'App\\AuthyGroup', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'AuthyGroupsRelatedByIdCreation');
        $this->addRelation('AuthyGroupRelatedByIdModification', 'App\\AuthyGroup', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'AuthyGroupsRelatedByIdModification');
        $this->addRelation('ConfigRelatedByIdCreation', 'App\\Config', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'ConfigsRelatedByIdCreation');
        $this->addRelation('ConfigRelatedByIdModification', 'App\\Config', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'ConfigsRelatedByIdModification');
        $this->addRelation('ApiRbacRelatedByIdCreation', 'App\\ApiRbac', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'ApiRbacsRelatedByIdCreation');
        $this->addRelation('ApiRbacRelatedByIdModification', 'App\\ApiRbac', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'ApiRbacsRelatedByIdModification');
        $this->addRelation('ApiLog', 'App\\ApiLog', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_authy', ), 'CASCADE', null, 'ApiLogs');
        $this->addRelation('TemplateRelatedByIdCreation', 'App\\Template', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'TemplatesRelatedByIdCreation');
        $this->addRelation('TemplateRelatedByIdModification', 'App\\Template', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'TemplatesRelatedByIdModification');
        $this->addRelation('TemplateFileRelatedByIdCreation', 'App\\TemplateFile', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'TemplateFilesRelatedByIdCreation');
        $this->addRelation('TemplateFileRelatedByIdModification', 'App\\TemplateFile', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'TemplateFilesRelatedByIdModification');
        $this->addRelation('MessageI18nRelatedByIdCreation', 'App\\MessageI18n', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_creation', ), null, null, 'MessageI18nsRelatedByIdCreation');
        $this->addRelation('MessageI18nRelatedByIdModification', 'App\\MessageI18n', RelationMap::ONE_TO_MANY, array('id_authy' => 'id_modification', ), null, null, 'MessageI18nsRelatedByIdModification');
        $this->addRelation('AuthyGroups', 'App\\AuthyGroup', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'AuthyGroups');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'GoatCheese' =>  array (
  'is_auth_table' => 'true',
  'is_root_columns' => '["is_root"]',
  'set_password_columns' => '["passwd_hash"]',
  'is_rights_column' => '["rights_all","rights_owner","rights_group"]',
  'add_tab_columns' => '{"Rights":"rights_all"}',
  'i18n_langs' => '["en_US"]',
  'set_parent_menu' => 'Settings',
  'set_menu_priority' => '200',
  'set_list_hide_columns' => '["rights","passwd_hash","rights_all","rights_owner","rights_group"]',
  'add_search_columns' => '{"Name":[["username","%val","or"],["email","%val"]],"Primary group":[["id_authy_group","%val"]]}',
  'with_child_tables' => '["authy_group_x","authy_log"]',
),
            'add_validator' =>  array (
),
            'add_tablestamp' =>  array (
  'create_column' => 'date_creation',
  'update_column' => 'date_modification',
  'create_id_column' => 'id_creation',
  'group_id_column' => 'id_group_creation',
  'update_id_column' => 'id_modification',
  'exclude' => 'none',
  'foreign_keys' => 'all',
),
        );
    } // getBehaviors()

} // AuthyTableMap
