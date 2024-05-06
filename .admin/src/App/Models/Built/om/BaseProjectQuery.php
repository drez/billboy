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
use App\Client;
use App\CostLine;
use App\Project;
use App\ProjectPeer;
use App\ProjectQuery;
use App\TimeLine;

/**
 * Base class that represents a query for the 'project' table.
 *
 * Project
 *
 * @method ProjectQuery orderByIdProject($order = Criteria::ASC) Order by the id_project column
 * @method ProjectQuery orderByCalcId($order = Criteria::ASC) Order by the calc_id column
 * @method ProjectQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method ProjectQuery orderByIdClient($order = Criteria::ASC) Order by the id_client column
 * @method ProjectQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method ProjectQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method ProjectQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method ProjectQuery orderByBudget($order = Criteria::ASC) Order by the budget column
 * @method ProjectQuery orderBySpent($order = Criteria::ASC) Order by the spent column
 * @method ProjectQuery orderByReference($order = Criteria::ASC) Order by the reference column
 * @method ProjectQuery orderByDateCreation($order = Criteria::ASC) Order by the date_creation column
 * @method ProjectQuery orderByDateModification($order = Criteria::ASC) Order by the date_modification column
 * @method ProjectQuery orderByIdGroupCreation($order = Criteria::ASC) Order by the id_group_creation column
 * @method ProjectQuery orderByIdCreation($order = Criteria::ASC) Order by the id_creation column
 * @method ProjectQuery orderByIdModification($order = Criteria::ASC) Order by the id_modification column
 *
 * @method ProjectQuery groupByIdProject() Group by the id_project column
 * @method ProjectQuery groupByCalcId() Group by the calc_id column
 * @method ProjectQuery groupByName() Group by the name column
 * @method ProjectQuery groupByIdClient() Group by the id_client column
 * @method ProjectQuery groupByDate() Group by the date column
 * @method ProjectQuery groupByType() Group by the type column
 * @method ProjectQuery groupByState() Group by the state column
 * @method ProjectQuery groupByBudget() Group by the budget column
 * @method ProjectQuery groupBySpent() Group by the spent column
 * @method ProjectQuery groupByReference() Group by the reference column
 * @method ProjectQuery groupByDateCreation() Group by the date_creation column
 * @method ProjectQuery groupByDateModification() Group by the date_modification column
 * @method ProjectQuery groupByIdGroupCreation() Group by the id_group_creation column
 * @method ProjectQuery groupByIdCreation() Group by the id_creation column
 * @method ProjectQuery groupByIdModification() Group by the id_modification column
 *
 * @method ProjectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ProjectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ProjectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ProjectQuery leftJoinClient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Client relation
 * @method ProjectQuery rightJoinClient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Client relation
 * @method ProjectQuery innerJoinClient($relationAlias = null) Adds a INNER JOIN clause to the query using the Client relation
 *
 * @method ProjectQuery leftJoinAuthyGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyGroup relation
 * @method ProjectQuery rightJoinAuthyGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyGroup relation
 * @method ProjectQuery innerJoinAuthyGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyGroup relation
 *
 * @method ProjectQuery leftJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdCreation relation
 * @method ProjectQuery rightJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdCreation relation
 * @method ProjectQuery innerJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdCreation relation
 *
 * @method ProjectQuery leftJoinAuthyRelatedByIdModification($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdModification relation
 * @method ProjectQuery rightJoinAuthyRelatedByIdModification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdModification relation
 * @method ProjectQuery innerJoinAuthyRelatedByIdModification($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdModification relation
 *
 * @method ProjectQuery leftJoinBilling($relationAlias = null) Adds a LEFT JOIN clause to the query using the Billing relation
 * @method ProjectQuery rightJoinBilling($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Billing relation
 * @method ProjectQuery innerJoinBilling($relationAlias = null) Adds a INNER JOIN clause to the query using the Billing relation
 *
 * @method ProjectQuery leftJoinBillingLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the BillingLine relation
 * @method ProjectQuery rightJoinBillingLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BillingLine relation
 * @method ProjectQuery innerJoinBillingLine($relationAlias = null) Adds a INNER JOIN clause to the query using the BillingLine relation
 *
 * @method ProjectQuery leftJoinCostLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the CostLine relation
 * @method ProjectQuery rightJoinCostLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CostLine relation
 * @method ProjectQuery innerJoinCostLine($relationAlias = null) Adds a INNER JOIN clause to the query using the CostLine relation
 *
 * @method ProjectQuery leftJoinTimeLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the TimeLine relation
 * @method ProjectQuery rightJoinTimeLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TimeLine relation
 * @method ProjectQuery innerJoinTimeLine($relationAlias = null) Adds a INNER JOIN clause to the query using the TimeLine relation
 *
 * @method Project findOne(PropelPDO $con = null) Return the first Project matching the query
 * @method Project findOneOrCreate(PropelPDO $con = null) Return the first Project matching the query, or a new Project object populated from the query conditions when no match is found
 *
 * @method Project findOneByCalcId(string $calc_id) Return the first Project filtered by the calc_id column
 * @method Project findOneByName(string $name) Return the first Project filtered by the name column
 * @method Project findOneByIdClient(int $id_client) Return the first Project filtered by the id_client column
 * @method Project findOneByDate(string $date) Return the first Project filtered by the date column
 * @method Project findOneByType(int $type) Return the first Project filtered by the type column
 * @method Project findOneByState(int $state) Return the first Project filtered by the state column
 * @method Project findOneByBudget(string $budget) Return the first Project filtered by the budget column
 * @method Project findOneBySpent(string $spent) Return the first Project filtered by the spent column
 * @method Project findOneByReference(string $reference) Return the first Project filtered by the reference column
 * @method Project findOneByDateCreation(string $date_creation) Return the first Project filtered by the date_creation column
 * @method Project findOneByDateModification(string $date_modification) Return the first Project filtered by the date_modification column
 * @method Project findOneByIdGroupCreation(int $id_group_creation) Return the first Project filtered by the id_group_creation column
 * @method Project findOneByIdCreation(int $id_creation) Return the first Project filtered by the id_creation column
 * @method Project findOneByIdModification(int $id_modification) Return the first Project filtered by the id_modification column
 *
 * @method array findByIdProject(int $id_project) Return Project objects filtered by the id_project column
 * @method array findByCalcId(string $calc_id) Return Project objects filtered by the calc_id column
 * @method array findByName(string $name) Return Project objects filtered by the name column
 * @method array findByIdClient(int $id_client) Return Project objects filtered by the id_client column
 * @method array findByDate(string $date) Return Project objects filtered by the date column
 * @method array findByType(int $type) Return Project objects filtered by the type column
 * @method array findByState(int $state) Return Project objects filtered by the state column
 * @method array findByBudget(string $budget) Return Project objects filtered by the budget column
 * @method array findBySpent(string $spent) Return Project objects filtered by the spent column
 * @method array findByReference(string $reference) Return Project objects filtered by the reference column
 * @method array findByDateCreation(string $date_creation) Return Project objects filtered by the date_creation column
 * @method array findByDateModification(string $date_modification) Return Project objects filtered by the date_modification column
 * @method array findByIdGroupCreation(int $id_group_creation) Return Project objects filtered by the id_group_creation column
 * @method array findByIdCreation(int $id_creation) Return Project objects filtered by the id_creation column
 * @method array findByIdModification(int $id_modification) Return Project objects filtered by the id_modification column
 *
 * @package    propel.generator..om
 */
