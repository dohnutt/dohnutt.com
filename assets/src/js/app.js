import "bootstrap/js/dist/util.js";
//import "bootstrap/js/dist/alert.js";
//import "bootstrap/js/dist/button.js";
import "bootstrap/js/dist/collapse.js";
//import "bootstrap/js/dist/dropdown.js";
//import "bootstrap/js/dist/modal.js";
//import "bootstrap/js/dist/scrollspy.js";
//import "bootstrap/js/dist/tab.js";
//import "bootstrap/js/dist/index.js";

document.documentElement.classList.remove('no-js');



/*
 * Light/dark mode
 */
if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
  console.log('🎉 Dark mode is supported');
}

const STORAGE_KEY = 'user-color-scheme';
const COLOR_MODE_KEY = '--color-mode';
const schemeToggleButton = document.querySelector('.js-scheme-toggle');
const schemeLabel = document.querySelector('.js-scheme-label');

const getCSSCustomProp = function (propKey) {
  let response = getComputedStyle(document.documentElement).getPropertyValue(propKey);

  if (response.length) {
    response = response.replace(/[\"\']/g, '').trim();
  }

  return response;
};

const applySetting = function (passedSetting) {
  let currentSetting = passedSetting || localStorage.getItem(STORAGE_KEY);

  if (currentSetting) {
    document.documentElement.classList.remove('light-mode', 'dark-mode');
    document.documentElement.classList.add(currentSetting+'-mode');
    setToggle(currentSetting);
  } else {
    document.documentElement.classList.remove('light-mode', 'dark-mode');
    document.documentElement.classList.add(getCSSCustomProp(COLOR_MODE_KEY)+'-mode');
    setToggle(getCSSCustomProp(COLOR_MODE_KEY));
  }
};

const setToggle = function (currentSetting) {
  let checkedVal = currentSetting === 'dark' ? true : false;
  let label = currentSetting === 'dark' ? '🌙' : '☀';
  schemeToggleButton.checked = checkedVal;
  schemeLabel.innerText = label;
};

const toggleSetting = function () {
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

schemeToggleButton.addEventListener('click', function (event) {
  applySetting(toggleSetting());
});

applySetting();



/*
 * Wrap all em and en dashes in `span.resize-dash`
 */
function wrapDashes() {
  var content = document.querySelector('.entry__content');
  content.innerHTML = content.innerHTML.replace(/\b(—|–|&ndash;|&mdash;)/g, '<span class="resize-dash">$1</span>')
}

wrapDashes();



/*
 * Toggle navbar
 */
$(document).click(function (event) {
  var _opened = $('.navbar-collapse').hasClass('show');

  if ( !$(event.target).closest('.navbar-collapse').length && !$(event.target).is('.navbar-collapse') && _opened === true ) {
    $('.navbar-collapse').collapse('toggle');
  }
});



/*
 * Accessible skip to content link
 */
document.querySelector('.js-a11y-skip').addEventListener('click', function (event) {

  event.preventDefault();

  var el = document.querySelector('#' + this.href.split('#')[1]);
  var removeElTabindex = function () {
    el.removeAttribute('tabindex');
  }

  el.setAttribute('tabindex', '-1');
  el.addEventListener('blur', removeElTabindex, false);
  el.addEventListener('focusout', removeElTabindex, false);
  el.focus();

});



/*
 * Open share links in a small popup window
 */
$('.share__link').click(function (event) {

  event.preventDefault();

  window.open(
    $(this).attr('href'),
    'shareWindow', 'height=450, width=550, top=' + ($(window).height() / 2 - 275) + ', left=' + ($(window).width() / 2 - 225) + ', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0'
  );

  return false;

});
