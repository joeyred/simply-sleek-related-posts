<?php
/**
 * Admin Settings Page and Widget Options
 *
 * @since 0.1.0
 *
 * @package SSRP\Admin
 */

// Options and input
  // Widget Title
  // Number of Posts displayed
  // Post Type
  //

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
      'value'      => ssrp_option_foreach( $post_types, $post_type ),
    )),
    'number-of-posts' => ssrp_make_field( array(
      'label'      => 'Number of Posts Displayed',
      'field_type' => 'select',
      'name'       => $object->get_field_name('num_posts'),
      'value'      => '',
    )),
  );



  $output = '';

  // Itterate through `$fields` array and add the strings to `$output`.
  foreach ( $fields as $field ) {

    $ouput .= $field;

  }

  return $output;

  /*
   * TODO: Create a function that performs necessary sprintf()s with passed values.
   * 			 Details may need to be hammered out better but values could be $wrapper,
   * 			 $field_type, $label, $args
   */
  //
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
