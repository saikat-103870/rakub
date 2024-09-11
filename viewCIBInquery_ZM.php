<?php
ob_start();
session_start();
include ('header.php');
include ('config.php');
ini_set('display_errors', 'off');

if(isset($_GET['gtrNo']))
{
	$trNo=$_GET['gtrNo'];
	
	//echo '<br><br><br><br><br><br><br><br><br><br>loanfddfdsf type '.$trNo;

	$exist=1;
	
	$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN individual c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo and i.status=2";
	
	$res = mysqli_query($conn, $sqlload);

	if (mysqli_affected_rows($conn)>0)
	{
     	$row = mysqli_fetch_assoc($res);
		
		$LoanType = $row['loanType'];
		$status = $row['status'];
		$indiviCompnyInfo = $row['indiviCompnyInfo'];
		$FISubCode = $row['FISubCode'];
		$FinTypeID = $row['FinTypeID'];
		$TotalReqAmt = $row['TotalReqAmt'];
		$InstallmentNo =$row['InstallmentNo'];
		$InstallmentAmt = $row['InstallmentAmt'];
		$PerodicityPayment = $row['PerodicityPayment'];
		$Role = $row['Role'];
		$Title = $row['Title'];
		$Name = $row['Name'];
		$FatherTitle = $row['FatherTitle'];
		$FatherName = $row['FatherName'];
		$MotherTitle = $row['MotherTitle'];
		$MotherName = $row['MotherName'];
		$SpouseTitle = $row['SpouseTitle'];
		$SpouseName = $row['SpouseName'];
		$NID = $row['NID'];
		$Etin = $row['Etin'];
		$TelephoneNumber = $row['TelephoneNumber'];
		$BirthDistrict = $row['BirthDistrict'];
		$BirthCountry = $row['BirthCountry'];
		$SecType = $row['SecType'];
		$SecCode = $row['SecCode'];
		$Gender = $row['Gender'];
		$PerStreet = $row['PerStreet'];
		$PerPostal = $row['PerPostal'];
		$PerDistrict = $row['PerDistrict'];
		$PerCountry = $row['PerCountry'];
		$PreStreet = $row['PreStreet'];
		$PrePostal = $row['PrePostal'];
		$PreDistrict = $row['PreDistrict'];
		$PreCountry = $row['PreCountry'];
		$IDType = $row['IDType'];
		$IDNumber = $row['IDNumber'];
		$IDIssueDate = $row['IDIssueDate'];
		$IDIssueCountry = $row['IDIssueCountry'];
		$BirthDate = $row['BirthDate'];
		$voucherNumber = $row['voucherNumber'];
		$voucherDate = $row['voucherDate'];
		$voucherAmount = $row['voucherAmount'];
		$fileName = $row['UploadNID'];
		$UploadMoneyReceipt = $row['UploadMoneyReceipt'];
		$UploadPromiseLetter = $row['UploadPromiseLetter'];
		$UploadOtherDocs = $row['UploadOtherDocs'];
	
	}	
		if($status>2)
	{
		echo '<center>';
		echo '<h2><br><br><br><br><span style="color: red;">Already sent to Head office.</span></h2>';
		echo "<a class='btn btn-default btn-lg blue' href='home.php'><span class='glyphicon glyphicon-edit'></span> Home</a><br><br>";
		echo '</center>';
		exit;
	} 
}


else
{
$exist=0;
if (isset($_SESSION['empid']))
{
    $EntryUserId = $_SESSION['empid'];
    $brCode = $_SESSION['brCode'];

}
else
{
    header("Location:login.php");
    exit;
}
			
}


if (isset($_POST['SubmitHO']))
{
	$trN=$_POST['trNo'];
	$trNo='';
	//echo '<br><br><br><br><br><br><br><br>dfdfdf'.$trNo; exit;
	$sql = "UPDATE `inquiry` SET `status`=3 where `TrackingNo`='$trN'";
	//echo '<br><br><br><br>';
	//echo $sql;exit();

if (mysqli_multi_query($conn, $sql))
        {
			echo '<center>';
			echo '<h2><br><br><br><br><span style="color: green;">Successfully Send to Head Office.</span></h2>';
			echo "<a class='btn btn-default btn-lg blue' href='home.php'><span class='glyphicon glyphicon-edit'></span> Back</a><br><br>";
			echo '</center>';
			//echo '<center>';
			//echo "<a class='btn btn-default btn-lg blue' href='generate_pdf/genPdfIndividual.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Generate PDF</a><br><br>";
			//echo '</center>';
			exit;
        }
	else
		{
			echo "Error: " . mysqli_error($conn);
		}


}














