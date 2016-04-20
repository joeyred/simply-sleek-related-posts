<?php
/**
 * Frontend Markup
 *
 * @since 0.1.0
 */

function ssrp_do_post_card( $post ) {

  setup_postdata( $post );

  if ( has_post_thumbnail() ) {

    $thumbnail_src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

    $atts = array(
      'style' => sprintf( ' style="background-image: url(%s);"', $thumbnail_src ),
      'class' => ' related-post-thumbnail',
    );

  } else {
    $atts = array(
      'style' => '',
      'class' => ' ssrp-placeholder',
    );
  }

  $card_bg = sprintf( 'class="ssrp-related-post-outer%s"%s', $atts['class'], $atts['style'] );

  ?>

  <a class="ssrp-related-post-link-wrap" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">

    <div <?php echo $card_bg; ?>>

      <div class="ssrp-related-post-inner">

        <h3 class="ssrp-post-title"><?php the_title(); ?></h3>

        <hr />

        <h6 class="ssrp-post-time"><?php the_time('F j, Y'); ?></h6>

        <h6 class="ssrp-post-author">by <?php echo get_the_author();  ?></h6>

      </div>

      <div class="ssrp-hover-overlay">

        <span class="ssrp-read-more-link">Read More</span>

      </div>

    </div>

  </a>
  <?php

  // IDEA add options to add framework typography classes to card elements
}

/**
 * Get block grid classes to be inserted in frontend markup. This function checks the
 * current markup as well as option values.
 *
 * @since 0.1.0
 *
 * @return string       Classes
 */
function ssrp_get_block_grid_classes() {

  if ( ssrp_which_markup() === 'bootstrap' ) {
    $per_row = array( '1', '2', '3', '4' );
    $queries = array( 'xs', 'sm', 'md', 'lg');
  } else {
    $per_row = array( '1', '2', '3', '3', '4' );
    $queries = array( 'small', 'medium', 'large', 'xlarge', 'xxlarge' );
  } // TODO Replace with option values.

  // `sprintf()` patterns.
  $class_pattern = ssrp_attr( array(
    'ssrp'        => 'ssrp-%s-block-grid-%s',
    'bootstrap'   => 'col-%s-%s',
    'foundation5' => '%s-block-grid-%s',
    'foundation6' => '%s-up-%s',
  ) );

  // Variables needed to correctly set values in `foreach` loop.
  $i = 0;
  $classes = array();

  foreach ( $queries as $query ) {

    // if option is set, create class string, otherwise increment `$i`.
    if ( $per_row[$i] !== '0' ) {
      // Create the class.
      $class = sprintf( $class_pattern, $queries[$i], $per_row[$i] );
      // Store class in array.
      $classes[$query] = $class;

    }
    // Bump up array key.
    $i++;
  }
  // Put it all together as a big string.
  $output = implode( ' ', $classes );

  return $output;
}

function ssrp_do_frontend_markup( $related_posts, $widget_title ) {

  $block_classes = ssrp_get_block_grid_classes();

  echo '<div class="ssrp-related-post-widget">';

  // TODO Widget Title
  echo $widget_title;

  // Block Grid Container - Open
  ssrp_markup( array(
    'ssrp'        => '<ul class="ssrp-block-grid %s">',
    'bootstrap'   => array( '<div class="row">', false ),
    'foundation5' => '<ul class="%s">',
    'foundation6' => '<div class="row %s">',
    'universal'   => $block_classes,
  ) );

  global $post;
  foreach( $related_posts as $post ) {

    ssrp_markup( array(
      'ssrp'        => '<li class="%s">',
      'bootstrap'   => '<div class="' . $block_classes . ' %s">',
      'foundation5' => '<li class="%s">',
      'foundation6' => '<div class="column %s">',
      'universal'   => 'ssrp-related-post',
    ) );

    // TODO Card Content
    ssrp_do_post_card( $post );

    // Close Block
    ssrp_markup( array(
      'ssrp'        => '</li>',
      'bootstrap'   => '</div>',
      'foundation5' => '</li>',
      'foundation6' => '</div>',
    ) );
  }

  // Close Block Grid
  ssrp_markup( array(
    'ssrp'        => '</ul>',
    'bootstrap'   => '</div>',
    'foundation5' => '</ul>',
    'foundation6' => '</div>',
  ) );

  // Close Widget Container
  echo '</div>';

}
