<?php
//Login Functions
function emptyInput($email,$pwd){
    $empty;
    if(empty($email) || empty($email) ){
        $empty= TRUE;
    }
    else{
        $empty=FALSE;
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

function invalidPassword($userPwd,$Inputpwd){
    if ($userPwd!==$Inputpwd) {
        $result=true;
    } else {
        $result=false;
    }
}

function passwordContainsReqiredCharacters($pwd){
    $criteria='/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
    $value;
    if (preg_match($criteria,$pwd)===1){
        $value=true;
    }
    else{
        $value=false;
    }
    return $value;

}


    


