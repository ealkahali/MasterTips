<?php $zunday_theme_options = get_option('zunday'); ?>
<?php get_header(); ?>
<div class="container">
   <div class="row">
      <div class="col-12">
         <?php global $more; $more = -1; ?>
         <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
         <section class="aos-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
            <div class="blogitem text-left content-detail cnt_full_text content">
               <h2 class="blogitem-title blogitem-title-separator text-center"><?php the_title(); ?></h2>
               <div class="line-general"></div>
               <?php the_content(); ?> <?php wp_link_pages(); ?>
               <?php if($zunday_theme_options['tag_display'] == 1 && has_tag()): ?> 
               <div class="aos-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                  <ul class="blog-post-tags">
                     <?php the_tags( '<li>', '</li><li>', '</li>' ); ?>
                  </ul>
               </div>
               <?php endif; ?> 
               <?php if($zunday_theme_options['author_display'] == 1): ?> 
               <?php if( get_the_author_meta( 'description') != ''):?>
               <div class="aos-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                  <div class="author-bio clr">
                     <div class="author-bio-avatar"> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr__( 'Visit Author Page', 'zunday' ); ?>"><?php if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '74' ); } ?></a></div>
                     <div class="author-bio-content clr">
                        <h4 class="author-bio-title"> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" title="<?php echo esc_attr__( 'Visit Author Page', 'zunday' ); ?>" data-wpel-link="internal"><?php the_author_meta( 'display_name' ); ?></a></h4>
                        <div class="author-bio-description clr">
                           <p><?php the_author_meta( 'description' ); ?></p>
                        </div>
                     </div>
                  </div>
               </div>
               <?php endif; ?>    
               <?php endif; ?>                                 
               <div class="clearfix"></div>
            </div>
            <!-- /content detail -->
            <div class="aos-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
               <div class="blogitem text-left content-detail cnt_full_text comments-sng">    
                  <?php comments_template(); ?>
               </div>
               <!-- /comments -->
            </div>
         </section>
         <?php endwhile;?>
         <?php endif; 
            ?>      
         <?php 
            $orig_post = $post;
            global $post;
            $tags = wp_get_post_tags($post->ID);
            
            if ($tags) {
            
            ?>
         <?php if($zunday_theme_options['related_posts_display'] == 1): ?>   
         <div class="aos-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
            <div class="related-posts blogitem text-left content-detail cnt_full_text">
               <div class="row">
                  <div class="col-md-12">
                     <h2 class="blogitem-title section-t text-center"><?php echo esc_html__( 'You may also like', 'zunday' ); ?></h2>
                     <div class="line-general boxesSn"></div>
                  </div>
                  <?php
                     $tag_ids = array();
                     foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                     $args=array(
                     'tag__in' => $tag_ids,
                     'post__not_in' => array($post->ID),
                     'posts_per_page'=>3, 
                     'ignore_sticky_posts'=>1,
                     'ignore_sticky_posts'=>1
                     );
                     
                     $my_query = new wp_query( $args );
                     
                     while( $my_query->have_posts() ) {
                     $my_query->the_post();
                     ?>         
                  <div class="col-md-4">
                     <a class="grid__item <?php if($zunday_theme_options['blog_styles_select'] == 2 || $zunday_theme_options['blog_styles_select'] == 3){ ?>full-img grid-img mobile-img-s<?php } ?>" href="<?php the_permalink(); ?>">
                        <h2 class="title title--preview"><?php the_title(); ?></h2>
                        <div class="line-general"></div>
                        <span class="category"><?php $category = get_the_category(); echo esc_html($category[0]->cat_name); ?></span>
                        <?php if($zunday_theme_options['blog_styles_select'] == 2 || $zunday_theme_options['blog_styles_select'] == 3){ ?>
                        <div class="bg-overlay"></div>
                        <?php if(has_post_thumbnail() && '' != get_the_post_thumbnail()) :
                           $post_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); 
                           
                            ?>
                        <div class="bg-image" style="background-image: url('<?php echo esc_url($post_image_url[0]); ?>');"></div>
                        <?php endif; ?>  
                        <?php } ?> 
                     </a>
                  </div>
                  <?php }
                     $post = $orig_post;
                     wp_reset_postdata();
                     ?>  
               </div>
            </div>
            <!-- /related-posts -->       
         </div>
         <?php endif; }  ?>                
         <div class="paginationCnt">
            <div class="pagination">
               <?php
                  global $wp_query;
                  
                  $big = 999999999; // need an unlikely integer
                  
                  echo paginate_links( array(
                    'base' => str_replace('#038;', '&', str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $wp_query->max_num_pages
                  ) );
                  ?>
               <div class="clearfix"></div>
            </div>
            <!-- /pagination -->
         </div>
      </div>
   </div>
</div>
<!-- /container -->
<?php get_footer(); ?>