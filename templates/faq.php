<?php /* Template name: FAQ */
get_header(); ?>

<section class="hero small">
  <div class="container">
    <div class="content ten columns offset-by-one">
      <h1><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </div>
  </div>
</section>

<section class="faq_topics">
  <div class="container">
    <div class="twelve columns">
    <?php $taxonomy = 'topics'; $terms = get_terms($taxonomy);
      $currentterm = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
      if ( $terms && !is_wp_error( $terms ) ) :
    ?>
    <ul class="topics">
      <?php foreach ( $terms as $term ) { $class = $currentterm->slug == $term->slug ? 'current' : '' ; ?>
        <li class="<?php echo $class; ?>"><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
      <?php } ?>
    </ul>
    </div>
  </div>
</section>

<section class="faq_listing">
  <div class="container">
  <div class="twelve columns">
    <?php endif;  wp_reset_query();?>
    <?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
      <div class="tab">
        <div class="accordionItem close">
        <h3 class="accordionItemHeading"><?php the_title(); ?></h3>
          <div class="accordionItemContent">
            <?php the_content(); ?>        
          </div>
        </div>
      </div>
    <?php endwhile; ?>
    <?php // Todo: Make sure all FAQs disply on one page ?>
    </div>
    <?php else : ?>
      <!-- No posts found -->
    <?php endif; wp_reset_query(); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>