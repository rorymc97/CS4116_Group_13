<?php

if(isset($_POST["Submit"])){

    session_start();

    //get user input
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdRepeat"];
    $bio = $_POST["bio"];

    require_once '../includes/dbh-inc.php';
    require_once '../includes/functions-inc.php';
    
    if(emptyInputSignup($fname, $lname, $email, $pwd, $pwdRepeat, $bio) !== false){
        header("location: ../signupJobseeker.php?error=emptyinput");
        exit();
    }
    
    if(invalidEmail($email) !== false){
        header("location: ../signupJobseeker.php?error=invalidemail");
        exit();
    }
    
    if(pwdMatch($pwd, $pwdRepeat) !== false){
        header("location: ../signupJobseeker.php?error=passwordmismatch");
        exit();
    }
    
    if(emailExists($conn, $email) !== false){
        header("location: ../signupJobseeker.php?error=emailexists");
        exit();
    }

    if(weakPassword($pwd) !== false){
        header("location: ../signupJobseeker.php?error=weakpassword");
        exit();
    }

    //create session variables to pass to last page
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['email'] = $email;
    $_SESSION['pwd'] = $pwd;
    $_SESSION['bio'] = $bio;

    //createUser($conn, $fname, $lname, $email, $pwd, $bio);

    header("location: ./signupJobseeker2.php?error=none");
    exit();

}

else{
    header("location: ../login2.php");
    exit();
}