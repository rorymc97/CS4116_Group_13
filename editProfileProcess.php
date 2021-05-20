<?php 

  //adding in more varibales for error handling 

    require "includes/dbh-inc.php";

  $css = "";
  $message = "";

  if(isset($_POST['save-user'])) {


      //Declaring Variables
    $uid;
    $firstname;
    $lastname;
    $email;
    $bio; 
      
        $uid = $_POST['uid'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $lastname = $_POST['lastname'];
        $bio = $_POST['bio'];

        $sql = "UPDATE Users SET Firstname='$firstname',Lastname='$lastname',Email='$email',Bio='$bio' WHERE User_Id ='$uid'";
          if (mysqli_query($conn, $sql)) {
             $message = "Updated Details Uploaded To Database";
                
          } else {
             $message = "Failed to Upload Details to Database";           
          }
  }



?>