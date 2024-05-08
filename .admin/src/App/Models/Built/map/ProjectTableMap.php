<?php

namespace App\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'project' table.
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
class ProjectTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.ProjectTableMap';

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
        $this->setName('project');
        $this->setPhpName('Project');
        $this->setClassname('App\\Project');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_project', 'IdProject', 'INTEGER', true, 10, null);
        $this->addColumn('calc_id', 'CalcId', 'VARCHAR', false, 20, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 100, null);
        $this->addForeignKey('id_client', 'IdClient', 'INTEGER', 'client', 'id_client', false, 11, null);
        $this->addColumn('date', 'Date', 'DATE', false, null, null);
        $this->addColumn('type', 'Type', 'ENUM', false, null, null);
        $this->getColumn('type', false)->setValueSet(array (
  0 => 'Quote',
  1 => 'Bill',
));
        $this->addColumn('state', 'State', 'ENUM', false, null, null);
        $this->getColumn('state', false)->setValueSet(array (
  0 => 'New',
  1 => 'Approved',
  2 => 'Cancelled',
  3 => 'Closed',
));
        $this->addColumn('budget', 'Budget', 'DECIMAL', false, 8, null);
        $this->addColumn('spent', 'Spent', 'DECIMAL', false, 8, null);
        $this->addColumn('reference', 'Reference', 'VARCHAR', false, 100, null);
        $this->addColumn('date_creation', 'DateCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('date_modification', 'DateModification', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('id_group_creation', 'IdGroupCreation', 'INTEGER', 'authy_group', 'id_authy_group', false, null, null);
        $this->addForeignKey('id_creation', 'IdCreation', 'INTEGER', 'authy', 'id_authy', false, null, null);
        $this->addForeignKey('id_modification', 'IdModification', 'INTEGER', 'authy', 'id_authy', false, null, null);
        // validators
        $this->addValidator('name', 'required', 'propel.validator.RequiredValidator', '', 'project_name__required');
        $this->addValidator('id_project', 'required', 'propel.validator.RequiredValidator', '', ('Project_IdProject_required'));
        $this->addValidator('id_project', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Project_IdProject_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('calc_id', 'type', 'propel.validator.TypeValidator', 'string', ('Project_CalcId_type_string'));
        $this->addValidator('name', 'type', 'propel.validator.TypeValidator', 'string', ('Project_Name_type_string'));
        $this->addValidator('id_client', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('Project_IdClient_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('date', 'match', 'propel.validator.MatchValidator', '', ('Project_Date_match'));
        $this->addValidator('type', 'type', 'propel.validator.TypeValidator', 'string', ('Project_Type_type_string'));
        $this->addValidator('state', 'type', 'propel.validator.TypeValidator', 'string', ('Project_State_type_string'));
        $this->addValidator('reference', 'type', 'propel.validator.TypeValidator', 'string', ('Project_Reference_type_string'));
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Client', 'App\\Client', RelationMap::MANY_TO_ONE, array('id_client' => 'id_client', ), null, null);
        $this->addRelation('AuthyGroup', 'App\\AuthyGroup', RelationMap::MANY_TO_ONE, array('id_group_creation' => 'id_authy_group', ), null, null);
        $this->addRelation('AuthyRelatedByIdCreation', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_creation' => 'id_authy', ), null, null);
        $this->addRelation('AuthyRelatedByIdModification', 'App\\Authy', RelationMap::MANY_TO_ONE, array('id_modification' => 'id_authy', ), null, null);
        $this->addRelation('Billing', 'App\\Billing', RelationMap::ONE_TO_MANY, array('id_project' => 'id_project', ), null, null, 'Billings');
        $this->addRelation('BillingLine', 'App\\BillingLine', RelationMap::ONE_TO_MANY, array('id_project' => 'id_project', ), null, null, 'BillingLines');
        $this->addRelation('CostLine', 'App\\CostLine', RelationMap::ONE_TO_MANY, array('id_project' => 'id_project', ), null, null, 'CostLines');
        $this->addRelation('TimeLine', 'App\\TimeLine', RelationMap::ONE_TO_MANY, array('id_project' => 'id_project', ), 'CASCADE', null, 'TimeLines');
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
  'with_child_tables' => '["billing_line","time_line"]',
  'child_table_read_only' => '["billing_line"]',
  'add_tab_columns' => '{"Budget":"budget"}',
  'is_wysiwyg_colunms' => '["note_billing"]',
  'add_search_columns' => '{"Client":[["id_client","%val"]],"Date":[["date","%val"]],"Title":[["title","%val"]]}',
  'set_readonly_columns' => '["spent"]',
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

} // ProjectTableMap
