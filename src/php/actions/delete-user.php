<?php 
include '../config/db_config.php';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id = $_POST['id'];

    $query = "DELETE FROM users WHERE users.id = :id";
    $stmt = $pdo->prepare($query);

    $stmt->execute(['id'=>$id]);

    
    echo json_encode(['status' => "Sucess", 'content' => "User Deleted Successfully"]);
}


?>