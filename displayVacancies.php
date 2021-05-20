<?php 

require "includes/dbh-inc.php";
echo "<br>";

$sql = "SELECT Vacancies.vacancy_name, Vacancies.vacancy_description, Vacancies.required_qualification,Companies.company_name FROM Vacancies LEFT JOIN Companies ON Vacancies.company_id=Companies.company_id";
// Store the result of the query in $result
$result = $conn->query($sql);
// check that there is rows in result
if ($result->num_rows > 0){
echo "<table>";
echo "<tr>
        <th>Role</th>
        <th>Company</th>
        <th>Description</th>
        <th>Required Qualification</th>
        
    </tr>";
// output the data of each row
 while($row = $result->fetch_assoc())
 {
   
    echo "<tr>";
    echo "<td>{$row["vacancy_name"]}</td>
    <td>{$row["company_name"]}</td>
    <td>{$row["vacancy_description"]}</td>
    <td>{$row["required_qualification"]}</td>";
   
    
    echo "</tr>";
 }
 echo "</table>";
} else{
    echo "0 results";
}


$conn->close();
?>