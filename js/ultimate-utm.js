(function() {
	var vars = {};
	window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function( m, key, value ) {
		vars[key] = value;
	});

	const terms = [
		'utm_source',
		'utm_medium',
		'utm_term',
		'utm_content',
		'utm_campaign',
	];

	const url = new URL(window.location.href);
	const params = new URLSearchParams(window.location.search)

	terms.forEach(function(v) {
		if( undefined === vars[v] ) {
			vars[v] = '';
		}

		if (typeof URLSearchParams !== 'undefined') {
			params.delete(v)
		}

		if( vars[v] != '' ) {
			Cookies.set(v, vars[v], { expires: 30 });
		}

		vars[v] = Cookies.get(v);

		let selector = 'input.'+v+',input[name="'+v+'"]'
		document.querySelectorAll(selector).forEach((item) => {
			if( vars[v] !== undefined ) {
				item.value = vars[v];
			}
		});

	});
	let url_string = `${url.origin}${url.pathname}?${params}`;
	if( url_string.endsWith("?") ) { url_string = url_string.substring( 0, url_string.length-1 ); }
	window.history.replaceState({}, document.title, url_string);
})();
