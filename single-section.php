<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cci_snap
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		while ( have_posts() ) : the_post();
        ?>
            <div class="section-page" style="background-image:url(<?php 
                                    echo get_field('background_image');
                                    ?>);border-bottom:1em solid <?php the_field("section_color"); ?>
                                             ">
                <div class="section-top-row">
                    <div class="section-top-row-title" style="border-right: 0.20em solid <?php the_field("section_color");?>"><?php the_title(); ?></div>
                    <div class="section-top-row-description"><?php the_field("description"); ?></div>
                </div>
                
                <?php
                    if( have_rows('subsectionbuilder') ):
                ?>
                        <div class="section-page-nav">
                    
                            <?php
                            while ( have_rows('subsectionbuilder') ) : the_row();

                                ?>
                                <div class="subsection" style="border-top:0.35em solid <?php the_field("section_color"); ?>">
                                    <div class="subsection-col1">
                                        <div class="subsection-title"><?php the_sub_field('sub_section_title'); ?></div>
                                        <div class="subsection-description"><?php the_sub_field('sub_section_description'); ?></div>
                                    </div>
                                    <div class="subsection-col2">
                                        <?php if (have_rows('assetselection')) : ?>
                                        <ul class="subsection-nav">
                                            
                                            <?php while(have_rows('assetselection')) : the_row(); ?>
                                            <li>
                                                <?php
                                                $asset_obj = get_sub_field('asset');
                                                ?>
                                                <a href="<?php echo get_permalink($asset_obj->ID) ?>">
                                                    <div class="nav-icon-<?php echo get_field('digital_asset_type',$asset_obj); ?>"></div>
                                                <?php echo get_the_title($asset_obj); ?>
                                                </a>
                                            </li>
                                            <?php endwhile; ?>
                                            
                                        </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            
                            <?php

                            endwhile;
                            ?>
                        </div>
                <?php
                        endif;
                ?>

                
            </div>
            
        <?php 
		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
