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

	
    
}
else
{
    header("Location:login.php");
    exit;
}



?>


<head>
<br><br>
	<title>Head Office Dashboard</title>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <style>
.styled-table {
    border-collapse: collapse;
    margin: 1px 0;
    font-size: 1.2em;
    font-family: serif;
    min-width: 300px;
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
<h1>Owner List</h1> 
<br>	
<div class="container">
<table class="styled-table table-striped">

  <thead>
  <tr>
  
    <th>SL No.</th>
	<th>TrackingNo</th>
	<th>Name</th>
	<th>Father Name</th>
	<th>Edit</th>

	
  </tr>
  </thead>
<?php 
	if(isset($_GET['gtrNo']))	{
	
		$trNo1 = $_GET['gtrNo'];

$sqlload="SELECT * FROM `individual` WHERE `TrackingNo` = '$trNo1'";
$counter = 0;	
$res = mysqli_query($conn, $sqlload);
	
//echo $searchTrackingNo;exit();

while($data = mysqli_fetch_array($res))
{
		
	//$form=$data['FormNo'];//
	?>
	

	<tbody>
<tr>
  
    <td><?php echo ++$counter;  ?></td>
    <td><?php echo $data['TrackingNo']; ?></td>
    <td><?php echo $data['Name']; ?></td>
    <td><?php echo $data['FatherName']; ?></td>
	<td><a class="btn btn-success a-btn-slide-text" href="editCompanyIndividual.php?gtrNo=<?php echo $data['SlNo'];?>">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong>Edit</strong></span>            
    </a>

	
		
	</td>
   
    
    
  </tr>	
  </tbody>
<?php
		
		
}
	

	}

?>

</table>
</div>
</div>




</body>

<br><br><br><br><br>
<br><br><br><br><br>
<br><br><br><br><br>
<br><br><br><br><br>
</html>
<?php include 'templates/footer.php';?>