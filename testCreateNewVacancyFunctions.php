<?php
session_start();
/**
$skillChoices = $_SESSION['skillsChoice'];
$userId = 11;
//$userId = $_SESSION['userID']
$vacancy_name = $_SESSION['vacancyName'];
$vacancy_description = $_SESSION['vacancyDescription'];
$required_qualification = $_SESSION['requiredQualification'];

insertVacancyForm($skillChoices,$userId,$vacancy_name,$vacancy_description,$required_qualification);
*/
//echo "above require";
require "createNewVacancyFunctions.php";
//echo "<br>one point five<br>";
//test();
function test(){
    //echo "test works";
}
function insertVacancyForm($skillChoices,$userId,$vacancy_name,$vacancy_description,$required_qualification){
    //echo "in insert vacancy form";
    echo $userId." ".$vacancy_name." ".$vacancy_description." ".$required_qualification."<br>";
    //print_r($skillChoices);
    
    //echo "but";
    //$_SESSION['userType']='company';
    if(isCompany()){
    
    
    $skillIds = [];
    echo skillIdFromSkillName($skillChoices[1]);

    foreach($skillChoices as $key=>$skillName){
        echo $skillName;
        $skillId = skillIdFromSkillName($skillName);
        echo $skillId;
        array_push($skillIds,$skillId);
    }

    
    $company_id = getCompanyIdFromUserId($userId);
    
    //echo "<br>$company_id<br>";

    insertIntoVacancyTable($company_id,$vacancy_name,$vacancy_description,      $required_qualification);

    $vacancy_id = getVacancyId($company_id,$vacancy_name,          $vacancy_description, $required_qualification);
    
    echo $vacancy_id;

    foreach($skillIds as $key=>$skill_id){
        insertIntoVacancySkills($vacancy_id,$skill_id);
    }
   
    }
}
?>