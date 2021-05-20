<?php
// Start the session
session_start();
?>

<?php 
require "includes/dbh-inc.php";
include 'profile_process.php'
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Account Details</title>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link href="CSS/Account.css" rel="stylesheet" type="text/css">
        <link href="CSS/footer.css"  rel="stylesheet" type="text/css">
        

    </head>
    <body>
        <div class="menu">
            <?php require 'headeradmin.php';?>
        </div>
      <div class="container p-4">  
        <div class="title">
            <h1>Account</h1>
            <HR>
            <p>Displayed below are your account details</p>
        </div>
        <div class = "account_details">
            <?php require 'displayUserAccountDetails.php'?>
        </div>


        <!-- Profile Picture and Bio Details -->

        <div class = "profile-pic container">
            <div class"profile-pic row">
                <div class="col-4 offset-md-4 form-div">
                    <form action="account.php" method="post" enctype="multipart/form-data">
                        

                        <!--Adding our alert message and Bootstrap PhP-->

                            <?php if(!empty($message)); ?>
                                <div class= "alert <?php echo $message ?> ">
                                    <?php echo $message ?>
                                </div> 
                            

                        <div class="form-group">
                            <image src="Images/placeholder.jpg" id="profileDisplay" alt="profilepicture" onclick="triggerClick()" />
                            <label for="profile_image">Profile Picture</label>
                            <input type="file" name="profile_image" id="profile_image" class="form-control" onchange="imageDisplay(this)" required>
                        </div>

                        <div class="form-group">

                            <label for="firstname">Firstname:</label>
                            <input type="text" id="firstname" name="firstname" class="form-control" value=<?php echo $_SESSION["userFirstName"]; ?> required>
                            
                        </div>

                        <div class="form-group">

                            <label for="lastname">Lastname:</label>
                            <input type="text" id="lastname" name="lastname" class="form-control" value=<?php echo $_SESSION["userLastName"]; ?> required>
                            
                        </div>

                        <div class="form-group">

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" value=<?php echo $_SESSION["userEmail"]; ?> required>
                            
                        </div>

                        <div class="form-group">

                            <label for="bio">Bio:</label>
                            <textarea name="bio" id="bio" class="form-control" required ></textarea>

                        </div>


                        <div class="form-group">
                            <button type="submit" name="save-user" class="btn btn-primary btn-block"> Save Changes to User Details </button>
                        </div>

                    </form>    
                </div>
            </div
        </div>

      </div>  


        <!-- <div class="footer">
            <div class="inner-footer">
                <div class="logo-container">
                    <img src="logo2.png" alt="logo">
                </div> 

                <div class="footer_thrid">
                    <h3>Need Help?</h3>
                        <a href="#">Terms and Conditions</a>
                        <a href="#">Privacy Policy</a>
                </div>

                <div class="footer_thrid">
                    <h3>More Information</h3>
                        <a href="#">Donate</a>
                        <a href="#">Governance</a>
                        <a href="#">Reports</a>
                        <a href="#">Conservation Efforts</a>
                </div>

                <div class="footer_thrid">
                    <h3>Follow Us</h3>
                        <a href="#"><i class="fa fa-facebook" title="Edit"></i></a>
                        <a href="#"><i i class="fa fa-twitter" title="Edit"></i></a>
                        <a href="#"><i class="fa fa-instagram" title="Edit"></i></a>
                        <a href="#"><i class="fa fa-linkedin-square" title="Edit"></i></a>
                </div>
        </div>
       </div> -->
    
        <!-- Adding Some Javascript so our Image pops up when Selected -->

        <script>

            function triggerClick() {

                document.querySelector('#profile_image').click();
                                    }

            function imageDisplay(e) {

                 if (e.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function(e) {
                    document.querySelector('#profileDisplay').setAttribute('src',e.target.result);
                                                }
                    reader.readAsDataURL(e.files[0]);
                }
            }

        </script> 


     
    </body>
        <!-- <div>
            <?php //require 'footer.php';?>
        </div> -->
</html>
