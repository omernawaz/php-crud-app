<?php 

require '../classes/user.php';

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // http_response_code(200);
    // echo json_encode($_POST);
    
    $id = $_POST['id'];
    $new_email = $_POST['email'];
    $new_username = $_POST['uname'];
    $new_pwd = $_POST['new-pwd'];


    $pfp_file = null;
    if(!empty($_FILES['pfp-file']['name']))
        $pfp_file = $_FILES['pfp-file'];

    $response = User::updateUser($id,$new_email,$new_username,$new_pwd,$pfp_file);

    http_response_code($response['code']);
    echo json_encode($response);
}

?>
