<?php
//require_once 'functions.php'
//Connection
$host = 'localhost';
$username = 'user';
$password = 'pass123';
$dbname = 'dolphin_crm';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!$conn){
    
    die("Could not connect to the the Databse");
}
else{
    //Insert admin credentials
    header("location: dashboard.html");
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
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        //Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, email, password FROM Users WHERE email = ?");
        $stmt->bindParam(1, $emailSanitize);
        $stmt->execute();

        // Fetch the user from the database
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and the password is correct
        if ($user && password_verify($hashedPwd, $user['password'])) {
            // Successful login
            echo json_encode(['success' => true, 'email' => $user['email']]);
            
        } else {
            // Invalid credentials
            echo json_encode(['success' => false]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    // Close the connection
    $conn = null;
        
    }