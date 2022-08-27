$(document).ready(function() {
  console.log("App ready!");

  // Get search parameter
  let searchParams = new URLSearchParams(window.location.search)
  let search = searchParams.get("text");

  // Get searchable fields
  let fields = null;
  let results = [];
  let unique_results = [];
  $.getJSON("/search.json")
    .done(function(json) {
      console.log("Got searchable fields.");
      fields = json;
    })
    .fail(function() {
      console.log("There was a problem retrieving searchable fields.");
    })
    .always(function() {
      console.log("Begining search...");
      // Parse it there is any results
      $.each(fields, function(index, value) {
        if ( value["title"].toLowerCase().includes( search ) ||
             value["date"].toLowerCase().includes( search ) ||
             value["content"].toLowerCase().includes( search ) ) {
          results.push( index );
        }
      });
      // Remove duplicate results
      unique_results = results.filter( onlyUnique );
      // Check if there are any results
      if ( unique_results.length > 0 ) {
        $.each(unique_results, function(index, value) {
          let link = $("<a>");
          link.html( fields[value]["title"] );
          link.attr("href", fields[value]["url"]);
          let strong = $("<strong>");
          strong.append( link );
          let span = $("<span>");
          let date = new Date( fields[value]["date"] );
          let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
          span.html( " (" + date.toLocaleDateString("en-US", options) + ")" );
          let result = $("<li>");
          result.append( strong );
          result.append( span );
          $("#results").append( result );
        });
      } else {
        let meh = $("<li>").html("No results were found...");
        $("#results").append( meh );
      }
    });
});

function onlyUnique(value, index, self) {
  return self.indexOf(value) === index;
}
