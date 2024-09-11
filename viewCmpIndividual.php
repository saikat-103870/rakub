<?php
ob_start();
session_start();
include ('header.php');
include ('config.php');
ini_set('display_errors', 'off');
if(isset($_GET['trNo']))	
{
	$trNo = $_GET['trNo'];
	$sqlload="SELECT DISTINCT i.*,b.*,ind.* FROM inquiry i  inner JOIN  individual ind
ON  
i.TrackingNo = ind.TrackingNo
inner JOIN branch b
ON  i.BranchId = b.brcode 
inner JOIN   zone z
on b.ZoneID = z.zoneCode WHERE i.status=3 and i.TrackingNo='$trNo'";
}