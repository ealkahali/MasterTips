<?php
   /**
   * Template Name: Grid - (without photo)
   */
   ?>
<?php get_header(); ?>
<section class="grid">
   <?php global $more; $more = -1; ?>
   <?php 
      $temp = $wp_query; $wp_query= null;
      $wp_query = new WP_Query(); $wp_query->query('posts_per_page=9' . '&paged='.$paged);
      while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
   <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700" id="post-<?php the_ID(); ?>" <?php post_class("grid__item aos-item"); ?>>
      <a class="" href="<?php the_permalink(); ?>">
         <h2 class="title title--preview"><?php the_title(); ?></h2>
         <div class="line-general"></div>
         <span class="category"><?php $category = get_the_category(); echo esc_html($category[0]->cat_name); ?></span>
         <div class="meta meta--preview">
            <span class="meta__date"><i class="fa fa-clock"></i> <?php the_time('F j, Y'); ?></span>
            <span class="meta__reading-time"><i class="fa fa-comments"></i> <?php comments_number( 'No comments', 'One comment', '% comments' ); ?></span>
         </div>
      </a>
   </div>
   <?php endwhile;?>
   <?php wp_reset_postdata(); ?>
   <?php wp_link_pages(); ?>
</section>
<?php get_footer(); ?>