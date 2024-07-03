<?php
include '../config/db_config.php';

if(isset($_REQUEST['signup']))
{
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES (NULL, :email, :username, :password)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email, 'username'=>$username, 'password'=>$password]);

    echo json_encode(['operationStatus' => "OK"]);
}

?>