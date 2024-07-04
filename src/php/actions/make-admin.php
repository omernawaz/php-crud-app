<?php 
include '../config/db_config.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id = $_POST['id'];

    $query = "UPDATE `users` SET `is_admin` = 1 WHERE `id` = :id";
    $stmt = $pdo->prepare($query);

    $stmt->execute(['id'=>$id]);
    
    echo json_encode(['status' => "Sucess", 'content' => "User Deleted Successfully"]);
}


?>