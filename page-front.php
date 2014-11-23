<?php 
   /*
   Template Name: Front Page
   */

   get_header(); 
   ?>

<div id="content">
     <div id="inner-content" class="row">
	  <?php get_sidebar(); ?>

	  <div id="main" class="sixtyCol" role="main">
	       <?php
	       $args = array( 'post_type' => 'job', 'posts_per_page' => -1 );
	       $loop = new WP_Query( $args );
	       while ( $loop->have_posts() ) : $loop->the_post();
	       ?>

		    <article id="post-<?php the_ID(); ?>" <?php post_class( 'job row' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
			 <header class="job-header row">
			      <div class="sixtyCol zeroPadding">
				   <h2 class="job-title"><?php the_field( 'job_title' ); ?></h2>

				   <p class="employer h3">
					<?php the_field( 'employer' ); ?>
				   </p>
			      </div> <!-- / .col -->

			      <p class="job-dates thirtyCol zeroPadding">
				   <?php the_field( 'begin_date' ); ?>&ensp;&ndash;&ensp;<?php the_field( 'end_date' ); ?>
			      </p>
			 </header> <!-- / .job-header -->

			 <section class="job-content">
			      <?php if ( get_field( 'job_description' ) ) : ?>
				   <p class="job-description">
					<?php the_field( 'job_description' ); ?>
				   </p>
			      <?php endif; ?>

			      <?php if ( have_rows( 'project' ) ) : ?>
				   <section class="projects">
					<?php while( have_rows( 'project' ) ) : the_row(); ?>
					     <article class="project">
						  <header class="project-header">
						       <h4 class="project-name"><?php the_sub_field( 'project_name' ); ?><span class="arrow">&#9662;</span></h4> 
						  </header>

						  <section class="project-content">
						       <p class="project-description">
							    <?php the_sub_field( 'project_description' ); ?>
						       </p>
						  </section> <!-- / .project-content -->
					     </article> <!-- / .project -->
					<?php endwhile; ?>
					
				   </section> <!-- / .projects -->
			      <?php endif; ?>

			 </section> <!-- / .job-content -->

			 <?php 
			 $jobTags = get_the_terms( get_the_ID(), 'job_tag' ); 
			 if ( $jobTags && ! is_wp_error( $jobTags ) ) :
			 ?>
			 <ul class="job-tags">
			 <?php foreach ( $jobTags as $tag ) : ?>
			      <li class="job-tag">
				   <a href="/job_tag/<?= $tag->slug ?>">
					<?= $tag->name ?>
				   </a>&ensp;
			      </li>
			 <?php endforeach; ?>
			 </ul> <!-- / .job-tags -->
			 <?php endif; ?>
		    </article> <!-- / .job -->
		    
	       <?php endwhile; ?>
	  </div> <!-- / #main -->
     </div> <!-- / #inner-content -->
</div> <!-- / #content -->

<?php get_footer(); ?>
