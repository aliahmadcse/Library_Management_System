<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS CDN -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
      integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
      crossorigin="anonymous"
    />
    <!-- Our Custom CSS -->
    <style>
        <?php include ("css/adminDashboardNav.css")?>
        <?php include ("css/adminDashboard.css")?>
    </style>

    <!-- Font Awesome JS -->
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
      integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
      crossorigin="anonymous"
    ></script>
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
      integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
      crossorigin="anonymous"
    ></script>

    <!-- animated css library -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"
    />
  </head>

  <body>
    <?php
    class AddNewBook{
      private $bookName;
      private $authorName;
      private $noOfCopies;
      private $edition;
      private $category;
      public $confirmMessage;

      public function construct(){
        $this->bookName=null;
        $this->authorName=null;
        $this->noOfCopies=null;
        $this->edition=null;
        $this->category=null;
        $this->confirmMessage=null;
      }
      public function getFormData(){
        $this->bookName=$_POST["bookName"];
        $this->authorName=$_POST["authorName"];
        $this->noOfCopies=$_POST["numberOfCopies"];
        $this->edition=$_POST["bookEdition"];
        $this->category=$_POST["bookCategory"];
      }
      public function insertData(){
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbName = 'library_management_system';
      $conn = new mysqli($servername, $username, $password, $dbName);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql = "INSERT INTO `books` (`bookName`, `authorName`, `numberOfCopies`, 
      `edition`, `category`) VALUES ('$this->bookName', '$this->authorName', 
      '$this->noOfCopies', '$this->edition', '$this->category')";

      if ($conn->query($sql) === TRUE) {
        $this->confirmMessage="Book added successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      $conn->close();
        }
    } //end of class AddNewBook

//new book form submit
    $addNewBookObj = new AddNewBook();
    if (isset($_POST['new-book-submit'])) {    
        $addNewBookObj->getFormData();
        $addNewBookObj->insertData();
      }

    ?>
    <div class="wrapper">
      <!-- Sidebar Holder -->
      <nav id="sidebar">
        <div class="sidebar-header">
          <h3>Welcome Admin</h3>
        </div>

        <ul class="list-unstyled components">  
            <p class="menu-header">Main Menus</p>
          <li>
            <a href="#" class="addBookLink">Add a new Book</a>
          </li>
          <li>
            <a href="#" class="editBookLink">Edit a Book</a>
          </li>
          <li>
            <a href="#" class="removeBookLink">Remove a Book</a>
          </li>
        </ul>
      </nav>

      <!-- Page Content Holder -->
      <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="navbar-btn">
              <span></span>
              <span></span>
              <span></span>
            </button>
            <button
              class="btn btn-dark d-inline-block d-lg-none ml-auto"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <i class="fas fa-align-justify"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="#">Logout</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- making forms -->
        <div id="row">
          <div class="col-12">
            <h2 class="form-header text-center text-primary">Add a new Book</h2>
            <!-- add book form -->
            <form class="add-book-form" method="post" 
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="text-center text-info confirmMessage animated rollIn">
              <?php echo $addNewBookObj->confirmMessage;?>
            </div>
            <label for="bookName">Book Name</label>  
            <input
              name="bookName"
              type="text"
              id="bookName"
              class="form-control form-element"
              placeholder="Enter book name"
              required
              >
              <label for="authorName">Author Name</label>  
            <input
              type="text"
              name="authorName"
              id="authorName"
              class="form-control form-element"
              placeholder="Enter book author name"
              required
              >
              <label for="numberOfCopies">Number of copies</label>  
            <input
              type="number"
              name="numberOfCopies"
              id="numberOfCopies"
              class="form-control form-element"
              placeholder="Enter number of copies"
              required
              >
              <label for="bookEdition">Edition</label>  
            <input
              type="text"
              name="bookEdition"
              id="bookEdition"
              class="form-control form-element"
              placeholder="Enter book Edition"
              required
              >
              <label for="bookCategory">Category</label>  
            <input
              type="text"
              name="bookCategory"
              id="bookCategory"
              class="form-control form-element"
              placeholder="Enter book category"
              required
              >
              <button type="submit" name="new-book-submit"
               class="btn btn-primary btn-block form-element">
                Add new book
              </button>
            </form>
            <!-- search-book-form -->
            <form class="search-book-form">
              <label for="searchBook">Search a book to edit</label>  
            <input
              type="text"
              name="searchBook"
              id="seachBook"
              class="form-control form-element"
              placeholder="Enter book name"
              required
              >
              <button type="submit" name="new-book-submit"
               class="btn btn-primary btn-block form-element">
                Search
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery CDN  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    <!-- nav bar script -->
    <script src="js/adminDashboard.js"></script>
    <script src="js/adminDashboardNav.js"></script>
  </body>
</html>
