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
    <?php include("css/enterResetCode.css"); ?>
    </style>
    <title>Enter reset code</title>
  </head>
  <body>

  <?php
  session_start();
  class ResetCodeHandler{
    public $codeErr;
    private $code;
    private $email;

    public function _constuct(){
      $this->codeErr=null;
      $this->code=null;
      $this->email=null;
    }
    public function getFormData(){
      $this->code=$_POST["code"];
      $this->email=$_SESSION["forgotEmail"];
    }
    public function confirmCode(){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbName='library_management_system';
      $conn = new mysqli($servername, $username, $password,$dbName);

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql="SELECT * FROM `userregistration` WHERE `email`='$this->email' 
      and `forgotPasswordCode`='$this->code'";
      $result=$conn->query($sql);
      $conn->close();

      if ($result->num_rows>0){
        header("location: resetPassword.php");
      }
      else{
        $this->codeErr="Code is invalid";
      }

    }
  }//end of class
  $resetCodeHandle=new resetCodeHandler();
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $resetCodeHandle->getFormData();
    $resetCodeHandle->confirmCode();
  }

  ?>
    <div class="fluid-container">
      <!-- code-enter form -->
      <h4 class="text-center text-primary reset-password-header">
      We have sent you an email with a six digit code. Enter code below to
      reset your password</h4>
      <form class="reset-password-form" method="post" action="<?php
       echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
       >
        <div class="form-group">
          <label for="forgotCode">Enter your code:</label>
          <span class="error text-danger">
           <?php echo $resetCodeHandle->codeErr;?></span>
          <input
            type="number"
            name="code"
            class="form-control user-email"
            id="forgotCode"
            aria-describedby="emailHelp"
            placeholder="Enter reset password code"
            required
          />
        </div>
        <button type="submit" class="btn btn-primary btn-block" id="btn-login">
          Click to continue
        </button>
      </form>
      <?php 
      include("footer.php");
      ?>
    </div>

  </body>
</html>
