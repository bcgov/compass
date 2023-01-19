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




<header id="masthead" class="site-header">

    <nav id="header-navbar" class="navbar navbar-expand-lg">

    <div class="navbar-collapse collapse" id="corenNavbar">

    </div>
        <div class="navbar-nav ml-auto">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control" id="topsearchbar" type="search" placeholder="Search" aria-label="Search">
            </form>
            <button id="events-toggle" class="navButton rightnavButton" data-toggle="collapse" data-target="#events-container"><img class="navIcon"src="<?= get_template_directory_uri() ?>/img/icon-calendar.svg"></button>
            <button id="mintranets-toggle" class="navButton rightnavButton" data-toggle="collapse" data-target="#mintranets-container"><img class="navIcon"src="<?= get_template_directory_uri() ?>/img/icon-mintranets.svg"></button>
            <button id="externals-toggle" class="navButton rightnavButton" data-toggle="collapse" data-target="#externals-container"><img class="navIcon"src="<?= get_template_directory_uri() ?>/img/icon-links.svg"></button>
        </div>
</nav>

    <div id="site-brand">
        <a class="navbar-brand" href="#"><?= the_custom_logo();?></a>
    </div>
<div class="collapse show" id="left-nav-container" >
    <?php if ( is_active_sidebar( 'left-nav' ) ) : ?>
        <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
            <?php dynamic_sidebar( 'left-nav' ); ?>
        </div><!-- #primary-sidebar -->
    <?php endif; ?>
</div>

<div class="collapse hidden-panel" id="events-container" >
    <?php if ( is_active_sidebar( 'events-menu' ) ) : ?>
        <div class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'events-menu' ); ?>
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


<div class="collapse hidden-panel" id="externals-container" >
    <?php if ( is_active_sidebar( 'externals' ) ) : ?>
        <div class="widget-area" role="complementary">
            <?php dynamic_sidebar( 'externals' ); ?>
        </div><!-- #primary-sidebar -->
    <?php endif; ?>
</div>

</header>

<div class="container-fluid" id="site-content">

