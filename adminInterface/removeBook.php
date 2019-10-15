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
      class searchBookData{
          public $confirmMessage;
          public $book_id;

          public function __construct()
          {
              $this->confirmMessage=null;
              $this->book_id=$_SESSION["book_id"];
          }
          
          public function deleteRecord(){
             $servername = "localhost";
             $username = "root";
             $password = "";
             $dbName='library_management_system';
             $conn = new mysqli($servername, $username, $password,$dbName);

             if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
             }

             $sql="DELETE fROM `books` WHERE `book_id`='$this->book_id'";
            if ($conn->query($sql) === TRUE) {
            // session_unset();
            $this->confirmMessage="Book deleted successfully";
            }
            else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();

          }
      }//end of classs searchBookData
 
    //search book form submit
    $deleteBookDataObj=new SearchBookData();
    if (isset($_POST["delete-book"])){
     $deleteBookDataObj->deleteRecord();
    }
    ?>
    <?php include("dashBoardNav.php"); ?>
        <!-- making forms -->
        <div id="row">
          <div class="col-12">
            <h2 class="form-header text-center text-primary">Delete a book</h2>
            <!-- search-book-form -->
            <form class="search-book-form"  method="post"
            action="<?php
            echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="text-center text-danger confirmMessage animated rollIn">
              <?php echo $deleteBookDataObj->confirmMessage ?>
            </div>
              <h4 class="">Record found is</h4>
              <div class="searchDataWrapper text-center">
                <div class="bookDetail">
                <h6 class="inlineData heading">Book Name:</h6>
                <p class="inlineData para"><?php echo $_SESSION["bookName"] ?></p>
                </div>
                <div class="bookDetail">
                <h6 class="inlineData heading">Author Name:</h6>
                <p class="inlineData para"><?php echo $_SESSION["authorName"] ?></p>
                </div>
                <div class="bookDetail">
                <h6 class="inlineData heading">Number of copies:</h6>
                <p class="inlineData para"><?php echo $_SESSION["numberOfCopies"] ?></p>
                </div>
                <div class="bookDetail">
                <h6 class="inlineData heading">Edition:</h6>
                <p class="inlineData para"><?php echo $_SESSION["edition"] ?></p>
                </div>
                <div class="bookDetail">
                <h6 class="inlineData heading">Category:</h6>
                <p class="inlineData para"><?php echo $_SESSION["category"] ?></p>
                </div>
              </div>
              <button type="submit" name="delete-book" id="searchButton"
               class="btn btn-primary btn-block form-element text-center"
               onclick="javascript:return confirm('Are you sure you want to delete this book?');"
               >
                Delete this Book
              </button>
            </form>
          </div>
        </div>
        <script src="js/appendBody.js"></script>
  </body>
</html>
