$(document).ready(function() {
  // Bulma tags input setting up
  BulmaTagsInput.attach();

  // Set all aria-delete buttons to delete their parent elements
  $("button.delete").on("click", function() {
    $(this).parent().addClass("is-hidden");
  });

  // Check for click events on the navbar burger icon
  $(".navbar-burger").on("click", function() {
    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
    $(".navbar-burger").toggleClass("is-active");
    $(".navbar-menu").toggleClass("is-active");
  });

});
