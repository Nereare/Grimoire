$(document).ready(function() {
  // Change tabs
  $("#animals").on("click", function() {
    if ( !$(this).parents("li").hasClass("is-active") ) {
      // Change tab displays
      $(this).parents("li").addClass("is-active");
      $("#plants, #monsters").parents("li").removeClass("is-active");
      // Change title and content div displays
      $("#title-animals, #tab-animals").removeClass("is-hidden");
      $("#title-plants, #title-monsters, #tab-plants, #tab-monsters").addClass("is-hidden");
    }
  });
  $("#plants").on("click", function() {
    if ( !$(this).parents("li").hasClass("is-active") ) {
      // Change tab displays
      $(this).parents("li").addClass("is-active");
      $("#animals, #monsters").parents("li").removeClass("is-active");
      // Change title and content div displays
      $("#title-plants, #tab-plants").removeClass("is-hidden");
      $("#title-animals, #title-monsters, #tab-animals, #tab-monsters").addClass("is-hidden");
    }
  });
  $("#monsters").on("click", function() {
    if ( !$(this).parents("li").hasClass("is-active") ) {
      // Change tab displays
      $(this).parents("li").addClass("is-active");
      $("#animals, #plants").parents("li").removeClass("is-active");
      // Change title and content div displays
      $("#title-monsters, #tab-monsters").removeClass("is-hidden");
      $("#title-animals, #title-plants, #tab-animals, #tab-plants").addClass("is-hidden");
    }
  });

  // Search animals
  $("#search-animals").on("input change", function() {
    let search = $(this).val();
    $(".animal").each(function() {
      if ( search == "" ) { $(this).removeClass("is-hidden"); }
      else {
        let terms = $(this).attr("data-search-terms").toLowerCase();
        if ( terms.includes(search) ) { $(this).removeClass("is-hidden"); }
        else { $(this).addClass("is-hidden"); }
      }
    });
  });

  // Search plants
  $("#search-plants").on("input change", function() {
    let search = $(this).val();
    $(".plant").each(function() {
      if ( search == "" ) { $(this).removeClass("is-hidden"); }
      else {
        let terms = $(this).attr("data-search-terms").toLowerCase();
        if ( terms.includes(search) ) { $(this).removeClass("is-hidden"); }
        else { $(this).addClass("is-hidden"); }
      }
    });
  });

  // Search monsters
  $("#search-monster-infos").on("input change", function() {
    let search = $(this).val();
    $(".monster").each(function() {
      if ( search == "" ) { $(this).removeClass("is-hidden"); }
      else {
        let terms = $(this).attr("data-search-terms").toLowerCase();
        if ( terms.includes(search) ) { $(this).removeClass("is-hidden"); }
        else { $(this).addClass("is-hidden"); }
      }
    });
  });
  $("#search-monster-stats").on("input change", function() {
    let search = $(this).val();
    $(".statblock").each(function() {
      if ( search == "" ) { $(this).removeClass("is-hidden"); }
      else {
        let terms = $(this).attr("data-search-terms").toLowerCase();
        if ( terms.includes(search) ) { $(this).removeClass("is-hidden"); }
        else { $(this).addClass("is-hidden"); }
      }
    });
  });
});
