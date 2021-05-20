<?php
include_once 'header.php';
?>
<div class="container p-4">
    <h2>Admin Sign Up Page</h2>
    <HR>
    <form action="signupProcess.php" method="POST">
           <table>
       
                    <tr>    
                        <td>First Name </td>
                        <td>
                            <input type="text" name="fname" id="fname">
                        </td>
                    </tr>

                    <tr>
                        <td> Last Name </td>
                        <td>
                            <input type="text" name="lname" id="lname">
                        </td>
                    </tr>

                    <tr>
                        <td> Email </td>
                        <td>
                            <input type="text" name="email" id="email">
                        </td>
                    </tr>

                    <tr>
                        <td>Password </td>
                        <td>
                            <input type="text" name="password" id="password">
                        </td>
                    </tr>

                    <tr>
                        <td>Retype Password </td>
                        <td>
                            <input type="text" name="passwordrepeat" id="passwordrepeat">
                        </td>
                    </tr>

                    <tr>
                        <td> Bio </td>
                        <td>
                            <input type="text" name="bio" id="bio">
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td> Click here to submit </td>
                        <td>
                            <button name="Submit_button" type="Submit" value="Submit">
                                Submit
                            </button>
                        </td>
                    </tr>
               </table>     
    </form>
</div>    
</body>
</html>

