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
    <?php include("css/forgotPassword.css"); ?>
    </style>
    <title>Forgot Password?</title>
  </head>
  <body>
  <?php 
  session_start();
  class forgotPasswordHandler{
    public $error;
    private $email;
    private $randomCode; 

    public function __construct(){
      $this->error=null;
      $this->email=null;
      $this->randomCode=null; 
    }

    public function getFormData(){
      $this->email=$_POST["email"];
    }

    public function generateRandomCode(){
      $this->randomCode=rand(100000,999999);
    }

    public function updateCodeInDataBase(){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbName='library_management_system';
      $conn = new mysqli($servername, $username, $password,$dbName);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql="UPDATE `userregistration` SET `forgotPasswordCode`='$this->randomCode'
      WHERE `email`='$this->email'";
      
      $result=$conn->query($sql);
      $conn->close();
    }
    //sending email
    public function sendEmail(){
      require_once("../PHPMailer/PHPMailerAutoload.php");

      $mail=new PHPMailer();
      $mail->isSMTP();
      $mail->SMTPAuth=true;
      $mail->SMTPSecure='ssl';
      $mail->Host='smtp.gmail.com';
      $mail->Port='465';
      $mail->isHTML();
      $mail->Username="aliahmadcse@gmail.com";
      $mail->Password="";
      $mail->SetFrom($this->email);
      $mail->Subject="Reset Password Code";
      $mail->Body="Your reset password code is ".$this->randomCode;
      $mail->AddAddress($this->email);
      
      $_SESSION['forgotEmail']=$this->email;
      if (!$mail->Send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
        $_SESSION['forgotEmail']=null;
      }
      header("location: enterResetCode.php");
    }

  }//class end

  $passwordHandle=new forgotPasswordHandler();
  if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
    $passwordHandle->getFormData();
    $passwordHandle->generateRandomCode();
    $passwordHandle->updateCodeInDataBase();
    $passwordHandle->sendEmail();

  }
  ?>
    <div class="fluid-container">
      <!-- Responsive Bootstrap Navigation Bar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.html"
          ><strong>LOGO Here</strong></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto" id="nav-list">
            <li class="nav-item">
              <a class="nav-link" href="../index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link-2</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link-3</a>
            </li>
          </ul>
        </div>
      </nav>
      <!-- forgot-password form -->
      <h4 class="text-center text-primary forgot-password-header">
      Changing your password is Simple. Just enter
      your email address below to continue</h4>
      <form class="forgot-password-form" method="post" action="<?php
       echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
       >
        <div class="form-group">
          <label for="exampleInputEmail1">Enter your Email address:</label>
          <input
            type="email"
            name="email"
            class="form-control user-email"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter email"
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

    <!-- Bootstrap CDN-->
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  </body>
</html>
