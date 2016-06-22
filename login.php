<?php
session_start();
include("/configs/db.php");
$page_title = "Please enter you login details";
include_once("layout/header.php");

if(isset($_SESSION['auth'])) {
  header("LOCATION:index.php");
}
?>

<div class="row">
    <div class="col-sm-6 col-sm-push-3 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" placeholder="Username" name="username">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password_field" placeholder="Password" name="password">
            </div>
            <div class="hidden alert alert-danger error-message"><p class="text-center"><strong></strong></p></div>
            <input type="submit" name="submit" value="submit" class="btn btn-primary"/>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php

    if(isset($_POST["submit"]))
    {
      $username = trim($_POST["username"]);
      $password = trim($_POST["password"]);

      if(strlen($username) == 0 || strlen($password) == 0) {
         echo('<script type="text/javascript">'.
          '$(".error-message").removeClass("hidden");'.
          '$(".error-message p strong").html("You\'ve got an empty field");'.
          'setTimeout(function() {$(".error-message").hide();}, 3000);'.
          '</script>');
        return;
      } 


      $dbinfo = MyDatabase::getConnectionDetails();
      $host = $dbinfo["host"];
      $database = $dbinfo["database"];
      $db_username = $dbinfo["username"];
      $db_password = $dbinfo["password"];
      $db = new MyDatabase($host,$database,$db_username,$db_password);
      $conn = $db->get_connection();

      $query = "SELECT * FROM authentication WHERE username = ?";
      $stmt = $conn->prepare($query);
      $stmt->bindParam("1",$username);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      /*echo(var_dump($result));*/

      if($result == false)
      {
        echo('<script type="text/javascript">'.
          '$(".error-message").removeClass("hidden");'.
          '$(".error-message p strong").html("Your username or password is wrong");'.
          'setTimeout(function() {$(".error-message").hide();}, 3000);'.
          '</script>');
      }
      else {
        if(password_verify($password, $result["password"])) {
          
          if($result["locked"] == 0) {
            $_SESSION["auth"] = true;
            $_SESSION["role"] = $result["role"];
            $_SESSION["locked"] = $result["locked"];
            header("LOCATION:index.php");
          } else {
            echo('<script type="text/javascript">'.
          '$(".error-message").removeClass("hidden");'.
          '$(".error-message p strong").html("Access denied, account has been locked");'.
          'setTimeout(function() {$(".error-message").hide();}, 3000);'.
          '</script>');
          }
          
        } else {
          echo('<script type="text/javascript">'.
          '$(".error-message").removeClass("hidden");'.
          '$(".error-message p strong").html("Your username or password is wrong");'.
          'setTimeout(function() {$(".error-message").hide();}, 3000);'.
          '</script>');
        }
      }
    }

    include_once("layout/footer.php");
  ?>