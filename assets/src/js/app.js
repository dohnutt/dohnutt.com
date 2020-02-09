// @codekit-prepend "../packages/bootstrap/js/dist/util.js";
// @codekit-prepend "../packages/bootstrap/js/dist/alert.js";
// @codekit-prepend "../packages/bootstrap/js/dist/button.js";
// @codekit-prepend "../packages/bootstrap/js/dist/collapse.js";
// @codekit-prepend "../packages/bootstrap/js/dist/dropdown.js";
// @codekit-prepend "../packages/bootstrap/js/dist/modal.js";
// @codekit-prepend "../packages/bootstrap/js/dist/scrollspy.js";
// @codekit-prepend "../packages/bootstrap/js/dist/tab.js";
// @codekit-prepend "../packages/bootstrap/js/dist/index.js";

document.documentElement.classList.remove('no-js');

if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
  console.log('🎉 Dark mode is supported');
}

const STORAGE_KEY = 'user-color-scheme';
const COLOR_MODE_KEY = '--color-mode';
const schemeToggleButton = document.querySelector('.js-scheme-toggle');
const schemeStatus = document.querySelector('.js-scheme-status');

const getCSSCustomProp = propKey => {
  let response = getComputedStyle(document.documentElement).getPropertyValue(propKey);

  if (response.length) {
    response = response.replace(/\"/g, '').trim();
  }

  return response;
};

const applySetting = passedSetting => {
  let currentSetting = passedSetting || localStorage.getItem(STORAGE_KEY);

  if (currentSetting) {
    document.documentElement.classList.remove('light-mode', 'dark-mode');
    document.documentElement.classList.add(currentSetting+'-mode');
    setToggle(currentSetting);
  } else {
    setToggle(getCSSCustomProp(COLOR_MODE_KEY));
  }
};

const setToggle = currentSetting => {
  let checkedVal = currentSetting === 'light' ? false : true;
  schemeToggleButton.checked = checkedVal;
  schemeStatus.innerText = currentSetting.charAt(0).toUpperCase() + currentSetting.slice(1);
  //console.log(`Color mode is now "${currentSetting}" "${checkedVal}"`);
};

const toggleSetting = () => {
  let currentSetting = localStorage.getItem(STORAGE_KEY);

  switch (currentSetting) {
    case null:
      currentSetting = getCSSCustomProp(COLOR_MODE_KEY) === 'dark' ? 'light' : 'dark';
      break;
    case 'light':
      currentSetting = 'dark';
      break;
    case 'dark':
      currentSetting = 'light';
      break;
  }

  localStorage.setItem(STORAGE_KEY, currentSetting);

  return currentSetting;
};

schemeToggleButton.addEventListener('click', event => {
  //event.preventDefault();

  applySetting(toggleSetting());
});

applySetting();




$(document).click(function (e) {
  var _opened = $('.navbar-collapse').hasClass('show');

  if ( !$(e.target).closest('.navbar-collapse').length && !$(e.target).is('.navbar-collapse') && _opened === true ) {
    $('.navbar-collapse').collapse('toggle');
  }
});


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
