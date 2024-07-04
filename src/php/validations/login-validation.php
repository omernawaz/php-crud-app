<?php 

include '../config/db_config.php';

$id = 0;
if(isset($_REQUEST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    

    $validation = array('email' => true, 'password'=>false);

    $query = "SELECT * FROM users WHERE email=:value";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['value' => $email]);
    $response = $stmt->fetch(PDO::FETCH_ASSOC);


    
    if(empty($response))
        $validation['email'] = false;
    else if($password == $response['password'])
        $validation['password'] = true;

    $id = $response['id'];
}



?>