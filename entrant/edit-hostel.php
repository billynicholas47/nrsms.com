<?php
session_start();
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
header('location:index.php');
}
else{

$uid = $_GET['id'];
if(isset($_POST['submit']))
{
$hostel=$_POST['hostel'];
$ed=$_POST['ed'];
$landl=$_POST['landl'];
$tel=$_POST['tel'];


$upd = "UPDATE `hostels` SET `hostel`='$hostel',`EstimatedDistance`='$ed',`landlord`='$landl',`Tel`='$tel' WHERE id='$uid'";

$ret=mysqli_query($bd, $upd);
if($ret)
{
echo ("<script type='text/javascript'>alert('Update Successful');</script>");
echo ("<script type='text/javascript'>window.location='hostel.php';</script>");
}
else
{
$_SESSION['delmsg']="Update Unsuccessful.";
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
<title>Admin | Update Hostel Information</title>
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
<h1 class="page-head-line">Update Hostel Information  </h1>
</div>
</div>
<div class="row" >
<div class="col-md-3"></div>
<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">
Replace desired fields with new details. Leave undesired fields intact.
</div>
<font color="green" align="center"><?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?></font>


<div class="panel-body">
<form name="dept" method="post">

<?php
$sqlq="select * from hostels where id='$uid'";
$retn=mysqli_query($bd, $sqlq);
while($rows = mysqli_fetch_assoc($retn))
{
?>

<div class="form-group">
<label for="studentname">Hostel Name  </label>
<input type="text" class="form-control" id="hostel" name="hostel" value="<?php echo($rows['hostel']); ?>" required />
</div>


<div class="form-group">
<label for="studentname">Estimated Distance from Campus (meters)  </label>
<input type="text" class="form-control" id="ed" name="ed" value="<?php echo($rows['EstimatedDistance']); ?>" required />
</div>

<div class="form-group">
<label for="studentname">Landlord's Name  </label>
<input type="text" class="form-control" id="landl" name="landl" value="<?php echo($rows['landlord']); ?>" required />
</div>

<div class="form-group">
<label for="studentname">Landlord's Contact  </label>
<input type="tel" maxlength="10" class="form-control" id="tel" name="tel" value="<?php echo($rows['Tel']); ?>" required />
</div>

<button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
</form>
</div>
</div>
</div>

</div>

</div>





</div>
</div>
<?php }} ?>
<?php include('includes/footer.php');?>
<script src="assets/js/jquery-1.11.1.js"></script>
<script src="assets/js/bootstrap.js"></script>


</body>
</html>