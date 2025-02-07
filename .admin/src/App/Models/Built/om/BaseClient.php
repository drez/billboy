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
use App\BillingCategoryQuery;
use App\BillingQuery;
use App\Client;
use App\ClientPeer;
use App\ClientQuery;
use App\Country;
use App\CountryQuery;
use App\Currency;
use App\CurrencyQuery;
use App\Project;
use App\ProjectQuery;

/**
 * Base class that represents a row from the 'client' table.
 *
 * Client
 *
 * @package    propel.generator..om
 */
abstract class BaseClient extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'App\\ClientPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ClientPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id_client field.
     * @var        int
     */
    protected $id_client;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the id_country field.
     * @var        int
     */
    protected $id_country;

    /**
     * The value for the phone field.
     * @var        string
     */
    protected $phone;

    /**
     * The value for the phone_work field.
     * @var        string
     */
    protected $phone_work;

    /**
     * The value for the ext field.
     * @var        string
     */
    protected $ext;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the contact field.
     * @var        string
     */
    protected $contact;

    /**
     * The value for the email2 field.
     * @var        string
     */
    protected $email2;

    /**
     * The value for the phone_mobile field.
     * @var        string
     */
    protected $phone_mobile;

    /**
     * The value for the website field.
     * @var        string
     */
    protected $website;

    /**
     * The value for the address_1 field.
     * @var        string
     */
    protected $address_1;

    /**
     * The value for the address_2 field.
     * @var        string
     */
    protected $address_2;

    /**
     * The value for the address_3 field.
     * @var        string
     */
    protected $address_3;

    /**
     * The value for the zip field.
     * @var        string
     */
    protected $zip;

    /**
     * The value for the default_rate field.
     * @var        string
     */
    protected $default_rate;

    /**
     * The value for the default_user field.
     * @var        int
     */
    protected $default_user;

    /**
     * The value for the default_category field.
     * @var        int
     */
    protected $default_category;

    /**
     * The value for the default_currency field.
     * @var        int
     */
    protected $default_currency;

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
     * @var        Country
     */
    protected $aCountry;

    /**
     * @var        Authy
     */
    protected $aAuthyRelatedByDefaultUser;

    /**
     * @var        BillingCategory
     */
    protected $aBillingCategory;

    /**
     * @var        Currency
     */
    protected $aCurrency;

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
     * @var        PropelObjectCollection|Project[] Collection to store aggregation of Project objects.
     */
    protected $collProjects;
    protected $collProjectsPartial;

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
    protected $projectsScheduledForDeletion = null;

    /**
     * @Field()
     * Get the [id_client] column value.
     *
     * @return int
     */
    public function getIdClient()
    {

        return $this->id_client;
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
     * Get the [id_country] column value.
     * Country
     * @return int
     */
    public function getIdCountry()
    {

        return $this->id_country;
    }

    /**
     * @Field()
     * Get the [phone] column value.
     * Phone
     * @return string
     */
    public function getPhone()
    {

        return $this->phone;
    }

    /**
     * @Field()
     * Get the [phone_work] column value.
     * Phone work
     * @return string
     */
    public function getPhoneWork()
    {

        return $this->phone_work;
    }

    /**
     * @Field()
     * Get the [ext] column value.
     * Extension
     * @return string
     */
    public function getExt()
    {

        return $this->ext;
    }

    /**
     * @Field()
     * Get the [email] column value.
     * Email
     * @return string
     */
    public function getEmail()
    {

        return $this->email;
    }

    /**
     * @Field()
     * Get the [contact] column value.
     * Contact
     * @return string
     */
    public function getContact()
    {

        return $this->contact;
    }

    /**
     * @Field()
     * Get the [email2] column value.
     * Email (contact)
     * @return string
     */
    public function getEmail2()
    {

        return $this->email2;
    }

    /**
     * @Field()
     * Get the [phone_mobile] column value.
     * contact
     * @return string
     */
    public function getPhoneMobile()
    {

        return $this->phone_mobile;
    }

    /**
     * @Field()
     * Get the [website] column value.
     *
     * @return string
     */
    public function getWebsite()
    {

        return $this->website;
    }

    /**
     * @Field()
     * Get the [address_1] column value.
     * Address 1
     * @return string
     */
    public function getAddress1()
    {

        return $this->address_1;
    }

    /**
     * @Field()
     * Get the [address_2] column value.
     * Address 2
     * @return string
     */
    public function getAddress2()
    {

        return $this->address_2;
    }

    /**
     * @Field()
     * Get the [address_3] column value.
     * Address 3
     * @return string
     */
    public function getAddress3()
    {

        return $this->address_3;
    }

    /**
     * @Field()
     * Get the [zip] column value.
     * Zip
     * @return string
     */
    public function getZip()
    {

        return $this->zip;
    }

    /**
     * @Field()
     * Get the [default_rate] column value.
     * Rate
     * @return string
     */
    public function getDefaultRate()
    {

        return $this->default_rate;
    }

    /**
     * @Field()
     * Get the [default_user] column value.
     * User
     * @return int
     */
    public function getDefaultUser()
    {

        return $this->default_user;
    }

    /**
     * @Field()
     * Get the [default_category] column value.
     * Category
     * @return int
     */
    public function getDefaultCategory()
    {

        return $this->default_category;
    }

    /**
     * @Field()
     * Get the [default_currency] column value.
     * Currency
     * @return int
     */
    public function getDefaultCurrency()
    {

        return $this->default_currency;
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
     * Set the value of [id_client] column.
     *
     * @param  int $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setIdClient($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_client !== $v) {
            $this->id_client = $v;
            $this->modifiedColumns[] = ClientPeer::ID_CLIENT;
        }


        return $this;
    } // setIdClient()

    /**
     * Set the value of [name] column.
     * Name
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = ClientPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [id_country] column.
     * Country
     * @param  int $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setIdCountry($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_country !== $v) {
            $this->id_country = $v;
            $this->modifiedColumns[] = ClientPeer::ID_COUNTRY;
        }

        if ($this->aCountry !== null && $this->aCountry->getIdCountry() !== $v) {
            $this->aCountry = null;
        }


        return $this;
    } // setIdCountry()

    /**
     * Set the value of [phone] column.
     * Phone
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[] = ClientPeer::PHONE;
        }


        return $this;
    } // setPhone()

    /**
     * Set the value of [phone_work] column.
     * Phone work
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setPhoneWork($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone_work !== $v) {
            $this->phone_work = $v;
            $this->modifiedColumns[] = ClientPeer::PHONE_WORK;
        }


        return $this;
    } // setPhoneWork()

    /**
     * Set the value of [ext] column.
     * Extension
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setExt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ext !== $v) {
            $this->ext = $v;
            $this->modifiedColumns[] = ClientPeer::EXT;
        }


        return $this;
    } // setExt()

    /**
     * Set the value of [email] column.
     * Email
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = ClientPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [contact] column.
     * Contact
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setContact($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact !== $v) {
            $this->contact = $v;
            $this->modifiedColumns[] = ClientPeer::CONTACT;
        }


        return $this;
    } // setContact()

    /**
     * Set the value of [email2] column.
     * Email (contact)
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setEmail2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email2 !== $v) {
            $this->email2 = $v;
            $this->modifiedColumns[] = ClientPeer::EMAIL2;
        }


        return $this;
    } // setEmail2()

    /**
     * Set the value of [phone_mobile] column.
     * contact
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setPhoneMobile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone_mobile !== $v) {
            $this->phone_mobile = $v;
            $this->modifiedColumns[] = ClientPeer::PHONE_MOBILE;
        }


        return $this;
    } // setPhoneMobile()

    /**
     * Set the value of [website] column.
     *
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setWebsite($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->website !== $v) {
            $this->website = $v;
            $this->modifiedColumns[] = ClientPeer::WEBSITE;
        }


        return $this;
    } // setWebsite()

    /**
     * Set the value of [address_1] column.
     * Address 1
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setAddress1($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_1 !== $v) {
            $this->address_1 = $v;
            $this->modifiedColumns[] = ClientPeer::ADDRESS_1;
        }


        return $this;
    } // setAddress1()

    /**
     * Set the value of [address_2] column.
     * Address 2
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setAddress2($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_2 !== $v) {
            $this->address_2 = $v;
            $this->modifiedColumns[] = ClientPeer::ADDRESS_2;
        }


        return $this;
    } // setAddress2()

    /**
     * Set the value of [address_3] column.
     * Address 3
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setAddress3($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address_3 !== $v) {
            $this->address_3 = $v;
            $this->modifiedColumns[] = ClientPeer::ADDRESS_3;
        }


        return $this;
    } // setAddress3()

    /**
     * Set the value of [zip] column.
     * Zip
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setZip($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->zip !== $v) {
            $this->zip = $v;
            $this->modifiedColumns[] = ClientPeer::ZIP;
        }


        return $this;
    } // setZip()

    /**
     * Set the value of [default_rate] column.
     * Rate
     * @param  string $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setDefaultRate($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->default_rate !== $v) {
            $this->default_rate = $v;
            $this->modifiedColumns[] = ClientPeer::DEFAULT_RATE;
        }


        return $this;
    } // setDefaultRate()

    /**
     * Set the value of [default_user] column.
     * User
     * @param  int $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setDefaultUser($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->default_user !== $v) {
            $this->default_user = $v;
            $this->modifiedColumns[] = ClientPeer::DEFAULT_USER;
        }

        if ($this->aAuthyRelatedByDefaultUser !== null && $this->aAuthyRelatedByDefaultUser->getIdAuthy() !== $v) {
            $this->aAuthyRelatedByDefaultUser = null;
        }


        return $this;
    } // setDefaultUser()

    /**
     * Set the value of [default_category] column.
     * Category
     * @param  int $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setDefaultCategory($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->default_category !== $v) {
            $this->default_category = $v;
            $this->modifiedColumns[] = ClientPeer::DEFAULT_CATEGORY;
        }

        if ($this->aBillingCategory !== null && $this->aBillingCategory->getIdBillingCategory() !== $v) {
            $this->aBillingCategory = null;
        }


        return $this;
    } // setDefaultCategory()

    /**
     * Set the value of [default_currency] column.
     * Currency
     * @param  int $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setDefaultCurrency($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->default_currency !== $v) {
            $this->default_currency = $v;
            $this->modifiedColumns[] = ClientPeer::DEFAULT_CURRENCY;
        }

        if ($this->aCurrency !== null && $this->aCurrency->getIdCurrency() !== $v) {
            $this->aCurrency = null;
        }


        return $this;
    } // setDefaultCurrency()

    /**
     * Sets the value of [date_creation] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Client The current object (for fluent API support)
     */
    public function setDateCreation($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_creation !== null || $dt !== null) {
            $currentDateAsString = ($this->date_creation !== null && $tmpDt = new DateTime($this->date_creation)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_creation = $newDateAsString;
                $this->modifiedColumns[] = ClientPeer::DATE_CREATION;
            }
        } // if either are not null


        return $this;
    } // setDateCreation()

    /**
     * Sets the value of [date_modification] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Client The current object (for fluent API support)
     */
    public function setDateModification($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_modification !== null || $dt !== null) {
            $currentDateAsString = ($this->date_modification !== null && $tmpDt = new DateTime($this->date_modification)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_modification = $newDateAsString;
                $this->modifiedColumns[] = ClientPeer::DATE_MODIFICATION;
            }
        } // if either are not null


        return $this;
    } // setDateModification()

    /**
     * Set the value of [id_group_creation] column.
     *
     * @param  int $v new value
     * @return Client The current object (for fluent API support)
     */
    public function setIdGroupCreation($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_group_creation !== $v) {
            $this->id_group_creation = $v;
            $this->modifiedColumns[] = ClientPeer::ID_GROUP_CREATION;
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
     * @return Client The current object (for fluent API support)
     */
    public function setIdCreation($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_creation !== $v) {
            $this->id_creation = $v;
            $this->modifiedColumns[] = ClientPeer::ID_CREATION;
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
     * @return Client The current object (for fluent API support)
     */
    public function setIdModification($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_modification !== $v) {
            $this->id_modification = $v;
            $this->modifiedColumns[] = ClientPeer::ID_MODIFICATION;
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

            $this->id_client = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->id_country = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->phone = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->phone_work = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->ext = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->email = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->contact = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->email2 = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->phone_mobile = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->website = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->address_1 = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->address_2 = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->address_3 = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->zip = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->default_rate = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->default_user = ($row[$startcol + 16] !== null) ? (int) $row[$startcol + 16] : null;
            $this->default_category = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
            $this->default_currency = ($row[$startcol + 18] !== null) ? (int) $row[$startcol + 18] : null;
            $this->date_creation = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
            $this->date_modification = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
            $this->id_group_creation = ($row[$startcol + 21] !== null) ? (int) $row[$startcol + 21] : null;
            $this->id_creation = ($row[$startcol + 22] !== null) ? (int) $row[$startcol + 22] : null;
            $this->id_modification = ($row[$startcol + 23] !== null) ? (int) $row[$startcol + 23] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 24; // 24 = ClientPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Client object", $e);
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

        if ($this->aCountry !== null && $this->id_country !== $this->aCountry->getIdCountry()) {
            $this->aCountry = null;
        }
        if ($this->aAuthyRelatedByDefaultUser !== null && $this->default_user !== $this->aAuthyRelatedByDefaultUser->getIdAuthy()) {
            $this->aAuthyRelatedByDefaultUser = null;
        }
        if ($this->aBillingCategory !== null && $this->default_category !== $this->aBillingCategory->getIdBillingCategory()) {
            $this->aBillingCategory = null;
        }
        if ($this->aCurrency !== null && $this->default_currency !== $this->aCurrency->getIdCurrency()) {
            $this->aCurrency = null;
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
            $con = Propel::getConnection(ClientPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ClientPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCountry = null;
            $this->aAuthyRelatedByDefaultUser = null;
            $this->aBillingCategory = null;
            $this->aCurrency = null;
            $this->aAuthyGroup = null;
            $this->aAuthyRelatedByIdCreation = null;
            $this->aAuthyRelatedByIdModification = null;
            $this->collBillings = null;

            $this->collProjects = null;

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
            $con = Propel::getConnection(ClientPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ClientQuery::create()
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
            $con = Propel::getConnection(ClientPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ClientPeer::addInstanceToPool($this);
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

            if ($this->aCountry !== null) {
                if ($this->aCountry->isModified() || $this->aCountry->isNew()) {
                    $affectedRows += $this->aCountry->save($con);
                }
                $this->setCountry($this->aCountry);
            }

            if ($this->aAuthyRelatedByDefaultUser !== null) {
                if ($this->aAuthyRelatedByDefaultUser->isModified() || $this->aAuthyRelatedByDefaultUser->isNew()) {
                    $affectedRows += $this->aAuthyRelatedByDefaultUser->save($con);
                }
                $this->setAuthyRelatedByDefaultUser($this->aAuthyRelatedByDefaultUser);
            }

            if ($this->aBillingCategory !== null) {
                if ($this->aBillingCategory->isModified() || $this->aBillingCategory->isNew()) {
                    $affectedRows += $this->aBillingCategory->save($con);
                }
                $this->setBillingCategory($this->aBillingCategory);
            }

            if ($this->aCurrency !== null) {
                if ($this->aCurrency->isModified() || $this->aCurrency->isNew()) {
                    $affectedRows += $this->aCurrency->save($con);
                }
                $this->setCurrency($this->aCurrency);
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

            if ($this->billingsScheduledForDeletion !== null) {
                if (!$this->billingsScheduledForDeletion->isEmpty()) {
                    BillingQuery::create()
                        ->filterByPrimaryKeys($this->billingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

        $this->modifiedColumns[] = ClientPeer::ID_CLIENT;
        if (null !== $this->id_client) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ClientPeer::ID_CLIENT . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ClientPeer::ID_CLIENT)) {
            $modifiedColumns[':p' . $index++]  = '`id_client`';
        }
        if ($this->isColumnModified(ClientPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(ClientPeer::ID_COUNTRY)) {
            $modifiedColumns[':p' . $index++]  = '`id_country`';
        }
        if ($this->isColumnModified(ClientPeer::PHONE)) {
            $modifiedColumns[':p' . $index++]  = '`phone`';
        }
        if ($this->isColumnModified(ClientPeer::PHONE_WORK)) {
            $modifiedColumns[':p' . $index++]  = '`phone_work`';
        }
        if ($this->isColumnModified(ClientPeer::EXT)) {
            $modifiedColumns[':p' . $index++]  = '`ext`';
        }
        if ($this->isColumnModified(ClientPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(ClientPeer::CONTACT)) {
            $modifiedColumns[':p' . $index++]  = '`contact`';
        }
        if ($this->isColumnModified(ClientPeer::EMAIL2)) {
            $modifiedColumns[':p' . $index++]  = '`email2`';
        }
        if ($this->isColumnModified(ClientPeer::PHONE_MOBILE)) {
            $modifiedColumns[':p' . $index++]  = '`phone_mobile`';
        }
        if ($this->isColumnModified(ClientPeer::WEBSITE)) {
            $modifiedColumns[':p' . $index++]  = '`website`';
        }
        if ($this->isColumnModified(ClientPeer::ADDRESS_1)) {
            $modifiedColumns[':p' . $index++]  = '`address_1`';
        }
        if ($this->isColumnModified(ClientPeer::ADDRESS_2)) {
            $modifiedColumns[':p' . $index++]  = '`address_2`';
        }
        if ($this->isColumnModified(ClientPeer::ADDRESS_3)) {
            $modifiedColumns[':p' . $index++]  = '`address_3`';
        }
        if ($this->isColumnModified(ClientPeer::ZIP)) {
            $modifiedColumns[':p' . $index++]  = '`zip`';
        }
        if ($this->isColumnModified(ClientPeer::DEFAULT_RATE)) {
            $modifiedColumns[':p' . $index++]  = '`default_rate`';
        }
        if ($this->isColumnModified(ClientPeer::DEFAULT_USER)) {
            $modifiedColumns[':p' . $index++]  = '`default_user`';
        }
        if ($this->isColumnModified(ClientPeer::DEFAULT_CATEGORY)) {
            $modifiedColumns[':p' . $index++]  = '`default_category`';
        }
        if ($this->isColumnModified(ClientPeer::DEFAULT_CURRENCY)) {
            $modifiedColumns[':p' . $index++]  = '`default_currency`';
        }
        if ($this->isColumnModified(ClientPeer::DATE_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`date_creation`';
        }
        if ($this->isColumnModified(ClientPeer::DATE_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = '`date_modification`';
        }
        if ($this->isColumnModified(ClientPeer::ID_GROUP_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_group_creation`';
        }
        if ($this->isColumnModified(ClientPeer::ID_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_creation`';
        }
        if ($this->isColumnModified(ClientPeer::ID_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_modification`';
        }

        $sql = sprintf(
            'INSERT INTO `client` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_client`':
                        $stmt->bindValue($identifier, $this->id_client, PDO::PARAM_INT);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`id_country`':
                        $stmt->bindValue($identifier, $this->id_country, PDO::PARAM_INT);
                        break;
                    case '`phone`':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case '`phone_work`':
                        $stmt->bindValue($identifier, $this->phone_work, PDO::PARAM_STR);
                        break;
                    case '`ext`':
                        $stmt->bindValue($identifier, $this->ext, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`contact`':
                        $stmt->bindValue($identifier, $this->contact, PDO::PARAM_STR);
                        break;
                    case '`email2`':
                        $stmt->bindValue($identifier, $this->email2, PDO::PARAM_STR);
                        break;
                    case '`phone_mobile`':
                        $stmt->bindValue($identifier, $this->phone_mobile, PDO::PARAM_STR);
                        break;
                    case '`website`':
                        $stmt->bindValue($identifier, $this->website, PDO::PARAM_STR);
                        break;
                    case '`address_1`':
                        $stmt->bindValue($identifier, $this->address_1, PDO::PARAM_STR);
                        break;
                    case '`address_2`':
                        $stmt->bindValue($identifier, $this->address_2, PDO::PARAM_STR);
                        break;
                    case '`address_3`':
                        $stmt->bindValue($identifier, $this->address_3, PDO::PARAM_STR);
                        break;
                    case '`zip`':
                        $stmt->bindValue($identifier, $this->zip, PDO::PARAM_STR);
                        break;
                    case '`default_rate`':
                        $stmt->bindValue($identifier, $this->default_rate, PDO::PARAM_STR);
                        break;
                    case '`default_user`':
                        $stmt->bindValue($identifier, $this->default_user, PDO::PARAM_INT);
                        break;
                    case '`default_category`':
                        $stmt->bindValue($identifier, $this->default_category, PDO::PARAM_INT);
                        break;
                    case '`default_currency`':
                        $stmt->bindValue($identifier, $this->default_currency, PDO::PARAM_INT);
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
        $this->setIdClient($pk);

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

            if ($this->aCountry !== null) {
                if (!$this->aCountry->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCountry->getValidationFailures());
                }
            }

            if ($this->aAuthyRelatedByDefaultUser !== null) {
                if (!$this->aAuthyRelatedByDefaultUser->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAuthyRelatedByDefaultUser->getValidationFailures());
                }
            }

            if ($this->aBillingCategory !== null) {
                if (!$this->aBillingCategory->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBillingCategory->getValidationFailures());
                }
            }

            if ($this->aCurrency !== null) {
                if (!$this->aCurrency->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCurrency->getValidationFailures());
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


            if (($retval = ClientPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collBillings !== null) {
                    foreach ($this->collBillings as $referrerFK) {
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
        $pos = ClientPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['Client'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Client'][$this->getPrimaryKey()] = true;
        $keys = ClientPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdClient(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getIdCountry(),
            $keys[3] => $this->getPhone(),
            $keys[4] => $this->getPhoneWork(),
            $keys[5] => $this->getExt(),
            $keys[6] => $this->getEmail(),
            $keys[7] => $this->getContact(),
            $keys[8] => $this->getEmail2(),
            $keys[9] => $this->getPhoneMobile(),
            $keys[10] => $this->getWebsite(),
            $keys[11] => $this->getAddress1(),
            $keys[12] => $this->getAddress2(),
            $keys[13] => $this->getAddress3(),
            $keys[14] => $this->getZip(),
            $keys[15] => $this->getDefaultRate(),
            $keys[16] => $this->getDefaultUser(),
            $keys[17] => $this->getDefaultCategory(),
            $keys[18] => $this->getDefaultCurrency(),
            $keys[19] => $this->getDateCreation(),
            $keys[20] => $this->getDateModification(),
            $keys[21] => $this->getIdGroupCreation(),
            $keys[22] => $this->getIdCreation(),
            $keys[23] => $this->getIdModification(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCountry) {
                $result['Country'] = $this->aCountry->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyRelatedByDefaultUser) {
                $result['AuthyRelatedByDefaultUser'] = $this->aAuthyRelatedByDefaultUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBillingCategory) {
                $result['BillingCategory'] = $this->aBillingCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aCurrency) {
                $result['Currency'] = $this->aCurrency->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collBillings) {
                $result['Billings'] = $this->collBillings->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjects) {
                $result['Projects'] = $this->collProjects->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ClientPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIdClient($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setIdCountry($value);
                break;
            case 3:
                $this->setPhone($value);
                break;
            case 4:
                $this->setPhoneWork($value);
                break;
            case 5:
                $this->setExt($value);
                break;
            case 6:
                $this->setEmail($value);
                break;
            case 7:
                $this->setContact($value);
                break;
            case 8:
                $this->setEmail2($value);
                break;
            case 9:
                $this->setPhoneMobile($value);
                break;
            case 10:
                $this->setWebsite($value);
                break;
            case 11:
                $this->setAddress1($value);
                break;
            case 12:
                $this->setAddress2($value);
                break;
            case 13:
                $this->setAddress3($value);
                break;
            case 14:
                $this->setZip($value);
                break;
            case 15:
                $this->setDefaultRate($value);
                break;
            case 16:
                $this->setDefaultUser($value);
                break;
            case 17:
                $this->setDefaultCategory($value);
                break;
            case 18:
                $this->setDefaultCurrency($value);
                break;
            case 19:
                $this->setDateCreation($value);
                break;
            case 20:
                $this->setDateModification($value);
                break;
            case 21:
                $this->setIdGroupCreation($value);
                break;
            case 22:
                $this->setIdCreation($value);
                break;
            case 23:
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
        $keys = ClientPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdClient($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setIdCountry($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPhone($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPhoneWork($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setExt($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setEmail($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setContact($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setEmail2($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setPhoneMobile($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setWebsite($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setAddress1($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setAddress2($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setAddress3($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setZip($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setDefaultRate($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setDefaultUser($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setDefaultCategory($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setDefaultCurrency($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setDateCreation($arr[$keys[19]]);
        if (array_key_exists($keys[20], $arr)) $this->setDateModification($arr[$keys[20]]);
        if (array_key_exists($keys[21], $arr)) $this->setIdGroupCreation($arr[$keys[21]]);
        if (array_key_exists($keys[22], $arr)) $this->setIdCreation($arr[$keys[22]]);
        if (array_key_exists($keys[23], $arr)) $this->setIdModification($arr[$keys[23]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ClientPeer::DATABASE_NAME);

        if ($this->isColumnModified(ClientPeer::ID_CLIENT)) $criteria->add(ClientPeer::ID_CLIENT, $this->id_client);
        if ($this->isColumnModified(ClientPeer::NAME)) $criteria->add(ClientPeer::NAME, $this->name);
        if ($this->isColumnModified(ClientPeer::ID_COUNTRY)) $criteria->add(ClientPeer::ID_COUNTRY, $this->id_country);
        if ($this->isColumnModified(ClientPeer::PHONE)) $criteria->add(ClientPeer::PHONE, $this->phone);
        if ($this->isColumnModified(ClientPeer::PHONE_WORK)) $criteria->add(ClientPeer::PHONE_WORK, $this->phone_work);
        if ($this->isColumnModified(ClientPeer::EXT)) $criteria->add(ClientPeer::EXT, $this->ext);
        if ($this->isColumnModified(ClientPeer::EMAIL)) $criteria->add(ClientPeer::EMAIL, $this->email);
        if ($this->isColumnModified(ClientPeer::CONTACT)) $criteria->add(ClientPeer::CONTACT, $this->contact);
        if ($this->isColumnModified(ClientPeer::EMAIL2)) $criteria->add(ClientPeer::EMAIL2, $this->email2);
        if ($this->isColumnModified(ClientPeer::PHONE_MOBILE)) $criteria->add(ClientPeer::PHONE_MOBILE, $this->phone_mobile);
        if ($this->isColumnModified(ClientPeer::WEBSITE)) $criteria->add(ClientPeer::WEBSITE, $this->website);
        if ($this->isColumnModified(ClientPeer::ADDRESS_1)) $criteria->add(ClientPeer::ADDRESS_1, $this->address_1);
        if ($this->isColumnModified(ClientPeer::ADDRESS_2)) $criteria->add(ClientPeer::ADDRESS_2, $this->address_2);
        if ($this->isColumnModified(ClientPeer::ADDRESS_3)) $criteria->add(ClientPeer::ADDRESS_3, $this->address_3);
        if ($this->isColumnModified(ClientPeer::ZIP)) $criteria->add(ClientPeer::ZIP, $this->zip);
        if ($this->isColumnModified(ClientPeer::DEFAULT_RATE)) $criteria->add(ClientPeer::DEFAULT_RATE, $this->default_rate);
        if ($this->isColumnModified(ClientPeer::DEFAULT_USER)) $criteria->add(ClientPeer::DEFAULT_USER, $this->default_user);
        if ($this->isColumnModified(ClientPeer::DEFAULT_CATEGORY)) $criteria->add(ClientPeer::DEFAULT_CATEGORY, $this->default_category);
        if ($this->isColumnModified(ClientPeer::DEFAULT_CURRENCY)) $criteria->add(ClientPeer::DEFAULT_CURRENCY, $this->default_currency);
        if ($this->isColumnModified(ClientPeer::DATE_CREATION)) $criteria->add(ClientPeer::DATE_CREATION, $this->date_creation);
        if ($this->isColumnModified(ClientPeer::DATE_MODIFICATION)) $criteria->add(ClientPeer::DATE_MODIFICATION, $this->date_modification);
        if ($this->isColumnModified(ClientPeer::ID_GROUP_CREATION)) $criteria->add(ClientPeer::ID_GROUP_CREATION, $this->id_group_creation);
        if ($this->isColumnModified(ClientPeer::ID_CREATION)) $criteria->add(ClientPeer::ID_CREATION, $this->id_creation);
        if ($this->isColumnModified(ClientPeer::ID_MODIFICATION)) $criteria->add(ClientPeer::ID_MODIFICATION, $this->id_modification);

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
        $criteria = new Criteria(ClientPeer::DATABASE_NAME);
        $criteria->add(ClientPeer::ID_CLIENT, $this->id_client);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdClient();
    }

    /**
     * Generic method to set the primary key (id_client column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdClient($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdClient();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Client (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setIdCountry($this->getIdCountry());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setPhoneWork($this->getPhoneWork());
        $copyObj->setExt($this->getExt());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setContact($this->getContact());
        $copyObj->setEmail2($this->getEmail2());
        $copyObj->setPhoneMobile($this->getPhoneMobile());
        $copyObj->setWebsite($this->getWebsite());
        $copyObj->setAddress1($this->getAddress1());
        $copyObj->setAddress2($this->getAddress2());
        $copyObj->setAddress3($this->getAddress3());
        $copyObj->setZip($this->getZip());
        $copyObj->setDefaultRate($this->getDefaultRate());
        $copyObj->setDefaultUser($this->getDefaultUser());
        $copyObj->setDefaultCategory($this->getDefaultCategory());
        $copyObj->setDefaultCurrency($this->getDefaultCurrency());
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

            foreach ($this->getProjects() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProject($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdClient(NULL); // this is a auto-increment column, so set to default value
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
     * @return Client Clone of current object.
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
     * @return ClientPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ClientPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Country object.
     *
     * @param                  Country $v
     * @return Client The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCountry(Country $v = null)
    {
        if ($v === null) {
            $this->setIdCountry(NULL);
        } else {
            $this->setIdCountry($v->getIdCountry());
        }

        $this->aCountry = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Country object, it will not be re-added.
        if ($v !== null) {
            $v->addClient($this);
        }


        return $this;
    }


    /**
     * Get the associated Country object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Country The associated Country object.
     * @throws PropelException
     */
    public function getCountry(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aCountry === null && ($this->id_country !== null) && $doQuery) {
            $this->aCountry = CountryQuery::create()->findPk($this->id_country, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCountry->addClients($this);
             */
        }

        return $this->aCountry;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return Client The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAuthyRelatedByDefaultUser(Authy $v = null)
    {
        if ($v === null) {
            $this->setDefaultUser(NULL);
        } else {
            $this->setDefaultUser($v->getIdAuthy());
        }

        $this->aAuthyRelatedByDefaultUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Authy object, it will not be re-added.
        if ($v !== null) {
            $v->addClientRelatedByDefaultUser($this);
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
    public function getAuthyRelatedByDefaultUser(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aAuthyRelatedByDefaultUser === null && ($this->default_user !== null) && $doQuery) {
            $this->aAuthyRelatedByDefaultUser = AuthyQuery::create()->findPk($this->default_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAuthyRelatedByDefaultUser->addClientsRelatedByDefaultUser($this);
             */
        }

        return $this->aAuthyRelatedByDefaultUser;
    }

    /**
     * Declares an association between this object and a BillingCategory object.
     *
     * @param                  BillingCategory $v
     * @return Client The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBillingCategory(BillingCategory $v = null)
    {
        if ($v === null) {
            $this->setDefaultCategory(NULL);
        } else {
            $this->setDefaultCategory($v->getIdBillingCategory());
        }

        $this->aBillingCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the BillingCategory object, it will not be re-added.
        if ($v !== null) {
            $v->addClient($this);
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
        if ($this->aBillingCategory === null && ($this->default_category !== null) && $doQuery) {
            $this->aBillingCategory = BillingCategoryQuery::create()->findPk($this->default_category, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBillingCategory->addClients($this);
             */
        }

        return $this->aBillingCategory;
    }

    /**
     * Declares an association between this object and a Currency object.
     *
     * @param                  Currency $v
     * @return Client The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCurrency(Currency $v = null)
    {
        if ($v === null) {
            $this->setDefaultCurrency(NULL);
        } else {
            $this->setDefaultCurrency($v->getIdCurrency());
        }

        $this->aCurrency = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Currency object, it will not be re-added.
        if ($v !== null) {
            $v->addClient($this);
        }


        return $this;
    }


    /**
     * Get the associated Currency object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Currency The associated Currency object.
     * @throws PropelException
     */
    public function getCurrency(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aCurrency === null && ($this->default_currency !== null) && $doQuery) {
            $this->aCurrency = CurrencyQuery::create()->findPk($this->default_currency, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCurrency->addClients($this);
             */
        }

        return $this->aCurrency;
    }

    /**
     * Declares an association between this object and a AuthyGroup object.
     *
     * @param                  AuthyGroup $v
     * @return Client The current object (for fluent API support)
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
            $v->addClient($this);
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
                $this->aAuthyGroup->addClients($this);
             */
        }

        return $this->aAuthyGroup;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return Client The current object (for fluent API support)
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
            $v->addClientRelatedByIdCreation($this);
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
                $this->aAuthyRelatedByIdCreation->addClientsRelatedByIdCreation($this);
             */
        }

        return $this->aAuthyRelatedByIdCreation;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return Client The current object (for fluent API support)
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
            $v->addClientRelatedByIdModification($this);
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
                $this->aAuthyRelatedByIdModification->addClientsRelatedByIdModification($this);
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
        if ('Project' == $relationName) {
            $this->initProjects();
        }
    }

    /**
     * Clears out the collBillings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Client The current object (for fluent API support)
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
     * If this Client is new, it will return
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
                    ->filterByClient($this)
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
     * @return Client The current object (for fluent API support)
     */
    public function setBillings(PropelCollection $billings, PropelPDO $con = null)
    {
        $billingsToDelete = $this->getBillings(new Criteria(), $con)->diff($billings);


        $this->billingsScheduledForDeletion = $billingsToDelete;

        foreach ($billingsToDelete as $billingRemoved) {
            $billingRemoved->setClient(null);
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
                ->filterByClient($this)
                ->count($con);
        }

        return count($this->collBillings);
    }

    /**
     * Method called to associate a Billing object to this object
     * through the Billing foreign key attribute.
     *
     * @param    Billing $l Billing
     * @return Client The current object (for fluent API support)
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
        $billing->setClient($this);
    }

    /**
     * @param	Billing $billing The billing object to remove.
     * @return Client The current object (for fluent API support)
     */
    public function removeBilling($billing)
    {
        if ($this->getBillings()->contains($billing)) {
            $this->collBillings->remove($this->collBillings->search($billing));
            if (null === $this->billingsScheduledForDeletion) {
                $this->billingsScheduledForDeletion = clone $this->collBillings;
                $this->billingsScheduledForDeletion->clear();
            }
            $this->billingsScheduledForDeletion[]= clone $billing;
            $billing->setClient(null);
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
    public function getBillingsJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('Currency', $join_behavior);

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
     * Clears out the collProjects collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Client The current object (for fluent API support)
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
     * If this Client is new, it will return
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
                    ->filterByClient($this)
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
     * @return Client The current object (for fluent API support)
     */
    public function setProjects(PropelCollection $projects, PropelPDO $con = null)
    {
        $projectsToDelete = $this->getProjects(new Criteria(), $con)->diff($projects);


        $this->projectsScheduledForDeletion = $projectsToDelete;

        foreach ($projectsToDelete as $projectRemoved) {
            $projectRemoved->setClient(null);
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
                ->filterByClient($this)
                ->count($con);
        }

        return count($this->collProjects);
    }

    /**
     * Method called to associate a Project object to this object
     * through the Project foreign key attribute.
     *
     * @param    Project $l Project
     * @return Client The current object (for fluent API support)
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
        $project->setClient($this);
    }

    /**
     * @param	Project $project The project object to remove.
     * @return Client The current object (for fluent API support)
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
            $project->setClient(null);
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
    public function getProjectsJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

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
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id_client = null;
        $this->name = null;
        $this->id_country = null;
        $this->phone = null;
        $this->phone_work = null;
        $this->ext = null;
        $this->email = null;
        $this->contact = null;
        $this->email2 = null;
        $this->phone_mobile = null;
        $this->website = null;
        $this->address_1 = null;
        $this->address_2 = null;
        $this->address_3 = null;
        $this->zip = null;
        $this->default_rate = null;
        $this->default_user = null;
        $this->default_category = null;
        $this->default_currency = null;
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
            if ($this->collProjects) {
                foreach ($this->collProjects as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aCountry instanceof Persistent) {
              $this->aCountry->clearAllReferences($deep);
            }
            if ($this->aAuthyRelatedByDefaultUser instanceof Persistent) {
              $this->aAuthyRelatedByDefaultUser->clearAllReferences($deep);
            }
            if ($this->aBillingCategory instanceof Persistent) {
              $this->aBillingCategory->clearAllReferences($deep);
            }
            if ($this->aCurrency instanceof Persistent) {
              $this->aCurrency->clearAllReferences($deep);
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
        if ($this->collProjects instanceof PropelCollection) {
            $this->collProjects->clearIterator();
        }
        $this->collProjects = null;
        $this->aCountry = null;
        $this->aAuthyRelatedByDefaultUser = null;
        $this->aBillingCategory = null;
        $this->aCurrency = null;
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
        return (string) $this->exportTo(ClientPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Client The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged(){
        $this->modifiedColumns[] = ClientPeer::DATE_MODIFICATION;

        return $this;
    }

}
