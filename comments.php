<?php $zunday_theme_options = get_option('zunday'); ?>
<div class="clearfix"></div>
<div id="comments" class="comments-form">
   <?php if ( post_password_required() ) : ?>
   <p class="nopassword">
      <?php echo esc_html__( 'This post is password protected. Enter the password to view any comments.', 'zunday' ); ?>
   </p>
</div>
<?php return; endif; ?>
<?php if ( have_comments() ) :  ?> 
<div class="block-title">
   <div class="titlePage">
      <h1><?php comments_number( esc_html__('No Responses', 'zunday' ), esc_html__('One Response', 'zunday' ), esc_html__('% Responses', 'zunday' ) ); ?></h1>
   </div>
   <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
   <div class="comment-navigation">
      <div class="nav-previous"><?php previous_comments_link( esc_html__( '<i class="icon-angle-left"></i>', 'zunday' ) ); ?></div>
      <div class="nav-next"><?php next_comments_link( esc_html__( '<i class="icon-angle-right"></i>', 'zunday' ) ); ?></div>
   </div>
   <?php endif; ?>
</div>
<ol class="commentlist">
   <?php wp_list_comments( array( 'callback' => 'zunday_comment_list' ) );?>
</ol>
<?php else :
   if ( ! comments_open() ) : ?>
<p class="nocomments">
   <?php echo esc_html__( 'Comments are closed.', 'zunday' ); ?>
</p>
<?php endif;?>
<?php endif; ?>
<?php 
   $commenter = wp_get_current_commenter();
   $req = get_option( 'require_name_email' );
   $aria_req = ( $req ? " aria-required='true'" : '' );
   
   $comments_args = array(
       'comment_notes_before' => '',
           'comment_notes_after' => '',
       'logged_in_as' => '',
           'comment_field' => '<div class="txtCont"><textarea id="comment" class="txt" placeholder="'.esc_attr__( 'Comment', 'zunday' ).'" name="comment" aria-required="true" rows="4"></textarea><div class="lineTop"></div></div>',
       'fields' => apply_filters( 'comment_form_default_fields', array(
         'author' =>
           '<div class="txtCont"><input id="author" class="txt" placeholder="'.esc_attr__( 'Name', 'zunday' ).( $req ? '*' : '' ) .'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
           '" size="30"' . $aria_req . ' /><div class="lineTop"></div></div>',
         'email' =>
           '<div class="txtCont"><input id="email" class="txt" placeholder="'.esc_attr__( 'E-mail', 'zunday' ).( $req ? '*' : '' ) .'" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
           '" size="30"' . $aria_req . ' /><div class="lineTop"></div></div>',
         'url' =>
           '<div class="txtCont"><input id="url" class="txt" placeholder="'.esc_attr__( 'Website', 'zunday' ).'" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
           '" size="30" /><div class="lineTop"></div></div>'
         )
       ),
   );
   
   comment_form($comments_args);
   ?>
</div>