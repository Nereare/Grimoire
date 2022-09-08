$(document).ready(function() {
  // Start SimpleMDE markdown interface.
  let about = new SimpleMDE({
    element: $("#body")[0],
    spellChecker: false
  });

  // Save page
  $("#do").on("click", function() {
    // Disable button
    $(this)
      .addClass("is-loading")
      .prop("disabled", true);

    let data = {};
    // Check if we want to edit or create a page
    if ( $("#id").val() != "" ) {
      data["action"] = "edit";
      data["id"] = parseInt( $("#id").val() );
    } else {
      data["action"] = "create";
    }
    // Get profile data
    $data["first_name"]   = $("#firstname").val();
    $data["last_name"]    = $("#lastname").val();
    $data["location"]    = $("#location").val();
    $data["birth"]       = $("#birth").val();
    $data["header"]      = $("#header").val();
    $data["systems"]     = $("#systems").val();
    $data["gm"]          = $("#gm").val();
    $data["player"]      = $("#player").val();
    $data["homebrewer"]  = $("#homebrewer").val();
    $data["about"]       = about.value();
    // Send AJAX request
    send( data );
  });
});

function send(data) {
  let reply = null;
  $.ajax({
    method: "GET",
    url: "do/profiles.php",
    data: data
  })
    .done(function(r) { reply = r; })
    .fail(function(r) {
      resetNotification( $("#notification") );
      $("#notification")
        .addClass("is-danger")
        .removeClass("is-hidden")
        .find("p").html("We could not connect to the server.");
      // Reenable button
      $("#do")
        .removeClass("is-loading")
        .prop("disabled", false);
    })
    .always(function(r) {
      if ( r == "0" ) {
        resetNotification( $("#notification") );
        $("#notification")
          .addClass("is-success")
          .removeClass("is-hidden")
          .find("p").html("Profile saved.");
      } else {
        resetNotification( $("#notification") );
        $("#notification")
          .addClass("is-danger")
          .removeClass("is-hidden")
          .find("p").html("The sent data was rejected.");
        // Reenable button
        $("#do")
          .removeClass("is-loading")
          .prop("disabled", false);
      }
    });
  return true;
}
