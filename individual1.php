<?php

ob_start();
session_start();
include('templates\header.php');
if(isset($_SESSION['empid']))
{
$EntryUserId=$_SESSION['empid'];
$brCode=$_SESSION['brCode'];
}
else
{	
	header("Location:login.php");
	exit;
}


if(isset ($_POST['save']))
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
		
		}
		
		?>
<!DOCTYPE html>
<br><br><br>
<html>

<head>
<title>CIB Inquiry System</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />
 <script> 
         function validateForm()                                 
         { 
             var NID = document.forms["form1"]["NID"]; 
				lengthNID = NID.value.length;
					if (lengthNID == 0){
					document.getElementById('errorname').innerHTML="Please enter a valid NID";  
					NID.focus();
					return false; 
				 
			 }
                 else {
			             document.getElementById('errorname').innerHTML="";  

				 }
             if ((lengthNID == 10) || (lengthNID == 13) || (lengthNID == 17)){ 
                 
				               document.getElementById('errorname').innerHTML="";  
				 			
             }else{
				 
 document.getElementById('errorname').innerHTML="NID must be 10 13 or 17 digits";  
                 NID.focus();
                 return false; 
				 }
	          
				 
				 
         }
		 
		 		 
      </script>
<script>
$(document).ready(function() {
	  
    $('#individual').validate({
        rules: {
				'InstallmentNo': {
						required: true,
						minlength: 1,
					},
					

				BirthDate : {
						  required: true,
						  date: true
				},		
					
					/*
				'txtLienFromToOrg': {
						required: true,
						minlength: 3,
					},
				'txtFromDate': 	{
					required: true,
     				},
			
*/
        },
		
        messages: {
            'InstallmentNo': {
                required: 'Mandatory field.',
            },
			
			'BirthDate': {
                required: 'Invalid Date.',
            },
			/*
			'txtFromDate': {
                required: 'Mandatory field.',
            },
			*/
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


      });

	
    });

</script>	  
<style>
  .error{
            color: #D8000C;
            background-color: #FFBABA;
         }
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: white;
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
.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    color: #ffffff;
    background-color: #04aa26;

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

	<div class="container">

 
       <div class="wrapper"<h3><div style="text-align:center;font-size:20px;background-color:green;color:white;width:1081px;height:48px;padding-top:7px;margin-bottom:10px">CIB ONLINE INQUIRY FORM-1</div></h3>
			  
  
         <!-- form start -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="individual" method="post" name= "form1" role="form" id="register-form" autocomplete="off"onsubmit="return validateForm()">
		  
 <div class="body_style">
         
        <section>
		
				<ul id="tabsList" class="nav nav-pills" style="font-size:15px;font-weight:BOLD;background-color:#DFF0D8">
				<li class="active"><a data-toggle="tab" role="tab" href="individual.php" id="individual" name = "individual" >Individual</a></li>
				<li ><a data-toggle="tab" role="tab" href="company.php" id="company" name= "company" >Company</a></li>
				</ul>
	   </section>
	   
	   
	   
	<section>

<!-- div class="topnav">
  <div class="search-container">
    <label  for="FISubCode" style="color:#269900 ; font-size: 19px;">FI Subject Code</label>
      <input type="text" placeholder="Search.."style="border:1px solid blue" name="FISubCode" id='FISubCode'>
     <a button type = "button" href=""><i class="fa fa-search"></i></a>
   
  </div>

</div -->

	     <div class="row">
		 <div class="form-group col-lg-6" style="padding-top:15px;">
      <label for="LoanType">Loan Type</label>

      <select class="form-control" id="LoanType" name='LoanType'>
	  	  	     <option selected value="">---Select Loan Type---</option>

		<option value="New">New</option>
		<option value="Renewal">Renewal</option>
		<option value="Enhancement">Enhancement</option>
		<option value="Others">Others</option>
	      </select>
	   </div>
	   	 <div class="form-group col-lg-6" style="padding-top:15px;">
          <label for="indiviCompnyInfo" id="indiviCompnyInfo" value="Borrower">Individual's Information</label><br>
     
    <label class="radio-inline" class="required" style="width:100px">
      <input type="radio" name="indiviCompnyInfo" id="indiviCompnyInfo" value="Borrower" class="form-control" style="width:23%">  Borrower
    </label>
    <label class="radio-inline" class="required" style="width:100px">
    <input type="radio" name="indiviCompnyInfo" id="indiviCompnyInfo" value="Co-Borrower" class="form-control" style="width:25%"> Co-borrower
    </label>
    <label class="radio-inline" class="required" style="width:100px">
     <input type="radio"  name="indiviCompnyInfo" id="indiviCompnyInfo" value="gurantor" class="form-control" style="width:25%"> Gurantor
    </label>
	 <label class="radio-inline" class="required" style="width:100px">
    <input type="radio"name="indiviCompnyInfo" id="indiviCompnyInfo" value="owner" class="form-control" style="width:25%"> Owner
    </label>
	   </div>
	  <br><br><br><br><br>
		
		
	
		<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="FinTypeID">Type of Financing</label>
			  <input type="text" name="FinTypeID" id="FinTypeID"class="form-control"   />
		
        </div>
				
		</div>
		<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="required" for="TotalReqAmt">Total Requested Amount</label>
			  <input type="number" name="TotalReqAmt" id="TotalReqAmt" class="form-control"   />
			</div>
        </div>
			<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="Role">Role in the Institution</label>
			  <select class="form-control" id="Role" name='Role' required="true">
			  	  	     <option selected value="">---Select Role---</option>
		<option value="Chairman">Chairman</option>
		<option value="Managing Director">Managing Director</option>
		<option value="Sponsor Director">Sponsor Director</option>
		<option value="Elected Director">Elected Director</option>
		<option value="Nominated Director(by Govt.)">Nominated Director(by Govt.)</option>
		<option value="Nominated Director(by Pvt. Institution)">Nominated Director(by Pvt. Institution)</option>
		<option value="Share Holder">Share Holder</option>
		<option value="Partner">Partner</option>
		<option value="Owner of Proprietorship">Owner of Proprietorship</option>
		<option value="Others">Others</option>

      </select>
			
			 </div>
		</div>
		
		<div class="form-group col-lg-2"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="FinTypeID">FI Subject Code</label>
			  <input type="text" name="FISubCode" id="FISubCode"class="form-control"   />
		
        </div>
				
		</div>
	</div>
</section>
	<section>
	     <div class="row" style="background-color:#dbf3ef ;">
		
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Installment Contract Data</span>
		
		</div>

		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="InstallmentNo">Number of Installment</label>
			  <input type="number" name="InstallmentNo" id="InstallmentNo" class="form-control" onkeydown="javascript: return event.keyCode == 69 ? false : true"/>
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;"> 
			<div class="form-group">
			  <label  for="InstallmentAmt">Installment Amount</label>
			  <input type="number" name="InstallmentAmt" id="InstallmentAmt" class="form-control" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
			</div>
        </div>
		
		<div class="form-group col-lg-4"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label  for="PerodicityPayment">Periodicity of Payment (In Months)</label>
			  <input type="number" name="PerodicityPayment" id="PerodicityPayment"class="form-control" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
			</div>
        </div>
				
		</div>
	</div>
</section>
<section>	
     <div class="row" style="background-color:#f1fdef;">
		
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Individual Subject Data</span>
		
		</div>

		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="Title">Title of the Name</label>
			  <input type="text" name="Title" id="Title"value="" class="form-control" />
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="Name">Name</label>
			  <input type="text" name="Name" id="Name"value="" class="form-control"  />
			 </div>
		</div>
				<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="FatherTitle">Father's Title</label>
			  <input type="text" name="FatherTitle" id="FatherTitle" value="" class="form-control" />
			 </div>
		</div>
					<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="FatherName">Father's Name</label>
			  <input type="text" name="FatherName" id="FatherName"value="" class="form-control" />
			 </div>
		</div>
		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label  for="MotherTitle">Mother's Title</label>
			  <input type="text" name="MotherTitle" id="MotherTitle" class="form-control" />
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="MotherName">Mother's Name</label>
			  <input type="text" name="MotherName" id="MotherName"value="" class="form-control" />
			 </div>
		</div>
		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label  for="SpouseTitle">Spouse's Title</label>
			  <input type="text" name="SpouseTitle" id="SpouseTitle"value="" class="form-control" />
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="SpouseName">Spouse's Name</label>
			  <input type="text" name="SpouseName" id="SpouseName"value="" class="form-control" />
			 </div>
		</div>
		
						<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="BirthDate">Date of Birth</label>
			  <input type="text" name="BirthDate" id="BirthDate" value=""placeholder="DD-MM-YYYY" class="form-control" />
			 </div>
		</div>
				<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="NID">NID</label>
			  <input type="text" name="NID" id="NID" class="form-control" maxlength="17"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  />
			 <p class="error" id="errorname"></p>
			 </div>
		</div>
		
	
	
					<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label  for="Etin">ETIN</label>
			  <input type="text" name="Etin" id="Etin" value="" class="form-control" maxlength="9"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="TelephoneNumber">Telephone Number</label>
			  <input type="text" name="TelephoneNumber" id="TelephoneNumber" value="" class="form-control" maxlength="11"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
			 			 <span class="error" id="errorname"></span>
</div>
		</div>	
			<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="BirthDistrict">District of Birth</label>
			  <input type="text" name="BirthDistrict" id="BirthDistrict" value="" class="form-control"  />
			 </div>
		</div>	
<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="BirthCountry">Country of Birth</label>
			  <input type="text" name="BirthCountry" id="BirthCountry" value="" class="form-control"  />
			 </div>
		</div>	
	
					<div class="form-group col-lg-2" style="padding-top:15px;">     
			  
			  <label class="required" for="SecType">Sector Type</label>
			  <select class="form-control" name='SecType' id="SecType" >
			  <option selected value="">---Select Sector Type---</option>
		<option value="Public">Public</option>
		<option value="Private">Private</option>
      </select>
			<br>
		</div>
					<div class="form-group col-lg-3" style="padding-top:15px;">     
			  
			  <label class="required" for="SecCode">Sector Code</label>
		 <input type="text" name="SecCode" id="SecCode" value="" class="form-control"  />
			<br>
		</div>
	
					<div class="form-group col-lg-2" style="padding-top:15px;">     
			  
			  <label class="required" for="Gender">Gender</label>
			  <select class="form-control" name='Gender'id="Gender" >
			  			  <option selected value="">---Select Gender---</option>

		<option value="Male">Male</option>
		<option value="Female">Female</option>
      </select>
			<br>
		</div>
		</div>
		
	</div>
	</section>
	<section>	
     <div class="row" style="background-color:#d8eaf1 ;">
		
		<div class="panel panel-default" >
		<div class="panel-heading " style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Permanent Address</span>
		
		</div>
	<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="required" for="PerStreet">Street Name and Number</label>
			  <input type="text" name="PerStreet" id="PerStreet" class="form-control"  />
			</div>
        </div>
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="PerPostal">Postal Code</label>
			  <input type="number" name="PerPostal" id="PerPostal"class="form-control"   />
			</div>
        </div>
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="PerDistrict">District</label>
			  <input type="text" name="PerDistrict" id="PerDistrict"value="" class="form-control"  />
			 </div>
		</div>
			
		
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="PerCountry">Country</label>
			  <input type="text" name="PerCountry" id="PerCountry"class="form-control"  />
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
			  <input type="text" name="PreStreet" id="PreStreet" class="form-control" />
			</div>
        </div>
		
				<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="PrePostal">Postal Code</label>
			  <input type="number" name="PrePostal" id="PrePostal"class="form-control"  />
			</div>
        </div>
		
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="PreDistrict">District</label>
			  <input type="text" name="PreDistrict" id="PreDistrict"value="" class="form-control" />
			 </div>
		</div>
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label for="PreCountry">Country</label>
			  <input type="text" name="PreCountry" id="PreCountry"class="form-control"  />
			</div>
        </div>
		
		</div>
	</div>
</section>

	<section>	
     <div class="row" style="background-color:#dbf3ef ;">
		
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Other ID</span>

		</div>
<div class="form-group col-lg-3" style="padding-top:15px;">
      <label for="IDType">ID Type</label>

      <select class="form-control" id="IDType" name='IDType'>
	  	  			  <option selected value="">---Select ID Type---</option>

		<option value="Passport">Passport</option>
		<option value="Driving License">Driving License</option>
		<option value="Birth Registration">Birth Registration</option>
	
      </select>
	   </div>
		<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label  for="IDNumber">ID Number</label>
			  <input type="text" name="IDNumber" id="IDNumber" class="form-control" />
			</div>
			<br>			
        </div>
		
		<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label  for="IDIssueDate">ID Issue Date</label>
			  <input type="text" name="IDIssueDate" id="IDIssueDate"class="form-control"  />
			</div>
        </div>
		
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label for="IDIssueCountry">ID Issued Country</label>
			  <input type="text" name="IDIssueCountry" id="IDIssueCountry"class="form-control"  />
			</div>
        </div>
		
	</section>
	<section> 

	<div class="row" style="background-color:#dbf3ef ;">
			
			
			<div class="form-group col-lg-4">
			<button type="" class="btn btn-success"  name = "save" value="save"style="border:1px solid #980be4; left: 80%; width: 200px; margin-left:440px;">
			<span class="glyphicon glyphicon-ok"></span> Reload Page
			</button>
			</div>
	<div class="form-group col-lg-4">
			<button type="submit" class="btn btn-success"  name = "save" value="save"style="border:1px solid #980be4; left: 80%; width: 200px; margin-left:490px;">
			<span class="glyphicon glyphicon-ok"></span>Save Information
			</button>
			</div>
		</div>
				</section>

			</div>
	</div>
		

	
              </div>
		</div>
			
             </div>
                        
                        
            </div>
            
  


            </form>
             <form action="generate_pdf/genPDF.php" method="post">
    	
	 <div class="footer_style">
               
			  <button type="submit" class="btn btn-success"  name = "save" value="save"style="border:1px solid #980be4;float: right">
                 <span class="glyphicon glyphicon-ok"></span>Generate PDF
                 </button>
		
			</div>
            </div>
           </div>
		   </form>

	</div>
      <script>
            function addressFunction() {
                if (document.getElementById(
                  "same").checked) {
                    document.getElementById(
                      "PreStreet").value = 
                    document.getElementById(
                      "PerStreet").value;
                    
                    document.getElementById(
                      "PrePostal").value = 
                    document.getElementById(
                      "PerPostal").value;
					  
					  
					    document.getElementById(
                      "PreDistrict").value = 
                    document.getElementById(
                      "PerDistrict").value;
					  
					    document.getElementById(
                      "PreCountry").value = 
                    document.getElementById(
                      "PerCountry").value;
					  
					  
					  
                } else {
                    document.getElementById(
                      "PreStreet").value = "";
                    document.getElementById(
                      "PrePostal").value = "";
					   document.getElementById(
                      "PreDistrict").value = "";
					     document.getElementById(
                      "PreCountry").value = "";
                }
            }
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