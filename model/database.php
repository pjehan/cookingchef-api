<?php

require_once __DIR__ . '/../config/parameters.php';

$connection = new PDO("mysql:dbname=" . $param['dbname'] . ";host=" . $param['host'], $param['user'], $param['password']);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$connection->exec("SET names utf8");
$connection->exec("SET lc_time_names = 'fr_FR'");

$entity_dir = __DIR__ . "/entity/";
$files = scandir($entity_dir);
foreach ($files as $file) {
    if (!is_dir($entity_dir . $file)
            && pathinfo($entity_dir . $file, PATHINFO_EXTENSION) == "php") {
        require_once $entity_dir . $file;
    }
}


function arrayKeysExists($array, $keys) {
    $missingKey = false;
    foreach ($keys as $key) {
        if (!array_key_exists($key, $array)) {
            echo "Missing " . $key . " parameter!<br>";
            $missingKey = true;
        }
    }
    if ($missingKey) {
        die;
    }
}