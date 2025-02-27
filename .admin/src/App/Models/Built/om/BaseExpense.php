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
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use App\Authy;
use App\AuthyGroup;
use App\AuthyGroupQuery;
use App\AuthyQuery;
use App\BillingCategory;
use App\BillingCategoryQuery;
use App\Expense;
use App\ExpensePeer;
use App\ExpenseQuery;
use App\Project;
use App\ProjectQuery;
use App\Supplier;
use App\SupplierQuery;

/**
 * Base class that represents a row from the 'expense' table.
 *
 * Expense
 *
 * @package    propel.generator..om
 */
abstract class BaseExpense extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'App\\ExpensePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ExpensePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id_expense field.
     * @var        int
     */
    protected $id_expense;

    /**
     * The value for the date field.
     * @var        string
     */
    protected $date;

    /**
     * The value for the quantity field.
     * @var        string
     */
    protected $quantity;

    /**
     * The value for the amount field.
     * @var        string
     */
    protected $amount;

    /**
     * The value for the total field.
     * @var        string
     */
    protected $total;

    /**
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the id_billing_category field.
     * @var        int
     */
    protected $id_billing_category;

    /**
     * The value for the note_expense_ligne field.
     * @var        string
     */
    protected $note_expense_ligne;

    /**
     * The value for the id_client field.
     * @var        int
     */
    protected $id_client;

    /**
     * The value for the id_project field.
     * @var        int
     */
    protected $id_project;

    /**
     * The value for the id_assign field.
     * @var        int
     */
    protected $id_assign;

    /**
     * The value for the id_supplier field.
     * @var        int
     */
    protected $id_supplier;

    /**
     * The value for the invoice_no field.
     * @var        string
     */
    protected $invoice_no;

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
     * @var        BillingCategory
     */
    protected $aBillingCategory;

    /**
     * @var        Project
     */
    protected $aProjectRelatedByIdClient;

    /**
     * @var        Project
     */
    protected $aProjectRelatedByIdProject;

    /**
     * @var        Authy
     */
    protected $aAuthyRelatedByIdAssign;

    /**
     * @var        Supplier
     */
    protected $aSupplier;

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
     * @Field()
     * Get the [id_expense] column value.
     *
     * @return int
     */
    public function getIdExpense()
    {

        return $this->id_expense;
    }

    /**
     * @Field()
     * Get the [optionally formatted] temporal [date] column value.
     * Date
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDate($format = 'Y-m-d')
    {
        if ($this->date === null) {
            return null;
        }

        if ($this->date === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date, true), $x);
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
     * Get the [quantity] column value.
     * Quantity
     * @return string
     */
    public function getQuantity()
    {

        return $this->quantity;
    }

    /**
     * @Field()
     * Get the [amount] column value.
     * Amount
     * @return string
     */
    public function getAmount()
    {

        return $this->amount;
    }

    /**
     * @Field()
     * Get the [total] column value.
     * Total
     * @return string
     */
    public function getTotal()
    {

        return $this->total;
    }

    /**
     * @Field()
     * Get the [title] column value.
     * Title
     * @return string
     */
    public function getTitle()
    {

        return $this->title;
    }

    /**
     * @Field()
     * Get the [id_billing_category] column value.
     * Category
     * @return int
     */
    public function getIdBillingCategory()
    {

        return $this->id_billing_category;
    }

    /**
     * @Field()
     * Get the [note_expense_ligne] column value.
     * Note
     * @return string
     */
    public function getNoteExpenseLigne()
    {

        return $this->note_expense_ligne;
    }

    /**
     * @Field()
     * Get the [id_client] column value.
     * Client
     * @return int
     */
    public function getIdClient()
    {

        return $this->id_client;
    }

    /**
     * @Field()
     * Get the [id_project] column value.
     * Project
     * @return int
     */
    public function getIdProject()
    {

        return $this->id_project;
    }

    /**
     * @Field()
     * Get the [id_assign] column value.
     * Responsable
     * @return int
     */
    public function getIdAssign()
    {

        return $this->id_assign;
    }

    /**
     * @Field()
     * Get the [id_supplier] column value.
     * Supplier
     * @return int
     */
    public function getIdSupplier()
    {

        return $this->id_supplier;
    }

    /**
     * @Field()
     * Get the [invoice_no] column value.
     * Invoice no.
     * @return string
     */
    public function getInvoiceNo()
    {

        return $this->invoice_no;
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
     * Set the value of [id_expense] column.
     *
     * @param  int $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setIdExpense($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_expense !== $v) {
            $this->id_expense = $v;
            $this->modifiedColumns[] = ExpensePeer::ID_EXPENSE;
        }


        return $this;
    } // setIdExpense()

    /**
     * Sets the value of [date] column to a normalized version of the date/time value specified.
     * Date
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Expense The current object (for fluent API support)
     */
    public function setDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date !== null || $dt !== null) {
            $currentDateAsString = ($this->date !== null && $tmpDt = new DateTime($this->date)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date = $newDateAsString;
                $this->modifiedColumns[] = ExpensePeer::DATE;
            }
        } // if either are not null


        return $this;
    } // setDate()

    /**
     * Set the value of [quantity] column.
     * Quantity
     * @param  string $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setQuantity($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->quantity !== $v) {
            $this->quantity = $v;
            $this->modifiedColumns[] = ExpensePeer::QUANTITY;
        }


        return $this;
    } // setQuantity()

    /**
     * Set the value of [amount] column.
     * Amount
     * @param  string $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setAmount($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->amount !== $v) {
            $this->amount = $v;
            $this->modifiedColumns[] = ExpensePeer::AMOUNT;
        }


        return $this;
    } // setAmount()

    /**
     * Set the value of [total] column.
     * Total
     * @param  string $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setTotal($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->total !== $v) {
            $this->total = $v;
            $this->modifiedColumns[] = ExpensePeer::TOTAL;
        }


        return $this;
    } // setTotal()

    /**
     * Set the value of [title] column.
     * Title
     * @param  string $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[] = ExpensePeer::TITLE;
        }


        return $this;
    } // setTitle()

    /**
     * Set the value of [id_billing_category] column.
     * Category
     * @param  int $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setIdBillingCategory($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_billing_category !== $v) {
            $this->id_billing_category = $v;
            $this->modifiedColumns[] = ExpensePeer::ID_BILLING_CATEGORY;
        }

        if ($this->aBillingCategory !== null && $this->aBillingCategory->getIdBillingCategory() !== $v) {
            $this->aBillingCategory = null;
        }


        return $this;
    } // setIdBillingCategory()

    /**
     * Set the value of [note_expense_ligne] column.
     * Note
     * @param  string $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setNoteExpenseLigne($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->note_expense_ligne !== $v) {
            $this->note_expense_ligne = $v;
            $this->modifiedColumns[] = ExpensePeer::NOTE_EXPENSE_LIGNE;
        }


        return $this;
    } // setNoteExpenseLigne()

    /**
     * Set the value of [id_client] column.
     * Client
     * @param  int $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setIdClient($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_client !== $v) {
            $this->id_client = $v;
            $this->modifiedColumns[] = ExpensePeer::ID_CLIENT;
        }

        if ($this->aProjectRelatedByIdClient !== null && $this->aProjectRelatedByIdClient->getIdClient() !== $v) {
            $this->aProjectRelatedByIdClient = null;
        }


        return $this;
    } // setIdClient()

    /**
     * Set the value of [id_project] column.
     * Project
     * @param  int $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setIdProject($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_project !== $v) {
            $this->id_project = $v;
            $this->modifiedColumns[] = ExpensePeer::ID_PROJECT;
        }

        if ($this->aProjectRelatedByIdProject !== null && $this->aProjectRelatedByIdProject->getIdProject() !== $v) {
            $this->aProjectRelatedByIdProject = null;
        }


        return $this;
    } // setIdProject()

    /**
     * Set the value of [id_assign] column.
     * Responsable
     * @param  int $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setIdAssign($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_assign !== $v) {
            $this->id_assign = $v;
            $this->modifiedColumns[] = ExpensePeer::ID_ASSIGN;
        }

        if ($this->aAuthyRelatedByIdAssign !== null && $this->aAuthyRelatedByIdAssign->getIdCreation() !== $v) {
            $this->aAuthyRelatedByIdAssign = null;
        }


        return $this;
    } // setIdAssign()

    /**
     * Set the value of [id_supplier] column.
     * Supplier
     * @param  int $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setIdSupplier($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_supplier !== $v) {
            $this->id_supplier = $v;
            $this->modifiedColumns[] = ExpensePeer::ID_SUPPLIER;
        }

        if ($this->aSupplier !== null && $this->aSupplier->getIdSupplier() !== $v) {
            $this->aSupplier = null;
        }


        return $this;
    } // setIdSupplier()

    /**
     * Set the value of [invoice_no] column.
     * Invoice no.
     * @param  string $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setInvoiceNo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->invoice_no !== $v) {
            $this->invoice_no = $v;
            $this->modifiedColumns[] = ExpensePeer::INVOICE_NO;
        }


        return $this;
    } // setInvoiceNo()

    /**
     * Sets the value of [date_creation] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Expense The current object (for fluent API support)
     */
    public function setDateCreation($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_creation !== null || $dt !== null) {
            $currentDateAsString = ($this->date_creation !== null && $tmpDt = new DateTime($this->date_creation)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_creation = $newDateAsString;
                $this->modifiedColumns[] = ExpensePeer::DATE_CREATION;
            }
        } // if either are not null


        return $this;
    } // setDateCreation()

    /**
     * Sets the value of [date_modification] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Expense The current object (for fluent API support)
     */
    public function setDateModification($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_modification !== null || $dt !== null) {
            $currentDateAsString = ($this->date_modification !== null && $tmpDt = new DateTime($this->date_modification)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_modification = $newDateAsString;
                $this->modifiedColumns[] = ExpensePeer::DATE_MODIFICATION;
            }
        } // if either are not null


        return $this;
    } // setDateModification()

    /**
     * Set the value of [id_group_creation] column.
     *
     * @param  int $v new value
     * @return Expense The current object (for fluent API support)
     */
    public function setIdGroupCreation($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_group_creation !== $v) {
            $this->id_group_creation = $v;
            $this->modifiedColumns[] = ExpensePeer::ID_GROUP_CREATION;
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
     * @return Expense The current object (for fluent API support)
     */
    public function setIdCreation($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_creation !== $v) {
            $this->id_creation = $v;
            $this->modifiedColumns[] = ExpensePeer::ID_CREATION;
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
     * @return Expense The current object (for fluent API support)
     */
    public function setIdModification($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_modification !== $v) {
            $this->id_modification = $v;
            $this->modifiedColumns[] = ExpensePeer::ID_MODIFICATION;
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

            $this->id_expense = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->date = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->quantity = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->amount = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->total = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->title = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->id_billing_category = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->note_expense_ligne = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->id_client = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->id_project = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->id_assign = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->id_supplier = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->invoice_no = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->date_creation = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->date_modification = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->id_group_creation = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
            $this->id_creation = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
            $this->id_modification = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 18; // 18 = ExpensePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Expense object", $e);
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

        if ($this->aBillingCategory !== null && $this->id_billing_category !== $this->aBillingCategory->getIdBillingCategory()) {
            $this->aBillingCategory = null;
        }
        if ($this->aProjectRelatedByIdClient !== null && $this->id_client !== $this->aProjectRelatedByIdClient->getIdClient()) {
            $this->aProjectRelatedByIdClient = null;
        }
        if ($this->aProjectRelatedByIdProject !== null && $this->id_project !== $this->aProjectRelatedByIdProject->getIdProject()) {
            $this->aProjectRelatedByIdProject = null;
        }
        if ($this->aAuthyRelatedByIdAssign !== null && $this->id_assign !== $this->aAuthyRelatedByIdAssign->getIdCreation()) {
            $this->aAuthyRelatedByIdAssign = null;
        }
        if ($this->aSupplier !== null && $this->id_supplier !== $this->aSupplier->getIdSupplier()) {
            $this->aSupplier = null;
        }
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
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ExpensePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBillingCategory = null;
            $this->aProjectRelatedByIdClient = null;
            $this->aProjectRelatedByIdProject = null;
            $this->aAuthyRelatedByIdAssign = null;
            $this->aSupplier = null;
            $this->aAuthyGroup = null;
            $this->aAuthyRelatedByIdCreation = null;
            $this->aAuthyRelatedByIdModification = null;
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
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ExpenseQuery::create()
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
            $con = Propel::getConnection(ExpensePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ExpensePeer::addInstanceToPool($this);
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

            if ($this->aBillingCategory !== null) {
                if ($this->aBillingCategory->isModified() || $this->aBillingCategory->isNew()) {
                    $affectedRows += $this->aBillingCategory->save($con);
                }
                $this->setBillingCategory($this->aBillingCategory);
            }

            if ($this->aProjectRelatedByIdClient !== null) {
                if ($this->aProjectRelatedByIdClient->isModified() || $this->aProjectRelatedByIdClient->isNew()) {
                    $affectedRows += $this->aProjectRelatedByIdClient->save($con);
                }
                $this->setProjectRelatedByIdClient($this->aProjectRelatedByIdClient);
            }

            if ($this->aProjectRelatedByIdProject !== null) {
                if ($this->aProjectRelatedByIdProject->isModified() || $this->aProjectRelatedByIdProject->isNew()) {
                    $affectedRows += $this->aProjectRelatedByIdProject->save($con);
                }
                $this->setProjectRelatedByIdProject($this->aProjectRelatedByIdProject);
            }

            if ($this->aAuthyRelatedByIdAssign !== null) {
                if ($this->aAuthyRelatedByIdAssign->isModified() || $this->aAuthyRelatedByIdAssign->isNew()) {
                    $affectedRows += $this->aAuthyRelatedByIdAssign->save($con);
                }
                $this->setAuthyRelatedByIdAssign($this->aAuthyRelatedByIdAssign);
            }

            if ($this->aSupplier !== null) {
                if ($this->aSupplier->isModified() || $this->aSupplier->isNew()) {
                    $affectedRows += $this->aSupplier->save($con);
                }
                $this->setSupplier($this->aSupplier);
            }

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

        $this->modifiedColumns[] = ExpensePeer::ID_EXPENSE;
        if (null !== $this->id_expense) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ExpensePeer::ID_EXPENSE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ExpensePeer::ID_EXPENSE)) {
            $modifiedColumns[':p' . $index++]  = '`id_expense`';
        }
        if ($this->isColumnModified(ExpensePeer::DATE)) {
            $modifiedColumns[':p' . $index++]  = '`date`';
        }
        if ($this->isColumnModified(ExpensePeer::QUANTITY)) {
            $modifiedColumns[':p' . $index++]  = '`quantity`';
        }
        if ($this->isColumnModified(ExpensePeer::AMOUNT)) {
            $modifiedColumns[':p' . $index++]  = '`amount`';
        }
        if ($this->isColumnModified(ExpensePeer::TOTAL)) {
            $modifiedColumns[':p' . $index++]  = '`total`';
        }
        if ($this->isColumnModified(ExpensePeer::TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`title`';
        }
        if ($this->isColumnModified(ExpensePeer::ID_BILLING_CATEGORY)) {
            $modifiedColumns[':p' . $index++]  = '`id_billing_category`';
        }
        if ($this->isColumnModified(ExpensePeer::NOTE_EXPENSE_LIGNE)) {
            $modifiedColumns[':p' . $index++]  = '`note_expense_ligne`';
        }
        if ($this->isColumnModified(ExpensePeer::ID_CLIENT)) {
            $modifiedColumns[':p' . $index++]  = '`id_client`';
        }
        if ($this->isColumnModified(ExpensePeer::ID_PROJECT)) {
            $modifiedColumns[':p' . $index++]  = '`id_project`';
        }
        if ($this->isColumnModified(ExpensePeer::ID_ASSIGN)) {
            $modifiedColumns[':p' . $index++]  = '`id_assign`';
        }
        if ($this->isColumnModified(ExpensePeer::ID_SUPPLIER)) {
            $modifiedColumns[':p' . $index++]  = '`id_supplier`';
        }
        if ($this->isColumnModified(ExpensePeer::INVOICE_NO)) {
            $modifiedColumns[':p' . $index++]  = '`invoice_no`';
        }
        if ($this->isColumnModified(ExpensePeer::DATE_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`date_creation`';
        }
        if ($this->isColumnModified(ExpensePeer::DATE_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = '`date_modification`';
        }
        if ($this->isColumnModified(ExpensePeer::ID_GROUP_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_group_creation`';
        }
        if ($this->isColumnModified(ExpensePeer::ID_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_creation`';
        }
        if ($this->isColumnModified(ExpensePeer::ID_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_modification`';
        }

        $sql = sprintf(
            'INSERT INTO `expense` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_expense`':
                        $stmt->bindValue($identifier, $this->id_expense, PDO::PARAM_INT);
                        break;
                    case '`date`':
                        $stmt->bindValue($identifier, $this->date, PDO::PARAM_STR);
                        break;
                    case '`quantity`':
                        $stmt->bindValue($identifier, $this->quantity, PDO::PARAM_STR);
                        break;
                    case '`amount`':
                        $stmt->bindValue($identifier, $this->amount, PDO::PARAM_STR);
                        break;
                    case '`total`':
                        $stmt->bindValue($identifier, $this->total, PDO::PARAM_STR);
                        break;
                    case '`title`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case '`id_billing_category`':
                        $stmt->bindValue($identifier, $this->id_billing_category, PDO::PARAM_INT);
                        break;
                    case '`note_expense_ligne`':
                        $stmt->bindValue($identifier, $this->note_expense_ligne, PDO::PARAM_STR);
                        break;
                    case '`id_client`':
                        $stmt->bindValue($identifier, $this->id_client, PDO::PARAM_INT);
                        break;
                    case '`id_project`':
                        $stmt->bindValue($identifier, $this->id_project, PDO::PARAM_INT);
                        break;
                    case '`id_assign`':
                        $stmt->bindValue($identifier, $this->id_assign, PDO::PARAM_INT);
                        break;
                    case '`id_supplier`':
                        $stmt->bindValue($identifier, $this->id_supplier, PDO::PARAM_INT);
                        break;
                    case '`invoice_no`':
                        $stmt->bindValue($identifier, $this->invoice_no, PDO::PARAM_STR);
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
        $this->setIdExpense($pk);

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

            if ($this->aBillingCategory !== null) {
                if (!$this->aBillingCategory->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBillingCategory->getValidationFailures());
                }
            }

            if ($this->aProjectRelatedByIdClient !== null) {
                if (!$this->aProjectRelatedByIdClient->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aProjectRelatedByIdClient->getValidationFailures());
                }
            }

            if ($this->aProjectRelatedByIdProject !== null) {
                if (!$this->aProjectRelatedByIdProject->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aProjectRelatedByIdProject->getValidationFailures());
                }
            }

            if ($this->aAuthyRelatedByIdAssign !== null) {
                if (!$this->aAuthyRelatedByIdAssign->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAuthyRelatedByIdAssign->getValidationFailures());
                }
            }

            if ($this->aSupplier !== null) {
                if (!$this->aSupplier->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aSupplier->getValidationFailures());
                }
            }

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


            if (($retval = ExpensePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = ExpensePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['Expense'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Expense'][$this->getPrimaryKey()] = true;
        $keys = ExpensePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdExpense(),
            $keys[1] => $this->getDate(),
            $keys[2] => $this->getQuantity(),
            $keys[3] => $this->getAmount(),
            $keys[4] => $this->getTotal(),
            $keys[5] => $this->getTitle(),
            $keys[6] => $this->getIdBillingCategory(),
            $keys[7] => $this->getNoteExpenseLigne(),
            $keys[8] => $this->getIdClient(),
            $keys[9] => $this->getIdProject(),
            $keys[10] => $this->getIdAssign(),
            $keys[11] => $this->getIdSupplier(),
            $keys[12] => $this->getInvoiceNo(),
            $keys[13] => $this->getDateCreation(),
            $keys[14] => $this->getDateModification(),
            $keys[15] => $this->getIdGroupCreation(),
            $keys[16] => $this->getIdCreation(),
            $keys[17] => $this->getIdModification(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBillingCategory) {
                $result['BillingCategory'] = $this->aBillingCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProjectRelatedByIdClient) {
                $result['ProjectRelatedByIdClient'] = $this->aProjectRelatedByIdClient->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProjectRelatedByIdProject) {
                $result['ProjectRelatedByIdProject'] = $this->aProjectRelatedByIdProject->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyRelatedByIdAssign) {
                $result['AuthyRelatedByIdAssign'] = $this->aAuthyRelatedByIdAssign->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSupplier) {
                $result['Supplier'] = $this->aSupplier->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyGroup) {
                $result['AuthyGroup'] = $this->aAuthyGroup->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyRelatedByIdCreation) {
                $result['AuthyRelatedByIdCreation'] = $this->aAuthyRelatedByIdCreation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyRelatedByIdModification) {
                $result['AuthyRelatedByIdModification'] = $this->aAuthyRelatedByIdModification->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = ExpensePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIdExpense($value);
                break;
            case 1:
                $this->setDate($value);
                break;
            case 2:
                $this->setQuantity($value);
                break;
            case 3:
                $this->setAmount($value);
                break;
            case 4:
                $this->setTotal($value);
                break;
            case 5:
                $this->setTitle($value);
                break;
            case 6:
                $this->setIdBillingCategory($value);
                break;
            case 7:
                $this->setNoteExpenseLigne($value);
                break;
            case 8:
                $this->setIdClient($value);
                break;
            case 9:
                $this->setIdProject($value);
                break;
            case 10:
                $this->setIdAssign($value);
                break;
            case 11:
                $this->setIdSupplier($value);
                break;
            case 12:
                $this->setInvoiceNo($value);
                break;
            case 13:
                $this->setDateCreation($value);
                break;
            case 14:
                $this->setDateModification($value);
                break;
            case 15:
                $this->setIdGroupCreation($value);
                break;
            case 16:
                $this->setIdCreation($value);
                break;
            case 17:
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
        $keys = ExpensePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdExpense($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setDate($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setQuantity($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setAmount($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setTotal($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setTitle($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setIdBillingCategory($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setNoteExpenseLigne($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setIdClient($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setIdProject($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setIdAssign($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setIdSupplier($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setInvoiceNo($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setDateCreation($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setDateModification($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setIdGroupCreation($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setIdCreation($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setIdModification($arr[$keys[17]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ExpensePeer::DATABASE_NAME);

        if ($this->isColumnModified(ExpensePeer::ID_EXPENSE)) $criteria->add(ExpensePeer::ID_EXPENSE, $this->id_expense);
        if ($this->isColumnModified(ExpensePeer::DATE)) $criteria->add(ExpensePeer::DATE, $this->date);
        if ($this->isColumnModified(ExpensePeer::QUANTITY)) $criteria->add(ExpensePeer::QUANTITY, $this->quantity);
        if ($this->isColumnModified(ExpensePeer::AMOUNT)) $criteria->add(ExpensePeer::AMOUNT, $this->amount);
        if ($this->isColumnModified(ExpensePeer::TOTAL)) $criteria->add(ExpensePeer::TOTAL, $this->total);
        if ($this->isColumnModified(ExpensePeer::TITLE)) $criteria->add(ExpensePeer::TITLE, $this->title);
        if ($this->isColumnModified(ExpensePeer::ID_BILLING_CATEGORY)) $criteria->add(ExpensePeer::ID_BILLING_CATEGORY, $this->id_billing_category);
        if ($this->isColumnModified(ExpensePeer::NOTE_EXPENSE_LIGNE)) $criteria->add(ExpensePeer::NOTE_EXPENSE_LIGNE, $this->note_expense_ligne);
        if ($this->isColumnModified(ExpensePeer::ID_CLIENT)) $criteria->add(ExpensePeer::ID_CLIENT, $this->id_client);
        if ($this->isColumnModified(ExpensePeer::ID_PROJECT)) $criteria->add(ExpensePeer::ID_PROJECT, $this->id_project);
        if ($this->isColumnModified(ExpensePeer::ID_ASSIGN)) $criteria->add(ExpensePeer::ID_ASSIGN, $this->id_assign);
        if ($this->isColumnModified(ExpensePeer::ID_SUPPLIER)) $criteria->add(ExpensePeer::ID_SUPPLIER, $this->id_supplier);
        if ($this->isColumnModified(ExpensePeer::INVOICE_NO)) $criteria->add(ExpensePeer::INVOICE_NO, $this->invoice_no);
        if ($this->isColumnModified(ExpensePeer::DATE_CREATION)) $criteria->add(ExpensePeer::DATE_CREATION, $this->date_creation);
        if ($this->isColumnModified(ExpensePeer::DATE_MODIFICATION)) $criteria->add(ExpensePeer::DATE_MODIFICATION, $this->date_modification);
        if ($this->isColumnModified(ExpensePeer::ID_GROUP_CREATION)) $criteria->add(ExpensePeer::ID_GROUP_CREATION, $this->id_group_creation);
        if ($this->isColumnModified(ExpensePeer::ID_CREATION)) $criteria->add(ExpensePeer::ID_CREATION, $this->id_creation);
        if ($this->isColumnModified(ExpensePeer::ID_MODIFICATION)) $criteria->add(ExpensePeer::ID_MODIFICATION, $this->id_modification);

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
        $criteria = new Criteria(ExpensePeer::DATABASE_NAME);
        $criteria->add(ExpensePeer::ID_EXPENSE, $this->id_expense);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdExpense();
    }

    /**
     * Generic method to set the primary key (id_expense column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdExpense($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdExpense();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Expense (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDate($this->getDate());
        $copyObj->setQuantity($this->getQuantity());
        $copyObj->setAmount($this->getAmount());
        $copyObj->setTotal($this->getTotal());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setIdBillingCategory($this->getIdBillingCategory());
        $copyObj->setNoteExpenseLigne($this->getNoteExpenseLigne());
        $copyObj->setIdClient($this->getIdClient());
        $copyObj->setIdProject($this->getIdProject());
        $copyObj->setIdAssign($this->getIdAssign());
        $copyObj->setIdSupplier($this->getIdSupplier());
        $copyObj->setInvoiceNo($this->getInvoiceNo());
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

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdExpense(NULL); // this is a auto-increment column, so set to default value
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
     * @return Expense Clone of current object.
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
     * @return ExpensePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ExpensePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a BillingCategory object.
     *
     * @param                  BillingCategory $v
     * @return Expense The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBillingCategory(BillingCategory $v = null)
    {
        if ($v === null) {
            $this->setIdBillingCategory(NULL);
        } else {
            $this->setIdBillingCategory($v->getIdBillingCategory());
        }

        $this->aBillingCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the BillingCategory object, it will not be re-added.
        if ($v !== null) {
            $v->addExpense($this);
        }


        return $this;
    }


    /**
     * Get the associated BillingCategory object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return BillingCategory The associated BillingCategory object.
     * @throws PropelException
     */
    public function getBillingCategory(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aBillingCategory === null && ($this->id_billing_category !== null) && $doQuery) {
            $this->aBillingCategory = BillingCategoryQuery::create()->findPk($this->id_billing_category, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBillingCategory->addExpenses($this);
             */
        }

        return $this->aBillingCategory;
    }

    /**
     * Declares an association between this object and a Project object.
     *
     * @param                  Project $v
     * @return Expense The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProjectRelatedByIdClient(Project $v = null)
    {
        if ($v === null) {
            $this->setIdClient(NULL);
        } else {
            $this->setIdClient($v->getIdClient());
        }

        $this->aProjectRelatedByIdClient = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Project object, it will not be re-added.
        if ($v !== null) {
            $v->addExpenseRelatedByIdClient($this);
        }


        return $this;
    }


    /**
     * Get the associated Project object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Project The associated Project object.
     * @throws PropelException
     */
    public function getProjectRelatedByIdClient(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aProjectRelatedByIdClient === null && ($this->id_client !== null) && $doQuery) {
            $this->aProjectRelatedByIdClient = ProjectQuery::create()
                ->filterByExpenseRelatedByIdClient($this) // here
                ->findOne($con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProjectRelatedByIdClient->addExpensesRelatedByIdClient($this);
             */
        }

        return $this->aProjectRelatedByIdClient;
    }

    /**
     * Declares an association between this object and a Project object.
     *
     * @param                  Project $v
     * @return Expense The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProjectRelatedByIdProject(Project $v = null)
    {
        if ($v === null) {
            $this->setIdProject(NULL);
        } else {
            $this->setIdProject($v->getIdProject());
        }

        $this->aProjectRelatedByIdProject = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Project object, it will not be re-added.
        if ($v !== null) {
            $v->addExpenseRelatedByIdProject($this);
        }


        return $this;
    }


    /**
     * Get the associated Project object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Project The associated Project object.
     * @throws PropelException
     */
    public function getProjectRelatedByIdProject(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aProjectRelatedByIdProject === null && ($this->id_project !== null) && $doQuery) {
            $this->aProjectRelatedByIdProject = ProjectQuery::create()->findPk($this->id_project, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProjectRelatedByIdProject->addExpensesRelatedByIdProject($this);
             */
        }

        return $this->aProjectRelatedByIdProject;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return Expense The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAuthyRelatedByIdAssign(Authy $v = null)
    {
        if ($v === null) {
            $this->setIdAssign(NULL);
        } else {
            $this->setIdAssign($v->getIdCreation());
        }

        $this->aAuthyRelatedByIdAssign = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Authy object, it will not be re-added.
        if ($v !== null) {
            $v->addExpenseRelatedByIdAssign($this);
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
    public function getAuthyRelatedByIdAssign(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aAuthyRelatedByIdAssign === null && ($this->id_assign !== null) && $doQuery) {
            $this->aAuthyRelatedByIdAssign = AuthyQuery::create()
                ->filterByExpenseRelatedByIdAssign($this) // here
                ->findOne($con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAuthyRelatedByIdAssign->addExpensesRelatedByIdAssign($this);
             */
        }

        return $this->aAuthyRelatedByIdAssign;
    }

    /**
     * Declares an association between this object and a Supplier object.
     *
     * @param                  Supplier $v
     * @return Expense The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSupplier(Supplier $v = null)
    {
        if ($v === null) {
            $this->setIdSupplier(NULL);
        } else {
            $this->setIdSupplier($v->getIdSupplier());
        }

        $this->aSupplier = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Supplier object, it will not be re-added.
        if ($v !== null) {
            $v->addExpense($this);
        }


        return $this;
    }


    /**
     * Get the associated Supplier object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Supplier The associated Supplier object.
     * @throws PropelException
     */
    public function getSupplier(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aSupplier === null && ($this->id_supplier !== null) && $doQuery) {
            $this->aSupplier = SupplierQuery::create()->findPk($this->id_supplier, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSupplier->addExpenses($this);
             */
        }

        return $this->aSupplier;
    }

    /**
     * Declares an association between this object and a AuthyGroup object.
     *
     * @param                  AuthyGroup $v
     * @return Expense The current object (for fluent API support)
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
            $v->addExpense($this);
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
                $this->aAuthyGroup->addExpenses($this);
             */
        }

        return $this->aAuthyGroup;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return Expense The current object (for fluent API support)
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
            $v->addExpenseRelatedByIdCreation($this);
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
                $this->aAuthyRelatedByIdCreation->addExpensesRelatedByIdCreation($this);
             */
        }

        return $this->aAuthyRelatedByIdCreation;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return Expense The current object (for fluent API support)
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
            $v->addExpenseRelatedByIdModification($this);
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
                $this->aAuthyRelatedByIdModification->addExpensesRelatedByIdModification($this);
             */
        }

        return $this->aAuthyRelatedByIdModification;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id_expense = null;
        $this->date = null;
        $this->quantity = null;
        $this->amount = null;
        $this->total = null;
        $this->title = null;
        $this->id_billing_category = null;
        $this->note_expense_ligne = null;
        $this->id_client = null;
        $this->id_project = null;
        $this->id_assign = null;
        $this->id_supplier = null;
        $this->invoice_no = null;
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
            if ($this->aBillingCategory instanceof Persistent) {
              $this->aBillingCategory->clearAllReferences($deep);
            }
            if ($this->aProjectRelatedByIdClient instanceof Persistent) {
              $this->aProjectRelatedByIdClient->clearAllReferences($deep);
            }
            if ($this->aProjectRelatedByIdProject instanceof Persistent) {
              $this->aProjectRelatedByIdProject->clearAllReferences($deep);
            }
            if ($this->aAuthyRelatedByIdAssign instanceof Persistent) {
              $this->aAuthyRelatedByIdAssign->clearAllReferences($deep);
            }
            if ($this->aSupplier instanceof Persistent) {
              $this->aSupplier->clearAllReferences($deep);
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

        $this->aBillingCategory = null;
        $this->aProjectRelatedByIdClient = null;
        $this->aProjectRelatedByIdProject = null;
        $this->aAuthyRelatedByIdAssign = null;
        $this->aSupplier = null;
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
        return (string) $this->exportTo(ExpensePeer::DEFAULT_STRING_FORMAT);
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
     * @return     Expense The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged(){
        $this->modifiedColumns[] = ExpensePeer::DATE_MODIFICATION;

        return $this;
    }

}
