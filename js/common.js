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

  // Login methods
  // Show login modal
  $("#login-button").on("click", function() {
    $("#login-modal").addClass("is-active");
    $("#login-username").focus();
  });
  // Cancel login
  $("#login-cancel").on("click", function() {
    $("#login-modal").removeClass("is-active");
    $("#login-username, #login-password").val("");
  });
  // Execute login
  $("#login-login").on("click", function() {
    // Disable button
    $(this)
      .addClass("is-loading")
      .prop("disabled", true);

    // Retrieve values for ease of use.
    let username = $("#login-username").val();
    let password = $("#login-password").val();

    if ( username != "" && password != "" ) {
      //
      let reply = null;
      $.ajax({
        method: "GET",
        url: "do/login.php",
        data: {
          username : username,
          password : password
        }
      })
        .done(function(r) { reply = r; })
        .fail(function(r) {
          resetNotification( $("#notification") );
          $("#notification")
            .addClass("is-danger")
            .removeClass("is-hidden")
            .find("p").html("We could not connect to the server.");
          // Reenable button
          $("#login-login")
            .removeClass("is-loading")
            .prop("disabled", false);
        })
        .always(function(r) {
          if ( r == "0" ) {
            resetNotification( $("#notification") );
            $("#notification")
              .addClass("is-success")
              .removeClass("is-hidden")
              .find("p").html("You are now logged in.");
            // Reload page
            location.reload();
          } else {
            resetNotification( $("#notification") );
            $("#notification")
              .addClass("is-danger")
              .removeClass("is-hidden")
              .find("p").html("The user data is invalid.");
            // Focus on username field
            $("#login-username").focus();
            // Reenable button
            $("#login-login")
              .removeClass("is-loading")
              .prop("disabled", false);
          }
        });
    } else {
      // Reenable button
      $(this)
        .removeClass("is-loading")
        .prop("disabled", false);
    }
  });

  // Logout
  $("#logout").on("click", function() {
    $.ajax({
      method: "GET",
      url: "do/logout.php"
    }).always(function(r) { location.reload(); });
  });

});

function resetNotification(elem) {
  elem.removeClass("is-success is-danger is-warning is-info is-dark is-light");
  elem.addClass( "is-hidden" );
}
