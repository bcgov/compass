<?php

/**
 * Matomo Tracking Script
 *
 * This is the tracking script used to provide analytics to the Matomo Dashboard.
 * 
 * Customized tracker for each intranet site - requires setting the siteID based on the site's index in matomo.
 */
//Checks for current access level - signed in as user with admin or editor access
if( current_user_can('editor') === false && current_user_can('administrator') === false ) { 
add_action( 'wp_head', function () { ?>
<!-- Matomo -->
<script>
	var _paq = window._paq = window._paq || [];
	/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
	_paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
	_paq.push(["setCookieDomain", "*.compass.gww.gov.bc.ca"]);
	_paq.push(['trackPageView']);
	_paq.push(['enableLinkTracking']);
	(function() {
		var u="//gww.gov.bc.ca/analytics/";
		_paq.push(['setTrackerUrl', u+'matomo.php']);
		_paq.push(['setSiteId', '2']);
		var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
		g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
	})();
</script>
<!-- End Matomo Code -->
<?php } );
}
