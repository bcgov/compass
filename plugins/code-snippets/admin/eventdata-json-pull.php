<?php

/**
 * eventData JSON pull 
 *
 * Pulls the event data from the event calendar API, and converts it into a locally stored json file. This prevents mass api-calling on the front-end to manage the loading of event-data.
 * 
 * Includes actions to run this function manually as a page within the Events menu and dropdown menu.
 */
const EVENTS_DATA_URL = 'https://compass.gww.gov.bc.ca/wp-json/tribe/events/v1/events/?page=1&per_page=48&start_date=';
const EVENTS_JSON_PATH = '/bitnami/wordpress/wp-content/uploads/wes-2022/';

//gets the next 48 events starting from the prior month and stores in a local json file
function getFileEvents() {
    $eventsURL = EVENTS_DATA_URL;
	$date = date("Y-m-d",strtotime("-1 month"));
    $eventsURL .= $date;
    $response = wp_remote_get( $eventsURL );
    if (is_wp_error( $response ) ) {
		return;
    }
    $body = wp_remote_retrieve_body( $response );
	$data = json_decode( $body );
	return $data;
}
function saveJSON(){
	$eventsData = getFileEvents();
	file_put_contents(EVENTS_JSON_PATH . 'event-list.json', json_encode($eventsData));
}	


//adds the getEvents action as a shortcode to the Refresh Events Admin page
add_shortcode('getevents', 'saveJSON');

function add_to_events(){
	add_submenu_page('edit.php?post_type=tribe_events', 'Refresh Events', 'Refresh Events', 'manage_options','events-menu-refresh-events', 'admineventsrefresh');
}

function admineventsrefresh(){	
			?>
			<h1>
				<?php do_shortcode('[getevents]'); ?>
			</h1>
			<div class='notification'>
				<h2>Refresh Events</h2>
				<p>The events database has been updated!</p>
			</div>
		<?php
}

add_action('admin_menu', 'add_to_events');

//Adds a shortcut to the event admin bar to update the event database
function event_update($wp_admin_bar){
	$args = array(
		'id' => 'event-update',
		'title' => 'Refresh Events',
		'parent' => 'tribe-events',
		'href' => "edit.php?post_type=tribe_events&page=events-menu-refresh-events",
		'meta' => array(
			'class' => 'custom-button-class'
		)
	);
	$wp_admin_bar->add_node($args);
}

add_action('admin_bar_menu', 'event_update');


//Runs the Event Data Pull once a day
add_action( 'init', function () {

	$hook = 'run_snippet_daily';
	$args = array();

	if ( ! wp_next_scheduled( $hook, $args ) ) {
		wp_schedule_event( time(), 'daily', $hook, $args );
	}
});

add_action( 'run_snippet_daily', saveJSON());
