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
//echo '<br><br><br><br><br><br><br><br>';
//echo $brCode;
    
}
else
{
    header("Location:login.php");
    exit;
}
$trNo = '';
$msgErr = '';
$LoanType = '';
$indiviCompnyInfo = '';
$FISubCode = '';
$FinTypeID = '';
$TotalReqAmt = '';
$InstallmentNo = '';
$InstallmentAmt = '';
$PerodicityPayment = '';
$InstitutionType = '';
$Title = '';
$TradeName = '';
$LegalForm = '';
$Etin = '';
$RJSCRegNo = '';
$RegDate = '';
$BusStreet = '';
$BusPostal = '';
$BusDistrict = '';
$BusCountry = '';
$FacStreet = '';
$FacPostal = '';
$FacDistrict = '';
$FacCountry = '';
$SecType = '';
$SecCode = '';
$voucherNumber = '';
$voucherAmount = '';
$voucherDate = '';
$contractHistory='';
$contractPhase='';
$fileName = '';
$UploadNID=null;
$UploadMoneyReceipt = null;
$UploadPromiseLetter = null;
$UploadOtherDocs = null;

if(isset($_GET['gtrNo']))
{
	$trNo=$_GET['gtrNo'];
	$exist=1;
	
	$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN company c
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
		$voucherNumber = $row['voucherNumber'];
		$voucherAmount = $row['voucherAmount'];
		$voucherDate = $row['voucherDate'];
		$contractHistory = $row['contractHistory'];
		$contractPhase = $row['contractPhase'];
		$fileName1 = $row['UploadMoneyReceipt'];
		$fileName2 = $row['UploadPromiseLetter'];
		$fileName3 = $row['UploadOtherDocs'];
	}
	
		else
	{
		echo '<center>';
		echo '<h2><br><br><br><br><span style="color: red;">Invalid Tracking No.</span></h2>';
		echo "<a class='btn btn-default btn-lg blue' href='home.php'><span class='glyphicon glyphicon-edit'></span> Home</a><br><br>";
		echo '</center>';
		exit;
	}
	if($status>0)
	{
		echo '<center>';
		echo '<h2><br><br><br><br><span style="color: red;">Edited Not Allowed.</span></h2>';
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
    
	//echo '<br><br><br><br><br><br><br><br><br><br>loanfsdfdsfsdsdfsfdsasasaerewrwr type '.$trNo;
}
else
{
    header("Location:login.php");
    exit;
}

			
}

