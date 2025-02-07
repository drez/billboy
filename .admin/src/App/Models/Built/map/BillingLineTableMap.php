<?php

namespace App\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'billing_line' table.
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
class BillingLineTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.BillingLineTableMap';

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
        $this->setName('billing_line');
        $this->setPhpName('BillingLine');
        $this->setClassname('App\\BillingLine');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_billing_line', 'IdBillingLine', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_billing', 'IdBilling', 'INTEGER', 'billing', 'id_billing', true, 11, null);
        $this->addColumn('calc_id', 'CalcId', 'VARCHAR', false, 20, null);
        $this->addForeignKey('id_assign', 'IdAssign', 'INTEGER', 'authy', 'id_authy', false, 11, null);
        $this->addForeignKey('id_project', 'IdProject', 'INTEGER', 'project', 'id_project', false, 11, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 100, null);
        $this->addColumn('work_date', 'WorkDate', 'DATE', false, null, null);
        $this->addColumn('quantity', 'Quantity', 'DECIMAL', true, 8, 1);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 8, 0);
        $this->addColumn('total', 'Total', 'DECIMAL', false, 8, null);
        $this->addForeignKey('id_billing_category', 'IdBillingCategory', 'INTEGER', 'billing_category', 'id_billing_category', false, 11, null);
        $this->addColumn('note_billing_ligne', 'NoteBillingLigne', 'LONGVARCHAR', false, 500, null);
        $this->addColumn('date_creation', 'DateCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('date_modification', 'DateModification', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('id_group_creation', 'IdGroupCreation', 'INTEGER', 'authy_group', 'id_authy_group', false, null, null);
        $this->addForeignKey('id_creation', 'IdCreation', 'INTEGER', 'authy', 'id_authy', false, null, null);
        $this->addForeignKey('id_modification', 'IdModification', 'INTEGER', 'authy', 'id_authy', false, null, null);
        // validators
        $this->addValidator('amount', 'minLength', 'propel.validator.MinLengthValidator', '1', 'billing_line_amount_required');
        $this->addValidator('quantity', 'minLength', 'propel.validator.MinLengthValidator', '1', 'billing_line_quantity_required');
        $this->addValidator('id_billing_line', 'required', 'propel.validator.RequiredValidator', '', ('BillingLine_IdBillingLine_required'));
        $this->addValidator('id_billing_line', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('BillingLine_IdBillingLine_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('id_billing', 'required', 'propel.validator.RequiredValidator', '', ('BillingLine_IdBilling_required'));
        $this->addValidator('id_billing', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('BillingLine_IdBilling_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('calc_id', 'type', 'propel.validator.TypeValidator', 'string', ('BillingLine_CalcId_type_string'));
        $this->addValidator('id_assign', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('BillingLine_IdAssign_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('id_project', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('BillingLine_IdProject_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('title', 'type', 'propel.validator.TypeValidator', 'string', ('BillingLine_Title_type_string'));
        $this->addValidator('work_date', 'match', 'propel.validator.MatchValidator', '', ('BillingLine_WorkDate_match'));
        $this->addValidator('quantity', 'required', 'propel.validator.RequiredValidator', '', ('BillingLine_Quantity_required'));
        $this->addValidator('amount', 'required', 'propel.validator.RequiredValidator', '', ('BillingLine_Amount_required'));
        $this->addValidator('id_billing_category', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('BillingLine_IdBillingCategory_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('note_billing_ligne', 'type', 'propel.validator.TypeValidator', 'string', ('BillingLine_NoteBillingLigne_type_string'));
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Billing', 'App\\Billing', RelationMap::MANY_TO_ONE, array('id_billing' => 'id_billing', ), 'CASCADE', null);
        $this->addRelation('AuthyRelatedByIdAssign', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_assign' => 'id_authy', ), null, null);
        $this->addRelation('Project', 'App\\Project', RelationMap::MANY_TO_ONE, array('id_project' => 'id_project', ), null, null);
        $this->addRelation('BillingCategory', 'App\\BillingCategory', RelationMap::MANY_TO_ONE, array('id_billing_category' => 'id_billing_category', ), null, null);
        $this->addRelation('AuthyGroup', 'App\\AuthyGroup', RelationMap::MANY_TO_ONE, array('id_group_creation' => 'id_authy_group', ), null, null);
        $this->addRelation('AuthyRelatedByIdCreation', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_creation' => 'id_authy', ), null, null);
        $this->addRelation('AuthyRelatedByIdModification', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_modification' => 'id_authy', ), null, null);
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
  'set_parent_table' => 'billing',
  'set_readonly_columns' => '["total"]',
  'set_selectbox_filters' => '{"id_project":[["id_client","%billing%.id_client"]]}',
  'set_child_colunms' => '{"id_creation":["fullname"],"id_assign":["fullname"]}',
  'is_wysiwyg_colunms' => '["note_billing_ligne"]',
  'add_tab_columns' => '{"Note":"note_billing_ligne"}',
  'set_order_list_columns' => '[["work_date","DESC"]]',
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

} // BillingLineTableMap
