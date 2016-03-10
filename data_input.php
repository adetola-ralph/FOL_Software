<?php include_once("layout/header.php");?>
      <div>
      		<form method="post" role="form" class="form-horizontal" id="form" >
				<div class="row">
                    <div class="alert alert-warning hidden"  id="alert">
                    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    	You have 1 or more issues to be dealt with
                    </div>
                </div>            
                
            	<div class="row"><!--beginning of personal details-->
                	<div class="col-sm-6">
                        <fieldset>
                            <legend>Personal Details</legend>
                            
                            <div class="form-group">
                                <label for="title" class="control-label col-sm-2">Title:</label>
                                <div class="col-sm-10">
                                    <select name="title" class="form-control">
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Chief">Chief</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Alhaji">Alhaji</option>
                                        <option value="Alhaja">Alhaja</option>
                                        <option value="Pastor">Pastor</option>
                                        <option value="Prince">Prince</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group"> 
                                <label for="firstname" class="control-label col-sm-2">First Name:</label>
                                <div class="col-sm-10">
                                	<input type="text" name="firstname" required class="form-control required" placeholder="FirstName"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="lastname" class="control-label col-sm-2">Last Name:</label>
                                <div class="col-sm-10">
                                	<input type="text" name="lastname" required class="form-control required" placeholder="Lastname"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="agerange" class="control-label col-sm-2">Age Range:</label>
                                <div class="col-sm-10">
                                    <select name="agerange" required class="form-control">
                                        <option value="0-17">0 to 17</option>
                                        <option value="18-24">18 to 24</option>
                                        <option value="25-34">25 to 34</option>
                                        <option value="35-40">35 to 40</option>
                                        <option value="41-50">41 to 50</option>
                                        <option value="51-60">51 to 60</option>
                                        <option value="61+">61+</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                    </div><!--end of personal details-->
                    
                    <div class="col-sm-6"><!--beginning of contact details-->
                        <fieldset>
                        	
                            <legend>Contact Details</legend>
                            <div class="form-group">
                                <label for="homeTelNum" class="control-label col-sm-2">Home Num</label>
                                <div class="col-sm-10">
                                	<input type="tel" name="homeTelNum" class="form-control" placeholder="441234567890"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="officeTelNum" class="control-label col-sm-2">Office Num:</label>
                                <div class="col-sm-10">
                                	<input type="tel" name="officeTelNum"  class="form-control" placeholder="441234567890"/>
                                </div>
							</div>
                            
                            <div class="form-group">
                                <label for="mobileTelNum" class="control-label col-sm-2">Mobile Num:</label>
                                <div class="col-sm-10">
                                	<input type="tel" name="mobileTelNum"  class="form-control" placeholder="441234567890"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="control-label col-sm-2">Email:</label>
                                <div class="col-sm-10">
                                	<input type="email" name="email"  class="form-control" placeholder="name@email.com"/>
                                </div>
                            </div>
                        </fieldset>
                        </div>
                </div><!--end of contact details-->
                
                <div class="row"><!--beginning of Address Details-->
                	<div class="col-sm-6">
                        <fieldset>
                            <legend>Address Details</legend>
                            <div class="form-group">
                                <label for="postcode" class="control-label col-sm-2">Postcode:</label>
                                <div class="col-sm-6">
                                	<input type="text" id="postcode" name="postcode" required class="form-control required" maxlength="8" data-toggle="popover" title="Enter the following for non-UK postcodes" data-trigger="hover focus" data-placement="bottom" data-html="true" data-content="<p><strong>AF1 1CA</strong> for an African country</p>
                                    <p><strong>EM1 1EA</strong> for a European, Asian & Middle Eastern Country</p>
                                    <p><strong>US1</strong> for the country of USA</p>
                                    <p><strong>OT1</strong> for other countries</p>" placeholder="Please enter your postcode"/>
                                    
                                </div>
                                <div class="col-sm-4"><input type="button" id="checkpostcode" class="btn btn-primary btn-md" value="Check Postcode"></div>
                            </div>
                            <div class="form-group">
                            	<div class="col-sm-2">
                                </div>
                            	<span class="label label-warning hide col-sm-8" id="postcodeerror1">Invalid postcode, Wrong Format</span>
                                <span class="label label-warning hide col-sm-8" id="postcodeerror2">Postcode not found</span>
                                <span class="label label-warning hide col-sm-8" id="postcodeerror3">You haven't clicked on check postcode button</span>
                            </div>
                            
                            <div class="form-group" id="lookup_field">
                            	<!--<label for="selectaddress" class="control-label col-sm-2">Select an address:</label>
                                <div class="col-sm-10">
                                	<select id="selectaddress" class="form-control">
                                        dynamically loaded select form
                                    </select>
                                </div>-->
                            </div>
                            
                            <div class="form-group">
                                <label for="address" class="control-label col-sm-2">Address:</label>
                                <div class="col-sm-10">
                                	<input name="address" type="text" required  class="form-control required" id="first_line"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="county" class="control-label col-sm-2">County:</label>
                                <div class="col-sm-10">
                                	<input type="text" name="county" required class="form-control required" id="county"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="city" class="control-label col-sm-2">City:</label>
                                <div class="col-sm-10">
                                	<input type="text" name="city" required class="form-control required" id="post_town"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="country" class="control-label col-sm-2">Country:</label>
                                <div class="col-sm-10">
                                    <select name="country" id="country" class="form-control">
                                        <!--dynamically loaded select form-->
                                    </select> 
                                </div>
                            </div>
                            
                            <div class="form-group">
                            	<label for="zonal_coordinator" class="control-label col-sm-2">Zone</label>
                                <div class="col-sm-10">
                                	<select id="zonal_coordinator" name="zonal_coordinator" class="form-control">
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                            	<label for="area_supervisor" class="control-label col-sm-2">Area</label>
                                <div class="col-sm-10">
                                	<select id="area_supervisor" name="area_supervisor" class="form-control" >
                                    </select>
                                </div>
                            </div>
                        </fieldset>
                	</div><!--end of address details-->
                
                    <div class="col-sm-6"><!--beginning of ???-->
                        <fieldset>
                            <legend> ???</legend>
                            <div class="form-group">
                                <label for="altarCallResponse" class="control-label col-sm-2">Response</label>
                                <div class="col-sm-10">
                                    <label><input type="radio" name="altarCallResponse" value="newconvert" required/> New Convert</label>
                                    <label><input type="radio" name="altarCallResponse" value="rededication" required/> Rededication</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="prayerPoint" class="control-label col-sm-2">Prayer Points</label>
                                <div class="col-sm-10">
                                	<textarea name="prayerPoints" required class="form-control required" rows="5"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                            	<label for="regDate" class="control-label col-sm-2">Date</label>
                                <div class="col-sm-10">
                                	<input type="date" name="regDate" value="<?php echo date("Y-m-d"); ?>" class="form-control" readonly="readonly"/>
                                </div>
                            </div>
                        </fieldset>
                    </div><!--end of ???-->
                </div>
                
                <div class="row"><!--beginning of submit-->
                	<div class="col-sm-4">
                    </div>
                	<div class="col-sm-4">
                        <input type="submit" id="submit" name="submit" class="btn btn-primary btn-lg">
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div><!--end of submit-->
            </form>
      </div>
<?php include_once("layout/footer.php");?>