<?php

namespace App\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'payment_line' table.
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
class PaymentLineTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.PaymentLineTableMap';

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
        $this->setName('payment_line');
        $this->setPhpName('PaymentLine');
        $this->setClassname('App\\PaymentLine');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_payment_line', 'IdPaymentLine', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_billing', 'IdBilling', 'INTEGER', 'billing', 'id_billing', false, 11, null);
        $this->addColumn('Reference', 'Reference', 'VARCHAR', false, 40, null);
        $this->addColumn('date', 'Date', 'DATE', false, null, null);
        $this->addColumn('note', 'Note', 'LONGVARCHAR', false, 500, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 8, 0);
        $this->addColumn('date_creation', 'DateCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('date_modification', 'DateModification', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('id_group_creation', 'IdGroupCreation', 'INTEGER', 'authy_group', 'id_authy_group', false, null, null);
        $this->addForeignKey('id_creation', 'IdCreation', 'INTEGER', 'authy', 'id_authy', false, null, null);
        $this->addForeignKey('id_modification', 'IdModification', 'INTEGER', 'authy', 'id_authy', false, null, null);
        // validators
        $this->addValidator('amount', 'minLength', 'propel.validator.MinLengthValidator', '1', 'payment_line_amount_required');
        $this->addValidator('id_payment_line', 'required', 'propel.validator.RequiredValidator', '', ('PaymentLine_IdPaymentLine_required'));
        $this->addValidator('id_payment_line', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('PaymentLine_IdPaymentLine_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('id_billing', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('PaymentLine_IdBilling_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('Reference', 'type', 'propel.validator.TypeValidator', 'string', ('PaymentLine_Reference_type_string'));
        $this->addValidator('date', 'match', 'propel.validator.MatchValidator', '', ('PaymentLine_Date_match'));
        $this->addValidator('note', 'type', 'propel.validator.TypeValidator', 'string', ('PaymentLine_Note_type_string'));
        $this->addValidator('amount', 'required', 'propel.validator.RequiredValidator', '', ('PaymentLine_Amount_required'));
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Billing', 'App\\Billing', RelationMap::MANY_TO_ONE, array('id_billing' => 'id_billing', ), 'CASCADE', null);
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
  'set_menu_priority' => '5',
  'set_selectbox_filters' => '{"id_project":[["id_client","%billing%.id_client"]],"id_billing":[["type","Bill"]]}',
  'set_child_colunms' => '{"id_billing":["client.name","title","date"]}',
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

} // PaymentLineTableMap
