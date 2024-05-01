<?php

namespace App\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use App\Authy;
use App\AuthyGroup;
use App\BillingCategory;
use App\Expense;
use App\ExpensePeer;
use App\ExpenseQuery;
use App\Project;
use App\Supplier;

/**
 * Base class that represents a query for the 'expense' table.
 *
 * Expense
 *
 * @method ExpenseQuery orderByIdExpense($order = Criteria::ASC) Order by the id_expense column
 * @method ExpenseQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method ExpenseQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method ExpenseQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method ExpenseQuery orderByTotal($order = Criteria::ASC) Order by the total column
 * @method ExpenseQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method ExpenseQuery orderByIdBillingCategory($order = Criteria::ASC) Order by the id_billing_category column
 * @method ExpenseQuery orderByNoteExpenseLigne($order = Criteria::ASC) Order by the note_expense_ligne column
 * @method ExpenseQuery orderByIdClient($order = Criteria::ASC) Order by the id_client column
 * @method ExpenseQuery orderByIdProject($order = Criteria::ASC) Order by the id_project column
 * @method ExpenseQuery orderByIdAssign($order = Criteria::ASC) Order by the id_assign column
 * @method ExpenseQuery orderByIdSupplier($order = Criteria::ASC) Order by the id_supplier column
 * @method ExpenseQuery orderByInvoiceNo($order = Criteria::ASC) Order by the invoice_no column
 * @method ExpenseQuery orderByDateCreation($order = Criteria::ASC) Order by the date_creation column
 * @method ExpenseQuery orderByDateModification($order = Criteria::ASC) Order by the date_modification column
 * @method ExpenseQuery orderByIdGroupCreation($order = Criteria::ASC) Order by the id_group_creation column
 * @method ExpenseQuery orderByIdCreation($order = Criteria::ASC) Order by the id_creation column
 * @method ExpenseQuery orderByIdModification($order = Criteria::ASC) Order by the id_modification column
 *
 * @method ExpenseQuery groupByIdExpense() Group by the id_expense column
 * @method ExpenseQuery groupByDate() Group by the date column
 * @method ExpenseQuery groupByQuantity() Group by the quantity column
 * @method ExpenseQuery groupByAmount() Group by the amount column
 * @method ExpenseQuery groupByTotal() Group by the total column
 * @method ExpenseQuery groupByTitle() Group by the title column
 * @method ExpenseQuery groupByIdBillingCategory() Group by the id_billing_category column
 * @method ExpenseQuery groupByNoteExpenseLigne() Group by the note_expense_ligne column
 * @method ExpenseQuery groupByIdClient() Group by the id_client column
 * @method ExpenseQuery groupByIdProject() Group by the id_project column
 * @method ExpenseQuery groupByIdAssign() Group by the id_assign column
 * @method ExpenseQuery groupByIdSupplier() Group by the id_supplier column
 * @method ExpenseQuery groupByInvoiceNo() Group by the invoice_no column
 * @method ExpenseQuery groupByDateCreation() Group by the date_creation column
 * @method ExpenseQuery groupByDateModification() Group by the date_modification column
 * @method ExpenseQuery groupByIdGroupCreation() Group by the id_group_creation column
 * @method ExpenseQuery groupByIdCreation() Group by the id_creation column
 * @method ExpenseQuery groupByIdModification() Group by the id_modification column
 *
 * @method ExpenseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ExpenseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ExpenseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ExpenseQuery leftJoinBillingCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the BillingCategory relation
 * @method ExpenseQuery rightJoinBillingCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BillingCategory relation
 * @method ExpenseQuery innerJoinBillingCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the BillingCategory relation
 *
 * @method ExpenseQuery leftJoinProjectRelatedByIdClient($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectRelatedByIdClient relation
 * @method ExpenseQuery rightJoinProjectRelatedByIdClient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectRelatedByIdClient relation
 * @method ExpenseQuery innerJoinProjectRelatedByIdClient($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectRelatedByIdClient relation
 *
 * @method ExpenseQuery leftJoinProjectRelatedByIdProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectRelatedByIdProject relation
 * @method ExpenseQuery rightJoinProjectRelatedByIdProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectRelatedByIdProject relation
 * @method ExpenseQuery innerJoinProjectRelatedByIdProject($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectRelatedByIdProject relation
 *
 * @method ExpenseQuery leftJoinAuthyRelatedByIdAssign($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdAssign relation
 * @method ExpenseQuery rightJoinAuthyRelatedByIdAssign($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdAssign relation
 * @method ExpenseQuery innerJoinAuthyRelatedByIdAssign($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdAssign relation
 *
 * @method ExpenseQuery leftJoinSupplier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Supplier relation
 * @method ExpenseQuery rightJoinSupplier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Supplier relation
 * @method ExpenseQuery innerJoinSupplier($relationAlias = null) Adds a INNER JOIN clause to the query using the Supplier relation
 *
 * @method ExpenseQuery leftJoinAuthyGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyGroup relation
 * @method ExpenseQuery rightJoinAuthyGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyGroup relation
 * @method ExpenseQuery innerJoinAuthyGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyGroup relation
 *
 * @method ExpenseQuery leftJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdCreation relation
 * @method ExpenseQuery rightJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdCreation relation
 * @method ExpenseQuery innerJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdCreation relation
 *
 * @method ExpenseQuery leftJoinAuthyRelatedByIdModification($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdModification relation
 * @method ExpenseQuery rightJoinAuthyRelatedByIdModification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdModification relation
 * @method ExpenseQuery innerJoinAuthyRelatedByIdModification($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdModification relation
 *
 * @method Expense findOne(PropelPDO $con = null) Return the first Expense matching the query
 * @method Expense findOneOrCreate(PropelPDO $con = null) Return the first Expense matching the query, or a new Expense object populated from the query conditions when no match is found
 *
 * @method Expense findOneByDate(string $date) Return the first Expense filtered by the date column
 * @method Expense findOneByQuantity(string $quantity) Return the first Expense filtered by the quantity column
 * @method Expense findOneByAmount(string $amount) Return the first Expense filtered by the amount column
 * @method Expense findOneByTotal(string $total) Return the first Expense filtered by the total column
 * @method Expense findOneByTitle(string $title) Return the first Expense filtered by the title column
 * @method Expense findOneByIdBillingCategory(int $id_billing_category) Return the first Expense filtered by the id_billing_category column
 * @method Expense findOneByNoteExpenseLigne(string $note_expense_ligne) Return the first Expense filtered by the note_expense_ligne column
 * @method Expense findOneByIdClient(int $id_client) Return the first Expense filtered by the id_client column
 * @method Expense findOneByIdProject(int $id_project) Return the first Expense filtered by the id_project column
 * @method Expense findOneByIdAssign(int $id_assign) Return the first Expense filtered by the id_assign column
 * @method Expense findOneByIdSupplier(int $id_supplier) Return the first Expense filtered by the id_supplier column
 * @method Expense findOneByInvoiceNo(string $invoice_no) Return the first Expense filtered by the invoice_no column
 * @method Expense findOneByDateCreation(string $date_creation) Return the first Expense filtered by the date_creation column
 * @method Expense findOneByDateModification(string $date_modification) Return the first Expense filtered by the date_modification column
 * @method Expense findOneByIdGroupCreation(int $id_group_creation) Return the first Expense filtered by the id_group_creation column
 * @method Expense findOneByIdCreation(int $id_creation) Return the first Expense filtered by the id_creation column
 * @method Expense findOneByIdModification(int $id_modification) Return the first Expense filtered by the id_modification column
 *
 * @method array findByIdExpense(int $id_expense) Return Expense objects filtered by the id_expense column
 * @method array findByDate(string $date) Return Expense objects filtered by the date column
 * @method array findByQuantity(string $quantity) Return Expense objects filtered by the quantity column
 * @method array findByAmount(string $amount) Return Expense objects filtered by the amount column
 * @method array findByTotal(string $total) Return Expense objects filtered by the total column
 * @method array findByTitle(string $title) Return Expense objects filtered by the title column
 * @method array findByIdBillingCategory(int $id_billing_category) Return Expense objects filtered by the id_billing_category column
 * @method array findByNoteExpenseLigne(string $note_expense_ligne) Return Expense objects filtered by the note_expense_ligne column
 * @method array findByIdClient(int $id_client) Return Expense objects filtered by the id_client column
 * @method array findByIdProject(int $id_project) Return Expense objects filtered by the id_project column
 * @method array findByIdAssign(int $id_assign) Return Expense objects filtered by the id_assign column
 * @method array findByIdSupplier(int $id_supplier) Return Expense objects filtered by the id_supplier column
 * @method array findByInvoiceNo(string $invoice_no) Return Expense objects filtered by the invoice_no column
 * @method array findByDateCreation(string $date_creation) Return Expense objects filtered by the date_creation column
 * @method array findByDateModification(string $date_modification) Return Expense objects filtered by the date_modification column
 * @method array findByIdGroupCreation(int $id_group_creation) Return Expense objects filtered by the id_group_creation column
 * @method array findByIdCreation(int $id_creation) Return Expense objects filtered by the id_creation column
 * @method array findByIdModification(int $id_modification) Return Expense objects filtered by the id_modification column
 *
 * @package    propel.generator..om
 */
