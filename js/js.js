$(document).ready(function() {
	/*
		1. load the country table into a dropdown box from mysql db
		2. load the age groups into the dropdown box from mysql db
		3. 
	*/
	
	$.ajax({
	url:"../php_ajax/getcountry.php",
	type: "GET",
	dataType:"json",
	success:function( json ){
			var countryselect = showObjectjQuery(json);
			$("#country").html(countryselect);
		}
		
	})
});

//ajax function that deals with correct postcode format
//ajax code that gets the addresses from postcode and inserts them into the address bar
//js code to allow for others in the title box
//js code to see if the required fields are filled
//js code that catches submit and uses all above functions for validation

function checkPostCode()
{
	
}

function showObjectjQuery(obj) {
  var result = "";
  $.each(obj, function(k, v) {  
    result += "<option value=\""+v.country_code + "\">" + v.country_name + "</option>";
  });
  alert(result);
  return result;
}