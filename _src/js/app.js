import "../scss/style.scss";


/**
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
	let currentSetting = passedSetting || localStorage.getItem(STORAGE_KEY) || getCSSCustomProp(COLOR_MODE_KEY);

	document.documentElement.classList.remove('light-mode', 'dark-mode');
	document.documentElement.classList.add(currentSetting + '-mode');
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