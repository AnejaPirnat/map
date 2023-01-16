<?php

require_once 'database.php';

$email = $_POST['email'];
$pass = $_POST['pass'];
$username = $_POST['username'];

//preverim podatke, da so obvezi vnešeni
if (!empty($username) && !empty($email) && !empty($pass))
   {
    
    //$pass = sha1($pass1.$salt);
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users (email, password, username) VALUES (?,?,?)";

    $stmt = $pdo->prepare($query);
    
    $stmt->execute([$email, $pass, $username]);
   
   header("Location: login.php");
}
else {
   header("Location: registration.php?error=true");
}
?>