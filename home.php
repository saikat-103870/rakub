<?php 
include('convertToBangla.php');
include 'config.php';
session_start();
if (isset($_SESSION['empid']))
{
    $EntryUserId = $_SESSION['empid'];
    $brCode = $_SESSION['offCode'];

}
else
{
    header("Location:login.php");
    exit;
}
require_once 'templates/header.php';

function getCurrentFiscalyear(){
	
	if (date('m') <= 6) {//Upto June 
    $fiscal_year = (date('Y')-1) . '-' . date('Y');
	} else {//After June 
		$fiscal_year = date('Y') . '-' . (date('Y') + 1);
	}
	return $fiscal_year;
}


?>
<style>
.bgh{
	background-image: url('img/bgimg.jpg');
	background-repeat:no-repeat;
	background-position: right;
	height:100%; /* you can change that height to 100%, please get sure youre Header is ready */
	background-size:cover;
}
.hdn{
    font-size: 30pt;
    font-weight: 700;
    letter-spacing: -1px;
    text-decoration: underline;
}
.headingList
{
	font-size:25px;
}
</style>
	<div class="content">
    <div class="container">

     		<div style="margin-bottom:70px" class="row">
				<?php /* require_once 'templates/message.php'; */ 
//$msg='Update work in progress...Please Submit weekly report after 2PM..';

//$msg='30-06-2019 তারিখের Daily MIS এর তথ্য 01-07-2019 তারিখের মধ্যে এন্ট্রি দেয়া ও ভেরিফিকেশন সম্পন্ন করা যাবে। ';
				if(isset ($_SESSION['offCode']))
				{
					$offCode=$_SESSION['offCode'];
					$OifficeLevel = $_SESSION['OifficeLevel'];
					$type = $_SESSION['type'];
					$BrCode=$_SESSION['offCode'];
					$uid=$_SESSION['uid'];					
				}
				
				?>
				
				<div class="col-sm-2">
				
				</div>
				
	     		<div class="col-sm-20">
				<h2 class="text-center"><font color="blue">Rajshahi Krishi Unnayan Bank</font></h2>
							<div class="col-md-12 dept-block" >
			
						
							
				
				<?php
				$branchQuery = "";
				if($_SESSION['OifficeLevel']==1)				
					$branchQuery = " and BranchId=".$_SESSION['offCode']." ";
				else if($_SESSION['OifficeLevel']==2)
					$branchQuery = " and BranchId in (select brcode  from branch b where b.ZoneID='".$_SESSION['offCode']."')";
				
				$sql = "SELECT count(*) as Count from inquiry where status = 0 $branchQuery
						union ALL SELECT count(*) as Count from inquiry where status = 1 $branchQuery
						union ALL SELECT count(*) as Count from inquiry where status = 2 $branchQuery
						union ALL SELECT count(*) as Count from inquiry where status = 3 $branchQuery
						union ALL SELECT count(*) as Count from inquiry where status = 4 $branchQuery";

				//echo $sql;
				//exit;
				$res = mysqli_query($conn, $sql);
				$count=0;
				$t0=0;
				$t1=1;
				$t2=2;
				$t3=3;
				$t4=4;
				while($data = mysqli_fetch_array($res))
				{
					if($count==0)
						$status0 = $data['Count'];
					else if($count==1)
						$status1 = $data['Count'];
					else if($count==2)
						$status2 = $data['Count'];
					else if($count==3)
						$status3 = $data['Count'];
					else if($count==4)
						$status4 = $data['Count'];
					$count++;
				}
				
				
				$reportDiv = "<div style='float:right'  class='panel panel-primary'>
							<div class='panel-heading'>
								<h3 class='panel-title black'>
									<font color='white' size='5'><b><center>".getCurrentFiscalyear()." Fiscal Year : </center></b></font> 
								</h3>
							</div>
							<div class='panel-body dept-block-body'>
				<table class='table table-striped table-bordered table-hover table-condensed table-responsive'>
							<tr><td><font size='4' color='blue'><b>Waiting for maker to send to Branch Manager </b></font></td>
							<td><font size='4' color='green'><b>:</b></font></td>
							<td><a href='fiscalYearReport.php?s=$t0'><font size='4' color='blue'><b>$status0</b></font></a></td>
							
							
			
							</tr>
							<tr><td><font size='4' color='green'><b>Waiting for Branch Manager Approval  </b></font></td>
							<td><font size='4' color='green'><b>:</b></font></td>
							<td><a href='fiscalYearReport.php?s=$t1'><font size='4' color='green'><b>$status1</b></font></a></td>

							
							
							</tr>	
							
							<tr><td><font size='4' color='red'><b>Waiting for Zonal Office Approval </b></font></td>
							<td><font size='4' color='green'><b>:</b></font></td>
							<td><a href='fiscalYearReport.php?s=$t2'><font size='4' color='red'><b>$status2</b></font></a></td></tr>	

							<tr><td><font size='4' color='Chocolate '><b> Waiting for CIB Report </b></font></td>
							<td><font size='4' color='green'><b>:</b></font></td>
							<td><a href='fiscalYearReport.php?s=$t3'><font size='4' color='red'><b>$status3</b></font></a></td></tr>		

							<tr><td><font size='4' color='DarkSlateGray'><b>CIB Reporting Completed </b></font></td>
							<td><font size='4' color='green'><b>:</b></font></td>
							<td> <a href='fiscalYearReport.php?s=$t4'><font size='4' color='red'><b>$status4</b></font></a></td></tr>	

														
							
							
					
							</table>
							</div>
						</div>";
				
			$officeCode=$_SESSION['offCode'];
			echo'<center><h2><font color="green">'.$_SESSION['office'].' ('.e2b($officeCode).')</font></h2></center>';			


