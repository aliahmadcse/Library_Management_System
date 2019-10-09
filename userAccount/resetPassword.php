<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- CDN for bootstrap -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <!-- Attaching css file -->
    <style>
    <?php include("css/resetPassword.css"); ?>
    </style>
    <title>Reset Password</title>
  </head>
  <body>
  <?php 
  session_start();

  class resetPasswordHandler{
    public $passwordError;
    private $newPassword;
    private $confirmNewPassword;
    private $userEmail;

    public function construct(){
    $this->passwordError=null;
    $this->newPassword=null;
    $this->confirmNewPassword=null;
    $this->userEmail=null;
  }
  
  public function getFormData(){
    $this->newPassword=$_POST["newPassword"];
    $this->confirmNewPassword=$_POST["confirmNewPassword"];
    $this->userEmail=$_SESSION["forgotEmail"];
  }

  //validating password
  private function validateNewPassword(){
    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$this->newPassword)){
      return true;
    }
    return false;
  }

  //validating if password and confirm password matches
  private function matchPasswordAndConfirmPassword(){
    if ($this->newPassword===$this->confirmNewPassword){
      return true;
    }
    return false;
  }

  public function updatePassword(){
    if (!$this->validateNewPassword()){
      $this->passwordError="Password is not valid";
      return;
    }
    if (!$this->matchPasswordAndConfirmPassword()){
      $this->passwordError="New password and confirm new password does not match";
      return;
    }
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbName='library_management_system';
      $conn = new mysqli($servername, $username, $password,$dbName);

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $sql="UPDATE `userregistration` SET `password`='$this->newPassword' 
      WHERE `email`='$this->userEmail'";

      $result=$conn->query($sql);
      session_destroy();
      $conn->close();
    }
    public function goToLogin(){
      header("location: userLogin.php");
    }
  }//end of class
  
  $resetPasswordHandle=new resetPasswordHandler();  
  if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $resetPasswordHandle->getFormData();
    $resetPasswordHandle->updatePassword();
    $resetPasswordHandle->goToLogin();
  }

  ?>

      <div class="fluid-container">
      <!-- code-enter form -->
      <h4 class="text-center text-primary reset-password-header">
      Enter a new Password below</h4>
      <form class="reset-password-form" method="post" action="<?php
       echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
       >
        <div class="form-group">
          <label for="forgotCode">Enter new Password:</label>
          <span class="error text-danger">
           <?php echo $resetPasswordHandle->passwordError;?></span>
          <input
            type="password"
            name="newPassword"
            class="form-control user-email"
            id="forgotCode"
            aria-describedby="emailHelp"
            placeholder="Enter reset password code"
            required
          />
          <small id="emailHelp" class="form-text text-muted"
            >Password must contain Minimum eight characters, at least
             one uppercase letter, one lowercase letter, one number and
             no special character</small
          >
        </div>
        <div class="form-group">
          <label for="forgotCode">Confirm New Password:</label>
          <span class="error text-danger">
           <?php echo $resetPasswordHandle->passwordError;?></span>
          <input
            type="password"
            name="confirmNewPassword"
            class="form-control user-email"
            id="forgotCode"
            aria-describedby="emailHelp"
            placeholder="Enter reset password code"
            required
          />
          <small id="emailHelp" class="form-text text-muted"
            >Password must contain Minimum eight characters, at least
             one uppercase letter, one lowercase letter, one number and
             no special character</small
          >
        </div>
        <button type="submit" class="btn btn-primary btn-block" id="btn-login">
          Reset Password
        </button>
      </form>
      <?php 
      include("footer.php");
      ?>
    </div>

  </body>
</html>
