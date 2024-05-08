Billboy is a small billing, crm and accounting software for Freelancer with basic needs.
It is meant to be simple and flexible.

Demo @ https://billboy.apigoat.com/

Features:

- Billing, Quote
- Client, Supplier
- Revenues, Expenses
- Project budgeting (basic for now)
- Bill, Quote printing with custom header
- Report charts
- Full API (https://apigoat.com/docs/api/)
- Easy class hooks to customize (https://apigoat.com/docs/using-hooks-with-php/)

It is build on top of Slim4 and Proel Orm via ApiGoat build engine.
For documentation on APIgoat build, check apigoat.com

### Getting started

#### 1. Requirement

- Requires a webserver with rewrite, mysql compatible database and PHP 8+
- Composer

#### 2. Install

1. copy the files to the server
2. rename .env.example and add your database and path configurations
3. run the deplaoy script in console:

```
$ composer run-script deploy
```

4. Log in with
   user: apigoat
   password: Apigoat2024!

#### 5. Attributions

#### 4. Attributions

- ORM provided by Propel (https://propelorm.org)
- PHP micro framework provided by Slim (https://www.slimframework.com)
- the icon "loading" is provided by loading.io (https://loading.io)

Licenced under MIT
