<?php 
include '../config/db_config.php';

$allowed_extensions = ['png', 'jpg', 'jpeg'];

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    // http_response_code(200);
    // echo json_encode($_POST);
    
    $id = $_POST['id'];

    $query = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    $entered_password = $_POST['pwd'];
    if($entered_password != $user['password']) {
        http_response_code(401);
        echo json_encode(['status' => 'AuthError', 'content' => 'Incorrect Password']);
        exit();
    }


    $new_pfp_path = $user['pfp_path'];


    $new_email = $_POST['email'];
    $new_username = $_POST['uname'];
    $new_pwd = $_POST['new-pwd'];

    if(empty($new_pwd))
        $new_pwd = $user['password'];

    if(!empty($_FILES['pfp-file']['name'])) {
        $message = "";

        $file_name = $_FILES['pfp-file']['name'];
        $file_size = $_FILES['pfp-file']['size'];
        $file_temp = $_FILES['pfp-file']['tmp_name'];


        $file_ext = explode('.', $file_name);
        $file_ext = trim(strtolower(end($file_ext)));

        $new_file_name = "user" . $id . '-' . 'pfp.' . $file_ext;


        if(!in_array($file_ext,$allowed_extensions))
            $message = "Please upload a valid file (png,jpg,jpeg) you uploaded:$file_ext";
        else if ($file_size > 25000000)
            $message = "File too large";
        else 
        {
            $target_dir = "../../img/uploads/{$new_file_name}";
            move_uploaded_file($file_temp,$target_dir);
            $new_pfp_path = $target_dir;
        }

        if($message != "")
        {
            http_response_code(415);
            echo json_encode(['status' => "FileError", 'content' => $message]);
            exit();
        }
    }

    
    $query = "UPDATE `users` SET `email`= :email, `name` = :uname, `pfp_path` = :pfp_path, `password` = :pass WHERE `id` = :id";

    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $new_email, 'uname' => $new_username, 'pfp_path' => $new_pfp_path, 'pass' => $new_pwd, 'id'=>$id]);

    //http_response_code(200);
    echo json_encode(['status' => "OK", 'content' => "User Updated"]);
}

?>
