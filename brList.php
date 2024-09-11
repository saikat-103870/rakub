<?php
ob_start();

session_start();

require_once 'config.php'; 

$Loc="Select Branch";
if($_POST['id'])
{
	
	$id=$_POST['id'];
	$sql="SELECT `brcode`, brName FROM `branch` WHERE `ZoneId`='".$id."'";
	$result=mysqli_query($conn, $sql); ?>
	
	<option selected="selected" value=""><?php echo $Loc; ?></option>
	<?php
	while($row = mysqli_fetch_assoc($result))
	{
	?>
			
		<option value="<?php echo $row['brcode']; ?>"><?php echo $row['brName']; ?></option>	
		 <?php
	}
	

}
?>