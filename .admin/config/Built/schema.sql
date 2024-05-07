
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- client
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client`
(
    `id_client` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) COMMENT 'Name',
    `id_country` INTEGER(11) NOT NULL COMMENT 'Country',
    `phone` VARCHAR(20) COMMENT 'Phone',
    `phone_work` VARCHAR(20) COMMENT 'Phone work',
    `ext` VARCHAR(10) COMMENT 'Extension',
    `email` VARCHAR(100) COMMENT 'Email',
    `contact` VARCHAR(150) COMMENT 'Contact',
    `email2` VARCHAR(100) COMMENT 'Email (contact)',
    `phone_mobile` VARCHAR(20) COMMENT 'contact',
    `website` VARCHAR(100),
    `address_1` TEXT(10) COMMENT 'Address 1',
    `address_2` TEXT(10) COMMENT 'Address 2',
    `address_3` TEXT(10) COMMENT 'Address 3',
    `zip` VARCHAR(12) COMMENT 'Zip',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_client`),
    INDEX `client_FI_1` (`id_country`),
    INDEX `client_FI_2` (`id_group_creation`),
    INDEX `client_FI_3` (`id_creation`),
    INDEX `client_FI_4` (`id_modification`),
    CONSTRAINT `client_FK_1`
        FOREIGN KEY (`id_country`)
        REFERENCES `country` (`id_country`),
    CONSTRAINT `client_FK_2`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `client_FK_3`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `client_FK_4`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Client';

-- ---------------------------------------------------------------------
-- billing
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `billing`;

CREATE TABLE `billing`
(
    `id_billing` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `calc_id` VARCHAR(20),
    `title` VARCHAR(100) COMMENT 'Title',
    `id_client` INTEGER(11) NOT NULL COMMENT 'Client',
    `id_project` INTEGER(11) COMMENT 'Project',
    `id_billing_category` INTEGER(11) COMMENT 'Category',
    `date` DATE COMMENT 'Date',
    `type` TINYINT DEFAULT 1 NOT NULL COMMENT 'Type',
    `state` TINYINT NOT NULL COMMENT 'State',
    `gross` DECIMAL(8, 2) COMMENT 'Gross',
    `tax` DECIMAL(8, 2) COMMENT 'Tax',
    `date_due` DATE COMMENT 'Due date',
    `note_billing` TEXT(400) COMMENT 'Note',
    `date_paid` DATE COMMENT 'Paid date',
    `net` DECIMAL(8, 2) COMMENT 'Net',
    `reference` VARCHAR(100) COMMENT 'Paiement Reference',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_billing`),
    INDEX `billing_FI_1` (`id_client`),
    INDEX `billing_FI_2` (`id_project`),
    INDEX `billing_FI_3` (`id_billing_category`),
    INDEX `billing_FI_4` (`id_group_creation`),
    INDEX `billing_FI_5` (`id_creation`),
    INDEX `billing_FI_6` (`id_modification`),
    CONSTRAINT `billing_FK_1`
        FOREIGN KEY (`id_client`)
        REFERENCES `client` (`id_client`),
    CONSTRAINT `billing_FK_2`
        FOREIGN KEY (`id_project`)
        REFERENCES `project` (`id_project`),
    CONSTRAINT `billing_FK_3`
        FOREIGN KEY (`id_billing_category`)
        REFERENCES `billing_category` (`id_billing_category`),
    CONSTRAINT `billing_FK_4`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `billing_FK_5`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `billing_FK_6`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Billing';

-- ---------------------------------------------------------------------
-- billing_line
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `billing_line`;

CREATE TABLE `billing_line`
(
    `id_billing_line` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `id_billing` INTEGER(11) NOT NULL,
    `calc_id` VARCHAR(20),
    `id_assign` INTEGER(11) COMMENT 'Assigned to',
    `id_project` INTEGER(11) COMMENT 'Project',
    `title` VARCHAR(100) COMMENT 'Title',
    `work_date` DATE COMMENT 'Date',
    `quantity` DECIMAL(8, 2) DEFAULT 1.00 NOT NULL COMMENT 'Quantity',
    `amount` DECIMAL(8, 2) DEFAULT 0.00 NOT NULL COMMENT 'Amount',
    `total` DECIMAL(8, 2) COMMENT 'Total',
    `id_billing_category` INTEGER(11) COMMENT 'Category',
    `note_billing_ligne` TEXT(500) COMMENT 'Note',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_billing_line`),
    INDEX `billing_line_FI_1` (`id_billing`),
    INDEX `billing_line_FI_2` (`id_assign`),
    INDEX `billing_line_FI_3` (`id_project`),
    INDEX `billing_line_FI_4` (`id_billing_category`),
    INDEX `billing_line_FI_5` (`id_group_creation`),
    INDEX `billing_line_FI_6` (`id_creation`),
    INDEX `billing_line_FI_7` (`id_modification`),
    CONSTRAINT `billing_line_FK_1`
        FOREIGN KEY (`id_billing`)
        REFERENCES `billing` (`id_billing`)
        ON DELETE CASCADE,
    CONSTRAINT `billing_line_FK_2`
        FOREIGN KEY (`id_assign`)
        REFERENCES `authy` (`id_creation`),
    CONSTRAINT `billing_line_FK_3`
        FOREIGN KEY (`id_project`)
        REFERENCES `project` (`id_project`),
    CONSTRAINT `billing_line_FK_4`
        FOREIGN KEY (`id_billing_category`)
        REFERENCES `billing_category` (`id_billing_category`),
    CONSTRAINT `billing_line_FK_5`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `billing_line_FK_6`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `billing_line_FK_7`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Entries';

