<?php

register_taxonomy( 'employer', 
		   array( 'job', 'project' ), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		   array('hierarchical' => true,     /* if this is true, it acts like categories */
			 'labels' => array(
     'name' => __( 'Employers', 'bonestheme' ), /* name of the custom taxonomy */
     'singular_name' => __( 'Employer', 'bonestheme' ), /* single taxonomy name */
     'search_items' =>  __( 'Search Employers', 'bonestheme' ), /* search title for taxomony */
     'all_items' => __( 'All Employers', 'bonestheme' ), /* all title for taxonomies */
     'parent_item' => __( 'Parent Employer', 'bonestheme' ), /* parent title for taxonomy */
     'parent_item_colon' => __( 'Parent Employer:', 'bonestheme' ), /* parent taxonomy title */
     'edit_item' => __( 'Edit Employer', 'bonestheme' ), /* edit custom taxonomy title */
     'update_item' => __( 'Update Employer', 'bonestheme' ), /* update title for taxonomy */
     'add_new_item' => __( 'Add New Employer', 'bonestheme' ), /* add new title for taxonomy */
     'new_item_name' => __( 'New Employer Name', 'bonestheme' ) /* name title for taxonomy */
			 ),
			 'show_admin_column' => true, 
			 'show_ui' => true,
			 'query_var' => true,
			 'rewrite' => array( 'slug' => 'employer' ),
		   )
);

register_taxonomy( 'skill', 
		   array( 'project' ), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		   array( 'hierarchical' => true,    /* if this is false, it acts like tags */
			  'labels' => array(
     'name' => __( 'Skills', 'bonestheme' ), /* name of the custom taxonomy */
     'singular_name' => __( 'Skill', 'bonestheme' ), /* single taxonomy name */
     'search_items' =>  __( 'Search Skills', 'bonestheme' ), /* search title for taxomony */
     'all_items' => __( 'All Skills', 'bonestheme' ), /* all title for taxonomies */
     'parent_item' => __( 'Parent Skill', 'bonestheme' ), /* parent title for taxonomy */
     'parent_item_colon' => __( 'Parent Skill:', 'bonestheme' ), /* parent taxonomy title */
     'edit_item' => __( 'Edit Skill', 'bonestheme' ), /* edit custom taxonomy title */
     'update_item' => __( 'Update Skill', 'bonestheme' ), /* update title for taxonomy */
     'add_new_item' => __( 'Add New Skill', 'bonestheme' ), /* add new title for taxonomy */
     'new_item_name' => __( 'New Skill Name', 'bonestheme' ) /* name title for taxonomy */
			 ),
			 'show_admin_column' => true,
			 'show_ui' => true,
			 'query_var' => true,
		   )
);
?>
