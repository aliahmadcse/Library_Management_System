$(document).ready(function() {
  $(".search-book-form").hide();

  $(".editBookLink").click(function (e) { 
    e.preventDefault();
    $(".add-book-form").hide();
    $(".search-book-form").show();
    $(".form-header").text("Edit a book");
  });

  $(".addBookLink").click(function(e){
    e.preventDefault();
    $(".search-book-form").hide();
    $(".add-book-form").show();
    $(".form-header").text("Add a new Book");
  })
});
