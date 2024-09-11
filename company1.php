<?php
ob_start();
session_start();
include('header.php');

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

?>
<!DOCTYPE html>
<br><br><br>
<html>

<head>
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
</style>
</head>

<body>

	<div class="container">

    <div class="wrapper"<h3><div style="text-align:center;font-size:20px;background-color:green;color:white;width:1081px;height:48px;padding-top:7px;margin-bottom:10px">CIB ONLINE INQUIRY FORM-2</div></h3>
		
    			 
			 

         <!-- form start -->
         <form action="insert1.php" method="post" role="form" id="register-form" autocomplete="off">
		 
         <div class="body_style">
         
    <section>
	   			  <ul id="tabsList" class="nav nav-pills" style="font-size:15px;font-weight:BOLD; background-color:#DFF0D8">
    <li ><a data-toggle="tab" role="tab" href="individual.php" id="individual" >Individual</a></li>
    <li class="active"><a data-toggle="tab" role="tab" href="company.php" id="company">Company</a></li>
	    <!--<li><a data-toggle="tab" href="#rewardPunish" id="rdp"> Reward & Punishment</a></li>
		-->
  </ul>
	   </section>
	


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
          <label for="indiviCompnyInfo">Institution's Information</label><br>
  
    <label class="radio-inline"style="width:100px">
      <input type="radio"id="indiviCompnyInfo" name="indiviCompnyInfo" value="Borrower" style="width:25%">Borrower
    </label>
    <label class="radio-inline"style="width:100px">
    <input type="radio"id="indiviCompnyInfo" name="indiviCompnyInfo" value="Co-Borrower" style="width:25%">Co-borrower
    </label>
    <label class="radio-inline" style="width:100px">
     <input type="radio" id="indiviCompnyInfo" name="indiviCompnyInfo"value="Gurantor"  style="width:25%">Gurantor
    </label>
	 <label class="radio-inline" style="width:100px">
    <input type="radio"id="indiviCompnyInfo" name="indiviCompnyInfo" value="Owner"  style="width:25%">Owner
    </label>
  <br><br>
	   </div>
	   

		<div class="form-group col-lg-4"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="FinTypeID">Type of Financing</label>
			  <input type="text" name="FinTypeID" id="FinTypeID"class="form-control"required="true"  />
		
        </div>
				
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="required" for="TotalReqAmt">Total Requested Amount/Credit Limit</label>
			  <input type="number" name="TotalReqAmt" id="TotalReqAmt" class="form-control"onkeydown="javascript: return event.keyCode == 69 ? false : true" required="true" />
			</div>
        </div>

