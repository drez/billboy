<?php

namespace App\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use App\AuthyGroupPeer;
use App\AuthyPeer;
use App\BillingCategoryPeer;
use App\BillingPeer;
use App\CostLine;
use App\CostLinePeer;
use App\ProjectPeer;
use App\SupplierPeer;
use App\map\CostLineTableMap;

/**
 * Base static class for performing query and update operations on the 'cost_line' table.
 *
 * Expense
 *
 * @package propel.generator..om
 */
abstract class BaseCostLinePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'myproject1';

    /** the table name for this class */
    const TABLE_NAME = 'cost_line';

    /** the related Propel class for this table */
    const OM_CLASS = 'App\\CostLine';

    /** the related TableMap class for this table */
    const TM_CLASS = 'App\\map\\CostLineTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 21;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 21;

    /** the column name for the id_cost_line field */
    const ID_COST_LINE = 'cost_line.id_cost_line';

    /** the column name for the id_billing field */
    const ID_BILLING = 'cost_line.id_billing';

    /** the column name for the calc_id field */
    const CALC_ID = 'cost_line.calc_id';

    /** the column name for the title field */
    const TITLE = 'cost_line.title';

    /** the column name for the id_supplier field */
    const ID_SUPPLIER = 'cost_line.id_supplier';

    /** the column name for the invoice_no field */
    const INVOICE_NO = 'cost_line.invoice_no';

    /** the column name for the id_project field */
    const ID_PROJECT = 'cost_line.id_project';

    /** the column name for the id_billing_category field */
    const ID_BILLING_CATEGORY = 'cost_line.id_billing_category';

    /** the column name for the spend_date field */
    const SPEND_DATE = 'cost_line.spend_date';

    /** the column name for the recuring field */
    const RECURING = 'cost_line.recuring';

    /** the column name for the renewal_date field */
    const RENEWAL_DATE = 'cost_line.renewal_date';

    /** the column name for the quantity field */
    const QUANTITY = 'cost_line.quantity';

    /** the column name for the amount field */
    const AMOUNT = 'cost_line.amount';

    /** the column name for the total field */
    const TOTAL = 'cost_line.total';

    /** the column name for the bill field */
    const BILL = 'cost_line.bill';

    /** the column name for the note_billing_ligne field */
    const NOTE_BILLING_LIGNE = 'cost_line.note_billing_ligne';

    /** the column name for the date_creation field */
    const DATE_CREATION = 'cost_line.date_creation';

    /** the column name for the date_modification field */
    const DATE_MODIFICATION = 'cost_line.date_modification';

    /** the column name for the id_group_creation field */
    const ID_GROUP_CREATION = 'cost_line.id_group_creation';

    /** the column name for the id_creation field */
    const ID_CREATION = 'cost_line.id_creation';

    /** the column name for the id_modification field */
    const ID_MODIFICATION = 'cost_line.id_modification';

    /** The enumerated values for the recuring field */
    const RECURING_ONCE = 'Once';
    const RECURING_MONTHLY = 'Monthly';
    const RECURING_YEARLY = 'Yearly';

    /** The enumerated values for the bill field */
    const BILL_NO = 'No';
    const BILL_YES = 'Yes';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of CostLine objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array CostLine[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. CostLinePeer::$fieldNames[CostLinePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('IdCostLine', 'IdBilling', 'CalcId', 'Title', 'IdSupplier', 'InvoiceNo', 'IdProject', 'IdBillingCategory', 'SpendDate', 'Recuring', 'RenewalDate', 'Quantity', 'Amount', 'Total', 'Bill', 'NoteBillingLigne', 'DateCreation', 'DateModification', 'IdGroupCreation', 'IdCreation', 'IdModification', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('idCostLine', 'idBilling', 'calcId', 'title', 'idSupplier', 'invoiceNo', 'idProject', 'idBillingCategory', 'spendDate', 'recuring', 'renewalDate', 'quantity', 'amount', 'total', 'bill', 'noteBillingLigne', 'dateCreation', 'dateModification', 'idGroupCreation', 'idCreation', 'idModification', ),
        BasePeer::TYPE_COLNAME => array (CostLinePeer::ID_COST_LINE, CostLinePeer::ID_BILLING, CostLinePeer::CALC_ID, CostLinePeer::TITLE, CostLinePeer::ID_SUPPLIER, CostLinePeer::INVOICE_NO, CostLinePeer::ID_PROJECT, CostLinePeer::ID_BILLING_CATEGORY, CostLinePeer::SPEND_DATE, CostLinePeer::RECURING, CostLinePeer::RENEWAL_DATE, CostLinePeer::QUANTITY, CostLinePeer::AMOUNT, CostLinePeer::TOTAL, CostLinePeer::BILL, CostLinePeer::NOTE_BILLING_LIGNE, CostLinePeer::DATE_CREATION, CostLinePeer::DATE_MODIFICATION, CostLinePeer::ID_GROUP_CREATION, CostLinePeer::ID_CREATION, CostLinePeer::ID_MODIFICATION, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID_COST_LINE', 'ID_BILLING', 'CALC_ID', 'TITLE', 'ID_SUPPLIER', 'INVOICE_NO', 'ID_PROJECT', 'ID_BILLING_CATEGORY', 'SPEND_DATE', 'RECURING', 'RENEWAL_DATE', 'QUANTITY', 'AMOUNT', 'TOTAL', 'BILL', 'NOTE_BILLING_LIGNE', 'DATE_CREATION', 'DATE_MODIFICATION', 'ID_GROUP_CREATION', 'ID_CREATION', 'ID_MODIFICATION', ),
        BasePeer::TYPE_FIELDNAME => array ('id_cost_line', 'id_billing', 'calc_id', 'title', 'id_supplier', 'invoice_no', 'id_project', 'id_billing_category', 'spend_date', 'recuring', 'renewal_date', 'quantity', 'amount', 'total', 'bill', 'note_billing_ligne', 'date_creation', 'date_modification', 'id_group_creation', 'id_creation', 'id_modification', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. CostLinePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('IdCostLine' => 0, 'IdBilling' => 1, 'CalcId' => 2, 'Title' => 3, 'IdSupplier' => 4, 'InvoiceNo' => 5, 'IdProject' => 6, 'IdBillingCategory' => 7, 'SpendDate' => 8, 'Recuring' => 9, 'RenewalDate' => 10, 'Quantity' => 11, 'Amount' => 12, 'Total' => 13, 'Bill' => 14, 'NoteBillingLigne' => 15, 'DateCreation' => 16, 'DateModification' => 17, 'IdGroupCreation' => 18, 'IdCreation' => 19, 'IdModification' => 20, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('idCostLine' => 0, 'idBilling' => 1, 'calcId' => 2, 'title' => 3, 'idSupplier' => 4, 'invoiceNo' => 5, 'idProject' => 6, 'idBillingCategory' => 7, 'spendDate' => 8, 'recuring' => 9, 'renewalDate' => 10, 'quantity' => 11, 'amount' => 12, 'total' => 13, 'bill' => 14, 'noteBillingLigne' => 15, 'dateCreation' => 16, 'dateModification' => 17, 'idGroupCreation' => 18, 'idCreation' => 19, 'idModification' => 20, ),
        BasePeer::TYPE_COLNAME => array (CostLinePeer::ID_COST_LINE => 0, CostLinePeer::ID_BILLING => 1, CostLinePeer::CALC_ID => 2, CostLinePeer::TITLE => 3, CostLinePeer::ID_SUPPLIER => 4, CostLinePeer::INVOICE_NO => 5, CostLinePeer::ID_PROJECT => 6, CostLinePeer::ID_BILLING_CATEGORY => 7, CostLinePeer::SPEND_DATE => 8, CostLinePeer::RECURING => 9, CostLinePeer::RENEWAL_DATE => 10, CostLinePeer::QUANTITY => 11, CostLinePeer::AMOUNT => 12, CostLinePeer::TOTAL => 13, CostLinePeer::BILL => 14, CostLinePeer::NOTE_BILLING_LIGNE => 15, CostLinePeer::DATE_CREATION => 16, CostLinePeer::DATE_MODIFICATION => 17, CostLinePeer::ID_GROUP_CREATION => 18, CostLinePeer::ID_CREATION => 19, CostLinePeer::ID_MODIFICATION => 20, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID_COST_LINE' => 0, 'ID_BILLING' => 1, 'CALC_ID' => 2, 'TITLE' => 3, 'ID_SUPPLIER' => 4, 'INVOICE_NO' => 5, 'ID_PROJECT' => 6, 'ID_BILLING_CATEGORY' => 7, 'SPEND_DATE' => 8, 'RECURING' => 9, 'RENEWAL_DATE' => 10, 'QUANTITY' => 11, 'AMOUNT' => 12, 'TOTAL' => 13, 'BILL' => 14, 'NOTE_BILLING_LIGNE' => 15, 'DATE_CREATION' => 16, 'DATE_MODIFICATION' => 17, 'ID_GROUP_CREATION' => 18, 'ID_CREATION' => 19, 'ID_MODIFICATION' => 20, ),
        BasePeer::TYPE_FIELDNAME => array ('id_cost_line' => 0, 'id_billing' => 1, 'calc_id' => 2, 'title' => 3, 'id_supplier' => 4, 'invoice_no' => 5, 'id_project' => 6, 'id_billing_category' => 7, 'spend_date' => 8, 'recuring' => 9, 'renewal_date' => 10, 'quantity' => 11, 'amount' => 12, 'total' => 13, 'bill' => 14, 'note_billing_ligne' => 15, 'date_creation' => 16, 'date_modification' => 17, 'id_group_creation' => 18, 'id_creation' => 19, 'id_modification' => 20, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
        CostLinePeer::RECURING => array(
            CostLinePeer::RECURING_ONCE,
            CostLinePeer::RECURING_MONTHLY,
            CostLinePeer::RECURING_YEARLY,
        ),
        CostLinePeer::BILL => array(
            CostLinePeer::BILL_NO,
            CostLinePeer::BILL_YES,
        ),
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = CostLinePeer::getFieldNames($toType);
        $key = isset(CostLinePeer::$fieldKeys[$fromType][$name]) ? CostLinePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(CostLinePeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, CostLinePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return CostLinePeer::$fieldNames[$type];
    }

    /**
     * Gets the list of values for all ENUM columns
     * @return array
     */
    public static function getValueSets()
    {
      return CostLinePeer::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM column
     *
     * @param string $colname The ENUM column name.
     *
     * @return array list of possible values for the column
     */
    public static function getValueSet($colname)
    {
        $valueSets = CostLinePeer::getValueSets();

        if (!isset($valueSets[$colname])) {
            throw new PropelException(sprintf('Column "%s" has no ValueSet.', $colname));
        }

        return $valueSets[$colname];
    }

    /**
     * Gets the SQL value for the ENUM column value
     *
     * @param string $colname ENUM column name.
     * @param string $enumVal ENUM value.
     *
     * @return int SQL value
     */
    public static function getSqlValueForEnum($colname, $enumVal)
    {
        $values = CostLinePeer::getValueSet($colname);
        if (!in_array($enumVal, $values)) {
            throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $colname));
        }

        return array_search($enumVal, $values);
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. CostLinePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(CostLinePeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CostLinePeer::ID_COST_LINE);
            $criteria->addSelectColumn(CostLinePeer::ID_BILLING);
            $criteria->addSelectColumn(CostLinePeer::CALC_ID);
            $criteria->addSelectColumn(CostLinePeer::TITLE);
            $criteria->addSelectColumn(CostLinePeer::ID_SUPPLIER);
            $criteria->addSelectColumn(CostLinePeer::INVOICE_NO);
            $criteria->addSelectColumn(CostLinePeer::ID_PROJECT);
            $criteria->addSelectColumn(CostLinePeer::ID_BILLING_CATEGORY);
            $criteria->addSelectColumn(CostLinePeer::SPEND_DATE);
            $criteria->addSelectColumn(CostLinePeer::RECURING);
            $criteria->addSelectColumn(CostLinePeer::RENEWAL_DATE);
            $criteria->addSelectColumn(CostLinePeer::QUANTITY);
            $criteria->addSelectColumn(CostLinePeer::AMOUNT);
            $criteria->addSelectColumn(CostLinePeer::TOTAL);
            $criteria->addSelectColumn(CostLinePeer::BILL);
            $criteria->addSelectColumn(CostLinePeer::NOTE_BILLING_LIGNE);
            $criteria->addSelectColumn(CostLinePeer::DATE_CREATION);
            $criteria->addSelectColumn(CostLinePeer::DATE_MODIFICATION);
            $criteria->addSelectColumn(CostLinePeer::ID_GROUP_CREATION);
            $criteria->addSelectColumn(CostLinePeer::ID_CREATION);
            $criteria->addSelectColumn(CostLinePeer::ID_MODIFICATION);
        } else {
            $criteria->addSelectColumn($alias . '.id_cost_line');
            $criteria->addSelectColumn($alias . '.id_billing');
            $criteria->addSelectColumn($alias . '.calc_id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.id_supplier');
            $criteria->addSelectColumn($alias . '.invoice_no');
            $criteria->addSelectColumn($alias . '.id_project');
            $criteria->addSelectColumn($alias . '.id_billing_category');
            $criteria->addSelectColumn($alias . '.spend_date');
            $criteria->addSelectColumn($alias . '.recuring');
            $criteria->addSelectColumn($alias . '.renewal_date');
            $criteria->addSelectColumn($alias . '.quantity');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.total');
            $criteria->addSelectColumn($alias . '.bill');
            $criteria->addSelectColumn($alias . '.note_billing_ligne');
            $criteria->addSelectColumn($alias . '.date_creation');
            $criteria->addSelectColumn($alias . '.date_modification');
            $criteria->addSelectColumn($alias . '.id_group_creation');
            $criteria->addSelectColumn($alias . '.id_creation');
            $criteria->addSelectColumn($alias . '.id_modification');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(CostLinePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return CostLine
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = CostLinePeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return CostLinePeer::populateObjects(CostLinePeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            CostLinePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param CostLine $obj A CostLine object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getIdCostLine();
            } // if key === null
            CostLinePeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A CostLine object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof CostLine) {
                $key = (string) $value->getIdCostLine();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or CostLine object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(CostLinePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return CostLine Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(CostLinePeer::$instances[$key])) {
                return CostLinePeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references) {
        foreach (CostLinePeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        CostLinePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to cost_line
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = CostLinePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = CostLinePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CostLinePeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (CostLine object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = CostLinePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = CostLinePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + CostLinePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CostLinePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            CostLinePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * Gets the SQL value for Recuring ENUM value
     *
     * @param  string $enumVal ENUM value to get SQL value for
     * @return int SQL value
     */
    public static function getRecuringSqlValue($enumVal)
    {
        return CostLinePeer::getSqlValueForEnum(CostLinePeer::RECURING, $enumVal);
    }

    /**
     * Gets the SQL value for Bill ENUM value
     *
     * @param  string $enumVal ENUM value to get SQL value for
     * @return int SQL value
     */
    public static function getBillSqlValue($enumVal)
    {
        return CostLinePeer::getSqlValueForEnum(CostLinePeer::BILL, $enumVal);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Billing table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinBilling(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Supplier table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinSupplier(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Project table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinProject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related BillingCategory table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinBillingCategory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related AuthyGroup table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAuthyGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related AuthyRelatedByIdCreation table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAuthyRelatedByIdCreation(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related AuthyRelatedByIdModification table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAuthyRelatedByIdModification(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with their Billing objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBilling(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol = CostLinePeer::NUM_HYDRATE_COLUMNS;
        BillingPeer::addSelectColumns($criteria);

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = BillingPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = BillingPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BillingPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    BillingPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (CostLine) to $obj2 (Billing)
                $obj2->addCostLine($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with their Supplier objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinSupplier(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol = CostLinePeer::NUM_HYDRATE_COLUMNS;
        SupplierPeer::addSelectColumns($criteria);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = SupplierPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = SupplierPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    SupplierPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (CostLine) to $obj2 (Supplier)
                $obj2->addCostLine($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with their Project objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinProject(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol = CostLinePeer::NUM_HYDRATE_COLUMNS;
        ProjectPeer::addSelectColumns($criteria);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ProjectPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ProjectPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ProjectPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (CostLine) to $obj2 (Project)
                $obj2->addCostLine($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with their BillingCategory objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBillingCategory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol = CostLinePeer::NUM_HYDRATE_COLUMNS;
        BillingCategoryPeer::addSelectColumns($criteria);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = BillingCategoryPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BillingCategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    BillingCategoryPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (CostLine) to $obj2 (BillingCategory)
                $obj2->addCostLine($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with their AuthyGroup objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAuthyGroup(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol = CostLinePeer::NUM_HYDRATE_COLUMNS;
        AuthyGroupPeer::addSelectColumns($criteria);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = AuthyGroupPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = AuthyGroupPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    AuthyGroupPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (CostLine) to $obj2 (AuthyGroup)
                $obj2->addCostLine($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with their Authy objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAuthyRelatedByIdCreation(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol = CostLinePeer::NUM_HYDRATE_COLUMNS;
        AuthyPeer::addSelectColumns($criteria);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = AuthyPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = AuthyPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    AuthyPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (CostLine) to $obj2 (Authy)
                $obj2->addCostLineRelatedByIdCreation($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with their Authy objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAuthyRelatedByIdModification(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol = CostLinePeer::NUM_HYDRATE_COLUMNS;
        AuthyPeer::addSelectColumns($criteria);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = AuthyPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = AuthyPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    AuthyPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (CostLine) to $obj2 (Authy)
                $obj2->addCostLineRelatedByIdModification($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of CostLine objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol2 = CostLinePeer::NUM_HYDRATE_COLUMNS;

        BillingPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol9 = $startcol8 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Billing rows

            $key2 = BillingPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = BillingPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BillingPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (CostLine) to the collection in $obj2 (Billing)
                $obj2->addCostLine($obj1);
            } // if joined row not null

            // Add objects for joined Supplier rows

            $key3 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = SupplierPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = SupplierPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    SupplierPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (CostLine) to the collection in $obj3 (Supplier)
                $obj3->addCostLine($obj1);
            } // if joined row not null

            // Add objects for joined Project rows

            $key4 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = ProjectPeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = ProjectPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    ProjectPeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (CostLine) to the collection in $obj4 (Project)
                $obj4->addCostLine($obj1);
            } // if joined row not null

            // Add objects for joined BillingCategory rows

            $key5 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol5);
            if ($key5 !== null) {
                $obj5 = BillingCategoryPeer::getInstanceFromPool($key5);
                if (!$obj5) {

                    $cls = BillingCategoryPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    BillingCategoryPeer::addInstanceToPool($obj5, $key5);
                } // if obj5 loaded

                // Add the $obj1 (CostLine) to the collection in $obj5 (BillingCategory)
                $obj5->addCostLine($obj1);
            } // if joined row not null

            // Add objects for joined AuthyGroup rows

            $key6 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol6);
            if ($key6 !== null) {
                $obj6 = AuthyGroupPeer::getInstanceFromPool($key6);
                if (!$obj6) {

                    $cls = AuthyGroupPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    AuthyGroupPeer::addInstanceToPool($obj6, $key6);
                } // if obj6 loaded

                // Add the $obj1 (CostLine) to the collection in $obj6 (AuthyGroup)
                $obj6->addCostLine($obj1);
            } // if joined row not null

            // Add objects for joined Authy rows

            $key7 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol7);
            if ($key7 !== null) {
                $obj7 = AuthyPeer::getInstanceFromPool($key7);
                if (!$obj7) {

                    $cls = AuthyPeer::getOMClass();

                    $obj7 = new $cls();
                    $obj7->hydrate($row, $startcol7);
                    AuthyPeer::addInstanceToPool($obj7, $key7);
                } // if obj7 loaded

                // Add the $obj1 (CostLine) to the collection in $obj7 (Authy)
                $obj7->addCostLineRelatedByIdCreation($obj1);
            } // if joined row not null

            // Add objects for joined Authy rows

            $key8 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol8);
            if ($key8 !== null) {
                $obj8 = AuthyPeer::getInstanceFromPool($key8);
                if (!$obj8) {

                    $cls = AuthyPeer::getOMClass();

                    $obj8 = new $cls();
                    $obj8->hydrate($row, $startcol8);
                    AuthyPeer::addInstanceToPool($obj8, $key8);
                } // if obj8 loaded

                // Add the $obj1 (CostLine) to the collection in $obj8 (Authy)
                $obj8->addCostLineRelatedByIdModification($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Billing table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptBilling(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Supplier table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptSupplier(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Project table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptProject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related BillingCategory table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptBillingCategory(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related AuthyGroup table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptAuthyGroup(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related AuthyRelatedByIdCreation table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptAuthyRelatedByIdCreation(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Returns the number of rows matching criteria, joining the related AuthyRelatedByIdModification table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptAuthyRelatedByIdModification(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            CostLinePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with all related objects except Billing.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptBilling(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol2 = CostLinePeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Supplier rows

                $key2 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = SupplierPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = SupplierPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    SupplierPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj2 (Supplier)
                $obj2->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Project rows

                $key3 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = ProjectPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = ProjectPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    ProjectPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj3 (Project)
                $obj3->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined BillingCategory rows

                $key4 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = BillingCategoryPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    BillingCategoryPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj4 (BillingCategory)
                $obj4->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined AuthyGroup rows

                $key5 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = AuthyGroupPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = AuthyGroupPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    AuthyGroupPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj5 (AuthyGroup)
                $obj5->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key6 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = AuthyPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = AuthyPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    AuthyPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj6 (Authy)
                $obj6->addCostLineRelatedByIdCreation($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key7 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol7);
                if ($key7 !== null) {
                    $obj7 = AuthyPeer::getInstanceFromPool($key7);
                    if (!$obj7) {

                        $cls = AuthyPeer::getOMClass();

                    $obj7 = new $cls();
                    $obj7->hydrate($row, $startcol7);
                    AuthyPeer::addInstanceToPool($obj7, $key7);
                } // if $obj7 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj7 (Authy)
                $obj7->addCostLineRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with all related objects except Supplier.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptSupplier(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol2 = CostLinePeer::NUM_HYDRATE_COLUMNS;

        BillingPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Billing rows

                $key2 = BillingPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj2 (Billing)
                $obj2->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Project rows

                $key3 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = ProjectPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = ProjectPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    ProjectPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj3 (Project)
                $obj3->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined BillingCategory rows

                $key4 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = BillingCategoryPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    BillingCategoryPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj4 (BillingCategory)
                $obj4->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined AuthyGroup rows

                $key5 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = AuthyGroupPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = AuthyGroupPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    AuthyGroupPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj5 (AuthyGroup)
                $obj5->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key6 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = AuthyPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = AuthyPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    AuthyPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj6 (Authy)
                $obj6->addCostLineRelatedByIdCreation($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key7 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol7);
                if ($key7 !== null) {
                    $obj7 = AuthyPeer::getInstanceFromPool($key7);
                    if (!$obj7) {

                        $cls = AuthyPeer::getOMClass();

                    $obj7 = new $cls();
                    $obj7->hydrate($row, $startcol7);
                    AuthyPeer::addInstanceToPool($obj7, $key7);
                } // if $obj7 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj7 (Authy)
                $obj7->addCostLineRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with all related objects except Project.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptProject(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol2 = CostLinePeer::NUM_HYDRATE_COLUMNS;

        BillingPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Billing rows

                $key2 = BillingPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj2 (Billing)
                $obj2->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key3 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = SupplierPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = SupplierPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    SupplierPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj3 (Supplier)
                $obj3->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined BillingCategory rows

                $key4 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = BillingCategoryPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    BillingCategoryPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj4 (BillingCategory)
                $obj4->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined AuthyGroup rows

                $key5 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = AuthyGroupPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = AuthyGroupPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    AuthyGroupPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj5 (AuthyGroup)
                $obj5->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key6 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = AuthyPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = AuthyPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    AuthyPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj6 (Authy)
                $obj6->addCostLineRelatedByIdCreation($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key7 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol7);
                if ($key7 !== null) {
                    $obj7 = AuthyPeer::getInstanceFromPool($key7);
                    if (!$obj7) {

                        $cls = AuthyPeer::getOMClass();

                    $obj7 = new $cls();
                    $obj7->hydrate($row, $startcol7);
                    AuthyPeer::addInstanceToPool($obj7, $key7);
                } // if $obj7 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj7 (Authy)
                $obj7->addCostLineRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with all related objects except BillingCategory.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptBillingCategory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol2 = CostLinePeer::NUM_HYDRATE_COLUMNS;

        BillingPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Billing rows

                $key2 = BillingPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj2 (Billing)
                $obj2->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key3 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = SupplierPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = SupplierPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    SupplierPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj3 (Supplier)
                $obj3->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Project rows

                $key4 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = ProjectPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = ProjectPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    ProjectPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj4 (Project)
                $obj4->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined AuthyGroup rows

                $key5 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = AuthyGroupPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = AuthyGroupPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    AuthyGroupPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj5 (AuthyGroup)
                $obj5->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key6 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = AuthyPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = AuthyPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    AuthyPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj6 (Authy)
                $obj6->addCostLineRelatedByIdCreation($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key7 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol7);
                if ($key7 !== null) {
                    $obj7 = AuthyPeer::getInstanceFromPool($key7);
                    if (!$obj7) {

                        $cls = AuthyPeer::getOMClass();

                    $obj7 = new $cls();
                    $obj7->hydrate($row, $startcol7);
                    AuthyPeer::addInstanceToPool($obj7, $key7);
                } // if $obj7 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj7 (Authy)
                $obj7->addCostLineRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with all related objects except AuthyGroup.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptAuthyGroup(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol2 = CostLinePeer::NUM_HYDRATE_COLUMNS;

        BillingPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Billing rows

                $key2 = BillingPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj2 (Billing)
                $obj2->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key3 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = SupplierPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = SupplierPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    SupplierPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj3 (Supplier)
                $obj3->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Project rows

                $key4 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = ProjectPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = ProjectPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    ProjectPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj4 (Project)
                $obj4->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined BillingCategory rows

                $key5 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = BillingCategoryPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    BillingCategoryPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj5 (BillingCategory)
                $obj5->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key6 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = AuthyPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = AuthyPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    AuthyPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj6 (Authy)
                $obj6->addCostLineRelatedByIdCreation($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key7 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol7);
                if ($key7 !== null) {
                    $obj7 = AuthyPeer::getInstanceFromPool($key7);
                    if (!$obj7) {

                        $cls = AuthyPeer::getOMClass();

                    $obj7 = new $cls();
                    $obj7->hydrate($row, $startcol7);
                    AuthyPeer::addInstanceToPool($obj7, $key7);
                } // if $obj7 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj7 (Authy)
                $obj7->addCostLineRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with all related objects except AuthyRelatedByIdCreation.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptAuthyRelatedByIdCreation(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol2 = CostLinePeer::NUM_HYDRATE_COLUMNS;

        BillingPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Billing rows

                $key2 = BillingPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj2 (Billing)
                $obj2->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key3 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = SupplierPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = SupplierPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    SupplierPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj3 (Supplier)
                $obj3->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Project rows

                $key4 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = ProjectPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = ProjectPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    ProjectPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj4 (Project)
                $obj4->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined BillingCategory rows

                $key5 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = BillingCategoryPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    BillingCategoryPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj5 (BillingCategory)
                $obj5->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined AuthyGroup rows

                $key6 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = AuthyGroupPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = AuthyGroupPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    AuthyGroupPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj6 (AuthyGroup)
                $obj6->addCostLine($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of CostLine objects pre-filled with all related objects except AuthyRelatedByIdModification.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of CostLine objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptAuthyRelatedByIdModification(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(CostLinePeer::DATABASE_NAME);
        }

        CostLinePeer::addSelectColumns($criteria);
        $startcol2 = CostLinePeer::NUM_HYDRATE_COLUMNS;

        BillingPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(CostLinePeer::ID_BILLING, BillingPeer::ID_BILLING, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(CostLinePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = CostLinePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = CostLinePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = CostLinePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                CostLinePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Billing rows

                $key2 = BillingPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj2 (Billing)
                $obj2->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key3 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = SupplierPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = SupplierPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    SupplierPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj3 (Supplier)
                $obj3->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined Project rows

                $key4 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = ProjectPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = ProjectPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    ProjectPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj4 (Project)
                $obj4->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined BillingCategory rows

                $key5 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = BillingCategoryPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    BillingCategoryPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj5 (BillingCategory)
                $obj5->addCostLine($obj1);

            } // if joined row is not null

                // Add objects for joined AuthyGroup rows

                $key6 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = AuthyGroupPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = AuthyGroupPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    AuthyGroupPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (CostLine) to the collection in $obj6 (AuthyGroup)
                $obj6->addCostLine($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(CostLinePeer::DATABASE_NAME)->getTable(CostLinePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseCostLinePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseCostLinePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \App\map\CostLineTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return CostLinePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a CostLine or Criteria object.
     *
     * @param      mixed $values Criteria or CostLine object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from CostLine object
        }

        if ($criteria->containsKey(CostLinePeer::ID_COST_LINE) && $criteria->keyContainsValue(CostLinePeer::ID_COST_LINE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CostLinePeer::ID_COST_LINE.')');
        }


        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a CostLine or Criteria object.
     *
     * @param      mixed $values Criteria or CostLine object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(CostLinePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(CostLinePeer::ID_COST_LINE);
            $value = $criteria->remove(CostLinePeer::ID_COST_LINE);
            if ($value) {
                $selectCriteria->add(CostLinePeer::ID_COST_LINE, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(CostLinePeer::TABLE_NAME);
            }

        } else { // $values is CostLine object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the cost_line table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(CostLinePeer::TABLE_NAME, $con, CostLinePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CostLinePeer::clearInstancePool();
            CostLinePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a CostLine or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or CostLine object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            CostLinePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof CostLine) { // it's a model object
            // invalidate the cache for this single object
            CostLinePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CostLinePeer::DATABASE_NAME);
            $criteria->add(CostLinePeer::ID_COST_LINE, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                CostLinePeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(CostLinePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            CostLinePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given CostLine object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param CostLine $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(CostLinePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(CostLinePeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::ID_SUPPLIER))
            $columns[CostLinePeer::ID_SUPPLIER] = $obj->getIdSupplier();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::SPEND_DATE))
            $columns[CostLinePeer::SPEND_DATE] = $obj->getSpendDate();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::AMOUNT))
            $columns[CostLinePeer::AMOUNT] = $obj->getAmount();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::QUANTITY))
            $columns[CostLinePeer::QUANTITY] = $obj->getQuantity();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::ID_BILLING))
            $columns[CostLinePeer::ID_BILLING] = $obj->getIdBilling();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::CALC_ID))
            $columns[CostLinePeer::CALC_ID] = $obj->getCalcId();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::TITLE))
            $columns[CostLinePeer::TITLE] = $obj->getTitle();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::TITLE))
            $columns[CostLinePeer::TITLE] = $obj->getTitle();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::ID_SUPPLIER))
            $columns[CostLinePeer::ID_SUPPLIER] = $obj->getIdSupplier();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::INVOICE_NO))
            $columns[CostLinePeer::INVOICE_NO] = $obj->getInvoiceNo();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::ID_PROJECT))
            $columns[CostLinePeer::ID_PROJECT] = $obj->getIdProject();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::ID_BILLING_CATEGORY))
            $columns[CostLinePeer::ID_BILLING_CATEGORY] = $obj->getIdBillingCategory();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::SPEND_DATE))
            $columns[CostLinePeer::SPEND_DATE] = $obj->getSpendDate();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::RECURING))
            $columns[CostLinePeer::RECURING] = $obj->getRecuring();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::RECURING))
            $columns[CostLinePeer::RECURING] = $obj->getRecuring();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::RENEWAL_DATE))
            $columns[CostLinePeer::RENEWAL_DATE] = $obj->getRenewalDate();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::QUANTITY))
            $columns[CostLinePeer::QUANTITY] = $obj->getQuantity();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::AMOUNT))
            $columns[CostLinePeer::AMOUNT] = $obj->getAmount();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::BILL))
            $columns[CostLinePeer::BILL] = $obj->getBill();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::BILL))
            $columns[CostLinePeer::BILL] = $obj->getBill();

        if ($obj->isNew() || $obj->isColumnModified(CostLinePeer::NOTE_BILLING_LIGNE))
            $columns[CostLinePeer::NOTE_BILLING_LIGNE] = $obj->getNoteBillingLigne();

        }

        return BasePeer::doValidate(CostLinePeer::DATABASE_NAME, CostLinePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return CostLine
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = CostLinePeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(CostLinePeer::DATABASE_NAME);
        $criteria->add(CostLinePeer::ID_COST_LINE, $pk);

        $v = CostLinePeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return CostLine[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(CostLinePeer::DATABASE_NAME);
            $criteria->add(CostLinePeer::ID_COST_LINE, $pks, Criteria::IN);
            $objs = CostLinePeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseCostLinePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseCostLinePeer::buildTableMap();

