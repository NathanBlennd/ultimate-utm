(function() {
	const selector =
		`[data-type="utm_campaign"],
		[data-type="utm_content"],
		[data-type="utm_medium"],
		[data-type="utm_source"],
		[data-type="utm_term"]`;

	document.querySelectorAll(selector).forEach((item) => {
		item.parentElement.style.display = 'none';
	});
})();
