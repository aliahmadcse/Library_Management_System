<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>Issue Book</title>

    <!-- Our Custom CSS -->
    <style>
        <?php include("css/user.css") ?>
    </style>

</head>

<body>
    <?php

    class SearchBook
    {
        private $bookToSearch;
        public $notFoundError;

        public function construct()
        {
            $this->bookToSearch = null;
            $this->notFoundError = null;
        }

        public function getFormData()
        {
            $this->bookToSearch = $_POST["bookName"];
        }
        public function searchDB()
        {

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbName = 'library_management_system';
            $conn = new mysqli($servername, $username, $password, $dbName);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM `books` WHERE `bookName`='$this->bookToSearch'";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION["book_id"] = $row["book_id"];
                $_SESSION["bookName"] = $row["bookName"];
                $_SESSION["authorName"] = $row["authorName"];
                $_SESSION["numberOfCopies"] = $row["numberOfCopies"];
                $_SESSION["edition"] = $row["edition"];
                $_SESSION["category"] = $row["category"];
                header("location:searchBookData.php");
            } else {
                $this->notFoundError = "No record found";
            }
            $conn->close();
        } //end of searchDB function

    } //end of searchBook class


    //search book form submit
    session_start();
    $searchBookObj = new SearchBook();
    if (isset($_POST["search-book"])) {
        $searchBookObj->getFormData();
        $searchBookObj->searchDB();
    }
    ?>
    <?php include("userNav.php") ?>
    <!-- making forms -->
    <div id="row">
        <div class="col-12">
            <h2 class="form-header text-center text-primary">Issue a book</h2>
            <!-- search-book-form -->
            <form class="search-book-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="text-center text-danger confirmMessage animated rollIn">
                    <?php echo $searchBookObj->notFoundError ?>
                </div>
                <label for="searchBook">Search a book to issue</label>
                <input type="text" name="bookName" id="seachBook" class="form-control form-element" placeholder="Enter book name" required>
                <button type="submit" name="search-book" id="searchButton" class="btn btn-primary btn-block form-element">
                    Search
                </button>
            </form>
        </div>
    </div>
    <script src="../adminInterface/js/appendBody.js"></script>
</body>

</html>