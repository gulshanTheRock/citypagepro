<?php
function business_listing_pages() 
{
?>
<?php 

if(isset($_POST['updatecatgory']))
{
	$cat_name = $_POST['cat_name'];
	$post_htmlpop = $_POST['post_htmlpop'];	
	$meta_titles = $_POST['cat_meta_title'];	
	$meta_keywords = $_POST['cat_meta_keywords'];	
	$meta_description = $_POST['cat_meta_description'];	
	
	global $wpdb;
	$tablename = $wpdb->prefix ."city_states_templates";	   


	$successupdate = $wpdb->query("UPDATE $tablename SET templates_value='".addslashes($post_htmlpop)."',meta_titles='".addslashes($meta_titles)."',meta_keywords='".addslashes($meta_keywords)."',meta_description='".addslashes($meta_description)."'  WHERE templates_meta_key = 'category_temp'");
}	

?>
   <?php 

		 global $wpdb;		
		 $tablename = $wpdb->prefix ."city_states_templates";		 
		 $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE templates_meta_key = 'category_temp'");					
      	
   ?>								 
								 
     
	<div class="listiong_creator_container">	
	   <form id="categoryformid" name="categoryform" method="POST">
	      <h2>Common Category Template Setting</h2>
		   <!--<span class="spantitiles">Category Name:</span><br>
		  <input type="text" class="form-control categoryformmain"  name="cat_name" value="<?php echo $cat_id[0]->cat_name;?>">		  -->


		  <br><br>
		  <div class="textareahml"> 			
			  <?php
              $settings = array( 'textarea_name' => 'post_htmlpop' );
              wp_editor(stripslashes($cat_id[0]->templates_value), 'post_htmlpop' );
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

		  <input class="updatelifemain" name="updatecatgory" type="submit" value="Update">
		</form>	
	</div>

	<!--
	  <link rel='stylesheet' id='vpc_customizer-stylesp-css'  href='<?php echo plugin_dir_url( __FILE__ ); ?>/bootstrap/bootstrap.css?ver=4.9.10' type='text/css' media='all' />
<link rel='stylesheet' id='vpc_customizer-stylespdddd-css'  href='<?php echo plugin_dir_url( __FILE__ ); ?>/bootstrap/dataTables.bootstrap.min.css?ver=4.9.11' type='text/css' media='all' />  
	  <div class="listiong_creator_container">
	  
	  <table id="example" class="table table-striped table-bordered" style="width:100%">

	   <thead>

		  <tr>	    

			 <th>ID</th>

			 <th>Category Name</th>

			 <th>Category Slug</th>			 

			 <th>Date Added</th>
			 
			 <th></th>			

		  </tr>

	   </thead>

	   <tbody> 
	      <?php 
				  global $wpdb;
				  $tablename = $wpdb->prefix ."tmj_services";			  
				  $services = $wpdb->get_results("SELECT * FROM $tablename");	
				  foreach($services as $k=>$serv)
				  { ?>
				  <tr>				

					 <td><?php echo $serv->ID;?></td>
					 
					 <td><?php echo $serv->cat_name;?></td>

					 <td><?php echo $serv->cat_slug;?></td>							

					 <td><?php echo $serv->dt_added;?></td> 

				     <td class="cateditbtn"><a href="<?php echo home_url("wp-admin/admin.php?page=cat_templates&cat_id=".$serv->ID."");?>">Edit Template</a></th>

			     </tr>
				    
				  <?php }
		  ?>	

     </tbody>

   <tfoot>

      <tr>	    

			 <th>ID</th>

			 <th>Category Name</th>

			 <th>Category Slug</th>

			 <th>Category Template</th>

			 <th>Date Added</th>	

             <th> </th>	 

		  </tr>

   </tfoot>

</table>		  
		 
		 
	 </div> -->
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	 
	 <script>
		   $(document).ready(function() {

			$('#example').DataTable();

		} );
     </script>
	  
  <?php } 	  