<?php 
include '../config/db_config.php';
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $id = $_POST['id'];
    $response = null;

    if($id == '*')
    {  

        $query = "SELECT id,email,name,pfp_path,is_admin FROM users";

        if(isset($_POST['filter'])){
            $filter = $_POST['filter'];
            $query .= " WHERE email LIKE '%$filter%' OR name LIKE '%$filter%'";
        }
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $id]);
    
        $response = $stmt->fetch(PDO::FETCH_ASSOC);
        unset($response['password']);
    }
    

    echo json_encode($response);
}
?>