<?php
ob_start();
session_start();
include ('header.php');
include ('config.php');
ini_set('display_errors', 'off');



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
$BirthDate = '';
$fileName = '';
$UploadNID=null;
$UploadMoneyReceipt = null;
$UploadPromiseLetter = null;
$UploadOtherDocs = null;
if(isset($_GET['gtrNo']))
{
	$trNo=$_GET['gtrNo'];
	
	//echo '<br><br><br><br><br><br><br><br><br><br>loanfddfdsf type '.$trNo;

	$exist=1;
	
	$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN individual c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo";
	
	
	
	$res = mysqli_query($conn, $sqlload);

	if (mysqli_affected_rows($conn)>0)
	{
     	$row = mysqli_fetch_assoc($res);
		
		$LoanType = $row['loanType'];
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
		$IDNumber = $row['IDNumber'];
		$IDIssueDate = $row['IDIssueDate'];
		$IDIssueCountry = $row['IDIssueCountry'];
		$BirthDate = $row['BirthDate'];
		$fileName = $row['UploadNID'];
		$UploadMoneyReceipt = $row['UploadMoneyReceipt'];
		$UploadPromiseLetter = $row['UploadPromiseLetter'];
		$UploadOtherDocs = $row['UploadOtherDocs'];
	
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
    $IDIssueDate = date("Y-m-d",strtotime(str_replace('/', '-', $_POST["IDIssueDate"])));
    $IDIssueCountry = $_POST['IDIssueCountry'];
    $SecType = $_POST['SecType'];
    $SecCode = $_POST['SecCode'];
    $TelephoneNumber = $_POST['TelephoneNumber'];
    $fileName = $_POST['UploadNID'];
    $UploadMoneyReceipt = $_POST['UploadMoneyReceipt'];
    $UploadPromiseLetter = $_POST['UploadPromiseLetter'];
    $UploadOtherDocs = $_POST['UploadOtherDocs'];
	$exist=$_POST['exist'];



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
    
	if(!empty($NID))
	{
		$n = strlen($NID);
		if (!($n == 10 || $n == 13 || $n == 17))
		{
			$msgErr .= "NID must be 10 13 or 17 characters<br>";
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
			$extension = array("pdf");
		//image upload NID
			$targetDir = "uploads/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName = $_FILES['UploadNID']['name'];
			$file_tmp = $_FILES['UploadNID']['tmp_name'];
			$dir="uploads/".$fileName;
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
		//echo "<br><br><br><br><br><br><br><br><br><br>";		
		//echo $ext;
		//exit();
	if(in_array($ext, $extension) == False)
		{
        $msgErr .= "For NID,Extension pdf allowed only<br>";
		}
			//echo '<br><br><br><br><br><br><br><br><br><br>loan type fileName'.$fileName.'<br><br><br> $extension:     '.$extension; exit;
		move_uploaded_file($file_tmp,$dir);



     //image upload Money receipt
			$targetDir = "uploads/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName1 = $_FILES['UploadMoneyReceipt']['name'];
			$file_tmp1 = $_FILES['UploadMoneyReceipt']['tmp_name'];
			$dir="uploads/".$fileName1;
			$ext1 = pathinfo($fileName1, PATHINFO_EXTENSION);
			if(in_array($ext1, $extension) == False)
		{
				$msgErr .= "For Money Receipt,Extension pdf allowed only<br>";
		}
	
	 //$check = getimagesize($_FILES["UploadNid"]["tmp_name"]);
	//image upload Promise Letter
			$targetDir = "uploads/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName2 = $_FILES['UploadPromiseLetter']['name'];
			$file_tmp2 = $_FILES['UploadPromiseLetter']['tmp_name'];
			$dir="uploads/".$fileName2;
			$extension2 = pathinfo($fileName2, PATHINFO_EXTENSION);
		
			
			//image upload Other Documents
			$targetDir = "uploads/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName3 = $_FILES['UploadOtherDocs']['name'];
			$file_tmp3 = $_FILES['UploadOtherDocs']['tmp_name'];
			$dir="uploads/".$fileName3;
			$extension3 = pathinfo($fileName3, PATHINFO_EXTENSION);
		
		/*echo "<br><br><br><br><br>";
		echo $extension;
		echo "<br><br><br><br><br>";
		echo $extension1;
		echo "<br><br><br><br><br>";
		echo $extension2;
		echo "<br><br><br><br><br>";
		echo $extension3;
		exit();*/
		
    if ($msgErr == '')
    {

	
		if($exist=='0')
		{
		$trNo = $brCode . date("ymdis") . rand(1, 99);
		
		
        $sql = "INSERT INTO `inquiry` (`TrackingNo`, `FormNo`, `indiviCompnyInfo`, `loanType`, `BankName`, `FICode`,
				`BranchId`, `FISubCode`, `CIBCode`, `FinTypeID`, `TotalReqAmt`, `InstallmentNo`, `InstallmentAmt`, `PerodicityPayment`, 
				`entryDate`, `entryUserId`, `authorizedUserId`, `authorizedDateTime`, `remarks`, `status`, `UploadCibReport`, `cibuploadDateTime`,
				`reportuploadUserId`, `docsUploaded`) VALUES ($trNo,'1','$indiviCompnyInfo','$LoanType','RAKUB','033','$brCode','$FISubCode','','$FinTypeID','$TotalReqAmt',
				'$InstallmentNo','$InstallmentAmt','$PerodicityPayment',CURRENT_TIMESTAMP,'$EntryUserId','','','','','','','','');
				
				INSERT INTO individual (`TrackingNo`,`Role`,`Title`,`Name`,FatherTitle,FatherName,`MotherTitle`,`MotherName`,`SpouseTitle`,`SpouseName`,NID,`Etin`,`BirthDate`,`Gender`,`BirthDistrict`,
				`BirthCountry`,`PerStreet`,`PerPostal`,`PerDistrict`,`PerCountry`,
				`PreStreet`,`PrePostal`,`PreDistrict`,`PreCountry`,`IDType`,
				`IDNumber`,`IDIssueDate`,`IDIssueCountry`,`SecType`,`SecCode`,`TelephoneNumber`,`UploadNID`,`UploadMoneyReceipt`,`UploadPromiseLetter`,`UploadOtherDocs`) 
				VALUES('$trNo','$Role','$Title','$Name','$FatherTitle','$FatherName',
				'$MotherTitle','$MotherName','$SpouseTitle','$SpouseName','$NID',
				'$Etin','$BirthDate','$Gender','$BirthDistrict','$BirthCountry',
				'$PerStreet','$PerPostal','$PerDistrict','$PerCountry','$PreStreet',
				'$PrePostal','$PreDistrict','$PreCountry','$IDType','$IDNumber','$IDIssueDate',
				'$IDIssueCountry','$SecType','$SecCode','$TelephoneNumber','$fileName','$fileName1','$fileName2','$fileName3')";
				 //echo '<br><br><br><br><br><br><br><br>'.$sql; exit;
				//move_uploaded_file($file_tmp,$dir);


	}
	else if($exist==1)
		{
		
		    $trNo=trim($_POST['trNo']);
			

			$sql = "update inquiry set loanType = '$LoanType',indiviCompnyInfo='$indiviCompnyInfo',FISubCode= '$FISubCode',FinTypeID='$FinTypeID',TotalReqAmt='$TotalReqAmt',
			InstallmentNo='$InstallmentNo',InstallmentAmt='$InstallmentAmt' where TrackingNo='$trNo';
			
			update individual set Title= '$Title',Name ='$Name',FatherTitle='$FatherTitle',FatherName='$FatherName',MotherTitle='$MotherTitle',
			MotherName='$MotherName',SpouseTitle='$SpouseTitle',SpouseName='$SpouseName',BirthDate='$BirthDate',NID='$NID',Etin='$Etin',
			TelephoneNumber='$TelephoneNumber',BirthDistrict='$BirthDistrict',BirthCountry='$BirthCountry',SecType='$SecType',
			SecCode='$SecCode',Gender='$Gender',PerStreet='$PerStreet',PerPostal='$PerPostal',PerDistrict='$PerDistrict',PerCountry='$PerCountry',
			PreStreet='$PreStreet',PrePostal='$PrePostal',PreDistrict='$PreDistrict',PreCountry='$PreCountry',IDType='$IDType',IDNumber='$IDNumber',
			IDIssueDate='$IDIssueDate',IDIssueCountry='$IDIssueCountry',UploadNID='$fileName',UploadMoneyReceipt='$fileName1',
			UploadPromiseLetter='$fileName2',UploadOtherDocs='$fileName3' where TrackingNo='$trNo'";
			
			//echo '<br><br><br><br><br><br><br><br>'.$sql; exit;
								//move_uploaded_file($file_tmp,$dir);

	
		}

		
	else
		{

		}

if (mysqli_multi_query($conn, $sql))
        {
				
		 
	
		
	//echo '<br><br><br><br><br><br><br><br><br><br>loanf type '.$sql;
	//echo '<br><br><br><br><br><br><br><br><br><br>loanf type '.$sql;
            echo '<center>';
            echo '<h2><br><br><br><br><span style="color: green;">Successfully Save Information.</span></h2>';
            echo "<a class='btn btn-default btn-lg blue' href='individual.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Edit</a><br><br>";
            echo '</center>';
			  echo '<center>';
            echo "<a class='btn btn-default btn-lg blue' href='generate_pdf/genPdfIndividual.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Generate PDF</a><br><br>";
            echo '</center>';
            exit;

        }

        else
        {
            echo "not inserted" . mysqli_error($conn);
        }


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

	   
 
	<script>
$(document).ready(function() {
	  
    $('#individual').validate({
        rules: {
				'FinTypeID': {
						required: true,
						minlength: 1,
					},	
				'Name': {
						required: true,
						minlength: 1,
					},
					'FatherName': {
						required: true,
						minlength: 1,
					},
						'MotherName': {
						required: true,
						minlength: 1,
					},
				'TotalReqAmt': {
						required: true,
						minlength: 1,
					},						
					
				'LoanType': {
						required: true,
						minlength: 1,
					},	
					'Gender': {
						required: true,
						minlength: 1,
					},
					'SecCode': {
						required: true,
						minlength: 1,
					},
				'BirthDate': {
						required: true,
						minlength: 1,
					},
				'BirthDistrict': {
						required: true,
						minlength: 1,
					},
				'BirthCountry': {
						required: true,
						minlength: 1,
					},	
				'SecType': {
						required: true,
						minlength: 1,
					},					
						'PerStreet': {
						required: true,
						minlength: 1,
					},
						'PerPostal': {
						required: true,
						minlength: 1,
					},
						'PerDistrict': {
						required: true,
						minlength: 1,
					},
						'PerCountry': {
						required: true,
						minlength: 1,
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
			 'LoanType': {
                required: 'Select loan type.',
            },
            'FinTypeID': {
                required: 'Fill up finance type',
            },
		  'TotalReqAmt': {
                required: 'Provide total requested amount.',
            },
		 'Name': {
                required: 'Insert full name.',
            },
		 'FatherName': {
                required: 'Insert name of father.',
            },
			'MotherName': {
                required: 'Insert name of mother',
            },
			'BirthDate': {
                required: 'Provide date of birth.',
            },
			'BirthDistrict': {
                required: 'Provide birth district',
            },
			'BirthCountry': {
                required: 'Provide birth country',
            },
			'SecType': {
                required: 'Provide sector type.',
            },
				'PerStreet': {
                required: 'Provide permanent address street name and number',
            },
				'PerPostal': {
                required: 'Provie permanent address postal code.',
            },
				'PerDistrict': {
                required: 'provide permanent address district.',
            },
				'PerCountry': {
                required: 'Provide permanent address country.',
            },
				'SecCode': {
                required: 'Provide sector code.',
            },
				'Gender': {
                required: 'Select Gender.',
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
<script>
        function fileValidation() {
            var fileInput = 
                document.getElementById('UploadNID');
              
            var filePath = fileInput.value;
          
            // Allowing file type
            var allowedExtensions = 
                    /(\.pdf)$/i;
              
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
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
                            'imagePreview').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>
<style>
  .error{
            color: red;
            background-color: #FFE4E1;
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
 
     <div class="wrapper"><div style="text-align:center;font-size:2vw;background-color:green;color:white;width:100%;height:48px;padding-top:7px;margin-bottom:10px">CIB ONLINE INQUIRY FORM-1</div>
		

         <!-- form start -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="individual" method="post" name= "form1" role="form" id="register-form" autocomplete="off" onsubmit="return validateForm()" enctype="multipart/form-data" >
		  
 <div class="body_style">
         
<section>
	<div class = "row">

	<ul id="tabsList" class="nav nav-pills" style="font-size:15px;font-weight:BOLD;background-color:#DFF0D8">
	<li class="active"><a data-toggle="tab" role="tab" href="individual.php" id="individual" name = "individual" >Individual</a></li>
	<li ><a data-toggle="tab" role="tab" href="company.php" id="company" name= "company" >Company</a></li>
	</ul>
	<div>
</section>
	   
	   
	   
<section>
<input type='hidden' value='<?php echo $exist; ?>' name="exist"  />
<input type='hidden' value='<?php echo $trNo; ?>' name="trNo"  />
<div style="color: white;background:red;"><?php if ($msgErr != '') echo '<b>Error Message<b><br>' . $msgErr; ?></div>
<div class="row">

		 <div class="form-group col-lg-6" style="padding-top:15px;">
      <label class="required" for="LoanType">Loan Type</label>

			<select class="form-control" id="LoanType" name='LoanType'>
				<option selected value="">Select Loan Type</option>
				<option value="New" <?php if ($LoanType == "New") echo 'selected="selected"'; ?> >New</option>
				<option value="Renewal" <?php if ($LoanType == "Renewal") echo 'selected="selected"'; ?>>Renewal</option>
				<option value="Enhancement" <?php if ($LoanType == "Enhancement") echo 'selected="selected"'; ?>>Enhancement</option>
				<option value="Others" <?php if ($LoanType == "Others") echo 'selected="selected"'; ?>>Others</option>
	      </select>
		  
 
	 </div>
	 
	 <div class="form-group col-lg-6" style="padding-top:15px;">
	  <label class="required" for="indiviCompnyInfo" id="indiviCompnyInfo" value="Borrower">Individual's Information</label><br>
 
		<label class="radio-inline" class="required" style="width:100px">
		<input type="radio" name="indiviCompnyInfo" id="indiviCompnyInfo" value="Borrower" <?php if ($indiviCompnyInfo == "Borrower") echo 'checked="checked"'; ?>  class="form-control" style="width:23%">  Borrower
		</label>
		<label class="radio-inline" class="required" style="width:100px">
		<input type="radio" name="indiviCompnyInfo" id="indiviCompnyInfo" value="Co-Borrower" <?php if ($indiviCompnyInfo == "Co-Borrower") echo 'checked="checked"'; ?>  class="form-control" style="width:25%"> Co-borrower
		</label>
		<label class="radio-inline" class="required" style="width:100px">
		<input type="radio"  name="indiviCompnyInfo" id="indiviCompnyInfo" value="gurantor" <?php if ($indiviCompnyInfo == "gurantor") echo 'checked="checked"'; ?>  class="form-control" style="width:25%"> Gurantor
		</label>
		<label class="radio-inline" class="required" style="width:100px">
		<input type="radio"name="indiviCompnyInfo" id="indiviCompnyInfo" value="owner" <?php if ($indiviCompnyInfo == "owner") echo 'checked="checked"'; ?> class="form-control" style="width:25%"> Owner
		</label>
   </div>

	 </div>	
	
<div class="row">	
	<div class="form-group col-lg-2"  style="padding-top:15px;" > 
		<div class="form-group">
		  <label for="FinTypeID">FI Subject Code</label>
		  <input type="text" name="FISubCode" id="FISubCode"class="form-control" value="<?php echo $FISubCode; ?>"   />
	
		</div>
	</div>
		
		<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label class="required" for="FinTypeID">Type of Financing</label>
			  <input type="text" name="FinTypeID" id="FinTypeID"class="form-control" value="<?php echo $FinTypeID; ?>"   />
		
            </div>
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
		
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Installment Contract Data</span>
		
		</div>

		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="InstallmentNo">Number of Installment</label>
			  <input type="number" name="InstallmentNo" id="InstallmentNo" class="form-control" value="<?php echo $InstallmentNo; ?>" onkeydown="javascript: return event.keyCode == 69 ? false : true"/>
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


<section>	

 <div class="row" style="background-color:#f1fdef;">
		
		<div class="panel panel-default" >
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




			 </div>
		</div>
	    
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			  <div class="form-group">
			  <label for="NID">NID</label>
			  <input type="text" name="NID" id="NID" class="form-control"  maxlength="17" value="<?php echo $NID; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  />
			 <p class="error" id="errornid"></p>
			 </div>
		</div>
	
	
	
		<div class="form-group col-lg-2" style="padding-top:15px;">     
			  <div class="form-group">
			  <label  for="Etin">ETIN</label>
			  <input type="text" name="Etin" id="Etin"  class="form-control" maxlength="9" value="<?php echo $Etin; ?>"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>
			 </div>
		</div>
		
		<div class="form-group col-lg-4" style="padding-top:15px;">     
			<div class="form-group">
			<label for="TelephoneNumber">Telephone Number</label>
			<input type="text" name="TelephoneNumber" id="TelephoneNumber" value="<?php echo $TelephoneNumber; ?>"  class="form-control" maxlength="11"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
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
			  $t='';
				$t.='<option selected="selected" value="Bangladesh">Bangladesh</option>';
				while($rsc = mysqli_fetch_assoc($rspc))
				{
				$t.='<option value="'.$rsc['country_code'].'"';
				if(trim($BirthCountry)==trim($rsc['country_code']))
				{
				$t.=" selected='selected'";
				}
				$t.='>'.$rsc['country_name'].'</option>';	
				}
				
				echo $t;
				?>
			  </select>			 </div>
		</div>	
	
		<div class="form-group col-lg-2" style="padding-top:15px;">     

		<label class="required" for="SecType">Sector Type</label>
		
			<select class="form-control" name='SecType' id="SecType" >
				<option selected value="">---Select Sector Type---</option>
				<option value="Public"<?php if ($SecType == "Public") echo 'selected="selected"'; ?>>Public</option>
				<option value="Private" <?php if ($SecType == "Private") echo 'selected="selected"'; ?>>Private</option>
			 </select>
		<br>
		</div>
		
		<div class="form-group col-lg-3" style="padding-top:15px;">     
			  
			  <label class="required" for="SecCode">Sector Code</label>
		 <input type="text" name="SecCode" id="SecCode" value="<?php echo $SecCode; ?>"  class="form-control"  />
			<br>
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
			  <input type="number" name="PerPostal" id="PerPostal" value="<?php echo $PerPostal; ?>" class="form-control"   />
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
			  <input type="number" name="PrePostal" id="PrePostal"value="<?php echo $PrePostal; ?>" class="form-control"  />
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
				while($rsc2 = mysqli_fetch_assoc($rspc2))
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
		
		<div class="panel panel-default" >
		<div class="panel-heading" style="background-color:#09937c;"> <span style="color: white; font-size:16px;">Other ID</span>

		</div>
<div class="form-group col-lg-3" style="padding-top:15px;">
      <label for="IDType">ID Type</label>

      <select class="form-control" id="IDType" name='IDType'>
	  	  			  <option selected value="0">---Select ID Type---</option>

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
		
			<div class="form-group col-lg-3"  style="padding-top:15px;" > 
			<div class="form-group">
			  <label for="IDIssueCountry">ID Issued Country</label>
<select class="form-control" id="IDIssueCountry" name='IDIssueCountry'>
			  <?php 
			  $t3='';
				$t3.='<option selected="selected" value="Bangladesh">Bangladesh</option>';
				while($rsc3 = mysqli_fetch_assoc($rspc3))
				{
				$t3.='<option value="'.$rsc3['country_code'].'"';
				if(trim($IDIssueCountry)==trim($rsc3['country_code']))
				{
				$t3.=" selected='selected'";
				}
				$t3.='>'.$rsc3['country_name'].'</option>';	
				}
				
				echo $t3;
				?>
			  </select>			</div>
        </div>
		
	</section>
	
	<section>
	  <div class="row" style="background-color:#d8eaf1 ">
		
		<div class="panel panel-default" >
		<div class="panel-heading " style="background-color:#0a709d;"> <span style="color: white; font-size:16px;">Upload Files</span>
		
		</div>
		<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label  for="UploadNID">Upload NID</label>
			  <input type="file" name="UploadNID" id="UploadNID" onchange="return fileValidation()" class="form-control-control-sm"  />
			 <p  style="color:red; font-size:12px; padding-top:5px"></p> 
		   	<p  style="color:red; font-size:12px; padding-top:5px">(Max-Size: 2MB) <?php  echo $fileName?></p> 
			</div>
						
        </div>
			<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label  for="UploadMoneyReceipt">Upload Money Receipt</label>
			  <input type="file" name="UploadMoneyReceipt" id="UploadMoneyReceipt" onchange="return fileValidation()" class="form-control-control-sm" />
					<p style="color:red; font-size:12px">(Max-Size: 2MB)</p> </div>
					
        </div>
		
		<div class="form-group col-lg-3" style="padding-top:15px;"> 
			<div class="form-group">
			  <label  for="Other Documents(3)">Upload Letter of Promise</label>
			  <input type="file" name="UploadPromiseLetter" id="UploadPromiseLetter" class="form-control-control-sm" />
			<p style="color:red; font-size:12px; padding-top:px">(Max-Size: 2MB)</p> 
			</div>
		</div>
				<div class="form-group col-lg-3" style="padding-top:15px;"> 
						<div class="form-group">
							<label  for="Other Documents(3)">3.Upload Other Documents</label>
							<input type="file" name="UploadOtherDocs" id="UploadOtherDocs" class="form-control-control-sm" />
							<p style="color:red; font-size:12px; padding-top:5px">(Max-Size: 2MB)</p> 
						</div>
				</div>
					
        </div>
		
		</section>
		<section> 
	
	</div>
	
	
<div class="form-group" style="background-color:#dbf3ef;>        
	<div class="save" style="text-align:center;"></div>
	<button type="submit" id="save" name="save" class="btn btn-success"style="border:1px solid #980be4;width: 200px;margin-left:650px;"><span class='glyphicon glyphicon-saved'></span> Save Information</button>
	<a button id="reload" type="button"href ="individual.php" name="reload" class="btn btn-info"style="border:1px solid #980be4;float:right;width:200px;">Reload Page <span class='glyphicon glyphicon-refresh'></span></button></a>
	
</div>
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
