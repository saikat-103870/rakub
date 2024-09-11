<?php

include 'mpdf.php';
require_once __DIR__ . '/vendor/autoload.php';
include '../config.php';
session_start();
$empid='';
if(isset($_SESSION['empid']))
{		
$empid=trim($_SESSION['empid']);
}
else
{	
	header("Location:../login.php");
	exit;
}


function CDate($string) {
    $datenew='';
	if($string != '0000-00-00'){
		$datenew=date("d-m-Y",strtotime(str_replace('/', '-', $string)));
	}
	return $datenew;
}

class my extends \Mpdf\Mpdf{
	//custom function


	var $widths;
	var $aligns;
	var $lineHeight=5;

	function GetX()
	{
		// Get x position
		return $this->x;
	}


	function GetY()
	{
		// Get y position
		return $this->y;
	}

	//Set the array of column widths
	function SetWidths($w){
		$this->widths=$w;
	}

	//Set the array of column alignments
	function SetAligns($a){
		$this->aligns=$a;
	}


	//Calculate the height of the row
	function Row($data, $bn=0)
	{
		// number of line
		$nb=1;

		// loop each data to find out greatest line number in a row.
		for($i=0;$i<count($data);$i++){
			// NbLines will calculate how many lines needed to display text wrapped in specified width.
			// then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
			if($i==2 || $i==5){
				$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
			}
		}
		
		//multiply number of line with line height. This will be the height of current row
		$h=$this->lineHeight * $nb;

		//Issue a page break first if needed
		$this->CheckPageBreak($h);

		//Draw the cells of current row
		for($i=0;$i<count($data);$i++)
		{
			// width of the current col
			$w=$this->widths[$i];
			// alignment of the current col. if unset, make it left.
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			//Print the text
			if($i==0 || $i==3){
				$this->printDataPr($this,$data[$i]);
			}
			else{
				if($bn==0){
					$this->MultiCell($w,5,$data[$i],0,$a);
				}
				else if($bn==1){
					if($i==2){
						$this->MultiCell($w,5,$data[$i],0,$a);
					}
					else{
						$this->SetFont('nikosh','',10);
						$this->MultiCell($w,5,$data[$i],0,$a);
						$this->SetFont('Times','',9);
					}
				}
			}
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
	function Row2($data)
	{
		// number of line
		$nb=0;

		// loop each data to find out greatest line number in a row.
		for($i=0;$i<count($data);$i++){
			// NbLines will calculate how many lines needed to display text wrapped in specified width.
			// then max function will compare the result with current $nb. Returning the greatest one. And reassign the $nb.
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		}
		
		//multiply number of line with line height. This will be the height of current row
		$h=$this->lineHeight * $nb;

		//Issue a page break first if needed
		$this->CheckPageBreak($h);

		//Draw the cells of current row
		for($i=0;$i<count($data);$i++)
		{
			// width of the current col
			$w=$this->widths[$i];
			// alignment of the current col. if unset, make it left.
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,5,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{

		// Output text with automatic or explicit line breaks
		$cw = &$this->CurrentFont['cw'];

		if ($w == 0) {
			$w = $this->w - $this->rMargin - $this->x;
		}

		$wmax = ($w - ($this->cMarginL + $this->cMarginR));

		if ($this->usingCoreFont) {
			$s = str_replace("\r", '', $txt);
			$nb = strlen($s);
			while ($nb > 0 and $s[$nb - 1] == "\n") {
				$nb--;
			}
		} else {
			$s = str_replace("\r", '', $txt);
			$nb = mb_strlen($s, $this->mb_enc);
			while ($nb > 0 and mb_substr($s, $nb - 1, 1, $this->mb_enc) == "\n") {
				$nb--;
			}
		}

		$b = 0;

		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$ns = 0;
		$nl = 1;

		$rows = 0;
		$start_y = $this->y;

		if (!$this->usingCoreFont) {

			while ($i < $nb) {

				// Get next character
				$c = mb_substr($s, $i, 1, $this->mb_enc);

				if ($c === "\n") { // Explicit line break

					$i++;
					$sep = -1;
					$j = $i;
					$l = 0;
					$ns = 0;
					$nl++;

					continue;
				}

				if ($c == " ") {
					$sep = $i;
					$ls = $l;
					$ns++;
				}

				$l += $this->GetCharWidthNonCore($c);

				if ($l > $wmax) {

					// Automatic line break
					if ($sep == -1) { // Only one word

						if ($i == $j) {
							$i++;
						}
					} else {
						$i = $sep + 1;
					}
					$sep = -1;
					$j = $i;
					$l = 0;
					$ns = 0;
					$nl++;

				} else {
					$i++;
				}
			}
			return $nl;

		} else {

			while ($i < $nb) {

				// Get next character
				$c = $s[$i];
				if ($c === "\n") {

					$i++;
					$sep = -1;
					$j = $i;
					$l = 0;
					$ns = 0;
					$nl++;

					continue;
				}

				if ($c === ' ') {
					$sep = $i;
					$ls = $l;
					$ns++;
				}

				$l += $this->GetCharWidthCore($c);

				if ($l > $wmax) {

					// Automatic line break
					if ($sep == -1) {

						if ($i == $j) {
							$i++;
						}
					} else {
						$i = $sep + 1;
					}

					$sep = -1;
					$j = $i;
					$l = 0;
					$ns = 0;
					$nl++;

				} else {
					$i++;
				}
			}
			return $nl;
		}
	}
	
	
	function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-($this->cMarginL+ $this->cMarginR)*2)/$str_width;

        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-($this->cMarginL+ $this->cMarginR)*2-$str_width)/max(strlen($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
	//Cell with horizontal scaling only if necessary
    function CellFitScale($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,true,false);
    }
	
	//Print Function for Personal
	function printDataPr($pdf,$value){
		$pdf->SetFont('Times','B',10);
		$pdf->CellFitScale(42,5,$value,0,0);
		$pdf->SetFont('Times','',9);
	}
		//Geting location from location code
	function getDistrict($conn,$pdf,$code,$table,$tabCode,$tabName){
		$p="select ".$tabName." from ".$table." where ".$tabCode."='".trim($code)."'";
		$pp=mysqli_query($conn,$p);
		$value=' ';
		if($pp->num_rows>0){
			$value=mysqli_fetch_object($pp)->$tabName;
		}
		return $value;
	}
	function getDiv($conn,$pdf,$code,$table,$tabName,$tabCode){
		$p="select ".$tabName." from ".$table." where ".$tabCode."='".trim($code)."'";
		$pp=mysqli_query($conn,$p);
		$value=' ';
		if($pp->num_rows>0){
			$value=mysqli_fetch_object($pp)->$tabName;
		}
		return $value;
	}
	function getPS($conn,$pdf,$Code1,$Code2,$Code3,$table,$tabName){
		$p="select ".$tabName." from ".$table." where DivisionCode='".trim($Code1)."' and DistrictCode='".trim($Code2)."' and UpazillaCode='".trim($Code3)."'";
		$pp=mysqli_query($conn,$p);
		$value=' ';
		if($pp->num_rows>0){
			$value=mysqli_fetch_object($pp)->$tabName;
		}
		return $value;
	}
	function getPO($conn,$pdf,$Code1,$Code2,$Code3,$Code4,$table,$tabName){
		$p="select ".$tabName." from ".$table." where DivisionCode='".trim($Code1)."' and DistrictCode='".trim($Code2)."' and UpazillaCode='".trim($Code3)."' and Unioncode='".trim($Code4)."'";
		$pp=mysqli_query($conn,$p);
		$value=' ';
		if($pp->num_rows>0){
			$value=mysqli_fetch_object($pp)->$tabName;
		}
		return $value;
	}
	
	function Footer()
	{
		// Go to 1.5 cm from bottom
		$this->SetY(-15);
		// Select Times bold 8
		$this->SetFont('Times','B',8);
		// Print right aligned page number
		$this->Cell(0,10,$this->PageNo().'/{nb}',0,0,'R');
	}
}

$pdf=new my([]);

$pdf->AliasNbPages();
$pdf->AddPage('P','A4','0');
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(10);
$pdf->SetTopMargin(7);

//$mpdf->WriteHTML($html);
$pdf->Image('../rakub.png',75,7,15,15);
$pdf->SetFont('Arial','B',12);
$pdf->Ln(-12);
$pdf->Cell(205,5,'Rajshahi Krishi Unnayan Bank',0,0,'C');
$pdf->Ln();
$pdf->SetFont('Times','',9);
$pdf->Cell(205,5,'Head Office, Rajshahi',0,0,'C');
$pdf->Ln(5);
		
$data=mysqli_query($conn,'select `photo`, `emp_id` from `personal` where `emp_id`='.$empid);
$photo=mysqli_fetch_assoc($data);

$pdf->Image('../photo/'.$photo['photo'],180,7,20,20);
$pdf->SetY(27);
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'Personal Information',0,0);
$pdf->Ln();
$pdf->Line(20,$pdf->y,200,$pdf->y);

$pdf->SetWidths(Array(42,3,45,42,3,45));

$pdf->SetFont('Times','',9);

$data=mysqli_query($conn,'select * from `personal` where `emp_id`='.$empid);
while($row=mysqli_fetch_array($data)){
	//Personal Information
	$pdf->Row(Array('Employee PIN/Personnel No.',':',empty($row['emp_id'])? ' ': $row['emp_id'],
		'Nationality',':',empty($row['nationality'])? ' ': $row['nationality']));
	$pdf->Row(Array('Name (In English)',':',empty($row['name_eng'])? ' ': $row['name_eng'],
					'Name (In Bengali)',':',empty($row['name_ban'])? ' ': $row['name_ban']),1);
	$pdf->Row(Array('Father\'s Name',':',empty($row['father_name'])? ' ': $row['father_name'],
					'Mother\'s Name',':',empty($row['mother_name'])? ' ': $row['mother_name']));
	$pdf->Row(Array('Home District',':',$pdf->getDistrict($conn,$pdf,empty($row['homedistrict'])? ' ': $row['homedistrict'],'location','DistrictCode','DistrictName'),
					'Date of Birth',':',$row['dob']=='0000-00-00'? ' ': CDate($row['dob'])));
	$pdf->Row(Array('Gender',':',empty($row['gender'])? ' ': $row['gender'],
					'Religion',':',empty($row['religion'])? ' ': $row['religion']));
	$pdf->Row(Array('Blood Group',':',empty($row['bloodgroup'])? ' ': $row['bloodgroup'],
					'Marital Status',':',empty($row['marital'])? ' ': $row['marital']));
	$pdf->Row(Array('NID No.',':',empty($row['nid'])? ' ': $row['nid'],
					'Personal Email Address',':',empty($row['email_pr'])? ' ': $row['email_pr']));
	$pdf->Row(Array('Personal Mobile.',':',empty($row['mobile_pr'])? ' ': $row['mobile_pr'],
					'Emergency Contact No.',':',empty($row['emergency_contact'])? ' ': $row['emergency_contact']));
	$pdf->Row(Array('Passport No.',':',empty($row['passport'])? ' ': $row['passport'],
					'e-TIN No.',':',empty($row['etin'])? ' ': $row['etin']));				
	$pdf->Ln();
			
	//Permanent Address
	$perAddress='Village: '.(empty($row['per_vill'])? '--': $row['per_vill']).', Post Office: '.(empty($row['per_postoffice'])? '--': $row['per_postoffice']).', Police Station/City Corporation: '.($pdf->getPS($conn,$pdf,$row['per_div'],$row['per_dist'],empty($row['per_ps'])? ' ': $row['per_ps'],'location','UpazillaName')).', District: '.($pdf->getDistrict($conn,$pdf,empty($row['per_dist'])? ' ': $row['per_dist'],'location','DistrictCode','DistrictName')).', Division: '.($pdf->getDiv($conn,$pdf,empty($row['per_div'])? ' ': $row['per_div'],'location','DivisionName','DivisionCode')); 
	
	$pdf->SetFont('Times','B',10);
	$pdf->CellFitScale(35,5,'Permanent Address',0,0);
	$pdf->SetFont('Times','',9);
	$pdf->CellFitScale(3,5,':',0,0);
	$pdf->MultiCell(140,5,$perAddress,0,'L');
	$pdf->Ln();

	//Present Address
	$preAddress='Village: '.(empty($row['pre_vill'])? '--': $row['pre_vill']).', Post Office: '.(empty($row['pre_postoffice'])? '--': $row['pre_postoffice']).', Police Station/City Corporation: '.($pdf->getPS($conn,$pdf,$row['pre_div'],$row['pre_dist'],empty($row['pre_ps'])? ' ': $row['pre_ps'],'location','UpazillaName')).', District: '.($pdf->getDistrict($conn,$pdf,empty($row['pre_dist'])? ' ': $row['pre_dist'],'location','DistrictCode','DistrictName')).', Division: '.($pdf->getDiv($conn,$pdf,empty($row['pre_div'])? ' ': $row['pre_div'],'location','DivisionName','DivisionCode')); 
	
	$pdf->SetFont('Times','B',10);
	$pdf->CellFitScale(35,5,'Present Address',0,0);
	$pdf->SetFont('Times','',9);
	$pdf->CellFitScale(3,5,':',0,0);
	$pdf->MultiCell(140,5,$preAddress,0,'L');
	$pdf->Ln();
	
	//Professional Information	
	$pdf->SetFont('Times','B','12');
	$pdf->Cell(200,5,'Professional Information',0,0);
	$pdf->Ln();
	$pdf->Line(20,$pdf->GetY(),200,$pdf->GetY());
	$pdf->SetFont('Times','','10');
	
	$pdf->Row(Array('Personal File No',':',empty($row['PersonalFileNo'])? ' ': $row['PersonalFileNo'],
					'Designation',':',empty($row['designation'])? ' ': $row['designation']));
	$pdf->Row(Array('Currently Working As',':',empty($row['official_desig'])? ' ': $row['official_desig'],
					'Joining Date in the bank',':',$row['date_joinbank']=='0000-00-00'? ' ': CDate($row['date_joinbank'])));
	$pdf->Row(Array('Joining Designation',':',empty($row['designation_join'])? ' ': $row['designation_join'],
					'Office Mobile',':',empty($row['mobile_office'])? ' ': $row['mobile_office']));
	$pdf->Row(Array('Present Place of Posting',':',empty($row['postingplace'])? ' ': $row['postingplace']));
	
	$pdf->Ln();
	
	//Banking Diploma	
	$diploma=(empty($row['d_rollno_JAIBB'])? ' ': 'JAIBB ').(empty($row['d_rollno_DAIBB'])? ' ': ',DAIBB'); 
	
	$pdf->SetFont('Times','B',10);
	$pdf->CellFitScale(35,5,'Banking Diploma',0,0);
	$pdf->SetFont('Times','',9);
	$pdf->CellFitScale(3,5,':',0,0);
	$pdf->MultiCell(140,5,$diploma,0,'L');
	$pdf->Ln();
	

}

//Spouse Information
$pdf->SetY($pdf->GetY());
$pdf->SetWidths(Array(60,60));
$pdf->SetFont('Times','B',10);
$pdf->Row2(Array('Spouse Name','Contact No.'));
$pdf->SetFont('nikosh','',10);
	
$data=mysqli_query($conn,'select * from `spouse` where `emp_id`='.$empid.' order by spId desc');
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['sp_name'])? '--': $row['sp_name'],
						empty($row['sp_contact'])? '--': $row['sp_contact']
						));		
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(120));
	$pdf->Row2(Array('No Spouse Data Found'));
	$pdf->Ln();
}


