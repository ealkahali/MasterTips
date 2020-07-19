<?php

/* = Theme Options
-------------------------------------------------------------- */
// Load the theme/plugin options
if ( file_exists( dirname( __FILE__ ) . '/includes/redux-config.php' ) ) {
    require_once dirname( __FILE__ ) . '/includes/redux-config.php';
}

function zunday_setup() {
  //support
  add_theme_support( 'post-thumbnails');
  add_theme_support('automatic-feed-links');
  add_theme_support( 'title-tag' );

  /* = Menu
  -------------------------------------------------------------- */
  register_nav_menu( 'primary', esc_html__('Main Navigation' , 'zunday') );
}

add_action( 'after_setup_theme', 'zunday_setup' );


/* = Sidebars
-------------------------------------------------------------- */
function zunday_sidebars()
{

  register_sidebar(array(
   'name' => esc_html__( 'Zunday Sidebar', 'zunday' ) ,
   'id' => 'zunday_sidebar',
   'description' => esc_html__( 'Sidebar Widgets', 'zunday' ),
   'before_widget' => '<div class="col-12"><div class="widget">',
   'after_widget' => '</div></div><!-- /widget -->',
   'before_title' => '<h3 class="widget-title">',
   'after_title' => '</h3><div class="clearfix"></div>'
   ));   
}
add_action('widgets_init' , 'zunday_sidebars');

// Register Custom Gallery
require_once('zunday-gallery.php');

// Languages
load_theme_textdomain( 'zunday', get_template_directory() . '/languages' );


class IBenic_Walker extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
      $object = $item->object;
      $type = $item->type;
      $title = $item->title;
      $description = $item->description;
      $permalink = $item->url;
      if( !empty( $item->classes ) ) {
       $output .= "<li class='" .  implode(" ", $item->classes) . "'>";
      }
      $output .= '<a class="menu__item" href="' . esc_url($permalink) . '">';
       
      $output .= '<span class="menu__item-name">'. esc_html($title) . '</span>';
      
      if( $description == '') {
        $output .= '<span class="menu__item-label noneDisplay">&nbsp;</span>';
      }else{
        $output .= '<span class="menu__item-label">' . esc_html($description) . '</span>';
      }
      $output .= '</a>';
    }
}



function zunday_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:', 'zunday') . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search', 'zunday') .'" />
    <i class="fa fa-search search-btn"></i>
    </div>
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'zunday_search_form' );


/* = Sripts
-------------------------------------------------------------- */
//register scripts
function zunday_scripts() {

  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css'); 
  wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/fontawesome-all.min.css');
  wp_enqueue_style( 'aos', get_template_directory_uri() . '/assets/css/aos.css');  
  wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/assets/css/jquery.bxslider.css'); 
  wp_enqueue_style( 'lightgallery', get_template_directory_uri() . '/assets/css/lightgallery.min.css');  
  wp_enqueue_style( 'photoswipe-skin', get_template_directory_uri() . '/assets/css/default-skin/default-skin.css');  
  wp_enqueue_style( 'zunday-style', get_template_directory_uri() . '/style.css'); 


  $zunday_theme_options = get_option('zunday');

  if($zunday_theme_options['general_site_style'] == 2):
    wp_enqueue_style( 'zunday-style-dark', get_template_directory_uri() . '/assets/css/zunday-dark.css'); 
  endif;

if ( is_singular() ) {
  wp_enqueue_script( 'comment-reply' );
}
  
  wp_enqueue_script( 'charming', get_template_directory_uri() . '/assets/js/charming.min.js','','',true); 
  wp_enqueue_script( 'anime', get_template_directory_uri() . '/assets/js/anime.min.js','','',true); 
  wp_enqueue_script( 'menu', get_template_directory_uri() . '/assets/js/menu.js','','',true); 
  wp_enqueue_script( 'aos', get_template_directory_uri() . '/assets/js/aos.js','','',true); 
  wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js','','',true); 
  wp_enqueue_script( 'ui-photoswipe', get_template_directory_uri() . '/assets/js/photoswipe.min.js','','',true); 
  wp_enqueue_script( 'lightgallery', get_template_directory_uri() . '/assets/js/lightgallery-all.min.js','','',true); 
  wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/assets/js/jquery.mousewheel.min.js','','',true); 
  wp_enqueue_script( 'zunday-custom', get_template_directory_uri() . '/assets/js/custom.js','','',true); 
}
add_action( 'wp_enqueue_scripts', 'zunday_scripts' );


