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

    <?php include("dashBoardNav.php"); ?>
        <!-- making forms -->
        <div id="row">
          <div class="col-12">
            <h2 class="form-header text-center text-primary">Edit a book</h2>
            <!-- search-book-form -->
            <form class="search-book-form" action="editBook.php">
              <label for="searchBook">Search a book to edit</label>  
            <input
              type="text"
              name="searchBook"
              id="seachBook"
              class="form-control form-element"
              placeholder="Enter book name"
              required
              >
              <button type="submit" name="search-book" id="searchButton"
               class="btn btn-primary btn-block form-element">
                Search
              </button>
            </form>
          </div>
        </div>
        <script src="js/appendBody.js"></script>
        <script>
        
        </script>
  </body>
</html>
