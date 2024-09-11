<?php
ob_start();
include ('header.php');
include 'config.php';
ini_set('display_errors', 'off');

session_start();
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
if(isset ($_SESSION['offCode']))
				{
					$offCode=$_SESSION['offCode'];
					$OifficeLevel = $_SESSION['OifficeLevel'];
				
					$type = $_SESSION['type'];
					$BrCode=$_SESSION['offCode'];
					$uid=$_SESSION['uid'];					
	$tempdate="";			}
	if(isset($_POST['txtdate']))			
		$tempdate=$_POST["txtdate"];
	$tempTodate="";
	if(isset($_POST['txtTodate']))
		$tempTodate=$_POST["txtTodate"];
?>
<!DOCTYPE html>
<html>
<br>
<br>

<head>
	<title>Status Report</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='css/fonts_googleapis_com.css' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/dataTables.bootstrap4.min_1.12.1.css">
 <script src="js/jquery-3.5.1.js"></script>
    <script src="js/jquery.dataTables.min.js_1.12.1.js"></script>
    <script src="js/dataTables.bootstrap4.min_1.12.1.js"></script>
	    <script type='text/javascript'src="js/jquery.mask.js"></script>
  
      
    <script  type='text/javascript'src="js/popper.min.js"></script>
      

<script type='text/javascript' src="js/jquery.inputmask.bundle.js"></script> 
 

</head>

<body >
<div style="min-height: 420px;"><br>
<h1 style="text-align: center;font-color:red;  color: green;">Search Reports Date Range</h1> 
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			  <div class="col-xs-6 col-sm-2 col-md-2">
				From Date:
	
	<input type="text" name="txtdate" placeholder= "dd/mm/yyyy" class="form-control" id="txtdate" data-inputmask="'alias': 'date'" value=<?=$tempdate?>>
					
				</div>
				
				
				
				<div class="col-xs-6 col-sm-2 col-md-2">
				To Date (dd-mm-yyyy):
               
 <input type="text" name="txtTodate" placeholder= "dd/mm/yyyy" class="form-control" id="txtTodate" data-inputmask="'alias': 'date'" value=<?=$tempTodate?>>
					<span class="help-block"></span>				
				</div>
				
						<div class="col-xs-6 col-sm-2 col-md-2">     

							Status
							
							
							
								<select class="form-control" name='status' id="status" >
									<option selected value="all">All</option>
									<option value="0">Waiting for maker to send to Branch Manager</option>
									<option value="1">Waiting for Branch Manager Approval</option>
									<option value="2">Waiting for Zonal Office Approval</option>
									<option value="3">Waiting for CIB Report</option>
									<option value="4">CIB Reporting Completed</option>
										
								 </select>
							<br>
						</div>
				
				<div class="col-xs-6 col-sm-3 col-md-3">
					<br>
				<input type="submit" name="Submit" id="Submit" value="show report" class="btn btn-default" style="border-color: green;">
				</div>

				</form><br><br><br><br><br><br>
<?php 

