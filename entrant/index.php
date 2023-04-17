<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
$username=$_POST['username'];
$password=md5($_POST['password']);
$query=mysqli_query($bd, "SELECT * FROM users WHERE UserName='$username' and Pass='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="manage-students.php";//
$_SESSION['alogin']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['errmsg']="Invalid username or password";
$extra="index.php";
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />

<title>Entrant Login</title>
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
<?php include('includes/header.php');?>
<div class="content-wrapper">
<div class="container">
<div class="row">
<div class="col-md-12">
<h4 class="page-head-line">Please Login To Enter </h4>

</div>

</div>
<span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
<form name="admin" method="post">
<div class="row">
<div class="col-md-6">
<label>Enter Username : </label>
<input type="text" name="username" class="form-control" required />
<label>Enter Password :  </label>
<input type="password" name="password" class="form-control" required />
<hr />
<button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-user"></span> &nbsp;Log Me In </button>&nbsp;
</div>
</form>
<div class="col-md-6">
<div class="alert alert-info">
This is a web-based system to help in managing information about non-residents.
<br />
<strong> Some of its features are given below :</strong>
<ul>
<li>
Adding non-resident information.
</li>
<li>
Easy use and customization by administrators.
</li>
<li>
User-friendly interfaces.
</li>
<li>
Easy tracking of the non-residents information.
</li>
</ul>

</div>
</div>

</div>
<a href="../admin/"><h4 class="left" style="text-align:right;">Admin Login</h4></a>
</div>
</div>

<?php include('includes/footer.php');?>

<script src="assets/js/jquery-1.11.1.js"></script>

<script src="assets/js/bootstrap.js"></script>
</body>
</html>
