<?php 

include '../config/db_config.php';

if(isset($_REQUEST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $api_response = array('email' => true, 'password'=>false);

    $query = "SELECT * FROM users WHERE email=:value";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['value' => $email]);
    $response = $stmt->fetch(PDO::FETCH_ASSOC);

    if(empty($response)){
        $api_response['email'] = false;
    }
    else if($password == $response['password'])
    {
        $api_response['password'] = true;
    }

    echo json_encode($api_response);
}



?>