//echo'<marquee><span style="color:red; font-size:20px;">'.$msg."</span></marquee>";			
if ($OifficeLevel==1){	// Branch
						if ($type==1){
							echo "<div style='float:left'>";
							//maker
							echo'<a href="individual.php" class="list-group-item list-group-item-success headingList" >1. CIB Enquiry Form</a>';
						//	echo'<a href="company.php" class="list-group-item list-group-item-deafult headingList" >2. CIB Enquiry form for Company</a>';
							echo'<a href="editInquiry.php" class="list-group-item list-group-item-deafult headingList" >2. Edit CIB Inquiry </a>';
							echo'<a href="statusReport.php" class="list-group-item list-group-item-success headingList" >3. Search CIB Inquiry Reports by Tracking No</a>';
							echo'<a href="statusReportDate.php" class="list-group-item list-group-item-default headingList" >4. Search CIB Inquiry Reports by Date</a>';
							
							echo "</div>";
							echo $reportDiv;
							/*
											echo "<div style='float:right'>";
							//maker
							echo'<a href="individual.php" class="list-group-item list-group-item-success headingList" >Waiting for maker to send to Branch Manager : </a>';
						//	echo'<a href="company.php" class="list-group-item list-group-item-deafult headingList" >2. CIB Enquiry form for Company</a>';
							echo'<a href="editInquiry.php" class="list-group-item list-group-item-deafult headingList" >Waiting for Branch Manager Approval :  </a>';
							echo'<a href="statusReport.php" class="list-group-item list-group-item-success headingList" >Waiting for Zonal Office Approval : </a>';
							echo'<a href="statusReportDate.php" class="list-group-item list-group-item-default headingList" >Waiting for CIB Report : </a>';
							echo'<a href="statusReportDate.php" class="list-group-item list-group-item-default headingList" >CIB Reporting Completed : </a>';
							
							echo "</div>";
							/**/
							?>
							
							
							
							<?php
							
						}
						else if ($type==2) //checker
						{
							echo "<div style='float:left'>";
							echo "<br><br><a  href='verifyReport.php?branchCode=$brCode'".' class="list-group-item list-group-item-success headingList" > 1. Verify CIB Inquiry Report</a>';
							echo'<a href="statusReport.php" class="list-group-item list-group-item-default headingList" >2. Search CIB Inquiry Reports</a>';
							echo'<a href="statusReportDate.php" class="list-group-item list-group-item-success headingList" >3. Search CIB Inquiry Reports by Date</a>';
							echo "</div>";
							echo $reportDiv;

								//echo  "<p style='color:green;text-align: center;font-size: 45px;font-family:serif;'>"."<br>"."Reset Password Successfully"."</p>";
							//echo'<a href="verifyReport.php?branchCode=$brCode > class="list-group-item list-group-item-action list-group-item-success headingList"1. Verify CIB Report</a>';
							//echo '<a href="verifyReport.php?branchCode=$brCode" class="list-group-item list-group-item-action list-group-item-action headingList">2. View Transaction Report</a>';
							//echo '<a href="ReportBrDetailDatewise.php" class="list-group-item list-group-item-action list-group-item-success headingList">3. View Datewise Detail Transaction Report</a>';
						    //echo '<a href="brpd_report_Branch.php" class="list-group-item list-group-item-action list-group-item-action headingList">4. BRPD Circular Wise Report</a>';
															
						}
						else if($type==3) //supervisor
						{
							//echo'<a href="dailyTransactionSupervisor.php" class="list-group-item list-group-item-action list-group-item-success headingList">1. Supervisor Transaction Entry Form</a>';
							//echo '<a href="report_serprvisor_peroframnce.php" class="list-group-item list-group-item-action list-group-item-action headingList">2. View Weekly Performance Report</a>';
							header("Location:sindex.php");
							exit;
							
						}
					}
					elseif($OifficeLevel==2){	//Zone
						echo '<left>  <br><br><br>';
						echo "<div style='float:left'>";
					    echo "<a  href='verifyReportZM.php?ZoneCode=$brCode' class='list-group-item list-group-item-success headingList'> 1. Verify CIB Inquiry Report</a>";
						echo'<a href="statusReport.php" class="list-group-item list-group-item-default headingList" >2. Search CIB Inquiry Reports</a></left>';
						echo'<a href="statusReportDate.php" class="list-group-item list-group-item-success headingList" >3. Search CIB Inquiry Reports by Date</a>';
						
							echo "</div>";
							echo $reportDiv;

						//echo'<a href="BrWiseReportZone.php" class="list-group-item list-group-item-action list-group-item-success headingList">3. View Transaction Report (Branch Wise)</a>';
						//echo'<a href="ZoneReportBrDetailDatewise.php" class="list-group-item list-group-item-action list-group-item-action headingList">4. View Branch Detail Transaction Report (Date Wise)</a>';
						//echo'<a href="reportszn.php" class="list-group-item list-group-item-action list-group-item-success headingList">5. View Transaction Report (Zone Wise)</a>';					
						//echo'<a href="brpd_report_Zone.php" class="list-group-item list-group-item-action list-group-item-action headingList">6. BRPD Circular Wise Report</a>';
						
						
					}elseif($OifficeLevel==3){	//ZAO
						echo'<a href="dasboard.php" class="list-group-item list-group-item-action headingList">1. D A S H B O A R D</a>';
						echo'<a href="reports.php" class="list-group-item list-group-item-action list-group-item-success headingList">2. View Transaction Report (Branch Wise)</a>';
						echo'<a href="divreportszn.php" class="list-group-item list-group-item-action list-group-item-secondary headingList">3. View Transaction Report (Zone Wise)</a>';					
						
					
					}elseif($OifficeLevel==4){	//DIVISION
						echo'<a href="divdasboard.php" class="list-group-item list-group-item-action headingList">1. D A S H B O A R D</a>';
						//echo'<a href="verifyZone.php" class="list-group-item list-group-item-action list-group-item-secondary">5. Verify Report from Zone</a>';
						echo'<a href="reports.php" class="list-group-item list-group-item-action list-group-item-success headingList">2. View Transaction Report (Branch Wise)</a>';
						echo'<a href="divreportszn.php" class="list-group-item list-group-item-action list-group-item-secondary headingList">3. Transaction Report (Zone Wise)</a>';					
						echo'<a href="div-reportsdiv.php" class="list-group-item list-group-item-action list-group-item-success headingList">4. View Transaction Report (Division wise)</a>';					
						
					
					}elseif($OifficeLevel==5){	//DAO
						echo'<a href="dasboard.php" class="list-group-item list-group-item-action headingList">1. D A S H B O A R D</a>';
						//echo'<a href="verifyZone.php" class="list-group-item list-group-item-action list-group-item-secondary">5. Verify Report from Zone</a>';
						echo'<a href="reports.php" class="list-group-item list-group-item-action list-group-item-success headingList">2. View Transaction Report (Branch Wise)</a>';
						echo'<a href="divreportszn.php" class="list-group-item list-group-item-action list-group-item-secondary headingList">3. Transaction Report (Zone Wise)</a>';					
						
					
					}elseif(($OifficeLevel==6) && (($offCode=='9907') or($offCode=='9904'))) {	//RAKUB, HO
						echo "<div style='float:left'>";
						echo'<a href="dashboard.php" class="list-group-item list-group-item-success headingList">1. CIB Inquiry Reports</a>';
						echo'<a href="statusReport.php" class="list-group-item list-group-item-default headingList" >2. Search CIB Inquiry Reports</a></left>';
						echo'<a href="statusReportDate.php" class="list-group-item list-group-item-success headingList" >3. Search CIB Inquiry Reports by Date</a>';
						
						echo "</div>";
						
						echo $reportDiv;

						
					}
					elseif($OifficeLevel==7){	//SECP
						
						header("Location:../id/index.php");
		                exit;
						}
				
					?>

				  </div>
	<p style="text-align: right;"><a href="cibhome.php" class="btn btn-success btn-md"> <span class="glyphicon glyphicon-step-backward"></span>back </a><br></p>
			
	     		
     		</div>
	</div> 
	</div> 
<?php require_once 'templates/footer.php';?>






