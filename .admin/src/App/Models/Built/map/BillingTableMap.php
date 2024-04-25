<?php

namespace App\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'billing' table.
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
class BillingTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.BillingTableMap';

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
        $this->setName('billing');
        $this->setPhpName('Billing');
        $this->setClassname('App\\Billing');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_billing', 'IdBilling', 'INTEGER', true, 10, null);
        $this->addColumn('calc_id', 'CalcId', 'VARCHAR', false, 20, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 100, null);
        $this->addForeignKey('id_client', 'IdClient', 'INTEGER', 'client', 'id_client', true, 11, null);
        $this->addForeignKey('id_project', 'IdProject', 'INTEGER', 'project', 'id_project', false, 11, null);
        $this->addColumn('date', 'Date', 'DATE', false, null, null);
        $this->addColumn('type', 'Type', 'ENUM', true, null, 'Bill');
        $this->getColumn('type', false)->setValueSet(array (
  0 => 'Quote',
  1 => 'Bill',
));
        $this->addColumn('state', 'State', 'ENUM', true, null, null);
        $this->getColumn('state', false)->setValueSet(array (
  0 => 'New',
  1 => 'Approved',
  2 => 'Sent',
  3 => 'Partial paiement',
  4 => 'Paid',
  5 => 'Cancelled',
  6 => 'To send',
));
        $this->addColumn('gross', 'Gross', 'DECIMAL', false, 8, null);
        $this->addColumn('date_due', 'DateDue', 'DATE', false, null, null);
        $this->addColumn('note_billing', 'NoteBilling', 'LONGVARCHAR', false, 400, null);
        $this->addColumn('date_paid', 'DatePaid', 'DATE', false, null, null);
        $this->addColumn('net', 'Net', 'DECIMAL', false, 8, null);
        $this->addColumn('reference', 'Reference', 'VARCHAR', false, 100, null);
        $this->addColumn('date_creation', 'DateCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('date_modification', 'DateModification', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('id_group_creation', 'IdGroupCreation', 'INTEGER', 'authy_group', 'id_authy_group', false, null, null);
        $this->addForeignKey('id_creation', 'IdCreation', 'INTEGER', 'authy', 'id_authy', false, null, null);
        $this->addForeignKey('id_modification', 'IdModification', 'INTEGER', 'authy', 'id_authy', false, null, null);
        // validators
        $this->addValidator('title', 'required', 'propel.validator.RequiredValidator', '', 'billing_title_required');
        $this->addValidator('id_billing', 'required', 'propel.validator.RequiredValidator', '', ('Billing_IdBilling_required'));
        $this->addValidator('id_billing', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Billing_IdBilling_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('calc_id', 'type', 'propel.validator.TypeValidator', 'string', ('Billing_CalcId_type_string'));
        $this->addValidator('title', 'type', 'propel.validator.TypeValidator', 'string', ('Billing_Title_type_string'));
        $this->addValidator('id_client', 'required', 'propel.validator.RequiredValidator', '', ('Billing_IdClient_required'));
        $this->addValidator('id_client', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Billing_IdClient_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('id_project', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Billing_IdProject_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('date', 'match', 'propel.validator.MatchValidator', '', ('Billing_Date_match'));
        $this->addValidator('type', 'required', 'propel.validator.RequiredValidator', '', ('Billing_Type_required'));
        $this->addValidator('type', 'type', 'propel.validator.TypeValidator', 'string', ('Billing_Type_type_string'));
        $this->addValidator('state', 'required', 'propel.validator.RequiredValidator', '', ('Billing_State_required'));
        $this->addValidator('state', 'type', 'propel.validator.TypeValidator', 'string', ('Billing_State_type_string'));
        $this->addValidator('date_due', 'match', 'propel.validator.MatchValidator', '', ('Billing_DateDue_match'));
        $this->addValidator('note_billing', 'type', 'propel.validator.TypeValidator', 'string', ('Billing_NoteBilling_type_string'));
        $this->addValidator('date_paid', 'match', 'propel.validator.MatchValidator', '', ('Billing_DatePaid_match'));
        $this->addValidator('reference', 'type', 'propel.validator.TypeValidator', 'string', ('Billing_Reference_type_string'));
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Client', 'App\\Client', RelationMap::MANY_TO_ONE, array('id_client' => 'id_client', ), null, null);
        $this->addRelation('Project', 'App\\Project', RelationMap::MANY_TO_ONE, array('id_project' => 'id_project', ), null, null);
        $this->addRelation('AuthyGroup', 'App\\AuthyGroup', RelationMap::MANY_TO_ONE, array('id_group_creation' => 'id_authy_group', ), null, null);
        $this->addRelation('AuthyRelatedByIdCreation', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_creation' => 'id_authy', ), null, null);
        $this->addRelation('AuthyRelatedByIdModification', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_modification' => 'id_authy', ), null, null);
        $this->addRelation('BillingLine', 'App\\BillingLine', RelationMap::ONE_TO_MANY, array('id_billing' => 'id_billing', ), 'CASCADE', null, 'BillingLines');
        $this->addRelation('PaymentLine', 'App\\PaymentLine', RelationMap::ONE_TO_MANY, array('id_billing' => 'id_billing', ), 'CASCADE', null, 'PaymentLines');
        $this->addRelation('CostLine', 'App\\CostLine', RelationMap::ONE_TO_MANY, array('id_billing' => 'id_billing', ), 'CASCADE', null, 'CostLines');
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
  'set_menu_priority' => '5',
  'set_parent_table' => 'client',
  'with_child_tables' => '["billing_line","cost_line","payment_line"]',
  'add_child_search_columns' => '{"billing_line":{"Assigned to":[["id_assign","%val"]]}}',
  'add_tab_columns' => '{"Note":"note_billing","Paiement":"date_paid"}',
  'is_wysiwyg_colunms' => '["note_billing"]',
  'add_search_columns' => '{"Type":[["type","%val","multiple"]],"Client":[["id_client","%val","multiple"]],"Date":[["date","%val"]],"Title":[["title","%val"]],"State":[["state","%val","multiple"]]}',
  'set_readonly_columns' => '["gross"]',
  'set_list_hide_columns' => '["note_billing","reference"]',
  'set_order_list_columns' => '[["date","DESC"]]',
  'set_order_child_list_columns' => '{"billing_line":[["work_date","DESC"]]}',
  'add_total' => '{"billing":[["gross"],["net"]],"billing_line":[["total"]]}',
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

} // BillingTableMap
