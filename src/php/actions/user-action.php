<?php 

require '../classes/user.php';

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    switch ($_POST['action']) {
        case 'login':
            $validation = User::logUser($_POST['email'], $_POST['pwd']);
            http_response_code($validation['code']);
            echo json_encode($validation);
            break;
            
        case 'signup':
            $response = User::signUser($_POST['email'], $_POST['uname'], $_POST['pwd']);
            http_response_code($response['code']);
            echo json_encode($response);
            break;

        case 'get':
            $id = $_POST['id'];
            $response = null;

            if(isset($_POST['filter'])) {
                $response = User::getUser($id,$_POST['filter']);
            }
            else {
                $response = User::getUser($id);
            }
            
            echo json_encode($response);
            break;

        case 'delete':
            $response = User::deleteUser($_POST['id']);
            echo json_encode($response);
            break;

        case 'update':
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
            break;

        case 'make-admin':
            $response = User::makeAdmin($_POST['id']);
            echo json_encode($response);
            break;

    }
}

?>
