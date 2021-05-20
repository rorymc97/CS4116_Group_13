<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head> 
        <link rel="stylesheet" href="CSS/search.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
  
    <body>
        
        <div class="menu">
            <?php require 'header.php';?>
        </div>
            
    </body>
</html>
<div class="container p-4">
<?php
// start the session and connect to the database
session_start();
require "includes/dbh-inc.php";
// Take the input from the search query
$input = $_POST['search'];
// Get the current users id
$currentUserId = $_SESSION['userID'];
//SQL Statement
// Selecting vacancy id where vacancy name, description, company, industry or skill match the input
$sql = "SELECT Vacancies.vacancy_id
FROM Vacancies
LEFT JOIN VacancySkills ON VacancySkills.vacancy_id = Vacancies.vacancy_id
LEFT JOIN Skills ON Skills.Skill_Id = VacancySkills.skill_id
LEFT JOIN Companies ON Vacancies.company_id = Companies.Company_Id
WHERE Vacancies.vacancy_name LIKE '%$input%'
OR Vacancies.vacancy_description LIKE '%$input%'
OR Vacancies.required_qualification LIKE '%$input%'
OR Companies.company_name LIKE '%$input%'
OR Companies.industry_type LIKE '%$input%'
OR Skills.Skill_Name LIKE '%$input%';";
// an array to store the vacancy ids
$vacancyIds = [];
// query the database
$result = $conn->query($sql);
// if the result is not empty, store the ids from the query in the array
if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            array_push($vacancyIds,$row['vacancy_id']);
        }
    }
// ensure each id in the array is unique
$vacancyIds = array_unique($vacancyIds);
if($vacancyIds){
    displayVacancies($vacancyIds);
}

// a function to get all vacancy information from its iD
function getVacancyFromId($vacancyId){
    require "includes/dbh-inc.php";
    $vacancy = [];
    $sql = "SELECT Vacancies.vacancy_name,Vacancies.vacancy_description, Companies.company_name
            FROM Vacancies
            LEFT JOIN Companies ON Vacancies.company_id = Companies.Company_Id
            WHERE Vacancies.vacancy_id = {$vacancyId};";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            array_push($vacancy,$row);
        }
    }
    return $vacancy;
}
// display vacancies given vacancyIds
function displayVacancies($vacancyIds){
    //print_r($vacancyIds);
    $displayedVacancies = [];
    //echo $currentUserId;
    echo "<table>";
            echo "<tr>
                <th>Vacancy Name  </th>
                <th>Vacancy Description  </th>
                <th>Company  </th>
        
                </tr>";
    foreach($vacancyIds as $key=>$value){

                if(!in_array($value,$displayedVacancies)){
                array_push($displayedVacancies,$value);
                //echo "value: ".$value;
                $vacancy = getVacancyFromId($value);
                //print_r($vacancy);
                echo "<tr>";
                echo "<td>{$vacancy[0]["vacancy_name"]}</td>
                    <td>{$vacancy[0]["vacancy_description"]}</td>
                    <td>{$vacancy[0]["company_name"]}</td>
                    ";   
                echo "</tr>";
 
                
            
        }
    }
    echo "</table>";
}

    //Closing Our Connection to the Database
    $conn->close();






?>
</div>



