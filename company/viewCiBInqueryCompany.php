<?php
ob_start();
session_start();
include ('templates\header.php');
include ('config.php');
ini_set('display_errors', 'off');
if(isset($_GET['gtrNo']))
{
	$trNo=$_GET['gtrNo'];
	
	//echo '<br><br><br><br><br><br><br><br><br><br>loanfddfdsf type '.$trNo;

	$exist=1;
	
	$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN company c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo";
	
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
				echo "<a class='btn btn-default btn-lg blue' href='home.php'><span class='glyphicon glyphicon-edit'></span> Back</a><br><br>";
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
 
     <div class="wrapper"><div style="text-align:center;font-size:2vw;background-color:green;color:white;width:100%;height:48px;padding-top:7px;margin-bottom:10px">CIB ONLINE INQUIRY FORM-2</div>
		

         <!-- form start -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="individual" method="post" name= "form1" role="form" id="register-form" autocomplete="off" onsubmit="return validateForm()" enctype="multipart/form-data" >
		  
 <div class="body_style">
	<table class="table table-bordered">
  <thead class="thead-light">
    <tr>
      <th>Loan Type</th> <th>:</th> <td><?php echo $LoanType; ?></td> 
	     <th>Institution Information:</th> <th>:</th><td><?php echo $indiviCompnyInfo; ?></td> 
		    <th>FI Subject Code</th><th>:</th> <td><?php echo $FISubCode; ?></td> 
		    <th>Type of Financing</th> <th>:</th><td><?php echo $FinTypeID; ?></td> 
		 </tr>
	  </thead>
   <thead class="thead-light">
    <tr>
      <th>Total Requested Amount</th> <th>:</th> <td><?php echo $TotalReqAmt; ?></td> 
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
	     <th>Title:</th> <th>:</th><td><?php echo $Title; ?></td> 
		    <th>Trade Name</th><th>:</th> <td><?php echo $TradeName; ?></td> 
		 </tr>
			 <tr>
	   <th>Legal Form</th> <th>:</th><td><?php echo $LegalForm; ?></td> 	 
      <th>Etin</th> <th>:</th> <td><?php echo $Etin; ?></td> 
	     <th>RJSC Registration Number</th> <th>:</th><td><?php echo $RJSCRegNo; ?></td> 
		 </tr>
			 <tr>
		    <th>Registration Date</th><th>:</th> <td><?php echo $RegDate; ?></td> 
		    <th>Telephone Number</th> <th>:</th><td><?php echo $TelephoneNumber; ?></td> 
		    <th>Sector Type</th><th>:</th> <td><?php echo $SecType; ?></td> 
		 
		 </tr>
		 <tr>
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


<section> 


<p align="right">
<br><a href="home.php" class="btn btn-warning btn-lg"> <span class="glyphicon glyphicon-step-backward"></span> Back </a>
<span style="margin-left:10px;"> &nbsp; <button type="submit" id="SubmitBM" name="SubmitBM" class="btn btn-lg btn-success">Submit to Branch Manager <span class='glyphicon glyphicon-step-forward'></span></button> </span>

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
