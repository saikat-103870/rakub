<?php
include('header.php');

?>
<!DOCTYPE html>
<html>
<br><br><br>
<head>
	<title>Insert Page page</title>
<title>Sign Up Form Using Bootstrap with jQuery Validation</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="assets/signup-form.css" type="text/css" />

<style>
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



}
.required:after {
	content:" *";
	color: red;
	font-weight: bold;
}
</style>
</head>

<body>
	<center>
		<?php
	

		// servername => localhost
		// username => root
		// password => empty
		// database name => cibinquiry
		$conn = mysqli_connect("localhost", "root", "", "cibinquiry");
		
		// Check connection
		if($conn == false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}


$TrackNo = $_GET['TrackNo']; // get id through query string
$Role = '';
$Gender = '';
$FinType= '';
$FISubjCode= '';
$LoanType= '';
$TotalReqAmt='';
$InstallmentNo='';
$InstallmentAmt='';
$PaymentPeriod='';
$Title='';
$Name='';
$FatherTitle='';
$FatherName='';
$MotherTitle = '';
$MotherName = '';
$SpouseTitle = '';
$SpouseName = '';
$BirthDate	= '';
$NID	= '';
$Etin	= '';
$TelephoneNumber = '';
$q = "select * from form1 where TrackNo='$TrackNo'";
$qry = mysqli_query($conn,$q); // select query
$row = mysqli_fetch_assoc($qry);
//$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{

		    $Role = $_POST['Role'];
    $Gender = $_POST['Gender'];
	$FinType = $_POST['FinType'];
	$FISubjCode = $_POST['FISubjCode'];
	$LoanType = $_POST['LoanType'];
	$TotalReqAmt = $_POST['TotalReqAmt'];
	$InstallmentNo = $_POST['InstallmentNo'];
	$InstallmentAmt = $_POST['InstallmentAmt'];
	$PaymentPeriod = $_POST['PaymentPeriod'];
	$Title = $_POST['Title'];
	$Name = $_POST['Name'];
	$FatherTitle = $_POST['FatherTitle'];
	$FatherName = $_POST['FatherName'];
	$MotherTitle = $_POST['MotherTitle'];
	$MotherName = $_POST['MotherName'];
	$SpouseTitle = $_POST['SpouseTitle'];
	$SpouseName = $_POST['SpouseName'];
	$BirthDate	= $_POST['BirthDate'];
	$NID	= $_POST['NID'];
	$Etin	= $_POST['Etin'];
	$TelephoneNumber = $_POST['TelephoneNumber'];
	
	
	
	
    $edit = mysqli_query($conn,"update form1 set BirthDate = '$BirthDate',NID='$NID',Etin = '$Etin',TelephoneNumber='$TelephoneNumber',MotherTitle='$MotherTitle',MotherName='$MotherName',SpouseTitle= '$SpouseTitle',SpouseName = '$SpouseName',Title = '$Title',Name = '$Name',FatherTitle='$FatherTitle',FatherName='$FatherName',PaymentPeriod='$PaymentPeriod',InstallmentNo='$InstallmentNo',InstallmentAmt= '$InstallmentAmt',TotalReqAmt='$TotalReqAmt',Role='$Role',FinType='$FinType', Gender='$Gender', FISubjCode='$FISubjCode', LoanType = '$LoanType' where TrackNo='$TrackNo'");
	
    if($edit)
    {
			echo "updated";
        mysqli_close($conn); // Close connection
	
    }
    else
    {
				echo "not updated";
        echo mysqli_error();
    }    	
}
?>

<h2>User Update Form</h2>

	<div class="container">
	       <div class="wrapper"<h3><div style="text-align:center;font-size:20px;background-color:green;color:white;width:1081px;height:48px;padding-top:7px;margin-bottom:10px">CIB ONLINE INQUIRY FORM-1</div></h3>

	         <form action="" method="post">
			          <div class="body_style">
	<section>
	<div class="topnav">
  <div class="search-container">
    <label  for="FISubjCode" style="color:#269900 ; font-size: 19px;">FI Subject Code</label>
      <input type="text" style="border:1px solid blue" name="FISubjCode" id='FISubjCode'value="<?php echo $row['FISubjCode'];?>">
     <a button type = "button" href=""><i class="fa fa-search"></i></a>
   
  </div>