-- ---------------------------------------------------------------------
-- payment_line
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `payment_line`;

CREATE TABLE `payment_line`
(
    `id_payment_line` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `id_billing` INTEGER(11) NOT NULL,
    `Reference` VARCHAR(40),
    `date` DATE COMMENT 'Date',
    `note` TEXT(500) COMMENT 'Note',
    `amount` DECIMAL(8, 2) DEFAULT 0.00 NOT NULL COMMENT 'Amount',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_payment_line`),
    INDEX `payment_line_FI_1` (`id_billing`),
    INDEX `payment_line_FI_2` (`id_group_creation`),
    INDEX `payment_line_FI_3` (`id_creation`),
    INDEX `payment_line_FI_4` (`id_modification`),
    CONSTRAINT `payment_line_FK_1`
        FOREIGN KEY (`id_billing`)
        REFERENCES `billing` (`id_billing`)
        ON DELETE CASCADE,
    CONSTRAINT `payment_line_FK_2`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `payment_line_FK_3`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `payment_line_FK_4`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Payment entry';

-- ---------------------------------------------------------------------
-- cost_line
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `cost_line`;

CREATE TABLE `cost_line`
(
    `id_cost_line` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `id_billing` INTEGER(11),
    `calc_id` VARCHAR(20),
    `title` VARCHAR(100) NOT NULL COMMENT 'Title',
    `id_supplier` INTEGER(11) COMMENT 'Supplier',
    `invoice_no` VARCHAR(100) COMMENT 'Invoice no.',
    `id_project` INTEGER(11) COMMENT 'Project',
    `id_billing_category` INTEGER(11) COMMENT 'Category',
    `spend_date` DATE NOT NULL COMMENT 'Date',
    `recuring` TINYINT NOT NULL COMMENT 'Recuring',
    `renewal_date` DATE COMMENT 'Renewal date',
    `quantity` DECIMAL(8, 2) DEFAULT 1.00 NOT NULL COMMENT 'Quantity',
    `amount` DECIMAL(8, 2) DEFAULT 0.00 NOT NULL COMMENT 'Amount',
    `total` DECIMAL(8, 2) COMMENT 'Total',
    `bill` TINYINT NOT NULL COMMENT 'Add to bill',
    `note_billing_ligne` TEXT(500) COMMENT 'Note',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_cost_line`),
    INDEX `cost_line_FI_1` (`id_billing`),
    INDEX `cost_line_FI_2` (`id_supplier`),
    INDEX `cost_line_FI_3` (`id_project`),
    INDEX `cost_line_FI_4` (`id_billing_category`),
    INDEX `cost_line_FI_5` (`id_group_creation`),
    INDEX `cost_line_FI_6` (`id_creation`),
    INDEX `cost_line_FI_7` (`id_modification`),
    CONSTRAINT `cost_line_FK_1`
        FOREIGN KEY (`id_billing`)
        REFERENCES `billing` (`id_billing`)
        ON DELETE CASCADE,
    CONSTRAINT `cost_line_FK_2`
        FOREIGN KEY (`id_supplier`)
        REFERENCES `supplier` (`id_supplier`),
    CONSTRAINT `cost_line_FK_3`
        FOREIGN KEY (`id_project`)
        REFERENCES `project` (`id_project`),
    CONSTRAINT `cost_line_FK_4`
        FOREIGN KEY (`id_billing_category`)
        REFERENCES `billing_category` (`id_billing_category`),
    CONSTRAINT `cost_line_FK_5`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `cost_line_FK_6`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `cost_line_FK_7`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Expense';

