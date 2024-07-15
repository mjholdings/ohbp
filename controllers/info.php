<?php



define("BASEPATH", __DIR__);

require_once 'install/helper.php';

require_once 'application/config/database.php';

$serverReq = checkReq();



$db = $db['default'];



$con = mysqli_connect($db["hostname"], $db['username'], $db['password'], $db['database'], $db["dbport"]);

if (mysqli_connect_errno()) {

    $con = false;

}

var_dump($db);