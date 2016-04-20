<?php

function ssrp_debug_markup() {

  // Get the current markup config
  $current_markup = ssrp_which_markup();
  $args = ssrp_debug_markup_array();
  $markup = $args[$current_markup];
  // If the value is empty, just return an empty string
  if ( ! $markup[0] ) {

    $markup = '';
  }
  // Check for universal class and add it
  if ( $args['universal'] && $markup[1] ) {

    $markup = sprintf( $markup[0], $args['universal'] );
  }

  $test_ouput = $markup;

  $block_classes = ssrp_get_block_grid_classes();
  $html = ssrp_markup( array(
    'ssrp'        => '<ul class="%s">',
    'bootstrap'   => array( '<div class="row">', false ),
    'foundation5' => '<ul class="%s">',
    'foundation6' => '<div class="%s">',
    'universal'   => $block_classes,
    'echo'        => false,
  ) );
  echo '<div style="background: #f4f680; margin-bottom: 10px; padding: 20px; font-size: 12px;">';
  echo '<h3>Output:</h3>';
  ssrp_string_dump_pre( ssrp_markup( array(
    'ssrp'        => '</li>',
    'bootstrap'   => '</div>',
    'foundation5' => '</li>',
    'foundation6' => '</div>',
  ) ) );
  echo '<hr />';
  ssrp_var_dump_pre( ssrp_debug_markup_array() );
  echo '<hr />';
  ssrp_var_dump_pre($test_ouput);
  echo '</div>';
}

function ssrp_debug_markup_array() {

  $args = array(
    'ssrp'        => '</li>',
    'bootstrap'   => '</div>',
    'foundation5' => '</li>',
    'foundation6' => '</div>',
  );

  $defaults = array(
    'ssrp'        => array( '', true ),
    'bootstrap'   => array( '', true ),
    'foundation5' => array( '', true ),
    'foundation6' => array( '', true ),
    'universal'   => '',
    'echo'        => true,
  );

  // Check if args values are arrays, and if not, convert to array for final parsing.
  foreach ( $args as $key => $value ) {

    // end loop after array values.
    if ( $key === 'universal' ) {
      break;
    }

    if ( is_array($value) ) {
      $args[$key] = $value;
    } else {
      $args[$key] = array( $value, true );
    }

  }

  // Parse args
  $args = wp_parse_args( $args, $defaults );

  return $args;
}

function ssrp_var_dump_pre($mixed = null) {
  echo '<pre>';
  ssrp_htmlvardump( $mixed );
  echo '</pre>';
  return null;
}

function ssrp_string_dump_pre( $string ) {
  echo '<pre>';
  ssrp_html_string( $string );
  echo '</pre>';
}

function ssrp_htmlvardump( $array ) {
	ob_start();
	var_export( $array );
	echo htmlentities( ob_get_clean() );
}

function ssrp_html_string( $html ) {
  ob_start();
  echo $html;
  echo htmlentities( ob_get_clean() );
}

add_action('genesis_before_entry', 'ssrp_debug_markup' );
