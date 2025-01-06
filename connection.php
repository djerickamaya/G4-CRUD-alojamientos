<?php 

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'alojamientos_db';

$connection = new mysqli($serverName,$username,$password,$dbName);

// Chekar la conexion a la bd

if($connection->connect_error){
    die("Conexion Fallida ".$connection->connect_error);
}
?>