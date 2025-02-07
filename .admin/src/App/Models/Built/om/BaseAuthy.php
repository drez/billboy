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
use App\ApiLog;
use App\ApiLogQuery;
use App\ApiRbac;
use App\ApiRbacQuery;
use App\Authy;
use App\AuthyGroup;
use App\AuthyGroupQuery;
use App\AuthyGroupX;
use App\AuthyGroupXQuery;
use App\AuthyLog;
use App\AuthyLogQuery;
use App\AuthyPeer;
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
use App\Currency;
use App\CurrencyQuery;
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
 * Base class that represents a row from the 'authy' table.
 *
 * User
 *
 * @package    propel.generator..om
 */
abstract class BaseAuthy extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'App\\AuthyPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        AuthyPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id_authy field.
     * @var        int
     */
    protected $id_authy;

    /**
     * The value for the validation_key field.
     * @var        string
     */
    protected $validation_key;

    /**
     * The value for the username field.
     * @var        string
     */
    protected $username;

    /**
     * The value for the fullname field.
     * @var        string
     */
    protected $fullname;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the passwd_hash field.
     * @var        string
     */
    protected $passwd_hash;

    /**
     * The value for the expire field.
     * Note: this column has a database default value of: NULL
     * @var        string
     */
    protected $expire;

    /**
     * The value for the deactivate field.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $deactivate;

    /**
     * The value for the is_root field.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $is_root;

    /**
     * The value for the id_authy_group field.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $id_authy_group;

    /**
     * The value for the is_system field.
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $is_system;

    /**
     * The value for the rights_all field.
     * @var        string
     */
    protected $rights_all;

    /**
     * The value for the rights_group field.
     * @var        string
     */
    protected $rights_group;

    /**
     * The value for the rights_owner field.
     * @var        string
     */
    protected $rights_owner;

    /**
     * The value for the onglet field.
     * @var        string
     */
    protected $onglet;

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
    protected $aAuthyGroupRelatedByIdAuthyGroup;

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
     * @var        PropelObjectCollection|Client[] Collection to store aggregation of Client objects.
     */
    protected $collClientsRelatedByDefaultUser;
    protected $collClientsRelatedByDefaultUserPartial;

    /**
     * @var        PropelObjectCollection|BillingLine[] Collection to store aggregation of BillingLine objects.
     */
    protected $collBillingLinesRelatedByIdAssign;
    protected $collBillingLinesRelatedByIdAssignPartial;

    /**
     * @var        PropelObjectCollection|AuthyGroupX[] Collection to store aggregation of AuthyGroupX objects.
     */
    protected $collAuthyGroupxes;
    protected $collAuthyGroupxesPartial;

    /**
     * @var        PropelObjectCollection|AuthyLog[] Collection to store aggregation of AuthyLog objects.
     */
    protected $collAuthyLogs;
    protected $collAuthyLogsPartial;

    /**
     * @var        PropelObjectCollection|Client[] Collection to store aggregation of Client objects.
     */
    protected $collClientsRelatedByIdCreation;
    protected $collClientsRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|Client[] Collection to store aggregation of Client objects.
     */
    protected $collClientsRelatedByIdModification;
    protected $collClientsRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|Billing[] Collection to store aggregation of Billing objects.
     */
    protected $collBillingsRelatedByIdCreation;
    protected $collBillingsRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|Billing[] Collection to store aggregation of Billing objects.
     */
    protected $collBillingsRelatedByIdModification;
    protected $collBillingsRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|BillingLine[] Collection to store aggregation of BillingLine objects.
     */
    protected $collBillingLinesRelatedByIdCreation;
    protected $collBillingLinesRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|BillingLine[] Collection to store aggregation of BillingLine objects.
     */
    protected $collBillingLinesRelatedByIdModification;
    protected $collBillingLinesRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|PaymentLine[] Collection to store aggregation of PaymentLine objects.
     */
    protected $collPaymentLinesRelatedByIdCreation;
    protected $collPaymentLinesRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|PaymentLine[] Collection to store aggregation of PaymentLine objects.
     */
    protected $collPaymentLinesRelatedByIdModification;
    protected $collPaymentLinesRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|CostLine[] Collection to store aggregation of CostLine objects.
     */
    protected $collCostLinesRelatedByIdCreation;
    protected $collCostLinesRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|CostLine[] Collection to store aggregation of CostLine objects.
     */
    protected $collCostLinesRelatedByIdModification;
    protected $collCostLinesRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|Project[] Collection to store aggregation of Project objects.
     */
    protected $collProjectsRelatedByIdCreation;
    protected $collProjectsRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|Project[] Collection to store aggregation of Project objects.
     */
    protected $collProjectsRelatedByIdModification;
    protected $collProjectsRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|TimeLine[] Collection to store aggregation of TimeLine objects.
     */
    protected $collTimeLinesRelatedByIdCreation;
    protected $collTimeLinesRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|TimeLine[] Collection to store aggregation of TimeLine objects.
     */
    protected $collTimeLinesRelatedByIdModification;
    protected $collTimeLinesRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|BillingCategory[] Collection to store aggregation of BillingCategory objects.
     */
    protected $collBillingCategoriesRelatedByIdCreation;
    protected $collBillingCategoriesRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|BillingCategory[] Collection to store aggregation of BillingCategory objects.
     */
    protected $collBillingCategoriesRelatedByIdModification;
    protected $collBillingCategoriesRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|Currency[] Collection to store aggregation of Currency objects.
     */
    protected $collCurrenciesRelatedByIdCreation;
    protected $collCurrenciesRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|Currency[] Collection to store aggregation of Currency objects.
     */
    protected $collCurrenciesRelatedByIdModification;
    protected $collCurrenciesRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|Supplier[] Collection to store aggregation of Supplier objects.
     */
    protected $collSuppliersRelatedByIdCreation;
    protected $collSuppliersRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|Supplier[] Collection to store aggregation of Supplier objects.
     */
    protected $collSuppliersRelatedByIdModification;
    protected $collSuppliersRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|Authy[] Collection to store aggregation of Authy objects.
     */
    protected $collAuthiesRelatedByIdAuthy0;
    protected $collAuthiesRelatedByIdAuthy0Partial;

    /**
     * @var        PropelObjectCollection|Authy[] Collection to store aggregation of Authy objects.
     */
    protected $collAuthiesRelatedByIdAuthy1;
    protected $collAuthiesRelatedByIdAuthy1Partial;

    /**
     * @var        PropelObjectCollection|Country[] Collection to store aggregation of Country objects.
     */
    protected $collCountriesRelatedByIdCreation;
    protected $collCountriesRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|Country[] Collection to store aggregation of Country objects.
     */
    protected $collCountriesRelatedByIdModification;
    protected $collCountriesRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|AuthyGroup[] Collection to store aggregation of AuthyGroup objects.
     */
    protected $collAuthyGroupsRelatedByIdCreation;
    protected $collAuthyGroupsRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|AuthyGroup[] Collection to store aggregation of AuthyGroup objects.
     */
    protected $collAuthyGroupsRelatedByIdModification;
    protected $collAuthyGroupsRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|Config[] Collection to store aggregation of Config objects.
     */
    protected $collConfigsRelatedByIdCreation;
    protected $collConfigsRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|Config[] Collection to store aggregation of Config objects.
     */
    protected $collConfigsRelatedByIdModification;
    protected $collConfigsRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|ApiRbac[] Collection to store aggregation of ApiRbac objects.
     */
    protected $collApiRbacsRelatedByIdCreation;
    protected $collApiRbacsRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|ApiRbac[] Collection to store aggregation of ApiRbac objects.
     */
    protected $collApiRbacsRelatedByIdModification;
    protected $collApiRbacsRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|ApiLog[] Collection to store aggregation of ApiLog objects.
     */
    protected $collApiLogs;
    protected $collApiLogsPartial;

    /**
     * @var        PropelObjectCollection|Template[] Collection to store aggregation of Template objects.
     */
    protected $collTemplatesRelatedByIdCreation;
    protected $collTemplatesRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|Template[] Collection to store aggregation of Template objects.
     */
    protected $collTemplatesRelatedByIdModification;
    protected $collTemplatesRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|TemplateFile[] Collection to store aggregation of TemplateFile objects.
     */
    protected $collTemplateFilesRelatedByIdCreation;
    protected $collTemplateFilesRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|TemplateFile[] Collection to store aggregation of TemplateFile objects.
     */
    protected $collTemplateFilesRelatedByIdModification;
    protected $collTemplateFilesRelatedByIdModificationPartial;

    /**
     * @var        PropelObjectCollection|MessageI18n[] Collection to store aggregation of MessageI18n objects.
     */
    protected $collMessageI18nsRelatedByIdCreation;
    protected $collMessageI18nsRelatedByIdCreationPartial;

    /**
     * @var        PropelObjectCollection|MessageI18n[] Collection to store aggregation of MessageI18n objects.
     */
    protected $collMessageI18nsRelatedByIdModification;
    protected $collMessageI18nsRelatedByIdModificationPartial;

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
    protected $clientsRelatedByDefaultUserScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $billingLinesRelatedByIdAssignScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $authyGroupxesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $authyLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $clientsRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $clientsRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $billingsRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $billingsRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $billingLinesRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $billingLinesRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $paymentLinesRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $paymentLinesRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $costLinesRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $costLinesRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $projectsRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $projectsRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $timeLinesRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $timeLinesRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $billingCategoriesRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $billingCategoriesRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $currenciesRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $currenciesRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $suppliersRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $suppliersRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $authiesRelatedByIdAuthy0ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $authiesRelatedByIdAuthy1ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $countriesRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $countriesRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $authyGroupsRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $authyGroupsRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $configsRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $configsRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $apiRbacsRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $apiRbacsRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $apiLogsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $templatesRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $templatesRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $templateFilesRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $templateFilesRelatedByIdModificationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $messageI18nsRelatedByIdCreationScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $messageI18nsRelatedByIdModificationScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->expire = NULL;
        $this->deactivate = 1;
        $this->is_root = 1;
        $this->id_authy_group = 1;
        $this->is_system = 1;
    }

    /**
     * Initializes internal state of BaseAuthy object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * @Field()
     * Get the [id_authy] column value.
     *
     * @return int
     */
    public function getIdAuthy()
    {

        return $this->id_authy;
    }

    /**
     * @Field()
     * Get the [validation_key] column value.
     *
     * @return string
     */
    public function getValidationKey()
    {

        return $this->validation_key;
    }

    /**
     * @Field()
     * Get the [username] column value.
     * Username
     * @return string
     */
    public function getUsername()
    {

        return $this->username;
    }

    /**
     * @Field()
     * Get the [fullname] column value.
     * Fullname
     * @return string
     */
    public function getFullname()
    {

        return $this->fullname;
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
     * Get the [passwd_hash] column value.
     * Password
     * @return string
     */
    public function getPasswdHash()
    {

        return $this->passwd_hash;
    }

    /**
     * @Field()
     * Get the [optionally formatted] temporal [expire] column value.
     * Expiration
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getExpire($format = 'Y-m-d')
    {
        if ($this->expire === null) {
            return null;
        }

        if ($this->expire === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->expire);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->expire, true), $x);
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
     * Get the [deactivate] column value.
     * Deactivated
     * @return int
     * @throws PropelException - if the stored enum key is unknown.
     */
    public function getDeactivate()
    {
        if (null === $this->deactivate) {
            return null;
        }
        $valueSet = AuthyPeer::getValueSet(AuthyPeer::DEACTIVATE);
        if (!isset($valueSet[$this->deactivate])) {
            throw new PropelException('Unknown stored enum key: ' . $this->deactivate);
        }

        return $valueSet[$this->deactivate];
    }

    /**
     * @Field()
     * Get the [is_root] column value.
     *
     * @return int
     * @throws PropelException - if the stored enum key is unknown.
     */
    public function getIsRoot()
    {
        if (null === $this->is_root) {
            return null;
        }
        $valueSet = AuthyPeer::getValueSet(AuthyPeer::IS_ROOT);
        if (!isset($valueSet[$this->is_root])) {
            throw new PropelException('Unknown stored enum key: ' . $this->is_root);
        }

        return $valueSet[$this->is_root];
    }

    /**
     * @Field()
     * Get the [id_authy_group] column value.
     * Primary group
     * @return int
     */
    public function getIdAuthyGroup()
    {

        return $this->id_authy_group;
    }

    /**
     * @Field()
     * Get the [is_system] column value.
     *
     * @return int
     * @throws PropelException - if the stored enum key is unknown.
     */
    public function getIsSystem()
    {
        if (null === $this->is_system) {
            return null;
        }
        $valueSet = AuthyPeer::getValueSet(AuthyPeer::IS_SYSTEM);
        if (!isset($valueSet[$this->is_system])) {
            throw new PropelException('Unknown stored enum key: ' . $this->is_system);
        }

        return $valueSet[$this->is_system];
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
     * Get the [onglet] column value.
     *
     * @return string
     */
    public function getOnglet()
    {

        return $this->onglet;
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
     * Set the value of [id_authy] column.
     *
     * @param  int $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setIdAuthy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_authy !== $v) {
            $this->id_authy = $v;
            $this->modifiedColumns[] = AuthyPeer::ID_AUTHY;
        }


        return $this;
    } // setIdAuthy()

    /**
     * Set the value of [validation_key] column.
     *
     * @param  string $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setValidationKey($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->validation_key !== $v) {
            $this->validation_key = $v;
            $this->modifiedColumns[] = AuthyPeer::VALIDATION_KEY;
        }


        return $this;
    } // setValidationKey()

    /**
     * Set the value of [username] column.
     * Username
     * @param  string $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setUsername($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->username !== $v) {
            $this->username = $v;
            $this->modifiedColumns[] = AuthyPeer::USERNAME;
        }


        return $this;
    } // setUsername()

    /**
     * Set the value of [fullname] column.
     * Fullname
     * @param  string $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setFullname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->fullname !== $v) {
            $this->fullname = $v;
            $this->modifiedColumns[] = AuthyPeer::FULLNAME;
        }


        return $this;
    } // setFullname()

    /**
     * Set the value of [email] column.
     * Email
     * @param  string $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = AuthyPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [passwd_hash] column.
     * Password
     * @param  string $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setPasswdHash($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->passwd_hash !== $v) {
            $this->passwd_hash = $v;
            $this->modifiedColumns[] = AuthyPeer::PASSWD_HASH;
        }


        return $this;
    } // setPasswdHash()

    /**
     * Sets the value of [expire] column to a normalized version of the date/time value specified.
     * Expiration
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Authy The current object (for fluent API support)
     */
    public function setExpire($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->expire !== null || $dt !== null) {
            $currentDateAsString = ($this->expire !== null && $tmpDt = new DateTime($this->expire)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ( ($currentDateAsString !== $newDateAsString) // normalized values don't match
                || ($dt->format('Y-m-d') === NULL) // or the entered value matches the default
                 ) {
                $this->expire = $newDateAsString;
                $this->modifiedColumns[] = AuthyPeer::EXPIRE;
            }
        } // if either are not null


        return $this;
    } // setExpire()

    /**
     * Set the value of [deactivate] column.
     * Deactivated
     * @param  int $v new value
     * @return Authy The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setDeactivate($v)
    {
        if ($v !== null) {
            $valueSet = AuthyPeer::getValueSet(AuthyPeer::DEACTIVATE);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->deactivate !== $v) {
            $this->deactivate = $v;
            $this->modifiedColumns[] = AuthyPeer::DEACTIVATE;
        }


        return $this;
    } // setDeactivate()

    /**
     * Set the value of [is_root] column.
     *
     * @param  int $v new value
     * @return Authy The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setIsRoot($v)
    {
        if ($v !== null) {
            $valueSet = AuthyPeer::getValueSet(AuthyPeer::IS_ROOT);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->is_root !== $v) {
            $this->is_root = $v;
            $this->modifiedColumns[] = AuthyPeer::IS_ROOT;
        }


        return $this;
    } // setIsRoot()

    /**
     * Set the value of [id_authy_group] column.
     * Primary group
     * @param  int $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setIdAuthyGroup($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_authy_group !== $v) {
            $this->id_authy_group = $v;
            $this->modifiedColumns[] = AuthyPeer::ID_AUTHY_GROUP;
        }

        if ($this->aAuthyGroupRelatedByIdAuthyGroup !== null && $this->aAuthyGroupRelatedByIdAuthyGroup->getIdAuthyGroup() !== $v) {
            $this->aAuthyGroupRelatedByIdAuthyGroup = null;
        }


        return $this;
    } // setIdAuthyGroup()

    /**
     * Set the value of [is_system] column.
     *
     * @param  int $v new value
     * @return Authy The current object (for fluent API support)
     * @throws PropelException - if the value is not accepted by this enum.
     */
    public function setIsSystem($v)
    {
        if ($v !== null) {
            $valueSet = AuthyPeer::getValueSet(AuthyPeer::IS_SYSTEM);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->is_system !== $v) {
            $this->is_system = $v;
            $this->modifiedColumns[] = AuthyPeer::IS_SYSTEM;
        }


        return $this;
    } // setIsSystem()

    /**
     * Set the value of [rights_all] column.
     * Rights
     * @param  string $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setRightsAll($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rights_all !== $v) {
            $this->rights_all = $v;
            $this->modifiedColumns[] = AuthyPeer::RIGHTS_ALL;
        }


        return $this;
    } // setRightsAll()

    /**
     * Set the value of [rights_group] column.
     * Rights group
     * @param  string $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setRightsGroup($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rights_group !== $v) {
            $this->rights_group = $v;
            $this->modifiedColumns[] = AuthyPeer::RIGHTS_GROUP;
        }


        return $this;
    } // setRightsGroup()

    /**
     * Set the value of [rights_owner] column.
     * Rights owner
     * @param  string $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setRightsOwner($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rights_owner !== $v) {
            $this->rights_owner = $v;
            $this->modifiedColumns[] = AuthyPeer::RIGHTS_OWNER;
        }


        return $this;
    } // setRightsOwner()

    /**
     * Set the value of [onglet] column.
     *
     * @param  string $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setOnglet($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->onglet !== $v) {
            $this->onglet = $v;
            $this->modifiedColumns[] = AuthyPeer::ONGLET;
        }


        return $this;
    } // setOnglet()

    /**
     * Sets the value of [date_creation] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Authy The current object (for fluent API support)
     */
    public function setDateCreation($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_creation !== null || $dt !== null) {
            $currentDateAsString = ($this->date_creation !== null && $tmpDt = new DateTime($this->date_creation)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_creation = $newDateAsString;
                $this->modifiedColumns[] = AuthyPeer::DATE_CREATION;
            }
        } // if either are not null


        return $this;
    } // setDateCreation()

    /**
     * Sets the value of [date_modification] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Authy The current object (for fluent API support)
     */
    public function setDateModification($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_modification !== null || $dt !== null) {
            $currentDateAsString = ($this->date_modification !== null && $tmpDt = new DateTime($this->date_modification)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_modification = $newDateAsString;
                $this->modifiedColumns[] = AuthyPeer::DATE_MODIFICATION;
            }
        } // if either are not null


        return $this;
    } // setDateModification()

    /**
     * Set the value of [id_group_creation] column.
     *
     * @param  int $v new value
     * @return Authy The current object (for fluent API support)
     */
    public function setIdGroupCreation($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_group_creation !== $v) {
            $this->id_group_creation = $v;
            $this->modifiedColumns[] = AuthyPeer::ID_GROUP_CREATION;
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
     * @return Authy The current object (for fluent API support)
     */
    public function setIdCreation($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_creation !== $v) {
            $this->id_creation = $v;
            $this->modifiedColumns[] = AuthyPeer::ID_CREATION;
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
     * @return Authy The current object (for fluent API support)
     */
    public function setIdModification($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id_modification !== $v) {
            $this->id_modification = $v;
            $this->modifiedColumns[] = AuthyPeer::ID_MODIFICATION;
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
            if ($this->expire !== NULL) {
                return false;
            }

            if ($this->deactivate !== 1) {
                return false;
            }

            if ($this->is_root !== 1) {
                return false;
            }

            if ($this->id_authy_group !== 1) {
                return false;
            }

            if ($this->is_system !== 1) {
                return false;
            }

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

            $this->id_authy = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->validation_key = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->username = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->fullname = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->email = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->passwd_hash = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->expire = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->deactivate = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->is_root = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->id_authy_group = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->is_system = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->rights_all = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
            $this->rights_group = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
            $this->rights_owner = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
            $this->onglet = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->date_creation = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
            $this->date_modification = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->id_group_creation = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
            $this->id_creation = ($row[$startcol + 18] !== null) ? (int) $row[$startcol + 18] : null;
            $this->id_modification = ($row[$startcol + 19] !== null) ? (int) $row[$startcol + 19] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 20; // 20 = AuthyPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Authy object", $e);
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

        if ($this->aAuthyGroupRelatedByIdAuthyGroup !== null && $this->id_authy_group !== $this->aAuthyGroupRelatedByIdAuthyGroup->getIdAuthyGroup()) {
            $this->aAuthyGroupRelatedByIdAuthyGroup = null;
        }
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
            $con = Propel::getConnection(AuthyPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = AuthyPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAuthyGroupRelatedByIdAuthyGroup = null;
            $this->aAuthyGroupRelatedByIdGroupCreation = null;
            $this->aAuthyRelatedByIdCreation = null;
            $this->aAuthyRelatedByIdModification = null;
            $this->collClientsRelatedByDefaultUser = null;

            $this->collBillingLinesRelatedByIdAssign = null;

            $this->collAuthyGroupxes = null;

            $this->collAuthyLogs = null;

            $this->collClientsRelatedByIdCreation = null;

            $this->collClientsRelatedByIdModification = null;

            $this->collBillingsRelatedByIdCreation = null;

            $this->collBillingsRelatedByIdModification = null;

            $this->collBillingLinesRelatedByIdCreation = null;

            $this->collBillingLinesRelatedByIdModification = null;

            $this->collPaymentLinesRelatedByIdCreation = null;

            $this->collPaymentLinesRelatedByIdModification = null;

            $this->collCostLinesRelatedByIdCreation = null;

            $this->collCostLinesRelatedByIdModification = null;

            $this->collProjectsRelatedByIdCreation = null;

            $this->collProjectsRelatedByIdModification = null;

            $this->collTimeLinesRelatedByIdCreation = null;

            $this->collTimeLinesRelatedByIdModification = null;

            $this->collBillingCategoriesRelatedByIdCreation = null;

            $this->collBillingCategoriesRelatedByIdModification = null;

            $this->collCurrenciesRelatedByIdCreation = null;

            $this->collCurrenciesRelatedByIdModification = null;

            $this->collSuppliersRelatedByIdCreation = null;

            $this->collSuppliersRelatedByIdModification = null;

            $this->collAuthiesRelatedByIdAuthy0 = null;

            $this->collAuthiesRelatedByIdAuthy1 = null;

            $this->collCountriesRelatedByIdCreation = null;

            $this->collCountriesRelatedByIdModification = null;

            $this->collAuthyGroupsRelatedByIdCreation = null;

            $this->collAuthyGroupsRelatedByIdModification = null;

            $this->collConfigsRelatedByIdCreation = null;

            $this->collConfigsRelatedByIdModification = null;

            $this->collApiRbacsRelatedByIdCreation = null;

            $this->collApiRbacsRelatedByIdModification = null;

            $this->collApiLogs = null;

            $this->collTemplatesRelatedByIdCreation = null;

            $this->collTemplatesRelatedByIdModification = null;

            $this->collTemplateFilesRelatedByIdCreation = null;

            $this->collTemplateFilesRelatedByIdModification = null;

            $this->collMessageI18nsRelatedByIdCreation = null;

            $this->collMessageI18nsRelatedByIdModification = null;

            $this->collAuthyGroups = null;
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
            $con = Propel::getConnection(AuthyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = AuthyQuery::create()
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
            $con = Propel::getConnection(AuthyPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            // GoatCheese behavior

            if ($isInsert) {
                \ApiGoat\Model\Authy::setDefaultsGroupRights($this);
            }
            if(method_exists($this, 'getEmail')){
                $this->setEmail(strtolower($this->getEmail()));
            }

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
                AuthyPeer::addInstanceToPool($this);
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

            if ($this->aAuthyGroupRelatedByIdAuthyGroup !== null) {
                if ($this->aAuthyGroupRelatedByIdAuthyGroup->isModified() || $this->aAuthyGroupRelatedByIdAuthyGroup->isNew()) {
                    $affectedRows += $this->aAuthyGroupRelatedByIdAuthyGroup->save($con);
                }
                $this->setAuthyGroupRelatedByIdAuthyGroup($this->aAuthyGroupRelatedByIdAuthyGroup);
            }

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

            if ($this->authyGroupsScheduledForDeletion !== null) {
                if (!$this->authyGroupsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->authyGroupsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    AuthyGroupXQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->authyGroupsScheduledForDeletion = null;
                }

                foreach ($this->getAuthyGroups() as $authyGroup) {
                    if ($authyGroup->isModified()) {
                        $authyGroup->save($con);
                    }
                }
            } elseif ($this->collAuthyGroups) {
                foreach ($this->collAuthyGroups as $authyGroup) {
                    if ($authyGroup->isModified()) {
                        $authyGroup->save($con);
                    }
                }
            }

            if ($this->clientsRelatedByDefaultUserScheduledForDeletion !== null) {
                if (!$this->clientsRelatedByDefaultUserScheduledForDeletion->isEmpty()) {
                    foreach ($this->clientsRelatedByDefaultUserScheduledForDeletion as $clientRelatedByDefaultUser) {
                        // need to save related object because we set the relation to null
                        $clientRelatedByDefaultUser->save($con);
                    }
                    $this->clientsRelatedByDefaultUserScheduledForDeletion = null;
                }
            }

            if ($this->collClientsRelatedByDefaultUser !== null) {
                foreach ($this->collClientsRelatedByDefaultUser as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->billingLinesRelatedByIdAssignScheduledForDeletion !== null) {
                if (!$this->billingLinesRelatedByIdAssignScheduledForDeletion->isEmpty()) {
                    foreach ($this->billingLinesRelatedByIdAssignScheduledForDeletion as $billingLineRelatedByIdAssign) {
                        // need to save related object because we set the relation to null
                        $billingLineRelatedByIdAssign->save($con);
                    }
                    $this->billingLinesRelatedByIdAssignScheduledForDeletion = null;
                }
            }

            if ($this->collBillingLinesRelatedByIdAssign !== null) {
                foreach ($this->collBillingLinesRelatedByIdAssign as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
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

            if ($this->authyLogsScheduledForDeletion !== null) {
                if (!$this->authyLogsScheduledForDeletion->isEmpty()) {
                    foreach ($this->authyLogsScheduledForDeletion as $authyLog) {
                        // need to save related object because we set the relation to null
                        $authyLog->save($con);
                    }
                    $this->authyLogsScheduledForDeletion = null;
                }
            }

            if ($this->collAuthyLogs !== null) {
                foreach ($this->collAuthyLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->clientsRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->clientsRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->clientsRelatedByIdCreationScheduledForDeletion as $clientRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $clientRelatedByIdCreation->save($con);
                    }
                    $this->clientsRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collClientsRelatedByIdCreation !== null) {
                foreach ($this->collClientsRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->clientsRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->clientsRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->clientsRelatedByIdModificationScheduledForDeletion as $clientRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $clientRelatedByIdModification->save($con);
                    }
                    $this->clientsRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collClientsRelatedByIdModification !== null) {
                foreach ($this->collClientsRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->billingsRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->billingsRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->billingsRelatedByIdCreationScheduledForDeletion as $billingRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $billingRelatedByIdCreation->save($con);
                    }
                    $this->billingsRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collBillingsRelatedByIdCreation !== null) {
                foreach ($this->collBillingsRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->billingsRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->billingsRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->billingsRelatedByIdModificationScheduledForDeletion as $billingRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $billingRelatedByIdModification->save($con);
                    }
                    $this->billingsRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collBillingsRelatedByIdModification !== null) {
                foreach ($this->collBillingsRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->billingLinesRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->billingLinesRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->billingLinesRelatedByIdCreationScheduledForDeletion as $billingLineRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $billingLineRelatedByIdCreation->save($con);
                    }
                    $this->billingLinesRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collBillingLinesRelatedByIdCreation !== null) {
                foreach ($this->collBillingLinesRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->billingLinesRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->billingLinesRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->billingLinesRelatedByIdModificationScheduledForDeletion as $billingLineRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $billingLineRelatedByIdModification->save($con);
                    }
                    $this->billingLinesRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collBillingLinesRelatedByIdModification !== null) {
                foreach ($this->collBillingLinesRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->paymentLinesRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->paymentLinesRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->paymentLinesRelatedByIdCreationScheduledForDeletion as $paymentLineRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $paymentLineRelatedByIdCreation->save($con);
                    }
                    $this->paymentLinesRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collPaymentLinesRelatedByIdCreation !== null) {
                foreach ($this->collPaymentLinesRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->paymentLinesRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->paymentLinesRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->paymentLinesRelatedByIdModificationScheduledForDeletion as $paymentLineRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $paymentLineRelatedByIdModification->save($con);
                    }
                    $this->paymentLinesRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collPaymentLinesRelatedByIdModification !== null) {
                foreach ($this->collPaymentLinesRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->costLinesRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->costLinesRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->costLinesRelatedByIdCreationScheduledForDeletion as $costLineRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $costLineRelatedByIdCreation->save($con);
                    }
                    $this->costLinesRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collCostLinesRelatedByIdCreation !== null) {
                foreach ($this->collCostLinesRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->costLinesRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->costLinesRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->costLinesRelatedByIdModificationScheduledForDeletion as $costLineRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $costLineRelatedByIdModification->save($con);
                    }
                    $this->costLinesRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collCostLinesRelatedByIdModification !== null) {
                foreach ($this->collCostLinesRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->projectsRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->projectsRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->projectsRelatedByIdCreationScheduledForDeletion as $projectRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $projectRelatedByIdCreation->save($con);
                    }
                    $this->projectsRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collProjectsRelatedByIdCreation !== null) {
                foreach ($this->collProjectsRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->projectsRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->projectsRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->projectsRelatedByIdModificationScheduledForDeletion as $projectRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $projectRelatedByIdModification->save($con);
                    }
                    $this->projectsRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collProjectsRelatedByIdModification !== null) {
                foreach ($this->collProjectsRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->timeLinesRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->timeLinesRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->timeLinesRelatedByIdCreationScheduledForDeletion as $timeLineRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $timeLineRelatedByIdCreation->save($con);
                    }
                    $this->timeLinesRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collTimeLinesRelatedByIdCreation !== null) {
                foreach ($this->collTimeLinesRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->timeLinesRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->timeLinesRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->timeLinesRelatedByIdModificationScheduledForDeletion as $timeLineRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $timeLineRelatedByIdModification->save($con);
                    }
                    $this->timeLinesRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collTimeLinesRelatedByIdModification !== null) {
                foreach ($this->collTimeLinesRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->billingCategoriesRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->billingCategoriesRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->billingCategoriesRelatedByIdCreationScheduledForDeletion as $billingCategoryRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $billingCategoryRelatedByIdCreation->save($con);
                    }
                    $this->billingCategoriesRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collBillingCategoriesRelatedByIdCreation !== null) {
                foreach ($this->collBillingCategoriesRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->billingCategoriesRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->billingCategoriesRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->billingCategoriesRelatedByIdModificationScheduledForDeletion as $billingCategoryRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $billingCategoryRelatedByIdModification->save($con);
                    }
                    $this->billingCategoriesRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collBillingCategoriesRelatedByIdModification !== null) {
                foreach ($this->collBillingCategoriesRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->currenciesRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->currenciesRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->currenciesRelatedByIdCreationScheduledForDeletion as $currencyRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $currencyRelatedByIdCreation->save($con);
                    }
                    $this->currenciesRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collCurrenciesRelatedByIdCreation !== null) {
                foreach ($this->collCurrenciesRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->currenciesRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->currenciesRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->currenciesRelatedByIdModificationScheduledForDeletion as $currencyRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $currencyRelatedByIdModification->save($con);
                    }
                    $this->currenciesRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collCurrenciesRelatedByIdModification !== null) {
                foreach ($this->collCurrenciesRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->suppliersRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->suppliersRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->suppliersRelatedByIdCreationScheduledForDeletion as $supplierRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $supplierRelatedByIdCreation->save($con);
                    }
                    $this->suppliersRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collSuppliersRelatedByIdCreation !== null) {
                foreach ($this->collSuppliersRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->suppliersRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->suppliersRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->suppliersRelatedByIdModificationScheduledForDeletion as $supplierRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $supplierRelatedByIdModification->save($con);
                    }
                    $this->suppliersRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collSuppliersRelatedByIdModification !== null) {
                foreach ($this->collSuppliersRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->authiesRelatedByIdAuthy0ScheduledForDeletion !== null) {
                if (!$this->authiesRelatedByIdAuthy0ScheduledForDeletion->isEmpty()) {
                    foreach ($this->authiesRelatedByIdAuthy0ScheduledForDeletion as $authyRelatedByIdAuthy0) {
                        // need to save related object because we set the relation to null
                        $authyRelatedByIdAuthy0->save($con);
                    }
                    $this->authiesRelatedByIdAuthy0ScheduledForDeletion = null;
                }
            }

            if ($this->collAuthiesRelatedByIdAuthy0 !== null) {
                foreach ($this->collAuthiesRelatedByIdAuthy0 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->authiesRelatedByIdAuthy1ScheduledForDeletion !== null) {
                if (!$this->authiesRelatedByIdAuthy1ScheduledForDeletion->isEmpty()) {
                    foreach ($this->authiesRelatedByIdAuthy1ScheduledForDeletion as $authyRelatedByIdAuthy1) {
                        // need to save related object because we set the relation to null
                        $authyRelatedByIdAuthy1->save($con);
                    }
                    $this->authiesRelatedByIdAuthy1ScheduledForDeletion = null;
                }
            }

            if ($this->collAuthiesRelatedByIdAuthy1 !== null) {
                foreach ($this->collAuthiesRelatedByIdAuthy1 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->countriesRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->countriesRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->countriesRelatedByIdCreationScheduledForDeletion as $countryRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $countryRelatedByIdCreation->save($con);
                    }
                    $this->countriesRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collCountriesRelatedByIdCreation !== null) {
                foreach ($this->collCountriesRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->countriesRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->countriesRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->countriesRelatedByIdModificationScheduledForDeletion as $countryRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $countryRelatedByIdModification->save($con);
                    }
                    $this->countriesRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collCountriesRelatedByIdModification !== null) {
                foreach ($this->collCountriesRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->authyGroupsRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->authyGroupsRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->authyGroupsRelatedByIdCreationScheduledForDeletion as $authyGroupRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $authyGroupRelatedByIdCreation->save($con);
                    }
                    $this->authyGroupsRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collAuthyGroupsRelatedByIdCreation !== null) {
                foreach ($this->collAuthyGroupsRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->authyGroupsRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->authyGroupsRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->authyGroupsRelatedByIdModificationScheduledForDeletion as $authyGroupRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $authyGroupRelatedByIdModification->save($con);
                    }
                    $this->authyGroupsRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collAuthyGroupsRelatedByIdModification !== null) {
                foreach ($this->collAuthyGroupsRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->configsRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->configsRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->configsRelatedByIdCreationScheduledForDeletion as $configRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $configRelatedByIdCreation->save($con);
                    }
                    $this->configsRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collConfigsRelatedByIdCreation !== null) {
                foreach ($this->collConfigsRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->configsRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->configsRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->configsRelatedByIdModificationScheduledForDeletion as $configRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $configRelatedByIdModification->save($con);
                    }
                    $this->configsRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collConfigsRelatedByIdModification !== null) {
                foreach ($this->collConfigsRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->apiRbacsRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->apiRbacsRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->apiRbacsRelatedByIdCreationScheduledForDeletion as $apiRbacRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $apiRbacRelatedByIdCreation->save($con);
                    }
                    $this->apiRbacsRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collApiRbacsRelatedByIdCreation !== null) {
                foreach ($this->collApiRbacsRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->apiRbacsRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->apiRbacsRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->apiRbacsRelatedByIdModificationScheduledForDeletion as $apiRbacRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $apiRbacRelatedByIdModification->save($con);
                    }
                    $this->apiRbacsRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collApiRbacsRelatedByIdModification !== null) {
                foreach ($this->collApiRbacsRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->apiLogsScheduledForDeletion !== null) {
                if (!$this->apiLogsScheduledForDeletion->isEmpty()) {
                    ApiLogQuery::create()
                        ->filterByPrimaryKeys($this->apiLogsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->apiLogsScheduledForDeletion = null;
                }
            }

            if ($this->collApiLogs !== null) {
                foreach ($this->collApiLogs as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->templatesRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->templatesRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->templatesRelatedByIdCreationScheduledForDeletion as $templateRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $templateRelatedByIdCreation->save($con);
                    }
                    $this->templatesRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collTemplatesRelatedByIdCreation !== null) {
                foreach ($this->collTemplatesRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->templatesRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->templatesRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->templatesRelatedByIdModificationScheduledForDeletion as $templateRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $templateRelatedByIdModification->save($con);
                    }
                    $this->templatesRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collTemplatesRelatedByIdModification !== null) {
                foreach ($this->collTemplatesRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->templateFilesRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->templateFilesRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->templateFilesRelatedByIdCreationScheduledForDeletion as $templateFileRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $templateFileRelatedByIdCreation->save($con);
                    }
                    $this->templateFilesRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collTemplateFilesRelatedByIdCreation !== null) {
                foreach ($this->collTemplateFilesRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->templateFilesRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->templateFilesRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->templateFilesRelatedByIdModificationScheduledForDeletion as $templateFileRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $templateFileRelatedByIdModification->save($con);
                    }
                    $this->templateFilesRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collTemplateFilesRelatedByIdModification !== null) {
                foreach ($this->collTemplateFilesRelatedByIdModification as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->messageI18nsRelatedByIdCreationScheduledForDeletion !== null) {
                if (!$this->messageI18nsRelatedByIdCreationScheduledForDeletion->isEmpty()) {
                    foreach ($this->messageI18nsRelatedByIdCreationScheduledForDeletion as $messageI18nRelatedByIdCreation) {
                        // need to save related object because we set the relation to null
                        $messageI18nRelatedByIdCreation->save($con);
                    }
                    $this->messageI18nsRelatedByIdCreationScheduledForDeletion = null;
                }
            }

            if ($this->collMessageI18nsRelatedByIdCreation !== null) {
                foreach ($this->collMessageI18nsRelatedByIdCreation as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->messageI18nsRelatedByIdModificationScheduledForDeletion !== null) {
                if (!$this->messageI18nsRelatedByIdModificationScheduledForDeletion->isEmpty()) {
                    foreach ($this->messageI18nsRelatedByIdModificationScheduledForDeletion as $messageI18nRelatedByIdModification) {
                        // need to save related object because we set the relation to null
                        $messageI18nRelatedByIdModification->save($con);
                    }
                    $this->messageI18nsRelatedByIdModificationScheduledForDeletion = null;
                }
            }

            if ($this->collMessageI18nsRelatedByIdModification !== null) {
                foreach ($this->collMessageI18nsRelatedByIdModification as $referrerFK) {
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

        $this->modifiedColumns[] = AuthyPeer::ID_AUTHY;
        if (null !== $this->id_authy) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AuthyPeer::ID_AUTHY . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AuthyPeer::ID_AUTHY)) {
            $modifiedColumns[':p' . $index++]  = '`id_authy`';
        }
        if ($this->isColumnModified(AuthyPeer::VALIDATION_KEY)) {
            $modifiedColumns[':p' . $index++]  = '`validation_key`';
        }
        if ($this->isColumnModified(AuthyPeer::USERNAME)) {
            $modifiedColumns[':p' . $index++]  = '`username`';
        }
        if ($this->isColumnModified(AuthyPeer::FULLNAME)) {
            $modifiedColumns[':p' . $index++]  = '`fullname`';
        }
        if ($this->isColumnModified(AuthyPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(AuthyPeer::PASSWD_HASH)) {
            $modifiedColumns[':p' . $index++]  = '`passwd_hash`';
        }
        if ($this->isColumnModified(AuthyPeer::EXPIRE)) {
            $modifiedColumns[':p' . $index++]  = '`expire`';
        }
        if ($this->isColumnModified(AuthyPeer::DEACTIVATE)) {
            $modifiedColumns[':p' . $index++]  = '`deactivate`';
        }
        if ($this->isColumnModified(AuthyPeer::IS_ROOT)) {
            $modifiedColumns[':p' . $index++]  = '`is_root`';
        }
        if ($this->isColumnModified(AuthyPeer::ID_AUTHY_GROUP)) {
            $modifiedColumns[':p' . $index++]  = '`id_authy_group`';
        }
        if ($this->isColumnModified(AuthyPeer::IS_SYSTEM)) {
            $modifiedColumns[':p' . $index++]  = '`is_system`';
        }
        if ($this->isColumnModified(AuthyPeer::RIGHTS_ALL)) {
            $modifiedColumns[':p' . $index++]  = '`rights_all`';
        }
        if ($this->isColumnModified(AuthyPeer::RIGHTS_GROUP)) {
            $modifiedColumns[':p' . $index++]  = '`rights_group`';
        }
        if ($this->isColumnModified(AuthyPeer::RIGHTS_OWNER)) {
            $modifiedColumns[':p' . $index++]  = '`rights_owner`';
        }
        if ($this->isColumnModified(AuthyPeer::ONGLET)) {
            $modifiedColumns[':p' . $index++]  = '`onglet`';
        }
        if ($this->isColumnModified(AuthyPeer::DATE_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`date_creation`';
        }
        if ($this->isColumnModified(AuthyPeer::DATE_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = '`date_modification`';
        }
        if ($this->isColumnModified(AuthyPeer::ID_GROUP_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_group_creation`';
        }
        if ($this->isColumnModified(AuthyPeer::ID_CREATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_creation`';
        }
        if ($this->isColumnModified(AuthyPeer::ID_MODIFICATION)) {
            $modifiedColumns[':p' . $index++]  = '`id_modification`';
        }

        $sql = sprintf(
            'INSERT INTO `authy` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id_authy`':
                        $stmt->bindValue($identifier, $this->id_authy, PDO::PARAM_INT);
                        break;
                    case '`validation_key`':
                        $stmt->bindValue($identifier, $this->validation_key, PDO::PARAM_STR);
                        break;
                    case '`username`':
                        $stmt->bindValue($identifier, $this->username, PDO::PARAM_STR);
                        break;
                    case '`fullname`':
                        $stmt->bindValue($identifier, $this->fullname, PDO::PARAM_STR);
                        break;
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`passwd_hash`':
                        $stmt->bindValue($identifier, $this->passwd_hash, PDO::PARAM_STR);
                        break;
                    case '`expire`':
                        $stmt->bindValue($identifier, $this->expire, PDO::PARAM_STR);
                        break;
                    case '`deactivate`':
                        $stmt->bindValue($identifier, $this->deactivate, PDO::PARAM_INT);
                        break;
                    case '`is_root`':
                        $stmt->bindValue($identifier, $this->is_root, PDO::PARAM_INT);
                        break;
                    case '`id_authy_group`':
                        $stmt->bindValue($identifier, $this->id_authy_group, PDO::PARAM_INT);
                        break;
                    case '`is_system`':
                        $stmt->bindValue($identifier, $this->is_system, PDO::PARAM_INT);
                        break;
                    case '`rights_all`':
                        $stmt->bindValue($identifier, $this->rights_all, PDO::PARAM_STR);
                        break;
                    case '`rights_group`':
                        $stmt->bindValue($identifier, $this->rights_group, PDO::PARAM_STR);
                        break;
                    case '`rights_owner`':
                        $stmt->bindValue($identifier, $this->rights_owner, PDO::PARAM_STR);
                        break;
                    case '`onglet`':
                        $stmt->bindValue($identifier, $this->onglet, PDO::PARAM_STR);
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
        $this->setIdAuthy($pk);

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

            if ($this->aAuthyGroupRelatedByIdAuthyGroup !== null) {
                if (!$this->aAuthyGroupRelatedByIdAuthyGroup->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAuthyGroupRelatedByIdAuthyGroup->getValidationFailures());
                }
            }

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


            if (($retval = AuthyPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collClientsRelatedByDefaultUser !== null) {
                    foreach ($this->collClientsRelatedByDefaultUser as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBillingLinesRelatedByIdAssign !== null) {
                    foreach ($this->collBillingLinesRelatedByIdAssign as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAuthyGroupxes !== null) {
                    foreach ($this->collAuthyGroupxes as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAuthyLogs !== null) {
                    foreach ($this->collAuthyLogs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collClientsRelatedByIdCreation !== null) {
                    foreach ($this->collClientsRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collClientsRelatedByIdModification !== null) {
                    foreach ($this->collClientsRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBillingsRelatedByIdCreation !== null) {
                    foreach ($this->collBillingsRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBillingsRelatedByIdModification !== null) {
                    foreach ($this->collBillingsRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBillingLinesRelatedByIdCreation !== null) {
                    foreach ($this->collBillingLinesRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBillingLinesRelatedByIdModification !== null) {
                    foreach ($this->collBillingLinesRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPaymentLinesRelatedByIdCreation !== null) {
                    foreach ($this->collPaymentLinesRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPaymentLinesRelatedByIdModification !== null) {
                    foreach ($this->collPaymentLinesRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCostLinesRelatedByIdCreation !== null) {
                    foreach ($this->collCostLinesRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCostLinesRelatedByIdModification !== null) {
                    foreach ($this->collCostLinesRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collProjectsRelatedByIdCreation !== null) {
                    foreach ($this->collProjectsRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collProjectsRelatedByIdModification !== null) {
                    foreach ($this->collProjectsRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTimeLinesRelatedByIdCreation !== null) {
                    foreach ($this->collTimeLinesRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTimeLinesRelatedByIdModification !== null) {
                    foreach ($this->collTimeLinesRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBillingCategoriesRelatedByIdCreation !== null) {
                    foreach ($this->collBillingCategoriesRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBillingCategoriesRelatedByIdModification !== null) {
                    foreach ($this->collBillingCategoriesRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCurrenciesRelatedByIdCreation !== null) {
                    foreach ($this->collCurrenciesRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCurrenciesRelatedByIdModification !== null) {
                    foreach ($this->collCurrenciesRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collSuppliersRelatedByIdCreation !== null) {
                    foreach ($this->collSuppliersRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collSuppliersRelatedByIdModification !== null) {
                    foreach ($this->collSuppliersRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAuthiesRelatedByIdAuthy0 !== null) {
                    foreach ($this->collAuthiesRelatedByIdAuthy0 as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAuthiesRelatedByIdAuthy1 !== null) {
                    foreach ($this->collAuthiesRelatedByIdAuthy1 as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCountriesRelatedByIdCreation !== null) {
                    foreach ($this->collCountriesRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCountriesRelatedByIdModification !== null) {
                    foreach ($this->collCountriesRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAuthyGroupsRelatedByIdCreation !== null) {
                    foreach ($this->collAuthyGroupsRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collAuthyGroupsRelatedByIdModification !== null) {
                    foreach ($this->collAuthyGroupsRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collConfigsRelatedByIdCreation !== null) {
                    foreach ($this->collConfigsRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collConfigsRelatedByIdModification !== null) {
                    foreach ($this->collConfigsRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collApiRbacsRelatedByIdCreation !== null) {
                    foreach ($this->collApiRbacsRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collApiRbacsRelatedByIdModification !== null) {
                    foreach ($this->collApiRbacsRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collApiLogs !== null) {
                    foreach ($this->collApiLogs as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTemplatesRelatedByIdCreation !== null) {
                    foreach ($this->collTemplatesRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTemplatesRelatedByIdModification !== null) {
                    foreach ($this->collTemplatesRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTemplateFilesRelatedByIdCreation !== null) {
                    foreach ($this->collTemplateFilesRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTemplateFilesRelatedByIdModification !== null) {
                    foreach ($this->collTemplateFilesRelatedByIdModification as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collMessageI18nsRelatedByIdCreation !== null) {
                    foreach ($this->collMessageI18nsRelatedByIdCreation as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collMessageI18nsRelatedByIdModification !== null) {
                    foreach ($this->collMessageI18nsRelatedByIdModification as $referrerFK) {
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
        $pos = AuthyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['Authy'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Authy'][$this->getPrimaryKey()] = true;
        $keys = AuthyPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdAuthy(),
            $keys[1] => $this->getValidationKey(),
            $keys[2] => $this->getUsername(),
            $keys[3] => $this->getFullname(),
            $keys[4] => $this->getEmail(),
            $keys[5] => $this->getPasswdHash(),
            $keys[6] => $this->getExpire(),
            $keys[7] => $this->getDeactivate(),
            $keys[8] => $this->getIsRoot(),
            $keys[9] => $this->getIdAuthyGroup(),
            $keys[10] => $this->getIsSystem(),
            $keys[11] => $this->getRightsAll(),
            $keys[12] => $this->getRightsGroup(),
            $keys[13] => $this->getRightsOwner(),
            $keys[14] => $this->getOnglet(),
            $keys[15] => $this->getDateCreation(),
            $keys[16] => $this->getDateModification(),
            $keys[17] => $this->getIdGroupCreation(),
            $keys[18] => $this->getIdCreation(),
            $keys[19] => $this->getIdModification(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aAuthyGroupRelatedByIdAuthyGroup) {
                $result['AuthyGroupRelatedByIdAuthyGroup'] = $this->aAuthyGroupRelatedByIdAuthyGroup->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyGroupRelatedByIdGroupCreation) {
                $result['AuthyGroupRelatedByIdGroupCreation'] = $this->aAuthyGroupRelatedByIdGroupCreation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyRelatedByIdCreation) {
                $result['AuthyRelatedByIdCreation'] = $this->aAuthyRelatedByIdCreation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAuthyRelatedByIdModification) {
                $result['AuthyRelatedByIdModification'] = $this->aAuthyRelatedByIdModification->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collClientsRelatedByDefaultUser) {
                $result['ClientsRelatedByDefaultUser'] = $this->collClientsRelatedByDefaultUser->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillingLinesRelatedByIdAssign) {
                $result['BillingLinesRelatedByIdAssign'] = $this->collBillingLinesRelatedByIdAssign->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuthyGroupxes) {
                $result['AuthyGroupxes'] = $this->collAuthyGroupxes->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuthyLogs) {
                $result['AuthyLogs'] = $this->collAuthyLogs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collClientsRelatedByIdCreation) {
                $result['ClientsRelatedByIdCreation'] = $this->collClientsRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collClientsRelatedByIdModification) {
                $result['ClientsRelatedByIdModification'] = $this->collClientsRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillingsRelatedByIdCreation) {
                $result['BillingsRelatedByIdCreation'] = $this->collBillingsRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillingsRelatedByIdModification) {
                $result['BillingsRelatedByIdModification'] = $this->collBillingsRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillingLinesRelatedByIdCreation) {
                $result['BillingLinesRelatedByIdCreation'] = $this->collBillingLinesRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillingLinesRelatedByIdModification) {
                $result['BillingLinesRelatedByIdModification'] = $this->collBillingLinesRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPaymentLinesRelatedByIdCreation) {
                $result['PaymentLinesRelatedByIdCreation'] = $this->collPaymentLinesRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPaymentLinesRelatedByIdModification) {
                $result['PaymentLinesRelatedByIdModification'] = $this->collPaymentLinesRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCostLinesRelatedByIdCreation) {
                $result['CostLinesRelatedByIdCreation'] = $this->collCostLinesRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCostLinesRelatedByIdModification) {
                $result['CostLinesRelatedByIdModification'] = $this->collCostLinesRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjectsRelatedByIdCreation) {
                $result['ProjectsRelatedByIdCreation'] = $this->collProjectsRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjectsRelatedByIdModification) {
                $result['ProjectsRelatedByIdModification'] = $this->collProjectsRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTimeLinesRelatedByIdCreation) {
                $result['TimeLinesRelatedByIdCreation'] = $this->collTimeLinesRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTimeLinesRelatedByIdModification) {
                $result['TimeLinesRelatedByIdModification'] = $this->collTimeLinesRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillingCategoriesRelatedByIdCreation) {
                $result['BillingCategoriesRelatedByIdCreation'] = $this->collBillingCategoriesRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBillingCategoriesRelatedByIdModification) {
                $result['BillingCategoriesRelatedByIdModification'] = $this->collBillingCategoriesRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCurrenciesRelatedByIdCreation) {
                $result['CurrenciesRelatedByIdCreation'] = $this->collCurrenciesRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCurrenciesRelatedByIdModification) {
                $result['CurrenciesRelatedByIdModification'] = $this->collCurrenciesRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSuppliersRelatedByIdCreation) {
                $result['SuppliersRelatedByIdCreation'] = $this->collSuppliersRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collSuppliersRelatedByIdModification) {
                $result['SuppliersRelatedByIdModification'] = $this->collSuppliersRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuthiesRelatedByIdAuthy0) {
                $result['AuthiesRelatedByIdAuthy0'] = $this->collAuthiesRelatedByIdAuthy0->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuthiesRelatedByIdAuthy1) {
                $result['AuthiesRelatedByIdAuthy1'] = $this->collAuthiesRelatedByIdAuthy1->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCountriesRelatedByIdCreation) {
                $result['CountriesRelatedByIdCreation'] = $this->collCountriesRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCountriesRelatedByIdModification) {
                $result['CountriesRelatedByIdModification'] = $this->collCountriesRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuthyGroupsRelatedByIdCreation) {
                $result['AuthyGroupsRelatedByIdCreation'] = $this->collAuthyGroupsRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAuthyGroupsRelatedByIdModification) {
                $result['AuthyGroupsRelatedByIdModification'] = $this->collAuthyGroupsRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collConfigsRelatedByIdCreation) {
                $result['ConfigsRelatedByIdCreation'] = $this->collConfigsRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collConfigsRelatedByIdModification) {
                $result['ConfigsRelatedByIdModification'] = $this->collConfigsRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collApiRbacsRelatedByIdCreation) {
                $result['ApiRbacsRelatedByIdCreation'] = $this->collApiRbacsRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collApiRbacsRelatedByIdModification) {
                $result['ApiRbacsRelatedByIdModification'] = $this->collApiRbacsRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collApiLogs) {
                $result['ApiLogs'] = $this->collApiLogs->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTemplatesRelatedByIdCreation) {
                $result['TemplatesRelatedByIdCreation'] = $this->collTemplatesRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTemplatesRelatedByIdModification) {
                $result['TemplatesRelatedByIdModification'] = $this->collTemplatesRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTemplateFilesRelatedByIdCreation) {
                $result['TemplateFilesRelatedByIdCreation'] = $this->collTemplateFilesRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTemplateFilesRelatedByIdModification) {
                $result['TemplateFilesRelatedByIdModification'] = $this->collTemplateFilesRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMessageI18nsRelatedByIdCreation) {
                $result['MessageI18nsRelatedByIdCreation'] = $this->collMessageI18nsRelatedByIdCreation->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collMessageI18nsRelatedByIdModification) {
                $result['MessageI18nsRelatedByIdModification'] = $this->collMessageI18nsRelatedByIdModification->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = AuthyPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setIdAuthy($value);
                break;
            case 1:
                $this->setValidationKey($value);
                break;
            case 2:
                $this->setUsername($value);
                break;
            case 3:
                $this->setFullname($value);
                break;
            case 4:
                $this->setEmail($value);
                break;
            case 5:
                $this->setPasswdHash($value);
                break;
            case 6:
                $this->setExpire($value);
                break;
            case 7:
                $valueSet = AuthyPeer::getValueSet(AuthyPeer::DEACTIVATE);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setDeactivate($value);
                break;
            case 8:
                $valueSet = AuthyPeer::getValueSet(AuthyPeer::IS_ROOT);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setIsRoot($value);
                break;
            case 9:
                $this->setIdAuthyGroup($value);
                break;
            case 10:
                $valueSet = AuthyPeer::getValueSet(AuthyPeer::IS_SYSTEM);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setIsSystem($value);
                break;
            case 11:
                $this->setRightsAll($value);
                break;
            case 12:
                $this->setRightsGroup($value);
                break;
            case 13:
                $this->setRightsOwner($value);
                break;
            case 14:
                $this->setOnglet($value);
                break;
            case 15:
                $this->setDateCreation($value);
                break;
            case 16:
                $this->setDateModification($value);
                break;
            case 17:
                $this->setIdGroupCreation($value);
                break;
            case 18:
                $this->setIdCreation($value);
                break;
            case 19:
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
        $keys = AuthyPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setIdAuthy($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setValidationKey($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUsername($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setFullname($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setEmail($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPasswdHash($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setExpire($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setDeactivate($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setIsRoot($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setIdAuthyGroup($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setIsSystem($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setRightsAll($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setRightsGroup($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setRightsOwner($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setOnglet($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setDateCreation($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setDateModification($arr[$keys[16]]);
        if (array_key_exists($keys[17], $arr)) $this->setIdGroupCreation($arr[$keys[17]]);
        if (array_key_exists($keys[18], $arr)) $this->setIdCreation($arr[$keys[18]]);
        if (array_key_exists($keys[19], $arr)) $this->setIdModification($arr[$keys[19]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(AuthyPeer::DATABASE_NAME);

        if ($this->isColumnModified(AuthyPeer::ID_AUTHY)) $criteria->add(AuthyPeer::ID_AUTHY, $this->id_authy);
        if ($this->isColumnModified(AuthyPeer::VALIDATION_KEY)) $criteria->add(AuthyPeer::VALIDATION_KEY, $this->validation_key);
        if ($this->isColumnModified(AuthyPeer::USERNAME)) $criteria->add(AuthyPeer::USERNAME, $this->username);
        if ($this->isColumnModified(AuthyPeer::FULLNAME)) $criteria->add(AuthyPeer::FULLNAME, $this->fullname);
        if ($this->isColumnModified(AuthyPeer::EMAIL)) $criteria->add(AuthyPeer::EMAIL, $this->email);
        if ($this->isColumnModified(AuthyPeer::PASSWD_HASH)) $criteria->add(AuthyPeer::PASSWD_HASH, $this->passwd_hash);
        if ($this->isColumnModified(AuthyPeer::EXPIRE)) $criteria->add(AuthyPeer::EXPIRE, $this->expire);
        if ($this->isColumnModified(AuthyPeer::DEACTIVATE)) $criteria->add(AuthyPeer::DEACTIVATE, $this->deactivate);
        if ($this->isColumnModified(AuthyPeer::IS_ROOT)) $criteria->add(AuthyPeer::IS_ROOT, $this->is_root);
        if ($this->isColumnModified(AuthyPeer::ID_AUTHY_GROUP)) $criteria->add(AuthyPeer::ID_AUTHY_GROUP, $this->id_authy_group);
        if ($this->isColumnModified(AuthyPeer::IS_SYSTEM)) $criteria->add(AuthyPeer::IS_SYSTEM, $this->is_system);
        if ($this->isColumnModified(AuthyPeer::RIGHTS_ALL)) $criteria->add(AuthyPeer::RIGHTS_ALL, $this->rights_all);
        if ($this->isColumnModified(AuthyPeer::RIGHTS_GROUP)) $criteria->add(AuthyPeer::RIGHTS_GROUP, $this->rights_group);
        if ($this->isColumnModified(AuthyPeer::RIGHTS_OWNER)) $criteria->add(AuthyPeer::RIGHTS_OWNER, $this->rights_owner);
        if ($this->isColumnModified(AuthyPeer::ONGLET)) $criteria->add(AuthyPeer::ONGLET, $this->onglet);
        if ($this->isColumnModified(AuthyPeer::DATE_CREATION)) $criteria->add(AuthyPeer::DATE_CREATION, $this->date_creation);
        if ($this->isColumnModified(AuthyPeer::DATE_MODIFICATION)) $criteria->add(AuthyPeer::DATE_MODIFICATION, $this->date_modification);
        if ($this->isColumnModified(AuthyPeer::ID_GROUP_CREATION)) $criteria->add(AuthyPeer::ID_GROUP_CREATION, $this->id_group_creation);
        if ($this->isColumnModified(AuthyPeer::ID_CREATION)) $criteria->add(AuthyPeer::ID_CREATION, $this->id_creation);
        if ($this->isColumnModified(AuthyPeer::ID_MODIFICATION)) $criteria->add(AuthyPeer::ID_MODIFICATION, $this->id_modification);

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
        $criteria = new Criteria(AuthyPeer::DATABASE_NAME);
        $criteria->add(AuthyPeer::ID_AUTHY, $this->id_authy);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdAuthy();
    }

    /**
     * Generic method to set the primary key (id_authy column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdAuthy($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getIdAuthy();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Authy (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setValidationKey($this->getValidationKey());
        $copyObj->setUsername($this->getUsername());
        $copyObj->setFullname($this->getFullname());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPasswdHash($this->getPasswdHash());
        $copyObj->setExpire($this->getExpire());
        $copyObj->setDeactivate($this->getDeactivate());
        $copyObj->setIsRoot($this->getIsRoot());
        $copyObj->setIdAuthyGroup($this->getIdAuthyGroup());
        $copyObj->setIsSystem($this->getIsSystem());
        $copyObj->setRightsAll($this->getRightsAll());
        $copyObj->setRightsGroup($this->getRightsGroup());
        $copyObj->setRightsOwner($this->getRightsOwner());
        $copyObj->setOnglet($this->getOnglet());
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

            foreach ($this->getClientsRelatedByDefaultUser() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addClientRelatedByDefaultUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBillingLinesRelatedByIdAssign() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBillingLineRelatedByIdAssign($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuthyGroupxes() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuthyGroupX($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuthyLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuthyLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getClientsRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addClientRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getClientsRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addClientRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBillingsRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBillingRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBillingsRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBillingRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBillingLinesRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBillingLineRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBillingLinesRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBillingLineRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPaymentLinesRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPaymentLineRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPaymentLinesRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPaymentLineRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCostLinesRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCostLineRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCostLinesRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCostLineRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjectsRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjectsRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTimeLinesRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTimeLineRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTimeLinesRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTimeLineRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBillingCategoriesRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBillingCategoryRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBillingCategoriesRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBillingCategoryRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCurrenciesRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCurrencyRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCurrenciesRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCurrencyRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSuppliersRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSupplierRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getSuppliersRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addSupplierRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuthiesRelatedByIdAuthy0() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuthyRelatedByIdAuthy0($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuthiesRelatedByIdAuthy1() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuthyRelatedByIdAuthy1($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCountriesRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCountryRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCountriesRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCountryRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuthyGroupsRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuthyGroupRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAuthyGroupsRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAuthyGroupRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getConfigsRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addConfigRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getConfigsRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addConfigRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getApiRbacsRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addApiRbacRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getApiRbacsRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addApiRbacRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getApiLogs() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addApiLog($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTemplatesRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTemplateRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTemplatesRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTemplateRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTemplateFilesRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTemplateFileRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTemplateFilesRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTemplateFileRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMessageI18nsRelatedByIdCreation() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMessageI18nRelatedByIdCreation($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getMessageI18nsRelatedByIdModification() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addMessageI18nRelatedByIdModification($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdAuthy(NULL); // this is a auto-increment column, so set to default value
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
     * @return Authy Clone of current object.
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
     * @return AuthyPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new AuthyPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a AuthyGroup object.
     *
     * @param                  AuthyGroup $v
     * @return Authy The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAuthyGroupRelatedByIdAuthyGroup(AuthyGroup $v = null)
    {
        if ($v === null) {
            $this->setIdAuthyGroup(1);
        } else {
            $this->setIdAuthyGroup($v->getIdAuthyGroup());
        }

        $this->aAuthyGroupRelatedByIdAuthyGroup = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the AuthyGroup object, it will not be re-added.
        if ($v !== null) {
            $v->addAuthyRelatedByIdAuthyGroup($this);
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
    public function getAuthyGroupRelatedByIdAuthyGroup(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aAuthyGroupRelatedByIdAuthyGroup === null && ($this->id_authy_group !== null) && $doQuery) {
            $this->aAuthyGroupRelatedByIdAuthyGroup = AuthyGroupQuery::create()->findPk($this->id_authy_group, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAuthyGroupRelatedByIdAuthyGroup->addAuthiesRelatedByIdAuthyGroup($this);
             */
        }

        return $this->aAuthyGroupRelatedByIdAuthyGroup;
    }

    /**
     * Declares an association between this object and a AuthyGroup object.
     *
     * @param                  AuthyGroup $v
     * @return Authy The current object (for fluent API support)
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
            $v->addAuthyRelatedByIdGroupCreation($this);
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
                $this->aAuthyGroupRelatedByIdGroupCreation->addAuthiesRelatedByIdGroupCreation($this);
             */
        }

        return $this->aAuthyGroupRelatedByIdGroupCreation;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return Authy The current object (for fluent API support)
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
            $v->addAuthyRelatedByIdAuthy0($this);
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
                $this->aAuthyRelatedByIdCreation->addAuthiesRelatedByIdAuthy0($this);
             */
        }

        return $this->aAuthyRelatedByIdCreation;
    }

    /**
     * Declares an association between this object and a Authy object.
     *
     * @param                  Authy $v
     * @return Authy The current object (for fluent API support)
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
            $v->addAuthyRelatedByIdAuthy1($this);
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
                $this->aAuthyRelatedByIdModification->addAuthiesRelatedByIdAuthy1($this);
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
        if ('ClientRelatedByDefaultUser' == $relationName) {
            $this->initClientsRelatedByDefaultUser();
        }
        if ('BillingLineRelatedByIdAssign' == $relationName) {
            $this->initBillingLinesRelatedByIdAssign();
        }
        if ('AuthyGroupX' == $relationName) {
            $this->initAuthyGroupxes();
        }
        if ('AuthyLog' == $relationName) {
            $this->initAuthyLogs();
        }
        if ('ClientRelatedByIdCreation' == $relationName) {
            $this->initClientsRelatedByIdCreation();
        }
        if ('ClientRelatedByIdModification' == $relationName) {
            $this->initClientsRelatedByIdModification();
        }
        if ('BillingRelatedByIdCreation' == $relationName) {
            $this->initBillingsRelatedByIdCreation();
        }
        if ('BillingRelatedByIdModification' == $relationName) {
            $this->initBillingsRelatedByIdModification();
        }
        if ('BillingLineRelatedByIdCreation' == $relationName) {
            $this->initBillingLinesRelatedByIdCreation();
        }
        if ('BillingLineRelatedByIdModification' == $relationName) {
            $this->initBillingLinesRelatedByIdModification();
        }
        if ('PaymentLineRelatedByIdCreation' == $relationName) {
            $this->initPaymentLinesRelatedByIdCreation();
        }
        if ('PaymentLineRelatedByIdModification' == $relationName) {
            $this->initPaymentLinesRelatedByIdModification();
        }
        if ('CostLineRelatedByIdCreation' == $relationName) {
            $this->initCostLinesRelatedByIdCreation();
        }
        if ('CostLineRelatedByIdModification' == $relationName) {
            $this->initCostLinesRelatedByIdModification();
        }
        if ('ProjectRelatedByIdCreation' == $relationName) {
            $this->initProjectsRelatedByIdCreation();
        }
        if ('ProjectRelatedByIdModification' == $relationName) {
            $this->initProjectsRelatedByIdModification();
        }
        if ('TimeLineRelatedByIdCreation' == $relationName) {
            $this->initTimeLinesRelatedByIdCreation();
        }
        if ('TimeLineRelatedByIdModification' == $relationName) {
            $this->initTimeLinesRelatedByIdModification();
        }
        if ('BillingCategoryRelatedByIdCreation' == $relationName) {
            $this->initBillingCategoriesRelatedByIdCreation();
        }
        if ('BillingCategoryRelatedByIdModification' == $relationName) {
            $this->initBillingCategoriesRelatedByIdModification();
        }
        if ('CurrencyRelatedByIdCreation' == $relationName) {
            $this->initCurrenciesRelatedByIdCreation();
        }
        if ('CurrencyRelatedByIdModification' == $relationName) {
            $this->initCurrenciesRelatedByIdModification();
        }
        if ('SupplierRelatedByIdCreation' == $relationName) {
            $this->initSuppliersRelatedByIdCreation();
        }
        if ('SupplierRelatedByIdModification' == $relationName) {
            $this->initSuppliersRelatedByIdModification();
        }
        if ('AuthyRelatedByIdAuthy0' == $relationName) {
            $this->initAuthiesRelatedByIdAuthy0();
        }
        if ('AuthyRelatedByIdAuthy1' == $relationName) {
            $this->initAuthiesRelatedByIdAuthy1();
        }
        if ('CountryRelatedByIdCreation' == $relationName) {
            $this->initCountriesRelatedByIdCreation();
        }
        if ('CountryRelatedByIdModification' == $relationName) {
            $this->initCountriesRelatedByIdModification();
        }
        if ('AuthyGroupRelatedByIdCreation' == $relationName) {
            $this->initAuthyGroupsRelatedByIdCreation();
        }
        if ('AuthyGroupRelatedByIdModification' == $relationName) {
            $this->initAuthyGroupsRelatedByIdModification();
        }
        if ('ConfigRelatedByIdCreation' == $relationName) {
            $this->initConfigsRelatedByIdCreation();
        }
        if ('ConfigRelatedByIdModification' == $relationName) {
            $this->initConfigsRelatedByIdModification();
        }
        if ('ApiRbacRelatedByIdCreation' == $relationName) {
            $this->initApiRbacsRelatedByIdCreation();
        }
        if ('ApiRbacRelatedByIdModification' == $relationName) {
            $this->initApiRbacsRelatedByIdModification();
        }
        if ('ApiLog' == $relationName) {
            $this->initApiLogs();
        }
        if ('TemplateRelatedByIdCreation' == $relationName) {
            $this->initTemplatesRelatedByIdCreation();
        }
        if ('TemplateRelatedByIdModification' == $relationName) {
            $this->initTemplatesRelatedByIdModification();
        }
        if ('TemplateFileRelatedByIdCreation' == $relationName) {
            $this->initTemplateFilesRelatedByIdCreation();
        }
        if ('TemplateFileRelatedByIdModification' == $relationName) {
            $this->initTemplateFilesRelatedByIdModification();
        }
        if ('MessageI18nRelatedByIdCreation' == $relationName) {
            $this->initMessageI18nsRelatedByIdCreation();
        }
        if ('MessageI18nRelatedByIdModification' == $relationName) {
            $this->initMessageI18nsRelatedByIdModification();
        }
    }

    /**
     * Clears out the collClientsRelatedByDefaultUser collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addClientsRelatedByDefaultUser()
     */
    public function clearClientsRelatedByDefaultUser()
    {
        $this->collClientsRelatedByDefaultUser = null; // important to set this to null since that means it is uninitialized
        $this->collClientsRelatedByDefaultUserPartial = null;

        return $this;
    }

    /**
     * reset is the collClientsRelatedByDefaultUser collection loaded partially
     *
     * @return void
     */
    public function resetPartialClientsRelatedByDefaultUser($v = true)
    {
        $this->collClientsRelatedByDefaultUserPartial = $v;
    }

    /**
     * Initializes the collClientsRelatedByDefaultUser collection.
     *
     * By default this just sets the collClientsRelatedByDefaultUser collection to an empty array (like clearcollClientsRelatedByDefaultUser());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initClientsRelatedByDefaultUser($overrideExisting = true)
    {
        if (null !== $this->collClientsRelatedByDefaultUser && !$overrideExisting) {
            return;
        }
        $this->collClientsRelatedByDefaultUser = new PropelObjectCollection();
        $this->collClientsRelatedByDefaultUser->setModel('Client');
    }

    /**
     * Gets an array of Client objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Client[] List of Client objects
     * @throws PropelException
     */
    public function getClientsRelatedByDefaultUser($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collClientsRelatedByDefaultUserPartial && !$this->isNew();
        if (null === $this->collClientsRelatedByDefaultUser || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collClientsRelatedByDefaultUser) {
                // return empty collection
                $this->initClientsRelatedByDefaultUser();
            } else {
                $collClientsRelatedByDefaultUser = ClientQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByDefaultUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collClientsRelatedByDefaultUserPartial && count($collClientsRelatedByDefaultUser)) {
                      $this->initClientsRelatedByDefaultUser(false);

                      foreach ($collClientsRelatedByDefaultUser as $obj) {
                        if (false == $this->collClientsRelatedByDefaultUser->contains($obj)) {
                          $this->collClientsRelatedByDefaultUser->append($obj);
                        }
                      }

                      $this->collClientsRelatedByDefaultUserPartial = true;
                    }

                    $collClientsRelatedByDefaultUser->getInternalIterator()->rewind();

                    return $collClientsRelatedByDefaultUser;
                }

                if ($partial && $this->collClientsRelatedByDefaultUser) {
                    foreach ($this->collClientsRelatedByDefaultUser as $obj) {
                        if ($obj->isNew()) {
                            $collClientsRelatedByDefaultUser[] = $obj;
                        }
                    }
                }

                $this->collClientsRelatedByDefaultUser = $collClientsRelatedByDefaultUser;
                $this->collClientsRelatedByDefaultUserPartial = false;
            }
        }

        return $this->collClientsRelatedByDefaultUser;
    }

    /**
     * Sets a collection of ClientRelatedByDefaultUser objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $clientsRelatedByDefaultUser A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setClientsRelatedByDefaultUser(PropelCollection $clientsRelatedByDefaultUser, PropelPDO $con = null)
    {
        $clientsRelatedByDefaultUserToDelete = $this->getClientsRelatedByDefaultUser(new Criteria(), $con)->diff($clientsRelatedByDefaultUser);


        $this->clientsRelatedByDefaultUserScheduledForDeletion = $clientsRelatedByDefaultUserToDelete;

        foreach ($clientsRelatedByDefaultUserToDelete as $clientRelatedByDefaultUserRemoved) {
            $clientRelatedByDefaultUserRemoved->setAuthyRelatedByDefaultUser(null);
        }

        $this->collClientsRelatedByDefaultUser = null;
        foreach ($clientsRelatedByDefaultUser as $clientRelatedByDefaultUser) {
            $this->addClientRelatedByDefaultUser($clientRelatedByDefaultUser);
        }

        $this->collClientsRelatedByDefaultUser = $clientsRelatedByDefaultUser;
        $this->collClientsRelatedByDefaultUserPartial = false;

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
    public function countClientsRelatedByDefaultUser(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collClientsRelatedByDefaultUserPartial && !$this->isNew();
        if (null === $this->collClientsRelatedByDefaultUser || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collClientsRelatedByDefaultUser) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getClientsRelatedByDefaultUser());
            }
            $query = ClientQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByDefaultUser($this)
                ->count($con);
        }

        return count($this->collClientsRelatedByDefaultUser);
    }

    /**
     * Method called to associate a Client object to this object
     * through the Client foreign key attribute.
     *
     * @param    Client $l Client
     * @return Authy The current object (for fluent API support)
     */
    public function addClientRelatedByDefaultUser(Client $l)
    {
        if ($this->collClientsRelatedByDefaultUser === null) {
            $this->initClientsRelatedByDefaultUser();
            $this->collClientsRelatedByDefaultUserPartial = true;
        }

        if (!in_array($l, $this->collClientsRelatedByDefaultUser->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddClientRelatedByDefaultUser($l);

            if ($this->clientsRelatedByDefaultUserScheduledForDeletion and $this->clientsRelatedByDefaultUserScheduledForDeletion->contains($l)) {
                $this->clientsRelatedByDefaultUserScheduledForDeletion->remove($this->clientsRelatedByDefaultUserScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ClientRelatedByDefaultUser $clientRelatedByDefaultUser The clientRelatedByDefaultUser object to add.
     */
    protected function doAddClientRelatedByDefaultUser($clientRelatedByDefaultUser)
    {
        $this->collClientsRelatedByDefaultUser[]= $clientRelatedByDefaultUser;
        $clientRelatedByDefaultUser->setAuthyRelatedByDefaultUser($this);
    }

    /**
     * @param	ClientRelatedByDefaultUser $clientRelatedByDefaultUser The clientRelatedByDefaultUser object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeClientRelatedByDefaultUser($clientRelatedByDefaultUser)
    {
        if ($this->getClientsRelatedByDefaultUser()->contains($clientRelatedByDefaultUser)) {
            $this->collClientsRelatedByDefaultUser->remove($this->collClientsRelatedByDefaultUser->search($clientRelatedByDefaultUser));
            if (null === $this->clientsRelatedByDefaultUserScheduledForDeletion) {
                $this->clientsRelatedByDefaultUserScheduledForDeletion = clone $this->collClientsRelatedByDefaultUser;
                $this->clientsRelatedByDefaultUserScheduledForDeletion->clear();
            }
            $this->clientsRelatedByDefaultUserScheduledForDeletion[]= $clientRelatedByDefaultUser;
            $clientRelatedByDefaultUser->setAuthyRelatedByDefaultUser(null);
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
    public function getClientsRelatedByDefaultUserJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('Country', $join_behavior);

        return $this->getClientsRelatedByDefaultUser($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsRelatedByDefaultUserJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

        return $this->getClientsRelatedByDefaultUser($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsRelatedByDefaultUserJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('Currency', $join_behavior);

        return $this->getClientsRelatedByDefaultUser($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsRelatedByDefaultUserJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getClientsRelatedByDefaultUser($query, $con);
    }

    /**
     * Clears out the collBillingLinesRelatedByIdAssign collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addBillingLinesRelatedByIdAssign()
     */
    public function clearBillingLinesRelatedByIdAssign()
    {
        $this->collBillingLinesRelatedByIdAssign = null; // important to set this to null since that means it is uninitialized
        $this->collBillingLinesRelatedByIdAssignPartial = null;

        return $this;
    }

    /**
     * reset is the collBillingLinesRelatedByIdAssign collection loaded partially
     *
     * @return void
     */
    public function resetPartialBillingLinesRelatedByIdAssign($v = true)
    {
        $this->collBillingLinesRelatedByIdAssignPartial = $v;
    }

    /**
     * Initializes the collBillingLinesRelatedByIdAssign collection.
     *
     * By default this just sets the collBillingLinesRelatedByIdAssign collection to an empty array (like clearcollBillingLinesRelatedByIdAssign());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBillingLinesRelatedByIdAssign($overrideExisting = true)
    {
        if (null !== $this->collBillingLinesRelatedByIdAssign && !$overrideExisting) {
            return;
        }
        $this->collBillingLinesRelatedByIdAssign = new PropelObjectCollection();
        $this->collBillingLinesRelatedByIdAssign->setModel('BillingLine');
    }

    /**
     * Gets an array of BillingLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     * @throws PropelException
     */
    public function getBillingLinesRelatedByIdAssign($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBillingLinesRelatedByIdAssignPartial && !$this->isNew();
        if (null === $this->collBillingLinesRelatedByIdAssign || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBillingLinesRelatedByIdAssign) {
                // return empty collection
                $this->initBillingLinesRelatedByIdAssign();
            } else {
                $collBillingLinesRelatedByIdAssign = BillingLineQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdAssign($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBillingLinesRelatedByIdAssignPartial && count($collBillingLinesRelatedByIdAssign)) {
                      $this->initBillingLinesRelatedByIdAssign(false);

                      foreach ($collBillingLinesRelatedByIdAssign as $obj) {
                        if (false == $this->collBillingLinesRelatedByIdAssign->contains($obj)) {
                          $this->collBillingLinesRelatedByIdAssign->append($obj);
                        }
                      }

                      $this->collBillingLinesRelatedByIdAssignPartial = true;
                    }

                    $collBillingLinesRelatedByIdAssign->getInternalIterator()->rewind();

                    return $collBillingLinesRelatedByIdAssign;
                }

                if ($partial && $this->collBillingLinesRelatedByIdAssign) {
                    foreach ($this->collBillingLinesRelatedByIdAssign as $obj) {
                        if ($obj->isNew()) {
                            $collBillingLinesRelatedByIdAssign[] = $obj;
                        }
                    }
                }

                $this->collBillingLinesRelatedByIdAssign = $collBillingLinesRelatedByIdAssign;
                $this->collBillingLinesRelatedByIdAssignPartial = false;
            }
        }

        return $this->collBillingLinesRelatedByIdAssign;
    }

    /**
     * Sets a collection of BillingLineRelatedByIdAssign objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $billingLinesRelatedByIdAssign A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setBillingLinesRelatedByIdAssign(PropelCollection $billingLinesRelatedByIdAssign, PropelPDO $con = null)
    {
        $billingLinesRelatedByIdAssignToDelete = $this->getBillingLinesRelatedByIdAssign(new Criteria(), $con)->diff($billingLinesRelatedByIdAssign);


        $this->billingLinesRelatedByIdAssignScheduledForDeletion = $billingLinesRelatedByIdAssignToDelete;

        foreach ($billingLinesRelatedByIdAssignToDelete as $billingLineRelatedByIdAssignRemoved) {
            $billingLineRelatedByIdAssignRemoved->setAuthyRelatedByIdAssign(null);
        }

        $this->collBillingLinesRelatedByIdAssign = null;
        foreach ($billingLinesRelatedByIdAssign as $billingLineRelatedByIdAssign) {
            $this->addBillingLineRelatedByIdAssign($billingLineRelatedByIdAssign);
        }

        $this->collBillingLinesRelatedByIdAssign = $billingLinesRelatedByIdAssign;
        $this->collBillingLinesRelatedByIdAssignPartial = false;

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
    public function countBillingLinesRelatedByIdAssign(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBillingLinesRelatedByIdAssignPartial && !$this->isNew();
        if (null === $this->collBillingLinesRelatedByIdAssign || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBillingLinesRelatedByIdAssign) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBillingLinesRelatedByIdAssign());
            }
            $query = BillingLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdAssign($this)
                ->count($con);
        }

        return count($this->collBillingLinesRelatedByIdAssign);
    }

    /**
     * Method called to associate a BillingLine object to this object
     * through the BillingLine foreign key attribute.
     *
     * @param    BillingLine $l BillingLine
     * @return Authy The current object (for fluent API support)
     */
    public function addBillingLineRelatedByIdAssign(BillingLine $l)
    {
        if ($this->collBillingLinesRelatedByIdAssign === null) {
            $this->initBillingLinesRelatedByIdAssign();
            $this->collBillingLinesRelatedByIdAssignPartial = true;
        }

        if (!in_array($l, $this->collBillingLinesRelatedByIdAssign->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBillingLineRelatedByIdAssign($l);

            if ($this->billingLinesRelatedByIdAssignScheduledForDeletion and $this->billingLinesRelatedByIdAssignScheduledForDeletion->contains($l)) {
                $this->billingLinesRelatedByIdAssignScheduledForDeletion->remove($this->billingLinesRelatedByIdAssignScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	BillingLineRelatedByIdAssign $billingLineRelatedByIdAssign The billingLineRelatedByIdAssign object to add.
     */
    protected function doAddBillingLineRelatedByIdAssign($billingLineRelatedByIdAssign)
    {
        $this->collBillingLinesRelatedByIdAssign[]= $billingLineRelatedByIdAssign;
        $billingLineRelatedByIdAssign->setAuthyRelatedByIdAssign($this);
    }

    /**
     * @param	BillingLineRelatedByIdAssign $billingLineRelatedByIdAssign The billingLineRelatedByIdAssign object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeBillingLineRelatedByIdAssign($billingLineRelatedByIdAssign)
    {
        if ($this->getBillingLinesRelatedByIdAssign()->contains($billingLineRelatedByIdAssign)) {
            $this->collBillingLinesRelatedByIdAssign->remove($this->collBillingLinesRelatedByIdAssign->search($billingLineRelatedByIdAssign));
            if (null === $this->billingLinesRelatedByIdAssignScheduledForDeletion) {
                $this->billingLinesRelatedByIdAssignScheduledForDeletion = clone $this->collBillingLinesRelatedByIdAssign;
                $this->billingLinesRelatedByIdAssignScheduledForDeletion->clear();
            }
            $this->billingLinesRelatedByIdAssignScheduledForDeletion[]= $billingLineRelatedByIdAssign;
            $billingLineRelatedByIdAssign->setAuthyRelatedByIdAssign(null);
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
    public function getBillingLinesRelatedByIdAssignJoinBilling($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('Billing', $join_behavior);

        return $this->getBillingLinesRelatedByIdAssign($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesRelatedByIdAssignJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getBillingLinesRelatedByIdAssign($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesRelatedByIdAssignJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

        return $this->getBillingLinesRelatedByIdAssign($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesRelatedByIdAssignJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getBillingLinesRelatedByIdAssign($query, $con);
    }

    /**
     * Clears out the collAuthyGroupxes collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
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
     * If this Authy is new, it will return
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
                    ->filterByAuthy($this)
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
     * @return Authy The current object (for fluent API support)
     */
    public function setAuthyGroupxes(PropelCollection $authyGroupxes, PropelPDO $con = null)
    {
        $authyGroupxesToDelete = $this->getAuthyGroupxes(new Criteria(), $con)->diff($authyGroupxes);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->authyGroupxesScheduledForDeletion = clone $authyGroupxesToDelete;

        foreach ($authyGroupxesToDelete as $authyGroupXRemoved) {
            $authyGroupXRemoved->setAuthy(null);
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
                ->filterByAuthy($this)
                ->count($con);
        }

        return count($this->collAuthyGroupxes);
    }

    /**
     * Method called to associate a AuthyGroupX object to this object
     * through the AuthyGroupX foreign key attribute.
     *
     * @param    AuthyGroupX $l AuthyGroupX
     * @return Authy The current object (for fluent API support)
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
        $authyGroupX->setAuthy($this);
    }

    /**
     * @param	AuthyGroupX $authyGroupX The authyGroupX object to remove.
     * @return Authy The current object (for fluent API support)
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
            $authyGroupX->setAuthy(null);
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
    public function getAuthyGroupxesJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyGroupXQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getAuthyGroupxes($query, $con);
    }

    /**
     * Clears out the collAuthyLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addAuthyLogs()
     */
    public function clearAuthyLogs()
    {
        $this->collAuthyLogs = null; // important to set this to null since that means it is uninitialized
        $this->collAuthyLogsPartial = null;

        return $this;
    }

    /**
     * reset is the collAuthyLogs collection loaded partially
     *
     * @return void
     */
    public function resetPartialAuthyLogs($v = true)
    {
        $this->collAuthyLogsPartial = $v;
    }

    /**
     * Initializes the collAuthyLogs collection.
     *
     * By default this just sets the collAuthyLogs collection to an empty array (like clearcollAuthyLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuthyLogs($overrideExisting = true)
    {
        if (null !== $this->collAuthyLogs && !$overrideExisting) {
            return;
        }
        $this->collAuthyLogs = new PropelObjectCollection();
        $this->collAuthyLogs->setModel('AuthyLog');
    }

    /**
     * Gets an array of AuthyLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|AuthyLog[] List of AuthyLog objects
     * @throws PropelException
     */
    public function getAuthyLogs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAuthyLogsPartial && !$this->isNew();
        if (null === $this->collAuthyLogs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAuthyLogs) {
                // return empty collection
                $this->initAuthyLogs();
            } else {
                $collAuthyLogs = AuthyLogQuery::create(null, $criteria)
                    ->filterByAuthy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAuthyLogsPartial && count($collAuthyLogs)) {
                      $this->initAuthyLogs(false);

                      foreach ($collAuthyLogs as $obj) {
                        if (false == $this->collAuthyLogs->contains($obj)) {
                          $this->collAuthyLogs->append($obj);
                        }
                      }

                      $this->collAuthyLogsPartial = true;
                    }

                    $collAuthyLogs->getInternalIterator()->rewind();

                    return $collAuthyLogs;
                }

                if ($partial && $this->collAuthyLogs) {
                    foreach ($this->collAuthyLogs as $obj) {
                        if ($obj->isNew()) {
                            $collAuthyLogs[] = $obj;
                        }
                    }
                }

                $this->collAuthyLogs = $collAuthyLogs;
                $this->collAuthyLogsPartial = false;
            }
        }

        return $this->collAuthyLogs;
    }

    /**
     * Sets a collection of AuthyLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $authyLogs A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setAuthyLogs(PropelCollection $authyLogs, PropelPDO $con = null)
    {
        $authyLogsToDelete = $this->getAuthyLogs(new Criteria(), $con)->diff($authyLogs);


        $this->authyLogsScheduledForDeletion = $authyLogsToDelete;

        foreach ($authyLogsToDelete as $authyLogRemoved) {
            $authyLogRemoved->setAuthy(null);
        }

        $this->collAuthyLogs = null;
        foreach ($authyLogs as $authyLog) {
            $this->addAuthyLog($authyLog);
        }

        $this->collAuthyLogs = $authyLogs;
        $this->collAuthyLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related AuthyLog objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related AuthyLog objects.
     * @throws PropelException
     */
    public function countAuthyLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAuthyLogsPartial && !$this->isNew();
        if (null === $this->collAuthyLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuthyLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuthyLogs());
            }
            $query = AuthyLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthy($this)
                ->count($con);
        }

        return count($this->collAuthyLogs);
    }

    /**
     * Method called to associate a AuthyLog object to this object
     * through the AuthyLog foreign key attribute.
     *
     * @param    AuthyLog $l AuthyLog
     * @return Authy The current object (for fluent API support)
     */
    public function addAuthyLog(AuthyLog $l)
    {
        if ($this->collAuthyLogs === null) {
            $this->initAuthyLogs();
            $this->collAuthyLogsPartial = true;
        }

        if (!in_array($l, $this->collAuthyLogs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAuthyLog($l);

            if ($this->authyLogsScheduledForDeletion and $this->authyLogsScheduledForDeletion->contains($l)) {
                $this->authyLogsScheduledForDeletion->remove($this->authyLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	AuthyLog $authyLog The authyLog object to add.
     */
    protected function doAddAuthyLog($authyLog)
    {
        $this->collAuthyLogs[]= $authyLog;
        $authyLog->setAuthy($this);
    }

    /**
     * @param	AuthyLog $authyLog The authyLog object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeAuthyLog($authyLog)
    {
        if ($this->getAuthyLogs()->contains($authyLog)) {
            $this->collAuthyLogs->remove($this->collAuthyLogs->search($authyLog));
            if (null === $this->authyLogsScheduledForDeletion) {
                $this->authyLogsScheduledForDeletion = clone $this->collAuthyLogs;
                $this->authyLogsScheduledForDeletion->clear();
            }
            $this->authyLogsScheduledForDeletion[]= $authyLog;
            $authyLog->setAuthy(null);
        }

        return $this;
    }

    /**
     * Clears out the collClientsRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addClientsRelatedByIdCreation()
     */
    public function clearClientsRelatedByIdCreation()
    {
        $this->collClientsRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collClientsRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collClientsRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialClientsRelatedByIdCreation($v = true)
    {
        $this->collClientsRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collClientsRelatedByIdCreation collection.
     *
     * By default this just sets the collClientsRelatedByIdCreation collection to an empty array (like clearcollClientsRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initClientsRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collClientsRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collClientsRelatedByIdCreation = new PropelObjectCollection();
        $this->collClientsRelatedByIdCreation->setModel('Client');
    }

    /**
     * Gets an array of Client objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Client[] List of Client objects
     * @throws PropelException
     */
    public function getClientsRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collClientsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collClientsRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collClientsRelatedByIdCreation) {
                // return empty collection
                $this->initClientsRelatedByIdCreation();
            } else {
                $collClientsRelatedByIdCreation = ClientQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collClientsRelatedByIdCreationPartial && count($collClientsRelatedByIdCreation)) {
                      $this->initClientsRelatedByIdCreation(false);

                      foreach ($collClientsRelatedByIdCreation as $obj) {
                        if (false == $this->collClientsRelatedByIdCreation->contains($obj)) {
                          $this->collClientsRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collClientsRelatedByIdCreationPartial = true;
                    }

                    $collClientsRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collClientsRelatedByIdCreation;
                }

                if ($partial && $this->collClientsRelatedByIdCreation) {
                    foreach ($this->collClientsRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collClientsRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collClientsRelatedByIdCreation = $collClientsRelatedByIdCreation;
                $this->collClientsRelatedByIdCreationPartial = false;
            }
        }

        return $this->collClientsRelatedByIdCreation;
    }

    /**
     * Sets a collection of ClientRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $clientsRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setClientsRelatedByIdCreation(PropelCollection $clientsRelatedByIdCreation, PropelPDO $con = null)
    {
        $clientsRelatedByIdCreationToDelete = $this->getClientsRelatedByIdCreation(new Criteria(), $con)->diff($clientsRelatedByIdCreation);


        $this->clientsRelatedByIdCreationScheduledForDeletion = $clientsRelatedByIdCreationToDelete;

        foreach ($clientsRelatedByIdCreationToDelete as $clientRelatedByIdCreationRemoved) {
            $clientRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collClientsRelatedByIdCreation = null;
        foreach ($clientsRelatedByIdCreation as $clientRelatedByIdCreation) {
            $this->addClientRelatedByIdCreation($clientRelatedByIdCreation);
        }

        $this->collClientsRelatedByIdCreation = $clientsRelatedByIdCreation;
        $this->collClientsRelatedByIdCreationPartial = false;

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
    public function countClientsRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collClientsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collClientsRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collClientsRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getClientsRelatedByIdCreation());
            }
            $query = ClientQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collClientsRelatedByIdCreation);
    }

    /**
     * Method called to associate a Client object to this object
     * through the Client foreign key attribute.
     *
     * @param    Client $l Client
     * @return Authy The current object (for fluent API support)
     */
    public function addClientRelatedByIdCreation(Client $l)
    {
        if ($this->collClientsRelatedByIdCreation === null) {
            $this->initClientsRelatedByIdCreation();
            $this->collClientsRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collClientsRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddClientRelatedByIdCreation($l);

            if ($this->clientsRelatedByIdCreationScheduledForDeletion and $this->clientsRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->clientsRelatedByIdCreationScheduledForDeletion->remove($this->clientsRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ClientRelatedByIdCreation $clientRelatedByIdCreation The clientRelatedByIdCreation object to add.
     */
    protected function doAddClientRelatedByIdCreation($clientRelatedByIdCreation)
    {
        $this->collClientsRelatedByIdCreation[]= $clientRelatedByIdCreation;
        $clientRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	ClientRelatedByIdCreation $clientRelatedByIdCreation The clientRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeClientRelatedByIdCreation($clientRelatedByIdCreation)
    {
        if ($this->getClientsRelatedByIdCreation()->contains($clientRelatedByIdCreation)) {
            $this->collClientsRelatedByIdCreation->remove($this->collClientsRelatedByIdCreation->search($clientRelatedByIdCreation));
            if (null === $this->clientsRelatedByIdCreationScheduledForDeletion) {
                $this->clientsRelatedByIdCreationScheduledForDeletion = clone $this->collClientsRelatedByIdCreation;
                $this->clientsRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->clientsRelatedByIdCreationScheduledForDeletion[]= $clientRelatedByIdCreation;
            $clientRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getClientsRelatedByIdCreationJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('Country', $join_behavior);

        return $this->getClientsRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsRelatedByIdCreationJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

        return $this->getClientsRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsRelatedByIdCreationJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('Currency', $join_behavior);

        return $this->getClientsRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getClientsRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collClientsRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addClientsRelatedByIdModification()
     */
    public function clearClientsRelatedByIdModification()
    {
        $this->collClientsRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collClientsRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collClientsRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialClientsRelatedByIdModification($v = true)
    {
        $this->collClientsRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collClientsRelatedByIdModification collection.
     *
     * By default this just sets the collClientsRelatedByIdModification collection to an empty array (like clearcollClientsRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initClientsRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collClientsRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collClientsRelatedByIdModification = new PropelObjectCollection();
        $this->collClientsRelatedByIdModification->setModel('Client');
    }

    /**
     * Gets an array of Client objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Client[] List of Client objects
     * @throws PropelException
     */
    public function getClientsRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collClientsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collClientsRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collClientsRelatedByIdModification) {
                // return empty collection
                $this->initClientsRelatedByIdModification();
            } else {
                $collClientsRelatedByIdModification = ClientQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collClientsRelatedByIdModificationPartial && count($collClientsRelatedByIdModification)) {
                      $this->initClientsRelatedByIdModification(false);

                      foreach ($collClientsRelatedByIdModification as $obj) {
                        if (false == $this->collClientsRelatedByIdModification->contains($obj)) {
                          $this->collClientsRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collClientsRelatedByIdModificationPartial = true;
                    }

                    $collClientsRelatedByIdModification->getInternalIterator()->rewind();

                    return $collClientsRelatedByIdModification;
                }

                if ($partial && $this->collClientsRelatedByIdModification) {
                    foreach ($this->collClientsRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collClientsRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collClientsRelatedByIdModification = $collClientsRelatedByIdModification;
                $this->collClientsRelatedByIdModificationPartial = false;
            }
        }

        return $this->collClientsRelatedByIdModification;
    }

    /**
     * Sets a collection of ClientRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $clientsRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setClientsRelatedByIdModification(PropelCollection $clientsRelatedByIdModification, PropelPDO $con = null)
    {
        $clientsRelatedByIdModificationToDelete = $this->getClientsRelatedByIdModification(new Criteria(), $con)->diff($clientsRelatedByIdModification);


        $this->clientsRelatedByIdModificationScheduledForDeletion = $clientsRelatedByIdModificationToDelete;

        foreach ($clientsRelatedByIdModificationToDelete as $clientRelatedByIdModificationRemoved) {
            $clientRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collClientsRelatedByIdModification = null;
        foreach ($clientsRelatedByIdModification as $clientRelatedByIdModification) {
            $this->addClientRelatedByIdModification($clientRelatedByIdModification);
        }

        $this->collClientsRelatedByIdModification = $clientsRelatedByIdModification;
        $this->collClientsRelatedByIdModificationPartial = false;

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
    public function countClientsRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collClientsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collClientsRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collClientsRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getClientsRelatedByIdModification());
            }
            $query = ClientQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collClientsRelatedByIdModification);
    }

    /**
     * Method called to associate a Client object to this object
     * through the Client foreign key attribute.
     *
     * @param    Client $l Client
     * @return Authy The current object (for fluent API support)
     */
    public function addClientRelatedByIdModification(Client $l)
    {
        if ($this->collClientsRelatedByIdModification === null) {
            $this->initClientsRelatedByIdModification();
            $this->collClientsRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collClientsRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddClientRelatedByIdModification($l);

            if ($this->clientsRelatedByIdModificationScheduledForDeletion and $this->clientsRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->clientsRelatedByIdModificationScheduledForDeletion->remove($this->clientsRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ClientRelatedByIdModification $clientRelatedByIdModification The clientRelatedByIdModification object to add.
     */
    protected function doAddClientRelatedByIdModification($clientRelatedByIdModification)
    {
        $this->collClientsRelatedByIdModification[]= $clientRelatedByIdModification;
        $clientRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	ClientRelatedByIdModification $clientRelatedByIdModification The clientRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeClientRelatedByIdModification($clientRelatedByIdModification)
    {
        if ($this->getClientsRelatedByIdModification()->contains($clientRelatedByIdModification)) {
            $this->collClientsRelatedByIdModification->remove($this->collClientsRelatedByIdModification->search($clientRelatedByIdModification));
            if (null === $this->clientsRelatedByIdModificationScheduledForDeletion) {
                $this->clientsRelatedByIdModificationScheduledForDeletion = clone $this->collClientsRelatedByIdModification;
                $this->clientsRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->clientsRelatedByIdModificationScheduledForDeletion[]= $clientRelatedByIdModification;
            $clientRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getClientsRelatedByIdModificationJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('Country', $join_behavior);

        return $this->getClientsRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsRelatedByIdModificationJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

        return $this->getClientsRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsRelatedByIdModificationJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('Currency', $join_behavior);

        return $this->getClientsRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Client[] List of Client objects
     */
    public function getClientsRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ClientQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getClientsRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collBillingsRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addBillingsRelatedByIdCreation()
     */
    public function clearBillingsRelatedByIdCreation()
    {
        $this->collBillingsRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collBillingsRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collBillingsRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialBillingsRelatedByIdCreation($v = true)
    {
        $this->collBillingsRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collBillingsRelatedByIdCreation collection.
     *
     * By default this just sets the collBillingsRelatedByIdCreation collection to an empty array (like clearcollBillingsRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBillingsRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collBillingsRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collBillingsRelatedByIdCreation = new PropelObjectCollection();
        $this->collBillingsRelatedByIdCreation->setModel('Billing');
    }

    /**
     * Gets an array of Billing objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Billing[] List of Billing objects
     * @throws PropelException
     */
    public function getBillingsRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBillingsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collBillingsRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBillingsRelatedByIdCreation) {
                // return empty collection
                $this->initBillingsRelatedByIdCreation();
            } else {
                $collBillingsRelatedByIdCreation = BillingQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBillingsRelatedByIdCreationPartial && count($collBillingsRelatedByIdCreation)) {
                      $this->initBillingsRelatedByIdCreation(false);

                      foreach ($collBillingsRelatedByIdCreation as $obj) {
                        if (false == $this->collBillingsRelatedByIdCreation->contains($obj)) {
                          $this->collBillingsRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collBillingsRelatedByIdCreationPartial = true;
                    }

                    $collBillingsRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collBillingsRelatedByIdCreation;
                }

                if ($partial && $this->collBillingsRelatedByIdCreation) {
                    foreach ($this->collBillingsRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collBillingsRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collBillingsRelatedByIdCreation = $collBillingsRelatedByIdCreation;
                $this->collBillingsRelatedByIdCreationPartial = false;
            }
        }

        return $this->collBillingsRelatedByIdCreation;
    }

    /**
     * Sets a collection of BillingRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $billingsRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setBillingsRelatedByIdCreation(PropelCollection $billingsRelatedByIdCreation, PropelPDO $con = null)
    {
        $billingsRelatedByIdCreationToDelete = $this->getBillingsRelatedByIdCreation(new Criteria(), $con)->diff($billingsRelatedByIdCreation);


        $this->billingsRelatedByIdCreationScheduledForDeletion = $billingsRelatedByIdCreationToDelete;

        foreach ($billingsRelatedByIdCreationToDelete as $billingRelatedByIdCreationRemoved) {
            $billingRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collBillingsRelatedByIdCreation = null;
        foreach ($billingsRelatedByIdCreation as $billingRelatedByIdCreation) {
            $this->addBillingRelatedByIdCreation($billingRelatedByIdCreation);
        }

        $this->collBillingsRelatedByIdCreation = $billingsRelatedByIdCreation;
        $this->collBillingsRelatedByIdCreationPartial = false;

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
    public function countBillingsRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBillingsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collBillingsRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBillingsRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBillingsRelatedByIdCreation());
            }
            $query = BillingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collBillingsRelatedByIdCreation);
    }

    /**
     * Method called to associate a Billing object to this object
     * through the Billing foreign key attribute.
     *
     * @param    Billing $l Billing
     * @return Authy The current object (for fluent API support)
     */
    public function addBillingRelatedByIdCreation(Billing $l)
    {
        if ($this->collBillingsRelatedByIdCreation === null) {
            $this->initBillingsRelatedByIdCreation();
            $this->collBillingsRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collBillingsRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBillingRelatedByIdCreation($l);

            if ($this->billingsRelatedByIdCreationScheduledForDeletion and $this->billingsRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->billingsRelatedByIdCreationScheduledForDeletion->remove($this->billingsRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	BillingRelatedByIdCreation $billingRelatedByIdCreation The billingRelatedByIdCreation object to add.
     */
    protected function doAddBillingRelatedByIdCreation($billingRelatedByIdCreation)
    {
        $this->collBillingsRelatedByIdCreation[]= $billingRelatedByIdCreation;
        $billingRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	BillingRelatedByIdCreation $billingRelatedByIdCreation The billingRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeBillingRelatedByIdCreation($billingRelatedByIdCreation)
    {
        if ($this->getBillingsRelatedByIdCreation()->contains($billingRelatedByIdCreation)) {
            $this->collBillingsRelatedByIdCreation->remove($this->collBillingsRelatedByIdCreation->search($billingRelatedByIdCreation));
            if (null === $this->billingsRelatedByIdCreationScheduledForDeletion) {
                $this->billingsRelatedByIdCreationScheduledForDeletion = clone $this->collBillingsRelatedByIdCreation;
                $this->billingsRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->billingsRelatedByIdCreationScheduledForDeletion[]= $billingRelatedByIdCreation;
            $billingRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getBillingsRelatedByIdCreationJoinClient($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('Client', $join_behavior);

        return $this->getBillingsRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsRelatedByIdCreationJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getBillingsRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsRelatedByIdCreationJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

        return $this->getBillingsRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsRelatedByIdCreationJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('Currency', $join_behavior);

        return $this->getBillingsRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getBillingsRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collBillingsRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addBillingsRelatedByIdModification()
     */
    public function clearBillingsRelatedByIdModification()
    {
        $this->collBillingsRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collBillingsRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collBillingsRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialBillingsRelatedByIdModification($v = true)
    {
        $this->collBillingsRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collBillingsRelatedByIdModification collection.
     *
     * By default this just sets the collBillingsRelatedByIdModification collection to an empty array (like clearcollBillingsRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBillingsRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collBillingsRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collBillingsRelatedByIdModification = new PropelObjectCollection();
        $this->collBillingsRelatedByIdModification->setModel('Billing');
    }

    /**
     * Gets an array of Billing objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Billing[] List of Billing objects
     * @throws PropelException
     */
    public function getBillingsRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBillingsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collBillingsRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBillingsRelatedByIdModification) {
                // return empty collection
                $this->initBillingsRelatedByIdModification();
            } else {
                $collBillingsRelatedByIdModification = BillingQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBillingsRelatedByIdModificationPartial && count($collBillingsRelatedByIdModification)) {
                      $this->initBillingsRelatedByIdModification(false);

                      foreach ($collBillingsRelatedByIdModification as $obj) {
                        if (false == $this->collBillingsRelatedByIdModification->contains($obj)) {
                          $this->collBillingsRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collBillingsRelatedByIdModificationPartial = true;
                    }

                    $collBillingsRelatedByIdModification->getInternalIterator()->rewind();

                    return $collBillingsRelatedByIdModification;
                }

                if ($partial && $this->collBillingsRelatedByIdModification) {
                    foreach ($this->collBillingsRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collBillingsRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collBillingsRelatedByIdModification = $collBillingsRelatedByIdModification;
                $this->collBillingsRelatedByIdModificationPartial = false;
            }
        }

        return $this->collBillingsRelatedByIdModification;
    }

    /**
     * Sets a collection of BillingRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $billingsRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setBillingsRelatedByIdModification(PropelCollection $billingsRelatedByIdModification, PropelPDO $con = null)
    {
        $billingsRelatedByIdModificationToDelete = $this->getBillingsRelatedByIdModification(new Criteria(), $con)->diff($billingsRelatedByIdModification);


        $this->billingsRelatedByIdModificationScheduledForDeletion = $billingsRelatedByIdModificationToDelete;

        foreach ($billingsRelatedByIdModificationToDelete as $billingRelatedByIdModificationRemoved) {
            $billingRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collBillingsRelatedByIdModification = null;
        foreach ($billingsRelatedByIdModification as $billingRelatedByIdModification) {
            $this->addBillingRelatedByIdModification($billingRelatedByIdModification);
        }

        $this->collBillingsRelatedByIdModification = $billingsRelatedByIdModification;
        $this->collBillingsRelatedByIdModificationPartial = false;

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
    public function countBillingsRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBillingsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collBillingsRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBillingsRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBillingsRelatedByIdModification());
            }
            $query = BillingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collBillingsRelatedByIdModification);
    }

    /**
     * Method called to associate a Billing object to this object
     * through the Billing foreign key attribute.
     *
     * @param    Billing $l Billing
     * @return Authy The current object (for fluent API support)
     */
    public function addBillingRelatedByIdModification(Billing $l)
    {
        if ($this->collBillingsRelatedByIdModification === null) {
            $this->initBillingsRelatedByIdModification();
            $this->collBillingsRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collBillingsRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBillingRelatedByIdModification($l);

            if ($this->billingsRelatedByIdModificationScheduledForDeletion and $this->billingsRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->billingsRelatedByIdModificationScheduledForDeletion->remove($this->billingsRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	BillingRelatedByIdModification $billingRelatedByIdModification The billingRelatedByIdModification object to add.
     */
    protected function doAddBillingRelatedByIdModification($billingRelatedByIdModification)
    {
        $this->collBillingsRelatedByIdModification[]= $billingRelatedByIdModification;
        $billingRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	BillingRelatedByIdModification $billingRelatedByIdModification The billingRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeBillingRelatedByIdModification($billingRelatedByIdModification)
    {
        if ($this->getBillingsRelatedByIdModification()->contains($billingRelatedByIdModification)) {
            $this->collBillingsRelatedByIdModification->remove($this->collBillingsRelatedByIdModification->search($billingRelatedByIdModification));
            if (null === $this->billingsRelatedByIdModificationScheduledForDeletion) {
                $this->billingsRelatedByIdModificationScheduledForDeletion = clone $this->collBillingsRelatedByIdModification;
                $this->billingsRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->billingsRelatedByIdModificationScheduledForDeletion[]= $billingRelatedByIdModification;
            $billingRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getBillingsRelatedByIdModificationJoinClient($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('Client', $join_behavior);

        return $this->getBillingsRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsRelatedByIdModificationJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getBillingsRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsRelatedByIdModificationJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

        return $this->getBillingsRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsRelatedByIdModificationJoinCurrency($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('Currency', $join_behavior);

        return $this->getBillingsRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Billing[] List of Billing objects
     */
    public function getBillingsRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getBillingsRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collBillingLinesRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addBillingLinesRelatedByIdCreation()
     */
    public function clearBillingLinesRelatedByIdCreation()
    {
        $this->collBillingLinesRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collBillingLinesRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collBillingLinesRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialBillingLinesRelatedByIdCreation($v = true)
    {
        $this->collBillingLinesRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collBillingLinesRelatedByIdCreation collection.
     *
     * By default this just sets the collBillingLinesRelatedByIdCreation collection to an empty array (like clearcollBillingLinesRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBillingLinesRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collBillingLinesRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collBillingLinesRelatedByIdCreation = new PropelObjectCollection();
        $this->collBillingLinesRelatedByIdCreation->setModel('BillingLine');
    }

    /**
     * Gets an array of BillingLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     * @throws PropelException
     */
    public function getBillingLinesRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBillingLinesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collBillingLinesRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBillingLinesRelatedByIdCreation) {
                // return empty collection
                $this->initBillingLinesRelatedByIdCreation();
            } else {
                $collBillingLinesRelatedByIdCreation = BillingLineQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBillingLinesRelatedByIdCreationPartial && count($collBillingLinesRelatedByIdCreation)) {
                      $this->initBillingLinesRelatedByIdCreation(false);

                      foreach ($collBillingLinesRelatedByIdCreation as $obj) {
                        if (false == $this->collBillingLinesRelatedByIdCreation->contains($obj)) {
                          $this->collBillingLinesRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collBillingLinesRelatedByIdCreationPartial = true;
                    }

                    $collBillingLinesRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collBillingLinesRelatedByIdCreation;
                }

                if ($partial && $this->collBillingLinesRelatedByIdCreation) {
                    foreach ($this->collBillingLinesRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collBillingLinesRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collBillingLinesRelatedByIdCreation = $collBillingLinesRelatedByIdCreation;
                $this->collBillingLinesRelatedByIdCreationPartial = false;
            }
        }

        return $this->collBillingLinesRelatedByIdCreation;
    }

    /**
     * Sets a collection of BillingLineRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $billingLinesRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setBillingLinesRelatedByIdCreation(PropelCollection $billingLinesRelatedByIdCreation, PropelPDO $con = null)
    {
        $billingLinesRelatedByIdCreationToDelete = $this->getBillingLinesRelatedByIdCreation(new Criteria(), $con)->diff($billingLinesRelatedByIdCreation);


        $this->billingLinesRelatedByIdCreationScheduledForDeletion = $billingLinesRelatedByIdCreationToDelete;

        foreach ($billingLinesRelatedByIdCreationToDelete as $billingLineRelatedByIdCreationRemoved) {
            $billingLineRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collBillingLinesRelatedByIdCreation = null;
        foreach ($billingLinesRelatedByIdCreation as $billingLineRelatedByIdCreation) {
            $this->addBillingLineRelatedByIdCreation($billingLineRelatedByIdCreation);
        }

        $this->collBillingLinesRelatedByIdCreation = $billingLinesRelatedByIdCreation;
        $this->collBillingLinesRelatedByIdCreationPartial = false;

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
    public function countBillingLinesRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBillingLinesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collBillingLinesRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBillingLinesRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBillingLinesRelatedByIdCreation());
            }
            $query = BillingLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collBillingLinesRelatedByIdCreation);
    }

    /**
     * Method called to associate a BillingLine object to this object
     * through the BillingLine foreign key attribute.
     *
     * @param    BillingLine $l BillingLine
     * @return Authy The current object (for fluent API support)
     */
    public function addBillingLineRelatedByIdCreation(BillingLine $l)
    {
        if ($this->collBillingLinesRelatedByIdCreation === null) {
            $this->initBillingLinesRelatedByIdCreation();
            $this->collBillingLinesRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collBillingLinesRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBillingLineRelatedByIdCreation($l);

            if ($this->billingLinesRelatedByIdCreationScheduledForDeletion and $this->billingLinesRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->billingLinesRelatedByIdCreationScheduledForDeletion->remove($this->billingLinesRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	BillingLineRelatedByIdCreation $billingLineRelatedByIdCreation The billingLineRelatedByIdCreation object to add.
     */
    protected function doAddBillingLineRelatedByIdCreation($billingLineRelatedByIdCreation)
    {
        $this->collBillingLinesRelatedByIdCreation[]= $billingLineRelatedByIdCreation;
        $billingLineRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	BillingLineRelatedByIdCreation $billingLineRelatedByIdCreation The billingLineRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeBillingLineRelatedByIdCreation($billingLineRelatedByIdCreation)
    {
        if ($this->getBillingLinesRelatedByIdCreation()->contains($billingLineRelatedByIdCreation)) {
            $this->collBillingLinesRelatedByIdCreation->remove($this->collBillingLinesRelatedByIdCreation->search($billingLineRelatedByIdCreation));
            if (null === $this->billingLinesRelatedByIdCreationScheduledForDeletion) {
                $this->billingLinesRelatedByIdCreationScheduledForDeletion = clone $this->collBillingLinesRelatedByIdCreation;
                $this->billingLinesRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->billingLinesRelatedByIdCreationScheduledForDeletion[]= $billingLineRelatedByIdCreation;
            $billingLineRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getBillingLinesRelatedByIdCreationJoinBilling($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('Billing', $join_behavior);

        return $this->getBillingLinesRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesRelatedByIdCreationJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getBillingLinesRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesRelatedByIdCreationJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

        return $this->getBillingLinesRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getBillingLinesRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collBillingLinesRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addBillingLinesRelatedByIdModification()
     */
    public function clearBillingLinesRelatedByIdModification()
    {
        $this->collBillingLinesRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collBillingLinesRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collBillingLinesRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialBillingLinesRelatedByIdModification($v = true)
    {
        $this->collBillingLinesRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collBillingLinesRelatedByIdModification collection.
     *
     * By default this just sets the collBillingLinesRelatedByIdModification collection to an empty array (like clearcollBillingLinesRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBillingLinesRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collBillingLinesRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collBillingLinesRelatedByIdModification = new PropelObjectCollection();
        $this->collBillingLinesRelatedByIdModification->setModel('BillingLine');
    }

    /**
     * Gets an array of BillingLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     * @throws PropelException
     */
    public function getBillingLinesRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBillingLinesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collBillingLinesRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBillingLinesRelatedByIdModification) {
                // return empty collection
                $this->initBillingLinesRelatedByIdModification();
            } else {
                $collBillingLinesRelatedByIdModification = BillingLineQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBillingLinesRelatedByIdModificationPartial && count($collBillingLinesRelatedByIdModification)) {
                      $this->initBillingLinesRelatedByIdModification(false);

                      foreach ($collBillingLinesRelatedByIdModification as $obj) {
                        if (false == $this->collBillingLinesRelatedByIdModification->contains($obj)) {
                          $this->collBillingLinesRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collBillingLinesRelatedByIdModificationPartial = true;
                    }

                    $collBillingLinesRelatedByIdModification->getInternalIterator()->rewind();

                    return $collBillingLinesRelatedByIdModification;
                }

                if ($partial && $this->collBillingLinesRelatedByIdModification) {
                    foreach ($this->collBillingLinesRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collBillingLinesRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collBillingLinesRelatedByIdModification = $collBillingLinesRelatedByIdModification;
                $this->collBillingLinesRelatedByIdModificationPartial = false;
            }
        }

        return $this->collBillingLinesRelatedByIdModification;
    }

    /**
     * Sets a collection of BillingLineRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $billingLinesRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setBillingLinesRelatedByIdModification(PropelCollection $billingLinesRelatedByIdModification, PropelPDO $con = null)
    {
        $billingLinesRelatedByIdModificationToDelete = $this->getBillingLinesRelatedByIdModification(new Criteria(), $con)->diff($billingLinesRelatedByIdModification);


        $this->billingLinesRelatedByIdModificationScheduledForDeletion = $billingLinesRelatedByIdModificationToDelete;

        foreach ($billingLinesRelatedByIdModificationToDelete as $billingLineRelatedByIdModificationRemoved) {
            $billingLineRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collBillingLinesRelatedByIdModification = null;
        foreach ($billingLinesRelatedByIdModification as $billingLineRelatedByIdModification) {
            $this->addBillingLineRelatedByIdModification($billingLineRelatedByIdModification);
        }

        $this->collBillingLinesRelatedByIdModification = $billingLinesRelatedByIdModification;
        $this->collBillingLinesRelatedByIdModificationPartial = false;

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
    public function countBillingLinesRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBillingLinesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collBillingLinesRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBillingLinesRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBillingLinesRelatedByIdModification());
            }
            $query = BillingLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collBillingLinesRelatedByIdModification);
    }

    /**
     * Method called to associate a BillingLine object to this object
     * through the BillingLine foreign key attribute.
     *
     * @param    BillingLine $l BillingLine
     * @return Authy The current object (for fluent API support)
     */
    public function addBillingLineRelatedByIdModification(BillingLine $l)
    {
        if ($this->collBillingLinesRelatedByIdModification === null) {
            $this->initBillingLinesRelatedByIdModification();
            $this->collBillingLinesRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collBillingLinesRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBillingLineRelatedByIdModification($l);

            if ($this->billingLinesRelatedByIdModificationScheduledForDeletion and $this->billingLinesRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->billingLinesRelatedByIdModificationScheduledForDeletion->remove($this->billingLinesRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	BillingLineRelatedByIdModification $billingLineRelatedByIdModification The billingLineRelatedByIdModification object to add.
     */
    protected function doAddBillingLineRelatedByIdModification($billingLineRelatedByIdModification)
    {
        $this->collBillingLinesRelatedByIdModification[]= $billingLineRelatedByIdModification;
        $billingLineRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	BillingLineRelatedByIdModification $billingLineRelatedByIdModification The billingLineRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeBillingLineRelatedByIdModification($billingLineRelatedByIdModification)
    {
        if ($this->getBillingLinesRelatedByIdModification()->contains($billingLineRelatedByIdModification)) {
            $this->collBillingLinesRelatedByIdModification->remove($this->collBillingLinesRelatedByIdModification->search($billingLineRelatedByIdModification));
            if (null === $this->billingLinesRelatedByIdModificationScheduledForDeletion) {
                $this->billingLinesRelatedByIdModificationScheduledForDeletion = clone $this->collBillingLinesRelatedByIdModification;
                $this->billingLinesRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->billingLinesRelatedByIdModificationScheduledForDeletion[]= $billingLineRelatedByIdModification;
            $billingLineRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getBillingLinesRelatedByIdModificationJoinBilling($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('Billing', $join_behavior);

        return $this->getBillingLinesRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesRelatedByIdModificationJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getBillingLinesRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesRelatedByIdModificationJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

        return $this->getBillingLinesRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BillingLine[] List of BillingLine objects
     */
    public function getBillingLinesRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getBillingLinesRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collPaymentLinesRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addPaymentLinesRelatedByIdCreation()
     */
    public function clearPaymentLinesRelatedByIdCreation()
    {
        $this->collPaymentLinesRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collPaymentLinesRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collPaymentLinesRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialPaymentLinesRelatedByIdCreation($v = true)
    {
        $this->collPaymentLinesRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collPaymentLinesRelatedByIdCreation collection.
     *
     * By default this just sets the collPaymentLinesRelatedByIdCreation collection to an empty array (like clearcollPaymentLinesRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPaymentLinesRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collPaymentLinesRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collPaymentLinesRelatedByIdCreation = new PropelObjectCollection();
        $this->collPaymentLinesRelatedByIdCreation->setModel('PaymentLine');
    }

    /**
     * Gets an array of PaymentLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PaymentLine[] List of PaymentLine objects
     * @throws PropelException
     */
    public function getPaymentLinesRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPaymentLinesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collPaymentLinesRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPaymentLinesRelatedByIdCreation) {
                // return empty collection
                $this->initPaymentLinesRelatedByIdCreation();
            } else {
                $collPaymentLinesRelatedByIdCreation = PaymentLineQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPaymentLinesRelatedByIdCreationPartial && count($collPaymentLinesRelatedByIdCreation)) {
                      $this->initPaymentLinesRelatedByIdCreation(false);

                      foreach ($collPaymentLinesRelatedByIdCreation as $obj) {
                        if (false == $this->collPaymentLinesRelatedByIdCreation->contains($obj)) {
                          $this->collPaymentLinesRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collPaymentLinesRelatedByIdCreationPartial = true;
                    }

                    $collPaymentLinesRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collPaymentLinesRelatedByIdCreation;
                }

                if ($partial && $this->collPaymentLinesRelatedByIdCreation) {
                    foreach ($this->collPaymentLinesRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collPaymentLinesRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collPaymentLinesRelatedByIdCreation = $collPaymentLinesRelatedByIdCreation;
                $this->collPaymentLinesRelatedByIdCreationPartial = false;
            }
        }

        return $this->collPaymentLinesRelatedByIdCreation;
    }

    /**
     * Sets a collection of PaymentLineRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $paymentLinesRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setPaymentLinesRelatedByIdCreation(PropelCollection $paymentLinesRelatedByIdCreation, PropelPDO $con = null)
    {
        $paymentLinesRelatedByIdCreationToDelete = $this->getPaymentLinesRelatedByIdCreation(new Criteria(), $con)->diff($paymentLinesRelatedByIdCreation);


        $this->paymentLinesRelatedByIdCreationScheduledForDeletion = $paymentLinesRelatedByIdCreationToDelete;

        foreach ($paymentLinesRelatedByIdCreationToDelete as $paymentLineRelatedByIdCreationRemoved) {
            $paymentLineRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collPaymentLinesRelatedByIdCreation = null;
        foreach ($paymentLinesRelatedByIdCreation as $paymentLineRelatedByIdCreation) {
            $this->addPaymentLineRelatedByIdCreation($paymentLineRelatedByIdCreation);
        }

        $this->collPaymentLinesRelatedByIdCreation = $paymentLinesRelatedByIdCreation;
        $this->collPaymentLinesRelatedByIdCreationPartial = false;

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
    public function countPaymentLinesRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPaymentLinesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collPaymentLinesRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPaymentLinesRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPaymentLinesRelatedByIdCreation());
            }
            $query = PaymentLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collPaymentLinesRelatedByIdCreation);
    }

    /**
     * Method called to associate a PaymentLine object to this object
     * through the PaymentLine foreign key attribute.
     *
     * @param    PaymentLine $l PaymentLine
     * @return Authy The current object (for fluent API support)
     */
    public function addPaymentLineRelatedByIdCreation(PaymentLine $l)
    {
        if ($this->collPaymentLinesRelatedByIdCreation === null) {
            $this->initPaymentLinesRelatedByIdCreation();
            $this->collPaymentLinesRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collPaymentLinesRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPaymentLineRelatedByIdCreation($l);

            if ($this->paymentLinesRelatedByIdCreationScheduledForDeletion and $this->paymentLinesRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->paymentLinesRelatedByIdCreationScheduledForDeletion->remove($this->paymentLinesRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	PaymentLineRelatedByIdCreation $paymentLineRelatedByIdCreation The paymentLineRelatedByIdCreation object to add.
     */
    protected function doAddPaymentLineRelatedByIdCreation($paymentLineRelatedByIdCreation)
    {
        $this->collPaymentLinesRelatedByIdCreation[]= $paymentLineRelatedByIdCreation;
        $paymentLineRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	PaymentLineRelatedByIdCreation $paymentLineRelatedByIdCreation The paymentLineRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removePaymentLineRelatedByIdCreation($paymentLineRelatedByIdCreation)
    {
        if ($this->getPaymentLinesRelatedByIdCreation()->contains($paymentLineRelatedByIdCreation)) {
            $this->collPaymentLinesRelatedByIdCreation->remove($this->collPaymentLinesRelatedByIdCreation->search($paymentLineRelatedByIdCreation));
            if (null === $this->paymentLinesRelatedByIdCreationScheduledForDeletion) {
                $this->paymentLinesRelatedByIdCreationScheduledForDeletion = clone $this->collPaymentLinesRelatedByIdCreation;
                $this->paymentLinesRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->paymentLinesRelatedByIdCreationScheduledForDeletion[]= $paymentLineRelatedByIdCreation;
            $paymentLineRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getPaymentLinesRelatedByIdCreationJoinBilling($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PaymentLineQuery::create(null, $criteria);
        $query->joinWith('Billing', $join_behavior);

        return $this->getPaymentLinesRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PaymentLine[] List of PaymentLine objects
     */
    public function getPaymentLinesRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PaymentLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getPaymentLinesRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collPaymentLinesRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addPaymentLinesRelatedByIdModification()
     */
    public function clearPaymentLinesRelatedByIdModification()
    {
        $this->collPaymentLinesRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collPaymentLinesRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collPaymentLinesRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialPaymentLinesRelatedByIdModification($v = true)
    {
        $this->collPaymentLinesRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collPaymentLinesRelatedByIdModification collection.
     *
     * By default this just sets the collPaymentLinesRelatedByIdModification collection to an empty array (like clearcollPaymentLinesRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPaymentLinesRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collPaymentLinesRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collPaymentLinesRelatedByIdModification = new PropelObjectCollection();
        $this->collPaymentLinesRelatedByIdModification->setModel('PaymentLine');
    }

    /**
     * Gets an array of PaymentLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PaymentLine[] List of PaymentLine objects
     * @throws PropelException
     */
    public function getPaymentLinesRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPaymentLinesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collPaymentLinesRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPaymentLinesRelatedByIdModification) {
                // return empty collection
                $this->initPaymentLinesRelatedByIdModification();
            } else {
                $collPaymentLinesRelatedByIdModification = PaymentLineQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPaymentLinesRelatedByIdModificationPartial && count($collPaymentLinesRelatedByIdModification)) {
                      $this->initPaymentLinesRelatedByIdModification(false);

                      foreach ($collPaymentLinesRelatedByIdModification as $obj) {
                        if (false == $this->collPaymentLinesRelatedByIdModification->contains($obj)) {
                          $this->collPaymentLinesRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collPaymentLinesRelatedByIdModificationPartial = true;
                    }

                    $collPaymentLinesRelatedByIdModification->getInternalIterator()->rewind();

                    return $collPaymentLinesRelatedByIdModification;
                }

                if ($partial && $this->collPaymentLinesRelatedByIdModification) {
                    foreach ($this->collPaymentLinesRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collPaymentLinesRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collPaymentLinesRelatedByIdModification = $collPaymentLinesRelatedByIdModification;
                $this->collPaymentLinesRelatedByIdModificationPartial = false;
            }
        }

        return $this->collPaymentLinesRelatedByIdModification;
    }

    /**
     * Sets a collection of PaymentLineRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $paymentLinesRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setPaymentLinesRelatedByIdModification(PropelCollection $paymentLinesRelatedByIdModification, PropelPDO $con = null)
    {
        $paymentLinesRelatedByIdModificationToDelete = $this->getPaymentLinesRelatedByIdModification(new Criteria(), $con)->diff($paymentLinesRelatedByIdModification);


        $this->paymentLinesRelatedByIdModificationScheduledForDeletion = $paymentLinesRelatedByIdModificationToDelete;

        foreach ($paymentLinesRelatedByIdModificationToDelete as $paymentLineRelatedByIdModificationRemoved) {
            $paymentLineRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collPaymentLinesRelatedByIdModification = null;
        foreach ($paymentLinesRelatedByIdModification as $paymentLineRelatedByIdModification) {
            $this->addPaymentLineRelatedByIdModification($paymentLineRelatedByIdModification);
        }

        $this->collPaymentLinesRelatedByIdModification = $paymentLinesRelatedByIdModification;
        $this->collPaymentLinesRelatedByIdModificationPartial = false;

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
    public function countPaymentLinesRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPaymentLinesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collPaymentLinesRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPaymentLinesRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPaymentLinesRelatedByIdModification());
            }
            $query = PaymentLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collPaymentLinesRelatedByIdModification);
    }

    /**
     * Method called to associate a PaymentLine object to this object
     * through the PaymentLine foreign key attribute.
     *
     * @param    PaymentLine $l PaymentLine
     * @return Authy The current object (for fluent API support)
     */
    public function addPaymentLineRelatedByIdModification(PaymentLine $l)
    {
        if ($this->collPaymentLinesRelatedByIdModification === null) {
            $this->initPaymentLinesRelatedByIdModification();
            $this->collPaymentLinesRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collPaymentLinesRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPaymentLineRelatedByIdModification($l);

            if ($this->paymentLinesRelatedByIdModificationScheduledForDeletion and $this->paymentLinesRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->paymentLinesRelatedByIdModificationScheduledForDeletion->remove($this->paymentLinesRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	PaymentLineRelatedByIdModification $paymentLineRelatedByIdModification The paymentLineRelatedByIdModification object to add.
     */
    protected function doAddPaymentLineRelatedByIdModification($paymentLineRelatedByIdModification)
    {
        $this->collPaymentLinesRelatedByIdModification[]= $paymentLineRelatedByIdModification;
        $paymentLineRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	PaymentLineRelatedByIdModification $paymentLineRelatedByIdModification The paymentLineRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removePaymentLineRelatedByIdModification($paymentLineRelatedByIdModification)
    {
        if ($this->getPaymentLinesRelatedByIdModification()->contains($paymentLineRelatedByIdModification)) {
            $this->collPaymentLinesRelatedByIdModification->remove($this->collPaymentLinesRelatedByIdModification->search($paymentLineRelatedByIdModification));
            if (null === $this->paymentLinesRelatedByIdModificationScheduledForDeletion) {
                $this->paymentLinesRelatedByIdModificationScheduledForDeletion = clone $this->collPaymentLinesRelatedByIdModification;
                $this->paymentLinesRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->paymentLinesRelatedByIdModificationScheduledForDeletion[]= $paymentLineRelatedByIdModification;
            $paymentLineRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getPaymentLinesRelatedByIdModificationJoinBilling($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PaymentLineQuery::create(null, $criteria);
        $query->joinWith('Billing', $join_behavior);

        return $this->getPaymentLinesRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PaymentLine[] List of PaymentLine objects
     */
    public function getPaymentLinesRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PaymentLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getPaymentLinesRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collCostLinesRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addCostLinesRelatedByIdCreation()
     */
    public function clearCostLinesRelatedByIdCreation()
    {
        $this->collCostLinesRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collCostLinesRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collCostLinesRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialCostLinesRelatedByIdCreation($v = true)
    {
        $this->collCostLinesRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collCostLinesRelatedByIdCreation collection.
     *
     * By default this just sets the collCostLinesRelatedByIdCreation collection to an empty array (like clearcollCostLinesRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCostLinesRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collCostLinesRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collCostLinesRelatedByIdCreation = new PropelObjectCollection();
        $this->collCostLinesRelatedByIdCreation->setModel('CostLine');
    }

    /**
     * Gets an array of CostLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     * @throws PropelException
     */
    public function getCostLinesRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCostLinesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collCostLinesRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCostLinesRelatedByIdCreation) {
                // return empty collection
                $this->initCostLinesRelatedByIdCreation();
            } else {
                $collCostLinesRelatedByIdCreation = CostLineQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCostLinesRelatedByIdCreationPartial && count($collCostLinesRelatedByIdCreation)) {
                      $this->initCostLinesRelatedByIdCreation(false);

                      foreach ($collCostLinesRelatedByIdCreation as $obj) {
                        if (false == $this->collCostLinesRelatedByIdCreation->contains($obj)) {
                          $this->collCostLinesRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collCostLinesRelatedByIdCreationPartial = true;
                    }

                    $collCostLinesRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collCostLinesRelatedByIdCreation;
                }

                if ($partial && $this->collCostLinesRelatedByIdCreation) {
                    foreach ($this->collCostLinesRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collCostLinesRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collCostLinesRelatedByIdCreation = $collCostLinesRelatedByIdCreation;
                $this->collCostLinesRelatedByIdCreationPartial = false;
            }
        }

        return $this->collCostLinesRelatedByIdCreation;
    }

    /**
     * Sets a collection of CostLineRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $costLinesRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setCostLinesRelatedByIdCreation(PropelCollection $costLinesRelatedByIdCreation, PropelPDO $con = null)
    {
        $costLinesRelatedByIdCreationToDelete = $this->getCostLinesRelatedByIdCreation(new Criteria(), $con)->diff($costLinesRelatedByIdCreation);


        $this->costLinesRelatedByIdCreationScheduledForDeletion = $costLinesRelatedByIdCreationToDelete;

        foreach ($costLinesRelatedByIdCreationToDelete as $costLineRelatedByIdCreationRemoved) {
            $costLineRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collCostLinesRelatedByIdCreation = null;
        foreach ($costLinesRelatedByIdCreation as $costLineRelatedByIdCreation) {
            $this->addCostLineRelatedByIdCreation($costLineRelatedByIdCreation);
        }

        $this->collCostLinesRelatedByIdCreation = $costLinesRelatedByIdCreation;
        $this->collCostLinesRelatedByIdCreationPartial = false;

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
    public function countCostLinesRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCostLinesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collCostLinesRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCostLinesRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCostLinesRelatedByIdCreation());
            }
            $query = CostLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collCostLinesRelatedByIdCreation);
    }

    /**
     * Method called to associate a CostLine object to this object
     * through the CostLine foreign key attribute.
     *
     * @param    CostLine $l CostLine
     * @return Authy The current object (for fluent API support)
     */
    public function addCostLineRelatedByIdCreation(CostLine $l)
    {
        if ($this->collCostLinesRelatedByIdCreation === null) {
            $this->initCostLinesRelatedByIdCreation();
            $this->collCostLinesRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collCostLinesRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCostLineRelatedByIdCreation($l);

            if ($this->costLinesRelatedByIdCreationScheduledForDeletion and $this->costLinesRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->costLinesRelatedByIdCreationScheduledForDeletion->remove($this->costLinesRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	CostLineRelatedByIdCreation $costLineRelatedByIdCreation The costLineRelatedByIdCreation object to add.
     */
    protected function doAddCostLineRelatedByIdCreation($costLineRelatedByIdCreation)
    {
        $this->collCostLinesRelatedByIdCreation[]= $costLineRelatedByIdCreation;
        $costLineRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	CostLineRelatedByIdCreation $costLineRelatedByIdCreation The costLineRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeCostLineRelatedByIdCreation($costLineRelatedByIdCreation)
    {
        if ($this->getCostLinesRelatedByIdCreation()->contains($costLineRelatedByIdCreation)) {
            $this->collCostLinesRelatedByIdCreation->remove($this->collCostLinesRelatedByIdCreation->search($costLineRelatedByIdCreation));
            if (null === $this->costLinesRelatedByIdCreationScheduledForDeletion) {
                $this->costLinesRelatedByIdCreationScheduledForDeletion = clone $this->collCostLinesRelatedByIdCreation;
                $this->costLinesRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->costLinesRelatedByIdCreationScheduledForDeletion[]= $costLineRelatedByIdCreation;
            $costLineRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getCostLinesRelatedByIdCreationJoinBilling($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('Billing', $join_behavior);

        return $this->getCostLinesRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesRelatedByIdCreationJoinSupplier($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('Supplier', $join_behavior);

        return $this->getCostLinesRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesRelatedByIdCreationJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getCostLinesRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesRelatedByIdCreationJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

        return $this->getCostLinesRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getCostLinesRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collCostLinesRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addCostLinesRelatedByIdModification()
     */
    public function clearCostLinesRelatedByIdModification()
    {
        $this->collCostLinesRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collCostLinesRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collCostLinesRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialCostLinesRelatedByIdModification($v = true)
    {
        $this->collCostLinesRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collCostLinesRelatedByIdModification collection.
     *
     * By default this just sets the collCostLinesRelatedByIdModification collection to an empty array (like clearcollCostLinesRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCostLinesRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collCostLinesRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collCostLinesRelatedByIdModification = new PropelObjectCollection();
        $this->collCostLinesRelatedByIdModification->setModel('CostLine');
    }

    /**
     * Gets an array of CostLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     * @throws PropelException
     */
    public function getCostLinesRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCostLinesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collCostLinesRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCostLinesRelatedByIdModification) {
                // return empty collection
                $this->initCostLinesRelatedByIdModification();
            } else {
                $collCostLinesRelatedByIdModification = CostLineQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCostLinesRelatedByIdModificationPartial && count($collCostLinesRelatedByIdModification)) {
                      $this->initCostLinesRelatedByIdModification(false);

                      foreach ($collCostLinesRelatedByIdModification as $obj) {
                        if (false == $this->collCostLinesRelatedByIdModification->contains($obj)) {
                          $this->collCostLinesRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collCostLinesRelatedByIdModificationPartial = true;
                    }

                    $collCostLinesRelatedByIdModification->getInternalIterator()->rewind();

                    return $collCostLinesRelatedByIdModification;
                }

                if ($partial && $this->collCostLinesRelatedByIdModification) {
                    foreach ($this->collCostLinesRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collCostLinesRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collCostLinesRelatedByIdModification = $collCostLinesRelatedByIdModification;
                $this->collCostLinesRelatedByIdModificationPartial = false;
            }
        }

        return $this->collCostLinesRelatedByIdModification;
    }

    /**
     * Sets a collection of CostLineRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $costLinesRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setCostLinesRelatedByIdModification(PropelCollection $costLinesRelatedByIdModification, PropelPDO $con = null)
    {
        $costLinesRelatedByIdModificationToDelete = $this->getCostLinesRelatedByIdModification(new Criteria(), $con)->diff($costLinesRelatedByIdModification);


        $this->costLinesRelatedByIdModificationScheduledForDeletion = $costLinesRelatedByIdModificationToDelete;

        foreach ($costLinesRelatedByIdModificationToDelete as $costLineRelatedByIdModificationRemoved) {
            $costLineRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collCostLinesRelatedByIdModification = null;
        foreach ($costLinesRelatedByIdModification as $costLineRelatedByIdModification) {
            $this->addCostLineRelatedByIdModification($costLineRelatedByIdModification);
        }

        $this->collCostLinesRelatedByIdModification = $costLinesRelatedByIdModification;
        $this->collCostLinesRelatedByIdModificationPartial = false;

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
    public function countCostLinesRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCostLinesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collCostLinesRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCostLinesRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCostLinesRelatedByIdModification());
            }
            $query = CostLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collCostLinesRelatedByIdModification);
    }

    /**
     * Method called to associate a CostLine object to this object
     * through the CostLine foreign key attribute.
     *
     * @param    CostLine $l CostLine
     * @return Authy The current object (for fluent API support)
     */
    public function addCostLineRelatedByIdModification(CostLine $l)
    {
        if ($this->collCostLinesRelatedByIdModification === null) {
            $this->initCostLinesRelatedByIdModification();
            $this->collCostLinesRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collCostLinesRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCostLineRelatedByIdModification($l);

            if ($this->costLinesRelatedByIdModificationScheduledForDeletion and $this->costLinesRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->costLinesRelatedByIdModificationScheduledForDeletion->remove($this->costLinesRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	CostLineRelatedByIdModification $costLineRelatedByIdModification The costLineRelatedByIdModification object to add.
     */
    protected function doAddCostLineRelatedByIdModification($costLineRelatedByIdModification)
    {
        $this->collCostLinesRelatedByIdModification[]= $costLineRelatedByIdModification;
        $costLineRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	CostLineRelatedByIdModification $costLineRelatedByIdModification The costLineRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeCostLineRelatedByIdModification($costLineRelatedByIdModification)
    {
        if ($this->getCostLinesRelatedByIdModification()->contains($costLineRelatedByIdModification)) {
            $this->collCostLinesRelatedByIdModification->remove($this->collCostLinesRelatedByIdModification->search($costLineRelatedByIdModification));
            if (null === $this->costLinesRelatedByIdModificationScheduledForDeletion) {
                $this->costLinesRelatedByIdModificationScheduledForDeletion = clone $this->collCostLinesRelatedByIdModification;
                $this->costLinesRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->costLinesRelatedByIdModificationScheduledForDeletion[]= $costLineRelatedByIdModification;
            $costLineRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getCostLinesRelatedByIdModificationJoinBilling($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('Billing', $join_behavior);

        return $this->getCostLinesRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesRelatedByIdModificationJoinSupplier($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('Supplier', $join_behavior);

        return $this->getCostLinesRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesRelatedByIdModificationJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getCostLinesRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesRelatedByIdModificationJoinBillingCategory($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('BillingCategory', $join_behavior);

        return $this->getCostLinesRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|CostLine[] List of CostLine objects
     */
    public function getCostLinesRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CostLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getCostLinesRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collProjectsRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addProjectsRelatedByIdCreation()
     */
    public function clearProjectsRelatedByIdCreation()
    {
        $this->collProjectsRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collProjectsRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collProjectsRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialProjectsRelatedByIdCreation($v = true)
    {
        $this->collProjectsRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collProjectsRelatedByIdCreation collection.
     *
     * By default this just sets the collProjectsRelatedByIdCreation collection to an empty array (like clearcollProjectsRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectsRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collProjectsRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collProjectsRelatedByIdCreation = new PropelObjectCollection();
        $this->collProjectsRelatedByIdCreation->setModel('Project');
    }

    /**
     * Gets an array of Project objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Project[] List of Project objects
     * @throws PropelException
     */
    public function getProjectsRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProjectsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collProjectsRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectsRelatedByIdCreation) {
                // return empty collection
                $this->initProjectsRelatedByIdCreation();
            } else {
                $collProjectsRelatedByIdCreation = ProjectQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProjectsRelatedByIdCreationPartial && count($collProjectsRelatedByIdCreation)) {
                      $this->initProjectsRelatedByIdCreation(false);

                      foreach ($collProjectsRelatedByIdCreation as $obj) {
                        if (false == $this->collProjectsRelatedByIdCreation->contains($obj)) {
                          $this->collProjectsRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collProjectsRelatedByIdCreationPartial = true;
                    }

                    $collProjectsRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collProjectsRelatedByIdCreation;
                }

                if ($partial && $this->collProjectsRelatedByIdCreation) {
                    foreach ($this->collProjectsRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collProjectsRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collProjectsRelatedByIdCreation = $collProjectsRelatedByIdCreation;
                $this->collProjectsRelatedByIdCreationPartial = false;
            }
        }

        return $this->collProjectsRelatedByIdCreation;
    }

    /**
     * Sets a collection of ProjectRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $projectsRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setProjectsRelatedByIdCreation(PropelCollection $projectsRelatedByIdCreation, PropelPDO $con = null)
    {
        $projectsRelatedByIdCreationToDelete = $this->getProjectsRelatedByIdCreation(new Criteria(), $con)->diff($projectsRelatedByIdCreation);


        $this->projectsRelatedByIdCreationScheduledForDeletion = $projectsRelatedByIdCreationToDelete;

        foreach ($projectsRelatedByIdCreationToDelete as $projectRelatedByIdCreationRemoved) {
            $projectRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collProjectsRelatedByIdCreation = null;
        foreach ($projectsRelatedByIdCreation as $projectRelatedByIdCreation) {
            $this->addProjectRelatedByIdCreation($projectRelatedByIdCreation);
        }

        $this->collProjectsRelatedByIdCreation = $projectsRelatedByIdCreation;
        $this->collProjectsRelatedByIdCreationPartial = false;

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
    public function countProjectsRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProjectsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collProjectsRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectsRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProjectsRelatedByIdCreation());
            }
            $query = ProjectQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collProjectsRelatedByIdCreation);
    }

    /**
     * Method called to associate a Project object to this object
     * through the Project foreign key attribute.
     *
     * @param    Project $l Project
     * @return Authy The current object (for fluent API support)
     */
    public function addProjectRelatedByIdCreation(Project $l)
    {
        if ($this->collProjectsRelatedByIdCreation === null) {
            $this->initProjectsRelatedByIdCreation();
            $this->collProjectsRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collProjectsRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProjectRelatedByIdCreation($l);

            if ($this->projectsRelatedByIdCreationScheduledForDeletion and $this->projectsRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->projectsRelatedByIdCreationScheduledForDeletion->remove($this->projectsRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ProjectRelatedByIdCreation $projectRelatedByIdCreation The projectRelatedByIdCreation object to add.
     */
    protected function doAddProjectRelatedByIdCreation($projectRelatedByIdCreation)
    {
        $this->collProjectsRelatedByIdCreation[]= $projectRelatedByIdCreation;
        $projectRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	ProjectRelatedByIdCreation $projectRelatedByIdCreation The projectRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeProjectRelatedByIdCreation($projectRelatedByIdCreation)
    {
        if ($this->getProjectsRelatedByIdCreation()->contains($projectRelatedByIdCreation)) {
            $this->collProjectsRelatedByIdCreation->remove($this->collProjectsRelatedByIdCreation->search($projectRelatedByIdCreation));
            if (null === $this->projectsRelatedByIdCreationScheduledForDeletion) {
                $this->projectsRelatedByIdCreationScheduledForDeletion = clone $this->collProjectsRelatedByIdCreation;
                $this->projectsRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->projectsRelatedByIdCreationScheduledForDeletion[]= $projectRelatedByIdCreation;
            $projectRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getProjectsRelatedByIdCreationJoinClient($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectQuery::create(null, $criteria);
        $query->joinWith('Client', $join_behavior);

        return $this->getProjectsRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Project[] List of Project objects
     */
    public function getProjectsRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getProjectsRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collProjectsRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addProjectsRelatedByIdModification()
     */
    public function clearProjectsRelatedByIdModification()
    {
        $this->collProjectsRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collProjectsRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collProjectsRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialProjectsRelatedByIdModification($v = true)
    {
        $this->collProjectsRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collProjectsRelatedByIdModification collection.
     *
     * By default this just sets the collProjectsRelatedByIdModification collection to an empty array (like clearcollProjectsRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectsRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collProjectsRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collProjectsRelatedByIdModification = new PropelObjectCollection();
        $this->collProjectsRelatedByIdModification->setModel('Project');
    }

    /**
     * Gets an array of Project objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Project[] List of Project objects
     * @throws PropelException
     */
    public function getProjectsRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProjectsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collProjectsRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectsRelatedByIdModification) {
                // return empty collection
                $this->initProjectsRelatedByIdModification();
            } else {
                $collProjectsRelatedByIdModification = ProjectQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProjectsRelatedByIdModificationPartial && count($collProjectsRelatedByIdModification)) {
                      $this->initProjectsRelatedByIdModification(false);

                      foreach ($collProjectsRelatedByIdModification as $obj) {
                        if (false == $this->collProjectsRelatedByIdModification->contains($obj)) {
                          $this->collProjectsRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collProjectsRelatedByIdModificationPartial = true;
                    }

                    $collProjectsRelatedByIdModification->getInternalIterator()->rewind();

                    return $collProjectsRelatedByIdModification;
                }

                if ($partial && $this->collProjectsRelatedByIdModification) {
                    foreach ($this->collProjectsRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collProjectsRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collProjectsRelatedByIdModification = $collProjectsRelatedByIdModification;
                $this->collProjectsRelatedByIdModificationPartial = false;
            }
        }

        return $this->collProjectsRelatedByIdModification;
    }

    /**
     * Sets a collection of ProjectRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $projectsRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setProjectsRelatedByIdModification(PropelCollection $projectsRelatedByIdModification, PropelPDO $con = null)
    {
        $projectsRelatedByIdModificationToDelete = $this->getProjectsRelatedByIdModification(new Criteria(), $con)->diff($projectsRelatedByIdModification);


        $this->projectsRelatedByIdModificationScheduledForDeletion = $projectsRelatedByIdModificationToDelete;

        foreach ($projectsRelatedByIdModificationToDelete as $projectRelatedByIdModificationRemoved) {
            $projectRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collProjectsRelatedByIdModification = null;
        foreach ($projectsRelatedByIdModification as $projectRelatedByIdModification) {
            $this->addProjectRelatedByIdModification($projectRelatedByIdModification);
        }

        $this->collProjectsRelatedByIdModification = $projectsRelatedByIdModification;
        $this->collProjectsRelatedByIdModificationPartial = false;

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
    public function countProjectsRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProjectsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collProjectsRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectsRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getProjectsRelatedByIdModification());
            }
            $query = ProjectQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collProjectsRelatedByIdModification);
    }

    /**
     * Method called to associate a Project object to this object
     * through the Project foreign key attribute.
     *
     * @param    Project $l Project
     * @return Authy The current object (for fluent API support)
     */
    public function addProjectRelatedByIdModification(Project $l)
    {
        if ($this->collProjectsRelatedByIdModification === null) {
            $this->initProjectsRelatedByIdModification();
            $this->collProjectsRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collProjectsRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProjectRelatedByIdModification($l);

            if ($this->projectsRelatedByIdModificationScheduledForDeletion and $this->projectsRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->projectsRelatedByIdModificationScheduledForDeletion->remove($this->projectsRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ProjectRelatedByIdModification $projectRelatedByIdModification The projectRelatedByIdModification object to add.
     */
    protected function doAddProjectRelatedByIdModification($projectRelatedByIdModification)
    {
        $this->collProjectsRelatedByIdModification[]= $projectRelatedByIdModification;
        $projectRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	ProjectRelatedByIdModification $projectRelatedByIdModification The projectRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeProjectRelatedByIdModification($projectRelatedByIdModification)
    {
        if ($this->getProjectsRelatedByIdModification()->contains($projectRelatedByIdModification)) {
            $this->collProjectsRelatedByIdModification->remove($this->collProjectsRelatedByIdModification->search($projectRelatedByIdModification));
            if (null === $this->projectsRelatedByIdModificationScheduledForDeletion) {
                $this->projectsRelatedByIdModificationScheduledForDeletion = clone $this->collProjectsRelatedByIdModification;
                $this->projectsRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->projectsRelatedByIdModificationScheduledForDeletion[]= $projectRelatedByIdModification;
            $projectRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getProjectsRelatedByIdModificationJoinClient($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectQuery::create(null, $criteria);
        $query->joinWith('Client', $join_behavior);

        return $this->getProjectsRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Project[] List of Project objects
     */
    public function getProjectsRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getProjectsRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collTimeLinesRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addTimeLinesRelatedByIdCreation()
     */
    public function clearTimeLinesRelatedByIdCreation()
    {
        $this->collTimeLinesRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collTimeLinesRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collTimeLinesRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialTimeLinesRelatedByIdCreation($v = true)
    {
        $this->collTimeLinesRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collTimeLinesRelatedByIdCreation collection.
     *
     * By default this just sets the collTimeLinesRelatedByIdCreation collection to an empty array (like clearcollTimeLinesRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTimeLinesRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collTimeLinesRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collTimeLinesRelatedByIdCreation = new PropelObjectCollection();
        $this->collTimeLinesRelatedByIdCreation->setModel('TimeLine');
    }

    /**
     * Gets an array of TimeLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TimeLine[] List of TimeLine objects
     * @throws PropelException
     */
    public function getTimeLinesRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTimeLinesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collTimeLinesRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTimeLinesRelatedByIdCreation) {
                // return empty collection
                $this->initTimeLinesRelatedByIdCreation();
            } else {
                $collTimeLinesRelatedByIdCreation = TimeLineQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTimeLinesRelatedByIdCreationPartial && count($collTimeLinesRelatedByIdCreation)) {
                      $this->initTimeLinesRelatedByIdCreation(false);

                      foreach ($collTimeLinesRelatedByIdCreation as $obj) {
                        if (false == $this->collTimeLinesRelatedByIdCreation->contains($obj)) {
                          $this->collTimeLinesRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collTimeLinesRelatedByIdCreationPartial = true;
                    }

                    $collTimeLinesRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collTimeLinesRelatedByIdCreation;
                }

                if ($partial && $this->collTimeLinesRelatedByIdCreation) {
                    foreach ($this->collTimeLinesRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collTimeLinesRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collTimeLinesRelatedByIdCreation = $collTimeLinesRelatedByIdCreation;
                $this->collTimeLinesRelatedByIdCreationPartial = false;
            }
        }

        return $this->collTimeLinesRelatedByIdCreation;
    }

    /**
     * Sets a collection of TimeLineRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $timeLinesRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setTimeLinesRelatedByIdCreation(PropelCollection $timeLinesRelatedByIdCreation, PropelPDO $con = null)
    {
        $timeLinesRelatedByIdCreationToDelete = $this->getTimeLinesRelatedByIdCreation(new Criteria(), $con)->diff($timeLinesRelatedByIdCreation);


        $this->timeLinesRelatedByIdCreationScheduledForDeletion = $timeLinesRelatedByIdCreationToDelete;

        foreach ($timeLinesRelatedByIdCreationToDelete as $timeLineRelatedByIdCreationRemoved) {
            $timeLineRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collTimeLinesRelatedByIdCreation = null;
        foreach ($timeLinesRelatedByIdCreation as $timeLineRelatedByIdCreation) {
            $this->addTimeLineRelatedByIdCreation($timeLineRelatedByIdCreation);
        }

        $this->collTimeLinesRelatedByIdCreation = $timeLinesRelatedByIdCreation;
        $this->collTimeLinesRelatedByIdCreationPartial = false;

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
    public function countTimeLinesRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTimeLinesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collTimeLinesRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTimeLinesRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTimeLinesRelatedByIdCreation());
            }
            $query = TimeLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collTimeLinesRelatedByIdCreation);
    }

    /**
     * Method called to associate a TimeLine object to this object
     * through the TimeLine foreign key attribute.
     *
     * @param    TimeLine $l TimeLine
     * @return Authy The current object (for fluent API support)
     */
    public function addTimeLineRelatedByIdCreation(TimeLine $l)
    {
        if ($this->collTimeLinesRelatedByIdCreation === null) {
            $this->initTimeLinesRelatedByIdCreation();
            $this->collTimeLinesRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collTimeLinesRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTimeLineRelatedByIdCreation($l);

            if ($this->timeLinesRelatedByIdCreationScheduledForDeletion and $this->timeLinesRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->timeLinesRelatedByIdCreationScheduledForDeletion->remove($this->timeLinesRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TimeLineRelatedByIdCreation $timeLineRelatedByIdCreation The timeLineRelatedByIdCreation object to add.
     */
    protected function doAddTimeLineRelatedByIdCreation($timeLineRelatedByIdCreation)
    {
        $this->collTimeLinesRelatedByIdCreation[]= $timeLineRelatedByIdCreation;
        $timeLineRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	TimeLineRelatedByIdCreation $timeLineRelatedByIdCreation The timeLineRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeTimeLineRelatedByIdCreation($timeLineRelatedByIdCreation)
    {
        if ($this->getTimeLinesRelatedByIdCreation()->contains($timeLineRelatedByIdCreation)) {
            $this->collTimeLinesRelatedByIdCreation->remove($this->collTimeLinesRelatedByIdCreation->search($timeLineRelatedByIdCreation));
            if (null === $this->timeLinesRelatedByIdCreationScheduledForDeletion) {
                $this->timeLinesRelatedByIdCreationScheduledForDeletion = clone $this->collTimeLinesRelatedByIdCreation;
                $this->timeLinesRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->timeLinesRelatedByIdCreationScheduledForDeletion[]= $timeLineRelatedByIdCreation;
            $timeLineRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getTimeLinesRelatedByIdCreationJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TimeLineQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getTimeLinesRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TimeLine[] List of TimeLine objects
     */
    public function getTimeLinesRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TimeLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getTimeLinesRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collTimeLinesRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addTimeLinesRelatedByIdModification()
     */
    public function clearTimeLinesRelatedByIdModification()
    {
        $this->collTimeLinesRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collTimeLinesRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collTimeLinesRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialTimeLinesRelatedByIdModification($v = true)
    {
        $this->collTimeLinesRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collTimeLinesRelatedByIdModification collection.
     *
     * By default this just sets the collTimeLinesRelatedByIdModification collection to an empty array (like clearcollTimeLinesRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTimeLinesRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collTimeLinesRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collTimeLinesRelatedByIdModification = new PropelObjectCollection();
        $this->collTimeLinesRelatedByIdModification->setModel('TimeLine');
    }

    /**
     * Gets an array of TimeLine objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TimeLine[] List of TimeLine objects
     * @throws PropelException
     */
    public function getTimeLinesRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTimeLinesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collTimeLinesRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTimeLinesRelatedByIdModification) {
                // return empty collection
                $this->initTimeLinesRelatedByIdModification();
            } else {
                $collTimeLinesRelatedByIdModification = TimeLineQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTimeLinesRelatedByIdModificationPartial && count($collTimeLinesRelatedByIdModification)) {
                      $this->initTimeLinesRelatedByIdModification(false);

                      foreach ($collTimeLinesRelatedByIdModification as $obj) {
                        if (false == $this->collTimeLinesRelatedByIdModification->contains($obj)) {
                          $this->collTimeLinesRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collTimeLinesRelatedByIdModificationPartial = true;
                    }

                    $collTimeLinesRelatedByIdModification->getInternalIterator()->rewind();

                    return $collTimeLinesRelatedByIdModification;
                }

                if ($partial && $this->collTimeLinesRelatedByIdModification) {
                    foreach ($this->collTimeLinesRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collTimeLinesRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collTimeLinesRelatedByIdModification = $collTimeLinesRelatedByIdModification;
                $this->collTimeLinesRelatedByIdModificationPartial = false;
            }
        }

        return $this->collTimeLinesRelatedByIdModification;
    }

    /**
     * Sets a collection of TimeLineRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $timeLinesRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setTimeLinesRelatedByIdModification(PropelCollection $timeLinesRelatedByIdModification, PropelPDO $con = null)
    {
        $timeLinesRelatedByIdModificationToDelete = $this->getTimeLinesRelatedByIdModification(new Criteria(), $con)->diff($timeLinesRelatedByIdModification);


        $this->timeLinesRelatedByIdModificationScheduledForDeletion = $timeLinesRelatedByIdModificationToDelete;

        foreach ($timeLinesRelatedByIdModificationToDelete as $timeLineRelatedByIdModificationRemoved) {
            $timeLineRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collTimeLinesRelatedByIdModification = null;
        foreach ($timeLinesRelatedByIdModification as $timeLineRelatedByIdModification) {
            $this->addTimeLineRelatedByIdModification($timeLineRelatedByIdModification);
        }

        $this->collTimeLinesRelatedByIdModification = $timeLinesRelatedByIdModification;
        $this->collTimeLinesRelatedByIdModificationPartial = false;

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
    public function countTimeLinesRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTimeLinesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collTimeLinesRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTimeLinesRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTimeLinesRelatedByIdModification());
            }
            $query = TimeLineQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collTimeLinesRelatedByIdModification);
    }

    /**
     * Method called to associate a TimeLine object to this object
     * through the TimeLine foreign key attribute.
     *
     * @param    TimeLine $l TimeLine
     * @return Authy The current object (for fluent API support)
     */
    public function addTimeLineRelatedByIdModification(TimeLine $l)
    {
        if ($this->collTimeLinesRelatedByIdModification === null) {
            $this->initTimeLinesRelatedByIdModification();
            $this->collTimeLinesRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collTimeLinesRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTimeLineRelatedByIdModification($l);

            if ($this->timeLinesRelatedByIdModificationScheduledForDeletion and $this->timeLinesRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->timeLinesRelatedByIdModificationScheduledForDeletion->remove($this->timeLinesRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TimeLineRelatedByIdModification $timeLineRelatedByIdModification The timeLineRelatedByIdModification object to add.
     */
    protected function doAddTimeLineRelatedByIdModification($timeLineRelatedByIdModification)
    {
        $this->collTimeLinesRelatedByIdModification[]= $timeLineRelatedByIdModification;
        $timeLineRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	TimeLineRelatedByIdModification $timeLineRelatedByIdModification The timeLineRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeTimeLineRelatedByIdModification($timeLineRelatedByIdModification)
    {
        if ($this->getTimeLinesRelatedByIdModification()->contains($timeLineRelatedByIdModification)) {
            $this->collTimeLinesRelatedByIdModification->remove($this->collTimeLinesRelatedByIdModification->search($timeLineRelatedByIdModification));
            if (null === $this->timeLinesRelatedByIdModificationScheduledForDeletion) {
                $this->timeLinesRelatedByIdModificationScheduledForDeletion = clone $this->collTimeLinesRelatedByIdModification;
                $this->timeLinesRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->timeLinesRelatedByIdModificationScheduledForDeletion[]= $timeLineRelatedByIdModification;
            $timeLineRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getTimeLinesRelatedByIdModificationJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TimeLineQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getTimeLinesRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TimeLine[] List of TimeLine objects
     */
    public function getTimeLinesRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TimeLineQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getTimeLinesRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collBillingCategoriesRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addBillingCategoriesRelatedByIdCreation()
     */
    public function clearBillingCategoriesRelatedByIdCreation()
    {
        $this->collBillingCategoriesRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collBillingCategoriesRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collBillingCategoriesRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialBillingCategoriesRelatedByIdCreation($v = true)
    {
        $this->collBillingCategoriesRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collBillingCategoriesRelatedByIdCreation collection.
     *
     * By default this just sets the collBillingCategoriesRelatedByIdCreation collection to an empty array (like clearcollBillingCategoriesRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBillingCategoriesRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collBillingCategoriesRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collBillingCategoriesRelatedByIdCreation = new PropelObjectCollection();
        $this->collBillingCategoriesRelatedByIdCreation->setModel('BillingCategory');
    }

    /**
     * Gets an array of BillingCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BillingCategory[] List of BillingCategory objects
     * @throws PropelException
     */
    public function getBillingCategoriesRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBillingCategoriesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collBillingCategoriesRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBillingCategoriesRelatedByIdCreation) {
                // return empty collection
                $this->initBillingCategoriesRelatedByIdCreation();
            } else {
                $collBillingCategoriesRelatedByIdCreation = BillingCategoryQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBillingCategoriesRelatedByIdCreationPartial && count($collBillingCategoriesRelatedByIdCreation)) {
                      $this->initBillingCategoriesRelatedByIdCreation(false);

                      foreach ($collBillingCategoriesRelatedByIdCreation as $obj) {
                        if (false == $this->collBillingCategoriesRelatedByIdCreation->contains($obj)) {
                          $this->collBillingCategoriesRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collBillingCategoriesRelatedByIdCreationPartial = true;
                    }

                    $collBillingCategoriesRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collBillingCategoriesRelatedByIdCreation;
                }

                if ($partial && $this->collBillingCategoriesRelatedByIdCreation) {
                    foreach ($this->collBillingCategoriesRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collBillingCategoriesRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collBillingCategoriesRelatedByIdCreation = $collBillingCategoriesRelatedByIdCreation;
                $this->collBillingCategoriesRelatedByIdCreationPartial = false;
            }
        }

        return $this->collBillingCategoriesRelatedByIdCreation;
    }

    /**
     * Sets a collection of BillingCategoryRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $billingCategoriesRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setBillingCategoriesRelatedByIdCreation(PropelCollection $billingCategoriesRelatedByIdCreation, PropelPDO $con = null)
    {
        $billingCategoriesRelatedByIdCreationToDelete = $this->getBillingCategoriesRelatedByIdCreation(new Criteria(), $con)->diff($billingCategoriesRelatedByIdCreation);


        $this->billingCategoriesRelatedByIdCreationScheduledForDeletion = $billingCategoriesRelatedByIdCreationToDelete;

        foreach ($billingCategoriesRelatedByIdCreationToDelete as $billingCategoryRelatedByIdCreationRemoved) {
            $billingCategoryRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collBillingCategoriesRelatedByIdCreation = null;
        foreach ($billingCategoriesRelatedByIdCreation as $billingCategoryRelatedByIdCreation) {
            $this->addBillingCategoryRelatedByIdCreation($billingCategoryRelatedByIdCreation);
        }

        $this->collBillingCategoriesRelatedByIdCreation = $billingCategoriesRelatedByIdCreation;
        $this->collBillingCategoriesRelatedByIdCreationPartial = false;

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
    public function countBillingCategoriesRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBillingCategoriesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collBillingCategoriesRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBillingCategoriesRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBillingCategoriesRelatedByIdCreation());
            }
            $query = BillingCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collBillingCategoriesRelatedByIdCreation);
    }

    /**
     * Method called to associate a BillingCategory object to this object
     * through the BillingCategory foreign key attribute.
     *
     * @param    BillingCategory $l BillingCategory
     * @return Authy The current object (for fluent API support)
     */
    public function addBillingCategoryRelatedByIdCreation(BillingCategory $l)
    {
        if ($this->collBillingCategoriesRelatedByIdCreation === null) {
            $this->initBillingCategoriesRelatedByIdCreation();
            $this->collBillingCategoriesRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collBillingCategoriesRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBillingCategoryRelatedByIdCreation($l);

            if ($this->billingCategoriesRelatedByIdCreationScheduledForDeletion and $this->billingCategoriesRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->billingCategoriesRelatedByIdCreationScheduledForDeletion->remove($this->billingCategoriesRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	BillingCategoryRelatedByIdCreation $billingCategoryRelatedByIdCreation The billingCategoryRelatedByIdCreation object to add.
     */
    protected function doAddBillingCategoryRelatedByIdCreation($billingCategoryRelatedByIdCreation)
    {
        $this->collBillingCategoriesRelatedByIdCreation[]= $billingCategoryRelatedByIdCreation;
        $billingCategoryRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	BillingCategoryRelatedByIdCreation $billingCategoryRelatedByIdCreation The billingCategoryRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeBillingCategoryRelatedByIdCreation($billingCategoryRelatedByIdCreation)
    {
        if ($this->getBillingCategoriesRelatedByIdCreation()->contains($billingCategoryRelatedByIdCreation)) {
            $this->collBillingCategoriesRelatedByIdCreation->remove($this->collBillingCategoriesRelatedByIdCreation->search($billingCategoryRelatedByIdCreation));
            if (null === $this->billingCategoriesRelatedByIdCreationScheduledForDeletion) {
                $this->billingCategoriesRelatedByIdCreationScheduledForDeletion = clone $this->collBillingCategoriesRelatedByIdCreation;
                $this->billingCategoriesRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->billingCategoriesRelatedByIdCreationScheduledForDeletion[]= $billingCategoryRelatedByIdCreation;
            $billingCategoryRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getBillingCategoriesRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingCategoryQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getBillingCategoriesRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collBillingCategoriesRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addBillingCategoriesRelatedByIdModification()
     */
    public function clearBillingCategoriesRelatedByIdModification()
    {
        $this->collBillingCategoriesRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collBillingCategoriesRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collBillingCategoriesRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialBillingCategoriesRelatedByIdModification($v = true)
    {
        $this->collBillingCategoriesRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collBillingCategoriesRelatedByIdModification collection.
     *
     * By default this just sets the collBillingCategoriesRelatedByIdModification collection to an empty array (like clearcollBillingCategoriesRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBillingCategoriesRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collBillingCategoriesRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collBillingCategoriesRelatedByIdModification = new PropelObjectCollection();
        $this->collBillingCategoriesRelatedByIdModification->setModel('BillingCategory');
    }

    /**
     * Gets an array of BillingCategory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BillingCategory[] List of BillingCategory objects
     * @throws PropelException
     */
    public function getBillingCategoriesRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBillingCategoriesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collBillingCategoriesRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBillingCategoriesRelatedByIdModification) {
                // return empty collection
                $this->initBillingCategoriesRelatedByIdModification();
            } else {
                $collBillingCategoriesRelatedByIdModification = BillingCategoryQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBillingCategoriesRelatedByIdModificationPartial && count($collBillingCategoriesRelatedByIdModification)) {
                      $this->initBillingCategoriesRelatedByIdModification(false);

                      foreach ($collBillingCategoriesRelatedByIdModification as $obj) {
                        if (false == $this->collBillingCategoriesRelatedByIdModification->contains($obj)) {
                          $this->collBillingCategoriesRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collBillingCategoriesRelatedByIdModificationPartial = true;
                    }

                    $collBillingCategoriesRelatedByIdModification->getInternalIterator()->rewind();

                    return $collBillingCategoriesRelatedByIdModification;
                }

                if ($partial && $this->collBillingCategoriesRelatedByIdModification) {
                    foreach ($this->collBillingCategoriesRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collBillingCategoriesRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collBillingCategoriesRelatedByIdModification = $collBillingCategoriesRelatedByIdModification;
                $this->collBillingCategoriesRelatedByIdModificationPartial = false;
            }
        }

        return $this->collBillingCategoriesRelatedByIdModification;
    }

    /**
     * Sets a collection of BillingCategoryRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $billingCategoriesRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setBillingCategoriesRelatedByIdModification(PropelCollection $billingCategoriesRelatedByIdModification, PropelPDO $con = null)
    {
        $billingCategoriesRelatedByIdModificationToDelete = $this->getBillingCategoriesRelatedByIdModification(new Criteria(), $con)->diff($billingCategoriesRelatedByIdModification);


        $this->billingCategoriesRelatedByIdModificationScheduledForDeletion = $billingCategoriesRelatedByIdModificationToDelete;

        foreach ($billingCategoriesRelatedByIdModificationToDelete as $billingCategoryRelatedByIdModificationRemoved) {
            $billingCategoryRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collBillingCategoriesRelatedByIdModification = null;
        foreach ($billingCategoriesRelatedByIdModification as $billingCategoryRelatedByIdModification) {
            $this->addBillingCategoryRelatedByIdModification($billingCategoryRelatedByIdModification);
        }

        $this->collBillingCategoriesRelatedByIdModification = $billingCategoriesRelatedByIdModification;
        $this->collBillingCategoriesRelatedByIdModificationPartial = false;

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
    public function countBillingCategoriesRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBillingCategoriesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collBillingCategoriesRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBillingCategoriesRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBillingCategoriesRelatedByIdModification());
            }
            $query = BillingCategoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collBillingCategoriesRelatedByIdModification);
    }

    /**
     * Method called to associate a BillingCategory object to this object
     * through the BillingCategory foreign key attribute.
     *
     * @param    BillingCategory $l BillingCategory
     * @return Authy The current object (for fluent API support)
     */
    public function addBillingCategoryRelatedByIdModification(BillingCategory $l)
    {
        if ($this->collBillingCategoriesRelatedByIdModification === null) {
            $this->initBillingCategoriesRelatedByIdModification();
            $this->collBillingCategoriesRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collBillingCategoriesRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBillingCategoryRelatedByIdModification($l);

            if ($this->billingCategoriesRelatedByIdModificationScheduledForDeletion and $this->billingCategoriesRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->billingCategoriesRelatedByIdModificationScheduledForDeletion->remove($this->billingCategoriesRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	BillingCategoryRelatedByIdModification $billingCategoryRelatedByIdModification The billingCategoryRelatedByIdModification object to add.
     */
    protected function doAddBillingCategoryRelatedByIdModification($billingCategoryRelatedByIdModification)
    {
        $this->collBillingCategoriesRelatedByIdModification[]= $billingCategoryRelatedByIdModification;
        $billingCategoryRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	BillingCategoryRelatedByIdModification $billingCategoryRelatedByIdModification The billingCategoryRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeBillingCategoryRelatedByIdModification($billingCategoryRelatedByIdModification)
    {
        if ($this->getBillingCategoriesRelatedByIdModification()->contains($billingCategoryRelatedByIdModification)) {
            $this->collBillingCategoriesRelatedByIdModification->remove($this->collBillingCategoriesRelatedByIdModification->search($billingCategoryRelatedByIdModification));
            if (null === $this->billingCategoriesRelatedByIdModificationScheduledForDeletion) {
                $this->billingCategoriesRelatedByIdModificationScheduledForDeletion = clone $this->collBillingCategoriesRelatedByIdModification;
                $this->billingCategoriesRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->billingCategoriesRelatedByIdModificationScheduledForDeletion[]= $billingCategoryRelatedByIdModification;
            $billingCategoryRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getBillingCategoriesRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BillingCategoryQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getBillingCategoriesRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collCurrenciesRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addCurrenciesRelatedByIdCreation()
     */
    public function clearCurrenciesRelatedByIdCreation()
    {
        $this->collCurrenciesRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collCurrenciesRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collCurrenciesRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialCurrenciesRelatedByIdCreation($v = true)
    {
        $this->collCurrenciesRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collCurrenciesRelatedByIdCreation collection.
     *
     * By default this just sets the collCurrenciesRelatedByIdCreation collection to an empty array (like clearcollCurrenciesRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCurrenciesRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collCurrenciesRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collCurrenciesRelatedByIdCreation = new PropelObjectCollection();
        $this->collCurrenciesRelatedByIdCreation->setModel('Currency');
    }

    /**
     * Gets an array of Currency objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Currency[] List of Currency objects
     * @throws PropelException
     */
    public function getCurrenciesRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCurrenciesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collCurrenciesRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCurrenciesRelatedByIdCreation) {
                // return empty collection
                $this->initCurrenciesRelatedByIdCreation();
            } else {
                $collCurrenciesRelatedByIdCreation = CurrencyQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCurrenciesRelatedByIdCreationPartial && count($collCurrenciesRelatedByIdCreation)) {
                      $this->initCurrenciesRelatedByIdCreation(false);

                      foreach ($collCurrenciesRelatedByIdCreation as $obj) {
                        if (false == $this->collCurrenciesRelatedByIdCreation->contains($obj)) {
                          $this->collCurrenciesRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collCurrenciesRelatedByIdCreationPartial = true;
                    }

                    $collCurrenciesRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collCurrenciesRelatedByIdCreation;
                }

                if ($partial && $this->collCurrenciesRelatedByIdCreation) {
                    foreach ($this->collCurrenciesRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collCurrenciesRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collCurrenciesRelatedByIdCreation = $collCurrenciesRelatedByIdCreation;
                $this->collCurrenciesRelatedByIdCreationPartial = false;
            }
        }

        return $this->collCurrenciesRelatedByIdCreation;
    }

    /**
     * Sets a collection of CurrencyRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $currenciesRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setCurrenciesRelatedByIdCreation(PropelCollection $currenciesRelatedByIdCreation, PropelPDO $con = null)
    {
        $currenciesRelatedByIdCreationToDelete = $this->getCurrenciesRelatedByIdCreation(new Criteria(), $con)->diff($currenciesRelatedByIdCreation);


        $this->currenciesRelatedByIdCreationScheduledForDeletion = $currenciesRelatedByIdCreationToDelete;

        foreach ($currenciesRelatedByIdCreationToDelete as $currencyRelatedByIdCreationRemoved) {
            $currencyRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collCurrenciesRelatedByIdCreation = null;
        foreach ($currenciesRelatedByIdCreation as $currencyRelatedByIdCreation) {
            $this->addCurrencyRelatedByIdCreation($currencyRelatedByIdCreation);
        }

        $this->collCurrenciesRelatedByIdCreation = $currenciesRelatedByIdCreation;
        $this->collCurrenciesRelatedByIdCreationPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Currency objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Currency objects.
     * @throws PropelException
     */
    public function countCurrenciesRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCurrenciesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collCurrenciesRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCurrenciesRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCurrenciesRelatedByIdCreation());
            }
            $query = CurrencyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collCurrenciesRelatedByIdCreation);
    }

    /**
     * Method called to associate a Currency object to this object
     * through the Currency foreign key attribute.
     *
     * @param    Currency $l Currency
     * @return Authy The current object (for fluent API support)
     */
    public function addCurrencyRelatedByIdCreation(Currency $l)
    {
        if ($this->collCurrenciesRelatedByIdCreation === null) {
            $this->initCurrenciesRelatedByIdCreation();
            $this->collCurrenciesRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collCurrenciesRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCurrencyRelatedByIdCreation($l);

            if ($this->currenciesRelatedByIdCreationScheduledForDeletion and $this->currenciesRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->currenciesRelatedByIdCreationScheduledForDeletion->remove($this->currenciesRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	CurrencyRelatedByIdCreation $currencyRelatedByIdCreation The currencyRelatedByIdCreation object to add.
     */
    protected function doAddCurrencyRelatedByIdCreation($currencyRelatedByIdCreation)
    {
        $this->collCurrenciesRelatedByIdCreation[]= $currencyRelatedByIdCreation;
        $currencyRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	CurrencyRelatedByIdCreation $currencyRelatedByIdCreation The currencyRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeCurrencyRelatedByIdCreation($currencyRelatedByIdCreation)
    {
        if ($this->getCurrenciesRelatedByIdCreation()->contains($currencyRelatedByIdCreation)) {
            $this->collCurrenciesRelatedByIdCreation->remove($this->collCurrenciesRelatedByIdCreation->search($currencyRelatedByIdCreation));
            if (null === $this->currenciesRelatedByIdCreationScheduledForDeletion) {
                $this->currenciesRelatedByIdCreationScheduledForDeletion = clone $this->collCurrenciesRelatedByIdCreation;
                $this->currenciesRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->currenciesRelatedByIdCreationScheduledForDeletion[]= $currencyRelatedByIdCreation;
            $currencyRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Currency[] List of Currency objects
     */
    public function getCurrenciesRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CurrencyQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getCurrenciesRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collCurrenciesRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addCurrenciesRelatedByIdModification()
     */
    public function clearCurrenciesRelatedByIdModification()
    {
        $this->collCurrenciesRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collCurrenciesRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collCurrenciesRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialCurrenciesRelatedByIdModification($v = true)
    {
        $this->collCurrenciesRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collCurrenciesRelatedByIdModification collection.
     *
     * By default this just sets the collCurrenciesRelatedByIdModification collection to an empty array (like clearcollCurrenciesRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCurrenciesRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collCurrenciesRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collCurrenciesRelatedByIdModification = new PropelObjectCollection();
        $this->collCurrenciesRelatedByIdModification->setModel('Currency');
    }

    /**
     * Gets an array of Currency objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Currency[] List of Currency objects
     * @throws PropelException
     */
    public function getCurrenciesRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCurrenciesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collCurrenciesRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCurrenciesRelatedByIdModification) {
                // return empty collection
                $this->initCurrenciesRelatedByIdModification();
            } else {
                $collCurrenciesRelatedByIdModification = CurrencyQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCurrenciesRelatedByIdModificationPartial && count($collCurrenciesRelatedByIdModification)) {
                      $this->initCurrenciesRelatedByIdModification(false);

                      foreach ($collCurrenciesRelatedByIdModification as $obj) {
                        if (false == $this->collCurrenciesRelatedByIdModification->contains($obj)) {
                          $this->collCurrenciesRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collCurrenciesRelatedByIdModificationPartial = true;
                    }

                    $collCurrenciesRelatedByIdModification->getInternalIterator()->rewind();

                    return $collCurrenciesRelatedByIdModification;
                }

                if ($partial && $this->collCurrenciesRelatedByIdModification) {
                    foreach ($this->collCurrenciesRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collCurrenciesRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collCurrenciesRelatedByIdModification = $collCurrenciesRelatedByIdModification;
                $this->collCurrenciesRelatedByIdModificationPartial = false;
            }
        }

        return $this->collCurrenciesRelatedByIdModification;
    }

    /**
     * Sets a collection of CurrencyRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $currenciesRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setCurrenciesRelatedByIdModification(PropelCollection $currenciesRelatedByIdModification, PropelPDO $con = null)
    {
        $currenciesRelatedByIdModificationToDelete = $this->getCurrenciesRelatedByIdModification(new Criteria(), $con)->diff($currenciesRelatedByIdModification);


        $this->currenciesRelatedByIdModificationScheduledForDeletion = $currenciesRelatedByIdModificationToDelete;

        foreach ($currenciesRelatedByIdModificationToDelete as $currencyRelatedByIdModificationRemoved) {
            $currencyRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collCurrenciesRelatedByIdModification = null;
        foreach ($currenciesRelatedByIdModification as $currencyRelatedByIdModification) {
            $this->addCurrencyRelatedByIdModification($currencyRelatedByIdModification);
        }

        $this->collCurrenciesRelatedByIdModification = $currenciesRelatedByIdModification;
        $this->collCurrenciesRelatedByIdModificationPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Currency objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Currency objects.
     * @throws PropelException
     */
    public function countCurrenciesRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCurrenciesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collCurrenciesRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCurrenciesRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCurrenciesRelatedByIdModification());
            }
            $query = CurrencyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collCurrenciesRelatedByIdModification);
    }

    /**
     * Method called to associate a Currency object to this object
     * through the Currency foreign key attribute.
     *
     * @param    Currency $l Currency
     * @return Authy The current object (for fluent API support)
     */
    public function addCurrencyRelatedByIdModification(Currency $l)
    {
        if ($this->collCurrenciesRelatedByIdModification === null) {
            $this->initCurrenciesRelatedByIdModification();
            $this->collCurrenciesRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collCurrenciesRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCurrencyRelatedByIdModification($l);

            if ($this->currenciesRelatedByIdModificationScheduledForDeletion and $this->currenciesRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->currenciesRelatedByIdModificationScheduledForDeletion->remove($this->currenciesRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	CurrencyRelatedByIdModification $currencyRelatedByIdModification The currencyRelatedByIdModification object to add.
     */
    protected function doAddCurrencyRelatedByIdModification($currencyRelatedByIdModification)
    {
        $this->collCurrenciesRelatedByIdModification[]= $currencyRelatedByIdModification;
        $currencyRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	CurrencyRelatedByIdModification $currencyRelatedByIdModification The currencyRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeCurrencyRelatedByIdModification($currencyRelatedByIdModification)
    {
        if ($this->getCurrenciesRelatedByIdModification()->contains($currencyRelatedByIdModification)) {
            $this->collCurrenciesRelatedByIdModification->remove($this->collCurrenciesRelatedByIdModification->search($currencyRelatedByIdModification));
            if (null === $this->currenciesRelatedByIdModificationScheduledForDeletion) {
                $this->currenciesRelatedByIdModificationScheduledForDeletion = clone $this->collCurrenciesRelatedByIdModification;
                $this->currenciesRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->currenciesRelatedByIdModificationScheduledForDeletion[]= $currencyRelatedByIdModification;
            $currencyRelatedByIdModification->setAuthyRelatedByIdModification(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Currency[] List of Currency objects
     */
    public function getCurrenciesRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CurrencyQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getCurrenciesRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collSuppliersRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addSuppliersRelatedByIdCreation()
     */
    public function clearSuppliersRelatedByIdCreation()
    {
        $this->collSuppliersRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collSuppliersRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collSuppliersRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialSuppliersRelatedByIdCreation($v = true)
    {
        $this->collSuppliersRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collSuppliersRelatedByIdCreation collection.
     *
     * By default this just sets the collSuppliersRelatedByIdCreation collection to an empty array (like clearcollSuppliersRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSuppliersRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collSuppliersRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collSuppliersRelatedByIdCreation = new PropelObjectCollection();
        $this->collSuppliersRelatedByIdCreation->setModel('Supplier');
    }

    /**
     * Gets an array of Supplier objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Supplier[] List of Supplier objects
     * @throws PropelException
     */
    public function getSuppliersRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collSuppliersRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collSuppliersRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSuppliersRelatedByIdCreation) {
                // return empty collection
                $this->initSuppliersRelatedByIdCreation();
            } else {
                $collSuppliersRelatedByIdCreation = SupplierQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collSuppliersRelatedByIdCreationPartial && count($collSuppliersRelatedByIdCreation)) {
                      $this->initSuppliersRelatedByIdCreation(false);

                      foreach ($collSuppliersRelatedByIdCreation as $obj) {
                        if (false == $this->collSuppliersRelatedByIdCreation->contains($obj)) {
                          $this->collSuppliersRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collSuppliersRelatedByIdCreationPartial = true;
                    }

                    $collSuppliersRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collSuppliersRelatedByIdCreation;
                }

                if ($partial && $this->collSuppliersRelatedByIdCreation) {
                    foreach ($this->collSuppliersRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collSuppliersRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collSuppliersRelatedByIdCreation = $collSuppliersRelatedByIdCreation;
                $this->collSuppliersRelatedByIdCreationPartial = false;
            }
        }

        return $this->collSuppliersRelatedByIdCreation;
    }

    /**
     * Sets a collection of SupplierRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $suppliersRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setSuppliersRelatedByIdCreation(PropelCollection $suppliersRelatedByIdCreation, PropelPDO $con = null)
    {
        $suppliersRelatedByIdCreationToDelete = $this->getSuppliersRelatedByIdCreation(new Criteria(), $con)->diff($suppliersRelatedByIdCreation);


        $this->suppliersRelatedByIdCreationScheduledForDeletion = $suppliersRelatedByIdCreationToDelete;

        foreach ($suppliersRelatedByIdCreationToDelete as $supplierRelatedByIdCreationRemoved) {
            $supplierRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collSuppliersRelatedByIdCreation = null;
        foreach ($suppliersRelatedByIdCreation as $supplierRelatedByIdCreation) {
            $this->addSupplierRelatedByIdCreation($supplierRelatedByIdCreation);
        }

        $this->collSuppliersRelatedByIdCreation = $suppliersRelatedByIdCreation;
        $this->collSuppliersRelatedByIdCreationPartial = false;

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
    public function countSuppliersRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collSuppliersRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collSuppliersRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSuppliersRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSuppliersRelatedByIdCreation());
            }
            $query = SupplierQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collSuppliersRelatedByIdCreation);
    }

    /**
     * Method called to associate a Supplier object to this object
     * through the Supplier foreign key attribute.
     *
     * @param    Supplier $l Supplier
     * @return Authy The current object (for fluent API support)
     */
    public function addSupplierRelatedByIdCreation(Supplier $l)
    {
        if ($this->collSuppliersRelatedByIdCreation === null) {
            $this->initSuppliersRelatedByIdCreation();
            $this->collSuppliersRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collSuppliersRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddSupplierRelatedByIdCreation($l);

            if ($this->suppliersRelatedByIdCreationScheduledForDeletion and $this->suppliersRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->suppliersRelatedByIdCreationScheduledForDeletion->remove($this->suppliersRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	SupplierRelatedByIdCreation $supplierRelatedByIdCreation The supplierRelatedByIdCreation object to add.
     */
    protected function doAddSupplierRelatedByIdCreation($supplierRelatedByIdCreation)
    {
        $this->collSuppliersRelatedByIdCreation[]= $supplierRelatedByIdCreation;
        $supplierRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	SupplierRelatedByIdCreation $supplierRelatedByIdCreation The supplierRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeSupplierRelatedByIdCreation($supplierRelatedByIdCreation)
    {
        if ($this->getSuppliersRelatedByIdCreation()->contains($supplierRelatedByIdCreation)) {
            $this->collSuppliersRelatedByIdCreation->remove($this->collSuppliersRelatedByIdCreation->search($supplierRelatedByIdCreation));
            if (null === $this->suppliersRelatedByIdCreationScheduledForDeletion) {
                $this->suppliersRelatedByIdCreationScheduledForDeletion = clone $this->collSuppliersRelatedByIdCreation;
                $this->suppliersRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->suppliersRelatedByIdCreationScheduledForDeletion[]= $supplierRelatedByIdCreation;
            $supplierRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getSuppliersRelatedByIdCreationJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SupplierQuery::create(null, $criteria);
        $query->joinWith('Country', $join_behavior);

        return $this->getSuppliersRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Supplier[] List of Supplier objects
     */
    public function getSuppliersRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SupplierQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getSuppliersRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collSuppliersRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addSuppliersRelatedByIdModification()
     */
    public function clearSuppliersRelatedByIdModification()
    {
        $this->collSuppliersRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collSuppliersRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collSuppliersRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialSuppliersRelatedByIdModification($v = true)
    {
        $this->collSuppliersRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collSuppliersRelatedByIdModification collection.
     *
     * By default this just sets the collSuppliersRelatedByIdModification collection to an empty array (like clearcollSuppliersRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initSuppliersRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collSuppliersRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collSuppliersRelatedByIdModification = new PropelObjectCollection();
        $this->collSuppliersRelatedByIdModification->setModel('Supplier');
    }

    /**
     * Gets an array of Supplier objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Supplier[] List of Supplier objects
     * @throws PropelException
     */
    public function getSuppliersRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collSuppliersRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collSuppliersRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collSuppliersRelatedByIdModification) {
                // return empty collection
                $this->initSuppliersRelatedByIdModification();
            } else {
                $collSuppliersRelatedByIdModification = SupplierQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collSuppliersRelatedByIdModificationPartial && count($collSuppliersRelatedByIdModification)) {
                      $this->initSuppliersRelatedByIdModification(false);

                      foreach ($collSuppliersRelatedByIdModification as $obj) {
                        if (false == $this->collSuppliersRelatedByIdModification->contains($obj)) {
                          $this->collSuppliersRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collSuppliersRelatedByIdModificationPartial = true;
                    }

                    $collSuppliersRelatedByIdModification->getInternalIterator()->rewind();

                    return $collSuppliersRelatedByIdModification;
                }

                if ($partial && $this->collSuppliersRelatedByIdModification) {
                    foreach ($this->collSuppliersRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collSuppliersRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collSuppliersRelatedByIdModification = $collSuppliersRelatedByIdModification;
                $this->collSuppliersRelatedByIdModificationPartial = false;
            }
        }

        return $this->collSuppliersRelatedByIdModification;
    }

    /**
     * Sets a collection of SupplierRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $suppliersRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setSuppliersRelatedByIdModification(PropelCollection $suppliersRelatedByIdModification, PropelPDO $con = null)
    {
        $suppliersRelatedByIdModificationToDelete = $this->getSuppliersRelatedByIdModification(new Criteria(), $con)->diff($suppliersRelatedByIdModification);


        $this->suppliersRelatedByIdModificationScheduledForDeletion = $suppliersRelatedByIdModificationToDelete;

        foreach ($suppliersRelatedByIdModificationToDelete as $supplierRelatedByIdModificationRemoved) {
            $supplierRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collSuppliersRelatedByIdModification = null;
        foreach ($suppliersRelatedByIdModification as $supplierRelatedByIdModification) {
            $this->addSupplierRelatedByIdModification($supplierRelatedByIdModification);
        }

        $this->collSuppliersRelatedByIdModification = $suppliersRelatedByIdModification;
        $this->collSuppliersRelatedByIdModificationPartial = false;

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
    public function countSuppliersRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collSuppliersRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collSuppliersRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collSuppliersRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getSuppliersRelatedByIdModification());
            }
            $query = SupplierQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collSuppliersRelatedByIdModification);
    }

    /**
     * Method called to associate a Supplier object to this object
     * through the Supplier foreign key attribute.
     *
     * @param    Supplier $l Supplier
     * @return Authy The current object (for fluent API support)
     */
    public function addSupplierRelatedByIdModification(Supplier $l)
    {
        if ($this->collSuppliersRelatedByIdModification === null) {
            $this->initSuppliersRelatedByIdModification();
            $this->collSuppliersRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collSuppliersRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddSupplierRelatedByIdModification($l);

            if ($this->suppliersRelatedByIdModificationScheduledForDeletion and $this->suppliersRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->suppliersRelatedByIdModificationScheduledForDeletion->remove($this->suppliersRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	SupplierRelatedByIdModification $supplierRelatedByIdModification The supplierRelatedByIdModification object to add.
     */
    protected function doAddSupplierRelatedByIdModification($supplierRelatedByIdModification)
    {
        $this->collSuppliersRelatedByIdModification[]= $supplierRelatedByIdModification;
        $supplierRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	SupplierRelatedByIdModification $supplierRelatedByIdModification The supplierRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeSupplierRelatedByIdModification($supplierRelatedByIdModification)
    {
        if ($this->getSuppliersRelatedByIdModification()->contains($supplierRelatedByIdModification)) {
            $this->collSuppliersRelatedByIdModification->remove($this->collSuppliersRelatedByIdModification->search($supplierRelatedByIdModification));
            if (null === $this->suppliersRelatedByIdModificationScheduledForDeletion) {
                $this->suppliersRelatedByIdModificationScheduledForDeletion = clone $this->collSuppliersRelatedByIdModification;
                $this->suppliersRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->suppliersRelatedByIdModificationScheduledForDeletion[]= $supplierRelatedByIdModification;
            $supplierRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getSuppliersRelatedByIdModificationJoinCountry($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SupplierQuery::create(null, $criteria);
        $query->joinWith('Country', $join_behavior);

        return $this->getSuppliersRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Supplier[] List of Supplier objects
     */
    public function getSuppliersRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = SupplierQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getSuppliersRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collAuthiesRelatedByIdAuthy0 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addAuthiesRelatedByIdAuthy0()
     */
    public function clearAuthiesRelatedByIdAuthy0()
    {
        $this->collAuthiesRelatedByIdAuthy0 = null; // important to set this to null since that means it is uninitialized
        $this->collAuthiesRelatedByIdAuthy0Partial = null;

        return $this;
    }

    /**
     * reset is the collAuthiesRelatedByIdAuthy0 collection loaded partially
     *
     * @return void
     */
    public function resetPartialAuthiesRelatedByIdAuthy0($v = true)
    {
        $this->collAuthiesRelatedByIdAuthy0Partial = $v;
    }

    /**
     * Initializes the collAuthiesRelatedByIdAuthy0 collection.
     *
     * By default this just sets the collAuthiesRelatedByIdAuthy0 collection to an empty array (like clearcollAuthiesRelatedByIdAuthy0());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuthiesRelatedByIdAuthy0($overrideExisting = true)
    {
        if (null !== $this->collAuthiesRelatedByIdAuthy0 && !$overrideExisting) {
            return;
        }
        $this->collAuthiesRelatedByIdAuthy0 = new PropelObjectCollection();
        $this->collAuthiesRelatedByIdAuthy0->setModel('Authy');
    }

    /**
     * Gets an array of Authy objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Authy[] List of Authy objects
     * @throws PropelException
     */
    public function getAuthiesRelatedByIdAuthy0($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAuthiesRelatedByIdAuthy0Partial && !$this->isNew();
        if (null === $this->collAuthiesRelatedByIdAuthy0 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAuthiesRelatedByIdAuthy0) {
                // return empty collection
                $this->initAuthiesRelatedByIdAuthy0();
            } else {
                $collAuthiesRelatedByIdAuthy0 = AuthyQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAuthiesRelatedByIdAuthy0Partial && count($collAuthiesRelatedByIdAuthy0)) {
                      $this->initAuthiesRelatedByIdAuthy0(false);

                      foreach ($collAuthiesRelatedByIdAuthy0 as $obj) {
                        if (false == $this->collAuthiesRelatedByIdAuthy0->contains($obj)) {
                          $this->collAuthiesRelatedByIdAuthy0->append($obj);
                        }
                      }

                      $this->collAuthiesRelatedByIdAuthy0Partial = true;
                    }

                    $collAuthiesRelatedByIdAuthy0->getInternalIterator()->rewind();

                    return $collAuthiesRelatedByIdAuthy0;
                }

                if ($partial && $this->collAuthiesRelatedByIdAuthy0) {
                    foreach ($this->collAuthiesRelatedByIdAuthy0 as $obj) {
                        if ($obj->isNew()) {
                            $collAuthiesRelatedByIdAuthy0[] = $obj;
                        }
                    }
                }

                $this->collAuthiesRelatedByIdAuthy0 = $collAuthiesRelatedByIdAuthy0;
                $this->collAuthiesRelatedByIdAuthy0Partial = false;
            }
        }

        return $this->collAuthiesRelatedByIdAuthy0;
    }

    /**
     * Sets a collection of AuthyRelatedByIdAuthy0 objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $authiesRelatedByIdAuthy0 A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setAuthiesRelatedByIdAuthy0(PropelCollection $authiesRelatedByIdAuthy0, PropelPDO $con = null)
    {
        $authiesRelatedByIdAuthy0ToDelete = $this->getAuthiesRelatedByIdAuthy0(new Criteria(), $con)->diff($authiesRelatedByIdAuthy0);


        $this->authiesRelatedByIdAuthy0ScheduledForDeletion = $authiesRelatedByIdAuthy0ToDelete;

        foreach ($authiesRelatedByIdAuthy0ToDelete as $authyRelatedByIdAuthy0Removed) {
            $authyRelatedByIdAuthy0Removed->setAuthyRelatedByIdCreation(null);
        }

        $this->collAuthiesRelatedByIdAuthy0 = null;
        foreach ($authiesRelatedByIdAuthy0 as $authyRelatedByIdAuthy0) {
            $this->addAuthyRelatedByIdAuthy0($authyRelatedByIdAuthy0);
        }

        $this->collAuthiesRelatedByIdAuthy0 = $authiesRelatedByIdAuthy0;
        $this->collAuthiesRelatedByIdAuthy0Partial = false;

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
    public function countAuthiesRelatedByIdAuthy0(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAuthiesRelatedByIdAuthy0Partial && !$this->isNew();
        if (null === $this->collAuthiesRelatedByIdAuthy0 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuthiesRelatedByIdAuthy0) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuthiesRelatedByIdAuthy0());
            }
            $query = AuthyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collAuthiesRelatedByIdAuthy0);
    }

    /**
     * Method called to associate a Authy object to this object
     * through the Authy foreign key attribute.
     *
     * @param    Authy $l Authy
     * @return Authy The current object (for fluent API support)
     */
    public function addAuthyRelatedByIdAuthy0(Authy $l)
    {
        if ($this->collAuthiesRelatedByIdAuthy0 === null) {
            $this->initAuthiesRelatedByIdAuthy0();
            $this->collAuthiesRelatedByIdAuthy0Partial = true;
        }

        if (!in_array($l, $this->collAuthiesRelatedByIdAuthy0->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAuthyRelatedByIdAuthy0($l);

            if ($this->authiesRelatedByIdAuthy0ScheduledForDeletion and $this->authiesRelatedByIdAuthy0ScheduledForDeletion->contains($l)) {
                $this->authiesRelatedByIdAuthy0ScheduledForDeletion->remove($this->authiesRelatedByIdAuthy0ScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	AuthyRelatedByIdAuthy0 $authyRelatedByIdAuthy0 The authyRelatedByIdAuthy0 object to add.
     */
    protected function doAddAuthyRelatedByIdAuthy0($authyRelatedByIdAuthy0)
    {
        $this->collAuthiesRelatedByIdAuthy0[]= $authyRelatedByIdAuthy0;
        $authyRelatedByIdAuthy0->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	AuthyRelatedByIdAuthy0 $authyRelatedByIdAuthy0 The authyRelatedByIdAuthy0 object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeAuthyRelatedByIdAuthy0($authyRelatedByIdAuthy0)
    {
        if ($this->getAuthiesRelatedByIdAuthy0()->contains($authyRelatedByIdAuthy0)) {
            $this->collAuthiesRelatedByIdAuthy0->remove($this->collAuthiesRelatedByIdAuthy0->search($authyRelatedByIdAuthy0));
            if (null === $this->authiesRelatedByIdAuthy0ScheduledForDeletion) {
                $this->authiesRelatedByIdAuthy0ScheduledForDeletion = clone $this->collAuthiesRelatedByIdAuthy0;
                $this->authiesRelatedByIdAuthy0ScheduledForDeletion->clear();
            }
            $this->authiesRelatedByIdAuthy0ScheduledForDeletion[]= $authyRelatedByIdAuthy0;
            $authyRelatedByIdAuthy0->setAuthyRelatedByIdCreation(null);
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
    public function getAuthiesRelatedByIdAuthy0JoinAuthyGroupRelatedByIdAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyQuery::create(null, $criteria);
        $query->joinWith('AuthyGroupRelatedByIdAuthyGroup', $join_behavior);

        return $this->getAuthiesRelatedByIdAuthy0($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Authy[] List of Authy objects
     */
    public function getAuthiesRelatedByIdAuthy0JoinAuthyGroupRelatedByIdGroupCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyQuery::create(null, $criteria);
        $query->joinWith('AuthyGroupRelatedByIdGroupCreation', $join_behavior);

        return $this->getAuthiesRelatedByIdAuthy0($query, $con);
    }

    /**
     * Clears out the collAuthiesRelatedByIdAuthy1 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addAuthiesRelatedByIdAuthy1()
     */
    public function clearAuthiesRelatedByIdAuthy1()
    {
        $this->collAuthiesRelatedByIdAuthy1 = null; // important to set this to null since that means it is uninitialized
        $this->collAuthiesRelatedByIdAuthy1Partial = null;

        return $this;
    }

    /**
     * reset is the collAuthiesRelatedByIdAuthy1 collection loaded partially
     *
     * @return void
     */
    public function resetPartialAuthiesRelatedByIdAuthy1($v = true)
    {
        $this->collAuthiesRelatedByIdAuthy1Partial = $v;
    }

    /**
     * Initializes the collAuthiesRelatedByIdAuthy1 collection.
     *
     * By default this just sets the collAuthiesRelatedByIdAuthy1 collection to an empty array (like clearcollAuthiesRelatedByIdAuthy1());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuthiesRelatedByIdAuthy1($overrideExisting = true)
    {
        if (null !== $this->collAuthiesRelatedByIdAuthy1 && !$overrideExisting) {
            return;
        }
        $this->collAuthiesRelatedByIdAuthy1 = new PropelObjectCollection();
        $this->collAuthiesRelatedByIdAuthy1->setModel('Authy');
    }

    /**
     * Gets an array of Authy objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Authy[] List of Authy objects
     * @throws PropelException
     */
    public function getAuthiesRelatedByIdAuthy1($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAuthiesRelatedByIdAuthy1Partial && !$this->isNew();
        if (null === $this->collAuthiesRelatedByIdAuthy1 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAuthiesRelatedByIdAuthy1) {
                // return empty collection
                $this->initAuthiesRelatedByIdAuthy1();
            } else {
                $collAuthiesRelatedByIdAuthy1 = AuthyQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAuthiesRelatedByIdAuthy1Partial && count($collAuthiesRelatedByIdAuthy1)) {
                      $this->initAuthiesRelatedByIdAuthy1(false);

                      foreach ($collAuthiesRelatedByIdAuthy1 as $obj) {
                        if (false == $this->collAuthiesRelatedByIdAuthy1->contains($obj)) {
                          $this->collAuthiesRelatedByIdAuthy1->append($obj);
                        }
                      }

                      $this->collAuthiesRelatedByIdAuthy1Partial = true;
                    }

                    $collAuthiesRelatedByIdAuthy1->getInternalIterator()->rewind();

                    return $collAuthiesRelatedByIdAuthy1;
                }

                if ($partial && $this->collAuthiesRelatedByIdAuthy1) {
                    foreach ($this->collAuthiesRelatedByIdAuthy1 as $obj) {
                        if ($obj->isNew()) {
                            $collAuthiesRelatedByIdAuthy1[] = $obj;
                        }
                    }
                }

                $this->collAuthiesRelatedByIdAuthy1 = $collAuthiesRelatedByIdAuthy1;
                $this->collAuthiesRelatedByIdAuthy1Partial = false;
            }
        }

        return $this->collAuthiesRelatedByIdAuthy1;
    }

    /**
     * Sets a collection of AuthyRelatedByIdAuthy1 objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $authiesRelatedByIdAuthy1 A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setAuthiesRelatedByIdAuthy1(PropelCollection $authiesRelatedByIdAuthy1, PropelPDO $con = null)
    {
        $authiesRelatedByIdAuthy1ToDelete = $this->getAuthiesRelatedByIdAuthy1(new Criteria(), $con)->diff($authiesRelatedByIdAuthy1);


        $this->authiesRelatedByIdAuthy1ScheduledForDeletion = $authiesRelatedByIdAuthy1ToDelete;

        foreach ($authiesRelatedByIdAuthy1ToDelete as $authyRelatedByIdAuthy1Removed) {
            $authyRelatedByIdAuthy1Removed->setAuthyRelatedByIdModification(null);
        }

        $this->collAuthiesRelatedByIdAuthy1 = null;
        foreach ($authiesRelatedByIdAuthy1 as $authyRelatedByIdAuthy1) {
            $this->addAuthyRelatedByIdAuthy1($authyRelatedByIdAuthy1);
        }

        $this->collAuthiesRelatedByIdAuthy1 = $authiesRelatedByIdAuthy1;
        $this->collAuthiesRelatedByIdAuthy1Partial = false;

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
    public function countAuthiesRelatedByIdAuthy1(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAuthiesRelatedByIdAuthy1Partial && !$this->isNew();
        if (null === $this->collAuthiesRelatedByIdAuthy1 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuthiesRelatedByIdAuthy1) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuthiesRelatedByIdAuthy1());
            }
            $query = AuthyQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collAuthiesRelatedByIdAuthy1);
    }

    /**
     * Method called to associate a Authy object to this object
     * through the Authy foreign key attribute.
     *
     * @param    Authy $l Authy
     * @return Authy The current object (for fluent API support)
     */
    public function addAuthyRelatedByIdAuthy1(Authy $l)
    {
        if ($this->collAuthiesRelatedByIdAuthy1 === null) {
            $this->initAuthiesRelatedByIdAuthy1();
            $this->collAuthiesRelatedByIdAuthy1Partial = true;
        }

        if (!in_array($l, $this->collAuthiesRelatedByIdAuthy1->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAuthyRelatedByIdAuthy1($l);

            if ($this->authiesRelatedByIdAuthy1ScheduledForDeletion and $this->authiesRelatedByIdAuthy1ScheduledForDeletion->contains($l)) {
                $this->authiesRelatedByIdAuthy1ScheduledForDeletion->remove($this->authiesRelatedByIdAuthy1ScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	AuthyRelatedByIdAuthy1 $authyRelatedByIdAuthy1 The authyRelatedByIdAuthy1 object to add.
     */
    protected function doAddAuthyRelatedByIdAuthy1($authyRelatedByIdAuthy1)
    {
        $this->collAuthiesRelatedByIdAuthy1[]= $authyRelatedByIdAuthy1;
        $authyRelatedByIdAuthy1->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	AuthyRelatedByIdAuthy1 $authyRelatedByIdAuthy1 The authyRelatedByIdAuthy1 object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeAuthyRelatedByIdAuthy1($authyRelatedByIdAuthy1)
    {
        if ($this->getAuthiesRelatedByIdAuthy1()->contains($authyRelatedByIdAuthy1)) {
            $this->collAuthiesRelatedByIdAuthy1->remove($this->collAuthiesRelatedByIdAuthy1->search($authyRelatedByIdAuthy1));
            if (null === $this->authiesRelatedByIdAuthy1ScheduledForDeletion) {
                $this->authiesRelatedByIdAuthy1ScheduledForDeletion = clone $this->collAuthiesRelatedByIdAuthy1;
                $this->authiesRelatedByIdAuthy1ScheduledForDeletion->clear();
            }
            $this->authiesRelatedByIdAuthy1ScheduledForDeletion[]= $authyRelatedByIdAuthy1;
            $authyRelatedByIdAuthy1->setAuthyRelatedByIdModification(null);
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
    public function getAuthiesRelatedByIdAuthy1JoinAuthyGroupRelatedByIdAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyQuery::create(null, $criteria);
        $query->joinWith('AuthyGroupRelatedByIdAuthyGroup', $join_behavior);

        return $this->getAuthiesRelatedByIdAuthy1($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Authy[] List of Authy objects
     */
    public function getAuthiesRelatedByIdAuthy1JoinAuthyGroupRelatedByIdGroupCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyQuery::create(null, $criteria);
        $query->joinWith('AuthyGroupRelatedByIdGroupCreation', $join_behavior);

        return $this->getAuthiesRelatedByIdAuthy1($query, $con);
    }

    /**
     * Clears out the collCountriesRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addCountriesRelatedByIdCreation()
     */
    public function clearCountriesRelatedByIdCreation()
    {
        $this->collCountriesRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collCountriesRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collCountriesRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialCountriesRelatedByIdCreation($v = true)
    {
        $this->collCountriesRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collCountriesRelatedByIdCreation collection.
     *
     * By default this just sets the collCountriesRelatedByIdCreation collection to an empty array (like clearcollCountriesRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCountriesRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collCountriesRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collCountriesRelatedByIdCreation = new PropelObjectCollection();
        $this->collCountriesRelatedByIdCreation->setModel('Country');
    }

    /**
     * Gets an array of Country objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Country[] List of Country objects
     * @throws PropelException
     */
    public function getCountriesRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCountriesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collCountriesRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCountriesRelatedByIdCreation) {
                // return empty collection
                $this->initCountriesRelatedByIdCreation();
            } else {
                $collCountriesRelatedByIdCreation = CountryQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCountriesRelatedByIdCreationPartial && count($collCountriesRelatedByIdCreation)) {
                      $this->initCountriesRelatedByIdCreation(false);

                      foreach ($collCountriesRelatedByIdCreation as $obj) {
                        if (false == $this->collCountriesRelatedByIdCreation->contains($obj)) {
                          $this->collCountriesRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collCountriesRelatedByIdCreationPartial = true;
                    }

                    $collCountriesRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collCountriesRelatedByIdCreation;
                }

                if ($partial && $this->collCountriesRelatedByIdCreation) {
                    foreach ($this->collCountriesRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collCountriesRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collCountriesRelatedByIdCreation = $collCountriesRelatedByIdCreation;
                $this->collCountriesRelatedByIdCreationPartial = false;
            }
        }

        return $this->collCountriesRelatedByIdCreation;
    }

    /**
     * Sets a collection of CountryRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $countriesRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setCountriesRelatedByIdCreation(PropelCollection $countriesRelatedByIdCreation, PropelPDO $con = null)
    {
        $countriesRelatedByIdCreationToDelete = $this->getCountriesRelatedByIdCreation(new Criteria(), $con)->diff($countriesRelatedByIdCreation);


        $this->countriesRelatedByIdCreationScheduledForDeletion = $countriesRelatedByIdCreationToDelete;

        foreach ($countriesRelatedByIdCreationToDelete as $countryRelatedByIdCreationRemoved) {
            $countryRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collCountriesRelatedByIdCreation = null;
        foreach ($countriesRelatedByIdCreation as $countryRelatedByIdCreation) {
            $this->addCountryRelatedByIdCreation($countryRelatedByIdCreation);
        }

        $this->collCountriesRelatedByIdCreation = $countriesRelatedByIdCreation;
        $this->collCountriesRelatedByIdCreationPartial = false;

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
    public function countCountriesRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCountriesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collCountriesRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCountriesRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCountriesRelatedByIdCreation());
            }
            $query = CountryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collCountriesRelatedByIdCreation);
    }

    /**
     * Method called to associate a Country object to this object
     * through the Country foreign key attribute.
     *
     * @param    Country $l Country
     * @return Authy The current object (for fluent API support)
     */
    public function addCountryRelatedByIdCreation(Country $l)
    {
        if ($this->collCountriesRelatedByIdCreation === null) {
            $this->initCountriesRelatedByIdCreation();
            $this->collCountriesRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collCountriesRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCountryRelatedByIdCreation($l);

            if ($this->countriesRelatedByIdCreationScheduledForDeletion and $this->countriesRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->countriesRelatedByIdCreationScheduledForDeletion->remove($this->countriesRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	CountryRelatedByIdCreation $countryRelatedByIdCreation The countryRelatedByIdCreation object to add.
     */
    protected function doAddCountryRelatedByIdCreation($countryRelatedByIdCreation)
    {
        $this->collCountriesRelatedByIdCreation[]= $countryRelatedByIdCreation;
        $countryRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	CountryRelatedByIdCreation $countryRelatedByIdCreation The countryRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeCountryRelatedByIdCreation($countryRelatedByIdCreation)
    {
        if ($this->getCountriesRelatedByIdCreation()->contains($countryRelatedByIdCreation)) {
            $this->collCountriesRelatedByIdCreation->remove($this->collCountriesRelatedByIdCreation->search($countryRelatedByIdCreation));
            if (null === $this->countriesRelatedByIdCreationScheduledForDeletion) {
                $this->countriesRelatedByIdCreationScheduledForDeletion = clone $this->collCountriesRelatedByIdCreation;
                $this->countriesRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->countriesRelatedByIdCreationScheduledForDeletion[]= $countryRelatedByIdCreation;
            $countryRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getCountriesRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CountryQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getCountriesRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collCountriesRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addCountriesRelatedByIdModification()
     */
    public function clearCountriesRelatedByIdModification()
    {
        $this->collCountriesRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collCountriesRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collCountriesRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialCountriesRelatedByIdModification($v = true)
    {
        $this->collCountriesRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collCountriesRelatedByIdModification collection.
     *
     * By default this just sets the collCountriesRelatedByIdModification collection to an empty array (like clearcollCountriesRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCountriesRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collCountriesRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collCountriesRelatedByIdModification = new PropelObjectCollection();
        $this->collCountriesRelatedByIdModification->setModel('Country');
    }

    /**
     * Gets an array of Country objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Country[] List of Country objects
     * @throws PropelException
     */
    public function getCountriesRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCountriesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collCountriesRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCountriesRelatedByIdModification) {
                // return empty collection
                $this->initCountriesRelatedByIdModification();
            } else {
                $collCountriesRelatedByIdModification = CountryQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCountriesRelatedByIdModificationPartial && count($collCountriesRelatedByIdModification)) {
                      $this->initCountriesRelatedByIdModification(false);

                      foreach ($collCountriesRelatedByIdModification as $obj) {
                        if (false == $this->collCountriesRelatedByIdModification->contains($obj)) {
                          $this->collCountriesRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collCountriesRelatedByIdModificationPartial = true;
                    }

                    $collCountriesRelatedByIdModification->getInternalIterator()->rewind();

                    return $collCountriesRelatedByIdModification;
                }

                if ($partial && $this->collCountriesRelatedByIdModification) {
                    foreach ($this->collCountriesRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collCountriesRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collCountriesRelatedByIdModification = $collCountriesRelatedByIdModification;
                $this->collCountriesRelatedByIdModificationPartial = false;
            }
        }

        return $this->collCountriesRelatedByIdModification;
    }

    /**
     * Sets a collection of CountryRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $countriesRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setCountriesRelatedByIdModification(PropelCollection $countriesRelatedByIdModification, PropelPDO $con = null)
    {
        $countriesRelatedByIdModificationToDelete = $this->getCountriesRelatedByIdModification(new Criteria(), $con)->diff($countriesRelatedByIdModification);


        $this->countriesRelatedByIdModificationScheduledForDeletion = $countriesRelatedByIdModificationToDelete;

        foreach ($countriesRelatedByIdModificationToDelete as $countryRelatedByIdModificationRemoved) {
            $countryRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collCountriesRelatedByIdModification = null;
        foreach ($countriesRelatedByIdModification as $countryRelatedByIdModification) {
            $this->addCountryRelatedByIdModification($countryRelatedByIdModification);
        }

        $this->collCountriesRelatedByIdModification = $countriesRelatedByIdModification;
        $this->collCountriesRelatedByIdModificationPartial = false;

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
    public function countCountriesRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCountriesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collCountriesRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCountriesRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getCountriesRelatedByIdModification());
            }
            $query = CountryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collCountriesRelatedByIdModification);
    }

    /**
     * Method called to associate a Country object to this object
     * through the Country foreign key attribute.
     *
     * @param    Country $l Country
     * @return Authy The current object (for fluent API support)
     */
    public function addCountryRelatedByIdModification(Country $l)
    {
        if ($this->collCountriesRelatedByIdModification === null) {
            $this->initCountriesRelatedByIdModification();
            $this->collCountriesRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collCountriesRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCountryRelatedByIdModification($l);

            if ($this->countriesRelatedByIdModificationScheduledForDeletion and $this->countriesRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->countriesRelatedByIdModificationScheduledForDeletion->remove($this->countriesRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	CountryRelatedByIdModification $countryRelatedByIdModification The countryRelatedByIdModification object to add.
     */
    protected function doAddCountryRelatedByIdModification($countryRelatedByIdModification)
    {
        $this->collCountriesRelatedByIdModification[]= $countryRelatedByIdModification;
        $countryRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	CountryRelatedByIdModification $countryRelatedByIdModification The countryRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeCountryRelatedByIdModification($countryRelatedByIdModification)
    {
        if ($this->getCountriesRelatedByIdModification()->contains($countryRelatedByIdModification)) {
            $this->collCountriesRelatedByIdModification->remove($this->collCountriesRelatedByIdModification->search($countryRelatedByIdModification));
            if (null === $this->countriesRelatedByIdModificationScheduledForDeletion) {
                $this->countriesRelatedByIdModificationScheduledForDeletion = clone $this->collCountriesRelatedByIdModification;
                $this->countriesRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->countriesRelatedByIdModificationScheduledForDeletion[]= $countryRelatedByIdModification;
            $countryRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getCountriesRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = CountryQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getCountriesRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collAuthyGroupsRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addAuthyGroupsRelatedByIdCreation()
     */
    public function clearAuthyGroupsRelatedByIdCreation()
    {
        $this->collAuthyGroupsRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collAuthyGroupsRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collAuthyGroupsRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialAuthyGroupsRelatedByIdCreation($v = true)
    {
        $this->collAuthyGroupsRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collAuthyGroupsRelatedByIdCreation collection.
     *
     * By default this just sets the collAuthyGroupsRelatedByIdCreation collection to an empty array (like clearcollAuthyGroupsRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuthyGroupsRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collAuthyGroupsRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collAuthyGroupsRelatedByIdCreation = new PropelObjectCollection();
        $this->collAuthyGroupsRelatedByIdCreation->setModel('AuthyGroup');
    }

    /**
     * Gets an array of AuthyGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|AuthyGroup[] List of AuthyGroup objects
     * @throws PropelException
     */
    public function getAuthyGroupsRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAuthyGroupsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collAuthyGroupsRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAuthyGroupsRelatedByIdCreation) {
                // return empty collection
                $this->initAuthyGroupsRelatedByIdCreation();
            } else {
                $collAuthyGroupsRelatedByIdCreation = AuthyGroupQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAuthyGroupsRelatedByIdCreationPartial && count($collAuthyGroupsRelatedByIdCreation)) {
                      $this->initAuthyGroupsRelatedByIdCreation(false);

                      foreach ($collAuthyGroupsRelatedByIdCreation as $obj) {
                        if (false == $this->collAuthyGroupsRelatedByIdCreation->contains($obj)) {
                          $this->collAuthyGroupsRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collAuthyGroupsRelatedByIdCreationPartial = true;
                    }

                    $collAuthyGroupsRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collAuthyGroupsRelatedByIdCreation;
                }

                if ($partial && $this->collAuthyGroupsRelatedByIdCreation) {
                    foreach ($this->collAuthyGroupsRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collAuthyGroupsRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collAuthyGroupsRelatedByIdCreation = $collAuthyGroupsRelatedByIdCreation;
                $this->collAuthyGroupsRelatedByIdCreationPartial = false;
            }
        }

        return $this->collAuthyGroupsRelatedByIdCreation;
    }

    /**
     * Sets a collection of AuthyGroupRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $authyGroupsRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setAuthyGroupsRelatedByIdCreation(PropelCollection $authyGroupsRelatedByIdCreation, PropelPDO $con = null)
    {
        $authyGroupsRelatedByIdCreationToDelete = $this->getAuthyGroupsRelatedByIdCreation(new Criteria(), $con)->diff($authyGroupsRelatedByIdCreation);


        $this->authyGroupsRelatedByIdCreationScheduledForDeletion = $authyGroupsRelatedByIdCreationToDelete;

        foreach ($authyGroupsRelatedByIdCreationToDelete as $authyGroupRelatedByIdCreationRemoved) {
            $authyGroupRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collAuthyGroupsRelatedByIdCreation = null;
        foreach ($authyGroupsRelatedByIdCreation as $authyGroupRelatedByIdCreation) {
            $this->addAuthyGroupRelatedByIdCreation($authyGroupRelatedByIdCreation);
        }

        $this->collAuthyGroupsRelatedByIdCreation = $authyGroupsRelatedByIdCreation;
        $this->collAuthyGroupsRelatedByIdCreationPartial = false;

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
    public function countAuthyGroupsRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAuthyGroupsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collAuthyGroupsRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuthyGroupsRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuthyGroupsRelatedByIdCreation());
            }
            $query = AuthyGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collAuthyGroupsRelatedByIdCreation);
    }

    /**
     * Method called to associate a AuthyGroup object to this object
     * through the AuthyGroup foreign key attribute.
     *
     * @param    AuthyGroup $l AuthyGroup
     * @return Authy The current object (for fluent API support)
     */
    public function addAuthyGroupRelatedByIdCreation(AuthyGroup $l)
    {
        if ($this->collAuthyGroupsRelatedByIdCreation === null) {
            $this->initAuthyGroupsRelatedByIdCreation();
            $this->collAuthyGroupsRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collAuthyGroupsRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAuthyGroupRelatedByIdCreation($l);

            if ($this->authyGroupsRelatedByIdCreationScheduledForDeletion and $this->authyGroupsRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->authyGroupsRelatedByIdCreationScheduledForDeletion->remove($this->authyGroupsRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	AuthyGroupRelatedByIdCreation $authyGroupRelatedByIdCreation The authyGroupRelatedByIdCreation object to add.
     */
    protected function doAddAuthyGroupRelatedByIdCreation($authyGroupRelatedByIdCreation)
    {
        $this->collAuthyGroupsRelatedByIdCreation[]= $authyGroupRelatedByIdCreation;
        $authyGroupRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	AuthyGroupRelatedByIdCreation $authyGroupRelatedByIdCreation The authyGroupRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeAuthyGroupRelatedByIdCreation($authyGroupRelatedByIdCreation)
    {
        if ($this->getAuthyGroupsRelatedByIdCreation()->contains($authyGroupRelatedByIdCreation)) {
            $this->collAuthyGroupsRelatedByIdCreation->remove($this->collAuthyGroupsRelatedByIdCreation->search($authyGroupRelatedByIdCreation));
            if (null === $this->authyGroupsRelatedByIdCreationScheduledForDeletion) {
                $this->authyGroupsRelatedByIdCreationScheduledForDeletion = clone $this->collAuthyGroupsRelatedByIdCreation;
                $this->authyGroupsRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->authyGroupsRelatedByIdCreationScheduledForDeletion[]= $authyGroupRelatedByIdCreation;
            $authyGroupRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getAuthyGroupsRelatedByIdCreationJoinAuthyGroupRelatedByIdGroupCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyGroupQuery::create(null, $criteria);
        $query->joinWith('AuthyGroupRelatedByIdGroupCreation', $join_behavior);

        return $this->getAuthyGroupsRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collAuthyGroupsRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addAuthyGroupsRelatedByIdModification()
     */
    public function clearAuthyGroupsRelatedByIdModification()
    {
        $this->collAuthyGroupsRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collAuthyGroupsRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collAuthyGroupsRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialAuthyGroupsRelatedByIdModification($v = true)
    {
        $this->collAuthyGroupsRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collAuthyGroupsRelatedByIdModification collection.
     *
     * By default this just sets the collAuthyGroupsRelatedByIdModification collection to an empty array (like clearcollAuthyGroupsRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAuthyGroupsRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collAuthyGroupsRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collAuthyGroupsRelatedByIdModification = new PropelObjectCollection();
        $this->collAuthyGroupsRelatedByIdModification->setModel('AuthyGroup');
    }

    /**
     * Gets an array of AuthyGroup objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|AuthyGroup[] List of AuthyGroup objects
     * @throws PropelException
     */
    public function getAuthyGroupsRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collAuthyGroupsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collAuthyGroupsRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAuthyGroupsRelatedByIdModification) {
                // return empty collection
                $this->initAuthyGroupsRelatedByIdModification();
            } else {
                $collAuthyGroupsRelatedByIdModification = AuthyGroupQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collAuthyGroupsRelatedByIdModificationPartial && count($collAuthyGroupsRelatedByIdModification)) {
                      $this->initAuthyGroupsRelatedByIdModification(false);

                      foreach ($collAuthyGroupsRelatedByIdModification as $obj) {
                        if (false == $this->collAuthyGroupsRelatedByIdModification->contains($obj)) {
                          $this->collAuthyGroupsRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collAuthyGroupsRelatedByIdModificationPartial = true;
                    }

                    $collAuthyGroupsRelatedByIdModification->getInternalIterator()->rewind();

                    return $collAuthyGroupsRelatedByIdModification;
                }

                if ($partial && $this->collAuthyGroupsRelatedByIdModification) {
                    foreach ($this->collAuthyGroupsRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collAuthyGroupsRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collAuthyGroupsRelatedByIdModification = $collAuthyGroupsRelatedByIdModification;
                $this->collAuthyGroupsRelatedByIdModificationPartial = false;
            }
        }

        return $this->collAuthyGroupsRelatedByIdModification;
    }

    /**
     * Sets a collection of AuthyGroupRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $authyGroupsRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setAuthyGroupsRelatedByIdModification(PropelCollection $authyGroupsRelatedByIdModification, PropelPDO $con = null)
    {
        $authyGroupsRelatedByIdModificationToDelete = $this->getAuthyGroupsRelatedByIdModification(new Criteria(), $con)->diff($authyGroupsRelatedByIdModification);


        $this->authyGroupsRelatedByIdModificationScheduledForDeletion = $authyGroupsRelatedByIdModificationToDelete;

        foreach ($authyGroupsRelatedByIdModificationToDelete as $authyGroupRelatedByIdModificationRemoved) {
            $authyGroupRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collAuthyGroupsRelatedByIdModification = null;
        foreach ($authyGroupsRelatedByIdModification as $authyGroupRelatedByIdModification) {
            $this->addAuthyGroupRelatedByIdModification($authyGroupRelatedByIdModification);
        }

        $this->collAuthyGroupsRelatedByIdModification = $authyGroupsRelatedByIdModification;
        $this->collAuthyGroupsRelatedByIdModificationPartial = false;

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
    public function countAuthyGroupsRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collAuthyGroupsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collAuthyGroupsRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAuthyGroupsRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAuthyGroupsRelatedByIdModification());
            }
            $query = AuthyGroupQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collAuthyGroupsRelatedByIdModification);
    }

    /**
     * Method called to associate a AuthyGroup object to this object
     * through the AuthyGroup foreign key attribute.
     *
     * @param    AuthyGroup $l AuthyGroup
     * @return Authy The current object (for fluent API support)
     */
    public function addAuthyGroupRelatedByIdModification(AuthyGroup $l)
    {
        if ($this->collAuthyGroupsRelatedByIdModification === null) {
            $this->initAuthyGroupsRelatedByIdModification();
            $this->collAuthyGroupsRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collAuthyGroupsRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddAuthyGroupRelatedByIdModification($l);

            if ($this->authyGroupsRelatedByIdModificationScheduledForDeletion and $this->authyGroupsRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->authyGroupsRelatedByIdModificationScheduledForDeletion->remove($this->authyGroupsRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	AuthyGroupRelatedByIdModification $authyGroupRelatedByIdModification The authyGroupRelatedByIdModification object to add.
     */
    protected function doAddAuthyGroupRelatedByIdModification($authyGroupRelatedByIdModification)
    {
        $this->collAuthyGroupsRelatedByIdModification[]= $authyGroupRelatedByIdModification;
        $authyGroupRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	AuthyGroupRelatedByIdModification $authyGroupRelatedByIdModification The authyGroupRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeAuthyGroupRelatedByIdModification($authyGroupRelatedByIdModification)
    {
        if ($this->getAuthyGroupsRelatedByIdModification()->contains($authyGroupRelatedByIdModification)) {
            $this->collAuthyGroupsRelatedByIdModification->remove($this->collAuthyGroupsRelatedByIdModification->search($authyGroupRelatedByIdModification));
            if (null === $this->authyGroupsRelatedByIdModificationScheduledForDeletion) {
                $this->authyGroupsRelatedByIdModificationScheduledForDeletion = clone $this->collAuthyGroupsRelatedByIdModification;
                $this->authyGroupsRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->authyGroupsRelatedByIdModificationScheduledForDeletion[]= $authyGroupRelatedByIdModification;
            $authyGroupRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getAuthyGroupsRelatedByIdModificationJoinAuthyGroupRelatedByIdGroupCreation($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = AuthyGroupQuery::create(null, $criteria);
        $query->joinWith('AuthyGroupRelatedByIdGroupCreation', $join_behavior);

        return $this->getAuthyGroupsRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collConfigsRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addConfigsRelatedByIdCreation()
     */
    public function clearConfigsRelatedByIdCreation()
    {
        $this->collConfigsRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collConfigsRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collConfigsRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialConfigsRelatedByIdCreation($v = true)
    {
        $this->collConfigsRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collConfigsRelatedByIdCreation collection.
     *
     * By default this just sets the collConfigsRelatedByIdCreation collection to an empty array (like clearcollConfigsRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initConfigsRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collConfigsRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collConfigsRelatedByIdCreation = new PropelObjectCollection();
        $this->collConfigsRelatedByIdCreation->setModel('Config');
    }

    /**
     * Gets an array of Config objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Config[] List of Config objects
     * @throws PropelException
     */
    public function getConfigsRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collConfigsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collConfigsRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collConfigsRelatedByIdCreation) {
                // return empty collection
                $this->initConfigsRelatedByIdCreation();
            } else {
                $collConfigsRelatedByIdCreation = ConfigQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collConfigsRelatedByIdCreationPartial && count($collConfigsRelatedByIdCreation)) {
                      $this->initConfigsRelatedByIdCreation(false);

                      foreach ($collConfigsRelatedByIdCreation as $obj) {
                        if (false == $this->collConfigsRelatedByIdCreation->contains($obj)) {
                          $this->collConfigsRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collConfigsRelatedByIdCreationPartial = true;
                    }

                    $collConfigsRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collConfigsRelatedByIdCreation;
                }

                if ($partial && $this->collConfigsRelatedByIdCreation) {
                    foreach ($this->collConfigsRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collConfigsRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collConfigsRelatedByIdCreation = $collConfigsRelatedByIdCreation;
                $this->collConfigsRelatedByIdCreationPartial = false;
            }
        }

        return $this->collConfigsRelatedByIdCreation;
    }

    /**
     * Sets a collection of ConfigRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $configsRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setConfigsRelatedByIdCreation(PropelCollection $configsRelatedByIdCreation, PropelPDO $con = null)
    {
        $configsRelatedByIdCreationToDelete = $this->getConfigsRelatedByIdCreation(new Criteria(), $con)->diff($configsRelatedByIdCreation);


        $this->configsRelatedByIdCreationScheduledForDeletion = $configsRelatedByIdCreationToDelete;

        foreach ($configsRelatedByIdCreationToDelete as $configRelatedByIdCreationRemoved) {
            $configRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collConfigsRelatedByIdCreation = null;
        foreach ($configsRelatedByIdCreation as $configRelatedByIdCreation) {
            $this->addConfigRelatedByIdCreation($configRelatedByIdCreation);
        }

        $this->collConfigsRelatedByIdCreation = $configsRelatedByIdCreation;
        $this->collConfigsRelatedByIdCreationPartial = false;

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
    public function countConfigsRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collConfigsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collConfigsRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collConfigsRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getConfigsRelatedByIdCreation());
            }
            $query = ConfigQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collConfigsRelatedByIdCreation);
    }

    /**
     * Method called to associate a Config object to this object
     * through the Config foreign key attribute.
     *
     * @param    Config $l Config
     * @return Authy The current object (for fluent API support)
     */
    public function addConfigRelatedByIdCreation(Config $l)
    {
        if ($this->collConfigsRelatedByIdCreation === null) {
            $this->initConfigsRelatedByIdCreation();
            $this->collConfigsRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collConfigsRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddConfigRelatedByIdCreation($l);

            if ($this->configsRelatedByIdCreationScheduledForDeletion and $this->configsRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->configsRelatedByIdCreationScheduledForDeletion->remove($this->configsRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ConfigRelatedByIdCreation $configRelatedByIdCreation The configRelatedByIdCreation object to add.
     */
    protected function doAddConfigRelatedByIdCreation($configRelatedByIdCreation)
    {
        $this->collConfigsRelatedByIdCreation[]= $configRelatedByIdCreation;
        $configRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	ConfigRelatedByIdCreation $configRelatedByIdCreation The configRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeConfigRelatedByIdCreation($configRelatedByIdCreation)
    {
        if ($this->getConfigsRelatedByIdCreation()->contains($configRelatedByIdCreation)) {
            $this->collConfigsRelatedByIdCreation->remove($this->collConfigsRelatedByIdCreation->search($configRelatedByIdCreation));
            if (null === $this->configsRelatedByIdCreationScheduledForDeletion) {
                $this->configsRelatedByIdCreationScheduledForDeletion = clone $this->collConfigsRelatedByIdCreation;
                $this->configsRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->configsRelatedByIdCreationScheduledForDeletion[]= $configRelatedByIdCreation;
            $configRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getConfigsRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ConfigQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getConfigsRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collConfigsRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addConfigsRelatedByIdModification()
     */
    public function clearConfigsRelatedByIdModification()
    {
        $this->collConfigsRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collConfigsRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collConfigsRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialConfigsRelatedByIdModification($v = true)
    {
        $this->collConfigsRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collConfigsRelatedByIdModification collection.
     *
     * By default this just sets the collConfigsRelatedByIdModification collection to an empty array (like clearcollConfigsRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initConfigsRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collConfigsRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collConfigsRelatedByIdModification = new PropelObjectCollection();
        $this->collConfigsRelatedByIdModification->setModel('Config');
    }

    /**
     * Gets an array of Config objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Config[] List of Config objects
     * @throws PropelException
     */
    public function getConfigsRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collConfigsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collConfigsRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collConfigsRelatedByIdModification) {
                // return empty collection
                $this->initConfigsRelatedByIdModification();
            } else {
                $collConfigsRelatedByIdModification = ConfigQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collConfigsRelatedByIdModificationPartial && count($collConfigsRelatedByIdModification)) {
                      $this->initConfigsRelatedByIdModification(false);

                      foreach ($collConfigsRelatedByIdModification as $obj) {
                        if (false == $this->collConfigsRelatedByIdModification->contains($obj)) {
                          $this->collConfigsRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collConfigsRelatedByIdModificationPartial = true;
                    }

                    $collConfigsRelatedByIdModification->getInternalIterator()->rewind();

                    return $collConfigsRelatedByIdModification;
                }

                if ($partial && $this->collConfigsRelatedByIdModification) {
                    foreach ($this->collConfigsRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collConfigsRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collConfigsRelatedByIdModification = $collConfigsRelatedByIdModification;
                $this->collConfigsRelatedByIdModificationPartial = false;
            }
        }

        return $this->collConfigsRelatedByIdModification;
    }

    /**
     * Sets a collection of ConfigRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $configsRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setConfigsRelatedByIdModification(PropelCollection $configsRelatedByIdModification, PropelPDO $con = null)
    {
        $configsRelatedByIdModificationToDelete = $this->getConfigsRelatedByIdModification(new Criteria(), $con)->diff($configsRelatedByIdModification);


        $this->configsRelatedByIdModificationScheduledForDeletion = $configsRelatedByIdModificationToDelete;

        foreach ($configsRelatedByIdModificationToDelete as $configRelatedByIdModificationRemoved) {
            $configRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collConfigsRelatedByIdModification = null;
        foreach ($configsRelatedByIdModification as $configRelatedByIdModification) {
            $this->addConfigRelatedByIdModification($configRelatedByIdModification);
        }

        $this->collConfigsRelatedByIdModification = $configsRelatedByIdModification;
        $this->collConfigsRelatedByIdModificationPartial = false;

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
    public function countConfigsRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collConfigsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collConfigsRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collConfigsRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getConfigsRelatedByIdModification());
            }
            $query = ConfigQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collConfigsRelatedByIdModification);
    }

    /**
     * Method called to associate a Config object to this object
     * through the Config foreign key attribute.
     *
     * @param    Config $l Config
     * @return Authy The current object (for fluent API support)
     */
    public function addConfigRelatedByIdModification(Config $l)
    {
        if ($this->collConfigsRelatedByIdModification === null) {
            $this->initConfigsRelatedByIdModification();
            $this->collConfigsRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collConfigsRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddConfigRelatedByIdModification($l);

            if ($this->configsRelatedByIdModificationScheduledForDeletion and $this->configsRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->configsRelatedByIdModificationScheduledForDeletion->remove($this->configsRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ConfigRelatedByIdModification $configRelatedByIdModification The configRelatedByIdModification object to add.
     */
    protected function doAddConfigRelatedByIdModification($configRelatedByIdModification)
    {
        $this->collConfigsRelatedByIdModification[]= $configRelatedByIdModification;
        $configRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	ConfigRelatedByIdModification $configRelatedByIdModification The configRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeConfigRelatedByIdModification($configRelatedByIdModification)
    {
        if ($this->getConfigsRelatedByIdModification()->contains($configRelatedByIdModification)) {
            $this->collConfigsRelatedByIdModification->remove($this->collConfigsRelatedByIdModification->search($configRelatedByIdModification));
            if (null === $this->configsRelatedByIdModificationScheduledForDeletion) {
                $this->configsRelatedByIdModificationScheduledForDeletion = clone $this->collConfigsRelatedByIdModification;
                $this->configsRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->configsRelatedByIdModificationScheduledForDeletion[]= $configRelatedByIdModification;
            $configRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getConfigsRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ConfigQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getConfigsRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collApiRbacsRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addApiRbacsRelatedByIdCreation()
     */
    public function clearApiRbacsRelatedByIdCreation()
    {
        $this->collApiRbacsRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collApiRbacsRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collApiRbacsRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialApiRbacsRelatedByIdCreation($v = true)
    {
        $this->collApiRbacsRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collApiRbacsRelatedByIdCreation collection.
     *
     * By default this just sets the collApiRbacsRelatedByIdCreation collection to an empty array (like clearcollApiRbacsRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initApiRbacsRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collApiRbacsRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collApiRbacsRelatedByIdCreation = new PropelObjectCollection();
        $this->collApiRbacsRelatedByIdCreation->setModel('ApiRbac');
    }

    /**
     * Gets an array of ApiRbac objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ApiRbac[] List of ApiRbac objects
     * @throws PropelException
     */
    public function getApiRbacsRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collApiRbacsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collApiRbacsRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collApiRbacsRelatedByIdCreation) {
                // return empty collection
                $this->initApiRbacsRelatedByIdCreation();
            } else {
                $collApiRbacsRelatedByIdCreation = ApiRbacQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collApiRbacsRelatedByIdCreationPartial && count($collApiRbacsRelatedByIdCreation)) {
                      $this->initApiRbacsRelatedByIdCreation(false);

                      foreach ($collApiRbacsRelatedByIdCreation as $obj) {
                        if (false == $this->collApiRbacsRelatedByIdCreation->contains($obj)) {
                          $this->collApiRbacsRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collApiRbacsRelatedByIdCreationPartial = true;
                    }

                    $collApiRbacsRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collApiRbacsRelatedByIdCreation;
                }

                if ($partial && $this->collApiRbacsRelatedByIdCreation) {
                    foreach ($this->collApiRbacsRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collApiRbacsRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collApiRbacsRelatedByIdCreation = $collApiRbacsRelatedByIdCreation;
                $this->collApiRbacsRelatedByIdCreationPartial = false;
            }
        }

        return $this->collApiRbacsRelatedByIdCreation;
    }

    /**
     * Sets a collection of ApiRbacRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $apiRbacsRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setApiRbacsRelatedByIdCreation(PropelCollection $apiRbacsRelatedByIdCreation, PropelPDO $con = null)
    {
        $apiRbacsRelatedByIdCreationToDelete = $this->getApiRbacsRelatedByIdCreation(new Criteria(), $con)->diff($apiRbacsRelatedByIdCreation);


        $this->apiRbacsRelatedByIdCreationScheduledForDeletion = $apiRbacsRelatedByIdCreationToDelete;

        foreach ($apiRbacsRelatedByIdCreationToDelete as $apiRbacRelatedByIdCreationRemoved) {
            $apiRbacRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collApiRbacsRelatedByIdCreation = null;
        foreach ($apiRbacsRelatedByIdCreation as $apiRbacRelatedByIdCreation) {
            $this->addApiRbacRelatedByIdCreation($apiRbacRelatedByIdCreation);
        }

        $this->collApiRbacsRelatedByIdCreation = $apiRbacsRelatedByIdCreation;
        $this->collApiRbacsRelatedByIdCreationPartial = false;

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
    public function countApiRbacsRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collApiRbacsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collApiRbacsRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collApiRbacsRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getApiRbacsRelatedByIdCreation());
            }
            $query = ApiRbacQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collApiRbacsRelatedByIdCreation);
    }

    /**
     * Method called to associate a ApiRbac object to this object
     * through the ApiRbac foreign key attribute.
     *
     * @param    ApiRbac $l ApiRbac
     * @return Authy The current object (for fluent API support)
     */
    public function addApiRbacRelatedByIdCreation(ApiRbac $l)
    {
        if ($this->collApiRbacsRelatedByIdCreation === null) {
            $this->initApiRbacsRelatedByIdCreation();
            $this->collApiRbacsRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collApiRbacsRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddApiRbacRelatedByIdCreation($l);

            if ($this->apiRbacsRelatedByIdCreationScheduledForDeletion and $this->apiRbacsRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->apiRbacsRelatedByIdCreationScheduledForDeletion->remove($this->apiRbacsRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ApiRbacRelatedByIdCreation $apiRbacRelatedByIdCreation The apiRbacRelatedByIdCreation object to add.
     */
    protected function doAddApiRbacRelatedByIdCreation($apiRbacRelatedByIdCreation)
    {
        $this->collApiRbacsRelatedByIdCreation[]= $apiRbacRelatedByIdCreation;
        $apiRbacRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	ApiRbacRelatedByIdCreation $apiRbacRelatedByIdCreation The apiRbacRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeApiRbacRelatedByIdCreation($apiRbacRelatedByIdCreation)
    {
        if ($this->getApiRbacsRelatedByIdCreation()->contains($apiRbacRelatedByIdCreation)) {
            $this->collApiRbacsRelatedByIdCreation->remove($this->collApiRbacsRelatedByIdCreation->search($apiRbacRelatedByIdCreation));
            if (null === $this->apiRbacsRelatedByIdCreationScheduledForDeletion) {
                $this->apiRbacsRelatedByIdCreationScheduledForDeletion = clone $this->collApiRbacsRelatedByIdCreation;
                $this->apiRbacsRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->apiRbacsRelatedByIdCreationScheduledForDeletion[]= $apiRbacRelatedByIdCreation;
            $apiRbacRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getApiRbacsRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ApiRbacQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getApiRbacsRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collApiRbacsRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addApiRbacsRelatedByIdModification()
     */
    public function clearApiRbacsRelatedByIdModification()
    {
        $this->collApiRbacsRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collApiRbacsRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collApiRbacsRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialApiRbacsRelatedByIdModification($v = true)
    {
        $this->collApiRbacsRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collApiRbacsRelatedByIdModification collection.
     *
     * By default this just sets the collApiRbacsRelatedByIdModification collection to an empty array (like clearcollApiRbacsRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initApiRbacsRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collApiRbacsRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collApiRbacsRelatedByIdModification = new PropelObjectCollection();
        $this->collApiRbacsRelatedByIdModification->setModel('ApiRbac');
    }

    /**
     * Gets an array of ApiRbac objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ApiRbac[] List of ApiRbac objects
     * @throws PropelException
     */
    public function getApiRbacsRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collApiRbacsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collApiRbacsRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collApiRbacsRelatedByIdModification) {
                // return empty collection
                $this->initApiRbacsRelatedByIdModification();
            } else {
                $collApiRbacsRelatedByIdModification = ApiRbacQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collApiRbacsRelatedByIdModificationPartial && count($collApiRbacsRelatedByIdModification)) {
                      $this->initApiRbacsRelatedByIdModification(false);

                      foreach ($collApiRbacsRelatedByIdModification as $obj) {
                        if (false == $this->collApiRbacsRelatedByIdModification->contains($obj)) {
                          $this->collApiRbacsRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collApiRbacsRelatedByIdModificationPartial = true;
                    }

                    $collApiRbacsRelatedByIdModification->getInternalIterator()->rewind();

                    return $collApiRbacsRelatedByIdModification;
                }

                if ($partial && $this->collApiRbacsRelatedByIdModification) {
                    foreach ($this->collApiRbacsRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collApiRbacsRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collApiRbacsRelatedByIdModification = $collApiRbacsRelatedByIdModification;
                $this->collApiRbacsRelatedByIdModificationPartial = false;
            }
        }

        return $this->collApiRbacsRelatedByIdModification;
    }

    /**
     * Sets a collection of ApiRbacRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $apiRbacsRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setApiRbacsRelatedByIdModification(PropelCollection $apiRbacsRelatedByIdModification, PropelPDO $con = null)
    {
        $apiRbacsRelatedByIdModificationToDelete = $this->getApiRbacsRelatedByIdModification(new Criteria(), $con)->diff($apiRbacsRelatedByIdModification);


        $this->apiRbacsRelatedByIdModificationScheduledForDeletion = $apiRbacsRelatedByIdModificationToDelete;

        foreach ($apiRbacsRelatedByIdModificationToDelete as $apiRbacRelatedByIdModificationRemoved) {
            $apiRbacRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collApiRbacsRelatedByIdModification = null;
        foreach ($apiRbacsRelatedByIdModification as $apiRbacRelatedByIdModification) {
            $this->addApiRbacRelatedByIdModification($apiRbacRelatedByIdModification);
        }

        $this->collApiRbacsRelatedByIdModification = $apiRbacsRelatedByIdModification;
        $this->collApiRbacsRelatedByIdModificationPartial = false;

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
    public function countApiRbacsRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collApiRbacsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collApiRbacsRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collApiRbacsRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getApiRbacsRelatedByIdModification());
            }
            $query = ApiRbacQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collApiRbacsRelatedByIdModification);
    }

    /**
     * Method called to associate a ApiRbac object to this object
     * through the ApiRbac foreign key attribute.
     *
     * @param    ApiRbac $l ApiRbac
     * @return Authy The current object (for fluent API support)
     */
    public function addApiRbacRelatedByIdModification(ApiRbac $l)
    {
        if ($this->collApiRbacsRelatedByIdModification === null) {
            $this->initApiRbacsRelatedByIdModification();
            $this->collApiRbacsRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collApiRbacsRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddApiRbacRelatedByIdModification($l);

            if ($this->apiRbacsRelatedByIdModificationScheduledForDeletion and $this->apiRbacsRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->apiRbacsRelatedByIdModificationScheduledForDeletion->remove($this->apiRbacsRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ApiRbacRelatedByIdModification $apiRbacRelatedByIdModification The apiRbacRelatedByIdModification object to add.
     */
    protected function doAddApiRbacRelatedByIdModification($apiRbacRelatedByIdModification)
    {
        $this->collApiRbacsRelatedByIdModification[]= $apiRbacRelatedByIdModification;
        $apiRbacRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	ApiRbacRelatedByIdModification $apiRbacRelatedByIdModification The apiRbacRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeApiRbacRelatedByIdModification($apiRbacRelatedByIdModification)
    {
        if ($this->getApiRbacsRelatedByIdModification()->contains($apiRbacRelatedByIdModification)) {
            $this->collApiRbacsRelatedByIdModification->remove($this->collApiRbacsRelatedByIdModification->search($apiRbacRelatedByIdModification));
            if (null === $this->apiRbacsRelatedByIdModificationScheduledForDeletion) {
                $this->apiRbacsRelatedByIdModificationScheduledForDeletion = clone $this->collApiRbacsRelatedByIdModification;
                $this->apiRbacsRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->apiRbacsRelatedByIdModificationScheduledForDeletion[]= $apiRbacRelatedByIdModification;
            $apiRbacRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getApiRbacsRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ApiRbacQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getApiRbacsRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collApiLogs collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addApiLogs()
     */
    public function clearApiLogs()
    {
        $this->collApiLogs = null; // important to set this to null since that means it is uninitialized
        $this->collApiLogsPartial = null;

        return $this;
    }

    /**
     * reset is the collApiLogs collection loaded partially
     *
     * @return void
     */
    public function resetPartialApiLogs($v = true)
    {
        $this->collApiLogsPartial = $v;
    }

    /**
     * Initializes the collApiLogs collection.
     *
     * By default this just sets the collApiLogs collection to an empty array (like clearcollApiLogs());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initApiLogs($overrideExisting = true)
    {
        if (null !== $this->collApiLogs && !$overrideExisting) {
            return;
        }
        $this->collApiLogs = new PropelObjectCollection();
        $this->collApiLogs->setModel('ApiLog');
    }

    /**
     * Gets an array of ApiLog objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ApiLog[] List of ApiLog objects
     * @throws PropelException
     */
    public function getApiLogs($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collApiLogsPartial && !$this->isNew();
        if (null === $this->collApiLogs || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collApiLogs) {
                // return empty collection
                $this->initApiLogs();
            } else {
                $collApiLogs = ApiLogQuery::create(null, $criteria)
                    ->filterByAuthy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collApiLogsPartial && count($collApiLogs)) {
                      $this->initApiLogs(false);

                      foreach ($collApiLogs as $obj) {
                        if (false == $this->collApiLogs->contains($obj)) {
                          $this->collApiLogs->append($obj);
                        }
                      }

                      $this->collApiLogsPartial = true;
                    }

                    $collApiLogs->getInternalIterator()->rewind();

                    return $collApiLogs;
                }

                if ($partial && $this->collApiLogs) {
                    foreach ($this->collApiLogs as $obj) {
                        if ($obj->isNew()) {
                            $collApiLogs[] = $obj;
                        }
                    }
                }

                $this->collApiLogs = $collApiLogs;
                $this->collApiLogsPartial = false;
            }
        }

        return $this->collApiLogs;
    }

    /**
     * Sets a collection of ApiLog objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $apiLogs A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setApiLogs(PropelCollection $apiLogs, PropelPDO $con = null)
    {
        $apiLogsToDelete = $this->getApiLogs(new Criteria(), $con)->diff($apiLogs);


        $this->apiLogsScheduledForDeletion = $apiLogsToDelete;

        foreach ($apiLogsToDelete as $apiLogRemoved) {
            $apiLogRemoved->setAuthy(null);
        }

        $this->collApiLogs = null;
        foreach ($apiLogs as $apiLog) {
            $this->addApiLog($apiLog);
        }

        $this->collApiLogs = $apiLogs;
        $this->collApiLogsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ApiLog objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ApiLog objects.
     * @throws PropelException
     */
    public function countApiLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collApiLogsPartial && !$this->isNew();
        if (null === $this->collApiLogs || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collApiLogs) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getApiLogs());
            }
            $query = ApiLogQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthy($this)
                ->count($con);
        }

        return count($this->collApiLogs);
    }

    /**
     * Method called to associate a ApiLog object to this object
     * through the ApiLog foreign key attribute.
     *
     * @param    ApiLog $l ApiLog
     * @return Authy The current object (for fluent API support)
     */
    public function addApiLog(ApiLog $l)
    {
        if ($this->collApiLogs === null) {
            $this->initApiLogs();
            $this->collApiLogsPartial = true;
        }

        if (!in_array($l, $this->collApiLogs->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddApiLog($l);

            if ($this->apiLogsScheduledForDeletion and $this->apiLogsScheduledForDeletion->contains($l)) {
                $this->apiLogsScheduledForDeletion->remove($this->apiLogsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	ApiLog $apiLog The apiLog object to add.
     */
    protected function doAddApiLog($apiLog)
    {
        $this->collApiLogs[]= $apiLog;
        $apiLog->setAuthy($this);
    }

    /**
     * @param	ApiLog $apiLog The apiLog object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeApiLog($apiLog)
    {
        if ($this->getApiLogs()->contains($apiLog)) {
            $this->collApiLogs->remove($this->collApiLogs->search($apiLog));
            if (null === $this->apiLogsScheduledForDeletion) {
                $this->apiLogsScheduledForDeletion = clone $this->collApiLogs;
                $this->apiLogsScheduledForDeletion->clear();
            }
            $this->apiLogsScheduledForDeletion[]= $apiLog;
            $apiLog->setAuthy(null);
        }

        return $this;
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ApiLog[] List of ApiLog objects
     */
    public function getApiLogsJoinApiRbac($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ApiLogQuery::create(null, $criteria);
        $query->joinWith('ApiRbac', $join_behavior);

        return $this->getApiLogs($query, $con);
    }

    /**
     * Clears out the collTemplatesRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addTemplatesRelatedByIdCreation()
     */
    public function clearTemplatesRelatedByIdCreation()
    {
        $this->collTemplatesRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collTemplatesRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collTemplatesRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialTemplatesRelatedByIdCreation($v = true)
    {
        $this->collTemplatesRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collTemplatesRelatedByIdCreation collection.
     *
     * By default this just sets the collTemplatesRelatedByIdCreation collection to an empty array (like clearcollTemplatesRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTemplatesRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collTemplatesRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collTemplatesRelatedByIdCreation = new PropelObjectCollection();
        $this->collTemplatesRelatedByIdCreation->setModel('Template');
    }

    /**
     * Gets an array of Template objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Template[] List of Template objects
     * @throws PropelException
     */
    public function getTemplatesRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTemplatesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collTemplatesRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTemplatesRelatedByIdCreation) {
                // return empty collection
                $this->initTemplatesRelatedByIdCreation();
            } else {
                $collTemplatesRelatedByIdCreation = TemplateQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTemplatesRelatedByIdCreationPartial && count($collTemplatesRelatedByIdCreation)) {
                      $this->initTemplatesRelatedByIdCreation(false);

                      foreach ($collTemplatesRelatedByIdCreation as $obj) {
                        if (false == $this->collTemplatesRelatedByIdCreation->contains($obj)) {
                          $this->collTemplatesRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collTemplatesRelatedByIdCreationPartial = true;
                    }

                    $collTemplatesRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collTemplatesRelatedByIdCreation;
                }

                if ($partial && $this->collTemplatesRelatedByIdCreation) {
                    foreach ($this->collTemplatesRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collTemplatesRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collTemplatesRelatedByIdCreation = $collTemplatesRelatedByIdCreation;
                $this->collTemplatesRelatedByIdCreationPartial = false;
            }
        }

        return $this->collTemplatesRelatedByIdCreation;
    }

    /**
     * Sets a collection of TemplateRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $templatesRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setTemplatesRelatedByIdCreation(PropelCollection $templatesRelatedByIdCreation, PropelPDO $con = null)
    {
        $templatesRelatedByIdCreationToDelete = $this->getTemplatesRelatedByIdCreation(new Criteria(), $con)->diff($templatesRelatedByIdCreation);


        $this->templatesRelatedByIdCreationScheduledForDeletion = $templatesRelatedByIdCreationToDelete;

        foreach ($templatesRelatedByIdCreationToDelete as $templateRelatedByIdCreationRemoved) {
            $templateRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collTemplatesRelatedByIdCreation = null;
        foreach ($templatesRelatedByIdCreation as $templateRelatedByIdCreation) {
            $this->addTemplateRelatedByIdCreation($templateRelatedByIdCreation);
        }

        $this->collTemplatesRelatedByIdCreation = $templatesRelatedByIdCreation;
        $this->collTemplatesRelatedByIdCreationPartial = false;

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
    public function countTemplatesRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTemplatesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collTemplatesRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTemplatesRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTemplatesRelatedByIdCreation());
            }
            $query = TemplateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collTemplatesRelatedByIdCreation);
    }

    /**
     * Method called to associate a Template object to this object
     * through the Template foreign key attribute.
     *
     * @param    Template $l Template
     * @return Authy The current object (for fluent API support)
     */
    public function addTemplateRelatedByIdCreation(Template $l)
    {
        if ($this->collTemplatesRelatedByIdCreation === null) {
            $this->initTemplatesRelatedByIdCreation();
            $this->collTemplatesRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collTemplatesRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTemplateRelatedByIdCreation($l);

            if ($this->templatesRelatedByIdCreationScheduledForDeletion and $this->templatesRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->templatesRelatedByIdCreationScheduledForDeletion->remove($this->templatesRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TemplateRelatedByIdCreation $templateRelatedByIdCreation The templateRelatedByIdCreation object to add.
     */
    protected function doAddTemplateRelatedByIdCreation($templateRelatedByIdCreation)
    {
        $this->collTemplatesRelatedByIdCreation[]= $templateRelatedByIdCreation;
        $templateRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	TemplateRelatedByIdCreation $templateRelatedByIdCreation The templateRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeTemplateRelatedByIdCreation($templateRelatedByIdCreation)
    {
        if ($this->getTemplatesRelatedByIdCreation()->contains($templateRelatedByIdCreation)) {
            $this->collTemplatesRelatedByIdCreation->remove($this->collTemplatesRelatedByIdCreation->search($templateRelatedByIdCreation));
            if (null === $this->templatesRelatedByIdCreationScheduledForDeletion) {
                $this->templatesRelatedByIdCreationScheduledForDeletion = clone $this->collTemplatesRelatedByIdCreation;
                $this->templatesRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->templatesRelatedByIdCreationScheduledForDeletion[]= $templateRelatedByIdCreation;
            $templateRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getTemplatesRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getTemplatesRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collTemplatesRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addTemplatesRelatedByIdModification()
     */
    public function clearTemplatesRelatedByIdModification()
    {
        $this->collTemplatesRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collTemplatesRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collTemplatesRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialTemplatesRelatedByIdModification($v = true)
    {
        $this->collTemplatesRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collTemplatesRelatedByIdModification collection.
     *
     * By default this just sets the collTemplatesRelatedByIdModification collection to an empty array (like clearcollTemplatesRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTemplatesRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collTemplatesRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collTemplatesRelatedByIdModification = new PropelObjectCollection();
        $this->collTemplatesRelatedByIdModification->setModel('Template');
    }

    /**
     * Gets an array of Template objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Template[] List of Template objects
     * @throws PropelException
     */
    public function getTemplatesRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTemplatesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collTemplatesRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTemplatesRelatedByIdModification) {
                // return empty collection
                $this->initTemplatesRelatedByIdModification();
            } else {
                $collTemplatesRelatedByIdModification = TemplateQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTemplatesRelatedByIdModificationPartial && count($collTemplatesRelatedByIdModification)) {
                      $this->initTemplatesRelatedByIdModification(false);

                      foreach ($collTemplatesRelatedByIdModification as $obj) {
                        if (false == $this->collTemplatesRelatedByIdModification->contains($obj)) {
                          $this->collTemplatesRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collTemplatesRelatedByIdModificationPartial = true;
                    }

                    $collTemplatesRelatedByIdModification->getInternalIterator()->rewind();

                    return $collTemplatesRelatedByIdModification;
                }

                if ($partial && $this->collTemplatesRelatedByIdModification) {
                    foreach ($this->collTemplatesRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collTemplatesRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collTemplatesRelatedByIdModification = $collTemplatesRelatedByIdModification;
                $this->collTemplatesRelatedByIdModificationPartial = false;
            }
        }

        return $this->collTemplatesRelatedByIdModification;
    }

    /**
     * Sets a collection of TemplateRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $templatesRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setTemplatesRelatedByIdModification(PropelCollection $templatesRelatedByIdModification, PropelPDO $con = null)
    {
        $templatesRelatedByIdModificationToDelete = $this->getTemplatesRelatedByIdModification(new Criteria(), $con)->diff($templatesRelatedByIdModification);


        $this->templatesRelatedByIdModificationScheduledForDeletion = $templatesRelatedByIdModificationToDelete;

        foreach ($templatesRelatedByIdModificationToDelete as $templateRelatedByIdModificationRemoved) {
            $templateRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collTemplatesRelatedByIdModification = null;
        foreach ($templatesRelatedByIdModification as $templateRelatedByIdModification) {
            $this->addTemplateRelatedByIdModification($templateRelatedByIdModification);
        }

        $this->collTemplatesRelatedByIdModification = $templatesRelatedByIdModification;
        $this->collTemplatesRelatedByIdModificationPartial = false;

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
    public function countTemplatesRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTemplatesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collTemplatesRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTemplatesRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTemplatesRelatedByIdModification());
            }
            $query = TemplateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collTemplatesRelatedByIdModification);
    }

    /**
     * Method called to associate a Template object to this object
     * through the Template foreign key attribute.
     *
     * @param    Template $l Template
     * @return Authy The current object (for fluent API support)
     */
    public function addTemplateRelatedByIdModification(Template $l)
    {
        if ($this->collTemplatesRelatedByIdModification === null) {
            $this->initTemplatesRelatedByIdModification();
            $this->collTemplatesRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collTemplatesRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTemplateRelatedByIdModification($l);

            if ($this->templatesRelatedByIdModificationScheduledForDeletion and $this->templatesRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->templatesRelatedByIdModificationScheduledForDeletion->remove($this->templatesRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TemplateRelatedByIdModification $templateRelatedByIdModification The templateRelatedByIdModification object to add.
     */
    protected function doAddTemplateRelatedByIdModification($templateRelatedByIdModification)
    {
        $this->collTemplatesRelatedByIdModification[]= $templateRelatedByIdModification;
        $templateRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	TemplateRelatedByIdModification $templateRelatedByIdModification The templateRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeTemplateRelatedByIdModification($templateRelatedByIdModification)
    {
        if ($this->getTemplatesRelatedByIdModification()->contains($templateRelatedByIdModification)) {
            $this->collTemplatesRelatedByIdModification->remove($this->collTemplatesRelatedByIdModification->search($templateRelatedByIdModification));
            if (null === $this->templatesRelatedByIdModificationScheduledForDeletion) {
                $this->templatesRelatedByIdModificationScheduledForDeletion = clone $this->collTemplatesRelatedByIdModification;
                $this->templatesRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->templatesRelatedByIdModificationScheduledForDeletion[]= $templateRelatedByIdModification;
            $templateRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getTemplatesRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getTemplatesRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collTemplateFilesRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addTemplateFilesRelatedByIdCreation()
     */
    public function clearTemplateFilesRelatedByIdCreation()
    {
        $this->collTemplateFilesRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collTemplateFilesRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collTemplateFilesRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialTemplateFilesRelatedByIdCreation($v = true)
    {
        $this->collTemplateFilesRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collTemplateFilesRelatedByIdCreation collection.
     *
     * By default this just sets the collTemplateFilesRelatedByIdCreation collection to an empty array (like clearcollTemplateFilesRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTemplateFilesRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collTemplateFilesRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collTemplateFilesRelatedByIdCreation = new PropelObjectCollection();
        $this->collTemplateFilesRelatedByIdCreation->setModel('TemplateFile');
    }

    /**
     * Gets an array of TemplateFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TemplateFile[] List of TemplateFile objects
     * @throws PropelException
     */
    public function getTemplateFilesRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTemplateFilesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collTemplateFilesRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTemplateFilesRelatedByIdCreation) {
                // return empty collection
                $this->initTemplateFilesRelatedByIdCreation();
            } else {
                $collTemplateFilesRelatedByIdCreation = TemplateFileQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTemplateFilesRelatedByIdCreationPartial && count($collTemplateFilesRelatedByIdCreation)) {
                      $this->initTemplateFilesRelatedByIdCreation(false);

                      foreach ($collTemplateFilesRelatedByIdCreation as $obj) {
                        if (false == $this->collTemplateFilesRelatedByIdCreation->contains($obj)) {
                          $this->collTemplateFilesRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collTemplateFilesRelatedByIdCreationPartial = true;
                    }

                    $collTemplateFilesRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collTemplateFilesRelatedByIdCreation;
                }

                if ($partial && $this->collTemplateFilesRelatedByIdCreation) {
                    foreach ($this->collTemplateFilesRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collTemplateFilesRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collTemplateFilesRelatedByIdCreation = $collTemplateFilesRelatedByIdCreation;
                $this->collTemplateFilesRelatedByIdCreationPartial = false;
            }
        }

        return $this->collTemplateFilesRelatedByIdCreation;
    }

    /**
     * Sets a collection of TemplateFileRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $templateFilesRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setTemplateFilesRelatedByIdCreation(PropelCollection $templateFilesRelatedByIdCreation, PropelPDO $con = null)
    {
        $templateFilesRelatedByIdCreationToDelete = $this->getTemplateFilesRelatedByIdCreation(new Criteria(), $con)->diff($templateFilesRelatedByIdCreation);


        $this->templateFilesRelatedByIdCreationScheduledForDeletion = $templateFilesRelatedByIdCreationToDelete;

        foreach ($templateFilesRelatedByIdCreationToDelete as $templateFileRelatedByIdCreationRemoved) {
            $templateFileRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collTemplateFilesRelatedByIdCreation = null;
        foreach ($templateFilesRelatedByIdCreation as $templateFileRelatedByIdCreation) {
            $this->addTemplateFileRelatedByIdCreation($templateFileRelatedByIdCreation);
        }

        $this->collTemplateFilesRelatedByIdCreation = $templateFilesRelatedByIdCreation;
        $this->collTemplateFilesRelatedByIdCreationPartial = false;

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
    public function countTemplateFilesRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTemplateFilesRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collTemplateFilesRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTemplateFilesRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTemplateFilesRelatedByIdCreation());
            }
            $query = TemplateFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collTemplateFilesRelatedByIdCreation);
    }

    /**
     * Method called to associate a TemplateFile object to this object
     * through the TemplateFile foreign key attribute.
     *
     * @param    TemplateFile $l TemplateFile
     * @return Authy The current object (for fluent API support)
     */
    public function addTemplateFileRelatedByIdCreation(TemplateFile $l)
    {
        if ($this->collTemplateFilesRelatedByIdCreation === null) {
            $this->initTemplateFilesRelatedByIdCreation();
            $this->collTemplateFilesRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collTemplateFilesRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTemplateFileRelatedByIdCreation($l);

            if ($this->templateFilesRelatedByIdCreationScheduledForDeletion and $this->templateFilesRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->templateFilesRelatedByIdCreationScheduledForDeletion->remove($this->templateFilesRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TemplateFileRelatedByIdCreation $templateFileRelatedByIdCreation The templateFileRelatedByIdCreation object to add.
     */
    protected function doAddTemplateFileRelatedByIdCreation($templateFileRelatedByIdCreation)
    {
        $this->collTemplateFilesRelatedByIdCreation[]= $templateFileRelatedByIdCreation;
        $templateFileRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	TemplateFileRelatedByIdCreation $templateFileRelatedByIdCreation The templateFileRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeTemplateFileRelatedByIdCreation($templateFileRelatedByIdCreation)
    {
        if ($this->getTemplateFilesRelatedByIdCreation()->contains($templateFileRelatedByIdCreation)) {
            $this->collTemplateFilesRelatedByIdCreation->remove($this->collTemplateFilesRelatedByIdCreation->search($templateFileRelatedByIdCreation));
            if (null === $this->templateFilesRelatedByIdCreationScheduledForDeletion) {
                $this->templateFilesRelatedByIdCreationScheduledForDeletion = clone $this->collTemplateFilesRelatedByIdCreation;
                $this->templateFilesRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->templateFilesRelatedByIdCreationScheduledForDeletion[]= $templateFileRelatedByIdCreation;
            $templateFileRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getTemplateFilesRelatedByIdCreationJoinTemplate($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateFileQuery::create(null, $criteria);
        $query->joinWith('Template', $join_behavior);

        return $this->getTemplateFilesRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TemplateFile[] List of TemplateFile objects
     */
    public function getTemplateFilesRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateFileQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getTemplateFilesRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collTemplateFilesRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addTemplateFilesRelatedByIdModification()
     */
    public function clearTemplateFilesRelatedByIdModification()
    {
        $this->collTemplateFilesRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collTemplateFilesRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collTemplateFilesRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialTemplateFilesRelatedByIdModification($v = true)
    {
        $this->collTemplateFilesRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collTemplateFilesRelatedByIdModification collection.
     *
     * By default this just sets the collTemplateFilesRelatedByIdModification collection to an empty array (like clearcollTemplateFilesRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTemplateFilesRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collTemplateFilesRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collTemplateFilesRelatedByIdModification = new PropelObjectCollection();
        $this->collTemplateFilesRelatedByIdModification->setModel('TemplateFile');
    }

    /**
     * Gets an array of TemplateFile objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TemplateFile[] List of TemplateFile objects
     * @throws PropelException
     */
    public function getTemplateFilesRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTemplateFilesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collTemplateFilesRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTemplateFilesRelatedByIdModification) {
                // return empty collection
                $this->initTemplateFilesRelatedByIdModification();
            } else {
                $collTemplateFilesRelatedByIdModification = TemplateFileQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTemplateFilesRelatedByIdModificationPartial && count($collTemplateFilesRelatedByIdModification)) {
                      $this->initTemplateFilesRelatedByIdModification(false);

                      foreach ($collTemplateFilesRelatedByIdModification as $obj) {
                        if (false == $this->collTemplateFilesRelatedByIdModification->contains($obj)) {
                          $this->collTemplateFilesRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collTemplateFilesRelatedByIdModificationPartial = true;
                    }

                    $collTemplateFilesRelatedByIdModification->getInternalIterator()->rewind();

                    return $collTemplateFilesRelatedByIdModification;
                }

                if ($partial && $this->collTemplateFilesRelatedByIdModification) {
                    foreach ($this->collTemplateFilesRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collTemplateFilesRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collTemplateFilesRelatedByIdModification = $collTemplateFilesRelatedByIdModification;
                $this->collTemplateFilesRelatedByIdModificationPartial = false;
            }
        }

        return $this->collTemplateFilesRelatedByIdModification;
    }

    /**
     * Sets a collection of TemplateFileRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $templateFilesRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setTemplateFilesRelatedByIdModification(PropelCollection $templateFilesRelatedByIdModification, PropelPDO $con = null)
    {
        $templateFilesRelatedByIdModificationToDelete = $this->getTemplateFilesRelatedByIdModification(new Criteria(), $con)->diff($templateFilesRelatedByIdModification);


        $this->templateFilesRelatedByIdModificationScheduledForDeletion = $templateFilesRelatedByIdModificationToDelete;

        foreach ($templateFilesRelatedByIdModificationToDelete as $templateFileRelatedByIdModificationRemoved) {
            $templateFileRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collTemplateFilesRelatedByIdModification = null;
        foreach ($templateFilesRelatedByIdModification as $templateFileRelatedByIdModification) {
            $this->addTemplateFileRelatedByIdModification($templateFileRelatedByIdModification);
        }

        $this->collTemplateFilesRelatedByIdModification = $templateFilesRelatedByIdModification;
        $this->collTemplateFilesRelatedByIdModificationPartial = false;

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
    public function countTemplateFilesRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTemplateFilesRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collTemplateFilesRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTemplateFilesRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTemplateFilesRelatedByIdModification());
            }
            $query = TemplateFileQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collTemplateFilesRelatedByIdModification);
    }

    /**
     * Method called to associate a TemplateFile object to this object
     * through the TemplateFile foreign key attribute.
     *
     * @param    TemplateFile $l TemplateFile
     * @return Authy The current object (for fluent API support)
     */
    public function addTemplateFileRelatedByIdModification(TemplateFile $l)
    {
        if ($this->collTemplateFilesRelatedByIdModification === null) {
            $this->initTemplateFilesRelatedByIdModification();
            $this->collTemplateFilesRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collTemplateFilesRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTemplateFileRelatedByIdModification($l);

            if ($this->templateFilesRelatedByIdModificationScheduledForDeletion and $this->templateFilesRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->templateFilesRelatedByIdModificationScheduledForDeletion->remove($this->templateFilesRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TemplateFileRelatedByIdModification $templateFileRelatedByIdModification The templateFileRelatedByIdModification object to add.
     */
    protected function doAddTemplateFileRelatedByIdModification($templateFileRelatedByIdModification)
    {
        $this->collTemplateFilesRelatedByIdModification[]= $templateFileRelatedByIdModification;
        $templateFileRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	TemplateFileRelatedByIdModification $templateFileRelatedByIdModification The templateFileRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeTemplateFileRelatedByIdModification($templateFileRelatedByIdModification)
    {
        if ($this->getTemplateFilesRelatedByIdModification()->contains($templateFileRelatedByIdModification)) {
            $this->collTemplateFilesRelatedByIdModification->remove($this->collTemplateFilesRelatedByIdModification->search($templateFileRelatedByIdModification));
            if (null === $this->templateFilesRelatedByIdModificationScheduledForDeletion) {
                $this->templateFilesRelatedByIdModificationScheduledForDeletion = clone $this->collTemplateFilesRelatedByIdModification;
                $this->templateFilesRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->templateFilesRelatedByIdModificationScheduledForDeletion[]= $templateFileRelatedByIdModification;
            $templateFileRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getTemplateFilesRelatedByIdModificationJoinTemplate($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateFileQuery::create(null, $criteria);
        $query->joinWith('Template', $join_behavior);

        return $this->getTemplateFilesRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|TemplateFile[] List of TemplateFile objects
     */
    public function getTemplateFilesRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TemplateFileQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getTemplateFilesRelatedByIdModification($query, $con);
    }

    /**
     * Clears out the collMessageI18nsRelatedByIdCreation collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addMessageI18nsRelatedByIdCreation()
     */
    public function clearMessageI18nsRelatedByIdCreation()
    {
        $this->collMessageI18nsRelatedByIdCreation = null; // important to set this to null since that means it is uninitialized
        $this->collMessageI18nsRelatedByIdCreationPartial = null;

        return $this;
    }

    /**
     * reset is the collMessageI18nsRelatedByIdCreation collection loaded partially
     *
     * @return void
     */
    public function resetPartialMessageI18nsRelatedByIdCreation($v = true)
    {
        $this->collMessageI18nsRelatedByIdCreationPartial = $v;
    }

    /**
     * Initializes the collMessageI18nsRelatedByIdCreation collection.
     *
     * By default this just sets the collMessageI18nsRelatedByIdCreation collection to an empty array (like clearcollMessageI18nsRelatedByIdCreation());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMessageI18nsRelatedByIdCreation($overrideExisting = true)
    {
        if (null !== $this->collMessageI18nsRelatedByIdCreation && !$overrideExisting) {
            return;
        }
        $this->collMessageI18nsRelatedByIdCreation = new PropelObjectCollection();
        $this->collMessageI18nsRelatedByIdCreation->setModel('MessageI18n');
    }

    /**
     * Gets an array of MessageI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|MessageI18n[] List of MessageI18n objects
     * @throws PropelException
     */
    public function getMessageI18nsRelatedByIdCreation($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMessageI18nsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collMessageI18nsRelatedByIdCreation || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMessageI18nsRelatedByIdCreation) {
                // return empty collection
                $this->initMessageI18nsRelatedByIdCreation();
            } else {
                $collMessageI18nsRelatedByIdCreation = MessageI18nQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdCreation($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMessageI18nsRelatedByIdCreationPartial && count($collMessageI18nsRelatedByIdCreation)) {
                      $this->initMessageI18nsRelatedByIdCreation(false);

                      foreach ($collMessageI18nsRelatedByIdCreation as $obj) {
                        if (false == $this->collMessageI18nsRelatedByIdCreation->contains($obj)) {
                          $this->collMessageI18nsRelatedByIdCreation->append($obj);
                        }
                      }

                      $this->collMessageI18nsRelatedByIdCreationPartial = true;
                    }

                    $collMessageI18nsRelatedByIdCreation->getInternalIterator()->rewind();

                    return $collMessageI18nsRelatedByIdCreation;
                }

                if ($partial && $this->collMessageI18nsRelatedByIdCreation) {
                    foreach ($this->collMessageI18nsRelatedByIdCreation as $obj) {
                        if ($obj->isNew()) {
                            $collMessageI18nsRelatedByIdCreation[] = $obj;
                        }
                    }
                }

                $this->collMessageI18nsRelatedByIdCreation = $collMessageI18nsRelatedByIdCreation;
                $this->collMessageI18nsRelatedByIdCreationPartial = false;
            }
        }

        return $this->collMessageI18nsRelatedByIdCreation;
    }

    /**
     * Sets a collection of MessageI18nRelatedByIdCreation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $messageI18nsRelatedByIdCreation A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setMessageI18nsRelatedByIdCreation(PropelCollection $messageI18nsRelatedByIdCreation, PropelPDO $con = null)
    {
        $messageI18nsRelatedByIdCreationToDelete = $this->getMessageI18nsRelatedByIdCreation(new Criteria(), $con)->diff($messageI18nsRelatedByIdCreation);


        $this->messageI18nsRelatedByIdCreationScheduledForDeletion = $messageI18nsRelatedByIdCreationToDelete;

        foreach ($messageI18nsRelatedByIdCreationToDelete as $messageI18nRelatedByIdCreationRemoved) {
            $messageI18nRelatedByIdCreationRemoved->setAuthyRelatedByIdCreation(null);
        }

        $this->collMessageI18nsRelatedByIdCreation = null;
        foreach ($messageI18nsRelatedByIdCreation as $messageI18nRelatedByIdCreation) {
            $this->addMessageI18nRelatedByIdCreation($messageI18nRelatedByIdCreation);
        }

        $this->collMessageI18nsRelatedByIdCreation = $messageI18nsRelatedByIdCreation;
        $this->collMessageI18nsRelatedByIdCreationPartial = false;

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
    public function countMessageI18nsRelatedByIdCreation(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMessageI18nsRelatedByIdCreationPartial && !$this->isNew();
        if (null === $this->collMessageI18nsRelatedByIdCreation || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMessageI18nsRelatedByIdCreation) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMessageI18nsRelatedByIdCreation());
            }
            $query = MessageI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdCreation($this)
                ->count($con);
        }

        return count($this->collMessageI18nsRelatedByIdCreation);
    }

    /**
     * Method called to associate a MessageI18n object to this object
     * through the MessageI18n foreign key attribute.
     *
     * @param    MessageI18n $l MessageI18n
     * @return Authy The current object (for fluent API support)
     */
    public function addMessageI18nRelatedByIdCreation(MessageI18n $l)
    {
        if ($this->collMessageI18nsRelatedByIdCreation === null) {
            $this->initMessageI18nsRelatedByIdCreation();
            $this->collMessageI18nsRelatedByIdCreationPartial = true;
        }

        if (!in_array($l, $this->collMessageI18nsRelatedByIdCreation->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddMessageI18nRelatedByIdCreation($l);

            if ($this->messageI18nsRelatedByIdCreationScheduledForDeletion and $this->messageI18nsRelatedByIdCreationScheduledForDeletion->contains($l)) {
                $this->messageI18nsRelatedByIdCreationScheduledForDeletion->remove($this->messageI18nsRelatedByIdCreationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	MessageI18nRelatedByIdCreation $messageI18nRelatedByIdCreation The messageI18nRelatedByIdCreation object to add.
     */
    protected function doAddMessageI18nRelatedByIdCreation($messageI18nRelatedByIdCreation)
    {
        $this->collMessageI18nsRelatedByIdCreation[]= $messageI18nRelatedByIdCreation;
        $messageI18nRelatedByIdCreation->setAuthyRelatedByIdCreation($this);
    }

    /**
     * @param	MessageI18nRelatedByIdCreation $messageI18nRelatedByIdCreation The messageI18nRelatedByIdCreation object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeMessageI18nRelatedByIdCreation($messageI18nRelatedByIdCreation)
    {
        if ($this->getMessageI18nsRelatedByIdCreation()->contains($messageI18nRelatedByIdCreation)) {
            $this->collMessageI18nsRelatedByIdCreation->remove($this->collMessageI18nsRelatedByIdCreation->search($messageI18nRelatedByIdCreation));
            if (null === $this->messageI18nsRelatedByIdCreationScheduledForDeletion) {
                $this->messageI18nsRelatedByIdCreationScheduledForDeletion = clone $this->collMessageI18nsRelatedByIdCreation;
                $this->messageI18nsRelatedByIdCreationScheduledForDeletion->clear();
            }
            $this->messageI18nsRelatedByIdCreationScheduledForDeletion[]= $messageI18nRelatedByIdCreation;
            $messageI18nRelatedByIdCreation->setAuthyRelatedByIdCreation(null);
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
    public function getMessageI18nsRelatedByIdCreationJoinMessage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MessageI18nQuery::create(null, $criteria);
        $query->joinWith('Message', $join_behavior);

        return $this->getMessageI18nsRelatedByIdCreation($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|MessageI18n[] List of MessageI18n objects
     */
    public function getMessageI18nsRelatedByIdCreationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MessageI18nQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getMessageI18nsRelatedByIdCreation($query, $con);
    }

    /**
     * Clears out the collMessageI18nsRelatedByIdModification collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Authy The current object (for fluent API support)
     * @see        addMessageI18nsRelatedByIdModification()
     */
    public function clearMessageI18nsRelatedByIdModification()
    {
        $this->collMessageI18nsRelatedByIdModification = null; // important to set this to null since that means it is uninitialized
        $this->collMessageI18nsRelatedByIdModificationPartial = null;

        return $this;
    }

    /**
     * reset is the collMessageI18nsRelatedByIdModification collection loaded partially
     *
     * @return void
     */
    public function resetPartialMessageI18nsRelatedByIdModification($v = true)
    {
        $this->collMessageI18nsRelatedByIdModificationPartial = $v;
    }

    /**
     * Initializes the collMessageI18nsRelatedByIdModification collection.
     *
     * By default this just sets the collMessageI18nsRelatedByIdModification collection to an empty array (like clearcollMessageI18nsRelatedByIdModification());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initMessageI18nsRelatedByIdModification($overrideExisting = true)
    {
        if (null !== $this->collMessageI18nsRelatedByIdModification && !$overrideExisting) {
            return;
        }
        $this->collMessageI18nsRelatedByIdModification = new PropelObjectCollection();
        $this->collMessageI18nsRelatedByIdModification->setModel('MessageI18n');
    }

    /**
     * Gets an array of MessageI18n objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Authy is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|MessageI18n[] List of MessageI18n objects
     * @throws PropelException
     */
    public function getMessageI18nsRelatedByIdModification($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collMessageI18nsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collMessageI18nsRelatedByIdModification || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collMessageI18nsRelatedByIdModification) {
                // return empty collection
                $this->initMessageI18nsRelatedByIdModification();
            } else {
                $collMessageI18nsRelatedByIdModification = MessageI18nQuery::create(null, $criteria)
                    ->filterByAuthyRelatedByIdModification($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collMessageI18nsRelatedByIdModificationPartial && count($collMessageI18nsRelatedByIdModification)) {
                      $this->initMessageI18nsRelatedByIdModification(false);

                      foreach ($collMessageI18nsRelatedByIdModification as $obj) {
                        if (false == $this->collMessageI18nsRelatedByIdModification->contains($obj)) {
                          $this->collMessageI18nsRelatedByIdModification->append($obj);
                        }
                      }

                      $this->collMessageI18nsRelatedByIdModificationPartial = true;
                    }

                    $collMessageI18nsRelatedByIdModification->getInternalIterator()->rewind();

                    return $collMessageI18nsRelatedByIdModification;
                }

                if ($partial && $this->collMessageI18nsRelatedByIdModification) {
                    foreach ($this->collMessageI18nsRelatedByIdModification as $obj) {
                        if ($obj->isNew()) {
                            $collMessageI18nsRelatedByIdModification[] = $obj;
                        }
                    }
                }

                $this->collMessageI18nsRelatedByIdModification = $collMessageI18nsRelatedByIdModification;
                $this->collMessageI18nsRelatedByIdModificationPartial = false;
            }
        }

        return $this->collMessageI18nsRelatedByIdModification;
    }

    /**
     * Sets a collection of MessageI18nRelatedByIdModification objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $messageI18nsRelatedByIdModification A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Authy The current object (for fluent API support)
     */
    public function setMessageI18nsRelatedByIdModification(PropelCollection $messageI18nsRelatedByIdModification, PropelPDO $con = null)
    {
        $messageI18nsRelatedByIdModificationToDelete = $this->getMessageI18nsRelatedByIdModification(new Criteria(), $con)->diff($messageI18nsRelatedByIdModification);


        $this->messageI18nsRelatedByIdModificationScheduledForDeletion = $messageI18nsRelatedByIdModificationToDelete;

        foreach ($messageI18nsRelatedByIdModificationToDelete as $messageI18nRelatedByIdModificationRemoved) {
            $messageI18nRelatedByIdModificationRemoved->setAuthyRelatedByIdModification(null);
        }

        $this->collMessageI18nsRelatedByIdModification = null;
        foreach ($messageI18nsRelatedByIdModification as $messageI18nRelatedByIdModification) {
            $this->addMessageI18nRelatedByIdModification($messageI18nRelatedByIdModification);
        }

        $this->collMessageI18nsRelatedByIdModification = $messageI18nsRelatedByIdModification;
        $this->collMessageI18nsRelatedByIdModificationPartial = false;

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
    public function countMessageI18nsRelatedByIdModification(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collMessageI18nsRelatedByIdModificationPartial && !$this->isNew();
        if (null === $this->collMessageI18nsRelatedByIdModification || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collMessageI18nsRelatedByIdModification) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getMessageI18nsRelatedByIdModification());
            }
            $query = MessageI18nQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAuthyRelatedByIdModification($this)
                ->count($con);
        }

        return count($this->collMessageI18nsRelatedByIdModification);
    }

    /**
     * Method called to associate a MessageI18n object to this object
     * through the MessageI18n foreign key attribute.
     *
     * @param    MessageI18n $l MessageI18n
     * @return Authy The current object (for fluent API support)
     */
    public function addMessageI18nRelatedByIdModification(MessageI18n $l)
    {
        if ($this->collMessageI18nsRelatedByIdModification === null) {
            $this->initMessageI18nsRelatedByIdModification();
            $this->collMessageI18nsRelatedByIdModificationPartial = true;
        }

        if (!in_array($l, $this->collMessageI18nsRelatedByIdModification->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddMessageI18nRelatedByIdModification($l);

            if ($this->messageI18nsRelatedByIdModificationScheduledForDeletion and $this->messageI18nsRelatedByIdModificationScheduledForDeletion->contains($l)) {
                $this->messageI18nsRelatedByIdModificationScheduledForDeletion->remove($this->messageI18nsRelatedByIdModificationScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	MessageI18nRelatedByIdModification $messageI18nRelatedByIdModification The messageI18nRelatedByIdModification object to add.
     */
    protected function doAddMessageI18nRelatedByIdModification($messageI18nRelatedByIdModification)
    {
        $this->collMessageI18nsRelatedByIdModification[]= $messageI18nRelatedByIdModification;
        $messageI18nRelatedByIdModification->setAuthyRelatedByIdModification($this);
    }

    /**
     * @param	MessageI18nRelatedByIdModification $messageI18nRelatedByIdModification The messageI18nRelatedByIdModification object to remove.
     * @return Authy The current object (for fluent API support)
     */
    public function removeMessageI18nRelatedByIdModification($messageI18nRelatedByIdModification)
    {
        if ($this->getMessageI18nsRelatedByIdModification()->contains($messageI18nRelatedByIdModification)) {
            $this->collMessageI18nsRelatedByIdModification->remove($this->collMessageI18nsRelatedByIdModification->search($messageI18nRelatedByIdModification));
            if (null === $this->messageI18nsRelatedByIdModificationScheduledForDeletion) {
                $this->messageI18nsRelatedByIdModificationScheduledForDeletion = clone $this->collMessageI18nsRelatedByIdModification;
                $this->messageI18nsRelatedByIdModificationScheduledForDeletion->clear();
            }
            $this->messageI18nsRelatedByIdModificationScheduledForDeletion[]= $messageI18nRelatedByIdModification;
            $messageI18nRelatedByIdModification->setAuthyRelatedByIdModification(null);
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
    public function getMessageI18nsRelatedByIdModificationJoinMessage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MessageI18nQuery::create(null, $criteria);
        $query->joinWith('Message', $join_behavior);

        return $this->getMessageI18nsRelatedByIdModification($query, $con);
    }


    /**

     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|MessageI18n[] List of MessageI18n objects
     */
    public function getMessageI18nsRelatedByIdModificationJoinAuthyGroup($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = MessageI18nQuery::create(null, $criteria);
        $query->joinWith('AuthyGroup', $join_behavior);

        return $this->getMessageI18nsRelatedByIdModification($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id_authy = null;
        $this->validation_key = null;
        $this->username = null;
        $this->fullname = null;
        $this->email = null;
        $this->passwd_hash = null;
        $this->expire = null;
        $this->deactivate = null;
        $this->is_root = null;
        $this->id_authy_group = null;
        $this->is_system = null;
        $this->rights_all = null;
        $this->rights_group = null;
        $this->rights_owner = null;
        $this->onglet = null;
        $this->date_creation = null;
        $this->date_modification = null;
        $this->id_group_creation = null;
        $this->id_creation = null;
        $this->id_modification = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
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
            if ($this->collClientsRelatedByDefaultUser) {
                foreach ($this->collClientsRelatedByDefaultUser as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBillingLinesRelatedByIdAssign) {
                foreach ($this->collBillingLinesRelatedByIdAssign as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthyGroupxes) {
                foreach ($this->collAuthyGroupxes as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthyLogs) {
                foreach ($this->collAuthyLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collClientsRelatedByIdCreation) {
                foreach ($this->collClientsRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collClientsRelatedByIdModification) {
                foreach ($this->collClientsRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBillingsRelatedByIdCreation) {
                foreach ($this->collBillingsRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBillingsRelatedByIdModification) {
                foreach ($this->collBillingsRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBillingLinesRelatedByIdCreation) {
                foreach ($this->collBillingLinesRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBillingLinesRelatedByIdModification) {
                foreach ($this->collBillingLinesRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPaymentLinesRelatedByIdCreation) {
                foreach ($this->collPaymentLinesRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPaymentLinesRelatedByIdModification) {
                foreach ($this->collPaymentLinesRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCostLinesRelatedByIdCreation) {
                foreach ($this->collCostLinesRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCostLinesRelatedByIdModification) {
                foreach ($this->collCostLinesRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjectsRelatedByIdCreation) {
                foreach ($this->collProjectsRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjectsRelatedByIdModification) {
                foreach ($this->collProjectsRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTimeLinesRelatedByIdCreation) {
                foreach ($this->collTimeLinesRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTimeLinesRelatedByIdModification) {
                foreach ($this->collTimeLinesRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBillingCategoriesRelatedByIdCreation) {
                foreach ($this->collBillingCategoriesRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBillingCategoriesRelatedByIdModification) {
                foreach ($this->collBillingCategoriesRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCurrenciesRelatedByIdCreation) {
                foreach ($this->collCurrenciesRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCurrenciesRelatedByIdModification) {
                foreach ($this->collCurrenciesRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSuppliersRelatedByIdCreation) {
                foreach ($this->collSuppliersRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collSuppliersRelatedByIdModification) {
                foreach ($this->collSuppliersRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthiesRelatedByIdAuthy0) {
                foreach ($this->collAuthiesRelatedByIdAuthy0 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthiesRelatedByIdAuthy1) {
                foreach ($this->collAuthiesRelatedByIdAuthy1 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCountriesRelatedByIdCreation) {
                foreach ($this->collCountriesRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCountriesRelatedByIdModification) {
                foreach ($this->collCountriesRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthyGroupsRelatedByIdCreation) {
                foreach ($this->collAuthyGroupsRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthyGroupsRelatedByIdModification) {
                foreach ($this->collAuthyGroupsRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collConfigsRelatedByIdCreation) {
                foreach ($this->collConfigsRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collConfigsRelatedByIdModification) {
                foreach ($this->collConfigsRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collApiRbacsRelatedByIdCreation) {
                foreach ($this->collApiRbacsRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collApiRbacsRelatedByIdModification) {
                foreach ($this->collApiRbacsRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collApiLogs) {
                foreach ($this->collApiLogs as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTemplatesRelatedByIdCreation) {
                foreach ($this->collTemplatesRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTemplatesRelatedByIdModification) {
                foreach ($this->collTemplatesRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTemplateFilesRelatedByIdCreation) {
                foreach ($this->collTemplateFilesRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTemplateFilesRelatedByIdModification) {
                foreach ($this->collTemplateFilesRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMessageI18nsRelatedByIdCreation) {
                foreach ($this->collMessageI18nsRelatedByIdCreation as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collMessageI18nsRelatedByIdModification) {
                foreach ($this->collMessageI18nsRelatedByIdModification as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAuthyGroups) {
                foreach ($this->collAuthyGroups as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aAuthyGroupRelatedByIdAuthyGroup instanceof Persistent) {
              $this->aAuthyGroupRelatedByIdAuthyGroup->clearAllReferences($deep);
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

        if ($this->collClientsRelatedByDefaultUser instanceof PropelCollection) {
            $this->collClientsRelatedByDefaultUser->clearIterator();
        }
        $this->collClientsRelatedByDefaultUser = null;
        if ($this->collBillingLinesRelatedByIdAssign instanceof PropelCollection) {
            $this->collBillingLinesRelatedByIdAssign->clearIterator();
        }
        $this->collBillingLinesRelatedByIdAssign = null;
        if ($this->collAuthyGroupxes instanceof PropelCollection) {
            $this->collAuthyGroupxes->clearIterator();
        }
        $this->collAuthyGroupxes = null;
        if ($this->collAuthyLogs instanceof PropelCollection) {
            $this->collAuthyLogs->clearIterator();
        }
        $this->collAuthyLogs = null;
        if ($this->collClientsRelatedByIdCreation instanceof PropelCollection) {
            $this->collClientsRelatedByIdCreation->clearIterator();
        }
        $this->collClientsRelatedByIdCreation = null;
        if ($this->collClientsRelatedByIdModification instanceof PropelCollection) {
            $this->collClientsRelatedByIdModification->clearIterator();
        }
        $this->collClientsRelatedByIdModification = null;
        if ($this->collBillingsRelatedByIdCreation instanceof PropelCollection) {
            $this->collBillingsRelatedByIdCreation->clearIterator();
        }
        $this->collBillingsRelatedByIdCreation = null;
        if ($this->collBillingsRelatedByIdModification instanceof PropelCollection) {
            $this->collBillingsRelatedByIdModification->clearIterator();
        }
        $this->collBillingsRelatedByIdModification = null;
        if ($this->collBillingLinesRelatedByIdCreation instanceof PropelCollection) {
            $this->collBillingLinesRelatedByIdCreation->clearIterator();
        }
        $this->collBillingLinesRelatedByIdCreation = null;
        if ($this->collBillingLinesRelatedByIdModification instanceof PropelCollection) {
            $this->collBillingLinesRelatedByIdModification->clearIterator();
        }
        $this->collBillingLinesRelatedByIdModification = null;
        if ($this->collPaymentLinesRelatedByIdCreation instanceof PropelCollection) {
            $this->collPaymentLinesRelatedByIdCreation->clearIterator();
        }
        $this->collPaymentLinesRelatedByIdCreation = null;
        if ($this->collPaymentLinesRelatedByIdModification instanceof PropelCollection) {
            $this->collPaymentLinesRelatedByIdModification->clearIterator();
        }
        $this->collPaymentLinesRelatedByIdModification = null;
        if ($this->collCostLinesRelatedByIdCreation instanceof PropelCollection) {
            $this->collCostLinesRelatedByIdCreation->clearIterator();
        }
        $this->collCostLinesRelatedByIdCreation = null;
        if ($this->collCostLinesRelatedByIdModification instanceof PropelCollection) {
            $this->collCostLinesRelatedByIdModification->clearIterator();
        }
        $this->collCostLinesRelatedByIdModification = null;
        if ($this->collProjectsRelatedByIdCreation instanceof PropelCollection) {
            $this->collProjectsRelatedByIdCreation->clearIterator();
        }
        $this->collProjectsRelatedByIdCreation = null;
        if ($this->collProjectsRelatedByIdModification instanceof PropelCollection) {
            $this->collProjectsRelatedByIdModification->clearIterator();
        }
        $this->collProjectsRelatedByIdModification = null;
        if ($this->collTimeLinesRelatedByIdCreation instanceof PropelCollection) {
            $this->collTimeLinesRelatedByIdCreation->clearIterator();
        }
        $this->collTimeLinesRelatedByIdCreation = null;
        if ($this->collTimeLinesRelatedByIdModification instanceof PropelCollection) {
            $this->collTimeLinesRelatedByIdModification->clearIterator();
        }
        $this->collTimeLinesRelatedByIdModification = null;
        if ($this->collBillingCategoriesRelatedByIdCreation instanceof PropelCollection) {
            $this->collBillingCategoriesRelatedByIdCreation->clearIterator();
        }
        $this->collBillingCategoriesRelatedByIdCreation = null;
        if ($this->collBillingCategoriesRelatedByIdModification instanceof PropelCollection) {
            $this->collBillingCategoriesRelatedByIdModification->clearIterator();
        }
        $this->collBillingCategoriesRelatedByIdModification = null;
        if ($this->collCurrenciesRelatedByIdCreation instanceof PropelCollection) {
            $this->collCurrenciesRelatedByIdCreation->clearIterator();
        }
        $this->collCurrenciesRelatedByIdCreation = null;
        if ($this->collCurrenciesRelatedByIdModification instanceof PropelCollection) {
            $this->collCurrenciesRelatedByIdModification->clearIterator();
        }
        $this->collCurrenciesRelatedByIdModification = null;
        if ($this->collSuppliersRelatedByIdCreation instanceof PropelCollection) {
            $this->collSuppliersRelatedByIdCreation->clearIterator();
        }
        $this->collSuppliersRelatedByIdCreation = null;
        if ($this->collSuppliersRelatedByIdModification instanceof PropelCollection) {
            $this->collSuppliersRelatedByIdModification->clearIterator();
        }
        $this->collSuppliersRelatedByIdModification = null;
        if ($this->collAuthiesRelatedByIdAuthy0 instanceof PropelCollection) {
            $this->collAuthiesRelatedByIdAuthy0->clearIterator();
        }
        $this->collAuthiesRelatedByIdAuthy0 = null;
        if ($this->collAuthiesRelatedByIdAuthy1 instanceof PropelCollection) {
            $this->collAuthiesRelatedByIdAuthy1->clearIterator();
        }
        $this->collAuthiesRelatedByIdAuthy1 = null;
        if ($this->collCountriesRelatedByIdCreation instanceof PropelCollection) {
            $this->collCountriesRelatedByIdCreation->clearIterator();
        }
        $this->collCountriesRelatedByIdCreation = null;
        if ($this->collCountriesRelatedByIdModification instanceof PropelCollection) {
            $this->collCountriesRelatedByIdModification->clearIterator();
        }
        $this->collCountriesRelatedByIdModification = null;
        if ($this->collAuthyGroupsRelatedByIdCreation instanceof PropelCollection) {
            $this->collAuthyGroupsRelatedByIdCreation->clearIterator();
        }
        $this->collAuthyGroupsRelatedByIdCreation = null;
        if ($this->collAuthyGroupsRelatedByIdModification instanceof PropelCollection) {
            $this->collAuthyGroupsRelatedByIdModification->clearIterator();
        }
        $this->collAuthyGroupsRelatedByIdModification = null;
        if ($this->collConfigsRelatedByIdCreation instanceof PropelCollection) {
            $this->collConfigsRelatedByIdCreation->clearIterator();
        }
        $this->collConfigsRelatedByIdCreation = null;
        if ($this->collConfigsRelatedByIdModification instanceof PropelCollection) {
            $this->collConfigsRelatedByIdModification->clearIterator();
        }
        $this->collConfigsRelatedByIdModification = null;
        if ($this->collApiRbacsRelatedByIdCreation instanceof PropelCollection) {
            $this->collApiRbacsRelatedByIdCreation->clearIterator();
        }
        $this->collApiRbacsRelatedByIdCreation = null;
        if ($this->collApiRbacsRelatedByIdModification instanceof PropelCollection) {
            $this->collApiRbacsRelatedByIdModification->clearIterator();
        }
        $this->collApiRbacsRelatedByIdModification = null;
        if ($this->collApiLogs instanceof PropelCollection) {
            $this->collApiLogs->clearIterator();
        }
        $this->collApiLogs = null;
        if ($this->collTemplatesRelatedByIdCreation instanceof PropelCollection) {
            $this->collTemplatesRelatedByIdCreation->clearIterator();
        }
        $this->collTemplatesRelatedByIdCreation = null;
        if ($this->collTemplatesRelatedByIdModification instanceof PropelCollection) {
            $this->collTemplatesRelatedByIdModification->clearIterator();
        }
        $this->collTemplatesRelatedByIdModification = null;
        if ($this->collTemplateFilesRelatedByIdCreation instanceof PropelCollection) {
            $this->collTemplateFilesRelatedByIdCreation->clearIterator();
        }
        $this->collTemplateFilesRelatedByIdCreation = null;
        if ($this->collTemplateFilesRelatedByIdModification instanceof PropelCollection) {
            $this->collTemplateFilesRelatedByIdModification->clearIterator();
        }
        $this->collTemplateFilesRelatedByIdModification = null;
        if ($this->collMessageI18nsRelatedByIdCreation instanceof PropelCollection) {
            $this->collMessageI18nsRelatedByIdCreation->clearIterator();
        }
        $this->collMessageI18nsRelatedByIdCreation = null;
        if ($this->collMessageI18nsRelatedByIdModification instanceof PropelCollection) {
            $this->collMessageI18nsRelatedByIdModification->clearIterator();
        }
        $this->collMessageI18nsRelatedByIdModification = null;
        if ($this->collAuthyGroups instanceof PropelCollection) {
            $this->collAuthyGroups->clearIterator();
        }
        $this->collAuthyGroups = null;
        $this->aAuthyGroupRelatedByIdAuthyGroup = null;
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
        return (string) $this->exportTo(AuthyPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Authy The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged(){
        $this->modifiedColumns[] = AuthyPeer::DATE_MODIFICATION;

        return $this;
    }

}
