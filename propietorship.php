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
$TradeTitle = '';
$TradeName = '';
$LegalForm = '';
$Etin = '';
$RJSCRegNo = '';
$RegDate = '';
$BirthDate = '';
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
$fileName = '';
$Role = '';
$Title = '';
$Name = '';
$FatherTitle = '';
$FatherName = '';
$MotherTitle = '';
$MotherName = '';
$SpouseTitle = '';
$SpouseName = '';
$NID = '';
$Etin = '';
$TelephoneNumber = '';
$OwnerTelephoneNumber = '';
$BirthDistrict = '';
$BirthCountry = '';
$Gender = '';
$PerStreet = '';
$PerPostal = '';
$PerDistrict = '';
$PerCountry = '';
$PreStreet = '';
$PrePostal = '';
$PreDistrict = '';
$PreCountry = '';
$IDType = '';
$IDNumber = '';
$IDIssueDate = '';
$IDIssueCountry = '';
$voucherNumber = '';
$voucherAmount = '';
$voucherDate = '';
$fileName = '';
$fileName = '';
$fileName1 = '';
$fileName2 = '';
$fileName3 = '';
$contractHistory='';
$contractPhase='';

if(isset($_GET['gtrNo']))
{
	$trNo=$_GET['gtrNo'];
	$exist=1;
	
	$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN propietorship c
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
	    $TradeTitle = $row['TradeTitle'];
	    $TradeName = $row['TradeName'];
	    $LegalForm = $row['LegalForm'];
	    $Etin = $row['Etin'];
	    $RJSCRegNo = $row['RJSCRegNo'];
	    $RegDate = $row['RegDate'];
	    //$BirthDate = $row['BirthDate'];
		if(empty(trim($row['IDIssueDate']))||(trim($row['IDIssueDate'])==null) || (trim($row['IDIssueDate'])=='0000-00-00') || (trim($row['IDIssueDate'])=='1970-01-01'))
		{
			$IDIssueDate=null;
		}	
		else
		{		
				$IDIssueDate = $row['IDIssueDate'];
		}
		if(empty(trim($row['BirthDate']))||(trim($row['BirthDate'])==null) || (trim($row['BirthDate'])=='0000-00-00') || (trim($row['BirthDate'])=='1970-01-01'))
		{
			$IDIssueDate=null;
		}	
		else
		{		
				$BirthDate = $row['BirthDate'];
		}
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
		//$IDIssueDate = $row['IDIssueDate'];
		$OwnerTelephoneNumber = $row['OwnerTelephoneNumber'];
		$voucherNumber = $row['voucherNumber'];
		$voucherAmount = $row['voucherAmount'];
		$voucherDate = $row['voucherDate'];
		/*if(empty(trim($row['voucherDate']))||(trim($row['voucherDate'])==null) || (trim($row['voucherDate'])=='0000-00-00') || (trim($row['voucherDate'])=='1970-01-01'))
		{
			$voucherDate=null;
		}	
		else
		{		
				$voucherDate = $row['voucherDate'];
		}*/
		$fileName = $row['UploadNID'];
		$fileName1 = $row['UploadMoneyReceipt'];
		$fileName2 = $row['UploadPromiseLetter'];
		$fileName3 = $row['UploadOtherDocs'];
		$contractHistory = $row['contractHistory'];
		$contractPhase = $row['contractPhase'];
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
	    $TradeTitle = addslashes($_POST['TradeTitle']);
	    $TradeName = addslashes($_POST['TradeName']);
	    $LegalForm = $_POST['LegalForm'];
	    $Etin = $_POST['Etin'];
	    $RJSCRegNo = $_POST['RJSCRegNo'];
		$voucherDate = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["voucherDate"])));
	    //$RegDate = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["RegDate"])));		
	    //$RegDate = $_POST['RegDate'];		
	    $BusStreet = addslashes($_POST['BusStreet']);
	    $BusPostal = addslashes($_POST['BusPostal']);
		$BusDistrict = addslashes($_POST['BusDistrict']);
		$BusCountry = $_POST['BusCountry'];
		$FacStreet = addslashes($_POST['FacStreet']);
		$FacPostal = addslashes($_POST['FacPostal']);
		$FacDistrict = addslashes($_POST['FacDistrict']);
		$FacCountry = $_POST['FacCountry'];
		$SecType = $_POST['SecType'];
		$SecCode = $_POST['SecCode'];
		$Role = $_POST['Role'];
		$Title = $_POST['Title'];
		$Name = $_POST['Name'];
		$FatherTitle = $_POST['FatherTitle'];
		$FatherName = $_POST['FatherName'];
		$MotherTitle = $_POST['MotherTitle'];
		$MotherName = $_POST['MotherName'];
		$SpouseTitle = $_POST['SpouseTitle'];
		$SpouseName = $_POST['SpouseName'];
		$NID = $_POST['NID'];
		$Etin = $_POST['Etin'];
		$BirthDate = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["BirthDate"])));
		$Gender = $_POST['Gender'];
		$BirthDistrict = $_POST['BirthDistrict'];
		$BirthCountry = $_POST['BirthCountry'];
		$PerStreet = addslashes($_POST['PerStreet']);
		$PerPostal = $_POST['PerPostal'];
		$PerDistrict = $_POST['PerDistrict'];
		$PerCountry = $_POST['PerCountry'];
		$PreStreet = addslashes($_POST['PreStreet']);
		$PrePostal = $_POST['PrePostal'];
		$PreDistrict = $_POST['PreDistrict'];
		$PreCountry = $_POST['PreCountry'];
		$IDType = $_POST['IDType'];
		$IDNumber = addslashes($_POST['IDNumber']);
		$IDIssueCountry = $_POST['IDIssueCountry'];
    	$TelephoneNumber = $_POST['TelephoneNumber'];
    	$OwnerTelephoneNumber = $_POST['OwnerTelephoneNumber'];
    	$voucherNumber =addslashes( $_POST['voucherNumber']);
    	$voucherAmount = addslashes($_POST['voucherAmount']);
		$UploadMoneyReceipt = $_POST['UploadMoneyReceipt'];
		$UploadPromiseLetter = $_POST['UploadPromiseLetter'];
		$UploadOtherDocs = $_POST['UploadOtherDocs'];
		$contractHistory = $_POST['contractHistory'];
		$contractPhase = $_POST['contractPhase'];
		$exist=$_POST['exist'];
		$status = $row['status'];
		$IDIssueDate = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["IDIssueDate"])));

		/*if(empty(trim($row['IDIssueDate']))||(trim($row['IDIssueDate'])==null) || (trim($row['IDIssueDate'])=='0000-00-00') || (trim($row['IDIssueDate'])=='1970-01-01'))
		{
			$IDIssueDate=null;
		}	
		else
		{		
				$IDIssueDate = $row['IDIssueDate'];
		}*/
	$fileName = $_POST['UploadNID'];
    $fileName1 = $_POST['UploadMoneyReceipt'];
    $fileName2 = $_POST['UploadPromiseLetter'];
    $fileName3 = $_POST['UploadOtherDocs'];
  	$exist=$_POST['exist'];
		
		//$trNo=$brCode.date("ymdis").rand(1,99);
		
		    //echo '<br><br><br><br><br><br><br><br><br><br><br><br><br>loan type '.$LoanType;


	if (empty($LoanType))
    {
        $msgErr .= "Please select Loan Type<br>";
    }
    if (empty($indiviCompnyInfo))
    {
        $msgErr .= "Please select Individual Information<br>";
    }
    if (empty($FinTypeID))
    {
        $msgErr .= "Please fill up finance type<br>";
    }
    if (empty($TotalReqAmt))
    {
        $msgErr .= "Please enter total requested amount or credit limit<br>";
    }
    if (empty($Name))
    {
        $msgErr .= "Please fill up Name<br>";
    }
    if (empty($FatherName))
    {
        $msgErr .= "Please fill up Father name<br>";
    }
    if (empty($MotherName))
    {
        $msgErr .= "Please fill up Mother name<br>";
    }
    
	if(!empty($NID))
	{
		$n = strlen($NID);
		if (!($n == 13 || $n == 17 || $n == 10))
		{
			$msgErr .= "NID must be 10, 13 or 17 characters<br>";
		}
	}
	
	
	
    if ($BirthDistrict=="0")
    {
        $msgErr .= "Select District of Birth<br>";
    }
    if (empty($BirthCountry))
    {
        $msgErr .= "Fill up Country of Birth<br>";
    }
    if ($SecType == "0")
    {
        $msgErr .= "Please select Sector Type <br>";
    }
    if (empty($SecCode))
    {
        $msgErr .= "Please enter Sector code <br>";
    }
    if ($Gender == "0")
    {
        $msgErr .= "Please select Gender <br>";
    }
	 if (empty($TelephoneNumber))
    {
        $msgErr .= "Please enter Telephone Number <br>";
    }
    if (empty($PerStreet))
    {
        $msgErr .= "Please enter Street no. for permanent address  <br>";
    }
    if (empty($PerPostal))
    {
        $msgErr .= "Please enter Postal code for permanent address <br>";
    }
    if (empty($PerDistrict))
    {
        $msgErr .= "Please enter District for permanent address <br>";
    }
    if (empty($PerCountry))
    {
        $msgErr .= "Please enter Country for permanent address <br>";
    }
		
	if(!empty($BirthDate))
	{
 
		// Create a datetime object using date of birth
		$dob = new DateTime($BirthDate);
		 
		// Get current date
		$now = new DateTime();
		 
		// Calculate the time difference between the two dates
		$diff = $now->diff($dob);
		 
		// Get the age in years, months and days
		$age = $diff->y;
		
		if ($age<18)
		{
			$msgErr .= "Age must be 18 years and above<br>";
		}
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
		$fileName = $_FILES['UploadNID']['name'];
		if(empty($fileName )){
			$fileName="";
		}
		else{
		$fileName = $random.$_FILES['UploadNID']['name'];
		}
		$file_tmp = $_FILES['UploadNID']['tmp_name'];
		$dir="uploads/".$fileName;
		$ext = pathinfo($fileName, PATHINFO_EXTENSION);
		move_uploaded_file($file_tmp,$dir);
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
		`reportuploadUserId`, `docsUploaded`) VALUES ('$trNo','3','$indiviCompnyInfo','$LoanType','RAKUB','033','$brCode','$FISubCode','','$FinTypeID','$TotalReqAmt',
		'$InstallmentNo','$InstallmentAmt','$PerodicityPayment',CURRENT_TIMESTAMP,'$EntryUserId','','','','','','','','');
		
	INSERT INTO propietorship (`TrackingNo`,`InstitutionType`,`TradeTitle`,`TradeName`,`LegalForm`,`Etin` ,
	`BusStreet`,`BusPostal`,`BusDistrict`,`BusCountry`,`FacStreet`,`FacPostal`, `FacDistrict`,`FacCountry`,
	`SecType`,`SecCode`,`Title`,`Name`,`FatherTitle`,`FatherName`,`MotherTitle`,`MotherName`,`SpouseTitle`,`SpouseName`,
	`NID`, `BirthDate`,`Gender`,`BirthDistrict`, `BirthCountry`,`PerStreet`,`PerPostal`,`PerDistrict`,`PerCountry`,
	`PreStreet`,`PrePostal`,`PreDistrict`,`PreCountry`,`IDType`, `IDNumber`,`IDIssueDate`,`IDIssueCountry`,`contractHistory`,
	`contractPhase`,`TelephoneNumber`,`OwnerTelephoneNumber`,`voucherAmount`,`voucherNumber`,`voucherDate`,`UploadNID`,`UploadMoneyReceipt`,`UploadPromiseLetter`,`UploadOtherDocs`)
		values ('$trNo','$InstitutionType','$TradeTitle','$TradeName','$LegalForm','$Etin',
		'$BusStreet','$BusPostal','$BusDistrict','$BusCountry','$FacStreet',
		'$FacPostal','$FacDistrict','$FacCountry','$SecType',
		'$SecCode','$Title','$Name','$FatherTitle','$FatherName',
		'$MotherTitle','$MotherName','$SpouseTitle','$SpouseName','$NID',
		'$BirthDate','$Gender','$BirthDistrict','$BirthCountry',
		'$PerStreet','$PerPostal','$PerDistrict','$PerCountry','$PreStreet',
		'$PrePostal','$PreDistrict','$PreCountry','$IDType','$IDNumber','$IDIssueDate',
		'$IDIssueCountry','$contractHistory','$contractPhase','$TelephoneNumber','$OwnerTelephoneNumber','$voucherAmount','$voucherNumber','$voucherDate','$fileName','$fileName1','$fileName2','$fileName3')";
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
			$fileName = $_FILES['UploadNID']['name'];
			if(empty($fileName ))
			{
			$fileName="";
			}
			else{
			$fileName = $random.$_FILES['UploadNID']['name'];
			}
			$file_tmp = $_FILES['UploadNID']['tmp_name'];
			$dir="uploads/".$fileName;
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);

			  
			  
