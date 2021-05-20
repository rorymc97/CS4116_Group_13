
<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/footer.css">
        <link rel="stylesheet" type="text/css" href="CSS/search.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"          rel="stylesheet"integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <title>Network Page</title>
    </head>
    <body>
        
        <div class="menu">
            <?php require 'header.php';?>
        </div>
        <div class="container p-4">
        <h1>Network</h1>
        <HR>
        

        <div class="users_network_display">
            <p>Displayed below are your network</p>
            <?php require 'displayNetwork.php';?>
        </div>

        <!--<div class="connections_search">
            <form method="POST" action="Cormacsearch2.php">

                <input type="text" name="search" id="search" placeholder="Look for Connections?" />
                <input type="submit" value="SUBMIT" />
            </form>
        </div>-->

        <br>
        <br>
        
        <div class="connections_search_with_connect">
            <form method="POST" action="searchConnections.php">

                <input type="text" name="search" id="search" placeholder="Look for Connections By Name?" />
                <input type="submit" value="SUBMIT" />
            </form>
        </div>

       <br>
       <br>


        <div class = "suggestedconnections">
            
            <?php 
            //require 'getSuggestedConnections.php';
            echo "<h5>Connections you may know: <a href='getSuggestedConnections.php'>Mutual Connections</a></h5>";
            ?>

        </div>
        <div>
           
        <br>
        <br>
        <br>

      <!--  <div class="footer">
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

                        <h5 class="text-uppercase mb-4 font-weight-bold text-warning"> Follow us </h5>
                       
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

                    <div class="align-middle">

                        <br>
                        <p> @CS4116 Copyright Group 13 2021 </p>

                    </div>

                </div>
            </div>
        </div>

        </footer>

    
    </body>
</html>