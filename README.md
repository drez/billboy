Billboy is a small billing, crm and accounting software for Freelancer with basic needs.
It is meant to be simple and flexible.

### Demo & doc @ https://billboy.apigoat.com/

#### Features:

- Billing, Quote
- Client, Supplier
- Revenues, Expenses
- Project budgeting (basic for now)
- Bill, Quote printing with custom header
- Report charts
- Pdf generation
- Multiple invoice templates
- Basic multi currency support

#### Customization:
- Full API (https://apigoat.com/docs/api/)
- Easy class hooks to customize (https://apigoat.com/docs/using-hooks-with-php/)

It is build on top of Slim4 and Propel Orm via The ApiGoat build engine.
For documentation on APIgoat build standards, check [apigoat.com](https://apigoat.com/).

### Getting started

#### 1. Requirement

- Requires a webserver with rewrite, mysql compatible database and PHP 8+
- Composer

#### 2. Install

1. copy the files to the server
2. run `composer install` in .admin folder
3. rename .env.example; add your database and configurations
4. run the deploy script in console or navigate to public/install.php

```
$ composer run-script deploy
```

5. Navigate to /.admin

6. Log in with your chosen root user
  

#### 5. Attributions

#### 4. Attributions

- ORM provided by Propel (https://propelorm.org)
- PHP micro framework provided by Slim (https://www.slimframework.com)
- the icon "loading" is provided by loading.io (https://loading.io)

Licenced under MIT
