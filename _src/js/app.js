import "../scss/style.scss";

const defaultScheme = 'pink-light';


/**
 * Colour schemer
 */

if (window.matchMedia('(prefers-color-scheme)').media !== 'not all') {
	console.log('🎉 Dark mode is supported');
}

const SCHEME_COOKIE = 'doh_scheme';
let currentScheme = getCookie(SCHEME_COOKIE) || defaultScheme;

window.applyScheme = function (passedScheme) {
	passedScheme = passedScheme || defaultScheme;

	setCookie(SCHEME_COOKIE, passedScheme, 365);

	document.body.removeAttribute('data-scheme');
	document.body.setAttribute('data-scheme', passedScheme);

	document.querySelectorAll('[data-scheme].is-current-scheme').forEach(function (activeEl) {
		if (activeEl.classList.contains('schemer-button')) {
			activeEl.setAttribute('data-scheme', passedScheme);
		} else {
			activeEl.classList.remove('is-current-scheme');
		}
	})

	document.querySelectorAll('.scheme-button[value="'+ passedScheme +'"]').forEach(function (button) {
		button.parentElement.classList.add('is-current-scheme');
	});

	console.log('🤘 Scheme changed to ' + passedScheme);
}

document.querySelectorAll('.scheme-button').forEach(function (button) {
	button.addEventListener('click', function (e) {
		window.applyScheme(e.target.value);
	});
});


/**
 * Manipulate cookies
 */

function setCookie(name, value, days) {
    var expires = "";
	
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }

    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');

    for (var i=0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }

    return null;
}

function eraseCookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
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

// Apply cookie on load
applyScheme(currentScheme);