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
use App\CostLine;
use App\Country;
use App\Supplier;
use App\SupplierPeer;
use App\SupplierQuery;

/**
 * Base class that represents a query for the 'supplier' table.
 *
 * Supplier
 *
 * @method SupplierQuery orderByIdSupplier($order = Criteria::ASC) Order by the id_supplier column
 * @method SupplierQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method SupplierQuery orderByIdCountry($order = Criteria::ASC) Order by the id_country column
 * @method SupplierQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method SupplierQuery orderByPhoneWork($order = Criteria::ASC) Order by the phone_work column
 * @method SupplierQuery orderByExt($order = Criteria::ASC) Order by the ext column
 * @method SupplierQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method SupplierQuery orderByContact($order = Criteria::ASC) Order by the contact column
 * @method SupplierQuery orderByEmail2($order = Criteria::ASC) Order by the email2 column
 * @method SupplierQuery orderByPhoneMobile($order = Criteria::ASC) Order by the phone_mobile column
 * @method SupplierQuery orderByWebsite($order = Criteria::ASC) Order by the website column
 * @method SupplierQuery orderByAddress1($order = Criteria::ASC) Order by the address_1 column
 * @method SupplierQuery orderByAddress2($order = Criteria::ASC) Order by the address_2 column
 * @method SupplierQuery orderByAddress3($order = Criteria::ASC) Order by the address_3 column
 * @method SupplierQuery orderByZip($order = Criteria::ASC) Order by the zip column
 * @method SupplierQuery orderByDateCreation($order = Criteria::ASC) Order by the date_creation column
 * @method SupplierQuery orderByDateModification($order = Criteria::ASC) Order by the date_modification column
 * @method SupplierQuery orderByIdGroupCreation($order = Criteria::ASC) Order by the id_group_creation column
 * @method SupplierQuery orderByIdCreation($order = Criteria::ASC) Order by the id_creation column
 * @method SupplierQuery orderByIdModification($order = Criteria::ASC) Order by the id_modification column
 *
 * @method SupplierQuery groupByIdSupplier() Group by the id_supplier column
 * @method SupplierQuery groupByName() Group by the name column
 * @method SupplierQuery groupByIdCountry() Group by the id_country column
 * @method SupplierQuery groupByPhone() Group by the phone column
 * @method SupplierQuery groupByPhoneWork() Group by the phone_work column
 * @method SupplierQuery groupByExt() Group by the ext column
 * @method SupplierQuery groupByEmail() Group by the email column
 * @method SupplierQuery groupByContact() Group by the contact column
 * @method SupplierQuery groupByEmail2() Group by the email2 column
 * @method SupplierQuery groupByPhoneMobile() Group by the phone_mobile column
 * @method SupplierQuery groupByWebsite() Group by the website column
 * @method SupplierQuery groupByAddress1() Group by the address_1 column
 * @method SupplierQuery groupByAddress2() Group by the address_2 column
 * @method SupplierQuery groupByAddress3() Group by the address_3 column
 * @method SupplierQuery groupByZip() Group by the zip column
 * @method SupplierQuery groupByDateCreation() Group by the date_creation column
 * @method SupplierQuery groupByDateModification() Group by the date_modification column
 * @method SupplierQuery groupByIdGroupCreation() Group by the id_group_creation column
 * @method SupplierQuery groupByIdCreation() Group by the id_creation column
 * @method SupplierQuery groupByIdModification() Group by the id_modification column
 *
 * @method SupplierQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method SupplierQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method SupplierQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method SupplierQuery leftJoinCountry($relationAlias = null) Adds a LEFT JOIN clause to the query using the Country relation
 * @method SupplierQuery rightJoinCountry($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Country relation
 * @method SupplierQuery innerJoinCountry($relationAlias = null) Adds a INNER JOIN clause to the query using the Country relation
 *
 * @method SupplierQuery leftJoinAuthyGroup($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyGroup relation
 * @method SupplierQuery rightJoinAuthyGroup($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyGroup relation
 * @method SupplierQuery innerJoinAuthyGroup($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyGroup relation
 *
 * @method SupplierQuery leftJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdCreation relation
 * @method SupplierQuery rightJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdCreation relation
 * @method SupplierQuery innerJoinAuthyRelatedByIdCreation($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdCreation relation
 *
 * @method SupplierQuery leftJoinAuthyRelatedByIdModification($relationAlias = null) Adds a LEFT JOIN clause to the query using the AuthyRelatedByIdModification relation
 * @method SupplierQuery rightJoinAuthyRelatedByIdModification($relationAlias = null) Adds a RIGHT JOIN clause to the query using the AuthyRelatedByIdModification relation
 * @method SupplierQuery innerJoinAuthyRelatedByIdModification($relationAlias = null) Adds a INNER JOIN clause to the query using the AuthyRelatedByIdModification relation
 *
 * @method SupplierQuery leftJoinCostLine($relationAlias = null) Adds a LEFT JOIN clause to the query using the CostLine relation
 * @method SupplierQuery rightJoinCostLine($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CostLine relation
 * @method SupplierQuery innerJoinCostLine($relationAlias = null) Adds a INNER JOIN clause to the query using the CostLine relation
 *
 * @method Supplier findOne(PropelPDO $con = null) Return the first Supplier matching the query
 * @method Supplier findOneOrCreate(PropelPDO $con = null) Return the first Supplier matching the query, or a new Supplier object populated from the query conditions when no match is found
 *
 * @method Supplier findOneByName(string $name) Return the first Supplier filtered by the name column
 * @method Supplier findOneByIdCountry(int $id_country) Return the first Supplier filtered by the id_country column
 * @method Supplier findOneByPhone(string $phone) Return the first Supplier filtered by the phone column
 * @method Supplier findOneByPhoneWork(string $phone_work) Return the first Supplier filtered by the phone_work column
 * @method Supplier findOneByExt(string $ext) Return the first Supplier filtered by the ext column
 * @method Supplier findOneByEmail(string $email) Return the first Supplier filtered by the email column
 * @method Supplier findOneByContact(string $contact) Return the first Supplier filtered by the contact column
 * @method Supplier findOneByEmail2(string $email2) Return the first Supplier filtered by the email2 column
 * @method Supplier findOneByPhoneMobile(string $phone_mobile) Return the first Supplier filtered by the phone_mobile column
 * @method Supplier findOneByWebsite(string $website) Return the first Supplier filtered by the website column
 * @method Supplier findOneByAddress1(string $address_1) Return the first Supplier filtered by the address_1 column
 * @method Supplier findOneByAddress2(string $address_2) Return the first Supplier filtered by the address_2 column
 * @method Supplier findOneByAddress3(string $address_3) Return the first Supplier filtered by the address_3 column
 * @method Supplier findOneByZip(string $zip) Return the first Supplier filtered by the zip column
 * @method Supplier findOneByDateCreation(string $date_creation) Return the first Supplier filtered by the date_creation column
 * @method Supplier findOneByDateModification(string $date_modification) Return the first Supplier filtered by the date_modification column
 * @method Supplier findOneByIdGroupCreation(int $id_group_creation) Return the first Supplier filtered by the id_group_creation column
 * @method Supplier findOneByIdCreation(int $id_creation) Return the first Supplier filtered by the id_creation column
 * @method Supplier findOneByIdModification(int $id_modification) Return the first Supplier filtered by the id_modification column
 *
 * @method array findByIdSupplier(int $id_supplier) Return Supplier objects filtered by the id_supplier column
 * @method array findByName(string $name) Return Supplier objects filtered by the name column
 * @method array findByIdCountry(int $id_country) Return Supplier objects filtered by the id_country column
 * @method array findByPhone(string $phone) Return Supplier objects filtered by the phone column
 * @method array findByPhoneWork(string $phone_work) Return Supplier objects filtered by the phone_work column
 * @method array findByExt(string $ext) Return Supplier objects filtered by the ext column
 * @method array findByEmail(string $email) Return Supplier objects filtered by the email column
 * @method array findByContact(string $contact) Return Supplier objects filtered by the contact column
 * @method array findByEmail2(string $email2) Return Supplier objects filtered by the email2 column
 * @method array findByPhoneMobile(string $phone_mobile) Return Supplier objects filtered by the phone_mobile column
 * @method array findByWebsite(string $website) Return Supplier objects filtered by the website column
 * @method array findByAddress1(string $address_1) Return Supplier objects filtered by the address_1 column
 * @method array findByAddress2(string $address_2) Return Supplier objects filtered by the address_2 column
 * @method array findByAddress3(string $address_3) Return Supplier objects filtered by the address_3 column
 * @method array findByZip(string $zip) Return Supplier objects filtered by the zip column
 * @method array findByDateCreation(string $date_creation) Return Supplier objects filtered by the date_creation column
 * @method array findByDateModification(string $date_modification) Return Supplier objects filtered by the date_modification column
 * @method array findByIdGroupCreation(int $id_group_creation) Return Supplier objects filtered by the id_group_creation column
 * @method array findByIdCreation(int $id_creation) Return Supplier objects filtered by the id_creation column
 * @method array findByIdModification(int $id_modification) Return Supplier objects filtered by the id_modification column
 *
 * @package    propel.generator..om
 */
