<?php
ob_start();
session_start();
include ('header.php');
include ('config.php');
ini_set('display_errors', 'off');
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
if(isset($_GET['gtrNo']))
{
	$trNo=$_GET['gtrNo'];
	$type=$_GET['type'];
	
	//echo '<br><br><br><br><br><br><br><br><br><br>loanfddfdsf type '.$trNo;
	if($type=='Company')
	{
		$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN company c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo and i.status=3";

	}
	else if($type=='Individual')
	{
		$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN individual c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo and i.status=3";
	}
	else if ($type=='propietorship') {
		$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN propietorship c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo and i.status=3";
	}
	

	$res = mysqli_query($conn, $sqlload);

	if (mysqli_affected_rows($conn)>0)
	{
     	$row = mysqli_fetch_assoc($res);
		
		$TrackingNo = $row['TrackingNo'];
		$Zone_en = $row['Zone_en'];
		$brNameEn = $row['brNameEn'];
		$idd = $row['idd'];

	
	}

	
		//echo"<br><br><br><br><br><br>";
		//echo $sqlload;
		//exit;
	$res = mysqli_query($conn, $sqlload);
	$res1 = mysqli_query($conn, $sqlload);
	$res2 = mysqli_query($conn, $sqlload);
	
//echo $searchTrackingNo;exit();
 if($type=='Individual'){
while($data = mysqli_fetch_array($res)){?>
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
      <th>Loan Type</th> <th>:</th> <td><?php  echo $data['loanType'];  ?></td> 
	     <th>Individual Information:</th> <th>:</th><td><?php  echo $data['indiviCompnyInfo'];  ?></td> 
		    <th>FI Subject Code</th><th>:</th> <td><?php echo $data['FISubCode']; ?></td> 
		 </tr>
	  </thead>
   <thead class="thead-light">
    <tr>
		<th>Type of Financing</th> <th>:</th><td><?php echo $data['FinTypeID']; ?></td>
		<th>Total Requested Amount</th> <th>:</th> <td><?php echo $data['TotalReqAmt']; ?></td> 
		<th>Role in the Institution</th> <th>:</th><td><?php echo $data['Role']; ?></td> 
		</tr>
	  </thead>
	
	  <input type="hidden" value="<?php echo $trNo; ?>" name="trNo" id="trNo" />
	  
</table>


     <div class="panel panel-default" id= "ICD">
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Installment Contract Data</span>
		
		</div>
		
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
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
      <th>Number of Installment</th> <th>:</th> <td><?php echo $data['InstallmentNo']; ?></td> 
	     <th>Installment Amount:</th> <th>:</th><td><?php echo $data['InstallmentAmt'];?></td> 
		    <th>Periodicity of Payment</th><th>:</th> <td><?php echo $data['PerodicityPayment']; ?></td> 
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
      <th>Title</th> <th>:</th> <td><?php  echo $data['Title']; ?></td> 
	     <th>Name:</th> <th>:</th><td><?php echo $data['Name']; ?></td> 
		    <th>Father's Title</th><th>:</th> <td><?php echo $data['FatherTitle']; ?></td> 
		    <th>Father's Name</th><th>:</th> <td><?php echo $data['FatherName']; ?></td> 
		 </tr>
		  <tr>
      <th>Mother's Title</th> <th>:</th> <td><?php echo $data['MotherTitle']; ?></td> 
	     <th>Mother's Name</th> <th>:</th><td><?php echo $data['MotherName']; ?></td> 
		    <th>Spouse's Title</th><th>:</th> <td><?php echo $data['SpouseTitle']; ?></td> 
		    <th>Spouse's Name</th> <th>:</th><td><?php echo $data['SpouseName']; ?></td> 
		 </tr>
		  <tr>
      <th>Date of Birth</th> <th>:</th> <td><?php  $B=$data['BirthDate']; echo empty($B)==false? date("d-m-Y",strtotime(str_replace('/', '-', $B))): $B; ?></td> 
	     <th>NID</th> <th>:</th><td><?php echo $data['NID']; ?></td> 
		    <th>Etin</th><th>:</th> <td><?php echo $data['Etin']; ?></td> 
		    <th>Telephone Number</th> <th>:</th><td><?php echo $data['TelephoneNumber']; ?></td> 
		 </tr>
		 <tr>
      <th>District of Birth</th> <th>:</th> <td><?php echo $data['BirthDistrict']; ?></td> 
	     <th>Country of Birth</th> <th>:</th><td><?php echo $data['BirthCountry']; ?></td> 
		    <th>Sector Type</th><th>:</th> <td><?php echo $data['SecType']; ?></td> 
		    <th>Sector Code</th><th>:</th> <td><?php echo $data['SecCode']; ?></td> 
		 </tr>
 <tr>
      <th>Gender</th> <th>:</th> <td><?php echo $data['Gender']; ?></td> 
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
      <th>Street</th> <th>:</th> <td><?php echo $data['PerStreet']; ?></td> 
	     <th>Postal:</th> <th>:</th><td><?php echo $data['PerPostal']; ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $data['PerDistrict']; ?></td> 
		    <th>Country</th> <th>:</th><td><?php echo $data['PerCountry'];?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
</div>

<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Present Address</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Street</th> <th>:</th> <td><?php echo $data['PreStreet']; ?></td> 
	     <th>Postal:</th> <th>:</th><td><?php echo $data['PrePostal']; ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $data['PreDistrict'];?></td> 
		    <th>Country</th> <th>:</th><td><?php echo  $data['PreCountry']; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
		
		
		</div>
<div class="panel panel-default" id = "OIT">
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Other ID</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
	
      <th>ID Type</th> <th>:</th> <td><?php echo $data['IDType']; ?></td> 
	     <th>ID Number</th> <th>:</th><td><?php echo $data['IDNumber']; ?></td> 
		    <th>ID Issue Date</th><th>:</th> <td><?php  $I=$data['IDIssueDate']; echo empty($I)==false? date("d-m-Y",strtotime(str_replace('/', '-', $I))): $I; ?></td> 
		    <th>ID Issue Country</th> <th>:</th><td><?php echo $data['IDIssueCountry']; ?></td> 
		 </tr>
	  </thead>
	  
	<?php	if  (($data['IDNumber']=="")&&($data['IDType']=="")&& ($data['IDIssueCountry	']=="")) {
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
</table> 
</div>
<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">CIB Inquiry Fee</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Fee Amount</th> <th>:</th> <td><?php echo $data['voucherAmount']; ?></td> 
	     <th>Voucher Number</th> <th>:</th><td><?php echo $data['voucherNumber'];; ?></td> 
		    <th>Date</th><th>:</th> <td><?php echo $data['voucherDate'];; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
		
		
		</div>
		<p align="right">
<a href="dashboard.php"  class="btn btn-lg btn-info btn-md"><span class="glyphicon glyphicon-step-backward"></span> Back </a>&nbsp; &nbsp;&nbsp; &nbsp;
</p>
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
}
 }
	}
	 if($type=='Company'){
		  while($data = mysqli_fetch_array($res1)){
		 ?>
		
<head>
<title>CIB Inquiry System</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
 <script type='text/javascript' src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
     
    <script type='text/javascript'src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  
      
    <script  type='text/javascript'src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      

<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script> 


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
      <th>Loan Type</th> <th>:</th> <td><?php echo $data['loanType']; ?></td> 
	     <th>Institution Information:</th> <th>:</th><td><?php echo $data['InstitutionType'];?></td> 
		    <th>FI Subject Code</th><th>:</th> <td><?php echo $data['indiviCompnyInfo']; ?></td> 
		 </tr>
	  </thead>
   <thead class="thead-light">
    <tr>
			    <th>Type of Financing</th> <th>:</th><td><?php echo $data['FinTypeID']; ?></td> 

      <th>Total Requested Amount</th> <th>:</th> <td><?php echo $data['TotalReqAmt']; ?></td> 
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
      <th>Number of Installment</th> <th>:</th> <td><?php echo $data['InstallmentNo']; ?></td> 
	     <th>Installment Amount:</th> <th>:</th><td><?php echo $data['InstallmentAmt']?></td> 
		    <th>Periodicity of Payment</th><th>:</th> <td><?php echo $data['PerodicityPayment']; ?></td> 
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
      <th>Institution Type</th> <th>:</th> <td><?php echo $data['InstitutionType'];?></td> 
	     <th>Title:</th> <th>:</th><td><?php echo $data['Title']; ?></td> 
		    <th>Trade Name</th><th>:</th> <td><?php echo $data['TradeName']; ?></td> 
		 </tr>
			 <tr>
	   <th>Legal Form</th> <th>:</th><td><?php echo $data['LegalForm']; ?></td> 	 
      <th>Etin</th> <th>:</th> <td><?php echo $data['Etin'];; ?></td> 
	     <th>RJSC Registration Number</th> <th>:</th><td><?php echo $data['RJSCRegNo']; ?></td> 
		 </tr>
			 <tr>
		    <th>Registration Date</th><th>:</th> <td><?php $R= $data['RegDate']; echo empty($R)==false? date("d-m-Y",strtotime(str_replace('/', '-', $R))): $R; ?> </td> 
		    <th>Telephone Number</th> <th>:</th><td><?php echo $data['TelephoneNumber']; ?></td> 
		    <th>Sector Type</th><th>:</th> <td><?php echo $data['SecType']; ; ?></td> 
		 
		 </tr>
		 <tr>
		    <th>Sector Code</th><th>:</th> <td><?php echo $data['SecCode']; ; ?></td> 
		   
		 </tr>
	  </thead>
	  
	  
</table>
		</div>

 <div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Business Address</span>
		
		</div>
		
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Street</th> <th>:</th> <td><?php echo $data['BusStreet'];  ?></td> 
	     <th>Postal:</th> <th>:</th><td><?php echo $data['BusPostal']; ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $data['BusDistrict'];  ?></td> 
		    <th>Country</th> <th>:</th><td><?php  echo $data['BusCountry']; ; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
</div>

<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Factory Address</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Street</th> <th>:</th> <td><?php echo $data['FacStreet'];  ?></td> 
	     <th>Postal:</th> <th>:</th><td><?php echo $data['FacPostal']; ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $data['FacDistrict'];  ?></td> 
		    <th>Country</th> <th>:</th><td><?php echo $data['FacCountry']; ; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
		
		
		</div>
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">CIB Inquiry Fee</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Fee Amount</th> <th>:</th> <td><?php echo $data['voucherAmount']; ?></td> 
	     <th>Voucher Number</th> <th>:</th><td><?php echo $data['voucherNumber'];?></td> 
		    <th>Date</th><th>:</th> <td><?php echo $data['voucherDate']; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
<?php
		$a1="SELECT * FROM `individual` WHERE `TrackingNo` = '$trNo'";
		 //echo $a1;
		 //exit;
		$res7 = mysqli_query($conn, $a1);
		$rowcount=mysqli_num_rows($res7);
		$rowcount1=0;
		$w=1;

	while($rowcount1<$rowcount){
	
while($data1 = mysqli_fetch_array($res7))
{	
	
	//echo '<br><br><br><br><br><br>saddddd';
	?>
	<p style="font-size:20px; text-decoration: none;color: #f60050 ;">Owner: <?php echo $w++; ?></p>
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
		<div class="panel-heading" style="background-color:#940a44;"> <span style="color: white; font-size:16px;">Permanent Address</span>
		
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
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Present Address</span>
		
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
<div class="panel panel-default" id = "OIT" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Other ID</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
		  <?php	if ( ($data1['IDType']=="") && ($data1['IDNumber']=="")){
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
		 <th>ID Type</th> <th>:</th> <td><?php echo $data1['IDType']; ?></td> 
 	     <th>ID Number</th> <th>:</th><td><?php echo  $data1['IDNumber']; ?></td>
		 <th>ID Issue Date</th><th>:</th> <td><?php echo empty($data1['IDIssueDate'])==false? date("d-m-Y",strtotime(str_replace('/', '-', $data1['IDIssueDate']))): $data1['IDIssueDate']; ?></td> 
		 <th>ID Issue Country</th> <th>:</th><td><?php  echo $data1['IDIssueCountry']; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
	
		</div>
	<!--	<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">CIB Inquiry Fee</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Fee Amount</th> <th>:</th> <td><?php echo $data1['voucherNumber']; ?></td> 
	     <th>Voucher Number</th> <th>:</th><td><?php $data1['voucherAmount']; ?></td> 
		    <th>Date</th><th>:</th> <td><?php echo $data1['voucherDate']; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
		
		
		</div>-->
	<?php
	
		
		
		
		

	}
$rowcount1++;	

}
		
		
	?>	

		
		</div>
	<p align="right">
<a href="dashboard.php"  class="btn btn-lg btn-info btn-md"><span class="glyphicon glyphicon-step-backward"></span> Back </a>&nbsp; &nbsp;&nbsp; &nbsp;
</p>
</div>
</div></div>
</div>
<section> 


</section>
		 
	<?php	 
	 }
	 }
	 if($type=='propietorship'){
	 //echo '<br><br><br><br><br><br><br><br><br><br><br>';
	 //echo"ghgghfhftr";
	 //exit();

	if (mysqli_affected_rows($conn)>0)
	{
     	$row = mysqli_fetch_assoc($res2);
		
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
	    $TradeTitle = $row['TradeTitle'];
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
		$OwnerTelephoneNumber = $row['OwnerTelephoneNumber'];
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
		$contractHistory = $row['contractHistory'];
		$contractPhase = $row['contractPhase'];
		$BirthDate = $row['BirthDate'];
		$voucherNumber = $row['voucherNumber'];
		$voucherDate = $row['voucherDate'];
		$voucherAmount = $row['voucherAmount'];
		$fileName1 = $row['UploadMoneyReceipt'];
		$fileName2 = $row['UploadPromiseLetter'];
		$fileName3 = $row['UploadOtherDocs'];
	
	}	
	?>
	<!DOCTYPE html>
<br><br><br>
<html>

<head>
<title>CIB Inquiry System</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
 <script type='text/javascript' src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
     
    <script type='text/javascript'src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  
      
    <script  type='text/javascript'src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      

<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script> 


</head>

<body>

<!DOCTYPE html>
<br><br><br>
<html>

<head>
<title>CIB Inquiry System</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
 <script type='text/javascript' src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
     
    <script type='text/javascript'src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  
      
    <script  type='text/javascript'src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      

<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script> 


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
      <th>Total Requested Amount</th> <th>:</th> <td><?php echo $TotalReqAmt; ?></td> 
      <th>Contract History</th> <th>:</th> <td><?php echo $contractHistory; ?></td> 
      <th>Contract Phase</th> <th>:</th> <td><?php echo $contractPhase; ?></td> 
		 </tr>
	  </thead>
	
	  <input type="hidden" value="<?php echo $trNo; ?>" name="trNo" id="trNo" />
	  
</table>


     <div class="panel panel-default" id="ICD" >
		<div class="panel-heading"  style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Installment Contract Data</span>
		
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
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Institution Subject Data</span>
		</div>
		<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
	     <th>Title:</th> <th>:</th><td><?php echo $TradeTitle; ?></td> 
		    <th>Trade Name</th><th>:</th> <td><?php echo $TradeName; ?></td>
			<th>Legal Form</th> <th>:</th><td><?php echo $LegalForm; ?></td> 	 
			
		 </tr>

			 <tr>
		    <th>Business Telephone Number</th> <th>:</th><td><?php echo $TelephoneNumber; ?></td> 
		    <th>Sector Type</th><th>:</th> <td><?php echo $SecType; ?></td> 
		 		    <th>Sector Code</th><th>:</th> <td><?php echo $SecCode; ?></td> 

		 </tr>

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
		 <th>District of Birth</th> <th>:</th> <td><?php echo $BirthDistrict; ?></td> 
	     <th>Country of Birth</th> <th>:</th><td><?php echo $BirthCountry; ?></td> 
		 </tr>
	
 <tr>
      <th>Gender</th> <th>:</th> <td><?php echo $Gender; ?></td> 
      <th>Owner Telephone Number</th> <th>:</th> <td><?php echo $OwnerTelephoneNumber; ?></td> 
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
	     <th>Postal</th> <th>:</th><td><?php echo $PerPostal; ?></td> 
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
	     <th>Postal</th> <th>:</th><td><?php echo $PrePostal; ?></td> 
		    <th>District</th><th>:</th> <td><?php echo $PreDistrict; ?></td> 
		    <th>Country</th> <th>:</th><td><?php echo $PreCountry; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
		
		
		</div>
<div class="panel panel-default" id = "OIT" >
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
		
		
		</div></div>
<section> 

<p align="right">
<a href="dashboard.php"  class="btn btn-lg btn-info btn-md"><span class="glyphicon glyphicon-step-backward"></span> Back </a>&nbsp; &nbsp;&nbsp; &nbsp;
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
	 }
		 ?>


<?php
include ('templates\footer.php')
?>
