<?php get_header(); ?>

<section id="studio-index" class="row">
  <div class="small-12 columns">
    <h2><?php the_title(); ?></h2>
    <div class="row">
      <div class="small-12 columns">
        <?php

          // Display basic page content
          the_post();
          the_content();

    		?>
      </div>
    </div>


    <div class="content-block-padded">
      <div class="row game-submission">
        <?php if ( is_user_logged_in() ): ?>
          <div class="small-12 medium-4 columns">
            <a href="<?php echo admin_url( 'post-new.php?post_type=studio' ); ?>" class="button">Submit a Studio</a>
          </div>
          <div class="small-12 medium-8 columns">
            <p>Interested in presenting at an Indienomicon event? Submit your studio!</p>
          </div>
        <?php else: ?>
          <div class="small-12 medium-4 columns">
            <a href="<?php echo wp_registration_url(); ?>" class="button">Register</a>
          </div>
          <div class="small-12 medium-8 columns">
            <p>Interested in presenting at an Indienomicon event? Register your Indienomicon account and then come back to this page to submit your studio!</p>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="item-index">
      <?php

        // Create a WordPress query to gather all of the games.
        $args = array(
        	'post_type' => 'studio',
        	'posts_per_page' => -1, // Unlimited posts
          'order' => 'ASC',
        	'orderby' => 'title' // Order alphabetically by title
        );
        $studios = new WP_Query( $args );

        // Render all of the games returned by the query.
        if( $studios->have_posts() ):
          while ( $studios->have_posts() ) : $studios->the_post();
            get_template_part( 'studio-listing' );
          endwhile;
        endif;

        // Restore global post data stomped by the_post().
        wp_reset_query();

      ?>
    </div>

  </div>
</section>

<?php get_footer(); ?>
