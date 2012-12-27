// DOM ready
$(function() {

      // Create the dropdown base
      $("<select />").appendTo(".menu-wrapper");
      
      // Create default option "Go to..."
      $("<option />", {
       "selected": "selected",
       "value"   : "",
       "text"    : "Ir a..."
     }).appendTo(".menu-wrapper select");
      
      // Populate dropdown with menu items
      $("ul.nav li a").each(function() {
       var el = $(this);
       $("<option />", {
         "value"   : el.attr("href"),
         "text"    : el.text()
       }).appendTo(".menu-wrapper select");
     });
      
	   // To make dropdown actually work
	   // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
    $(".menu-wrapper select").change(function() {
      window.location = $(this).find("option:selected").val();
    });
  });
$(function(){
  $("iframe").each(function(){
    var ifr_source = $(this).attr('src');
    var wmode = "wmode=transparent";
    if(ifr_source.indexOf('?') != -1) $(this).attr('src',ifr_source+'&'+wmode);
    else $(this).attr('src',ifr_source+'?'+wmode);
  });
})

//Animacion de Galeria
$(function(){
  $('ul.photoGallery li a').hover(
    function () {
      $(this).children('img').stop(true, true).animate({
        opacity: 0.25
      });
    },
    function () {
      $(this).children('img').stop(true, true).animate({
        opacity:1
      });
    }
    );
})