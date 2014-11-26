<?php 
   /*
   Template Name: Grid
   */
   
get_header(); ?>

<div id="content">
  <div id="inner-content" class="wrap cf">
    <div id="main" class="" role="main">
      <?php if ( have_posts()) : while ( have_posts()) : the_post(); ?>

      <?php if ( have_rows( 'row' ) ):
	    while ( have_rows( 'row' ) ) : the_row(); ?>
      <div class="row">
	
	<?php if ( have_rows( 'column' ) ) : while ( have_rows( 'column' ) ) : the_row(); ?>
	<div class="column">
	  
	  <?php if ( get_field( 'content' ) ) : ?>
	  <div class="content">
	    <?= the_field( 'content' ); ?>
	  </div>
	  <?php endif; ?>
	
	</div>
	<?php endwhile; endif; ?>

      </div>      
      <?php endwhile; endif; ?>

      <?php endwhile; endif; ?>
    </div> <!-- / #main -->
  </div> <!-- / #inner-content -->
</div> <!-- / #content -->

<?php get_footer(); ?>
