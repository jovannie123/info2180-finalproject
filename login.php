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
        $email= $_POST["email"];
        $pwd= $_POST["pword"];
        

        //Sanitize
        $emailSanitize = filter_var($email, FILTER_SANITIZE_EMAIL);
        $pwdSanitize=filter_var($pwd, FILTER_SANITIZE_STRING);
        //$hashedPwd = password_hash($pwdSanitize, PASSWORD_DEFAULT);
        

        //Get hashed User input password 

        $Inputstmt = $conn->prepare("SELECT PASSWORD(?);");
        $Inputstmt->bindParam(1, $pwdSanitize);
        $Inputstmt->execute();
        $Inputhashed = $Inputstmt->fetch(PDO::FETCH_ASSOC);
        $inputHashedPwd=$Inputhashed["PASSWORD('$pwdSanitize')"];


        //Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, email, password FROM Users WHERE email = ?");
        $stmt->bindParam(1, $emailSanitize);
        $stmt->execute();

        // Fetch the user from the database
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $userPwd=$user['password'];
        

        // Check if the user exists and the password is correct
        if (true) {
            // Successful login
            //echo json_encode(['success' => true, 'email' => $user['email']]);
            //echo("Login Success!!!");
            //Authentication
            if(emptyInput($emailSanitize,$pwdSanitize)){
                echo("Empty");
                //header("location: login.html")
                //exit();
            }
            elseif(invalidEmail($emailSanitize,$conn)){
                echo("Invalid Email");
                //header("location: login.html")
                //exit();
            }
            elseif(invalidPassword($userPwd,$inputHashedPwd)){
                echo("Invalid Password");
                //header("location: login.html")
                //exit();
            }
            /*if(passwordContainsReqiredCharacters($pwdSanitize)){
                echo("Not Enough Characters");
                //header("location: login.html")
                //exit();
            }*/

            else{
                //User logged
                echo("Dashboard");
                header("location: dashboard.html");
            } 
            
        } else {
            // Invalid credentials
            echo("Credentials did not match.");
            header("location: login.html");
            exit();
        }
    } 
    else{
        die("Invalid Form Method");
    }

    // Close the connection
    $conn = null;
        
    }