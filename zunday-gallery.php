<?php
   function zunday_gallery( $content, $attr ) {
   	global $instance, $post;
   	$instance++;
   
   	if ( isset( $attr['orderby'] ) ) {
   		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
   		if ( ! $attr['orderby'] )
   			unset( $attr['orderby'] );
   	}
   
   	extract( shortcode_atts( array(
   		'order'			=>	'ASC',
   		'orderby'		=>	'menu_order ID',
   		'id'			=>	$post->ID,
   		'itemtag'		=>	'figure',
   		'icontag'		=>	'div',
   		'captiontag'	=>	'figcaption',
   		'columns'		=>	3,
   		'size'			=>	'thumbnail',
   		'include'		=>	'',
   		'exclude'		=>	''
   	), $attr ) );
   
   	$id = intval( $id );
   
   	if ( 'RAND' == $order ) {
   		$orderby = 'none';
   	}
   
   	if ( $include ) {
   		
   		$include = preg_replace( '/[^0-9,]+/', '', $include );
   		
   		$_attachments = get_posts( array(
   			'include'			=>	$include,
   			'post_status'		=>	'inherit',
   			'post_type'			=>	'attachment',
   			'post_mime_type'	=>	'image',
   			'order'				=>	$order,
   			'orderby'			=>	$orderby
   		) );
   
   		$attachments = array();
   		
   		foreach ( $_attachments as $key => $val ) {
   			$attachments[$val->ID] = $_attachments[$key];
   		}
   
   	} elseif ( $exclude ) {
   		
   		$exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
   		
   		$attachments = get_children( array(
   			'post_parent'		=>	$id,
   			'exclude'			=>	$exclude,
   			'post_status'		=>	'inherit',
   			'post_type'			=>	'attachment',
   			'post_mime_type'	=>	'image',
   			'order'				=>	$order,
   			'orderby'			=>	$orderby
   		) );
   
   	} else {
   		
   		$attachments = get_children( array(
   			'post_parent'		=>	$id,
   			'post_status'		=>	'inherit',
   			'post_type'			=>	'attachment',
   			'post_mime_type'	=>	'image',
   			'order'				=>	$order,
   			'orderby'			=>	$orderby
   		) );
   
   	}
   
   	if ( empty( $attachments ) ) {
   		return;
   	}
   
   	if ( is_feed() ) {
   		$output = "\n";
   		foreach ( $attachments as $att_id => $attachment )
   			$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
   		return $output;
   	}
   
   	$itemtag	=	tag_escape( $itemtag );
   	$captiontag	=	tag_escape( $captiontag );
   	$columns	=	intval( min( array( 8, $columns ) ) );
   	$float		=	(is_rtl()) ? 'right' : 'left';
   	
   	$selector	=	"gallery-{$instance}";
   	$size_class	=	sanitize_html_class( $size );
   	$output		=	"<div class='row gallery-row my-gallery' itemscope itemtype='//schema.org/ImageGallery' id='$selector'>";
   
   
   	$span_array = null;
   
   	switch (count($attachments)) {
   		case 1:
   			/* One full width image */
   	        $span_array = array(12);
   	        break;
   	    case 2:
   	    	/* Two half width images */
   	        $span_array = array(6,6);
   	        break;
   	    case 3:
   	    	/* One 3/4 width image with two 1/4 width images to the right */
   	        $span_array = array(12,8,4);
   	        break;
   	    case 4:
   	    	/* One full width image with three 1/3 width images underneath */
   	    	$span_array = array(12,4,4,4);
   	        break;
   	    case 5:
   	    	/* Two half width images with fout 1/4 width images underneath */
   	    	$span_array = array(6,6,4,4,4);
   	        break;
   	    case 6:
   	    	/* One 2/3 width image with two 1/3 width images to the right,
   	    	 * and three 1/3 width images underneath */
   	    	$span_array = array(4,4,4,4,4,4);
   	        break;
   	    default:
   	    	/* One full width image with two 1/2 width images underneath
   	    	 * All remaining images 1/3 width underneath */
   	    	$span_array = array(12,6,6,4);
   	        break;
   	}
   
   	$attachment_count = 0;
   
   	foreach ( $attachments as $id => $attachment ) {
   		
   		$attachment_image = wp_get_attachment_image( $id, 'full');
   		$attachment_image_url = wp_get_attachment_url( $id, 'large');
   		$attachment_link = wp_get_attachment_link( $id, 'full', ! ( isset( $attr['link'] ) AND 'file' == $attr['link'] ) );
   
   		$output .= "<figure itemprop='associatedMedia' itemscope itemtype='http://schema.org/ImageObject' class='col-md-6 col-lg-" . $span_array[$attachment_count] . "'>";
   
   		$output .= "<a class='bg-imageFgallery' style='background-image:url(".$attachment_image_url.");' href='".$attachment_image_url."' itemprop='contentUrl' data-size='1920x1440'> <img src='".$attachment_image_url."' itemprop='thumbnail' alt='Image description' /> </a>";
   		
   		$output .= "</figure>\n";
   
   		if(count($attachments) >= 7 && $attachment_count == 3){
   			$attachment_count = 3;
   		} else {
   			$attachment_count++;
   		}
   	}
   	
   	$output .= "</div>\n";
   	
   	return $output;
   }
   
   add_filter( 'post_gallery', 'zunday_gallery', 10, 2 );
   
   ?>