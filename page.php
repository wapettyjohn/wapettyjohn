<?php get_header(); ?>

<div id="content">
  <div id="inner-content" class="wrap cf">
    <div id="main" class="m-all t-2of3 d-5of7 cf" role="main">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
	<header class="article-header">
	  <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
	</header> <!-- / .article-header -->

	<section class="entry-content cf" itemprop="articleBody">
	  <?php the_content(); ?>
	</section> <!-- / .entry-content -->

	<footer class="article-footer cf">
	</footer> <!-- / .article-footer-->
      </article> <!-- / .hentry -->

      <?php endwhile; else : ?>

      <article id="post-not-found" class="hentry cf">
	<header class="article-header">
	  <h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
	</header> <!-- / .article-header -->

	<section class="entry-content">
	  <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
	</section> <!-- / .entry-content -->

	<footer class="article-footer">
	  <p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
	</footer> <!-- / .article-footer-->
      </article> <!-- / .hentry -->

      <?php endif; ?>
    </div> <!-- / #main -->

    <?php get_sidebar(); ?>
  </div> <!-- / #inner-content -->
</div> <!-- / #content -->

<?php get_footer(); ?>
