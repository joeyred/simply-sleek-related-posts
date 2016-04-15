jQuery(function($){

$(document).ready(function() {

  // Conditionally run this code if the widget exists on the page.
  if ( $( 'div.ssrp-related-post-widget' ) ) {

    function doneResizing() {


      // Get height of card in grid block.
      var cardHeight = $( '.ssrp-related-post' ).height();
      var cardHeightHalved = cardHeight / 2;
      // Get link text height
      var linkHeight = $( '.ssrp-read-more-link' ).height();

      var linkMargin = cardHeightHalved - linkHeight;

      // Inject the margin-top style
      $( '.ssrp-read-more-link' ).css({ 'margin-top': linkMargin + 'px' });

    }
    // Keep text vertically centered as viewport is adjusted
  	var id;
    $(window).resize(function() {
        clearTimeout(id);
        id = setTimeout(doneResizing, 0);
    });
    doneResizing();
  } // End of if statement.
});




}); // End of jQuery declaration
