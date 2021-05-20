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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="CSS/vacancies.css" rel="stylesheet" type="text/css">
        <!-- <link href="CSS/footer.css"  rel="stylesheet" type="text/css"> -->
        

    </head>
    <body>
        <div class="menu">
            <?php require 'header.php';?>
        </div>

         <div class="container p-4">  
            <div class="title">
                <h1>Vancancies</h1>
                <HR>
                <p>Displayed below are open vacancies</p>
            </div>

        <div class="vacancies_display">
          <table class="table table-striped">
            <?php include 'displayVacancies.php'?>
          </table >  
        </div>   

        <br>
        <br>

         <div class="vacancies_search">
            <form method="POST" action="searchVacancies.php">

                <input type="text" name="search" id="search" placeholder="Look for Vacancies" />
                <input type="submit" value="SUBMIT" />

            </form>
        </div>

        <div class="suggested_vacancies">
            <p>Displayed below are suggested vacancies based on your skills</p>
            <?php require 'getSuggestedVacancies.php'?>
        </div>


        <!-- Profile Picture and Bio Details -->



        </div>
    
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
       
        
        <footer class"sticky-footer">

            <div class="bg-dark text-white pt-5 pb-4">
                <div class="container text-center text-md-left">
                    <div class="row text-center text-md-left">

                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        
                        <img src="logo2.png" alt="logo">

                    </div>


                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h5 class="text-uppercase mb-4 font-weight-bold text-warning"> Need Help? </h5>
                       
                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"> Privacy Policy </a>
                            </p>

                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"> Terms and Conditions </a>
                            </p>

                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"> Frequently asked questions </a>
                            </p>


                    </div>

                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">

                        <h5 class="text-uppercase mb-4 font-weight-bold text-warning"> More Information </h5>
                       
                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"> Governance </a>
                            </p>

                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"> Reports </a>
                            </p>

                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"> Github </a>
                            </p>

                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"> Donation </a>
                            </p>

                    </div>

                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">

                        <h5 class="text-uppercase mb-4 font-weight-bold text-warning"> Follow Us </h5>
                       
                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"><i class="fa fa-facebook" title="Edit"></i></a>
                            </p>

                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"><i class="fa fa-twitter" title="Edit"></i></a>
                            </p>

                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"><i class="fa fa-instagram" title="Edit"></i></a>
                            </p>

                            <p>
                                <a href="#" class="text-white" style="text-decoration: none;"><i class="fa fa-linkedin-square" title="Edit"></i></a>
                            </p>


                    </div>

                   

                </div>
            </div>
        </div>

        </footer>

     
    </body>
        <!-- <div>
            <?php //require 'footer.php';?>
        </div> -->
</html>