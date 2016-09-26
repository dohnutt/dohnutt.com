//@prepros-prepend ../bower_components/bootstrap/js/dist/alert.js
//@prepros-prepend ../bower_components/bootstrap/js/dist/button.js
//@prepros-prepend ../bower_components/bootstrap/js/dist/carousel.js
//@prepros-prepend ../bower_components/bootstrap/js/dist/collapse.js
//@prepros-prepend ../bower_components/bootstrap/js/dist/dropdown.js
//@prepros-prepend ../bower_components/bootstrap/js/dist/modal.js
//@prepros-prepend ../bower_components/tether/dist/js/tether.min.js
//@prepros-prepend ../bower_components/bootstrap/js/dist/tooltip.js
//@prepros-prepend ../bower_components/bootstrap/js/dist/popover.js
//@prepros-prepend ../bower_components/bootstrap/js/dist/scrollspy.js
//@prepros-prepend ../bower_components/bootstrap/js/dist/tab.js
//@prepros-prepend ../bower_components/bootstrap/js/dist/util.js

(function($) {
  /*
   * Prevent Gravity Forms from being submitted twice
   */
  var gformSubmitted = false;
  $(".gform_wrapper form").submit(function(event) {
    $(".gform_button", this).text("Processing, please wait...");
    $(".gform_button", this).attr('disabled', 'disabled');
  });

  /*
   * Accessible skip to content link
   */
  $(".skip").click(function(event){
    // strip the leading hash and declare the content we're skipping to
    event.preventDefault();
    var skipTo="#"+this.href.split('#')[1];
    // Setting 'tabindex' to -1 takes an element out of normal tab flow but allows it to be focused via javascript
    $(skipTo).attr('tabindex', -1).on('blur focusout', function () {
      // when focus leaves this element, remove the tabindex attribute
      $(this).removeAttr('tabindex');
    }).focus(); // focus on the content container
  });

  /*
   * Share links open in a small popup window
   */
  $('.share-link').click(function(e) {
    e.preventDefault();
    window.open($(this).attr('href'), 'shareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
    return false;
  });
})(jQuery);
