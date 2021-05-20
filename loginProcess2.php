<?php 
session_start();
$email = $_POST["em"];
$password = $_POST["pwd"];

require_once "includes/dbh-inc.php";

$sql = "select * from Users WHERE Email='{$_POST[em]}' and Password = '{$_POST[pwd]}';";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

if($row["Status"] == 'banned') {
    header("location: ./login2.php?error=userbanned");
    exit();
}

else if($row["Email"] == $_POST["em"] and $row["Password"] == $_POST["pwd"]){

    if($row["Type"] == "jobseeker"){
        include 'header.php';
    }

    else if($row["Type"] == "company"){
        include 'headercompany.php';
        
    }

    else if($row["Type"] == "admin"){
        include 'headeradmin.php';
        header("location: listVacancies.php");
        exit();
    }
    
        
    // Set session variables
    $userFirstName =$row["Firstname"];
    $userLastName = $row["Lastname"];
    $userBio = $row["Bio"];
    $userEmail = $row["Email"];
    $userPassword = $row["Password"];
    $userID = $row["User_Id"];
    $userType = $row["Type"];
    $userImage = $row["Profile_Pic"];


    $_SESSION["userFirstName"] = $userFirstName;
    $_SESSION["userLastName"] = $userLastName;
    $_SESSION["userBio"] = $userBio;
    $_SESSION["userEmail"] = $userEmail;
    $_SESSION["userPassword"] = $userPassword;
    $_SESSION["userID"] = $userID;
    $_SESSION["userType"] = $userType;
    $_SESSION["userImage"] = $userImage;
    echo "<br>";

    echo "<h3>Welcome $userFirstName!";
   //include 'footer.php';

}



else{
    header("location: ./login2.php?error=invalidlogin");
    exit();
}

$conn->close();

?>

<!--<a href="logout.php"> Logout? </a>-->