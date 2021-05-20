<?php 

  //adding in more varibales for error handling 

    $servername = "sql312.epizy.com";
    $username = "epiz_28009504";
    $password = "AtnzzYRZ7tnyAW";
    $dbname = "epiz_28009504_CS4116";
    $conn = new mysqli($servername, $username, $password,$dbname);

    // Check connection of our Database
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

 
    $message = "";

  if(isset($_POST['save-user'])) {


      //Declaring Variables

    $firstname;
    $lastname;
    $email;
    $bio; 
    $profileImage;
  


         
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $lastname = $_POST['lastname'];
        $bio = $_POST['bio'];
        $profileImage = time() . '_' . $_FILES['profile_image']['name'];

        $target = "Images/" . $profileImage;

        move_uploaded_file($_FILES['profile_image']['tmp_name'], $target);
    
          $sql = "UPDATE Users SET Profile_Pic='$profileImage',Firstname='$firstname',Lastname='$lastname',Email='$email',Bio='$bio' WHERE User_Id ='{$_SESSION['userID']}'";


          if (is_null($profileImage)) {
            move_uploaded_file($_FILES['profile_image']['tmp_name'], $target);
            $sql = "UPDATE Users SET Profile_Pic='Profile_avatar_placeholder_large.png' WHERE User_Id ='{$_SESSION['userID']}'";
          }


          if (mysqli_query($conn, $sql)) {
             $message = "Updated Details Uploaded To Database";


          } else {
             $message = "Failed to Upload Details to Database";           
          }

        

  }



?>