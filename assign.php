<?php
require_once 'functions.php';
session_start();
//Connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dolphin_crm';


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$contactEmail=$_GET['assign'];


if (!$conn){
    
    die("Could not connect to the Database");
    
    $conn = null;
}
else{
    try{
        //Session
        $loggedInUseremail=$_SESSION['email'];
        
        //Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id FROM Users WHERE email = ?;");
        $stmt->bindParam(1, $loggedInUseremail);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $idnum= $user['id'];


        $stmt2 = $conn->prepare("UPDATE Contacts SET assigned_to=? WHERE email='$contactEmail';");
        $stmt2->bindParam(1, $idnum);
        $stmt2->execute();
        
        echo("Contact assigned to you.");
        //$conn=null;
        //header("location: dashboardIndex.php");
    }
    catch(PDOException $e){
        echo("There was an Error");
    }
}
?>