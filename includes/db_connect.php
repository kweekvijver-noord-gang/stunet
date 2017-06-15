<?php
include_once 'config.php';   // As functions.php is not included
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);


$dbh = new PDO('mysql:dbname=stunet; host=localhost',USER,PASSWORD);