<?php

//  	$paged = ($paged) ? get_query_var('paged') : 1;

$args = array(
  'post_type' => 'case-studies', // enter your custom post type
  'post_status' => 'publish',
  'posts_per_page'=> '5',  // overrides posts per page in theme settings
  'paged' => $paged,
  'order' => 'asc',
  'orderby' => 'menu_order',
);

$loop = new WP_Query( $args );
if( $loop->have_posts() ):
?>
<?php $i = 1; while( $loop->have_posts() ): $loop->the_post(); global $post; ?>
  <?php if($i == 1): ?>
    <div class="row">
    <div class="grid-3-box off-screen">
  <?php endif; ?>
  <?php if($i == 4): ?>
    <div class="row">
      <div class="grid-2-box off-screen">
  <?php endif; ?>

  <?php if($i == 4 && get_field('featured_portrait')):
    $image = get_field('featured_portrait');
    elseif(get_field('featured_landscape')):
      $image = get_field('featured_landscape');
    else:
    $image = get_field('placeholder_image','options');
  endif;?>
   <div><a href="<?php the_permalink(); ?>"><div class="overflow-hidden"><div class="box-height" style="background-image: url('<?php echo $image['sizes']['large']; ?>');"></div><div class="case-study-title overlay-text"><?php the_title(); ?></div></div></a></div>
  <?php if($i == 3 || $i == 5): ?>
        </div>
      </div>
  <?php endif; ?>
  <?php wp_reset_postdata(); ?>
<?php $i++; endwhile; ?>

<?php else : ?>
  <h2>Nulla da visualizzare</h2>
  <script>
    $('.view-more').hide();
  </script>
<?php endif; ?>
