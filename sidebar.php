<aside id="sidebar" class="sidebar thirtyCol" role="complementary">
     <?php 
     $skills = get_terms( 'skill' );
     if ( $skills && ! is_wp_error( $skills ) ) :
     
     ?>
	  <ul class="skills clearfix">
	       <?php foreach ( $skills as $skill ) : ?>
		    <li class="skill">
			 <a href="#" count="<?= $skill->count ?>">
			      <?= $skill->name ?>
			 </a>
		    </li>
	       <?php endforeach; ?>
	  </ul> <!-- / .skills -->
	  <a href="#" class="view-all">View all&ensp;<span>&#10548;</span></a>
     <?php endif; ?>
</aside>
