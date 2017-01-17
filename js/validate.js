$(function() {


$("#register-form").validate({
	
    rules: {
    login: "required",
	qst: "required",
	asw: "required",
	password: 
	{
		required: true,
		minlength : 6
    },
    password_repeat: 
	{
		required: true,
        minlength : 6,
        equalTo : "#pass"
    },
    mail: {
    required: true,
    email: true
	}
  
           
},
        
      
        messages: {
        login:  "Wprowadź login.",
		qst:  "Wprowadź pytanie.",
		asw:  "Wprowadź odpowiedź.",
		password : 
		{
			required: "Wprowadź hasło.",
			minlength : "Hasło musi się składać z przynajmniej 6-u znaków."
		},
		password_repeat : 
		{
			required: "Wprowadź potwierdzenie hasła.",
			minlength : "Hasło musi się składać z przynajmniej 6-u znaków.",
			equalTo : "Hasła muszą się zgadzać."
		},
		mail: 
		{
		required: "Wprowadź mail.",
		email: "Wprowadzone dane nie są adresem mailowym."
		}
           
        },
     

	  
      submitHandler: function(form) {
		
      if($("#register-form").valid()) { 
		  
	  form.submit();
      } 
	  },
	  });
	  
	$("#addcon").validate({
	
    rules: {
    conName: "required",
	conSurname: "required",
	conPhone: {
	required: true,
	minlength:9,
	maxlength: 12
	},
	conAd: "required",
	conCit: "required"
	},
        
      
        messages: {
        conName:  "Wprowadź imię.",
		conSurname:  "Wprowadź nazwisko.",
		conPhone: {
		required: "Wprowadź numer.",
		minlength: "Za krótki numer",
		maxlength: "Za długi numer"
		},
		conAd: "Wprowadź adres.",
		conCit: "Wprowadź miejscowość."
           
        },
     

	  
      submitHandler: function(form) {
		
      if($("#addcon").valid()) { 
		  
	  form.submit();
      } 
	  },
	  });

});