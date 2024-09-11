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
	
		$sendZM = "update inquiry set Received_status='1',`Received_by`='$EntryUserId', Received_at=NOW() where TrackingNo=$trNo1";

	if (mysqli_multi_query($conn, $sendZM))
        {
			echo '<center>';
			echo '<h2><br><br><br><br><span style="color: purple;">Successfully Received by- '.$EntryUserId.' and TrackingNo-'.$trNo1.'</span></h2>';
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
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
 
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


<?php include 'templates/footer.php';?>