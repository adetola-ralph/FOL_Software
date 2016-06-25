<?php
	include_once("php_class/auth.php");
    include("/configs/db.php");
	$page_title = "Application Setting";
	include_once("layout/header.php");

    $role = $_SESSION["role"];
    if($role === "normal") {
        header("LOCATION:index.php");
    }

    $dbinfo = MyDatabase::getConnectionDetails();
    $host = $dbinfo["host"];
    $database = $dbinfo["database"];
    $db_username = $dbinfo["username"];
    $db_password = $dbinfo["password"];
    $db = new MyDatabase($host,$database,$db_username,$db_password);
?>

<div>
    <div class="row">
        <!--shows result of any operation carried on this page-->
        <div class="hidden alert" id="alert-message"><p class="text-center"><strong>Successful</strong></p></div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <form role="form" class="form-horizontal" id="addUser" method="post" action="<?php $_SERVER['PHP_SELF']?>">
                <fieldset>
                    <legend>Add New User</legend>
                </fieldset>

                <div class="form-group">
                    <label for="username" class="control-label col-sm-2">Username:</label>
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
                    <legend>Lock all non-admin accounts</legend>
                    <!--<table class="table table-condensed table-striped table-bordered">
                        <tbody>
                            <tr>
                                <td>Status</td>
                                <td>
                                    <i class="fa fa-lock" aria-hidden="true"> locked<?php //echo($locked)?>
                                    <i class="fa fa-unlock" aria-hidden="true"> unlocked<?php //echo($locked)?>
                                </td>
                            </tr>
                        </tbody>
                    </table>-->
                </fieldset>
                <input type="submit" id="lockAccount" name="lockAccount" value="Lock Accounts" class="btn btn-warning btn-lg">
                <input type="submit" id="unlockAccount" name="unlockAccount" value="Unlock Accounts" class="btn btn-primary btn-lg">
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

<?php
    if(isset($_POST["addUser"])) {
        // echo("something");
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $confirmPassword = trim($_POST["confirmPassword"]);

        if(strlen($username) == 0 || strlen($password) == 0 || strlen($confirmPassword) == 0)
        {
            echo('<script>'.
                '$("#alert-message").removeClass("hidden");'.
                '$("#alert-message").addClass("alert-danger");'.
                '$("#alert-message p strong").html("You have an empty field");'.
                'setTimeout(function() {$("#alert-message").addClass("hidden");$("#alert-message").removeClass("alert-danger");}, 5000);'.
                '</script>');
        } else if($password != $confirmPassword) {
            echo('<script>'.
                '$("#alert-message").removeClass("hidden");'.
                '$("#alert-message").addClass("alert-danger");'.
                '$("#alert-message p strong").html("Please type in the same password");'.
                'setTimeout(function() {$("#alert-message").addClass("hidden");$("#alert-message").removeClass("alert-danger");}, 5000);'.
                '</script>');
        } else {
            $conn = $db->get_connection();
            $returned_code = 00000;

            $enc_password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO authentication (username, password) VALUES (?,?)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam("1",$username);
            $stmt->bindParam("2",$enc_password);
            try {
                $stmt->execute();
            } catch(PDOException $e) {
                //echo($e->getCode());
                $returned_code = $e->getCode();
            }

            if($returned_code == 00000) {
                echo('<script>'.
                '$("#alert-message").removeClass("hidden");'.
                '$("#alert-message").addClass("alert-success");'.
                '$("#alert-message p strong").html("User successfully inserted");'.
                'setTimeout(function() {$("#alert-message").addClass("hidden");$("#alert-message").removeClass("alert-success");}, 5000);'.
                '</script>');
            } else if($returned_code == 23000) {
                echo('<script>'.
                '$("#alert-message").removeClass("hidden");'.
                '$("#alert-message").addClass("alert-danger");'.
                '$("#alert-message p strong").html("User already exists in the database");'.
                'setTimeout(function() {$("#alert-message").addClass("hidden");$("#alert-message").removeClass("alert-danger");}, 5000);'.
                '</script>');
            }
        }
    }

    if(isset($_POST["unlockAccount"])) {
        $conn1 = $db->get_connection();
        $query1 = "UPDATE authentication SET locked = ? WHERE role = ?";
        $stmt1 = $conn1->prepare($query1);
        $role = "normal";
        $locked = "0";
        $stmt1->bindParam(1,$locked);
        $stmt1->bindParam(2,$role);
        try{
            $stmt1->execute();
        } catch(PDOException $e) {
            echo('<script>'.
                '$("#alert-message").removeClass("hidden");'.
                '$("#alert-message").addClass("alert-danger");'.
                '$("#alert-message p strong").html("'. $e->getMessage() .'");'.
                'setTimeout(function() {$("#alert-message").addClass("hidden");$("#alert-message").removeClass("alert-success");}, 5000);'.
                '</script>');
        }
        //echo($stmt1->rowCount());
        if($stmt1->rowCount() > 0)
		{
			echo('<script>'.
                '$("#alert-message").removeClass("hidden");'.
                '$("#alert-message").addClass("alert-success");'.
                '$("#alert-message p strong").html("Accounts Successfully unlocked");'.
                'setTimeout(function() {$("#alert-message").addClass("hidden");$("#alert-message").removeClass("alert-success");}, 5000);'.
                '</script>');
		}
		else
		{
			echo('<script>'.
                '$("#alert-message").removeClass("hidden");'.
                '$("#alert-message").addClass("alert-info");'.
                '$("#alert-message p strong").html("Accounts already unlocked");'.
                'setTimeout(function() {$("#alert-message").addClass("hidden");$("#alert-message").removeClass("alert-info");}, 5000);'.
                '</script>');
		}
    }

    if(isset($_POST["lockAccount"])) {
        $conn2 = $db->get_connection();
        $query2 = "UPDATE authentication SET locked = ? WHERE role = ?";
        $stmt2 = $conn2->prepare($query2);
        $role = "normal";
        $locked = "1";
        $stmt2->bindParam(1,$locked);
        $stmt2->bindParam(2,$role);
        try{
            $stmt2->execute();
        } catch(PDOException $e) {
            echo('<script>'.
                '$("#alert-message").removeClass("hidden");'.
                '$("#alert-message").addClass("alert-danger");'.
                '$("#alert-message p strong").html("'. $e->getMessage() .'");'.
                'setTimeout(function() {$("#alert-message").addClass("hidden");$("#alert-message").removeClass("alert-success");}, 5000);'.
                '</script>');
        }
        //echo($stmt2->rowCount());
        if($stmt2->rowCount() > 0)
		{
			echo('<script>'.
                '$("#alert-message").removeClass("hidden");'.
                '$("#alert-message").addClass("alert-success");'.
                '$("#alert-message p strong").html("Accounts Successfully locked");'.
                'setTimeout(function() {$("#alert-message").addClass("hidden");$("#alert-message").removeClass("alert-success");}, 5000);'.
                '</script>');
		}
		else
		{
			echo('<script>'.
                '$("#alert-message").removeClass("hidden");'.
                '$("#alert-message").addClass("alert-info");'.
                '$("#alert-message p strong").html("Accounts already locked");'.
                'setTimeout(function() {$("#alert-message").addClass("hidden");$("#alert-message").removeClass("alert-info");}, 5000);'.
                '</script>');
		}
    }
    
?>