
<?php
ob_start();
session_start();
$EntryUserId=$_SESSION['empid'];
$brCode=$_SESSION['brCode'];
include('config.php');

?>

<!DOCTYPE html>
<html>

<head>
	<title>Insert Page page</title>
</head>

<body>
	<center>
		<?php

		
		// Taking all values from the form data(input)
		$LoanType = $_POST['LoanType'];
		$indiviCompnyInfo = $_POST['indiviCompnyInfo'];
		$FISubCode = $_POST['FISubCode'];
		$FinTypeID = $_POST['FinTypeID'];
		$TotalReqAmt = $_POST['TotalReqAmt'];
	    $InstallmentNo = $_POST['InstallmentNo'];
	    $InstallmentAmt = $_POST['InstallmentAmt'];
		$PerodicityPayment = $_POST['PerodicityPayment'];
	    $InstitutionType = $_POST['InstitutionType'];
	    $Title = $_POST['Title'];
	    $TradeName = $_POST['TradeName'];
	    $LegalForm = $_POST['LegalForm'];
	    $Etin = $_POST['Etin'];
	    $RJSCRegNo = $_POST['RJSCRegNo'];
	    $RegDate = $_POST['RegDate'];
	    $BusStreet = $_POST['BusStreet'];
	    $BusPostal = $_POST['BusPostal'];
		$BusDistrict = $_POST['BusDistrict'];
		$BusCountry = $_POST['BusCountry'];
		$FacStreet = $_POST['FacStreet'];
		$FacPostal = $_POST['FacPostal'];
		$FacDistrict = $_POST['FacDistrict'];
		$FacCountry = $_POST['FacCountry'];
		$SecType = $_POST['SecType'];
		$SecCode = $_POST['SecCode'];
		$TelephoneNumber = $_POST['TelephoneNumber'];
		
		// Performing insert query execution
		// here our table name is form2
		
				$trNo=$brCode.date("ymdis").rand(1,99);

		
		$sql1 = "INSERT INTO `inquiry` (`TrackingNo`, `FormNo`, `indiviCompnyInfo`, `loanType`, `BankName`, `FICode`,
		`BranchId`, `FISubCode`, `CIBCode`, `FinTypeID`, `TotalReqAmt`, `InstallmentNo`, `InstallmentAmt`, `PerodicityPayment`, 
		`entryDate`, `entryUserId`, `authorizedUserId`, `authorizedDateTime`, `remarks`, `status`, `UploadCibReport`, `cibuploadDateTime`,
		`reportuploadUserId`, `docsUploaded`) VALUES ($trNo,'2','$indiviCompnyInfo','$LoanType','RAKUB','033','$brCode','$FISubCode','','$FinTypeID','$TotalReqAmt',
		'$InstallmentNo','$InstallmentAmt','$PerodicityPayment',CURRENT_TIMESTAMP,'$EntryUserId','',CURRENT_TIMESTAMP,'','','',CURRENT_TIMESTAMP,'','');
		
		INSERT INTO company VALUES ($trNo,'$InstitutionType','$Title','$TradeName','$LegalForm','$Etin',
			'$RJSCRegNo','$RegDate','$BusStreet','$BusPostal','$BusDistrict','$BusCountry','$FacStreet','$FacPostal','$FacDistrict','$FacCountry','$SecType','$SecCode','$TelephoneNumber')";
		
			if (mysqli_multi_query($conn,$sql1)){
	
				echo "Data inserted";

		}
		// Performing insert query execution
		// here our table name is individual
		else{
			echo "not inserted".mysqli_error($conn);
		}
		
		// Close connection
		mysqli_close($conn);
		?>
	</center>
</body>

</html>
