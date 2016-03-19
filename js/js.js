$(document).ready(function() 
{
	//Initialisation of the Bootstrap popover feature I used in postcode input object
	$('[data-toggle="popover"]').popover();
	
	//Ajax to load country into select form
	$.ajax({
	url:"php_ajax/getcountry.php",
	type: "GET",
	dataType:"json",
	success:function( json ){
			var countryselect = showObjectjQuery(json);
			$("#country").html(countryselect);
		}
	});
	
	//Post code validator
	/*$("#checkpostcode").on("click",function(){
	var tryyu = checkPostCode();	
		if(checkPostCode() == false)
		{
			$("#postcodeerror1").removeClass("hide");
		}
		else
		{
			$("#postcode").addClass("valid");
			$("#postcodeerror").addClass("hide");
			var postcode = $("#postcode").val();
			var outcode = postcode.split(" ")[0];
			
			var otherOutcode = ["AF1","EM1","US1","OT1"];
			
			var otherOutcodeResult = otherOutcode.some(function(item, index, array){
				return outcode === item;				
				});
				
			if(otherOutcodeResult){alert("non UK postcode");}	
			alert (outcode);
			/*$.ajax({
				url:"../php_ajax/getSupCoor.php",
				type:"POST",
				data:{postcode:outcode},
				dataType:"",
				success: function(){
					
					}
				});
		}
	});*/
	
	//JS code for the ideal-postcodes api
	$('#lookup_field').setupPostcodeLookup({
		  api_key: 'ak_ilmmvxk9PTsqzchJdhRVOvGU9IEnP',
		  output_fields: {
			//line_1: '#first_line',  
			county: '#county',
			postcode: "#postcode",
			post_town: '#post_town',
		  },
		  input_class: "",
		  button_class: "btn btn-primary btn-md",
		  dropdown_class: "form-control",
		  /*onLookupTriggered: function()
		  {
			  
		  },*/
		  onAddressSelected: function(address)
		  {
			  var addressLines = [];
			  if (address.line_1.length > 0) {
				  addressLines.push(address.line_1)
			  }
			  if (address.line_2.length > 0) {
				  addressLines.push(address.line_2)
			  }
			  if (address.line_3.length > 0) {
				  addressLines.push(address.line_3)
			  }
			  $("#first_line").val(addressLines.join(", "));
		  },
		  onSearchCompleted: function(data)
		  {
			  var postcode = $("#idpc_input").val();
			  var outcode = postcode.split(" ")[0];
			  var otherOutcode = ["AF1","EM1","US1","OT1"];
			  var otherOutcodeResult = otherOutcode.some(function(item, index, array){
				  return outcode.toUpperCase() === item.toUpperCase();				
				});
			  
			  if(data.code===4040)
			  {
				  alert(otherOutcodeResult);
				  alert(outcode);
				  if(otherOutcodeResult)
				  {
					 //check db for zonal & area superss
					 $("#postcode").addClass("valid");
					 $("#postcode").val(postcode.toUpperCase());
					 $.ajax({
						url:"php_ajax/getAreaZone.php",
						type:"GET",
						data:{postcode:outcode},
						dataType:"",
						success: function(data){
							//returns the format {"zone":"??","zonal_coor":"??","area":"??","area_sup":"??"}
							//alert(data);
							//console.log(data);
							
							var obj = jQuery.parseJSON(data);
							var zone = [];
							zone[0] = obj.zone;
							zone[1] = obj.zonal_coor;
							var area = [];
							area[0] = obj.area;
							area[1] = obj.area_sup;
							
							$('#zonal_coordinator').append(new Option(zone[1],zone[0]));
							$('#area_supervisor').append(new Option(area[1],area[0]));
							}
						}); 
				  }
				  
			  }
			  else if(data.code===2000)
			  {
				  //get the area and zonal guys
				  $("#postcode").addClass("valid");
				  $.ajax({
						url:"php_ajax/getAreaZone.php",
						type:"GET",
						data:{postcode:outcode},
						dataType:"",
						success: function(data){
							//returns the format {"zone":"??","zonal_coor":"??","area":"??","area_sup":"??"}
							//alert(data);
							
							var obj = jQuery.parseJSON(data);
							var zone = [];
							zone[0] = obj.zone;
							zone[1] = obj.zonal_coor;
							var area = [];
							area[0] = obj.area;
							area[1] = obj.area_sup;
							
							$('#zonal_coordinator').append(new Option(zone[1],zone[0]));
							$('#area_supervisor').append(new Option(area[1],area[0]));
							}
						});
				  
			  }
			  
		  }
		  	  
		});
	
	//for submit button
	$("#submit").on("click",function(event){
		var errorValue = 0;
		$(".required").each(function(){
			if($(this).val().length === 0)
			{
			  errorValue++;
			}	
		});
		
		if(!($("#postcode").hasClass("valid")))
		{
			errorValue++;
			$("#postcodeerror3").removeClass("hide");
		}else if($("#postcode").hasClass("valid")){errorValue--;$("#postcodeerror3").addClass("hide");}
		
		
		if(errorValue>0)
		{
			event.preventDefault();
			$("#alert").removeClass("hidden");
		}
		else
		{
			//event.preventDefault();
		  	alert("All clear");
			//alert(JSON.stringify($("#form").serializeArray()));
            alert($("#form").serialize());
            console.log($("#form").serialize());
		   $.ajax({
				 url:"data_process.php",
				 type:"POST",
				 data:$("#form").serialize(),
				 dataType:"",
				 success: function(data){
					   if(data == true)
					   {
							   alert("Inserted sucessfully");
					   }
					   else if(data == false)
					   {
							   alert("not Inserted sucessfully");
					   }
			   		}
				 });

		}
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

function getZoneArea(outcode)
{
	
}

function getArea()
{
	
}
