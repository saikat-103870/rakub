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
	$pdf->Row(Array('Father\'s Contact No.',':',empty($row['father_contact'])? ' ': $row['father_contact'],
					'Mother\'s Contact No.',':',empty($row['mother_contact'])? ' ': $row['mother_contact']));
	$pdf->Row(Array('Birth Place',':',$pdf->getDistrict($conn,$pdf,empty($row['birth_district'])? ' ': $row['birth_district'],'location','DistrictCode','DistrictName'),
					'Date of Birth',':',$row['dob']=='0000-00-00'? ' ': CDate($row['dob'])));
	$pdf->Row(Array('Gender',':',empty($row['gender'])? ' ': $row['gender'],
					'Religion',':',empty($row['religion'])? ' ': $row['religion']));
	$pdf->Row(Array('Blood Group',':',empty($row['bloodgroup'])? ' ': $row['bloodgroup'],
					'Home District',':',$pdf->getDistrict($conn,$pdf,empty($row['homedistrict'])? ' ': $row['homedistrict'],'location','DistrictCode','DistrictName')));
	$pdf->Row(Array('NID No.',':',empty($row['nid'])? ' ': $row['nid'],
					'Birth Certificate No.',':',empty($row['birth_certificate'])? ' ': $row['birth_certificate']));
	$pdf->Row(Array('Marital Status',':',empty($row['marital'])? ' ': $row['marital'],
					'Hobby',':',empty($row['hobby'])? ' ': $row['hobby']));
	$pdf->Row(Array('Personal Mobile.',':',empty($row['mobile_pr'])? ' ': $row['mobile_pr'],
					'Emergency Contact No.',':',empty($row['emergency_contact'])? ' ': $row['emergency_contact']));
	$pdf->Row(Array('Passport No.',':',empty($row['passport'])? ' ': $row['passport'],
					'e-TIN No.',':',empty($row['etin'])? ' ': $row['etin']));
	$pdf->Row(Array('Personal Email Address',':',empty($row['email_pr'])? ' ': $row['email_pr']));
					
	$pdf->Ln();
			
	//Permanent Address
	$pdf->SetFont('Times','B','12');
	$pdf->Cell(200,5,'Permanent Address',0);
	$pdf->Ln();
	$pdf->Line(20,$pdf->GetY(),200,$pdf->GetY());
	$pdf->SetFont('Times','','10');
	
	$pdf->Row(Array('Village',':',empty($row['per_vill'])? ' ': $row['per_vill'],
					'House No',':',empty($row['per_house'])? ' ': $row['per_house']));
	$pdf->Row(Array('Road/Block/Sector',':',empty($row['per_road'])? ' ': $row['per_road'],
					'Post Office',':',empty($row['per_postoffice'])? ' ': $row['per_postoffice']));
	$pdf->Row(Array('Union/Ward No.',':',$pdf->getPO($conn,$pdf,$row['per_div'],$row['per_dist'],$row['per_ps'],empty($row['per_po'])? ' ': $row['per_po'],'location','UnionName'),
					'Police Station/City Corporation',':',$pdf->getPS($conn,$pdf,$row['per_div'],$row['per_dist'],empty($row['per_ps'])? ' ': $row['per_ps'],'location','UpazillaName')));
	$pdf->Row(Array('District',':',$pdf->getDistrict($conn,$pdf,empty($row['per_dist'])? ' ': $row['per_dist'],'location','DistrictCode','DistrictName'),
					'Division',':',$pdf->getDiv($conn,$pdf,empty($row['per_div'])? ' ': $row['per_div'],'location','DivisionName','DivisionCode')));
	$pdf->ln();
	
	//Present Address
	$pdf->SetFont('Times','B','12');
	$pdf->Cell(200,5,'Present Address',0,0);
	$pdf->Ln();
	$pdf->Line(20,$pdf->GetY(),200,$pdf->GetY());
	$pdf->SetFont('Times','','10');
	
	$pdf->Row(Array('Village',':',empty($row['pre_vill'])? ' ': $row['pre_vill'],
					'House No',':',empty($row['pre_house'])? ' ': $row['pre_house']));
	$pdf->Row(Array('Road/Block/Sector',':',empty($row['pre_road'])? ' ': $row['pre_road'],
					'Post Office',':',empty($row['pre_postoffice'])? ' ': $row['pre_postoffice']));
	$pdf->Row(Array('Union/Ward No.',':',$pdf->getPO($conn,$pdf,$row['pre_div'],$row['pre_dist'],$row['pre_ps'],empty($row['pre_po'])? ' ': $row['pre_po'],'location','UnionName'),
					'Police Station/City Corporation',':',$pdf->getPS($conn,$pdf,$row['pre_div'],$row['pre_dist'],empty($row['pre_ps'])? ' ': $row['pre_ps'],'location','UpazillaName')));
	$pdf->Row(Array('District',':',$pdf->getDistrict($conn,$pdf,empty($row['pre_dist'])? ' ': $row['pre_dist'],'location','DistrictCode','DistrictName'),
					'Division',':',$pdf->getDiv($conn,$pdf,empty($row['pre_div'])? ' ': $row['pre_div'],'location','DivisionName','DivisionCode')));
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
					'Joining Scale',':',empty($row['joiningscale'])? ' ': $row['joiningscale']));
	$pdf->Row(Array('Present Place of Posting',':',empty($row['postingplace'])? ' ': $row['postingplace'],
					'Joining Date at Present Place',':',$row['date_present']=='0000-00-00'? ' ': CDate($row['date_present'])));
	$pdf->Row(Array('Last Promotion Date',':',$row['date_promotion']=='0000-00-00'? ' ': CDate($row['date_promotion']),
					'Promotion Date As Officer',':',$row['promotionDtOfficer']=='0000-00-00'? ' ': CDate($row['promotionDtOfficer'])));
	$pdf->Row(Array('Freedom Fighter (Self)',':',empty($row['FreedomFighterSelf'])? ' ': $row['FreedomFighterSelf'],
					'Quota Availed',':',empty($row['QuotaAvailed'])? ' ': $row['QuotaAvailed']));
	$pdf->Row(Array('PRL Start Date',':',$row['date_prlstart']=='0000-00-00'? ' ': CDate($row['date_prlstart']),
					'Date of Retirement',':',$row['date_retirement']=='0000-00-00'? ' ': CDate($row['date_retirement'])));
	$pdf->Row(Array('Employee Status',':',empty($row['status_employee'])? ' ': $row['status_employee'],
					'Employment Status',':',empty($row['status_employment'])? ' ': $row['status_employment']));
	$pdf->Row(Array('Provident Fund Type',':',empty($row['pftype'])? ' ': $row['pftype'],
					'Date of Job Confirmation',':',$row['date_jobconfirm']=='0000-00-00'? ' ': CDate($row['date_jobconfirm'])));
	$pdf->Row(Array('Police Verification Completed',':',empty($row['policeverification'])? ' ': $row['policeverification'],
					'Present Salary Scale',':',empty($row['scale_present'])? ' ': $row['scale_present']));
	$pdf->Row(Array('Present Basic Pay',':',empty($row['basicpay'])? ' ': $row['basicpay'],
					'Benevolent No',':',empty($row['bvno'])? ' ': $row['bvno']));
	$pdf->Row(Array('Date of Last Increment',':',$row['increment_last']=='0000-00-00'? ' ': CDate($row['increment_last']),
					'GPF Number',':',empty($row['pfno'])? ' ': $row['pfno']));
	$pdf->Row(Array('GPF Subscription Rate (%)',':',empty($row['pf_rate'])? ' ': $row['pf_rate'],
					'Surety Name',':',empty($row['guarantee_name'])? ' ': $row['guarantee_name']));
	$pdf->Row(Array('Surety Address',':',empty($row['guarantee_address'])? ' ': $row['guarantee_address'],
					'Surety Amount',':',empty($row['guarantee_amount'])? ' ': $row['guarantee_amount']));
	$pdf->Row(Array('Cash Security Account No',':',empty($row['account_security'])? ' ': $row['account_security'],
					'Office Mobile',':',empty($row['mobile_office'])? ' ': $row['mobile_office']));
	$pdf->Row(Array('Telephone No',':',empty($row['telephone'])? ' ': $row['telephone'],
					'Official Email Address',':',empty($row['email_office'])? ' ': $row['email_office']));
	$pdf->Row(Array('Salary Account No.',':',empty($row['account_salary'])? ' ': $row['account_salary']));
					
	$pdf->Ln();

	$pdf->SetFont('Times','B',10);
	$pdf->CellFitScale(42,5,'Extra Curriculum',0,0);
	$pdf->SetFont('Times','',9);
	$pdf->CellFitScale(3,5,':',0,0);
	$pdf->MultiCell(135,5,empty($row['extra_curri'])? ' ': $row['extra_curri'],0,'L');
	$pdf->Ln(20);
	
	$pdf->SetLeftMargin(20);
	//Banking Diploma	
	$pdf->SetFont('Times','B','12');
	$pdf->Cell(200,5,'Banking Diploma',0,0);
	$pdf->Ln();
	$pdf->Line(20,$pdf->GetY(),200,$pdf->GetY());
	$pdf->SetFont('Times','','9');
	
	$pdf->SetLeftMargin(20);

	//$pdf->Line($pdf->GetX()+95, $pdf->GetY(), $pdf->GetX()+95, $pdf->GetY()+20);
	$pdf->Row(Array('Diploma Part-1',':',empty($row['diploma_JAIBB'])? ' ': $row['diploma_JAIBB'],
					'Diploma Part-2',':',empty($row['diploma_DAIBB'])? ' ': $row['diploma_DAIBB']));
	$pdf->Row(Array('Enrollment No',':',empty($row['d_enrollno_JAIBB'])? ' ': $row['d_enrollno_JAIBB'],
					'Enrollment No',':',empty($row['d_enrollno_DAIBB'])? ' ': $row['d_enrollno_DAIBB']));
	$pdf->Row(Array('Roll No',':',empty($row['d_rollno_JAIBB'])? ' ': $row['d_rollno_JAIBB'],
					'Roll No',':',empty($row['d_rollno_DAIBB'])? ' ': $row['d_rollno_DAIBB']));
	$pdf->Row(Array('Passing Year',':',empty($row['d_year_JAIBB'])? ' ': $row['d_year_JAIBB'],
					'Passing Year',':',empty($row['d_year_DAIBB'])? ' ': $row['d_year_DAIBB']));
	$pdf->Row(Array('Passing Month',':',empty($row['d_month_JAIBB'])? ' ': $row['d_month_JAIBB'],
					'Passing Month',':',empty($row['d_month_DAIBB'])? ' ': $row['d_month_DAIBB']));
	$pdf->Ln();
	
	//Study Permission Given By Bank	
	$pdf->SetFont('Times','B','12');
	$pdf->Cell(200,5,'Study Permission Given By Bank',0,0);
	$pdf->Ln();
	$pdf->Line(20,$pdf->GetY(),200,$pdf->GetY());
	$pdf->SetFont('Times','','9');
	
	$pdf->Row(Array('Approval Authority',':',empty($row['st_authority'])? ' ': $row['st_authority'],
					'Letter Reference No',':',empty($row['st_ref'])? ' ': $row['st_ref']));
	$pdf->Row(Array('Issuing Date',':',$row['st_date']=='0000-00-00'? ' ': CDate($row['st_date']),
					'Degree/Diploma/Course',':',empty($row['st_degree'])? ' ': $row['st_degree']));
	$pdf->Row(Array('Field Experience',':',empty($row['field_exp'])? ' ': $row['field_exp']));
	
	
	$pdf->Ln();

}

