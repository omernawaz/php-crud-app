<?php 
require '../classes/user.php';

if(isset($_REQUEST['login']))
{
    $validation = User::logUser($_POST['email'], $_POST['pwd']);
    http_response_code($validation['code']);
    echo json_encode($validation);
}

?>
