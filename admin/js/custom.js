
	$("html").on("input",function(){
		var initialPassword = $("#passwordFirst").val();
		var finalPassword = $("#passwordSecond").val();
		var firstlength = initialPassword.length;
		var secondlength = finalPassword.length;
	
	if(initialPassword != finalPassword){
		$("#sajid").text("Password Does Not Match");
		$("#sajid").css("color","red");
	}
	if(initialPassword == "" && finalPassword == ""){
		$("#sajid").text("Enter Both Password Feild");
		$("#sajid").css("color","red");
	}
	if(initialPassword == finalPassword && initialPassword.length > 0 && finalPassword.length > 0 && firstlength == secondlength){
		$("#sajid").text("Password  Match");
		$("#sajid").css("color","green");
	}
		
	});


	
	$("html").on("input",function(){
		var initialPassword = $("#newpassword").val();
		var finalPassword = $("#confirmpassword").val();
		var firstlength = initialPassword.length;
		var secondlength = finalPassword.length;
	
	if(initialPassword != finalPassword){
		$("#sajidtwo").text("Password Does Not Match");
		$("#sajidtwo").css("color","red");
	}
	if(initialPassword == "" && finalPassword == ""){
		$("#sajidtwo").text("Enter Both Password Feild");
		$("#sajidtwo").css("color","red");
	}
	if(initialPassword == finalPassword && initialPassword.length > 0 && finalPassword.length > 0 && firstlength == secondlength){
		$("#sajidtwo").text("Password  Match");
		$("#sajidtwo").css("color","green");
	}
		
	});

	// $(document).ready(function(){
	// 	$("#sidebarToggle").click(function(){
	// 		$(".bbtt").css("width","83px");
	// 		$(".bbtt").css("margin-left","-87px");
	// 		$(".bbtt").css("position","relative");
	// 	});
		
	// 	$("#sidebarToggle").dblclick(function(){
	// 		$(".bbtt").css("width","149px");
	// 		$(".bbtt").css("margin-left","4px");
	// 		$(".bbtt").css("position","relative");
	// 	});
	// });


	
	  
	 