$pdf->SetLeftMargin(15);
$pdf->AliasNbPages();
$pdf->AddPage('L','A4','0');

//Spouse Information
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'Spouse Information',0,0);
$pdf->Ln(8);

$pdf->SetFont('Times','B',10);
$pdf->SetWidths(Array(25,18,20,20,20,18,22,22,30,27,26,25));
$pdf->Row2(Array('Name','Gender','Father\'s Name','Mother\'s Name','Date of Birth',
				'Relation','National ID No.','Contact No.','Present Address','Organization','Organization Address','Designation/ Profession'));
$pdf->SetFont('nikosh','',10);
	
$data=mysqli_query($conn,'select * from `spouse` where `emp_id`='.$empid.' order by spId desc');
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['sp_name'])? ' ': $row['sp_name'],
						empty($row['sp_gender'])? ' ': $row['sp_gender'],
						empty($row['sp_father'])? ' ': $row['sp_father'],
						empty($row['sp_mother'])? ' ': $row['sp_mother'],
						$row['sp_dob']=='0000-00-00'? ' ': CDate($row['sp_dob']),
						empty($row['sp_relation'])? ' ': $row['sp_relation'],
						empty($row['sp_nid'])? ' ': $row['sp_nid'],
						empty($row['sp_contact'])? ' ': $row['sp_contact'],
						empty($row['sp_address'])? ' ': $row['sp_address'],
						empty($row['sp_org'])? ' ': $row['sp_org'],
						empty($row['sp_orgaddress'])? ' ': $row['sp_orgaddress'],
						empty($row['sp_desi'])? ' ': $row['sp_desi']
						));		
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(273));
	$pdf->Row2(Array('No Spouse Data Found'));
	$pdf->Ln();
}


