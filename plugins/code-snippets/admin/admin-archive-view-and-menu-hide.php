<?php

/**
 * Admin Archive View Hider/Menu
 *
 * Removes archived-categorized posts from the admin view and visitor view, and creates a subpage for admin to view only these archived posts.
 */
function exclude_category( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
	$query->set( 'cat', '-1145' );
	}
}
add_action( 'pre_get_posts', 'exclude_category' );

function exclude_category_posts( $query ) {
    if ( $query->is_main_query() && is_admin()) {
        if($_REQUEST['page_type']=="archived")
            $query->set( 'cat', '1145' );
        else
            $query->set( 'cat', '-1145' );
    }
}
add_filter( 'pre_get_posts', 'exclude_category_posts' );

add_action('admin_menu', 'add_custom_submenu_link');
function add_custom_submenu_link()
{
	add_posts_page( 'Archive', 'Archive', 'read', "&#47;wp-admin/edit.php?page_type=archived");
}
