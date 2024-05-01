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
use App\ApiRbac;
use App\ApiRbacQuery;
use App\Authy;
use App\AuthyGroup;
use App\AuthyGroupPeer;
use App\AuthyGroupQuery;
use App\AuthyGroupX;
use App\AuthyGroupXQuery;
use App\AuthyQuery;
use App\Billing;
use App\BillingCategory;
use App\BillingCategoryQuery;
use App\BillingLine;
use App\BillingLineQuery;
use App\BillingQuery;
use App\Client;
use App\ClientQuery;
use App\Config;
use App\ConfigQuery;
use App\CostLine;
use App\CostLineQuery;
use App\Country;
use App\CountryQuery;
use App\MessageI18n;
use App\MessageI18nQuery;
use App\PaymentLine;
use App\PaymentLineQuery;
use App\Project;
use App\ProjectQuery;
use App\Supplier;
use App\SupplierQuery;
use App\Template;
use App\TemplateFile;
use App\TemplateFileQuery;
use App\TemplateQuery;
use App\TimeLine;
use App\TimeLineQuery;

/**
 * Base class that represents a row from the 'authy_group' table.
 *
 * Group
 *
 * @package    propel.generator..om
 */
abstract class BaseAuthyGroup extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'App\\AuthyGroupPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        AuthyGroupPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id_authy_group field.
     * @var        int
     */
    protected $id_authy_group;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the desc field.
     * @var        string
     */
    protected $desc;

    /**
     * The value for the default_group field.
     * @var        int
     */
    protected $default_group;

    /**
     * The value for the admin field.
     * @var        int
     */
    protected $admin;

    /**
     * The value for the rights_all field.
     * @var        string
     */
    protected $rights_all;

    /**
     * The value for the rights_owner field.
     * @var        string
     */
    protected $rights_owner;

    /**
     * The value for the rights_group field.
     * @var        string
     */
    protected $rights_group;

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
    protected $aAuthyGroupRelatedByIdGroupCreation;

    /**
     * @var        Authy
     */
    protected $aAuthyRelatedByIdCreation;

    /**
     * @var        Authy
     */
    protected $aAuthyRelatedByIdModification;

    /**
     * @var        PropelObjectCollection|AuthyGroupX[] Collection to store aggregation of AuthyGroupX objects.
     */
    protected $collAuthyGroupxes;
    protected $collAuthyGroupxesPartial;

    /**
     * @var        PropelObjectCollection|Client[] Collection to store aggregation of Client objects.
     */
    protected $collClients;
    protected $collClientsPartial;

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
     * @var        PropelObjectCollection|PaymentLine[] Collection to store aggregation of PaymentLine objects.
     */
    protected $collPaymentLines;
    protected $collPaymentLinesPartial;

    /**
     * @var        PropelObjectCollection|CostLine[] Collection to store aggregation of CostLine objects.
     */
    protected $collCostLines;
    protected $collCostLinesPartial;

    /**
     * @var        PropelObjectCollection|Project[] Collection to store aggregation of Project objects.
     */
    protected $collProjects;
    protected $collProjectsPartial;

    /**
     * @var        PropelObjectCollection|TimeLine[] Collection to store aggregation of TimeLine objects.
     */
    protected $collTimeLines;
    protected $collTimeLinesPartial;

    /**
     * @var        PropelObjectCollection|BillingCategory[] Collection to store aggregation of BillingCategory objects.
     */
    protected $collBillingCategories;
    protected $collBillingCategoriesPartial;

    /**
     * @var        PropelObjectCollection|Supplier[] Collection to store aggregation of Supplier objects.
     */
    protected $collSuppliers;
    protected $collSuppliersPartial;

    /**
     * @var        PropelObjectCollection|Authy[] Collection to store aggregation of Authy objects.
     */
    protected $collAuthiesRelatedByIdAuthyGroup;
    protected $collAuthiesRelatedByIdAuthyGroupPartial;

    /**
     * @var        PropelObjectCollection|Authy[] Collection to store aggregation of Authy objects.
     */
    protected $collAuthiesRelatedByIdGroupCreation;
    protected $collAuthiesRelatedByIdGroupCreationPartial;

    /**
     * @var        PropelObjectCollection|Country[] Collection to store aggregation of Country objects.
     */
    protected $collCountries;
    protected $collCountriesPartial;

    /**
     * @var        PropelObjectCollection|AuthyGroup[] Collection to store aggregation of AuthyGroup objects.
     */
    protected $collAuthyGroupsRelatedByIdAuthyGroup;
    protected $collAuthyGroupsRelatedByIdAuthyGroupPartial;

    /**
     * @var        PropelObjectCollection|Config[] Collection to store aggregation of Config objects.
     */
    protected $collConfigs;
    protected $collConfigsPartial;

    /**
     * @var        PropelObjectCollection|ApiRbac[] Collection to store aggregation of ApiRbac objects.
     */
    protected $collApiRbacs;
    protected $collApiRbacsPartial;

    /**
     * @var        PropelObjectCollection|Template[] Collection to store aggregation of Template objects.
     */
    protected $collTemplates;
    protected $collTemplatesPartial;

    /**
     * @var        PropelObjectCollection|TemplateFile[] Collection to store aggregation of TemplateFile objects.
     */
    protected $collTemplateFiles;
    protected $collTemplateFilesPartial;

    /**
     * @var        PropelObjectCollection|MessageI18n[] Collection to store aggregation of MessageI18n objects.
     */
    protected $collMessageI18ns;
    protected $collMessageI18nsPartial;

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
    protected $authyGroupxesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $clientsScheduledForDeletion = null;

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
    protected $paymentLinesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $costLinesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $projectsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $timeLinesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $billingCategoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $suppliersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $authiesRelatedByIdAuthyGroupScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $authiesRelatedByIdGroupCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $countriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $authyGroupsRelatedByIdAuthyGroupScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $configsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $apiRbacsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $templatesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $templateFilesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $messageI18nsScheduledForDeletion = null;

    /**
     * @Field()
     * Get the [id_authy_group] column value.
     *
     * @return int
     */
    public function getIdAuthyGroup()
    {

        return $this->id_authy_group;
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
     * Get the [desc] column value.
     * Description
     * @return string
     */
    public function getDesc()
    {

        return $this->desc;
    }

    /**
     * @Field()
     * Get the [default_group] column value.
     * Default
     * @return int
     * @throws PropelException - if the stored enum key is unknown.
     */
    public function getDefaultGroup()
    {
        if (null === $this->default_group) {
            return null;
        }
        $valueSet = AuthyGroupPeer::getValueSet(AuthyGroupPeer::DEFAULT_GROUP);
        if (!isset($valueSet[$this->default_group])) {
            throw new PropelException('Unknown stored enum key: ' . $this->default_group);
        }

        return $valueSet[$this->default_group];
    }

    /**
     * @Field()
     * Get the [admin] column value.
     * Admin
     * @return int
     * @throws PropelException - if the stored enum key is unknown.
     */
    public function getAdmin()
    {
        if (null === $this->admin) {
            return null;
        }
        $valueSet = AuthyGroupPeer::getValueSet(AuthyGroupPeer::ADMIN);
        if (!isset($valueSet[$this->admin])) {
            throw new PropelException('Unknown stored enum key: ' . $this->admin);
        }

        return $valueSet[$this->admin];
    }

    /**
     * @Field()
     * Get the [rights_all] column value.
     * Rights
     * @return string
     */
    public function getRightsAll()
    {

        return $this->rights_all;
    }

    /**
     * @Field()
     * Get the [rights_owner] column value.
     * Rights owner
     * @return string
     */
    public function getRightsOwner()
    {

        return $this->rights_owner;
    }

    /**
     * @Field()
     * Get the [rights_group] column value.
     * Rights group
     * @return string
     */
    public function getRightsGroup()
    {

        return $this->rights_group;
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
     * Set the value of [id_authy_group] column.
     *
     * @param  int $v new value
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setIdAuthyGroup($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_authy_group !== $v) {
            $this->id_authy_group = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::ID_AUTHY_GROUP;
        }


        return $this;
    } // setIdAuthyGroup()

    /**
     * Set the value of [name] column.
     * Name
     * @param  string $v new value
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [desc] column.
     * Description
     * @param  string $v new value
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setDesc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->desc !== $v) {
            $this->desc = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::DESC;
        }


        return $this;
    } // setDesc()

    /**
     * Set the value of [default_group] column.
     * Default
     * @param  int $v new value
     * @return AuthyGroup The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setDefaultGroup($v)
    {
        if ($v !== null) {
            $valueSet = AuthyGroupPeer::getValueSet(AuthyGroupPeer::DEFAULT_GROUP);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->default_group !== $v) {
            $this->default_group = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::DEFAULT_GROUP;
        }


        return $this;
    } // setDefaultGroup()

    /**
     * Set the value of [admin] column.
     * Admin
     * @param  int $v new value
     * @return AuthyGroup The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setAdmin($v)
    {
        if ($v !== null) {
            $valueSet = AuthyGroupPeer::getValueSet(AuthyGroupPeer::ADMIN);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->admin !== $v) {
            $this->admin = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::ADMIN;
        }


        return $this;
    } // setAdmin()

    /**
     * Set the value of [rights_all] column.
     * Rights
     * @param  string $v new value
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setRightsAll($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rights_all !== $v) {
            $this->rights_all = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::RIGHTS_ALL;
        }


        return $this;
    } // setRightsAll()

    /**
     * Set the value of [rights_owner] column.
     * Rights owner
     * @param  string $v new value
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setRightsOwner($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rights_owner !== $v) {
            $this->rights_owner = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::RIGHTS_OWNER;
        }


        return $this;
    } // setRightsOwner()

    /**
     * Set the value of [rights_group] column.
     * Rights group
     * @param  string $v new value
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setRightsGroup($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rights_group !== $v) {
            $this->rights_group = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::RIGHTS_GROUP;
        }


        return $this;
    } // setRightsGroup()

    /**
     * Sets the value of [date_creation] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setDateCreation($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_creation !== null || $dt !== null) {
            $currentDateAsString = ($this->date_creation !== null && $tmpDt = new DateTime($this->date_creation)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_creation = $newDateAsString;
                $this->modifiedColumns[] = AuthyGroupPeer::DATE_CREATION;
            }
        } // if either are not null


        return $this;
    } // setDateCreation()

    /**
     * Sets the value of [date_modification] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setDateModification($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_modification !== null || $dt !== null) {
            $currentDateAsString = ($this->date_modification !== null && $tmpDt = new DateTime($this->date_modification)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_modification = $newDateAsString;
                $this->modifiedColumns[] = AuthyGroupPeer::DATE_MODIFICATION;
            }
        } // if either are not null


        return $this;
    } // setDateModification()

    /**
     * Set the value of [id_group_creation] column.
     *
     * @param  int $v new value
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setIdGroupCreation($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_group_creation !== $v) {
            $this->id_group_creation = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::ID_GROUP_CREATION;
        }

        if ($this->aAuthyGroupRelatedByIdGroupCreation !== null && $this->aAuthyGroupRelatedByIdGroupCreation->getIdAuthyGroup() !== $v) {
            $this->aAuthyGroupRelatedByIdGroupCreation = null;
        }


        return $this;
    } // setIdGroupCreation()

    /**
     * Set the value of [id_creation] column.
     *
     * @param  int $v new value
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setIdCreation($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_creation !== $v) {
            $this->id_creation = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::ID_CREATION;
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
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setIdModification($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_modification !== $v) {
            $this->id_modification = $v;
            $this->modifiedColumns[] = AuthyGroupPeer::ID_MODIFICATION;
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

            $this->id_authy_group = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->desc = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->default_group = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->admin = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->rights_all = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->rights_owner = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->rights_group = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->date_creation = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->date_modification = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->id_group_creation = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->id_creation = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->id_modification = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 13; // 13 = AuthyGroupPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating AuthyGroup object", $e);
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

        if ($this->aAuthyGroupRelatedByIdGroupCreation !== null && $this->id_group_creation !== $this->aAuthyGroupRelatedByIdGroupCreation->getIdAuthyGroup()) {
            $this->aAuthyGroupRelatedByIdGroupCreation = null;
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
            $con = Propel::getConnection(AuthyGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = AuthyGroupPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAuthyGroupRelatedByIdGroupCreation = null;
            $this->aAuthyRelatedByIdCreation = null;
            $this->aAuthyRelatedByIdModification = null;
            $this->collAuthyGroupxes = null;

            $this->collClients = null;

            $this->collBillings = null;

            $this->collBillingLines = null;

            $this->collPaymentLines = null;

            $this->collCostLines = null;

            $this->collProjects = null;

            $this->collTimeLines = null;

            $this->collBillingCategories = null;

            $this->collSuppliers = null;

            $this->collAuthiesRelatedByIdAuthyGroup = null;

            $this->collAuthiesRelatedByIdGroupCreation = null;

            $this->collCountries = null;

            $this->collAuthyGroupsRelatedByIdAuthyGroup = null;

            $this->collConfigs = null;

            $this->collApiRbacs = null;

            $this->collTemplates = null;

            $this->collTemplateFiles = null;

            $this->collMessageI18ns = null;

            $this->collAuthies = null;
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
            $con = Propel::getConnection(AuthyGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = AuthyGroupQuery::create()
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
            $con = Propel::getConnection(AuthyGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                AuthyGroupPeer::addInstanceToPool($this);
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

            if ($this->aAuthyGroupRelatedByIdGroupCreation !== null) {
                if ($this->aAuthyGroupRelatedByIdGroupCreation->isModified() || $this->aAuthyGroupRelatedByIdGroupCreation->isNew()) {
                    $affectedRows += $this->aAuthyGroupRelatedByIdGroupCreation->save($con);
                }
                $this->setAuthyGroupRelatedByIdGroupCreation($this->aAuthyGroupRelatedByIdGroupCreation);
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

            if ($this->authiesScheduledForDeletion !== null) {
                if (!$this->authiesScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->authiesScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($pk, $remotePk);
                    }
                    AuthyGroupXQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->authiesScheduledForDeletion = null;
                }

                foreach ($this->getAuthies() as $authy) {
                    if ($authy->isModified()) {
                        $authy->save($con);
                    }
                }
            } elseif ($this->collAuthies) {
                foreach ($this->collAuthies as $authy) {
                    if ($authy->isModified()) {
                        $authy->save($con);
                    }
                }
            }

            if ($this->authyGroupxesScheduledForDeletion !== null) {
                if (!$this->authyGroupxesScheduledForDeletion->isEmpty()) {
                    AuthyGroupXQuery::create()
                        ->filterByPrimaryKeys($this->authyGroupxesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->authyGroupxesScheduledForDeletion = null;
                }
            }

            if ($this->collAuthyGroupxes !== null) {
                foreach ($this->collAuthyGroupxes as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->clientsScheduledForDeletion !== null) {
                if (!$this->clientsScheduledForDeletion->isEmpty()) {
                    foreach ($this->clientsScheduledForDeletion as $client) {
                        // need to save related object because we set the relation to null
                        $client->save($con);
                    }
                    $this->clientsScheduledForDeletion = null;
                }
            }

            if ($this->collClients !== null) {
                foreach ($this->collClients as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->paymentLinesScheduledForDeletion !== null) {
                if (!$this->paymentLinesScheduledForDeletion->isEmpty()) {
                    foreach ($this->paymentLinesScheduledForDeletion as $paymentLine) {
                        // need to save related object because we set the relation to null
                        $paymentLine->save($con);
                    }
                    $this->paymentLinesScheduledForDeletion = null;
                }
            }

            if ($this->collPaymentLines !== null) {
                foreach ($this->collPaymentLines as $referrerFK) {
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

            if ($this->projectsScheduledForDeletion !== null) {
                if (!$this->projectsScheduledForDeletion->isEmpty()) {
                    foreach ($this->projectsScheduledForDeletion as $project) {
                        // need to save related object because we set the relation to null
                        $project->save($con);
                    }
                    $this->projectsScheduledForDeletion = null;
                }
            }

            if ($this->collProjects !== null) {
                foreach ($this->collProjects as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->timeLinesScheduledForDeletion !== null) {
                if (!$this->timeLinesScheduledForDeletion->isEmpty()) {
                    foreach ($this->timeLinesScheduledForDeletion as $timeLine) {
                        // need to save related object because we set the relation to null
                        $timeLine->save($con);
                    }
                    $this->timeLinesScheduledForDeletion = null;
                }
            }

            if ($this->collTimeLines !== null) {
                foreach ($this->collTimeLines as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->billingCategoriesScheduledForDeletion !== null) {
                if (!$this->billingCategoriesScheduledForDeletion->isEmpty()) {
                    foreach ($this->billingCategoriesScheduledForDeletion as $billingCategory) {
                        // need to save related object because we set the relation to null
                        $billingCategory->save($con);
                    }
                    $this->billingCategoriesScheduledForDeletion = null;
                }
            }

            if ($this->collBillingCategories !== null) {
                foreach ($this->collBillingCategories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->suppliersScheduledForDeletion !== null) {
                if (!$this->suppliersScheduledForDeletion->isEmpty()) {
                    foreach ($this->suppliersScheduledForDeletion as $supplier) {
                        // need to save related object because we set the relation to null
                        $supplier->save($con);
                    }
                    $this->suppliersScheduledForDeletion = null;
                }
            }

            if ($this->collSuppliers !== null) {
                foreach ($this->collSuppliers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->authiesRelatedByIdAuthyGroupScheduledForDeletion !== null) {
                if (!$this->authiesRelatedByIdAuthyGroupScheduledForDeletion->isEmpty()) {
                    AuthyQuery::create()
                        ->filterByPrimaryKeys($this->authiesRelatedByIdAuthyGroupScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->authiesRelatedByIdAuthyGroupScheduledForDeletion = null;
                }
            }

            if ($this->collAuthiesRelatedByIdAuthyGroup !== null) {
                foreach ($this->collAuthiesRelatedByIdAuthyGroup as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->authiesRelatedByIdGroupCreationScheduledForDeletion !== null) {
                if (!$this->authiesRelatedByIdGroupCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->authiesRelatedByIdGroupCreationScheduledForDeletion as $authyRelatedByIdGroupCreation) {
                        // need to save related object because we set the relation to null
                        $authyRelatedByIdGroupCreation->save($con);
                    }
                    $this->authiesRelatedByIdGroupCreationScheduledForDeletion = null;
                }
            }

            if ($this->collAuthiesRelatedByIdGroupCreation !== null) {
                foreach ($this->collAuthiesRelatedByIdGroupCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->countriesScheduledForDeletion !== null) {
                if (!$this->countriesScheduledForDeletion->isEmpty()) {
                    foreach ($this->countriesScheduledForDeletion as $country) {
                        // need to save related object because we set the relation to null
                        $country->save($con);
                    }
                    $this->countriesScheduledForDeletion = null;
                }
            }

            if ($this->collCountries !== null) {
                foreach ($this->collCountries as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion !== null) {
                if (!$this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion->isEmpty()) {
                    foreach ($this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion as $authyGroupRelatedByIdAuthyGroup) {
                        // need to save related object because we set the relation to null
                        $authyGroupRelatedByIdAuthyGroup->save($con);
                    }
                    $this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion = null;
                }
            }

            if ($this->collAuthyGroupsRelatedByIdAuthyGroup !== null) {
                foreach ($this->collAuthyGroupsRelatedByIdAuthyGroup as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->configsScheduledForDeletion !== null) {
                if (!$this->configsScheduledForDeletion->isEmpty()) {
                    foreach ($this->configsScheduledForDeletion as $config) {
                        // need to save related object because we set the relation to null
                        $config->save($con);
                    }
                    $this->configsScheduledForDeletion = null;
                }
            }

            if ($this->collConfigs !== null) {
                foreach ($this->collConfigs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->apiRbacsScheduledForDeletion !== null) {
                if (!$this->apiRbacsScheduledForDeletion->isEmpty()) {
                    foreach ($this->apiRbacsScheduledForDeletion as $apiRbac) {
                        // need to save related object because we set the relation to null
                        $apiRbac->save($con);
                    }
                    $this->apiRbacsScheduledForDeletion = null;
                }
            }

            if ($this->collApiRbacs !== null) {
                foreach ($this->collApiRbacs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->templatesScheduledForDeletion !== null) {
                if (!$this->templatesScheduledForDeletion->isEmpty()) {
                    foreach ($this->templatesScheduledForDeletion as $template) {
                        // need to save related object because we set the relation to null
                        $template->save($con);
                    }
                    $this->templatesScheduledForDeletion = null;
                }
            }

            if ($this->collTemplates !== null) {
                foreach ($this->collTemplates as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->templateFilesScheduledForDeletion !== null) {
                if (!$this->templateFilesScheduledForDeletion->isEmpty()) {
                    foreach ($this->templateFilesScheduledForDeletion as $templateFile) {
                        // need to save related object because we set the relation to null
                        $templateFile->save($con);
                    }
                    $this->templateFilesScheduledForDeletion = null;
                }
            }

            if ($this->collTemplateFiles !== null) {
                foreach ($this->collTemplateFiles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->messageI18nsScheduledForDeletion !== null) {
                if (!$this->messageI18nsScheduledForDeletion->isEmpty()) {
                    foreach ($this->messageI18nsScheduledForDeletion as $messageI18n) {
                        // need to save related object because we set the relation to null
                        $messageI18n->save($con);
                    }
                    $this->messageI18nsScheduledForDeletion = null;
                }
            }

            if ($this->collMessageI18ns !== null) {
                foreach ($this->collMessageI18ns as $referrerFK) {
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

        $this->modifiedColumns[] = AuthyGroupPeer::ID_AUTHY_GROUP;
        if (null !== $this->id_authy_group) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AuthyGroupPeer::ID_AUTHY_GROUP . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AuthyGroupPeer::ID_AUTHY_GROUP)) {
            $modifiedColumns[':p' . $index++]  = '`id_authy_group`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::DESC)) {
            $modifiedColumns[':p' . $index++]  = '`desc`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::DEFAULT_GROUP)) {
            $modifiedColumns[':p' . $index++]  = '`default_group`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::ADMIN)) {
            $modifiedColumns[':p' . $index++]  = '`admin`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::RIGHTS_ALL)) {
            $modifiedColumns[':p' . $index++]  = '`rights_all`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::RIGHTS_OWNER)) {
            $modifiedColumns[':p' . $index++]  = '`rights_owner`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::RIGHTS_GROUP)) {
            $modifiedColumns[':p' . $index++]  = '`rights_group`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::DATE_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`date_creation`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::DATE_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = '`date_modification`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::ID_GROUP_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_group_creation`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::ID_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_creation`';
        }
        if ($this->isColumnModified(AuthyGroupPeer::ID_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_modification`';
        }

        $sql = sprintf(
            'INSERT INTO `authy_group` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_authy_group`':
                        $stmt->bindValue($identifier, $this->id_authy_group, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`desc`':
                        $stmt->bindValue($identifier, $this->desc, PDO::PARAM_STR);
                        break;
                    case '`default_group`':
                        $stmt->bindValue($identifier, $this->default_group, PDO::PARAM_INT);
                        break;
                    case '`admin`':
                        $stmt->bindValue($identifier, $this->admin, PDO::PARAM_INT);
                        break;
                    case '`rights_all`':
                        $stmt->bindValue($identifier, $this->rights_all, PDO::PARAM_STR);
                        break;
                    case '`rights_owner`':
                        $stmt->bindValue($identifier, $this->rights_owner, PDO::PARAM_STR);
                        break;
                    case '`rights_group`':
                        $stmt->bindValue($identifier, $this->rights_group, PDO::PARAM_STR);
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
        $this->setIdAuthyGroup($pk);

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

            if ($this->aAuthyGroupRelatedByIdGroupCreation !== null) {
                if (!$this->aAuthyGroupRelatedByIdGroupCreation->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAuthyGroupRelatedByIdGroupCreation->getValidationFailures());
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


            if (($retval = AuthyGroupPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collAuthyGroupxes !== null) {
                    foreach ($this->collAuthyGroupxes as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collClients !== null) {
                    foreach ($this->collClients as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
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

                if ($this->collPaymentLines !== null) {
                    foreach ($this->collPaymentLines as $referrerFK) {
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

                if ($this->collProjects !== null) {
                    foreach ($this->collProjects as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTimeLines !== null) {
                    foreach ($this->collTimeLines as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBillingCategories !== null) {
                    foreach ($this->collBillingCategories as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collSuppliers !== null) {
                    foreach ($this->collSuppliers as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAuthiesRelatedByIdAuthyGroup !== null) {
                    foreach ($this->collAuthiesRelatedByIdAuthyGroup as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAuthiesRelatedByIdGroupCreation !== null) {
                    foreach ($this->collAuthiesRelatedByIdGroupCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCountries !== null) {
                    foreach ($this->collCountries as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAuthyGroupsRelatedByIdAuthyGroup !== null) {
                    foreach ($this->collAuthyGroupsRelatedByIdAuthyGroup as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collConfigs !== null) {
                    foreach ($this->collConfigs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collApiRbacs !== null) {
                    foreach ($this->collApiRbacs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTemplates !== null) {
                    foreach ($this->collTemplates as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTemplateFiles !== null) {
                    foreach ($this->collTemplateFiles as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collMessageI18ns !== null) {
                    foreach ($this->collMessageI18ns as $referrerFK) {
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
        $pos = AuthyGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['AuthyGroup'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['AuthyGroup'][$this->getPrimaryKey()] = true;
        $keys = AuthyGroupPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdAuthyGroup(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getDesc(),
            $keys[3] => $this->getDefaultGroup(),
            $keys[4] => $this->getAdmin(),
            $keys[5] => $this->getRightsAll(),
            $keys[6] => $this->getRightsOwner(),
            $keys[7] => $this->getRightsGroup(),
            $keys[8] => $this->getDateCreation(),
            $keys[9] => $this->getDateModification(),
            $keys[10] => $this->getIdGroupCreation(),
            $keys[11] => $this->getIdCreation(),
            $keys[12] => $this->getIdModification(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aAuthyGroupRelatedByIdGroupCreation) {
                $result['AuthyGroupRelatedByIdGroupCreation'] = $this->aAuthyGroupRelatedByIdGroupCreation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyRelatedByIdCreation) {
                $result['AuthyRelatedByIdCreation'] = $this->aAuthyRelatedByIdCreation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyRelatedByIdModification) {
                $result['AuthyRelatedByIdModification'] = $this->aAuthyRelatedByIdModification->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAuthyGroupxes) {
                $result['AuthyGroupxes'] = $this->collAuthyGroupxes->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collClients) {
                $result['Clients'] = $this->collClients->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillings) {
                $result['Billings'] = $this->collBillings->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillingLines) {
                $result['BillingLines'] = $this->collBillingLines->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPaymentLines) {
                $result['PaymentLines'] = $this->collPaymentLines->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCostLines) {
                $result['CostLines'] = $this->collCostLines->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjects) {
                $result['Projects'] = $this->collProjects->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTimeLines) {
                $result['TimeLines'] = $this->collTimeLines->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillingCategories) {
                $result['BillingCategories'] = $this->collBillingCategories->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSuppliers) {
                $result['Suppliers'] = $this->collSuppliers->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuthiesRelatedByIdAuthyGroup) {
                $result['AuthiesRelatedByIdAuthyGroup'] = $this->collAuthiesRelatedByIdAuthyGroup->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuthiesRelatedByIdGroupCreation) {
                $result['AuthiesRelatedByIdGroupCreation'] = $this->collAuthiesRelatedByIdGroupCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCountries) {
                $result['Countries'] = $this->collCountries->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuthyGroupsRelatedByIdAuthyGroup) {
                $result['AuthyGroupsRelatedByIdAuthyGroup'] = $this->collAuthyGroupsRelatedByIdAuthyGroup->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collConfigs) {
                $result['Configs'] = $this->collConfigs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collApiRbacs) {
                $result['ApiRbacs'] = $this->collApiRbacs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTemplates) {
                $result['Templates'] = $this->collTemplates->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTemplateFiles) {
                $result['TemplateFiles'] = $this->collTemplateFiles->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMessageI18ns) {
                $result['MessageI18ns'] = $this->collMessageI18ns->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = AuthyGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIdAuthyGroup($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setDesc($value);
                break;
            case 3:
                $valueSet = AuthyGroupPeer::getValueSet(AuthyGroupPeer::DEFAULT_GROUP);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setDefaultGroup($value);
                break;
            case 4:
                $valueSet = AuthyGroupPeer::getValueSet(AuthyGroupPeer::ADMIN);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setAdmin($value);
                break;
            case 5:
                $this->setRightsAll($value);
                break;
            case 6:
                $this->setRightsOwner($value);
                break;
            case 7:
                $this->setRightsGroup($value);
                break;
            case 8:
                $this->setDateCreation($value);
                break;
            case 9:
                $this->setDateModification($value);
                break;
            case 10:
                $this->setIdGroupCreation($value);
                break;
            case 11:
                $this->setIdCreation($value);
                break;
            case 12:
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
        $keys = AuthyGroupPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdAuthyGroup($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setDesc($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setDefaultGroup($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setAdmin($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setRightsAll($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setRightsOwner($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setRightsGroup($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setDateCreation($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setDateModification($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setIdGroupCreation($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setIdCreation($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setIdModification($arr[$keys[12]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(AuthyGroupPeer::DATABASE_NAME);

        if ($this->isColumnModified(AuthyGroupPeer::ID_AUTHY_GROUP)) $criteria->add(AuthyGroupPeer::ID_AUTHY_GROUP, $this->id_authy_group);
        if ($this->isColumnModified(AuthyGroupPeer::NAME)) $criteria->add(AuthyGroupPeer::NAME, $this->name);
        if ($this->isColumnModified(AuthyGroupPeer::DESC)) $criteria->add(AuthyGroupPeer::DESC, $this->desc);
        if ($this->isColumnModified(AuthyGroupPeer::DEFAULT_GROUP)) $criteria->add(AuthyGroupPeer::DEFAULT_GROUP, $this->default_group);
        if ($this->isColumnModified(AuthyGroupPeer::ADMIN)) $criteria->add(AuthyGroupPeer::ADMIN, $this->admin);
        if ($this->isColumnModified(AuthyGroupPeer::RIGHTS_ALL)) $criteria->add(AuthyGroupPeer::RIGHTS_ALL, $this->rights_all);
        if ($this->isColumnModified(AuthyGroupPeer::RIGHTS_OWNER)) $criteria->add(AuthyGroupPeer::RIGHTS_OWNER, $this->rights_owner);
        if ($this->isColumnModified(AuthyGroupPeer::RIGHTS_GROUP)) $criteria->add(AuthyGroupPeer::RIGHTS_GROUP, $this->rights_group);
        if ($this->isColumnModified(AuthyGroupPeer::DATE_CREATION)) $criteria->add(AuthyGroupPeer::DATE_CREATION, $this->date_creation);
        if ($this->isColumnModified(AuthyGroupPeer::DATE_MODIFICATION)) $criteria->add(AuthyGroupPeer::DATE_MODIFICATION, $this->date_modification);
        if ($this->isColumnModified(AuthyGroupPeer::ID_GROUP_CREATION)) $criteria->add(AuthyGroupPeer::ID_GROUP_CREATION, $this->id_group_creation);
        if ($this->isColumnModified(AuthyGroupPeer::ID_CREATION)) $criteria->add(AuthyGroupPeer::ID_CREATION, $this->id_creation);
        if ($this->isColumnModified(AuthyGroupPeer::ID_MODIFICATION)) $criteria->add(AuthyGroupPeer::ID_MODIFICATION, $this->id_modification);

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
        $criteria = new Criteria(AuthyGroupPeer::DATABASE_NAME);
        $criteria->add(AuthyGroupPeer::ID_AUTHY_GROUP, $this->id_authy_group);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdAuthyGroup();
    }

    /**
     * Generic method to set the primary key (id_authy_group column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdAuthyGroup($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdAuthyGroup();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of AuthyGroup (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setDesc($this->getDesc());
        $copyObj->setDefaultGroup($this->getDefaultGroup());
        $copyObj->setAdmin($this->getAdmin());
        $copyObj->setRightsAll($this->getRightsAll());
        $copyObj->setRightsOwner($this->getRightsOwner());
        $copyObj->setRightsGroup($this->getRightsGroup());
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

            foreach ($this->getAuthyGroupxes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuthyGroupX($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getClients() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addClient($relObj->copy($deepCopy));
                }
            }

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

            foreach ($this->getPaymentLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPaymentLine($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCostLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCostLine($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjects() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProject($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTimeLines() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTimeLine($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBillingCategories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBillingCategory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSuppliers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSupplier($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuthiesRelatedByIdAuthyGroup() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuthyRelatedByIdAuthyGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuthiesRelatedByIdGroupCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuthyRelatedByIdGroupCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCountries() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCountry($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuthyGroupsRelatedByIdAuthyGroup() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuthyGroupRelatedByIdAuthyGroup($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getConfigs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addConfig($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getApiRbacs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addApiRbac($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTemplates() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTemplate($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTemplateFiles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTemplateFile($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMessageI18ns() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMessageI18n($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdAuthyGroup(NULL); // this is a auto-increment column, so set to default value
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
     * @return AuthyGroup Clone of current object.
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
     * @return AuthyGroupPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new AuthyGroupPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a AuthyGroup object.
     *
     * @param                  AuthyGroup $v
     * @return AuthyGroup The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAuthyGroupRelatedByIdGroupCreation(AuthyGroup $v = null)
    {
        if ($v === null) {
            $this->setIdGroupCreation(NULL);
        } else {
            $this->setIdGroupCreation($v->getIdAuthyGroup());
        }

        $this->aAuthyGroupRelatedByIdGroupCreation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the AuthyGroup object, it will not be re-added.
        if ($v !== null) {
            $v->addAuthyGroupRelatedByIdAuthyGroup($this);
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
    public function getAuthyGroupRelatedByIdGroupCreation(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aAuthyGroupRelatedByIdGroupCreation === null && ($this->id_group_creation !== null) && $doQuery) {
            $this->aAuthyGroupRelatedByIdGroupCreation = AuthyGroupQuery::create()->findPk($this->id_group_creation, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAuthyGroupRelatedByIdGroupCreation->addAuthyGroupsRelatedByIdAuthyGroup($this);
             */
        }

        return $this->aAuthyGroupRelatedByIdGroupCreation;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return AuthyGroup The current object (for fluent API support)
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
            $v->addAuthyGroupRelatedByIdCreation($this);
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
                $this->aAuthyRelatedByIdCreation->addAuthyGroupsRelatedByIdCreation($this);
             */
        }

        return $this->aAuthyRelatedByIdCreation;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return AuthyGroup The current object (for fluent API support)
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
            $v->addAuthyGroupRelatedByIdModification($this);
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
                $this->aAuthyRelatedByIdModification->addAuthyGroupsRelatedByIdModification($this);
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
        if ('AuthyGroupX' == $relationName) {
            $this->initAuthyGroupxes();
        }
        if ('Client' == $relationName) {
            $this->initClients();
        }
        if ('Billing' == $relationName) {
            $this->initBillings();
        }
        if ('BillingLine' == $relationName) {
            $this->initBillingLines();
        }
        if ('PaymentLine' == $relationName) {
            $this->initPaymentLines();
        }
        if ('CostLine' == $relationName) {
            $this->initCostLines();
        }
        if ('Project' == $relationName) {
            $this->initProjects();
        }
        if ('TimeLine' == $relationName) {
            $this->initTimeLines();
        }
        if ('BillingCategory' == $relationName) {
            $this->initBillingCategories();
        }
        if ('Supplier' == $relationName) {
            $this->initSuppliers();
        }
        if ('AuthyRelatedByIdAuthyGroup' == $relationName) {
            $this->initAuthiesRelatedByIdAuthyGroup();
        }
        if ('AuthyRelatedByIdGroupCreation' == $relationName) {
            $this->initAuthiesRelatedByIdGroupCreation();
        }
        if ('Country' == $relationName) {
            $this->initCountries();
        }
        if ('AuthyGroupRelatedByIdAuthyGroup' == $relationName) {
            $this->initAuthyGroupsRelatedByIdAuthyGroup();
        }
        if ('Config' == $relationName) {
            $this->initConfigs();
        }
        if ('ApiRbac' == $relationName) {
            $this->initApiRbacs();
        }
        if ('Template' == $relationName) {
            $this->initTemplates();
        }
        if ('TemplateFile' == $relationName) {
            $this->initTemplateFiles();
        }
        if ('MessageI18n' == $relationName) {
            $this->initMessageI18ns();
        }
    }

    /**
     * Clears out the collAuthyGroupxes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addAuthyGroupxes()
     */
    public function clearAuthyGroupxes()
    {
        $this->collAuthyGroupxes = null; // important to set this to null since that means it is uninitialized
        $this->collAuthyGroupxesPartial = null;

        return $this;
    }

    /**
     * reset is the collAuthyGroupxes collection loaded partially
     *
     * @return void
     */
    public function resetPartialAuthyGroupxes($v = true)
    {
        $this->collAuthyGroupxesPartial = $v;
    }

    /**
     * Initializes the collAuthyGroupxes collection.
     *
     * By default this just sets the collAuthyGroupxes collection to an empty array (like clearcollAuthyGroupxes());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuthyGroupxes($overrideExisting = true)
    {
        if (null !== $this->collAuthyGroupxes && !$overrideExisting) {
            return;
        }
        $this->collAuthyGroupxes = new PropelObjectCollection();
        $this->collAuthyGroupxes->setModel('AuthyGroupX');
    }

    /**
     * Gets an array of AuthyGroupX objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|AuthyGroupX[] List of AuthyGroupX objects
     * @throws PropelException
     */
    public function getAuthyGroupxes($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAuthyGroupxesPartial && !$this->isNew();
        if (null === $this->collAuthyGroupxes || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAuthyGroupxes) {
                // return empty collection
                $this->initAuthyGroupxes();
            } else {
                $collAuthyGroupxes = AuthyGroupXQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAuthyGroupxesPartial && count($collAuthyGroupxes)) {
                      $this->initAuthyGroupxes(false);

                      foreach ($collAuthyGroupxes as $obj) {
                        if (false == $this->collAuthyGroupxes->contains($obj)) {
                          $this->collAuthyGroupxes->append($obj);
                        }
                      }

                      $this->collAuthyGroupxesPartial = true;
                    }

                    $collAuthyGroupxes->getInternalIterator()->rewind();

                    return $collAuthyGroupxes;
                }

                if ($partial && $this->collAuthyGroupxes) {
                    foreach ($this->collAuthyGroupxes as $obj) {
                        if ($obj->isNew()) {
                            $collAuthyGroupxes[] = $obj;
                        }
                    }
                }

                $this->collAuthyGroupxes = $collAuthyGroupxes;
                $this->collAuthyGroupxesPartial = false;
            }
        }

        return $this->collAuthyGroupxes;
    }

    /**
     * Sets a collection of AuthyGroupX objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $authyGroupxes A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setAuthyGroupxes(PropelCollection $authyGroupxes, PropelPDO $con = null)
    {
        $authyGroupxesToDelete = $this->getAuthyGroupxes(new Criteria(), $con)->diff($authyGroupxes);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->authyGroupxesScheduledForDeletion = clone $authyGroupxesToDelete;

        foreach ($authyGroupxesToDelete as $authyGroupXRemoved) {
            $authyGroupXRemoved->setAuthyGroup(null);
        }

        $this->collAuthyGroupxes = null;
        foreach ($authyGroupxes as $authyGroupX) {
            $this->addAuthyGroupX($authyGroupX);
        }

        $this->collAuthyGroupxes = $authyGroupxes;
        $this->collAuthyGroupxesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AuthyGroupX objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related AuthyGroupX objects.
     * @throws PropelException
     */
    public function countAuthyGroupxes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAuthyGroupxesPartial && !$this->isNew();
        if (null === $this->collAuthyGroupxes || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuthyGroupxes) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuthyGroupxes());
            }
            $query = AuthyGroupXQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collAuthyGroupxes);
    }

    /**
     * Method called to associate a AuthyGroupX object to this object
     * through the AuthyGroupX foreign key attribute.
     *
     * @param    AuthyGroupX $l AuthyGroupX
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addAuthyGroupX(AuthyGroupX $l)
    {
        if ($this->collAuthyGroupxes === null) {
            $this->initAuthyGroupxes();
            $this->collAuthyGroupxesPartial = true;
        }

        if (!in_array($l, $this->collAuthyGroupxes->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAuthyGroupX($l);

            if ($this->authyGroupxesScheduledForDeletion and $this->authyGroupxesScheduledForDeletion->contains($l)) {
                $this->authyGroupxesScheduledForDeletion->remove($this->authyGroupxesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	AuthyGroupX $authyGroupX The authyGroupX object to add.
     */
    protected function doAddAuthyGroupX($authyGroupX)
    {
        $this->collAuthyGroupxes[]= $authyGroupX;
        $authyGroupX->setAuthyGroup($this);
    }

    /**
     * @param	AuthyGroupX $authyGroupX The authyGroupX object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeAuthyGroupX($authyGroupX)
    {
        if ($this->getAuthyGroupxes()->contains($authyGroupX)) {
            $this->collAuthyGroupxes->remove($this->collAuthyGroupxes->search($authyGroupX));
            if (null === $this->authyGroupxesScheduledForDeletion) {
                $this->authyGroupxesScheduledForDeletion = clone $this->collAuthyGroupxes;
                $this->authyGroupxesScheduledForDeletion->clear();
            }
            $this->authyGroupxesScheduledForDeletion[]= clone $authyGroupX;
            $authyGroupX->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|AuthyGroupX[] List of AuthyGroupX objects
     */
    public function getAuthyGroupxesJoinAuthy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyGroupXQuery::create(null, $criteria);
        $query->joinWith('Authy', $join_behavior);

        return $this->getAuthyGroupxes($query, $con);
    }

    /**
     * Clears out the collClients collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addClients()
     */
    public function clearClients()
    {
        $this->collClients = null; // important to set this to null since that means it is uninitialized
        $this->collClientsPartial = null;

        return $this;
    }

    /**
     * reset is the collClients collection loaded partially
     *
     * @return void
     */
    public function resetPartialClients($v = true)
    {
        $this->collClientsPartial = $v;
    }

    /**
     * Initializes the collClients collection.
     *
     * By default this just sets the collClients collection to an empty array (like clearcollClients());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initClients($overrideExisting = true)
    {
        if (null !== $this->collClients && !$overrideExisting) {
            return;
        }
        $this->collClients = new PropelObjectCollection();
        $this->collClients->setModel('Client');
    }

    /**
     * Gets an array of Client objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Client[] List of Client objects
     * @throws PropelException
     */
    public function getClients($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collClientsPartial && !$this->isNew();
        if (null === $this->collClients || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collClients) {
                // return empty collection
                $this->initClients();
            } else {
                $collClients = ClientQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collClientsPartial && count($collClients)) {
                      $this->initClients(false);

                      foreach ($collClients as $obj) {
                        if (false == $this->collClients->contains($obj)) {
                          $this->collClients->append($obj);
                        }
                      }

                      $this->collClientsPartial = true;
                    }

                    $collClients->getInternalIterator()->rewind();

                    return $collClients;
                }

                if ($partial && $this->collClients) {
                    foreach ($this->collClients as $obj) {
                        if ($obj->isNew()) {
                            $collClients[] = $obj;
                        }
                    }
                }

                $this->collClients = $collClients;
                $this->collClientsPartial = false;
            }
        }

        return $this->collClients;
    }

    /**
     * Sets a collection of Client objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $clients A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setClients(PropelCollection $clients, PropelPDO $con = null)
    {
        $clientsToDelete = $this->getClients(new Criteria(), $con)->diff($clients);


        $this->clientsScheduledForDeletion = $clientsToDelete;

        foreach ($clientsToDelete as $clientRemoved) {
            $clientRemoved->setAuthyGroup(null);
        }

        $this->collClients = null;
        foreach ($clients as $client) {
            $this->addClient($client);
        }

        $this->collClients = $clients;
        $this->collClientsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Client objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Client objects.
     * @throws PropelException
     */
    public function countClients(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collClientsPartial && !$this->isNew();
        if (null === $this->collClients || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collClients) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getClients());
            }
            $query = ClientQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collClients);
    }

    /**
     * Method called to associate a Client object to this object
     * through the Client foreign key attribute.
     *
     * @param    Client $l Client
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addClient(Client $l)
    {
        if ($this->collClients === null) {
            $this->initClients();
            $this->collClientsPartial = true;
        }

        if (!in_array($l, $this->collClients->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddClient($l);

            if ($this->clientsScheduledForDeletion and $this->clientsScheduledForDeletion->contains($l)) {
                $this->clientsScheduledForDeletion->remove($this->clientsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Client $client The client object to add.
     */
    protected function doAddClient($client)
    {
        $this->collClients[]= $client;
        $client->setAuthyGroup($this);
    }

    /**
     * @param	Client $client The client object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeClient($client)
    {
        if ($this->getClients()->contains($client)) {
            $this->collClients->remove($this->collClients->search($client));
            if (null === $this->clientsScheduledForDeletion) {
                $this->clientsScheduledForDeletion = clone $this->collClients;
                $this->clientsScheduledForDeletion->clear();
            }
            $this->clientsScheduledForDeletion[]= $client;
            $client->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('Country', $join_behavior);

        return $this->getClients($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getClients($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getClients($query, $con);
    }

    /**
     * Clears out the collBillings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
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
     * If this AuthyGroup is new, it will return
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
                    ->filterByAuthyGroup($this)
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
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setBillings(PropelCollection $billings, PropelPDO $con = null)
    {
        $billingsToDelete = $this->getBillings(new Criteria(), $con)->diff($billings);


        $this->billingsScheduledForDeletion = $billingsToDelete;

        foreach ($billingsToDelete as $billingRemoved) {
            $billingRemoved->setAuthyGroup(null);
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
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collBillings);
    }

    /**
     * Method called to associate a Billing object to this object
     * through the Billing foreign key attribute.
     *
     * @param    Billing $l Billing
     * @return AuthyGroup The current object (for fluent API support)
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
        $billing->setAuthyGroup($this);
    }

    /**
     * @param	Billing $billing The billing object to remove.
     * @return AuthyGroup The current object (for fluent API support)
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
            $billing->setAuthyGroup(null);
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
    public function getBillingsJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

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
     * @return AuthyGroup The current object (for fluent API support)
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
     * If this AuthyGroup is new, it will return
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
                    ->filterByAuthyGroup($this)
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
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setBillingLines(PropelCollection $billingLines, PropelPDO $con = null)
    {
        $billingLinesToDelete = $this->getBillingLines(new Criteria(), $con)->diff($billingLines);


        $this->billingLinesScheduledForDeletion = $billingLinesToDelete;

        foreach ($billingLinesToDelete as $billingLineRemoved) {
            $billingLineRemoved->setAuthyGroup(null);
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
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collBillingLines);
    }

    /**
     * Method called to associate a BillingLine object to this object
     * through the BillingLine foreign key attribute.
     *
     * @param    BillingLine $l BillingLine
     * @return AuthyGroup The current object (for fluent API support)
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
        $billingLine->setAuthyGroup($this);
    }

    /**
     * @param	BillingLine $billingLine The billingLine object to remove.
     * @return AuthyGroup The current object (for fluent API support)
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
            $billingLine->setAuthyGroup(null);
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
    public function getBillingLinesJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

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
     * Clears out the collPaymentLines collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addPaymentLines()
     */
    public function clearPaymentLines()
    {
        $this->collPaymentLines = null; // important to set this to null since that means it is uninitialized
        $this->collPaymentLinesPartial = null;

        return $this;
    }

    /**
     * reset is the collPaymentLines collection loaded partially
     *
     * @return void
     */
    public function resetPartialPaymentLines($v = true)
    {
        $this->collPaymentLinesPartial = $v;
    }

    /**
     * Initializes the collPaymentLines collection.
     *
     * By default this just sets the collPaymentLines collection to an empty array (like clearcollPaymentLines());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPaymentLines($overrideExisting = true)
    {
        if (null !== $this->collPaymentLines && !$overrideExisting) {
            return;
        }
        $this->collPaymentLines = new PropelObjectCollection();
        $this->collPaymentLines->setModel('PaymentLine');
    }

    /**
     * Gets an array of PaymentLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PaymentLine[] List of PaymentLine objects
     * @throws PropelException
     */
    public function getPaymentLines($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPaymentLinesPartial && !$this->isNew();
        if (null === $this->collPaymentLines || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPaymentLines) {
                // return empty collection
                $this->initPaymentLines();
            } else {
                $collPaymentLines = PaymentLineQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPaymentLinesPartial && count($collPaymentLines)) {
                      $this->initPaymentLines(false);

                      foreach ($collPaymentLines as $obj) {
                        if (false == $this->collPaymentLines->contains($obj)) {
                          $this->collPaymentLines->append($obj);
                        }
                      }

                      $this->collPaymentLinesPartial = true;
                    }

                    $collPaymentLines->getInternalIterator()->rewind();

                    return $collPaymentLines;
                }

                if ($partial && $this->collPaymentLines) {
                    foreach ($this->collPaymentLines as $obj) {
                        if ($obj->isNew()) {
                            $collPaymentLines[] = $obj;
                        }
                    }
                }

                $this->collPaymentLines = $collPaymentLines;
                $this->collPaymentLinesPartial = false;
            }
        }

        return $this->collPaymentLines;
    }

    /**
     * Sets a collection of PaymentLine objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $paymentLines A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setPaymentLines(PropelCollection $paymentLines, PropelPDO $con = null)
    {
        $paymentLinesToDelete = $this->getPaymentLines(new Criteria(), $con)->diff($paymentLines);


        $this->paymentLinesScheduledForDeletion = $paymentLinesToDelete;

        foreach ($paymentLinesToDelete as $paymentLineRemoved) {
            $paymentLineRemoved->setAuthyGroup(null);
        }

        $this->collPaymentLines = null;
        foreach ($paymentLines as $paymentLine) {
            $this->addPaymentLine($paymentLine);
        }

        $this->collPaymentLines = $paymentLines;
        $this->collPaymentLinesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PaymentLine objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PaymentLine objects.
     * @throws PropelException
     */
    public function countPaymentLines(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPaymentLinesPartial && !$this->isNew();
        if (null === $this->collPaymentLines || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPaymentLines) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPaymentLines());
            }
            $query = PaymentLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collPaymentLines);
    }

    /**
     * Method called to associate a PaymentLine object to this object
     * through the PaymentLine foreign key attribute.
     *
     * @param    PaymentLine $l PaymentLine
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addPaymentLine(PaymentLine $l)
    {
        if ($this->collPaymentLines === null) {
            $this->initPaymentLines();
            $this->collPaymentLinesPartial = true;
        }

        if (!in_array($l, $this->collPaymentLines->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPaymentLine($l);

            if ($this->paymentLinesScheduledForDeletion and $this->paymentLinesScheduledForDeletion->contains($l)) {
                $this->paymentLinesScheduledForDeletion->remove($this->paymentLinesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	PaymentLine $paymentLine The paymentLine object to add.
     */
    protected function doAddPaymentLine($paymentLine)
    {
        $this->collPaymentLines[]= $paymentLine;
        $paymentLine->setAuthyGroup($this);
    }

    /**
     * @param	PaymentLine $paymentLine The paymentLine object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removePaymentLine($paymentLine)
    {
        if ($this->getPaymentLines()->contains($paymentLine)) {
            $this->collPaymentLines->remove($this->collPaymentLines->search($paymentLine));
            if (null === $this->paymentLinesScheduledForDeletion) {
                $this->paymentLinesScheduledForDeletion = clone $this->collPaymentLines;
                $this->paymentLinesScheduledForDeletion->clear();
            }
            $this->paymentLinesScheduledForDeletion[]= $paymentLine;
            $paymentLine->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PaymentLine[] List of PaymentLine objects
     */
    public function getPaymentLinesJoinBilling($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PaymentLineQuery::create(null, $criteria);
        $query->joinWith('Billing', $join_behavior);

        return $this->getPaymentLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PaymentLine[] List of PaymentLine objects
     */
    public function getPaymentLinesJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PaymentLineQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getPaymentLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PaymentLine[] List of PaymentLine objects
     */
    public function getPaymentLinesJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PaymentLineQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getPaymentLines($query, $con);
    }

    /**
     * Clears out the collCostLines collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
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
     * If this AuthyGroup is new, it will return
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
                    ->filterByAuthyGroup($this)
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
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setCostLines(PropelCollection $costLines, PropelPDO $con = null)
    {
        $costLinesToDelete = $this->getCostLines(new Criteria(), $con)->diff($costLines);


        $this->costLinesScheduledForDeletion = $costLinesToDelete;

        foreach ($costLinesToDelete as $costLineRemoved) {
            $costLineRemoved->setAuthyGroup(null);
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
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collCostLines);
    }

    /**
     * Method called to associate a CostLine object to this object
     * through the CostLine foreign key attribute.
     *
     * @param    CostLine $l CostLine
     * @return AuthyGroup The current object (for fluent API support)
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
        $costLine->setAuthyGroup($this);
    }

    /**
     * @param	CostLine $costLine The costLine object to remove.
     * @return AuthyGroup The current object (for fluent API support)
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
            $costLine->setAuthyGroup(null);
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
    public function getCostLinesJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

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
     * Clears out the collProjects collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addProjects()
     */
    public function clearProjects()
    {
        $this->collProjects = null; // important to set this to null since that means it is uninitialized
        $this->collProjectsPartial = null;

        return $this;
    }

    /**
     * reset is the collProjects collection loaded partially
     *
     * @return void
     */
    public function resetPartialProjects($v = true)
    {
        $this->collProjectsPartial = $v;
    }

    /**
     * Initializes the collProjects collection.
     *
     * By default this just sets the collProjects collection to an empty array (like clearcollProjects());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjects($overrideExisting = true)
    {
        if (null !== $this->collProjects && !$overrideExisting) {
            return;
        }
        $this->collProjects = new PropelObjectCollection();
        $this->collProjects->setModel('Project');
    }

    /**
     * Gets an array of Project objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Project[] List of Project objects
     * @throws PropelException
     */
    public function getProjects($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProjectsPartial && !$this->isNew();
        if (null === $this->collProjects || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjects) {
                // return empty collection
                $this->initProjects();
            } else {
                $collProjects = ProjectQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProjectsPartial && count($collProjects)) {
                      $this->initProjects(false);

                      foreach ($collProjects as $obj) {
                        if (false == $this->collProjects->contains($obj)) {
                          $this->collProjects->append($obj);
                        }
                      }

                      $this->collProjectsPartial = true;
                    }

                    $collProjects->getInternalIterator()->rewind();

                    return $collProjects;
                }

                if ($partial && $this->collProjects) {
                    foreach ($this->collProjects as $obj) {
                        if ($obj->isNew()) {
                            $collProjects[] = $obj;
                        }
                    }
                }

                $this->collProjects = $collProjects;
                $this->collProjectsPartial = false;
            }
        }

        return $this->collProjects;
    }

    /**
     * Sets a collection of Project objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $projects A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setProjects(PropelCollection $projects, PropelPDO $con = null)
    {
        $projectsToDelete = $this->getProjects(new Criteria(), $con)->diff($projects);


        $this->projectsScheduledForDeletion = $projectsToDelete;

        foreach ($projectsToDelete as $projectRemoved) {
            $projectRemoved->setAuthyGroup(null);
        }

        $this->collProjects = null;
        foreach ($projects as $project) {
            $this->addProject($project);
        }

        $this->collProjects = $projects;
        $this->collProjectsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Project objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Project objects.
     * @throws PropelException
     */
    public function countProjects(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProjectsPartial && !$this->isNew();
        if (null === $this->collProjects || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjects) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProjects());
            }
            $query = ProjectQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collProjects);
    }

    /**
     * Method called to associate a Project object to this object
     * through the Project foreign key attribute.
     *
     * @param    Project $l Project
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addProject(Project $l)
    {
        if ($this->collProjects === null) {
            $this->initProjects();
            $this->collProjectsPartial = true;
        }

        if (!in_array($l, $this->collProjects->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProject($l);

            if ($this->projectsScheduledForDeletion and $this->projectsScheduledForDeletion->contains($l)) {
                $this->projectsScheduledForDeletion->remove($this->projectsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Project $project The project object to add.
     */
    protected function doAddProject($project)
    {
        $this->collProjects[]= $project;
        $project->setAuthyGroup($this);
    }

    /**
     * @param	Project $project The project object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeProject($project)
    {
        if ($this->getProjects()->contains($project)) {
            $this->collProjects->remove($this->collProjects->search($project));
            if (null === $this->projectsScheduledForDeletion) {
                $this->projectsScheduledForDeletion = clone $this->collProjects;
                $this->projectsScheduledForDeletion->clear();
            }
            $this->projectsScheduledForDeletion[]= $project;
            $project->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Project[] List of Project objects
     */
    public function getProjectsJoinClient($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectQuery::create(null, $criteria);
        $query->joinWith('Client', $join_behavior);

        return $this->getProjects($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Project[] List of Project objects
     */
    public function getProjectsJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getProjects($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Project[] List of Project objects
     */
    public function getProjectsJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getProjects($query, $con);
    }

    /**
     * Clears out the collTimeLines collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addTimeLines()
     */
    public function clearTimeLines()
    {
        $this->collTimeLines = null; // important to set this to null since that means it is uninitialized
        $this->collTimeLinesPartial = null;

        return $this;
    }

    /**
     * reset is the collTimeLines collection loaded partially
     *
     * @return void
     */
    public function resetPartialTimeLines($v = true)
    {
        $this->collTimeLinesPartial = $v;
    }

    /**
     * Initializes the collTimeLines collection.
     *
     * By default this just sets the collTimeLines collection to an empty array (like clearcollTimeLines());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTimeLines($overrideExisting = true)
    {
        if (null !== $this->collTimeLines && !$overrideExisting) {
            return;
        }
        $this->collTimeLines = new PropelObjectCollection();
        $this->collTimeLines->setModel('TimeLine');
    }

    /**
     * Gets an array of TimeLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TimeLine[] List of TimeLine objects
     * @throws PropelException
     */
    public function getTimeLines($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTimeLinesPartial && !$this->isNew();
        if (null === $this->collTimeLines || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTimeLines) {
                // return empty collection
                $this->initTimeLines();
            } else {
                $collTimeLines = TimeLineQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTimeLinesPartial && count($collTimeLines)) {
                      $this->initTimeLines(false);

                      foreach ($collTimeLines as $obj) {
                        if (false == $this->collTimeLines->contains($obj)) {
                          $this->collTimeLines->append($obj);
                        }
                      }

                      $this->collTimeLinesPartial = true;
                    }

                    $collTimeLines->getInternalIterator()->rewind();

                    return $collTimeLines;
                }

                if ($partial && $this->collTimeLines) {
                    foreach ($this->collTimeLines as $obj) {
                        if ($obj->isNew()) {
                            $collTimeLines[] = $obj;
                        }
                    }
                }

                $this->collTimeLines = $collTimeLines;
                $this->collTimeLinesPartial = false;
            }
        }

        return $this->collTimeLines;
    }

    /**
     * Sets a collection of TimeLine objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $timeLines A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setTimeLines(PropelCollection $timeLines, PropelPDO $con = null)
    {
        $timeLinesToDelete = $this->getTimeLines(new Criteria(), $con)->diff($timeLines);


        $this->timeLinesScheduledForDeletion = $timeLinesToDelete;

        foreach ($timeLinesToDelete as $timeLineRemoved) {
            $timeLineRemoved->setAuthyGroup(null);
        }

        $this->collTimeLines = null;
        foreach ($timeLines as $timeLine) {
            $this->addTimeLine($timeLine);
        }

        $this->collTimeLines = $timeLines;
        $this->collTimeLinesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TimeLine objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TimeLine objects.
     * @throws PropelException
     */
    public function countTimeLines(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTimeLinesPartial && !$this->isNew();
        if (null === $this->collTimeLines || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTimeLines) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTimeLines());
            }
            $query = TimeLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collTimeLines);
    }

    /**
     * Method called to associate a TimeLine object to this object
     * through the TimeLine foreign key attribute.
     *
     * @param    TimeLine $l TimeLine
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addTimeLine(TimeLine $l)
    {
        if ($this->collTimeLines === null) {
            $this->initTimeLines();
            $this->collTimeLinesPartial = true;
        }

        if (!in_array($l, $this->collTimeLines->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTimeLine($l);

            if ($this->timeLinesScheduledForDeletion and $this->timeLinesScheduledForDeletion->contains($l)) {
                $this->timeLinesScheduledForDeletion->remove($this->timeLinesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TimeLine $timeLine The timeLine object to add.
     */
    protected function doAddTimeLine($timeLine)
    {
        $this->collTimeLines[]= $timeLine;
        $timeLine->setAuthyGroup($this);
    }

    /**
     * @param	TimeLine $timeLine The timeLine object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeTimeLine($timeLine)
    {
        if ($this->getTimeLines()->contains($timeLine)) {
            $this->collTimeLines->remove($this->collTimeLines->search($timeLine));
            if (null === $this->timeLinesScheduledForDeletion) {
                $this->timeLinesScheduledForDeletion = clone $this->collTimeLines;
                $this->timeLinesScheduledForDeletion->clear();
            }
            $this->timeLinesScheduledForDeletion[]= $timeLine;
            $timeLine->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TimeLine[] List of TimeLine objects
     */
    public function getTimeLinesJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TimeLineQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getTimeLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TimeLine[] List of TimeLine objects
     */
    public function getTimeLinesJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TimeLineQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getTimeLines($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TimeLine[] List of TimeLine objects
     */
    public function getTimeLinesJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TimeLineQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getTimeLines($query, $con);
    }

    /**
     * Clears out the collBillingCategories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addBillingCategories()
     */
    public function clearBillingCategories()
    {
        $this->collBillingCategories = null; // important to set this to null since that means it is uninitialized
        $this->collBillingCategoriesPartial = null;

        return $this;
    }

    /**
     * reset is the collBillingCategories collection loaded partially
     *
     * @return void
     */
    public function resetPartialBillingCategories($v = true)
    {
        $this->collBillingCategoriesPartial = $v;
    }

    /**
     * Initializes the collBillingCategories collection.
     *
     * By default this just sets the collBillingCategories collection to an empty array (like clearcollBillingCategories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBillingCategories($overrideExisting = true)
    {
        if (null !== $this->collBillingCategories && !$overrideExisting) {
            return;
        }
        $this->collBillingCategories = new PropelObjectCollection();
        $this->collBillingCategories->setModel('BillingCategory');
    }

    /**
     * Gets an array of BillingCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BillingCategory[] List of BillingCategory objects
     * @throws PropelException
     */
    public function getBillingCategories($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBillingCategoriesPartial && !$this->isNew();
        if (null === $this->collBillingCategories || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBillingCategories) {
                // return empty collection
                $this->initBillingCategories();
            } else {
                $collBillingCategories = BillingCategoryQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBillingCategoriesPartial && count($collBillingCategories)) {
                      $this->initBillingCategories(false);

                      foreach ($collBillingCategories as $obj) {
                        if (false == $this->collBillingCategories->contains($obj)) {
                          $this->collBillingCategories->append($obj);
                        }
                      }

                      $this->collBillingCategoriesPartial = true;
                    }

                    $collBillingCategories->getInternalIterator()->rewind();

                    return $collBillingCategories;
                }

                if ($partial && $this->collBillingCategories) {
                    foreach ($this->collBillingCategories as $obj) {
                        if ($obj->isNew()) {
                            $collBillingCategories[] = $obj;
                        }
                    }
                }

                $this->collBillingCategories = $collBillingCategories;
                $this->collBillingCategoriesPartial = false;
            }
        }

        return $this->collBillingCategories;
    }

    /**
     * Sets a collection of BillingCategory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $billingCategories A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setBillingCategories(PropelCollection $billingCategories, PropelPDO $con = null)
    {
        $billingCategoriesToDelete = $this->getBillingCategories(new Criteria(), $con)->diff($billingCategories);


        $this->billingCategoriesScheduledForDeletion = $billingCategoriesToDelete;

        foreach ($billingCategoriesToDelete as $billingCategoryRemoved) {
            $billingCategoryRemoved->setAuthyGroup(null);
        }

        $this->collBillingCategories = null;
        foreach ($billingCategories as $billingCategory) {
            $this->addBillingCategory($billingCategory);
        }

        $this->collBillingCategories = $billingCategories;
        $this->collBillingCategoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BillingCategory objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BillingCategory objects.
     * @throws PropelException
     */
    public function countBillingCategories(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBillingCategoriesPartial && !$this->isNew();
        if (null === $this->collBillingCategories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBillingCategories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBillingCategories());
            }
            $query = BillingCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collBillingCategories);
    }

    /**
     * Method called to associate a BillingCategory object to this object
     * through the BillingCategory foreign key attribute.
     *
     * @param    BillingCategory $l BillingCategory
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addBillingCategory(BillingCategory $l)
    {
        if ($this->collBillingCategories === null) {
            $this->initBillingCategories();
            $this->collBillingCategoriesPartial = true;
        }

        if (!in_array($l, $this->collBillingCategories->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBillingCategory($l);

            if ($this->billingCategoriesScheduledForDeletion and $this->billingCategoriesScheduledForDeletion->contains($l)) {
                $this->billingCategoriesScheduledForDeletion->remove($this->billingCategoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	BillingCategory $billingCategory The billingCategory object to add.
     */
    protected function doAddBillingCategory($billingCategory)
    {
        $this->collBillingCategories[]= $billingCategory;
        $billingCategory->setAuthyGroup($this);
    }

    /**
     * @param	BillingCategory $billingCategory The billingCategory object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeBillingCategory($billingCategory)
    {
        if ($this->getBillingCategories()->contains($billingCategory)) {
            $this->collBillingCategories->remove($this->collBillingCategories->search($billingCategory));
            if (null === $this->billingCategoriesScheduledForDeletion) {
                $this->billingCategoriesScheduledForDeletion = clone $this->collBillingCategories;
                $this->billingCategoriesScheduledForDeletion->clear();
            }
            $this->billingCategoriesScheduledForDeletion[]= $billingCategory;
            $billingCategory->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingCategory[] List of BillingCategory objects
     */
    public function getBillingCategoriesJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingCategoryQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getBillingCategories($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingCategory[] List of BillingCategory objects
     */
    public function getBillingCategoriesJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingCategoryQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getBillingCategories($query, $con);
    }

    /**
     * Clears out the collSuppliers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addSuppliers()
     */
    public function clearSuppliers()
    {
        $this->collSuppliers = null; // important to set this to null since that means it is uninitialized
        $this->collSuppliersPartial = null;

        return $this;
    }

    /**
     * reset is the collSuppliers collection loaded partially
     *
     * @return void
     */
    public function resetPartialSuppliers($v = true)
    {
        $this->collSuppliersPartial = $v;
    }

    /**
     * Initializes the collSuppliers collection.
     *
     * By default this just sets the collSuppliers collection to an empty array (like clearcollSuppliers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSuppliers($overrideExisting = true)
    {
        if (null !== $this->collSuppliers && !$overrideExisting) {
            return;
        }
        $this->collSuppliers = new PropelObjectCollection();
        $this->collSuppliers->setModel('Supplier');
    }

    /**
     * Gets an array of Supplier objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Supplier[] List of Supplier objects
     * @throws PropelException
     */
    public function getSuppliers($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collSuppliersPartial && !$this->isNew();
        if (null === $this->collSuppliers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSuppliers) {
                // return empty collection
                $this->initSuppliers();
            } else {
                $collSuppliers = SupplierQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collSuppliersPartial && count($collSuppliers)) {
                      $this->initSuppliers(false);

                      foreach ($collSuppliers as $obj) {
                        if (false == $this->collSuppliers->contains($obj)) {
                          $this->collSuppliers->append($obj);
                        }
                      }

                      $this->collSuppliersPartial = true;
                    }

                    $collSuppliers->getInternalIterator()->rewind();

                    return $collSuppliers;
                }

                if ($partial && $this->collSuppliers) {
                    foreach ($this->collSuppliers as $obj) {
                        if ($obj->isNew()) {
                            $collSuppliers[] = $obj;
                        }
                    }
                }

                $this->collSuppliers = $collSuppliers;
                $this->collSuppliersPartial = false;
            }
        }

        return $this->collSuppliers;
    }

    /**
     * Sets a collection of Supplier objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $suppliers A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setSuppliers(PropelCollection $suppliers, PropelPDO $con = null)
    {
        $suppliersToDelete = $this->getSuppliers(new Criteria(), $con)->diff($suppliers);


        $this->suppliersScheduledForDeletion = $suppliersToDelete;

        foreach ($suppliersToDelete as $supplierRemoved) {
            $supplierRemoved->setAuthyGroup(null);
        }

        $this->collSuppliers = null;
        foreach ($suppliers as $supplier) {
            $this->addSupplier($supplier);
        }

        $this->collSuppliers = $suppliers;
        $this->collSuppliersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Supplier objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Supplier objects.
     * @throws PropelException
     */
    public function countSuppliers(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collSuppliersPartial && !$this->isNew();
        if (null === $this->collSuppliers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSuppliers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSuppliers());
            }
            $query = SupplierQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collSuppliers);
    }

    /**
     * Method called to associate a Supplier object to this object
     * through the Supplier foreign key attribute.
     *
     * @param    Supplier $l Supplier
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addSupplier(Supplier $l)
    {
        if ($this->collSuppliers === null) {
            $this->initSuppliers();
            $this->collSuppliersPartial = true;
        }

        if (!in_array($l, $this->collSuppliers->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddSupplier($l);

            if ($this->suppliersScheduledForDeletion and $this->suppliersScheduledForDeletion->contains($l)) {
                $this->suppliersScheduledForDeletion->remove($this->suppliersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Supplier $supplier The supplier object to add.
     */
    protected function doAddSupplier($supplier)
    {
        $this->collSuppliers[]= $supplier;
        $supplier->setAuthyGroup($this);
    }

    /**
     * @param	Supplier $supplier The supplier object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeSupplier($supplier)
    {
        if ($this->getSuppliers()->contains($supplier)) {
            $this->collSuppliers->remove($this->collSuppliers->search($supplier));
            if (null === $this->suppliersScheduledForDeletion) {
                $this->suppliersScheduledForDeletion = clone $this->collSuppliers;
                $this->suppliersScheduledForDeletion->clear();
            }
            $this->suppliersScheduledForDeletion[]= $supplier;
            $supplier->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Supplier[] List of Supplier objects
     */
    public function getSuppliersJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SupplierQuery::create(null, $criteria);
        $query->joinWith('Country', $join_behavior);

        return $this->getSuppliers($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Supplier[] List of Supplier objects
     */
    public function getSuppliersJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SupplierQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getSuppliers($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Supplier[] List of Supplier objects
     */
    public function getSuppliersJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SupplierQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getSuppliers($query, $con);
    }

    /**
     * Clears out the collAuthiesRelatedByIdAuthyGroup collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addAuthiesRelatedByIdAuthyGroup()
     */
    public function clearAuthiesRelatedByIdAuthyGroup()
    {
        $this->collAuthiesRelatedByIdAuthyGroup = null; // important to set this to null since that means it is uninitialized
        $this->collAuthiesRelatedByIdAuthyGroupPartial = null;

        return $this;
    }

    /**
     * reset is the collAuthiesRelatedByIdAuthyGroup collection loaded partially
     *
     * @return void
     */
    public function resetPartialAuthiesRelatedByIdAuthyGroup($v = true)
    {
        $this->collAuthiesRelatedByIdAuthyGroupPartial = $v;
    }

    /**
     * Initializes the collAuthiesRelatedByIdAuthyGroup collection.
     *
     * By default this just sets the collAuthiesRelatedByIdAuthyGroup collection to an empty array (like clearcollAuthiesRelatedByIdAuthyGroup());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuthiesRelatedByIdAuthyGroup($overrideExisting = true)
    {
        if (null !== $this->collAuthiesRelatedByIdAuthyGroup && !$overrideExisting) {
            return;
        }
        $this->collAuthiesRelatedByIdAuthyGroup = new PropelObjectCollection();
        $this->collAuthiesRelatedByIdAuthyGroup->setModel('Authy');
    }

    /**
     * Gets an array of Authy objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Authy[] List of Authy objects
     * @throws PropelException
     */
    public function getAuthiesRelatedByIdAuthyGroup($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAuthiesRelatedByIdAuthyGroupPartial && !$this->isNew();
        if (null === $this->collAuthiesRelatedByIdAuthyGroup || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAuthiesRelatedByIdAuthyGroup) {
                // return empty collection
                $this->initAuthiesRelatedByIdAuthyGroup();
            } else {
                $collAuthiesRelatedByIdAuthyGroup = AuthyQuery::create(null, $criteria)
                    ->filterByAuthyGroupRelatedByIdAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAuthiesRelatedByIdAuthyGroupPartial && count($collAuthiesRelatedByIdAuthyGroup)) {
                      $this->initAuthiesRelatedByIdAuthyGroup(false);

                      foreach ($collAuthiesRelatedByIdAuthyGroup as $obj) {
                        if (false == $this->collAuthiesRelatedByIdAuthyGroup->contains($obj)) {
                          $this->collAuthiesRelatedByIdAuthyGroup->append($obj);
                        }
                      }

                      $this->collAuthiesRelatedByIdAuthyGroupPartial = true;
                    }

                    $collAuthiesRelatedByIdAuthyGroup->getInternalIterator()->rewind();

                    return $collAuthiesRelatedByIdAuthyGroup;
                }

                if ($partial && $this->collAuthiesRelatedByIdAuthyGroup) {
                    foreach ($this->collAuthiesRelatedByIdAuthyGroup as $obj) {
                        if ($obj->isNew()) {
                            $collAuthiesRelatedByIdAuthyGroup[] = $obj;
                        }
                    }
                }

                $this->collAuthiesRelatedByIdAuthyGroup = $collAuthiesRelatedByIdAuthyGroup;
                $this->collAuthiesRelatedByIdAuthyGroupPartial = false;
            }
        }

        return $this->collAuthiesRelatedByIdAuthyGroup;
    }

    /**
     * Sets a collection of AuthyRelatedByIdAuthyGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $authiesRelatedByIdAuthyGroup A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setAuthiesRelatedByIdAuthyGroup(PropelCollection $authiesRelatedByIdAuthyGroup, PropelPDO $con = null)
    {
        $authiesRelatedByIdAuthyGroupToDelete = $this->getAuthiesRelatedByIdAuthyGroup(new Criteria(), $con)->diff($authiesRelatedByIdAuthyGroup);


        $this->authiesRelatedByIdAuthyGroupScheduledForDeletion = $authiesRelatedByIdAuthyGroupToDelete;

        foreach ($authiesRelatedByIdAuthyGroupToDelete as $authyRelatedByIdAuthyGroupRemoved) {
            $authyRelatedByIdAuthyGroupRemoved->setAuthyGroupRelatedByIdAuthyGroup(null);
        }

        $this->collAuthiesRelatedByIdAuthyGroup = null;
        foreach ($authiesRelatedByIdAuthyGroup as $authyRelatedByIdAuthyGroup) {
            $this->addAuthyRelatedByIdAuthyGroup($authyRelatedByIdAuthyGroup);
        }

        $this->collAuthiesRelatedByIdAuthyGroup = $authiesRelatedByIdAuthyGroup;
        $this->collAuthiesRelatedByIdAuthyGroupPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Authy objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Authy objects.
     * @throws PropelException
     */
    public function countAuthiesRelatedByIdAuthyGroup(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAuthiesRelatedByIdAuthyGroupPartial && !$this->isNew();
        if (null === $this->collAuthiesRelatedByIdAuthyGroup || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuthiesRelatedByIdAuthyGroup) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuthiesRelatedByIdAuthyGroup());
            }
            $query = AuthyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroupRelatedByIdAuthyGroup($this)
                ->count($con);
        }

        return count($this->collAuthiesRelatedByIdAuthyGroup);
    }

    /**
     * Method called to associate a Authy object to this object
     * through the Authy foreign key attribute.
     *
     * @param    Authy $l Authy
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addAuthyRelatedByIdAuthyGroup(Authy $l)
    {
        if ($this->collAuthiesRelatedByIdAuthyGroup === null) {
            $this->initAuthiesRelatedByIdAuthyGroup();
            $this->collAuthiesRelatedByIdAuthyGroupPartial = true;
        }

        if (!in_array($l, $this->collAuthiesRelatedByIdAuthyGroup->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAuthyRelatedByIdAuthyGroup($l);

            if ($this->authiesRelatedByIdAuthyGroupScheduledForDeletion and $this->authiesRelatedByIdAuthyGroupScheduledForDeletion->contains($l)) {
                $this->authiesRelatedByIdAuthyGroupScheduledForDeletion->remove($this->authiesRelatedByIdAuthyGroupScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	AuthyRelatedByIdAuthyGroup $authyRelatedByIdAuthyGroup The authyRelatedByIdAuthyGroup object to add.
     */
    protected function doAddAuthyRelatedByIdAuthyGroup($authyRelatedByIdAuthyGroup)
    {
        $this->collAuthiesRelatedByIdAuthyGroup[]= $authyRelatedByIdAuthyGroup;
        $authyRelatedByIdAuthyGroup->setAuthyGroupRelatedByIdAuthyGroup($this);
    }

    /**
     * @param	AuthyRelatedByIdAuthyGroup $authyRelatedByIdAuthyGroup The authyRelatedByIdAuthyGroup object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeAuthyRelatedByIdAuthyGroup($authyRelatedByIdAuthyGroup)
    {
        if ($this->getAuthiesRelatedByIdAuthyGroup()->contains($authyRelatedByIdAuthyGroup)) {
            $this->collAuthiesRelatedByIdAuthyGroup->remove($this->collAuthiesRelatedByIdAuthyGroup->search($authyRelatedByIdAuthyGroup));
            if (null === $this->authiesRelatedByIdAuthyGroupScheduledForDeletion) {
                $this->authiesRelatedByIdAuthyGroupScheduledForDeletion = clone $this->collAuthiesRelatedByIdAuthyGroup;
                $this->authiesRelatedByIdAuthyGroupScheduledForDeletion->clear();
            }
            $this->authiesRelatedByIdAuthyGroupScheduledForDeletion[]= clone $authyRelatedByIdAuthyGroup;
            $authyRelatedByIdAuthyGroup->setAuthyGroupRelatedByIdAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Authy[] List of Authy objects
     */
    public function getAuthiesRelatedByIdAuthyGroupJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getAuthiesRelatedByIdAuthyGroup($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Authy[] List of Authy objects
     */
    public function getAuthiesRelatedByIdAuthyGroupJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getAuthiesRelatedByIdAuthyGroup($query, $con);
    }

    /**
     * Clears out the collAuthiesRelatedByIdGroupCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addAuthiesRelatedByIdGroupCreation()
     */
    public function clearAuthiesRelatedByIdGroupCreation()
    {
        $this->collAuthiesRelatedByIdGroupCreation = null; // important to set this to null since that means it is uninitialized
        $this->collAuthiesRelatedByIdGroupCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collAuthiesRelatedByIdGroupCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialAuthiesRelatedByIdGroupCreation($v = true)
    {
        $this->collAuthiesRelatedByIdGroupCreationPartial = $v;
    }

    /**
     * Initializes the collAuthiesRelatedByIdGroupCreation collection.
     *
     * By default this just sets the collAuthiesRelatedByIdGroupCreation collection to an empty array (like clearcollAuthiesRelatedByIdGroupCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuthiesRelatedByIdGroupCreation($overrideExisting = true)
    {
        if (null !== $this->collAuthiesRelatedByIdGroupCreation && !$overrideExisting) {
            return;
        }
        $this->collAuthiesRelatedByIdGroupCreation = new PropelObjectCollection();
        $this->collAuthiesRelatedByIdGroupCreation->setModel('Authy');
    }

    /**
     * Gets an array of Authy objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Authy[] List of Authy objects
     * @throws PropelException
     */
    public function getAuthiesRelatedByIdGroupCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAuthiesRelatedByIdGroupCreationPartial && !$this->isNew();
        if (null === $this->collAuthiesRelatedByIdGroupCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAuthiesRelatedByIdGroupCreation) {
                // return empty collection
                $this->initAuthiesRelatedByIdGroupCreation();
            } else {
                $collAuthiesRelatedByIdGroupCreation = AuthyQuery::create(null, $criteria)
                    ->filterByAuthyGroupRelatedByIdGroupCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAuthiesRelatedByIdGroupCreationPartial && count($collAuthiesRelatedByIdGroupCreation)) {
                      $this->initAuthiesRelatedByIdGroupCreation(false);

                      foreach ($collAuthiesRelatedByIdGroupCreation as $obj) {
                        if (false == $this->collAuthiesRelatedByIdGroupCreation->contains($obj)) {
                          $this->collAuthiesRelatedByIdGroupCreation->append($obj);
                        }
                      }

                      $this->collAuthiesRelatedByIdGroupCreationPartial = true;
                    }

                    $collAuthiesRelatedByIdGroupCreation->getInternalIterator()->rewind();

                    return $collAuthiesRelatedByIdGroupCreation;
                }

                if ($partial && $this->collAuthiesRelatedByIdGroupCreation) {
                    foreach ($this->collAuthiesRelatedByIdGroupCreation as $obj) {
                        if ($obj->isNew()) {
                            $collAuthiesRelatedByIdGroupCreation[] = $obj;
                        }
                    }
                }

                $this->collAuthiesRelatedByIdGroupCreation = $collAuthiesRelatedByIdGroupCreation;
                $this->collAuthiesRelatedByIdGroupCreationPartial = false;
            }
        }

        return $this->collAuthiesRelatedByIdGroupCreation;
    }

    /**
     * Sets a collection of AuthyRelatedByIdGroupCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $authiesRelatedByIdGroupCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setAuthiesRelatedByIdGroupCreation(PropelCollection $authiesRelatedByIdGroupCreation, PropelPDO $con = null)
    {
        $authiesRelatedByIdGroupCreationToDelete = $this->getAuthiesRelatedByIdGroupCreation(new Criteria(), $con)->diff($authiesRelatedByIdGroupCreation);


        $this->authiesRelatedByIdGroupCreationScheduledForDeletion = $authiesRelatedByIdGroupCreationToDelete;

        foreach ($authiesRelatedByIdGroupCreationToDelete as $authyRelatedByIdGroupCreationRemoved) {
            $authyRelatedByIdGroupCreationRemoved->setAuthyGroupRelatedByIdGroupCreation(null);
        }

        $this->collAuthiesRelatedByIdGroupCreation = null;
        foreach ($authiesRelatedByIdGroupCreation as $authyRelatedByIdGroupCreation) {
            $this->addAuthyRelatedByIdGroupCreation($authyRelatedByIdGroupCreation);
        }

        $this->collAuthiesRelatedByIdGroupCreation = $authiesRelatedByIdGroupCreation;
        $this->collAuthiesRelatedByIdGroupCreationPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Authy objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Authy objects.
     * @throws PropelException
     */
    public function countAuthiesRelatedByIdGroupCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAuthiesRelatedByIdGroupCreationPartial && !$this->isNew();
        if (null === $this->collAuthiesRelatedByIdGroupCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuthiesRelatedByIdGroupCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuthiesRelatedByIdGroupCreation());
            }
            $query = AuthyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroupRelatedByIdGroupCreation($this)
                ->count($con);
        }

        return count($this->collAuthiesRelatedByIdGroupCreation);
    }

    /**
     * Method called to associate a Authy object to this object
     * through the Authy foreign key attribute.
     *
     * @param    Authy $l Authy
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addAuthyRelatedByIdGroupCreation(Authy $l)
    {
        if ($this->collAuthiesRelatedByIdGroupCreation === null) {
            $this->initAuthiesRelatedByIdGroupCreation();
            $this->collAuthiesRelatedByIdGroupCreationPartial = true;
        }

        if (!in_array($l, $this->collAuthiesRelatedByIdGroupCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAuthyRelatedByIdGroupCreation($l);

            if ($this->authiesRelatedByIdGroupCreationScheduledForDeletion and $this->authiesRelatedByIdGroupCreationScheduledForDeletion->contains($l)) {
                $this->authiesRelatedByIdGroupCreationScheduledForDeletion->remove($this->authiesRelatedByIdGroupCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	AuthyRelatedByIdGroupCreation $authyRelatedByIdGroupCreation The authyRelatedByIdGroupCreation object to add.
     */
    protected function doAddAuthyRelatedByIdGroupCreation($authyRelatedByIdGroupCreation)
    {
        $this->collAuthiesRelatedByIdGroupCreation[]= $authyRelatedByIdGroupCreation;
        $authyRelatedByIdGroupCreation->setAuthyGroupRelatedByIdGroupCreation($this);
    }

    /**
     * @param	AuthyRelatedByIdGroupCreation $authyRelatedByIdGroupCreation The authyRelatedByIdGroupCreation object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeAuthyRelatedByIdGroupCreation($authyRelatedByIdGroupCreation)
    {
        if ($this->getAuthiesRelatedByIdGroupCreation()->contains($authyRelatedByIdGroupCreation)) {
            $this->collAuthiesRelatedByIdGroupCreation->remove($this->collAuthiesRelatedByIdGroupCreation->search($authyRelatedByIdGroupCreation));
            if (null === $this->authiesRelatedByIdGroupCreationScheduledForDeletion) {
                $this->authiesRelatedByIdGroupCreationScheduledForDeletion = clone $this->collAuthiesRelatedByIdGroupCreation;
                $this->authiesRelatedByIdGroupCreationScheduledForDeletion->clear();
            }
            $this->authiesRelatedByIdGroupCreationScheduledForDeletion[]= $authyRelatedByIdGroupCreation;
            $authyRelatedByIdGroupCreation->setAuthyGroupRelatedByIdGroupCreation(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Authy[] List of Authy objects
     */
    public function getAuthiesRelatedByIdGroupCreationJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getAuthiesRelatedByIdGroupCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Authy[] List of Authy objects
     */
    public function getAuthiesRelatedByIdGroupCreationJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getAuthiesRelatedByIdGroupCreation($query, $con);
    }

    /**
     * Clears out the collCountries collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addCountries()
     */
    public function clearCountries()
    {
        $this->collCountries = null; // important to set this to null since that means it is uninitialized
        $this->collCountriesPartial = null;

        return $this;
    }

    /**
     * reset is the collCountries collection loaded partially
     *
     * @return void
     */
    public function resetPartialCountries($v = true)
    {
        $this->collCountriesPartial = $v;
    }

    /**
     * Initializes the collCountries collection.
     *
     * By default this just sets the collCountries collection to an empty array (like clearcollCountries());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCountries($overrideExisting = true)
    {
        if (null !== $this->collCountries && !$overrideExisting) {
            return;
        }
        $this->collCountries = new PropelObjectCollection();
        $this->collCountries->setModel('Country');
    }

    /**
     * Gets an array of Country objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Country[] List of Country objects
     * @throws PropelException
     */
    public function getCountries($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCountriesPartial && !$this->isNew();
        if (null === $this->collCountries || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCountries) {
                // return empty collection
                $this->initCountries();
            } else {
                $collCountries = CountryQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCountriesPartial && count($collCountries)) {
                      $this->initCountries(false);

                      foreach ($collCountries as $obj) {
                        if (false == $this->collCountries->contains($obj)) {
                          $this->collCountries->append($obj);
                        }
                      }

                      $this->collCountriesPartial = true;
                    }

                    $collCountries->getInternalIterator()->rewind();

                    return $collCountries;
                }

                if ($partial && $this->collCountries) {
                    foreach ($this->collCountries as $obj) {
                        if ($obj->isNew()) {
                            $collCountries[] = $obj;
                        }
                    }
                }

                $this->collCountries = $collCountries;
                $this->collCountriesPartial = false;
            }
        }

        return $this->collCountries;
    }

    /**
     * Sets a collection of Country objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $countries A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setCountries(PropelCollection $countries, PropelPDO $con = null)
    {
        $countriesToDelete = $this->getCountries(new Criteria(), $con)->diff($countries);


        $this->countriesScheduledForDeletion = $countriesToDelete;

        foreach ($countriesToDelete as $countryRemoved) {
            $countryRemoved->setAuthyGroup(null);
        }

        $this->collCountries = null;
        foreach ($countries as $country) {
            $this->addCountry($country);
        }

        $this->collCountries = $countries;
        $this->collCountriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Country objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Country objects.
     * @throws PropelException
     */
    public function countCountries(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCountriesPartial && !$this->isNew();
        if (null === $this->collCountries || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCountries) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCountries());
            }
            $query = CountryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collCountries);
    }

    /**
     * Method called to associate a Country object to this object
     * through the Country foreign key attribute.
     *
     * @param    Country $l Country
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addCountry(Country $l)
    {
        if ($this->collCountries === null) {
            $this->initCountries();
            $this->collCountriesPartial = true;
        }

        if (!in_array($l, $this->collCountries->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCountry($l);

            if ($this->countriesScheduledForDeletion and $this->countriesScheduledForDeletion->contains($l)) {
                $this->countriesScheduledForDeletion->remove($this->countriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Country $country The country object to add.
     */
    protected function doAddCountry($country)
    {
        $this->collCountries[]= $country;
        $country->setAuthyGroup($this);
    }

    /**
     * @param	Country $country The country object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeCountry($country)
    {
        if ($this->getCountries()->contains($country)) {
            $this->collCountries->remove($this->collCountries->search($country));
            if (null === $this->countriesScheduledForDeletion) {
                $this->countriesScheduledForDeletion = clone $this->collCountries;
                $this->countriesScheduledForDeletion->clear();
            }
            $this->countriesScheduledForDeletion[]= $country;
            $country->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Country[] List of Country objects
     */
    public function getCountriesJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CountryQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getCountries($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Country[] List of Country objects
     */
    public function getCountriesJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CountryQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getCountries($query, $con);
    }

    /**
     * Clears out the collAuthyGroupsRelatedByIdAuthyGroup collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addAuthyGroupsRelatedByIdAuthyGroup()
     */
    public function clearAuthyGroupsRelatedByIdAuthyGroup()
    {
        $this->collAuthyGroupsRelatedByIdAuthyGroup = null; // important to set this to null since that means it is uninitialized
        $this->collAuthyGroupsRelatedByIdAuthyGroupPartial = null;

        return $this;
    }

    /**
     * reset is the collAuthyGroupsRelatedByIdAuthyGroup collection loaded partially
     *
     * @return void
     */
    public function resetPartialAuthyGroupsRelatedByIdAuthyGroup($v = true)
    {
        $this->collAuthyGroupsRelatedByIdAuthyGroupPartial = $v;
    }

    /**
     * Initializes the collAuthyGroupsRelatedByIdAuthyGroup collection.
     *
     * By default this just sets the collAuthyGroupsRelatedByIdAuthyGroup collection to an empty array (like clearcollAuthyGroupsRelatedByIdAuthyGroup());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuthyGroupsRelatedByIdAuthyGroup($overrideExisting = true)
    {
        if (null !== $this->collAuthyGroupsRelatedByIdAuthyGroup && !$overrideExisting) {
            return;
        }
        $this->collAuthyGroupsRelatedByIdAuthyGroup = new PropelObjectCollection();
        $this->collAuthyGroupsRelatedByIdAuthyGroup->setModel('AuthyGroup');
    }

    /**
     * Gets an array of AuthyGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|AuthyGroup[] List of AuthyGroup objects
     * @throws PropelException
     */
    public function getAuthyGroupsRelatedByIdAuthyGroup($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAuthyGroupsRelatedByIdAuthyGroupPartial && !$this->isNew();
        if (null === $this->collAuthyGroupsRelatedByIdAuthyGroup || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAuthyGroupsRelatedByIdAuthyGroup) {
                // return empty collection
                $this->initAuthyGroupsRelatedByIdAuthyGroup();
            } else {
                $collAuthyGroupsRelatedByIdAuthyGroup = AuthyGroupQuery::create(null, $criteria)
                    ->filterByAuthyGroupRelatedByIdGroupCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAuthyGroupsRelatedByIdAuthyGroupPartial && count($collAuthyGroupsRelatedByIdAuthyGroup)) {
                      $this->initAuthyGroupsRelatedByIdAuthyGroup(false);

                      foreach ($collAuthyGroupsRelatedByIdAuthyGroup as $obj) {
                        if (false == $this->collAuthyGroupsRelatedByIdAuthyGroup->contains($obj)) {
                          $this->collAuthyGroupsRelatedByIdAuthyGroup->append($obj);
                        }
                      }

                      $this->collAuthyGroupsRelatedByIdAuthyGroupPartial = true;
                    }

                    $collAuthyGroupsRelatedByIdAuthyGroup->getInternalIterator()->rewind();

                    return $collAuthyGroupsRelatedByIdAuthyGroup;
                }

                if ($partial && $this->collAuthyGroupsRelatedByIdAuthyGroup) {
                    foreach ($this->collAuthyGroupsRelatedByIdAuthyGroup as $obj) {
                        if ($obj->isNew()) {
                            $collAuthyGroupsRelatedByIdAuthyGroup[] = $obj;
                        }
                    }
                }

                $this->collAuthyGroupsRelatedByIdAuthyGroup = $collAuthyGroupsRelatedByIdAuthyGroup;
                $this->collAuthyGroupsRelatedByIdAuthyGroupPartial = false;
            }
        }

        return $this->collAuthyGroupsRelatedByIdAuthyGroup;
    }

    /**
     * Sets a collection of AuthyGroupRelatedByIdAuthyGroup objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $authyGroupsRelatedByIdAuthyGroup A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setAuthyGroupsRelatedByIdAuthyGroup(PropelCollection $authyGroupsRelatedByIdAuthyGroup, PropelPDO $con = null)
    {
        $authyGroupsRelatedByIdAuthyGroupToDelete = $this->getAuthyGroupsRelatedByIdAuthyGroup(new Criteria(), $con)->diff($authyGroupsRelatedByIdAuthyGroup);


        $this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion = $authyGroupsRelatedByIdAuthyGroupToDelete;

        foreach ($authyGroupsRelatedByIdAuthyGroupToDelete as $authyGroupRelatedByIdAuthyGroupRemoved) {
            $authyGroupRelatedByIdAuthyGroupRemoved->setAuthyGroupRelatedByIdGroupCreation(null);
        }

        $this->collAuthyGroupsRelatedByIdAuthyGroup = null;
        foreach ($authyGroupsRelatedByIdAuthyGroup as $authyGroupRelatedByIdAuthyGroup) {
            $this->addAuthyGroupRelatedByIdAuthyGroup($authyGroupRelatedByIdAuthyGroup);
        }

        $this->collAuthyGroupsRelatedByIdAuthyGroup = $authyGroupsRelatedByIdAuthyGroup;
        $this->collAuthyGroupsRelatedByIdAuthyGroupPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AuthyGroup objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related AuthyGroup objects.
     * @throws PropelException
     */
    public function countAuthyGroupsRelatedByIdAuthyGroup(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAuthyGroupsRelatedByIdAuthyGroupPartial && !$this->isNew();
        if (null === $this->collAuthyGroupsRelatedByIdAuthyGroup || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuthyGroupsRelatedByIdAuthyGroup) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuthyGroupsRelatedByIdAuthyGroup());
            }
            $query = AuthyGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroupRelatedByIdGroupCreation($this)
                ->count($con);
        }

        return count($this->collAuthyGroupsRelatedByIdAuthyGroup);
    }

    /**
     * Method called to associate a AuthyGroup object to this object
     * through the AuthyGroup foreign key attribute.
     *
     * @param    AuthyGroup $l AuthyGroup
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addAuthyGroupRelatedByIdAuthyGroup(AuthyGroup $l)
    {
        if ($this->collAuthyGroupsRelatedByIdAuthyGroup === null) {
            $this->initAuthyGroupsRelatedByIdAuthyGroup();
            $this->collAuthyGroupsRelatedByIdAuthyGroupPartial = true;
        }

        if (!in_array($l, $this->collAuthyGroupsRelatedByIdAuthyGroup->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAuthyGroupRelatedByIdAuthyGroup($l);

            if ($this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion and $this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion->contains($l)) {
                $this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion->remove($this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	AuthyGroupRelatedByIdAuthyGroup $authyGroupRelatedByIdAuthyGroup The authyGroupRelatedByIdAuthyGroup object to add.
     */
    protected function doAddAuthyGroupRelatedByIdAuthyGroup($authyGroupRelatedByIdAuthyGroup)
    {
        $this->collAuthyGroupsRelatedByIdAuthyGroup[]= $authyGroupRelatedByIdAuthyGroup;
        $authyGroupRelatedByIdAuthyGroup->setAuthyGroupRelatedByIdGroupCreation($this);
    }

    /**
     * @param	AuthyGroupRelatedByIdAuthyGroup $authyGroupRelatedByIdAuthyGroup The authyGroupRelatedByIdAuthyGroup object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeAuthyGroupRelatedByIdAuthyGroup($authyGroupRelatedByIdAuthyGroup)
    {
        if ($this->getAuthyGroupsRelatedByIdAuthyGroup()->contains($authyGroupRelatedByIdAuthyGroup)) {
            $this->collAuthyGroupsRelatedByIdAuthyGroup->remove($this->collAuthyGroupsRelatedByIdAuthyGroup->search($authyGroupRelatedByIdAuthyGroup));
            if (null === $this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion) {
                $this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion = clone $this->collAuthyGroupsRelatedByIdAuthyGroup;
                $this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion->clear();
            }
            $this->authyGroupsRelatedByIdAuthyGroupScheduledForDeletion[]= $authyGroupRelatedByIdAuthyGroup;
            $authyGroupRelatedByIdAuthyGroup->setAuthyGroupRelatedByIdGroupCreation(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|AuthyGroup[] List of AuthyGroup objects
     */
    public function getAuthyGroupsRelatedByIdAuthyGroupJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyGroupQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getAuthyGroupsRelatedByIdAuthyGroup($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|AuthyGroup[] List of AuthyGroup objects
     */
    public function getAuthyGroupsRelatedByIdAuthyGroupJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyGroupQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getAuthyGroupsRelatedByIdAuthyGroup($query, $con);
    }

    /**
     * Clears out the collConfigs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addConfigs()
     */
    public function clearConfigs()
    {
        $this->collConfigs = null; // important to set this to null since that means it is uninitialized
        $this->collConfigsPartial = null;

        return $this;
    }

    /**
     * reset is the collConfigs collection loaded partially
     *
     * @return void
     */
    public function resetPartialConfigs($v = true)
    {
        $this->collConfigsPartial = $v;
    }

    /**
     * Initializes the collConfigs collection.
     *
     * By default this just sets the collConfigs collection to an empty array (like clearcollConfigs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initConfigs($overrideExisting = true)
    {
        if (null !== $this->collConfigs && !$overrideExisting) {
            return;
        }
        $this->collConfigs = new PropelObjectCollection();
        $this->collConfigs->setModel('Config');
    }

    /**
     * Gets an array of Config objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Config[] List of Config objects
     * @throws PropelException
     */
    public function getConfigs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collConfigsPartial && !$this->isNew();
        if (null === $this->collConfigs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collConfigs) {
                // return empty collection
                $this->initConfigs();
            } else {
                $collConfigs = ConfigQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collConfigsPartial && count($collConfigs)) {
                      $this->initConfigs(false);

                      foreach ($collConfigs as $obj) {
                        if (false == $this->collConfigs->contains($obj)) {
                          $this->collConfigs->append($obj);
                        }
                      }

                      $this->collConfigsPartial = true;
                    }

                    $collConfigs->getInternalIterator()->rewind();

                    return $collConfigs;
                }

                if ($partial && $this->collConfigs) {
                    foreach ($this->collConfigs as $obj) {
                        if ($obj->isNew()) {
                            $collConfigs[] = $obj;
                        }
                    }
                }

                $this->collConfigs = $collConfigs;
                $this->collConfigsPartial = false;
            }
        }

        return $this->collConfigs;
    }

    /**
     * Sets a collection of Config objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $configs A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setConfigs(PropelCollection $configs, PropelPDO $con = null)
    {
        $configsToDelete = $this->getConfigs(new Criteria(), $con)->diff($configs);


        $this->configsScheduledForDeletion = $configsToDelete;

        foreach ($configsToDelete as $configRemoved) {
            $configRemoved->setAuthyGroup(null);
        }

        $this->collConfigs = null;
        foreach ($configs as $config) {
            $this->addConfig($config);
        }

        $this->collConfigs = $configs;
        $this->collConfigsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Config objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Config objects.
     * @throws PropelException
     */
    public function countConfigs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collConfigsPartial && !$this->isNew();
        if (null === $this->collConfigs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collConfigs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getConfigs());
            }
            $query = ConfigQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collConfigs);
    }

    /**
     * Method called to associate a Config object to this object
     * through the Config foreign key attribute.
     *
     * @param    Config $l Config
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addConfig(Config $l)
    {
        if ($this->collConfigs === null) {
            $this->initConfigs();
            $this->collConfigsPartial = true;
        }

        if (!in_array($l, $this->collConfigs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddConfig($l);

            if ($this->configsScheduledForDeletion and $this->configsScheduledForDeletion->contains($l)) {
                $this->configsScheduledForDeletion->remove($this->configsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Config $config The config object to add.
     */
    protected function doAddConfig($config)
    {
        $this->collConfigs[]= $config;
        $config->setAuthyGroup($this);
    }

    /**
     * @param	Config $config The config object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeConfig($config)
    {
        if ($this->getConfigs()->contains($config)) {
            $this->collConfigs->remove($this->collConfigs->search($config));
            if (null === $this->configsScheduledForDeletion) {
                $this->configsScheduledForDeletion = clone $this->collConfigs;
                $this->configsScheduledForDeletion->clear();
            }
            $this->configsScheduledForDeletion[]= $config;
            $config->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Config[] List of Config objects
     */
    public function getConfigsJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ConfigQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getConfigs($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Config[] List of Config objects
     */
    public function getConfigsJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ConfigQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getConfigs($query, $con);
    }

    /**
     * Clears out the collApiRbacs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addApiRbacs()
     */
    public function clearApiRbacs()
    {
        $this->collApiRbacs = null; // important to set this to null since that means it is uninitialized
        $this->collApiRbacsPartial = null;

        return $this;
    }

    /**
     * reset is the collApiRbacs collection loaded partially
     *
     * @return void
     */
    public function resetPartialApiRbacs($v = true)
    {
        $this->collApiRbacsPartial = $v;
    }

    /**
     * Initializes the collApiRbacs collection.
     *
     * By default this just sets the collApiRbacs collection to an empty array (like clearcollApiRbacs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initApiRbacs($overrideExisting = true)
    {
        if (null !== $this->collApiRbacs && !$overrideExisting) {
            return;
        }
        $this->collApiRbacs = new PropelObjectCollection();
        $this->collApiRbacs->setModel('ApiRbac');
    }

    /**
     * Gets an array of ApiRbac objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ApiRbac[] List of ApiRbac objects
     * @throws PropelException
     */
    public function getApiRbacs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collApiRbacsPartial && !$this->isNew();
        if (null === $this->collApiRbacs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collApiRbacs) {
                // return empty collection
                $this->initApiRbacs();
            } else {
                $collApiRbacs = ApiRbacQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collApiRbacsPartial && count($collApiRbacs)) {
                      $this->initApiRbacs(false);

                      foreach ($collApiRbacs as $obj) {
                        if (false == $this->collApiRbacs->contains($obj)) {
                          $this->collApiRbacs->append($obj);
                        }
                      }

                      $this->collApiRbacsPartial = true;
                    }

                    $collApiRbacs->getInternalIterator()->rewind();

                    return $collApiRbacs;
                }

                if ($partial && $this->collApiRbacs) {
                    foreach ($this->collApiRbacs as $obj) {
                        if ($obj->isNew()) {
                            $collApiRbacs[] = $obj;
                        }
                    }
                }

                $this->collApiRbacs = $collApiRbacs;
                $this->collApiRbacsPartial = false;
            }
        }

        return $this->collApiRbacs;
    }

    /**
     * Sets a collection of ApiRbac objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $apiRbacs A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setApiRbacs(PropelCollection $apiRbacs, PropelPDO $con = null)
    {
        $apiRbacsToDelete = $this->getApiRbacs(new Criteria(), $con)->diff($apiRbacs);


        $this->apiRbacsScheduledForDeletion = $apiRbacsToDelete;

        foreach ($apiRbacsToDelete as $apiRbacRemoved) {
            $apiRbacRemoved->setAuthyGroup(null);
        }

        $this->collApiRbacs = null;
        foreach ($apiRbacs as $apiRbac) {
            $this->addApiRbac($apiRbac);
        }

        $this->collApiRbacs = $apiRbacs;
        $this->collApiRbacsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ApiRbac objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ApiRbac objects.
     * @throws PropelException
     */
    public function countApiRbacs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collApiRbacsPartial && !$this->isNew();
        if (null === $this->collApiRbacs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collApiRbacs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getApiRbacs());
            }
            $query = ApiRbacQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collApiRbacs);
    }

    /**
     * Method called to associate a ApiRbac object to this object
     * through the ApiRbac foreign key attribute.
     *
     * @param    ApiRbac $l ApiRbac
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addApiRbac(ApiRbac $l)
    {
        if ($this->collApiRbacs === null) {
            $this->initApiRbacs();
            $this->collApiRbacsPartial = true;
        }

        if (!in_array($l, $this->collApiRbacs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddApiRbac($l);

            if ($this->apiRbacsScheduledForDeletion and $this->apiRbacsScheduledForDeletion->contains($l)) {
                $this->apiRbacsScheduledForDeletion->remove($this->apiRbacsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ApiRbac $apiRbac The apiRbac object to add.
     */
    protected function doAddApiRbac($apiRbac)
    {
        $this->collApiRbacs[]= $apiRbac;
        $apiRbac->setAuthyGroup($this);
    }

    /**
     * @param	ApiRbac $apiRbac The apiRbac object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeApiRbac($apiRbac)
    {
        if ($this->getApiRbacs()->contains($apiRbac)) {
            $this->collApiRbacs->remove($this->collApiRbacs->search($apiRbac));
            if (null === $this->apiRbacsScheduledForDeletion) {
                $this->apiRbacsScheduledForDeletion = clone $this->collApiRbacs;
                $this->apiRbacsScheduledForDeletion->clear();
            }
            $this->apiRbacsScheduledForDeletion[]= $apiRbac;
            $apiRbac->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ApiRbac[] List of ApiRbac objects
     */
    public function getApiRbacsJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ApiRbacQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getApiRbacs($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ApiRbac[] List of ApiRbac objects
     */
    public function getApiRbacsJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ApiRbacQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getApiRbacs($query, $con);
    }

    /**
     * Clears out the collTemplates collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addTemplates()
     */
    public function clearTemplates()
    {
        $this->collTemplates = null; // important to set this to null since that means it is uninitialized
        $this->collTemplatesPartial = null;

        return $this;
    }

    /**
     * reset is the collTemplates collection loaded partially
     *
     * @return void
     */
    public function resetPartialTemplates($v = true)
    {
        $this->collTemplatesPartial = $v;
    }

    /**
     * Initializes the collTemplates collection.
     *
     * By default this just sets the collTemplates collection to an empty array (like clearcollTemplates());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTemplates($overrideExisting = true)
    {
        if (null !== $this->collTemplates && !$overrideExisting) {
            return;
        }
        $this->collTemplates = new PropelObjectCollection();
        $this->collTemplates->setModel('Template');
    }

    /**
     * Gets an array of Template objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Template[] List of Template objects
     * @throws PropelException
     */
    public function getTemplates($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTemplatesPartial && !$this->isNew();
        if (null === $this->collTemplates || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTemplates) {
                // return empty collection
                $this->initTemplates();
            } else {
                $collTemplates = TemplateQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTemplatesPartial && count($collTemplates)) {
                      $this->initTemplates(false);

                      foreach ($collTemplates as $obj) {
                        if (false == $this->collTemplates->contains($obj)) {
                          $this->collTemplates->append($obj);
                        }
                      }

                      $this->collTemplatesPartial = true;
                    }

                    $collTemplates->getInternalIterator()->rewind();

                    return $collTemplates;
                }

                if ($partial && $this->collTemplates) {
                    foreach ($this->collTemplates as $obj) {
                        if ($obj->isNew()) {
                            $collTemplates[] = $obj;
                        }
                    }
                }

                $this->collTemplates = $collTemplates;
                $this->collTemplatesPartial = false;
            }
        }

        return $this->collTemplates;
    }

    /**
     * Sets a collection of Template objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $templates A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setTemplates(PropelCollection $templates, PropelPDO $con = null)
    {
        $templatesToDelete = $this->getTemplates(new Criteria(), $con)->diff($templates);


        $this->templatesScheduledForDeletion = $templatesToDelete;

        foreach ($templatesToDelete as $templateRemoved) {
            $templateRemoved->setAuthyGroup(null);
        }

        $this->collTemplates = null;
        foreach ($templates as $template) {
            $this->addTemplate($template);
        }

        $this->collTemplates = $templates;
        $this->collTemplatesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Template objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Template objects.
     * @throws PropelException
     */
    public function countTemplates(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTemplatesPartial && !$this->isNew();
        if (null === $this->collTemplates || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTemplates) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTemplates());
            }
            $query = TemplateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collTemplates);
    }

    /**
     * Method called to associate a Template object to this object
     * through the Template foreign key attribute.
     *
     * @param    Template $l Template
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addTemplate(Template $l)
    {
        if ($this->collTemplates === null) {
            $this->initTemplates();
            $this->collTemplatesPartial = true;
        }

        if (!in_array($l, $this->collTemplates->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTemplate($l);

            if ($this->templatesScheduledForDeletion and $this->templatesScheduledForDeletion->contains($l)) {
                $this->templatesScheduledForDeletion->remove($this->templatesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Template $template The template object to add.
     */
    protected function doAddTemplate($template)
    {
        $this->collTemplates[]= $template;
        $template->setAuthyGroup($this);
    }

    /**
     * @param	Template $template The template object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeTemplate($template)
    {
        if ($this->getTemplates()->contains($template)) {
            $this->collTemplates->remove($this->collTemplates->search($template));
            if (null === $this->templatesScheduledForDeletion) {
                $this->templatesScheduledForDeletion = clone $this->collTemplates;
                $this->templatesScheduledForDeletion->clear();
            }
            $this->templatesScheduledForDeletion[]= $template;
            $template->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Template[] List of Template objects
     */
    public function getTemplatesJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getTemplates($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Template[] List of Template objects
     */
    public function getTemplatesJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getTemplates($query, $con);
    }

    /**
     * Clears out the collTemplateFiles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addTemplateFiles()
     */
    public function clearTemplateFiles()
    {
        $this->collTemplateFiles = null; // important to set this to null since that means it is uninitialized
        $this->collTemplateFilesPartial = null;

        return $this;
    }

    /**
     * reset is the collTemplateFiles collection loaded partially
     *
     * @return void
     */
    public function resetPartialTemplateFiles($v = true)
    {
        $this->collTemplateFilesPartial = $v;
    }

    /**
     * Initializes the collTemplateFiles collection.
     *
     * By default this just sets the collTemplateFiles collection to an empty array (like clearcollTemplateFiles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTemplateFiles($overrideExisting = true)
    {
        if (null !== $this->collTemplateFiles && !$overrideExisting) {
            return;
        }
        $this->collTemplateFiles = new PropelObjectCollection();
        $this->collTemplateFiles->setModel('TemplateFile');
    }

    /**
     * Gets an array of TemplateFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TemplateFile[] List of TemplateFile objects
     * @throws PropelException
     */
    public function getTemplateFiles($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTemplateFilesPartial && !$this->isNew();
        if (null === $this->collTemplateFiles || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTemplateFiles) {
                // return empty collection
                $this->initTemplateFiles();
            } else {
                $collTemplateFiles = TemplateFileQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTemplateFilesPartial && count($collTemplateFiles)) {
                      $this->initTemplateFiles(false);

                      foreach ($collTemplateFiles as $obj) {
                        if (false == $this->collTemplateFiles->contains($obj)) {
                          $this->collTemplateFiles->append($obj);
                        }
                      }

                      $this->collTemplateFilesPartial = true;
                    }

                    $collTemplateFiles->getInternalIterator()->rewind();

                    return $collTemplateFiles;
                }

                if ($partial && $this->collTemplateFiles) {
                    foreach ($this->collTemplateFiles as $obj) {
                        if ($obj->isNew()) {
                            $collTemplateFiles[] = $obj;
                        }
                    }
                }

                $this->collTemplateFiles = $collTemplateFiles;
                $this->collTemplateFilesPartial = false;
            }
        }

        return $this->collTemplateFiles;
    }

    /**
     * Sets a collection of TemplateFile objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $templateFiles A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setTemplateFiles(PropelCollection $templateFiles, PropelPDO $con = null)
    {
        $templateFilesToDelete = $this->getTemplateFiles(new Criteria(), $con)->diff($templateFiles);


        $this->templateFilesScheduledForDeletion = $templateFilesToDelete;

        foreach ($templateFilesToDelete as $templateFileRemoved) {
            $templateFileRemoved->setAuthyGroup(null);
        }

        $this->collTemplateFiles = null;
        foreach ($templateFiles as $templateFile) {
            $this->addTemplateFile($templateFile);
        }

        $this->collTemplateFiles = $templateFiles;
        $this->collTemplateFilesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TemplateFile objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TemplateFile objects.
     * @throws PropelException
     */
    public function countTemplateFiles(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTemplateFilesPartial && !$this->isNew();
        if (null === $this->collTemplateFiles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTemplateFiles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTemplateFiles());
            }
            $query = TemplateFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collTemplateFiles);
    }

    /**
     * Method called to associate a TemplateFile object to this object
     * through the TemplateFile foreign key attribute.
     *
     * @param    TemplateFile $l TemplateFile
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addTemplateFile(TemplateFile $l)
    {
        if ($this->collTemplateFiles === null) {
            $this->initTemplateFiles();
            $this->collTemplateFilesPartial = true;
        }

        if (!in_array($l, $this->collTemplateFiles->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTemplateFile($l);

            if ($this->templateFilesScheduledForDeletion and $this->templateFilesScheduledForDeletion->contains($l)) {
                $this->templateFilesScheduledForDeletion->remove($this->templateFilesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TemplateFile $templateFile The templateFile object to add.
     */
    protected function doAddTemplateFile($templateFile)
    {
        $this->collTemplateFiles[]= $templateFile;
        $templateFile->setAuthyGroup($this);
    }

    /**
     * @param	TemplateFile $templateFile The templateFile object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeTemplateFile($templateFile)
    {
        if ($this->getTemplateFiles()->contains($templateFile)) {
            $this->collTemplateFiles->remove($this->collTemplateFiles->search($templateFile));
            if (null === $this->templateFilesScheduledForDeletion) {
                $this->templateFilesScheduledForDeletion = clone $this->collTemplateFiles;
                $this->templateFilesScheduledForDeletion->clear();
            }
            $this->templateFilesScheduledForDeletion[]= $templateFile;
            $templateFile->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TemplateFile[] List of TemplateFile objects
     */
    public function getTemplateFilesJoinTemplate($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateFileQuery::create(null, $criteria);
        $query->joinWith('Template', $join_behavior);

        return $this->getTemplateFiles($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TemplateFile[] List of TemplateFile objects
     */
    public function getTemplateFilesJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateFileQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getTemplateFiles($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TemplateFile[] List of TemplateFile objects
     */
    public function getTemplateFilesJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateFileQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getTemplateFiles($query, $con);
    }

    /**
     * Clears out the collMessageI18ns collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return AuthyGroup The current object (for fluent API support)
     * @see        addMessageI18ns()
     */
    public function clearMessageI18ns()
    {
        $this->collMessageI18ns = null; // important to set this to null since that means it is uninitialized
        $this->collMessageI18nsPartial = null;

        return $this;
    }

    /**
     * reset is the collMessageI18ns collection loaded partially
     *
     * @return void
     */
    public function resetPartialMessageI18ns($v = true)
    {
        $this->collMessageI18nsPartial = $v;
    }

    /**
     * Initializes the collMessageI18ns collection.
     *
     * By default this just sets the collMessageI18ns collection to an empty array (like clearcollMessageI18ns());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMessageI18ns($overrideExisting = true)
    {
        if (null !== $this->collMessageI18ns && !$overrideExisting) {
            return;
        }
        $this->collMessageI18ns = new PropelObjectCollection();
        $this->collMessageI18ns->setModel('MessageI18n');
    }

    /**
     * Gets an array of MessageI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this AuthyGroup is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|MessageI18n[] List of MessageI18n objects
     * @throws PropelException
     */
    public function getMessageI18ns($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMessageI18nsPartial && !$this->isNew();
        if (null === $this->collMessageI18ns || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMessageI18ns) {
                // return empty collection
                $this->initMessageI18ns();
            } else {
                $collMessageI18ns = MessageI18nQuery::create(null, $criteria)
                    ->filterByAuthyGroup($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMessageI18nsPartial && count($collMessageI18ns)) {
                      $this->initMessageI18ns(false);

                      foreach ($collMessageI18ns as $obj) {
                        if (false == $this->collMessageI18ns->contains($obj)) {
                          $this->collMessageI18ns->append($obj);
                        }
                      }

                      $this->collMessageI18nsPartial = true;
                    }

                    $collMessageI18ns->getInternalIterator()->rewind();

                    return $collMessageI18ns;
                }

                if ($partial && $this->collMessageI18ns) {
                    foreach ($this->collMessageI18ns as $obj) {
                        if ($obj->isNew()) {
                            $collMessageI18ns[] = $obj;
                        }
                    }
                }

                $this->collMessageI18ns = $collMessageI18ns;
                $this->collMessageI18nsPartial = false;
            }
        }

        return $this->collMessageI18ns;
    }

    /**
     * Sets a collection of MessageI18n objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $messageI18ns A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function setMessageI18ns(PropelCollection $messageI18ns, PropelPDO $con = null)
    {
        $messageI18nsToDelete = $this->getMessageI18ns(new Criteria(), $con)->diff($messageI18ns);


        $this->messageI18nsScheduledForDeletion = $messageI18nsToDelete;

        foreach ($messageI18nsToDelete as $messageI18nRemoved) {
            $messageI18nRemoved->setAuthyGroup(null);
        }

        $this->collMessageI18ns = null;
        foreach ($messageI18ns as $messageI18n) {
            $this->addMessageI18n($messageI18n);
        }

        $this->collMessageI18ns = $messageI18ns;
        $this->collMessageI18nsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related MessageI18n objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related MessageI18n objects.
     * @throws PropelException
     */
    public function countMessageI18ns(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMessageI18nsPartial && !$this->isNew();
        if (null === $this->collMessageI18ns || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMessageI18ns) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMessageI18ns());
            }
            $query = MessageI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyGroup($this)
                ->count($con);
        }

        return count($this->collMessageI18ns);
    }

    /**
     * Method called to associate a MessageI18n object to this object
     * through the MessageI18n foreign key attribute.
     *
     * @param    MessageI18n $l MessageI18n
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function addMessageI18n(MessageI18n $l)
    {
        if ($this->collMessageI18ns === null) {
            $this->initMessageI18ns();
            $this->collMessageI18nsPartial = true;
        }

        if (!in_array($l, $this->collMessageI18ns->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddMessageI18n($l);

            if ($this->messageI18nsScheduledForDeletion and $this->messageI18nsScheduledForDeletion->contains($l)) {
                $this->messageI18nsScheduledForDeletion->remove($this->messageI18nsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	MessageI18n $messageI18n The messageI18n object to add.
     */
    protected function doAddMessageI18n($messageI18n)
    {
        $this->collMessageI18ns[]= $messageI18n;
        $messageI18n->setAuthyGroup($this);
    }

    /**
     * @param	MessageI18n $messageI18n The messageI18n object to remove.
     * @return AuthyGroup The current object (for fluent API support)
     */
    public function removeMessageI18n($messageI18n)
    {
        if ($this->getMessageI18ns()->contains($messageI18n)) {
            $this->collMessageI18ns->remove($this->collMessageI18ns->search($messageI18n));
            if (null === $this->messageI18nsScheduledForDeletion) {
                $this->messageI18nsScheduledForDeletion = clone $this->collMessageI18ns;
                $this->messageI18nsScheduledForDeletion->clear();
            }
            $this->messageI18nsScheduledForDeletion[]= $messageI18n;
            $messageI18n->setAuthyGroup(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|MessageI18n[] List of MessageI18n objects
     */
    public function getMessageI18nsJoinMessage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MessageI18nQuery::create(null, $criteria);
        $query->joinWith('Message', $join_behavior);

        return $this->getMessageI18ns($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|MessageI18n[] List of MessageI18n objects
     */
    public function getMessageI18nsJoinAuthyRelatedByIdCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MessageI18nQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdCreation', $join_behavior);

        return $this->getMessageI18ns($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|MessageI18n[] List of MessageI18n objects
     */
    public function getMessageI18nsJoinAuthyRelatedByIdModification($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MessageI18nQuery::create(null, $criteria);
        $query->joinWith('AuthyRelatedByIdModification', $join_behavior);

        return $this->getMessageI18ns($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id_authy_group = null;
        $this->name = null;
        $this->desc = null;
        $this->default_group = null;
        $this->admin = null;
        $this->rights_all = null;
        $this->rights_owner = null;
        $this->rights_group = null;
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
            if ($this->collAuthyGroupxes) {
                foreach ($this->collAuthyGroupxes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collClients) {
                foreach ($this->collClients as $o) {
                    $o->clearAllReferences($deep);
                }
            }
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
            if ($this->collPaymentLines) {
                foreach ($this->collPaymentLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCostLines) {
                foreach ($this->collCostLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjects) {
                foreach ($this->collProjects as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTimeLines) {
                foreach ($this->collTimeLines as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBillingCategories) {
                foreach ($this->collBillingCategories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSuppliers) {
                foreach ($this->collSuppliers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthiesRelatedByIdAuthyGroup) {
                foreach ($this->collAuthiesRelatedByIdAuthyGroup as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthiesRelatedByIdGroupCreation) {
                foreach ($this->collAuthiesRelatedByIdGroupCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCountries) {
                foreach ($this->collCountries as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthyGroupsRelatedByIdAuthyGroup) {
                foreach ($this->collAuthyGroupsRelatedByIdAuthyGroup as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collConfigs) {
                foreach ($this->collConfigs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collApiRbacs) {
                foreach ($this->collApiRbacs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTemplates) {
                foreach ($this->collTemplates as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTemplateFiles) {
                foreach ($this->collTemplateFiles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMessageI18ns) {
                foreach ($this->collMessageI18ns as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthies) {
                foreach ($this->collAuthies as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aAuthyGroupRelatedByIdGroupCreation instanceof Persistent) {
              $this->aAuthyGroupRelatedByIdGroupCreation->clearAllReferences($deep);
            }
            if ($this->aAuthyRelatedByIdCreation instanceof Persistent) {
              $this->aAuthyRelatedByIdCreation->clearAllReferences($deep);
            }
            if ($this->aAuthyRelatedByIdModification instanceof Persistent) {
              $this->aAuthyRelatedByIdModification->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collAuthyGroupxes instanceof PropelCollection) {
            $this->collAuthyGroupxes->clearIterator();
        }
        $this->collAuthyGroupxes = null;
        if ($this->collClients instanceof PropelCollection) {
            $this->collClients->clearIterator();
        }
        $this->collClients = null;
        if ($this->collBillings instanceof PropelCollection) {
            $this->collBillings->clearIterator();
        }
        $this->collBillings = null;
        if ($this->collBillingLines instanceof PropelCollection) {
            $this->collBillingLines->clearIterator();
        }
        $this->collBillingLines = null;
        if ($this->collPaymentLines instanceof PropelCollection) {
            $this->collPaymentLines->clearIterator();
        }
        $this->collPaymentLines = null;
        if ($this->collCostLines instanceof PropelCollection) {
            $this->collCostLines->clearIterator();
        }
        $this->collCostLines = null;
        if ($this->collProjects instanceof PropelCollection) {
            $this->collProjects->clearIterator();
        }
        $this->collProjects = null;
        if ($this->collTimeLines instanceof PropelCollection) {
            $this->collTimeLines->clearIterator();
        }
        $this->collTimeLines = null;
        if ($this->collBillingCategories instanceof PropelCollection) {
            $this->collBillingCategories->clearIterator();
        }
        $this->collBillingCategories = null;
        if ($this->collSuppliers instanceof PropelCollection) {
            $this->collSuppliers->clearIterator();
        }
        $this->collSuppliers = null;
        if ($this->collAuthiesRelatedByIdAuthyGroup instanceof PropelCollection) {
            $this->collAuthiesRelatedByIdAuthyGroup->clearIterator();
        }
        $this->collAuthiesRelatedByIdAuthyGroup = null;
        if ($this->collAuthiesRelatedByIdGroupCreation instanceof PropelCollection) {
            $this->collAuthiesRelatedByIdGroupCreation->clearIterator();
        }
        $this->collAuthiesRelatedByIdGroupCreation = null;
        if ($this->collCountries instanceof PropelCollection) {
            $this->collCountries->clearIterator();
        }
        $this->collCountries = null;
        if ($this->collAuthyGroupsRelatedByIdAuthyGroup instanceof PropelCollection) {
            $this->collAuthyGroupsRelatedByIdAuthyGroup->clearIterator();
        }
        $this->collAuthyGroupsRelatedByIdAuthyGroup = null;
        if ($this->collConfigs instanceof PropelCollection) {
            $this->collConfigs->clearIterator();
        }
        $this->collConfigs = null;
        if ($this->collApiRbacs instanceof PropelCollection) {
            $this->collApiRbacs->clearIterator();
        }
        $this->collApiRbacs = null;
        if ($this->collTemplates instanceof PropelCollection) {
            $this->collTemplates->clearIterator();
        }
        $this->collTemplates = null;
        if ($this->collTemplateFiles instanceof PropelCollection) {
            $this->collTemplateFiles->clearIterator();
        }
        $this->collTemplateFiles = null;
        if ($this->collMessageI18ns instanceof PropelCollection) {
            $this->collMessageI18ns->clearIterator();
        }
        $this->collMessageI18ns = null;
        if ($this->collAuthies instanceof PropelCollection) {
            $this->collAuthies->clearIterator();
        }
        $this->collAuthies = null;
        $this->aAuthyGroupRelatedByIdGroupCreation = null;
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
        return (string) $this->exportTo(AuthyGroupPeer::DEFAULT_STRING_FORMAT);
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
     * @return     AuthyGroup The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged(){
        $this->modifiedColumns[] = AuthyGroupPeer::DATE_MODIFICATION;

        return $this;
    }

}
