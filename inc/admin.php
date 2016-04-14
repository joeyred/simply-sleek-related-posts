<?php
/**
 * Admin Settings Page and Widget Options
 *
 * @since 0.1.0
 *
 * @package SSRP\Admin
 */

/**
 * Builds out form fields for Simply_Sleek_Related_Posts::form() method.
 *
 * @since 0.1.0
 *
 * @param  mixed $instance Saved values.
 * @param  mixed $object   `$this` from widget sub-class.
 *
 * @return string           Markup.
 */
function ssrp_widget_options_form( $instance, $object ) {

  // Get all registered post types
  $post_types = get_post_types( '', 'names' );

  // Check Values
  if ( $instance ) {

    $title 	   = esc_attr($instance['title']);
    $num_posts = esc_attr($instance['num_posts']);
    $post_type = esc_attr($instance['post_type']);

  } else {

    $title     = '';
    $num_posts = '';
    $post_type = '';
  }

  // Array of form fields in order of output.
  $fields = array(
    'title' => ssrp_make_field( array(
      'label'      => 'Title',
      'field_type' => 'text',
      'name'       => $object->get_field_name('post_type'),
      'value'      => $title,
    )),
    'post-type' => ssrp_make_field( array(
      'label'      => 'Post Type',
      'field_type' => 'select',
      'name'       => $object->get_field_name('post_type'),
      'value'      => ssrp_option_loop( $post_types, $post_type, 'foreach' ),
    )),
    'number-of-posts' => ssrp_make_field( array(
      'label'      => 'Number of Posts Displayed',
      'field_type' => 'select',
      'name'       => $object->get_field_name('num_posts'),
      'value'      => ssrp_option_loop( 6, $num_posts, 'for' ),
    )),
  );



  $output = '';

  // Itterate through `$fields` array and add the strings to `$output`.
  foreach ( $fields as $field ) {

    $output .= $field;

  }

  return $output;
}

// Settings Page
  // Choose Styling
    // SSRP Default
    // Bootstrap
    // Foundation 5
    // Foundation 6 Float Grid
    // Foundation 6 Flex Grid
  // Placeholder Thumbnail
    // Upload a Placeholder
    // or Choose a BG color
    // or use default Placeholder (choose between default placeholders?)
