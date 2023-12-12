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



if (!$conn){
    
    die("Could not connect to the Database");
    
    $conn = null;
}
else{
    try{
        $comment=filter_var($_POST['createNote'],FILTER_SANITIZE_STRING);
        $contactEmail=filter_var($_POST['fixed'],FILTER_SANITIZE_STRING);
        echo($contactEmail);

        //Session
        $loggedInUseremail=$_SESSION['email'];
        //Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id FROM Users WHERE email = ?");
        $stmt->bindParam(1, $loggedInUseremail);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $userIdNum= $user['id'];


        $stmt2 = $conn->prepare("SELECT id FROM Contacts WHERE email=?");
        $stmt2->bindParam(1, $contactEmail);
        $stmt->execute();
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        $contactIdNum= $contact['id'];

        

        $stmt3 = $conn->prepare("INSERT INTO Notes(contact_id,comment,created_by,created_at)
            VALUES
            (:contact_id,:comment,:created_by,NOW());");
            $stmt3->bindParam(':contact_id',$contactIdNum);
            $stmt3->bindParam(':comment',$comment);
            $stmt3->bindParam(':created_by',$userIdNum);
            $stmt3->execute();
    
            //echo("Your Note was successfully added!!!");
            $conn=null;
            header("location: dashboardIndex.php");
            $conn = null;

    }
    catch(PDOException $e){
        echo("There was an Error");
    }
}
?>