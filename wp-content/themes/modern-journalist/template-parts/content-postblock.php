<div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
    <div class="post-block">
      <div class="post-entry-thumb objfit">
        <?php if ( has_post_thumbnail() ) {
	the_post_thumbnail('medium');
} ?>
      </div>


        <div class="post-entry-content">
          <?php $meta_date = get_post_meta(get_the_ID(), 'jourblocks_meta_date', true);

          if ($meta_date) {
              echo '<div class="post__date">' . esc_attr($meta_date) . '</div>';
          }
          ?>
          <header class="post-entry-header">
              <?php
              the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
              ?>
          </header><!-- .entry-header -->
        <?php the_excerpt(); ?>

        <?php

        $meta_authors = get_post_meta(get_the_ID(), 'jourblocks_meta_authors', true);

        if ($meta_authors) {
            echo '<div class="post__authors">By ' . esc_attr($meta_authors) . '</div>';
        }

        ?>

    </div>
</div>
