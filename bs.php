<?php 

ob_start();
session_start();
ini_set('display_errors','off');
if(!isset($_SESSION['logged_in'])){

	header('Location: ../login.php');

}
include('convertToBangla.php');
//include('BanglaToenglish.php');
include('fy.php');
$type = $_SESSION['type'];

	function en2bn($en){	
			$bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
			$bn = str_replace(range(0, 9),$bn_digits, $en);
			return $bn;
		}


?>
<?php
if(isset ($_SESSION['offCode']))
{
$offCode=$_SESSION['offCode'];
$offName=$_SESSION['office'];
$OifficeLevel = $_SESSION['OifficeLevel'];
$type = $_SESSION['type'];
$BrCode=$_SESSION['offCode'];
$uid=$_SESSION['uid'];					
}

?>
<!DOCTYPE html>
<html>
<head>

  <link rel="icon" href="images/rakub.jpg" type="image/png"></link>
    <title> CIB Management System </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/bootstrap.bundle.js"></script>
 
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">  
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap-reboot.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap-grid.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
 



  <script src="../js/datetimepicker_css.js"></script>  
  
  <script src="../js/pageload-pace.js"></script>  

 <!-- DATA TABLE  : ####################################### -->   
   <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
<!-- DATA TABLE  : ####################################### --> 


	
  
 <!-- MOVE ITEM : ####################################### -->  
<script src="../js/jquery.selectlistactions.js"></script>
<link rel="stylesheet" href="../css/moveItem.css">

<style>
.bg-ass {background-color: #edf4f7;}
.bg-white {background-color: white;}
.bg-green {background-color: green;}
.bg-green2 {background-color: #10a321;}
.bg-green3 {background-color: #c6f7d0;}
.bg-orange {background-color: orange;}
.bg-red {background-color: red;}
.bg-blue {background-color: blue;}
.bg-black {background-color: black;}
.bg-sky {background-color: #64b7ff;}
.bg-nav {background-color: white;}
.bg-int {background-color: #7501af;}

.btnSq {border-radius: 12px;}
.btnRound {border-radius: 50%;}
.btnRoundLg {border-radius: 30%;}

.btn-square {border-radius: 12px;}
.btn-round {border-radius: 50%;}
.btn-round-lg {border-radius: 30%;}

<!-- FONT COLOR, SIZE -->

.red {color: red; }
.red2 {color: red; }
.red-color {color: red; }
.green { color: green; }
.green2 { color: #c6f7d0; }
.green3 { color: #c6f7d0; }
.blue { color: blue; }
.orange { color: orange; }
.sky { color: #64b7ff; }
.white { color: white; }
.black { color: black; }
.ass { color: #edf4f7; }


.big { font-size: 20px; 
	   //background-color: #c4e1ff;// #d4d6d8;
	   //background-color: #64b7ff; //sky
	   font-weight: bold;
}


.bigBoldW { font-size: 16px; 
	   font-weight: bold;
	   color: black;
}



.small { font-size: 12px; 
	   //font-weight: bold;
}

.xsm { font-size: 8px; 
	   //background-color: #d4d6d8;
	   !background-color: #c4e1ff;// #d4d6d8;
	   font-weight: bold;
}

.sm { font-size: 12px; 
	   font-weight: bold;
}

.md { font-size: 15px; 
	   font-weight: bold;
}


 .over{

	 text-decoration: overline;

 }

 .under{

	 text-decoration: underline;

 }

 .cut{

	 text-decoration: line-through;

 }


.lh-sm{
	 line-height: 1.8;
 }

 
hr {
    display: block;
    height: 2px;
    border: 0;
    border-top: 1px solid #010000;
    margin: 1em 0;
    padding: 0;
}

.mob-width {
	width: 220px;
 }
.bg {
    //background-image: url("images/divbg6.jpg");
	background-image: url("images/school-101.jpg");	
	//background-image: url("images/red-bg11.jpg");
	background-repeat: no-repeat;
    background-position: center;      /* center the image */
    //background-size: cover;           /* cover the entire window */
}



</style>

<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>  

<style type="text/css">

#navcolor
        {
            background-color: #1589FF ;
        }

  .h3,h4{
      color:white;
  }

  #panel-heading{
      color:red;
  }

 </style> 

<style>
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
</style>

  
<!///FOR MODAL FORM///////////////////////////> 
<style>
  .modal-header, h6, .close {
      !background-color: green;
	  !background-color: #c6f7d0;
	  background-color: #c6f7d0;
	  
      color:black !important;
      text-align: center;
      font-size: 30px;
  }

  .modal-footer {
      background-color: #f2f7f3;
  }
  
  .modal-dialog {
  width: 900px; !MODAL WINDOW SIZE

}
  </style>
<! END OF MODAL FORM////////////////////>

<!PRINT CONTAINT OF A DIV>

<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

<!END PRINT>
 
<script>
/*
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
*/

//background-color: #64b7ff  // SKY COLOR
</script>

<script>
// Tooltip: Show Hints

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

// OPTION FOR SPECIFIC BUTTON ....
$(document).ready(function(){
    $('.btn99').tooltip({title: "<h1><strong>HTML</strong> inside <code>the</code> <em>tooltip</em></h1>", html: true, placement: "bottom"}); 
});

//############# SHOW CLOCK #################/
var myVar = setInterval(myTimer, 1000);
function myTimer() {
    var d = new Date();
    document.getElementById("clock99").innerHTML = d.toLocaleTimeString();
}

//####### END OF Tooltip ####################

// POP OVER
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
// ###############

//#64b7ff;  //sky
//#04ce3d;  // green

</script>

 <!-- ############## LOCAL FILE ####################### --> 
<link rel="stylesheet" href="css/floatBtnAction.css">     	
<link rel="stylesheet" href="css/floatBtnType.css">  
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<table class="table table-responsive table-condense black"><tr class="bg-white">

		<td align="center"><img src="images/rakub.png" height="50" width="50"><font color="green" size="5"><b> রাজশাহী কৃষি উন্নয়ন ব্যাংক</b></font></td>

<?php
if (isset($_SESSION['offCode'])){
?>
	
		
		<td>
		<?php
			$br_code=$_SESSION['offCode'];
			$br_name=$_SESSION['office'];
			echo 'শাখার নাম: '.$br_name.'<br>';
		?>
		</td>
		<td align="left">
		<?php			
			$name=$_SESSION['name'];
			$username=$_SESSION['username'];
			echo 'ইউজার: '.$uid.'<br>নাম: '.$username;
		?>		
		</td>
		
		<td align="right">

       	  
		</td>
		
		<td  align="right">
		
			<a href="logout.php" class="btn btn-danger btn-sm">
			  <span class="glyphicon glyphicon-log-out"></span> Log out
			</a>

		
		</td>	

		
		<?php
			}
		?>
		
		</tr></table>

<div class="bg-green">		
<center><font color="white" size="5"><span class="glyphicon glyphicon-retweet fa-1x white"></span> 
CIB Management System </font></center>
</div>