</div>
	     <div class="row">
		 		 <div class="form-group col-lg-6" style="padding-top:15px;">
      <label for="LoanType">Loan Type</label>
      <select class="form-control" id="LoanType" name='LoanType'>
	  	<option value="New" <?php if($row['LoanType']=="New") echo "selected"; ?>>New</option>
	  	<option value="Renewal" <?php if($row['LoanType']=="Renewal") echo "selected"; ?>>Renewal</option>
	  	<option value="Enhancement" <?php if($row['LoanType']=="Enhancement") echo "selected"; ?>>Enhancement</option>
	  	<option value="Others" <?php if($row['LoanType']=="Others") echo "selected"; ?>>Others</option>
	      </select>
	   </div>
	      	 <div class="form-group col-lg-6" style="padding-top:15px;">
          <label class="required" for="IndividualInfo" id="IndividualInfo" value="Borrower">Individual's Information</label><br>
     
    <label class="radio-inline" class="required" style="width:100px">
      <input type="radio" name="IndividualInfo" id="IndividualInfo" value="Borrower" class="form-control" style="width:25%">Borrower
    </label>
    <label class="radio-inline" class="required" style="width:100px">
    <input type="radio" name="IndividualInfo" id="IndividualInfo" value="Co-Borrower" class="form-control" style="width:25%">Co-borrower
    </label>
    <label class="radio-inline" class="required" style="width:100px">
     <input type="radio"  name="IndividualInfo" id="IndividualInfo" value="gurantor" class="form-control" style="width:25%">Gurantor
    </label>
	 <label class="radio-inline" class="required" style="width:100px">
    <input type="radio"name="IndividualInfo" id="IndividualInfo" value="owner" class="form-control" style="width:25%">Owner
    </label>
	   </div>
	     <br><br><br><br><br>
		 <div class="form-group col-lg-4"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="FinType">Type of Financing</label>
			  <input type="text" name="FinType" id="FinType"class="form-control"  required="true"value="<?php echo $row['FinType'];?>" />
		
        </div>
				
		</div>
			<div class="form-group col-lg-4" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="required" for="TotalReqAmt">Total Requested Amount/Credit Limit</label>
			  <input type="text" name="TotalReqAmt" id="TotalReqAmt" class="form-control" value="<?php echo $row['TotalReqAmt'];?>"/>
			</div>
        </div>

				<div class="form-group col-lg-4" style="padding-top:15px;">     
			  
			  <label class="required" for="Role">Role in the Institution</label>
			  <select class="form-control" name='Role' id="Role" >
		<option value="Chairman" <?php if($row['Role']=="Chairman") echo "selected"; ?>>Chairman</option>
		<option value="Managing Director"<?php if($row['Role']=="Managing Director") echo "selected"; ?>>Managing Director</option>
		<option value="Sponsor Director"<?php if($row['Role']=="Sponsor Director") echo "selected"; ?>>Sponsor Director</option>
		<option value="Elected Director"<?php if($row['Role']=="Elected Director") echo "selected"; ?>>Elected Director</option>
		<option value="Nominated Director(by Govt.)"<?php if($row['Role']=="Nominated Director(by Govt.)") echo "selected"; ?>>Nominated Director(by Govt.)</option>
		<option value="Nominated Director(by Pvt. Institution)"<?php if($row['Role']=="Nominated Director(by Pvt. Institution)") echo "selected"; ?>>Nominated Director(by Pvt. Institution)</option>
		<option value="Share Holder"<?php if($row['Role']=="Share Holder") echo "selected"; ?>>Share Holder</option>
		<option value="Partner"<?php if($row['Role']=="Partner") echo "selected"; ?>>Partner</option>
		<option value="Owner of Proprietorship"<?php if($row['Role']=="Owner of Proprietorship") echo "selected"; ?>>Owner of Proprietorship</option>
		<option value="Others"<?php if($row['Role']=="Others") echo "selected"; ?>>Others</option>


      </select>
			<br>
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
			  <input type="number" name="InstallmentNo" id="InstallmentNo" class="form-control" value="<?php echo $row['InstallmentNo'];?>"/>
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;"> 
			<div class="form-group">
			  <label  for="InstallmentAmt">Installment Amount</label>
			  <input type="text" name="InstallmentAmt" id="InstallmentAmt" class="form-control" value="<?php echo $row['InstallmentAmt'];?>"/>
			</div>
        </div>
		
		<div class="form-group col-lg-4"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label  for="PaymentPeriod">Periodicity of Payment (In Months)</label>
			  <input type="number" name="PaymentPeriod" id="PaymentPeriod"class="form-control" value="<?php echo $row['PaymentPeriod'];?>"/>
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
			  <input type="text" name="Title" id="Title" class="form-control" value="<?php echo $row['Title'];?>"/>
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="Name">Name</label>
			  <input type="text" name="Name" id="Name" class="form-control" value="<?php echo $row['Name'];?>"/>
			 </div>
		</div>
				<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="FatherTitle">Father's Title</label>
			  <input type="text" name="FatherTitle" id="FatherTitle" class="form-control" value="<?php echo $row['FatherTitle'];?>" />
			 </div>
		</div>
					<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="FatherName">Father's Name</label>
			  <input type="text" name="FatherName" id="FatherName"class="form-control" value="<?php echo $row['FatherName'];?>"/>
			 </div>
		</div>
		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label  for="MotherTitle">Mother's Title</label>
			  <input type="text" name="MotherTitle" id="MotherTitle" class="form-control" value="<?php echo $row['MotherTitle'];?>"/>
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="MotherName">Mother's Name</label>
			  <input type="text" name="MotherName" id="MotherName" class="form-control"value="<?php echo $row['MotherName'];?>"/>
			 </div>
		</div>
		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label  for="SpouseTitle">Spouse's Title</label>
			  <input type="text" name="SpouseTitle" id="SpouseTitle" class="form-control"value="<?php echo $row['SpouseTitle'];?>" />
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="SpouseName">Spouse's Name</label>
			  <input type="text" name="SpouseName" id="SpouseName" class="form-control" value="<?php echo $row['SpouseName'];?>"/>
			 </div>
		</div>
		
						<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="BirthDate">Date of Birth</label>
			  <input type="text" name="BirthDate" id="BirthDate" placeholder="DD-MM-YYYY" class="form-control"  value="<?php echo $row['BirthDate'];?>"/>
			 </div>
		</div>
				<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="NID">NID</label>
			  <input type="text" name="NID" id="NID"  class="form-control"  value="<?php echo $row['NID'];?>" />
			 </div>
		</div>
					<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label  for="Etin">ETIN</label>
			  <input type="text" name="Etin" id="Etin" class="form-control"  value="<?php echo $row['Etin'];?>"/>
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="TelephoneNumber">Telephone Number</label>
			  <input type="text" name="TelephoneNumber" id="TelephoneNumber" class="form-control"  value="<?php echo $row['TelephoneNumber'];?>" />
			 </div>
		</div>
			<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="BirthDistrict">District of Birth</label>
			  <input type="text" name="BirthDistrict" id="BirthDistrict" value="" class="form-control" />
			 </div>
		</div>	