abstract class BaseProjectQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseProjectQuery object.
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
            $modelName = 'App\\Project';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ProjectQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ProjectQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ProjectQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ProjectQuery) {
            return $criteria;
        }
        $query = new ProjectQuery(null, null, $modelAlias);

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
     * @return   Project|Project[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProjectPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ProjectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Project A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdProject($key, $con = null)
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
     * @return                 Project A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id_project`, `calc_id`, `name`, `id_client`, `date`, `type`, `state`, `budget`, `spent`, `reference`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification` FROM `project` WHERE `id_project` = :p0';
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
            $obj = new Project();
            $obj->hydrate($row);
            ProjectPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Project|Project[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Project[]|mixed the list of results, formatted by the current formatter
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProjectPeer::ID_PROJECT, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProjectPeer::ID_PROJECT, $keys, Criteria::IN);
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
     * @param     mixed $idProject The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByIdProject($idProject = null, $comparison = null)
    {
        if (is_array($idProject)) {
            $useMinMax = false;
            if (isset($idProject['min'])) {
                $this->addUsingAlias(ProjectPeer::ID_PROJECT, $idProject['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idProject['max'])) {
                $this->addUsingAlias(ProjectPeer::ID_PROJECT, $idProject['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::ID_PROJECT, $idProject, $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProjectPeer::CALC_ID, $calcId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProjectPeer::NAME, $name, $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByIdClient($idClient = null, $comparison = null)
    {
        if (is_array($idClient)) {
            $useMinMax = false;
            if (isset($idClient['min'])) {
                $this->addUsingAlias(ProjectPeer::ID_CLIENT, $idClient['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idClient['max'])) {
                $this->addUsingAlias(ProjectPeer::ID_CLIENT, $idClient['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::ID_CLIENT, $idClient, $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(ProjectPeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(ProjectPeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::DATE, $date, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * @param     mixed $type The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByType($type = null, $comparison = null)
    {
        if (is_scalar($type)) {
            $type = ProjectPeer::getSqlValueForEnum(ProjectPeer::TYPE, $type);
        } elseif (is_array($type)) {
            $convertedValues = array();
            foreach ($type as $value) {
                $convertedValues[] = ProjectPeer::getSqlValueForEnum(ProjectPeer::TYPE, $value);
            }
            $type = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the state column
     *
     * @param     mixed $state The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the value is not accepted by the enum.
     */
    public function filterByState($state = null, $comparison = null)
    {
        if (is_scalar($state)) {
            $state = ProjectPeer::getSqlValueForEnum(ProjectPeer::STATE, $state);
        } elseif (is_array($state)) {
            $convertedValues = array();
            foreach ($state as $value) {
                $convertedValues[] = ProjectPeer::getSqlValueForEnum(ProjectPeer::STATE, $value);
            }
            $state = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::STATE, $state, $comparison);
    }

    /**
     * Filter the query on the budget column
     *
     * Example usage:
     * <code>
     * $query->filterByBudget(1234); // WHERE budget = 1234
     * $query->filterByBudget(array(12, 34)); // WHERE budget IN (12, 34)
     * $query->filterByBudget(array('min' => 12)); // WHERE budget >= 12
     * $query->filterByBudget(array('max' => 12)); // WHERE budget <= 12
     * </code>
     *
     * @param     mixed $budget The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByBudget($budget = null, $comparison = null)
    {
        if (is_array($budget)) {
            $useMinMax = false;
            if (isset($budget['min'])) {
                $this->addUsingAlias(ProjectPeer::BUDGET, $budget['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($budget['max'])) {
                $this->addUsingAlias(ProjectPeer::BUDGET, $budget['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::BUDGET, $budget, $comparison);
    }

    /**
     * Filter the query on the spent column
     *
     * Example usage:
     * <code>
     * $query->filterBySpent(1234); // WHERE spent = 1234
     * $query->filterBySpent(array(12, 34)); // WHERE spent IN (12, 34)
     * $query->filterBySpent(array('min' => 12)); // WHERE spent >= 12
     * $query->filterBySpent(array('max' => 12)); // WHERE spent <= 12
     * </code>
     *
     * @param     mixed $spent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterBySpent($spent = null, $comparison = null)
    {
        if (is_array($spent)) {
            $useMinMax = false;
            if (isset($spent['min'])) {
                $this->addUsingAlias(ProjectPeer::SPENT, $spent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($spent['max'])) {
                $this->addUsingAlias(ProjectPeer::SPENT, $spent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::SPENT, $spent, $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ProjectPeer::REFERENCE, $reference, $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByDateCreation($dateCreation = null, $comparison = null)
    {
        if (is_array($dateCreation)) {
            $useMinMax = false;
            if (isset($dateCreation['min'])) {
                $this->addUsingAlias(ProjectPeer::DATE_CREATION, $dateCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCreation['max'])) {
                $this->addUsingAlias(ProjectPeer::DATE_CREATION, $dateCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::DATE_CREATION, $dateCreation, $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByDateModification($dateModification = null, $comparison = null)
    {
        if (is_array($dateModification)) {
            $useMinMax = false;
            if (isset($dateModification['min'])) {
                $this->addUsingAlias(ProjectPeer::DATE_MODIFICATION, $dateModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateModification['max'])) {
                $this->addUsingAlias(ProjectPeer::DATE_MODIFICATION, $dateModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::DATE_MODIFICATION, $dateModification, $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByIdGroupCreation($idGroupCreation = null, $comparison = null)
    {
        if (is_array($idGroupCreation)) {
            $useMinMax = false;
            if (isset($idGroupCreation['min'])) {
                $this->addUsingAlias(ProjectPeer::ID_GROUP_CREATION, $idGroupCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGroupCreation['max'])) {
                $this->addUsingAlias(ProjectPeer::ID_GROUP_CREATION, $idGroupCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::ID_GROUP_CREATION, $idGroupCreation, $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByIdCreation($idCreation = null, $comparison = null)
    {
        if (is_array($idCreation)) {
            $useMinMax = false;
            if (isset($idCreation['min'])) {
                $this->addUsingAlias(ProjectPeer::ID_CREATION, $idCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCreation['max'])) {
                $this->addUsingAlias(ProjectPeer::ID_CREATION, $idCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::ID_CREATION, $idCreation, $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function filterByIdModification($idModification = null, $comparison = null)
    {
        if (is_array($idModification)) {
            $useMinMax = false;
            if (isset($idModification['min'])) {
                $this->addUsingAlias(ProjectPeer::ID_MODIFICATION, $idModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idModification['max'])) {
                $this->addUsingAlias(ProjectPeer::ID_MODIFICATION, $idModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProjectPeer::ID_MODIFICATION, $idModification, $comparison);
    }

    /**
     * Filter the query by a related Client object
     *
     * @param   Client|PropelObjectCollection $client The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByClient($client, $comparison = null)
    {
        if ($client instanceof Client) {
            return $this
                ->addUsingAlias(ProjectPeer::ID_CLIENT, $client->getIdClient(), $comparison);
        } elseif ($client instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectPeer::ID_CLIENT, $client->toKeyValue('PrimaryKey', 'IdClient'), $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function joinClient($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useClientQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinClient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Client', '\App\ClientQuery');
    }

    /**
     * Filter the query by a related AuthyGroup object
     *
     * @param   AuthyGroup|PropelObjectCollection $authyGroup The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyGroup($authyGroup, $comparison = null)
    {
        if ($authyGroup instanceof AuthyGroup) {
            return $this
                ->addUsingAlias(ProjectPeer::ID_GROUP_CREATION, $authyGroup->getIdAuthyGroup(), $comparison);
        } elseif ($authyGroup instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectPeer::ID_GROUP_CREATION, $authyGroup->toKeyValue('PrimaryKey', 'IdAuthyGroup'), $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
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
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdCreation($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(ProjectPeer::ID_CREATION, $authy->getIdAuthy(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectPeer::ID_CREATION, $authy->toKeyValue('PrimaryKey', 'IdAuthy'), $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
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
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdModification($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(ProjectPeer::ID_MODIFICATION, $authy->getIdAuthy(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProjectPeer::ID_MODIFICATION, $authy->toKeyValue('PrimaryKey', 'IdAuthy'), $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
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
     * Filter the query by a related Billing object
     *
     * @param   Billing|PropelObjectCollection $billing  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBilling($billing, $comparison = null)
    {
        if ($billing instanceof Billing) {
            return $this
                ->addUsingAlias(ProjectPeer::ID_PROJECT, $billing->getIdProject(), $comparison);
        } elseif ($billing instanceof PropelObjectCollection) {
            return $this
                ->useBillingQuery()
                ->filterByPrimaryKeys($billing->getPrimaryKeys())
                ->endUse();
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
     * @return ProjectQuery The current query, for fluid interface
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
     * Filter the query by a related BillingLine object
     *
     * @param   BillingLine|PropelObjectCollection $billingLine  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBillingLine($billingLine, $comparison = null)
    {
        if ($billingLine instanceof BillingLine) {
            return $this
                ->addUsingAlias(ProjectPeer::ID_PROJECT, $billingLine->getIdProject(), $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function joinBillingLine($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useBillingLineQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBillingLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BillingLine', '\App\BillingLineQuery');
    }

    /**
     * Filter the query by a related CostLine object
     *
     * @param   CostLine|PropelObjectCollection $costLine  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCostLine($costLine, $comparison = null)
    {
        if ($costLine instanceof CostLine) {
            return $this
                ->addUsingAlias(ProjectPeer::ID_PROJECT, $costLine->getIdProject(), $comparison);
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
     * @return ProjectQuery The current query, for fluid interface
     */
    public function joinCostLine($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useCostLineQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCostLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CostLine', '\App\CostLineQuery');
    }

    /**
     * Filter the query by a related TimeLine object
     *
     * @param   TimeLine|PropelObjectCollection $timeLine  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ProjectQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTimeLine($timeLine, $comparison = null)
    {
        if ($timeLine instanceof TimeLine) {
            return $this
                ->addUsingAlias(ProjectPeer::ID_PROJECT, $timeLine->getIdProject(), $comparison);
        } elseif ($timeLine instanceof PropelObjectCollection) {
            return $this
                ->useTimeLineQuery()
                ->filterByPrimaryKeys($timeLine->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTimeLine() only accepts arguments of type TimeLine or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TimeLine relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function joinTimeLine($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TimeLine');

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
            $this->addJoinObject($join, 'TimeLine');
        }

        return $this;
    }

    /**
     * Use the TimeLine relation TimeLine object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\TimeLineQuery A secondary query class using the current class as primary query
     */
    public function useTimeLineQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTimeLine($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TimeLine', '\App\TimeLineQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Project $project Object to remove from the list of results
     *
     * @return ProjectQuery The current query, for fluid interface
     */
    public function prune($project = null)
    {
        if ($project) {
            $this->addUsingAlias(ProjectPeer::ID_PROJECT, $project->getIdProject(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // add_tablestamp behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ProjectQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7){
        return $this->addUsingAlias(ProjectPeer::DATE_MODIFICATION, time() - $nbDays * 24 * 60 * 60, \Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ProjectQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst(){
        return $this->addDescendingOrderByColumn(ProjectPeer::DATE_MODIFICATION);
    }

    /**
     * Order by update date asc
     *
     * @return     ProjectQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst(){
        return $this->addAscendingOrderByColumn(ProjectPeer::DATE_MODIFICATION);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ProjectQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7){
        return $this->addUsingAlias(ProjectPeer::DATE_CREATION, time() - $nbDays * 24 * 60 * 60, \Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     ProjectQuery The current query, for fluid interface
     */
    public function lastCreatedFirst(){
        return $this->addDescendingOrderByColumn(ProjectPeer::DATE_CREATION);
    }

    /**
     * Order by create date asc
     *
     * @return     ProjectQuery The current query, for fluid interface
     */
    public function firstCreatedFirst(){
        return $this->addAscendingOrderByColumn(ProjectPeer::DATE_CREATION);
    }
}
