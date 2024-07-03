<?php
include '../config/db_config.php';

function checkAttribute($pdo, $attr, $value)
{
    $query = "SELECT $attr FROM users WHERE $attr = :value";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['value' => $value]);

    $response = $stmt->fetch(PDO::FETCH_ASSOC);

    return $response;
}

if(isset($_POST['signup']))
{
    $email = $_POST['email'];
    $name = $_POST['username'];
    $password = $_POST['password'];

    $api_return = array('email' => true, 'name' => true, 'password' => true);

    $response = checkAttribute($pdo,'email',$email);
    if(!empty($response))
        $api_return['email'] = false;
    
    $response = checkAttribute($pdo,'name',$name);
    if(!empty($response))
        $api_return['name'] = false;

    echo json_encode($api_return);
}
?>