<?php
ob_start();
include ('header.php');
ini_set('display_errors', 'off');

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
?>
<!DOCTYPE html>
<html>
<br>
<br>

<head>
	<title>Reset Password</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/font-awesome.min.css">
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

<body >
<div style="min-height: 420px;"><br>
<h1>Search Tracking No</h1> 
<br>
<form class="example" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Search.." name="searchTrackingNo">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>
<?php 
	//echo '<br><br><br><br><br><br><br><br><br><br>loanfsdfdsfsdsdfsfdsasasaerewrwr type '.$brCode;

if(isset($_GET['searchTrackingNo']))	{
	$searchTrackingNo = $_GET['searchTrackingNo'];
	$trNo= $searchTrackingNo;
	//echo '<br><br><br><br><br><br><br><br><br><br>fdsfsdfsdf';
	
	
$sql="SELECT DISTINCT i.`TrackingNo`,ind.TradeName,z.Zone_en,b.brNameEn,ind.TradeName, i.TotalReqAmt,'Company' idd FROM inquiry i  inner JOIN  company ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode where i.TrackingNo=$trNo and i.status=1
UNION ALL
SELECT DISTINCT i.`TrackingNo`,ind.Name,z.Zone_en,b.brNameEn,ind.Name,i.TotalReqAmt,'Individual' idd FROM inquiry i  inner JOIN  individual ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.TrackingNo=$trNo and i.status=1
uNION ALL
SELECT DISTINCT i.`TrackingNo`,ind.Name,z.Zone_en,b.brNameEn,ind.Name,i.TotalReqAmt,'propietorship' idd FROM inquiry i  inner JOIN  propietorship ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.TrackingNo=$trNo and i.status=1";	
$res = mysqli_query($conn, $sql);

	if (mysqli_affected_rows($conn)>0)
	{
     	$row = mysqli_fetch_assoc($res);
		
		$idd = $row['idd'];
	
	}
if($idd="Individual"){
$sqlload="SELECT i.*,c.* from inquiry i INNER JOIN individual c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$searchTrackingNo and i.BranchId=".$_SESSION['brCode'];
		
	$res1 = mysqli_query($conn, $sqlload);
	$rowcount=mysqli_num_rows($res1); 
//echo $searchTrackingNo;exit();
if($rowcount<1){
$r= $rowcount;
}
else
{
header("Location: individual.php?gtrNo=".$trNo);

}
}

if($idd="Company"){
$sqlload1="SELECT i.*,c.* from inquiry i INNER JOIN company c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$searchTrackingNo and i.BranchId=".$_SESSION['brCode'];
		
	$res2 = mysqli_query($conn, $sqlload1);
	$rowcount1=mysqli_num_rows($res2); 
//echo $searchTrackingNo;exit();
if($rowcount1<1){
	$r1= $rowcount1;
}
else
{
			header("Location: editCompany.php?gtrNo=".$trNo);

}
}

if($idd="propietorship"){
$sqlload1="SELECT i.*,c.* from inquiry i INNER JOIN propietorship c
	on i.TrackingNo=c.TrackingNo where i.TrackingNo=$searchTrackingNo and i.BranchId=".$_SESSION['brCode'];
		
	$res3 = mysqli_query($conn, $sqlload1);
	$rowcount3=mysqli_num_rows($res3); 
//echo $searchTrackingNo;exit();
if($rowcount3<1){
	$r3= $rowcount3;
}
else
{
			header("Location: propietorship.php?gtrNo=".$trNo);exit;

}
}
if($r<1 && $r1<1&&$r3<1 ){
	echo  "<p style='color:red;text-align: center;font-size: 25px;font-family:serif;'>"."<br>"."Invalid Tracking No."."</p>";
}

}

?>


	
</div>
</body>

<br><br><br><br><br>
</html>
<?php include 'templates/footer.php';?>