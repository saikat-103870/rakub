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
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

	
		<?php
	

		// servername => localhost
		// username => root
		// password => empty
		// database name => cibinquiry

		
		// Taking all values from the form data(input)
		
		
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
		$BirthDate = $_POST['BirthDate'];
		$Gender = $_POST['Gender'];
		$BirthDistrict = $_POST['BirthDistrict'];
		$BirthCountry = $_POST['BirthCountry'];
		$PerStreet = $_POST['PerStreet'];
		$PerPostal = $_POST['PerPostal'];
		$PerDistrict = $_POST['PerDistrict'];
		$PerCountry = $_POST['PerCountry'];
		$PreStreet = $_POST['PreStreet'];
		$PrePostal = $_POST['PrePostal'];
		$PreDistrict = $_POST['PreDistrict'];
		$PreCountry = $_POST['PreCountry'];
		$IDType = $_POST['IDType'];
		$IDNumber = $_POST['IDNumber'];
		$IDIssueDate = $_POST['IDIssueDate'];
		$IDIssueCountry = $_POST['IDIssueCountry'];
		$SecType = $_POST['SecType'];
		$SecCode = $_POST['SecCode'];
		$TelephoneNumber = $_POST['TelephoneNumber'];

		$trNo=$brCode.date("ymdis").rand(1,99);
		
		
		$sql = "INSERT INTO `inquiry` (`TrackingNo`, `FormNo`, `indiviCompnyInfo`, `loanType`, `BankName`, `FICode`,
		`BranchId`, `FISubCode`, `CIBCode`, `FinTypeID`, `TotalReqAmt`, `InstallmentNo`, `InstallmentAmt`, `PerodicityPayment`, 
		`entryDate`, `entryUserId`, `authorizedUserId`, `authorizedDateTime`, `remarks`, `status`, `UploadCibReport`, `cibuploadDateTime`,
		`reportuploadUserId`, `docsUploaded`) VALUES ($trNo,'1','$indiviCompnyInfo','$LoanType','RAKUB','033','$brCode','$FISubCode','','$FinTypeID','$TotalReqAmt',
		'$InstallmentNo','$InstallmentAmt','$PerodicityPayment',CURRENT_TIMESTAMP,'$EntryUserId','','','','','','','','');
		
		INSERT INTO individual (`TrackingNo`,`Role`,`Title`,`Name`,FatherTitle,FatherName,`MotherTitle`,`MotherName`,`SpouseTitle`,`SpouseName`,NID,`Etin`,`BirthDate`,`Gender`,`BirthDistrict`,
		`BirthCountry`,`PerStreet`,`PerPostal`,`PerDistrict`,`PerCountry`,
		`PreStreet`,`PrePostal`,`PreDistrict`,`PreCountry`,`IDType`,
		`IDNumber`,`IDIssueDate`,`IDIssueCountry`,`SecType`,`SecCode`,`TelephoneNumber`) 
		VALUES('$trNo','$Role','$Title','$Name','$FatherTitle','$FatherName',
			'$MotherTitle','$MotherName','$SpouseTitle','$SpouseName','$NID',
			'$Etin','$BirthDate','$Gender','$BirthDistrict','$BirthCountry',
			'$PerStreet','$PerPostal','$PerDistrict','$PerCountry','$PreStreet',
			'$PrePostal','$PreDistrict','$PreCountry','$IDType','$IDNumber','$IDIssueDate',
			'$IDIssueCountry','$SecType','$SecCode','$TelephoneNumber')";
			//echo $sql; exit;
		if (mysqli_multi_query($conn,$sql)){
	
				echo "Data inserted";

		}
		// Performing insert query execution
		// here our table name is individual
		else{
			echo "not inserted".mysqli_error($conn);
		}
		
		//$sql1 = "select TrackNo,Role,Gender from form1";





		// Close connection
		mysqli_close($conn);
		?>

	
	
	



</html>
