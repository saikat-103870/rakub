<?php
ob_start();
session_start();
//include ('header.php');
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
$BirthDistrict = '';
$BirthCountry = '';
$SecType = '';
$SecCode = '';
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
$BirthDate = '';
$contractHistory = '';
$contractPhase = '';
$fileName = '';
$fileName = '';
$fileName1 = '';
$fileName2 = '';
$fileName3 = '';
if(isset($_GET['gtrNo']))
{
	$trNo=$_REQUEST['gtrNo'];
	$exist=1;
	
	$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN individual c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo and i.BranchId=".$_SESSION['brCode'];
	
	
	
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
		$voucherNumber = $row['voucherNumber'];
		$voucherAmount = $row['voucherAmount'];
		$voucherDate = $row['voucherDate'];
		$IDNumber = $row['IDNumber'];
		if(empty(trim($row['voucherDate']))||(trim($row['voucherDate'])==null) || (trim($row['voucherDate'])=='0000-00-00') || (trim($row['voucherDate'])=='1970-01-01'))
		{
			$voucherDate=null;
		}	
		else
		{		
				$voucherDate = $row['voucherDate'];
		}
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
		$IDIssueCountry = $row['IDIssueCountry'];
		//$BirthDate = $row['BirthDate'];
		$contractHistory = $row['contractHistory'];
		$contractPhase = $row['contractPhase'];
		$fileName = $row['UploadNID'];
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
if (isset($_SESSION['empid'])&& isset($_SESSION['type']))
{
	if($_SESSION['type']==1)
	{
    $EntryUserId = $_SESSION['empid'];
    $brCode = $_SESSION['brCode'];
    }
	else
	{
		header("Location:home.php");
		exit;
	}
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
    $FISubCode = $_POST['FISubCode'];
    $FinTypeID = $_POST['FinTypeID'];
    $TotalReqAmt = $_POST['TotalReqAmt'];
    $InstallmentNo = $_POST['InstallmentNo'];
    $InstallmentAmt = $_POST['InstallmentAmt'];
    $PerodicityPayment = $_POST['PerodicityPayment'];
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
    $voucherDate = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["voucherDate"])));
    $Gender = $_POST['Gender'];
    $BirthDistrict = $_POST['BirthDistrict'];
    $BirthCountry = $_POST['BirthCountry'];
    $PerStreet = addslashes($_POST['PerStreet']);
    $PerPostal = $_POST['PerPostal'];
    $PerDistrict = $_POST['PerDistrict'];
    $PerCountry = $_POST['PerCountry'];
    $PreStreet = addslashes($_POST['PreStreet']);
    $PrePostal = $_POST['PrePostal'];
    $PreDistrict = addslashes($_POST['PreDistrict']);
    $PreCountry = $_POST['PreCountry'];
    $IDType = $_POST['IDType'];
    $IDNumber = addslashes($_POST['IDNumber']);    
	if(!empty(trim($_POST["IDIssueDate"])))
	{
    $IDIssueDate = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["IDIssueDate"])));
	}
	else
	{
		$IDIssueDate=null;
	}
    $IDIssueCountry = $_POST['IDIssueCountry'];
    $SecType = $_POST['SecType'];
    $SecCode = $_POST['SecCode'];
    $TelephoneNumber = $_POST['TelephoneNumber'];
	$voucherNumber = addslashes($_POST['voucherNumber']);
    $voucherAmount = $_POST['voucherAmount'];
	$contractHistory = $_POST['contractHistory'];
	$contractPhase = $_POST['contractPhase'];
    $fileName = $_POST['UploadNID'];
	//exit;
    $fileName1 = $_POST['UploadMoneyReceipt'];
    $fileName2 = $_POST['UploadPromiseLetter'];
    $fileName3 = $_POST['UploadOtherDocs'];
    $UploadMoneyReceipt = $_POST['UploadMoneyReceipt'];
    $UploadPromiseLetter = $_POST['UploadPromiseLetter'];
    $UploadOtherDocs = $_POST['UploadOtherDocs'];
	$exist=$_POST['exist'];
	$trNo=trim($_REQUEST['trNo']);


	

    //echo '<br><br><br><br><br><br><br><br><br><br><br><br><br>loanf type '.$LoanType;
	
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
	if (empty($NID))
    {
        $msgErr .= "Please fill up NID/SmartCard Number<br>";
    }
    
	if(!empty($NID))
	{
		$n = strlen($NID);
		if (!($n == 13 || $n == 17 || $n == 10))
		{
			$msgErr .= "NID must be 10, 13 or 17 characters<br>";
		}
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
			$extension = array("pdf","jpg","jpeg","png");
	
    if ($msgErr == '')
    {

	
		if($exist=='0')
		{
		$random=rand();
		//$trNo = $brCode . date("ymd");
		$sqlGSL="SELECT count(`TrackingNo`) trno FROM `inquiry` WHERE `BranchId`='$brCode'";
		$rsl = mysqli_query($conn, $sqlGSL);
		$rwl = mysqli_fetch_assoc($rsl);
		$trNo3= $brCode . date("ymd").($rwl['trno']+1);
		$trNo= strval($trNo3);
		
$targetDir = "uploads/";
		$tmp=$_FILES["InputImg"]["tmp_name"];
		$nam=$_FILES["InputImg"]["name"];
		$fileName = $_FILES['UploadNID']['name'];
		if(empty($fileName )){
			$fileName="".$_POST['existfile'];
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

			
        $sql = "INSERT INTO `inquiry` (`TrackingNo`, `FormNo`, `indiviCompnyInfo`, `loanType`, `BankName`, `FICode`,
				`BranchId`, `FISubCode`, `CIBCode`, `FinTypeID`, `TotalReqAmt`, `InstallmentNo`, `InstallmentAmt`, `PerodicityPayment`, 
				`entryDate`, `entryUserId`, `authorizedUserId`, `authorizedDateTime`, `remarks`, `status`, `UploadCibReport`, `cibuploadDateTime`,
				`reportuploadUserId`, `docsUploaded`) VALUES ('$trNo','1','$indiviCompnyInfo','$LoanType','RAKUB','033','$brCode','$FISubCode','','$FinTypeID','$TotalReqAmt',
				'$InstallmentNo','$InstallmentAmt','$PerodicityPayment',CURRENT_TIMESTAMP,'$EntryUserId','','','','','','','','');
				
				INSERT INTO individual (`TrackingNo`,`Role`,`Title`,`Name`,FatherTitle,FatherName,`MotherTitle`,`MotherName`,`SpouseTitle`,`SpouseName`,NID,`Etin`,`BirthDate`,`Gender`,`BirthDistrict`,
				`BirthCountry`,`PerStreet`,`PerPostal`,`PerDistrict`,`PerCountry`,
				`PreStreet`,`PrePostal`,`PreDistrict`,`PreCountry`,`IDType`,
				`IDNumber`,`IDIssueDate`,`IDIssueCountry`,`SecType`,`SecCode`,`TelephoneNumber`,`UploadNID`,`UploadMoneyReceipt`,`UploadPromiseLetter`,`UploadOtherDocs`,`voucherNumber`,`voucherAmount`,`voucherDate`,`contractHistory`,`contractPhase`) 
				VALUES('$trNo','$Role','$Title','$Name','$FatherTitle','$FatherName',
				'$MotherTitle','$MotherName','$SpouseTitle','$SpouseName','$NID',
				'$Etin','$BirthDate','$Gender','$BirthDistrict','$BirthCountry',
				'$PerStreet','$PerPostal','$PerDistrict','$PerCountry','$PreStreet',
				'$PrePostal','$PreDistrict','$PreCountry','$IDType','$IDNumber','$IDIssueDate',
				'$IDIssueCountry','$SecType','$SecCode','$TelephoneNumber','$fileName','$fileName1','$fileName2','$fileName3','$voucherNumber','$voucherAmount','$voucherDate','$contractHistory','$contractPhase')";
				//echo '<br><br><br><br><br><br><br><br>'.$sql; exit;
				
				
				move_uploaded_file($file_tmp2,$dir);
				move_uploaded_file($file_tmp3,$dir);


	}
	else if($exist==1)
		{
			$trNo=trim($_REQUEST['trNo']);
			
			$random=rand(10,10000);
		     //Upload NID Start
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
		
			
		    

			$sql = "update inquiry set loanType = '$LoanType',indiviCompnyInfo='$indiviCompnyInfo',FISubCode= '$FISubCode',FinTypeID='$FinTypeID',TotalReqAmt='$TotalReqAmt',
			InstallmentNo='$InstallmentNo',InstallmentAmt='$InstallmentAmt',PerodicityPayment='$PerodicityPayment' where TrackingNo='$trNo';
			
			update individual set Role='$Role',Title= '$Title',Name ='$Name',FatherTitle='$FatherTitle',FatherName='$FatherName',MotherTitle='$MotherTitle',
			MotherName='$MotherName',SpouseTitle='$SpouseTitle',SpouseName='$SpouseName',BirthDate='$BirthDate',NID='$NID',Etin='$Etin',
			TelephoneNumber='$TelephoneNumber',BirthDistrict='$BirthDistrict',BirthCountry='$BirthCountry',SecType='$SecType',
			SecCode='$SecCode',Gender='$Gender',PerStreet='$PerStreet',PerPostal='$PerPostal',PerDistrict='$PerDistrict',PerCountry='$PerCountry',
			PreStreet='$PreStreet',PrePostal='$PrePostal',PreDistrict='$PreDistrict',PreCountry='$PreCountry',IDType='$IDType',IDNumber='$IDNumber',
			IDIssueDate='$IDIssueDate', ".$nidup."".$mrup."".$plup."".$odup." IDIssueCountry='$IDIssueCountry',voucherAmount='$voucherAmount',voucherNumber='$voucherNumber',voucherDate='$voucherDate',contractHistory='$contractHistory',contractPhase='$contractPhase' where TrackingNo='$trNo'";
			
			//echo '<br><br><br><br><br><br><br><br>'.$sql; exit;
	
		}

		
	else
		{

		}

if (mysqli_multi_query($conn, $sql))
        {
				
		 
	
		
	//echo '<br><br><br><br><br><br><br><br><br><br>loanf type '.$sql;exit();
	//echo '<br><br><br><br><br><br><br><br><br><br>loanf type '.$sql;
            echo '<center>';
            echo '<h2><br><br><br><br><span style="color: green;">Successfully Save Information with Tracking No-'. '<span style="color: magenta;">'.$trNo.' </span></h2>';
			echo "<a class='btn btn-success btn-lg' href='individual.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Edit</a><br><br>";
            echo '</center>';
			echo '<center>';
            echo "<a class='btn btn-primary btn-lg' href='viewCiBInquery.php?gtrNo=$trNo'><span class='glyphicon glyphicon-eye-open'></span> View Report and Submit to Manager</a><br><br>";
            echo '</center>';
            exit;

        }

        else
        {
            echo "not inserted" . mysqli_error($conn);
        }


    }
	else{

	
		    $fileName="".$_POST['existfile'];
			
	
			$fileName1="".$_POST['existfile1'];
			
		
			$fileName2="".$_POST['existfile2'];
			
		
			$fileName3="".$_POST['existfile3'];
			
	/**/
	
			
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
$rspc4=mysqli_query($conn, $sqlc);

$sqlSec="SELECT * FROM `sheet1` where `remarks`='c'";
$rspc5=mysqli_query($conn, $sqlSec);

?>
