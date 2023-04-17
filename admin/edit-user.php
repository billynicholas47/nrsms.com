<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
header('location:index.php');
}
else{



if(isset($_GET['del']))
{
mysqli_query($bd, "delete from users where s_no = '".$_GET['id']."'");
$_SESSION['delmsg']="User record deleted !!";
}


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Admin | Users</title>
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
<?php include('includes/header.php');?>

<?php if($_SESSION['alogin']!="")
{
include('includes/menubar.php');
}
?>

<div class="content-wrapper">
<div class="container">
<div class="row">
<div class="col-md-12">
<h1 class="page-head-line">Users  </h1>
</div>
</div>
<div class="row" >

<font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
<div class="col-md-12">

<div class="panel panel-default">
<div class="panel-heading">
Manage Users
</div>

<div class="panel-body">
<div class="table-responsive table-bordered">
<table class="table">
<thead>
<tr>
<th>#</th>
<th>Full Name</th>
<th>User Name </th>
<th>Password</th>
<th>Actions </th>
</tr>
</thead>
<tbody>
<?php
$sql=mysqli_query($bd, "select * from users");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


<tr>
<td><?php echo $cnt;?></td>
<td><?php echo htmlentities($row['FullName']);?></td>
<td><?php echo htmlentities($row['UserName']);?></td>
<td><?php echo htmlentities($row['Pass']);?></td>
<td>              
<center>
<a href="update-user.php?id=<?php echo $row['s_no']?>" onClick="return confirm('Are you sure you want to update?')">
<button type="submit" name="submit" id="submit" class="btn btn-default">Update</button>
</a>
<a href="edit-user.php?id=<?php echo $row['s_no']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
<button class="btn btn-danger">Delete</button>
</a>
</center>
</td>
</tr>
<?php 
$cnt++;
} ?>


</tbody>
</table>
</div>
</div>
</div>

</div>
</div>





</div>
</div>

<?php include('includes/footer.php');?>

<script src="assets/js/jquery-1.11.1.js"></script>

<script src="assets/js/bootstrap.js"></script>
</body>
</html>
<?php } ?>
