
<?php
include 'bs.php';
include 'config.php';


ini_set('display_errors', 'off');
//session_start();

if(!isset($_SESSION['admn']))
{		
	header("Location:login.php");
}

?>
<style type="text/css">
.customers {
	
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  
}

.customers td, .customers th {
  border: 1px solid #ddd;
padding: 5px;
font-size: 15px;
}


.Nrow
{
	background-color: #CCC;
	font-weight: bold;
}
.customers tr:hover {background-color: #A4F6AF;}

.customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

input[type='button'] {
   text-align: left;
}
select
{
width:300px;
 }
 
 		.txtlbl {
		background: rgba(0, 0, 0, 0);
		border: none;
		}
.edit{
		background: rgba(0, 0, 0, 0);
		border: none;
		
}	
.edit:hover {
  background-color: #A4F6AF;
  
}
  </style>
<script>
$(document).ready(function(){
  $("#txtSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#officerList tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<body>
<div class="container">
<div class="row" style="min-height: 450px;">
<br>
  <h2 style=" color:green; font-size:3vw;" >Personnel Data Sheet</h2>
  <hr style="color:green; ">

  <div  class="col-sm-6 col-md-6"></div>
  <div  class="col-sm-6 col-md-6">
      <div class="form-group">
      <label class="control-label col-sm-6" style="margin-top:8px;text-align:right; color: green; font-size:16px; " for="email">Searching Text:</label>
      <div class="col-sm-6">
        <input type="text" style="border: 1px solid green;" class="form-control" id="txtSearch" placeholder="Type Here Searching Text" name="TxtSearch">
      <br>
	  </div>
	  
    </div>
	
  </div>
<?php

$sqllist="SELECT `name_eng`, `name_ban`, `zone_code`, `branch_code`, `emp_id`, 
`father_name`, `mother_name`, `spouse_name`, `p_address`, `t_address`, `designation`,
 `place_posting`, `telephone_home`, `mobile_prsnl`, `mobile_crp`, `emrgncy_cntct`, 
 `nid`, `license`, `ppno`, `date_issue`, `date_valid`, `dob`, `join_date_br`, 
 `join_as`, `last_des`, `prom_date`, `marital`, `child_no`, `tin`, `circle_name`, 
 `bloodgrp`, `email`, `picture`, `date` FROM `emp_all`  order by name_eng";


echo "<table class='table  table-bordered table-striped, customers'>";
echo "<thead>";
echo "<tr>";
echo '<th >SL#</th>';
echo '<th >Emp. Id</th>';
echo "<th>officer's Name</th>";
echo "<th>Designation</th>";
echo "<th>Father's Name</th>";
echo "<th>Mother's Name</th>";
echo "<th>Office</th>";

echo "<th>Edit PDS</th>";
echo "</tr>";
echo "</thead>";
echo '<tbody id="officerList">';

$sn=1;

$res = mysqli_query($conn, $sqllist);

while($rw = mysqli_fetch_assoc($res))
	{
		echo "<tr>";
		echo "<td>".$sn."</td>";
		echo "<td>".$rw['emp_id']."</td>";
		echo "<td>".$rw['name_eng']."</td>";
		echo "<td>".$rw['designation']."</td>";
		echo "<td>".$rw['father_name']."</td>";
		echo "<td>".$rw['mother_name']."</td>";
		echo "<td>".$rw['place_posting']."</td>";
		$eid=trim($rw['emp_id']);
		$enm=trim($rw['name_eng']);
		echo '<td><a href="pds.php?eid='.$eid.'&enm='.$enm.'"><button type="button" class="btn btn-default btn-lg orange edit" style="border: none;">
          <span class="glyphicon glyphicon-edit"></span>
        </button></a></td>';
		echo "</tr>";
		$sn++;
	}
echo "</tbody>";
echo "</table>";

?>

</div> <!-- end of row -->

</div>
<?php require_once 'templates/footer.php';?>