Billboy is a small billing, crm and accounting software for Freelancer with basic needs.

It supports:

- Billing, Quote
- Client, Supplier
- Revenues, Expenses
- Project budgeting (basic for now)
- Bill, Quote printing with custom header
- Report charts
- Full API

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
