<?php  

 sharp_miancheck_slug(); 

 get_header(); 



?>
	<div class="container tmj-front-end-container">
	     <?php		   
            $cat_type = get_query_var("type");  
            $state_cities = get_query_var("state_cities");  
            $citicode = get_query_var("citicode");  
            $pageno = get_query_var("page_number");   
         ?>	   
		 
		 <?php 
		  if(!empty($cat_type) && !empty($state_cities)&&!empty($citicode)) 
		  {
			    global $wpdb;		
			   $tablename = $wpdb->prefix ."tmj_services";		   
			   $cat_result = $wpdb->get_results("SELECT * FROM $tablename WHERE cat_slug = '".$cat_type."'");		     
            	// echo '<pre>';
            	// print_r($cat_result);
            	// exit();
			   echo replace_text(stripslashes($cat_result[0]->cat_template));			
		  }	 
		  else if(!empty($cat_type) && !empty($state_cities))
		  { 	      
			  global $wpdb;		
			   $tablename = $wpdb->prefix ."city_states_templates";		   
			   $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE templates_meta_key = 'state_temp'");					
			   echo replace_text(stripslashes($cat_id[0]->templates_value));			
			 
			// echo "<pre>";
			 //  print_r($actcities);
			// echo "</pre>";
			 
		  }
          else if(!empty($cat_type))		  	    
		  {            
			   global $wpdb;		
			   $tablename = $wpdb->prefix ."city_states_templates";		 
			   $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE templates_meta_key = 'category_temp'");					
			   echo replace_text(stripslashes($cat_id[0]->templates_value));											 
		  } 
		 	 
        ?>
		 

                 

	</div>
	
<?php get_footer(); ?>
<script type="text/javascript">
		function getSponsoredList(pg) 
		{
			jQuery('.loading-screen').show();
			
			var page = pg;
			if(page<=0 || page=='')
				page = 1;
			
			
			 var path = "<?php echo get_home_path_auto();?>";  
			var result = jQuery.ajax({
								type: "POST",
								url: '<?php echo WP_PLUGIN_URL;?>/wp_tmj_listing/tmj_ajax.php',
								data: 'act=getSponsoredList&page='+page+'&path='+path,
								async: false
							}).responseText;
			
			jQuery('.records-list').html(result);
			
			if(pg>0)
				goToDiv('.Sponsor-section');
			
			jQuery('.loading-screen').hide();
		}

	</script>