<!DOCTYPE html>
<html>

<head>
	<title>Insert Page page</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<center>
		<?php
	

		// servername => localhost
		// username => root
		// password => empty
		// database name => cibinquiry
		$conn = mysqli_connect("localhost", "root", "", "cibinquiry");
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}
if(isset($_GET['TrackNo']))	{
	$TrackNo = $_GET['TrackNo'];
$sqlp = "DELETE FROM form1 WHERE `TrackNo` ='$TrackNo'";
$result = mysqli_query($conn,$sqlp);
if($result == true){
	echo"Record Deleted Successfully";
}
else{
	echo "Error in delete";
} 

}	


	// Close connection
mysqli_close($conn);
	 ?>

	</center>	
</body>
</html>
