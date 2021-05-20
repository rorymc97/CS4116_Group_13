<!DOCTYPE html>
<html>
<body>

<?php
$str = "asdf";
$pattern = "/^[a-z\s]+$/i";
echo preg_match($pattern, $str);

$str = "asdf123 asdf 213'";
$pattern = "/^[a-z0-9\s]+$/i";
echo preg_match($pattern, $str);

echo test_input($str);
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
echo "<br>";
$str2 = "Bachelor of Science Masters of Computer Software PHD in loads of stuff OR 5 years experience";
echo strlen($str2);
if(strlen($str)<=300 && true){
    echo "yupyup";


}
?>

</body>
</html>
