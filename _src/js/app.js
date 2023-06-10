import "../scss/style.scss";


/**
 * Colour schemer
 */

if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
	console.log('🎉 Dark mode is supported');
}

const STORAGE_KEY = 'doh_scheme';
const schemeToggleButton = document.querySelector('.js-scheme-toggle > a');
const schemes = ['pink-light', 'pink-dark', 'teal-light', 'teal-dark'];

function applySetting(passedSetting) {
	let currentScheme = passedSetting || window.localStorage.getItem(STORAGE_KEY) || schemes[0];

	document.body.removeAttribute('data-scheme');
	document.body.setAttribute('data-scheme', currentScheme);
}

function toggleSetting() {
	let currentScheme = window.localStorage.getItem(STORAGE_KEY) || schemes[0];
	let currentSchemeIndex = schemes.indexOf(currentScheme) || 0;

	currentScheme = currentSchemeIndex >= (schemes.length - 1) ? schemes[0] : schemes[currentSchemeIndex + 1];
	window.localStorage.setItem(STORAGE_KEY, currentScheme);
	console.log('😎 Scheme changed to ' + currentScheme);
	
	return currentScheme;
}

schemeToggleButton.addEventListener('click', function (event) {
	event.preventDefault();
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