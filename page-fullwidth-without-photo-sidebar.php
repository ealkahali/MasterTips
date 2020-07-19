<?php
   /**
   * Template Name: Full Width - (without photo) - Sidebar
   */
   ?>
<?php get_header(); ?>
<div class="container demoS">
   <div class="row">
      <div class="col-md-8 order-2">
         <?php global $more; $more = -1; ?>
         <?php 
            $temp = $wp_query; $wp_query= null;
            $wp_query = new WP_Query(); $wp_query->query('posts_per_page=9' . '&paged='.$paged);
            while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
         <section data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700" id="post-<?php the_ID(); ?>" <?php post_class("aos-item"); ?>>
            <div class="blogitem text-center">
               <a href="<?php the_permalink(); ?>">
                  <h2 class="blogitem-title blogitem-title-separator"><?php the_title(); ?></h2>
               </a>
               <div class="line-general"></div>
               <div class="blogitem-description">
                  <div>
                     <p><?php $content = get_the_excerpt(); echo substr($content, 0, 400); ?></p>
                  </div>
                  <p><a href="<?php the_permalink(); ?>" class="more-link"><span><?php echo esc_html__( 'Read More', 'zunday' ); ?></span></a></p>
               </div>
               <div class="iteminfo">
                  <div class="iteminfo-cont time">
                     <i class="fa fa-clock"></i><?php the_time('F j, Y'); ?>
                  </div>
                  <div class="iteminfo-cont comments">
                     <i class="fa fa-comments"></i> <?php comments_number( 'No comments', 'One comment', '% comments' ); ?>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="clearfix"></div>
            </div>
         </section>
         <?php endwhile;?>
         <?php wp_reset_postdata(); ?>
         <?php wp_link_pages(); ?>
      </div>
      <div class="col-md-4 order-2">
         <div class="widget-container sidebar sidebar_Side aos-item" data-aos="fade-up" data-aos-duration="700">
            <div class="row">
               <?php dynamic_sidebar('zunday_sidebar'); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /container -->
<?php get_footer(); ?>