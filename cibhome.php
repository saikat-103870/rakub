<?php
//include('../dbconnect2i.php');
ob_start();
	
include ("bs.php");
error_reporting(E_ALL);
ini_set('display_errors', 'on');

ini_set('max_execution_time', 0);
set_time_limit(1800);
ini_set('memory_limit', '-1');

//include('convertToBangla.php');
include 'dbconnect.php';

//

if(isset ($_SESSION['offCode']))
{
$offCode=$_SESSION['offCode'];
$OifficeLevel = $_SESSION['OifficeLevel'];
$type = $_SESSION['type'];
$brCode=$_SESSION['offCode'];
$uid=$_SESSION['uid'];	
//echo $offCode."-".$OifficeLevel."-".$type."-".$brCode."-".$uid;				
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Matching CIB Data</title>
  <meta charset="utf-8">


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min_v3.4.1.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 


<style type="text/css">
.customers{
  overflow-y: scroll;
  height: 150px;
 
}

.customers th{
    position: sticky;
    top: 0;

}

.customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;

  
}

.customers td, .customers th {
	//border-top: none !important;
    border: 1px solid #ffffe6;
    //padding: 5px;


}


.customers tr:hover {
color:#00b300; 
//border: 1px solid red;
}

.customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  //background-color: #4CAF50;
  color: white;
  border: 1px solid black;
}

.cib{
	background-color: #fcba03 ;
}
.cbs{
	background-color:  #4CAF50;
}
</style>
<style>
/* The chkcont */
.chkcont {
  display: block;
  position: relative;
  padding-left: 30px;
  margin-bottom: 2px;
  cursor: pointer;
  font-size: 18px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.chkcont input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;

}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #eee;
    border:1px solid green;
}



/* When the checkbox is checked, add a blue background */
.chkcont input:checked ~ .checkmark {
  background-color: green;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.chkcont input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.chkcont .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}

h4 {
   width: 100%; 
   text-align: center; 
   border-bottom: 1px solid green; 
   line-height: 0.1em;
   margin: 10px 0 20px; 
   
}
h4 span { 
    background:#fff; 
    padding:0 10px; 
}




</style>





</head>
<body>

<div class="wrapper">

<div class="container-fluid">
<br>
<div class="row">

<div class="col-sm-3">
</div>				
<div class="col-sm-6">
<h3 class="text-left"><font color="green"></font>

<?php
echo'<a href="home.php" class="list-group-item list-group-item-action list-group-item-success headingList"><span class="glyphicon glyphicon-th-list"> </span>&nbsp;CIB Inquiry System</a>';					
echo'<a href="../mis/cib/index.php" class="list-group-item list-group-item-action list-group-item-warning headingList"><span class="glyphicon glyphicon-th-list"> </span>&nbsp;10 Digit Smart Card Updating System</a>';



?>
</h3>
</div>
<div class="col-sm-3">
</div>	
</div>
</div>

</div>

</body>
</html>