abstract class BaseExpenseQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseExpenseQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'myproject1';
        }
        if (null === $modelName) {
            $modelName = 'App\\Expense';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ExpenseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ExpenseQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ExpenseQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ExpenseQuery) {
            return $criteria;
        }
        $query = new ExpenseQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * @Query()
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Expense|Expense[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ExpensePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Expense A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdExpense($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Expense A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id_expense`, `date`, `quantity`, `amount`, `total`, `title`, `id_billing_category`, `note_expense_ligne`, `id_client`, `id_project`, `id_assign`, `id_supplier`, `invoice_no`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification` FROM `expense` WHERE `id_expense` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Expense();
            $obj->hydrate($row);
            ExpensePeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * @Query()
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Expense|Expense[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }


    /**
     * @Query()
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Expense[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ExpensePeer::ID_EXPENSE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ExpensePeer::ID_EXPENSE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_expense column
     *
     * Example usage:
     * <code>
     * $query->filterByIdExpense(1234); // WHERE id_expense = 1234
     * $query->filterByIdExpense(array(12, 34)); // WHERE id_expense IN (12, 34)
     * $query->filterByIdExpense(array('min' => 12)); // WHERE id_expense >= 12
     * $query->filterByIdExpense(array('max' => 12)); // WHERE id_expense <= 12
     * </code>
     *
     * @param     mixed $idExpense The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByIdExpense($idExpense = null, $comparison = null)
    {
        if (is_array($idExpense)) {
            $useMinMax = false;
            if (isset($idExpense['min'])) {
                $this->addUsingAlias(ExpensePeer::ID_EXPENSE, $idExpense['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idExpense['max'])) {
                $this->addUsingAlias(ExpensePeer::ID_EXPENSE, $idExpense['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::ID_EXPENSE, $idExpense, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date < '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(ExpensePeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(ExpensePeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::DATE, $date, $comparison);
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE quantity >= 12
     * $query->filterByQuantity(array('max' => 12)); // WHERE quantity <= 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(ExpensePeer::QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(ExpensePeer::QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::QUANTITY, $quantity, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount >= 12
     * $query->filterByAmount(array('max' => 12)); // WHERE amount <= 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ExpensePeer::AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ExpensePeer::AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the total column
     *
     * Example usage:
     * <code>
     * $query->filterByTotal(1234); // WHERE total = 1234
     * $query->filterByTotal(array(12, 34)); // WHERE total IN (12, 34)
     * $query->filterByTotal(array('min' => 12)); // WHERE total >= 12
     * $query->filterByTotal(array('max' => 12)); // WHERE total <= 12
     * </code>
     *
     * @param     mixed $total The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByTotal($total = null, $comparison = null)
    {
        if (is_array($total)) {
            $useMinMax = false;
            if (isset($total['min'])) {
                $this->addUsingAlias(ExpensePeer::TOTAL, $total['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($total['max'])) {
                $this->addUsingAlias(ExpensePeer::TOTAL, $total['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::TOTAL, $total, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ExpensePeer::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the id_billing_category column
     *
     * Example usage:
     * <code>
     * $query->filterByIdBillingCategory(1234); // WHERE id_billing_category = 1234
     * $query->filterByIdBillingCategory(array(12, 34)); // WHERE id_billing_category IN (12, 34)
     * $query->filterByIdBillingCategory(array('min' => 12)); // WHERE id_billing_category >= 12
     * $query->filterByIdBillingCategory(array('max' => 12)); // WHERE id_billing_category <= 12
     * </code>
     *
     * @see       filterByBillingCategory()
     *
     * @param     mixed $idBillingCategory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByIdBillingCategory($idBillingCategory = null, $comparison = null)
    {
        if (is_array($idBillingCategory)) {
            $useMinMax = false;
            if (isset($idBillingCategory['min'])) {
                $this->addUsingAlias(ExpensePeer::ID_BILLING_CATEGORY, $idBillingCategory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBillingCategory['max'])) {
                $this->addUsingAlias(ExpensePeer::ID_BILLING_CATEGORY, $idBillingCategory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::ID_BILLING_CATEGORY, $idBillingCategory, $comparison);
    }

    /**
     * Filter the query on the note_expense_ligne column
     *
     * Example usage:
     * <code>
     * $query->filterByNoteExpenseLigne('fooValue');   // WHERE note_expense_ligne = 'fooValue'
     * $query->filterByNoteExpenseLigne('%fooValue%'); // WHERE note_expense_ligne LIKE '%fooValue%'
     * </code>
     *
     * @param     string $noteExpenseLigne The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByNoteExpenseLigne($noteExpenseLigne = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($noteExpenseLigne)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $noteExpenseLigne)) {
                $noteExpenseLigne = str_replace('*', '%', $noteExpenseLigne);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ExpensePeer::NOTE_EXPENSE_LIGNE, $noteExpenseLigne, $comparison);
    }

    /**
     * Filter the query on the id_client column
     *
     * Example usage:
     * <code>
     * $query->filterByIdClient(1234); // WHERE id_client = 1234
     * $query->filterByIdClient(array(12, 34)); // WHERE id_client IN (12, 34)
     * $query->filterByIdClient(array('min' => 12)); // WHERE id_client >= 12
     * $query->filterByIdClient(array('max' => 12)); // WHERE id_client <= 12
     * </code>
     *
     * @see       filterByProjectRelatedByIdClient()
     *
     * @param     mixed $idClient The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByIdClient($idClient = null, $comparison = null)
    {
        if (is_array($idClient)) {
            $useMinMax = false;
            if (isset($idClient['min'])) {
                $this->addUsingAlias(ExpensePeer::ID_CLIENT, $idClient['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idClient['max'])) {
                $this->addUsingAlias(ExpensePeer::ID_CLIENT, $idClient['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::ID_CLIENT, $idClient, $comparison);
    }

    /**
     * Filter the query on the id_project column
     *
     * Example usage:
     * <code>
     * $query->filterByIdProject(1234); // WHERE id_project = 1234
     * $query->filterByIdProject(array(12, 34)); // WHERE id_project IN (12, 34)
     * $query->filterByIdProject(array('min' => 12)); // WHERE id_project >= 12
     * $query->filterByIdProject(array('max' => 12)); // WHERE id_project <= 12
     * </code>
     *
     * @see       filterByProjectRelatedByIdProject()
     *
     * @param     mixed $idProject The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByIdProject($idProject = null, $comparison = null)
    {
        if (is_array($idProject)) {
            $useMinMax = false;
            if (isset($idProject['min'])) {
                $this->addUsingAlias(ExpensePeer::ID_PROJECT, $idProject['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProject['max'])) {
                $this->addUsingAlias(ExpensePeer::ID_PROJECT, $idProject['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::ID_PROJECT, $idProject, $comparison);
    }

    /**
     * Filter the query on the id_assign column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAssign(1234); // WHERE id_assign = 1234
     * $query->filterByIdAssign(array(12, 34)); // WHERE id_assign IN (12, 34)
     * $query->filterByIdAssign(array('min' => 12)); // WHERE id_assign >= 12
     * $query->filterByIdAssign(array('max' => 12)); // WHERE id_assign <= 12
     * </code>
     *
     * @see       filterByAuthyRelatedByIdAssign()
     *
     * @param     mixed $idAssign The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByIdAssign($idAssign = null, $comparison = null)
    {
        if (is_array($idAssign)) {
            $useMinMax = false;
            if (isset($idAssign['min'])) {
                $this->addUsingAlias(ExpensePeer::ID_ASSIGN, $idAssign['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAssign['max'])) {
                $this->addUsingAlias(ExpensePeer::ID_ASSIGN, $idAssign['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::ID_ASSIGN, $idAssign, $comparison);
    }

    /**
     * Filter the query on the id_supplier column
     *
     * Example usage:
     * <code>
     * $query->filterByIdSupplier(1234); // WHERE id_supplier = 1234
     * $query->filterByIdSupplier(array(12, 34)); // WHERE id_supplier IN (12, 34)
     * $query->filterByIdSupplier(array('min' => 12)); // WHERE id_supplier >= 12
     * $query->filterByIdSupplier(array('max' => 12)); // WHERE id_supplier <= 12
     * </code>
     *
     * @see       filterBySupplier()
     *
     * @param     mixed $idSupplier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByIdSupplier($idSupplier = null, $comparison = null)
    {
        if (is_array($idSupplier)) {
            $useMinMax = false;
            if (isset($idSupplier['min'])) {
                $this->addUsingAlias(ExpensePeer::ID_SUPPLIER, $idSupplier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSupplier['max'])) {
                $this->addUsingAlias(ExpensePeer::ID_SUPPLIER, $idSupplier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::ID_SUPPLIER, $idSupplier, $comparison);
    }

    /**
     * Filter the query on the invoice_no column
     *
     * Example usage:
     * <code>
     * $query->filterByInvoiceNo('fooValue');   // WHERE invoice_no = 'fooValue'
     * $query->filterByInvoiceNo('%fooValue%'); // WHERE invoice_no LIKE '%fooValue%'
     * </code>
     *
     * @param     string $invoiceNo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByInvoiceNo($invoiceNo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($invoiceNo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $invoiceNo)) {
                $invoiceNo = str_replace('*', '%', $invoiceNo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ExpensePeer::INVOICE_NO, $invoiceNo, $comparison);
    }

    /**
     * Filter the query on the date_creation column
     *
     * Example usage:
     * <code>
     * $query->filterByDateCreation('2011-03-14'); // WHERE date_creation = '2011-03-14'
     * $query->filterByDateCreation('now'); // WHERE date_creation = '2011-03-14'
     * $query->filterByDateCreation(array('max' => 'yesterday')); // WHERE date_creation < '2011-03-13'
     * </code>
     *
     * @param     mixed $dateCreation The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByDateCreation($dateCreation = null, $comparison = null)
    {
        if (is_array($dateCreation)) {
            $useMinMax = false;
            if (isset($dateCreation['min'])) {
                $this->addUsingAlias(ExpensePeer::DATE_CREATION, $dateCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCreation['max'])) {
                $this->addUsingAlias(ExpensePeer::DATE_CREATION, $dateCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::DATE_CREATION, $dateCreation, $comparison);
    }

    /**
     * Filter the query on the date_modification column
     *
     * Example usage:
     * <code>
     * $query->filterByDateModification('2011-03-14'); // WHERE date_modification = '2011-03-14'
     * $query->filterByDateModification('now'); // WHERE date_modification = '2011-03-14'
     * $query->filterByDateModification(array('max' => 'yesterday')); // WHERE date_modification < '2011-03-13'
     * </code>
     *
     * @param     mixed $dateModification The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByDateModification($dateModification = null, $comparison = null)
    {
        if (is_array($dateModification)) {
            $useMinMax = false;
            if (isset($dateModification['min'])) {
                $this->addUsingAlias(ExpensePeer::DATE_MODIFICATION, $dateModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateModification['max'])) {
                $this->addUsingAlias(ExpensePeer::DATE_MODIFICATION, $dateModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::DATE_MODIFICATION, $dateModification, $comparison);
    }

    /**
     * Filter the query on the id_group_creation column
     *
     * Example usage:
     * <code>
     * $query->filterByIdGroupCreation(1234); // WHERE id_group_creation = 1234
     * $query->filterByIdGroupCreation(array(12, 34)); // WHERE id_group_creation IN (12, 34)
     * $query->filterByIdGroupCreation(array('min' => 12)); // WHERE id_group_creation >= 12
     * $query->filterByIdGroupCreation(array('max' => 12)); // WHERE id_group_creation <= 12
     * </code>
     *
     * @see       filterByAuthyGroup()
     *
     * @param     mixed $idGroupCreation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByIdGroupCreation($idGroupCreation = null, $comparison = null)
    {
        if (is_array($idGroupCreation)) {
            $useMinMax = false;
            if (isset($idGroupCreation['min'])) {
                $this->addUsingAlias(ExpensePeer::ID_GROUP_CREATION, $idGroupCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGroupCreation['max'])) {
                $this->addUsingAlias(ExpensePeer::ID_GROUP_CREATION, $idGroupCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::ID_GROUP_CREATION, $idGroupCreation, $comparison);
    }

    /**
     * Filter the query on the id_creation column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCreation(1234); // WHERE id_creation = 1234
     * $query->filterByIdCreation(array(12, 34)); // WHERE id_creation IN (12, 34)
     * $query->filterByIdCreation(array('min' => 12)); // WHERE id_creation >= 12
     * $query->filterByIdCreation(array('max' => 12)); // WHERE id_creation <= 12
     * </code>
     *
     * @see       filterByAuthyRelatedByIdCreation()
     *
     * @param     mixed $idCreation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByIdCreation($idCreation = null, $comparison = null)
    {
        if (is_array($idCreation)) {
            $useMinMax = false;
            if (isset($idCreation['min'])) {
                $this->addUsingAlias(ExpensePeer::ID_CREATION, $idCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCreation['max'])) {
                $this->addUsingAlias(ExpensePeer::ID_CREATION, $idCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::ID_CREATION, $idCreation, $comparison);
    }

    /**
     * Filter the query on the id_modification column
     *
     * Example usage:
     * <code>
     * $query->filterByIdModification(1234); // WHERE id_modification = 1234
     * $query->filterByIdModification(array(12, 34)); // WHERE id_modification IN (12, 34)
     * $query->filterByIdModification(array('min' => 12)); // WHERE id_modification >= 12
     * $query->filterByIdModification(array('max' => 12)); // WHERE id_modification <= 12
     * </code>
     *
     * @see       filterByAuthyRelatedByIdModification()
     *
     * @param     mixed $idModification The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function filterByIdModification($idModification = null, $comparison = null)
    {
        if (is_array($idModification)) {
            $useMinMax = false;
            if (isset($idModification['min'])) {
                $this->addUsingAlias(ExpensePeer::ID_MODIFICATION, $idModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idModification['max'])) {
                $this->addUsingAlias(ExpensePeer::ID_MODIFICATION, $idModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpensePeer::ID_MODIFICATION, $idModification, $comparison);
    }

    /**
     * Filter the query by a related BillingCategory object
     *
     * @param   BillingCategory|PropelObjectCollection $billingCategory The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ExpenseQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBillingCategory($billingCategory, $comparison = null)
    {
        if ($billingCategory instanceof BillingCategory) {
            return $this
                ->addUsingAlias(ExpensePeer::ID_BILLING_CATEGORY, $billingCategory->getIdBillingCategory(), $comparison);
        } elseif ($billingCategory instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensePeer::ID_BILLING_CATEGORY, $billingCategory->toKeyValue('PrimaryKey', 'IdBillingCategory'), $comparison);
        } else {
            throw new PropelException('filterByBillingCategory() only accepts arguments of type BillingCategory or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BillingCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function joinBillingCategory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BillingCategory');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'BillingCategory');
        }

        return $this;
    }

    /**
     * Use the BillingCategory relation BillingCategory object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\BillingCategoryQuery A secondary query class using the current class as primary query
     */
    public function useBillingCategoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBillingCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BillingCategory', '\App\BillingCategoryQuery');
    }

    /**
     * Filter the query by a related Project object
     *
     * @param   Project|PropelObjectCollection $project The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ExpenseQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProjectRelatedByIdClient($project, $comparison = null)
    {
        if ($project instanceof Project) {
            return $this
                ->addUsingAlias(ExpensePeer::ID_CLIENT, $project->getIdClient(), $comparison);
        } elseif ($project instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensePeer::ID_CLIENT, $project->toKeyValue('PrimaryKey', 'IdClient'), $comparison);
        } else {
            throw new PropelException('filterByProjectRelatedByIdClient() only accepts arguments of type Project or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectRelatedByIdClient relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function joinProjectRelatedByIdClient($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectRelatedByIdClient');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProjectRelatedByIdClient');
        }

        return $this;
    }

    /**
     * Use the ProjectRelatedByIdClient relation Project object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\ProjectQuery A secondary query class using the current class as primary query
     */
    public function useProjectRelatedByIdClientQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProjectRelatedByIdClient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectRelatedByIdClient', '\App\ProjectQuery');
    }

    /**
     * Filter the query by a related Project object
     *
     * @param   Project|PropelObjectCollection $project The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ExpenseQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProjectRelatedByIdProject($project, $comparison = null)
    {
        if ($project instanceof Project) {
            return $this
                ->addUsingAlias(ExpensePeer::ID_PROJECT, $project->getIdProject(), $comparison);
        } elseif ($project instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensePeer::ID_PROJECT, $project->toKeyValue('PrimaryKey', 'IdProject'), $comparison);
        } else {
            throw new PropelException('filterByProjectRelatedByIdProject() only accepts arguments of type Project or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectRelatedByIdProject relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function joinProjectRelatedByIdProject($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectRelatedByIdProject');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ProjectRelatedByIdProject');
        }

        return $this;
    }

    /**
     * Use the ProjectRelatedByIdProject relation Project object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\ProjectQuery A secondary query class using the current class as primary query
     */
    public function useProjectRelatedByIdProjectQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProjectRelatedByIdProject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectRelatedByIdProject', '\App\ProjectQuery');
    }

    /**
     * Filter the query by a related Authy object
     *
     * @param   Authy|PropelObjectCollection $authy The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ExpenseQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdAssign($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(ExpensePeer::ID_ASSIGN, $authy->getIdCreation(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensePeer::ID_ASSIGN, $authy->toKeyValue('PrimaryKey', 'IdCreation'), $comparison);
        } else {
            throw new PropelException('filterByAuthyRelatedByIdAssign() only accepts arguments of type Authy or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AuthyRelatedByIdAssign relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function joinAuthyRelatedByIdAssign($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AuthyRelatedByIdAssign');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AuthyRelatedByIdAssign');
        }

        return $this;
    }

    /**
     * Use the AuthyRelatedByIdAssign relation Authy object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\AuthyQuery A secondary query class using the current class as primary query
     */
    public function useAuthyRelatedByIdAssignQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAuthyRelatedByIdAssign($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AuthyRelatedByIdAssign', '\App\AuthyQuery');
    }

    /**
     * Filter the query by a related Supplier object
     *
     * @param   Supplier|PropelObjectCollection $supplier The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ExpenseQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySupplier($supplier, $comparison = null)
    {
        if ($supplier instanceof Supplier) {
            return $this
                ->addUsingAlias(ExpensePeer::ID_SUPPLIER, $supplier->getIdSupplier(), $comparison);
        } elseif ($supplier instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensePeer::ID_SUPPLIER, $supplier->toKeyValue('PrimaryKey', 'IdSupplier'), $comparison);
        } else {
            throw new PropelException('filterBySupplier() only accepts arguments of type Supplier or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Supplier relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function joinSupplier($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Supplier');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Supplier');
        }

        return $this;
    }

    /**
     * Use the Supplier relation Supplier object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\SupplierQuery A secondary query class using the current class as primary query
     */
    public function useSupplierQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSupplier($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Supplier', '\App\SupplierQuery');
    }

    /**
     * Filter the query by a related AuthyGroup object
     *
     * @param   AuthyGroup|PropelObjectCollection $authyGroup The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ExpenseQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyGroup($authyGroup, $comparison = null)
    {
        if ($authyGroup instanceof AuthyGroup) {
            return $this
                ->addUsingAlias(ExpensePeer::ID_GROUP_CREATION, $authyGroup->getIdAuthyGroup(), $comparison);
        } elseif ($authyGroup instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensePeer::ID_GROUP_CREATION, $authyGroup->toKeyValue('PrimaryKey', 'IdAuthyGroup'), $comparison);
        } else {
            throw new PropelException('filterByAuthyGroup() only accepts arguments of type AuthyGroup or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AuthyGroup relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function joinAuthyGroup($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AuthyGroup');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AuthyGroup');
        }

        return $this;
    }

    /**
     * Use the AuthyGroup relation AuthyGroup object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\AuthyGroupQuery A secondary query class using the current class as primary query
     */
    public function useAuthyGroupQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAuthyGroup($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AuthyGroup', '\App\AuthyGroupQuery');
    }

    /**
     * Filter the query by a related Authy object
     *
     * @param   Authy|PropelObjectCollection $authy The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ExpenseQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdCreation($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(ExpensePeer::ID_CREATION, $authy->getIdAuthy(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensePeer::ID_CREATION, $authy->toKeyValue('PrimaryKey', 'IdAuthy'), $comparison);
        } else {
            throw new PropelException('filterByAuthyRelatedByIdCreation() only accepts arguments of type Authy or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AuthyRelatedByIdCreation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function joinAuthyRelatedByIdCreation($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AuthyRelatedByIdCreation');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AuthyRelatedByIdCreation');
        }

        return $this;
    }

    /**
     * Use the AuthyRelatedByIdCreation relation Authy object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\AuthyQuery A secondary query class using the current class as primary query
     */
    public function useAuthyRelatedByIdCreationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAuthyRelatedByIdCreation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AuthyRelatedByIdCreation', '\App\AuthyQuery');
    }

    /**
     * Filter the query by a related Authy object
     *
     * @param   Authy|PropelObjectCollection $authy The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ExpenseQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdModification($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(ExpensePeer::ID_MODIFICATION, $authy->getIdAuthy(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpensePeer::ID_MODIFICATION, $authy->toKeyValue('PrimaryKey', 'IdAuthy'), $comparison);
        } else {
            throw new PropelException('filterByAuthyRelatedByIdModification() only accepts arguments of type Authy or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the AuthyRelatedByIdModification relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function joinAuthyRelatedByIdModification($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('AuthyRelatedByIdModification');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'AuthyRelatedByIdModification');
        }

        return $this;
    }

    /**
     * Use the AuthyRelatedByIdModification relation Authy object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\AuthyQuery A secondary query class using the current class as primary query
     */
    public function useAuthyRelatedByIdModificationQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAuthyRelatedByIdModification($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'AuthyRelatedByIdModification', '\App\AuthyQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Expense $expense Object to remove from the list of results
     *
     * @return ExpenseQuery The current query, for fluid interface
     */
    public function prune($expense = null)
    {
        if ($expense) {
            $this->addUsingAlias(ExpensePeer::ID_EXPENSE, $expense->getIdExpense(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // add_tablestamp behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ExpenseQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7){
        return $this->addUsingAlias(ExpensePeer::DATE_MODIFICATION, time() - $nbDays * 24 * 60 * 60, \Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ExpenseQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst(){
        return $this->addDescendingOrderByColumn(ExpensePeer::DATE_MODIFICATION);
    }

    /**
     * Order by update date asc
     *
     * @return     ExpenseQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst(){
        return $this->addAscendingOrderByColumn(ExpensePeer::DATE_MODIFICATION);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ExpenseQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7){
        return $this->addUsingAlias(ExpensePeer::DATE_CREATION, time() - $nbDays * 24 * 60 * 60, \Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     ExpenseQuery The current query, for fluid interface
     */
    public function lastCreatedFirst(){
        return $this->addDescendingOrderByColumn(ExpensePeer::DATE_CREATION);
    }

    /**
     * Order by create date asc
     *
     * @return     ExpenseQuery The current query, for fluid interface
     */
    public function firstCreatedFirst(){
        return $this->addAscendingOrderByColumn(ExpensePeer::DATE_CREATION);
    }
}
