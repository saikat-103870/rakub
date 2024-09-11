

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
//ini_set('display_errors','off');

$pdfcontent = '
		<table align="center">
		<tr>
		<td><img src="../rakub.png" width="75" height="72">
		<td align="center"><h2>Rajshahi Krishi Unnayan Bank</h2>
		<p style="text-align:center;font-size: 17px;">Head Office, Rajshahi</p></td></tr>
		</table>
		';	
function printTable(&$result) //mysqli result set
{
	$txt='';
    /**  Set up Table and Headers **/
	
    $fieldinfo = $result->fetch_fields();
	
	$txt.='<table border ="1" cellspacing="0" cellpadding="10">
			<tr>
				<th>SL#</th>
				<th>Emp. Id</th>
				<th>Name</th>
				<th>Designation</th>
				<th>Department Name</th>
				<th>Joining Date</th>
				<th>Duration</th>
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
			<td>'.$row['emp_id'].'</td>
			<td>'.$row['Name'].' </td>
			<td>'.$row['designation'].' </td>
			<td>'.$row['office'].' </td>
			<td>'.$row['joiningDate'].' </td>
			<td>'.$d.'</td>
			<tr>';

		$kn++;
    }
     $txt.="</table>\n";


    $result->free();
	return $txt;
}


	


$sql="select  tb.emp_id,tb.name_eng Name, tb.designation,tbo.office,tb.joiningDate,datediff(CURDATE(),tb.joiningDate) Duration
from 
(select p.emp_id,p.name_eng,p.`designation`,p.`PrPostingLoc`,p.`prPostingZone`,p.`PrPostingBr`,p.`date_joinbank`,t.joinDate,
case
WHEN t.joinDate is null THEN p.`date_joinbank`
WHEN t.joinDate is not null THEN t.joinDate
END as joiningDate,
CASE
 WHEN p.PrPostingLoc=1 THEN PrPostingBr
 WHEN p.PrPostingLoc>1 THEN prPostingZone
 END as office
from personal p 
LEFT JOIN 
(SELECT `emp_id`,max(`date_jointransfer`) joinDate FROM `transfer` group by emp_id) t
on p.emp_id=t.emp_id) tb
INNER JOIN 
(
SELECT `deptCode` code , `DeptName` office,6 loc FROM `department` WHERE 1
) tbo
on tb.office=tbo.code and tb.PrPostingLoc=tbo.loc
where tb.designation IN ('Senior Officer','Principal Officer','Senior Principal Officer','Assistant General Manager','Deputy General Manager')
order by datediff(CURDATE(),tb.joiningDate) desc;";



$result = mysqli_query($conn, $sql);
$mpdf->WriteHTML($pdfcontent);



$mpdf->WriteHTML(printTable($result));

$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0; 

//call watermark content and image
$mpdf->SetWatermarkText('etutorialspoint');
//$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;

//output in browser
$mpdf->Output();	

	
?>



