<?php 
require '../classes/user.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id = $_POST['id'];
    $response = null;

    if(isset($_POST['filter'])) {
        $response = User::getUser($id,$_POST['filter']);
    }
    else {
        $response = User::getUser($id);
    }
    
    echo json_encode($response);
}
?>