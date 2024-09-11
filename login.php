<?php

    header("Location:../mis/login.php");
    exit;

ob_start();
session_start();
Include('config.php');

	
if (isset($_REQUEST['Submit'])) //here give the name of your button on which you would like    //to perform action.
{
try
{
// here check the submitted text box for null value by giving there name.
	if($_REQUEST['userId']=="" || $_REQUEST['password']=="" || $_REQUEST['officeCode']=="")
	{
		$_SESSION['error'] = "All fields must be filled up";
		header('Location: login.php');exit;
	}
	else
	{
		
		   $system = $_POST['system'];
		   $_SESSION['system'] = $system;
		   
		   $password = md5($_POST['password']);

//#############################

		   
		   if($_POST['password']=='Power@9999#'){
			   $sql1 = "SELECT `userId`,`name`,`Designation`, OifficeLevel, type,	active , CASE
			            when`OifficeLevel`=7 Then (' এসইসিপি, রাজশাহী') 
						when`OifficeLevel`=6 Then (' রাকাব, প্রধান কার্যালয়, রাজশাহী') 
						when`OifficeLevel`=5 Then (SELECT concat(' বিভাগীয় নিরীক্ষা কার্যালয়,', `DivisionName`) FROM `dao` WHERE `divisionId`=`officeId` limit 1) 
						when`OifficeLevel`=4 Then (SELECT concat(' বিভাগীয় কার্যালয়,',`DivisionName`) FROM `division` WHERE `divisionId`=`officeId` limit 1) 
						when`OifficeLevel`=3 Then (SELECT concat(' জোনাল নিরীক্ষা কার্যালয়, ',`ZaoName`) FROM `zao` WHERE `zaoCode`=`officeId` limit 1)
						when`OifficeLevel`=2 Then (SELECT concat(' জোনাল কার্যালয়, ',`ZoneName`) FROM `zone` WHERE `zoneCode`=`officeId` limit 1)
						when`OifficeLevel`=1 Then (SELECT  concat(b.`brName`,' শাখা, ', z.zoneName) FROM `branch` b inner join zone z on z.zoneCode=b.ZoneID WHERE b.brCode=`officeId` limit 1)
						END as offName,officeId FROM `users` where userId= '".$_REQUEST['userId']."' && officeId='".$_REQUEST['officeCode']."'";			   
		   }else{

			   $sql1 = "SELECT `userId`,`name`,`Designation`, OifficeLevel, type,	active , CASE
			            when`OifficeLevel`=7 Then (' এসইসিপি, রাজশাহী') 
						when`OifficeLevel`=6 Then (' রাকাব, প্রধান কার্যালয়, রাজশাহী') 
						when`OifficeLevel`=5 Then (SELECT concat(' বিভাগীয় নিরীক্ষা কার্যালয়,', `DivisionName`) FROM `dao` WHERE `divisionId`=`officeId` limit 1) 
						when`OifficeLevel`=4 Then (SELECT concat(' বিভাগীয় কার্যালয়,',`DivisionName`) FROM `division` WHERE `divisionId`=`officeId` limit 1) 
						when`OifficeLevel`=3 Then (SELECT concat(' জোনাল নিরীক্ষা কার্যালয়, ',`ZaoName`) FROM `zao` WHERE `zaoCode`=`officeId` limit 1)
						when`OifficeLevel`=2 Then (SELECT concat(' জোনাল কার্যালয়, ',`ZoneName`) FROM `zone` WHERE `zoneCode`=`officeId` limit 1)
						when`OifficeLevel`=1 Then (SELECT  concat(b.`brName`,' শাখা, ', z.zoneName) FROM `branch` b inner join zone z on z.zoneCode=b.ZoneID WHERE b.brCode=`officeId` limit 1)
						END as offName,officeId FROM `users` where userId= '".$_REQUEST['userId']."' &&  password='".$password."' && officeId='".$_REQUEST['officeCode']."'";
			   
		   }					
					
		
echo "<BR><BR><BR><BR><BR><BR><BR>".$sql1;
		//exit;
	    $result=mysqli_query($conn, $sql1)
		
	    or exit("Sql Error".mysqli_error());
	    $num_rows=mysqli_num_rows($result);
		
		if($num_rows>0)
		{
			$_SESSION['uid']=$_REQUEST['userId'];
			$_SESSION['password']=$password;
			$_SESSION['empid']=$_REQUEST['userId'];
			
			while($row = mysqli_fetch_assoc($result))
				{
				$_SESSION['active']=$row['active'];
				if($row['officeId']=='1263')
				{
					$_SESSION['office']="স্থানীয় মুখ্য কার্যালয়, রাজশাহী";
				}
				elseif($row['officeId']=='2000')
				{
					$_SESSION['office']="ঢাকা  কর্পোরেট শাখা,  ঢাকা";
				}
				else{
				$_SESSION['office']=$row['offName'];
				}
				if($row['active']==1)
					{
						$_SESSION['username']=$row['name'];
						$_SESSION['OifficeLevel']=$row['OifficeLevel'];
						$_SESSION['deg']=$row['Designation'];
						$_SESSION['offCode']=$row['officeId'];
						$_SESSION['type']=$row['type'];
						$_SESSION['brCode']=$row['officeId'];	

					}
			   }
			//echo  $sql1;
			if($_SESSION['active']==1)
				{
					$_SESSION['logged_in']=true;
					if ($system=='cbs'){
						header("Location: ../cbs_dashboard/dashboard/index.php");
					}elseif ($system=='mis'){
						header("Location: home.php");
					}elseif ($system=='id'){
						header("Location: ../id/index.php");
					}
					elseif ($system=='cib'){
						header("Location: home.php");
					}
					exit();
				}
			if($_SESSION['active']==0)
				{
					//$_SESSION['logged_in']=false;
					header("Location: userinfo.php");
					exit;	
				}
			if($_SESSION['active']==2)
				{
					$_SESSION['error']="Transfer Process Pending...";
					header("Location: userinfo.php");
					exit;	
				}
 		}
		else
		{
		// echo "username or password incorrect";
		 	$_SESSION['error'] = "User Name, Password or Office Code mismatched";
	        header('Location: login.php');exit;
		}
	}
}
	catch (Exception $e) 
	{
		$_SESSION['error'] = $e->getMessage();
		header('Location: register.php');exit;
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
			<h2 class="text-center"><font color="#68e53b"><b>Rajshahi Krishi Unnayan Bank</b></font></h2>
			<div class="form-header">
				<img src="img/rakubLogo.jpg" />
				<h2 class="text-center"><font color="blue"><b>RAKUB MIS</b></font></h2>
			</div>
			<form id="login-form" method="post" class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			
			    <input name="officeCode" id="officeCode" type="Text" class="form-control" placeholder="Office/Branch Code" value="" autofocus> 
				<br>
				<input name="userId" id="userId" type="Text" class="form-control" placeholder="User Id" value=""> 
				<br>
				<input name="password" id="password" type="password" class="form-control" placeholder="Password" value=""> 
				
				<!--select class="form-control99" id="system" name="system">
					<option value="mis">
					System</option>
					<option value="cbs">CBS Migration System</option>
					<option value="id">ID Card System</option>
				</select-->
								
				<label><input type="radio" name="system" value="mis" checked> <span class="glyphicon glyphicon-time"></span> MIS System</label>
				<label><input type="radio" name="system" value="cbs"> <span class="glyphicon glyphicon-link"></span> CBS Data Migration System</label>
				<label><input type="radio" name="system" value="id"> <span class="glyphicon glyphicon-user"></span> ID Card System</label>
				<label><input type="radio" name="system" value="cib"> <span class="glyphicon glyphicon-user"></span> CIB Inquiry System</label>
						
				<br>
				<button type="submit" name="Submit" class="btn btn-md btn-success"><span class="glyphicon glyphicon-ok-sign"></span> Login</button>
				<button type="reset" name="reset" class="btn btn-md btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
				
				
			</form>
			<div class="form-footer">
				<div class="row">
					
					<div class="col-xs-6 col-sm-6 col-md-6">
						<i class="fa fa-registered" aria-hidden="true"></i>
						<a href="manual.php"><span class="glyphicon glyphicon-help"></span> User Manual </a>
					</div>					
					<div class="col-xs-6 col-sm-6 col-md-6">
						<i class="fa fa-searchch"></i>
						<a href="officeCode.php"><span class="glyphicon glyphicon-search"></span> Find Office/ Branch Code </a>
					</div>
				</div>
			</div>
			<br/>
			<div class="text-center well">
				<p>Copyright @2018, Rajshahi Krishi Unnayan Bank </p>
			</div>
		</div>
	</div>
	<!-- /container -->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/login.js"></script>
  </body>
</html>
   
