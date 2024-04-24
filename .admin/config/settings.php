<?php

$settings = require __DIR__ . '/settings.defaults.php';
ini_set('session.gc_maxlifetime', 36000);

return $settings;
