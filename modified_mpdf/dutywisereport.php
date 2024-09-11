

<style>
table, th, td {
  border: 1px solid black;
}
</style>
<?php
// Include mpdf library file
require_once __DIR__ . '/vendor/autoload.php';

ini_set("memory_limit","1024M");
ini_set('max_execution_time', 0);
set_time_limit(1800);
ini_set('memory_limit', '-1');


$mpdf = new \Mpdf\Mpdf();
include '../config.php';
// Database Connection 
ini_set('display_errors','off');
if(isset($_POST['submit']))
{
$pdfcontent = '
		<table align="center">
		<tr>
		<td><img src="../rakub.png" width="75" height="75">
		<td align="center"><h2>Rajshahi Krishi Unnayan Bank</h2>
		<p style="text-align:center;font-size: 17px;">Head Office, Rajshahi</p></td></tr>
		</table>
		<h4 style="text-align:center; font-size:18px">PMIS Report</h4>';	
function printTable(&$result) //mysqli result set
{
	$txt='';
    /**  Set up Table and Headers **/
	
    $fieldinfo = $result->fetch_fields();
	
	$txt.='<table border ="1" cellspacing="0" cellpadding="10">
			<tr>
				<th>SL#</th>
				
				<th>Name</th>
				<th>Designation</th>
				<th>Currently Working As</th>
				<th>Office</th>
				<th>Contact</th>
				
		</tr>';
//<th>Emp. Id</th>
//<td>'.$row['emp_id'].'</td>
    /** dump rows **/
	$kn=1;
    while($row = $result->fetch_assoc()) 
	{
			$d1 = date_create(date("Y-m-d"));
			$d2 = date_create($row['joiningDate']);
			$interval = date_diff($d1, $d2);
			$d=$interval->format('%yY %mM %dD');
			
			$txt.='<tr>
			<td>'.$kn.' </td>
			
			<td>'.$row['name_eng'].' </td>
			<td>'.$row['designation'].' </td>
			<td>'.$row['official_desig'].' </td>
			<td>'.$row['office'].' </td>
			<td>'.$row['mobile_pr'].' </td>
			
			<tr>';

		$kn++;
    }
     $txt.="</table>\n";


    $result->free();
	return $txt;
}

if(trim($_POST['official_desig'])=='0')
{
	echo '<br><br><br><br><br><br><center><div style="color: red;font-size:18px;">Please select Currently Working Position</div>';
	echo '<a href="dutywisereport.php" class="btn btn-lg">Back</a></center>';
	exit;
}
	
$desig=$_POST['official_desig'];

$sql='Select tb.emp_id,tb.official_desig,tb.name_eng,tb.`designation`, tbo.office,tb.mobile_pr from 
(select p.emp_id,p.official_desig,p.name_eng,p.`designation`,p.`PrPostingLoc`,p.`prPostingZone`,p.`PrPostingBr`,p.`date_joinbank`,p.mobile_pr,
CASE
 WHEN p.PrPostingLoc=1 THEN PrPostingBr
 WHEN p.PrPostingLoc>1 THEN prPostingZone
 END as office
from personal p
where p.official_desig="'.$desig.'") tb
INNER JOIN (SELECT `divisionId` code , concat(`DivisionNameEn`," Divisional Office") office,4 loc FROM `division` WHERE `divisionId`!=9999
union all
SELECT `divisionId` code , concat(`DivisionNameEn`," Divisional Audit Office") office,5 loc FROM `dao` WHERE 1
union all
SELECT `brcode` code , concat(`brNameEn`," Branch,",z.Zone_en, " zone") office,1 loc FROM `br` inner join zone z
on z.zoneCode=br.ZoneID
union all
SELECT `deptCode` code , concat(`DeptName`," Head Office") office,6 loc FROM `department` WHERE 1
union all
SELECT `ZaoCode` code , concat(`Zao_en`," zonal Audit Office") office,3 loc FROM `zao` WHERE 1
union all
SELECT `zoneCode`,concat(`Zone_en`," zone") office,2 loc FROM `zone` WHERE 1) tbo
on tb.office=tbo.code and tb.PrPostingLoc=tbo.loc';



$result = mysqli_query($conn, $sql);
$mpdf->WriteHTML($pdfcontent);
$mpdf->Ln(5);
$mpdf->WriteHTML('Employee List of '.$desig);
$mpdf->Ln();

$mpdf->WriteHTML(printTable($result));

$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0; 

//call watermark content and image
$mpdf->SetWatermarkText('etutorialspoint');
//$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;

//output in browser
$mpdf->Output();	
}
	
