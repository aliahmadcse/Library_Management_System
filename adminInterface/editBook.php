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
    //class to search a book
    class SearchBook{
      private $book;
      public $notFoundError;

    }//end of searchBook class


    //search book form submit
    $searchBookObj=new SearchBook();
    if (isset($_POST['search-book'])){
      $searchBookObj->notFoundError="Error";
    }

    ?>
    <?php include("dashBoardNav.php"); ?>
        <!-- making forms -->
        <div id="row">
          <div class="col-12">
            <h2 class="form-header text-center text-primary">Edit a book</h2>
            <!-- edit book form -->
            <form class="edit-book-form" method="post" 
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="text-center text-info confirmMessage animated rollIn">
              <?php echo $searchBookObj->notFoundError?>
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
                Edit Book
              </button>
            </form>
          </div>
        </div>
        <script src="js/appendBody.js"></script>
  </body>
</html>