//Children Information
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'Children Information',0,0);
$pdf->Ln(8);

$pdf->SetFont('Times','B',10);
$pdf->SetWidths(Array(30,30,30,30,30,30,30,30,30));
$pdf->Row2(Array('Child Name','Gender','Nationality','Country Residence','National ID No.',
				'Birth Cert. No.','Date of Birth','Disable','Last Education Qualification'));
$pdf->SetFont('nikosh','',10);
	
$data=mysqli_query($conn,'select * from `child` where `emp_id`='.$empid.' order by chId desc');
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['childName'])? ' ': $row['childName'],
						empty($row['chGender'])? ' ': $row['chGender'],
						empty($row['ch_nationality'])? ' ': $row['ch_nationality'],
						empty($row['ch_country'])? ' ': $row['ch_country'],
						empty($row['ch_nid'])? ' ': $row['ch_nid'],
						empty($row['ch_birthcert'])? ' ': $row['ch_birthcert'],
						$row['ch_dob']=='0000-00-00'? ' ': CDate($row['ch_dob']),
						empty($row['ch_disable'])? ' ': $row['ch_disable'],
						empty($row['ch_quality'])? ' ': $row['ch_quality']
						));
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(270));
	$pdf->Row2(Array('No Children Data Found'));
	$pdf->Ln();
}

