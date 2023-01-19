<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sextant
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Navbar -->



<nav class="navbar navbar-light sticky-top flex-md-nowrap p-0 bg-white shadow" id="site-nav">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="<?= get_home_url(); ?>"><img src="<?= esc_url( wp_get_attachment_url( get_theme_mod( 'custom_logo' ) ) ); ?>" alt="Compass, the corporate intranet for the BC public service"></a>

    <?php if ( is_active_sidebar( 'mobile-menu' ) ) : ?>
        <div class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'mobile-menu' ); ?>
        </div><!-- #primary-sidebar -->
    <?php endif; ?>

    <form method="get" class="col-md-3 float-right" action="<?= get_home_url('/'); ?>">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search" name="s" aria-label="search">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit" id="search-button">Search</button>
            </div>
        </div>
    </form>

    <div id="panel-buttons">
    
		
		 <span class="button-wrapper" data-toggle="tooltip" data-placement="bottom" title="Intranets">
            <button id="mintranets-toggle" class="navButton rightnavButton" data-toggle="collapse" data-target="#mintranets-container"><span class="panel-button-text">Other Intranets</span></button>
        </span>
		
	
		
      
		
        <span class="button-wrapper" data-toggle="tooltip" data-placement="bottom" title="IM/IT, Privacy, &amp; Security">
            <button id="infotech-toggle" class="navButton rightnavButton" data-toggle="collapse" data-target="#infotech-container"><span class="panel-button-text">I.M.I.T., Privacy and Security</span></button>
        </span>
		
	

		  <span class="button-wrapper" data-toggle="tooltip" data-placement="bottom" title="HR &amp; Finance Resources">
        <button id="externals-toggle" class="navButton rightnavButton" data-toggle="collapse" data-target="#externals-container"><span class="panel-button-text">HR and Finance Resources</span></button>
        </span>
		
	
	
       

		<span class="button-wrapper" data-toggle="tooltip" data-placement="bottom" title="Events Calendar">
            <button id="events-toggle" class="navButton rightnavButton" data-toggle="collapse" data-target="#events-container"><span class="panel-button-text">Events Calendar</span></button>
        </span>
	
		
    </div>
</nav>
<!-- Navbar Panels -->


		<div class="collapse hidden-panel" id="externals-container" >
    <?php if ( is_active_sidebar( 'externals' ) ) : ?>
        <div class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'externals' ); ?>
        </div><!-- #primary-sidebar -->
    <?php endif; ?>
</div>
	
	<div class="collapse hidden-panel" id="mintranets-container">
    <?php if ( is_active_sidebar( 'mintranets' ) ) : ?>
        <div class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'mintranets' ); ?>
        </div><!-- #primary-sidebar -->
    <?php endif; ?>
</div>
	
		<div class="collapse hidden-panel" id="infotech-container">
    <?php if(is_active_sidebar('infotech') ) : ?>
        <div class="widget_area" role="complementary">
            <?php dynamic_sidebar('infotech'); ?>
        </div>
    <?php endif; ?>
</div>
	
	
		<div class="collapse hidden-panel" id="events-container" >
    <?php if ( is_active_sidebar( 'events-menu' ) ) : ?>
        <div class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'events-menu' ); ?>
        </div><!-- #primary-sidebar -->
    <?php endif; ?>
</div>







<!-- Content with side nav -->

<div class="container-fluid">
    <div class="row">

        <div id="sidebarMenu" class="col-md-3 col-lg-2 m-0 px-0 d-md-block bg-light sidebar">
            <div class="sidebar-sticky pt-4">
				<div class="site-navigation" role="navigation" aria-label="Site Navigation" tabindex="0">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) ); ?>
				</div>
				
                <?php if ( is_active_sidebar( 'left-nav' ) ) : ?>
                    <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                        <?php dynamic_sidebar( 'left-nav' ); ?>
                    </div><!-- #primary-sidebar -->
                <?php endif; ?>
            </div>
        </div>
        <main role="main" class="col-md-9 px-0 col-lg-10">






