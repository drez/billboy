<?php

namespace App\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use App\Authy;
use App\AuthyGroup;
use App\AuthyGroupQuery;
use App\AuthyQuery;
use App\Billing;
use App\BillingCategory;
use App\BillingCategoryPeer;
use App\BillingCategoryQuery;
use App\BillingLine;
use App\BillingLineQuery;
use App\BillingQuery;
use App\CostLine;
use App\CostLineQuery;

/**
 * Base class that represents a row from the 'billing_category' table.
 *
 * Category billing
 *
 * @package    propel.generator..om
 */
abstract class BaseBillingCategory extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'App\\BillingCategoryPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BillingCategoryPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id_billing_category field.
     * @var        int
     */
    protected $id_billing_category;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the date_creation field.
     * @var        string
     */
    protected $date_creation;

    /**
     * The value for the date_modification field.
     * @var        string
     */
    protected $date_modification;

    /**
     * The value for the id_group_creation field.
     * @var        int
     */
    protected $id_group_creation;

    /**
     * The value for the id_creation field.
     * @var        int
     */
    protected $id_creation;

    /**
     * The value for the id_modification field.
     * @var        int
     */
    protected $id_modification;

    /**
     * @var        AuthyGroup
     */
    protected $aAuthyGroup;

    /**
     * @var        Authy
     */
    protected $aAuthyRelatedByIdCreation;

    /**
     * @var        Authy
     */
    protected $aAuthyRelatedByIdModification;

    /**
     * @var        PropelObjectCollection|Billing[] Collection to store aggregation of Billing objects.
     */
    protected $collBillings;
    protected $collBillingsPartial;

    /**
     * @var        PropelObjectCollection|BillingLine[] Collection to store aggregation of BillingLine objects.
     */
    protected $collBillingLines;
    protected $collBillingLinesPartial;

    /**
     * @var        PropelObjectCollection|CostLine[] Collection to store aggregation of CostLine objects.
     */
    protected $collCostLines;
    protected $collCostLinesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $billingsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $billingLinesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $costLinesScheduledForDeletion = null;

    /**
     * @Field()
     * Get the [id_billing_category] column value.
     *
     * @return int
     */
    public function getIdBillingCategory()
    {

        return $this->id_billing_category;
    }

    /**
     * @Field()
     * Get the [name] column value.
     * Name
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * @Field()
     * Get the [optionally formatted] temporal [date_creation] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateCreation($format = 'Y-m-d H:i:s')
    {
        if ($this->date_creation === null) {
            return null;
        }

        if ($this->date_creation === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_creation);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_creation, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * @Field()
     * Get the [optionally formatted] temporal [date_modification] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateModification($format = 'Y-m-d H:i:s')
    {
        if ($this->date_modification === null) {
            return null;
        }

        if ($this->date_modification === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_modification);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_modification, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * @Field()
     * Get the [id_group_creation] column value.
     *
     * @return int
     */
    public function getIdGroupCreation()
    {

        return $this->id_group_creation;
    }

    /**
     * @Field()
     * Get the [id_creation] column value.
     *
     * @return int
     */
    public function getIdCreation()
    {

        return $this->id_creation;
    }

    /**
     * @Field()
     * Get the [id_modification] column value.
     *
     * @return int
     */
    public function getIdModification()
    {

        return $this->id_modification;
    }

    /**
     * Set the value of [id_billing_category] column.
     *
     * @param  int $v new value
     * @return BillingCategory The current object (for fluent API support)
     */
    public function setIdBillingCategory($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_billing_category !== $v) {
            $this->id_billing_category = $v;
            $this->modifiedColumns[] = BillingCategoryPeer::ID_BILLING_CATEGORY;
        }


        return $this;
    } // setIdBillingCategory()

    /**
     * Set the value of [name] column.
     * Name
     * @param  string $v new value
     * @return BillingCategory The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = BillingCategoryPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Sets the value of [date_creation] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BillingCategory The current object (for fluent API support)
     */
    public function setDateCreation($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_creation !== null || $dt !== null) {
            $currentDateAsString = ($this->date_creation !== null && $tmpDt = new DateTime($this->date_creation)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_creation = $newDateAsString;
                $this->modifiedColumns[] = BillingCategoryPeer::DATE_CREATION;
            }
        } // if either are not null


        return $this;
    } // setDateCreation()

    /**
     * Sets the value of [date_modification] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return BillingCategory The current object (for fluent API support)
     */
    public function setDateModification($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_modification !== null || $dt !== null) {
            $currentDateAsString = ($this->date_modification !== null && $tmpDt = new DateTime($this->date_modification)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_modification = $newDateAsString;
                $this->modifiedColumns[] = BillingCategoryPeer::DATE_MODIFICATION;
            }
        } // if either are not null


        return $this;
    } // setDateModification()

    /**
     * Set the value of [id_group_creation] column.
     *
     * @param  int $v new value
     * @return BillingCategory The current object (for fluent API support)
     */
    public function setIdGroupCreation($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_group_creation !== $v) {
            $this->id_group_creation = $v;
            $this->modifiedColumns[] = BillingCategoryPeer::ID_GROUP_CREATION;
        }

        if ($this->aAuthyGroup !== null && $this->aAuthyGroup->getIdAuthyGroup() !== $v) {
            $this->aAuthyGroup = null;
        }


        return $this;
    } // setIdGroupCreation()

    /**
     * Set the value of [id_creation] column.
     *
     * @param  int $v new value
     * @return BillingCategory The current object (for fluent API support)
     */
    public function setIdCreation($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_creation !== $v) {
            $this->id_creation = $v;
            $this->modifiedColumns[] = BillingCategoryPeer::ID_CREATION;
        }

        if ($this->aAuthyRelatedByIdCreation !== null && $this->aAuthyRelatedByIdCreation->getIdAuthy() !== $v) {
            $this->aAuthyRelatedByIdCreation = null;
        }


        return $this;
    } // setIdCreation()

    /**
     * Set the value of [id_modification] column.
     *
     * @param  int $v new value
     * @return BillingCategory The current object (for fluent API support)
     */
    public function setIdModification($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_modification !== $v) {
            $this->id_modification = $v;
            $this->modifiedColumns[] = BillingCategoryPeer::ID_MODIFICATION;
        }

        if ($this->aAuthyRelatedByIdModification !== null && $this->aAuthyRelatedByIdModification->getIdAuthy() !== $v) {
            $this->aAuthyRelatedByIdModification = null;
        }


        return $this;
    } // setIdModification()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id_billing_category = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->date_creation = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->date_modification = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->id_group_creation = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->id_creation = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->id_modification = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 7; // 7 = BillingCategoryPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating BillingCategory object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aAuthyGroup !== null && $this->id_group_creation !== $this->aAuthyGroup->getIdAuthyGroup()) {
            $this->aAuthyGroup = null;
        }
        if ($this->aAuthyRelatedByIdCreation !== null && $this->id_creation !== $this->aAuthyRelatedByIdCreation->getIdAuthy()) {
            $this->aAuthyRelatedByIdCreation = null;
        }
        if ($this->aAuthyRelatedByIdModification !== null && $this->id_modification !== $this->aAuthyRelatedByIdModification->getIdAuthy()) {
            $this->aAuthyRelatedByIdModification = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(BillingCategoryPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BillingCategoryPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAuthyGroup = null;
            $this->aAuthyRelatedByIdCreation = null;
            $this->aAuthyRelatedByIdModification = null;
            $this->collBillings = null;

            $this->collBillingLines = null;

            $this->collCostLines = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(BillingCategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BillingCategoryQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(BillingCategoryPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // add_tablestamp behavior

                    $this->setDateCreation(time());
                    $this->setDateModification(time());
                    $this->setIdGroupCreation( (get_class($_SESSION[_AUTH_VAR]) === 'ApiGoat\Sessions\AuthySession')?$_SESSION[_AUTH_VAR]->getIdPrimaryGroup():null );
                    if(!$this->getIdCreation())
                        $this->setIdCreation( (get_class($_SESSION[_AUTH_VAR]) === 'ApiGoat\Sessions\AuthySession')?$_SESSION[_AUTH_VAR]->getIdAuthy():null );
                    if(!$this->getIdModification())
                        $this->setIdModification( (get_class($_SESSION[_AUTH_VAR]) === 'ApiGoat\Sessions\AuthySession')?$_SESSION[_AUTH_VAR]->getIdAuthy():null );

            } else {
                $ret = $ret && $this->preUpdate($con);
                // add_tablestamp behavior
                if ($this->isModified() ) {
                    $this->setDateCreation( $this->getDateCreation() );
                    $this->setDateModification(time());
                    $this->setIdGroupCreation( (get_class($_SESSION[_AUTH_VAR]) === 'ApiGoat\Sessions\AuthySession')?$_SESSION[_AUTH_VAR]->getIdPrimaryGroup():null );
                    if(!$this->getIdCreation())
                        $this->setIdCreation( (get_class($_SESSION[_AUTH_VAR]) === 'ApiGoat\Sessions\AuthySession')?$_SESSION[_AUTH_VAR]->getIdAuthy():null );
                    if(!$this->getIdModification())
                        $this->setIdModification( (get_class($_SESSION[_AUTH_VAR]) === 'ApiGoat\Sessions\AuthySession')?$_SESSION[_AUTH_VAR]->getIdAuthy():null );
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                BillingCategoryPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aAuthyGroup !== null) {
                if ($this->aAuthyGroup->isModified() || $this->aAuthyGroup->isNew()) {
                    $affectedRows += $this->aAuthyGroup->save($con);
                }
                $this->setAuthyGroup($this->aAuthyGroup);
            }

            if ($this->aAuthyRelatedByIdCreation !== null) {
                if ($this->aAuthyRelatedByIdCreation->isModified() || $this->aAuthyRelatedByIdCreation->isNew()) {
                    $affectedRows += $this->aAuthyRelatedByIdCreation->save($con);
                }
                $this->setAuthyRelatedByIdCreation($this->aAuthyRelatedByIdCreation);
            }

            if ($this->aAuthyRelatedByIdModification !== null) {
                if ($this->aAuthyRelatedByIdModification->isModified() || $this->aAuthyRelatedByIdModification->isNew()) {
                    $affectedRows += $this->aAuthyRelatedByIdModification->save($con);
                }
                $this->setAuthyRelatedByIdModification($this->aAuthyRelatedByIdModification);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->billingsScheduledForDeletion !== null) {
                if (!$this->billingsScheduledForDeletion->isEmpty()) {
                    foreach ($this->billingsScheduledForDeletion as $billing) {
                        // need to save related object because we set the relation to null
                        $billing->save($con);
                    }
                    $this->billingsScheduledForDeletion = null;
                }
            }

            if ($this->collBillings !== null) {
                foreach ($this->collBillings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->billingLinesScheduledForDeletion !== null) {
                if (!$this->billingLinesScheduledForDeletion->isEmpty()) {
                    foreach ($this->billingLinesScheduledForDeletion as $billingLine) {
                        // need to save related object because we set the relation to null
                        $billingLine->save($con);
                    }
                    $this->billingLinesScheduledForDeletion = null;
                }
            }

            if ($this->collBillingLines !== null) {
                foreach ($this->collBillingLines as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->costLinesScheduledForDeletion !== null) {
                if (!$this->costLinesScheduledForDeletion->isEmpty()) {
                    foreach ($this->costLinesScheduledForDeletion as $costLine) {
                        // need to save related object because we set the relation to null
                        $costLine->save($con);
                    }
                    $this->costLinesScheduledForDeletion = null;
                }
            }

            if ($this->collCostLines !== null) {
                foreach ($this->collCostLines as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = BillingCategoryPeer::ID_BILLING_CATEGORY;
        if (null !== $this->id_billing_category) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BillingCategoryPeer::ID_BILLING_CATEGORY . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BillingCategoryPeer::ID_BILLING_CATEGORY)) {
            $modifiedColumns[':p' . $index++]  = '`id_billing_category`';
        }
        if ($this->isColumnModified(BillingCategoryPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(BillingCategoryPeer::DATE_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`date_creation`';
        }
        if ($this->isColumnModified(BillingCategoryPeer::DATE_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = '`date_modification`';
        }
        if ($this->isColumnModified(BillingCategoryPeer::ID_GROUP_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_group_creation`';
        }
        if ($this->isColumnModified(BillingCategoryPeer::ID_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_creation`';
        }
        if ($this->isColumnModified(BillingCategoryPeer::ID_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_modification`';
        }

        $sql = sprintf(
            'INSERT INTO `billing_category` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_billing_category`':
                        $stmt->bindValue($identifier, $this->id_billing_category, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`date_creation`':
                        $stmt->bindValue($identifier, $this->date_creation, PDO::PARAM_STR);
                        break;
                    case '`date_modification`':
                        $stmt->bindValue($identifier, $this->date_modification, PDO::PARAM_STR);
                        break;
                    case '`id_group_creation`':
                        $stmt->bindValue($identifier, $this->id_group_creation, PDO::PARAM_INT);
                        break;
                    case '`id_creation`':
                        $stmt->bindValue($identifier, $this->id_creation, PDO::PARAM_INT);
                        break;
                    case '`id_modification`':
                        $stmt->bindValue($identifier, $this->id_modification, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setIdBillingCategory($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aAuthyGroup !== null) {
                if (!$this->aAuthyGroup->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAuthyGroup->getValidationFailures());
                }
            }

            if ($this->aAuthyRelatedByIdCreation !== null) {
                if (!$this->aAuthyRelatedByIdCreation->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAuthyRelatedByIdCreation->getValidationFailures());
                }
            }

            if ($this->aAuthyRelatedByIdModification !== null) {
                if (!$this->aAuthyRelatedByIdModification->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAuthyRelatedByIdModification->getValidationFailures());
                }
            }


            if (($retval = BillingCategoryPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collBillings !== null) {
                    foreach ($this->collBillings as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBillingLines !== null) {
                    foreach ($this->collBillingLines as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCostLines !== null) {
                    foreach ($this->collCostLines as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = BillingCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['BillingCategory'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BillingCategory'][$this->getPrimaryKey()] = true;
        $keys = BillingCategoryPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdBillingCategory(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDateCreation(),
            $keys[3] => $this->getDateModification(),
            $keys[4] => $this->getIdGroupCreation(),
            $keys[5] => $this->getIdCreation(),
            $keys[6] => $this->getIdModification(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aAuthyGroup) {
                $result['AuthyGroup'] = $this->aAuthyGroup->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyRelatedByIdCreation) {
                $result['AuthyRelatedByIdCreation'] = $this->aAuthyRelatedByIdCreation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyRelatedByIdModification) {
                $result['AuthyRelatedByIdModification'] = $this->aAuthyRelatedByIdModification->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBillings) {
                $result['Billings'] = $this->collBillings->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillingLines) {
                $result['BillingLines'] = $this->collBillingLines->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCostLines) {
                $result['CostLines'] = $this->collCostLines->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = BillingCategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdBillingCategory($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setDateCreation($value);
                break;
            case 3:
                $this->setDateModification($value);
                break;
            case 4:
                $this->setIdGroupCreation($value);
                break;
            case 5:
                $this->setIdCreation($value);
                break;
            case 6:
                $this->setIdModification($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = BillingCategoryPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdBillingCategory($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDateCreation($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDateModification($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setIdGroupCreation($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setIdCreation($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setIdModification($arr[$keys[6]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BillingCategoryPeer::DATABASE_NAME);

        if ($this->isColumnModified(BillingCategoryPeer::ID_BILLING_CATEGORY)) $criteria->add(BillingCategoryPeer::ID_BILLING_CATEGORY, $this->id_billing_category);
        if ($this->isColumnModified(BillingCategoryPeer::NAME)) $criteria->add(BillingCategoryPeer::NAME, $this->name);
        if ($this->isColumnModified(BillingCategoryPeer::DATE_CREATION)) $criteria->add(BillingCategoryPeer::DATE_CREATION, $this->date_creation);
        if ($this->isColumnModified(BillingCategoryPeer::DATE_MODIFICATION)) $criteria->add(BillingCategoryPeer::DATE_MODIFICATION, $this->date_modification);
        if ($this->isColumnModified(BillingCategoryPeer::ID_GROUP_CREATION)) $criteria->add(BillingCategoryPeer::ID_GROUP_CREATION, $this->id_group_creation);
        if ($this->isColumnModified(BillingCategoryPeer::ID_CREATION)) $criteria->add(BillingCategoryPeer::ID_CREATION, $this->id_creation);
        if ($this->isColumnModified(BillingCategoryPeer::ID_MODIFICATION)) $criteria->add(BillingCategoryPeer::ID_MODIFICATION, $this->id_modification);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(BillingCategoryPeer::DATABASE_NAME);
        $criteria->add(BillingCategoryPeer::ID_BILLING_CATEGORY, $this->id_billing_category);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdBillingCategory();
    }

    /**
     * Generic method to set the primary key (id_billing_category column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdBillingCategory($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdBillingCategory();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of BillingCategory (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDateCreation($this->getDateCreation());
        $copyObj->setDateModification($this->getDateModification());
        $copyObj->setIdGroupCreation($this->getIdGroupCreation());
        $copyObj->setIdCreation($this->getIdCreation());
        $copyObj->setIdModification($this->getIdModification());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getBillings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBilling($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBillingLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBillingLine($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCostLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCostLine($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdBillingCategory(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return BillingCategory Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return BillingCategoryPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BillingCategoryPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a AuthyGroup object.
     *
     * @param                  AuthyGroup $v
     * @return BillingCategory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAuthyGroup(AuthyGroup $v = null)
    {
        if ($v === null) {
            $this->setIdGroupCreation(NULL);
        } else {
            $this->setIdGroupCreation($v->getIdAuthyGroup());
        }

        $this->aAuthyGroup = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the AuthyGroup object, it will not be re-added.
        if ($v !== null) {
            $v->addBillingCategory($this);
        }


        return $this;
    }


    /**
     * Get the associated AuthyGroup object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return AuthyGroup The associated AuthyGroup object.
     * @throws PropelException
     */
    public function getAuthyGroup(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aAuthyGroup === null && ($this->id_group_creation !== null) && $doQuery) {
            $this->aAuthyGroup = AuthyGroupQuery::create()->findPk($this->id_group_creation, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAuthyGroup->addBillingCategories($this);
             */
        }

        return $this->aAuthyGroup;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return BillingCategory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAuthyRelatedByIdCreation(Authy $v = null)
    {
        if ($v === null) {
            $this->setIdCreation(NULL);
        } else {
            $this->setIdCreation($v->getIdAuthy());
        }

        $this->aAuthyRelatedByIdCreation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Authy object, it will not be re-added.
        if ($v !== null) {
            $v->addBillingCategoryRelatedByIdCreation($this);
        }


        return $this;
    }


    /**
     * Get the associated Authy object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Authy The associated Authy object.
     * @throws PropelException
     */
    public function getAuthyRelatedByIdCreation(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aAuthyRelatedByIdCreation === null && ($this->id_creation !== null) && $doQuery) {
            $this->aAuthyRelatedByIdCreation = AuthyQuery::create()->findPk($this->id_creation, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAuthyRelatedByIdCreation->addBillingCategoriesRelatedByIdCreation($this);
             */
        }

        return $this->aAuthyRelatedByIdCreation;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return BillingCategory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAuthyRelatedByIdModification(Authy $v = null)
    {
        if ($v === null) {
            $this->setIdModification(NULL);
        } else {
            $this->setIdModification($v->getIdAuthy());
        }

        $this->aAuthyRelatedByIdModification = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Authy object, it will not be re-added.
        if ($v !== null) {
            $v->addBillingCategoryRelatedByIdModification($this);
        }


        return $this;
    }


    /**
     * Get the associated Authy object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Authy The associated Authy object.
     * @throws PropelException
     */
    public function getAuthyRelatedByIdModification(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aAuthyRelatedByIdModification === null && ($this->id_modification !== null) && $doQuery) {
            $this->aAuthyRelatedByIdModification = AuthyQuery::create()->findPk($this->id_modification, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAuthyRelatedByIdModification->addBillingCategoriesRelatedByIdModification($this);
             */
        }

        return $this->aAuthyRelatedByIdModification;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Billing' == $relationName) {
            $this->initBillings();
        }
        if ('BillingLine' == $relationName) {
            $this->initBillingLines();
        }
        if ('CostLine' == $relationName) {
            $this->initCostLines();
        }
    }

    /**
     * Clears out the collBillings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BillingCategory The current object (for fluent API support)
     * @see        addBillings()
     */
    public function clearBillings()
    {
        $this->collBillings = null; // important to set this to null since that means it is uninitialized
        $this->collBillingsPartial = null;

        return $this;
    }

    /**
     * reset is the collBillings collection loaded partially
     *
     * @return void
     */
    public function resetPartialBillings($v = true)
    {
        $this->collBillingsPartial = $v;
    }

    /**
     * Initializes the collBillings collection.
     *
     * By default this just sets the collBillings collection to an empty array (like clearcollBillings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBillings($overrideExisting = true)
    {
        if (null !== $this->collBillings && !$overrideExisting) {
            return;
        }
        $this->collBillings = new PropelObjectCollection();
        $this->collBillings->setModel('Billing');
    }

    /**
     * Gets an array of Billing objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BillingCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Billing[] List of Billing objects
     * @throws PropelException
     */
    public function getBillings($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBillingsPartial && !$this->isNew();
        if (null === $this->collBillings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBillings) {
                // return empty collection
                $this->initBillings();
            } else {
                $collBillings = BillingQuery::create(null, $criteria)
                    ->filterByBillingCategory($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBillingsPartial && count($collBillings)) {
                      $this->initBillings(false);

                      foreach ($collBillings as $obj) {
                        if (false == $this->collBillings->contains($obj)) {
                          $this->collBillings->append($obj);
                        }
                      }

                      $this->collBillingsPartial = true;
                    }

                    $collBillings->getInternalIterator()->rewind();

                    return $collBillings;
                }

                if ($partial && $this->collBillings) {
                    foreach ($this->collBillings as $obj) {
                        if ($obj->isNew()) {
                            $collBillings[] = $obj;
                        }
                    }
                }

                $this->collBillings = $collBillings;
                $this->collBillingsPartial = false;
            }
        }

        return $this->collBillings;
    }

    /**
     * Sets a collection of Billing objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $billings A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BillingCategory The current object (for fluent API support)
     */
    public function setBillings(PropelCollection $billings, PropelPDO $con = null)
    {
        $billingsToDelete = $this->getBillings(new Criteria(), $con)->diff($billings);


        $this->billingsScheduledForDeletion = $billingsToDelete;

        foreach ($billingsToDelete as $billingRemoved) {
            $billingRemoved->setBillingCategory(null);
        }

        $this->collBillings = null;
        foreach ($billings as $billing) {
            $this->addBilling($billing);
        }

        $this->collBillings = $billings;
        $this->collBillingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Billing objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Billing objects.
     * @throws PropelException
     */
    public function countBillings(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBillingsPartial && !$this->isNew();
        if (null === $this->collBillings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBillings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBillings());
            }
            $query = BillingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBillingCategory($this)
                ->count($con);
        }

        return count($this->collBillings);
    }

    /**
     * Method called to associate a Billing object to this object
     * through the Billing foreign key attribute.
     *
     * @param    Billing $l Billing
     * @return BillingCategory The current object (for fluent API support)
     */
    public function addBilling(Billing $l)
    {
        if ($this->collBillings === null) {
            $this->initBillings();
            $this->collBillingsPartial = true;
        }

        if (!in_array($l, $this->collBillings->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBilling($l);

            if ($this->billingsScheduledForDeletion and $this->billingsScheduledForDeletion->contains($l)) {
                $this->billingsScheduledForDeletion->remove($this->billingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Billing $billing The billing object to add.
     */
    protected function doAddBilling($billing)
    {
        $this->collBillings[]= $billing;
        $billing->setBillingCategory($this);
    }

    /**
     * @param	Billing $billing The billing object to remove.
     * @return BillingCategory The current object (for fluent API support)
     */
    public function removeBilling($billing)
    {
        if ($this->getBillings()->contains($billing)) {
            $this->collBillings->remove($this->collBillings->search($billing));
            if (null === $this->billingsScheduledForDeletion) {
                $this->billingsScheduledForDeletion = clone $this->collBillings;
                $this->billingsScheduledForDeletion->clear();
            }
            $this->billingsScheduledForDeletion[]= $billing;
            $billing->setBillingCategory(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsJoinClient($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('Client', $join_behavior);

        return $this->getBillings($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getBillings($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getBillings($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getBillings($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getBillings($query, $con);
    }

    /**
     * Clears out the collBillingLines collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BillingCategory The current object (for fluent API support)
     * @see        addBillingLines()
     */
    public function clearBillingLines()
    {
        $this->collBillingLines = null; // important to set this to null since that means it is uninitialized
        $this->collBillingLinesPartial = null;

        return $this;
    }

    /**
     * reset is the collBillingLines collection loaded partially
     *
     * @return void
     */
    public function resetPartialBillingLines($v = true)
    {
        $this->collBillingLinesPartial = $v;
    }

    /**
     * Initializes the collBillingLines collection.
     *
     * By default this just sets the collBillingLines collection to an empty array (like clearcollBillingLines());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBillingLines($overrideExisting = true)
    {
        if (null !== $this->collBillingLines && !$overrideExisting) {
            return;
        }
        $this->collBillingLines = new PropelObjectCollection();
        $this->collBillingLines->setModel('BillingLine');
    }

    /**
     * Gets an array of BillingLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BillingCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     * @throws PropelException
     */
    public function getBillingLines($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBillingLinesPartial && !$this->isNew();
        if (null === $this->collBillingLines || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBillingLines) {
                // return empty collection
                $this->initBillingLines();
            } else {
                $collBillingLines = BillingLineQuery::create(null, $criteria)
                    ->filterByBillingCategory($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBillingLinesPartial && count($collBillingLines)) {
                      $this->initBillingLines(false);

                      foreach ($collBillingLines as $obj) {
                        if (false == $this->collBillingLines->contains($obj)) {
                          $this->collBillingLines->append($obj);
                        }
                      }

                      $this->collBillingLinesPartial = true;
                    }

                    $collBillingLines->getInternalIterator()->rewind();

                    return $collBillingLines;
                }

                if ($partial && $this->collBillingLines) {
                    foreach ($this->collBillingLines as $obj) {
                        if ($obj->isNew()) {
                            $collBillingLines[] = $obj;
                        }
                    }
                }

                $this->collBillingLines = $collBillingLines;
                $this->collBillingLinesPartial = false;
            }
        }

        return $this->collBillingLines;
    }

    /**
     * Sets a collection of BillingLine objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $billingLines A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BillingCategory The current object (for fluent API support)
     */
    public function setBillingLines(PropelCollection $billingLines, PropelPDO $con = null)
    {
        $billingLinesToDelete = $this->getBillingLines(new Criteria(), $con)->diff($billingLines);


        $this->billingLinesScheduledForDeletion = $billingLinesToDelete;

        foreach ($billingLinesToDelete as $billingLineRemoved) {
            $billingLineRemoved->setBillingCategory(null);
        }

        $this->collBillingLines = null;
        foreach ($billingLines as $billingLine) {
            $this->addBillingLine($billingLine);
        }

        $this->collBillingLines = $billingLines;
        $this->collBillingLinesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BillingLine objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BillingLine objects.
     * @throws PropelException
     */
    public function countBillingLines(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBillingLinesPartial && !$this->isNew();
        if (null === $this->collBillingLines || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBillingLines) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBillingLines());
            }
            $query = BillingLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBillingCategory($this)
                ->count($con);
        }

        return count($this->collBillingLines);
    }

    /**
     * Method called to associate a BillingLine object to this object
     * through the BillingLine foreign key attribute.
     *
     * @param    BillingLine $l BillingLine
     * @return BillingCategory The current object (for fluent API support)
     */
    public function addBillingLine(BillingLine $l)
    {
        if ($this->collBillingLines === null) {
            $this->initBillingLines();
            $this->collBillingLinesPartial = true;
        }

        if (!in_array($l, $this->collBillingLines->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBillingLine($l);

            if ($this->billingLinesScheduledForDeletion and $this->billingLinesScheduledForDeletion->contains($l)) {
                $this->billingLinesScheduledForDeletion->remove($this->billingLinesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	BillingLine $billingLine The billingLine object to add.
     */
    protected function doAddBillingLine($billingLine)
    {
        $this->collBillingLines[]= $billingLine;
        $billingLine->setBillingCategory($this);
    }

    /**
     * @param	BillingLine $billingLine The billingLine object to remove.
     * @return BillingCategory The current object (for fluent API support)
     */
    public function removeBillingLine($billingLine)
    {
        if ($this->getBillingLines()->contains($billingLine)) {
            $this->collBillingLines->remove($this->collBillingLines->search($billingLine));
            if (null === $this->billingLinesScheduledForDeletion) {
                $this->billingLinesScheduledForDeletion = clone $this->collBillingLines;
                $this->billingLinesScheduledForDeletion->clear();
            }
            $this->billingLinesScheduledForDeletion[]= $billingLine;
            $billingLine->setBillingCategory(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesJoinBilling($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('Billing', $join_behavior);

        return $this->getBillingLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesJoinAuthyRelatedByIdAssign($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdAssign', $join_behavior);

        return $this->getBillingLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getBillingLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getBillingLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getBillingLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getBillingLines($query, $con);
    }

    /**
     * Clears out the collCostLines collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return BillingCategory The current object (for fluent API support)
     * @see        addCostLines()
     */
    public function clearCostLines()
    {
        $this->collCostLines = null; // important to set this to null since that means it is uninitialized
        $this->collCostLinesPartial = null;

        return $this;
    }

    /**
     * reset is the collCostLines collection loaded partially
     *
     * @return void
     */
    public function resetPartialCostLines($v = true)
    {
        $this->collCostLinesPartial = $v;
    }

    /**
     * Initializes the collCostLines collection.
     *
     * By default this just sets the collCostLines collection to an empty array (like clearcollCostLines());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCostLines($overrideExisting = true)
    {
        if (null !== $this->collCostLines && !$overrideExisting) {
            return;
        }
        $this->collCostLines = new PropelObjectCollection();
        $this->collCostLines->setModel('CostLine');
    }

    /**
     * Gets an array of CostLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this BillingCategory is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     * @throws PropelException
     */
    public function getCostLines($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCostLinesPartial && !$this->isNew();
        if (null === $this->collCostLines || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCostLines) {
                // return empty collection
                $this->initCostLines();
            } else {
                $collCostLines = CostLineQuery::create(null, $criteria)
                    ->filterByBillingCategory($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCostLinesPartial && count($collCostLines)) {
                      $this->initCostLines(false);

                      foreach ($collCostLines as $obj) {
                        if (false == $this->collCostLines->contains($obj)) {
                          $this->collCostLines->append($obj);
                        }
                      }

                      $this->collCostLinesPartial = true;
                    }

                    $collCostLines->getInternalIterator()->rewind();

                    return $collCostLines;
                }

                if ($partial && $this->collCostLines) {
                    foreach ($this->collCostLines as $obj) {
                        if ($obj->isNew()) {
                            $collCostLines[] = $obj;
                        }
                    }
                }

                $this->collCostLines = $collCostLines;
                $this->collCostLinesPartial = false;
            }
        }

        return $this->collCostLines;
    }

    /**
     * Sets a collection of CostLine objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $costLines A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return BillingCategory The current object (for fluent API support)
     */
    public function setCostLines(PropelCollection $costLines, PropelPDO $con = null)
    {
        $costLinesToDelete = $this->getCostLines(new Criteria(), $con)->diff($costLines);


        $this->costLinesScheduledForDeletion = $costLinesToDelete;

        foreach ($costLinesToDelete as $costLineRemoved) {
            $costLineRemoved->setBillingCategory(null);
        }

        $this->collCostLines = null;
        foreach ($costLines as $costLine) {
            $this->addCostLine($costLine);
        }

        $this->collCostLines = $costLines;
        $this->collCostLinesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CostLine objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related CostLine objects.
     * @throws PropelException
     */
    public function countCostLines(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCostLinesPartial && !$this->isNew();
        if (null === $this->collCostLines || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCostLines) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCostLines());
            }
            $query = CostLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBillingCategory($this)
                ->count($con);
        }

        return count($this->collCostLines);
    }

    /**
     * Method called to associate a CostLine object to this object
     * through the CostLine foreign key attribute.
     *
     * @param    CostLine $l CostLine
     * @return BillingCategory The current object (for fluent API support)
     */
    public function addCostLine(CostLine $l)
    {
        if ($this->collCostLines === null) {
            $this->initCostLines();
            $this->collCostLinesPartial = true;
        }

        if (!in_array($l, $this->collCostLines->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCostLine($l);

            if ($this->costLinesScheduledForDeletion and $this->costLinesScheduledForDeletion->contains($l)) {
                $this->costLinesScheduledForDeletion->remove($this->costLinesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	CostLine $costLine The costLine object to add.
     */
    protected function doAddCostLine($costLine)
    {
        $this->collCostLines[]= $costLine;
        $costLine->setBillingCategory($this);
    }

    /**
     * @param	CostLine $costLine The costLine object to remove.
     * @return BillingCategory The current object (for fluent API support)
     */
    public function removeCostLine($costLine)
    {
        if ($this->getCostLines()->contains($costLine)) {
            $this->collCostLines->remove($this->collCostLines->search($costLine));
            if (null === $this->costLinesScheduledForDeletion) {
                $this->costLinesScheduledForDeletion = clone $this->collCostLines;
                $this->costLinesScheduledForDeletion->clear();
            }
            $this->costLinesScheduledForDeletion[]= $costLine;
            $costLine->setBillingCategory(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesJoinBilling($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('Billing', $join_behavior);

        return $this->getCostLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesJoinSupplier($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('Supplier', $join_behavior);

        return $this->getCostLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getCostLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getCostLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getCostLines($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id_billing_category = null;
        $this->name = null;
        $this->date_creation = null;
        $this->date_modification = null;
        $this->id_group_creation = null;
        $this->id_creation = null;
        $this->id_modification = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collBillings) {
                foreach ($this->collBillings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBillingLines) {
                foreach ($this->collBillingLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCostLines) {
                foreach ($this->collCostLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aAuthyGroup instanceof Persistent) {
              $this->aAuthyGroup->clearAllReferences($deep);
            }
            if ($this->aAuthyRelatedByIdCreation instanceof Persistent) {
              $this->aAuthyRelatedByIdCreation->clearAllReferences($deep);
            }
            if ($this->aAuthyRelatedByIdModification instanceof Persistent) {
              $this->aAuthyRelatedByIdModification->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collBillings instanceof PropelCollection) {
            $this->collBillings->clearIterator();
        }
        $this->collBillings = null;
        if ($this->collBillingLines instanceof PropelCollection) {
            $this->collBillingLines->clearIterator();
        }
        $this->collBillingLines = null;
        if ($this->collCostLines instanceof PropelCollection) {
            $this->collCostLines->clearIterator();
        }
        $this->collCostLines = null;
        $this->aAuthyGroup = null;
        $this->aAuthyRelatedByIdCreation = null;
        $this->aAuthyRelatedByIdModification = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BillingCategoryPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

    // add_tablestamp behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     BillingCategory The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged(){
        $this->modifiedColumns[] = BillingCategoryPeer::DATE_MODIFICATION;

        return $this;
    }

}