//Education Information
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'Education Information',0,0);
$pdf->Ln(8);

$pdf->SetFont('Times','B',10);
$pdf->SetWidths(Array(35,35,35,40,30,30,30,35));
$pdf->Row2(Array('Examination Name','Group/Subject','Board/University','Institution Name',
				'Duration in Years','Result','Session','Exam Roll'));
$pdf->SetFont('nikosh','',10);

$sql='select * from `education` where `emp_id`='.$empid.' ORDER BY examRank asc';
$data=mysqli_query($conn,$sql);

if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['examName'])? ' ': $row['examName'],
						empty($row['GroupSubject'])? ' ': $row['GroupSubject'],
						empty($row['BoardUniversity'])? ' ': $row['BoardUniversity'],
						empty($row['InsName'])? ' ': $row['InsName'],
						empty($row['duration'])? ' ': $row['duration'],
						empty($row['Result'])? ' ': $row['Result'],
						empty($row['Session'])? ' ': $row['Session'],
						empty($row['ExamRoll'])? ' ': $row['ExamRoll']
						));	
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(270));
	$pdf->Row2(Array('No Education Data Found'));
	$pdf->Ln();
}

//Training/Workshop/Seminar Information 
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'Training/Workshop/Seminar Information',0,0);
$pdf->Ln(8);

