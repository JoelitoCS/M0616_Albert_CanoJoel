<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$host = 'mysql-adaw.alwaysdata.net';
$dbname = 'adaw_gestor_notas_uab';
$username = 'adaw';
$password = '16082006jcs';


$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_error){
    die("Error de conexión: " . $mysqli->connect_error);
}