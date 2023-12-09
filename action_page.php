<?php
require_once 'functions.php'
//Connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dolphin_crm';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!$conn){
    die("Could not connect to the the Databse");
}
else{
    //Insert admin credentials
    $adminEmail='admin@project2.com';
    $adminPwd='password123';
    $hashedAdminPwd = password_hash($adminPwd, PASSWORD_DEFAULT);
    $stmt= $conn-> prepare("IF NOT EXISTS(SELECT * FROM Users WHERE email='admin@project2.com', NULL , INSERT INTO Users(firstname,lastname,password,email,role,created_at) VALUES(admin,admin,'%$hashedAdminPwd%','%$adminEmail%',Admin,NOW())); ");
    $stmt->execute();
   //User Input 
    if(isset($POST["submit"])){
        $email= $POST["email"];
        $pwd= $POST["pwd"];
        $emailSanitize = filter_var($emailSanitize, FILTER_SANITIZE_EMAIL);
        
    }
    
    //Authentication
    if(emptyInput($emailSanitize,$pwd)){
        header("location: index.html")
        exit();
    }
    if(invalidEmail($emailSanitize)){
        header("location: index.html")
        exit();
    }
    if(invalidPassword($pwd)){
        header("location: index.html")
        exit();
    }
    if(passwordContainsReqiredCharacters($pwd)){
        header("location: index.html")
        exit();
    }

    loginUser($conn,$emailSanitize,$pwd);



}