//Education Information

$sql='select * from `education` where `emp_id`='.$empid.' ORDER BY examRank desc limit 1';
$data=mysqli_query($conn,$sql);

$lastEdu='';
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$lastEdu.=(empty($row['examName'])? ' ': $row['examName']." in ").(empty($row['GroupSubject'])? ' ': $row['GroupSubject']);
	}
}
else{
$lastEdu.=" Not Mentioned";
}
$pdf->SetFont('Times','B',10);
	$pdf->CellFitScale(35,5,'Last Education',0,0);
	$pdf->SetFont('Times','',9);
	$pdf->CellFitScale(3,5,':',0,0);
	$pdf->MultiCell(140,5,$lastEdu,0,'L');
	$pdf->Ln();
//প্রত্যয়ন


$pdf->SetWidths(Array(42,3,45,42));

$pdf->SetFont('Times','',9);


while($row=mysqli_fetch_array($data)){
$pdf->Row(Array($row['name_ban']),1);
					

}
//===============================

//Signature
$data=mysqli_query($conn,'select `signature` from `personal` where `emp_id`='.$empid);
$sign=mysqli_fetch_assoc($data);

$pdf->Image('../photo/'.$sign['signature'],$pdf->GetX()+127,$pdf->GetY()+5,45,12);
$pdf->SetFont('Times','B',12);
$pdf->Cell(160,5,'Signature',0,0,'R');
$pdf->Ln();

$pdf->Output($empid.'_short_pds.pdf','I');


?>
