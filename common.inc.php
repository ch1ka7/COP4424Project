<?php
session_start(); //Session starts

$parameter["siteName"] = "My Blog";
$parameter["dbName"] = "myblog";
$parameter["dbUsername"] = "root";
$parameter["dbPassword"] = "";

try {
    $db = new PDO("mysql:host=localhost;charset=utf8;dbname=" . $parameter["dbName"], $parameter["dbUsername"], $parameter["dbPassword"]); //Create PDO Object
} catch (PDOException $pex) {
    die("Connection failed: " . $pex->getMessage());
}

?>