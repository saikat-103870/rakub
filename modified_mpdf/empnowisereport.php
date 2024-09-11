

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
		<td><img src="../rakub.png" width="95" height="85">
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
				<th>Office/Branch Name</th>
				<th>Office/Branch Code</th>
				<th>No. of Employee</th>

		</tr>';


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
			<td>'.$row['office'].'</td>
			<td>'.$row['OfficeCode'].' </td>
			<td>'.$row['Emp_Number'].' </td>

			<tr>';

		$kn++;
    }
     $txt.="</table>\n";


    $result->free();
	return $txt;
}

if(trim($_POST['empno'])=='0')
{
	echo '<br><br><br><br><br><br><center><div style="color: red;font-size:18px;">Please select No. of employee</div>';
	echo '<a href="empnowisereport.php" class="btn btn-lg">Back</a></center>';
	exit;
}
	
$empno=($_POST['empno']);

$sql="select tbo.office,tb.office OfficeCode,tb.cnt Emp_Number
from (
select p1.office,count(p1.emp_id) cnt from (
select p.emp_id,p.name_eng,p.`designation`,p.`PrPostingLoc`,p.`prPostingZone`,p.`PrPostingBr`
,p.`date_joinbank`,
CASE
 WHEN p.PrPostingLoc=1 THEN PrPostingBr
 WHEN p.PrPostingLoc>1 THEN prPostingZone
END as office
from personal p 
) p1
where p1.office>0
group by p1.office
HAVING count(p1.emp_id)>=".$empno."
)tb
INNER JOIN
(
SELECT `divisionId` code , concat(trim(`DivisionNameEn`),' Divisional Office') office,4 loc FROM `division` WHERE `divisionId`!=9999
union all
SELECT `divisionId` code , concat(trim(`DivisionNameEn`),' Divisional Audit Office') office,5 loc FROM `dao` WHERE 1
union all
SELECT `brcode` code , concat(trim(`brNameEn`),' Branch,',z.Zone_en, ' zone') office,1 loc FROM `br` inner join zone z
on z.zoneCode=br.ZoneID
union all
SELECT `deptCode` code , concat(trim(`DeptName`),' Head Office') office,6 loc FROM `department` WHERE 1
union all
SELECT `ZaoCode` code , concat(trim(`Zao_en`),' zonal Audit Office') office,3 loc FROM `zao` WHERE 1
union all
SELECT `zoneCode`,concat(trim(`Zone_en`),' zone') office,2 loc FROM `zone` WHERE 1
) tbo
on tb.office=tbo.code
order by CONVERT(tb.cnt, INT) desc
";



$result = mysqli_query($conn, $sql);
$mpdf->WriteHTML($pdfcontent);
$mpdf->Ln(5);
$mpdf->WriteHTML('List of Branches Having More Than '.$empno.' Employee');
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
<div class="panel-heading" style="background-color:#008836;color: white; font-size:16px;">Select Number of Employee</div>
<div class="panel-body" style="border:1px solid green;  background-color:#f0f5f5;">
<div class="form-group">
	  
	  <select class="form-control empno" id="empno" name="empno">
		<option selected value="0">--Select--</option>
		<?php 
			for ($x = 1; $x <= 30; $x++) {
				echo '<option value="'.$x;
				if($d_year_JAIBB==$x){
					echo '" selected="selected" >'.$x.'</option>';
				}
				else{
					echo '" >'.$x.'</option>';
				}					
			}
		?>

	</select>
</div>
<div>


	 <input type="submit" value='Get Report' name="submit" class="btn btn-success"> 
	<a class="btn btn-primary"  href="../pmisreport.php" >
     <span class="glyphicon glyphicon-step-backward" aria-hidden="true" style="align:right"></span>
     <span><strong>Back</strong></span>            
	</a>
</div>
<div>

</div>
</div>
</div>
</div>
</div>

</form>

</body>


</html>
<?php include 'templates/footer.php';?>
