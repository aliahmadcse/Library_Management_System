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
    <?php include("css/userRegistration.css"); ?>
    </style>
    <title>Login</title>
  </head>
  <body>

<?php
$firstName=$lastName=$email=$cnic=$password=$confirmPassword=$address="";
$firstNameErr=$lastNameErr=$emailErr=$cnicErr=$passwordErr=$addressErr="";

//validating user first name
function validateName($name){
  if (preg_match("/^[a-zA-z]+$/",$name)){
    return true;
  }
  return false;
}
//validating cnic
function validateCnic($cnic){
  if (preg_match("/\d{5}-\d{7}-\d{1}/",$cnic)){
    return true;
  }
  return false;
}
//validating password
function validatePassword($password){
  if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$password)){
    return true;
  }
  return false;
}
//validating if password and confirm password matches
function matchPasswordAndConfirmPassword($password,$confirmPassword){
  if ($password===$confirmPassword){
    return true;
  }
  return false;
}
//validating email address
function validateEmail($email){
  if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    return true;
  }
  return false;
}
//getting form data
if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
$firstName = $_POST["fname"];
$lastName = $_POST["lname"];
$email= $_POST["email"];
$cnic = $_POST["cnic"];
$password = $_POST["password"];
$confirmPassword=$_POST["cpassword"];
$address = $_POST["address"]; 

if (!validateName($firstName)){
  $firstNameErr="First Name is not valid";
}

if (!validateName($lastName)){
  $lastNameErr="Last Name is not valid";
  }

if (!validateCnic($cnic)){
  $cnicErr="Cnic is not valid";
}

if (!validatePassword($password)){
  $passwordErr="Password is not valid";
}

if (!matchPasswordAndConfirmPassword($password,$confirmPassword)){
  $passwordErr="Password and Confirm password does not match";
}

if (!validateEmail($email)){
  $emailErr="Email is not valid";
}

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
      <div class="col-xs-12 text-center text-primary" id="info-para">
        <h2>Want to Register with the Library</h2>
        <p>Please Enter the following Information</p>
      </div>
      <!-- login form -->
      <form class="registration-form" action="<?php
       echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
      method="post">
        <div class="form-group">
          <label for="firstName">First Name *</label>
          <span class="error text-danger">
           <?php echo $firstNameErr;?></span>
          <input
            type="text"
            name="fname"
            value="<?php echo $firstName; ?>"
            class="form-control user-email"
            id="firstName"
            aria-describedby="emailHelp"
            placeholder="Enter first Name"
            required
          />
        </div>
        <div class="form-group">
          <label for="lastName">Last Name *</label>
          <span class="error text-danger"> <?php echo $lastNameErr;?></span>
          <input
            type="text"
            name="lname"
            value="<?php echo $lastName; ?>"
            class="form-control user-email"
            id="lastName"
            aria-describedby="emailHelp"
            placeholder="Enter last Name"
            required
          />
        </div>
        <div class="form-group">
          <label for="emailAddress">Email address *</label>
          <span class="error text-danger"> <?php echo $emailErr;?></span>
          <input
            type="email"
            name="email"
            value="<?php echo $email; ?>"
            class="form-control user-email"
            id="emailAddress"
            aria-describedby="emailHelp"
            placeholder="Enter email"
            required
          />
          <small id="emailHelp" class="form-text text-muted"
            >We'll never share your email with anyone else.</small
          >
        </div>
        <div class="form-group">
          <label for="cnic">CNIC *</label>
          <span class="error text-danger"> <?php echo $cnicErr;?></span>
          <input
            type="text"
            name="cnic"
            value="<?php echo $cnic; ?>"
            class="form-control user-email"
            id="cnic"
            aria-describedby="emailHelp"
            placeholder="Enter CNIC Here"
            required
          />
          <small id="emailHelp" class="form-text text-muted"
            >We'll never share your CNIC with anyone else. Format should be
            xxxxx-xxxxxxx-x</small
          >
        </div>
        <div class="form-group">
          <label for="password">Password *</label>
          <span class="error text-danger"> <?php echo $passwordErr;?></span>
          <input
            type="password"
            name="password"
            value="<?php echo $password; ?>"
            class="form-control user-email"
            id="password"
            aria-describedby="emailHelp"
            placeholder="Password"
            required
          />
          <small id="emailHelp" class="form-text text-muted"
            >Password must contain Minimum eight characters, at least
             one uppercase letter, one lowercase letter, one number and
             no special character</small
          >
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password *</label>
          <span class="error text-danger"> <?php echo $passwordErr;?></span>
          <input
            type="password"
            name="cpassword"
            value="<?php echo $confirmPassword; ?>"
            class="form-control user-email"
            id="confirmPassword"
            aria-describedby="emailHelp"
            placeholder="Confirm Password"
            required
          />
          <small id="emailHelp" class="form-text text-muted"
            >Password must contain Minimum eight characters, at least
             one uppercase letter, one lowercase letter, one number and
             no special character</small
          >
        </div>
        <div class="form-group">
          <label for="address">Address *</label>
          <span class="error text-danger"> <?php echo $addressErr;?></span>
          <input
            type="text"
            name="address"
            value="<?php echo $address; ?>"
            class="form-control user-email"
            id="address"
            aria-describedby="emailHelp"
            placeholder="Address Here"
            required
          />
          <small id="emailHelp" class="form-text text-muted"
            >Don't worry, Your address will only be used for book shipping
            purpose</small
          >
        </div>
        <button type="submit" class="btn btn-primary btn-block" id="btn-register">
          Register Here
        </button>
      </form>
      <footer class="footer">
        <small>&copy; Copyright 2019, Library Management System</small>
      </footer>
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
    <!-- Java script file -->
    <script src="js/userRegistration.js"></script>
    <script src="database/registerDB.js"></script>
  </body>
</html>
