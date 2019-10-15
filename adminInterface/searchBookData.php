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
          public $notFoundError;
      }
 
    //search book form submit
    $searchBookDataObj=new SearchBookData();
    if (isset($_POST["search-book-data"])){
      $searchBookObj->getFormData();
      $searchBookObj->searchDB();
    }
    ?>
    <?php include("dashBoardNav.php"); ?>
        <!-- making forms -->
        <div id="row">
          <div class="col-12">
            <h2 class="form-header text-center text-primary">Edit a book</h2>
            <!-- search-book-form -->
            <form class="search-book-form"  method="post"
            action="editBook.php">
            <div class="text-center text-danger confirmMessage animated rollIn">
              <?php echo $searchBookDataObj->notFoundError ?>
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
              <button type="submit" name="search-book" id="searchButton"
               class="btn btn-primary btn-block form-element text-center">
                Edit this data
              </button>
            </form>
          </div>
        </div>
        <script src="js/appendBody.js"></script>
  </body>
</html>
