<?php $zunday_theme_options = get_option('zunday'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
   <head>
      <meta charset="<?php bloginfo( 'charset' ); ?>" />
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <?php
      if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ):
         if(isset($zunday_theme_options['favicon']['url']) && $zunday_theme_options['favicon']['url'] != "") : ?>
            <link id="favicon" rel="shortcut icon" href="<?php echo esc_url($zunday_theme_options['favicon']['url']); ?>" type="image/png" />
         <?php endif; 
      endif; ?>
      
      <?php wp_head(); ?>          
   </head>
   <body <?php body_class(); ?> >


      <?php if($zunday_theme_options['loading_display'] == 1): ?> 
      <div class="spinner-cont">
         <div class="spinner"></div>
      </div>
      <?php endif; ?> 


      <div class="fbg <?php if($zunday_theme_options['cover_image_display'] != 1 && is_single()): ?> noBg_image <?php endif; ?> <?php if($zunday_theme_options['cover_image_display'] == 1 && is_single()):?>mainContainer bg-image_single_1_<?php endif; ?> ">


      <?php if($zunday_theme_options['cover_image_display'] == 1 && is_single()): 
         if(has_post_thumbnail() && '' != get_the_post_thumbnail()) : ?>
         <?php $post_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); ?>
         <div class="bg_style_1_ov" style="background-image: url('<?php echo esc_url($post_image_url[0]); ?>')"></div>
      <?php endif; endif;?>  


      <header>

         <?php if($zunday_theme_options['cover_image_display'] == 1 && is_single()): ?>

            <?php if(isset($zunday_theme_options['logo_light']['url']) && $zunday_theme_options['logo_light']['url'] != "") : ?>
               <a href="<?php echo esc_url(home_url("/")); ?>" class="logo">
               <img src="<?php echo esc_url($zunday_theme_options['logo_light']['url']); ?>" class="aos-item" data-aos="fade-up" data-aos-duration="700" alt="<?php bloginfo( 'name' ); ?>">
               <span class="desc-logo aos-item" data-aos="fade-up" data-aos-duration="700"><?php echo esc_html($zunday_theme_options['logo_subtitles']); ?></span></a>
            <?php else: ?>
               <a href="<?php echo esc_url(home_url("/")); ?>" class="logo">
               <img src="<?php echo esc_url(get_stylesheet_directory_uri()."/assets/img/logo-for-dark.png"); ?>" class="aos-item" data-aos="fade-up" data-aos-duration="700" alt="<?php bloginfo( 'name' ); ?>">
               <span class="desc-logo aos-item" data-aos="fade-up" data-aos-duration="700"><?php echo esc_html($zunday_theme_options['logo_subtitles']); ?></span></a>
            <?php endif; ?>

         <?php else: ?>


         <?php 
            if($zunday_theme_options['general_site_style'] == 2){ ?>
               <?php if(isset($zunday_theme_options['logo_light']['url']) && $zunday_theme_options['logo_light']['url'] != "") : ?>
               <a href="<?php echo esc_url(home_url("/")); ?>" class="logo">
               <img src="<?php echo esc_url($zunday_theme_options['logo_light']['url']); ?>" class="aos-item" data-aos="fade-up" data-aos-duration="700" alt="<?php bloginfo( 'name' ); ?>">
            <?php else: ?>  
               <a href="<?php echo esc_url(home_url("/")); ?>" class="logo">
               <img src="<?php echo esc_url(get_stylesheet_directory_uri()."/assets/img/logo-for-dark.png"); ?>" class="aos-item" data-aos="fade-up" data-aos-duration="700" alt="<?php bloginfo( 'name' ); ?>">
            <?php endif; ?>
         <?php } 


         else { ?>            
            <?php  if(isset($zunday_theme_options['logo']['url']) && $zunday_theme_options['logo']['url'] != "") : ?>
               <a href="<?php echo esc_url(home_url("/")); ?>" class="logo">
               <img src="<?php echo esc_url($zunday_theme_options['logo']['url']); ?>" class="aos-item" data-aos="fade-up" data-aos-duration="700" alt="<?php bloginfo( 'name' ); ?>">
            <?php else: ?>  
               <a href="<?php echo esc_url(home_url("/")); ?>" class="logo">
               <img src="<?php echo esc_url(get_stylesheet_directory_uri()."/assets/img/logo-for-light.png"); ?>" class="aos-item" data-aos="fade-up" data-aos-duration="700" alt="<?php bloginfo( 'name' ); ?>">
            <?php endif; } ?>          
            <span class="desc-logo aos-item" data-aos="fade-up" data-aos-duration="700"><?php echo esc_html($zunday_theme_options['logo_subtitles']); ?></span></a>
         <?php endif; ?>

      </header>




      <nav class="sidetb aos-item" data-aos="fade-right" data-aos-duration="700">
         <div class="logo n_button">
            <a class="btn_menu js-menuBtn">
               <div id="nav-icon2">
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
               </div>
            </a>
         </div>
         <ul class="nav__list">
            <li class="srcLi">
               <div class="srcdv">

                  <?php get_search_form(); ?>

               </div>
            </li>
            <li class="nav__item"><a href="#" class="search-btns"><i class="fa fa-search"></i></a></li>
         </ul>


         <?php if($zunday_theme_options['socialmedia_display'] == 1): ?> 

            <ul class="nav__social">
               <?php if(isset($zunday_theme_options['rss']) && $zunday_theme_options['rss'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['rss']); ?>" class="nav_social__item"><i class="fas fa-rss"></i></a></li>
               <?php } ?>
               <?php if(isset($zunday_theme_options['Facebook']) && $zunday_theme_options['Facebook'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['Facebook']); ?>" class="nav_social__item"><i class="fab fa-facebook"></i></a></li>
               <?php } ?>   
               <?php if(isset($zunday_theme_options['Twitter']) && $zunday_theme_options['Twitter'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['Twitter']); ?>" class="nav_social__item"><i class="fab fa-twitter"></i></a></li>
               <?php } ?>  
               <?php if(isset($zunday_theme_options['Google']) && $zunday_theme_options['Google'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['Google']); ?>" class="nav_social__item"><i class="fab fa-google"></i></a></li>
               <?php } ?> 
               <?php if(isset($zunday_theme_options['Pinterest']) && $zunday_theme_options['Pinterest'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['Pinterest']); ?>" class="nav_social__item"><i class="fab fa-pinterest"></i></a></li>
               <?php } ?>  
               <?php if(isset($zunday_theme_options['tumblr']) && $zunday_theme_options['tumblr'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['tumblr']); ?>" class="nav_social__item"><i class="fab fa-tumblr"></i></a></li>
               <?php } ?>  
               <?php if(isset($zunday_theme_options['Dribbble']) && $zunday_theme_options['Dribbble'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['Dribbble']); ?>" class="nav_social__item"><i class="fab fa-dribbble"></i></a></li>
               <?php } ?>  
               <?php if(isset($zunday_theme_options['Instagram']) && $zunday_theme_options['Instagram'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['Instagram']); ?>" class="nav_social__item"><i class="fab fa-instagram"></i></a></li>
               <?php } ?>  
               <?php if(isset($zunday_theme_options['Linkedin']) && $zunday_theme_options['Linkedin'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['Linkedin']); ?>" class="nav_social__item"><i class="fab fa-linkedin"></i></a></li>
               <?php } ?> 
               <?php if(isset($zunday_theme_options['Github']) && $zunday_theme_options['Github'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['Github']); ?>" class="nav_social__item"><i class="fab fa-github-square"></i></a></li>
               <?php } ?>
               <?php if(isset($zunday_theme_options['Skype']) && $zunday_theme_options['Skype'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['Skype']); ?>" class="nav_social__item"><i class="fab fa-skype"></i></a></li>
               <?php } ?>
               <?php if(isset($zunday_theme_options['YouTube']) && $zunday_theme_options['YouTube'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['YouTube']); ?>" class="nav_social__item"><i class="fab fa-youtube"></i></a></li>
               <?php } ?> 
               <?php if(isset($zunday_theme_options['Flickr']) && $zunday_theme_options['Flickr'] != '') { ?>
               <li><a href="<?php echo esc_url($zunday_theme_options['Flickr']); ?>" class="nav_social__item"><i class="fab fa-flickr"></i></a></li>
               <?php } ?>                                                                                                                                                                        
            </ul>

         <?php endif; ?> 


      </nav>
      <?php if($zunday_theme_options['slider_display'] == 1 && !empty($zunday_theme_options['slider_category'])): ?>
      <div class="container">
         <?php 
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            
               if(is_home() && 1 == $paged){
                 include ( get_parent_theme_file_path() . '/includes/slider.php' );
               }
               
             ?>   
      </div>
      <?php endif; ?> 
      <div class="container">
         <?php 
            include ( get_parent_theme_file_path() . '/includes/archive-header.php' );
            
            ?>
      </div>
      <div class="main">
      <section class="main-menu-opcnt">
         <div class="close-menu"><i class="fa fa-times"></i></div>
         <div class="row">
            <div class="col-lg-12">
               <nav class="menu menu--zunday" >
                  <?php 
                     wp_nav_menu( array(
                       'theme_location' => 'primary',
                       'menu_class'     => 'accordion',
                       'container' => false,
                       'walker' => new IBenic_Walker()
                      ) );
                     
                     ?>
               </nav>
            </div>
         </div>
      </section>