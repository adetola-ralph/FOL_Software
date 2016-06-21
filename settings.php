<?php
	include_once("php_class/auth.php");
	$page_title = "Application Setting";
	include_once("layout/header.php");

    $role = $_SESSION["role"];
    if($role === "normal") {
        header("LOCATION:index.php");
    }
?>

<div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <form role="form" class="form-horizontal" id="form" method="post">
                <fieldset>
                    <legend>Add New User</legend>
                </fieldset>

                <div class="form-group">
                    <label for="title" class="control-label col-sm-2">Title:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label col-sm-2">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password_field" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group"> 
                    <label for="confirmPassword" class="control-label col-sm-2">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="confirm_password_field" placeholder="Confirm Password" name="confirmPassword">
                    </div>
                </div>
                <input type="submit" id="addUser" name="addUser" class="btn btn-primary btn-lg"> 
            </form>
        </div>
        <div class="col-xs-12 col-md-6">
            <form role="form" class="form-horizontal" id="form" method="post">
                <fieldset>
                    <legend>Lock non admin accounts</legend>
                    <table class="table table-condensed table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <i class="fa fa-lock" aria-hidden="true"> locked<?php //echo($locked)?>
                                    <i class="fa fa-unlock" aria-hidden="true"> unlocked<?php //echo($locked)?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
                <input type="submit" id="unlockAccount" name="unlockAccount" value="Lock Accounts" class="btn btn-warning btn-lg">
                <input type="submit" id="lockAccount" name="lockAccount" value="Unlock Accounts" class="btn btn-primary btn-lg">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <form role="form" class="form-horizontal" id="form" method="post">
                <fieldset>
                    <legend>#</legend>
                </fieldset>
            </form>
        </div>
        <div class="col-xs-12 col-md-6">
            <form role="form" class="form-horizontal" id="form" method="post">
                <fieldset>
                    <legend>#</legend>
                </fieldset>
            </form>
        </div>
    </div>
</div>