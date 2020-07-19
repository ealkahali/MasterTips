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
               <div class="clearfix"></div>
            </div>
            <!-- /content detail -->
         </section>
         <?php endwhile;?>
         <?php endif; 
            ?>      
         <div class="aos-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
            <div class="blogitem text-left content-detail cnt_full_text">    
               <?php comments_template(); ?>
            </div>
            <!-- /comments -->
         </div>
      </div>
   </div>
</div>
<!-- /container -->
<?php get_footer(); ?>