<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- cdn for animate.css library -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"
    />
    <!-- CDN for bootstrap -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <!-- Attaching css file -->
    <style>
    <?php include("css/userLogin.css"); ?>
    </style>

    <title>Login</title>
  </head>
  <body>

  <?php
  session_start();
  
  class LoginHandler{
    private $email;
    private $password;
    public $error;

    public function _construct(){
      $this->email=null;
      $this->password=null;
      $this->error=null;
    }

    public function getFormData(){
      $this->email=$_POST["email"];
      $this->password=$_POST["password"];
    }
    public function validateCredentials(){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbName='library_management_system';
      $conn = new mysqli($servername, $username, $password,$dbName);

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $sql="SELECT * FROM `userregistration` WHERE `email`='$this->email' 
      and `password`='$this->password'";

      $result=$conn->query($sql);
      $conn->close();
      if ($result->num_rows>0){
        $_SESSION["email"]=$this->email;
        header("location: ../userInterface/searchBook.php");
      }
      else{
        $_SESSION["email"]=null;
        $this->error="Your Credentials doesn't match";
      }
  }
  }//end of class

  $loginHandle=new LoginHandler();

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $loginHandle->getFormData();
    $loginHandle->validateCredentials();
  }
  // session_destroy();
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
              <a class="nav-link" href="../index.php">Home</a>
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
      <div class="error text-danger text-center animated fadeInUpBig">
           <?php echo $loginHandle->error; ?></div>
      <!-- login form -->
      <form class="login" method="post" action="<?php
       echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
       >
       <h4 class="text-primary text-center">Login Here to proceed</h4>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input
            type="email"
            name="email"
            class="form-control user-email"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter email"
            required
          />
          <small id="emailHelp" class="form-text text-muted"
            >We'll never share your email with anyone else.</small
          >
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input
            name="password"
            type="password"
            class="form-control user-password"
            id="exampleInputPassword1"
            placeholder="Password"
            required
          />
        </div>

        <button type="submit" class="btn btn-primary btn-block" id="btn-login">
          Login
        </button>
        <div class="text-center" id="forgot-password-link">
          <a href="forgotPassword.php" class="text-info">Forgot Password?</a>
        </div>
        <div class="text-center" id="user-registration-link">
          <a href="userRegistration.php" class="text-info"
            >Not registered yet!</a
          >
        </div>
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
