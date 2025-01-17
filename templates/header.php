<?php 



?>

<!DOCTYPE html>

<html lang="en">

  <head>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="php quiz script">

    <meta name="keywords" content="php quiz script, php quiz code, php quiz application, quiz php code">

	<meta name="author" content="#">

    <title>CIB Inquiry System</title>

	<link href='css/fonts_googleapis_com.css' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->

    <link type="text/css" rel="stylesheet" href="css/fonts_googleapis_com_css_family=Droid_Sans:400,700.css">

    <!-- Bootstrap -->

    <!--link href="css/bootstrap.min.css" rel="stylesheet"-->

    <link rel="icon" href="im/fb-con.png" type="image/x-icon" />

    <link href="css/font-awesome.min.css" rel="stylesheet">
	    



   <link rel="stylesheet" href="css/bootstrap.min_v3.2.0.css">
   

<style>
.bg-ass {background-color: #edf4f7;}
.bg-white {background-color: white;}
.bg-green {background-color: #03c10a;}
.bg-green2 {background-color: #10a321;}
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
.blue { color: blue; }
.orange { color: orange; }
.sky { color: #64b7ff; }
.white { color: white; }
.black { color: black; }
.ass { color: #edf4f7; }

.big { font-size: 20px; 
	   font-weight: bold;
}


.bigBoldW { font-size: 16px; 
	   font-weight: bold;
	   color: black;
}
.small { font-size: 12px; 
}

.xsm { font-size: 8px; 
	   font-weight: bold;
}

.sm { font-size: 12px; 
	   font-weight: bold;
}

.md { font-size: 15px; 
	   font-weight: bold;
}

</style>

    <!--date picker -->

<script src="js/datetimepicker_css.js"></script>    

    <script type='text/javascript' src='js/jquery-1.8.3.js'></script>
	    <link href="css/main.css" rel="stylesheet">



    <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css">

    <script type='text/javascript' src="js/bootstrap-datepicker.min.js"></script>

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

   <script language="javascript" type="text/javascript">
//////// print function
/*
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
			//tableData =tableData+'<table border="1">'+document.getElementsByTagName('table')[2].innerHTML+'</table>';
			//divElements = '<table border="1">'divElements+'</table>';
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body><border='1'>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
		*/
		
    </script>
<script language="javascript">
function printDiv() {
    var divToPrint = document.getElementById('printarea');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000;' +
        'padding;0.5em;' +
		//'text-align:right;' +
        '}' +
		'table {'+
		'border-collapse: collapse;'+
		'}'+
		
		'table td,'+
		'table th'+
		'{'+
		'text-align:left;'+
		'}'+

		'table td + td,'+
		'table th + th'+
		'{'+
		'text-align:right'+
		'}'+
		
		'.spColor1 {'+
		'background-color: green;'+
		'}'+

		
		'.spColor {'+
		'background-color: #ebe8e7;'+
		'}'+
		'@media print {'+
		'body {-webkit-print-color-adjust: exact;}'+
		'}'+

		/*
		'@media print {'+
		'table {page-break-after: always;}'+
		'}'+
		*/

		'@media print {'+
		'thead {display: table-header-group;}'+
		'}'+
		//'@media screen {'+
		//'thead { display: block; }'+
		//'}'+
		
	'@page {'+
	'counter-increment: page;'+
	'counter-reset: page 1;'+
	'@top-right {'+
	'content: "Page " counter(page) " of " counter(pages);'+
	'}'+
	'}'+
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}
</script>
 </head>

 <body >



    <!-- Static navbar -->

			<?php 

			$arr = explode("/",$_SERVER['REQUEST_URI']);

			$uri = end( $arr ); 

			

			?>

<nav class="navbar navbar-default navbar-fixed-top" style="background-color:#008836;">

  <div class="container-fluid">

    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>                        

      </button>

      
     <a href="home.php" ><font color="white" size="6"><img src="img/logo.jpg" width="60" height="60">CIB Inquiry System</font></a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar" >

		<ul class="nav navbar-right navbar-nav">
		<li   <?php if($uri == 'home.php') echo "class='active'"; ?>><a href="home.php"   style="color:red;">Home </a></li>
		<li <?php if($uri == 'logout.php') echo "class='active'"; ?>><a href="logout.php"   style="color:white;">Logout </a></li>
		
		</ul>
    </div>

  </div>

</nav>
