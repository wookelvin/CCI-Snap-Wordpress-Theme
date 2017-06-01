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
		while ( have_posts() ) : the_post(); ?>
            
            <article id="post-asset-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="entry-content">
                    
                    <?php 
                    $sections = get_posts(
                        array(
                            'post_type'	=> 'section',
                            /*'meta_query' => array(
                                    'key' => 'subsectionbuilder_%_assetselection',
                                    'value' => get_the_ID(),
                                    'compare' => '='*/
                            )
                    );
                    $thesection = null;
                    foreach ($sections as $section){
                        if (have_rows('subsectionbuilder', $section)){
                            while (have_rows('subsectionbuilder', $section)){
                                the_row();
                                if (have_rows('assetselection')) {
                                    while(have_rows('assetselection')) { the_row(); 
                                                                        $asset_obj = get_sub_field('asset');
                                                                        if (get_the_ID() == $asset_obj->ID){
                                                                          $thesection = $section;   
                                                                        }
                                                                       }
                                }
                                
                            }
                        }
                    }
                    
                    
                    //echo $thesection->ID;
                    
                    $prev_subsection = null;
                    $curr_subsection = null;
                    $next_subsection = null;
                    
                    $foundcurr = 0;
                    $foundnext = 0;
                    $rows = null;
                    $next_section_firstasset = null;
                    $prev_section_firstasset = null;
                    $curr_section_firstasset = null;
                    
                    $nav = "";
                    
                    if( have_rows('subsectionbuilder', $thesection) ):
                        while ( have_rows('subsectionbuilder',$thesection) && $foundnext == 0) : the_row();
                            
                    
                            if ($foundcurr == 0){
                                $nav = "";
                                $prev_subsection = $curr_subsection;
                                $curr_subsection = get_sub_field('sub_section_title');
                                $prev_section_firstasset = $curr_section_firstasset;
                                $curr_section_firstasset = null;
                            }else{
                                $foundnext = 1;
                                $next_subsection = get_sub_field('sub_section_title');
                                
                                
                            }
                    
                            if (have_rows('assetselection')) : 
                                while(have_rows('assetselection')) : the_row(); 
                                    $asset_obj = get_sub_field('asset');
                                    if (!($curr_section_firstasset)){
                                        $curr_section_firstasset = get_permalink($asset_obj->ID);
                                    }
                                    if ($foundnext == 0){
                                        
                                        if ($asset_obj->ID == get_the_ID())
                                        {
                                            $nav .= '<li class="current-item"><a href="'.get_permalink($asset_obj->ID).'">';    
                                        }else{
                                            $nav .= "<li><a href=\"".get_permalink($asset_obj->ID)."\">";    
                                        }
                                        $nav .= '<div class="nav-icon nav-icon-'.get_field('digital_asset_type',$asset_obj).'"></div>';       
                                        $nav .= '<div class="asset-nav-title">'.get_the_title($asset_obj->ID)."</div></a></li>";
                                    }
                                    
                                    if (!($next_section_firstasset) && ($foundnext == 1 )){
                                        $next_section_firstasset = get_permalink($asset_obj->ID);
                                        
                                    }
                    
                                    if (get_the_ID() == $asset_obj->ID){
                                        $foundcurr = 1;
                                    }
                                endwhile;
                            endif;
                        endwhile;
                    endif;

                    ?>
                <div class="asset-banner fullwidth">
                    <div class="asset-nav" style="background-color:<?php the_field('section_color',$thesection); ?>">
                        <?php if ($prev_subsection): ?>
                        <div class="asset-nav-prev-subsection">
                            <a href="<?php echo $prev_section_firstasset; ?>">
                            <?php echo $prev_subsection ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <div class="asset-nav-curr-subsection">
                            <h1 class="asset-nav-section-title"><a href="<?php echo get_permalink($thesection);?>"><?php echo $curr_subsection; ?></a></h1>
                            <?php if ($nav != ""): ?>
                            <ul class="asset-nav-section-list">
                                <?php echo $nav; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                        <?php if ($next_subsection): ?>
                        <div class="asset-nav-next-subsection"><a href="<?php echo $next_section_firstasset; ?>"><?php echo $next_subsection;?></a></div>
                        <?php endif; ?>
                    </div>
                    <?php if (get_field('main_banner_type')=='mov'): ?>
                    <div class="asset-banner-content"><div class="embed-container">
                        
                        <?php 
                            $vimeo_link = get_field('main_banner_movie_source',false,false); 
                            preg_match ("/(\d+)/",$vimeo_link,$matches);
                            $video_num= $matches[0];
                        ?>

                        
                        
                        <iframe src="https://player.vimeo.com/video/<?php echo $video_num;?>?title=0&byline=0&portrait=0" width="640" height="330" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="asset-banner-content" style="background-image:url(<?php 
                                                             $mainbannerimg = get_field('main_banner_image_source');
                                                             echo $mainbannerimg['url'];?>">
                    </div>
                    <?php endif; ?>
                
                </div>
                
                <div class="asset-main-section">
                    <div class="inner-page-width">
                        <div class="asset-main-section-col1">
                            <div class="asset-main-bigsection" style="border-bottom-color:<?php the_field('section_color',$thesection);?>"><?php echo get_the_title($thesection);?></div>
                            <div class="asset-main-asset-title"><?php the_title(); ?></div>
                            
                            
                            <?php 
                            $file1 = get_field('attachment_1');
                            $file2 = get_field('attachment_2');
                            $file3 = get_field('attachment_3');
                            $file4 = get_field('attachment_4');
                            
                            function icon_filetype ($fname){
                                if (preg_match("/pdf$/i",$fname)){echo get_template_directory_uri()."/img/download-icon-pdf.svg";}
                                elseif (preg_match("/xlsx$/i",$fname)){echo get_template_directory_uri()."/img/download-icon-xls.svg";}
                                elseif (preg_match("/pptx$/i",$fname)){echo get_template_directory_uri()."/img/download-icon-ppt.svg";}
                                elseif (preg_match("/mov$/i",$fname)){echo get_template_directory_uri()."/img/download-icon-mov.svg";}
                                elseif (preg_match("/link$/i",$fname)){echo get_template_directory_uri()."/img/download-icon-link.svg";}
                                
                                    
                            };
                            
                            function desc_filetype($fname){
                                if (preg_match("/pdf$/i",$fname)){echo "DOWNLOAD PDF";}
                                elseif (preg_match("/xlsx$/i",$fname)){echo "DOWNLOAD XLS";}
                                elseif (preg_match("/pptx$/i",$fname)){echo "DOWNLOAD PPT";}
                                elseif (preg_match("/mov$/i",$fname)){echo "DOWNLOAD MOV";}
                                
                            };
                            
                            ?>
                            
                            <?php if ($file1): ?>
                            <a href="<?php echo $file1['url']; ?>">
                            <div class="asset-main-download-attachment-container">
                                <div class="asset-main-download-attachment-icon" 
                                     style="background-image:url(<?php icon_filetype($file1['url']); ?>);">
                                </div>
                                <div class="asset-main-download-name"><h1 class="asset-main-download-title"><?php echo $file1['title']; ?></h1><p class="asset-main-download-text"><?php desc_filetype($file1['url']); ?></p></div>
                            </div>
                            </a>
                            <?php endif; ?>
                            
                            <?php if ($file2): ?>
                            <a href="<?php echo $file2['url']; ?>">
                            <div class="asset-main-download-attachment-container">
                                <div class="asset-main-download-attachment-icon" style="background-image:url(<?php icon_filetype($file2['url']); ?>"></div>
                                <div class="asset-main-download-name"><h1 class="asset-main-download-title"><?php echo $file2['title']; ?></h1><p class="asset-main-download-text"><?php desc_filetype($file2['url']); ?></p></div>
                            </div>
                            </a>
                            <?php endif; ?>
                            
                            <?php if ($file3): ?>
                            <a href="<?php echo $file3['url']; ?>">
                            <div class="asset-main-download-attachment-container">
                                <div class="asset-main-download-attachment-icon" style="background-image:url(<?php icon_filetype($file3['url']); ?>"></div>
                                <div class="asset-main-download-name"><h1 class="asset-main-download-title"><?php echo $file3['title']; ?></h1><p class="asset-main-download-text"><?php desc_filetype($file3['url']); ?></p></div>
                            </div>
                            </a>
                            <?php endif; ?>
                            
                            <?php if ($file4): ?>
                            <a href="<?php echo $file4['url']; ?>">
                            <div class="asset-main-download-attachment-container">
                                <div class="asset-main-download-attachment-icon" style="background-image:url(<?php icon_filetype($file4['url']); ?>"></div>
                                <div class="asset-main-download-name"><h1 class="asset-main-download-title"><?php echo $file4['title']; ?></h1><p class="asset-main-download-text"><?php desc_filetype($file4['url']); ?></p></div>
                            </div>
                            </a>
                            <?php endif; ?>
                            

                        </div>
                        <div class="asset-main-section-col2">
                            <div class="asset-main-description"><?php the_field('description'); ?></div>
                            <div class="asset-main-author">
                                <div class="asset-main-author-image"><img src="<?php 
                                    $author_obj = get_field('author');
                                    $author_img = get_field('profile_picture',$author_obj);
                                    echo $author_img['url'];
                                    ?>" alt="author-img"/></div>
                                <div class="asset-main-author-title-container">
                                    <h2 class="asset-main-author-name"><?php echo get_the_title($author_obj);?></h2>
                                    <p class="asset-main-author-title"><?php echo get_field('title',$author_obj); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                    <?php
                        the_content( sprintf(
                            /* translators: %s: Name of current post. */
                            wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cci_snap' ), array( 'span' => array( 'class' => array() ) ) ),
                            the_title( '<span class="screen-reader-text">"', '"</span>', false )
                        ) );

                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cci_snap' ),
                            'after'  => '</div>',
                        ) );
                    ?>
                </div><!-- .entry-content -->

                <?php 
                //<footer class="entry-footer">
                //    cci_snap_entry_footer(); 
                //</footer><!-- .entry-footer -->
                ?>
            </article><!-- #post-## -->
            
			<?php 
        
			//the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			/*if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;*/
            

		endwhile; // End of the loop.
		?>

            <div class="asset-comment-section fullwidth" style="border-bottom:0.5em solid <?php the_field('section_color',$thesection);?>;">
                <div class="inner-page-width">
                    <div id="disqus_thread"></div>
<script>

/**
 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables */
/*
var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = '//cci-ddc.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                </div>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
