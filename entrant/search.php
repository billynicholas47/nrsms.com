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
mysqli_query($bd, "delete from students where RegNo = '".$_GET['id']."'");
$_SESSION['delmsg']="Student record deleted !!";
}


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Admin | Non-Residents</title>
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
<h1 class="page-head-line">Non-Residents  </h1>
</div>
</div>
<div class="row" >
<form name="search" method="post">
<input type="search" name="sname" placeholder="Enter keyword here" class="form-control" style="display:inline;width:40%;margin-left:20%;">
<button class="btn btn-primary" type="submit" name="search" style="width:10%;margin-left:2%;display:inline;">Search</button>
</form>
<br>
<font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
<div class="col-md-12">

<div class="panel panel-default">
<div class="panel-heading">
Manage Non-Residents
</div>

<div class="panel-body">
<div class="table-responsive table-bordered">
<table class="table">
<thead>
<tr>
<th>#</th>
<th>Reg No </th>
<th>Student Name </th>
<th> Gender</th>
<th>Date of birth</th>
<th>Program</th>
<th>Year </th>
<th>Hostel </th>
<th>Actions </th>
</tr>
</thead>
<tbody>
<?php
if(isset($_POST['search']))
{
//$name=$_POST['sname'];
$name = mysqli_real_escape_string($bd, $_POST['sname']);

$sql=mysqli_query($bd, "select * from students where StudentName like '%$name%' OR Program like '%$name%' OR Hostel like '%$name%'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


<tr>
<td><?php echo $cnt;?></td>
<td><?php echo htmlentities($row['RegNo']);?></td>
<td><?php echo htmlentities($row['StudentName']);?></td>
<td><?php echo htmlentities($row['Gender']);?></td>
<td><?php echo htmlentities($row['DOB']);?></td>
<td><?php echo htmlentities($row['Program']);?></td>
<td><?php echo htmlentities($row['year_of_study']);?></td>
<td><?php echo htmlentities($row['Hostel']);?></td>
<td>              

<a href="update-student.php?id=<?php echo $row['RegNo']?>" onClick="return confirm('Are you sure you want to update?')">
<button type="submit" name="submit" id="submit" class="btn btn-default">Update</button>
</a>
<a href="manage-students.php?id=<?php echo $row['RegNo']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
<button class="btn btn-danger">Delete</button>
</a>
</td>
</tr>
<?php 
$cnt++;
} 

}

?>


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
