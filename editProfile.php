<?php
// Start the session
session_start();

?>

<?php 
require "includes/dbh-inc.php";
include 'editProfileProcess.php';
include 'getUserFromId.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Account Details</title>

        <link rel="stylesheet" type="text/css" href="CSS/footer.css">
        <!--<link href="CSS/Account.css" rel="stylesheet" type="text/css">-->
        

    </head>
    <body style="background-image: url('background.jpg')";>        
    <div class="menu">
            <?php require 'headeradmin.php';
            if($_GET['uid']){

            $uid = $_GET['uid'];

            $firstname = getUserFromId($uid)[0]["Firstname"];
            $lastname = getUserFromId($uid)[0]["Lastname"];
            $email = getUserFromId($uid)[0]["Email"];
            $bio = getUserFromId($uid)[0]["Bio"];
        }
        ?>
        </div>
    <div class="container p-4" style="background-color: white; width: 1000px; min-width:700px; margin-top: 20px; margin-bottom: 20px; "> 
        <div class="title">
            <center><h1>Edit User #<?php echo $uid; ?> Account</h1><center>
            <HR>
        </div>

        <!-- Profile Picture and Bio Details -->

        <div class = "profile-pic container">
            <div class"profile-pic row">
                <div class="col-4 offset-md-4 form-div">
                    <form action="listUsers.php" method="post" enctype="multipart/form-data">
                        

                        <!--Adding our alert message and Bootstrap PhP-->

                            <?php if(!empty($message)); ?>
                                <div class= "alert <?php echo $message ?> ">
                                    <?php echo $message ?>
                                </div> 
                            

                        <div class="form-group">

                            <label for="firstname">Firstname:</label>
                            <input type="text" id="firstname" name="firstname" class="form-control" value=<?php echo $firstname; ?> required>
                            
                        </div>

                        <div class="form-group">

                            <label for="lastname">Lastname:</label>
                            <input type="text" id="lastname" name="lastname" class="form-control" value= <?php echo $lastname; ?> required>
                            
                        </div>

                        <div class="form-group">

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" value=<?php echo $email; ?> required>
                            
                        </div>

                        <div class="form-group">

                            <label for="bio">Bio:</label>
                            <input type="text" name="bio" id="bio" class="form-control" value=<?php echo $bio; ?> required>
                            <input id="uid" name="uid" type="hidden" value=<?php echo $uid; ?>>
                        </div>


                        <div class="form-group">
                            <button type="submit" name="save-user" class="btn btn-primary btn-block"> Save Changes to User Details </button>
                        </div>

                    </form>    
                </div>
            </div>
        </div> 
    </div>
    
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
<?php
 require "footer.php";
 ?>
</html>
