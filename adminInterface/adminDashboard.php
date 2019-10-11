<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CDN for bootstrap -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous"
    />
    <!-- font awesomo -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"
      integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+"
      crossorigin="anonymous"
    />
    <!-- adding style sheets -->
    <style>
        <?php include ("css/adminDashboard.css") ?>
    </style>
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="container-fluid">
        <div class="header">
            <img src="../assets/header.jpg" alt="header-img" 
            class="header-img">
        </div>
        <div class="row">
            <div class="col-xs-3 nav-bar" >
                <nav>
                    <div class="link-wrapper">
                    <a class="nav-link" id="addBookLink" href="#">
                        Add a book</a><hr>
                    </div>
                    <div class="link-wrapper">
                    <a class="nav-link" id="editBookLink" href="#">
                        Edit a book</a><hr>
                    </div class="link-wrapper">
                    <div class="link-wrapper">
                    <a class="nav-link" href="#">Delete a book</a>
                    </div>
                </nav>
            </div>
            <div class="col-xs-8 forms">
                <h2 class="text-center text-primary form-header">
                    Add a new book</h2>
                <form class="add-book-form">
                    <label for="bookName">Enter Book Name</label>
                    <input
                    type="text"
                    id="bookName"
                    class="form-control form-element"
                    name="bookName"
                    placeholder="Enter book name"
                    required
                    >
                    <button class="btn btn-primary btn-block form-element">
                        Add this book</button>
                </form>
                <form class="search-form">
                    <label for="searchBook">Search the book to edit</label>
                    <input
                    type="search"
                    id="searchBook"
                    class="form-control"
                    placeholder="Search"
                    >
                </form>
                <form class="edit-book-form">
                    <label for="bookName">Book Name</label>
                    <input
                    type="text"
                    id="bookName"
                    class="form-control form-element"
                    name="bookName"
                    placeholder="Enter book name"
                    required
                    value=""
                    >
                    <button class="btn btn-primary btn-block form-element">
                        Confirm Edit</button>

                </form>
            </div>
        </div>
    </div>

    <?php include ("../userAccount/footer.php")?>
      <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>

    <!-- attaching js file -->
    <script src="js/adminDashboard.js"></script>
</body>
</html>