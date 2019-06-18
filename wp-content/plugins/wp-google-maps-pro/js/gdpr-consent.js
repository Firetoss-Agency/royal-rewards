jQuery("button.wpgmza-api-consent").on("click", function(event) {
	document.cookie = "wpgmza-api-consent-given=true";
	window.location.reload();
});