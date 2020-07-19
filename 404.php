<?php $zunday_theme_options = get_option('zunday'); ?>
<?php get_header(); ?>
<div class="container">
   <div class="row">
      <div class="col-12">
         <section class="aos-item" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
            <div class="blogitem text-left content-detail cnt_full_text content text-center">
               <img class="image-not-found" src="<?php echo esc_url(get_stylesheet_directory_uri()."/assets/img/404-error.svg"); ?>">
               <div class="text-center">
                  <h4 class="headernot-found"><?php echo esc_html__( '404', 'zunday' ); ?></h4>
               </div>
               <div class="nf-des">
                  <?php echo esc_html__( 'Page Not Found.', 'zunday' ); ?>
               </div>
               <p class="text-center"><?php echo esc_html__( 'The page you are looking for was moved, removed, renamed or might never existed.', 'zunday' ); ?></p>
               <p class="text-center not-link"><a href="<?php echo esc_url(home_url("/")); ?>">&laquo; <?php echo esc_html__( 'Homepage', 'zunday' ); ?></a></p>
               <div class="clearfix"></div>
            </div>
            <!-- /content detail -->
         </section>
      </div>
   </div>
</div>
<!-- /container -->
<?php get_footer(); ?>