<?php
$servername = "db";
$username = "root";
$password = "1";
$dbName = "first";

$link = mysqli_connect($servername, $username, $password);
if (!$link) {
    die("Ошибка подключения к серверу MySQL: " . mysqli_connect_error());
}

mysqli_query($link, "CREATE DATABASE IF NOT EXISTS `$dbName`");

mysqli_select_db($link, $dbName);

$sql_table = "CREATE TABLE IF NOT EXISTS users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL UNIQUE,
    pass VARCHAR(255) NOT NULL
)";
mysqli_query($link, $sql_table);

mysqli_close($link);
?>