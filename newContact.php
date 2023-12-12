<?php
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
    $title=filter_var($_POST['title'],FILTER_SANITIZE_STRING);
    $firstname=filter_var($_POST['fname'],FILTER_SANITIZE_STRING);
    $lastname=filter_var($_POST['lname'],FILTER_SANITIZE_STRING);
    $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $phone=filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
    $company=filter_var($_POST['company'],FILTER_SANITIZE_STRING);
    $type=filter_var($_POST['work'],FILTER_SANITIZE_STRING);
    $assignedTo=filter_var($_POST['assignedTo'],FILTER_VALIDATE_INT);
    $createdBy=filter_var($_POST['createdby'],FILTER_VALIDATE_INT);


    
    try{
        $stmt = $conn->prepare("INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at)
        VALUES 
        (:title, :firstname, :lastname,:email,:phone,:company,:type,:assignedTo,:createdBy, NOW(), NOW());");
        
        $stmt->bindParam(':title',$title);
        
        $stmt->bindParam(':firstname',$firstname);
        
        $stmt->bindParam(':lastname',$lastname);
        
        $stmt->bindParam(':email',$email);
        
        $stmt->bindParam(':phone',$phone);
        
        $stmt->bindParam(':company',$company);
        
        $stmt->bindParam(':type',$type);
        $stmt->bindParam(':assignedTo',$assignedTo);
        $stmt->bindParam(':createdBy',$createdBy);
        $stmt->execute();


        echo("Contact was added successfully!!!");
        $conn = null;

        
    }
    catch(PDOException $e){
        echo("There was an Error with the server");
        $conn = null;
    }

    }
    else{
        echo("Please submit data")
    }
}