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
    $name = $_POST['uname'];
    $password = $_POST['pwd'];

    $validation = array('email' => true, 'name' => true, 'password' => true);

    $response = checkAttribute($pdo,'email',$email);
    if(!empty($response))
        $validation['email'] = false;
    
    $response = checkAttribute($pdo,'name',$name);
    if(!empty($response))
        $validation['name'] = false;

}
?>