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
      // Get plant data
      data["title"]        = $("#title").val();
      data["domain"]       = $("#domain").val();
      data["kingdom"]      = $("#kingdom").val();
      data["clade"]        = $("#clade").val();
      data["order"]        = $("#order").val();
      data["suborder"]     = $("#suborder").val();
      data["family"]       = $("#family").val();
      data["subfamily"]    = $("#subfamily").val();
      data["genus"]        = $("#genus").val();
      data["species"]      = $("#species").val();
      data["subspecies"]   = $("#subspecies").val();
      data["feeding"]      = $("#feeding").val();
      data["size_type"]    = $("#size_type").val();
      data["size_unit"]    = $("#size_unit").val();
      data["size_min"]     = $("#size_min").val();
      data["size_max"]     = $("#size_max").val();
      data["weight_unit"]  = $("#weight_unit").val();
      data["weight_min"]   = $("#weight_min").val();
      data["weight_max"]   = $("#weight_max").val();
      data["habitat"]      = $("#habitat").val();
      data["home_plane"]   = $("#home_plane").val();
      data["iucn"]         = $("#iucn").val();
      data["domestic"]     = $("#domestic").val();
      data["notes"]        = $("#notes").val();
      data["body"]         = body.value();
      // Send AJAX request
      send( data );
    } else {
      // If neither title nor body is set
      resetNotification( $("#notification") );
      $("#notification")
        .addClass("is-warning")
        .removeClass("is-hidden")
        .find("p").html("Please, fill both title and contents, at least.");
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
    url: "do/plants.php",
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
          .find("p").html("Page saved.");
      } else {
        resetNotification( $("#notification") );
        $("#notification")
          .addClass("is-danger")
          .removeClass("is-hidden")
          .find("p").html("The sent data was rejected.");
      }
      // Reenable button
      $("#do")
        .removeClass("is-loading")
        .prop("disabled", false);
    });
  return true;
}
