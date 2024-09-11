<?php
ob_start();
session_start();
Include('config.php');
$_SESSION['error']="";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{	
$empId="";
$passwrd = "";
if (isset($_REQUEST['Submit'])) //here give the name of your button on which you would like    //to perform action.
{
try
{
// here check the submitted text box for null value by giving there name.
	if($_REQUEST['empid']=="" || $_REQUEST['password']=="")
	{
		$_SESSION['error'] = "All fields must be filled up";
		header('Location: login.php');exit;
	}
	
	else if(strlen(trim($_REQUEST['empid']))!=6 || !is_numeric(trim($_REQUEST['empid'])))
	{
		$_SESSION['error'] = "Invalid User Id";
		//header('Location: login.php');
		//exit;	
	}
	
	else
	{
	$empId=trim($_POST['empid']);
	//$password = trim(md5($_POST['password']));
   $passwrd = trim($_POST['password']);
   //checking emp_id 
 /*  
      $sqlChk = "SELECT `password`,`Name`,`brCode`,`status` FROM `users` WHERE `empno`='$empId'"; 

	    $resultchk=mysqli_query($conn, $sqlChk)
			    or exit("Sql Error".mysqli_error());
			
	    $nrChk=mysqli_num_rows($resultchk);
		if($nrChk<1)
		{
			$sqlgetUsrId="INSERT INTO `users`(`empno`, `password`, `Name`, `brCode`, `status`)
			select t.emp_id,md5('Rakub*789'),t.name_eng,t.branch_code,0 from emp_all t 
			WHERE t.emp_id='$empId'";
			if(!mysqli_query($conn, $sqlgetUsrId))
			{
				echo "Sql Error".mysqli_error($conn);
			}
			
			//Start insert data to personal table
			
			$sqlRest="SELECT `name_eng`,`name_ban`,`emp_id`,`telephone_home`,`mobile_prsnl`,`emrgncy_cntct`,`nid`,`dob`,`bloodgrp`,`picture`,`branch_code`,`zone_code`,
			CASE 
			WHEN zone_code=1 THEN (SELECT `ZoneID` FROM `br` where `brcode`=branch_code limit 1)
			ELSE branch_code 
			END as zoneId
			FROM `emp_all` 
			WHERE `emp_id`='$empId'";
			
			$rst=mysqli_query($conn, $sqlRest)
			    or exit("Sql Error".mysqli_error($conn));
				$sqlDn="";	
				while($rw = mysqli_fetch_assoc($rst))
				{
					$empId=$rw['emp_id'];
					$name_eng=$rw['name_eng'];
					$name_ban=$rw['name_ban'];
					$PrPostingLoc=$rw['zone_code'];
					if(trim($rw['zone_code'])==1)
					{
					  $branch_code=$rw['branch_code'];
				  
					}
					else
					{
					  $branch_code='';
  
					}
					$zone=$rw['zoneId'];
					
					$mobile_prsnl=b2e($rw['mobile_prsnl']);
					$emrgncy_cntct=b2e($rw['emrgncy_cntct']);
					$nid=b2e($rw['nid']);
					$dob=b2e($rw['dob']);
					$dob = date("Y-m-d",strtotime(str_replace('/', '-', $dob)));
					$telephone_home=b2e($rw['telephone_home']);
					$bloodgrp=BloodGroup(trim($rw['bloodgrp']));
					$picture=$rw['picture'];
					$sign=$rw['picture'].'_s';
					
					$sqlDn="INSERT INTO `personal`(`emp_id`,`name_eng`,
					`name_ban`,`PrPostingLoc`,`prPostingZone`,`PrPostingBr`,
					`telephone`,`mobile_pr`,`emergency_contact`,`nid`,
					`dob`,`bloodgroup`,`photo`,`signature`) Values(
					'$empId','$name_eng','$name_ban','$PrPostingLoc',
					'$zone','$branch_code','$telephone_home','$mobile_prsnl',
					'$emrgncy_cntct','$nid','$dob','$bloodgrp','$picture','$sign')";
					
					$dirPhoto="../id/uploads/".$empId.".jpg";
					$dirSign="../id/uploads/".$empId."_s.jpg";
					//echo file_exists($dirSign); exit;
					if(mysqli_query($conn, $sqlDn))
						{
							copy($dirPhoto,'photo/'.$empId.'.jpg');	
							copy($dirSign,'photo/'.$empId.'_s.jpg');	
						}
				}	
				
			//END insert data to personal table			
			
		}
   
   ///////////////////////////////////////////
   
   
   
   */
   
   ///////////////////////////////////
   ///////////////////////
   
   
   
   
   //end checking emp Id
   
   
   $sql1 = "SELECT `password`,`Name`,`brCode`,`status` FROM `users` WHERE `empno`='$empId' and `password`='".md5($passwrd)."'"; 

	    $result=mysqli_query($conn, $sql1)
			    or exit("Sql Error".mysqli_error());
				
	    $num_rows=mysqli_num_rows($result);

		if($num_rows>0)
		{
			
			$row = mysqli_fetch_assoc($result);
			
			//if(trim($row['status'])==1)
			//{
			$_SESSION['empid']=$empId;
			$_SESSION['password']=$passwrd;
			$_SESSION['brCode']=$row['brCode'];
			header("Location: individual.php");
			//}
			/*
			else
			{
			    $_SESSION['tmpempid']=$empId;
			    $_SESSION['empid']=null;
			    $_SESSION['password']=$passwrd; 
				header("Location: CngPass.php");
				exit;
			}
			*/
		}
		/*
		else if($empId=="admin" && md5($passwrd) =='e10adc3949ba59abbe56e057f20f883e')
		{
			$_SESSION['admn']=$empId;
			$_SESSION['password']=$passwrd;

			header("Location: adminPanel.php");
		}
		*/
		else
		{	
		 	$_SESSION['error'] = "Employee PIN/Personnel No. and Password mismatched";
	        //header('Location: login.php');
		}
	}
}
catch (Exception $e) 
{
	$_SESSION['error'] = $e->getMessage();
	exit;
}
}	

if (isset($_REQUEST['reset']))
{
	$empId="";
	$passwrd=""; 
	$_SESSION['error']="";
	header('Location: login.php');
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="php quiz script, php quiz code, php quiz application, quiz php code, php quiz system, online quiz using php, quiz using php, how to make quiz in php, quiz system in php, php programming quiz, online quiz using php and mysql, create online quiz using php and mysql, create quiz using php mysql, php quiz script free">
    <meta name="keywords" content="php quiz script, php quiz code, php quiz application, quiz php code, php quiz system, online quiz using php, quiz using php, how to make quiz in php, quiz system in php, php programming quiz, online quiz using php and mysql, create online quiz using php and mysql, create quiz using php mysql, php quiz script free">
	<meta name="author" content="https://plus.google.com/+vetripandi/">
    <title>Rajshahi Krishi Unnayan Bank</title>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">  
	<link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
	<div class="container">
		<div class="login-form">
			<?php  require_once 'templates/message.php'; ?>
			
			<div class="form-header">
			<h2 class="text-center"><font color="green"><b>Rajshahi Krishi Unnayan Bank</b></font></h2>
				<img src="images/rakubLogo.jpg" />
				<h2 class="text-center"><font color="#fc03e3"><b>RAKUB CIB Inquiry System</b></font></h2>
			</div>
			<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			
			    
				<br>
				<input name="empid" id="empid" type="Text" class="form-control" placeholder="User Id." value="<?php if(!empty($empId)) { echo $empId;} ?>"> 
				<br>
				<input name="password" id="password" type="password" class="form-control" placeholder="Password" value="<?php if(!empty($passwrd)) { echo $passwrd;} ?>"> 
				<br>
				<div style="text-align: center;">
					<button type="submit" name="Submit" class="btn btn-md btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Login</button><span>  &nbsp; &nbsp; </span>
					<button type="submit" name="reset" class="btn btn-md btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>

				</div>	
			</form>

			<br/>
			<div class="text-center well">
				<p>Copyright @2021, Rajshahi Krishi Unnayan Bank </p>
			</div>
		</div>
	</div>
	<!-- /container -->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/login.js"></script>
  </body>
</html>
   
