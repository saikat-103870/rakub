

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
		<td><img src="rakub.png" width="115" height="100">
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
				<th>Emp. Id</th>
				<th>Name</th>
				<th>Currently Working As</th>
				<th>Office</th>
				<th>Contact</th>
				
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
			<td>'.$row['TrackingNo'].'</td>
			<td>'.$row['Name'].' </td>
			
			
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

$sql='SELECT distinct i.*,c.*,d.* from inquiry i INNER JOIN individual c 
on i.TrackingNo=c.TrackingNo inner join branch d on i.BranchId=d.brcode 
where i.TrackingNo=06012202201';



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

<?php include 'templates/footer.php';?>
