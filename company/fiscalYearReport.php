<?php
ob_start();
include ('header.php');
include 'config.php';
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

if(isset($_GET['gtrNo']))	{
	
		$trNo1 = $_GET['gtrNo'];
	
		$sendMaker = "update inquiry set status=0 where TrackingNo=$trNo1";
	
	if (mysqli_multi_query($conn, $sendMaker))
        {
			echo '<center>';
			echo '<h2><br><br><br><br><span style="color: green;">Successfully Send Back to Corresponding Officer for Correction.</span></h2>';
			echo "<a class='btn btn-default btn-lg blue' href='home.php'><span class='glyphicon glyphicon-edit'></span> Back</a><br><br>";
			echo '</center>';
			//echo '<center>';
			//echo "<a class='btn btn-default btn-lg blue' href='generate_pdf/genPdfIndividual.php?gtrNo=$trNo'><span class='glyphicon glyphicon-edit'></span> Generate PDF</a><br><br>";
			echo '</center>';
			exit;
        }
	else
		{
			echo "Error: " . mysqli_error($conn);
		}
}

?>
<!DOCTYPE html>
<html>
<br>
<br>

<head>
	<title>Verify Report</title>

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
#footer {
   position:absolute;
   bottom:0;
   width:100%;
   height:60px;   
   background:#6cf;
}
ex1 {
  min-height: 200px;
}
</style> 
</head>

<body ><br>
<!--<p align= "right"<p style="color:red;text-align:right;font-size:20px">Branch Code:<?php echo $brCode;?></p>-->

<div style="min-height: 420px;"><br>

<h1>Verify CIB Inquiry</h1> 
<br>
<table class="styled-table">

  <thead>
  <tr>
  
    <th>Tracking No</th>
    <th>Customer Name</th>
    <th>Type of Financing</th>
    <th>Form No</th>
	<th>Amount</th>
	<th>Action</th>
	
  </tr>
  </thead>
