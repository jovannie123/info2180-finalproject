<?php
require_once 'functions.php';
//Connection
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'dolphin_crm';


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Session variable
session_start();
$idNum;
$loggedInUser=$_SESSION["email"];
$emailSanitize = filter_var($loggedInUser, FILTER_SANITIZE_EMAIL);
//Get ID from Database
$stmt = $conn->prepare("SELECT id FROM Users WHERE email = ?");
$stmt->bindParam(1, $emailSanitize);
$stmt->execute();

// Fetch the user from the database
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$userID=$user['id'];



if (!$conn){
    
    die("Could not connect to the Database");
    
    $conn = null;
}
else{
    //Data from Database
    $stmt = $conn->prepare("SELECT title,firstname,lastname,email,company,type FROM Contacts WHERE assigned_to=?;");
    $stmt->bindParam(1, $userID);
    $stmt->execute();
    // Fetch the user from the database
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn=null; 

    echo '<table>';
    echo '<thead><tr><th>Name</th><th>Email</th><th>Company</th><th>Type</th></tr></thead>';
    echo '<tbody>';
    foreach ($contacts as $contact) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($contact['title']) ." " . htmlspecialchars($contact['firstname']) ." ". htmlspecialchars($contact['lastname']) ." ".  '</td>';
      echo "<td>" . htmlspecialchars($contact['email']) . '</td>';
      echo "<td>" . htmlspecialchars($contact['company']) . '</td>';
      echo "<td>" . htmlspecialchars($contact['type']) . '</td>';
      echo "</tr>";
    }
    echo '</tbody></table>';


}