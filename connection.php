<?php


$dbhost = "lab22";
$dbuser = "root";
$dbpass = "root";
$dbname = "anoforum";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$con) {
    die("Database not found!");
}