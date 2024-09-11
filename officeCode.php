<?php
ob_start();
session_start();
require_once 'config.php'; 
?>
<?php 
	if(!empty($_POST)){
		try {
			$user_obj = new Cl_User();
			$data = $user_obj->registration($_POST );
			if($data){
			    $_SESSION['success'] = USER_REGISTRATION_SUCCESS;
				header('Location: login.php');exit;
			}
		} catch (Exception $e) {
			$_SESSION['error'] = $e->getMessage();
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
    <title> Find Code </title>
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
	
	    <!--date picker -->

    <script type='text/javascript' src='//code.jquery.com/jquery-1.8.3.js'></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker3.min.css">
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
	
	
	<script type="text/javascript">
		
$(document).ready(function()
{
	$(".OfficeLoc").change(function()
	{
		var id=$(this).val();
		$(".result").html("");
		var dataString = 'id='+ id;
	    
	        if($(this).val()!=1){
          $('.branch').hide();
			}
		  else{
            $('.branch').show();
		  }
	
	
	//
		$.ajax
		({
			type: "POST",
			url: "zoneList.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".ZoneList").html(html);
			} 
		});
	});
	
	
	$(".ZoneList").change(function()
	{
		var id=$(this).val();
		$(".result").html("");
		var nameoff=$('.ZoneList option:selected').text();
		var dataString = 'id='+ id;
	  // var offloc = document.getElementById("OfficeLoc");
	   var offloc =$('.OfficeLoc option:selected').val();
	   if (offloc!=1)
	   {
		   if (offloc==2)
		   {
		   $(".result").html("জোনাল কার্যালয়,  "+nameoff+"<br/> কার্যালয় কোড: "+id);		   $(".result").css({ 'color': 'red', 'font-size': '120%' });
		   }
		   else if (offloc==3)
		   {
		   $(".result").html("জোনাল  নিরীক্ষা কার্যালয়,  "+nameoff+"<br/> কার্যালয় কোড: "+id);		   $(".result").css({ 'color': 'red', 'font-size': '120%' });
		   }
		   else if (offloc==4)
		   {
		   $(".result").html(" বিভাগীয় কার্যালয়, "+nameoff+"<br/> কার্যালয় কোড: "+id);		   $(".result").css({ 'color': 'red', 'font-size': '120%' });
		   }
		   else if (offloc==5)
		   {
		   $(".result").html("বিভাগীয়  নিরীক্ষা কার্যালয়, "+nameoff+"<br/> কার্যালয় কোড: "+id);		   $(".result").css({ 'color': 'red', 'font-size': '120%' });
		   }
		   else if (offloc==6)
		   {
		   $(".result").html(" "+nameoff+"<br/> বিভাগের  কোড: "+id);		   $(".result").css({ 'color': 'red', 'font-size': '120%' });
		   }
		   return false;
	   }
		$.ajax
		({
			type: "POST",
			url: "brList.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$(".branch").html(html);
			} 
		});
	});

	$(".branch").change(function()
	{
		var idbr=$(this).val();
	    var brname=$('.branch option:selected').text();
		var offloc =$('.OfficeLoc option:selected').val();
		if (offloc==1)
	   {
           $(".result").html("<br/> শাখার নাম : "+brname+"<br/> শাখার কোড: "+idbr);		   $(".result").css({ 'color': 'red', 'font-size': '120%' });
		   return false;
	   }

	});
	
	
});
</script>



  </head>
  <body style="background-color:blue;">
	<div class="container">
		<div class="officefind-form">
			<?php //require_once 'templates/message.php';?>
			
			<h2 style="color:orange; text-align:center;">Find Office/ Branch Code</h2>
			<div class="form-header" style="background-color: #acbcad;">
			<i class="fa fa-search" style="font-size:48px;color:green"></i>
			</div>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-officefind" role="form" id="register-form">
						
				<div>
					<select name="OfficeLoc" class="OfficeLoc form-control" >
					<option selected="" disabled="disabled">Select Office Location</option>
						<option value="1">Branch</option>
						<option value="2">Zonal Office</option>
						<option value="3">Zonal Audit Office</option>
						<option value="4">Divisional Office</option>
						<option value="5">Division Audit Office</option>
						<option value="6">Head Office</option>
					</select>
					<span class="help-block"></span>
				<div>
				<br>
					</div>
					<select name="ZoneList" class="ZoneList form-control">
					<option selected="" disabled="disabled">--Select--</option>
					<span class="help-block"></span>
					</select>
				<div>
				<br>
					</div>
					<select name="branch" class="branch form-control">
					<option selected="selected">--Select--</option>
					</select>

					</div>
				
			<div class="result" ‍style="margin: 1px solid green;"> </div> 

			</form>
			<div class="form-footer" style="background-color: #acbcad;">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<i class="fa fa-lock"></i>
						<a href="home.php"> Home </a>
					
					</div>
					
					<div class="col-xs-6 col-sm-6 col-md-6" >
						<i class="fa fa-check"></i>
						<a href="login.php"> Login </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /container -->

	
    <script src="js/jquery.validate.min.js"></script> 
    <script src="js/register.js"></script>
  </body>
</html>
<?php unset($_SESSION['success'] ); unset($_SESSION['error']);  ?>    