$sqlperdis="SELECT DISTINCT DistrictCode, DistrictName FROM `location` ORDER by DistrictName asc;";
$rsperDist=mysqli_query($conn, $sqlperdis);

//$sqlperdis1="SELECT DISTINCT DistrictCode, DistrictName FROM `location` ORDER by DistrictName asc;";
$rsperDist1=mysqli_query($conn, $sqlperdis);

//$sqlperdis2="SELECT DISTINCT DistrictCode, DistrictName FROM `location` ORDER by DistrictName asc;";
$rsperDist2=mysqli_query($conn, $sqlperdis);


//$sqlperdis3="SELECT DISTINCT DistrictCode, DistrictName FROM `location` ORDER by DistrictName asc;";
$rsperDist3=mysqli_query($conn, $sqlperdis);


$sqlc="SELECT DISTINCT country_code,country_name  FROM `apps_countries` ORDER by country_name asc";
$rspc=mysqli_query($conn, $sqlc);
$rspc1=mysqli_query($conn, $sqlc);
$rspc2=mysqli_query($conn, $sqlc);
$rspc3=mysqli_query($conn, $sqlc);

?>
<!DOCTYPE html>
<br><br><br>
<html>

<head>
<title>CIB Inquiry System</title>
<script src="js/jquery.min.js_3.2.1.js"></script>
<link rel="stylesheet" href="css/font-awesome.min.css_4.7.0.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
 <script type='text/javascript' src="js/jquery-3.3.1.slim.min.js"></script>
     
    <script type='text/javascript'src="js/jquery.mask.js"></script>
  
      
    <script  type='text/javascript'src="js/popper.min.js"></script>
      

<script type='text/javascript' src="js/jquery.inputmask.bundle.js"></script> 


</head>

<body>

<div class="container">
 
     <div class="wrapper"><div style="text-align:center;font-size:2vw;background-color:green;color:white;width:100%;height:48px;padding-top:7px;margin-bottom:10px">CIB ONLINE INQUIRY FORM</div>
		

         <!-- form start -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="individual" method="post" name= "form1" role="form" id="register-form" autocomplete="off" onsubmit="return validateForm()" enctype="multipart/form-data" >
		  
 <div class="body_style">
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Loan Type</th> <th>:</th> <td><?php echo $LoanType; ?></td> 
	     <th>Individual Information</th> <th>:</th><td><?php echo $indiviCompnyInfo; ?></td> 
		    <th>FI Subject Code</th><th>:</th> <td><?php echo $FISubCode; ?></td> 
		    
		 </tr>
	  </thead>
   <thead class="thead-light">
    <tr>
	<th>Type of Financing</th> <th>:</th><td><?php echo $FinTypeID; ?></td> 
      <th>Total Requested Amount</th> <th>:</th> <td><?php echo $TotalReqAmt; ?></td> 
	     <th>Role in the Institution</th> <th>:</th><td><?php echo $Role; ?></td> 
		 </tr>
	  </thead>
	
	  <input type="hidden" value="<?php echo $trNo; ?>" name="trNo" id="trNo" />
	  
</table>


     <div class="panel panel-default" id="ICD" >
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Installment Contract Data</span>
		
		</div>
		
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Number of Installment</th> <th>:</th> <td><?php echo $InstallmentNo; ?></td>
	  <?php	if ( $FinTypeID=="Term Loan" ){
?>
<script type="text/javascript">$('#ICD').show()</script>
<?php
}
else if ( $FinTypeID=="Other installment contract" ){
	?>
	<script type="text/javascript">$('#ICD').show()</script>
<?php
}
else{
	?>
		<script type="text/javascript">$('#ICD').hide()</script>
<?php
}
?>	  
	     <th>Installment Amount</th> <th>:</th><td><?php echo $InstallmentAmt; ?></td> 
		    <th>Periodicity of Payment</th><th>:</th> <td><?php echo $PerodicityPayment; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
</div>