<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="BirthCountry">Country of Birth</label>
			  <input type="text" name="BirthCountry" id="BirthCountry" value="" class="form-control" />
			 </div>
		</div>	
	
					<div class="form-group col-lg-2" style="padding-top:15px;">     
			  
			  <label class="required" for="SecType">Sector Type</label>
			  <select class="form-control" name='SecType' id="SecType" >
		<option value="Public">Public</option>
		<option value="Private">Private</option>
      </select>
			<br>
		</div>
					<div class="form-group col-lg-4" style="padding-top:15px;">     
			  
			  <label class="required" for="SecCode">Sector Code</label>
		 <input type="text" name="SecCode" id="SecCode" value="" class="form-control" />
			<br>
		</div>
	
						<div class="form-group col-lg-2" style="padding-top:15px;">     
			  
			  <label class="required" for="Gender">Gender</label>
			  <select class="form-control" name='Gender' id="Gender">
		<option value="Male"  <?php if($row['Gender']=="Male") echo "selected"; ?>>Male</option>
		<option value="Female"<?php if($row['Gender']=="Female") echo "selected"; ?>>Female</option>
      </select>
			<br>
		</div>
		</div>
		
	</div>
	</section>
		  <button type="submit" class="btn btn-success" name = "update" value="Update" <span class="glyphicon glyphicon-ok"></span>Update Information
                 </button>
		</form>
		</div> 
		</div>
		</div>
		</div>
	<?php

	 ?>

	</center>	
 <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery-1.11.2.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script src="assets/register.js"></script>
</body>
</html>
