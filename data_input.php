<?php include_once("layout/header.php");?>
      <div>
      		<form method="post" action="data_process.php">
            	<fieldset>
                	<legend>Personal Details</legend>
                    <label for="title">Title:</label>
                    <select name="title">
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
                    <label for="firstname">FirstName:</label>
                    <input type="text" name="firstname" required/>
                    <label for="lastname">LastName:</label>
                    <input type="text" name="lastname" required/>
                    <label for="agerange">Age Range:</label>
                    <select name="agerange" required>
                    	<!--dynamically load a file cotaining the age ranges-->
                        <option value="16-18">16 to 18</option>
                    </select>
                </fieldset>
                
                <fieldset>
                	<legend>Contact Details</legend>
                    <label for="homeTelNum">Home Telephone:</label>
                    <input type="tel" name="homeTelNum" />
                    <label for="officeTelNum">Office Telephone:</label>
                    <input type="tel" name="officeTelNum" />
                    <label for="mobileTelNum">Mobile Telephone:</label>
                    <input type="tel" name="mobileTelNum" />
                    <label for="email">Email Address:</label>
                    <input type="email" name="email" />
                </fieldset>
                
                <fieldset>
                	<legend>Address Details</legend>
                    <label for="address">Address</label>
                    <input name="address" type="text" required />
                    <label for="county">County:</label>
                    <input type="text" name="county" required/>
                    <label for="city">City:</label>
                    <input type="text" name="city" required/>
                    <label for="country">Country:</label>
                    <input type="text" name="country" required/> //change this a dynamically loaded select form
                    <label for="postcode">Postcode:</label>
                    <input type="text" name="postcode" required/>
                </fieldset>
                <fieldset>
                	<legend> ???</legend>
                    <label for="altarCallResponse">Response To Altar Call</label>
                    <input type="radio" name="altarCallResponse" value="newconvert" required/> New Convert
                    <input type="radio" name="altarCallResponse" value="rededication" required/> Rededication
                    <label for="prayerPoint">Prayer Points</label>
                    <textarea name="prayerPoints" required></textarea>
                </fieldset>
                <input type="date" name="regDate" value="<?php echo date("Y-m-d"); ?>" />
                <input type="submit" name="submit"/>
            </form>
      </div>
<?php include_once("layout/footer.php");?>