<?php

const CONNECTION_STRING = "mysql:host=localhost;dbname=basededonnees2210407";
const DB_USER = "www-2210407";

// Should be in an external file and make SURE it's not in the VCS
const DB_PASSWORD = '1234';

$driver = new PDO(CONNECTION_STRING, DB_USER, DB_PASSWORD);
$driver->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$driver->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);