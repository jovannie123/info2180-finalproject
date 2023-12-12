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
    $stmt = $conn->query("SELECT firstname,lastname,email,role,created_at FROM Users;");
    
    // Fetch the user from the database
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn=null; 

    echo '<table>';
    echo '<thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Created</th></tr></thead>';
    echo '<tbody>';
    foreach ($users as $user) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($user['firstname']) ." ". htmlspecialchars($user['lastname']) ." ".  '</td>';
      echo "<td>" . htmlspecialchars($user['email']) . '</td>';
      echo "<td>" . htmlspecialchars($user['role']) . '</td>';
      echo "<td>" . htmlspecialchars($user['created_at']) . '</td>';
      echo "</tr>";
    }
    echo '</tbody></table>';


}