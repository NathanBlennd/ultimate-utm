jQuery(function($) {
	var vars = {};
	window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function( m, key, value ) {
		vars[key] = value;
	});
	
	$.each([ 'utm_source', 'utm_medium', 'utm_term', 'utm_content', 'utm_campaign' ], function( i, v ) {
		if( undefined == vars[v] ) {
			vars[v] = '';
		}

		if( vars[v] != '' ) {
			Cookies.remove(v);
			Cookies.set(v, vars[v], { expires: 30 });
		}

		vars[v] = Cookies.get(v);

		$('input[name=\"'+v+'\"]').val(vars[v])
		$('input#'+v).val(vars[v])
		$('input.'+v).val(vars[v])

	});

});