if (isset($_POST['save']))
{
		$LoanType = $_POST['LoanType'];
		$indiviCompnyInfo = $_POST['indiviCompnyInfo'];
		$FISubCode = addslashes($_POST['FISubCode']);
		$FinTypeID = $_POST['FinTypeID'];
		$TotalReqAmt = $_POST['TotalReqAmt'];
	    $InstallmentNo = $_POST['InstallmentNo'];
	    $InstallmentAmt = $_POST['InstallmentAmt'];
		$PerodicityPayment = $_POST['PerodicityPayment'];
	    $InstitutionType = $_POST['InstitutionType'];
	    $Title = addslashes($_POST['Title']);
	    $TradeName = addslashes($_POST['TradeName']);
	    $LegalForm = $_POST['LegalForm'];
	    $Etin = $_POST['Etin'];
	    $RJSCRegNo = addslashes($_POST['RJSCRegNo']);
		$RegDate = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["RegDate"])));
	    //$RegDate = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["RegDate"])));		
	    //$RegDate = $_POST['RegDate'];		
	    $BusStreet = addslashes($_POST['BusStreet']);
	    $BusPostal = $_POST['BusPostal'];
		$BusDistrict =addslashes($_POST['BusDistrict']);
		$BusCountry = $_POST['BusCountry'];
		$FacStreet = addslashes($_POST['FacStreet']);
		$FacPostal = $_POST['FacPostal'];
		$FacDistrict = addslashes($_POST['FacDistrict']);
		$FacCountry = $_POST['FacCountry'];
		$SecType = $_POST['SecType'];
		$SecCode = $_POST['SecCode'];
		$TelephoneNumber = $_POST['TelephoneNumber'];
		$voucherNumber = addslashes($_POST['voucherNumber']);
		$voucherAmount = addslashes($_POST['voucherAmount']);
		$contractHistory = $_POST['contractHistory'];
		$contractPhase = $_POST['contractPhase'];
		$voucherDate = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["voucherDate"])));
		$UploadMoneyReceipt = $_POST['UploadMoneyReceipt'];
		$UploadPromiseLetter = $_POST['UploadPromiseLetter'];
		$UploadOtherDocs = $_POST['UploadOtherDocs'];
		$exist=$_POST['exist'];

		
		//$trNo=$brCode.date("ymdis").rand(1,99);
		
		    //echo '<br><br><br><br><br><br><br><br><br><br><br><br><br>loan type '.$LoanType;

		
		
		 if ($LoanType == "0")
    {
        $msgErr .= "Please select Loan Type <br>";
    }
	  if (empty($indiviCompnyInfo))
    {
        $msgErr .= "Please select Individual Information<br>";
    }
	 if (empty($FinTypeID))
    {
        $msgErr .= "Please enter Type of financing <br>";
    }
	 if (empty($TotalReqAmt))
    {
        $msgErr .= "Please enter total requested amount or credit limit<br>";
    }
	 if (empty($Title))
    {
        $msgErr .= "Please enter Title of the trade name<br>";
    }
	 if (empty($TradeName))
    {
        $msgErr .= "Please enter Trade name<br>";
    }
		 if ($LegalForm == "0")
    {
        $msgErr .= "Please select type of legal Form <br>";
    }
	 if (empty($BusStreet))
    {
        $msgErr .= "Please enter Street name and number of business address<br>";
    }
	if (empty($BusPostal))
    {
        $msgErr .= "Please enter postal number of business address<br>";
    }
	if (empty($BusDistrict))
    {
        $msgErr .= "Please enter district of business address<br>";
    }
	if (empty($BusCountry))
    {
        $msgErr .= "Please enter country of business address<br>";
    }
		 if ($SecType == "0")
    {
        $msgErr .= "Please select sector type<br>";
    }
	if (empty($SecCode))
    {
        $msgErr .= "Please enter sector code<br>";
    }
	
		
    if ($msgErr == '')
	{
		if($exist=='0'){
		$random=rand();
		$sqlGSL="SELECT count(`TrackingNo`) trno FROM `inquiry` WHERE `BranchId`='$brCode'";

		$rsl = mysqli_query($conn, $sqlGSL);
		$rwl = mysqli_fetch_assoc($rsl);
		$trNo3=$brCode . date("ymd").($rwl['trno']+1);
		$trNo=strval($trNo3);
		
$targetDir = "uploads/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName1 = $_FILES['UploadMoneyReceipt']['name'];
			if(empty($fileName1 )){
			$fileName1="";
			}
			else{
			$fileName1 = $random.$_FILES['UploadMoneyReceipt']['name'];
			}
			$file_tmp1 = $_FILES['UploadMoneyReceipt']['tmp_name'];
			$dir="uploads/".$fileName1;
			//echo '<br><br><br><br><br><br><br><br><br><br>loanf type fileName'.$fileName.' $file_tmp'.$file_tmp; exit;
			move_uploaded_file($file_tmp1,$dir);

$targetDir = "uploads/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName2 = $_FILES['UploadPromiseLetter']['name'];
			if(empty($fileName2 ))
			{
			$fileName2="";
			}
			else{
			$fileName2 = $random.$_FILES['UploadPromiseLetter']['name'];
			}
			$file_tmp2 = $_FILES['UploadPromiseLetter']['tmp_name'];
			$dir="uploads/".$fileName2;
			$extension2 = pathinfo($fileName2, PATHINFO_EXTENSION);
			move_uploaded_file($file_tmp2,$dir);
$targetDir = "uploads/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName3 = $_FILES['UploadOtherDocs']['name'];
			if(empty($fileName3 ))
			{
			$fileName3="";
			}
			else{
			$fileName3 = $random.$_FILES['UploadOtherDocs']['name'];
			}
			$file_tmp3 = $_FILES['UploadOtherDocs']['tmp_name'];
			$dir="uploads/".$fileName3;
			$extension3 = pathinfo($fileName3, PATHINFO_EXTENSION);
			move_uploaded_file($file_tmp3,$dir);
			
		$sql1 = "INSERT INTO `inquiry` (`TrackingNo`, `FormNo`, `indiviCompnyInfo`, `loanType`, `BankName`, `FICode`,
		`BranchId`, `FISubCode`, `CIBCode`, `FinTypeID`, `TotalReqAmt`, `InstallmentNo`, `InstallmentAmt`, `PerodicityPayment`, 
		`entryDate`, `entryUserId`, `authorizedUserId`, `authorizedDateTime`, `remarks`, `status`, `UploadCibReport`, `cibuploadDateTime`,
		`reportuploadUserId`, `docsUploaded`) VALUES ('$trNo','2','$indiviCompnyInfo','$LoanType','RAKUB','033','$brCode','$FISubCode','','$FinTypeID','$TotalReqAmt',
		'$InstallmentNo','$InstallmentAmt','$PerodicityPayment',CURRENT_TIMESTAMP,'$EntryUserId','','','','','','','','');
		
		INSERT INTO company (`TrackingNo`,`InstitutionType`,`Title`,`TradeName`,`LegalForm`,`Etin`
		,`RJSCRegNo`,`RegDate`,`BusStreet`,`BusPostal`,`BusDistrict`,`BusCountry`,`FacStreet`,`FacPostal`,
		`FacDistrict`,`FacCountry`,`SecType`,`SecCode`,`TelephoneNumber`,`UploadMoneyReceipt`,`UploadPromiseLetter`,`UploadOtherDocs`,`voucherNumber`,`voucherAmount`,`voucherDate`,`contractHistory`,`contractPhase`)
		values ('$trNo','$InstitutionType','$Title','$TradeName','$LegalForm','$Etin',
			'$RJSCRegNo','$RegDate','$BusStreet','$BusPostal','$BusDistrict','$BusCountry','$FacStreet',
			'$FacPostal','$FacDistrict','$FacCountry','$SecType',
			'$SecCode','$TelephoneNumber','$fileName1','$fileName2','$fileName3','$voucherNumber','$voucherAmount','$voucherDate','$contractHistory','$contractPhase')";
		//echo '<br><br><br><br><br><br><br><br><br><br>'.$sql1;exit();
		
				}
					else if($exist==1)
		{
			$random=rand(10,10000);
			$targetDir = "uploads/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName1 = $_FILES['UploadMoneyReceipt']['name'];
			if(empty($fileName1 ))
			{
			$fileName1="";
			}
			else{
			$fileName1 = $random.$_FILES['UploadMoneyReceipt']['name'];
			}
			$file_tmp1 = $_FILES['UploadMoneyReceipt']['tmp_name'];
			$dir="uploads/".$fileName1;
			$ext1 = pathinfo($fileName1, PATHINFO_EXTENSION);			
            $mrup='';
			  if($_POST['dphd3']==1)
			  {
				 $mrup="UploadMoneyReceipt='$fileName1',";
				 move_uploaded_file($file_tmp1,$dir);
			  }
			  else if($_POST['dphd3']==0 && !empty($fileName1))
			  {
				  $mrup="UploadMoneyReceipt='$fileName1',";
				  move_uploaded_file($file_tmp1,$dir);
			  }
			  else
			  {
				  
			  }	
		
		
$targetDir = "uploads/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName2 = $_FILES['UploadPromiseLetter']['name'];
			if(empty($fileName2 ))
			{
			$fileName2="";
			}
			else{
			$fileName2 = $random.$_FILES['UploadPromiseLetter']['name'];
			}
			$file_tmp2 = $_FILES['UploadPromiseLetter']['tmp_name'];
			$dir="uploads/".$fileName2;
			$extension2 = pathinfo($fileName2, PATHINFO_EXTENSION);
$plup='';
			  if($_POST['dphd4']==1)
			  {
				 $plup="UploadPromiseLetter='$fileName2',";
				 move_uploaded_file($file_tmp2,$dir);
			  }
			  else if($_POST['dphd4']==0 && !empty($fileName2))
			  {
				  $plup="UploadPromiseLetter='$fileName2',";
				  move_uploaded_file($file_tmp2,$dir);
			  }
			  else
			  {
				  
			  }		
$targetDir = "uploads/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName3 = $_FILES['UploadOtherDocs']['name'];
			if(empty($fileName3 ))
			{
			$fileName3="";
			}
			else{
			$fileName3 = $random.$_FILES['UploadOtherDocs']['name'];
			}
			$file_tmp3 = $_FILES['UploadOtherDocs']['tmp_name'];
			$dir="uploads/".$fileName3;
			$extension3 = pathinfo($fileName3, PATHINFO_EXTENSION);
$odup='';
			  if($_POST['dphd5']==1)
			  {
				 $odup="UploadOtherDocs='$fileName3',";
				 move_uploaded_file($file_tmp3,$dir);
			  }
			  else if($_POST['dphd5']==0 && !empty($fileName3))
			  {
				  $plup="UploadOtherDocs='$fileName3',";
				  move_uploaded_file($file_tmp3,$dir);
			  }
			  else
			  {
				  
			  }	
	if(($FinTypeID=="Term Loan")OR($FinTypeID=="Other installment contract"))
		{
			$InstallmentNo = $InstallmentNo;
			$InstallmentAmt = $InstallmentAmt;
			$PerodicityPayment =$PerodicityPayment;
		}
		else
		{
			$InstallmentNo = '';
			$InstallmentAmt = '';
			$PerodicityPayment = '';
		}
					  
		    $trNo=trim($_POST['trNo']);

			$sql1 = "update inquiry set loanType = '$LoanType',indiviCompnyInfo='$indiviCompnyInfo',FISubCode= '$FISubCode',FinTypeID='$FinTypeID',TotalReqAmt='$TotalReqAmt',
			InstallmentNo='$InstallmentNo',InstallmentAmt='$InstallmentAmt' where TrackingNo='$trNo';
			
			update company set InstitutionType= '$InstitutionType',Title ='$Title',TradeName='$TradeName',LegalForm='$LegalForm',Etin='$Etin',
			RJSCRegNo='$RJSCRegNo',RegDate='$RegDate',BusStreet='$BusStreet',BusPostal='$BusPostal',BusDistrict='$BusDistrict',BusCountry='$BusCountry',
			FacStreet='$FacStreet',FacPostal='$FacPostal',FacDistrict='$FacDistrict',FacCountry='$FacCountry',contractHistory='$contractHistory',contractPhase='$contractPhase'
			SecType='$SecType',SecCode='$SecCode', ".$mrup." ".$plup."
			".$odup." TelephoneNumber='$TelephoneNumber' where TrackingNo='$trNo'";
			
			//echo '<br><br><br><br><br><br><br><br>'.$sql1; exit;
					
			 

		}
		else
		{

		}
		
        if (mysqli_multi_query($conn, $sql1))
        {
            //echo '<center>';
            //echo '<h2><br><br><br><br><span style="color: green;">Successfully Save Information.</span></h2>';
           header("Location: cmpIndividual.php?gtrNo=".$trNo);
            //echo "<a class='btn btn-default btn-lg blue' href='generate_pdf/genPDFCompany.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Generate PDF</a><br><br>";
           // echo '</center>';
           // echo '<center>';
			//echo "<a class='btn btn-default btn-lg blue' href='viewCiBInqueryCompany.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> View Report and Submit to Manager</a><br><br>";
           // echo '</center>';
			exit;

        }

        else
        {
            echo "not inserted" . mysqli_error($conn);
        }
				 echo "not inserted" . mysqli_error($conn);

	}
	
	

}

