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
use App\Expense;
use App\ExpensePeer;
use App\ProjectPeer;
use App\SupplierPeer;
use App\map\ExpenseTableMap;

/**
 * Base static class for performing query and update operations on the 'expense' table.
 *
 * Expense
 *
 * @package propel.generator..om
 */
abstract class BaseExpensePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'myproject1';

    /** the table name for this class */
    const TABLE_NAME = 'expense';

    /** the related Propel class for this table */
    const OM_CLASS = 'App\\Expense';

    /** the related TableMap class for this table */
    const TM_CLASS = 'App\\map\\ExpenseTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 18;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 18;

    /** the column name for the id_expense field */
    const ID_EXPENSE = 'expense.id_expense';

    /** the column name for the date field */
    const DATE = 'expense.date';

    /** the column name for the quantity field */
    const QUANTITY = 'expense.quantity';

    /** the column name for the amount field */
    const AMOUNT = 'expense.amount';

    /** the column name for the total field */
    const TOTAL = 'expense.total';

    /** the column name for the title field */
    const TITLE = 'expense.title';

    /** the column name for the id_billing_category field */
    const ID_BILLING_CATEGORY = 'expense.id_billing_category';

    /** the column name for the note_expense_ligne field */
    const NOTE_EXPENSE_LIGNE = 'expense.note_expense_ligne';

    /** the column name for the id_client field */
    const ID_CLIENT = 'expense.id_client';

    /** the column name for the id_project field */
    const ID_PROJECT = 'expense.id_project';

    /** the column name for the id_assign field */
    const ID_ASSIGN = 'expense.id_assign';

    /** the column name for the id_supplier field */
    const ID_SUPPLIER = 'expense.id_supplier';

    /** the column name for the invoice_no field */
    const INVOICE_NO = 'expense.invoice_no';

    /** the column name for the date_creation field */
    const DATE_CREATION = 'expense.date_creation';

    /** the column name for the date_modification field */
    const DATE_MODIFICATION = 'expense.date_modification';

    /** the column name for the id_group_creation field */
    const ID_GROUP_CREATION = 'expense.id_group_creation';

    /** the column name for the id_creation field */
    const ID_CREATION = 'expense.id_creation';

    /** the column name for the id_modification field */
    const ID_MODIFICATION = 'expense.id_modification';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identity map to hold any loaded instances of Expense objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Expense[]
     */
    public static $instances = array();


    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. ExpensePeer::$fieldNames[ExpensePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('IdExpense', 'Date', 'Quantity', 'Amount', 'Total', 'Title', 'IdBillingCategory', 'NoteExpenseLigne', 'IdClient', 'IdProject', 'IdAssign', 'IdSupplier', 'InvoiceNo', 'DateCreation', 'DateModification', 'IdGroupCreation', 'IdCreation', 'IdModification', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('idExpense', 'date', 'quantity', 'amount', 'total', 'title', 'idBillingCategory', 'noteExpenseLigne', 'idClient', 'idProject', 'idAssign', 'idSupplier', 'invoiceNo', 'dateCreation', 'dateModification', 'idGroupCreation', 'idCreation', 'idModification', ),
        BasePeer::TYPE_COLNAME => array (ExpensePeer::ID_EXPENSE, ExpensePeer::DATE, ExpensePeer::QUANTITY, ExpensePeer::AMOUNT, ExpensePeer::TOTAL, ExpensePeer::TITLE, ExpensePeer::ID_BILLING_CATEGORY, ExpensePeer::NOTE_EXPENSE_LIGNE, ExpensePeer::ID_CLIENT, ExpensePeer::ID_PROJECT, ExpensePeer::ID_ASSIGN, ExpensePeer::ID_SUPPLIER, ExpensePeer::INVOICE_NO, ExpensePeer::DATE_CREATION, ExpensePeer::DATE_MODIFICATION, ExpensePeer::ID_GROUP_CREATION, ExpensePeer::ID_CREATION, ExpensePeer::ID_MODIFICATION, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID_EXPENSE', 'DATE', 'QUANTITY', 'AMOUNT', 'TOTAL', 'TITLE', 'ID_BILLING_CATEGORY', 'NOTE_EXPENSE_LIGNE', 'ID_CLIENT', 'ID_PROJECT', 'ID_ASSIGN', 'ID_SUPPLIER', 'INVOICE_NO', 'DATE_CREATION', 'DATE_MODIFICATION', 'ID_GROUP_CREATION', 'ID_CREATION', 'ID_MODIFICATION', ),
        BasePeer::TYPE_FIELDNAME => array ('id_expense', 'date', 'quantity', 'amount', 'total', 'title', 'id_billing_category', 'note_expense_ligne', 'id_client', 'id_project', 'id_assign', 'id_supplier', 'invoice_no', 'date_creation', 'date_modification', 'id_group_creation', 'id_creation', 'id_modification', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. ExpensePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('IdExpense' => 0, 'Date' => 1, 'Quantity' => 2, 'Amount' => 3, 'Total' => 4, 'Title' => 5, 'IdBillingCategory' => 6, 'NoteExpenseLigne' => 7, 'IdClient' => 8, 'IdProject' => 9, 'IdAssign' => 10, 'IdSupplier' => 11, 'InvoiceNo' => 12, 'DateCreation' => 13, 'DateModification' => 14, 'IdGroupCreation' => 15, 'IdCreation' => 16, 'IdModification' => 17, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('idExpense' => 0, 'date' => 1, 'quantity' => 2, 'amount' => 3, 'total' => 4, 'title' => 5, 'idBillingCategory' => 6, 'noteExpenseLigne' => 7, 'idClient' => 8, 'idProject' => 9, 'idAssign' => 10, 'idSupplier' => 11, 'invoiceNo' => 12, 'dateCreation' => 13, 'dateModification' => 14, 'idGroupCreation' => 15, 'idCreation' => 16, 'idModification' => 17, ),
        BasePeer::TYPE_COLNAME => array (ExpensePeer::ID_EXPENSE => 0, ExpensePeer::DATE => 1, ExpensePeer::QUANTITY => 2, ExpensePeer::AMOUNT => 3, ExpensePeer::TOTAL => 4, ExpensePeer::TITLE => 5, ExpensePeer::ID_BILLING_CATEGORY => 6, ExpensePeer::NOTE_EXPENSE_LIGNE => 7, ExpensePeer::ID_CLIENT => 8, ExpensePeer::ID_PROJECT => 9, ExpensePeer::ID_ASSIGN => 10, ExpensePeer::ID_SUPPLIER => 11, ExpensePeer::INVOICE_NO => 12, ExpensePeer::DATE_CREATION => 13, ExpensePeer::DATE_MODIFICATION => 14, ExpensePeer::ID_GROUP_CREATION => 15, ExpensePeer::ID_CREATION => 16, ExpensePeer::ID_MODIFICATION => 17, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID_EXPENSE' => 0, 'DATE' => 1, 'QUANTITY' => 2, 'AMOUNT' => 3, 'TOTAL' => 4, 'TITLE' => 5, 'ID_BILLING_CATEGORY' => 6, 'NOTE_EXPENSE_LIGNE' => 7, 'ID_CLIENT' => 8, 'ID_PROJECT' => 9, 'ID_ASSIGN' => 10, 'ID_SUPPLIER' => 11, 'INVOICE_NO' => 12, 'DATE_CREATION' => 13, 'DATE_MODIFICATION' => 14, 'ID_GROUP_CREATION' => 15, 'ID_CREATION' => 16, 'ID_MODIFICATION' => 17, ),
        BasePeer::TYPE_FIELDNAME => array ('id_expense' => 0, 'date' => 1, 'quantity' => 2, 'amount' => 3, 'total' => 4, 'title' => 5, 'id_billing_category' => 6, 'note_expense_ligne' => 7, 'id_client' => 8, 'id_project' => 9, 'id_assign' => 10, 'id_supplier' => 11, 'invoice_no' => 12, 'date_creation' => 13, 'date_modification' => 14, 'id_group_creation' => 15, 'id_creation' => 16, 'id_modification' => 17, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, )
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
        $toNames = ExpensePeer::getFieldNames($toType);
        $key = isset(ExpensePeer::$fieldKeys[$fromType][$name]) ? ExpensePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(ExpensePeer::$fieldKeys[$fromType], true));
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
        if (!array_key_exists($type, ExpensePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return ExpensePeer::$fieldNames[$type];
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
     * @param      string $column The column name for current table. (i.e. ExpensePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(ExpensePeer::TABLE_NAME.'.', $alias.'.', $column);
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
            $criteria->addSelectColumn(ExpensePeer::ID_EXPENSE);
            $criteria->addSelectColumn(ExpensePeer::DATE);
            $criteria->addSelectColumn(ExpensePeer::QUANTITY);
            $criteria->addSelectColumn(ExpensePeer::AMOUNT);
            $criteria->addSelectColumn(ExpensePeer::TOTAL);
            $criteria->addSelectColumn(ExpensePeer::TITLE);
            $criteria->addSelectColumn(ExpensePeer::ID_BILLING_CATEGORY);
            $criteria->addSelectColumn(ExpensePeer::NOTE_EXPENSE_LIGNE);
            $criteria->addSelectColumn(ExpensePeer::ID_CLIENT);
            $criteria->addSelectColumn(ExpensePeer::ID_PROJECT);
            $criteria->addSelectColumn(ExpensePeer::ID_ASSIGN);
            $criteria->addSelectColumn(ExpensePeer::ID_SUPPLIER);
            $criteria->addSelectColumn(ExpensePeer::INVOICE_NO);
            $criteria->addSelectColumn(ExpensePeer::DATE_CREATION);
            $criteria->addSelectColumn(ExpensePeer::DATE_MODIFICATION);
            $criteria->addSelectColumn(ExpensePeer::ID_GROUP_CREATION);
            $criteria->addSelectColumn(ExpensePeer::ID_CREATION);
            $criteria->addSelectColumn(ExpensePeer::ID_MODIFICATION);
        } else {
            $criteria->addSelectColumn($alias . '.id_expense');
            $criteria->addSelectColumn($alias . '.date');
            $criteria->addSelectColumn($alias . '.quantity');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.total');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.id_billing_category');
            $criteria->addSelectColumn($alias . '.note_expense_ligne');
            $criteria->addSelectColumn($alias . '.id_client');
            $criteria->addSelectColumn($alias . '.id_project');
            $criteria->addSelectColumn($alias . '.id_assign');
            $criteria->addSelectColumn($alias . '.id_supplier');
            $criteria->addSelectColumn($alias . '.invoice_no');
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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(ExpensePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return Expense
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = ExpensePeer::doSelect($critcopy, $con);
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
        return ExpensePeer::populateObjects(ExpensePeer::doSelectStmt($criteria, $con));
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
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            ExpensePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

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
     * @param Expense $obj A Expense object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getIdExpense();
            } // if key === null
            ExpensePeer::$instances[$key] = $obj;
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
     * @param      mixed $value A Expense object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Expense) {
                $key = (string) $value->getIdExpense();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Expense object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(ExpensePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return Expense Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(ExpensePeer::$instances[$key])) {
                return ExpensePeer::$instances[$key];
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
        foreach (ExpensePeer::$instances as $instance) {
          $instance->clearAllReferences(true);
        }
      }
        ExpensePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to expense
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
        $cls = ExpensePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = ExpensePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpensePeer::addInstanceToPool($obj, $key);
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
     * @return array (Expense object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = ExpensePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = ExpensePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + ExpensePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpensePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            ExpensePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ProjectRelatedByIdClient table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinProjectRelatedByIdClient(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ProjectRelatedByIdProject table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinProjectRelatedByIdProject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related AuthyRelatedByIdAssign table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAuthyRelatedByIdAssign(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
     * Selects a collection of Expense objects pre-filled with their BillingCategory objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinBillingCategory(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol = ExpensePeer::NUM_HYDRATE_COLUMNS;
        BillingCategoryPeer::addSelectColumns($criteria);

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Expense) to $obj2 (BillingCategory)
                $obj2->addExpense($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with their Project objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinProjectRelatedByIdClient(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol = ExpensePeer::NUM_HYDRATE_COLUMNS;
        ProjectPeer::addSelectColumns($criteria);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Expense) to $obj2 (Project)
                $obj2->addExpenseRelatedByIdClient($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with their Project objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinProjectRelatedByIdProject(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol = ExpensePeer::NUM_HYDRATE_COLUMNS;
        ProjectPeer::addSelectColumns($criteria);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Expense) to $obj2 (Project)
                $obj2->addExpenseRelatedByIdProject($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with their Authy objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAuthyRelatedByIdAssign(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol = ExpensePeer::NUM_HYDRATE_COLUMNS;
        AuthyPeer::addSelectColumns($criteria);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Expense) to $obj2 (Authy)
                $obj2->addExpenseRelatedByIdAssign($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with their Supplier objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinSupplier(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol = ExpensePeer::NUM_HYDRATE_COLUMNS;
        SupplierPeer::addSelectColumns($criteria);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Expense) to $obj2 (Supplier)
                $obj2->addExpense($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with their AuthyGroup objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAuthyGroup(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol = ExpensePeer::NUM_HYDRATE_COLUMNS;
        AuthyGroupPeer::addSelectColumns($criteria);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Expense) to $obj2 (AuthyGroup)
                $obj2->addExpense($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with their Authy objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAuthyRelatedByIdCreation(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol = ExpensePeer::NUM_HYDRATE_COLUMNS;
        AuthyPeer::addSelectColumns($criteria);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Expense) to $obj2 (Authy)
                $obj2->addExpenseRelatedByIdCreation($obj1);

            } // if joined row was not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with their Authy objects.
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAuthyRelatedByIdModification(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol = ExpensePeer::NUM_HYDRATE_COLUMNS;
        AuthyPeer::addSelectColumns($criteria);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {

                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Expense) to $obj2 (Authy)
                $obj2->addExpenseRelatedByIdModification($obj1);

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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
     * Selects a collection of Expense objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol2 = ExpensePeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol9 = $startcol8 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol10 = $startcol9 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            // Add objects for joined BillingCategory rows

            $key2 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
            if ($key2 !== null) {
                $obj2 = BillingCategoryPeer::getInstanceFromPool($key2);
                if (!$obj2) {

                    $cls = BillingCategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingCategoryPeer::addInstanceToPool($obj2, $key2);
                } // if obj2 loaded

                // Add the $obj1 (Expense) to the collection in $obj2 (BillingCategory)
                $obj2->addExpense($obj1);
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

                // Add the $obj1 (Expense) to the collection in $obj3 (Project)
                $obj3->addExpenseRelatedByIdClient($obj1);
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

                // Add the $obj1 (Expense) to the collection in $obj4 (Project)
                $obj4->addExpenseRelatedByIdProject($obj1);
            } // if joined row not null

            // Add objects for joined Authy rows

            $key5 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol5);
            if ($key5 !== null) {
                $obj5 = AuthyPeer::getInstanceFromPool($key5);
                if (!$obj5) {

                    $cls = AuthyPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    AuthyPeer::addInstanceToPool($obj5, $key5);
                } // if obj5 loaded

                // Add the $obj1 (Expense) to the collection in $obj5 (Authy)
                $obj5->addExpenseRelatedByIdAssign($obj1);
            } // if joined row not null

            // Add objects for joined Supplier rows

            $key6 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol6);
            if ($key6 !== null) {
                $obj6 = SupplierPeer::getInstanceFromPool($key6);
                if (!$obj6) {

                    $cls = SupplierPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    SupplierPeer::addInstanceToPool($obj6, $key6);
                } // if obj6 loaded

                // Add the $obj1 (Expense) to the collection in $obj6 (Supplier)
                $obj6->addExpense($obj1);
            } // if joined row not null

            // Add objects for joined AuthyGroup rows

            $key7 = AuthyGroupPeer::getPrimaryKeyHashFromRow($row, $startcol7);
            if ($key7 !== null) {
                $obj7 = AuthyGroupPeer::getInstanceFromPool($key7);
                if (!$obj7) {

                    $cls = AuthyGroupPeer::getOMClass();

                    $obj7 = new $cls();
                    $obj7->hydrate($row, $startcol7);
                    AuthyGroupPeer::addInstanceToPool($obj7, $key7);
                } // if obj7 loaded

                // Add the $obj1 (Expense) to the collection in $obj7 (AuthyGroup)
                $obj7->addExpense($obj1);
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

                // Add the $obj1 (Expense) to the collection in $obj8 (Authy)
                $obj8->addExpenseRelatedByIdCreation($obj1);
            } // if joined row not null

            // Add objects for joined Authy rows

            $key9 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol9);
            if ($key9 !== null) {
                $obj9 = AuthyPeer::getInstanceFromPool($key9);
                if (!$obj9) {

                    $cls = AuthyPeer::getOMClass();

                    $obj9 = new $cls();
                    $obj9->hydrate($row, $startcol9);
                    AuthyPeer::addInstanceToPool($obj9, $key9);
                } // if obj9 loaded

                // Add the $obj1 (Expense) to the collection in $obj9 (Authy)
                $obj9->addExpenseRelatedByIdModification($obj1);
            } // if joined row not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ProjectRelatedByIdClient table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptProjectRelatedByIdClient(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related ProjectRelatedByIdProject table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptProjectRelatedByIdProject(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
     * Returns the number of rows matching criteria, joining the related AuthyRelatedByIdAssign table
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAllExceptAuthyRelatedByIdAssign(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);

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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

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
        $criteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            ExpensePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY should not affect count

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

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
     * Selects a collection of Expense objects pre-filled with all related objects except BillingCategory.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
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
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol2 = ExpensePeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol9 = $startcol8 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
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

                // Add the $obj1 (Expense) to the collection in $obj2 (Project)
                $obj2->addExpenseRelatedByIdClient($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj3 (Project)
                $obj3->addExpenseRelatedByIdProject($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key4 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = AuthyPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = AuthyPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    AuthyPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Expense) to the collection in $obj4 (Authy)
                $obj4->addExpenseRelatedByIdAssign($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key5 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = SupplierPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = SupplierPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    SupplierPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Expense) to the collection in $obj5 (Supplier)
                $obj5->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj6 (AuthyGroup)
                $obj6->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj7 (Authy)
                $obj7->addExpenseRelatedByIdCreation($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key8 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol8);
                if ($key8 !== null) {
                    $obj8 = AuthyPeer::getInstanceFromPool($key8);
                    if (!$obj8) {

                        $cls = AuthyPeer::getOMClass();

                    $obj8 = new $cls();
                    $obj8->hydrate($row, $startcol8);
                    AuthyPeer::addInstanceToPool($obj8, $key8);
                } // if $obj8 already loaded

                // Add the $obj1 (Expense) to the collection in $obj8 (Authy)
                $obj8->addExpenseRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with all related objects except ProjectRelatedByIdClient.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptProjectRelatedByIdClient(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol2 = ExpensePeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BillingCategory rows

                $key2 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingCategoryPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingCategoryPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Expense) to the collection in $obj2 (BillingCategory)
                $obj2->addExpense($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key3 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = AuthyPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = AuthyPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    AuthyPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Expense) to the collection in $obj3 (Authy)
                $obj3->addExpenseRelatedByIdAssign($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key4 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = SupplierPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = SupplierPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    SupplierPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Expense) to the collection in $obj4 (Supplier)
                $obj4->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj5 (AuthyGroup)
                $obj5->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj6 (Authy)
                $obj6->addExpenseRelatedByIdCreation($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj7 (Authy)
                $obj7->addExpenseRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with all related objects except ProjectRelatedByIdProject.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptProjectRelatedByIdProject(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol2 = ExpensePeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BillingCategory rows

                $key2 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingCategoryPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingCategoryPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Expense) to the collection in $obj2 (BillingCategory)
                $obj2->addExpense($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key3 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol3);
                if ($key3 !== null) {
                    $obj3 = AuthyPeer::getInstanceFromPool($key3);
                    if (!$obj3) {

                        $cls = AuthyPeer::getOMClass();

                    $obj3 = new $cls();
                    $obj3->hydrate($row, $startcol3);
                    AuthyPeer::addInstanceToPool($obj3, $key3);
                } // if $obj3 already loaded

                // Add the $obj1 (Expense) to the collection in $obj3 (Authy)
                $obj3->addExpenseRelatedByIdAssign($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key4 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol4);
                if ($key4 !== null) {
                    $obj4 = SupplierPeer::getInstanceFromPool($key4);
                    if (!$obj4) {

                        $cls = SupplierPeer::getOMClass();

                    $obj4 = new $cls();
                    $obj4->hydrate($row, $startcol4);
                    SupplierPeer::addInstanceToPool($obj4, $key4);
                } // if $obj4 already loaded

                // Add the $obj1 (Expense) to the collection in $obj4 (Supplier)
                $obj4->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj5 (AuthyGroup)
                $obj5->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj6 (Authy)
                $obj6->addExpenseRelatedByIdCreation($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj7 (Authy)
                $obj7->addExpenseRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with all related objects except AuthyRelatedByIdAssign.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAllExceptAuthyRelatedByIdAssign(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        // $criteria->getDbName() will return the same object if not set to another value
        // so == check is okay and faster
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol2 = ExpensePeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BillingCategory rows

                $key2 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingCategoryPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingCategoryPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Expense) to the collection in $obj2 (BillingCategory)
                $obj2->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj3 (Project)
                $obj3->addExpenseRelatedByIdClient($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj4 (Project)
                $obj4->addExpenseRelatedByIdProject($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key5 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = SupplierPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = SupplierPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    SupplierPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Expense) to the collection in $obj5 (Supplier)
                $obj5->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj6 (AuthyGroup)
                $obj6->addExpense($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with all related objects except Supplier.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
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
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol2 = ExpensePeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol9 = $startcol8 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BillingCategory rows

                $key2 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingCategoryPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingCategoryPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Expense) to the collection in $obj2 (BillingCategory)
                $obj2->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj3 (Project)
                $obj3->addExpenseRelatedByIdClient($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj4 (Project)
                $obj4->addExpenseRelatedByIdProject($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj5 (Authy)
                $obj5->addExpenseRelatedByIdAssign($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj6 (AuthyGroup)
                $obj6->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj7 (Authy)
                $obj7->addExpenseRelatedByIdCreation($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key8 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol8);
                if ($key8 !== null) {
                    $obj8 = AuthyPeer::getInstanceFromPool($key8);
                    if (!$obj8) {

                        $cls = AuthyPeer::getOMClass();

                    $obj8 = new $cls();
                    $obj8->hydrate($row, $startcol8);
                    AuthyPeer::addInstanceToPool($obj8, $key8);
                } // if $obj8 already loaded

                // Add the $obj1 (Expense) to the collection in $obj8 (Authy)
                $obj8->addExpenseRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with all related objects except AuthyGroup.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
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
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol2 = ExpensePeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol8 = $startcol7 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        AuthyPeer::addSelectColumns($criteria);
        $startcol9 = $startcol8 + AuthyPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_ASSIGN, AuthyPeer::ID_CREATION, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CREATION, AuthyPeer::ID_AUTHY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_MODIFICATION, AuthyPeer::ID_AUTHY, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BillingCategory rows

                $key2 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingCategoryPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingCategoryPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Expense) to the collection in $obj2 (BillingCategory)
                $obj2->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj3 (Project)
                $obj3->addExpenseRelatedByIdClient($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj4 (Project)
                $obj4->addExpenseRelatedByIdProject($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj5 (Authy)
                $obj5->addExpenseRelatedByIdAssign($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key6 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol6);
                if ($key6 !== null) {
                    $obj6 = SupplierPeer::getInstanceFromPool($key6);
                    if (!$obj6) {

                        $cls = SupplierPeer::getOMClass();

                    $obj6 = new $cls();
                    $obj6->hydrate($row, $startcol6);
                    SupplierPeer::addInstanceToPool($obj6, $key6);
                } // if $obj6 already loaded

                // Add the $obj1 (Expense) to the collection in $obj6 (Supplier)
                $obj6->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj7 (Authy)
                $obj7->addExpenseRelatedByIdCreation($obj1);

            } // if joined row is not null

                // Add objects for joined Authy rows

                $key8 = AuthyPeer::getPrimaryKeyHashFromRow($row, $startcol8);
                if ($key8 !== null) {
                    $obj8 = AuthyPeer::getInstanceFromPool($key8);
                    if (!$obj8) {

                        $cls = AuthyPeer::getOMClass();

                    $obj8 = new $cls();
                    $obj8->hydrate($row, $startcol8);
                    AuthyPeer::addInstanceToPool($obj8, $key8);
                } // if $obj8 already loaded

                // Add the $obj1 (Expense) to the collection in $obj8 (Authy)
                $obj8->addExpenseRelatedByIdModification($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with all related objects except AuthyRelatedByIdCreation.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
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
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol2 = ExpensePeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BillingCategory rows

                $key2 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingCategoryPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingCategoryPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Expense) to the collection in $obj2 (BillingCategory)
                $obj2->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj3 (Project)
                $obj3->addExpenseRelatedByIdClient($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj4 (Project)
                $obj4->addExpenseRelatedByIdProject($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key5 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = SupplierPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = SupplierPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    SupplierPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Expense) to the collection in $obj5 (Supplier)
                $obj5->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj6 (AuthyGroup)
                $obj6->addExpense($obj1);

            } // if joined row is not null

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }


    /**
     * Selects a collection of Expense objects pre-filled with all related objects except AuthyRelatedByIdModification.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Expense objects.
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
            $criteria->setDbName(ExpensePeer::DATABASE_NAME);
        }

        ExpensePeer::addSelectColumns($criteria);
        $startcol2 = ExpensePeer::NUM_HYDRATE_COLUMNS;

        BillingCategoryPeer::addSelectColumns($criteria);
        $startcol3 = $startcol2 + BillingCategoryPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol4 = $startcol3 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        ProjectPeer::addSelectColumns($criteria);
        $startcol5 = $startcol4 + ProjectPeer::NUM_HYDRATE_COLUMNS;

        SupplierPeer::addSelectColumns($criteria);
        $startcol6 = $startcol5 + SupplierPeer::NUM_HYDRATE_COLUMNS;

        AuthyGroupPeer::addSelectColumns($criteria);
        $startcol7 = $startcol6 + AuthyGroupPeer::NUM_HYDRATE_COLUMNS;

        $criteria->addJoin(ExpensePeer::ID_BILLING_CATEGORY, BillingCategoryPeer::ID_BILLING_CATEGORY, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_CLIENT, ProjectPeer::ID_CLIENT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_PROJECT, ProjectPeer::ID_PROJECT, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_SUPPLIER, SupplierPeer::ID_SUPPLIER, $join_behavior);

        $criteria->addJoin(ExpensePeer::ID_GROUP_CREATION, AuthyGroupPeer::ID_AUTHY_GROUP, $join_behavior);


        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = ExpensePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = ExpensePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = ExpensePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                ExpensePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

                // Add objects for joined BillingCategory rows

                $key2 = BillingCategoryPeer::getPrimaryKeyHashFromRow($row, $startcol2);
                if ($key2 !== null) {
                    $obj2 = BillingCategoryPeer::getInstanceFromPool($key2);
                    if (!$obj2) {

                        $cls = BillingCategoryPeer::getOMClass();

                    $obj2 = new $cls();
                    $obj2->hydrate($row, $startcol2);
                    BillingCategoryPeer::addInstanceToPool($obj2, $key2);
                } // if $obj2 already loaded

                // Add the $obj1 (Expense) to the collection in $obj2 (BillingCategory)
                $obj2->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj3 (Project)
                $obj3->addExpenseRelatedByIdClient($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj4 (Project)
                $obj4->addExpenseRelatedByIdProject($obj1);

            } // if joined row is not null

                // Add objects for joined Supplier rows

                $key5 = SupplierPeer::getPrimaryKeyHashFromRow($row, $startcol5);
                if ($key5 !== null) {
                    $obj5 = SupplierPeer::getInstanceFromPool($key5);
                    if (!$obj5) {

                        $cls = SupplierPeer::getOMClass();

                    $obj5 = new $cls();
                    $obj5->hydrate($row, $startcol5);
                    SupplierPeer::addInstanceToPool($obj5, $key5);
                } // if $obj5 already loaded

                // Add the $obj1 (Expense) to the collection in $obj5 (Supplier)
                $obj5->addExpense($obj1);

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

                // Add the $obj1 (Expense) to the collection in $obj6 (AuthyGroup)
                $obj6->addExpense($obj1);

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
        return Propel::getDatabaseMap(ExpensePeer::DATABASE_NAME)->getTable(ExpensePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseExpensePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseExpensePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new \App\map\ExpenseTableMap());
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
        return ExpensePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Expense or Criteria object.
     *
     * @param      mixed $values Criteria or Expense object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Expense object
        }

        if ($criteria->containsKey(ExpensePeer::ID_EXPENSE) && $criteria->keyContainsValue(ExpensePeer::ID_EXPENSE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ExpensePeer::ID_EXPENSE.')');
        }


        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

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
     * Performs an UPDATE on the database, given a Expense or Criteria object.
     *
     * @param      mixed $values Criteria or Expense object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(ExpensePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(ExpensePeer::ID_EXPENSE);
            $value = $criteria->remove(ExpensePeer::ID_EXPENSE);
            if ($value) {
                $selectCriteria->add(ExpensePeer::ID_EXPENSE, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(ExpensePeer::TABLE_NAME);
            }

        } else { // $values is Expense object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the expense table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(ExpensePeer::TABLE_NAME, $con, ExpensePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpensePeer::clearInstancePool();
            ExpensePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Expense or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Expense object or primary key or array of primary keys
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
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            ExpensePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Expense) { // it's a model object
            // invalidate the cache for this single object
            ExpensePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExpensePeer::DATABASE_NAME);
            $criteria->add(ExpensePeer::ID_EXPENSE, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                ExpensePeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(ExpensePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            ExpensePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Expense object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param Expense $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(ExpensePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(ExpensePeer::TABLE_NAME);

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

        if ($obj->isNew() || $obj->isColumnModified(ExpensePeer::AMOUNT))
            $columns[ExpensePeer::AMOUNT] = $obj->getAmount();

        if ($obj->isNew() || $obj->isColumnModified(ExpensePeer::DATE))
            $columns[ExpensePeer::DATE] = $obj->getDate();

        if ($obj->isNew() || $obj->isColumnModified(ExpensePeer::TITLE))
            $columns[ExpensePeer::TITLE] = $obj->getTitle();

        if ($obj->isNew() || $obj->isColumnModified(ExpensePeer::ID_BILLING_CATEGORY))
            $columns[ExpensePeer::ID_BILLING_CATEGORY] = $obj->getIdBillingCategory();

        if ($obj->isNew() || $obj->isColumnModified(ExpensePeer::NOTE_EXPENSE_LIGNE))
            $columns[ExpensePeer::NOTE_EXPENSE_LIGNE] = $obj->getNoteExpenseLigne();

        if ($obj->isNew() || $obj->isColumnModified(ExpensePeer::ID_CLIENT))
            $columns[ExpensePeer::ID_CLIENT] = $obj->getIdClient();

        if ($obj->isNew() || $obj->isColumnModified(ExpensePeer::ID_PROJECT))
            $columns[ExpensePeer::ID_PROJECT] = $obj->getIdProject();

        if ($obj->isNew() || $obj->isColumnModified(ExpensePeer::ID_ASSIGN))
            $columns[ExpensePeer::ID_ASSIGN] = $obj->getIdAssign();

        if ($obj->isNew() || $obj->isColumnModified(ExpensePeer::ID_SUPPLIER))
            $columns[ExpensePeer::ID_SUPPLIER] = $obj->getIdSupplier();

        if ($obj->isNew() || $obj->isColumnModified(ExpensePeer::INVOICE_NO))
            $columns[ExpensePeer::INVOICE_NO] = $obj->getInvoiceNo();

        }

        return BasePeer::doValidate(ExpensePeer::DATABASE_NAME, ExpensePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Expense
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = ExpensePeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(ExpensePeer::DATABASE_NAME);
        $criteria->add(ExpensePeer::ID_EXPENSE, $pk);

        $v = ExpensePeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Expense[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(ExpensePeer::DATABASE_NAME);
            $criteria->add(ExpensePeer::ID_EXPENSE, $pks, Criteria::IN);
            $objs = ExpensePeer::doSelect($criteria, $con);
        }

        return $objs;
    }

} // BaseExpensePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseExpensePeer::buildTableMap();

