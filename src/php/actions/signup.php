<?php
include '../config/db_config.php';
include '../validations/signup-validation.php';


    if(isset($_REQUEST['signup']) && $validation['email'] && $validation['name'])
    {
        $email = $_POST['email'];
        $username = $_POST['uname'];
        $password = $_POST['pwd'];

        $query = "INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES (NULL, :email, :username, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $email, 'username'=>$username, 'password'=>$password]);

        $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $pdo->lastInsertId();
        
        http_response_code(200);
        echo json_encode(['status' => "OK", 'content' => "User succesfully registered", 'id' => $id]);
    }
    else{
        http_response_code(401);
        echo json_encode(array_merge(['status' => "ValidationError", 'content' => "Credentials were invalid"], $validation));
    }

?>