$(document).ready(function() {
  // Change tab methods
  $("#tab-password").on("click", function() {
    if ( !$(this).parents("li").hasClass("is-active") ) {
      $(this).parents("li").addClass("is-active");
      $("#password").removeClass("is-hidden");
      $("#tab-add-user, #tab-list-users").parents("li").removeClass("is-active");
      $("#add-user, #list-users").addClass("is-hidden");
    }
  });
  $("#tab-list-users").on("click", function() {
    if ( !$(this).parents("li").hasClass("is-active") ) {
      $(this).parents("li").addClass("is-active");
      $("#list-users").removeClass("is-hidden");
      $("#tab-add-user, #tab-password").parents("li").removeClass("is-active");
      $("#add-user, #password").addClass("is-hidden");
    }
  });
  $("#tab-add-user").on("click", function() {
    if ( !$(this).parents("li").hasClass("is-active") ) {
      $(this).parents("li").addClass("is-active");
      $("#add-user").removeClass("is-hidden");
      $("#tab-password, #tab-list-users").parents("li").removeClass("is-active");
      $("#password, #list-users").addClass("is-hidden");
    }
  });
  // Select starter tab
  $("#tab-" + $("#tab-open").val() ).trigger("click");

  // Check new password validity
  $("#new-pw-1, #new-pw-2").on("change input", function() {
    if ( $(this).val().match(/^[A-Za-z0-9\_\-\?\$\(\)\#\@\.\=]{6,}$/) != null ) {
      $(this)
        .removeClass("is-success is-danger")
        .addClass("is-success");
    } else {
      $(this)
        .removeClass("is-success is-danger")
        .addClass("is-danger");
    }
    if ( $("#new-pw-1").val() == $("#new-pw-2").val() ) {
      $("#new-pw-1, #new-pw-2")
        .removeClass("is-success is-danger")
        .addClass("is-success");
    } else {
      $("#new-pw-1, #new-pw-2")
        .removeClass("is-success is-danger")
        .addClass("is-danger");
    }
  });
  // Send password change request
  $("#do-password").on("click", function() {
    // Disable button
    $(this)
      .addClass("is-loading")
      .prop("disabled", true);
    // Check data validity
    if ( $("#new-pw-1").val() != "" &&
         $("#new-pw-2").val() != "" &&
         $("#new-pw-1").val().match(/^[A-Za-z0-9\_\-\?\$\(\)\#\@\.\=]{6,}$/) != null &&
         $("#old-pw").val() != "" ) {
      // Build data array
      let data = {
        action: "password",
        new_1: $("#new-pw-1").val(),
        new_2: $("#new-pw-2").val(),
        old: $("#old-pw").val()
      };
      // Send data request
      send(data);
      // Empty old password field
      $("#old-pw").val("");
      // Reenable button
      $(this)
        .removeClass("is-loading")
        .prop("disabled", false);
    } else {
      // Note invalid request
      resetNotification( $("#notification") );
      $("#notification")
        .addClass("is-warning")
        .removeClass("is-hidden")
        .find("p").html("Please, fill <strong>all</strong> fields.");
      // Reenable button
      $(this)
        .removeClass("is-loading")
        .prop("disabled", false);
    }
  });

  // Send user ban request
  $("#users-ban").on("click", function() {
    // Disable button
    $("#users-ban, #users-unban, #users-delete")
      .addClass("is-loading")
      .prop("disabled", true);
    // Get ID of the user to ban
    let data = {
      action: "ban",
      id: $(this).attr("data-user-id")
    };
    // Send request
    send(data);
    // Reload page with GET data
    window.location.replace("setup.php?tab=list-users");
  });

  // Send user unban request
  $("#users-unban").on("click", function() {
    // Disable button
    $("#users-ban, #users-unban, #users-delete")
      .addClass("is-loading")
      .prop("disabled", true);
    // Get ID of the user to unban
    let data = {
      action: "unban",
      id: $(this).attr("data-user-id")
    };
    // Send request
    send(data);
    // Reload page with GET data
    window.location.replace("setup.php?tab=list-users");
  });

  // Send user delete request
  $("#users-delete").on("click", function() {
    // Disable button
    $("#users-ban, #users-unban, #users-delete")
      .addClass("is-loading")
      .prop("disabled", true);
    // Get ID of the user to ban
    let data = {
      action: "delete",
      id: $(this).attr("data-user-id")
    };
    // Send request
    send(data);
    // Reload page with GET data
    window.location.replace("setup.php?tab=list-users");
  });

  // Send new user creation request
  $("#do-add-user").on("click", function() {
    // Disable button
    $(this)
      .addClass("is-loading")
      .prop("disabled", true);
    // Check data validity
    if ( $("#user-username").val() != "" &&
         $("#user-email").val() != "" ) {
      // Build data array
      let data = {
        action: "add-user",
        username: $("#user-username").val(),
        email: $("#user-email").val()
      };
      // Send data request
      send(data);
      // Empty fields
      $("#user-username, #user-email").val("");
      // Reenable button
      $(this)
        .removeClass("is-loading")
        .prop("disabled", false);
    } else {
      // Note invalid request
      resetNotification( $("#notification") );
      $("#notification")
        .addClass("is-warning")
        .removeClass("is-hidden")
        .find("p").html("Please, fill <strong>all</strong> fields.");
      // Reenable button
      $(this)
        .removeClass("is-loading")
        .prop("disabled", false);
    }
  });
});

function send(data) {
  let reply = null;
  $.ajax({
    method: "GET",
    url: "do/setup.php",
    data: data
  })
    .done(function(r) { reply = r; })
    .fail(function(r) {
      resetNotification( $("#notification") );
      $("#notification")
        .addClass("is-danger")
        .removeClass("is-hidden")
        .find("p").html("We could not connect to the server.");
    })
    .always(function(r) {
      if ( r == "0" ) {
        resetNotification( $("#notification") );
        $("#notification")
          .addClass("is-success")
          .removeClass("is-hidden")
          .find("p").html("Done.");
      } else {
        resetNotification( $("#notification") );
        $("#notification")
          .addClass("is-danger")
          .removeClass("is-hidden")
          .find("p").html("The sent data was rejected.");
      }
    });
  return true;
}