-- ---------------------------------------------------------------------
-- project
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project`
(
    `id_project` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `calc_id` VARCHAR(20),
    `name` VARCHAR(100) COMMENT 'Name',
    `id_client` INTEGER(11) COMMENT 'Client',
    `date` DATE COMMENT 'Start date',
    `type` TINYINT COMMENT 'Type',
    `state` TINYINT COMMENT 'State',
    `budget` DECIMAL(8, 2) COMMENT 'Budget',
    `spent` DECIMAL(8, 2) COMMENT 'Spent',
    `reference` VARCHAR(100) COMMENT 'Paiement Reference',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_project`),
    INDEX `project_FI_1` (`id_client`),
    INDEX `project_FI_2` (`id_group_creation`),
    INDEX `project_FI_3` (`id_creation`),
    INDEX `project_FI_4` (`id_modification`),
    CONSTRAINT `project_FK_1`
        FOREIGN KEY (`id_client`)
        REFERENCES `client` (`id_client`),
    CONSTRAINT `project_FK_2`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `project_FK_3`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `project_FK_4`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Project';

-- ---------------------------------------------------------------------
-- time_line
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `time_line`;

CREATE TABLE `time_line`
(
    `id_cost_line` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `id_project` INTEGER(11) NOT NULL,
    `calc_id` VARCHAR(20),
    `Name` VARCHAR(100) COMMENT 'Title',
    `date` DATE COMMENT 'Date',
    `note` TEXT(500) COMMENT 'Note',
    `quantity` DECIMAL(8, 2) COMMENT 'Quantity',
    `amount` DECIMAL(8, 2) COMMENT 'Amount',
    `total` DECIMAL(8, 2) COMMENT 'Total',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_cost_line`),
    INDEX `time_line_FI_1` (`id_project`),
    INDEX `time_line_FI_2` (`id_group_creation`),
    INDEX `time_line_FI_3` (`id_creation`),
    INDEX `time_line_FI_4` (`id_modification`),
    CONSTRAINT `time_line_FK_1`
        FOREIGN KEY (`id_project`)
        REFERENCES `project` (`id_project`)
        ON DELETE CASCADE,
    CONSTRAINT `time_line_FK_2`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `time_line_FK_3`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `time_line_FK_4`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Time';

-- ---------------------------------------------------------------------
-- billing_category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `billing_category`;

CREATE TABLE `billing_category`
(
    `id_billing_category` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) COMMENT 'Name',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_billing_category`),
    INDEX `billing_category_FI_1` (`id_group_creation`),
    INDEX `billing_category_FI_2` (`id_creation`),
    INDEX `billing_category_FI_3` (`id_modification`),
    CONSTRAINT `billing_category_FK_1`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `billing_category_FK_2`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `billing_category_FK_3`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Category billing';

