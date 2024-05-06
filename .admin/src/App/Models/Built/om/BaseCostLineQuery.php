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
use App\Billing;
use App\BillingCategory;
use App\CostLine;
use App\CostLinePeer;
use App\CostLineQuery;
use App\Project;
use App\Supplier;

/**
 * Base class that represents a query for the 'cost_line' table.
 *
 * Expense
 *
 * @method CostLineQuery orderByIdCostLine($order = Criteria::ASC) Order by the id_cost_line column
 * @method CostLineQuery orderByIdBilling($order = Criteria::ASC) Order by the id_billing column
 * @method CostLineQuery orderByCalcId($order = Criteria::ASC) Order by the calc_id column
 * @method CostLineQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method CostLineQuery orderByIdSupplier($order = Criteria::ASC) Order by the id_supplier column
 * @method CostLineQuery orderByInvoiceNo($order = Criteria::ASC) Order by the invoice_no column
 * @method CostLineQuery orderByIdProject($order = Criteria::ASC) Order by the id_project column
 * @method CostLineQuery orderByIdBillingCategory($order = Criteria::ASC) Order by the id_billing_category column
 * @method CostLineQuery orderBySpendDate($order = Criteria::ASC) Order by the spend_date column
 * @method CostLineQuery orderByRecuring($order = Criteria::ASC) Order by the recuring column
 * @method CostLineQuery orderByRenewalDate($order = Criteria::ASC) Order by the renewal_date column
 * @method CostLineQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method CostLineQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method CostLineQuery orderByTotal($order = Criteria::ASC) Order by the total column
 * @method CostLineQuery orderByBill($order = Criteria::ASC) Order by the bill column
 * @method CostLineQuery orderByNoteBillingLigne($order = Criteria::ASC) Order by the note_billing_ligne column
 * @method CostLineQuery orderByDateCreation($order = Criteria::ASC) Order by the date_creation column
 * @method CostLineQuery orderByDateModification($order = Criteria::ASC) Order by the date_modification column
 * @method CostLineQuery orderByIdGroupCreation($order = Criteria::ASC) Order by the id_group_creation column
 * @method CostLineQuery orderByIdCreation($order = Criteria::ASC) Order by the id_creation column
 * @method CostLineQuery orderByIdModification($order = Criteria::ASC) Order by the id_modification column
 *
 * @method CostLineQuery groupByIdCostLine() Group by the id_cost_line column
 * @method CostLineQuery groupByIdBilling() Group by the id_billing column
 * @method CostLineQuery groupByCalcId() Group by the calc_id column
 * @method CostLineQuery groupByTitle() Group by the title column
 * @method CostLineQuery groupByIdSupplier() Group by the id_supplier column
 * @method CostLineQuery groupByInvoiceNo() Group by the invoice_no column
 * @method CostLineQuery groupByIdProject() Group by the id_project column
 * @method CostLineQuery groupByIdBillingCategory() Group by the id_billing_category column
 * @method CostLineQuery groupBySpendDate() Group by the spend_date column
 * @method CostLineQuery groupByRecuring() Group by the recuring column
 * @method CostLineQuery groupByRenewalDate() Group by the renewal_date column
 * @method CostLineQuery groupByQuantity() Group by the quantity column
 * @method CostLineQuery groupByAmount() Group by the amount column
 * @method CostLineQuery groupByTotal() Group by the total column
 * @method CostLineQuery groupByBill() Group by the bill column
 * @method CostLineQuery groupByNoteBillingLigne() Group by the note_billing_ligne column
 * @method CostLineQuery groupByDateCreation() Group by the date_creation column
 * @method CostLineQuery groupByDateModification() Group by the date_modification column
 * @method CostLineQuery groupByIdGroupCreation() Group by the id_group_creation column
 * @method CostLineQuery groupByIdCreation() Group by the id_creation column
 * @method CostLineQuery groupByIdModification() Group by the id_modification column
 *
 * @method CostLineQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method CostLineQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method CostLineQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method CostLineQuery leftJoinBilling($relationAlias = null) Adds a LEFT JOIN clause to the query using the Billing relation
 * @method CostLineQuery rightJoinBilling($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Billing relation
 * @method CostLineQuery innerJoinBilling($relationAlias = null) Adds a INNER JOIN clause to the query using the Billing relation
 *
 * @method CostLineQuery leftJoinSupplier($relationAlias = null) Adds a LEFT JOIN clause to the query using the Supplier relation
 * @method CostLineQuery rightJoinSupplier($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Supplier relation
 * @method CostLineQuery innerJoinSupplier($relationAlias = null) Adds a INNER JOIN clause to the query using the Supplier relation
 *
 * @method CostLineQuery leftJoinProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Project relation
 * @method CostLineQuery rightJoinProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Project relation
 * @method CostLineQuery innerJoinProject($relationAlias = null) Adds a INNER JOIN clause to the query using the Project relation
 *
 * @method CostLineQuery leftJoinBillingCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the BillingCategory relation
 * @method CostLineQuery rightJoinBillingCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BillingCategory relation
 * @method CostLineQuery innerJoinBillingCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the BillingCategory relation
 *
 * @method CostLineQuery leftJoinAuthyGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyGroup relation
 * @method CostLineQuery rightJoinAuthyGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyGroup relation
 * @method CostLineQuery innerJoinAuthyGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyGroup relation
 *
 * @method CostLineQuery leftJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdCreation relation
 * @method CostLineQuery rightJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdCreation relation
 * @method CostLineQuery innerJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdCreation relation
 *
 * @method CostLineQuery leftJoinAuthyRelatedByIdModification($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdModification relation
 * @method CostLineQuery rightJoinAuthyRelatedByIdModification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdModification relation
 * @method CostLineQuery innerJoinAuthyRelatedByIdModification($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdModification relation
 *
 * @method CostLine findOne(PropelPDO $con = null) Return the first CostLine matching the query
 * @method CostLine findOneOrCreate(PropelPDO $con = null) Return the first CostLine matching the query, or a new CostLine object populated from the query conditions when no match is found
 *
 * @method CostLine findOneByIdBilling(int $id_billing) Return the first CostLine filtered by the id_billing column
 * @method CostLine findOneByCalcId(string $calc_id) Return the first CostLine filtered by the calc_id column
 * @method CostLine findOneByTitle(string $title) Return the first CostLine filtered by the title column
 * @method CostLine findOneByIdSupplier(int $id_supplier) Return the first CostLine filtered by the id_supplier column
 * @method CostLine findOneByInvoiceNo(string $invoice_no) Return the first CostLine filtered by the invoice_no column
 * @method CostLine findOneByIdProject(int $id_project) Return the first CostLine filtered by the id_project column
 * @method CostLine findOneByIdBillingCategory(int $id_billing_category) Return the first CostLine filtered by the id_billing_category column
 * @method CostLine findOneBySpendDate(string $spend_date) Return the first CostLine filtered by the spend_date column
 * @method CostLine findOneByRecuring(int $recuring) Return the first CostLine filtered by the recuring column
 * @method CostLine findOneByRenewalDate(string $renewal_date) Return the first CostLine filtered by the renewal_date column
 * @method CostLine findOneByQuantity(string $quantity) Return the first CostLine filtered by the quantity column
 * @method CostLine findOneByAmount(string $amount) Return the first CostLine filtered by the amount column
 * @method CostLine findOneByTotal(string $total) Return the first CostLine filtered by the total column
 * @method CostLine findOneByBill(int $bill) Return the first CostLine filtered by the bill column
 * @method CostLine findOneByNoteBillingLigne(string $note_billing_ligne) Return the first CostLine filtered by the note_billing_ligne column
 * @method CostLine findOneByDateCreation(string $date_creation) Return the first CostLine filtered by the date_creation column
 * @method CostLine findOneByDateModification(string $date_modification) Return the first CostLine filtered by the date_modification column
 * @method CostLine findOneByIdGroupCreation(int $id_group_creation) Return the first CostLine filtered by the id_group_creation column
 * @method CostLine findOneByIdCreation(int $id_creation) Return the first CostLine filtered by the id_creation column
 * @method CostLine findOneByIdModification(int $id_modification) Return the first CostLine filtered by the id_modification column
 *
 * @method array findByIdCostLine(int $id_cost_line) Return CostLine objects filtered by the id_cost_line column
 * @method array findByIdBilling(int $id_billing) Return CostLine objects filtered by the id_billing column
 * @method array findByCalcId(string $calc_id) Return CostLine objects filtered by the calc_id column
 * @method array findByTitle(string $title) Return CostLine objects filtered by the title column
 * @method array findByIdSupplier(int $id_supplier) Return CostLine objects filtered by the id_supplier column
 * @method array findByInvoiceNo(string $invoice_no) Return CostLine objects filtered by the invoice_no column
 * @method array findByIdProject(int $id_project) Return CostLine objects filtered by the id_project column
 * @method array findByIdBillingCategory(int $id_billing_category) Return CostLine objects filtered by the id_billing_category column
 * @method array findBySpendDate(string $spend_date) Return CostLine objects filtered by the spend_date column
 * @method array findByRecuring(int $recuring) Return CostLine objects filtered by the recuring column
 * @method array findByRenewalDate(string $renewal_date) Return CostLine objects filtered by the renewal_date column
 * @method array findByQuantity(string $quantity) Return CostLine objects filtered by the quantity column
 * @method array findByAmount(string $amount) Return CostLine objects filtered by the amount column
 * @method array findByTotal(string $total) Return CostLine objects filtered by the total column
 * @method array findByBill(int $bill) Return CostLine objects filtered by the bill column
 * @method array findByNoteBillingLigne(string $note_billing_ligne) Return CostLine objects filtered by the note_billing_ligne column
 * @method array findByDateCreation(string $date_creation) Return CostLine objects filtered by the date_creation column
 * @method array findByDateModification(string $date_modification) Return CostLine objects filtered by the date_modification column
 * @method array findByIdGroupCreation(int $id_group_creation) Return CostLine objects filtered by the id_group_creation column
 * @method array findByIdCreation(int $id_creation) Return CostLine objects filtered by the id_creation column
 * @method array findByIdModification(int $id_modification) Return CostLine objects filtered by the id_modification column
 *
 * @package    propel.generator..om
 */
