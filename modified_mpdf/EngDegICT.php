

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
		<td><img src="rakub.png" width="75" height="72">
		<td align="center"><h2>Rajshahi Krishi Unnayan Bank</h2>
		<p style="text-align:center;font-size: 17px;">Head Office, Rajshahi</p></td></tr>
		</table>
		';	
//page Nubering Function


//print Result
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
				<th>Office</th>
				<th>Contact No.</th>
				<th>Subject</th>
				<th>Degree Name</th>
				<th>University</th>
		</tr>';


    /** dump rows **/
	$kn=1;
    while($row = $result->fetch_assoc()) 
	{
			/*$d1 = date_create(date("Y-m-d"));
			$d2 = date_create($row['joiningDate']);
			$interval = date_diff($d1, $d2);
			$d=$interval->format('%yY %mM %dD');*/
			
			$txt.='<tr>
			
			<td>'.$kn.' </td>
      <th>Loan Type</th> <th>:</th> <td><?php '.$row['FatherTitle'].' ?></td> 
			<td>'.$row['FatherTitle'].'</td>
			<td>'.$row['designation'].'</td>
			<td>'.$row['office'].'</td>
			<td>'.$row['mobile_pr'].'</td>
			<td>'.$row['GroupSubject'].'</td>
			<td>'.$row['examName'].'</td>
			<td>'.$row['BoardUniversity'].'</td>
			<tr>
      <th>Loan Type</th> <th>:</th> <td><?php echo .$row['Name'].; ?></td> 
	     <th>Institution Information:</th> <th>:</th><td><?php $row['Name']; ?></td> 
		    <th>FI Subject Code</th><th>:</th> <td><?php echo $FISubCode; ?></td> 
		 </tr>
			<tr>';

		$kn++;
    }
     $txt.="</table>\n";


    $result->free();
	return $txt;
}


	


$sql='SELECT distinct i.*,c.*,d.* from inquiry i INNER JOIN individual c 
on i.TrackingNo=c.TrackingNo inner join branch d on i.BranchId=d.brcode 
where i.TrackingNo=12122201251';



$result = mysqli_query($conn, $sql);
$mpdf->WriteHTML($pdfcontent);
$mpdf->Ln(5);
$mpdf->WriteHTML('Employee List Those Have Engineering/Equivalent(Other Engineering) Degree');
$mpdf->Ln();

//call watermark content and image
$mpdf->SetWatermarkText('ICT Department, RAKUB');
//$mpdf->showWatermarkText = true;
$mpdf->watermarkTextAlpha = 0.1;
//page number
//$mpdf->setFooter('|{PAGENO} of {nbpg}|');
$mpdf->WriteHTML(printTable($result));

$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0; 



//output in browser
$mpdf->Output();	

	
?>



