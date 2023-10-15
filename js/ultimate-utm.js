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

	terms.forEach(function(v) {
		if( undefined === vars[v] ) {
			vars[v] = '';
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

})();
