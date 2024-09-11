	<script>
$(document).ready(function() {
	  
    $('#company').validate({
        rules: {
				'LoanType': {
						required: true,
						minlength: 1,
					},
				'FinTypeID': {
						required: true,
						minlength: 1,
					},	
				
				'Title': {
						required: true,
						minlength: 1,
					},
				'TradeName': {
						required: true,
						minlength: 1,
					},
				'TotalReqAmt': {
						required: true,
						minlength: 1,
					},						
				'LegalForm': {
						required: true,
						minlength: 1,
					},	
					
				'SecCode': {
						required: true,
						minlength: 1,
					},
				
				'SecType': {
						required: true,
						minlength: 1,
					},					
				'BusStreet': {
						required: true,
						minlength: 1,
					},
				'BusPostal': {
						required: true,
						minlength: 4,
					},
				'BusDistrict': {
						required: true,
						minlength: 1,
					},
				'BusCountry': {
						required: true,
						minlength: 1,
					},
					'FISubCode': {
						
						minlength: 16,
					},
					'RegDate': {
						required: true,
						minlength: 1,
					},
					'TelephoneNumber': {
						required: true,
						minlength: 1,
					},
					'voucherAmount': {
						
						required: true,
					},
					'voucherNumber': {
						
						required: true,
					},
					'voucherDate': {
						
						required: true,
					},
					'contractHistory': {
						
						required: true,
					},
					'contractPhase': {
						
						required: true,
					},
					'FacPostal': {
						
						minlength: 4,
					},
					'UploadMoneyReceipt':{
		   required:{
			   depends: function(element){
				   var status = true;
				    var vchrNo=$("#voucherNumber").val();
				  if(vchrNo.length==0){
						//alert("Please Upload other id");
						 var status = false;
			}
				   //console.log("yesname is: "+status);
				   return status;
			   }
		   }
		   
	   },
					/*
				'txtLienFromToOrg': {
						required: true,
						minlength: 3,
					},
				'txtFromDate': 	{
					required: true,
     				},
			
*/
        },
		
        messages: {
			'LoanType': {
                required: 'Select loan type',
            },
            'FinTypeID': {
                required: 'Fill up finance type',
            },
		  'TotalReqAmt': {
                required: 'Provide total requested amount.',
            },
		 'TradeName': {
                required: 'Insert Trade name.',
            },
		 'Title': {
                required: 'Insert title of trade.',
            },
			'LegalForm': {
                required: 'Select one',
            },
		
			'SecType': {
                required: 'Provide sector type.',
            },
				'BusStreet': {
                required: 'Provide business address street name and number',
            },
				'BusPostal': {
                required: 'Provide business address postal code.',
            },
				'BusDistrict': {
                required: 'provide business address district.',
            },
				'BusCountry': {
                required: 'Provide business address country.',
            },
				'SecCode': {
                required: 'Provide sector code.',
            },
			'RegDate': {
                required: 'Provide date of Registration.',
            },
			'FISubCode': {
                required: 'must be 16 digits.',
            },
			'TelephoneNumber': {
                required: 'Insert telephone number.',
            },
			'voucherAmount': {
                required: 'Provide amount.',
            },
			'voucherNumber': {
                required: 'Provide voucher number.',
            },
			'voucherDate': {
                required: 'Provide voucher date.',
            },
			'contractHistory': {
                required: 'select contract history.',
            },
			'contractPhase': {
                required: 'select contract phase.',
            },
			'UploadMoneyReceipt': {
                required: 'Please upload money receipt.',
            },
			/*
			'txtFromDate': {
                required: 'Mandatory field.',
            },
			*/
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


      });

	
    });

</script>

<script>
        function fileValidation1() {
            var fileInput = 
                document.getElementById('UploadMoneyReceipt');
              
            var filePath = fileInput.value;
          
            // Allowing file type
            var allowedExtensions = 
                   /(\.jpg|\.jpeg|\.png|.\pdf)$/i;
              
            if (!allowedExtensions.exec(filePath)) {
               alert('File type must be jpg,jpeg,png or pdf');
                fileInput.value = '';
                return false;
            } 
            else 
            {
              
                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'UploadMoneyReceipt').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>

<script>
        function fileValidation2() {
            var fileInput = 
                document.getElementById('UploadPromiseLetter');
              
            var filePath = fileInput.value;
          
            // Allowing file type
            var allowedExtensions = 
                         /(\.jpg|\.jpeg|\.png|.\pdf)$/i;
              
            if (!allowedExtensions.exec(filePath)) {
               alert('File type must be jpg,jpeg,png or pdf');
                fileInput.value = '';
                return false;
            } 
            else 
            {
              
                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'UploadPromiseLetter').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>
	
	
<script>
        function fileValidation3() {
            var fileInput = 
                document.getElementById('UploadOtherDocs');
              
            var filePath = fileInput.value;
          
            // Allowing file type
            var allowedExtensions = 
                        /(\.jpg|\.jpeg|\.png|.\pdf)$/i;
              
            if (!allowedExtensions.exec(filePath)) {
               alert('File type must be jpg,jpeg,png or pdf');
                fileInput.value = '';
                return false;
            } 
            else 
            {
              
                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById(
                            'UploadOtherDocs').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
			        }
    </script>
<script>
$(document).ready(function(){
$("#UploadMoneyReceipt").change(function(){
$("#file_error1").html("");
$(".UploadMoneyReceipt").css("border-color","#F0F0F0");
var file_size1 = $('#UploadMoneyReceipt')[0].files[0].size;
if(file_size1>5000000) {
$("#file_error1").html("<p style='color:#FF0000'>File size is greater than 5 mb</p>");
$(".UploadMoneyReceipt").css("border-color","#FF0000");
this.value = "";
return false;
} 
return true;
});
});
</script>
<script>
$(document).ready(function(){
$("#UploadPromiseLetter").change(function(){
$("#file_error2").html("");
$(".UploadPromiseLetter").css("border-color","#F0F0F0");
var file_size1 = $('#UploadPromiseLetter')[0].files[0].size;
if(file_size1>5000000) {
$("#file_error2").html("<p style='color:#FF0000'>File size is greater than 5 mb</p>");
$(".UploadPromiseLetter").css("border-color","#FF0000");
this.value = "";
return false;
} 
return true;
});
});
</script>
<script>
$(document).ready(function(){
$("#UploadOtherDocs").change(function(){
$("#file_error3").html("");
$(".UploadOtherDocs").css("border-color","#F0F0F0");
var file_size1 = $('#UploadOtherDocs')[0].files[0].size;
if(file_size1>5000000) {
$("#file_error3").html("<p style='color:#FF0000'>File size is greater than 5 mb</p>");
$(".UploadOtherDocs").css("border-color","#FF0000");
this.value = "";
return false;
} 
return true;
});
});
</script>
<script>
function validateForm() {
$("#file_error88").html("");
$(".indiviCompnyInfo").css("border-color","#F0F0F0");
var radioValue = $("input[name='indiviCompnyInfo']:checked").val();

//alert("Your are a - " + radioValue.length);
if((radioValue=="Borrower")||(radioValue=="owner")||(radioValue=="Co-Borrower")||(radioValue=="gurantor")) {
//alert("Your are aaaaaa - " + radioValue);
return true;
} 
else{
	$("#file_error88").html("<p style='color:#FF0000;background-color:#ffcccc;font-weight:bold;'>Please check atleast one</p>");
	return false;
	//alert("Please enter a value");
}
	
}

$(document).ready(function() {
    $('input:radio[name=indiviCompnyInfo]').change(function() {
        if ((this.value == 'owner')) {
	$("#file_error88").html("");
        }
        else if (this.value == 'Borrower') {
	$("#file_error88").html("");
        }
		  else if (this.value == 'gurantor') {
	$("#file_error88").html("");
        }
		  else if (this.value == 'Co-Borrower') {
	$("#file_error88").html("");
        }
    });
});
</script>