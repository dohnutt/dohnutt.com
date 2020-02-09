// @codekit-prepend "../packages/bootstrap/js/dist/util.js";
// @codekit-prepend "../packages/bootstrap/js/dist/alert.js";
// @codekit-prepend "../packages/bootstrap/js/dist/button.js";
// @codekit-prepend "../packages/bootstrap/js/dist/carousel.js";
// @codekit-prepend "../packages/bootstrap/js/dist/collapse.js";
// @codekit-prepend "../packages/bootstrap/js/dist/dropdown.js";
// @codekit-prepend "../packages/bootstrap/js/dist/modal.js";
// @codekit-prepend "../packages/bootstrap/js/dist/tooltip.js";
// @codekit-prepend "../packages/bootstrap/js/dist/popover.js";
// @codekit-prepend "../packages/bootstrap/js/dist/scrollspy.js";
// @codekit-prepend "../packages/bootstrap/js/dist/tab.js";
// @codekit-prepend "../packages/bootstrap/js/dist/index.js";


if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
  console.log('🎉 Dark mode is supported');
}


/*
 * Prevent Gravity Forms from being submitted twice
 *
$('.wpforms-form').submit(function(event) {
  $('.wpforms-submit', this).text('Processing, please wait...');
  $('.wpforms-submit', this).attr('disabled', 'disabled');
});
*/



/*
 * Accessible skip to content link
 */
$('.a11y-skip').click(function(event) {

  event.preventDefault();

  // strip the leading hash and declare the content we're skipping to
  var skipTo = '#' + this.href.split('#')[1];

  // Setting 'tabindex' to -1 takes an element out of normal tab flow but allows it to be focused via javascript
  $(skipTo).attr('tabindex', -1).on('blur focusout', function () {

    // when focus leaves this element, remove the tabindex attribute
    $(this).removeAttr('tabindex');

  }).focus(); // focus on the content container

});



/*
 * Open share links in a small popup window
 */
$('.share__link').click(function(event) {

  event.preventDefault();

  window.open(
    $(this).attr('href'),
    'shareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0'
  );

  return false;

});



$(window).load(function() {
  // stuff
});


$(window).resize(function() {
  // stuff
});


$(window).scroll(function() {
  // stuff
});
