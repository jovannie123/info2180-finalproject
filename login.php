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
            //User Input 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email= $_POST["email"];
            $pwd= $_POST["pword"];

            //Session
            $_SESSION['email'] = $_POST['email'];
            

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
            if ($inputHashedPwd===$userPwd) {
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
                    header("location: dashboardIndex.php");
                } 
                
            } else {
                // Invalid credentials
                echo("Credentials did not match.");
                //header("location: loginIndex.php");
                exit();
            }
        } 
        else{
            echo("Invalid Form Method");
        }

        // Close the connection
        $conn = null;
    }
    catch(PDOException $e){
        echo("There was an Error with the server");
        $conn = null;
    }
   
        
}

// Start or resume the session


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email from the form
    
    

    // Store email in session variable
    $_SESSION['email'] = $_POST['email'];
    echo($_SESSION['email']);

    // Redirect to another page (profile.php in this example)
    
}
else{
    echo("Something went Wrong");
}
