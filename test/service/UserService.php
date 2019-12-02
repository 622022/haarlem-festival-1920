<?php

include __DIR__ . '/../util/db.php';

class UserService{
    public function CheckUser($username, $password) {
        $conn = OpenCon();
    
        $result = $conn->query("SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'");
    
        return $result;
        
        CloseCon($conn);
    
    }
    
    public function RegisterUser($username, $email, $password) {
        $conn = OpenCon();
    
        $result = $conn->query("INSERT into `users` (username, password, email, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$trn_date')");
    
        return $result;
        
        CloseCon($conn);
    
    }
}






