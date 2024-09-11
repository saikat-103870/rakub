<?php
ob_start();
session_start();
include ('header.php');
include ('config.php');
ini_set('display_errors', 'off');

if(isset($_GET['gtrNo']))
{
	$trNo=$_GET['gtrNo'];
	
	//echo '<br><br><br><br><br><br><br><br><br><br>loanfddfdsf type '.$trNo;

	$exist=1;
	
	$sqlload="SELECT DISTINCT i.`TrackingNo`,ind.TradeName,z.Zone_en,b.brNameEn,ind.TradeName Name,i.TotalReqAmt,'Company' idd FROM inquiry i  inner JOIN  company ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode where i.TrackingNo=$trNo and i.status=3
uNION ALL
SELECT DISTINCT i.`TrackingNo`,ind.Name,z.Zone_en,b.brNameEn,ind.Name,i.TotalReqAmt,'Individual' idd FROM inquiry i  inner JOIN  individual ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.TrackingNo=$trNo and i.status=3
uNION ALL
SELECT DISTINCT i.`TrackingNo`,ind.Name,z.Zone_en,b.brNameEn,ind.Name,i.TotalReqAmt,'Individual' idd FROM inquiry i  inner JOIN  propietorship ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.TrackingNo=$trNo and i.status=3";
	
	$res = mysqli_query($conn, $sqlload);

	if (mysqli_affected_rows($conn)>0)
	{
     	$row = mysqli_fetch_assoc($res);
		
		$LoanType = $row['loanType'];
		$status = $row['status'];
		$brNameEn = $row['brNameEn'];
		$indiviCompnyInfo = $row['indiviCompnyInfo'];
		$TrackingNo = $row['TrackingNo'];
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

}
else
{
    header("Location:login.php");
    exit;
}
			
}
//echo '<br><br><br><br><br><br><br><br>dfdfdf'.$trNo; exit;
$random=rand();
if (isset($_POST['UploadCIB']))
{
		$targetDir = "uploadsCIB/";
			$tmp=$_FILES["InputImg"]["tmp_name"];
			$nam=$_FILES["InputImg"]["name"];
			$fileName1 = $random.$_FILES['UploadCIB']['name'];
			$file_tmp1 = $_FILES['UploadCIB']['tmp_name'];
			$dir="uploadsCIB/".$fileName1;
			$ext1 = pathinfo($fileName1, PATHINFO_EXTENSION);
		
			move_uploaded_file($file_tmp1,$dir);

	$trN=$_POST['trNo'];
	//$trNo='';
	//echo '<br><br><br><br><br><br><br><br>dfdfdf'.$trNo; exit;
	$sql = "UPDATE `inquiry` SET `status`=4,UploadCibReport=1,cibuploadDateTime=CURRENT_TIMESTAMP,reportuploadUserId='$EntryUserId',docsUploaded='$fileName1' where `TrackingNo`='$trN'";
	//echo '<br><br><br><br>';
	//echo $sql;exit();

if (mysqli_multi_query($conn, $sql))
        {
			echo '<center>';
			echo '<h2><br><br><br><br><span style="color: green;">Successfully uploaded CIB Report.</span></h2>';
			echo "<a class='btn btn-default btn-lg blue' href='home.php'><span class='glyphicon glyphicon-edit'></span> Back</a><br><br>";
			echo '</center>';
			//echo '<center>';
			//echo "<a class='btn btn-default btn-lg blue' href='generate_pdf/genPdfIndividual.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Generate PDF</a><br><br>";
			//echo '</center>';
			exit;
        }
	else
		{
			echo "Error: " . mysqli_error($conn);
		}


}



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


</head>

<body>

<div class="container">
 
     <div class="wrapper"><div style="text-align:center;font-size:2vw;background-color:green;color:white;width:100%;height:48px;padding-top:7px;margin-bottom:10px">Upload CIB Report</div>
		

         <!-- form start -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="individual" method="post" name= "form1" role="form" id="register-form" autocomplete="off" onsubmit="return validateForm()" enctype="multipart/form-data" >
		  
 <div class="body_style">






		
<section>

		<input type='hidden' value='<?php echo $trNo; ?>' name="trNo"  />

	<p style="color:blue;text-align:right;margin-right:700px;font-size:20px">Branch Name:  <?php echo $brNameEn; ?></p>
	<p style="color:green;text-align:right;margin-right:700px;font-size:20px;">Customer Name:  <?php echo $Name; ?> </p>
	<p style="color:#000080;text-align:right;margin-right:700px;font-size:20px;">Tracking No: <?php echo $TrackingNo; ?></p><br>
		
		
				<div class="form-group col-lg-3" style="padding-top:15px;margin-left:200px"> 
						<div class="form-group">
							<label  for="Other Documents(3)">Upload CIB</label>
							<input type="file" name="UploadCIB" id="UploadCIB" onchange="return fileValidation()" class="form-control-control-sm" />
						</div>
				</div>
				
		
<p><br><br><br><br><br>
<span style="margin-left:-250px;">  <button type="submit" id="UploadCIB" name="UploadCIB" class=" btn-success">Upload CIB <span class='glyphicon glyphicon-step-forward'></span></button> </span>

</p>

		</section>
		

	
	
	
</form>

</div>
</div>
    </div>           
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/jquery-1.11.2.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script src="assets/register.js"></script>
	

</body>
<script>
        function fileValidation() {
            var fileInput = 
                document.getElementById('UploadCIB');
              
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
                            'UploadCIB').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>
</html>
<?php
include ('templates\footer1.php')
?>