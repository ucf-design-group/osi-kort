$(document).ready(function () {
  // Run function to make sure nav is setup for current viewport
  adjustNav();
  $(".menu-toggle").on("click", function(evt){
    $(".main-menu ul").slideToggle();
    evt.preventDefault();
  });
});

// Will adjust classes and properties to display the correct menu
var adjustNav = function(){
  if($(document).width() < 767){
    $("nav.main-menu").removeClass("full").addClass("compact");
    $(".compact-menu").css("display", "block");
    $(".main-menu ul").hide();
  }
  if($(document).width() > 767){
    $("nav.main-menu").removeClass("compact").addClass("full");
    $(".compact-menu").css("display", "none");
    $(".main-menu ul").show();
  }
}
// If the viewport is resized, re-evaluate which menu to display
$(window).resize(function() {
  adjustNav();
});