<?php
require 'fpdf.php';
include '../config.php';
session_start();



if (isset($_SESSION['empid']))
{
    $EntryUserId = $_SESSION['empid'];
    $brCode = $_SESSION['brCode'];
    
	//echo '<br><br><br><br><br><br><br><br><br><br>loanfsdfdsfsdsdfsfdsasasaerewrwr type '.$trNo;
}
else
{
    header("Location:login.php");
    exit;
}
function CDate($string) {
    $datenew='';
	if($string != '0000-00-00'){
		$datenew=date("d-m-Y",strtotime(str_replace('/', '-', $string)));
	}
	return $datenew;
}


class myPDF extends FPDF{
	
	function personal(){
		$this->Image('rakub.png',57,7,15,15);
		$this->SetFont('Arial','B',15);
		$this->Cell(205,5,'Rajshahi Krishi Unnayan Bank',0,0,'C');
		$this->Ln();
		
		//$this->Cell(205,5,'CIB Inquiry Form-2',0,0,'C');
		$this->SetFont('Times','',10);
		//$this->Cell(205,5,'Head Office, Rajshahi',0,0,'C');
		$this->Ln(7);
		
	}
	var $widths;
	var $aligns;
	var $lineHeight=5;

	//Set the array of column widths
	function SetWidths($w){
		$this->widths=$w;
	}

	//Set the array of column alignments
	function SetAligns($a){
		$this->aligns=$a;
	}

	//Set line height
	function SetLineHeight($h){
		$this->lineHeight=$h;
	}

	//Calculate the height of the row
	function Row($data)
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
				$this->MultiCell($w,5,$data[$i],0,$a);
			}
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
		//calculate the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
	
	
	function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;

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
                $char_space=($w-$this->cMargin*2-$str_width)/max(strlen($txt)-1,1)*$this->k;
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
		$pdf->CellFitScale(44,5,$value,0,0);
		$pdf->SetFont('Times','',10);
	}     
	


	
}


$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4','0');
$pdf->personal();

//$pdf->Ln();
$pdf->SetFont('Times','B',15);

//$pdf->Cell(300,5,'CIB Inquiry Form-2',0,0);
$pdf->Cell(205,5,'CIB Inquiry Form-2',0,0,'C');

$pdf->Ln(7);
$pdf->Line(10,$pdf->GetY(),200,$pdf->GetY());

$pdf->SetWidths(Array(44,4,47,44,4,47));

