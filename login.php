<?php
session_start();
include("/configs/db.php");
$page_title = "Please enter you login details";
include_once("layout/header.php");
?>

<div class="row">
    <div class="col-sm-6 col-sm-push-3 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <div class="form-group">
              <label for="username">Usernam</label>
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
      $username = $_POST["username"];
      $password = $_POST["password"];

      $db = new MyDatabase("localhost","foldb","root","");
      $conn = $db->get_connection();

      $query = "SELECT * FROM authentication WHERE username = ?";
      $stmt = $conn->prepare($query);
      $stmt->bindParam("1",$username);
      $stmt->execute();
      
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      
      echo(var_dump($result));
      if($result == false)
      {
        echo('<script type="text/javascript">'.
        '$(".error-message").removeClass("hidden");'.
        '$(".error-message p strong").html("Your username or password is wrong");'.
        '</script>');
      }
      else {
        if(password_verify($password, $result["password"])) {
          $_SESSION["auth"] = true;
          $_SESSION["role"] = $result["role"];
          header("LOCATION:index.php");
        } else {
          echo('<script type="text/javascript">'.
          '$(".error-message").removeClass("hidden");'.
          '$(".error-message p strong").html("Your username or password is wrong");'.
          '</script>');
        }
      }
    }
  
   
    include_once("layout/footer.php");
  ?>
