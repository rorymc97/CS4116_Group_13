<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!-- <link rel="stylesheet" type="text/css" href="CSS/footer.css"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="CSS/Profile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <title>Profile Page</title>
    </head>
    <body>

    

    <div class="menu">
            <?php 
            
            if($_SESSION['userType'] == "jobseeker"){
                include 'header.php';
            }

            else if($_SESSION['userType'] == "company"){
                include 'headercompany.php';
            }

            else if($_SESSION['userType'] == "admin"){
                include 'headeradmin.php';
            }
    ?>
    </div>


     <div class="container p-4">
        <h1>Profile</h1>
        <HR>
        <p>Displayed below is your profile</p>
        <?php
        // Echo session variables that were set previously

        $content = $_SESSION["userImage"];

        echo "<b>Name: </b>".$_SESSION["userFirstName"]." ".$_SESSION["userLastName"];
        echo "</br>";
        echo "<b>Bio: </b>".$_SESSION["userBio"];
        echo "</br>";
        echo "<b>ID: </b>".$_SESSION["userID"];
        echo "</br>";
        echo "<b>Password: </b>".$_SESSION["userPassword"];
        echo "</br>";
        ?>

        <div class="image-container">
        <?php echo "<img src=Images/".$_SESSION["userImage"];"/>"; ?>
        </div>
        
        <div class="user_skills_display">
            <?php if($_SESSION['userType']!='company'){require 'displayUserSkills.php';}?>
        </div>

        <div class = "user_quals_display">
            <?php if($_SESSION['userType']!='company'){require 'displayUserQualifications.php';}?>
            
        </div>

        <br>

        <div class = "company_vacancies_display">
            <?php if($_SESSION['userType']=='company'){require 'advertiseVacancy.php';}?>
            
        </div>

        <br>

        <div class = "upload_vacancy_form">
            <?php if($_SESSION['userType']=='company'){
                //require 'uploadVacancyForm.php';
                echo "<br>";
                echo "<h3> Create new vacancy: <a href='uploadVacancyForm.php'>upload vacancy</a></h3>";
                
                echo "<br>";
            
            }?>

    </div>


 </body>
</html>