import "../scss/style.scss";


/**
 * Light/dark mode
 */

if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
	console.log('🎉 Dark mode is supported');
}

const STORAGE_KEY = 'doh-theme';

const applySetting = function (passedSetting) {
	let currentSetting = passedSetting || localStorage.getItem(STORAGE_KEY) || 'teal-light';

	document.documentElement.classList.remove('teal-light', 'teal-dark');
	document.documentElement.classList.add('teal-' + currentSetting);
	setToggle(currentSetting);
};

const setToggle = function (currentSetting) {
	let checkedVal = currentSetting === 'dark' ? true : false;
	let label = currentSetting === 'dark' ? '🌙' : '☀';
	let ariaLabel = currentSetting === 'dark' ? 'Dark mode' : 'Light mode';
	schemeToggleButton.checked = checkedVal;
	schemeLabel.innerText = label;
	schemeLabel.setAttribute('aria-label', ariaLabel);
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