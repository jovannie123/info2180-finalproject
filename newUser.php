<?php
require_once 'functions.php';
//Connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dolphin_crm';


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!$conn){
    
    die("Could not connect to the Database");
    
    $conn = null;
}
else{
   //User Input 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Santizie String
    $firstname=filter_var($_POST['fname'],FILTER_SANITIZE_STRING);
    $lastname=filter_var($_POST['lname'],FILTER_SANITIZE_STRING);
    $password=filter_var($_POST['pword'],FILTER_SANITIZE_STRING);
    $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $role=filter_var($_POST['role'],FILTER_SANITIZE_STRING);
    
    //Check if password has required characters
    if(passwordContainsReqiredCharacters($password)){
        try{
            $stmt = $conn->prepare("INSERT INTO Users(firstname,lastname,password,email,role,created_at)
            VALUES
            (:firstname,:lastname,PASSWORD(:password),:email,:role,NOW());");
            $stmt->bindParam(':firstname',$firstname);
            $stmt->bindParam(':lastname',$lastname);
            $stmt->bindParam(':password',$password);
            $stmt->bindParam(':email',$email);
            $stmt->bindParam(':role',$role);
            $stmt->execute();
    
            echo("User was added successfully!!!");
            $conn = null;
    
            
        }
        catch(PDOException $e){
            echo("There was an Error with the server");
            $conn = null;
        }
    }
    else{
        echo("There was an error with data entered. Try again");
        $conn = null;
    }

    }
}