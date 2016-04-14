<?php
/**
 * Widget Sub Class
 *
 * @since 0.1.0
 */

class Simply_Sleek_Related_Posts extends WP_Widget {

	// Set up widget name and details
	function simply_sleek_related_posts() {
		parent::__construct(
			false, // Base ID
			'SS - Related Posts', // Name
			array(
			'description' => __( 'Display Related Posts.', 'simply-sleek-related-posts' ),
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	function widget( $args, $instance ) {

  	// extract($args);
  	// $title 	   = apply_filters( 'widget_title', $instance['title'] );
  	// $num_posts = $instance['num_posts'];
  	// $post_type = $instance['post_type'];

  	// global $post;

    // // Get tags and store in variable
    // $tags = wp_get_post_tags( $post->ID );
    //
    // if ( $tags ) {
    //
    //   foreach ( $tags as $tag ) {
    //
    //     $tags_arr .= $tag->slug . ',';
    //   }
    //
    //   $args = array(
    //     'post_type' => $post_type,
    //     'tag'       => $tag_arr,
    //     'numberposts' => $num_posts,
    //     'post__not_in' => array($post->ID),
    //   );
    //
    //   $related_posts = get_posts( $args );
    //
    //   if ( $related_posts ) {
    //
    //     ssrp_do_container_open( $title ); // TODO handle class option regarding amount of blocks per row
    //
    //     ssrp_do_container_close();
    //   }
    //
    // }



    // wp_reset_postdata();
    // echo 'I Am a Widget';

 	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	function update( $new_instance, $old_instance ) {

		$instance 			   		 = $old_instance;
		$instance['title'] 	   = strip_tags($new_instance['title']);
		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['post_type'] = $new_instance['post_type'];

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @uses ssrp_widget_options_form() Build out options form.
	 *
	 * @param array $instance Previously saved values from database.
	 */
  function form( $instance ) {

		$form = ssrp_widget_options_form( $instance, $this );

		echo $form;
	}
}

add_action( 'widgets_init', 'ssrp_register_widget' );
function ssrp_register_widget() {

	register_widget( 'Simply_Sleek_Related_Posts' );
}