-- ---------------------------------------------------------------------
-- supplier
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier`
(
    `id_supplier` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) COMMENT 'Name',
    `id_country` INTEGER(11) NOT NULL COMMENT 'Country',
    `phone` VARCHAR(20) COMMENT 'Phone',
    `phone_work` VARCHAR(20) COMMENT 'Phone work',
    `ext` VARCHAR(10) COMMENT 'Extension',
    `email` VARCHAR(100) COMMENT 'Email',
    `contact` VARCHAR(150) COMMENT 'Contact',
    `email2` VARCHAR(100) COMMENT 'Email (contact)',
    `phone_mobile` VARCHAR(20) COMMENT 'contact',
    `website` VARCHAR(100),
    `address_1` TEXT(10) COMMENT 'Address 1',
    `address_2` TEXT(10) COMMENT 'Address 2',
    `address_3` TEXT(10) COMMENT 'Address 3',
    `zip` VARCHAR(12) COMMENT 'Zip',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_supplier`),
    INDEX `supplier_FI_1` (`id_country`),
    INDEX `supplier_FI_2` (`id_group_creation`),
    INDEX `supplier_FI_3` (`id_creation`),
    INDEX `supplier_FI_4` (`id_modification`),
    CONSTRAINT `supplier_FK_1`
        FOREIGN KEY (`id_country`)
        REFERENCES `country` (`id_country`),
    CONSTRAINT `supplier_FK_2`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `supplier_FK_3`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `supplier_FK_4`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Supplier';

-- ---------------------------------------------------------------------
-- authy
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `authy`;

CREATE TABLE `authy`
(
    `id_authy` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `validation_key` VARCHAR(32),
    `username` VARCHAR(32) COMMENT 'Username',
    `fullname` VARCHAR(100) COMMENT 'Fullname',
    `email` VARCHAR(100) NOT NULL COMMENT 'Email',
    `passwd_hash` VARCHAR(32) NOT NULL COMMENT 'Password',
    `expire` DATE DEFAULT '0000-00-00' COMMENT 'Expiration',
    `deactivate` TINYINT DEFAULT 1 COMMENT 'Deactivated',
    `is_root` TINYINT DEFAULT 1 NOT NULL,
    `id_authy_group` INTEGER DEFAULT 1 NOT NULL COMMENT 'Primary group',
    `is_system` TINYINT DEFAULT 1 NOT NULL,
    `rights_all` TEXT COMMENT 'Rights',
    `rights_group` TEXT COMMENT 'Rights group',
    `rights_owner` TEXT COMMENT 'Rights owner',
    `onglet` TEXT,
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_authy`),
    UNIQUE INDEX `authy_U_1` (`username`),
    INDEX `I_referenced_billing_line_FK_2_1` (`id_creation`),
    INDEX `authy_FI_1` (`id_authy_group`),
    INDEX `authy_FI_2` (`id_group_creation`),
    INDEX `authy_FI_4` (`id_modification`),
    CONSTRAINT `authy_FK_1`
        FOREIGN KEY (`id_authy_group`)
        REFERENCES `authy_group` (`id_authy_group`)
        ON DELETE CASCADE,
    CONSTRAINT `authy_FK_2`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `authy_FK_3`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `authy_FK_4`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='User';

-- ---------------------------------------------------------------------
-- country
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country`
(
    `id_country` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) COMMENT 'Name',
    `code` VARCHAR(3) COMMENT 'Code',
    `timezone` VARCHAR(20) COMMENT 'Timezone',
    `timezone_code` VARCHAR(50) COMMENT 'Timezone code',
    `priority` INTEGER(10) COMMENT 'Priority',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_country`),
    INDEX `country_FI_1` (`id_group_creation`),
    INDEX `country_FI_2` (`id_creation`),
    INDEX `country_FI_3` (`id_modification`),
    CONSTRAINT `country_FK_1`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `country_FK_2`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `country_FK_3`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Country';

-- ---------------------------------------------------------------------
-- authy_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `authy_group`;

CREATE TABLE `authy_group`
(
    `id_authy_group` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) COMMENT 'Name',
    `desc` VARCHAR(32) COMMENT 'Description',
    `default_group` TINYINT NOT NULL COMMENT 'Default',
    `admin` TINYINT NOT NULL COMMENT 'Admin',
    `rights_all` VARCHAR(1023) COMMENT 'Rights',
    `rights_owner` VARCHAR(1023) COMMENT 'Rights owner',
    `rights_group` VARCHAR(1023) COMMENT 'Rights group',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_authy_group`),
    INDEX `authy_group_FI_1` (`id_group_creation`),
    INDEX `authy_group_FI_2` (`id_creation`),
    INDEX `authy_group_FI_3` (`id_modification`),
    CONSTRAINT `authy_group_FK_1`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `authy_group_FK_2`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `authy_group_FK_3`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Group';

