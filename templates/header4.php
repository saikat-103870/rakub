<?php 
ob_start();
session_start();ini_set('display_errors','off');
if(!isset($_SESSION['logged_in'])){
	header('Location: login.php');
}include('convertToBangla.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="php quiz script">
    <meta name="keywords" content="php quiz script, php quiz code, php quiz application, quiz php code">
	<meta name="author" content="#">
    <title>RAKUB MIS</title>
	<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="im/fb-con.png" type="image/x-icon" />
    <link href="css/font-awesome.min.css" rel="stylesheet"> 	<link href="css/main.css" rel="stylesheet"> 	
    <!--date picker -->

    <script type='text/javascript' src='//code.jquery.com/jquery-1.8.3.js'></script>

    <!link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker3.min.css">
    <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>
		<script type='text/javascript'>
		$(function(){
		$('.input-group.date').datepicker({
			calendarWeeks: true,
			todayHighlight: true,
			autoclose: true,
			format: 'dd-mm-yyyy' 
		});  
		});

	</script>
	
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
   
 </head>
 <body >

    <!-- Static navbar -->
			<?php 
			$arr = explode("/",$_SERVER['REQUEST_URI']);
			$uri = end( $arr ); 
			
			?>
<nav class="navbar navbar-default navbar-fixed-top" style="background-color:#008836;">
  <div class="container-fluid">
    <div class="navbar-header">      <a href="home.php" ><font color="white" size="6"><img src="img/logo.jpg" width="60" height="60"> RAKUB MIS</font></a>    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
<ul class="nav navbar-right navbar-nav">

									
					<li <?php if($uri == 'home.php') echo "class='active'"; ?>><a href="home.php"><b>HOME</b></a></li>
					<li <?php if($uri == 'account.php'|| $uri == 'logout.php') echo "class='dropdown active'"; else echo "class='dropdown'"; ?>>
						<a href="#" data-toggle="dropdown" class="dropdown-toggle">
							<b>LOGIN BY: 
						<?php if($_SESSION['logged_in']) { ?>
							<?php echo $_SESSION['username']; ?>
							<span class="caret"></span>									</b>
						</a>
						<ul role="menu" class="dropdown-menu bgdm">
							<li> <a href="account.php"><b>CHANGE PASSWORD</b></a> </li>
							<li class="divider"></li>
							<li> <a href="logout.php"><b>LOGOUT</b></a> </li>
						</ul>
						<?php } ?>
					</li>
					
				</ul>
    </div>
  </div>
</nav>