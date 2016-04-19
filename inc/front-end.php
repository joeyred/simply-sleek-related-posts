<?php
/**
 * Frontend Markup
 *
 * @since 0.1.0
 */

function ssrp_do_post_card() {

  ?>

  <a class="ssrp-related-post-link-wrap" href="" title="">

    <div class="ssrp-related-post-outer">

      <div class="ssrp-related-post-inner">

        <h3 class="ssrp-post-title">Post Title</h3>

        <hr />

        <h6 class="ssrp-post-time">Time Published</h6>

        <h6 class="ssrp-post-author">by Author</h6>

      </div>

      <div class="ssrp-hover-overlay">

        <span class="ssrp-read-more-link">Read More</span>

      </div>

    </div>

  </a>


  <?php
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
  $class_pattern = ssrp_markup( array(
    'ssrp'        => 'ssrp-%s-block-grid-%s',
    'bootstrap'   => 'col-%s-%s',
    'foundation5' => '%s-block-grid-%s',
    'foundation6' => '%s-up-%s',
    'echo'        => false,
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

function ssrp_do_frontend_markup() {

  // Options that will have to be pulled from options page
  $num_cards = 6;
  $per_row = array(
    'small' => 1,
    'medium' => 2,
    'large' => 3,
    'xlarge' => 3,
    'xxlarge' => 4,
  );



  echo '<div class="ssrp-related-post-widget">';

  // Widget Title
    // From extracted `$args`

  // Block Grid Container - Open
  ssrp_markup( array(
    'ssrp'        => '<ul class="ssrp-block-grid ssrp-small-block-grid-1 ssrp-medium-block-grid-2 ssrp-large-block-grid-3">',
    'bootstrap'   => '<div class="row">',
    'foundation5' => '<ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">',
    'foundation6' => '<div class="row small-up-1 medium-up-2 large-up-3">',
  ) );


  if ( ssrp_which_markup() === 'ssrp' ) {
    ?>


      <h3 class="ssrp-widget-title">Widget Title</h3>

      <ul class="ssrp-block-grid ssrp-small-block-grid-1 ssrp-medium-block-grid-2 ssrp-large-block-grid-3">
        <?php
        for ( $i = 0; $i < $num_cards; $i++ ) {

          echo '<li class="ssrp-related-post">';

          ssrp_do_post_card();

          echo '</li>';
         }
        ?>
      </ul>

    <?php
  } elseif ( ssrp_which_markup() === 'bootstrap' ) {
    ?>
    <div class="row">

      <h3 class="widget-title">Widget Title</h3>

      <?php
      for ( $i = 0; $i < $num_cards; $i++ ) {
        echo '<div class="col-sm-12 col-md-6 col-lg-4 ssrp-related-post">';
        ssrp_do_post_card();
        echo '</div>';
       }
      ?>

    </div>
    <?php
  } elseif ( ssrp_which_markup() === 'foundation5' ) {
    ?>
    <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">

      <h3 class="widget-title">Widget Title</h3>

      <?php
      for ( $i = 0; $i < $num_cards; $i++ ) {
        echo '<li class="ssrp-related-post">';
        ssrp_do_post_card();
        echo '</li>';
       }
      ?>
    </ul>
    <?php
  } elseif ( ssrp_which_markup() === 'foundation6' ) {
    ?>
    <div class="row small-up-1 medium-up-2 large-up-3">

      <h3 class="widget-title">Widget Title</h3>

      <?php
      for ( $i = 0; $i < $num_cards; $i++ ) {
        echo '<div class="column ssrp-related-post">';
        ssrp_do_post_card();
        echo '</div>';
       }
      ?>
    </div>
    <?php
  }
  echo '</div>';
}
