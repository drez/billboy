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
use App\Billing;
use App\BillingCategoryPeer;
use App\BillingLinePeer;
use App\BillingPeer;
use App\ClientPeer;
use App\CostLinePeer;
use App\PaymentLinePeer;
use App\ProjectPeer;
use App\map\BillingTableMap;

/**
 * Base static class for performing query and update operations on the 'billing' table.
 *
 * Billing
 *
 * @package propel.generator..om
 */
abstract class BaseBillingPeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'myproject1';

    /** the table name for this class */
    const TABLE_NAME = 'billing';

    /** the related Propel class for this table */
    const OM_CLASS = 'App\\Billing';

    /** the related TableMap class for this table */
    const TM_CLASS = 'App\\map\\BillingTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 21;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 21;

    /** the column name for the id_billing field */
    const ID_BILLING = 'billing.id_billing';

    /** the column name for the calc_id field */
    const CALC_ID = 'billing.calc_id';

    /** the column name for the title field */
    const TITLE = 'billing.title';

    /** the column name for the id_client field */
    const ID_CLIENT = 'billing.id_client';

    /** the column name for the id_project field */
    const ID_PROJECT = 'billing.id_project';

    /** the column name for the id_billing_category field */
    const ID_BILLING_CATEGORY = 'billing.id_billing_category';

    /** the column name for the date field */
    const DATE = 'billing.date';

    /** the column name for the type field */
    const TYPE = 'billing.type';

    /** the column name for the state field */
    const STATE = 'billing.state';

    /** the column name for the gross field */
    const GROSS = 'billing.gross';

    /** the column name for the tax field */
    const TAX = 'billing.tax';

    /** the column name for the date_due field */
    const DATE_DUE = 'billing.date_due';

    /** the column name for the note_billing field */
    const NOTE_BILLING = 'billing.note_billing';

    /** the column name for the date_paid field */
    const DATE_PAID = 'billing.date_paid';

    /** the column name for the net field */
    const NET = 'billing.net';

    /** the column name for the reference field */
    const REFERENCE = 'billing.reference';

    /** the column name for the date_creation field */
    const DATE_CREATION = 'billing.date_creation';

    /** the column name for the date_modification field */
    const DATE_MODIFICATION = 'billing.date_modification';

    /** the column name for the id_group_creation field */
    const ID_GROUP_CREATION = 'billing.id_group_creation';

    /** the column name for the id_creation field */
    const ID_CREATION = 'billing.id_creation';

    /** the column name for the id_modification field */
    const ID_MODIFICATION = 'billing.id_modification';

    /** The enumerated values for the type field */
    const TYPE_QUOTE = 'Quote';
    const TYPE_BILL = 'Bill';

    /** The enumerated values for the state field */
    const STATE_NEW = 'New';
    const STATE_APPROVED = 'Approved';
    const STATE_SENT = 'Sent';
    const STATE_PARTIAL_PAIEMENT = 'Partial paiement';
    const STATE_PAID = 'Paid';
    const STATE_CANCELLED = 'Cancelled';
    const STATE_TO_SEND = 'To send';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of Billing objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Billing[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. BillingPeer::$fieldNames[BillingPeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('IdBilling', 'CalcId', 'Title', 'IdClient', 'IdProject', 'IdBillingCategory', 'Date', 'Type', 'State', 'Gross', 'Tax', 'DateDue', 'NoteBilling', 'DatePaid', 'Net', 'Reference', 'DateCreation', 'DateModification', 'IdGroupCreation', 'IdCreation', 'IdModification', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('idBilling', 'calcId', 'title', 'idClient', 'idProject', 'idBillingCategory', 'date', 'type', 'state', 'gross', 'tax', 'dateDue', 'noteBilling', 'datePaid', 'net', 'reference', 'dateCreation', 'dateModification', 'idGroupCreation', 'idCreation', 'idModification', ),
        BasePeer::TYPE_COLNAME => array (BillingPeer::ID_BILLING, BillingPeer::CALC_ID, BillingPeer::TITLE, BillingPeer::ID_CLIENT, BillingPeer::ID_PROJECT, BillingPeer::ID_BILLING_CATEGORY, BillingPeer::DATE, BillingPeer::TYPE, BillingPeer::STATE, BillingPeer::GROSS, BillingPeer::TAX, BillingPeer::DATE_DUE, BillingPeer::NOTE_BILLING, BillingPeer::DATE_PAID, BillingPeer::NET, BillingPeer::REFERENCE, BillingPeer::DATE_CREATION, BillingPeer::DATE_MODIFICATION, BillingPeer::ID_GROUP_CREATION, BillingPeer::ID_CREATION, BillingPeer::ID_MODIFICATION, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID_BILLING', 'CALC_ID', 'TITLE', 'ID_CLIENT', 'ID_PROJECT', 'ID_BILLING_CATEGORY', 'DATE', 'TYPE', 'STATE', 'GROSS', 'TAX', 'DATE_DUE', 'NOTE_BILLING', 'DATE_PAID', 'NET', 'REFERENCE', 'DATE_CREATION', 'DATE_MODIFICATION', 'ID_GROUP_CREATION', 'ID_CREATION', 'ID_MODIFICATION', ),
        BasePeer::TYPE_FIELDNAME => array ('id_billing', 'calc_id', 'title', 'id_client', 'id_project', 'id_billing_category', 'date', 'type', 'state', 'gross', 'tax', 'date_due', 'note_billing', 'date_paid', 'net', 'reference', 'date_creation', 'date_modification', 'id_group_creation', 'id_creation', 'id_modification', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. BillingPeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('IdBilling' => 0, 'CalcId' => 1, 'Title' => 2, 'IdClient' => 3, 'IdProject' => 4, 'IdBillingCategory' => 5, 'Date' => 6, 'Type' => 7, 'State' => 8, 'Gross' => 9, 'Tax' => 10, 'DateDue' => 11, 'NoteBilling' => 12, 'DatePaid' => 13, 'Net' => 14, 'Reference' => 15, 'DateCreation' => 16, 'DateModification' => 17, 'IdGroupCreation' => 18, 'IdCreation' => 19, 'IdModification' => 20, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('idBilling' => 0, 'calcId' => 1, 'title' => 2, 'idClient' => 3, 'idProject' => 4, 'idBillingCategory' => 5, 'date' => 6, 'type' => 7, 'state' => 8, 'gross' => 9, 'tax' => 10, 'dateDue' => 11, 'noteBilling' => 12, 'datePaid' => 13, 'net' => 14, 'reference' => 15, 'dateCreation' => 16, 'dateModification' => 17, 'idGroupCreation' => 18, 'idCreation' => 19, 'idModification' => 20, ),
        BasePeer::TYPE_COLNAME => array (BillingPeer::ID_BILLING => 0, BillingPeer::CALC_ID => 1, BillingPeer::TITLE => 2, BillingPeer::ID_CLIENT => 3, BillingPeer::ID_PROJECT => 4, BillingPeer::ID_BILLING_CATEGORY => 5, BillingPeer::DATE => 6, BillingPeer::TYPE => 7, BillingPeer::STATE => 8, BillingPeer::GROSS => 9, BillingPeer::TAX => 10, BillingPeer::DATE_DUE => 11, BillingPeer::NOTE_BILLING => 12, BillingPeer::DATE_PAID => 13, BillingPeer::NET => 14, BillingPeer::REFERENCE => 15, BillingPeer::DATE_CREATION => 16, BillingPeer::DATE_MODIFICATION => 17, BillingPeer::ID_GROUP_CREATION => 18, BillingPeer::ID_CREATION => 19, BillingPeer::ID_MODIFICATION => 20, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID_BILLING' => 0, 'CALC_ID' => 1, 'TITLE' => 2, 'ID_CLIENT' => 3, 'ID_PROJECT' => 4, 'ID_BILLING_CATEGORY' => 5, 'DATE' => 6, 'TYPE' => 7, 'STATE' => 8, 'GROSS' => 9, 'TAX' => 10, 'DATE_DUE' => 11, 'NOTE_BILLING' => 12, 'DATE_PAID' => 13, 'NET' => 14, 'REFERENCE' => 15, 'DATE_CREATION' => 16, 'DATE_MODIFICATION' => 17, 'ID_GROUP_CREATION' => 18, 'ID_CREATION' => 19, 'ID_MODIFICATION' => 20, ),
        BasePeer::TYPE_FIELDNAME => array ('id_billing' => 0, 'calc_id' => 1, 'title' => 2, 'id_client' => 3, 'id_project' => 4, 'id_billing_category' => 5, 'date' => 6, 'type' => 7, 'state' => 8, 'gross' => 9, 'tax' => 10, 'date_due' => 11, 'note_billing' => 12, 'date_paid' => 13, 'net' => 14, 'reference' => 15, 'date_creation' => 16, 'date_modification' => 17, 'id_group_creation' => 18, 'id_creation' => 19, 'id_modification' => 20, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
        BillingPeer::TYPE => array(
            BillingPeer::TYPE_QUOTE,
            BillingPeer::TYPE_BILL,
        ),
        BillingPeer::STATE => array(
            BillingPeer::STATE_NEW,
            BillingPeer::STATE_APPROVED,
            BillingPeer::STATE_SENT,
            BillingPeer::STATE_PARTIAL_PAIEMENT,
            BillingPeer::STATE_PAID,
            BillingPeer::STATE_CANCELLED,
            BillingPeer::STATE_TO_SEND,
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
        $toNames = BillingPeer::getFieldNames($toType);
        $key = isset(BillingPeer::$fieldKeys[$fromType][$name]) ? BillingPeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(BillingPeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, BillingPeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return BillingPeer::$fieldNames[$type];
    }

    /**
     * Gets the list of values for all ENUM columns
     * @return array
     */
    public static function getValueSets()
    {
      return BillingPeer::$enumValueSets;
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
        $valueSets = BillingPeer::getValueSets();

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
        $values = BillingPeer::getValueSet($colname);
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
     * @param      string $column The column name for current table. (i.e. BillingPeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(BillingPeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(BillingPeer::ID_BILLING);
            $criteria->addSelectColumn(BillingPeer::CALC_ID);
            $criteria->addSelectColumn(BillingPeer::TITLE);
            $criteria->addSelectColumn(BillingPeer::ID_CLIENT);
            $criteria->addSelectColumn(BillingPeer::ID_PROJECT);
            $criteria->addSelectColumn(BillingPeer::ID_BILLING_CATEGORY);
            $criteria->addSelectColumn(BillingPeer::DATE);
            $criteria->addSelectColumn(BillingPeer::TYPE);
            $criteria->addSelectColumn(BillingPeer::STATE);
            $criteria->addSelectColumn(BillingPeer::GROSS);
            $criteria->addSelectColumn(BillingPeer::TAX);
            $criteria->addSelectColumn(BillingPeer::DATE_DUE);
            $criteria->addSelectColumn(BillingPeer::NOTE_BILLING);
            $criteria->addSelectColumn(BillingPeer::DATE_PAID);
            $criteria->addSelectColumn(BillingPeer::NET);
            $criteria->addSelectColumn(BillingPeer::REFERENCE);
            $criteria->addSelectColumn(BillingPeer::DATE_CREATION);
            $criteria->addSelectColumn(BillingPeer::DATE_MODIFICATION);
            $criteria->addSelectColumn(BillingPeer::ID_GROUP_CREATION);
            $criteria->addSelectColumn(BillingPeer::ID_CREATION);
            $criteria->addSelectColumn(BillingPeer::ID_MODIFICATION);
        } else {
            $criteria->addSelectColumn($alias . '.id_billing');
            $criteria->addSelectColumn($alias . '.calc_id');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.id_client');
            $criteria->addSelectColumn($alias . '.id_project');
            $criteria->addSelectColumn($alias . '.id_billing_category');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.state');
            $criteria->addSelectColumn($alias . '.gross');
            $criteria->addSelectColumn($alias . '.tax');
            $criteria->addSelectColumn($alias . '.date_due');
            $criteria->addSelectColumn($alias . '.note_billing');
            $criteria->addSelectColumn($alias . '.date_paid');
            $criteria->addSelectColumn($alias . '.net');
            $criteria->addSelectColumn($alias . '.reference');
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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(BillingPeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return Billing
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = BillingPeer::doSelect($critcopy, $con);
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
        return BillingPeer::populateObjects(BillingPeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            BillingPeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

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
     * @param Billing $obj A Billing object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getIdBilling();
            } // if key === null
            BillingPeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Billing object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Billing) {
                $key = (string) $value->getIdBilling();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Billing object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(BillingPeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return Billing Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(BillingPeer::$instances[$key])) {
                return BillingPeer::$instances[$key];
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
        foreach (BillingPeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        BillingPeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to billing
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in BillingLinePeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        BillingLinePeer::clearInstancePool();
        // Invalidate objects in PaymentLinePeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        PaymentLinePeer::clearInstancePool();
        // Invalidate objects in CostLinePeer instance pool,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        CostLinePeer::clearInstancePool();
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
        $cls = BillingPeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = BillingPeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BillingPeer::addInstanceToPool($obj, $key);
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
     * @return array (Billing object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = BillingPeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = BillingPeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + BillingPeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BillingPeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            BillingPeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * Gets the SQL value for Type ENUM value
     *
     * @param  string $enumVal ENUM value to get SQL value for
     * @return int SQL value
     */
    public static function getTypeSqlValue($enumVal)
    {
        return BillingPeer::getSqlValueForEnum(BillingPeer::TYPE, $enumVal);
    }

    /**
     * Gets the SQL value for State ENUM value
     *
     * @param  string $enumVal ENUM value to get SQL value for
     * @return int SQL value
     */
    public static function getStateSqlValue($enumVal)
    {
        return BillingPeer::getSqlValueForEnum(BillingPeer::STATE, $enumVal);
    }


    /**
     * Returns the number of rows matching criteria, joining the related Client table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinClient(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
     * Selects a collection of Billing objects pre-filled with their Client objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinClient(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol = BillingPeer::NUM_HYDRATE_COLUMNS;
        ClientPeer::addSelectColumns($criteria);

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
            } // if $obj1 already loaded

            $key2 = ClientPeer::getPrimaryKeyHashFromRow($row, $startcol);
            if ($key2 !== null) {
                $obj2 = ClientPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ClientPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol);
                    ClientPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 already loaded

                // Add the $obj1 (Billing) to $obj2 (Client)
                $obj2->addBilling($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Billing objects pre-filled with their Project objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinProject(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol = BillingPeer::NUM_HYDRATE_COLUMNS;
        ProjectPeer::addSelectColumns($criteria);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Billing) to $obj2 (Project)
                $obj2->addBilling($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Billing objects pre-filled with their BillingCategory objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBillingCategory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol = BillingPeer::NUM_HYDRATE_COLUMNS;
        BillingCategoryPeer::addSelectColumns($criteria);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Billing) to $obj2 (BillingCategory)
                $obj2->addBilling($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Billing objects pre-filled with their AuthyGroup objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAuthyGroup(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol = BillingPeer::NUM_HYDRATE_COLUMNS;
        AuthyGroupPeer::addSelectColumns($criteria);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Billing) to $obj2 (AuthyGroup)
                $obj2->addBilling($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Billing objects pre-filled with their Authy objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAuthyRelatedByIdCreation(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol = BillingPeer::NUM_HYDRATE_COLUMNS;
        AuthyPeer::addSelectColumns($criteria);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Billing) to $obj2 (Authy)
                $obj2->addBillingRelatedByIdCreation($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Billing objects pre-filled with their Authy objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAuthyRelatedByIdModification(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol = BillingPeer::NUM_HYDRATE_COLUMNS;
        AuthyPeer::addSelectColumns($criteria);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Billing) to $obj2 (Authy)
                $obj2->addBillingRelatedByIdModification($obj1);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
     * Selects a collection of Billing objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol2 = BillingPeer::NUM_HYDRATE_COLUMNS;

        ClientPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ClientPeer::NUM_HYDRATE_COLUMNS;

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

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined Client rows

            $key2 = ClientPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = ClientPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = ClientPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ClientPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Billing) to the collection in $obj2 (Client)
                $obj2->addBilling($obj1);
            } // if joined row not null

            // Add objects for joined Project rows

            $key3 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol3);
            if ($key3 !== null) {
                $obj3 = ProjectPeer::getInstanceFromPool($key3);
                if (!$obj3) {

                    $cls = ProjectPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    ProjectPeer::addInstanceToPool($obj3, $key3);
                } // if obj3 loaded

                // Add the $obj1 (Billing) to the collection in $obj3 (Project)
                $obj3->addBilling($obj1);
            } // if joined row not null

            // Add objects for joined BillingCategory rows

            $key4 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol4);
            if ($key4 !== null) {
                $obj4 = BillingCategoryPeer::getInstanceFromPool($key4);
                if (!$obj4) {

                    $cls = BillingCategoryPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    BillingCategoryPeer::addInstanceToPool($obj4, $key4);
                } // if obj4 loaded

                // Add the $obj1 (Billing) to the collection in $obj4 (BillingCategory)
                $obj4->addBilling($obj1);
            } // if joined row not null

            // Add objects for joined AuthyGroup rows

            $key5 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol5);
            if ($key5 !== null) {
                $obj5 = AuthyGroupPeer::getInstanceFromPool($key5);
                if (!$obj5) {

                    $cls = AuthyGroupPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    AuthyGroupPeer::addInstanceToPool($obj5, $key5);
                } // if obj5 loaded

                // Add the $obj1 (Billing) to the collection in $obj5 (AuthyGroup)
                $obj5->addBilling($obj1);
            } // if joined row not null

            // Add objects for joined Authy rows

            $key6 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol6);
            if ($key6 !== null) {
                $obj6 = AuthyPeer::getInstanceFromPool($key6);
                if (!$obj6) {

                    $cls = AuthyPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    AuthyPeer::addInstanceToPool($obj6, $key6);
                } // if obj6 loaded

                // Add the $obj1 (Billing) to the collection in $obj6 (Authy)
                $obj6->addBillingRelatedByIdCreation($obj1);
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

                // Add the $obj1 (Billing) to the collection in $obj7 (Authy)
                $obj7->addBillingRelatedByIdModification($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Returns the number of rows matching criteria, joining the related Client table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptClient(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

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
        $criteria->setPrimaryTableName(BillingPeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            BillingPeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

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
     * Selects a collection of Billing objects pre-filled with all related objects except Client.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptClient(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol2 = BillingPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Project rows

                $key2 = ProjectPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ProjectPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ProjectPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ProjectPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Billing) to the collection in $obj2 (Project)
                $obj2->addBilling($obj1);

            } // if joined row is not null

                // Add objects for joined BillingCategory rows

                $key3 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = BillingCategoryPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    BillingCategoryPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Billing) to the collection in $obj3 (BillingCategory)
                $obj3->addBilling($obj1);

            } // if joined row is not null

                // Add objects for joined AuthyGroup rows

                $key4 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = AuthyGroupPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = AuthyGroupPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    AuthyGroupPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Billing) to the collection in $obj4 (AuthyGroup)
                $obj4->addBilling($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key5 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = AuthyPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = AuthyPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    AuthyPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Billing) to the collection in $obj5 (Authy)
                $obj5->addBillingRelatedByIdCreation($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj6 (Authy)
                $obj6->addBillingRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Billing objects pre-filled with all related objects except Project.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
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
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol2 = BillingPeer::NUM_HYDRATE_COLUMNS;

        ClientPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ClientPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Client rows

                $key2 = ClientPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ClientPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ClientPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ClientPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Billing) to the collection in $obj2 (Client)
                $obj2->addBilling($obj1);

            } // if joined row is not null

                // Add objects for joined BillingCategory rows

                $key3 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = BillingCategoryPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    BillingCategoryPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Billing) to the collection in $obj3 (BillingCategory)
                $obj3->addBilling($obj1);

            } // if joined row is not null

                // Add objects for joined AuthyGroup rows

                $key4 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = AuthyGroupPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = AuthyGroupPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    AuthyGroupPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Billing) to the collection in $obj4 (AuthyGroup)
                $obj4->addBilling($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key5 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = AuthyPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = AuthyPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    AuthyPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Billing) to the collection in $obj5 (Authy)
                $obj5->addBillingRelatedByIdCreation($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj6 (Authy)
                $obj6->addBillingRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Billing objects pre-filled with all related objects except BillingCategory.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
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
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol2 = BillingPeer::NUM_HYDRATE_COLUMNS;

        ClientPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ClientPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Client rows

                $key2 = ClientPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ClientPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ClientPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ClientPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Billing) to the collection in $obj2 (Client)
                $obj2->addBilling($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj3 (Project)
                $obj3->addBilling($obj1);

            } // if joined row is not null

                // Add objects for joined AuthyGroup rows

                $key4 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = AuthyGroupPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = AuthyGroupPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    AuthyGroupPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Billing) to the collection in $obj4 (AuthyGroup)
                $obj4->addBilling($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key5 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = AuthyPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = AuthyPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    AuthyPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Billing) to the collection in $obj5 (Authy)
                $obj5->addBillingRelatedByIdCreation($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj6 (Authy)
                $obj6->addBillingRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Billing objects pre-filled with all related objects except AuthyGroup.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
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
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol2 = BillingPeer::NUM_HYDRATE_COLUMNS;

        ClientPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ClientPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Client rows

                $key2 = ClientPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ClientPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ClientPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ClientPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Billing) to the collection in $obj2 (Client)
                $obj2->addBilling($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj3 (Project)
                $obj3->addBilling($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj4 (BillingCategory)
                $obj4->addBilling($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key5 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = AuthyPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = AuthyPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    AuthyPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Billing) to the collection in $obj5 (Authy)
                $obj5->addBillingRelatedByIdCreation($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj6 (Authy)
                $obj6->addBillingRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Billing objects pre-filled with all related objects except AuthyRelatedByIdCreation.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
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
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol2 = BillingPeer::NUM_HYDRATE_COLUMNS;

        ClientPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ClientPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Client rows

                $key2 = ClientPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ClientPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ClientPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ClientPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Billing) to the collection in $obj2 (Client)
                $obj2->addBilling($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj3 (Project)
                $obj3->addBilling($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj4 (BillingCategory)
                $obj4->addBilling($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj5 (AuthyGroup)
                $obj5->addBilling($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Billing objects pre-filled with all related objects except AuthyRelatedByIdModification.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Billing objects.
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
            $criteria->setDbName(BillingPeer::DATABASE_NAME);
        }

        BillingPeer::addSelectColumns($criteria);
        $startcol2 = BillingPeer::NUM_HYDRATE_COLUMNS;

        ClientPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ClientPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(BillingPeer::ID_CLIENT, ClientPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(BillingPeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = BillingPeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = BillingPeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = BillingPeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                BillingPeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined Client rows

                $key2 = ClientPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = ClientPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = ClientPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    ClientPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Billing) to the collection in $obj2 (Client)
                $obj2->addBilling($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj3 (Project)
                $obj3->addBilling($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj4 (BillingCategory)
                $obj4->addBilling($obj1);

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

                // Add the $obj1 (Billing) to the collection in $obj5 (AuthyGroup)
                $obj5->addBilling($obj1);

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
        return Propel::getDatabaseMap(BillingPeer::DATABASE_NAME)->getTable(BillingPeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseBillingPeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseBillingPeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \App\map\BillingTableMap());
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
        return BillingPeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Billing or Criteria object.
     *
     * @param      mixed $values Criteria or Billing object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Billing object
        }

        if ($criteria->containsKey(BillingPeer::ID_BILLING) && $criteria->keyContainsValue(BillingPeer::ID_BILLING) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BillingPeer::ID_BILLING.')');
        }


        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Billing or Criteria object.
     *
     * @param      mixed $values Criteria or Billing object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(BillingPeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(BillingPeer::ID_BILLING);
            $value = $criteria->remove(BillingPeer::ID_BILLING);
            if ($value) {
                $selectCriteria->add(BillingPeer::ID_BILLING, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(BillingPeer::TABLE_NAME);
            }

        } else { // $values is Billing object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the billing table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(BillingPeer::TABLE_NAME, $con, BillingPeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BillingPeer::clearInstancePool();
            BillingPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Billing or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Billing object or primary key or array of primary keys
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
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            BillingPeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Billing) { // it's a model object
            // invalidate the cache for this single object
            BillingPeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BillingPeer::DATABASE_NAME);
            $criteria->add(BillingPeer::ID_BILLING, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                BillingPeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(BillingPeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            BillingPeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Billing object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param Billing $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(BillingPeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(BillingPeer::TABLE_NAME);

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

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::TITLE))
            $columns[BillingPeer::TITLE] = $obj->getTitle();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::CALC_ID))
            $columns[BillingPeer::CALC_ID] = $obj->getCalcId();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::TITLE))
            $columns[BillingPeer::TITLE] = $obj->getTitle();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::ID_CLIENT))
            $columns[BillingPeer::ID_CLIENT] = $obj->getIdClient();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::ID_CLIENT))
            $columns[BillingPeer::ID_CLIENT] = $obj->getIdClient();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::ID_PROJECT))
            $columns[BillingPeer::ID_PROJECT] = $obj->getIdProject();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::ID_BILLING_CATEGORY))
            $columns[BillingPeer::ID_BILLING_CATEGORY] = $obj->getIdBillingCategory();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::DATE))
            $columns[BillingPeer::DATE] = $obj->getDate();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::TYPE))
            $columns[BillingPeer::TYPE] = $obj->getType();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::TYPE))
            $columns[BillingPeer::TYPE] = $obj->getType();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::STATE))
            $columns[BillingPeer::STATE] = $obj->getState();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::STATE))
            $columns[BillingPeer::STATE] = $obj->getState();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::DATE_DUE))
            $columns[BillingPeer::DATE_DUE] = $obj->getDateDue();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::NOTE_BILLING))
            $columns[BillingPeer::NOTE_BILLING] = $obj->getNoteBilling();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::DATE_PAID))
            $columns[BillingPeer::DATE_PAID] = $obj->getDatePaid();

        if ($obj->isNew() || $obj->isColumnModified(BillingPeer::REFERENCE))
            $columns[BillingPeer::REFERENCE] = $obj->getReference();

        }

        return BasePeer::doValidate(BillingPeer::DATABASE_NAME, BillingPeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Billing
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = BillingPeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(BillingPeer::DATABASE_NAME);
        $criteria->add(BillingPeer::ID_BILLING, $pk);

        $v = BillingPeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Billing[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(BillingPeer::DATABASE_NAME);
            $criteria->add(BillingPeer::ID_BILLING, $pks, Criteria::IN);
            $objs = BillingPeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseBillingPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseBillingPeer::buildTableMap();

