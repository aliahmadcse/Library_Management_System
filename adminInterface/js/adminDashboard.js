$(document).ready(function() {
  $(".search-form").hide();
  $(".edit-book-form").hide();

  //   edit book link click event
  $("#editBookLink").click(function(e) {
    e.preventDefault();
    $(".form-header").text("Edit a book");
    $(".add-book-form").hide();
    $(".edit-book-form").hide();
    $(".search-form").show();
  });

  //add book link click
  $("#addBookLink").click(function(e) {
    e.preventDefault();
    $(".form-header").text("Add a new Book");
    $(".add-book-form").show();
    $(".search-form").hide();
    $(".edit-book-form").hide();
  });
});
