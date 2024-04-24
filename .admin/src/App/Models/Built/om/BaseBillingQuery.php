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
use App\BillingLine;
use App\BillingPeer;
use App\BillingQuery;
use App\Client;
use App\CostLine;
use App\PaymentLine;
use App\Project;

/**
 * Base class that represents a query for the 'billing' table.
 *
 * Billing
 *
 * @method BillingQuery orderByIdBilling($order = Criteria::ASC) Order by the id_billing column
 * @method BillingQuery orderByCalcId($order = Criteria::ASC) Order by the calc_id column
 * @method BillingQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method BillingQuery orderByIdClient($order = Criteria::ASC) Order by the id_client column
 * @method BillingQuery orderByIdProject($order = Criteria::ASC) Order by the id_project column
 * @method BillingQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method BillingQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method BillingQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method BillingQuery orderByGross($order = Criteria::ASC) Order by the gross column
 * @method BillingQuery orderByDateDue($order = Criteria::ASC) Order by the date_due column
 * @method BillingQuery orderByNoteBilling($order = Criteria::ASC) Order by the note_billing column
 * @method BillingQuery orderByDatePaid($order = Criteria::ASC) Order by the date_paid column
 * @method BillingQuery orderByNet($order = Criteria::ASC) Order by the net column
 * @method BillingQuery orderByReference($order = Criteria::ASC) Order by the reference column
 * @method BillingQuery orderByDateCreation($order = Criteria::ASC) Order by the date_creation column
 * @method BillingQuery orderByDateModification($order = Criteria::ASC) Order by the date_modification column
 * @method BillingQuery orderByIdGroupCreation($order = Criteria::ASC) Order by the id_group_creation column
 * @method BillingQuery orderByIdCreation($order = Criteria::ASC) Order by the id_creation column
 * @method BillingQuery orderByIdModification($order = Criteria::ASC) Order by the id_modification column
 *
 * @method BillingQuery groupByIdBilling() Group by the id_billing column
 * @method BillingQuery groupByCalcId() Group by the calc_id column
 * @method BillingQuery groupByTitle() Group by the title column
 * @method BillingQuery groupByIdClient() Group by the id_client column
 * @method BillingQuery groupByIdProject() Group by the id_project column
 * @method BillingQuery groupByDate() Group by the date column
 * @method BillingQuery groupByType() Group by the type column
 * @method BillingQuery groupByState() Group by the state column
 * @method BillingQuery groupByGross() Group by the gross column
 * @method BillingQuery groupByDateDue() Group by the date_due column
 * @method BillingQuery groupByNoteBilling() Group by the note_billing column
 * @method BillingQuery groupByDatePaid() Group by the date_paid column
 * @method BillingQuery groupByNet() Group by the net column
 * @method BillingQuery groupByReference() Group by the reference column
 * @method BillingQuery groupByDateCreation() Group by the date_creation column
 * @method BillingQuery groupByDateModification() Group by the date_modification column
 * @method BillingQuery groupByIdGroupCreation() Group by the id_group_creation column
 * @method BillingQuery groupByIdCreation() Group by the id_creation column
 * @method BillingQuery groupByIdModification() Group by the id_modification column
 *
 * @method BillingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BillingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BillingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BillingQuery leftJoinClient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Client relation
 * @method BillingQuery rightJoinClient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Client relation
 * @method BillingQuery innerJoinClient($relationAlias = null) Adds a INNER JOIN clause to the query using the Client relation
 *
 * @method BillingQuery leftJoinProject($relationAlias = null) Adds a LEFT JOIN clause to the query using the Project relation
 * @method BillingQuery rightJoinProject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Project relation
 * @method BillingQuery innerJoinProject($relationAlias = null) Adds a INNER JOIN clause to the query using the Project relation
 *
 * @method BillingQuery leftJoinAuthyGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyGroup relation
 * @method BillingQuery rightJoinAuthyGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyGroup relation
 * @method BillingQuery innerJoinAuthyGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyGroup relation
 *
 * @method BillingQuery leftJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdCreation relation
 * @method BillingQuery rightJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdCreation relation
 * @method BillingQuery innerJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdCreation relation
 *
 * @method BillingQuery leftJoinAuthyRelatedByIdModification($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdModification relation
 * @method BillingQuery rightJoinAuthyRelatedByIdModification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdModification relation
 * @method BillingQuery innerJoinAuthyRelatedByIdModification($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdModification relation
 *
 * @method BillingQuery leftJoinBillingLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the BillingLine relation
 * @method BillingQuery rightJoinBillingLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BillingLine relation
 * @method BillingQuery innerJoinBillingLine($relationAlias = null) Adds a INNER JOIN clause to the query using the BillingLine relation
 *
 * @method BillingQuery leftJoinPaymentLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the PaymentLine relation
 * @method BillingQuery rightJoinPaymentLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PaymentLine relation
 * @method BillingQuery innerJoinPaymentLine($relationAlias = null) Adds a INNER JOIN clause to the query using the PaymentLine relation
 *
 * @method BillingQuery leftJoinCostLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the CostLine relation
 * @method BillingQuery rightJoinCostLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CostLine relation
 * @method BillingQuery innerJoinCostLine($relationAlias = null) Adds a INNER JOIN clause to the query using the CostLine relation
 *
 * @method Billing findOne(PropelPDO $con = null) Return the first Billing matching the query
 * @method Billing findOneOrCreate(PropelPDO $con = null) Return the first Billing matching the query, or a new Billing object populated from the query conditions when no match is found
 *
 * @method Billing findOneByCalcId(string $calc_id) Return the first Billing filtered by the calc_id column
 * @method Billing findOneByTitle(string $title) Return the first Billing filtered by the title column
 * @method Billing findOneByIdClient(int $id_client) Return the first Billing filtered by the id_client column
 * @method Billing findOneByIdProject(int $id_project) Return the first Billing filtered by the id_project column
 * @method Billing findOneByDate(string $date) Return the first Billing filtered by the date column
 * @method Billing findOneByType(int $type) Return the first Billing filtered by the type column
 * @method Billing findOneByState(int $state) Return the first Billing filtered by the state column
 * @method Billing findOneByGross(string $gross) Return the first Billing filtered by the gross column
 * @method Billing findOneByDateDue(string $date_due) Return the first Billing filtered by the date_due column
 * @method Billing findOneByNoteBilling(string $note_billing) Return the first Billing filtered by the note_billing column
 * @method Billing findOneByDatePaid(string $date_paid) Return the first Billing filtered by the date_paid column
 * @method Billing findOneByNet(string $net) Return the first Billing filtered by the net column
 * @method Billing findOneByReference(string $reference) Return the first Billing filtered by the reference column
 * @method Billing findOneByDateCreation(string $date_creation) Return the first Billing filtered by the date_creation column
 * @method Billing findOneByDateModification(string $date_modification) Return the first Billing filtered by the date_modification column
 * @method Billing findOneByIdGroupCreation(int $id_group_creation) Return the first Billing filtered by the id_group_creation column
 * @method Billing findOneByIdCreation(int $id_creation) Return the first Billing filtered by the id_creation column
 * @method Billing findOneByIdModification(int $id_modification) Return the first Billing filtered by the id_modification column
 *
 * @method array findByIdBilling(int $id_billing) Return Billing objects filtered by the id_billing column
 * @method array findByCalcId(string $calc_id) Return Billing objects filtered by the calc_id column
 * @method array findByTitle(string $title) Return Billing objects filtered by the title column
 * @method array findByIdClient(int $id_client) Return Billing objects filtered by the id_client column
 * @method array findByIdProject(int $id_project) Return Billing objects filtered by the id_project column
 * @method array findByDate(string $date) Return Billing objects filtered by the date column
 * @method array findByType(int $type) Return Billing objects filtered by the type column
 * @method array findByState(int $state) Return Billing objects filtered by the state column
 * @method array findByGross(string $gross) Return Billing objects filtered by the gross column
 * @method array findByDateDue(string $date_due) Return Billing objects filtered by the date_due column
 * @method array findByNoteBilling(string $note_billing) Return Billing objects filtered by the note_billing column
 * @method array findByDatePaid(string $date_paid) Return Billing objects filtered by the date_paid column
 * @method array findByNet(string $net) Return Billing objects filtered by the net column
 * @method array findByReference(string $reference) Return Billing objects filtered by the reference column
 * @method array findByDateCreation(string $date_creation) Return Billing objects filtered by the date_creation column
 * @method array findByDateModification(string $date_modification) Return Billing objects filtered by the date_modification column
 * @method array findByIdGroupCreation(int $id_group_creation) Return Billing objects filtered by the id_group_creation column
 * @method array findByIdCreation(int $id_creation) Return Billing objects filtered by the id_creation column
 * @method array findByIdModification(int $id_modification) Return Billing objects filtered by the id_modification column
 *
 * @package    propel.generator..om
 */
