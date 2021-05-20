<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dynamically Generate Select Dropdowns</title>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <select name = 'skills[]' multiple = 'multiple'>  
    <!--<select name = "chosen">-->
        <option selected="selected">Choose multiple using Ctrl click</option>
        <?php
        
        $skills = getAllSKills();
        
        foreach($skills as $key=>$item){
            echo "<option value='$item'>$item</option>";
        }
        ?>
    </select>
    <input type="submit" value="Submit" name="submit">
</form>
<?php
session_start();
//$choice = $_POST['chosen'];
$skillsChoice = [];
// Check if form is submitted successfully
    if(isset($_POST["submit"])) 
    {
        // Check if any option is selected
        if(isset($_POST["skills"])) 
        {
            // Retrieving each selected option
            foreach ($_POST['skills'] as $key=>$skill)
                if($skill!="Choose multiple using Ctrl click"){ 
                echo "You selected $skill<br/>";
                array_push($skillsChoice,$skill);
                }
        }
    else
        echo "Select an option first !!";
    }
echo "<br>";
//print_r($skillsChoice);
$_SESSION['skillsChoice'] = $skillsChoice;
print_r($_SESSION['skillsChoice']);
//echo $choice;
// get all skills
function getAllSkills(){
    $skills = [];
    require "includes/dbh-inc.php";
    $sql = "SELECT Skill_Name FROM Skills;";
    
    $result = $conn->query($sql);
    //print_r($result);
    
    if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($skills,$row['Skill_Name']);
            }
        }
    //echo "<br>Skills array<br>";
    //print_r($skills);
    return $skills;
}
?>
</body>
</html>