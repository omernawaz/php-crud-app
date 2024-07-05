<?php 
include '../classes/user.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $response = User::makeAdmin($_POST['id']);
    echo json_encode($response);
}


?>