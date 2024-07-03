<?php 
$db_host = "localhost:8889";
$db_name = "crud-dev";
$db_user = "omer";
$password_file_path = "../../../db/password.txt";

$db_pass = trim(file_get_contents($password_file_path));

$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
?>