<?php 
		
	//echo '<br><br><br><br><br><br><br><br><br><br>loanfsdfdsfsdsdfsfdsasasaerewrwr type '.$brCode;
	//echo '<br><br><br><br><br><br><br><br><br><br>loanfsdfdsfsdsdfsfdsasasaerewrwr type '.$EntryUserId;


    //echo '<br><br><br><br><br>true';
	if(isset($_GET['branchCode']))	{
	
	$brCode1 = $_GET['branchCode'];
	//$trNo= $searchTrackingNo;
		//echo '<br><br><br><br><br><br><br><br><br><br>loanfsdfdsfsdsdfsfdsasasaerewrwr type '.$brCode1;

$sqlload="SELECT i.*,c.* from
inquiry i 
inner JOIN
individual c
on i.TrackingNo=c.TrackingNo 
where i.BranchId=$brCode1 and i.status=1";
//echo'<br><br><br><br><br><br><br><br>';
//echo $sqlload;
//exit();
		
	$res = mysqli_query($conn, $sqlload);
	$rowcount=mysqli_num_rows($res); 

/*while($data = mysqli_fetch_array($res))
{
	?>
	
	
	<tbody>
<tr>
    <td><?php echo $data['TrackingNo']; ?></td>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['FinTypeID']; ?></td>
    <td><?php echo $data['TotalReqAmt']; ?></td>
	<td><a class="btn btn-success a-btn-slide-text" href="viewCIBInquery_BM.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong>View</strong></span>            
    </a>
	<a class="btn btn-primary a-btn-slide-text" href="verifyReport.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong>Unlock</strong></span>            
    </a>
	
	</td>
   
    
    
  </tr>	
  </tbody>
<?php
	
}*/



$sqlload1="SELECT i.*,c.* from
inquiry i 
inner JOIN
company c
on i.TrackingNo=c.TrackingNo 
where i.BranchId=$brCode1 and i.status=1";
$res1 = mysqli_query($conn, $sqlload1);
$rowcount=mysqli_num_rows($res1);
 
/*while($data = mysqli_fetch_array($res1))
{
	?>
	
	
	<tbody>
<tr>
    <td><?php echo $data['TrackingNo']; ?></td>
    <td><?php echo $data['TradeName']; ?></td>
    <td><?php echo $data['FinTypeID']; ?></td>
    <td><?php echo $data['TotalReqAmt']; ?></td>
	<td><a class="btn btn-success a-btn-slide-text" href="viewCIBInquery_BM_company.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong>View</strong></span>            
    </a>
	<a class="btn btn-primary a-btn-slide-text" href="verifyReport.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong>Unlock</strong></span>            
    </a>
	
	</td>
   
  
    
  </tr>	
  </tbody>
<?php
	
}*/	



$sqlload2="SELECT  i.TrackingNo,i.FormNo, i.FinTypeID,i.TotalReqAmt,
CASE
WHEN i.FormNo=1 THEN (SELECT concat(`Title`,`Name`) as Name FROM `individual` WHERE `TrackingNo`=i.TrackingNo limit 1) 
WHEN i.FormNo=2 THEN (SELECT concat(`Title`,`TradeName`) as Name FROM company  WHERE `TrackingNo`=i.TrackingNo limit 1)
WHEN i.FormNo=3 THEN (SELECT concat(`Title`,`Name`) as Name FROM `propietorship` WHERE `TrackingNo`=i.TrackingNo limit 1)
END as Name
FROM `inquiry` i WHERE i.BranchId=$brCode1 and i.status=1;";
$res1 = mysqli_query($conn, $sqlload2);
$rowcount=mysqli_num_rows($res1);

while($data = mysqli_fetch_array($res1))
{
	?>
	
		
	<tbody>
<tr>
    <td><?php echo $data['TrackingNo']; ?></td>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['FinTypeID']; ?></td>
    <td><?php  $form=$data['FormNo'];
	if($form==1)
	{
		echo "Individual"; 
	}
	else if($form==2)
	{
		echo "Company"; 
	}
    else if($form==3)
	{
		echo "Propietorship"; 
	}	
	else
	{
		
	}
	?>
	</td>
    <td><?php echo $data['TotalReqAmt']; ?></td>
	<?php 
	if($form == 1)
	{
		?>
	<td><a class="btn btn-success a-btn-slide-text" href="viewCIBInquery_BM.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
        <span><strong>View</strong></span>            
    </a>

	
	<a class="btn btn-danger a-btn-slide-text" href="verifyReport.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="fa fa-unlock" aria-hidden="true"></span>
        <span><strong>Unlock</strong></span>            
    </a>
	
	</td>
   
  
    
  </tr>	
  </tbody>
<?php
	}
	if($form == 2)
	{
		?>
	<td><a class="btn btn-success a-btn-slide-text" href="viewCIBInquery_BM_company.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
        <span><strong>View</strong></span>            
    </a>

	
	<a class="btn btn-danger a-btn-slide-text" href="verifyReport.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="fa fa-unlock" aria-hidden="true"></span>
        <span><strong>Unlock</strong></span>            
    </a>
	
	</td>
   
  
    
  </tr>	
  </tbody>
<?php
	}
	if($form == 3)
	{
		?>
	<td><a class="btn btn-success a-btn-slide-text" href="viewCIBInquery_BM_propietorship.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
        <span><strong>View</strong></span>            
    </a>

	
	<a class="btn btn-danger a-btn-slide-text" href="verifyReport.php?gtrNo=<?php echo $data['TrackingNo'];?>">
        <span class="fa fa-unlock" aria-hidden="true"></span>
        <span><strong>Unlock</strong></span>            
    </a>
	
	</td>
   
  
    
  </tr>	
  </tbody>
<?php
	}
}	
}




?>

</table>





	
</div>
</body>

<br><br><br><br><br>
<br><br><br><br><br>
<br><br><br><br><br>
<br><br><br><br><br>
</html>
<?php include 'templates/footer.php';?>