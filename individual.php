<?php 
ob_start();
include ('header.php');
include("indSave.php");
//echo "<br><br><br><br><br><br><br><br><br><br><br>ssss".$PerStreet;
//exit();
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
 <script type='text/javascript' src="js/jquery-3.3.1.slim.min.js"></script>
     
    <script type='text/javascript'src="js/jquery.mask.js"></script>
  
      
    <script  type='text/javascript'src="js/popper.min.js"></script>
      

<script type='text/javascript' src="js/jquery.inputmask.bundle.js"></script> 

<?php
include("indJsFile.js");
?>
<body>
<!--<p align= "right"<p style="color:red;text-align:right;font-size:20px">Branch Code:<?php echo $brCode;?></p>--->
<div class="container">
 
     <div class="wrapper"><div style="text-align:center;font-size:2vw;background-color:green;color:white;width:100%;height:48px;padding-top:7px;margin-bottom:10px">CIB ONLINE INQUIRY FORM</div>
		

<!-- form start -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="individual" method="post" name= "form1" role="form" id="register-form" autocomplete="off" onsubmit="return validateForm()" enctype="multipart/form-data" >
		  
 <div class="body_style">
         
<section>
	<div class = "row">

	<ul id="tabsList" class="nav nav-pills" style="font-size:15px;font-weight:BOLD;background-color:#DFF0D8">
	<li class="active"><a data-toggle="tab" role="tab" href="individual.php" id="individual" name = "individual" >Individual</a></li>
	<li ><a data-toggle="tab" role="tab" href="company.php" id="company" name= "company" >Company</a></li>
	<li ><a data-toggle="tab" role="tab" href="propietorship.php" id="propietorship" name= "propietorship" >Proprietorship</a></li>
	</ul>
	<div>
</section>
	   
	   
	   
<section>
<input type='hidden' value='<?php echo $exist; ?>' name="exist"  />
<input type='hidden' value='<?php echo $trNo; ?>' name="trNo"  />
<div style="color: white;background:red;"><?php if ($msgErr != '') echo '<b>Error Message<b><br>' . $msgErr; ?></div>
<div class="row">

	<div class="form-group col-lg-3" style="padding-top:15px;">
      <label class="required" for="LoanType">Loan Type</label>

			<select class="form-control" id="LoanType" name='LoanType'>
				<option selected value="">Select Loan Type</option>
				<option value="New" <?php if ($LoanType == "New") echo 'selected="selected"'; ?> >New</option>
				<option value="Renewal" <?php if ($LoanType == "Renewal") echo 'selected="selected"'; ?>>Renewal</option>
				<option value="Enhancement" <?php if ($LoanType == "Enhancement") echo 'selected="selected"'; ?>>Enhancement</option>
				<option value="Others" <?php if ($LoanType == "Others") echo 'selected="selected"'; ?>>Others</option>
	      </select>
		  
 
	 </div>
	 
	 <div class="form-group col-lg-6" style="padding-top:15px;"onchange="return fileValidation44 ()"  >
	
	  <label class="required" for="indiviCompnyInfo" id="indiviCompnyInfo" style="padding-bottom:2px;" value="Borrower" >Individual's Information</label><br>
        
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

	<div class="form-group col-lg-3"  style="padding-top:15px;" > 
		<div class="form-group">
		  <label for="FinTypeID">FI Subject Code</label>
		  <input type="text" name="FISubCode" id="FISubCode"maxlength="16" class="form-control" value="<?php echo $FISubCode;?>"   />
	
		</div>
			
	</div>

	 </div>	
	
<div class="row">	

		
		<div class="form-group col-lg-5"  style="padding-top:15px;" > 
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
					<option value="Other installment contract"<?php if ($FinTypeID == "Other installment contract") echo 'selected="selected"'; ?>>Other installment contract</option>
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
		
		
		<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="required" for="TotalReqAmt">Total Requested Amount</label>
			  <input type="number" name="TotalReqAmt" id="TotalReqAmt" class="form-control" value="<?php echo $TotalReqAmt; ?>"  onkeydown="javascript: return event.keyCode == 69 ? false : true"/>
			</div>
        </div>
	
		<div class="form-group col-lg-4" style="padding-top:15px;">     
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

	</div>

</section>

<section>

