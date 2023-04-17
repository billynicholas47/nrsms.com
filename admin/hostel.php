<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
header('location:index.php');
}
else{

if(isset($_POST['submit']))
{
$hostel=$_POST['hostel'];
$distance=$_POST['ed'];
$landlord=$_POST['landl'];
$tel=$_POST['tel'];

$sql = "INSERT INTO `hostels` (`id`, `hostel`, `EstimatedDistance`, `landlord`, `Tel`) 
VALUES (NULL, '$hostel', '$distance', '$landlord', '$tel');";
$ret=mysqli_query($bd, $sql);
if($ret)
{
$_SESSION['msg']="Hostel Registered Successfully !!";
}
else
{
$_SESSION['msg']="Error : Hostel not Registered";
}
}
if(isset($_GET['del']))
{
mysqli_query($bd, "delete from hostels where id = '".$_GET['id']."'");
$_SESSION['delmsg']="Hostel deleted !!";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="" />
<meta name="author" content="" />
<title>Admin | Hostel Management</title>
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
<h1 class="page-head-line">REGISTER / MANAGE HOSTELS  </h1>
</div>
</div>
<div class="row" >
<div class="col-md-3"></div>
<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">
Enter Hostel Information
</div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


<div class="panel-body">
<form name="dept" method="post">
<div class="form-group">
<label for="hostel">Hostel Name  </label>
<input type="text" class="form-control" id="hostel" name="hostel" placeholder="Enter Hostel Name" required />
</div> 

<div class="form-group">
<label for="ed">Estimated Distance From Campus (in meters)  </label>
<input type="number" class="form-control" id="ed" name="ed" placeholder="e.g. 200" required />
</div>

<div class="form-group">
<label for="landl">Landlord's Name  </label>
<input type="text" class="form-control" id="landl" name="landl" placeholder="Landlord's Name" required />
</div>

<div class="form-group">
<label for="tel">Landlord's Contact  </label>
<input type="tel" class="form-control" id="tel" name="tel" maxlength="10" placeholder="e.g. 0784352413" required />
</div>

<button type="submit" name="submit" class="btn btn-default">Submit</button>
</form>
</div>
</div>
</div>

</div>
<font color="red" align="center"><?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?></font>
<div class="col-md-12">

<div class="panel panel-default" id="mng">
<div class="panel-heading">
Manage Hostel Info
</div>

<div class="panel-body">
<div class="table-responsive table-bordered">
<table class="table">
<thead>
<tr>
<th>#</th>
<th>Hostel Code</th>
<th>Hostel Name </th>
<th>Est. Distance from Campus (metres)</th>
<th>Landlord's Name</th>
<th>Landlord's Contact</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$sql=mysqli_query($bd, "select * from hostels");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>


<tr>
<td><?php echo $cnt;?></td>
<td><?php echo htmlentities($row['id']);?></td>
<td><?php echo htmlentities($row['hostel']);?></td>
<td><?php echo htmlentities($row['EstimatedDistance']);?></td>
<td><?php echo htmlentities($row['landlord']);?></td>
<td><?php echo htmlentities($row['Tel']);?></td>
<td>
<a href="edit-hostel.php?id=<?php echo $row['id']?>">
<button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> </a>                                        
<a href="hostel.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
<button class="btn btn-danger">Delete</button>
</a>
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
