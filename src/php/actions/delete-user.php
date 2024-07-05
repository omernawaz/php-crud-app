<?php 
include '../classes/user.php';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $response = User::deleteUser($_POST['id']);
    echo json_encode($response);
}


?>