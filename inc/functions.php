<?php
/**
 * Functions
 *
 * @since 0.1.0
 */

function ssrp_markup( $args = array() ) {

  $defaults = array(
    'ssrp'             => '',
    'bootstrap'        => '',
    'foundation-float' => '',
    'foundation-flex'  => '',
    'universal'        => '',
    'echo'             => true,
  );

  // Parse args
  $args = wp_parse_args( $args, $defaults );

  // Check option value for contextual markup
  if ( ssrp_which_markup() === 'bootstrap' ) {

    $markup = $args['bootstrap'];

  } elseif ( ssrp_which_markup() === 'foundation-float' ) {

    $markup = $args['foundation-float'];

  } elseif ( ssrp_which_markup() === 'foundation-flex' ) {

    $markup = $args['foundation-flex'];

  } else {

    $markup = $args['ssrp'];
  }

  // If the value is empty, just return an empty string
  if ( ! $markup ) {

    return '';
  }

  // Check for universal class and add it
  if ( $args['universal'] ) {

    $markup = sprintf( $markup, $args['universal'] );
  }

  if ( $args['echo'] ) {

    echo $markup;

  } else {

    return $markup;
  }
}

// TODO: Create function that checks for the option value that determines which markup is used

function ssrp_which_markup() {

  return 'ssrp';
}

/**
 * Add selected attribute and value if option matches instance.
 *
 * @since 0.1.0
 *
 * @param  string|int $instance       Stored value from database
 * @param  string|int $current_option Current option that `$insatnce` is checked against.
 * @return string                     Attribute or empty string.
 */
function ssrp_check_selected_option( $instance, $current_option ) {

  if ( $instance === $current_option ) {

    $output = ' selected="selected"';

  } else {

    $output = '';

  }

  return $output;
}

/**
 * Generate options in a select element.
 *
 * If the passed value of `$loop` is `for`, then this function will output option elements
 * built with a for loop setting values to be passed through a `sprintf()` pattern, for
 * which `$instance` is an integer. If the passed value is 'foreach', the same will be
 * executed via a foreach loop, however, `$instance` is an array to be iterated through.
 *
 * @since 0.1.0
 *
 * @uses ssrp_check_selected_option() Check if option matches stored value in `$instance`.
 *
 * @param  int|array  $options  Either max int (for) or array of options (foreach).
 * @param  int|string $instance Value of form field taken from `$insatnce`.
 * @param  string     $loop     Loop to use. accpepted values are `for` and `foreach`.
 *
 * @return string               Markup.
 */
function ssrp_option_loop( $options, $instance, $loop ) {

  // Empty variable to add onto.
  $output = '';

  // For Loop
  if ( $loop === 'for' ) {

    // `sprintf()` pattern markup.
    $field = '<option value="%1$d"%2$s>%1$d</option>';

    for ($i = 1; $i <= $options; $i++ ) {

      // Add 'selected' attribute if stored instance matches option.
      $selected = ssrp_check_selected_option( $instance, $i );

      $output .= sprintf( $field, $i, $selected );

    }
  // Foreach Loop
  } elseif ( $loop === 'foreach' ) {

    // `sprintf()` pattern markup.
    $field = '<option value="%1$s"%2$s>%1$s</option>';

    foreach ( $options as $option ) {

      // Add 'selected' attribute if stored instance matches option.
      $selected = ssrp_check_selected_option( $instance, $option );

      $output .= sprintf( $field, $option, $selected );

  	}

  }

  return $output;
}

/**
 * Create Form Field in a Consitent Manner.
 *
 * Supported keys for `$args` are:
 *
 *  - `label` (the text of the label),
 *  - `field_type` (which field `sprintf()` pattern to use),
 *    - `text` (create a basic text input field),
 *    - `select` (create a select field),
 *  - `name` (value of the name attribute of the html field element),
 *  - `value` (the value attribute or content depending on the field_type),
 *  - `wrapper` (default is a paragarph element),
 *    - string (`sprintf()` parrtern markup for wrapper around field element),
 *    - `false` (output field markup without a wrapping element),
 *
 * Conditionally create markup based upon passed values for form fields via multiple
 * `sprintf()` patterns. This function can output different types of form fields with a
 * variety of options, with or without a wrapping element.
 *
 * @since 0.1.0
 *
 * @param  array  $args Array of arguments.
 *
 * @return string       Markup.
 */
function ssrp_make_field( $args = array() ) {

  $defaults = array(
    'label'      => '',
    'field_type' => '',
    'name'       => '',
    'value'      => '',
    'wrapper'    => '<p>%s</p>',

  );
  // Merge Default values with Args.
  $args = wp_parse_args( $args, $defaults );

  $field_types = array(
    'text' => '<input class="widefat" name="%s" type="text" value="%s" />',
    'select' => '<select name="%s">%s</select>',
    'option' => '<option value="%s" %s>%s</option>'
  );

  $label = '<label>%s%s</label>';

  // Check the field type to be used.
  if ( $args['field_type'] === 'text' ) {

    $field_type = $field_types['text'];

  } elseif ( $args['field_type'] === 'select' ) {

    $field_type = $field_types['select'];

  }

  // Build the field.
  $field = sprintf( $field_type, $args['name'], $args['value'] );

  // Stick built field in label.
  $labeled_field = sprintf( $label, __( $args['label'], 'simply-sleek-related-posts' ), $field );

  // Check if a wrapper should be applied or not.
  if ( ! $args['wrapper'] ) {
    // Output without a wrapper
    $output = $labeled_field;
  } else {
    // Put the whole thing into a wrapper.
    $output = sprintf( $args['wrapper'], $labeled_field );
  }

  return $output;
}
