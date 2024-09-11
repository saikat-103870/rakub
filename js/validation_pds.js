/*
$(document).ready(function() {
  $("#personalInfo").validate({
    rules: {


	empid: {
			required: true,
			minlength: 6,
			number: true,
		 },

	nameEng: {
			required: true,
			minlength: 3,
	   },
	  
	NIDCardNo: {
	required: true,
	minlength: 10,
	number: true,
	},
	
	FatherName: {
			required: true,
			minlength: 3,
	   },
	   
	MotherName: {
			required: true,
			minlength: 3,
	   },
	  
	  
	BirthCertificate: {
	required: true,
	minlength: 17,
	number: true,
	}, 
	
	SalaryAccountNo: {
	required: true,
	minlength: 4,
	number: true,
	},
	
	PersonalMobile: {
	required: true,
	minlength: 11,
	number: true,
	},
	
	EmergencyContactNo: {
	required: true,
	minlength: 11,
	number: true,
	},
	  
	PersonalEmailAddress: {
	required: true,
	email: true,
	},
	
	PassportNo: {
	minlength: 6,
	},
	  
	eTIN: {
	required: true,
	minlength: 9,
	number: true,
	},
	
	SpouseName: {
			required: true,
			minlength: 3
	   },
	   
	spNationalIDNo: {
	required: true,
	minlength: 10,
	number: true,
	},
	  
      weight: {
        required: {
          depends: function(elem) {
            return $("#age").val() > 50
          }
        },
        number: true,
        min: 0,
      },
	  
    },
	
	
	
    messages : {
      nameEng: {
        minlength: "Name should be at least 3 characters"
      },
      age: {
        required: "Please enter your age",
        number: "Please enter your age as a numerical value",
        min: "You must be at least 18 years old"
      },
      email: {
        email: "The email should be in the format: abc@domain.tld"
      },
      weight: {
        required: "People with age over 50 have to enter their weight",
        number: "Please enter your weight as a numerical value"
      },
    },
	
	  errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },
  });

  });
  */
  $(document).ready(function() {
	  
    $('#lieninfo').validate({
        rules: {
				'txtPostingBankLien': {
						required: true,
						minlength: 3,
					},
				'txtLienFromToOrg': {
						required: true,
						minlength: 3,
					},
				'txtFromDate': 	{
					required: true,
     				},
			

        },
		
        messages: {
            'txtPostingBankLien': {
                required: 'Mandatory field.',
            },
			'txtLienFromToOrg': {
                required: 'Mandatory field.',
            },
			'txtFromDate': {
                required: 'Mandatory field.',
            },
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	/////////Punishment
	
	  
    $('#punishment').validate({
        rules: {
				'PunishmentName': {
						required: true,
						minlength: 3,
					},
				'PunishmentDesc': {
						required: true,
						minlength: 3,
					},
				'PunishmentDate': 	{
					required: true,
     				},
				'PunishmentRefAuth': 	{
					required: true,
     				},
			
			
			

        },
		
        messages: {
            'PunishmentName': {
                required: 'Mandatory field.',
            },
			'PunishmentDesc': {
                required: 'Mandatory field.',
            },
			'PunishmentDate': {
                required: 'Mandatory field.',
            },
			'PunishmentRefAuth': {
                required: 'Mandatory field.',
            },
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	
	
	/////////Promotion
	
	  
    $('#promotion').validate({
        rules: {
				'FromDesg': {
						required: true,
						
					},
				'ToDesg': {
						required: true,
					},
				'PromotionDate': 	{
					required: true,
     				},
			
			

        },
		
        messages: {
            'FromDesg': {
                required: 'Mandatory field.',
            },
			'ToDesg': {
                required: 'Mandatory field.',
            },
			'PromotionDate': {
                required: 'Mandatory field.',
            },
			
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	
	/////////Reward
	
	  
    $('#reward').validate({
        rules: {
				'RewardName': {
						required: true,
						minlength: 3,
					},
				'RewardDesc': {
						required: true,
						minlength: 3,
					},
				'RewardDate': 	{
					required: true,
     				},
				'RewardedBy': 	{
					required: true,
     				},
			
			
		
        },
		
        messages: {
            'RewardName': {
                required: 'Mandatory field.',
            },
			'RewardDesc': {
                required: 'Mandatory field.',
            },
			'RewardDate': {
                required: 'Mandatory field.',
            },
			'RewardedBy': {
                required: 'Mandatory field.',
            },
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	/////////Transfer
	
	  
    $('#transfer').validate({
        rules: {
				'trFromLoc': {
						required: true,
					},
				'trFromZoneList': {
						required: true,
					},
				'trFrombranch': {
						required: true,
					},
				'trToLoc': {
						required: true,
					},
				'trToZoneList': {
						required: true,
					},
				'trTobranch': {
						required: true,
					},
				'ReleaseDate': 	{
					required: true,
     				},
				'ReleaseRefNo': 	{
					required: true,
     				},
				'JoinDate': 	{
					required: true,
     				},
				'JoinRefNo': 	{
					required: true,
     				},
				'DesignationTransfer': {
						required: true,
						minlength: 1,
					},
			
		
        },
		
        messages: {
            'trFromLoc': {
                required: 'Mandatory field.',
            },
			'trFromZoneList': {
                required: 'Mandatory field.',
            },
			'trFrombranch': {
                required: 'Mandatory field.',
            },
			'trToLoc': {
                required: 'Mandatory field.',
            },
			'trToZoneList': {
                required: 'Mandatory field.',
            },
			'trTobranch': {
                required: 'Mandatory field.',
            },
			'ReleaseDate': {
                required: 'Mandatory field.',
            },
			'ReleaseRefNo': {
                required: 'Mandatory field.',
            },
			'JoinDate': {
                required: 'Mandatory field.',
            },
			'JoinRefNo': {
                required: 'Mandatory field.',
            },
			'DesignationTransfer': {
                required: 'Mandatory field.',
            },
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	/////////Spouse
	
	  
    $('#spouse').validate({
        rules: {
				'SpouseName': {
						required: true,
					},
				'SpouseFather': {
						required: true,
					},
				'SpouseMother': 	{
					required: true,
     				},
				'Spousedob': 	{
					required: true,
     				},
				'SpouseNID': 	{
					required: true,
     				},
				'SpouseContact': 	{
					required: true,
     				},
				'SpouseAddress': 	{
					required: true,
     				},
				'SpouseDesignation': 	{
					required: true,
     				},
			
		
        },
		
        messages: {
            'SpouseName': {
                required: 'Mandatory field.',
            },
			'SpouseFather': {
                required: 'Mandatory field.',
            },
			'SpouseMother': {
                required: 'Mandatory field.',
            },
			'Spousedob': {
                required: 'Mandatory field.',
            },
			'SpouseNID': {
                required: 'Mandatory field.',
            },
			'SpouseContact': {
                required: 'Mandatory field.',
            },
			'SpouseAddress': {
                required: 'Mandatory field.',
            },
			'SpouseDesignation': {
                required: 'Mandatory field.',
            },
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	
	
	/////////Children
	
	  
    $('#children').validate({
        rules: {
				'ChildName': {
						required: true,
						minlength: 3,
					},
				'ChildNationality': {
						required: true,
						minlength: 2,
					},
				'ChildDoB': 	{
					required: true,
     				},
			
		
        },
		
        messages: {
            'ChildName': {
                required: 'Mandatory field.',
            },
			'ChildNationality': {
                required: 'Mandatory field.',
            },
			'ChildDoB': {
                required: 'Mandatory field.',
            },
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	/////////Training
	
	  
    $('#trainingPerson').validate({
        rules: {
				'title': {
						required: true,
						
					},
				'StartDate': {
						required: true,
					},
				'EndDate': {
						required: true,
					},
				'Duration': 	{
					required: true,
     				},
				'Evaluation': {
						required: true,
						minlength: 1,
					},
				'PlaceTrain': {
						required: true,
						minlength: 1,
					},
			
		
        },
		
        messages: {
            'title': {
                required: 'Mandatory field.',
            },
			'StartDate': {
                required: 'Mandatory field.',
            },
			'EndDate': {
                required: 'Mandatory field.',
            },
			'Duration': {
                required: 'Mandatory field.',
            },
			'Evaluation': {
                required: 'Mandatory field.',
            },
			'PlaceTrain': {
                required: 'Mandatory field.',
            },
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	//Education
	
	$('#education').validate({
        rules: {
				
				'BoardUniName': {
						required: true,
						minlength: 2,
					},
				'DurationEdu': {
						required: true,
						number: true,
						
					},
				'InsName': 	{
						required: true,
     				},
				'SessionEdu': {
						required: true,
						minlength: 1,
					},
				'ResultEdu': {
						required: true,
						minlength: 1,
						
					},
			
			
		
        },
		
        messages: {
			'BoardUniName': {
                required: 'Mandatory field.',
            },
			'DurationEdu': {
                required: 'Mandatory field.',
            },
			'InsName': {
                required: 'Mandatory field.',
            },
			'SessionEdu': {
                required: 'Mandatory field.',
            },
			'ResultEdu': {
                required: 'Mandatory field.',
            },
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	//Personal Info
	
	$('#personalInfo').validate({
        rules: {
				'nameEng': {
						required: true,
						minlength: 3,
					},
				'nameBng': {
						required: true,
						minlength: 3,
					},
				'FatherName': 	{
					required: true,
     				},
				'MotherName': 	{
						required: true,
						},
				'BirthDate': 	{
						required: true,
						},
				
				'bpdistricts': 	{
						required: true,
						},
				
				'gender': 	{
						required: true,
						},
				
				'BloodGroup': 	{
						required: true,
						},
				
				'NIDCardNo': 	{
						required: true,
						},
				
				'HomeDistrict': 	{
						required: true,
						},
				
				'PersonalMobile': 	{
						required: true,
						},
				
				'EmergencyContactNo': 	{
						required: true,
						},
				'PersonalEmailAddress': 	{
						required: true,
						},
						
				'PrPostOffice': 	{
						required: true,
						},
				
				'Div': 	{
						required: true,
						},
				
				'Distict': 	{
						required: true,
						},
				
				'prps': 	{
						required: true,
						},
				
				'PrPo': 	{
						required: true,
						},
						
				'PerPostOffice': 	{
						required: true,
						},
				
				'PerDiv': 	{
						required: true,
						},
				
				'PerDistict': 	{
						required: true,
						},
				
				'perps': 	{
						required: true,
						},
				
				'PerPO': 	{
						required: true,
						},
			
			
			

        },
		
        messages: {
            'nameEng': {
                required: 'Mandatory field.',
            },
			'nameBng': {
                required: 'Mandatory field.',
            },
			'FatherName': {
                required: 'Mandatory field.',
            },
			'MotherName': {
                required: 'Mandatory field.',
            },
			'BirthDate': {
                required: 'Mandatory field.',
            },
			'bpdistricts': {
                required: 'Mandatory field.',
            },
			'gender': {
                required: 'Mandatory field.',
            },
			'BloodGroup': {
                required: 'Mandatory field.',
            },
			'NIDCardNo': {
                required: 'Mandatory field.',
            },
			'HomeDistrict': {
                required: 'Mandatory field.',
            },
			'PersonalMobile': {
                required: 'Mandatory field.',
            },
			'EmergencyContactNo': {
                required: 'Mandatory field.',
            },
			'PersonalEmailAddress': {
                required: 'Mandatory field.',
            },
			'PrRoad': {
                required: 'Mandatory field.',
            },
			'PrPostOffice': {
                required: 'Mandatory field.',
            },
			'Div': {
                required: 'Mandatory field.',
            },
			'Distict': {
                required: 'Mandatory field.',
            },
			'prps': {
                required: 'Mandatory field.',
            },
			'PrPO': {
                required: 'Mandatory field.',
            },
			'PerRoad': {
                required: 'Mandatory field.',
            },
			'PerPostOffice': {
                required: 'Mandatory field.',
            },
			'PerDiv': {
                required: 'Mandatory field.',
            },
			'PerDistict': {
                required: 'Mandatory field.',
            },
			'perps': {
                required: 'Mandatory field.',
            },
			'PerPO': {
                required: 'Mandatory field.',
            },
		
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	
	//Professional Info
	$('#professionalInfo').validate({
        rules: {
				'prFileNO': {
						required: true,
					},
				'Desi': {
						required: true,
					},
				'date_joinbank': 	{
					required: true,
     				},
				'OfficeLoc': 	{
					required: true,
     				},
				'ZoneList': 	{
					required: true,
     				},
				'branch': 	{
					required: true,
     				},
				'joiningscale': 	{
						required: true,
						},
				'date_present': 	{
						required: true,
						},
				
				'date_prlstart': 	{
						required: true,
						},
				
				'date_retirement': 	{
						required: true,
						},
				
				'status_employee': 	{
						required: true,
						},
				'official_desig': 	{
						required: true,
						},
				
				'status_employment': 	{
						required: true,
						},
				
				'pftype': 	{
						required: true,
						},
				
				'policeverification': 	{
						required: true,
						},
				
				'scale_present': 	{
						required: true,
						},
				
				'basicpay': 	{
						required: true,
						},
				
				'SalaryAccountNo': 	{
						required: true,
						},
				
				'pf_gpf': 	{
						required: true,
						},
				
				'pf_rate': 	{
						required: true,
						},
				
				'FreedomFighterSelf': 	{
						required: true,
						},
				
				
				'QuotaAvailed': 	{
						required: true,
						},
				
				
				
				
				

        },
		
        messages: {
            'prFileNO': {
                required: 'Mandatory field.',
            },
			'Desi': {
                required: 'Mandatory field.',
            },
			'date_joinbank': {
                required: 'Mandatory field.',
            },
			'Desi_join': {
                required: 'Mandatory field.',
            },
			'joiningscale': {
                required: 'Mandatory field.',
            },
			'date_present': {
                required: 'Mandatory field.',
            },
			'OfficeLoc': {
                required: 'Mandatory field.',
            },
			'ZoneList': {
                required: 'Mandatory field.',
            },
			'branch': {
                required: 'Mandatory field.',
            },
			'date_prlstart': {
                required: 'Mandatory field.',
            },
			'date_retirement': {
                required: 'Mandatory field.',
            },
			'status_employee': {
                required: 'Mandatory field.',
            },
			'official_desig': {
                required: 'Mandatory field.',
            },
			'status_employment': {
                required: 'Mandatory field.',
            },
			'pftype': {
                required: 'Mandatory field.',
            },
			'policeverification': {
                required: 'Mandatory field.',
            },
			'scale_present': {
                required: 'Mandatory field.',
            },
			'basicpay': {
                required: 'Mandatory field.',
            },
			'SalaryAccountNo': {
                required: 'Mandatory field.',
            },
			'pf_gpf': {
                required: 'Mandatory field.',
            },
			'pf_rate': {
                required: 'Mandatory field.',
            },
			'FreedomFighterSelf': {
                required: 'Mandatory field.',
            },
			'QuotaAvailed': {
                required: 'Mandatory field.',
            },
						
        },
		
        errorClass: 'errortxt',
        errorPlacement: function (err, element) {
            err.insertAfter(element);
        },


    });
	
	
	
});
	
