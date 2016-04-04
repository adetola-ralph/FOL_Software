<?php
	$page_title = "Welcome!!!"; 
	include_once("layout/header.php");
?>
    <div class="row">
    	<div class="col-sm-4">
        	<div class="row">
            	<div class="col-sm-4">
        		</div>
                <div class="col-sm-4">
                    <a href="data_input.php" class="btn btn-lg btn-success" role="button">
                        <img src="images/add-contact.png" width="100" height="100" class="img-responsive img-thumbnail"/>
                        <p class="align-center">Add new Convert</p>
                    </a>
                </div>
                <div class="col-sm-4">
                </div>
        	</div>
        </div>
        <div class="col-sm-4">
        	<div class="row">
            	<div class="col-sm-4">
        		</div>
                <div class="col-sm-4">
                	<a href="print.php" class="btn btn-lg btn-success" role="button">
                		<img src="images/printer.png" width="100" height="100" class="img-responsive img-thumbnail" />
                        <p class="align-center">Print Converts in CSV file</p>
                    </a>
                </div>
                <div class="col-sm-4">
                </div>
        	</div>
        </div>
        <div class="col-sm-4">
        	<div class="row">
            	<div class="col-sm-4">
        		</div>
                <div class="col-sm-4">
                	<a href="#" class="btn btn-lg btn-success" role="button">
                        <img src="images/statistics.png" width="100" height="100" class="img-responsive img-thumbnail"/>
                        <p class="align-center">See statistics</p>
                    </a>
                </div>
                <div class="col-sm-4">
                </div>
        	</div>
        </div>    	    
    </div>
<?php include_once("layout/footer.php");?>