/* = Dark Style
-------------------------------------------------------------- */

function zunday_customize() {
  
  $zunday_theme_options = get_option('zunday');

  $custom = "";


  if( !empty( $zunday_theme_options['generalBgImg']['url'] ) ){ 

    $custom .= 'body::before{background-image: url(\'' . esc_url($zunday_theme_options['generalBgImg']['url']) . ' \') !important; background-size: cover !important; background-color: #000;} ';
  }


  if( !empty( $zunday_theme_options['logo_max_width'] ) ) {
    $custom .= 'a.logo img{max-width:' . esc_attr( $zunday_theme_options['logo_max_width'] ) . ';}';
  }  


  if( !empty( $zunday_theme_options['generalBgImg_opacity'] ) ) {
    $custom .= 'body::before{opacity:' . esc_attr( $zunday_theme_options['generalBgImg_opacity'] ) . ' !important;}';
  }   
  

  if( !empty( $zunday_theme_options['general-color'] ) ) {
    $custom .= 'nav.sidetb, .social_links.style-outline a:hover, .blogitem-title.section-t::after{background:' . esc_attr( $zunday_theme_options['general-color'] ) . ' !important;}';
  }   


  if( !empty( $zunday_theme_options['general-color'] ) ) {
    $custom .= '.bg-image_single_1_ .blogitem.content-detail.content, h3.widget-title::after, .widget .widget-title::after, .social_links.style-outline a:hover,.lg-outer .lg-thumb-item.active, .lg-outer .lg-thumb-item:hover{border-color:' . esc_attr( $zunday_theme_options['general-color'] ) . ' !important;}';
  }  


  if( !empty( $zunday_theme_options['general-color'] ) ) {
    $custom .= '.pagination span.current{border-color:' . esc_attr( $zunday_theme_options['general-color'] ) . '38 !important;}';
  }   



  if( !empty( $zunday_theme_options['general-color'] ) ) {
    $custom .= '.menu--zunday .menu__item-name::before{background:' . esc_attr( $zunday_theme_options['general-color'] ) . '20 !important;}';
  }     



  if( !empty( $zunday_theme_options['general-color'] ) ) {
    $custom .= '.blogitem:first-child:hover::before, .grid__item:hover::before{border-color:' . esc_attr( $zunday_theme_options['general-color'] ) . '30 !important;}';
  }     
  

  if( !empty( $zunday_theme_options['general-color'] ) ) {
    $custom .= '.pagination span.current{border-top-color:' . esc_attr( $zunday_theme_options['general-color'] ) . ' !important;}';
  }      


  if( !empty( $zunday_theme_options['general-color'] ) ) {
    $custom .= '.menu--zunday ul li a, .search-btn, .pagination span.current, .menu--zunday ul li a, a:hover:not(.ab-item):not(.nav_social__item), .menu--zunday .menu__item-name, .menu--zunday ul li a{color:' . esc_attr( $zunday_theme_options['general-color'] ) . ' !important;}';
  }              


  if( !empty( $zunday_theme_options['general-color'] ) ) {
    $custom .= '.line-general{background:' . esc_attr( $zunday_theme_options['general-color'] ) . ' !important;}';
  }        


  if($zunday_theme_options['general_site_style'] == 2):
  

      if( !empty( $zunday_theme_options['general-color'] ) ) {
        $custom .= 'input#submit, .line-general, .menu--zunday .menu__item-name::before{background:' . esc_attr( $zunday_theme_options['general-color'] ) . ' !important;}';
      }


      if( !empty( $zunday_theme_options['general-color'] ) ) {
        $custom .= '@media screen and (min-width: 900px){ .grid__item:hover::before, .blogitem:first-child:hover::before {border-color:' . esc_attr( $zunday_theme_options['general-color'] ) . ' !important;}}';
      }      

  endif;


    wp_enqueue_style( 'zunday-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0' );
    wp_add_inline_style( 'zunday-custom', $custom );  

}
add_action( 'wp_enqueue_scripts', 'zunday_customize' );


