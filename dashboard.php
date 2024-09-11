<?php
ob_start();
include ('header.php');
include 'config.php';
session_start();
if (isset($_SESSION['empid']))
{
    $EntryUserId = $_SESSION['empid'];
    $brCode = $_SESSION['brCode'];
	$OifficeLevel = $_SESSION['OifficeLevel'];
	if($OifficeLevel!=6)
	{
		header("Location:home.php");
		exit;
	}
	
    
}
else
{
    header("Location:login.php");
    exit;
}

if(isset($_GET['gtrNo']))	{
	
		$trNo1 = $_GET['gtrNo'];
	
		$sendZM = "update inquiry set status=2 where TrackingNo=$trNo1";
	
	if (mysqli_multi_query($conn, $sendZM))
        {
			echo '<center>';
			echo '<h2><br><br><br><br><span style="color: green;">Successfully Send Back to Zonal Manager.</span></h2>';
			//echo "<a class='btn btn-default btn-lg blue' href='individual.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Edit</a><br><br>";
			//echo '</center>';
			echo '<center>';
			echo "<a class='btn btn-default btn-lg blue' href='home.php'><span class='glyphicon glyphicon-edit'></span> Back</a><br><br>";
			echo '</center>';
			exit;
        }
	else
		{
			echo "Error: " . mysqli_error($conn);
		}
		
		
}


?>


<head>
<br><br>
	<title>Head Office Dashboard</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='css/fonts_googleapis_com.css' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/dataTables.bootstrap4.min_1.12.1.css">
 <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js_1.12.1.js"></script>
    <script src="js/dataTables.bootstrap4.min_1.12.1.js"></script>
 
 <style>


a.btn:hover {
     -webkit-transform: scale(1.1);
     -moz-transform: scale(1.1);
     -o-transform: scale(1.1);
 }
 a.btn {
     -webkit-transform: scale(0.8);
     -moz-transform: scale(0.8);
     -o-transform: scale(0.8);
     -webkit-transition-duration: 0.5s;
     -moz-transition-duration: 0.5s;
     -o-transition-duration: 0.5s;
 }




</style> 
</head>

<body >
<div style="min-height: 420px;"><br>
<h1 style="text-align: center;font-color:red;  color: green;">CIB Inquiry Reports</h1> 

<br>	
<div class="container">
<table id="example" class="table table-striped table-bordered" style="width:20%;margin-left:-100px;font-size:15px;">


  <thead style="background-color: #009879; color:white">
  <tr>
  
    <th>SL No.</th>
    <th>Zone</th>
    <th>Branch Name</th>
	<th>Customer Name</th>
	<th>Amount</th>
	<th>TrackingNo</th>
	<th>Individual / Company / Proprietorship </th>
	<th>Received By</th>
	<th>View Form</th>
	<th>Download Docs.</th>
	<th>Upload CIB Report</th>
	<th>Unlock</th>
	<th>Receive</th>
	
	
  </tr>
  </thead>
<?php 
	

/*$sqlload="SELECT DISTINCT i.`TrackingNo`,z.Zone_en,b.brNameEn,ind.TradeName Name,i.TotalReqAmt,'Company' idd FROM inquiry i  inner JOIN  company ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode where i.status=3 
uNION ALL
SELECT DISTINCT i.`TrackingNo`,z.Zone_en,b.brNameEn,ind.Name,i.TotalReqAmt,'Individual' idd FROM inquiry i  inner JOIN  individual ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.status=3
uNION ALL
SELECT DISTINCT i.`TrackingNo`,z.Zone_en,b.brNameEn,ind.TradeName,i.TotalReqAmt,'propietorship' idd FROM inquiry i  inner JOIN  propietorship ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.status=3";
$counter = 0;	
$res = mysqli_query($conn, $sqlload);*/
	
//echo $searchTrackingNo;exit();
$sqlload="SELECT  i.TrackingNo,i.FormNo, i.FinTypeID,i.TotalReqAmt,
CASE
WHEN i.FormNo=1 THEN (SELECT concat(`Title`,' ',`Name`) as Name FROM `individual` WHERE `TrackingNo`=i.TrackingNo limit 1) 
WHEN i.FormNo=2 THEN (SELECT concat(`Title`,' ',`TradeName`) as Name FROM company  WHERE `TrackingNo`=i.TrackingNo limit 1)
WHEN i.FormNo=3 THEN (SELECT concat(`Title`,' ',`Name`) as Name FROM `propietorship` WHERE `TrackingNo`=i.TrackingNo limit 1)
END as Name,b.brNameEn,z.Zone_en,i.Received_status,i.Received_by
FROM `inquiry` i inner join branch b on i.BranchId=b.brcode inner join zone z on b.ZoneID=z.zoneCode where  i.status=3  GROUP BY (TrackingNo) HAVING COUNT(TrackingNo)>1;";
$res = mysqli_query($conn, $sqlload);
//echo "<br><br><br><br><br><br>";
//echo $sqlload;
//exit();
$counter = 0;	
	?>
	
	<tbody style="background-color:#d8f3e5;">
