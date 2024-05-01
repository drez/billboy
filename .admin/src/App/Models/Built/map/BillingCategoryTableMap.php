<?php

namespace App\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'billing_category' table.
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
class BillingCategoryTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.BillingCategoryTableMap';

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
        $this->setName('billing_category');
        $this->setPhpName('BillingCategory');
        $this->setClassname('App\\BillingCategory');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_billing_category', 'IdBillingCategory', 'INTEGER', true, 10, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 100, null);
        $this->addColumn('date_creation', 'DateCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('date_modification', 'DateModification', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('id_group_creation', 'IdGroupCreation', 'INTEGER', 'authy_group', 'id_authy_group', false, null, null);
        $this->addForeignKey('id_creation', 'IdCreation', 'INTEGER', 'authy', 'id_authy', false, null, null);
        $this->addForeignKey('id_modification', 'IdModification', 'INTEGER', 'authy', 'id_authy', false, null, null);
        // validators
        $this->addValidator('name', 'required', 'propel.validator.RequiredValidator', '', 'name_required');
        $this->addValidator('id_billing_category', 'required', 'propel.validator.RequiredValidator', '', ('BillingCategory_IdBillingCategory_required'));
        $this->addValidator('id_billing_category', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('BillingCategory_IdBillingCategory_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('name', 'type', 'propel.validator.TypeValidator', 'string', ('BillingCategory_Name_type_string'));
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('AuthyGroup', 'App\\AuthyGroup', RelationMap::MANY_TO_ONE, array('id_group_creation' => 'id_authy_group', ), null, null);
        $this->addRelation('AuthyRelatedByIdCreation', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_creation' => 'id_authy', ), null, null);
        $this->addRelation('AuthyRelatedByIdModification', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_modification' => 'id_authy', ), null, null);
        $this->addRelation('Billing', 'App\\Billing', RelationMap::ONE_TO_MANY, array('id_billing_category' => 'id_billing_category', ), null, null, 'Billings');
        $this->addRelation('BillingLine', 'App\\BillingLine', RelationMap::ONE_TO_MANY, array('id_billing_category' => 'id_billing_category', ), null, null, 'BillingLines');
        $this->addRelation('CostLine', 'App\\CostLine', RelationMap::ONE_TO_MANY, array('id_billing_category' => 'id_billing_category', ), null, null, 'CostLines');
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
  'set_parent_menu' => 'Settings',
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

} // BillingCategoryTableMap
