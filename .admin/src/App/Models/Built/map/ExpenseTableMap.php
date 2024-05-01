<?php

namespace App\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'expense' table.
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
class ExpenseTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.ExpenseTableMap';

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
        $this->setName('expense');
        $this->setPhpName('Expense');
        $this->setClassname('App\\Expense');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_expense', 'IdExpense', 'INTEGER', true, 10, null);
        $this->addColumn('date', 'Date', 'DATE', false, null, null);
        $this->addColumn('quantity', 'Quantity', 'DECIMAL', false, 8, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', false, 8, null);
        $this->addColumn('total', 'Total', 'DECIMAL', false, 8, null);
        $this->addColumn('title', 'Title', 'VARCHAR', false, 100, null);
        $this->addForeignKey('id_billing_category', 'IdBillingCategory', 'INTEGER', 'billing_category', 'id_billing_category', false, 11, null);
        $this->addColumn('note_expense_ligne', 'NoteExpenseLigne', 'LONGVARCHAR', false, 500, null);
        $this->addForeignKey('id_client', 'IdClient', 'INTEGER', 'project', 'id_client', false, 11, null);
        $this->addForeignKey('id_project', 'IdProject', 'INTEGER', 'project', 'id_project', false, 11, null);
        $this->addForeignKey('id_assign', 'IdAssign', 'INTEGER', 'authy', 'id_creation', false, 11, null);
        $this->addForeignKey('id_supplier', 'IdSupplier', 'INTEGER', 'supplier', 'id_supplier', false, 11, null);
        $this->addColumn('invoice_no', 'InvoiceNo', 'VARCHAR', false, 100, null);
        $this->addColumn('date_creation', 'DateCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('date_modification', 'DateModification', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('id_group_creation', 'IdGroupCreation', 'INTEGER', 'authy_group', 'id_authy_group', false, null, null);
        $this->addForeignKey('id_creation', 'IdCreation', 'INTEGER', 'authy', 'id_authy', false, null, null);
        $this->addForeignKey('id_modification', 'IdModification', 'INTEGER', 'authy', 'id_authy', false, null, null);
        // validators
        $this->addValidator('amount', 'required', 'propel.validator.RequiredValidator', '', 'expense_line_amount_required');
        $this->addValidator('id_expense', 'required', 'propel.validator.RequiredValidator', '', ('Expense_IdExpense_required'));
        $this->addValidator('id_expense', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Expense_IdExpense_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('date', 'match', 'propel.validator.MatchValidator', '', ('Expense_Date_match'));
        $this->addValidator('title', 'type', 'propel.validator.TypeValidator', 'string', ('Expense_Title_type_string'));
        $this->addValidator('id_billing_category', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Expense_IdBillingCategory_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('note_expense_ligne', 'type', 'propel.validator.TypeValidator', 'string', ('Expense_NoteExpenseLigne_type_string'));
        $this->addValidator('id_client', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Expense_IdClient_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('id_project', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Expense_IdProject_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('id_assign', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Expense_IdAssign_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('id_supplier', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Expense_IdSupplier_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('invoice_no', 'type', 'propel.validator.TypeValidator', 'string', ('Expense_InvoiceNo_type_string'));
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BillingCategory', 'App\\BillingCategory', RelationMap::MANY_TO_ONE, array('id_billing_category' => 'id_billing_category', ), null, null);
        $this->addRelation('ProjectRelatedByIdClient', 'App\\Project', RelationMap::MANY_TO_ONE, array('id_client' => 'id_client', ), null, null);
        $this->addRelation('ProjectRelatedByIdProject', 'App\\Project', RelationMap::MANY_TO_ONE, array('id_project' => 'id_project', ), null, null);
        $this->addRelation('AuthyRelatedByIdAssign', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_assign' => 'id_creation', ), null, null);
        $this->addRelation('Supplier', 'App\\Supplier', RelationMap::MANY_TO_ONE, array('id_supplier' => 'id_supplier', ), null, null);
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
  'set_menu_priority' => '1',
  'set_readonly_columns' => '["total"]',
  'set_child_colunms' => '{"id_creation":["fullname"],"id_assign":["fullname"]}',
  'is_wysiwyg_colunms' => '["note_expense_ligne"]',
  'add_tab_columns' => '{"Note":"note_expense_ligne","Client":"id_assign","Description":"title"}',
  'set_order_list_columns' => '[["date","DESC"]]',
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

} // ExpenseTableMap
