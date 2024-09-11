	   
 
	<script>

	
$(document).ready(function() {
	
		
	  
    $('#individual').validate({
        rules: {
				'FinTypeID': {
						required: true,
						minlength: 1,
					},	
					
				'Name': {
						required: true,
						minlength: 1,
					},
					'FatherName': {
						required: true,
						minlength: 1,
					},
						'MotherName': {
						required: true,
						minlength: 1,
					},
				'TotalReqAmt': {
						required: true,
						minlength: 1,
					},						
					
				'LoanType': {
						required: true,
						minlength: 1,
					},	
					'Gender': {
						required: true,
						minlength: 1,
					},
					'NID': {
						required: true,
						
					},
					'SecCode': {
						required: true,
						minlength: 1,
					},
				'BirthDate': {
						required: true,
						minlength: 1,
					},
				'BirthDistrict': {
						required: true,
						minlength: 1,
					},
				'BirthCountry': {
						required: true,
						minlength: 1,
					},	
				'SecType': {
						required: true,
						minlength: 1,
					},					
						'PerStreet': {
						required: true,
						minlength: 1,
					},
						'PerPostal': {
						required: true,
						minlength: 4,
					},
						'PerDistrict': {
						required: true,
						minlength: 1,
					},
					'PerCountry': {
						required: true,
						minlength: 1,
					},
					'PrePostal': {
						
						minlength: 4,
					},
					'TelephoneNumber': {
						required: true,
						
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
					'FISubCode': {
						
						minlength: 16,
					},
						'contractHistory': {
						
						required: true,
					},
						'contractPhase': {
						
						required: true,
					},
					
			
					
				   'IDNumber':{
		   required:{
			   depends: function(element){
				   var status = true;
				    var NID1=$("#NID").val();
				  	if(NID1.length!=0){
						//alert("Please Upload other id");
						 var status = false;
			}
				   //console.log("yesname is: "+status);
				   return status;
			   }
		   }
		   
	   },
	   		   'IDIssueDate':{
		   required:{
			   depends: function(element){
				   var status = true;
				    var NID2=$("#NID").val();
				  if(NID2.length!=0){
						//alert("Please Upload other id");
						 var status = false;
			}
				   //console.log("yesname is: "+status);
				   return status;
			   }
		   }
		   
	   },
	   'IDType':{
		   required:{
			   depends: function(element){
				   var status = true;
				    var NID2=$("#NID").val();
				  if(NID2.length!=0){
						//alert("Please Upload other id");
						 var status = false;
			}
				   //console.log("yesname is: "+status);
				   return status;
			   }
		   }
		   
	   },
	 'UploadNID':{
		   required:{
			   depends: function(element){
				   var status = true;
				    var NID2=$("#NID").val();
				  if(NID2.length==0){
						//alert("Please Upload other id");
						 var status = false;
			}
				   //console.log("yesname is: "+status);
				   return status;
			   }
		   }
		   
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
	    'UploadOtherDocs':{
		   required:{
			   depends: function(element){
				   var status = true;
				    var type=$("#IDType").val();
				    var number=$("#IDNumber").val();
				  if(type.length==0){
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
                required: 'Select loan type.',
            },
            'FinTypeID': {
                required: 'Fill up finance type',
            },
		  'TotalReqAmt': {
                required: 'Provide total requested amount.',
            },
		 'Name': {
                required: 'Insert full name.',
            },
		 'FatherName': {
                required: 'Insert name of father.',
            },
			'MotherName': {
                required: 'Insert name of mother',
            },
			'BirthDate': {
                required: 'Provide date of birth.',
            },
			'BirthDistrict': {
                required: 'Provide birth district',
            },
			'BirthCountry': {
                required: 'Provide birth country',
            },
			'SecType': {
                required: 'Provide sector type.',
            },
				'PerStreet': {
                required: 'Provide permanent address street name and number',
            },
				'PerPostal': {
                required: 'Provide permanent address postal code.',
            },
				'PerDistrict': {
                required: 'Provide permanent address district.',
            },
				'PerCountry': {
                required: 'Provide permanent address country.',
            },
				'SecCode': {
                required: 'Provide sector code.',
            },
				'Gender': {
                required: 'Select Gender.',
            },
			'NID': {
                required: 'Enter NID/Smart Card.',
            },
			'TelephoneNumber': {
                required: 'Provide Telephone Number.',
            },
			'contractHistory': {
                required: 'Select contract history.',
            },
			'contractPhase': {
                required: 'Select contract phase.',
            },
			
			'IDNumber': {
                required: 'Plese provide other ID Number.',
            },
			'IDIssueDate': {
                required: 'Plese provide other ID Issue Date.',
            },
			'IDType': {
                required: 'Plese provide other ID Type.',
            },
			'UploadNID': {
                required: 'Plese upload NID.',
            },
			'UploadMoneyReceipt': {
                required: 'Plese upload money receipt.',
            },
			'UploadOtherDocs': {
                required: 'Plese upload other docs.',
            },
			'voucherAmount': {
                required: 'Provide voucher amount.',
            },
			'voucherNumber': {
                required: 'Provide voucher number.',
            },
			'voucherDate': {
                required: 'Provide voucher date.',
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
        function fileValidation() {
            var fileInput = 
                document.getElementById('UploadNID');
              
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
                            'UploadNID').innerHTML = 
                            '<img src="' + e.target.result
                            + '"/>';
                    };
                      
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
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
$("#UploadNID").change(function(){
$("#file_error").html("");
$(".UploadNID").css("border-color","#F0F0F0");
var file_size = $('#UploadNID')[0].files[0].size;
if(file_size>5000000) {
$("#file_error").html("<p style='color:#FF0000'>File size is greater than 5 mb</p>");
$(".UploadNID").css("border-color","#FF0000");
this.value = "";
return false;
} 
return true;
});
});
</script>


<script>


function getAge(birthday){
	
		var dob = new Date(birthday);
		//calculate month difference from current date in time
		var month_diff = Date.now() - dob.getTime();
		
		//convert the calculated difference in date format
		var age_dt = new Date(month_diff); 
		
		//extract year from date    
		var year = age_dt.getUTCFullYear();
		
		//now calculate the age of the user
		var age = Math.abs(year - 1970);
		
		return age;
	
}	

function validateForm() {

$("#file_error99").html("");
$(".NID").css("border-color","#F0F0F0");
var l=$("#NID").val();

if(l.length==0)
{
	return true;
}
if((l.length!=13) && (l.length!=17) && (l.length!=10)) {
$("#file_error99").html("<p style='color:#FF0000'>NID must be 10, 13 or 17 characters.</p>");
$(".NID").css("border-color","#FF0000");
return false;
} 
else{
return true;
}

	
}
$(document).ready(function(){
		
$("#NID").change(function(){
$("#file_error99").html("");
$(".NID").css("border-color","#F0F0F0");
var l=$("#NID").val();
if((l.length!=13) && (l.length!=17) && (l.length!=10)) {
$("#file_error99").html("<p style='color:#FF0000;background-color:#ffcccc;font-weight:bold;'>NID must be 10, 13 or 17 characters.</p>");
$(".NID").css("border-color","#FF0000");
return false;
} 
else{
return true;
}
});


$("#BirthDate").change(function(){
$("#dob_error").html("");
var birthday=$("#BirthDate").val();

var age = getAge(birthday);


if(age<18) {
$("#dob_error").html("<p style='color:#FF0000;background-color:#ffcccc;font-weight:bold;'>Age must be 18 years and above</p>");
return false;
} 
else{
return true;
}
});


});


</script>

<script>

$(document).ready(function(){
  $("form").submit(function(){
 $("#file_error88").html("");

$(".indiviCompnyInfo").css("border-color","#F0F0F0");
var radioValue = $("input[name='indiviCompnyInfo']:checked").val();

//alert("Your are a - " + radioValue.length);
if((radioValue=="Borrower")||(radioValue=="owner")||(radioValue=="Co-Borrower")||(radioValue=="gurantor")) {
//alert("Your are aaaaaa - " + radioValue);
return true;
} 
else{
	$("#file_error88").html("<p style='color:#FF0000;background-color:#ffcccc;font-weight:bold;'>Please check one radio button for individual information.</p>");
	return false;
	//alert("Please enter a value");
}
  });
});

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

<script>
$(document).ready(function(){
$("#UploadMoneyReceipt").change(function(){
$("#file_error1").html("");
$(".UploadMoneyReceipt").css("border-color","#F0F0F0");
var file_size1 = $('#UploadMoneyReceipt')[0].files[0].size;
if(file_size1>5000000) {
$("#file_error1").html("<p style='color:#FF0000;'>File size is greater than 5 mb</p>");
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




<style>
  .error{
            color: red;
            background-color: #FFE4E1;
         }
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: white;
}



.topnav .search-container {
  float: left;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}
.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    color: #ffffff;
    background-color: #04aa26;

}
.topnav .search-container a {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
  border: 1px solid #ccc; 
}



@media screen and (max-width: 400px) {
  .topnav .search-container {
    float: none;
  }

}
.required:after {
	content:" *";
	color: red;
	font-weight: bold;
}

.errortxt 
{
    color: red;
	background-color:#FFE4E1;
}

</style>
</head>