$sqlperdis="SELECT DISTINCT DistrictCode, DistrictName FROM `location` ORDER by DistrictName asc;";
$rsperDist=mysqli_query($conn, $sqlperdis);
$rsperDist7=mysqli_query($conn, $sqlperdis);



$sqlc="SELECT DISTINCT country_code,country_name  FROM `apps_countries` ORDER by country_name asc";
$rspc=mysqli_query($conn, $sqlc);
$rspc7=mysqli_query($conn, $sqlc);
$sqlSec="SELECT * FROM `sheet1` where `remarks`='i'";
$rspc5=mysqli_query($conn, $sqlSec);
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
   
     <script type='text/javascript' src="js/jquery.inputmask.bundle.js"></script>
  
    <script  type='text/javascript'src="js/popper.min.js"></script>
        <script type='text/javascript'src="js/jquery.mask.js"></script>
  
      

	
<style>
* {box-sizing: border-box;}
 .error{
            color: red;
            background-color: #FFE4E1;
         }
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: white;
}

.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    color: #ffffff;
    background-color: #04aa26;

}

.topnav .search-container {
  float: left;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container a {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
  border: 1px solid #ccc; 
}



@media screen and (max-width: 400px) {
  .topnav .search-container {
    float: none;
  }

}
.required:after {
	content:" *";
	color: red;
	font-weight: bold;
}
.errortxt 
{
    color: red;
	background-color:#FFE4E1;
}
</style>
<?php
include("cmpjs.js");
?>
</head>

<body>
<!--<p align= "right"<p style="color:red;text-align:right;font-size:20px">Branch Code:<?php echo $brCode;?></p>--->

	<div class="container">

     <div class="wrapper"><div style="text-align:center;font-size:2vw;background-color:green;color:white;width:100%;height:48px;padding-top:7px;margin-bottom:10px">CIB ONLINE INQUIRY FORM</div>
		
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="company" method="post" name= "form2" role="form" id="register-form" autocomplete="off"onsubmit="return validateForm()" enctype="multipart/form-data">

         <div class="body_style">
         
    <section>	
	<div class = "row">
	
	   			  <ul id="tabsList" class="nav nav-pills" style="font-size:15px;font-weight:BOLD; background-color:#DFF0D8">
    <li ><a data-toggle="tab" role="tab" href="individual.php" id="individual" >Individual</a></li>
    <li class="active"><a data-toggle="tab" role="tab" href="company.php" id="company">Company</a></li>
		<li ><a data-toggle="tab" role="tab" href="propietorship.php" id="proprietorship" name= "proprietorship" >Proprietorship</a></li>

	    <!--<li><a data-toggle="tab" href="#rewardPunish" id="rdp"> Reward & Punishment</a></li>
		-->
  </ul>
  </div>
	   </section>

<section>
<input type='hidden' value='<?php echo $exist; ?>' name="exist"  />
<input type='hidden' value='<?php echo $trNo; ?>' name="trNo"  />
<div style="color: white;background:red;"><?php if ($msgErr != '') echo '<b>Error Message<b><br>' . $msgErr; ?></div>

 <div class="row">
		 <div class="form-group col-lg-6" style="padding-top:15px;">
      <label class="required" for="LoanType">Loan Type</label>
      <select class="form-control" id="LoanType" name='LoanType'>
	  	     <option selected value="">---Select Loan Type---</option>
		<option value="New" <?php if ($LoanType == "New") echo 'selected="selected"'; ?> >New</option>
		<option value="Renewal"  <?php if ($LoanType == "Renewal") echo 'selected="selected"'; ?>>Renewal</option>
		<option value="Enhancement" <?php if ($LoanType == "Enhancement") echo 'selected="selected"'; ?>>Enhancement</option>
		<option value="Others"  <?php if ($LoanType == "Others") echo 'selected="selected"'; ?>>Others</option>
	
      </select>
	   </div>
	   	  <div class="form-group col-lg-6" style="padding-top:15px;">
	
	  <label class="required" for="indiviCompnyInfo" id="indiviCompnyInfo"  style="padding-bottom:2px;" value="Borrower">Individual's Information</label><br>
        
		<div  style="border: 1px solid green; padding:5px;">
		<label class="radio-inline" class="required" style="width:100px"> 
		<input type="radio" name="indiviCompnyInfo" id="indiviCompnyInfo" value="Borrower" <?php if ($indiviCompnyInfo == "Borrower") echo 'checked="checked"'; ?>  class="form-control" style="width:23%">&nbsp;Borrower
		</label>
		<label class="radio-inline" class="required" style="width:100px">
		<input type="radio" name="indiviCompnyInfo" id="indiviCompnyInfo" value="Co-Borrower" <?php if ($indiviCompnyInfo == "Co-Borrower") echo 'checked="checked"'; ?>  class="form-control" style="width:23%"> Co-borrower
		</label>
		<label class="radio-inline" class="required" style="width:100px">
		<input type="radio"  name="indiviCompnyInfo" id="indiviCompnyInfo" value="gurantor" <?php if ($indiviCompnyInfo == "gurantor") echo 'checked="checked"'; ?>  class="form-control" style="width:25%">&nbsp; Gurantor
		</label>
		<label class="radio-inline" class="required" style="width:100px">
		<input type="radio"name="indiviCompnyInfo" id="indiviCompnyInfo" value="owner" <?php if ($indiviCompnyInfo == "owner") echo 'checked="checked"'; ?> class="form-control" style="width:25%"> &nbsp; Owner
		</label>
		
		</div>
					<span id="file_error88"></span>

   </div>
	   </div>
	    <div class="row">

<div class="form-group col-lg-4" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="" for="FISubCode">FISubCode</label>
			  <input type="text" name="FISubCode" id="FISubCode" value="<?php echo $FISubCode; ?>" maxlength="16"  class="form-control" />
			</div>
        </div>
		<div class="form-group col-lg-4"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="FinTypeID">Type of Financing</label>
<select class="form-control" id="FinTypeID" name='FinTypeID' >
				<option selected value="">---Select Type of Financing---</option>

					<option value=""  disabled="">----- Installment Contracts-----</option>
					<option  value="Bai-Muazzal (Installment Payment)"<?php if ($FinTypeID == "Bai-Muazzal (Installment Payment)") echo 'selected="selected"'; ?>>Bai-Muazzal (Installment Payment)</option>
					<option  value="Bai-Muazzal (Real Estate)"<?php if ($FinTypeID == "Bai-Muazzal (Real Estate)") echo 'selected="selected"'; ?> >Bai-Muazzal (Real Estate)</option>
					<option  value="Demand Loan (Instalment repayment)"<?php if ($FinTypeID == "Demand Loan (Instalment repayment)") echo 'selected="selected"'; ?>>Demand Loan (Instalment repayment)</option>
					<option value="Financial Leasing"<?php if ($FinTypeID == "Financial Leasing") echo 'selected="selected"'; ?>>Financial Leasing</option>
					<option  value="Hire-Purchase"<?php if ($FinTypeID == "Hire-Purchase") echo 'selected="selected"'; ?>>Hire-Purchase</option>
					<option value="Hire-Purchase under shirkatul Meelk"<?php if ($FinTypeID == "Hire-Purchase under shirkatul Meelk") echo 'selected="selected"'; ?>>Hire-Purchase under shirkatul Meelk</option>
					<option  value="Ijara (Lease Finance)"<?php if ($FinTypeID == "Ijara (Lease Finance)") echo 'selected="selected"'; ?>>Ijara (Lease Finance)</option>
					<option value="Mortgage loan"<?php if ($FinTypeID == "Mortgage loan") echo 'selected="selected"'; ?>>Mortgage loan</option>
					<option  value="Operational Leasing"<?php if ($FinTypeID == "Operational Leasing") echo 'selected="selected"'; ?>>Operational Leasing</option>
					<option value="Other installment contract"<?php if ($FinTypeID == "Other installment contract") echo 'selected="selected"'; ?>>Other instalment contract</option>
					<option  value="Packing Credit (Instalment repayment)"<?php if ($FinTypeID == "Packing Credit (Instalment repayment)") echo 'selected="selected"'; ?>>Packing Credit (Instalment repayment)</option>
					<option  value="Partially Secured Term Loan"<?php if ($FinTypeID == "Partially Secured Term Loan") echo 'selected="selected"'; ?>>Partially Secured Term Loan</option>
					<option  value="Term Loan"<?php if ($FinTypeID == "Term Loan") echo 'selected="selected"'; ?>>Term Loan</option>
					<option  value="House Building"<?php if ($FinTypeID == "House Building") echo 'selected="selected"'; ?>>House Building</option>
					
					
					<option value="" class="credit" disabled="">----- Credit Cards Contracts-----</option>
					<option  value="Charge Card (Payable in full each month)"<?php if ($FinTypeID == "Charge Card (Payable in full each month)") echo 'selected="selected"'; ?>>Charge Card (Payable in full each month)</option>
					<option  value="Credit Card (Revolving)"<?php if ($FinTypeID == "Credit Card (Revolving)") echo 'selected="selected"'; ?>>Credit Card (Revolving)</option>
					<option  value="Revolving Credit"<?php if ($FinTypeID == "Revolving Credit") echo 'selected="selected"'; ?>>Revolving Credit</option>


<option value="" class="nonins" disabled="">----- Non-Installment Contracts-----</option>
					<option  value="Any other Pre-shipment Credit"<?php if ($FinTypeID == "Any other Pre-shipment Credit") echo 'selected="selected"'; ?>>Any other Pre-shipment Credit</option>
					<option  value="Bai-Muazzal Pre-shipment Credit"<?php if ($FinTypeID == "Bai-Muazzal Pre-shipment Credit") echo 'selected="selected"'; ?>>Bai-Muazzal Pre-shipment Credit</option>
					<option  value="Bai-Muazzal WES/Bills"<?php if ($FinTypeID == "Bai-Muazzal WES/Bills") echo 'selected="selected"'; ?>>Bai-Muazzal; Bai-Muazzal WES/Bills</option>
					<option  value="Bai-Murabaha"<?php if ($FinTypeID == "Bai-Murabaha") echo 'selected="selected"'; ?>>Bai-Murabaha</option>
					<option  value="Bai-Murabaha-commercial"<?php if ($FinTypeID == "Bai-Murabaha-commercial") echo 'selected="selected"'; ?>>Bai-Murabaha-commercial</option>
					<option  value="Bai-Murabaha-TR"<?php if ($FinTypeID == "Bai-Murabaha-TR") echo 'selected="selected"'; ?>>Bai-Murabaha-TR</option>
					<option  value="Cash Credit against Hypothecation"<?php if ($FinTypeID == "Cash Credit against Hypothecation") echo 'selected="selected"'; ?>>Cash Credit against Hypothecation</option>
					<option  value="Cash Credit against Pledge"<?php if ($FinTypeID == "Cash Credit against Pledge") echo 'selected="selected"'; ?>>Cash Credit against Pledge</option>
					<option  value="Demand Loan (Not Installment)"<?php if ($FinTypeID == "Demand Loan (Not Installment)") echo 'selected="selected"'; ?>>Demand Loan (Not Installment)</option>
					<option  value="Export Credit"<?php if ($FinTypeID == "Export Credit") echo 'selected="selected"'; ?>>Export Credit</option>
					<option  value="Export loan against Foreign Bill Purchased"<?php if ($FinTypeID == "Export loan against Foreign Bill Purchased") echo 'selected="selected"'; ?>>Export loan against Foreign Bill Purchased</option>
					<option  value="Export loan against Local Bill Purchased"<?php if ($FinTypeID == "Export loan against Local Bill Purchased") echo 'selected="selected"'; ?>>Export loan against Local Bill Purchased</option>
					<option  value="Finance against Imported Merchandise (FIM)<?php if ($FinTypeID == "Finance against Imported Merchandise (FIM)") echo 'selected="selected"'; ?>">Finance against Imported Merchandise (FIM)</option>
					<option  value="Foreign Bill Negotiation (FBN)"<?php if ($FinTypeID == "Foreign Bill Negotiation (FBN)") echo 'selected="selected"'; ?>>Foreign Bill Negotiation (FBN)</option>
					<option  value="Foreign Bill Purchase (FBP)<?php if ($FinTypeID == "Foreign Bill Purchase (FBP)") echo 'selected="selected"'; ?>">Foreign Bill Purchase (FBP)</option>
					<option  value="Guarantee (non funded)" <?php if ($FinTypeID == "Guarantee (non funded)") echo 'selected="selected"'; ?>>Guarantee (non funded)</option>
					<option  value="Letter of credit (non funded)"<?php if ($FinTypeID == "Letter of credit (non funded)") echo 'selected="selected"'; ?>>Letter of credit (non funded)</option>
					<option  value="Loan Against Imported Merchandise (LIM)"<?php if ($FinTypeID == "Loan Against Imported Merchandise (LIM)") echo 'selected="selected"'; ?>>Loan Against Imported Merchandise (LIM)</option>
					<option  value="Loan Against Imported Merchandise (LTR)"<?php if ($FinTypeID == "Loan Against Imported Merchandise (LTR)") echo 'selected="selected"'; ?>>Loan Against Imported Merchandise (LTR)</option>
					<option  value="Murabaha Bills, Murabaha Bill of Exchange (General) Import Bills"<?php if ($FinTypeID == "Murabaha Bills, Murabaha Bill of Exchange (General) Import Bills") echo 'selected="selected"'; ?>>Murabaha Bills, Murabaha Bill of Exchange (General) Import Bills</option>
					<option  value="Murabaha Post Import (MPI)"<?php if ($FinTypeID == "Murabaha Post Import (MPI)") echo 'selected="selected"'; ?>>Murabaha Post Import (MPI)</option>
					<option  value="Murabaha Post Import Trust Receipt (MPITR)"<?php if ($FinTypeID == "Murabaha Post Import Trust Receipt (MPITR)") echo 'selected="selected"'; ?>>Murabaha Post Import Trust Receipt (MPITR)</option>
					<option  value="Musharaka (General)"<?php if ($FinTypeID == "Musharaka (General)") echo 'selected="selected"'; ?>>Musharaka (General)</option>
					<option  value="Musharaka (Local Purchase-Hypo)"<?php if ($FinTypeID == "Musharaka (Local Purchase-Hypo)") echo 'selected="selected"'; ?>>Musharaka (Local Purchase-Hypo)</option>
					<option  value="Musharaka Documentary Bills(MDB)"<?php if ($FinTypeID == "Musharaka Documentary Bills(MDB)") echo 'selected="selected"'; ?>>Musharaka Documentary Bills(MDB)</option>
					<option  value="Musharaka on consigment basis"<?php if ($FinTypeID == "Musharaka on consigment basis") echo 'selected="selected"'; ?>>Musharaka on consigment basis</option>
					<option  value="Musharaka Pre-shipment, Bai-Salam"<?php if ($FinTypeID == "Musharaka Pre-shipment, Bai-Salam") echo 'selected="selected"'; ?>>Musharaka Pre-shipment, Bai-Salam</option>
					<option  value="Other indirect facility (non funded)"<?php if ($FinTypeID == "Other indirect facility (non funded)") echo 'selected="selected"'; ?>>Other indirect facility (non funded)</option>
					<option  value="Other non instalment contract"<?php if ($FinTypeID == "Other non instalment contract") echo 'selected="selected"'; ?>>Other non instalment contract</option>
					<option  value="Overdraft"<?php if ($FinTypeID == "Overdraft") echo 'selected="selected"'; ?>>Overdraft</option>
					<option  value="Packing Credit (Not Installment)<?php if ($FinTypeID == "Packing Credit (Not Installment)") echo 'selected="selected"'; ?>">Packing Credit (Not Installment)</option>
					<option  value="PAD/BLC/BE loan against doc/bills"<?php if ($FinTypeID == "PAD/BLC/BE loan against doc/bills") echo 'selected="selected"'; ?>>PAD/BLC/BE loan against doc/bills</option>
					<option  value="Post-shipment Finance"<?php if ($FinTypeID == "Post-shipment Finance") echo 'selected="selected"'; ?>>Post-shipment Finance</option>
					<option  value="Quard (All types)"<?php if ($FinTypeID == "Quard (All types)") echo 'selected="selected"'; ?>>Quard (All types)</option>
					<option  value="Working capital financing"<?php if ($FinTypeID == "Working capital financing") echo 'selected="selected"'; ?>>Working capital financing</option>
					
				</select>		
        </div>
				
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="required" for="TotalReqAmt">Total Requested Amount/Credit Limit</label>
			  <input type="number" name="TotalReqAmt" id="TotalReqAmt" value="<?php echo $TotalReqAmt; ?>"  class="form-control"onkeydown="javascript: return event.keyCode == 69 ? false : true"  />
			</div>
        </div>


	
		
	</div>
</section>
<script>
$(document).ready(function() {
 
 	$('#FinTypeID').change(function() {
  	if ($(this).val() == "Term Loan"){
		
		$('#ICD').show();
	
		
       		  }
	else if ($(this).val() == "Other installment contract"){
		$('#ICD').show();
		
       		    }

	else {       
      $('#ICD').hide();
	  	
      
    }
  });
 
});
</script>
	<section>
	     <div class="row" style="background-color: #dbf3ef ;">
		
		<div id="ICD" class="panel panel-default">
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Installment Contract Data</span>
		
		</div>

		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="InstallmentNo">Number of Installment</label>
			  <input type="number" name="InstallmentNo" id="InstallmentNo" value="<?php echo $InstallmentNo; ?>" onkeydown="javascript: return event.keyCode == 69 ? false : true" class="form-control" />
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
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;"> 
			<div class="form-group">
			  <label  for="InstallmentAmt">Installment Amount</label>
			  <input type="number" name="InstallmentAmt" id="InstallmentAmt" value="<?php echo $InstallmentAmt; ?>" onkeydown="javascript: return event.keyCode == 69 ? false : true" class="form-control" />
			</div>
        </div>
	<div class="form-group col-lg-4"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label  for="PerodicityPayment">Periodicity of Payment (In Months)</label>
			  <input type="number" name="PerodicityPayment" id="PerodicityPayment" value="<?php echo $PerodicityPayment; ?>" onkeydown="javascript: return event.keyCode == 69 ? false : true" class="form-control"  />
			</div>
        </div>
				
		</div>
	</div>
</section>
<section>	
     <div class="row" style="background-color:#f1fdef;">
		
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Institution Subject Data</span>
		
		</div>
		<div class = "row"style="margin-left:5px;margin-right:5px">
	 <div class="form-group col-lg-2" style="padding-top:15px;">
      <label for="InstitutionType">Institution Type</label>
      <select class="form-control" id="InstitutionType" name='InstitutionType'>
	  	     <option selected value="0">Select Institution Type</option>
		<option value="Proprietorship"<?php if ($InstitutionType == "Proprietorship") echo 'selected="selected"'; ?> >Proprietorship</option>
		<option value="Partnership"<?php if ($InstitutionType == "Partnership") echo 'selected="selected"'; ?> >Partnership</option>
		<option value="Company"<?php if ($InstitutionType == "Company") echo 'selected="selected"'; ?> >Company</option>
		<option value="Others" <?php if ($InstitutionType == "Others") echo 'selected="selected"'; ?> >Others</option>
	      </select>
	   </div>
	
			<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="Title">Trade Name Title</label>
			  <input type="text" name="Title" id="Title"  value="<?php echo $Title; ?>"class="form-control"  />
			 </div>
		</div>
			<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="	TradeName">Trade Name</label>
			  <input type="text" name="TradeName" id="TradeName"  value="<?php echo $TradeName; ?>" class="form-control"  />
			 </div>
		</div>
	 <div class="form-group col-lg-4" style="padding-top:15px;">
      <label class="required"  for="LegalForm">Legal form</label>
      <select class="form-control" id="LegalForm" name='LegalForm' >
	  	     <option selected value="">---Select Legal Form---</option>
		<option value="Proprietorship"<?php if ($LegalForm == "Proprietorship") echo 'selected="selected"'; ?> >Proprietorship</option>
		<option value="Partnership"<?php if ($LegalForm == "Partnership") echo 'selected="selected"'; ?>>Partnership</option>
		<option value="pvt.ltd.co"<?php if ($LegalForm == "pvt.ltd.co") echo 'selected="selected"'; ?>>Pvt.Ltd.Co.</option>
		<option value="public.ltd.co"<?php if ($LegalForm == "public.ltd.co") echo 'selected="selected"'; ?>>Public.Ltd.Co.</option>
		<option value="cooperative"<?php if ($LegalForm == "cooperative") echo 'selected="selected"'; ?>>Co-operative</option>
		<option value="public sector"<?php if ($LegalForm == "public sector") echo 'selected="selected"'; ?>>Public Sector</option>
		<option value="multinational organization"<?php if ($LegalForm == "multinational organization") echo 'selected="selected"'; ?>>Multinational Organization</option>
		<option value="ngo"<?php if ($LegalForm == "ngo") echo 'selected="selected"'; ?>>NGO</option>
		<option value="trustee organization"<?php if ($LegalForm == "trustee organization") echo 'selected="selected"'; ?>>Trustee Organization</option>
		<option value="Others"<?php if ($LegalForm == "Others") echo 'selected="selected"'; ?>>Others</option>
	      </select>
		  <br>
	   </div></div>
	   		<div class = "row"style="margin-left:5px;margin-right:5px">

					<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="Etin">ETIN</label>
			  <input type="text" name="Etin" id="Etin"value="<?php echo $Etin; ?>"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"class="form-control" />
			 </div>
		</div>
	
	   
						<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="RJSCRegNo">RJSC Registration Number(If available)</label>
			  <input type="text" name="RJSCRegNo" id="RJSCRegNo"value="<?php echo $RJSCRegNo; ?>" class="form-control" />
			 </div><br>
		</div>
			<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="RegDate">Date of Registration</label>
			<input type="text" name="RegDate" placeholder= "dd/mm/yyyy" class="form-control" id="RegDate" data-inputmask="'alias': 'date'" value="<?php echo empty($RegDate)==false? date("d-m-Y",strtotime(str_replace('/', '-', $RegDate))): $RegDate; ?>" >
		 </div>
		</div>

		</div>
		
		</div>

	</section>
	<section>	
     <div class="row" style="background-color:#d8eaf1 ;">
		
		<div class="panel panel-default" >
		<div class="panel-heading " style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Business Address</span>
		
		</div>
	<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="required" for="BusStreet">Street Name and Number</label>
			  <input type="text" name="BusStreet" id="BusStreet" value="<?php echo $BusStreet; ?>"  class="form-control" />
			</div>
        </div>
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required"  for="BusPostal">Postal Code</label>
			  <input type="text" name="BusPostal" id="BusPostal" maxlength="4" value="<?php echo $BusPostal; ?>" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  />
			</div>
        </div>
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="BusDistrict">District</label>
  <select class="form-control" id="BusDistrict" name='BusDistrict'>
			  <?php 
			  $perDistList='';
				$perDistList.='<option selected="selected" value="">Select District</option>';
				while($rwPer = mysqli_fetch_assoc($rsperDist))
				{
				$perDistList.='<option value="'.$rwPer['DistrictName'].'"';
				if(trim($BusDistrict)==trim($rwPer['DistrictName']))
				{
				$perDistList.=" selected='selected'";
				}
				$perDistList.='>'.$rwPer['DistrictName'].'</option>';	
				}
				
				echo $perDistList;
				?>
			  </select>	
			  </div>
		</div>
		
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="BusCountry">Country</label>
 <select class="form-control" id="BusCountry" name='BusCountry'>
			  <?php 
			  $t='';
				$t.='<option selected="selected" value="Bangladesh">Bangladesh</option>';
				while($rsc = mysqli_fetch_assoc($rspc))
				{
				$t.='<option value="'.$rsc['country_name'].'"';
				if(trim($BusCountry)==trim($rsc['country_name']))
				{
				$t.=" selected='selected'";
				}
				$t.='>'.$rsc['country_name'].'</option>';	
				}
				
				echo $t;
				?>
			  </select>				</div>
        </div>
		
		</div>
	</div>
</section>

<section>	
     <div class="row" style="background-color:#f1fdef ;">
		
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Factory Address</span>
		</div>

		<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label for="FacStreet">Street Name and Number</label>
			  <input type="text" name="FacStreet" id="FacStreet" value="<?php echo $FacStreet; ?>" class="form-control" />
			</div>
        </div>
		
		<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label  for="FacPostal">Postal Code</label>
			  <input type="text" name="FacPostal" id="FacPostal" maxlength="4"value="<?php echo $FacPostal; ?>"  class="form-control"oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  />
			</div>
        </div>
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="FacDistrict">District</label>
  <select class="form-control" id="FacDistrict" name='FacDistrict'>
			  <?php 
			  $perDistList7='';
				$perDistList7.='<option selected="selected" value="0">Select District</option>';
				while($rwPer7 = mysqli_fetch_assoc($rsperDist7))
				{
				$perDistList7.='<option value="'.$rwPer7['DistrictName'].'"';
				if(trim($FacDistrict)==trim($rwPer7['DistrictName']))
				{
				$perDistList7.=" selected='selected'";
				}
				$perDistList7.='>'.$rwPer7['DistrictName'].'</option>';	
				}
				
				echo $perDistList7;
				?>
			  </select>	
		 </div>
		</div>
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label for="FacCountry">Country</label>
 <select class="form-control" id="FacCountry" name='FacCountry'>
			  <?php 
			  $t7='';
				$t7.='<option selected="selected" value="Bangladesh">Bangladesh</option>';
				while($rsc7 = mysqli_fetch_assoc($rspc7))
				{
				$t7.='<option value="'.$rsc7['country_name'].'"';
				if(trim($FacCountry)==trim($rsc7['country_name']))
				{
				$t7.=" selected='selected'";
				}
				$t7.='>'.$rsc7['country_name'].'</option>';	
				}
				
				echo $t7;
				?>
			  </select>				</div>
        </div>
		
		</div>
		</section>
		<section>	
     <div class="row" style="background-color:#dbf3ef">
		
	
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="TelephoneNumber">Telephone Number</label>
			  <input type="text" name="TelephoneNumber" id="TelephoneNumber" maxlength="11"  required ="true" value="<?php echo $TelephoneNumber; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" class="form-control" />
			 </div>
		</div>
						<div class="form-group col-lg-3" style="padding-top:15px;">     
			  
			  <label class="required" for="SecType">Sector Type</label>
			  <select class="form-control" id="SecType" name='SecType'>
			  	   <!--  <option selected value="">---Select Sector Type---</option> -->
		<option value="Private"<?php if ($SecType == "Private") echo 'selected="selected"'; ?>>Private</option>
		<option value="Public"<?php if ($SecType == "Public") echo 'selected="selected"'; ?>>Public</option>
		
      </select>
			<br>
		</div>
			<div class="form-group col-lg-6" style="padding-top:15px;">     
			  
			  <label class="required" for="SecCode">Sector Code</label>
 <select class="form-control" id="SecCode" name='SecCode'>
			  <?php 
			  $perDistList9='';
				$perDistList9.='<option selected="selected" value="">Select Sector Code</option>';
				while($rwPer9 = mysqli_fetch_assoc($rspc5))
				{
				$perDistList9.='<option value="'.$rwPer9['Code'].'"';
				if(trim($SecCode)==trim($rwPer9['Code']))
				{
				$perDistList9.=" selected='selected'";
				}
				$perDistList9.='>'.$rwPer9['Name'].'('.$rwPer9['Code'].')'.'</option>';	
				}
				
				echo $perDistList9;
				?>
			  </select>		
		</div>
		
		 </section>
		 
				<section>	
     <div class="row" ">
		
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">CIB Inquiry Fee</span>
		
		</div>
		<div class = "row"style="margin-left:5px;margin-right:5px">
	<!-- <div class="form-group col-lg-2" style="padding-top:15px;">
      <label for="InstitutionType">Institution Type</label>
      <select class="form-control" id="InstitutionType" name='InstitutionType'>
	  	     <option selected value="0">Select Institution Type</option>
		<option value="Proprietorship"<?php if ($InstitutionType == "Proprietorship") echo 'selected="selected"'; ?> >Proprietorship</option>
		<option value="Partnership"<?php if ($InstitutionType == "Partnership") echo 'selected="selected"'; ?> >Partnership</option>
		<option value="Company"<?php if ($InstitutionType == "Company") echo 'selected="selected"'; ?> >Company</option>
		<option value="Others" <?php if ($InstitutionType == "Others") echo 'selected="selected"'; ?> >Others</option>
	      </select>
	   </div>-->
	
			<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="voucherAmount">Fee Amount</label>
			  <input type="text" name="voucherAmount" id="voucherAmount"  value="<?php echo $voucherAmount; ?>"class="form-control"  />
			 </div>
		</div>
			<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="	voucherNumber">Voucher No</label>
			  <input type="text" name="voucherNumber" id="voucherNumber"  value="<?php echo $voucherNumber; ?>" class="form-control"  />
			 </div>
		</div>
	<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="voucherDate">Date</label>
			<input type="text" name="voucherDate" placeholder= "dd/mm/yyyy" class="form-control" id="voucherDate" data-inputmask="'alias': 'date'" value="<?php echo empty($voucherDate)==false? date("d-m-Y",strtotime(str_replace('/', '-', $voucherDate))): $voucherDate; ?>" >
			 </div>
		</div>
	   </div>
	
		
		</div>
<div class="form-group col-lg-2" style="padding-top:15px;">     
			  
			  <label class ="required" for="contractHistory">Contract History</label>
			  <select class="form-control" id="contractHistory" name='contractHistory'>
			  	     <option selected value="">---Select contract history---</option>

		<option value="12 Months"<?php if ($contractHistory == "12 Months") echo 'selected="selected"'; ?>>12 Months</option>
		<option value="24 Months"<?php if ($contractHistory == "24 Months") echo 'selected="selected"'; ?>>24 Months</option>
      </select>
			<br>
		</div>
<div class="form-group col-lg-2" style="padding-top:15px;">     
			  
			  <label class ="required" for="contractPhase">Contract Phase</label>
			  <select class="form-control" id="contractPhase" name='contractPhase'>
			  	     <option selected value="">---select contract phase---</option>

		<option value="All loans"<?php if ($contractPhase == "All loans") echo 'selected="selected"'; ?>>All loans</option>
		<option value="Living Loans"<?php if ($contractPhase == "Living Loans") echo 'selected="selected"'; ?>>Living Loans</option>
      </select>
			<br>
		</div>
	</section> 
		 
		 
	<section>
	  <div class="row" style="background-color:#ccffe6 ">
		
		<div class="panel panel-default" >
		<div class="panel-heading " style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Upload Files</span>
		
		</div>
	
	<div class="form-group col-lg-4" style="padding-top:15px;">
	  <label for="cerBankingDpma2">Upload Money Receipt</label>
	  <div style="border: 1px solid green;">
 <script type="text/javascript">
    $(function () {
        $("input[name=btnShowDip3]").click(function () {
            if ($(this).val() == "Change") {
                $("#UploadMoneyReceipt").show();
				$("#firstDip3").hide();
				$('#dphd3').val(1);
            } else {
                $("#UploadMoneyReceipt").hide();
				$("#firstDip3").show
				$('#dphd3').val(0);
            }
        });
    });
</script>	  
	  <?php
	  $display="display: ''";
	  if(!empty($fileName1))
		  {
			echo '<div id="firstDip3">';
			$lnk1=$fileName1;
			if(strlen($fileName1)>10)
			{
			$lnk1='..'.substr($fileName1,-10,10);
			}
			echo '<a href="uploads/'.$fileName1.'" target="_blank" style=" color: blue;">'.$lnk1.'</a>'; 
			echo ' <input type="button" style="border:none; color: red;"  value="Change" name ="btnShowDip3" id ="btnShowDip3" />';
			echo '</div>';
			$display="display: none";
		  }
		  else{
			  $display="display: ''";
		  }
		
		echo '<input id="UploadMoneyReceipt" onchange="return fileValidation1 ()" style="'.$display.'" type="file" size="10px" name="UploadMoneyReceipt" class="UploadMoneyReceipt">';
	  ?> 
	  				<p style="color:red; font-size:12px; padding-top:5px">(Max-Size: 5MB)</p> 

	  <span id="file_error1"></span>
	  	  <input type="hidden" value="0" name="dphd3" id="dphd3">
	  
	  </div>
	  
	</div>
	<div class="form-group col-lg-4" style="padding-top:15px;">
	  <label for="cerBankingDpma2">Upload Promise Letter</label>
	  <div style="border: 1px solid green;">
 <script type="text/javascript">
    $(function () {
        $("input[name=btnShowDip4]").click(function () {
            if ($(this).val() == "Change") {
                $("#UploadPromiseLetter").show();
				$("#firstDip4").hide();
				$('#dphd4').val(1);
            } else {
                $("#UploadPromiseLetter").hide();
				$("#firstDip4").show
				$('#dphd4').val(0);
            }
        });
    });
</script>	  
	  <?php
	  $display="display: ''";
	  if(!empty($fileName2))
		  {
			echo '<div id="firstDip4">';
			$lnk2=$fileName2;
			if(strlen($fileName2)>10)
			{
			$lnk2='..'.substr($fileName2,-10,10);
			}
			echo '<a href="uploads/'.$fileName2.'" target="_blank" style=" color: blue;">'.$lnk2.'</a>'; 
			echo ' <input type="button" style="border:none; color: red;"  value="Change" name ="btnShowDip4" id ="btnShowDip4" />';
			echo '</div>';
			$display="display: none";
		  }
		  else{
			  $display="display: ''";
		  }
		
		echo '<input id="UploadPromiseLetter" onchange="return fileValidation2 ()" style="'.$display.'" type="file" size="10px" name="UploadPromiseLetter" class="UploadPromiseLetter">';
	  ?>
	  				<p style="color:red; font-size:12px; padding-top:5px">(Max-Size: 5MB)</p> 
<span id="file_error2"></span>
	  	  <input type="hidden" value="0" name="dphd4" id="dphd4">
	  
	  </div>
	  
	</div>
	 	<div class="form-group col-lg-4" style="padding-top:15px;">
	  <label for="cerBankingDpma2">Upload Other Docs </label>
	  <div style="border: 1px solid green;">
 <script type="text/javascript">
    $(function () {
        $("input[name=btnShowDip5]").click(function () {
            if ($(this).val() == "Change") {
                $("#UploadOtherDocs").show();
				$("#firstDip5").hide();
				$('#dphd5').val(1);
            } else {
                $("#UploadOtherDocs").hide();
				$("#firstDip5").show
				$('#dphd5').val(0);
            }
        });
    });
</script>	  
	  <?php
	  $display="display: ''";
	  if(!empty($fileName3))
		  {
			echo '<div id="firstDip5">';
			$lnk3=$fileName3;
			if(strlen($fileName3)>10)
			{
			$lnk3='..'.substr($fileName3,-10,10);
			}
			echo '<a href="uploads/'.$fileName3.'" target="_blank" style=" color: blue;">'.$lnk3.'</a>'; 
			echo ' <input type="button" style="border:none; color: red;"  value="Change" name ="btnShowDip5" id ="btnShowDip5" />';
			echo '</div>';
			$display="display: none";
		  }
		  else{
			  $display="display: ''";
		  }
		
		echo '<input id="UploadOtherDocs" onchange="return fileValidation3 ()" style="'.$display.'" type="file" size="10px" name="UploadOtherDocs" class="UploadOtherDocs">';
	  ?> 
	  				<p style="color:red; font-size:12px; padding-top:5px">(Max-Size: 5MB)</p> 

	  <span id="file_error3"></span>
	  	  <input type="hidden" value="0" name="dphd5" id="dphd5">
	  
	  </div>
	  
	</div>
			
        </div>	
		
	</div>	
                 

				 </div>
		
		</section>
		<p align="right">
<br><a href="company.php" class="btn btn-warning btn-lg"> <span class="glyphicon glyphicon-step-backward"></span> Reload </a>
<span style="margin-right:8px;"> &nbsp; <button type="submit" id="save" name="save" class="btn btn-lg btn-success">Save & Next<span class='glyphicon glyphicon-step-forward'></span></button> </span>

</p>
            </form>
            
           </div>

	</div>
	<script>


	$(document).ready(function(){
		$("#RegDate").focusout(function(){
			var txtdob= $("#RegDate").val();
			var arr=txtdob.split('/');
			var dob=arr[2]+'-'+arr[1]+'-'+arr[0];
			
			var lwdate = '1950-01-01';
			
			var d = new Date();
			var month = d.getMonth()+1;
			var day = d.getDate();
				d.setFullYear(d.getFullYear()-18);
			
			var output = d.getFullYear() + '-' +
				(month<10 ? '0' : '') + month + '-' +
				(day<10 ? '0' : '') + day ;
				
			//alert(dob);
			if(txtdob.length==0){
				$("#errordat1").html('');
				$("#RegDate").focus();
			}
			else if(new Date(dob) < new Date(output) && new Date(dob) > new Date(lwdate)){
				$("#errordat1").html('');
			}
			else{
				$("#errordat1").html('Enter valid Birth Date');
				$("#errordat1").css('color','red');
				$("#RegDate").focus();
			}
		});
</script>
<script>
 $('input[name="RegDate"]').mask('00/00/0000');
 $('input[name="voucherDate"]').mask('00/00/0000');
</script>

    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery-1.11.2.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script src="assets/register.js"></script>

</body>
</html>
<?php
include('templates\footer.php')
?>