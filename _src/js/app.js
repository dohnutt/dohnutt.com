import "../scss/style.scss";

const defaultScheme = 'pink-light';


/**
 * Colour schemer
 */

if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
	console.log('🎉 Dark mode is supported');
}

const SCHEME_STORAGE_KEY = 'doh_scheme';
let currentScheme = window.localStorage.getItem(SCHEME_STORAGE_KEY) || defaultScheme;

function applySetting(passedScheme) {
	passedScheme = passedScheme || defaultScheme;

	window.localStorage.setItem(SCHEME_STORAGE_KEY, passedScheme);

	document.body.removeAttribute('data-scheme');
	document.body.setAttribute('data-scheme', passedScheme);

	document.querySelectorAll('[data-scheme].is-current-scheme').forEach(function (activeEl) {
		if (activeEl.classList.contains('schemer-button')) {
			activeEl.setAttribute('data-scheme', passedScheme);
		} else {
			activeEl.classList.remove('is-current-scheme');
		}
	})

	document.querySelectorAll('input[name="scheme"][value="'+ passedScheme +'"').forEach(function (input) {
		input.setAttribute('checked', 'checked');
		input.parentElement.parentElement.classList.add('is-current-scheme');
	});

	console.log('🤘 Scheme changed to ' + passedScheme);
}


/*
* Wrap all em and en dashes in `span.resize-dash`
*/
function wrapDashes() {
	var content = document.querySelector('main');
	if (content) {
		content.innerHTML = content.innerHTML.replace(
			/\b(—|–|&ndash;|&mdash;)/g,
			'<span class="resize-dash">$1</span>'
		);
	}
	
}


// Wrap dashes on load
wrapDashes();

// Apply local storage setting on load
applySetting(currentScheme);