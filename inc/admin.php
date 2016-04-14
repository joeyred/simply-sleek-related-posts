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
 * @param  array $instance Saved values.
 * @param  array $object   `$this` from widget sub-class.
 *
 * @return string           Markup.
 */
function ssrp_widget_options_form( $instance, $object ) {

  // Get all registered post types
  $post_types = get_post_types( '', 'names' );

  // // Check Values
  // if ( $instance ) {
  //
  //   $title 	   = esc_attr($instance['title']);
  //   $num_posts = esc_attr($instance['num_posts']);
  //   $post_type = esc_attr($instance['post_type']);
  //
  // } else {
  //
  //   $title     = '';
  //   $num_posts = '';
  //   $post_type = '';
  // }

  // Array of form fields in order of output.
  $fields = array(
    'title' => ssrp_make_field( array(
      'label'      => 'Title',
      'field_type' => 'text',
      'name'       => $object->get_field_name('title'),
      'value'      => $instance['title'],
    )),
    'post-type' => ssrp_make_field( array(
      'label'      => 'Post Type',
      'field_type' => 'select',
      'name'       => $object->get_field_name('post_type'),
      'value'      => ssrp_option_loop( $post_types, $instance['post_type'], 'foreach' ),
    )),
    'number-of-posts' => ssrp_make_field( array(
      'label'      => 'Number of Posts Displayed',
      'field_type' => 'select',
      'name'       => $object->get_field_name('num_posts'),
      'value'      => ssrp_option_loop( 6, $instance['num_posts'], 'for' ),
    )),
    'test-for-loop-selection' => ssrp_make_field( array(
      'label'      => 'Test the For Loop',
      'field_type' => 'select',
      'name'       => 'testing',
      'value'      => ssrp_option_loop( 6, 3, 'for' ),
    )),
  );



  $output = '';

  // Itterate through `$fields` array and add the strings to `$output`.
  foreach ( $fields as $field ) {

    $output .= $field;

  }

  return $output;
}

/*
 * IDEA: Have the amount of posts per row configurable via the global settings page, but
 * 			 either have an option on the settings page to allow for this option to be set
 * 			 individual per widget via options on the widget, or have a selectable option in
 * 			 the widget options which, when checked, overrides global settings and opens up
 * 			 new options to configure the widget independently. The latter may be best.
 */

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
