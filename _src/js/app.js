import "../scss/style.scss";


/**
 * Light/dark mode
 */

if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
	console.log('🎉 Dark mode is supported');
}

const STORAGE_KEY = 'doh_theme';
const themeToggleButton = document.querySelector('.js-theme-toggle > a');
const themes = ['pink-light', 'pink-dark', 'teal-light', 'teal-dark'];

function applySetting(passedSetting) {
	let currentTheme = passedSetting || window.localStorage.getItem(STORAGE_KEY) || themes[0];

	document.body.removeAttribute('data-theme');
	document.body.setAttribute('data-theme', currentTheme);
}

function toggleSetting() {
	let currentTheme = window.localStorage.getItem(STORAGE_KEY) || themes[0];
	let currentThemeIndex = themes.indexOf(currentTheme) || 0;

	currentTheme = currentThemeIndex >= (themes.length - 1) ? themes[0] : themes[currentThemeIndex + 1];
	window.localStorage.setItem(STORAGE_KEY, currentTheme);
	console.log('😎 Theme changed to ' + currentTheme);
	
	return currentTheme;
}

themeToggleButton.addEventListener('click', function (event) {
	applySetting(toggleSetting());
});

applySetting();



/*
 * Wrap all em and en dashes in `span.resize-dash`
 */
function wrapDashes() {
	var content = document.querySelector('main');
	content.innerHTML = content.innerHTML.replace(/\b(—|–|&ndash;|&mdash;)/g, '<span class="resize-dash">$1</span>')
}

wrapDashes();