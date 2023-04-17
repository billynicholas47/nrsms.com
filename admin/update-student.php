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
$studentname=$_POST['studentname'];
$studentregno=$_POST['studentregno'];
$gender=$_POST['gender'];
$dob=$_POST['dob'];
$program=$_POST['program'];
$year=$_POST['year'];
$hostel=$_POST['hostel'];



$upd = "UPDATE `students` SET `StudentName`='$studentname',`RegNo`='$studentregno',`Gender`='$gender',`DOB`='$dob',`Program`='$program',`year_of_study`='$year',`Hostel`='$hostel' WHERE RegNo='$uid'";

$ret=mysqli_query($bd, $upd);
if($ret)
{
echo ("<script type='text/javascript'>alert('Update Successful');</script>");
echo ("<script type='text/javascript'>window.location='manage-students.php';</script>");
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
<title>Admin | Update Non-Resident Information</title>
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
<h1 class="page-head-line">Update Non-Resident Information  </h1>
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
$sqlq="select * from students where RegNo='$uid'";
$retn=mysqli_query($bd, $sqlq);
while($rows = mysqli_fetch_assoc($retn))
{
?>

<div class="form-group">
<label for="studentname">Student Name  </label>
<input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo($rows['StudentName']); ?>" required />
</div>


<div class="form-group">
<label for="studentregno">Student Reg No   </label>
<input type="text" class="form-control" id="studentregno" maxlength="15" name="studentregno" onBlur="userAvailability()" value="<?php echo htmlentities($rows['RegNo']);?>" required />
<span id="user-availability-status1" style="font-size:12px;">
</div>

<div class="form-group">
<label for="gender">Gender  </label>
<select class="form-control" id="gender" name="gender" required />
<option value="<?php echo htmlentities($rows['Gender']);?>"><?php echo htmlentities($rows['Gender']);?> (Default Value)</option>
<option value=""></option>
<option value="Male">Male</option>
<option value="Female">Female</option>
</select>
</div>

<div class="form-group">
<label for="dob">Student Date Of Birth  </label>
<input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlentities($rows['DOB']);?>" required />
</div>

<div class="form-group">
<label for="password">Program of Study  </label>
<select class="form-control" id="program" name="program" required />
<option value="<?php echo htmlentities($rows['Program']);?>"><?php echo htmlentities($rows['Program']);?> (Default Value)</option>
<option value=""></option>
<option value="Bachelor Of Information Technology (BIT)">Bachelor Of Information Technology (BIT)</option>
<option value="Bachelor Of Computer Science (BCS)">Bachelor Of Computer Science (BCS)</option>
<option value="Bachelor Of Education Primary (BEP)">Bachelor Of Education Primary (BEP)</option>
<option value="Diploma Of Education Primary (DEP)">Diploma Of Education Primary (DEP)</option>
<option value="Bachelor Of Education (Physics,Math) (EPM)">Bachelor Of Education (Physics,Math) (EPM)</option>
<option value="Bachelor Of Education (Physics,ICT) (EPI)">Bachelor Of Education (Physics,ICT) (EPI)</option>
<option value="Bachelor Of Education (Chemistry,Math) (ECM)">Bachelor Of Education (Chemistry,Math) (ECM)</option>
</select>
</div> 

<div class="form-group">
<label for="year">Year Of Study  </label>
<select class="form-control" id="year" name="year" required />
<option value="<?php echo htmlentities($rows['year_of_study']);?>"><?php echo htmlentities($rows['year_of_study']);?> (Default Value)</option>
<option value=""></option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select>
</div>

<div class="form-group">
<label for="hostel">Hostel  </label>
<select class="form-control" id="hostel" name="hostel" required />
<option value="<?php echo htmlentities($rows['Hostel']);?>"><?php echo htmlentities($rows['Hostel']);?> (Default Value)</option>
<option value=""></option>
<option value=""></option>

<?php 
}
$sql=mysqli_query($bd, "select * from hostels");
while($row=mysqli_fetch_array($sql))
{
?>
<option value="<?php echo htmlentities($row['hostel']);?>"><?php echo htmlentities($row['hostel']);?></option>
<?php } ?>
</select>
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
<?php include('includes/footer.php');?>
<script src="assets/js/jquery-1.11.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'regno='+$("#studentregno").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>


</body>
</html>
<?php } ?>
