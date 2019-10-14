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
    <?php include("css/login.css"); ?>
    </style>

    <title>Login</title>
  </head>
  <body>
      <?php
      class loginHandler{
          private $userName;
          private $password;
          public $error;
          public function construct(){
              $this->userName=null;
              $this->password=null;
              $this->error=null;
          }         
          public function getFormData(){
              $this->userName=$_POST["userName"];
              $this->password=$_POST["password"];
          }
          public function validateUser(){
              if ($this->userName==="admin" && $this->password==="admin"){
                  header("location:addNewBook.php");
              }
              else{
                  $this->error="Credentials does not match";
              }
          }
      }//end of class

      $loginHandle=new loginHandler();
      if ($_SERVER["REQUEST_METHOD"]=="POST"){
          $loginHandle->getFormData();
          $loginHandle->validateUser();   
      }
      ?>
    <div class="fluid-container">

      <div class="error text-danger text-center animated fadeInUpBig">
           <?php echo $loginHandle->error; ?></div>
      <!-- login form -->
      <form class="login" method="post" action="<?php
       echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
       >
       <h4 class="text-primary text-center">Login Here to proceed</h4>
        <div class="form-group">
          <label for="exampleInputEmail1">User Name</label>
          <input
            type="text"
            name="userName"
            class="form-control user-email"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
            placeholder="Enter User Name"
            required
          />
          
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
      </form>
      <?php 
      include("../userAccount/footer.php");
      ?>
    </div>
  </body>
</html>
