<?php  
sharp_miancheck_slug();
 get_header(); 

?>
<div class="container tmj-front-end-container">
	     <?php		   
           $sluglist = get_query_var("sluglist");  
           $idbuniness = get_numerics_tmj($sluglist);
           
           global $wpdb;		
		   $tablename = $wpdb->prefix ."city_states_templates";		 
		   $cat_result = $wpdb->get_results("SELECT * FROM $tablename WHERE templates_meta_key = 'business_tamplate'");	
           
           echo replace_text(stripslashes($cat_result[0]->templates_value));	
         ?>	 

 </div>       

<?php get_footer(); ?>