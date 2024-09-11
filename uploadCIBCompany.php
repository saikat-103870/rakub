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
UNION ALL
SELECT DISTINCT i.`TrackingNo`,ind.Name,z.Zone_en,b.brNameEn,ind.Name,i.TotalReqAmt,'Individual' idd FROM inquiry i  inner JOIN  individual ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.TrackingNo=$trNo and i.status=3";

$sqlload1="SELECT DISTINCT i.`TrackingNo`,ind.SlNo,ind.Name,z.Zone_en,b.brNameEn,ind.Name,i.TotalReqAmt,'Individual' idd FROM inquiry i inner JOIN individual ind ON i.TrackingNo = ind.TrackingNo inner JOIN branch b ON i.BranchId = b.brcode inner JOIN zone z 
on b.ZoneID = z.zoneCode WHERE i.TrackingNo=$trNo and i.status=3;";
$a1="SELECT * FROM `individual` WHERE `TrackingNo` = '$trNo'";
$r = mysqli_query($conn, $a1);
$rowcount=mysqli_num_rows($r);
$rowcount1=0;
$c=1;
$res = mysqli_query($conn, $sqlload);
	
$res1 = mysqli_query($conn, $sqlload1);
if (mysqli_affected_rows($conn)>0)
	{
     	$row1 = mysqli_fetch_assoc($res1);
		$brNameEn= $row1['brNameEn'];
		$Name= $row1['Name'];
		$TrackingNo= $row1['TrackingNo'];
		$SlNo = $row1['SlNo'];
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


if (isset($_POST['UploadCIB']))
{
				$targetDir = "uploadsCIB/";
				$tmp=$_FILES["InputImg"]["tmp_name"];
				$nam=$_FILES["InputImg"]["name"];
				$fileName1 = $_FILES['UploadCIB']['name'];
				$file_tmp1 = $_FILES['UploadCIB']['tmp_name'];
				$dir="uploadsCIB/".$fileName1;
				$ext1 = pathinfo($fileName1, PATHINFO_EXTENSION);
				move_uploaded_file($file_tmp1,$dir);
				
				

				$trN=$_POST['trNo'];
				$SlNo=$_POST['SlNo'];
				//$SlNo=$data1['SlNo'];
				//$trNo='';
				//echo '<br><br><br><br><br><br><br><br>dfdfdf'.$SlNo; exit;
				$sql = "update company set UploadCibReport='$fileName1' where company.TrackingNo='$trN';
				update inquiry set status=4 where inquiry.TrackingNo='$trN';" ;
				$a1="SELECT * FROM `individual` WHERE `TrackingNo` = '$trN'";
				$r = mysqli_query($conn, $a1);
				$rowcount=mysqli_num_rows($r);
				$rowcount1=0;
				
			while($rowcount1<$rowcount){
					
			while($data1 = mysqli_fetch_array($r))
			{
				$SlNo=$data1['SlNo'];
				$fileNo='UploadCIBInd'.$data1['SlNo'];
				$targetDir = "uploadsCIB/";
				$tmp=$_FILES["InputImg"]["tmp_name"];
				$nam=$_FILES["InputImg"]["name"];
				$fileName2 = $_FILES[$fileNo]['name'];
				$total_count = count($_FILES['UploadCIBInd']['name']);
			
				$file_tmp2 = $_FILES[$fileNo]['tmp_name'];
				$dir="uploadsCIB/".$fileName2;
				$ext1 = pathinfo($fileName2, PATHINFO_EXTENSION);
				move_uploaded_file($file_tmp2,$dir);
	//echo '<br><br><br><br><br><br><br>sl-';
	//echo '<br><br>';echo $SlNo;
	//echo $fileName2;
	
			
			$sql .= "update individual set UploadCibReport='$fileName2' where individual.SlNo='$SlNo';";
			//echo '<br><br><br><br>';
			$fileName2='';
			//echo $sql;
			}			

			$rowcount1++;
				}
//exit();
			
if (mysqli_multi_query($conn, $sql))
			{
			//echo '<br><br><br><br>saikat';
			//echo $sql;exit();
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
 
     <div class="wrapper"><div style="text-align:center;font-size:2vw;background-color:green;color:white;width:100%;height:48px;padding-top:7px;margin-bottom:10px">Upload CIB Reports</div>
		

         <!-- form start -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="individual" method="post" name= "form1" role="form" id="register-form" autocomplete="off" onsubmit="return validateForm()" enctype="multipart/form-data" >
		  
 <div class="body_style">






		
<section>

		<input type='hidden' value='<?php echo $trNo; ?>' name="trNo"  />

	<p style="color:blue;text-align:right;margin-right:700px;font-size:20px">Branch Name:  <?php echo $brNameEn; ?></p>
	<p style="color:green;text-align:right;margin-right:700px;font-size:20px;">Customer Name:  <?php echo $Name; ?> </p>
	<p style="color:#000080;text-align:right;margin-right:700px;font-size:20px;">Tracking No: <?php echo $TrackingNo; ?></p><br>
		<h2 style="color:blue;">Upload CIB: </h2>
		<h4 style="color:blue;">Upload CIB for Company: </h2>
		<input type="file" name="UploadCIB" id="UploadCIB" onchange="return fileValidation()" class="form-control-control-sm" />
<?php
		
	while($rowcount1<$rowcount){
		while($data1 = mysqli_fetch_array($r)){

		?>
		<h4 style="color:blue;">Upload CIB for Owner: <?php echo $c++;?> </h4>
		<input type="file" name="UploadCIBInd<?php echo $data1['SlNo']; ?>" id="UploadCIBInd"  class="form-control-control-sm" multiple />
		<input type='hidden' value='<?php echo $data1['SlNo']; ?>' name="SlNo"  />
	

<?php
		}
$rowcount1++;
}
?>
		
				
				
		
<p><br><br><br><br><br>
<span style="margin-left:400px;">  <button type="submit" id="UploadCIB" name="UploadCIB" class=" btn-success">Upload CIB <span class='glyphicon glyphicon-step-forward'></span></button> </span>

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
include ('templates\footer.php')
?>