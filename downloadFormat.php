<?php
ob_start();
session_start();
include ('header.php');
include ('config.php');
ini_set('display_errors', 'off');
if(isset($_GET['trNo']))	
{
	
$trNo = $_GET['trNo'];
	

$sqlload="SELECT DISTINCT i.*,b.*,ind.* FROM inquiry i  inner JOIN  individual ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.status=3 and i.TrackingNo='$trNo';";

	$res = mysqli_query($conn, $sqlload);

	if (mysqli_affected_rows($conn)>0)
	{
     	$row = mysqli_fetch_assoc($res);
		$LoanType = $row['loanType'];
		$TrackingNo = $row['TrackingNo'];
		$formNo = $row['FormNo'];
		$brNameEn = $row['brNameEn'];
		$status = $row['status'];
		$idd = $row['idd'];
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
$sqlload1="SELECT DISTINCT i.*,b.*,c.* FROM inquiry i  inner JOIN  company c
ON  
i.TrackingNo = c.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.status=3 and i.TrackingNo='$trNo'";

	$res = mysqli_query($conn, $sqlload1);

	if (mysqli_affected_rows($conn)>0)
	{
     	$row = mysqli_fetch_assoc($res);
		$LoanType = $row['loanType'];
		$TrackingNo = $row['TrackingNo'];
		$formNo = $row['FormNo'];
		$brNameEn = $row['brNameEn'];
		$status = $row['status'];
		$idd = $row['idd'];
		$FISubCode = $row['FISubCode'];
		$FinTypeID = $row['FinTypeID'];
		$TotalReqAmt = $row['TotalReqAmt'];
		$InstallmentNo =$row['InstallmentNo'];
		$InstallmentAmt = $row['InstallmentAmt'];
		$PerodicityPayment = $row['PerodicityPayment'];
		$Role = $row['Role'];
		$Title = $row['Title'];
		$TradeName = $row['TradeName'];
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
	$sqlload2="SELECT DISTINCT i.*,b.*,c.* FROM inquiry i  inner JOIN  propietorship c
ON  
i.TrackingNo = c.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.status=3 and i.TrackingNo='$trNo'";

	$res3 = mysqli_query($conn, $sqlload2);
if (mysqli_affected_rows($conn)>0)
	{
     	$row = mysqli_fetch_assoc($res3);
		
		$status = $row['status'];
		$LoanType = $row['loanType'];
		$indiviCompnyInfo = $row['indiviCompnyInfo'];
		$TrackingNo = $row['TrackingNo'];
		$formNo = $row['FormNo'];
		$brNameEn = $row['brNameEn'];
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
		$fileName1 = $row['UploadMoneyReceipt'];
		$fileName2 = $row['UploadPromiseLetter'];
		$fileName3 = $row['UploadOtherDocs'];
	
	}	
	

}
else
{
	header("Location:home.php");
	exit;
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
<style>
.bgh{
	background-image: url('img/bgimg.jpg');
	background-repeat:no-repeat;
	background-position: right;
	height:100%; /* you can change that height to 100%, please get sure youre Header is ready */
	background-size:cover;
}
.hdn{
    font-size: 30pt;
    font-weight: 700;
    letter-spacing: -1px;
    text-decoration: underline;
}
.headingList
{
	font-size:25px;
}
p {
  color: green;
  font-size: 15px;
  text-transform: uppercase;
}
</style>

</head>

<body>

<div class="container">


         <!-- form start -->
		 
		 
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="individual" method="post" name= "form1" role="form" id="register-form" autocomplete="off" onsubmit="return validateForm()" enctype="multipart/form-data" >
<div class="container" >


<br>
<h2 style="text-align:center;color: blue;">Branch Name: <?php echo $brNameEn; ?><br> 

<strong style="text-align:center;color: green;">Tracking No: <?php echo $TrackingNo; ?></strong>
</h2>
<br>

<div style="width:50%; margin-left:100px;">
<h2 style="color:blue;">List of Documents for Downloading: </h2>
<h3>
<ul style="list-style-type:square;">

<?php 
if($formNo==1)
{	
?>
	<li><a href="generate_pdf/genPdfIndividual.php?gtrNo=<?php echo $trNo;?>"target="_blank" <span style="color:green;">CIB Inquiry Form(PDF)</span></a></li>

	<?php


	  if(!empty($row['UploadNID'])) 
			{ 
			   echo '<li ><a href="uploads/'.$row['UploadNID'].'" target="_blank"><span style="color:green;">National ID</span></a></li>';
			}  
		 if(!empty($row['UploadMoneyReceipt']))
			 {
				echo '<li><a href="uploads/'.$row['UploadMoneyReceipt'].'" target="_blank"><span style="color:green;">Money Receipt</span></a></li>';
			 }	
		 if(!empty($row['UploadPromiseLetter']))
			 {
				echo '<li><a href="uploads/'.$row['UploadPromiseLetter'].'" target="_blank"><span style="color:green;">Letter of Promise</span></a></li>';
			 } 
		if(!empty($row['UploadOtherDocs']))
			{
			   echo '<li><a href="uploads/'.$row['UploadOtherDocs'].'" target="_blank"><span style="color:green;">Other Documents</span></a></li>';
			}  
	 
}
     
if($formNo==2)
{
?>
	<li><a href="generate_pdf/genPdfCompany.php?gtrNo=<?php echo $trNo;?>"target="_blank" <span style="color:green;">CIB Inquiry Form(PDF)</span></a></li>

	<?php

//echo '<li><a href="uploads/'.$row['UploadMoneyReceipt'].'" target="_blank">Money Receipt</a></li>';

	  if(!empty($row['UploadMoneyReceipt'])) 
			{ 
			   echo '<li><a href="uploads/'.$row['UploadMoneyReceipt'].'" target="_blank"><span style="color:green;">Money Receipt</span></a></li>';
			} 
		 if(!empty($row['UploadPromiseLetter']))
			 {
				echo '<li><a href="uploads/'.$row['UploadPromiseLetter'].'" target="_blank"><span style="color:green;">Letter of Promise</span></a></li>';
			 }	
		 if(!empty($row['UploadOtherDocs']))
			 {
				echo '<li><a href="uploads/'.$row['UploadOtherDocs'].'" target="_blank"><span style="color:green;">Other Documents</span></a></li>';
			 } 
		$a1="SELECT * FROM `individual` WHERE `TrackingNo` = '$trNo'";
//echo '<br><br><br><br><br><br><br><br><br>';
//echo $a1;
//exit();
$r = mysqli_query($conn, $a1);
$rowcount=mysqli_num_rows($r);
$rowcount1=0;
while($rowcount1<$rowcount){
//echo '<br><br><br><br><br><br><br><br><br>';
//echo "dfsdfdsfsdfdsf";
//exit();
	$rowcount2=1;
while($data1 = mysqli_fetch_array($r))
{

	?>
	 <h2 style="color:blue;">Owner-<?php echo $rowcount2++;?> </h2>
	<li><a href="generate_pdf/genPdfcmpIndividual.php?gtrNo=<?php echo $data1[SlNo];?>"target="_blank" <span style="color:green;">CIB Inquiry Form(PDF)</span></a></li>

	<?php


	  if(!empty($data1['UploadNID'])) 
			{ 
			   echo '<li ><a href="uploads/'.$data1['UploadNID'].'" target="_blank"><span style="color:green;">National ID</span></a></li>';
			}  
		 if(!empty($data1['UploadMoneyReceipt']))
			 {
				echo '<li><a href="uploads/'.$data1['UploadMoneyReceipt'].'" target="_blank"><span style="color:green;">Money Receipt</span></a></li>';
			 }	
		 if(!empty($data1['UploadPromiseLetter']))
			 {
				echo '<li><a href="uploads/'.$data1['UploadPromiseLetter'].'" target="_blank"><span style="color:green;">Letter of Promise</span></a></li>';
			 } 
		if(!empty($data1['UploadOtherDocs']))
			{
			   echo '<li><a href="uploads/'.$data1['UploadOtherDocs'].'" target="_blank"><span style="color:green;">Other Documents</span></a></li>';
			} 
}
$rowcount1++;	
}	 
			 
}	
if($formNo==3)
{
	?>
	<li><a href="generate_pdf/genPdfPropietorship.php?gtrNo=<?php echo $trNo;?>"target="_blank" <span style="color:green;">CIB Inquiry Form(PDF)</span></a></li>

	<?php

//echo '<li><a href="uploads/'.$row['UploadMoneyReceipt'].'" target="_blank">Money Receipt</a></li>';
if(!empty($row['UploadNID'])) 
			{ 
			   echo '<li ><a href="uploads/'.$row['UploadNID'].'" target="_blank"><span style="color:green;">National ID</span></a></li>';
			} 
	  if(!empty($row['UploadMoneyReceipt'])) 
			{ 
			   echo '<li><a href="uploads/'.$row['UploadMoneyReceipt'].'" target="_blank"><span style="color:green;">Money Receipt</span></a></li>';
			} 
		 if(!empty($row['UploadPromiseLetter']))
			 {
				echo '<li><a href="uploads/'.$row['UploadPromiseLetter'].'" target="_blank"><span style="color:green;">Letter of Promise</span></a></li>';
			 }	
		 if(!empty($row['UploadOtherDocs']))
			 {
				echo '<li><a href="uploads/'.$row['UploadOtherDocs'].'" target="_blank"><span style="color:green;">Other Documents</span></a></li>';
			 } 

}
 ?>
	</ul>

	</h3>
</div>	
<p align="right">
<a href="dashboard.php"  class="btn btn-md btn-info btn-md"><span class="glyphicon glyphicon-step-backward"></span> Back </a>&nbsp; &nbsp;&nbsp; &nbsp;
</p><br><br>	
</form>

</div>
</div>
          
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery-1.11.2.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script src="assets/register.js"></script>
	

</body>
</html>
<br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include ('templates/footer.php')
?>