$nidup='';
			  if($_POST['dphd2']==1)
			  {
				 $nidup="UploadNID='$fileName',";
				 move_uploaded_file($file_tmp,$dir);
			  }
			  else if($_POST['dphd2']==0 && !empty($fileName))
			  {
				  $nidup="UploadNID='$fileName',";
				  move_uploaded_file($file_tmp,$dir);
			  }
			  else
			  {
				  
			  }
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
			$fileName2 =$_FILES['UploadPromiseLetter']['name'];
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
			InstallmentNo='$InstallmentNo',InstallmentAmt='$InstallmentAmt',PerodicityPayment='$PerodicityPayment' where TrackingNo='$trNo';
			
			update propietorship set InstitutionType= '$InstitutionType',TradeTitle ='$TradeTitle',TradeName='$TradeName',LegalForm='$LegalForm',
			BusStreet='$BusStreet',BusPostal='$BusPostal',BusDistrict='$BusDistrict',BusCountry='$BusCountry',
			FacStreet='$FacStreet',FacPostal='$FacPostal',FacDistrict='$FacDistrict',FacCountry='$FacCountry',Title= '$Title',Name ='$Name',FatherTitle='$FatherTitle',FatherName='$FatherName',MotherTitle='$MotherTitle',
			MotherName='$MotherName',SpouseTitle='$SpouseTitle',SpouseName='$SpouseName',BirthDate='$BirthDate',NID='$NID',Etin='$Etin',BirthDistrict='$BirthDistrict',BirthCountry='$BirthCountry',SecType='$SecType',
			SecCode='$SecCode',Gender='$Gender',PerStreet='$PerStreet',PerPostal='$PerPostal',PerDistrict='$PerDistrict',PerCountry='$PerCountry',contractHistory='$contractHistory',contractPhase='$contractPhase',
			PreStreet='$PreStreet',PrePostal='$PrePostal',PreDistrict='$PreDistrict',PreCountry='$PreCountry',IDType='$IDType',IDNumber='$IDNumber',
			IDIssueDate='$IDIssueDate',IDIssueCountry='$IDIssueCountry', ".$nidup."".$mrup."".$plup."".$odup." TelephoneNumber='$TelephoneNumber',OwnerTelephoneNumber='$OwnerTelephoneNumber',voucherAmount='$voucherAmount',voucherNumber='$voucherNumber',voucherDate='$voucherDate' where TrackingNo='$trNo'";
			
			//echo '<br><br><br><br><br><br><br><br>'.$sql1; exit;
					
			 

		}
		else
		{

		}
		
        if (mysqli_multi_query($conn, $sql1))
        {
            echo '<center>';
            echo '<h2><br><br><br><br><span style="color: green;">Successfully Save Information with Tracking No-'. '<span style="color: magenta;">'.$trNo.'</span></h2>';
            echo "<a class='btn btn-success btn-lg' href='propietorship.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Edit</a><br><br>";
       
            //echo "<a class='btn btn-default btn-lg blue' href='generate_pdf/genPDFCompany.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Generate PDF</a><br><br>";
            echo '</center>';
            echo '<center>';
			echo "<a class='btn btn-primary btn-lg' href='viewCiBInqueryPropietorship.php?gtrNo=$trNo'><span class='glyphicon glyphicon-eye-open'></span> View Report and Submit to Manager</a><br><br>";
            echo '</center>';
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
$sqlSec="SELECT * FROM `sheet1` where `remarks`='c'";
$rspc=mysqli_query($conn, $sqlSec);

$sqlperdis="SELECT DISTINCT DistrictCode, DistrictName FROM `location` ORDER by DistrictName asc;";
$rsperDist=mysqli_query($conn, $sqlperdis);

//$sqlperdis1="SELECT DISTINCT DistrictCode, DistrictName FROM `location` ORDER by DistrictName asc;";
$rsperDist1=mysqli_query($conn, $sqlperdis);
$rsperDist2=mysqli_query($conn, $sqlperdis);

//$sqlperdis2="SELECT DISTINCT DistrictCode, DistrictName FROM `location` ORDER by DistrictName asc;";
$rsperDist2=mysqli_query($conn, $sqlperdis);
$rsperDist3=mysqli_query($conn, $sqlperdis);


$sqlperdis3="SELECT DISTINCT DistrictCode, DistrictName FROM `location` ORDER by DistrictName asc;";
$rsperDist3=mysqli_query($conn, $sqlperdis);


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
$rspc4=mysqli_query($conn, $sqlc);

$sqlSec="SELECT * FROM `sheet1`";
$a=mysqli_query($conn, $sqlSec);
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
		
		
		

  
    <?php
include("propJsFile.js");
?>  



<script>
        function fileValidation1() {
            var fileInput = 
                document.getElementById('UploadMoneyReceipt');
              
            var filePath = fileInput.value;
          
            // Allowing file type
            var allowedExtensions = 
                   /(\.jpg|\.jpeg|\.png|.\pdf)$/i;
              
            if (!allowedExtensions.exec(filePath)) {
               alert('File type must be jpg,jpeg,png or pdf');
                fileInput.value = '';
                return false;
            } 
            else 
            {
              
                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'UploadMoneyReceipt').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>

<script>
        function fileValidation2() {
            var fileInput = 
                document.getElementById('UploadPromiseLetter');
              
            var filePath = fileInput.value;
          
            // Allowing file type
            var allowedExtensions = 
                         /(\.jpg|\.jpeg|\.png|.\pdf)$/i;
              
            if (!allowedExtensions.exec(filePath)) {
               alert('File type must be jpg,jpeg,png or pdf');
                fileInput.value = '';
                return false;
            } 
            else 
            {
              
                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'UploadPromiseLetter').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>
	
	
<script>
        function fileValidation3() {
            var fileInput = 
                document.getElementById('UploadOtherDocs');
              
            var filePath = fileInput.value;
          
            // Allowing file type
            var allowedExtensions = 
                        /(\.jpg|\.jpeg|\.png|.\pdf)$/i;
              
            if (!allowedExtensions.exec(filePath)) {
               alert('File type must be jpg,jpeg,png or pdf');
                fileInput.value = '';
                return false;
            } 
            else 
            {
              
                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'UploadOtherDocs').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
			        }
    </script>



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
</head>

<body>
<!--<p align= "right"<p style="color:red;text-align:right;font-size:20px">Branch Code:<?php echo $brCode;?></p>--->

	<div class="container">

     <div class="wrapper"><div style="text-align:center;font-size:2vw;background-color:green;color:white;width:100%;height:48px;padding-top:7px;margin-bottom:10px">CIB ONLINE INQUIRY FORM</div>
		
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="propietorship" method="post" name= "form3" role="form" id="register-form" autocomplete="off"onsubmit="return validateForm()" enctype="multipart/form-data">

         <div class="body_style">
         
    <section>	
	<div class = "row">
	
	<ul id="tabsList" class="nav nav-pills" style="font-size:15px;font-weight:BOLD; background-color:#DFF0D8">
    <li ><a data-toggle="tab" role="tab" href="individual.php" id="individual" >Individual</a></li>
    <li ><a data-toggle="tab" role="tab" href="company.php" id="company">Company</a></li>
	<li class="active" ><a data-toggle="tab" role="tab" href="propietorship.php" id="propietorship" name= "propietorship" >Proprietorship</a></li>

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
		 <div class="form-group col-lg-3" style="padding-top:15px;">
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
   <div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="" for="FISubCode">FISubCode</label>
			  <input type="text" name="FISubCode" id="FISubCode" value="<?php echo $FISubCode; ?>" maxlength="16"  class="form-control" />
			</div>
        </div>
	   </div>
	    <div class="row">


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
<div class="form-group col-lg-2" style="padding-top:15px;">     
			  
			  <label class = "required" for="contractHistory">Contract History</label>
			  <select class="form-control" id="contractHistory" name='contractHistory'>
			  	     <option selected value="">---Select contract history---</option>

		<option value="12 Months"<?php if ($contractHistory == "12 Months") echo 'selected="selected"'; ?>>12 Months</option>
		<option value="24 Months"<?php if ($contractHistory == "24 Months") echo 'selected="selected"'; ?>>24 Months</option>
      </select>
			<br>
		</div>
<div class="form-group col-lg-2" style="padding-top:15px;">     
			  
			  <label class = "required"  for="contractPhase">Contract Phase</label>
			  <select class="form-control" id="contractPhase" name='contractPhase'>
			  	     <option selected value="">---select contract phase---</option>

		<option value="All loans"<?php if ($contractPhase == "All loans") echo 'selected="selected"'; ?>>All loans</option>
		<option value="Living Loans"<?php if ($contractPhase == "Living Loans") echo 'selected="selected"'; ?>>Living Loans</option>
      </select>
			<br>
		</div>
	<!--	<div class="form-group col-lg-4" style="padding-top:15px;">     
			<div class="form-group">
			<label for="Role">Role in the Institution</label>
				<select class="form-control" id="Role" name='Role' >
					<option selected value="">---Select Role---</option>
					<option value="Chairman" <?php if ($Role == "Chairman") echo 'selected="selected"'; ?>>Chairman</option>
					<option value="Managing Director"<?php if ($Role == "Managing Director") echo 'selected="selected"'; ?>>Managing Director</option>
					<option value="Sponsor Director"<?php if ($Role == "Sponsor Director") echo 'selected="selected"'; ?>>Sponsor Director</option>
					<option value="Elected Director"<?php if ($Role == "Elected Director") echo 'selected="selected"'; ?>>Elected Director</option>
					<option value="Nominated Director(by Govt.)"<?php if ($Role == "Nominated Director(by Govt.)") echo 'selected="selected"'; ?> >Nominated Director(by Govt.)</option>
					<option value="Nominated Director(by Pvt. Institution)" <?php if ($Role == "Nominated Director(by Pvt. Institution)") echo 'selected="selected"'; ?> >Nominated Director(by Pvt. Institution)</option>
					<option value="Share Holder" <?php if ($Role == "Share Holder") echo 'selected="selected"'; ?> >Share Holder</option>
					<option value="Partner" <?php if ($Role == "Partner") echo 'selected="selected"'; ?> >Partner</option>
					<option value="Owner of Proprietorship" <?php if ($Role == "Owner of Proprietorship") echo 'selected="selected"'; ?> >Owner of Proprietorship</option>
					<option value="Others" <?php if ($Role == "Others") echo 'selected="selected"'; ?> >Others</option>

				</select>

			</div>
		</div>
		--->
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
	
			<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="TradeTitle">Trade Name Title</label>
			  <input type="text" name="TradeTitle" id="TradeTitle"  value="<?php echo $TradeTitle; ?>"class="form-control"  />
			 </div>
		</div>
			<div class="form-group col-lg-5" style="padding-top:15px;">     
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
	   </div>
	   </div>
	   	<!--	<div class = "row"style="margin-left:5px;margin-right:5px">

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

		</div>-->
		
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
			  <input type="text" name="BusPostal" id="BusPostal" maxlength="4" value="<?php echo $BusPostal; ?>" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"    />
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
			  <input type="text" name="FacPostal" id="FacPostal" maxlength="4"value="<?php echo $FacPostal; ?>"  class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"   />
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
			  <label  for="TelephoneNumber"> Business Telephone Number</label>
			  <input type="text" name="TelephoneNumber" id="TelephoneNumber" maxlength="11"  required ="true" value="<?php echo $TelephoneNumber; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" class="form-control" />
			 </div>
		</div>
						<div class="form-group col-lg-3" style="padding-top:15px;">     
			  
			  <label class="required" for="SecType">Sector Type</label>
			  <select class="form-control" id="SecType" name='SecType'>
			  	     <!-- <option selected value="">---Select Sector Type---</option> -->
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
				while($rwPer9 = mysqli_fetch_assoc($a))
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

 <div class="row" style="background-color:#f1fdef;">
		
<div class="panel panel-default" style="background-color:#f0f5f5;"  >
		<div class="panel-heading" style="background-color:#0E95B5;"> <span style="color: white; font-size:16px;">Individual Subject Data</span>
		
		</div>
<div class = "row" style="margin-left:5px;margin-right:5px">
	<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class = "" for="Title">Title of the Name</label>
			  <input type="text" name="Title" id="Title"value="<?php echo $Title; ?>"class="form-control" onkeyup="this.value = this.value.replace(/[^a-zA-Z .]/g, '')" />
			 </div>
		</div>
		
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="Name">Name</label>
			  <input type="text" name="Name" id="Name"value="<?php echo $Name; ?>" class="form-control" onkeyup="this.value = this.value.replace(/[^a-zA-Z .]/g, '')" required ="true" />
			 </div>
		</div>
		
		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="FatherTitle">Father's Title</label>
			  <input type="text" name="FatherTitle" id="FatherTitle" value="<?php echo $FatherTitle; ?>" class="form-control" onkeyup="this.value = this.value.replace(/[^a-zA-Z .]/g, '')"/>
			 </div>
		</div>
		
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="FatherName">Father's Name</label>
			  <input type="text" name="FatherName" id="FatherName"value="<?php echo $FatherName; ?>" class="form-control" onkeyup="this.value = this.value.replace(/[^a-zA-Z .]/g, '')" />
			 </div>
		</div>
	</div>
	
<div class="row" style="margin-left:5px;margin-right:5px">	
	
		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label  for="MotherTitle">Mother's Title</label>
			  <input type="text" name="MotherTitle" id="MotherTitle" class="form-control" value="<?php echo $MotherTitle; ?>" onkeyup="this.value = this.value.replace(/[^a-zA-Z .]/g, '')" />
			 </div>
		</div>
		
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="MotherName">Mother's Name</label>
			  <input type="text" name="MotherName" id="MotherName" class="form-control" value="<?php echo $MotherName; ?>" onkeyup="this.value = this.value.replace(/[^a-zA-Z .]/g, '')" />
			 </div>
		</div>
		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label  for="SpouseTitle">Spouse's Title</label>
			  <input type="text" name="SpouseTitle" id="SpouseTitle" class="form-control"  value="<?php echo $SpouseTitle; ?>" onkeyup="this.value = this.value.replace(/[^a-zA-Z .]/g, '')"/>
			 </div>
		</div>
		
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="SpouseName">Spouse's Name</label>
			  <input type="text" name="SpouseName" id="SpouseName" class="form-control" value="<?php echo $SpouseName; ?>" onkeyup="this.value = this.value.replace(/[^a-zA-Z .]/g, '')" />
			 </div>
		</div>
		
</div>
<div class="row" style="margin-left:5px;margin-right:5px">		
	<div class="form-group col-lg-2" style="padding-top:15px;">     
		<div class="form-group">
		<label class="required" for="BirthDate">Date of Birth</label>

		<input type="text" name="BirthDate" placeholder= "dd/mm/yyyy" class="form-control" id="BirthDate" data-inputmask="'alias': 'date'" value="<?php echo empty($BirthDate)==false? date("d-m-Y",strtotime(str_replace('/', '-', $BirthDate))): $BirthDate; ?>" >
		
		<span id="dob_error"></span>

		
		</div>
	</div>
	    
	
	<div class="form-group col-lg-2" style="padding-top:15px;">     
			  
			  <label class="required" for="Gender">Gender</label>
			  <select class="form-control" name='Gender'id="Gender" >
			  			  <option selected value="">---Select Gender---</option>

		<option value="Male"<?php if ($Gender == "Male") echo 'selected="selected"'; ?>>Male</option>
		<option value="Female"<?php if ($Gender == "Female") echo 'selected="selected"'; ?>>Female</option>
         </select>
		<br>
	</div>		
		
		
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="NID">NID</label>
			  <input type="text" name="NID" id="NID" class="form-control"  maxlength="17" value="<?php echo $NID; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  />
			<span id="file_error99"></span>
			 </div>
		</div>
	

		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label  for="Etin">ETIN</label>
			  <input type="text" name="Etin" id="Etin"  class="form-control" value="<?php echo $Etin; ?>"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
			 </div>
		</div>
		
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			<div class="form-group">
			<label class ="required" for="OwnerTelephoneNumber"> Owner Telephone Number</label>
			<input type="text" name="OwnerTelephoneNumber" id="OwnerTelephoneNumber" value="<?php echo $OwnerTelephoneNumber; ?>"  class="form-control" maxlength="11"  required ="true" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
			<span class="error" id="errorname"></span>
			</div>
		</div>	
		
</div>
<div class="row"style="margin-left:5px;margin-right:5px">		
		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="BirthDistrict">District of Birth</label>
			 <select class="form-control" id="BirthDistrict" name='BirthDistrict'>
			  <?php 
			  $perDistList1='';
				$perDistList1.='<option selected="selected" value="">Select District</option>';
				while($rwPer1 = mysqli_fetch_assoc($rsperDist1))
				{
				$perDistList1.='<option value="'.$rwPer1['DistrictName'].'"';
				if(trim($BirthDistrict)==trim($rwPer1['DistrictName']))
				{
				$perDistList1.=" selected='selected'";
				}
				$perDistList1.='>'.$rwPer1['DistrictName'].'</option>';	
				}
				
				echo $perDistList1;
				?>
			  </select>	
			
			 </div>
		</div>	
		
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="BirthCountry">Country of Birth</label>
 <select class="form-control" id="BirthCountry" name='BirthCountry'>
			 <?php 
			  $t1='';
				$t1.='<option selected="selected" value="Bangladesh">Bangladesh</option>';
				while($rsc1 = mysqli_fetch_assoc($rspc1))
				{
				$t1.='<option value="'.$rsc1['country_name'].'"';
				if(trim($PerCountry)==trim($rsc1['country_name']))
				{
				$t1.=" selected='selected'";
				}
				$t1.='>'.$rsc1['country_name'].'</option>';	
				}
				
				echo $t1;
				?>
			  </select>	
			  </div>
		</div>	
</div>
		
	</div>
	
	</section>
<section>	
     <div class="row" style="background-color:#d8eaf1 ">
		
		<div class="panel panel-default" >
		<div class="panel-heading " style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Permanent Address</span>
		
		</div>
	<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="required" for="PerStreet">Street Name and Number</label>
			  <input type="text" name="PerStreet" id="PerStreet" value="<?php echo $PerStreet; ?>" class="form-control"  />
			</div>
        </div>
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="PerPostal">Postal Code</label>
			  <input type="text" name="PerPostal" id="PerPostal"  maxlength="4" value="<?php echo $PerPostal; ?>" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"   />
			</div>
        </div>
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="PerDistrict">District</label>
 <select class="form-control" id="PerDistrict" name='PerDistrict'>
			  <?php 
			  $perDistList1='';
				$perDistList1.='<option selected="selected" value="">Select District</option>';
				while($rwPer1 = mysqli_fetch_assoc($rsperDist2))
				{
				$perDistList1.='<option value="'.$rwPer1['DistrictName'].'"';
				if(trim($PerDistrict)==trim($rwPer1['DistrictName']))
				{
				$perDistList1.=" selected='selected'";
				}
				$perDistList1.='>'.$rwPer1['DistrictName'].'</option>';	
				}
				
				echo $perDistList1;
				?>
			  </select>			 </div>
		</div>
			
		
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="PerCountry">Country</label>
<select class="form-control" id="PerCountry" name='PerCountry'>
			  <?php 
			  $t1='';
				$t1.='<option selected="selected" value="Bangladesh">Bangladesh</option>';
				while($rsc1 = mysqli_fetch_assoc($rspc2))
				{
				$t1.='<option value="'.$rsc1['country_name'].'"';
				if(trim($PerCountry)==trim($rsc1['country_name']))
				{
				$t1.=" selected='selected'";
				}
				$t1.='>'.$rsc1['country_name'].'</option>';	
				}
				
				echo $t1;
				?>
			  </select>			
			  </div>
        </div>
		
		</div>
	</div>
</section>

<section>	
     <div class="row" style="background-color:#f1fdef ;">
		
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Present Address</span>
		<span style="padding-left:17px; padding-top:5px;"><input type="checkbox" id="same" name="same" onchange="addressFunction()" ></span>
<span style="font-size:15px; color:white">Same as Permanent Address</span>
		</div>

		<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label for="PreStreet">Street Name and Number</label>
			  <input type="text" name="PreStreet" id="PreStreet" value="<?php echo $PreStreet; ?>"  class="form-control" />
			</div>
        </div>
		
				<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label for="PrePostal">Postal Code</label>
			  <input type="text" name="PrePostal" id="PrePostal" maxlength="4" value="<?php echo $PrePostal; ?>" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
			</div>
        </div>
		
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="PreDistrict">District</label>
<select class="form-control" id="PreDistrict" name='PreDistrict'>
			  <?php 
			  $perDistList2='';
				$perDistList2.='<option selected="selected" value="0">Select District</option>';
				while($rwPer = mysqli_fetch_assoc($rsperDist3))
				{
				$perDistList2.='<option value="'.$rwPer['DistrictName'].'"';
				if(trim($PreDistrict)==trim($rwPer['DistrictName']))
				{
				$perDistList2.=" selected='selected'";
				}
				$perDistList2.='>'.$rwPer['DistrictName'].'</option>';	
				}
				
				echo $perDistList2;
				?>
			  </select>			 </div>
		</div>
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label for="PreCountry">Country</label>
<select class="form-control" id="PreCountry" name='PreCountry'>
			  <?php 
			  $t2='';
				$t2.='<option selected="selected" value="Bangladesh">Bangladesh</option>';
				while($rsc2 = mysqli_fetch_assoc($rspc4))
				{
				$t2.='<option value="'.$rsc2['country_name'].'"';
				if(trim($BirthCountry)==trim($rsc2['country_name']))
				{
				$t2.=" selected='selected'";
				}
				$t2.='>'.$rsc2['country_name'].'</option>';	
				}
				
				echo $t2;
				?>
			  </select>			
			  </div>
        </div>
		
		</div>
	</div>
</section>


	<section>	
     <div class="row" style="background-color:#dbf3ef ;">
		
		<div class="panel panel-default" id="OIT">
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Other ID</span>

		</div>
<div class="form-group col-lg-3" style="padding-top:15px;">
      <label for="IDType">ID Type</label>

      <select class="form-control" id="IDType" name='IDType'>
	  	  			  <option selected value="">---Select ID Type---</option>

		<option value="Passport" <?php if ($IDType == "Passport") echo 'selected="selected"'; ?>>Passport</option>
		<option value="Driving License"<?php if ($IDType == "Driving License") echo 'selected="selected"'; ?>>Driving License</option>
		<option value="Birth Registration"<?php if ($IDType == "Birth Registration") echo 'selected="selected"'; ?>>Birth Registration</option>
	
      </select>
	   </div>
		<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label  for="IDNumber">ID Number</label>
			  <input type="text" name="IDNumber" id="IDNumber" value="<?php echo $IDNumber; ?>"class="form-control" />
			</div>
			<br>			
        </div>
		
		<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label  for="IDIssueDate">ID Issue Date</label>			  
		<input type="text" name="IDIssueDate" placeholder= "dd/mm/yyyy" class="form-control" id="IDIssueDate" data-inputmask="'alias': 'date'" value="<?php echo empty($IDIssueDate)==false? date("d-m-Y",strtotime(str_replace('/', '-', $IDIssueDate))): $IDIssueDate; ?>" >
			</div>
        </div>
<!---		<script>
  var maskConfig = {
    mask: "1/2/y",
    leapday: "29/02/",
    separator: "/",
    alias: "dd/mm/yyyy",
    placeholder: "dd/mm/yyyy"
};

$("._input_selector").inputmask("dd/mm/yyyy", maskConfig);
</script> -->
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label for="IDIssueCountry">ID Issued Country</label>
<select class="form-control" id="IDIssueCountry" name='IDIssueCountry'>
			  <?php 
			  $t3='';
				$t3.='<option selected="selected" value="Bangladesh">Bangladesh</option>';
				while($rsc3 = mysqli_fetch_assoc($rspc3))
				{
				$t3.='<option value="'.$rsc3['country_name'].'"';
				if(trim($IDIssueCountry)==trim($rsc3['country_name']))
				{
				$t3.=" selected='selected'";
				}
				$t3.='>'.$rsc3['country_name'].'</option>';	
				}
				
				echo $t3;
				?>
			  </select>			
			 </div>
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

	</section>
	<section>
	  <div class="row" style="background-color:#d8eaf1;">
		
		<div class="panel panel-default" >
		<div class="panel-heading " style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Upload Files</span>
		
		</div>
			
 <script type="text/javascript">
    $(function () {
        $("input[name=btnShowDip2]").click(function () {
            if ($(this).val() == "Change") {
                $("#UploadNID").show();
				$("#firstDip2").hide();
				$('#dphd2').val(1);
            } else {
                $("#UploadNID").hide();
				$("#firstDip2").show
				$('#dphd2').val(0);
            }
        });
    });
</script>
		
 	<div class="form-group col-lg-3" style="padding-top:15px;">
	  <label for="cerBankingDpma2">Upload NID</label>
	  <div style="border: 1px solid green;">
	  
	  
	  <?php

		  
	  $display="display: ''";
	  if(!empty($fileName))
		  {
			echo '<div id="firstDip2">';
			$lnk=$fileName;
			if(strlen($fileName)>10)
			{
			$lnk='..'.substr($fileName,-10,10);
			}
			echo '<a href="uploads/'.$fileName.'" target="_blank" style=" color: blue;">'.$lnk.'</a>';
            echo '<input type="button" value="Change" style="border:none; color:#fc0abc; " name ="btnShowDip2" id ="btnShowDip2" class="btn btn-link"></input>';
			echo '</div>';
			$display="display: none";
		  }
		  else{
			  $display="display: ''";
		  }
		
		echo '<input id="UploadNID" onchange="return fileValidation ()" style="'.$display.'" type="file" size="10px" name="UploadNID" class="UploadNID">';
	  
	  ?>
	  				<p style="color:red; font-size:12px; padding-top:5px">(Max-Size: 5MB)</p> 

	  <span id="file_error"></span>
	  	  <input type="hidden" value="0" name="dphd2" id="dphd2">
	  
	  </div>
	  
	</div>
		
	 	<div class="form-group col-lg-3" style="padding-top:15px;">
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
			echo ' <input type="button" value="Change"style="border:none; color: #fc0abc;" name ="btnShowDip3" id ="btnShowDip3"class="btn btn-link"></input>';
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
	
	
	
	

	<div class="form-group col-lg-3" style="padding-top:15px;">
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
			echo ' <input type="button" value="Change" style="border:none; color: #fc0abc;" name ="btnShowDip4" id ="btnShowDip4" class="btn btn-link" /></input>';
			
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
	
	 	<div class="form-group col-lg-3" style="padding-top:15px;">
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
			echo ' <input type="button" value="Change"style="border:none; color: #fc0abc;"  name ="btnShowDip5" id ="btnShowDip5" class="btn btn-link" /></input>';

			
			
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
		
		</section>
		
	
	
</div>
		<p align="right">
<br><a href="company.php" class="btn btn-warning btn-lg"> <span class="glyphicon glyphicon-step-backward"></span> Reload </a>
<span style="margin-right:8px;"> &nbsp; <button type="submit" id="save" name="save" class="btn btn-lg btn-success">Save Information<span class='glyphicon glyphicon-step-forward'></span></button> </span>

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
 $('input[name="voucherDate"]').mask('00/00/0000');
   $('input[name="BirthDate"]').mask('00/00/0000');
		 $('input[name="IDIssueDate"]').mask('00/00/0000');
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