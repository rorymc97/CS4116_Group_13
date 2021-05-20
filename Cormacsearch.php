<?php

// Database Details { Servername, Username, Password and DatabaseName } 
require "header.php";
echo "<br>";
$servername = "sql312.epizy.com";
$username = "epiz_28009504";
$password = "AtnzzYRZ7tnyAW";
$dbname = "epiz_28009504_CS4116";
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection of our Database
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully\n\n";
echo "<br>";
echo "<br>";

$role = $_POST['search'];



//SQL Statement

$sql = " SELECT * FROM Vacancies WHERE vacancy_name LIKE '%$role%' ";
//$sql = " SELECT * FROM Vacancies WHERE vacancy_name = '$role' ";

$result = $conn->query($sql);
$count;

// Code Continues.

if ($_POST['search'] != null ) {

    
    while($row = $result->fetch_assoc()) {
        
        $count++;
        
        if($count != 0) {

            echo "<table border=2>";
        
            echo 
                "<tr>
                <th>Vacancy Name</th>
                <th>Vacancy Description</th>
                <th>Required Qualification</th>
                </tr>";

            // Output our SQL Query
            echo "<tr>";
            echo 
                "<td>{$row["vacancy_name"]}</td>
                <td>{$row["vacancy_description"]}</td>
                <td>{$row["required_qualification"]}</td>";        
        
            echo "</tr>";

            echo "</table>";
           

        }   
             
    }

    if($count == 0) {
        echo "Couldn't Find Vacancy Please Try Again";
    }


}

else {
    echo "Couldn't Find Vacancy!!!";
}
    //Closing Our Connection to the Database
    $conn->close();

require "footer.php";

?>