<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Individual Subject Data</span>
		</div>
		<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Title</th> <th>:</th> <td><?php echo $Title; ?></td> 
	     <th>Name</th> <th>:</th><td><?php echo $Name; ?></td> 
		    <th>Father's Title</th><th>:</th> <td><?php echo $FatherTitle; ?></td> 
		    <th>Father's Name</th> <th>:</th><td><?php echo $FatherName; ?></td> 
		 </tr>
		  <tr>
      <th>Mother's Title</th> <th>:</th> <td><?php echo $MotherTitle; ?></td> 
	     <th>Mother's Name</th> <th>:</th><td><?php echo $MotherName; ?></td> 
		    <th>Spouse's Title</th><th>:</th> <td><?php echo $SpouseTitle; ?></td> 
		    <th>Spouse's Name</th> <th>:</th><td><?php echo $SpouseName; ?></td> 
		 </tr>
		  <tr>
      <th>Date of Birth</th> <th>:</th> <td><?php echo empty($BirthDate)==false? date("d-m-Y",strtotime(str_replace('/', '-', $BirthDate))): $BirthDate; ?></td> 
	     <th>NID</th> <th>:</th><td><?php echo $NID; ?></td> 
		    <th>Etin</th><th>:</th> <td><?php echo $Etin; ?></td> 
		    <th>Telephone Number</th> <th>:</th><td><?php echo $TelephoneNumber; ?></td> 
		 </tr>
		 <tr>
      <th>District of Birth</th> <th>:</th> <td><?php echo $BirthDistrict; ?></td> 
	     <th>Country of Birth</th> <th>:</th><td><?php echo $BirthCountry; ?></td> 
		    <th>Sector Type</th><th>:</th> <td><?php echo $SecType; ?></td> 
		    <th>Sector Code</th><th>:</th> <td><?php echo $SecCode; ?></td> 
		 </tr>
 <tr>
      <th>Gender</th> <th>:</th> <td><?php echo $Gender; ?></td> 
	     </tr>
	  </thead>
	  
	  
</table>
		</div>

 <div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Permanent Address</span>
		
		</div>
		
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Street</th> <th>:</th> <td><?php echo $PerStreet; ?></td> 
	     <th>Postal:</th> <th>:</th><td><?php echo $PerPostal; ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $PerDistrict; ?></td> 
		    <th>Country</th> <th>:</th><td><?php echo $PerCountry; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
</div>

<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Present Address</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Street</th> <th>:</th> <td><?php echo $PreStreet; ?></td> 
	     <th>Postal:</th> <th>:</th><td><?php echo $PrePostal; ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $PreDistrict; ?></td> 
		    <th>Country</th> <th>:</th><td><?php echo $PreCountry; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
		
		
		</div>
<div class="panel panel-default" id ="OIT" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Other ID</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
		<?php	if ( ($IDType=="") && ($IDNumber=="")){
?>
<script type="text/javascript">$('#OIT').hide()</script>
<?php
}
else{
	?>
		<script type="text/javascript">$('#OIT').show()</script>
<?php
}
?>
      <th>ID Type</th> <th>:</th> <td><?php echo $IDType; ?></td> 
	     <th>ID Number</th> <th>:</th><td><?php echo $IDNumber; ?></td> 
		    <th>ID Issue Date</th><th>:</th> <td><?php echo empty($IDIssueDate)==false? date("d-m-Y",strtotime(str_replace('/', '-', $IDIssueDate))): $IDIssueDate; ?></td> 
		    <th>ID Issue Country</th> <th>:</th><td><?php echo $IDIssueCountry; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
</div>

<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">CIB Inquiry Fee</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Fee Amount</th> <th>:</th> <td><?php echo $voucherAmount; ?></td> 
	     <th>Voucher Number</th> <th>:</th><td><?php echo $voucherNumber; ?></td> 
		    <th>Date</th><th>:</th> <td><?php echo $voucherDate; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
		
		
		</div>		
		

<section> 


<p align="right">
<br><a href="home.php" class="btn btn-warning btn-lg"> <span class="glyphicon glyphicon-step-backward"></span> Back </a>
<span style="margin-left:10px;"> &nbsp; <button type="submit" id="SubmitHO" name="SubmitHO" class="btn btn-lg btn-success">Submit to Head Office <span class='glyphicon glyphicon-step-forward'></span></button> </span>

</p>

</section>
		

	
	
	
</form>

</div>
</div>
               
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery-1.11.2.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script src="assets/register.js"></script>
	

</body>
</html>
<?php
include ('templates\footer.php')
?>