/* = Plugin Activation
-------------------------------------------------------------- */
require_once(get_template_directory() . '/lib/tgm-plugin/class-tgm-plugin-activation.php');
require_once(get_template_directory() . '/lib/tgm-plugin/getplugins.php');


/* = Comments...
-------------------------------------------------------------- */
require_once(get_template_directory() . '/includes/comments.php');


/* = Get recent comments
-------------------------------------------------------------- */
if ( ! function_exists( 'get_avatar_url' ) ) {
  function get_avatar_url($get_avatar){
      preg_match("/src='(.*?)'/i", $get_avatar, $matches);
      return $matches[1];
  }
}


function zunday_dp_recent_comments($no_comments = 10, $comment_len = 150) {
    global $wpdb;
    $request = "SELECT * FROM $wpdb->comments";
    $request .= " JOIN $wpdb->posts ON ID = comment_post_ID";
    $request .= " WHERE comment_approved = '1' AND post_status = 'publish' AND post_password =''";
    $request .= " ORDER BY comment_date DESC LIMIT $no_comments";
    $comments = $wpdb->get_results($request);
    if ($comments) {
?>
<div class="otherFeaItems"> 
<?php

        foreach ($comments as $comment) {
            ob_start();
            ?>  
            <div class="otherItem">
              <div class="imgBoxBg">
                <?php echo get_avatar( $comment->comment_author_email, 70); ?>
              </div>
              <a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>"><?php echo dp_get_author($comment); ?></a>
              <p><?php echo get_the_title($comment->comment_post_ID); ?></p>
              <div class="clearfix"></div>
            </div><!-- /otherItem -->
          

            <?php
            ob_end_flush();
        }
?>
</div>
<?php        
    } else {
        echo esc_html__('No comments yet', 'zunday');
    }
}

// Get author for comment
function dp_get_author($comment) {
    $author = "";
    if ( empty($comment->comment_author) )
        $author = esc_html__('Anonymous', 'zunday');
    else
        $author = $comment->comment_author;
    return $author;
}

/* = Exclude Pages from Search Results
-------------------------------------------------------------- */
function zunday_SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','zunday_SearchFilter');


if ( ! isset( $content_width ) ) $content_width = 1014;


/* = Demo Importer
-------------------------------------------------------------- */

function ocdi_import_files() {
  return array(


    array(
      'import_file_name'           => esc_html__('Light Version', 'zunday'),
      //'categories'                 => array( 'Category 1', 'Category 2' ),
      'import_file_url'            => 'http://www.creaheads.com/demo-files/demo-content.xml',
      'import_widget_file_url'     => 'http://www.creaheads.com/demo-files/widgets.json',
      'import_redux'               => array(
        array(
          'file_url'    => 'http://www.creaheads.com/demo-files/theme_options-light.json',
          'option_name' => 'zunday',
        ),
      ),
      'import_preview_image_url'   => 'http://www.creaheads.com/importPreview_zunday/preview-import-light.png',
      'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zunday' ),
      'preview_url'                => 'http://www.creaheads.com/zunday',
    ),


    array(
      'import_file_name'           => esc_html__('Dark Version', 'zunday'),
      'import_file_url'            => 'http://www.creaheads.com/demo-files/demo-content.xml',
      'import_widget_file_url'     => 'http://www.creaheads.com/demo-files/widgets.json',
      'import_redux'               => array(
        array(
          'file_url'    => 'http://www.creaheads.com/demo-files/theme_options-dark.json',
          'option_name' => 'zunday',
        ),
      ),
      'import_preview_image_url'   => 'http://www.creaheads.com/importPreview_zunday/preview-import-dark.png',
      'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zunday' ),
      'preview_url'                => 'http://www.creaheads.com/zunday-dark',
    ),

  );
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );