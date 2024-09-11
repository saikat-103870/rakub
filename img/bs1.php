<?php
//include("../mysettings.php");
//include("../classLibSys.php");

date_default_timezone_set('Asia/Dhaka'); // CDT
$d=date('d-m-Y');
$t=date('H:i:s');

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="../images/logo.png" type="image/png"></link>
    <title>........ RAKUB MIS ..........</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
 
 
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
  <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">  
  <link href="http://pingendo.github.io/pingendo-bootstrap/themes/default/bootstrap.css" rel="stylesheet" type="text/css">


  <script src="../js/datetimepicker_css.js"></script>  
  <link href="../css/pageload-pace-bar.css" rel="stylesheet" /> 
  <script src="../js/pageload-pace.js"></script>  

  <!-- MOVE ITEM : ####################################### -->  

<script src="../js/jquery.selectlistactions.js"></script>
<link rel="stylesheet" href="../css/moveItem.css">

<!-- ####################################### -->  

<style>

.bg-ass {background-color: #eaeced;}
.bg-white {background-color: white;}
// #eaeced; #f9f9f9; 
.btnSq {border-radius: 12px;}
.btnRound {border-radius: 50%;}

<!-- FONT COLOR, SIZE -->
.red {	color: red; }
.green { color: green; }
.sky { color: #64b7ff; }
.white { color: white; }
.black { color: black; }

.big { font-size: 20px; 
	   background-color: #c4e1ff;// #d4d6d8;
	   //background-color: #64b7ff; //sky
	   font-weight: bold;
}

.small { font-size: 10px; 
	   background-color: #c4e1ff;// #d4d6d8;
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
<!-- END OF FONT COLOR, SIZE -->
 
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
	.dropdown:hover .dropdown-menu {
	//display: block;
	}

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
      background-color: #64b7ff;
	  //background-color: #3b88ed; //sky	
	  
	  //background-color: #696b70;
	  //background-color: #e2dede;
	  
	  //background-color: #71ef0a;	//Green
	  
	  //background-color: #079b2;	//Green
	  
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
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});

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
    document.getElementById("clock").innerHTML = d.toLocaleTimeString();
}

//###########################33

//#64b7ff;  //sky
//#04ce3d;  // green

</script>

 <!-- ############## LOCAL FILE ####################### --> 
<link rel="stylesheet" href="../css/floatBtnAction.css">     	
<link rel="stylesheet" href="../css/floatBtnType.css">  
<!link rel="stylesheet" href="../css/floatBtn.css">     	
<!link rel="stylesheet" href="../css/floatBtnFont.css">     	
<!link rel="stylesheet" href="../css/floatBtnIcon.css">     	
  

</head>

<center><h1 class="bg-primary white"><img src="../images/rakubLogo.jpg" height="60" width="60" /> রাজশাহী কৃষি উন্নয়ন ব্যাংক</h1></center>