abstract class BaseSupplierQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseSupplierQuery object.
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
            $modelName = 'App\\Supplier';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new SupplierQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   SupplierQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return SupplierQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof SupplierQuery) {
            return $criteria;
        }
        $query = new SupplierQuery(null, null, $modelAlias);

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
     * @return   Supplier|Supplier[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = SupplierPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(SupplierPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Supplier A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByIdSupplier($key, $con = null)
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
     * @return                 Supplier A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id_supplier`, `name`, `id_country`, `phone`, `phone_work`, `ext`, `email`, `contact`, `email2`, `phone_mobile`, `website`, `address_1`, `address_2`, `address_3`, `zip`, `date_creation`, `date_modification`, `id_group_creation`, `id_creation`, `id_modification` FROM `supplier` WHERE `id_supplier` = :p0';
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
            $obj = new Supplier();
            $obj->hydrate($row);
            SupplierPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Supplier|Supplier[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Supplier[]|mixed the list of results, formatted by the current formatter
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
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SupplierPeer::ID_SUPPLIER, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SupplierPeer::ID_SUPPLIER, $keys, Criteria::IN);
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
     * @param     mixed $idSupplier The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByIdSupplier($idSupplier = null, $comparison = null)
    {
        if (is_array($idSupplier)) {
            $useMinMax = false;
            if (isset($idSupplier['min'])) {
                $this->addUsingAlias(SupplierPeer::ID_SUPPLIER, $idSupplier['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idSupplier['max'])) {
                $this->addUsingAlias(SupplierPeer::ID_SUPPLIER, $idSupplier['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupplierPeer::ID_SUPPLIER, $idSupplier, $comparison);
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
     * @return SupplierQuery The current query, for fluid interface
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

        return $this->addUsingAlias(SupplierPeer::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the id_country column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCountry(1234); // WHERE id_country = 1234
     * $query->filterByIdCountry(array(12, 34)); // WHERE id_country IN (12, 34)
     * $query->filterByIdCountry(array('min' => 12)); // WHERE id_country >= 12
     * $query->filterByIdCountry(array('max' => 12)); // WHERE id_country <= 12
     * </code>
     *
     * @see       filterByCountry()
     *
     * @param     mixed $idCountry The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByIdCountry($idCountry = null, $comparison = null)
    {
        if (is_array($idCountry)) {
            $useMinMax = false;
            if (isset($idCountry['min'])) {
                $this->addUsingAlias(SupplierPeer::ID_COUNTRY, $idCountry['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCountry['max'])) {
                $this->addUsingAlias(SupplierPeer::ID_COUNTRY, $idCountry['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupplierPeer::ID_COUNTRY, $idCountry, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%'); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phone)) {
                $phone = str_replace('*', '%', $phone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the phone_work column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneWork('fooValue');   // WHERE phone_work = 'fooValue'
     * $query->filterByPhoneWork('%fooValue%'); // WHERE phone_work LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneWork The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByPhoneWork($phoneWork = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneWork)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phoneWork)) {
                $phoneWork = str_replace('*', '%', $phoneWork);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::PHONE_WORK, $phoneWork, $comparison);
    }

    /**
     * Filter the query on the ext column
     *
     * Example usage:
     * <code>
     * $query->filterByExt('fooValue');   // WHERE ext = 'fooValue'
     * $query->filterByExt('%fooValue%'); // WHERE ext LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ext The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByExt($ext = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ext)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ext)) {
                $ext = str_replace('*', '%', $ext);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::EXT, $ext, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the contact column
     *
     * Example usage:
     * <code>
     * $query->filterByContact('fooValue');   // WHERE contact = 'fooValue'
     * $query->filterByContact('%fooValue%'); // WHERE contact LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contact The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByContact($contact = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contact)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contact)) {
                $contact = str_replace('*', '%', $contact);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::CONTACT, $contact, $comparison);
    }

    /**
     * Filter the query on the email2 column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail2('fooValue');   // WHERE email2 = 'fooValue'
     * $query->filterByEmail2('%fooValue%'); // WHERE email2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByEmail2($email2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email2)) {
                $email2 = str_replace('*', '%', $email2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::EMAIL2, $email2, $comparison);
    }

    /**
     * Filter the query on the phone_mobile column
     *
     * Example usage:
     * <code>
     * $query->filterByPhoneMobile('fooValue');   // WHERE phone_mobile = 'fooValue'
     * $query->filterByPhoneMobile('%fooValue%'); // WHERE phone_mobile LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phoneMobile The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByPhoneMobile($phoneMobile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phoneMobile)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $phoneMobile)) {
                $phoneMobile = str_replace('*', '%', $phoneMobile);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::PHONE_MOBILE, $phoneMobile, $comparison);
    }

    /**
     * Filter the query on the website column
     *
     * Example usage:
     * <code>
     * $query->filterByWebsite('fooValue');   // WHERE website = 'fooValue'
     * $query->filterByWebsite('%fooValue%'); // WHERE website LIKE '%fooValue%'
     * </code>
     *
     * @param     string $website The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByWebsite($website = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($website)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $website)) {
                $website = str_replace('*', '%', $website);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::WEBSITE, $website, $comparison);
    }

    /**
     * Filter the query on the address_1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress1('fooValue');   // WHERE address_1 = 'fooValue'
     * $query->filterByAddress1('%fooValue%'); // WHERE address_1 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address1 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByAddress1($address1 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address1)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address1)) {
                $address1 = str_replace('*', '%', $address1);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::ADDRESS_1, $address1, $comparison);
    }

    /**
     * Filter the query on the address_2 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress2('fooValue');   // WHERE address_2 = 'fooValue'
     * $query->filterByAddress2('%fooValue%'); // WHERE address_2 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address2 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByAddress2($address2 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address2)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address2)) {
                $address2 = str_replace('*', '%', $address2);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::ADDRESS_2, $address2, $comparison);
    }

    /**
     * Filter the query on the address_3 column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress3('fooValue');   // WHERE address_3 = 'fooValue'
     * $query->filterByAddress3('%fooValue%'); // WHERE address_3 LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address3 The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByAddress3($address3 = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address3)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $address3)) {
                $address3 = str_replace('*', '%', $address3);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::ADDRESS_3, $address3, $comparison);
    }

    /**
     * Filter the query on the zip column
     *
     * Example usage:
     * <code>
     * $query->filterByZip('fooValue');   // WHERE zip = 'fooValue'
     * $query->filterByZip('%fooValue%'); // WHERE zip LIKE '%fooValue%'
     * </code>
     *
     * @param     string $zip The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByZip($zip = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($zip)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $zip)) {
                $zip = str_replace('*', '%', $zip);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(SupplierPeer::ZIP, $zip, $comparison);
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
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByDateCreation($dateCreation = null, $comparison = null)
    {
        if (is_array($dateCreation)) {
            $useMinMax = false;
            if (isset($dateCreation['min'])) {
                $this->addUsingAlias(SupplierPeer::DATE_CREATION, $dateCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCreation['max'])) {
                $this->addUsingAlias(SupplierPeer::DATE_CREATION, $dateCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupplierPeer::DATE_CREATION, $dateCreation, $comparison);
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
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByDateModification($dateModification = null, $comparison = null)
    {
        if (is_array($dateModification)) {
            $useMinMax = false;
            if (isset($dateModification['min'])) {
                $this->addUsingAlias(SupplierPeer::DATE_MODIFICATION, $dateModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateModification['max'])) {
                $this->addUsingAlias(SupplierPeer::DATE_MODIFICATION, $dateModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupplierPeer::DATE_MODIFICATION, $dateModification, $comparison);
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
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByIdGroupCreation($idGroupCreation = null, $comparison = null)
    {
        if (is_array($idGroupCreation)) {
            $useMinMax = false;
            if (isset($idGroupCreation['min'])) {
                $this->addUsingAlias(SupplierPeer::ID_GROUP_CREATION, $idGroupCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGroupCreation['max'])) {
                $this->addUsingAlias(SupplierPeer::ID_GROUP_CREATION, $idGroupCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupplierPeer::ID_GROUP_CREATION, $idGroupCreation, $comparison);
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
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByIdCreation($idCreation = null, $comparison = null)
    {
        if (is_array($idCreation)) {
            $useMinMax = false;
            if (isset($idCreation['min'])) {
                $this->addUsingAlias(SupplierPeer::ID_CREATION, $idCreation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCreation['max'])) {
                $this->addUsingAlias(SupplierPeer::ID_CREATION, $idCreation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupplierPeer::ID_CREATION, $idCreation, $comparison);
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
     * @return SupplierQuery The current query, for fluid interface
     */
    public function filterByIdModification($idModification = null, $comparison = null)
    {
        if (is_array($idModification)) {
            $useMinMax = false;
            if (isset($idModification['min'])) {
                $this->addUsingAlias(SupplierPeer::ID_MODIFICATION, $idModification['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idModification['max'])) {
                $this->addUsingAlias(SupplierPeer::ID_MODIFICATION, $idModification['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SupplierPeer::ID_MODIFICATION, $idModification, $comparison);
    }

    /**
     * Filter the query by a related Country object
     *
     * @param   Country|PropelObjectCollection $country The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SupplierQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCountry($country, $comparison = null)
    {
        if ($country instanceof Country) {
            return $this
                ->addUsingAlias(SupplierPeer::ID_COUNTRY, $country->getIdCountry(), $comparison);
        } elseif ($country instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupplierPeer::ID_COUNTRY, $country->toKeyValue('PrimaryKey', 'IdCountry'), $comparison);
        } else {
            throw new PropelException('filterByCountry() only accepts arguments of type Country or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Country relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function joinCountry($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Country');

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
            $this->addJoinObject($join, 'Country');
        }

        return $this;
    }

    /**
     * Use the Country relation Country object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \App\CountryQuery A secondary query class using the current class as primary query
     */
    public function useCountryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCountry($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Country', '\App\CountryQuery');
    }

    /**
     * Filter the query by a related AuthyGroup object
     *
     * @param   AuthyGroup|PropelObjectCollection $authyGroup The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SupplierQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyGroup($authyGroup, $comparison = null)
    {
        if ($authyGroup instanceof AuthyGroup) {
            return $this
                ->addUsingAlias(SupplierPeer::ID_GROUP_CREATION, $authyGroup->getIdAuthyGroup(), $comparison);
        } elseif ($authyGroup instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupplierPeer::ID_GROUP_CREATION, $authyGroup->toKeyValue('PrimaryKey', 'IdAuthyGroup'), $comparison);
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
     * @return SupplierQuery The current query, for fluid interface
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
     * @return                 SupplierQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdCreation($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(SupplierPeer::ID_CREATION, $authy->getIdAuthy(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupplierPeer::ID_CREATION, $authy->toKeyValue('PrimaryKey', 'IdAuthy'), $comparison);
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
     * @return SupplierQuery The current query, for fluid interface
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
     * @return                 SupplierQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuthyRelatedByIdModification($authy, $comparison = null)
    {
        if ($authy instanceof Authy) {
            return $this
                ->addUsingAlias(SupplierPeer::ID_MODIFICATION, $authy->getIdAuthy(), $comparison);
        } elseif ($authy instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(SupplierPeer::ID_MODIFICATION, $authy->toKeyValue('PrimaryKey', 'IdAuthy'), $comparison);
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
     * @return SupplierQuery The current query, for fluid interface
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
     * Filter the query by a related CostLine object
     *
     * @param   CostLine|PropelObjectCollection $costLine  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 SupplierQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCostLine($costLine, $comparison = null)
    {
        if ($costLine instanceof CostLine) {
            return $this
                ->addUsingAlias(SupplierPeer::ID_SUPPLIER, $costLine->getIdSupplier(), $comparison);
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
     * @return SupplierQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Supplier $supplier Object to remove from the list of results
     *
     * @return SupplierQuery The current query, for fluid interface
     */
    public function prune($supplier = null)
    {
        if ($supplier) {
            $this->addUsingAlias(SupplierPeer::ID_SUPPLIER, $supplier->getIdSupplier(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // add_tablestamp behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     SupplierQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7){
        return $this->addUsingAlias(SupplierPeer::DATE_MODIFICATION, time() - $nbDays * 24 * 60 * 60, \Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     SupplierQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst(){
        return $this->addDescendingOrderByColumn(SupplierPeer::DATE_MODIFICATION);
    }

    /**
     * Order by update date asc
     *
     * @return     SupplierQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst(){
        return $this->addAscendingOrderByColumn(SupplierPeer::DATE_MODIFICATION);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     SupplierQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7){
        return $this->addUsingAlias(SupplierPeer::DATE_CREATION, time() - $nbDays * 24 * 60 * 60, \Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     SupplierQuery The current query, for fluid interface
     */
    public function lastCreatedFirst(){
        return $this->addDescendingOrderByColumn(SupplierPeer::DATE_CREATION);
    }

    /**
     * Order by create date asc
     *
     * @return     SupplierQuery The current query, for fluid interface
     */
    public function firstCreatedFirst(){
        return $this->addAscendingOrderByColumn(SupplierPeer::DATE_CREATION);
    }
}