-- ---------------------------------------------------------------------
-- authy_group_x
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `authy_group_x`;

CREATE TABLE `authy_group_x`
(
    `id_authy` INTEGER NOT NULL,
    `id_authy_group` INTEGER NOT NULL COMMENT 'Group',
    PRIMARY KEY (`id_authy`,`id_authy_group`),
    INDEX `authy_group_x_FI_1` (`id_authy_group`),
    CONSTRAINT `authy_group_x_FK_1`
        FOREIGN KEY (`id_authy_group`)
        REFERENCES `authy_group` (`id_authy_group`)
        ON DELETE CASCADE,
    CONSTRAINT `authy_group_x_FK_2`
        FOREIGN KEY (`id_authy`)
        REFERENCES `authy` (`id_authy`)
        ON UPDATE CASCADE
) ENGINE=InnoDB COMMENT='Group';

-- ---------------------------------------------------------------------
-- authy_log
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `authy_log`;

CREATE TABLE `authy_log`
(
    `id_authy_log` INTEGER NOT NULL AUTO_INCREMENT,
    `id_authy` INTEGER,
    `timestamp` DATETIME COMMENT 'Date',
    `login` VARCHAR(50) NOT NULL COMMENT 'Username',
    `userid` INTEGER,
    `result` VARCHAR(100) NOT NULL,
    `ip` VARCHAR(16) NOT NULL COMMENT 'Ip',
    `count` INTEGER COMMENT 'Count',
    PRIMARY KEY (`id_authy_log`),
    INDEX `authy_log_FI_1` (`id_authy`),
    CONSTRAINT `authy_log_FK_1`
        FOREIGN KEY (`id_authy`)
        REFERENCES `authy` (`id_authy`)
        ON UPDATE CASCADE
) ENGINE=InnoDB COMMENT='Login log';

-- ---------------------------------------------------------------------
-- message
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message`
(
    `id_message` INTEGER NOT NULL AUTO_INCREMENT,
    `label` VARCHAR(100) NOT NULL COMMENT 'Label',
    PRIMARY KEY (`id_message`)
) ENGINE=InnoDB COMMENT='Message';

-- ---------------------------------------------------------------------
-- config
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config`
(
    `id_config` INTEGER NOT NULL AUTO_INCREMENT,
    `category` TINYINT NOT NULL COMMENT 'Category',
    `config` VARCHAR(100) NOT NULL COMMENT 'Setting',
    `value` TEXT(400) COMMENT 'Value',
    `system` TINYINT DEFAULT 0,
    `description` VARCHAR(100) COMMENT 'Description',
    `type` VARCHAR(35),
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_config`),
    INDEX `config_FI_1` (`id_group_creation`),
    INDEX `config_FI_2` (`id_creation`),
    INDEX `config_FI_3` (`id_modification`),
    CONSTRAINT `config_FK_1`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `config_FK_2`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `config_FK_3`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Setting';

-- ---------------------------------------------------------------------
-- api_rbac
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `api_rbac`;

CREATE TABLE `api_rbac`
(
    `id_api_rbac` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `date_creation` DATE NOT NULL COMMENT 'Date',
    `description` TEXT(1023) COMMENT 'Description',
    `model` VARCHAR(200) NOT NULL COMMENT 'Model',
    `action` VARCHAR(200) COMMENT 'Action',
    `body` TEXT(1023) COMMENT 'Body',
    `query` TEXT(1023) COMMENT 'Query',
    `method` TINYINT DEFAULT 0 NOT NULL COMMENT 'Method',
    `scope` TINYINT DEFAULT 0 NOT NULL COMMENT 'Scope',
    `rule` TINYINT DEFAULT 1 NOT NULL COMMENT 'Rule',
    `count` INTEGER DEFAULT 0 NOT NULL COMMENT 'Used count',
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_api_rbac`),
    INDEX `api_rbac_FI_1` (`id_group_creation`),
    INDEX `api_rbac_FI_2` (`id_creation`),
    INDEX `api_rbac_FI_3` (`id_modification`),
    CONSTRAINT `api_rbac_FK_1`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `api_rbac_FK_2`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `api_rbac_FK_3`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='API ACL';

