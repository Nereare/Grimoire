$(document).ready(function() {
  console.log("App ready!");

  // Hide non-default divs
  $("#tags, #categories").css("display", "none");

  // Show alphabetically
  $("#go-alphabetical").on("click", function() {
    if ( !$(this).hasClass("button-primary") ) {
      $("#go-tags, #go-categories").removeClass("button-primary");
      $(this).addClass("button-primary");
      $("#alphabetical").css("display", "block");
      $("#tags, #categories").css("display", "none");
    }
  });
  // Show tags
  $("#go-tags").on("click", function() {
    if ( !$(this).hasClass("button-primary") ) {
      $("#go-alphabetical, #go-categories").removeClass("button-primary");
      $(this).addClass("button-primary");
      $("#tags").css("display", "block");
      $("#alphabetical, #categories").css("display", "none");
    }
  });
  // Show categories
  $("#go-categories").on("click", function() {
    if ( !$(this).hasClass("button-primary") ) {
      $("#go-alphabetical, #go-tags").removeClass("button-primary");
      $(this).addClass("button-primary");
      $("#categories").css("display", "block");
      $("#alphabetical, #tags").css("display", "none");
    }
  });
});