abstract class BaseBillingQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBillingQuery object.
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
            $modelName = 'App\\Billing';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BillingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   BillingQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BillingQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BillingQuery) {
            return $criteria;
        }
        $query = new BillingQuery(null, null, $modelAlias);

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
     * @return   Billing|Billing[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BillingPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BillingPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Billing A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdBilling($key, $con = null)
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
     * @return                 Billing A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id_billing`, `calc_id`, `title`, `id_client`, `id_project`, `date`, `type`, `state`, `gross`, `date_due`, `note_billing`, `date_paid`, `net`, `reference`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification` FROM `billing` WHERE `id_billing` = :p0';
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
            $obj = new Billing();
            $obj->hydrate($row);
            BillingPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Billing|Billing[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Billing[]|mixed the list of results, formatted by the current formatter
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
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BillingPeer::ID_BILLING, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BillingPeer::ID_BILLING, $keys, Criteria::IN);
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
     * @param     mixed $idBilling The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByIdBilling($idBilling = null, $comparison = null)
    {
        if (is_array($idBilling)) {
            $useMinMax = false;
            if (isset($idBilling['min'])) {
                $this->addUsingAlias(BillingPeer::ID_BILLING, $idBilling['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBilling['max'])) {
                $this->addUsingAlias(BillingPeer::ID_BILLING, $idBilling['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::ID_BILLING, $idBilling, $comparison);
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
     * @return BillingQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BillingPeer::CALC_ID, $calcId, $comparison);
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
     * @return BillingQuery The current query, for fluid interface
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

        return $this->addUsingAlias(BillingPeer::TITLE, $title, $comparison);
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
     * @see       filterByClient()
     *
     * @param     mixed $idClient The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByIdClient($idClient = null, $comparison = null)
    {
        if (is_array($idClient)) {
            $useMinMax = false;
            if (isset($idClient['min'])) {
                $this->addUsingAlias(BillingPeer::ID_CLIENT, $idClient['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idClient['max'])) {
                $this->addUsingAlias(BillingPeer::ID_CLIENT, $idClient['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::ID_CLIENT, $idClient, $comparison);
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
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByIdProject($idProject = null, $comparison = null)
    {
        if (is_array($idProject)) {
            $useMinMax = false;
            if (isset($idProject['min'])) {
                $this->addUsingAlias(BillingPeer::ID_PROJECT, $idProject['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProject['max'])) {
                $this->addUsingAlias(BillingPeer::ID_PROJECT, $idProject['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::ID_PROJECT, $idProject, $comparison);
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
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(BillingPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(BillingPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::DATE, $date, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * @param     mixed $type The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BillingQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (is_scalar($type)) {
            $type = BillingPeer::getSqlValueForEnum(BillingPeer::TYPE, $type);
        } elseif (is_array($type)) {
            $convertedValues = array();
            foreach ($type as $value) {
                $convertedValues[] = BillingPeer::getSqlValueForEnum(BillingPeer::TYPE, $value);
            }
            $type = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the state column
     *
     * @param     mixed $state The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BillingQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (is_scalar($state)) {
            $state = BillingPeer::getSqlValueForEnum(BillingPeer::STATE, $state);
        } elseif (is_array($state)) {
            $convertedValues = array();
            foreach ($state as $value) {
                $convertedValues[] = BillingPeer::getSqlValueForEnum(BillingPeer::STATE, $value);
            }
            $state = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::STATE, $state, $comparison);
    }

    /**
     * Filter the query on the gross column
     *
     * Example usage:
     * <code>
     * $query->filterByGross(1234); // WHERE gross = 1234
     * $query->filterByGross(array(12, 34)); // WHERE gross IN (12, 34)
     * $query->filterByGross(array('min' => 12)); // WHERE gross >= 12
     * $query->filterByGross(array('max' => 12)); // WHERE gross <= 12
     * </code>
     *
     * @param     mixed $gross The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByGross($gross = null, $comparison = null)
    {
        if (is_array($gross)) {
            $useMinMax = false;
            if (isset($gross['min'])) {
                $this->addUsingAlias(BillingPeer::GROSS, $gross['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($gross['max'])) {
                $this->addUsingAlias(BillingPeer::GROSS, $gross['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::GROSS, $gross, $comparison);
    }

    /**
     * Filter the query on the date_due column
     *
     * Example usage:
     * <code>
     * $query->filterByDateDue('2011-03-14'); // WHERE date_due = '2011-03-14'
     * $query->filterByDateDue('now'); // WHERE date_due = '2011-03-14'
     * $query->filterByDateDue(array('max' => 'yesterday')); // WHERE date_due < '2011-03-13'
     * </code>
     *
     * @param     mixed $dateDue The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByDateDue($dateDue = null, $comparison = null)
    {
        if (is_array($dateDue)) {
            $useMinMax = false;
            if (isset($dateDue['min'])) {
                $this->addUsingAlias(BillingPeer::DATE_DUE, $dateDue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateDue['max'])) {
                $this->addUsingAlias(BillingPeer::DATE_DUE, $dateDue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::DATE_DUE, $dateDue, $comparison);
    }

    /**
     * Filter the query on the note_billing column
     *
     * Example usage:
     * <code>
     * $query->filterByNoteBilling('fooValue');   // WHERE note_billing = 'fooValue'
     * $query->filterByNoteBilling('%fooValue%'); // WHERE note_billing LIKE '%fooValue%'
     * </code>
     *
     * @param     string $noteBilling The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByNoteBilling($noteBilling = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($noteBilling)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $noteBilling)) {
                $noteBilling = str_replace('*', '%', $noteBilling);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BillingPeer::NOTE_BILLING, $noteBilling, $comparison);
    }

    /**
     * Filter the query on the date_paid column
     *
     * Example usage:
     * <code>
     * $query->filterByDatePaid('2011-03-14'); // WHERE date_paid = '2011-03-14'
     * $query->filterByDatePaid('now'); // WHERE date_paid = '2011-03-14'
     * $query->filterByDatePaid(array('max' => 'yesterday')); // WHERE date_paid < '2011-03-13'
     * </code>
     *
     * @param     mixed $datePaid The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByDatePaid($datePaid = null, $comparison = null)
    {
        if (is_array($datePaid)) {
            $useMinMax = false;
            if (isset($datePaid['min'])) {
                $this->addUsingAlias(BillingPeer::DATE_PAID, $datePaid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($datePaid['max'])) {
                $this->addUsingAlias(BillingPeer::DATE_PAID, $datePaid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::DATE_PAID, $datePaid, $comparison);
    }

    /**
     * Filter the query on the net column
     *
     * Example usage:
     * <code>
     * $query->filterByNet(1234); // WHERE net = 1234
     * $query->filterByNet(array(12, 34)); // WHERE net IN (12, 34)
     * $query->filterByNet(array('min' => 12)); // WHERE net >= 12
     * $query->filterByNet(array('max' => 12)); // WHERE net <= 12
     * </code>
     *
     * @param     mixed $net The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByNet($net = null, $comparison = null)
    {
        if (is_array($net)) {
            $useMinMax = false;
            if (isset($net['min'])) {
                $this->addUsingAlias(BillingPeer::NET, $net['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($net['max'])) {
                $this->addUsingAlias(BillingPeer::NET, $net['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::NET, $net, $comparison);
    }

    /**
     * Filter the query on the reference column
     *
     * Example usage:
     * <code>
     * $query->filterByReference('fooValue');   // WHERE reference = 'fooValue'
     * $query->filterByReference('%fooValue%'); // WHERE reference LIKE '%fooValue%'
     * </code>
     *
     * @param     string $reference The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByReference($reference = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($reference)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $reference)) {
                $reference = str_replace('*', '%', $reference);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BillingPeer::REFERENCE, $reference, $comparison);
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
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByDateCreation($dateCreation = null, $comparison = null)
    {
        if (is_array($dateCreation)) {
            $useMinMax = false;
            if (isset($dateCreation['min'])) {
                $this->addUsingAlias(BillingPeer::DATE_CREATION, $dateCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCreation['max'])) {
                $this->addUsingAlias(BillingPeer::DATE_CREATION, $dateCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::DATE_CREATION, $dateCreation, $comparison);
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
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByDateModification($dateModification = null, $comparison = null)
    {
        if (is_array($dateModification)) {
            $useMinMax = false;
            if (isset($dateModification['min'])) {
                $this->addUsingAlias(BillingPeer::DATE_MODIFICATION, $dateModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateModification['max'])) {
                $this->addUsingAlias(BillingPeer::DATE_MODIFICATION, $dateModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::DATE_MODIFICATION, $dateModification, $comparison);
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
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByIdGroupCreation($idGroupCreation = null, $comparison = null)
    {
        if (is_array($idGroupCreation)) {
            $useMinMax = false;
            if (isset($idGroupCreation['min'])) {
                $this->addUsingAlias(BillingPeer::ID_GROUP_CREATION, $idGroupCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGroupCreation['max'])) {
                $this->addUsingAlias(BillingPeer::ID_GROUP_CREATION, $idGroupCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::ID_GROUP_CREATION, $idGroupCreation, $comparison);
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
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByIdCreation($idCreation = null, $comparison = null)
    {
        if (is_array($idCreation)) {
            $useMinMax = false;
            if (isset($idCreation['min'])) {
                $this->addUsingAlias(BillingPeer::ID_CREATION, $idCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCreation['max'])) {
                $this->addUsingAlias(BillingPeer::ID_CREATION, $idCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::ID_CREATION, $idCreation, $comparison);
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
     * @return BillingQuery The current query, for fluid interface
     */
    public function filterByIdModification($idModification = null, $comparison = null)
    {
        if (is_array($idModification)) {
            $useMinMax = false;
            if (isset($idModification['min'])) {
                $this->addUsingAlias(BillingPeer::ID_MODIFICATION, $idModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idModification['max'])) {
                $this->addUsingAlias(BillingPeer::ID_MODIFICATION, $idModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BillingPeer::ID_MODIFICATION, $idModification, $comparison);
    }

    /**
     * Filter the query by a related Client object
     *
     * @param   Client|PropelObjectCollection $client The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BillingQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByClient($client, $comparison = null)
    {
        if ($client instanceof Client) {
            return $this
                ->addUsingAlias(BillingPeer::ID_CLIENT, $client->getIdClient(), $comparison);
        } elseif ($client instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BillingPeer::ID_CLIENT, $client->toKeyValue('PrimaryKey', 'IdClient'), $comparison);
        } else {
            throw new PropelException('filterByClient() only accepts arguments of type Client or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Client relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function joinClient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Client');

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
            $this->addJoinObject($join, 'Client');
        }

        return $this;
    }

    /**
     * Use the Client relation Client object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\ClientQuery A secondary query class using the current class as primary query
     */
    public function useClientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinClient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Client', '\App\ClientQuery');
    }

    /**
     * Filter the query by a related Project object
     *
     * @param   Project|PropelObjectCollection $project The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BillingQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByProject($project, $comparison = null)
    {
        if ($project instanceof Project) {
            return $this
                ->addUsingAlias(BillingPeer::ID_PROJECT, $project->getIdProject(), $comparison);
        } elseif ($project instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BillingPeer::ID_PROJECT, $project->toKeyValue('PrimaryKey', 'IdProject'), $comparison);
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
     * @return BillingQuery The current query, for fluid interface
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
     * Filter the query by a related AuthyGroup object
     *
     * @param   AuthyGroup|PropelObjectCollection $authyGroup The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BillingQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyGroup($authyGroup, $comparison = null)
    {
        if ($authyGroup instanceof AuthyGroup) {
            return $this
                ->addUsingAlias(BillingPeer::ID_GROUP_CREATION, $authyGroup->getIdAuthyGroup(), $comparison);
        } elseif ($authyGroup instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BillingPeer::ID_GROUP_CREATION, $authyGroup->toKeyValue('PrimaryKey', 'IdAuthyGroup'), $comparison);
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
     * @return BillingQuery The current query, for fluid interface
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
     * @return                 BillingQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdCreation($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(BillingPeer::ID_CREATION, $authy->getIdAuthy(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BillingPeer::ID_CREATION, $authy->toKeyValue('PrimaryKey', 'IdAuthy'), $comparison);
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
     * @return BillingQuery The current query, for fluid interface
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
     * @return                 BillingQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdModification($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(BillingPeer::ID_MODIFICATION, $authy->getIdAuthy(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BillingPeer::ID_MODIFICATION, $authy->toKeyValue('PrimaryKey', 'IdAuthy'), $comparison);
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
     * @return BillingQuery The current query, for fluid interface
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
     * Filter the query by a related BillingLine object
     *
     * @param   BillingLine|PropelObjectCollection $billingLine  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BillingQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBillingLine($billingLine, $comparison = null)
    {
        if ($billingLine instanceof BillingLine) {
            return $this
                ->addUsingAlias(BillingPeer::ID_BILLING, $billingLine->getIdBilling(), $comparison);
        } elseif ($billingLine instanceof PropelObjectCollection) {
            return $this
                ->useBillingLineQuery()
                ->filterByPrimaryKeys($billingLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBillingLine() only accepts arguments of type BillingLine or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BillingLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function joinBillingLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BillingLine');

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
            $this->addJoinObject($join, 'BillingLine');
        }

        return $this;
    }

    /**
     * Use the BillingLine relation BillingLine object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\BillingLineQuery A secondary query class using the current class as primary query
     */
    public function useBillingLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBillingLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BillingLine', '\App\BillingLineQuery');
    }

    /**
     * Filter the query by a related PaymentLine object
     *
     * @param   PaymentLine|PropelObjectCollection $paymentLine  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BillingQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPaymentLine($paymentLine, $comparison = null)
    {
        if ($paymentLine instanceof PaymentLine) {
            return $this
                ->addUsingAlias(BillingPeer::ID_BILLING, $paymentLine->getIdBilling(), $comparison);
        } elseif ($paymentLine instanceof PropelObjectCollection) {
            return $this
                ->usePaymentLineQuery()
                ->filterByPrimaryKeys($paymentLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPaymentLine() only accepts arguments of type PaymentLine or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PaymentLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function joinPaymentLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PaymentLine');

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
            $this->addJoinObject($join, 'PaymentLine');
        }

        return $this;
    }

    /**
     * Use the PaymentLine relation PaymentLine object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\PaymentLineQuery A secondary query class using the current class as primary query
     */
    public function usePaymentLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPaymentLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PaymentLine', '\App\PaymentLineQuery');
    }

    /**
     * Filter the query by a related CostLine object
     *
     * @param   CostLine|PropelObjectCollection $costLine  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BillingQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCostLine($costLine, $comparison = null)
    {
        if ($costLine instanceof CostLine) {
            return $this
                ->addUsingAlias(BillingPeer::ID_BILLING, $costLine->getIdBilling(), $comparison);
        } elseif ($costLine instanceof PropelObjectCollection) {
            return $this
                ->useCostLineQuery()
                ->filterByPrimaryKeys($costLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCostLine() only accepts arguments of type CostLine or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CostLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function joinCostLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CostLine');

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
            $this->addJoinObject($join, 'CostLine');
        }

        return $this;
    }

    /**
     * Use the CostLine relation CostLine object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\CostLineQuery A secondary query class using the current class as primary query
     */
    public function useCostLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCostLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CostLine', '\App\CostLineQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Billing $billing Object to remove from the list of results
     *
     * @return BillingQuery The current query, for fluid interface
     */
    public function prune($billing = null)
    {
        if ($billing) {
            $this->addUsingAlias(BillingPeer::ID_BILLING, $billing->getIdBilling(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // add_tablestamp behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     BillingQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7){
        return $this->addUsingAlias(BillingPeer::DATE_MODIFICATION, time() - $nbDays * 24 * 60 * 60, \Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     BillingQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst(){
        return $this->addDescendingOrderByColumn(BillingPeer::DATE_MODIFICATION);
    }

    /**
     * Order by update date asc
     *
     * @return     BillingQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst(){
        return $this->addAscendingOrderByColumn(BillingPeer::DATE_MODIFICATION);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     BillingQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7){
        return $this->addUsingAlias(BillingPeer::DATE_CREATION, time() - $nbDays * 24 * 60 * 60, \Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     BillingQuery The current query, for fluid interface
     */
    public function lastCreatedFirst(){
        return $this->addDescendingOrderByColumn(BillingPeer::DATE_CREATION);
    }

    /**
     * Order by create date asc
     *
     * @return     BillingQuery The current query, for fluid interface
     */
    public function firstCreatedFirst(){
        return $this->addAscendingOrderByColumn(BillingPeer::DATE_CREATION);
    }
}
