<?php

function ssrp_do_post_card() {

  ?>
  <li class="ssrp-related-post">
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
  </li>

  <?php
}

function ssrp_do_frontend_markup() {
  ?>

  <div class="ssrp-related-post-widget">

    <h3 class="ssrp-widget-title">Widget Title</h3>

    <ul class="ssrp-block-grid">
      <?php
      for ( $i = 0; $i < 3; $i++ ) {

        ssrp_do_post_card();
       }
      ?>
    </ul>
  </div>

  <?php
}
