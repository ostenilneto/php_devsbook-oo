<?php
session_start();
$base = 'http://211.0.77.222/devsbook-oo';

$db_name = 'devsbook';
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

$maxWidth = 800;
$maxHeight = 800;

$pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);