<div class="form-group col-lg-4" style="padding-top:15px;"> 
			<div class="form-group">
			  <label class="required" for="TotalReqAmt">FISubCode</label>
			  <input type="number" name="TotalReqAmt" id="TotalReqAmt" class="form-control" />
			</div>
        </div>
		
		
	</div>

	<section>
	     <div class="row" style="background-color: #dbf3ef ;">
		
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Installment Contract Data</span>
		
		</div>

		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="InstallmentNo">Number of Installment</label>
			  <input type="number" name="InstallmentNo" id="InstallmentNo"onkeydown="javascript: return event.keyCode == 69 ? false : true" class="form-control" />
			 </div>
		</div>
		<div class="form-group col-lg-4" style="padding-top:15px;"> 
			<div class="form-group">
			  <label  for="InstallmentAmt">Installment Amount</label>
			  <input type="number" name="InstallmentAmt" id="InstallmentAmt" onkeydown="javascript: return event.keyCode == 69 ? false : true" class="form-control" />
			</div>
        </div>
	<div class="form-group col-lg-4"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label  for="PerodicityPayment">Periodicity of Payment (In Months)</label>
			  <input type="number" name="PerodicityPayment" id="PerodicityPayment" onkeydown="javascript: return event.keyCode == 69 ? false : true" class="form-control"  />
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
	 <div class="form-group col-lg-2" style="padding-top:15px;">
      <label for="InstitutionType">Institution Type</label>
      <select class="form-control" id="InstitutionType" name='InstitutionType'>
	  	     <option selected value="">Select Institution Type</option>
		<option value="Proprietorship">Proprietorship</option>
		<option value="Partnership">Partnership</option>
		<option value="Company">Company</option>
		<option value="Others">Others</option>
	      </select>
	   </div>
	
			<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="Title">Trade Name Title</label>
			  <input type="text" name="Title" id="Title"value="" class="form-control"required="true" />
			 </div>
		</div>
			<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="	TradeName">Trade Name</label>
			  <input type="text" name="TradeName" id="TradeName"value="" class="form-control"required="true" />
			 </div>
		</div>
	 <div class="form-group col-lg-4" style="padding-top:15px;">
      <label class="required"  for="LegalForm">Legal form</label>
      <select class="form-control" id="LegalForm" name='LegalForm' required="true">
	  	     <option selected value="">---Select Legal Form---</option>
		<option value="Proprietorship">Proprietorship</option>
		<option value="Partnership">Partnership</option>
		<option value="pvtltdco">Pvt.Ltd.Co.</option>
		<option value="publicltdco">Public.Ltd.Co.</option>
		<option value="cooperative">Co-operative</option>
		<option value="publicsector">Public Sector</option>
		<option value="multinationalorganization">Multinational Organization</option>
		<option value="ngo">NGO</option>
		<option value="trusteeorganization">Trustee Organization</option>
		<option value="Others">Others</option>
	      </select>
		  <br>
	   </div>
					<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="Etin">ETIN</label>
			  <input type="text" name="Etin" id="Etin"value="" maxlength="9" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"class="form-control" />
			 </div>
		</div>
	
	   
						<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="RJSCRegNo">RJSC Registration Number(If available)</label>
			  <input type="text" name="RJSCRegNo" id="RJSCRegNo"value="" class="form-control" />
			 </div><br>
		</div>
			<div class="form-group 	col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="RegDate">Registration Date in format(yyyy/mm/dd)</label>
			  <input type="text" name="RegDate" id="RegDate"value="" class="form-control" />
			 </div><br>
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
			  <input type="text" name="BusStreet" id="BusStreet" class="form-control"required="true" />
			</div>
        </div>
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required"  for="BusPostal">Postal Code</label>
			  <input type="number" name="BusPostal" id="BusPostal"class="form-control" onkeydown="javascript: return event.keyCode == 69 ? false : true" required="true" />
			</div>
        </div>
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label class="required" for="BusDistrict">District</label>
			  <input type="text" name="BusDistrict" id="BusDistrict"value="" class="form-control" required="true" />
			 </div>
		</div>
			
		
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="BusCountry">Country</label>
			  <input type="text" name="BusCountry" id="BusCountry"class="form-control" required="true" />
			</div>
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
			  <input type="text" name="FacStreet" id="FacStreet" class="form-control" />
			</div>
        </div>
		
		<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label  for="FacPostal">Postal Code</label>
			  <input type="number" name="FacPostal" id="FacPostal" onkeydown="javascript: return event.keyCode == 69 ? false : true" class="form-control"  />
			</div>
        </div>
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="FacDistrict">District</label>
			  <input type="text" name="FacDistrict" id="FacDistrict"value="" class="form-control"/>
			 </div>
		</div>
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label for="FacCountry">Country</label>
			  <input type="text" name="FacCountry" id="FacCountry"class="form-control"/>
			</div>
        </div>
		
		</div>
		</section>
		<section>	
     <div class="row" style="background-color:#dbf3ef">
		
	
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="TelephoneNumber">Telephone Number</label>
			  <input type="text" name="TelephoneNumber" id="TelephoneNumber" value=""maxlength="15" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')" class="form-control" />
			 </div>
		</div>
						<div class="form-group col-lg-4" style="padding-top:15px;">     
			  
			  <label class="required" for="SecType">Sector Type</label>
			  <select class="form-control" id="SecType" name='SecType'required="true">
			  	     <option selected value="">---Select Sector Type---</option>

		<option value="Public">Public</option>
		<option value="Private">Private</option>
      </select>
			<br>
		</div>
			<div class="form-group col-lg-4" style="padding-top:15px;">     
			  
			  <label class="required" for="SecCode">Sector Code</label>
		 <input type="text" name="SecCode" id="SecCode" value="" class="form-control" required="true"/>
		
		</div>
		
		 
		</div>
		      <div class="footer_style">
                 <button type="submit" class="btn btn-success" style="border:1px solid #980be4;float: right">
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
include('templates\footer.php')
?>