
<?php 
function printTable(&$result) //mysqli result set
{
	$txt='';
    /**  Set up Table and Headers **/
    $fieldinfo = $result->fetch_fields();
    $txt.='<table class="pmis" style="border:1px solid black;border-collapse:collapse;" >' . "\n";
    $txt.='<tr class="header" style="border:1px solid black; background-color: #e0e0eb">' . "\n";
     $txt.= '<td  style="border:1px solid black;" >SL#</td>';
	foreach ($fieldinfo as $fieldval) {
        $txt.= '<td  style="border:1px solid black;" >'.$fieldval->name."</td>\n";
    }
    $txt.="</tr>\n";

    /** dump rows **/
	$kn=1;
    while($row = $result->fetch_assoc()) {
        $txt.='<tr style="border:1px solid black;">';
        foreach ($row as $column) {
            $txt.='<td  style="border:1px solid black;" >'.$kn.'</td><td style="border:1px solid black;" >'.$column."</td>\n";
        }
        $txt.="</tr>";
		$kn++;
    }
     $txt.="</table>\n";

    /**  gc  **/
    $result->free();
	return $txt;
}

?>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
<?php
// Include mpdf library file
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();
include '../config.php';
// Database Connection 

$sql="select  tb.emp_id 'Emp. Id',tb.name_eng Name, tb.designation,tbo.office 'Posting Place',tb.joiningDate,datediff(CURDATE(),tb.joiningDate) Duration
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
on tb.office=tbo.code and tb.PrPostingLoc=tbo.loc
where datediff(CURDATE(),tb.joiningDate)>1095
order by datediff(CURDATE(),tb.joiningDate) desc";

$result = mysqli_query($conn, $sql);


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