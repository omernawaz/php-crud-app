<?php 
include '../config/db_config.php';
if(isset($_REQUEST['login']))
{
    $email = $_POST['email'];

    $query = "SELECT id,name,email FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);

    $response = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $response['id'];
    $username = $response['name'];


    $api_return = array('logged'=>true, 'id'=>$id, 'email'=>$email, 'username'=>$username);

    echo json_encode($api_return);

}
?>
