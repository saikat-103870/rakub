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
	
	$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN company c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo and i.status=2";
	
	$res = mysqli_query($conn, $sqlload);

	if (mysqli_affected_rows($conn)>0)
	{
     	$row = mysqli_fetch_assoc($res);
		
		$status = $row['status'];
		$LoanType = $row['loanType'];
		$indiviCompnyInfo = $row['indiviCompnyInfo'];
		$FISubCode = $row['FISubCode'];
		$FinTypeID = $row['FinTypeID'];
		$TotalReqAmt = $row['TotalReqAmt'];
	    $InstallmentNo = $row['InstallmentNo'];
	    $InstallmentAmt = $row['InstallmentAmt'];
		$PerodicityPayment = $row['PerodicityPayment'];
	    $InstitutionType = $row['InstitutionType'];
	    $Title = $row['Title'];
	    $TradeName = $row['TradeName'];
	    $LegalForm = $row['LegalForm'];
	    $Etin = $row['Etin'];
	    $RJSCRegNo = $row['RJSCRegNo'];
	    $RegDate = $row['RegDate'];
	    $BusStreet = $row['BusStreet'];
	    $BusPostal = $row['BusPostal'];
		$BusDistrict = $row['BusDistrict'];
		$BusCountry = $row['BusCountry']; 
		$FacStreet = $row['FacStreet'];
		$FacPostal = $row['FacPostal'];
		$FacDistrict = $row['FacDistrict'];
		$FacCountry = $row['FacCountry'];
		$SecType = $row['SecType'];
		$SecCode = $row['SecCode'];
		$TelephoneNumber = $row['TelephoneNumber'];
		$fileName1 = $row['UploadMoneyReceipt'];
		$fileName2 = $row['UploadPromiseLetter'];
		$fileName3 = $row['UploadOtherDocs'];
		$voucherNumber = $row['voucherNumber'];
		$voucherDate = $row['voucherDate'];
		$voucherAmount = $row['voucherAmount'];
		$contractHistory = $row['contractHistory'];
		$contractPhase = $row['contractPhase'];
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
	     <th>Individual Information:</th> <th>:</th><td><?php echo $indiviCompnyInfo; ?></td> 
		    <th>FI Subject Code</th><th>:</th> <td><?php echo $FISubCode; ?></td> 
		    
		 </tr>
	  </thead>
   <thead class="thead-light">
<tr>
		<th>Type of Financing</th> <th>:</th><td><?php echo $FinTypeID; ?></td>
      <th>Total Requested Amount</th> <th>:</th> <td><?php echo $TotalReqAmt; ?></td> 
      <th>Contract History</th> <th>:</th> <td><?php echo $contractHistory; ?></td> 
		 </tr>
		 <tr>
      <th>Contract Phase</th> <th>:</th> <td><?php echo $contractPhase; ?></td> 
		 </tr>
	  </thead>
	
	  <input type="hidden" value="<?php echo $trNo; ?>" name="trNo" id="trNo" />
	  
</table>


     <div class="panel panel-default" id = "ICD">
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
	     <th>Installment Amount:</th> <th>:</th><td><?php echo $InstallmentAmt; ?></td> 
		    <th>Periodicity of Payment</th><th>:</th> <td><?php echo $PerodicityPayment; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
</div>

<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Institution Subject Data</span>
		</div>
		<table class="table table-bordered">
 <thead class="thead-light">
    <tr>
      <th>Institution Type</th> <th>:</th> <td><?php echo $InstitutionType; ?></td> 
	     <th>Trade Name Title:</th> <th>:</th><td><?php echo $Title; ?></td> 
		    <th>Trade Name</th><th>:</th> <td><?php echo $TradeName; ?></td> 
		 </tr>
	  </thead>
	
 <thead class="thead-light">
		  <tr>
      <th>Legal Form</th> <th>:</th> <td><?php echo $LegalForm; ?></td> 
	     <th>ETIN</th> <th>:</th><td><?php echo $Etin; ?></td> 
		    <th>Registration Number</th><th>:</th> <td><?php echo $RJSCRegNo; ?></td> 
		    <th>Registration Date</th> <th>:</th><td><?php echo empty($RegDate)==false? date("d-m-Y",strtotime(str_replace('/', '-', $RegDate))): $RegDate; ?></td> 
		 </tr>
		 </thead>
		 </table>
	
 
	  </thead>
	  
	  
</table>
		</div>

 <div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Business Address</span>
		
		</div>
		
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Street</th> <th>:</th> <td><?php echo $BusStreet; ?></td> 
	     <th>Postal:</th> <th>:</th><td><?php echo $BusPostal; ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $BusDistrict; ?></td> 
		    <th>Country</th> <th>:</th><td><?php echo $BusCountry; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
</div>

<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Factory Address</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Street</th> <th>:</th> <td><?php echo $FacStreet; ?></td> 
	     <th>Postal:</th> <th>:</th><td><?php echo $FacPostal; ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $FacDistrict; ?></td> 
		    <th>Country</th> <th>:</th><td><?php echo $FacCountry; ?></td> 
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
		<?php
		
	$a1="SELECT * FROM `individual` WHERE `TrackingNo` = '$trNo'";
		$res1 = mysqli_query($conn, $a1);
		$rowcount=mysqli_num_rows($res1);
		$rowcount1=0;
		$w=1;

	while($rowcount1<$rowcount){
	
while($data1 = mysqli_fetch_array($res1))
{	
	
	//echo '<br><br><br><br><br><br>saddddd';
	?>
	<p style="font-size:20px; text-decoration: none;color: #f60050 ;">Owner Data: <?php echo $w++;?></p>
		<hr style="height:5px; width:100%; border-width:0; color:red; background-color:red">
	<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Individual Subject Data</span>
		</div>
		<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Title</th> <th>:</th> <td><?php echo $data1['Title'];  ?></td> 
	     <th>Name</th> <th>:</th><td><?php echo $data1['Name']; ?></td> 
		    <th>Father's Title</th><th>:</th> <td><?php echo $data1['FatherTitle']; ?></td> 
		    <th>Father's Name</th> <th>:</th><td><?php echo $data1['FatherName']; ?></td> 
		 </tr>
		  <tr>
      <th>Mother's Title</th> <th>:</th> <td><?php echo $data1['MotherTitle']; ?></td> 
	     <th>Mother's Name</th> <th>:</th><td><?php echo $data1['MotherName']; ?></td> 
		    <th>Spouse's Title</th><th>:</th> <td><?php echo $data1['SpouseTitle']; ?></td> 
		    <th>Spouse's Name</th> <th>:</th><td><?php echo $data1['SpouseName']; ?></td> 
		 </tr>
		  <tr>
      <th>Date of Birth</th> <th>:</th> <td><?php echo empty($data1['BirthDate'])==false? date("d-m-Y",strtotime(str_replace('/', '-', $data1['BirthDate']))): $data1['BirthDate']; ?></td> 
	     <th>NID</th> <th>:</th><td><?php echo $data1['NID']; ?></td> 
		    <th>Etin</th><th>:</th> <td><?php echo $data1['Etin']; ?></td> 
		    <th>Telephone Number</th> <th>:</th><td><?php echo $data1['TelephoneNumber']; ?></td> 
		 </tr>
		 <tr>
      <th>District of Birth</th> <th>:</th> <td><?php echo $data1['BirthDistrict']; ?></td> 
	     <th>Country of Birth</th> <th>:</th><td><?php echo $data1['BirthCountry']; ?></td> 
		    <th>Sector Type</th><th>:</th> <td><?php echo $data1['SecType']; ?></td> 
		    <th>Sector Code</th><th>:</th> <td><?php echo $data1['SecCode']; ?></td> 
		 </tr>
 <tr>
      <th>Gender</th> <th>:</th> <td><?php echo $data1['Gender'];  ?></td> 
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
      <th>Street</th> <th>:</th> <td><?php echo $data1['PerStreet'];  ?></td> 
	     <th>Postal</th> <th>:</th><td><?php echo $data1['PerPostal'];  ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $data1['PerDistrict'];  ?></td> 
		    <th>Country</th> <th>:</th><td><?php echo $data1['PerCountry'];  ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
</div>
	 <div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#940a44;"> <span style="color: white; font-size:16px;">Present Address</span>
		
		</div>
		
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Street</th> <th>:</th> <td><?php echo $data1['PreStreet'];  ?></td> 
	     <th>Postal</th> <th>:</th><td><?php echo $data1['PrePostal'];  ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $data1['PreDistrict'];  ?></td> 
		    <th>Country</th> <th>:</th><td><?php echo $data1['PreCountry'];  ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
</div>
<?php 
if ( ($data1['IDType']=="") && ($data1['IDNumber']==""))
{
}
else
{
?>
<div class="panel panel-default" id = "OIT" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Other ID</span>
	</div>
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>


		 <th>ID Type</th> <th>:</th> <td><?php echo $data1['IDType']; ?></td> 
 	     <th>ID Number</th> <th>:</th><td><?php echo  $data1['IDNumber']; ?></td>
		 <th>ID Issue Date</th><th>:</th> <td><?php echo empty($data1['IDIssueDate'])==false? date("d-m-Y",strtotime(str_replace('/', '-', $data1['IDIssueDate']))): $data1['IDIssueDate']; ?></td> 
		 <th>ID Issue Country</th> <th>:</th><td><?php  echo $data1['IDIssueCountry']; ?></td> 
		 </tr>
	  </thead>
	  
</table> 
	
		</div>
		
	<?php
	
}	
		
		
		

	}
$rowcount1++;	

}
		
		
	?>	
		
<section> 


<p align="right">
<br><a href="home.php" class="btn btn-warning btn-lg"> <span class="glyphicon glyphicon-step-backward"></span> Back </a>
<span style="margin-left:10px;"> &nbsp; <button type="submit" id="SubmitHO" name="SubmitHO" class="btn btn-lg btn-success">Submit to Head Office <span class='glyphicon glyphicon-step-forward'></span></button> </span>

</p>

</section>
		

	
	
	
</form>

</div>
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