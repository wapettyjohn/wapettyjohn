<?php 
/*
   Template Name: Resume
   */

   get_header(); 
   ?>



<div id="content">
     <div id="inner-content" class="row">
	  <?php get_sidebar(); ?>

	  <div id="main" role="main" class="sixtyCol">
	       
	       <?php
	       $jobArgs = array( 
		    'post_type'      => 'job', 
		    'posts_per_page' => -1 
	       );
	       $jobs = new WP_Query( $jobArgs );
	       while ( $jobs->have_posts() ) : $jobs->the_post();
	       $jobID = get_the_ID();
	       $employers = get_the_terms( $jobID, 'employer' );
	       $employerSlug =  $employers && ! is_wp_error( $employers ) ? reset( $employers )->slug : null;
	       ?>
	       
		    <article id="post-<?php the_ID(); ?>" <?php post_class( 'job row' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
			 <header class="job-header row">
			      <div class="sixtyCol zeroPadding">
				   <h2 class="employer"><?php the_field( 'employer' ); ?></h2>

				   <h3 class="job-title"><?php the_field( 'job_title' ); ?></h3>
			      </div> <!-- / .sixtyCol -->

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

			      <section class="projects">
				   
				   <?php
				   $projectArgs = array( 
					'post_type'      => 'project', 
					'posts_per_page' => -1, 
					'tax_query'      => array(
					     array(
						  'field'    => 'slug',
						  'taxonomy' => 'employer',
						  'terms'    => $employerSlug
					     )
					)
				   );
				   $projects = new WP_Query( $projectArgs );
				   while ( $projects->have_posts() ) : $projects->the_post();
				   $projectID = get_the_ID();
				   ?>
				
					<article class="project">
					     <header class="project-header">
						  <h4 class="project-name">
						       <?php if ( get_field( 'client' ) ) : the_field( 'client' ); ?>&ensp;/&ensp;<?php endif; the_field( 'project_name' ); ?><span class="arrow">&#9662;</span>
						  </h4> 
					     </header>
					     
					     <section class="project-content">
						  <?php if ( get_field( 'project_description' ) ) : ?>
						       <p class="project-description">
							    <?php the_field( 'project_description' ); ?>
						       </p>
						  <?php endif; ?>
						  
						  <?php if ( get_field( 'project_url' ) ) : ?>
						       <span class="project-url">
							    <a href="<?php the_field( 'project_url' ); ?>" target="_blank">See it live</a>
						       </span>
						  <?php endif; ?>

						  <?php if ( have_rows( 'project_highlights' ) ) : ?>
						       <ul class="project-highlights">
							    <?php while ( have_rows( 'project_highlights' ) ) : the_row(); ?>
								 <li class="project-highlight"><?php the_sub_field( 'project_highlight' ); ?></li>
							    <?php endwhile; ?>
						       </ul>
						  <?php endif; ?>
					     </section> <!-- / .project-content -->
					     <?php 
					     $skills = get_the_terms( get_the_ID(), 'skill' );
					     if ( $skills && ! is_wp_error( $skills ) ) :
					     ?>
					     
					     <footer class="project-footer">
						  <ul class="skills">
						       <?php foreach ( $skills as $skill ) : ?>
							    <li class="skill">
								 <a href="#"><?= $skill->name ?></a>
							    </li>
						       <?php endforeach; ?>
						  </ul>
					     </footer> <!-- / .project-footer -->
					     <?php endif; ?>
					</article> <!-- / .project -->
				   
				   <?php endwhile;  ?>
				   
			      </section> <!-- / .projects -->
			 </section> <!-- / .job-content -->
		    </article> <!-- / .job -->
	       
	       <?php endwhile; ?>
	       
	  </div> <!-- / #main -->
     </div> <!-- / #inner-content -->
</div> <!-- / #content -->

<?php get_footer(); ?>
