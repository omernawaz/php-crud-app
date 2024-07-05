<?php 

require '../config/db_config.php';


class User {
    
    protected static function checkAttribute($pdo, $attr, $value)
    {
        $query = "SELECT $attr FROM users WHERE $attr = :value";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['value' => $value]);

        $response = $stmt->fetch(PDO::FETCH_ASSOC);

        return $response;
    }

    protected static function saveUserFile(&$new_file_path, $id, $pfp_file)
    {

        $allowed_extensions = ['png', 'jpg', 'jpeg'];

        $message = "";

        $file_name = $pfp_file['name'];
        $file_size = $pfp_file['size'];
        $file_temp = $pfp_file['tmp_name'];


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
            $new_file_path = $target_dir;
            return true;
        }

        if($message != "")
        {
            $new_file_path = ['status' => "FileError", 'content' => $message, 'code' => 415];
            return false;
        }
    }

    protected static function addUser($pdo, $email, $username, $password){

        $query = "INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES (NULL, :email, :username, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $email, 'username'=>$username, 'password'=>$password]);

        $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $pdo->lastInsertId();

        return $id;
    }

    public static function getUser($id, $filter = ''){

        $pdo = dbHandler::getHandler();
        $response = '';
        if($id == '*')
        {  

            $query = "SELECT id,email,name,pfp_path,is_admin FROM users";

            if(!empty($filter)){
                $filter = $_POST['filter'];
                $query .= " WHERE email LIKE '%$filter%' OR name LIKE '%$filter%'";
            }

            $query .= ' ORDER BY `is_admin` desc';

            $stmt = $pdo->prepare($query);
            $stmt->execute();
        
            $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            $query = "SELECT id,email,name,pfp_path,is_admin  FROM users WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['id' => $id]);
        
            $response = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $response;
    }

    public static function signUser($email, $name, $password) {

        $pdo = dbHandler::getHandler();

        $validation = array('email' => true, 'name' => true, 'password' => true, 'code' => 200);

        $response = self::checkAttribute($pdo,'email',$email);
        if(!empty($response))
            $validation['email'] = false;
        
        $response = self::checkAttribute($pdo,'name',$name);
        if(!empty($response))
            $validation['name'] = false;

        if($validation['name'] && $validation['email']){
            $id = self::addUser($pdo,$email,$name,$password);
            $userInfo = self::getUser($id);
            $validation = array_merge($validation,$userInfo);
        }
        else {
            $validation['code'] = 401;
        }

        return $validation;

    }

   

    public static function logUser($email, $password) {

        $pdo = dbHandler::getHandler();

        $validation = array('email' => true, 'password'=>false, 'code' => 401);

        $query = "SELECT * FROM users WHERE email=:value";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['value' => $email]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);


        
        if(empty($response)){
            $validation['email'] = false;
            $validation['code'] = 404;
        }
        else if($password == $response['password']) {
            $validation['password'] = true;
            $validation['code'] = 200;
            unset($response['password']);
            $userInfo = self::getUser($response['id']);
            $validation = array_merge($validation,$userInfo);
        }

        return $validation;
    }

    public static function updateUser($id, $new_email, $new_username, $new_pwd,$pfp_file ){

        $pdo = dbHandler::getHandler();

        $user = self::getUser($id);
        $entered_password = $_POST['pwd'];

        $auth = self::logUser($user['email'], $entered_password);

        if($auth['code'] != 200) {
            return ['status' => 'AuthError', 'content' => 'Incorrect Password', 'code' => 401];
        }

        $new_pfp_path = $user['pfp_path'];

        if(empty($new_pwd))
            $new_pwd = $entered_password;

        if($pfp_file != null) {
            if(!self::saveUserFile($new_pfp_path,$id,$pfp_file)){
                return $new_pfp_path;
            }
        }

        
        $query = "UPDATE `users` SET `email`= :email, `name` = :uname, `pfp_path` = :pfp_path, `password` = :pass WHERE `id` = :id";

        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $new_email, 'uname' => $new_username, 'pfp_path' => $new_pfp_path, 'pass' => $new_pwd, 'id'=>$id]);

        return ['status' => "OK", 'content' => "User Updated", 'code'=>200];

    }

    public static function deleteUser($id) {

        $pdo = dbHandler::getHandler();

        $query = "DELETE FROM users WHERE users.id = :id";
        $stmt = $pdo->prepare($query);

        $stmt->execute(['id'=>$id]);

        
        return ['status' => "Sucess", 'content' => "User Deleted Successfully"];

    }

    public static function makeAdmin($id) {

        $pdo = dbHandler::getHandler();

        $query = "UPDATE `users` SET `is_admin` = 1 WHERE `id` = :id";
        $stmt = $pdo->prepare($query);

        $stmt->execute(['id'=>$id]);

        return ['status' => "Sucess", 'content' => "User Made Admin Successfully"];
    }
}


?>