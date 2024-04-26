<?php

namespace App\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'time_line' table.
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
class TimeLineTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.map.TimeLineTableMap';

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
        $this->setName('time_line');
        $this->setPhpName('TimeLine');
        $this->setClassname('App\\TimeLine');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id_cost_line', 'IdCostLine', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_project', 'IdProject', 'INTEGER', 'project', 'id_project', true, 11, null);
        $this->addColumn('calc_id', 'CalcId', 'VARCHAR', false, 20, null);
        $this->addColumn('Name', 'Name', 'VARCHAR', false, 100, null);
        $this->addColumn('date', 'Date', 'DATE', false, null, null);
        $this->addColumn('note', 'Note', 'LONGVARCHAR', false, 500, null);
        $this->addColumn('quantity', 'Quantity', 'DECIMAL', false, 8, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', false, 8, null);
        $this->addColumn('total', 'Total', 'DECIMAL', false, 8, null);
        $this->addColumn('date_creation', 'DateCreation', 'TIMESTAMP', false, null, null);
        $this->addColumn('date_modification', 'DateModification', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('id_group_creation', 'IdGroupCreation', 'INTEGER', 'authy_group', 'id_authy_group', false, null, null);
        $this->addForeignKey('id_creation', 'IdCreation', 'INTEGER', 'authy', 'id_authy', false, null, null);
        $this->addForeignKey('id_modification', 'IdModification', 'INTEGER', 'authy', 'id_authy', false, null, null);
        // validators
        $this->addValidator('amount', 'required', 'propel.validator.RequiredValidator', '', 'cost_line_amount_required');
        $this->addValidator('id_cost_line', 'required', 'propel.validator.RequiredValidator', '', ('TimeLine_IdCostLine_required'));
        $this->addValidator('id_cost_line', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('TimeLine_IdCostLine_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('id_project', 'required', 'propel.validator.RequiredValidator', '', ('TimeLine_IdProject_required'));
        $this->addValidator('id_project', 'match', 'propel.validator.MatchValidator', '/^(?:[0-9]*|null)$/', ('TimeLine_IdProject_match_/^(?:[0-9]*|null)$/'));
        $this->addValidator('calc_id', 'type', 'propel.validator.TypeValidator', 'string', ('TimeLine_CalcId_type_string'));
        $this->addValidator('Name', 'type', 'propel.validator.TypeValidator', 'string', ('TimeLine_Name_type_string'));
        $this->addValidator('date', 'match', 'propel.validator.MatchValidator', '', ('TimeLine_Date_match'));
        $this->addValidator('note', 'type', 'propel.validator.TypeValidator', 'string', ('TimeLine_Note_type_string'));
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Project', 'App\\Project', RelationMap::MANY_TO_ONE, array('id_project' => 'id_project', ), 'CASCADE', null);
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
  'set_parent_table' => 'project',
  'set_readonly_columns' => '["total"]',
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

} // TimeLineTableMap
