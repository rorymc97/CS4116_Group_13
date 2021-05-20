<?php
// Start the session
session_start();
?>
<?php 

require "includes/dbh-inc.php";

//echo "<br>";
// SQL query for all vacancies
// Selesects vacancy name, vacancy description, require_qualification, company name, skill
$sql = "SELECT Vacancies.vacancy_id,Vacancies.vacancy_name, 
Vacancies.vacancy_description, 
Vacancies.required_qualification,
Companies.company_name,
Skills.Skill_Name
FROM VacancySkills

LEFT JOIN Vacancies ON Vacancies.vacancy_id=VacancySkills.vacancy_id
LEFT JOIN Companies ON Vacancies.company_id=Companies.company_id
LEFT JOIN Skills ON VacancySkills.skill_id=Skills.Skill_Id;";

$vacancyWithSkills=[];
$result = $conn->query($sql);
// check that there is rows in result
if ($result->num_rows > 0){

// The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array.
// Note: Fieldnames returned from this function are case-sensitive.
// 
 while($row = $result->fetch_assoc())
 {
        array_push($vacancyWithSkills,$row);
        
}
 
}
require "getUserSkills.php";
require "getUserQualifications.php";
// userQualifications and userSkills are empty until a session is started and a user logs in
$userQualifications = $_SESSION["userQualifications"];
$userSkills = $_SESSION["userSkills"];
//$userQualifications = array(0=>array("Qualification_Type"=>"Bachelors","Qualification_Field"=>"Development"));
//$userSkills = array("Python","PHP","C","C++","Java");


//echo "<br>vacancywithskills:";
//print_r($vacancyWithSkills);
//echo "<br>userskills: ";
//print_r($userSkills);
//echo "<br>userQualifications: ";
//print_r($userQualifications);

foreach($userSkills as $value){
    //echo "{$value}";
    //echo "what";
}


// Loop through vacancyWithSkills and userSkills, and note the vacancy when they match
$suggestedVacanciesBySkills = [];
foreach($vacancyWithSkills as $vacancyKey=>$vacancyValue){
    foreach($userSkills as $userSkillsKey=>$userSkillsValue){
        if($vacancyValue['Skill_Name']==$userSkillsValue){
            //echo "<br>".$vacancyKey." ".$vacancyValue['vacancy_name'];
            array_push($suggestedVacanciesBySkills,$vacancyKey);
        }
    }
    
}
//echo "<br>suggestedVacanciesBySkills: ";
//print_r($suggestedVacanciesBySkills);
   
// Loop through vacancyWithSkills and userQualifications, and note the vacancy when they match
$suggestedVacanciesByQualifications = [];
foreach($vacancyWithSkills as $vacancyKey=>$vacancyValue){
    foreach($userQualifications as $userQualificationsKey=>$userQualificationsValue){
        if($vacancyValue['required_qualification']==$userQualificationsValue['Qualification_Type']){
            //echo "<br>".$vacancyKey." ".$vacancyValue['vacancy_name'];
            array_push($suggestedVacanciesByQualifications,$vacancyKey);
        }
    }
}
//echo "<br>suggestedVacanciesByQualifications: ";
//print_r($suggestedVacanciesByQualifications);

// Loop through suggestedVacanciesBySkills and suggestedVacanciesByQualifications,
// where the keys match push that vacancy to an array
$suggestedVacanciesNo = [];
foreach($suggestedVacanciesBySkills as $kS=>$vS){
    foreach($suggestedVacanciesByQualifications as $kQ=>$vQ){
        if($vS==$vQ){
            //echo "<br>".$vS;
            array_push($suggestedVacanciesNo,$vS);
        }
    }
}
//echo "<br>suggestedVacanciesNo: ";
//print_r($suggestedVacanciesNo);

// Loop through suggestedVacanciesNo and vacanciesWithSkills
// where they match push row to suggesteVacancies
$suggestedVacanciesIds = [];
foreach($suggestedVacanciesNo as $kN=>$vN){
    foreach($vacancyWithSkills as $vacancyKey=>$vacancyValue){
        if($vN==$vacancyKey){
            array_push($suggestedVacanciesIds,$vacancyValue['vacancy_id']);

        }
    }
}
//echo "<br>suggestedVacanciesIds: ";
//print_r($suggestedVacanciesIds);

// remove duplicates from an array
$suggestedVacanciesIds = array_values(array_unique($suggestedVacanciesIds));
//echo "<br>suggestedVacanciesIds: ";
//print_r($suggestedVacanciesIds);

// Request from database the vacancies with these ids
// SQL query for all vacancies
// Selects vacancy id,name, vacancy description, require_qualification, company name, 
require "includes/dbh-inc.php";
$sql = "SELECT Vacancies.vacancy_id,Vacancies.vacancy_name, 
Vacancies.vacancy_description, 
Vacancies.required_qualification,
Companies.company_name

FROM Vacancies

LEFT JOIN Companies ON Vacancies.company_id=Companies.company_id";

$vacancies=[];
$result = $conn->query($sql);
// check that there is rows in result
if ($result->num_rows > 0){

// The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array.
// Note: Fieldnames returned from this function are case-sensitive.
// 
    while($row = $result->fetch_assoc())
    {
        array_push($vacancies,$row);
        
    }
 
}
//echo "<br>vacancies: ";
//print_r($vacancies);

// Loop through vacancies and when they match suggested Ids
// push them to suggestedVacancies array
$suggestedVacancies = [];
foreach($vacancies as $kV=>$vV){
    foreach($suggestedVacanciesIds as $kI=>$vI){
        if($vV['vacancy_id']==$vI){
            array_push($suggestedVacancies,$vV);
        }
    }
}

//echo "<br>suggestedVacancies: ";
//print_r($suggestedVacancies);
$_SESSION['suggestedVacancies'] = $suggestedVacancies;
//echo "<br><br><br>";
//print_r($_SESSION['suggestedVacancies']);

//echo "<br><br><br>";
//print_r($_SESSION['suggestedVacancies']);

echo "<table>";
echo "<tr>
        <th>Role</th>
        <th>Company</th>
        <th>Description</th>
        <th>Required Qualification</th>
        
    </tr>";
// output the data of each row
$suggestedVacancies = $_SESSION['suggestedVacancies'];
 foreach($suggestedVacancies as $k=>$v)
 {
   
    echo "<tr>";
    echo "<td>{$v["vacancy_name"]}</td>
    <td>{$v["company_name"]}</td>
    <td>{$v["vacancy_description"]}</td>
    <td>{$v["required_qualification"]}</td>";
   
    
    echo "</tr>";
 }
 echo "</table>";

$conn->close();
?>