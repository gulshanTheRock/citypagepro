<?php
function state_display_sub_menu_page() {
?>		 
<?php 

if(isset($_POST['updatecatgorystate']))
{
	$cat_name_state = $_POST['cat_name_state'];
	$post_htmlpop_state = $_POST['post_htmlpop_state'];	
	$meta_titles = $_POST['cat_meta_title'];	
	$meta_keywords = $_POST['cat_meta_keywords'];	
	$meta_description = $_POST['cat_meta_description'];	
	
	global $wpdb;
	$tablename = $wpdb->prefix ."city_states_templates";	

	$successupdate = $wpdb->query("UPDATE $tablename SET templates_value='".addslashes($post_htmlpop_state)."',meta_titles='".addslashes($meta_titles)."',meta_keywords='".addslashes($meta_keywords)."',meta_description='".addslashes($meta_description)."'  WHERE templates_meta_key = 'state_temp'");
}	
?>	  	
   
   <?php 
		 global $wpdb;		
		 $tablename = $wpdb->prefix ."city_states_templates";		 
		 $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE templates_meta_key = 'state_temp'");	
   ?>	
		<div class="listiong_creator_container">         
		   <form id="categoryformid" name="categoryform" method="POST">
			  <h2>Common State Template Setting</h2>
			  <div class="textareahml"> 			
				  <?php
				  $settings = array( 'textarea_name' => 'post_htmlpop_state' );
				  wp_editor(stripslashes($cat_id[0]->templates_value), 'post_htmlpop_state' );  
				?>	 
				</div>	
               <span class="spantitiles">Meta Title:</span><br>
		      <input type="text" class="form-control categoryformmain"  name="cat_meta_title" value="<?php echo $cat_id[0]->meta_titles;?>">
              <span class="spantitiles">Meta Keywords:</span><br>
		      <input type="text" class="form-control categoryformmain"  name="cat_meta_keywords" value="<?php echo $cat_id[0]->meta_keywords;?>">
		     <span class="spantitiles">Meta Description:</span><br>
		   <textarea rows="4" cols="50" class="textfullwidth"name="cat_meta_description">
			 <?php echo $cat_id[0]->meta_description;?>
		  </textarea> 
			  <input class="updatelifemain" name="updatecatgorystate" type="submit" value="Update">
			</form>	
		</div>

	 
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	 
	 <script>
		   $(document).ready(function() {

			$('#example').DataTable();

		} );
     </script>
<?php }	