-- ---------------------------------------------------------------------
-- api_log
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `api_log`;

CREATE TABLE `api_log`
(
    `id_api_log` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `id_api_rbac` INTEGER NOT NULL COMMENT 'Rule',
    `id_authy` INTEGER,
    `time` DATETIME NOT NULL COMMENT 'Time',
    PRIMARY KEY (`id_api_log`),
    INDEX `api_log_FI_1` (`id_api_rbac`),
    INDEX `api_log_FI_2` (`id_authy`),
    CONSTRAINT `api_log_FK_1`
        FOREIGN KEY (`id_api_rbac`)
        REFERENCES `api_rbac` (`id_api_rbac`)
        ON DELETE CASCADE,
    CONSTRAINT `api_log_FK_2`
        FOREIGN KEY (`id_authy`)
        REFERENCES `authy` (`id_authy`)
        ON DELETE CASCADE
) ENGINE=InnoDB COMMENT='API log';

-- ---------------------------------------------------------------------
-- template
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `template`;

CREATE TABLE `template`
(
    `id_template` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL COMMENT 'Name',
    `subject` VARCHAR(200) COMMENT 'Action',
    `color_1` VARCHAR(10) COMMENT 'Color 1',
    `color_2` VARCHAR(10) COMMENT 'Color 2',
    `color_3` VARCHAR(10) COMMENT 'Color 3',
    `status` TINYINT DEFAULT 0 NOT NULL COMMENT 'Status',
    `body` TEXT(1023) COMMENT 'Body',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_template`),
    INDEX `template_FI_1` (`id_group_creation`),
    INDEX `template_FI_2` (`id_creation`),
    INDEX `template_FI_3` (`id_modification`),
    CONSTRAINT `template_FK_1`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `template_FK_2`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `template_FK_3`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='Template';

-- ---------------------------------------------------------------------
-- template_file
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `template_file`;

CREATE TABLE `template_file`
(
    `id_template_file` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `id_template` INTEGER NOT NULL,
    `name` VARCHAR(100) COMMENT 'Name',
    `file` VARCHAR(500) COMMENT 'File',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_template_file`),
    INDEX `template_file_FI_1` (`id_template`),
    INDEX `template_file_FI_2` (`id_group_creation`),
    INDEX `template_file_FI_3` (`id_creation`),
    INDEX `template_file_FI_4` (`id_modification`),
    CONSTRAINT `template_file_FK_1`
        FOREIGN KEY (`id_template`)
        REFERENCES `template` (`id_template`)
        ON DELETE CASCADE,
    CONSTRAINT `template_file_FK_2`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `template_file_FK_3`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `template_file_FK_4`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB COMMENT='File';

-- ---------------------------------------------------------------------
-- message_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `message_i18n`;

CREATE TABLE `message_i18n`
(
    `id_message` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `text` TEXT(200) COMMENT 'Texte',
    `date_creation` DATETIME,
    `date_modification` DATETIME,
    `id_group_creation` INTEGER,
    `id_creation` INTEGER,
    `id_modification` INTEGER,
    PRIMARY KEY (`id_message`,`locale`),
    INDEX `message_i18n_FI_2` (`id_group_creation`),
    INDEX `message_i18n_FI_3` (`id_creation`),
    INDEX `message_i18n_FI_4` (`id_modification`),
    CONSTRAINT `message_i18n_FK_1`
        FOREIGN KEY (`id_message`)
        REFERENCES `message` (`id_message`)
        ON DELETE CASCADE,
    CONSTRAINT `message_i18n_FK_2`
        FOREIGN KEY (`id_group_creation`)
        REFERENCES `authy_group` (`id_authy_group`),
    CONSTRAINT `message_i18n_FK_3`
        FOREIGN KEY (`id_creation`)
        REFERENCES `authy` (`id_authy`),
    CONSTRAINT `message_i18n_FK_4`
        FOREIGN KEY (`id_modification`)
        REFERENCES `authy` (`id_authy`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
