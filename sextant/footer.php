<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sextant
 */

?>

<footer class="footer" id="site-footer">
        <div class="row">
            <div class="col-md-4">
                <?php if ( is_active_sidebar( 'footer-left' ) ) : ?>
                    <div class="widget-area" role="complementary">
                        <?php dynamic_sidebar( 'footer-left' ); ?>
                    </div><!-- #primary-sidebar -->
                <?php endif; ?>

            </div>
            <div class="col-md-4">
                <?php if ( is_active_sidebar( 'footer-middle' ) ) : ?>
                    <div class="widget-area" role="complementary">
                        <?php dynamic_sidebar( 'footer-middle' ); ?>
                    </div><!-- #primary-sidebar -->
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <?php if ( is_active_sidebar( 'footer-right' ) ) : ?>
                    <div class="widget-area" role="complementary">
                        <?php dynamic_sidebar( 'footer-right' ); ?>
                    </div><!-- #primary-sidebar -->
                <?php endif; ?>
            </div>
        </div>
</footer>
</main>
</div>
</div>
<?php wp_footer(); ?>

</body>
</html>
