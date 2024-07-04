<?php 
include '../config/db_config.php';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id = $_POST['id'];
    
    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    $response = $stmt->fetch(PDO::FETCH_ASSOC);

    unset($response['password']);
    echo json_encode($response);
}
?>