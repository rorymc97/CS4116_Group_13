<?php

if(isset($_POST["Submit"])){

    session_start();

    //get user input
    $cname = $_POST["fname"];
    $lname = 'tmp';
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $bio = $_POST["bio"];

    $industry = $_POST["industry"];
    $phone = $_POST["phone"];

    require_once '../includes/dbh-inc.php';
    require_once '../includes/functions-inc.php';
    
    if(emptyInputSignup($cname, $lname, $email, $pwd, $pwdRepeat, $bio) !== false){
        header("location: ../signupCompany.php?error=emptyinput");
        exit();
    }
    
    if(invalidEmail($email) !== false){
        header("location: ../signupCompany.php?error=invalidemail");
        exit();
    }
    
    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../signupCompany.php?error=passwordmismatch");
        exit();
    }
    
    if(emailExists($conn, $email) !== false){
        header("location: ../signupCompany.php?error=emailexists");
        exit();
    }    
    
    if(companyExists($conn, $cname) !== false){
        header("location: ../signupCompany.php?error=companyexists");
        exit();
    }

    if(weakPassword($pwd) !== false){
        header("location: ../signupCompany.php?error=weakpassword");
        exit();
    }

    createCompany($conn, $cname, $lname, $email, $pwd, $bio, $industry, $phone);

    header("location: ./signupJobseekerConfirm.php?error=none");
    exit();

}

else{
    header("location: ../login2.php");
    exit();
}