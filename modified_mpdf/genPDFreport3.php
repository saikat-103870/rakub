<?php
require_once __DIR__ . '/vendor/autoload.php';
include 'vendor/mpdf/mpdf/src/Mpdf.php';
include '../config.php';





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

$pdf->SetY(27);
$pdf->SetFont('Times','B',12);
$pdf->Cell(200,5,'PMIS Report',0,0);
$pdf->Ln();
$pdf->Line(20,$pdf->y,200,$pdf->y);

$pdf->SetWidths(Array(30,30));

$pdf->SetFont('Times','',9);

$pdf->SetFont('Times','',12);
$pdf->Cell(200,5,'',0,0);
$pdf->Ln(8);
$desig=$_POST['official_desig'];
$pdf->Cell(200,5,'Employee List of '.$desig,0,0);
$pdf->Ln(10);
$pdf->SetFont('Times','B',12);
$pdf->SetWidths(Array(30,40,50,30,30));
$pdf->Row2(Array('Zone Name','Branch Name','Branch Manager Name','Designation','Contact'));
$pdf->SetFont('nikosh','',10);


$sql='select tb.Zone_en,tb.brNameEn, tb.name_eng,tb.official_desig,tb.mobile_pr from
(SELECT distinct p.`emp_id`,p.`prPostingZone`,p.`name_eng`,p.`official_desig`,p.`mobile_pr`,z.`Zone_en`,b.`brNameEn` FROM `personal` p 

INNER JOIN zone z on trim(z.zoneCode)=trim(p.prPostingZone)
INNER JOIN br b on trim(b.brCode)=trim(p.prPostingBr) 
where p.`official_desig`="'.$desig.'") tb
 ORDER BY Zone_en ASC, brNameEn';

$data=mysqli_query($conn,$sql);
if (mysqli_num_rows($data) > 0) 
{
	while($row=mysqli_fetch_array($data)){
		$pdf->Row2(Array(empty($row['Zone_en'])? ' ': $row['Zone_en'],
						empty($row['brNameEn'])? ' ': $row['brNameEn'],
						empty($row['name_eng'])? ' ': $row['name_eng'],
						empty($row['official_desig'])? ' ': $row['official_desig'],
						empty($row['mobile_pr'])? ' ': $row['mobile_pr']
						
						));
	}
	$pdf->Ln();
}
else{
	$pdf->SetWidths(Array(70));
	$pdf->Row2(Array('No Reprt Found'));
	$pdf->Ln();
}


//Spouse Information


//Children Information

//$pdf->SetFont('nikosh','',10);
	


//Education Information

//Training/Workshop/Seminar Information 


//Transfer Information 


//Promotion History 


//Reward Information 


//Punishment Information  

//prottyon



//

ob_end_clean();
$pdf->Output('_pds.pdf','I');


?>