$pdf->SetFont('Times','B',10);
$pdf->SetWidths(Array(40,50,35,35,45,30,35));
$pdf->Row2(Array('Training/ Workshop/ Seminar','Title','Start Date','End Date',
				'Institution\'s Name','Duration in Days','Evaluation'));
$pdf->SetFont('nikosh','',10);
	
$data=mysqli_query($conn,'select * from `training` where `emp_id`='.$empid.' order by trid desc');
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['trainingName'])? ' ': $row['trainingName'],
						empty($row['title'])? ' ': $row['title'],
						$row['startDate']=='0000-00-00'? ' ': CDate($row['startDate']),
						$row['endDate']=='0000-00-00'? ' ': CDate($row['endDate']),
						empty($row['placeTraining'])? ' ': $row['placeTraining'],
						empty($row['duration'])? ' ': $row['duration'],
						empty($row['evaluation'])? ' ': $row['evaluation']
						));	
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(270));
	$pdf->Row2(Array('No Training/Workshop/Seminar Data Found'));
	$pdf->Ln();
}

//Lien Information 
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'Lien Information',0,0);
$pdf->Ln(8);

$pdf->SetFont('Times','B',10);
$pdf->SetWidths(Array(60,60,50,50,50,50));
$pdf->Row2(Array('Lien From/To Organization','Posting at Bank Before/After Lien',
				'From Date','To Date','Lien Ref. Date'));
$pdf->SetFont('nikosh','',10);
	
$data=mysqli_query($conn,'select * from `lien` where `emp_id`='.$empid.' order by LienId desc');
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['LienFromToOrg'])? ' ': $row['LienFromToOrg'],
						empty($row['PostingBankLien'])? ' ': $row['PostingBankLien'],
						$row['FromDate']=='0000-00-00'? ' ': CDate($row['FromDate']),
						$row['ToDate']=='0000-00-00'? ' ': CDate($row['ToDate']),
						$row['LienRefDate']=='0000-00-00'? ' ': CDate($row['LienRefDate'])
						));	
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(270));
	$pdf->Row2(Array('No Lien Data Found'));
	$pdf->Ln();
}

//Transfer Information 
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'Transfer Information',0,0);
$pdf->Ln(8);

$pdf->SetFont('Times','B',10);
$pdf->SetWidths(Array(50,50,40,30,35,30,35));
$pdf->Row2(Array('Transfer From','Transfer To','Transferred As','Release Date',
				'Release Ref. No','Joining Date','Joining Ref. No'));
$pdf->SetFont('nikosh','',10);
	
$data=mysqli_query($conn,'select * from `transfer` where `emp_id`='.$empid.' order by trnsId desc');
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['transfer_from'])? ' ': $row['transfer_from'],
						empty($row['transfer_to'])? ' ': $row['transfer_to'],
						empty($row['designation_transfer'])? ' ': $row['designation_transfer'],
						$row['date_release']=='0000-00-00'? ' ': CDate($row['date_release']),
						empty($row['release_refno'])? ' ': $row['release_refno'],
						$row['date_jointransfer']=='0000-00-00'? ' ': CDate($row['date_jointransfer']),
						empty($row['join_refno'])? ' ': $row['join_refno']
						));	
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(270));
	$pdf->Row2(Array('No Transfer Data Found'));
	$pdf->Ln();
}

//Promotion History 
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'Promotion History',0,0);
$pdf->Ln(8);

