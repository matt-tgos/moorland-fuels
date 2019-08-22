<?php /* Template Name: Home */
get_header();

// Vars
$serviceText = get_field('services_text');
$ctaBG = get_field('cta_background_image');



while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'inc/hero' ); ?>

<section class="small_cta">
  <div class="container">
    <h3>Looking for a quick fuel price?</h3><a href="#" class="button secondary reversed">Get a quote</a>
  </div>
</section>

<section class="services_slider">
  <div class="container">
    <div class="content eight columns offset-by-two">
    <?php echo $serviceText; ?>
    </div>
    <div class="content ten columns offset-by-one">
      <?php       
      query_posts(array( 
        'post_type' => 'services',
        'showposts' => -1,
        'orderby'   => 'rand',
        'order'     => 'ASC',
              
      ));  
      ?>
        <div class="service-scroll">
        <?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
          <?php $icon = get_field('service_icon'); ?>
          <article>
            <a href="<?php the_permalink(); ?>">
            <div class="image">
              <div class="border">
              <img src="<?php echo $icon['url']; ?>" />
              </div>
            </div>
            <div class="content">
              <h3><?php the_title(); ?></h3>
            </div></a>
          </article>
        <?php endwhile; ?>
        </div>
        <?php else : endif; wp_reset_query(); ?>
    <a href="<?php echo get_site_url(); ?>/services" class="button primary">View all Services</a>
    </div>
  </div>
</section>

<section class="home_cta">  
    <div class="cta_bg" style="background: url('<?php echo $ctaBG['url'] ?>') center center no-repeat; background-size: cover;">
    </div>
    <div class="cta_content cta_slider">
      
      <?php if( have_rows('slide_content') ):
        while ( have_rows('slide_content') ) : the_row(); ?>
        <div class="slide">
          <div class="content">
            <h3><?php the_sub_field('title'); ?></h3>
            <?php the_sub_field('content'); ?>
            <a href="<?php the_sub_field('button_link'); ?>" class="button secondary reversed"><?php the_sub_field('button_text'); ?></a>
          </div>
        </div>
      <?php endwhile; else : endif; ?>
      </div>
    </div>
  </div>
</section>

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>