<aside id="sidebar" class="sidebar thirtyCol" role="complementary">
     <?php 
     function count_sort( $a,$b ) {
	  if ($a->count === $b->count ) return 0;
	  return ( $a->count > $b->count ) ? -1 : 1;
     }

     $skills = get_terms( 'skill' );
     usort( $skills, "count_sort" );

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
