$(document).ready(function() {
  // Start SimpleMDE markdown interface.
  var simplemde = new SimpleMDE({
    element: $("#profile-about")[0],
    spellChecker: false
  });

  // Create random password for the database user
  $("#db-password").val( Math.random().toString(16).slice(-12) );

  // Check required values - username
  $("#user-username").on("input change", function() {
    $(this).removeClass("is-success is-warning is-danger is-info");
    if ( $(this).val().match(/^[A-Za-z][A-Za-z0-9_]{5,}$/) ) {
      $(this).addClass("is-success");
    } else {
      $(this).addClass("is-warning");
    }
  });

  // Check required values - email
  $("#user-email").on("input change", function() {
    $(this).removeClass("is-success is-warning is-danger is-info");
    if ( $(this).val().match(/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/) ) {
      $(this).addClass("is-success");
    } else {
      $(this).addClass("is-warning");
    }
  });

  // Check required values - password
  $("#user-password").on("input change", function() {
    $(this).removeClass("is-success is-warning is-danger is-info");
    if ( $(this).val().match(/^[A-Za-z0-9\_\-\?\$\(\)\#\@\.\=]{6,}$/) ) {
      $(this).addClass("is-success");
    } else {
      $(this).addClass("is-warning");
    }
  });

  // Set required fields to show red if empty.
  $(".required").on("input change", function() {
    if ( $(this).val() == "" ) { $(this).addClass("is-danger"); }
    else { $(this).removeClass("is-danger"); }
  });

  $("#install").on("click", function() {
    // Disable button
    $(this)
      .addClass("is-loading")
      .prop("disabled", true);

    // Retrieve values for ease of use.
    var mysql_username      = $("#mysql-username").val();
    var mysql_password      = $("#mysql-password").val();
    var db_name             = $("#db-name").val();
    var db_user             = $("#db-user").val();
    var db_password         = $("#db-password").val();
    var email_host          = $("#email-host").val();
    var email_port          = $("#email-port").val();
    var email_username      = $("#email-username").val();
    var email_password      = $("#email-password").val();
    var site_baseuri        = $("#site-baseuri").val();
    var site_name           = $("#site-name").val();
    var site_subtitle       = $("#site-subtitle").val();
    var site_admin_name     = $("#site-admin-name").val();
    var site_admin_email    = $("#site-admin-email").val();
    var user_username       = $("#user-username").val();
    var user_email          = $("#user-email").val();
    var user_password       = $("#user-password").val();
    var user_firstname      = $("#user-firstname").val();
    var user_lastname       = $("#user-lastname").val();
    var user_location       = $("#user-location").val();
    var user_birth          = $("#user-birth").val();
    var user_systems        = $("#user-systems").val();
    var user_about          = simplemde.value();
    var is_gm               = $("#is-gm").is(":checked");
    var is_player           = $("#is-player").is(":checked");
    var is_homebrewer       = $("#is-homebrewer").is(":checked");

    // Check required values - if they have any contents.
    var req_filled = true;
    $(".required").each(function() {
      if ( $(this).val() == "" ) {
        req_filled = false;
        $(this)
          .trigger("change")
          .focus();
      }
    });

    // Run AJAX query if all required fields were filled.
    if (req_filled) {
      var reply = null;
      // AJAX Request
      $.ajax({
        method: "GET",
        url: "do/install.php",
        data: {
          mysql_username       : mysql_username,
          mysql_password       : mysql_password,
          db_name              : db_name,
          db_user              : db_user,
          db_password          : db_password,
          email_host           : email_host,
          email_port           : email_port,
          email_username       : email_username,
          email_password       : email_password,
          site_baseuri         : site_baseuri,
          site_name            : site_name,
          site_subtitle        : site_subtitle,
          site_admin_name      : site_admin_name,
          site_admin_email     : site_admin_email,
          user_username        : user_username,
          user_email           : user_email,
          user_password        : user_password,
          user_firstname       : user_firstname,
          user_lastname        : user_lastname,
          user_location        : user_location,
          user_birth           : user_birth,
          user_systems         : user_systems,
          user_about           : user_about,
          is_gm                : is_gm,
          is_player            : is_player,
          is_homebrewer        : is_homebrewer
        }
      })
        .done( function(r) {
          reply = JSON.parse(r);
        })
        .always( function(r) {
          // Empty the results div.
          $("#result").html("");
          if (reply) {
            // Fill the result div with the replies from the server.
            for (var entry in reply) {
              if (reply.hasOwnProperty(entry)) {
                $("#result").append("<div class=\"notification is-" + reply[entry]["state"] + " is-light\"><h4 class=\"title is-5\">" + entry + ". " + reply[entry]["title"] + "</h4><p>" + reply[entry]["msg"] + "</p></div>");
              }
            }
            // Remove the loading effect from the button.
            $("#install")
              .removeClass("is-loading")
              .html("Done");
          } else {
            // Reply that there was an error.
            $("#result").append("<div class=\"notification is-danger is-light\"><p>Oopsie.</p></div>");
            // Re-enable the button, since there was an error.
            $("#install")
              .removeClass("is-loading")
              .prop("disabled", false);
          }
        });
    } else {
      // Re-enable button, if required fields weren't all filled.
      $(this)
        .removeClass("is-loading")
        .prop("disabled", false);
    }
  });
});
