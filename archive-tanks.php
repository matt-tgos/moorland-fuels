<?php /* Services Archive */
get_header(); 
?>

<section class="hero small">
  <div class="container">
    <div class="content ten columns offset-by-one">
      <h1>Tank orders</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <div class="basic_filters">
        <h2>Find out more about our product ranges:</h2>
        <a href="<?php echo get_site_url(); ?>/tanks/?type=12&tank_width=" class="button primary bunded">Bunded tanks</a>
        <a href="<?php echo get_site_url(); ?>/tanks/?type=13&tank_width=" class="button primary fuel">Fuel dispensers</a>
        <a href="<?php echo get_site_url(); ?>/tanks/?type=14&tank_width=" class="button primary enviroblu">Enviroblu tanks</a>
      </div>
    </div>
  </div>
</section>

<section class="post tank_listing">
  <div class="container">
    <div class="twelve columns">
      <div class="main_content">
        <div class="twelve columns grid">
          <?php 
    
            $queryType = $_GET['type'];
            $width = $_GET['tank_width'];
            $low = intval($_GET['price-low']);
            $high = intval($_GET['price-high']);
            $lowSize = intval($_GET['size-low']);
            $highSize = intval($_GET['size-high']);
            
            query_posts(array( 
              'post_type'  => 'tanks',
              'showposts'  => -1,
              'orderby'    => "tile",
              'order'      => 'ASC',
              'meta_query' => array(
                'relation' => 'AND',
                array(
                  'relation' => 'OR',
                  array(
                    'meta_key' => 'basic',
                    'value' => array($low, $high),
                    'type'     => 'numeric',
                    'compare' => 'BETWEEN'
                  ),
                  array(
                    'meta_key' => 'full_spec',
                    'value' => array($low, $high),
                    'type'     => 'numeric',
                    'compare' => 'BETWEEN'
                  )
                ),
                array(
                  'relation' => 'OR',
                  array(
                    'meta_key' => 'size',
                    'value' => array($lowSize, $highSize),
                    'type'     => 'numeric',
                    'compare' => 'BETWEEN'
                  ),
                  array(
                    'meta_key' => 'size',
                    'value' => array($lowSize, $highSize),
                    'type'     => 'numeric',
                    'compare' => 'BETWEEN'
                  )
                ),
                array(
                  'taxonomy' => 'types',
                  'value'   => $queryType,
                  'compare' => '=',
                ),
                array(
                  'taxonomy' => 'tank_width',
                  'value'   => $width,
                  'compare' => '=',
                ),
                
              )
            ));  
          ?>
          
          <?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
          
          <?php 
          // Tank Details
          $type = get_field('type');
          $size = get_field('size');
          $name = get_field('name');
          // Price
          $basic = get_field('basic');
          $full = get_field('full_spec');
          $request = get_field('price_on_request');
          // Capacity
          $brimful = get_field('brimful');
          $nominal = get_field('nominal');
          // Dimensions
          $length = get_field('length');
          $width = get_field('width');
          $height = get_field('height');
          $footprint = get_field('footprint');
          $tankWidth = get_field('tank_width');
          ?>
          
          <article class="<?php $term = get_term( $type ); echo $term->slug; ?> <?php echo $size; ?>">
            
            <a href="<?php the_permalink(); ?>">
            <div class="image">
              <?php the_post_thumbnail('featured-img'); ?>
            </div>
            </a>
            
            <div class="heading">
              
              <div class="name"><?php echo $size; ?> <?php echo $name; ?></div>
              
              <div class="price">
                <?php if ($request == '1') { // Price on request ?>
                <div class="cost single"><span class="info">On request</span>£ -</div>
                <?php } else { ?>
                  <?php if($full && $basic) { ?>
                  <div class="cost double"><span class="info">Basic</span>£<?php echo $basic; ?></div>
                  <div class="cost double"><span class="info">Full spec</span>£<?php echo $full; ?></div>
                  <?php } else { ?> 
                  <div class="cost single"><span class="info">Full spec</span>£<?php echo $full; ?></div>
                  <?php } ?>
                <?php } ?>
              </div>
              
            </div>
            <div class="content">
              
              <div class="litres">
                <div class="brimful"><?php echo $brimful; ?> litres<span class="info">Brimful</span></div>
                <div class="nominal"><?php echo $nominal; ?> litres<span class="info">Nominal</span></div>
              </div>
              
              <div class="size">
                <div class="length"><?php echo $length; ?>mm<span class="info">Length</div>
                <div class="width"><?php echo $width; ?>mm<span class="info">Width</div>
                <div class="height"><?php echo $height; ?>mm<span class="info">Height</div>
              </div>
              
              <div class="footprint">
                <?php echo $footprint; ?>mm <span class="info">Footprint</span>
              </div>
              
              <a href="<?php the_permalink(); ?>" class="button primary">View product</a>
            
            </div>
          </article>

          <?php endwhile; ?>
        </div>
        <?php else : ?>
        <div class="no_match">
          <h3>No results found</h3>
          <p>There are no matching Tanks based on your search filters.</p>
          <p><a href="<?php echo get_site_url(); ?>/tanks/" class="button">Reset filters</a></p>
        </div>
        <?php endif; wp_reset_query(); ?>
      </div>
    </div>
  </div>
</section>

<?php get_template_part('inc/filters'); ?>

<?php get_footer(); ?>