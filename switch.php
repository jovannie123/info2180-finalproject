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


$contactEmail=$_GET['switch'];


$switchedTypeValue;



if (!$conn){
    
    die("Could not connect to the Database");
    
    $conn = null;
}
else{
    try{
       
        $stmt = $conn->prepare("SELECT * FROM Contacts WHERE email = ?;");
        $stmt->bindParam(1, $contactEmail);
        $stmt->execute();
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        $contactType=$contact['type'];
        
        

        switch($contactType){
            case "Sales Lead":
                $switchedTypeValue="Support";
                break;
            case "Support":
                $switchedTypeValue="Sales Lead";
                break;
            case "salesLead":
                $switchedTypeValue="Support";
                break;
            case "support":
                $switchedTypeValue="Sales Lead";
                break;
        }

        
        $stmt2 = $conn->prepare("UPDATE Contacts SET type = :switchedTypeValue WHERE email=:contactEmail;");
        $stmt2->bindParam(':switchedTypeValue', $switchedTypeValue);
        $stmt2->bindParam(':contactEmail', $contactEmail);
        $stmt2->execute();
        echo("Successfully Switched!!!");
    }
    catch(PDOException $e){
        echo("There was an Error");
    }
}
?>