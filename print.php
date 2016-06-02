<?php
	include_once("php_class/auth.php");
	$page_title = "Print CSV Page";
	include_once("layout/header.php");
?>

<div class="row">
	<form method="post" role="form" class="form-horizontal" id="printForm" action="printCsv.php">
        <div class="col-md-6 col-md-offset-3">
        	<div class="form-group">
            	<label for="select_date" class="control-label col-sm-3">
                	Select Date:
                </label>
                <div class="col-sm-9">
                	<select name="select_date" id="select_date" class="form-control">
                        <!--dynamically loaded select form-->
                        <option value="0">Select Date</option>
                    </select>
                </div>
            </div>
            <div style="padding:30px 0 0 30px;">
            	<input type="submit" id="dateSubmit" name="dateSubmit" class="btn btn-success btn-lg">
            </div>
        </div>
    </form>
</div>

<?php include_once("layout/footer.php");?>
