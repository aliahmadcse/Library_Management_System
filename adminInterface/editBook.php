<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>Edit Book</title>

    <!-- Our Custom CSS -->
    <style>
        <?php include ("css/admin.css")?>
    </style>

  </head>

  <body>
    <?php 
    session_start();
    class editBook{
      private $bookName;
      private $authorName;
      private $numberOfCopies;
      private $edition;
      private $category;
      private $bookId;
      public $confirmMessage;

      public function getFormData(){
        $this->bookName=$_POST["bookName"];
        $this->authorName=$_POST["authorName"];
        $this->numberOfCopies=$_POST["numberOfCopies"];
        $this->edition=$_POST["bookEdition"];
        $this->category=$_POST["bookCategory"];
        $this->bookId=$_SESSION["book_id"];
      }
      public function updateData(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName='library_management_system';
        $conn = new mysqli($servername, $username, $password,$dbName);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql="UPDATE `books` SET `bookName`='$this->bookName',
        `authorName`='$this->authorName',
        `numberOfCopies`='$this->numberOfCopies',
         `edition`='$this->edition',
         `category`='$this->category'
          WHERE `book_id`='$this->bookId'";

        if ($conn->query($sql) === TRUE) {
          // session_unset();
          $this->confirmMessage="Book edited successfully";
        }
        else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
      }
    }//end of class editBook
    $editBookObj=new editBook();
    if (isset($_POST["edit-book"])){
      $editBookObj->getFormData();
      $editBookObj->updateData();
    }
    ?>
    <?php include("dashBoardNav.php"); ?>
        <!-- making forms -->
        <div id="row">
          <div class="col-12">
            <h2 class="form-header text-center text-primary">Edit the book data</h2>
            <!-- edit book form -->
            <form class="edit-book-form" method="post" 
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="text-center text-info confirmMessage animated rollIn">
              <?php echo $editBookObj->confirmMessage; ?>
            </div>
            <label for="bookName">Book Name</label>  
            <input
              name="bookName"
              type="text"
              value="<?php echo $_SESSION["bookName"] ?>"
              id="bookName"
              class="form-control form-element"
              placeholder="Enter book name"
              required
              >
              <label for="authorName">Author Name</label>  
            <input
              type="text"
              value="<?php echo $_SESSION["authorName"] ?>"
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
              value="<?php echo $_SESSION["numberOfCopies"] ?>"
              id="numberOfCopies"
              class="form-control form-element"
              placeholder="Enter number of copies"
              required
              >
              <label for="bookEdition">Edition</label>  
            <input
              type="text"
              name="bookEdition"
              value="<?php echo $_SESSION["edition"] ?>"
              id="bookEdition"
              class="form-control form-element"
              placeholder="Enter book Edition"
              required
              >
              <label for="bookCategory">Category</label>  
            <input
              type="text"
              name="bookCategory"
              value="<?php echo $_SESSION["category"] ?>"
              id="bookCategory"
              class="form-control form-element"
              placeholder="Enter book category"
              required
              >
              <button type="submit" name="edit-book"
              onclick="javascript:return confirm('Are you sure you want to edit this book?');"
               class="btn btn-primary btn-block form-element">
                Save Changes
              </button>
            </form>
          </div>
        </div>
        <script src="js/appendBody.js"></script>
  </body>
</html>