?>
<!DOCTYPE html>
<html>

<head>
	<title>Report</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
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
.variablecolor{
color: #fc03e3;}

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

<body>

<form action=""  method="post">
<div  class="col-sm-6 col-sm-offset-3">
<div class="items">
<div class="panel panel-default">
<div class="panel-heading" style="background-color:#008836;color: white; font-size:16px;">Enter Your Current Working Position</div>
<div class="panel-body" style="border:1px solid green;  background-color:#f0f5f5;">
<div class="form-group">
	
	<select class="form-control" id="official_desig" name="official_desig">
		<option selected value="0">Select Currently Working As</option>
		<option value="Cashier" <?php if($official_desig=="Cashier") echo 'selected="selected"'; ?> >Cashier</option>
		<option value="Cell Head" <?php if($official_desig=="Cell Head") echo 'selected="selected"'; ?> >Cell Head</option>
		<option value="Departmental Employee" <?php if($official_desig=="Departmental Employee") echo 'selected="selected"'; ?> >Departmental Employee</option>
		<option value="Departmental Head" <?php if($official_desig=="Dismissed") echo 'selected="selected"'; ?> >Departmental Head</option>
		<option value="Divisional Audit Employee" <?php if($official_desig=="Divisional Audit Employee") echo 'selected="selected"'; ?> >Divisional Audit Employee</option>
		<option value="Divisional Audit Head" <?php if($official_desig=="Divisional Audit Head") echo 'selected="selected"'; ?> >Divisional Audit Head</option>
		<option value="Divisional Employee" <?php if($official_desig=="Divisional Employee") echo 'selected="selected"'; ?> >Divisional Employee</option>
		<option value="Divisional Manager" <?php if($official_desig=="Divisional Manager") echo 'selected="selected"'; ?> >Divisional Manager</option>
		<option value="Field Officer" <?php if($official_desig=="Field Officer") echo 'selected="selected"'; ?> >Field Officer</option>
		<option value="General Banking" <?php if($official_desig=="General Banking") echo 'selected="selected"'; ?> >General Banking</option>
		<option value="Guard" <?php if($official_desig=="Guard") echo 'selected="selected"'; ?> >Guard</option>
		<option value="Manager" <?php if($official_desig=="Manager") echo 'selected="selected"'; ?> >Manager</option>
		<option value="Office Assistant" <?php if($official_desig=="Office Assistant") echo 'selected="selected"'; ?> >Office Assistant</option>
		<option value="Second Officer" <?php if($official_desig=="Second Officer") echo 'selected="selected"'; ?> >Second Officer</option>
		<option value="Zonal Audit Employee" <?php if($official_desig=="Zonal Audit Employee") echo 'selected="selected"'; ?> >Zonal Audit Employee</option>
		<option value="Zonal Audit Head" <?php if($official_desig=="Zonal Audit Head") echo 'selected="selected"'; ?> >Zonal Audit Head</option>
		<option value="Zonal Employee" <?php if($official_desig=="Zonal Employee") echo 'selected="selected"'; ?> >Zonal Employee</option>
		<option value="Zonal Manager" <?php if($official_desig=="Zonal Manager") echo 'selected="selected"'; ?> >Zonal Manager</option>
		
		
	
	</select>
	</div>
<div>


	<span style=""> <button type="submit" value='Get Report' name="submit" class="btn btn-success">Get Report<span class='glyphicon glyphicon-step-forward'></span></button> </span>
	<a class="btn btn-primary"  href="../pmisreport.php" >
     <span class="glyphicon glyphicon-step-backward" aria-hidden="true" style="align:right"></span>
     <span><strong>Back</strong></span>            
	</a>
</div>
</div>
</div>
</div>
</div>
</form>


</body>


</html>
<?php include 'templates/footer.php';?>
