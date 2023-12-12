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
    //Data from Database
    $stmt = $conn->query("SELECT title,firstname,lastname,email,company,type FROM Contacts;");
    
    // Fetch the user from the database
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn=null; 

    echo '<table>';
    echo '<thead><tr><th>Name</th><th>Email</th><th>Company</th><th>Type</th><th>Link</th></tr></thead>';
    echo '<tbody>';
    foreach ($contacts as $contact) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($contact['title']) ." " . htmlspecialchars($contact['firstname']) ." ". htmlspecialchars($contact['lastname']) ." ".  '</td>';
      echo "<td>" . htmlspecialchars($contact['email']) . '</td>';
      echo "<td>" . htmlspecialchars($contact['company']) . '</td>';
      echo "<td>" . htmlspecialchars($contact['type']) . '</td>';
      echo "<td> <button id='viewBtn'>View</button> </td>";
      echo "</tr>";
    }
    echo '</tbody></table>';


}