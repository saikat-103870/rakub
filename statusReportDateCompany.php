
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
				}
?>
<!DOCTYPE html>
<html>
<br>
<br>

<head>
	<title>Status Report</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 1.5em;
    font-family: serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
	margin-left: auto;
	margin-right: auto;
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 2px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
h1{
	font-size: em;
    font-family: serif;
	text-align: center;
	color:green;
}
h3{
	font-size: em;
    font-family: serif;
	text-align: center;
	color:green;
	
}
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
.table-table-bordered{ background-color: lightblue;}

body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}

ex1 {
  min-height: 200px;
}
</style>
</head>

<body >
<br>
<h1>Company Reports</h1> 

<?php 

if(isset($_GET['gtrNo']))	{
	$gtrNo = $_GET['gtrNo'];
	$trNo= $gtrNo;
	//echo '<br><br><br><br><br><br><br><br><br><br>fdsfsdfsdf';
		//echo '<br><br><br><br><br><br><br><br><br><br>loanfsdfdsfsdsdfsfdsasasaerewrwr type '.$OifficeLevel;

	
//$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN individual c
	//on i.TrackingNo=c.TrackingNo where i.TrackingNo=$trNo and i.BranchId=".$_SESSION['brCode'];
/*$sqlload = "select i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,individual a  where i.TrackingNo=a.TrackingNo and i.TrackingNo='$trNo' and i.BranchId=$brCode
union ALL
select i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,propietorship a  where i.TrackingNo=a.TrackingNo and i.TrackingNo='$trNo' and i.BranchId=$brCode
union ALL
select i.TrackingNo,a.TradeName,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,i.docsUploaded from inquiry i ,company a  where i.TrackingNo=a.TrackingNo and i.TrackingNo='$trNo' and i.BranchId=$brCode";*/

	//echo '<br><br><br><br><br><br>sadsaas';
	//echo $FormNo;
	//exit();

	?>
	<table class="styled-table">

  <thead>
  <tr>
  
    <th>Tracking No</th>
    <th>Customer Name</th>
    <th>Type of Financing</th>
	<th>Amount</th>
	<th>Status</th>
	
  </tr>
  </thead>
	<?php
//echo $searchTrackingNo;exit();
	
	$sql1 = "select i.TrackingNo,a.Name,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,a.`UploadCibReport` from inquiry i ,individual a where i.TrackingNo=a.TrackingNo and i.TrackingNo=$trNo
	union ALL 
	select i.TrackingNo,a.TradeName,i.FinTypeID,i.TotalReqAmt,i.FormNo,i.status,a.`UploadCibReport` from inquiry i ,company a where i.TrackingNo=a.TrackingNo and i.TrackingNo=$trNo";
	$res1 = mysqli_query($conn, $sql1);
	//echo '<br><br><br><br><br>sadas';
	//echo $sql1;
	//exit();
	while($data = mysqli_fetch_array($res1))
{
	?>
	

	<tbody>
<tr>
    <td><?php echo $data['TrackingNo']; ?></td>
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
		
			?><a href="uploadsCIB/<?php echo $data['UploadCibReport'];?>" target="_blank" style="color:Blue" >CIB Inquiry Report</a>
	
	
	<?php
}

}
	



//zone




}







?>

</td>  
    
  </tr>	
  </tbody>

	
</div>
</body>

</html>
<?php include 'templates/footer1.php';?>