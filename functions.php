<?php
//Login Functions
function emptyInput($email,$pwd){
    $empty;
    if(empty($email) || empty($email) ){
        $empty= TRUE;
    }
    else{
        $empty=FALSE
    }
    return $empty;


}

function invalidEmail($email, $conn){
    $stmt= $conn-> prepare("SELECT * FROM users WHERE email= :email;");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $result;

    if ($user['email']!==$email) {
        $result=true;
    }
    else{
        $result=false;
    } 
    return $result;
    
}

function invalidPassword($email,$pwd){
    $password = password_hash($pwd, PASSWORD_DEFAULT);
    $stmt= $conn-> prepare("SELECT * FROM users WHERE email= :email;");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $pwdHashed= password_verify($password, $user['password'])
    $result;

    if (password_verify($password, $user['password'])!==true) {
        $result=true;
    } else {
        $result=false;
    }
}

function passwordContainsReqiredCharacters($pwd){
    $criteria="^(?=.*[a-zA-Z])(?=.*\d).{8,}$";
    $value;
    if (preg_match($criteria,$pwd)===1){
        $value=false;
    }
    else{
        $value=true;
    }
    return $value;

}

function loginUser($conn,$email,$pwd){
    $password = password_hash($pwd, PASSWORD_DEFAULT);
    $stmt= $conn-> prepare("SELECT * FROM users WHERE email= :email;");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $pwdHashed= password_verify($password, $user['password'])
    $result;

    if (invalidEmail($conn,$email,$pwd)===false) {
        if (password_verify($password, $user['password'])===true) {
            session_start();
            $_SESSION["email"]=$user['email'];
            $_SESSION["id"]=$user['id'];
            header("location: ../dashboard.html")
        }
    }
        
         else {
            $result=false;
    }
}