$pdf->SetFont('Times','',10);
if(isset($_GET['gtrNo']))
{
	$trNo=$_GET['gtrNo'];

$data=mysqli_query($conn,"SELECT distinct i.*,c.*,d.* from inquiry i INNER JOIN company c 
on i.TrackingNo=c.TrackingNo inner join branch d on i.BranchId=d.brcode 
where i.TrackingNo='$trNo'");
while($row=mysqli_fetch_array($data)){
	//Personal Information	
				$pdf->Row(Array('FI Code',':',empty($row['FICode'])? ' ': $row['FICode'],
						'Branch Name',':',empty($row['brNameEn'])? ' ': $row['brNameEn']));
			
			$pdf->Row(Array('Loan Type.',':',empty($row['loanType'])? ' ': $row['loanType'],
						'Individual Information',':',empty($row['indiviCompnyInfo'])? ' ': $row['indiviCompnyInfo']));
			$pdf->Row(Array('FI Subject Code',':',empty($row['FISubCode'])? ' ': $row['FISubCode'],
						'Type of Financing',':',empty($row['FinTypeID'])? ' ': $row['FinTypeID']));
$pdf->Row(Array('Contract History',':',empty($row['contractHistory'])? ' ': $row['contractHistory'],
						'Contract Phase',':',empty($row['contractPhase'])? ' ': $row['contractPhase']));
			$pdf->Row(Array('Total Requested Amount.',':',empty($row['TotalReqAmt'])? ' ': $row['TotalReqAmt']));

			$pdf->Ln();
			$pdf->SetFont('Times','B','15');
			$pdf->Cell(200,5,'Installment Contract Data:',20,20);
			//$pdf->Ln();
			$pdf->Line(10,$pdf->GetY(),200,$pdf->GetY());
			$pdf->SetFont('Times','','24');
			$pdf->Row(Array('Number of Installment',':',empty($row['InstallmentNo'])? ' ': $row['InstallmentNo'],
						'Installment Amount',':',empty($row['InstallmentAmt'])? ' ': $row['InstallmentAmt']));
			$pdf->Row(Array('Periodicity of Payments(in Months)',':',empty($row['PerodicityPayment'])? ' ': $row['PerodicityPayment'])); 
			$pdf->Ln();
			$pdf->SetFont('Times','B','15');
			$pdf->Cell(200,5,'Institution Subject Data:',20,20);
			//$pdf->Ln();
			$pdf->Line(10,$pdf->GetY(),200,$pdf->GetY());
			$pdf->SetFont('Times','','24');	
			//$pdf->Ln();			
			$pdf->Row(Array('Title of Trade',':',empty($row['Title'])? ' ': $row['Title'],
						'Trade Name',':',empty($row['TradeName'])? ' ': $row['TradeName']));
			$pdf->Row(Array('Institution Type',':',empty($row['InstitutionType'])? ' ': $row['InstitutionType'],
						'Legal Form',':',empty($row['LegalForm'])? ' ': $row['LegalForm']));
			$pdf->Row(Array('ETIN',':',empty($row['Etin'])? ' ': $row['Etin'],
						'Telephone Number',':',empty($row['TelephoneNumber'])? ' ': $row['TelephoneNumber']));
			//$pdf->Row(Array('RegDate',':',empty($row['RegDate'])? ' ': $row['RegDate']));
			$pdf->Row(Array('RJSC Registration Number',':',empty($row['RJSCRegNo'])? ' ': $row['RJSCRegNo'],
						'RJSC Registration Date',':',empty($row['RegDate'])? ' ': $row['RegDate']));
			$pdf->Row(Array('Sector Code',':',empty($row['SecCode'])? ' ': $row['SecCode'],
						'Sector Type',':',empty($row['SecType'])? ' ': $row['SecType']));
	
	
	
			$pdf->Ln();
			$pdf->SetFont('Times','B','15');
			$pdf->Cell(200,5,'Business Address:',20,20);
			//$pdf->Ln();
			$pdf->Line(10,$pdf->GetY(),200,$pdf->GetY());
			$pdf->SetFont('Times','','24');		
			$pdf->Row(Array('Street',':',empty($row['BusStreet'])? ' ': $row['BusStreet'],
						'Postal',':',empty($row['BusPostal'])? ' ': $row['BusPostal']));
			$pdf->Row(Array('District',':',empty($row['BusDistrict'])? ' ': $row['BusDistrict'],
						'Country',':',empty($row['BusCountry'])? ' ': $row['BusCountry']));
	
			$pdf->Ln();
			$pdf->SetFont('Times','B','15');
			$pdf->Cell(200,5,'Factory Address:',20,20);
			//$pdf->Ln();
			$pdf->Line(10,$pdf->GetY(),200,$pdf->GetY());
			$pdf->SetFont('Times','','24');		
			$pdf->Row(Array('Street',':',empty($row['FacStreet'])? ' ': $row['FacStreet'],
						'Postal',':',empty($row['FacPostal'])? ' ': $row['FacPostal']));
			$pdf->Row(Array('District',':',empty($row['FacDistrict'])? ' ': $row['FacDistrict'],
						'Country',':',empty($row['FacCountry'])? ' ': $row['FacCountry']));
	}
	$pdf->Ln(27);
	
	$pdf->SetFont('Times','B',12);
$pdf->Cell(190,5,'Signature,Seal and Date of the Authorizer',0,0,'L');
$pdf->Ln();
$pdf->Cell(190,-3.5,'Signature of the Customer',30,30,'R');
$pdf->Ln();
}
$pdf->output();



?>