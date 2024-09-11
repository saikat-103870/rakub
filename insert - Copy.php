<?php
include('templates\header.php');
include('config.php');

?>
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

<div class="container" style="padding-top:57px;"> 
   <h2>Entry Form Data</h2>
<table class="table-table-striped table-table-bordered styled-table">

  <thead>
  <tr>
    <th>Sr.No.</td>
    <th>Full Name</td>
    <th>Age</td>
	<th>Action</td>
  </tr>
  </thead>
	<center>
		<?php
	

		// servername => localhost
		// username => root
		// password => empty
		// database name => cibinquiry

		
		// Taking all values from the form data(input)
		
		
		$LoanType = $_POST['LoanType'];
		$IndividualInfo = $_POST['IndividualInfo'];
		$FISubjCode = $_POST['FISubjCode'];
		$FinType = $_POST['FinType'];
		$TotalReqAmt = $_POST['TotalReqAmt'];
	    $InstallmentNo = $_POST['InstallmentNo'];
	    $InstallmentAmt = $_POST['InstallmentAmt'];
		$PaymentPeriod = $_POST['PaymentPeriod'];
	    $Role = $_POST['Role'];
	    $Title = $_POST['Title'];
	    $Name = $_POST['Name'];
	    $FatherTitle = $_POST['FatherTitle'];
	    $FatherName = $_POST['FatherName'];
	    $MotherTitle = $_POST['MotherTitle'];
	    $MotherName = $_POST['MotherName'];
	    $SpouseTitle = $_POST['SpouseTitle'];
	    $SpouseName = $_POST['SpouseName'];
		$NID = $_POST['NID'];
		$Etin = $_POST['Etin'];
		$BirthDate = $_POST['BirthDate'];
		$Gender = $_POST['Gender'];
		$BirthDistrict = $_POST['BirthDistrict'];
		$BirthCountry = $_POST['BirthCountry'];
		$PerStreet = $_POST['PerStreet'];
		$PerPostal = $_POST['PerPostal'];
		$PerDistrict = $_POST['PerDistrict'];
		$PerCountry = $_POST['PerCountry'];
		$PreStreet = $_POST['PreStreet'];
		$PrePostal = $_POST['PrePostal'];
		$PreDistrict = $_POST['PreDistrict'];
		$PreCountry = $_POST['PreCountry'];
		$IDType = $_POST['IDType'];
		$IDNumber = $_POST['IDNumber'];
		$IDIssueDate = $_POST['IDIssueDate'];
		$IDIssueCountry = $_POST['IDIssueCountry'];
		$SecType = $_POST['SecType'];
		$SecCode = $_POST['SecCode'];
		$TelephoneNumber = $_POST['TelephoneNumber'];
		
		// Performing insert query execution
		// here our table name is form1
		$sql = "INSERT INTO form1 VALUES ('','$LoanType','$IndividualInfo','100','$FISubjCode','$FinType','$TotalReqAmt','$InstallmentNo','$PaymentPeriod','$InstallmentAmt','$Role','$Title','$Name','$FatherTitle','$FatherName',
			'$MotherTitle','$MotherName','$SpouseTitle','$SpouseName','$NID','$Etin','$BirthDate','$Gender','$BirthDistrict','$BirthCountry','$PerStreet','$PerPostal','$PerDistrict','$PerCountry','$PreStreet',
			'$PrePostal','$PreDistrict','$PreCountry','$IDType','$IDNumber','$IDIssueDate','$IDIssueCountry','$SecType','$SecCode','$TelephoneNumber')";
		 
		$sql1 = "select TrackNo,Role,Gender from form1";

		if(mysqli_query($conn, $sql)){
		
		} else{
			
				mysqli_error($conn);
		}
		$records = mysqli_query($conn,$sql1); // fetch data from database
while($data = mysqli_fetch_array($records))
{
	?>
	
	<tbody>
<tr>
    <td><?php echo $data['TrackNo']; ?></td>
    <td><?php echo $data['Role']; ?></td>
    <td><?php echo $data['Gender']; ?></td>
    <td>   <a class="btn btn-primary a-btn-slide-text" href="edit.php?TrackNo=<?php echo $data['TrackNo'];?>">
        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
        <span><strong>Edit</strong></span>            
    </a>
    <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item')" href="delete.php?TrackNo=<?php echo $data['TrackNo'];?>">
       <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        <span><strong>Delete</strong></span>            
    </a>	</td>
  </tr>	
  </tbody>
<?php
}

		// Close connection
		mysqli_close($conn);
		?>

	</table>
	</center>	
	</div>
</body>
<style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 1em;
    font-family: sans-serif;
    min-width: 800px;
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
    padding: 10px 12px;
	
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 1px solid #009879;
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
h2{
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

</style>


</html>