$pdf->SetFont('Times','B',10);
$pdf->SetWidths(Array(70,70,70,60));
$pdf->Row2(Array('From Designation','To Designation','Promotion Date','Promotion Ref. No'));
$pdf->SetFont('nikosh','',10);
	
$data=mysqli_query($conn,'select * from `promotion_history` where `emp_id`='.$empid.' order by promotion_id desc');
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['from_desg'])? ' ': $row['from_desg'],
						empty($row['to_desg'])? ' ': $row['to_desg'],
						$row['promotion_date']=='0000-00-00'? ' ': CDate($row['promotion_date']),
						empty($row['pro_refno'])? ' ': $row['pro_refno']
						));	
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(270));
	$pdf->Row2(Array('No Promotion History Found'));
	$pdf->Ln();
}

//Reward Information 
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'Reward Information',0,0);
$pdf->Ln(8);

$pdf->SetFont('Times','B',10);
$pdf->SetWidths(Array(50,70,50,60,40));
$pdf->Row2(Array('Rewarded For','Reward Description','Reward Date','Rewarded By','Reward Ref. No'));
$pdf->SetFont('nikosh','',10);
	
$data=mysqli_query($conn,'select * from `reward` where `emp_id`='.$empid.' order by rwrdId desc');
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['Rwardcause'])? ' ': $row['Rwardcause'],
						empty($row['RwardDecs'])? ' ': $row['RwardDecs'],
						$row['Rwarddate']=='0000-00-00'? ' ': CDate($row['Rwarddate']),
						empty($row['RwardBy'])? ' ': $row['RwardBy'],
						empty($row['RwardRefNo'])? ' ': $row['RwardRefNo']
						));	
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(270));
	$pdf->Row2(Array('No Reward Informaton Found'));
	$pdf->Ln();
}


//Punishment Information  
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'Punishment Information',0,0);
$pdf->Ln(8);

$pdf->SetFont('Times','B',10);
$pdf->SetWidths(Array(50,70,50,60,40));
$pdf->Row2(Array('Punished For','Punishment Description','Punishment Ref. Date',
				'Punishment Ref. Authority','Punishment Ref. No'));
$pdf->SetFont('nikosh','',10);
	
$data=mysqli_query($conn,'select * from `punishment` where `emp_id`='.$empid.' order by pnshiId desc');
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['p_cause'])? ' ': $row['p_cause'],
						empty($row['p_description'])? ' ': $row['p_description'],
						$row['p_date']=='0000-00-00'? ' ': CDate($row['p_date']),
						empty($row['p_refauth'])? ' ': $row['p_refauth'],
						empty($row['p_refno'])? ' ': $row['p_refno']
						));	
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(270));
	$pdf->Row2(Array('No Punishment Informaton Found'));
	$pdf->Ln();
}
//prottyon

$pdf->SetFont('nikosh','I',12);

$pdf->MultiCell(271,4.5,'আমি এই মর্মে অঙ্গীকার করিতেছি যে, উল্লিখিত বিবরণী আমার জানামতে নির্ভুল এবং সত্য। উপরোক্ত বিবরণের মধ্যে যদি কোন অসত্য অথবা অসমাপ্ত বিবরণ প্রমাণিত হয়, তবে রাজশাহী কৃষি উন্নয়ন ব্যাংকের একজন কর্মকর্তা/কর্মচারি হিসাবে ব্যাংক প্রদত্ত আইনানুগ যেকোন ব্যবস্থা মেনে নিতে বাধ্য থাকিব।',0,'J',0);
$pdf->Ln();

//
//Signature
$data=mysqli_query($conn,'select `signature` from `personal` where `emp_id`='.$empid);
$sign=mysqli_fetch_assoc($data);



$pdf->Image('../photo/'.$sign['signature'],$pdf->GetX()+210,$pdf->GetY()+5,60,16);


$pdf->SetFont('Times','B',12);
$pdf->Cell(250,5,'Signature',0,0,'R');
$pdf->Ln();
ob_end_clean();
$pdf->Output($empid.'_pds.pdf','I');


?>