<div class="row" style="background-color:#dbf3ef ;">
		
		<div id="ICD" class="panel panel-default" >
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Installment Contract Data</span>
		
		</div>

		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="InstallmentNo">Number of Installment</label>
			  <input type="number" name="InstallmentNo" id="InstallmentNo" class="form-control" value="<?php echo $InstallmentNo; ?>" onkeydown="javascript: return event.keyCode == 69 ? false : true"/>
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
			  <input type="number" name="InstallmentAmt" id="InstallmentAmt" class="form-control"  value="<?php echo $InstallmentAmt; ?>" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
			</div>
        </div>
		
		<div class="form-group col-lg-4"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label  for="PerodicityPayment">Periodicity of Payment (In Months)</label>
			  <input type="number" name="PerodicityPayment" id="PerodicityPayment"class="form-control"  value="<?php echo $PerodicityPayment; ?>" onkeydown="javascript: return event.keyCode == 69 ? false : true" />
			</div>
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

 <div class="row" style="background-color:#f1fdef;">
		
<div class="panel panel-default" style="background-color:#f0f5f5;"  >
		<div class="panel-heading" style="background-color:#239b56;"> <span style="color: white; font-size:16px;">Individual Subject Data</span>
		
		</div>
<div class = "row" style="margin-left:5px;margin-right:5px">
	<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="Title">Title of the Name</label>
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
			  <label class="required" for="NID">NID/SmartCard</label>
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
			<label class ="required" for="TelephoneNumber">Telephone Number</label>
			<input type="text" name="TelephoneNumber" id="TelephoneNumber" value="<?php echo $TelephoneNumber; ?>"  class="form-control" maxlength="11"  required ="true" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
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
			  $perDistList='';
				$perDistList.='<option selected="selected" value="">Select District</option>';
				while($rwPer = mysqli_fetch_assoc($rsperDist))
				{
				$perDistList.='<option value="'.$rwPer['DistrictName'].'"';
				if(trim($BirthDistrict)==trim($rwPer['DistrictName']))
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
	
		<div class="form-group col-lg-2" style="padding-top:15px;">     

		<label class="required" for="SecType">Sector Type</label>
		
			<select class="form-control" name='SecType' id="SecType" >
				<!-- <option selected value="">---Select Sector Type---</option> -->
				<option value="Private" <?php if ($SecType == "Private") echo 'selected="selected"'; ?>>Private</option>
				<option value="Public"<?php if ($SecType == "Public") echo 'selected="selected"'; ?>>Public</option>
				
			 </select>
		<br>
		</div>
		
		<div class="form-group col-lg-5" style="padding-top:15px;">     
			  
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
				while($rwPer1 = mysqli_fetch_assoc($rsperDist1))
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
			  <input type="text" name="PrePostal" id="PrePostal" maxlength="4" value="<?php echo $PrePostal; ?>" class="form-control"  />
			</div>
        </div>
		
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="PreDistrict">District</label>
<select class="form-control" id="PreDistrict" name='PreDistrict'>
			  <?php 
			  $perDistList2='';
				$perDistList2.='<option selected="selected" value="0">Select District</option>';
				while($rwPer = mysqli_fetch_assoc($rsperDist2))
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
			  <input type="number" name="voucherAmount" id="voucherAmount" value="<?php echo $voucherAmount; ?>"class="form-control" onkeydown="javascript: return event.keyCode == 69 ? false : true"   />

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
		/*
		  $("#UploadNID").change(function() {
				$('#existfile').val("");
		});
		
		 $("#UploadMoneyReceipt").change(function() {
				$('#existfile1').val("");
		});
		
		 $("#UploadPromiseLetter").change(function() {
				$('#existfile2').val("");
		});
		
		 $("#UploadOtherDocs").change(function() {
				$('#existfile3').val("");
		});
		/**/
		  
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
			 echo '<input type="hidden" value="'.$fileName.'" name ="existfile" id ="existfile"></input>';
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
			echo '<input type="hidden" value="'.$fileName1.'" name ="existfile1" id ="existfile1"></input>';
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
			echo '<input type="hidden" value="'.$fileName2.'" name ="existfile2" id ="existfile2"></input>';
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
			echo '<input type="hidden" value="'.$fileName3.'" name ="existfile3" id ="existfile3"></input>';
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
	
		<section>
	
<p align="right">
<br><a href="individual.php" class="btn btn-warning btn-lg"> <span class="glyphicon glyphicon-step-backward"></span> Reload </a>
<span style="margin-right:8px;"> &nbsp; <button type="submit" id="save" name="save" class="btn btn-lg btn-success">Save Information<span class='glyphicon glyphicon-step-forward'></span></button> </span>

</p>

</section>
	
	
</form>

</div>
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
			   
        $('input[name="BirthDate"]').mask('00/00/0000');
		 $('input[name="IDIssueDate"]').mask('00/00/0000');
		 $('input[name="voucherDate"]').mask('00/00/0000');
      
    </script>
 
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery-1.11.2.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script src="assets/register.js"></script>


</body>
</html>
<?php
include ('templates\footer.php')
?>