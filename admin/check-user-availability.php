<?php 
require_once("includes/config.php");
if(!empty($_POST["username"])) {
$username= $_POST["username"];

$result =mysqli_query($bd, "SELECT UserName FROM users WHERE UserName='$username'");
$count=mysqli_num_rows($result);
if($count>0)
{
echo "<span style='color:red'> Username Exists.</span>";
echo "<script>$('#submit').prop('disabled',true);</script>";
} else{


}
}


?>
