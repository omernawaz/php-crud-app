<?php
require '../classes/user.php';

if(isset($_REQUEST['signup']))
{
    $response = User::signUser($_POST['email'], $_POST['uname'], $_POST['pwd']);
    http_response_code($response['code']);
    echo json_encode($response);
}

?>