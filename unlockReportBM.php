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
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo";
	
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
		$fileName = $row['UploadNID'];
		$UploadMoneyReceipt = $row['UploadMoneyReceipt'];
		$UploadPromiseLetter = $row['UploadPromiseLetter'];
		$UploadOtherDocs = $row['UploadOtherDocs'];
	
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


if (isset($_POST['SubmitBM']))
{
	$trN=$_POST['trNo'];
	$trNo='';
	//echo '<br><br><br><br><br><br><br><br>dfdfdf'.$trNo; exit;
	$sql = "UPDATE `inquiry` SET  `status`=1 where `TrackingNo`='$trN'";

if (mysqli_multi_query($conn, $sql))
        {
			echo '<center>';
			echo '<h2><br><br><br><br><span style="color: green;">Successfully Send to Branch Manager.</span></h2>';
			echo "<a class='btn btn-default btn-lg blue' href='individual.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Edit</a><br><br>";
			echo '</center>';
			echo '<center>';
			echo "<a class='btn btn-default btn-lg blue' href='generate_pdf/genPdfIndividual.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Generate PDF</a><br><br>";
			echo '</center>';
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
 
     <div class="wrapper"><div style="text-align:center;font-size:2vw;background-color:green;color:white;width:100%;height:48px;padding-top:7px;margin-bottom:10px">CIB ONLINE INQUIRY FORM-1</div>
		

         <!-- form start -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="individual" method="post" name= "form1" role="form" id="register-form" autocomplete="off" onsubmit="return validateForm()" enctype="multipart/form-data" >
		  
 <div class="body_style">
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Loan Type</th> <th>:</th> <td><?php echo $LoanType; ?></td> 
	     <th>Individual Information:</th> <th>:</th><td><?php echo $indiviCompnyInfo; ?></td> 
		    <th>FI Subject Code</th><th>:</th> <td><?php echo $FISubCode; ?></td> 
		    <th>Type of Financing</th> <th>:</th><td><?php echo $FinTypeID; ?></td> 
		 </tr>
	  </thead>
   <thead class="thead-light">
    <tr>
      <th>Total Requested Amount</th> <th>:</th> <td><?php echo $TotalReqAmt; ?></td> 
	     <th>Role in the Institution</th> <th>:</th><td><?php echo $Role; ?></td> 
		 </tr>
	  </thead>
	
	  <input type="hidden" value="<?php echo $trNo; ?>" name="trNo" id="trNo" />
	  
</table>


     <div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Installment Contract Data</span>
		
		</div>
		
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Number of Installment</th> <th>:</th> <td><?php echo $InstallmentNo; ?></td> 
	     <th>Individual Information:</th> <th>:</th><td><?php echo $indiviCompnyInfo; ?></td> 
		    <th>FI Subject Code</th><th>:</th> <td><?php echo $FISubCode; ?></td> 
		    <th>Type of Financing</th> <th>:</th><td><?php echo $FinTypeID; ?></td> 
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
	     <th>Name:</th> <th>:</th><td><?php echo $Name; ?></td> 
		    <th>Father's Title</th><th>:</th> <td><?php echo $FatherTitle; ?></td> 
		    <th>Father's Name</th> <th>:</th><td><?php echo $FatherName; ?></td> 
		 </tr>
		  <tr>
      <th>Mother's Title</th> <th>:</th> <td><?php echo $MotherTitle; ?></td> 
	     <th>Mother's Name</th> <th>:</th><td><?php echo $MotherName; ?></td> 
		    <th>Spouse's Title</th><th>:</th> <td><?php echo $SpouseTitle; ?></td> 
		    <th>Spouse's Name</th> <th>:</th><td><?php echo $Spouse; ?></td> 
		 </tr>
		  <tr>
      <th>Date of Birth</th> <th>:</th> <td><?php echo $BirthDate; ?></td> 
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
<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Other ID</span>
	</div><table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>ID Type</th> <th>:</th> <td><?php echo $IDType; ?></td> 
	     <th>ID Number</th> <th>:</th><td><?php echo $IDNumber; ?></td> 
		    <th>ID Issue Date</th><th>:</th> <td><?php echo $IDIssueDate; ?></td> 
		    <th>ID Issue Country</th> <th>:</th><td><?php echo $IDIssueCountry; ?></td> 
		 </tr>
	  </thead>
	  
	  
</table> 
			<section> 
	
	
	
	
<div class="form-group" style="background-color:#dbf3ef;>        
	<div class="save" style="text-align:center;"></div>
	<button type="submit" id="SubmitBM" name="SubmitBM" class="btn btn-info"style="border:1px solid #980be4;float:right;width: 200px;margin-left:650px;">Submit to Branch Manager <span class='glyphicon glyphicon-arrow-right'></span></button>
	

	</section>
		
		</div>


	
	
	
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
