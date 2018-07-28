(function($) {

  /*
   * Accessible skip to content link
   */
  $(".skip").click(function(e) {
    e.preventDefault();
    $('#' + this.href.split('#')[1]).attr('tabindex', -1).on('blur focusout', function() {
      $(this).removeAttr('tabindex');
    }).focus();
  });

  /*
   * Share links open in a small popup window
   */
  $('.share-link').click(function(e) {
    e.preventDefault();
    window.open($(this).attr('href'), 'shareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
    return false;
  });


  $('.navbar-toggler').on('click', function(e) {
     var $target = $($(this).data('target'));
     $target.toggleClass('is-open d-block show');
  });



})(jQuery);
