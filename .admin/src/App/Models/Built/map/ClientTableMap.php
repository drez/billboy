<?php

namespace App\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'client' table.
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
class ClientTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.ClientTableMap';

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
        $this->setName('client');
        $this->setPhpName('Client');
        $this->setClassname('App\\Client');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_client', 'IdClient', 'INTEGER', true, 10, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 100, null);
        $this->addForeignKey('id_country', 'IdCountry', 'INTEGER', 'country', 'id_country', true, 11, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 20, null);
        $this->addColumn('phone_work', 'PhoneWork', 'VARCHAR', false, 20, null);
        $this->addColumn('ext', 'Ext', 'VARCHAR', false, 10, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 100, null);
        $this->addColumn('contact', 'Contact', 'VARCHAR', false, 150, null);
        $this->addColumn('email2', 'Email2', 'VARCHAR', false, 100, null);
        $this->addColumn('phone_mobile', 'PhoneMobile', 'VARCHAR', false, 20, null);
        $this->addColumn('website', 'Website', 'VARCHAR', false, 100, null);
        $this->addColumn('address_1', 'Address1', 'LONGVARCHAR', false, 10, null);
        $this->addColumn('address_2', 'Address2', 'LONGVARCHAR', false, 10, null);
        $this->addColumn('address_3', 'Address3', 'LONGVARCHAR', false, 10, null);
        $this->addColumn('zip', 'Zip', 'VARCHAR', false, 12, null);
        $this->addColumn('date_creation', 'DateCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('date_modification', 'DateModification', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('id_group_creation', 'IdGroupCreation', 'INTEGER', 'authy_group', 'id_authy_group', false, null, null);
        $this->addForeignKey('id_creation', 'IdCreation', 'INTEGER', 'authy', 'id_authy', false, null, null);
        $this->addForeignKey('id_modification', 'IdModification', 'INTEGER', 'authy', 'id_authy', false, null, null);
        // validators
        $this->addValidator('phone', 'unique', 'propel.validator.UniqueValidator', '', 'client_phone_not_unique');
        $this->addValidator('phone', 'minLength', 'propel.validator.MinLengthValidator', '7', 'client_phone_required');
        $this->addValidator('name', 'minLength', 'propel.validator.MinLengthValidator', '1', 'client_name_required');
        $this->addValidator('id_country', 'required', 'propel.validator.RequiredValidator', '', 'client_country_required');
        $this->addValidator('id_client', 'required', 'propel.validator.RequiredValidator', '', ('Client_IdClient_required'));
        $this->addValidator('id_client', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Client_IdClient_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('name', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Name_type_string'));
        $this->addValidator('id_country', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Client_IdCountry_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('phone', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Phone_type_string'));
        $this->addValidator('phone_work', 'type', 'propel.validator.TypeValidator', 'string', ('Client_PhoneWork_type_string'));
        $this->addValidator('ext', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Ext_type_string'));
        $this->addValidator('email', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Email_type_string'));
        $this->addValidator('contact', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Contact_type_string'));
        $this->addValidator('email2', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Email2_type_string'));
        $this->addValidator('phone_mobile', 'type', 'propel.validator.TypeValidator', 'string', ('Client_PhoneMobile_type_string'));
        $this->addValidator('website', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Website_type_string'));
        $this->addValidator('address_1', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Address1_type_string'));
        $this->addValidator('address_2', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Address2_type_string'));
        $this->addValidator('address_3', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Address3_type_string'));
        $this->addValidator('zip', 'type', 'propel.validator.TypeValidator', 'string', ('Client_Zip_type_string'));
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Country', 'App\\Country', RelationMap::MANY_TO_ONE, array('id_country' => 'id_country', ), null, null);
        $this->addRelation('AuthyGroup', 'App\\AuthyGroup', RelationMap::MANY_TO_ONE, array('id_group_creation' => 'id_authy_group', ), null, null);
        $this->addRelation('AuthyRelatedByIdCreation', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_creation' => 'id_authy', ), null, null);
        $this->addRelation('AuthyRelatedByIdModification', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_modification' => 'id_authy', ), null, null);
        $this->addRelation('Billing', 'App\\Billing', RelationMap::ONE_TO_MANY, array('id_client' => 'id_client', ), null, null, 'Billings');
        $this->addRelation('Project', 'App\\Project', RelationMap::ONE_TO_MANY, array('id_client' => 'id_client', ), null, null, 'Projects');
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
  'i18n_langs' => '["en_US"]',
  'set_menu_priority' => '1',
  'with_child_tables' => '["billing"]',
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

} // ClientTableMap
