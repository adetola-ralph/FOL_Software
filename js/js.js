$(document).ready(function() 
{	
	//Ajax to load country into select form
	$.ajax({
	url:"../php_ajax/getcountry.php",
	type: "GET",
	dataType:"json",
	success:function( json ){
			var countryselect = showObjectjQuery(json);
			$("#country").html(countryselect);
		}
	});
	
	//Post code validator
	$("#checkpostcode").on("click",function(){
	var tryyu = checkPostCode();	
		if(checkPostCode() == false)
		{
			$("#postcodeerror").removeClass("hide");
		}
		else
		{
			$("#postcodeerror").addClass("hide");
			var postcode = $("#postcode").val();
			var outcode = postcode.split(" ")[0];
			alert (outcode);
			/*$.ajax({
				url:"../php_ajax/getSupCoor.php",
				type:"POST",
				data:{postcode:outcode},
				dataType:"",
				success: function(){
					
					}
				});*/
		}
	});
	
	$("#submit").on("click",function(){
		
	});
	
});

//ajax code that gets the addresses from postcode and inserts them into the address bar*
//js code to allow for others in the title box*
//js code to see if the required fields are filled**
//js code that catches submit and uses all above functions for validation

/*
*function to check if postcode is valid
*/
function checkPostCode()
{
	var postcode = $("#postcode").val();
	var regPostcode = /^([a-zA-Z]){1}([0-9][0-9]|[0-9]|[0-9][a-zA-Z]|[a-zA-Z][0-9][a-zA-Z]|[a-zA-Z][0-9][0-9]|[a-zA-Z][0-9]){1}([ ])([0-9][a-zA-z][a-zA-z]){1}$/;
	
	if(regPostcode.test(postcode) == false)
	{
		//$("#postcodeerror").removeClass("hide");
		return false;
	}
	else
	{
		//$("#postcodeerror").addClass("hide");
		return true;
	}
}

/**
*function that converts json into options to be loaded into the select input form
*/
function showObjectjQuery(obj) {
  var result = "";
  $.each(obj, function(k, v) {  
    result += "<option value=\""+v.country_code + "\">" + v.country_name + "</option>";
  });
  return result;
}