<?php
while($data = mysqli_fetch_array($res))
{
		
	//$form=$data['FormNo'];//
	?>
	

<tr>
  
    <td><?php echo ++$counter;  ?></td>
    <td><?php echo $data['Zone_en']; ?></td>
    <td><?php echo $data['brNameEn']; ?></td>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['TotalReqAmt']; ?></td>
    <td><?php echo $data['TrackingNo']; ?></td>
    <td><?php if ($data['FormNo']==1)
	{
		echo "Individual";
	} 
		if ($data['FormNo']==2)
	{
		echo "Company";
	} 
		if ($data['FormNo']==3)
	{
		echo "Proprietorship";
	} 
	


	?>
	
	</td>
	 <td><?php echo $data['Received_by']; ?></td>
	
<td> 
<?php
if ($data['Received_by']==$EntryUserId){
?>
<a class="btn btn-info a-btn-slide-text" href="viewCiBInqueryHO.php?gtrNo=<?php echo $data['TrackingNo'];?>&type=<?php  if ($data['FormNo']==1){echo "Individual";}	else if ($data['FormNo']==2){echo "Company";}else if ($data['FormNo']==3){echo "propietorship";}?>">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
        <span><strong>View</strong></span>            
    </a>
 
<td>
<?php
}
else{?><td></td>
<?php
}
if ($data['Received_by']==$EntryUserId){
?>
	<a class="btn btn-primary a-btn-slide-text" href="downloadFormat.php?trNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-download-alt"></span>
        <span><strong>Download</strong></span>            
    </a>
	</td>
	<?php 
}
else {
	?><td></td>
	<?php
}

 if ($data['FormNo']==1)

	{
			 if ($data['Received_by']==$EntryUserId){
	?>
	<td>	<a class="btn btn-success a-btn-slide-text" href="uploadCIB.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-upload"></span>
        <span><strong>Upload</strong></span>            
    </a>
	</td>
	<?php
	}
	else{?> <td></td>
	<?php
	}
}
else{}
 if ($data['FormNo']==2)
	{
if ($data['Received_by']==$EntryUserId){
	{
	?>
	<td>	<a class="btn btn-success a-btn-slide-text" href="uploadCIBCompany.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-upload"></span>
        <span><strong>Upload</strong></span>            
    </a>
	</td>
	<?php
	}
	}
	else{?><td></td> <?php
	}
	}

	?>
	<?php 
	
	 if ($data['FormNo']==3)
	{
if ($data['Received_by']==$EntryUserId){	?>
	<td>	<a class="btn btn-success a-btn-slide-text" href="uploadCIB.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-upload"></span>
        <span><strong>Upload</strong></span>            
    </a>
	</td>
	<?php
	}
	
	else{?> <td></td>
	<?php
	}
	}
	if ($data['Received_by']==$EntryUserId){
	?>
		<td>	<a class="btn btn-danger a-btn-slide-text" href="dashboard.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-lock"></span>
        <span><strong>Unlock</strong></span>            
    </a>
	</td>
<?php 
	}
	 if ($data['Received_status']=='')
	{
	?>
  	<td>	<a class="btn btn-primary a-btn-slide-text" id="receiveHO"name="receiveHO" href="receive.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-glass"></span>
        <span><strong>Receive</strong></span>            
    </a>
	</td>
	<?php
	}		
else {
	?>
	<td>	
        <span  style="color: #000080"><p style= "font-size:15px;font-weight: bold;">Already Received</p></span>            
    </a>
	</td>

	<?php
}	
	?>
	
	
<?php
		
		
}
	



?>

	</td>
   
    
    
  </tr>	
  </tbody>
</table>

</div>

</div>
	



</body>
	<script>
$(document).ready(function () {
    $('#example').DataTable();
});
</script>
</body>
<br><br><br><br><br>
<br><br><br><br><br>
<br><br><br><br><br>
<br><br><br><br><br>
</html>
<?php include 'templates/footer.php';?>