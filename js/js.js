$(document).ready(function() 
{
	//Initialisation of the Bootstrap popover feature I used in postcode input object
	$('[data-toggle="popover"]').popover();
	
	//Ajax to load country into select form
	$.ajax({
		url:"../php_ajax/getcountry.php",
		type: "GET",
		dataType:"json",
		success:function( json ){
			var countryselect = showCountryjQuery(json);
			$("#country").html(countryselect);
		}
	});
	
	//Ajax to load dates in the database based on the events
	$.ajax({
		url:"../php_ajax/getDate.php",
		type:"GET",
		dataType:"json",
		success:function(json){
			for(var i=0;i<json.length;i++)
			{
				//var dateObj = jQuery.parseJSON(json[i]); //{"year":"xxxx","month":"xx"}
				var _month = json[i].month;
				var _year = json[i].year;
				
				$("#select_date").append(new Option(_year+"/"+_month,_year+"/"+_month));
			}
		}
		});
		
		//print.php submit button
		$("#dateSubmit").on("click", function(event){
				//event.preventDefault();
				if($("#select_date").val() == "0")
				{
					event.preventDefault();
					alert("Please select a date");
					$("#select_date").parents(".form-group").addClass("has-error");
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
		  api_key: 'ak_im3pb5hjhDTXfskNUnoIgl74BWZOx',
		  output_fields: {
			//line_1: '#first_line',  
			county: '#county',
			postcode: "#postcode",
			post_town: '#post_town',
		  },
		  /*input_class: "",
		  button_class: "btn btn-primary btn-md",*/
          button: '#customButton',
          input: '#customInput',
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
			  var postcode = $("#customInput").val();
			  var outcode = postcode.split(" ")[0];
			  var otherOutcode = ["AF1","EM1","US1","OT1"];
			  var otherOutcodeResult = otherOutcode.some(function(item, index, array){
				  return outcode.toUpperCase() === item.toUpperCase();				
				});
			  
			  if(data.code===4040)
			  {
				  //alert(otherOutcodeResult);
				  //alert(outcode);
				  if(otherOutcodeResult)
				  {
					 //check db for zonal & area couns
					 $("#postcode").addClass("valid");
					 $.ajax({
						url:"../php_ajax/getAreaZone.php",
						type:"GET",
						data:{postcode:outcode},
						dataType:"",
						success: function(data){
							//returns the format {"zone":"??","zonal_coor":"??","area":"??","area_coun":"??"}
							//alert(data);
							//console.log(data);
							
							var obj = jQuery.parseJSON(data);
							var zone = [];
							zone[0] = obj.zone;
							zone[1] = obj.zonal_coor;
							var area = [];
							area[0] = obj.area;
							area[1] = obj.area_coun;
							
							$('#zonal_coordinator').append(new Option(zone[1],zone[0]));
							$('#area_counsellor').append(new Option(area[1],area[0]));
							}
						}); 
				  }
				  
			  }
			  else if(data.code===2000)
			  {
				  //get the area and zonal guys
				  $("#postcode").addClass("valid");
				  $.ajax({
						url:"../php_ajax/getAreaZone.php",
						type:"GET",
						data:{postcode:outcode},
						dataType:"",
						success: function(data){
							//returns the format {"zone":"??","zonal_coor":"??","area":"??","area_coun":"??"}
							//alert(data);
							
							var obj = jQuery.parseJSON(data);
							var zone = [];
							zone[0] = obj.zone;
							zone[1] = obj.zonal_coor;
							var area = [];
							area[0] = obj.area;
							area[1] = obj.area_coun;
							
							$('#zonal_coordinator').append(new Option(zone[1],zone[0]));
							$('#area_counsellor').append(new Option(area[1],area[0]));
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
			  $(this).parents(".form-group").addClass("has-error");
			}
			else
			{
				
				if(($(this).parents(".form-group").hasClass("has-error")) && $(this).val().length !== 0 )
				{
					$(this).parents(".form-group").removeClass("has-error");
				}
			}
		});
		
		if(!($("#postcode").hasClass("valid")))
		{
			errorValue++;
			$("#postcodeerror3").removeClass("hide");
		}else if($("#postcode").hasClass("valid")){errorValue--;$("#postcodeerror3").addClass("hide");}
		
		//alert(errorValue);
		if(errorValue>0)
		{
			event.preventDefault();
			$("#alert").removeClass("hidden");
		}
		else
		{
			//event.preventDefault();
		  	//alert("All clear");
			//alert(JSON.stringify($("#form").serializeArray()));
            //alert($("#form").serialize());
            console.log($("#form").serialize());
		   $.ajax({
				 url:"../data_process.php",
				 type:"POST",
				 data:$("#form").serialize(),
				 dataType:"",
				 success: function(data){
					   // alert(data);
					   if(data == true)
					   {
							   alert("Inserted sucessfully");
					   }
					   else
					   {
							   alert("not Inserted sucessfully");
					   }
			   		}
				 });

		}
	});
	
	//Modernizr test for svg image support
	if (!Modernizr.svg) {
	  $(".navbar-brand img").attr("src", "../images/logo.png");
	}
	
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
function showCountryjQuery(obj) {
  var result = "";
  $.each(obj, function(k, v) {  
    result += "<option value=\""+v.country_code + "\">" + v.country_name + "</option>";
  });
  return result;
}