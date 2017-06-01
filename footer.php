<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cci_snap
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-row">
            <div class="footer-col">
                <div class="footer-logo-container"><a href="<?php bloginfo('url');?>">
                <img class="logo-footer" src="<?php echo get_template_directory_uri();?>/img/ccilogo.png"/>
                    </a>
                </div>
            </div>
            <div class="footer-col">
                <h2 class="footer-title">Contact Us</h2>
                <p class="footer-text">
                    Center for Care Innovations<br>
                    1438 Webster St. Suite 101,<br>
                    Oakland, CA 94612<br><br>
                    Phone 415.830.3020<br>
                    Fax 415.707.6988
                </p>
            </div>
        </div>
        <div class="footer-copyright">&copy; 2016 Center for Care Innovations</div>
        </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script id="dsq-count-scr" src="//cci-ddc.disqus.com/count.js" async></script>
</body>
</html>
