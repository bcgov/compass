<?php

/**
 * Event Calendar Widget Customization
 * Used for the Insider Intranet portal
 *
 * Adds additional features to the event calendar widget and changes the layout to meet front-end design requirements.
 */
add_action(
  'tribe_template_after_include:events/v2/widgets/widget-events-list/event/date-tag',
  'my_action_add_inline_date',
  15,
  3
);
 
// Utilize the hook variables to get the events, find the dates, and echo the correct date format.
function my_action_add_inline_date( $file, $name, $template ) {
  // Get the event for reference
  $event = $template->get('event');
	
  $fulldatestart = sprintf(($event->dates->start->format( 'F j, Y h:i:s' )));
  $fulldateend = sprintf(($event->dates->end->format( 'F j, Y h:i:s' )));
	
  $datestart = sprintf(($event->dates->start->format( 'F j, Y' )));
  $dateend = sprintf(($event->dates->end->format( 'F j, Y' )));
	
  $shortdatestart = sprintf(($event->dates->start->format( 'F j, ' )));
  $shortdateend = sprintf(($event->dates->end->format( 'F j, ' )));
	
  $shortdatestartnoformat = sprintf(($event->dates->start->format( 'F j ' )));
	
  $timestart = sprintf(($event->dates->start->format( 'g:i a' )));
  $timeend = sprintf(($event->dates->end->format( 'g:i a' )));
	
  echo '<div class="widget-date-time-stamp">';
	
  if ($fulldatestart != $fulldateend) {
	  if ($datestart != $dateend) {
	  echo $shortdatestartnoformat;
	  echo ' - ';
	  echo $dateend;
	  } elseif($timestart == '12:00 am' && $timeend == '11:59 pm'){
		  echo $datestart;
	  }
	  else {
		  echo $shortdatestart;
		  echo $timestart;
		  echo ' - ';
		  echo $timeend;
	  }

  } else {
	  echo $datestart;
  }
	
  echo '</div>';
 

}
