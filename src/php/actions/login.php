<?php 
include '../config/db_config.php';
include '../validations/login-validation.php';

if(isset($_REQUEST['login']))
{
    $response = ['status' => 'OK', 'content' => "Login Authorized"];

    if($validation['email'] == false) {
        http_response_code(404);
        $response['status'] = 'NoSuchUser';
        $response['content'] = "Specified user does not exist";
        echo json_encode(array_merge($response,$validation));
    }
    else if(!$validation['password'])
    {
        http_response_code(401);
        $response['status'] = 'AuthError';
        $response['content'] = "The password is incorrect";
        echo json_encode(array_merge($response,$validation));
    }
    else {
        http_response_code(200);
        echo json_encode(array_merge($response,['id' => $id]));
    }
}
?>
