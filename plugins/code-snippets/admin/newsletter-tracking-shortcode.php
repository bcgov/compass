<?php

/**
 * Newsletter Pixel Shortcode
 *
 * Shortcode plugin for adding custom tracking to newsletters.
 * 
 * If given a newsletter name in arguments, will use this for tracking information. Otherwise defaults to basic newsletter tracking.
 * Customized tracker for each intranet site - requires setting the siteID based on the site's index in matomo.
 * 
 */
add_filter('mailpoet_newsletter_shortcode', 'mailpoet_custom_shortcode', 10, 6);

function mailpoet_custom_shortcode($shortcode, $newsletter, $subscriber, $queue, $newsletter_body, $arguments) {
  if (strpos($shortcode, '[custom:newslettertracking') !== 0) return $shortcode;

  if ($arguments){
	  
	  $newsletterName = implode("", $arguments);

	// full image src should be directly pulled from matomo and customized for the newsletter
	// See matomo FAQ for setup https://matomo.org/faq/how-to/faq_25454/
	  
	  $customPixel = '<img src="' . $newsletterName . '&action_name=Email%20opened&_rcn=internal%20email%20newsletter&_rck=' . $newsletterName . '" style="border:0;” alt="" />';
	  
	  return $customPixel;
	  
  } else {
	  
	  $pixelDefault = '<img src="' . '&action_name=Email%20opened&_rcn=internal%20email%20newsletter&_rck=newsletter_opened" style="border:0;” alt="" />';	
	  
	  return $pixelDefault;
	  
  }
}
