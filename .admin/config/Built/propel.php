<?php

namespace App;

require_once _PROPEL_RUNTIME_PATH.'/lib/Propel.php';
\Propel::init(__DIR__ . "/db.php");
$con = \Propel::getConnection('goatcheese');
