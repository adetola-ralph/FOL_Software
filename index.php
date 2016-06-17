<?php
	include_once("php_class/auth.php");
	$page_title = "Welcome!!!";
	include_once("layout/header.php");
    //echo($_SESSION["role"]);

    $role =  $_SESSION["role"]; //admin or normal
    // $locked = $_SESSION["locked"];
    // echo($locked);
?>
    <div class="row">
    	<div class="col-md-3">
        	<div class="row" style="padding-bottom:10px;">
            	<div class="col-xs-4">
        		</div>
                <div class="col-xs-4">
                    <a href="data_input.php" class="btn btn-lg btn-success" role="button" >
                        <!--<img src="images/add-contact.png" width="100" height="100" class="img-responsive img-thumbnail"/>-->
                        <i class="glyphicon glyphicon-user gi-5x" aria-hidden="true"></i>
                        <p class="align-center">Add new Convert</p>
                    </a>

                </div>
                <div class="col-xs-4">
                </div>
        	</div>
        </div>
        <?php /*shows or hides content based on the users roles*/if($role === 'admin'){echo('<div class="col-md-3">
        	<div class="row" style="padding-bottom:10px;">
            	<div class="col-xs-4">
        		</div>
                <div class="col-xs-4">
                	<a href="print.php" class="btn btn-lg btn-success" role="button">
                		<!--<img src="images/add-contact.png" width="100" height="100" class="img-responsive img-thumbnail"/>-->
                        <i class="glyphicon glyphicon-print gi-5x" aria-hidden="true"></i>
                        <p class="align-center">Print CSV file</p>
                    </a>
                </div>
                <div class="col-xs-4">
                </div>
        	</div>
        </div>
        <div class="col-md-3">
        	<div class="row" style="padding-bottom:10px;">
            	<div class="col-xs-4">
        		</div>
                <div class="col-xs-4">
                	<a href="#" class="btn btn-lg btn-success" role="button" disabled="disabled">
                        <!--<img src="images/add-contact.png" width="100" height="100" class="img-responsive img-thumbnail"/>-->
                        <i class="glyphicon glyphicon-stats gi-5x" aria-hidden="true"></i>
                        <p class="align-center">See statistics</p>
                    </a>
               </div>
                <div class="col-xs-4">
                </div>
        	</div>
        </div>
        <div class="col-md-3">
        	<div class="row" style="padding-bottom:10px;">
            	<div class="col-xs-4">
        		</div>
                <div class="col-xs-4">
                	<a href="#" class="btn btn-lg btn-success" role="button" disabled="disabled">
                        <!--<img src="images/add-contact.png" width="100" height="100" class="img-responsive img-thumbnail"/>-->
                        <i class="glyphicon glyphicon-cog gi-5x" aria-hidden="true"></i>
                        <p class="align-center">Settings</p>
                    </a>
               </div>
                <div class="col-xs-4">
                </div>
        	</div>
        </div>');}?>
    </div>
<?php include_once("layout/footer.php");?>