if (isset($_POST['Submit'])) //here give the name of your button on which you would like    //to perform action.
{
	$status=$_POST['status'];
	if($status!='all'){
		$statusQuery = " and i.status=$status";
	}
	//date("Y-m-d",strtotime(str_replace('/', '-', $_POST["BirthDate"])))
	
	$tempdate=$_POST['txtdate'];
	$tempTodate=$_POST['txtTodate'];
	$date=date('Y-m-d', strtotime(str_replace('/', '-', $tempdate)));
	$todate=date('Y-m-d', strtotime(str_replace('/', '-', $tempTodate)));
	//echo '<br><br><br><br><br><br><br><br>dssdfsdd';
	//echo $date;
	//echo '<br><br><br><br><br><br><br><br>dssdfsdd';
	//echo $todate;
	//exit();

if($OifficeLevel==1){	
	//echo'<br><br><br><br><br><br><br>';
	//echo "shsdkjfsdhfkdsfhksdf";
	//exit();
//$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN individual c
	//on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo and i.BranchId=".$_SESSION['brCode'];
/*$sqlload = "select DISTINCT i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,individual a  where i.TrackingNo=a.TrackingNo and  i.BranchId=$brCode and i.entryDate between '$date' and '$todate'
union ALL
select DISTINCT  i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,propietorship a  where i.TrackingNo=a.TrackingNo  and i.BranchId=$brCode and i.entryDate between '$date' and  '$todate' 
union ALL
select DISTINCT  i.TrackingNo,a.TradeName,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,company a  where i.TrackingNo=a.TrackingNo  and i.BranchId=$brCode and i.entryDate between '$date' and  '$todate'";
echo'<br><br><br><br><br><br><br>';
echo $sqlload;*/
$sqlload = "SELECT  i.TrackingNo,i.FormNo, i.FinTypeID,i.TotalReqAmt,i.`docsUploaded`,i.status,
CASE
WHEN i.FormNo=1 THEN (SELECT concat(`Title`,' ',`Name`) as Name FROM `individual` WHERE `TrackingNo`=i.TrackingNo limit 1) 
WHEN i.FormNo=2 THEN (SELECT concat(`Title`,' ',`TradeName`) as Name FROM company  WHERE `TrackingNo`=i.TrackingNo limit 1)
WHEN i.FormNo=3 THEN (SELECT concat(`Title`,' ',`Name`) as Name FROM `propietorship` WHERE `TrackingNo`=i.TrackingNo limit 1)
END as Name
FROM `inquiry` i WHERE Date(i.entryDate) BETWEEN '$date' and '$todate' and i.BranchId='".$_SESSION['brCode']."'".$statusQuery;


$res = mysqli_query($conn, $sqlload);
$rowcount=mysqli_num_rows($res); 

//echo '<br><br><br><br><br><br>sasasdfre';
//echo $sqlload;
//exit();
$c=1;
	?>
	<div class = "container"">

<table id="example" class="table table-striped table-bordered" style="width:100%;margin-left: 30px;font-size:15px;">

  <thead style="background-color: #009879; color:white">
  <tr>
  
    <th>Tracking No</th>
    <th>Form No</th>
    <th>Name</th>
    <th>Type of Financing</th>
	<th>Amount</th>
	<th>Status</th>
	
  </tr>
  </thead>
	<?php


	//echo'<br><br><br><br><br><br>';
	/*$sql1 = "select i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded
	from inquiry i ,individual a  where i.TrackingNo=a.TrackingNo and i.entryDate between '$date' and '$todate'  and i.BranchId=".$_SESSION['brCode'];
	$res1 = mysqli_query($conn, $sql1);
	//echo $sql1; exit;*/
	?>
	<tbody style="background-color:  #d8f3e5;">
	<?php
	while($data = mysqli_fetch_array($res))
{
	?>
	

	
<tr>
    <td><?php echo $data['TrackingNo']; ?></td>
    <td><?php echo $data['FormNo']; ?></td>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['FinTypeID']; ?></td>
    <td><?php echo $data['TotalReqAmt']; ?></td>
	<td><?php 
	 if ($data['status']==0)
	{
		echo "Waiting for maker to send to Branch Manager";
	} 
	else if ($data['status']==1)
	{
		echo "Waiting for Branch Manager Approval";
	} 
	else if ($data['status']==2)
	{
		echo "Waiting for Zonal Office Approval";
	} 
	else if ($data['status']==3)
	{
		echo "Waiting for CIB Report";
	}
	
	else if ($data['status']==4)
	{
		if($data['FormNo']==1){
			?><a href="uploadsCIB/<?php echo $data['docsUploaded'];?>" target="_blank" style="color:Blue" >CIB Inquiry Report</a>
		<?php 
		}	
	if($data['FormNo']==3){
			?><a href="uploadsCIB/<?php echo $data['docsUploaded'];?>" target="_blank" style="color:Blue" >CIB Inquiry Report</a>
		<?php 
		}	
if($data['FormNo']==2){
			?><a href="statusReportDateCompany.php?gtrNo=<?php echo $data['TrackingNo'];?>" target="_blank" style="color:Blue" >CIB Inquiry Report</a>
		<?php 
		}	

		
}


	

	


}
	
//echo $searchTrackingNo;exit();


}
//zone
if($OifficeLevel==2){	
	//echo'<br><br><br><br><br><br><br>';
	//echo "shsdkjfsdhfkdsfhksdf";
	//exit();
//$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN individual c
	//on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo and i.BranchId=".$_SESSION['brCode'];
/*$sqlload = "select DISTINCT i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,individual a  where i.TrackingNo=a.TrackingNo and  i.BranchId=$brCode and i.entryDate between '$date' and '$todate'
union ALL
select DISTINCT  i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,propietorship a  where i.TrackingNo=a.TrackingNo  and i.BranchId=$brCode and i.entryDate between '$date' and  '$todate' 
union ALL
select DISTINCT  i.TrackingNo,a.TradeName,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,company a  where i.TrackingNo=a.TrackingNo  and i.BranchId=$brCode and i.entryDate between '$date' and  '$todate'";
echo'<br><br><br><br><br><br><br>';
echo $sqlload;*/
$sqlload = "SELECT distinct i.TotalReqAmt,i.status,i.FinTypeID,i.TrackingNo,i.FormNo,ind.Name,i.docsUploaded,b.brNameEn FROM inquiry i inner join branch b on i.BranchId=b.brcode inner join zone z on b.ZoneID=z.zoneCode inner join individual ind on i.TrackingNo= ind.TrackingNo where z.zoneCode=$brCode$statusQuery
UNION ALL
SELECT distinct i.TotalReqAmt,i.status,i.FinTypeID,i.TrackingNo,i.FormNo,ind.TradeName,i.docsUploaded,b.brNameEn FROM inquiry i inner join branch b on i.BranchId=b.brcode inner join zone z on b.ZoneID=z.zoneCode inner join company ind on i.TrackingNo= ind.TrackingNo where z.zoneCode=$brCode$statusQuery 
UNION ALL
SELECT distinct i.TotalReqAmt,i.status,i.FinTypeID,i.TrackingNo,i.FormNo,ind.Name,i.docsUploaded,b.brNameEn FROM inquiry i inner join branch b on i.BranchId=b.brcode inner join zone z on b.ZoneID=z.zoneCode inner join propietorship ind on i.TrackingNo= ind.TrackingNo where z.zoneCode=$brCode$statusQuery";


$res = mysqli_query($conn, $sqlload);
$rowcount=mysqli_num_rows($res); 

//echo '<br><br><br><br><br><br>sasasdfre';
//echo $sqlload;
//exit();
$c=1;
	?>
	<div class = "container"">

<table id="example" class="table table-striped table-bordered" style="width:100%;margin-left: 30px;font-size:15px;">

  <thead style="background-color: #009879; color:white">
  <tr>
  
    <th>Branch</th>
    <th>Tracking No</th>
    <th>Form No</th>
    <th>Name</th>
    <th>Type of Financing</th>
	<th>Amount</th>
	<th>Status</th>
	
  </tr>
  </thead>
	<?php


	//echo'<br><br><br><br><br><br>';
	/*$sql1 = "select i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded
	from inquiry i ,individual a  where i.TrackingNo=a.TrackingNo and i.entryDate between '$date' and '$todate'  and i.BranchId=".$_SESSION['brCode'];
	$res1 = mysqli_query($conn, $sql1);
	//echo $sql1; exit;*/
	?>
	<tbody style="background-color:  #d8f3e5;">
	<?php
	while($data = mysqli_fetch_array($res))
{
	?>
	

	
<tr>
    <td><?php echo $data['brNameEn']; ?></td>
    <td><?php echo $data['TrackingNo']; ?></td>
    <td><?php echo $data['FormNo']; ?></td>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['FinTypeID']; ?></td>
    <td><?php echo $data['TotalReqAmt']; ?></td>
	<td><?php 
	 if ($data['status']==0)
	{
		echo "Waiting for maker to send to Branch Manager";
	} 
	else if ($data['status']==1)
	{
		echo "Waiting for Branch Manager Approval";
	} 
	else if ($data['status']==2)
	{
		echo "Waiting for Zonal Office Approval";
	} 
	else if ($data['status']==3)
	{
		echo "Waiting for CIB Report";
	}
	
	else if ($data['status']==4)
	{
		if($data['FormNo']==1){
			?><a href="uploadsCIB/<?php echo $data['docsUploaded'];?>" target="_blank" style="color:Blue" >CIB Inquiry Report</a>
		<?php 
		}	
	if($data['FormNo']==3){
			?><a href="uploadsCIB/<?php echo $data['docsUploaded'];?>" target="_blank" style="color:Blue" >CIB Inquiry Report</a>
		<?php 
		}	
if($data['FormNo']==2){
			?><a href="statusReportDateCompany.php?gtrNo=<?php echo $data['TrackingNo'];?>" target="_blank" style="color:Blue" >CIB Inquiry Report</a>
		<?php 
		}	

		
}


}
	
//echo $searchTrackingNo;exit();


}
//head office
if($OifficeLevel==6){	
	//echo'<br><br><br><br><br><br><br>';
	//echo "shsdkjfsdhfkdsfhksdf";
	//exit();
//$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN individual c
	//on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo and i.BranchId=".$_SESSION['brCode'];
/*$sqlload = "select DISTINCT i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,individual a  where i.TrackingNo=a.TrackingNo and  i.BranchId=$brCode and i.entryDate between '$date' and '$todate'
union ALL
select DISTINCT  i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,propietorship a  where i.TrackingNo=a.TrackingNo  and i.BranchId=$brCode and i.entryDate between '$date' and  '$todate' 
union ALL
select DISTINCT  i.TrackingNo,a.TradeName,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,company a  where i.TrackingNo=a.TrackingNo  and i.BranchId=$brCode and i.entryDate between '$date' and  '$todate'";
echo'<br><br><br><br><br><br><br>';
echo $sqlload;*/
$sqlload = "SELECT  i.TrackingNo,i.FormNo, i.FinTypeID,i.TotalReqAmt,i.`docsUploaded`,i.status,
CASE
WHEN i.FormNo=1 THEN (SELECT concat(`Title`,' ',`Name`) as Name FROM `individual` WHERE `TrackingNo`=i.TrackingNo ) 
WHEN i.FormNo=2 THEN (SELECT concat(`Title`,' ',`TradeName`) as Name FROM company  WHERE `TrackingNo`=i.TrackingNo )
WHEN i.FormNo=3 THEN (SELECT concat(`Title`,' ',`Name`) as Name FROM `propietorship` WHERE `TrackingNo`=i.TrackingNo)
END as Name, b.brNameEn,z.Zone_en
FROM `inquiry` i inner join branch b on i.BranchId=b.brcode inner join zone z on b.ZoneID=z.zoneCode 
WHERE Date(i.entryDate) BETWEEN '$date' and '$todate'$statusQuery";
$res = mysqli_query($conn, $sqlload);
$rowcount=mysqli_num_rows($res); 

//echo '<br><br><br><br><br><br>sasasdfre';
//echo $sqlload;
//exit();
$c=1;
	?>
	<div class = "container"">

<table id="example" class="table table-striped table-bordered" style="width:100%;margin-left: 30px;font-size:15px;">

  <thead style="background-color: #009879; color:white">
  <tr>
  
    <th>Zone</th>
    <th>Branch</th>
    <th>Tracking No</th>
    <th>Form No</th>
    <th>Name</th>
    <th>Type of Financing</th>
	<th>Amount</th>
	<th>Status</th>
	
  </tr>
  </thead>
	<?php


	//echo'<br><br><br><br><br><br>';
	/*$sql1 = "select i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded
	from inquiry i ,individual a  where i.TrackingNo=a.TrackingNo and i.entryDate between '$date' and '$todate'  and i.BranchId=".$_SESSION['brCode'];
	$res1 = mysqli_query($conn, $sql1);
	//echo $sql1; exit;*/
	?>
	<tbody style="background-color:  #d8f3e5;">
	<?php
	while($data = mysqli_fetch_array($res))
{
	?>
	

	
<tr>
    <td><?php echo $data['Zone_en']; ?></td>
    <td><?php echo $data['brNameEn']; ?></td>
    <td><?php echo $data['TrackingNo']; ?></td>
    <td><?php echo $data['FormNo']; ?></td>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['FinTypeID']; ?></td>
    <td><?php echo $data['TotalReqAmt']; ?></td>
	<td><?php 
	 if ($data['status']==0)
	{
		echo "Waiting for maker to send to Branch Manager";
	} 
	else if ($data['status']==1)
	{
		echo "Waiting for Branch Manager Approval";
	} 
	else if ($data['status']==2)
	{
		echo "Waiting for Zonal Office Approval";
	} 
	else if ($data['status']==3)
	{
		echo "Waiting for CIB Report";
	}
	
	else if ($data['status']==4)
	{
		if($data['FormNo']==1){
			?><a href="uploadsCIB/<?php echo $data['docsUploaded'];?>" target="_blank" style="color:Blue" >CIB Inquiry Report</a>
		<?php 
		}	
	if($data['FormNo']==3){
			?><a href="uploadsCIB/<?php echo $data['docsUploaded'];?>" target="_blank" style="color:Blue" >CIB Inquiry Report</a>
		<?php 
		}	
if($data['FormNo']==2){
			?><a href="statusReportDateCompany.php?gtrNo=<?php echo $data['TrackingNo'];?>" target="_blank" style="color:Blue" >CIB Inquiry Report</a>
		<?php 
		}	

		
}


	

	


}
	
//echo $searchTrackingNo;exit();


}



}






?>

</td>  
    
  </tr>	
  </tbody>
</table>
	</div>
</div>
	<script>
$(document).ready(function () {
    $('#example').DataTable();
});
$('input[name="txtdate"]').mask('00/00/0000');
$('input[name="txtTodate"]').mask('00/00/0000');
</script>
</body>


</html>
<br><br><br><br>
<br><br><br><br>

<?php include 'templates/footer.php';?>