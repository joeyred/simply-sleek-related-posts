<?php

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

function ssrp_do_frontend_markup() {

  $num_cards = 6;

  echo '<div class="ssrp-related-post-widget">';

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