abstract class BaseCostLineQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseCostLineQuery object.
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
            $modelName = 'App\\CostLine';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new CostLineQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   CostLineQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return CostLineQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof CostLineQuery) {
            return $criteria;
        }
        $query = new CostLineQuery(null, null, $modelAlias);

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
     * @return   CostLine|CostLine[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CostLinePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(CostLinePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 CostLine A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdCostLine($key, $con = null)
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
     * @return                 CostLine A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id_cost_line`, `id_billing`, `calc_id`, `title`, `id_supplier`, `invoice_no`, `id_project`, `id_billing_category`, `spend_date`, `recuring`, `renewal_date`, `quantity`, `amount`, `total`, `bill`, `note_billing_ligne`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification` FROM `cost_line` WHERE `id_cost_line` = :p0';
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
            $obj = new CostLine();
            $obj->hydrate($row);
            CostLinePeer::addInstanceToPool($obj, (string) $key);
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
     * @return CostLine|CostLine[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|CostLine[]|mixed the list of results, formatted by the current formatter
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CostLinePeer::ID_COST_LINE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CostLinePeer::ID_COST_LINE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_cost_line column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCostLine(1234); // WHERE id_cost_line = 1234
     * $query->filterByIdCostLine(array(12, 34)); // WHERE id_cost_line IN (12, 34)
     * $query->filterByIdCostLine(array('min' => 12)); // WHERE id_cost_line >= 12
     * $query->filterByIdCostLine(array('max' => 12)); // WHERE id_cost_line <= 12
     * </code>
     *
     * @param     mixed $idCostLine The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByIdCostLine($idCostLine = null, $comparison = null)
    {
        if (is_array($idCostLine)) {
            $useMinMax = false;
            if (isset($idCostLine['min'])) {
                $this->addUsingAlias(CostLinePeer::ID_COST_LINE, $idCostLine['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCostLine['max'])) {
                $this->addUsingAlias(CostLinePeer::ID_COST_LINE, $idCostLine['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::ID_COST_LINE, $idCostLine, $comparison);
    }

    /**
     * Filter the query on the id_billing column
     *
     * Example usage:
     * <code>
     * $query->filterByIdBilling(1234); // WHERE id_billing = 1234
     * $query->filterByIdBilling(array(12, 34)); // WHERE id_billing IN (12, 34)
     * $query->filterByIdBilling(array('min' => 12)); // WHERE id_billing >= 12
     * $query->filterByIdBilling(array('max' => 12)); // WHERE id_billing <= 12
     * </code>
     *
     * @see       filterByBilling()
     *
     * @param     mixed $idBilling The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByIdBilling($idBilling = null, $comparison = null)
    {
        if (is_array($idBilling)) {
            $useMinMax = false;
            if (isset($idBilling['min'])) {
                $this->addUsingAlias(CostLinePeer::ID_BILLING, $idBilling['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBilling['max'])) {
                $this->addUsingAlias(CostLinePeer::ID_BILLING, $idBilling['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::ID_BILLING, $idBilling, $comparison);
    }

    /**
     * Filter the query on the calc_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCalcId('fooValue');   // WHERE calc_id = 'fooValue'
     * $query->filterByCalcId('%fooValue%'); // WHERE calc_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $calcId The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByCalcId($calcId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($calcId)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $calcId)) {
                $calcId = str_replace('*', '%', $calcId);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CostLinePeer::CALC_ID, $calcId, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CostLinePeer::TITLE, $title, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByIdSupplier($idSupplier = null, $comparison = null)
    {
        if (is_array($idSupplier)) {
            $useMinMax = false;
            if (isset($idSupplier['min'])) {
                $this->addUsingAlias(CostLinePeer::ID_SUPPLIER, $idSupplier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSupplier['max'])) {
                $this->addUsingAlias(CostLinePeer::ID_SUPPLIER, $idSupplier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::ID_SUPPLIER, $idSupplier, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CostLinePeer::INVOICE_NO, $invoiceNo, $comparison);
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
     * @see       filterByProject()
     *
     * @param     mixed $idProject The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByIdProject($idProject = null, $comparison = null)
    {
        if (is_array($idProject)) {
            $useMinMax = false;
            if (isset($idProject['min'])) {
                $this->addUsingAlias(CostLinePeer::ID_PROJECT, $idProject['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProject['max'])) {
                $this->addUsingAlias(CostLinePeer::ID_PROJECT, $idProject['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::ID_PROJECT, $idProject, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByIdBillingCategory($idBillingCategory = null, $comparison = null)
    {
        if (is_array($idBillingCategory)) {
            $useMinMax = false;
            if (isset($idBillingCategory['min'])) {
                $this->addUsingAlias(CostLinePeer::ID_BILLING_CATEGORY, $idBillingCategory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBillingCategory['max'])) {
                $this->addUsingAlias(CostLinePeer::ID_BILLING_CATEGORY, $idBillingCategory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::ID_BILLING_CATEGORY, $idBillingCategory, $comparison);
    }

    /**
     * Filter the query on the spend_date column
     *
     * Example usage:
     * <code>
     * $query->filterBySpendDate('2011-03-14'); // WHERE spend_date = '2011-03-14'
     * $query->filterBySpendDate('now'); // WHERE spend_date = '2011-03-14'
     * $query->filterBySpendDate(array('max' => 'yesterday')); // WHERE spend_date < '2011-03-13'
     * </code>
     *
     * @param     mixed $spendDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterBySpendDate($spendDate = null, $comparison = null)
    {
        if (is_array($spendDate)) {
            $useMinMax = false;
            if (isset($spendDate['min'])) {
                $this->addUsingAlias(CostLinePeer::SPEND_DATE, $spendDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($spendDate['max'])) {
                $this->addUsingAlias(CostLinePeer::SPEND_DATE, $spendDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::SPEND_DATE, $spendDate, $comparison);
    }

    /**
     * Filter the query on the recuring column
     *
     * @param     mixed $recuring The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CostLineQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByRecuring($recuring = null, $comparison = null)
    {
        if (is_scalar($recuring)) {
            $recuring = CostLinePeer::getSqlValueForEnum(CostLinePeer::RECURING, $recuring);
        } elseif (is_array($recuring)) {
            $convertedValues = array();
            foreach ($recuring as $value) {
                $convertedValues[] = CostLinePeer::getSqlValueForEnum(CostLinePeer::RECURING, $value);
            }
            $recuring = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::RECURING, $recuring, $comparison);
    }

    /**
     * Filter the query on the renewal_date column
     *
     * Example usage:
     * <code>
     * $query->filterByRenewalDate('2011-03-14'); // WHERE renewal_date = '2011-03-14'
     * $query->filterByRenewalDate('now'); // WHERE renewal_date = '2011-03-14'
     * $query->filterByRenewalDate(array('max' => 'yesterday')); // WHERE renewal_date < '2011-03-13'
     * </code>
     *
     * @param     mixed $renewalDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByRenewalDate($renewalDate = null, $comparison = null)
    {
        if (is_array($renewalDate)) {
            $useMinMax = false;
            if (isset($renewalDate['min'])) {
                $this->addUsingAlias(CostLinePeer::RENEWAL_DATE, $renewalDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($renewalDate['max'])) {
                $this->addUsingAlias(CostLinePeer::RENEWAL_DATE, $renewalDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::RENEWAL_DATE, $renewalDate, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(CostLinePeer::QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(CostLinePeer::QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::QUANTITY, $quantity, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(CostLinePeer::AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(CostLinePeer::AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::AMOUNT, $amount, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByTotal($total = null, $comparison = null)
    {
        if (is_array($total)) {
            $useMinMax = false;
            if (isset($total['min'])) {
                $this->addUsingAlias(CostLinePeer::TOTAL, $total['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($total['max'])) {
                $this->addUsingAlias(CostLinePeer::TOTAL, $total['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::TOTAL, $total, $comparison);
    }

    /**
     * Filter the query on the bill column
     *
     * @param     mixed $bill The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CostLineQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByBill($bill = null, $comparison = null)
    {
        if (is_scalar($bill)) {
            $bill = CostLinePeer::getSqlValueForEnum(CostLinePeer::BILL, $bill);
        } elseif (is_array($bill)) {
            $convertedValues = array();
            foreach ($bill as $value) {
                $convertedValues[] = CostLinePeer::getSqlValueForEnum(CostLinePeer::BILL, $value);
            }
            $bill = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::BILL, $bill, $comparison);
    }

    /**
     * Filter the query on the note_billing_ligne column
     *
     * Example usage:
     * <code>
     * $query->filterByNoteBillingLigne('fooValue');   // WHERE note_billing_ligne = 'fooValue'
     * $query->filterByNoteBillingLigne('%fooValue%'); // WHERE note_billing_ligne LIKE '%fooValue%'
     * </code>
     *
     * @param     string $noteBillingLigne The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByNoteBillingLigne($noteBillingLigne = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($noteBillingLigne)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $noteBillingLigne)) {
                $noteBillingLigne = str_replace('*', '%', $noteBillingLigne);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CostLinePeer::NOTE_BILLING_LIGNE, $noteBillingLigne, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByDateCreation($dateCreation = null, $comparison = null)
    {
        if (is_array($dateCreation)) {
            $useMinMax = false;
            if (isset($dateCreation['min'])) {
                $this->addUsingAlias(CostLinePeer::DATE_CREATION, $dateCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCreation['max'])) {
                $this->addUsingAlias(CostLinePeer::DATE_CREATION, $dateCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::DATE_CREATION, $dateCreation, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByDateModification($dateModification = null, $comparison = null)
    {
        if (is_array($dateModification)) {
            $useMinMax = false;
            if (isset($dateModification['min'])) {
                $this->addUsingAlias(CostLinePeer::DATE_MODIFICATION, $dateModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateModification['max'])) {
                $this->addUsingAlias(CostLinePeer::DATE_MODIFICATION, $dateModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::DATE_MODIFICATION, $dateModification, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByIdGroupCreation($idGroupCreation = null, $comparison = null)
    {
        if (is_array($idGroupCreation)) {
            $useMinMax = false;
            if (isset($idGroupCreation['min'])) {
                $this->addUsingAlias(CostLinePeer::ID_GROUP_CREATION, $idGroupCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGroupCreation['max'])) {
                $this->addUsingAlias(CostLinePeer::ID_GROUP_CREATION, $idGroupCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::ID_GROUP_CREATION, $idGroupCreation, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByIdCreation($idCreation = null, $comparison = null)
    {
        if (is_array($idCreation)) {
            $useMinMax = false;
            if (isset($idCreation['min'])) {
                $this->addUsingAlias(CostLinePeer::ID_CREATION, $idCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCreation['max'])) {
                $this->addUsingAlias(CostLinePeer::ID_CREATION, $idCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::ID_CREATION, $idCreation, $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
     */
    public function filterByIdModification($idModification = null, $comparison = null)
    {
        if (is_array($idModification)) {
            $useMinMax = false;
            if (isset($idModification['min'])) {
                $this->addUsingAlias(CostLinePeer::ID_MODIFICATION, $idModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idModification['max'])) {
                $this->addUsingAlias(CostLinePeer::ID_MODIFICATION, $idModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CostLinePeer::ID_MODIFICATION, $idModification, $comparison);
    }

    /**
     * Filter the query by a related Billing object
     *
     * @param   Billing|PropelObjectCollection $billing The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CostLineQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBilling($billing, $comparison = null)
    {
        if ($billing instanceof Billing) {
            return $this
                ->addUsingAlias(CostLinePeer::ID_BILLING, $billing->getIdBilling(), $comparison);
        } elseif ($billing instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CostLinePeer::ID_BILLING, $billing->toKeyValue('PrimaryKey', 'IdBilling'), $comparison);
        } else {
            throw new PropelException('filterByBilling() only accepts arguments of type Billing or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Billing relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function joinBilling($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Billing');

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
            $this->addJoinObject($join, 'Billing');
        }

        return $this;
    }

    /**
     * Use the Billing relation Billing object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\BillingQuery A secondary query class using the current class as primary query
     */
    public function useBillingQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBilling($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Billing', '\App\BillingQuery');
    }

    /**
     * Filter the query by a related Supplier object
     *
     * @param   Supplier|PropelObjectCollection $supplier The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CostLineQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterBySupplier($supplier, $comparison = null)
    {
        if ($supplier instanceof Supplier) {
            return $this
                ->addUsingAlias(CostLinePeer::ID_SUPPLIER, $supplier->getIdSupplier(), $comparison);
        } elseif ($supplier instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CostLinePeer::ID_SUPPLIER, $supplier->toKeyValue('PrimaryKey', 'IdSupplier'), $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
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
     * Filter the query by a related Project object
     *
     * @param   Project|PropelObjectCollection $project The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CostLineQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProject($project, $comparison = null)
    {
        if ($project instanceof Project) {
            return $this
                ->addUsingAlias(CostLinePeer::ID_PROJECT, $project->getIdProject(), $comparison);
        } elseif ($project instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CostLinePeer::ID_PROJECT, $project->toKeyValue('PrimaryKey', 'IdProject'), $comparison);
        } else {
            throw new PropelException('filterByProject() only accepts arguments of type Project or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Project relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function joinProject($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Project');

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
            $this->addJoinObject($join, 'Project');
        }

        return $this;
    }

    /**
     * Use the Project relation Project object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\ProjectQuery A secondary query class using the current class as primary query
     */
    public function useProjectQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Project', '\App\ProjectQuery');
    }

    /**
     * Filter the query by a related BillingCategory object
     *
     * @param   BillingCategory|PropelObjectCollection $billingCategory The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CostLineQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBillingCategory($billingCategory, $comparison = null)
    {
        if ($billingCategory instanceof BillingCategory) {
            return $this
                ->addUsingAlias(CostLinePeer::ID_BILLING_CATEGORY, $billingCategory->getIdBillingCategory(), $comparison);
        } elseif ($billingCategory instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CostLinePeer::ID_BILLING_CATEGORY, $billingCategory->toKeyValue('PrimaryKey', 'IdBillingCategory'), $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
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
     * Filter the query by a related AuthyGroup object
     *
     * @param   AuthyGroup|PropelObjectCollection $authyGroup The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 CostLineQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyGroup($authyGroup, $comparison = null)
    {
        if ($authyGroup instanceof AuthyGroup) {
            return $this
                ->addUsingAlias(CostLinePeer::ID_GROUP_CREATION, $authyGroup->getIdAuthyGroup(), $comparison);
        } elseif ($authyGroup instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CostLinePeer::ID_GROUP_CREATION, $authyGroup->toKeyValue('PrimaryKey', 'IdAuthyGroup'), $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
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
     * @return                 CostLineQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdCreation($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(CostLinePeer::ID_CREATION, $authy->getIdAuthy(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CostLinePeer::ID_CREATION, $authy->toKeyValue('PrimaryKey', 'IdAuthy'), $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
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
     * @return                 CostLineQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdModification($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(CostLinePeer::ID_MODIFICATION, $authy->getIdAuthy(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CostLinePeer::ID_MODIFICATION, $authy->toKeyValue('PrimaryKey', 'IdAuthy'), $comparison);
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
     * @return CostLineQuery The current query, for fluid interface
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
     * @param   CostLine $costLine Object to remove from the list of results
     *
     * @return CostLineQuery The current query, for fluid interface
     */
    public function prune($costLine = null)
    {
        if ($costLine) {
            $this->addUsingAlias(CostLinePeer::ID_COST_LINE, $costLine->getIdCostLine(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // add_tablestamp behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     CostLineQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7){
        return $this->addUsingAlias(CostLinePeer::DATE_MODIFICATION, time() - $nbDays * 24 * 60 * 60, \Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     CostLineQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst(){
        return $this->addDescendingOrderByColumn(CostLinePeer::DATE_MODIFICATION);
    }

    /**
     * Order by update date asc
     *
     * @return     CostLineQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst(){
        return $this->addAscendingOrderByColumn(CostLinePeer::DATE_MODIFICATION);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     CostLineQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7){
        return $this->addUsingAlias(CostLinePeer::DATE_CREATION, time() - $nbDays * 24 * 60 * 60, \Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     CostLineQuery The current query, for fluid interface
     */
    public function lastCreatedFirst(){
        return $this->addDescendingOrderByColumn(CostLinePeer::DATE_CREATION);
    }

    /**
     * Order by create date asc
     *
     * @return     CostLineQuery The current query, for fluid interface
     */
    public function firstCreatedFirst(){
        return $this->addAscendingOrderByColumn(CostLinePeer::DATE_CREATION);
    }
}
