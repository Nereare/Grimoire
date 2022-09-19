$(document).ready(function() {
  // Start SimpleMDE markdown interface.
  let body = new SimpleMDE({
    element: $("#body")[0]
  });

  // Save page
  $("#do").on("click", function() {
    // Disable button
    $(this)
      .addClass("is-loading")
      .prop("disabled", true);
    // Check required fields
    if ( $("#title").val() != "" && body.value() != "" ) {
      // If both title and body are set
      let data = {};
      // Check if we want to edit or create a page
      if ( $("#id").val() != "" ) {
        data["action"] = "edit";
        data["id"] = parseInt( $("#id").val() );
      } else {
        data["action"] = "create";
      }
      // Get target
      if ( $("#target").val() != "chapter" ) { data["target"] = "chapter"; }
      else { data["target"] = "book"; }
      // Get content
      if ( data["target"] == "chapter" ) {
        data["title"] = $("#title").val();
        data["book"] = parseInt( $("#book").val() );
        data["body"] = body.value();
        data["previous"] = parseInt( $("#previous").val() );
        data["next"] = parseInt( $("#next").val() );
      } else {
        data["title"] = $("#title").val();
      }
      // Send AJAX request
      send( data );
    } else {
      // If neither title nor body is set
      resetNotification( $("#notification") );
      $("#notification")
        .addClass("is-warning")
        .removeClass("is-hidden")
        .find("p").html("Please, fill both name/title and the contents.");
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
    url: "do/chapters.php",
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
          .find("p").html("Book/Chapter saved.");
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
