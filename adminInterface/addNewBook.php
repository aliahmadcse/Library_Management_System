<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>Add new Book</title>
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"
    >
    <!-- Our Custom CSS -->
    <style>
        <?php include ("css/admin.css")?>
    </style>
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
    
    <?php include("dashBoardNav.php"); ?>
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
              onclick="javascript:return confirm('Are you sure you want to add this book?');"
               class="btn btn-primary btn-block form-element">
                Add new book
              </button>
            </form>
            
          </div>
        </div>
        <script src="js/appendBody.js"></script>
  </body>
</html>
