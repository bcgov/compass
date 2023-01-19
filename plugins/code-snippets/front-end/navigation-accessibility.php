<?php

/**
 * Navigation Accessibility
 *
 * Adds accessibility features for navigation, including screen readers. Allows tabbing through the links within the navigational menu widgets and a scroll-to-top button function.
 */
add_action( 'wp_head', function () { ?>
<script>

(function($) {
	//helper function to set multiple attributes at once
function setAttributesAccess(el, attrs) {
    for(const key in attrs) {
        el.setAttribute(key, attrs[key]);
    }
}

/**

- Adds accessibility features of tab-indexing and aria-role link
- @returns rendered navigation bar items with proper indexing as selectable links
*/

function addAccessibility(className) {
	const navListItems = $(className);
	for(let each of navListItems){
		setAttributesAccess(each, {'tabindex': `0`});
	}
}
	
/**
 * Adds scroll-to-top functionality for ease and accessibility of navigation
**/
	
// Get the button:
// When the user scrolls down 2000px from the top of the document, show the button
 
function scrollTopButton(){
	let mybutton = document.getElementById("scroll-top-button");
	if(mybutton){
		window.onscroll = function() {scrollFunction()};
		mybutton.onclick = function() {
			window.scrollTo({ top: 0, behavior: 'smooth' });
		}
		function scrollFunction() {
			if (document.body.scrollTop > 2000 || document.documentElement.scrollTop > 2000) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
		}	
	}
}

//Checks for readiness and loads accessibility features once page loaded.

const readyAccess = (callback) => {
    if (document.readyState != "loading") callback()
    else document.addEventListener("DOMContentLoaded", callback)
    };
readyAccess(()=> {

	addAccessibility(".elementor-item");
	scrollTopButton();
	
})

})( jQuery );
</script>
<?php } );
