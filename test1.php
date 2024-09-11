 

<head>
 
    <script type='text/javascript'src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  
      
    <script  type='text/javascript'src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      

<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script> 

	   
 
</head>

 <div class="form-group">
	  <label for="cerBankingDpma1">Certificate</label>
	  <div style="border: 1px solid green;">
 <script type="text/javascript">
    $(function () {
        $("input[name=btnShowDip2]").click(function () {
            if ($(this).val() == "Change") {
                $("#fileDip2").show();
				$("#firstDip2").hide();
				$('#dphd2').val(1);
            } else {
                $("#fileDip2").hide();
				$("#firstDip2").show
				$('#dphd2').val(0);
            }
        });
    });
</script>	  
	  <?php
	  $display="display: ''";
	  if(!empty($d_certifica21Link))
		  {
			echo '<div id="firstDip2">';
			$lnk=$d_certifica21Link;
			if(strlen($d_certifica21Link)>22)
			{
			$lnk='..'.substr($d_certifica21Link,-22,22);
			}
			echo '<a href="uploads/'.$d_certifica21Link.'" target="_blank" style=" color: blue;">'.$lnk.'</a>'; 
			echo ' <input type="button" style="border:none; color: red;" value="Change" name ="btnShowDip2" id ="btnShowDip2" />';
			echo '</div>';
			$display="display: none";
		  }
		  else{
			  $display="display: ''";
		  }
		
		echo '<input id="fileDip2" style="'.$display.'" type="file" size="10px" name="cerBankingDpma2" class="cerBankingDpma2">';
	  ?>
	  	  <input type="hidden" value="0" name="dphd2" id="dphd2">
	  
	  </div>
	  
	</div>