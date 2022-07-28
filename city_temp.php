<?php
function city_display_sub_menu_page() {  
?>	
<style>
#wpfooter {
	display: none;
}
</style>
<?php 
if(isset($_POST['updatecatgory']))
{	
	$post_htmlpop = $_POST['post_htmlpop'];	
	$meta_titles = $_POST['cat_meta_title'];	
	$meta_keywords = $_POST['cat_meta_keywords'];	
	$meta_description = $_POST['cat_meta_description'];
	
	global $wpdb;
	$tablename = $wpdb->prefix ."tmj_services";	
	$successupdate = $wpdb->query("UPDATE $tablename SET cat_template='".addslashes($post_htmlpop)."',meta_titles='".addslashes($meta_titles)."',meta_keywords='".addslashes($meta_keywords)."s',meta_description='".addslashes($meta_description)."' WHERE ID = '".$_GET['cat_id']."'");
}	

if(!empty($_GET['cat_id'])) 
{ ?>
   <?php 

		 global $wpdb;		
		 $tablename = $wpdb->prefix ."tmj_services";		 
		 $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE ID = '".$_GET['cat_id']."'");			
													 
   ?>								 
							 
    
	<div class="listiong_creator_container ffffffffffff">   
     
	    <form id="categoryformid" name="categoryform" method="POST">
	      <h2>City Template Based On <?php echo $cat_id[0]->cat_name;?></h2> 
		   <span class="spantitiles">Category Name :  <b><?php echo $cat_id[0]->cat_name;?></b></span><br>		 
		  <br><br>
		  <div class="textareahml"> 			
			  <?php
              $settings = array( 'textarea_name' => 'post_htmlpop' );
              wp_editor(stripslashes($cat_id[0]->cat_template), 'post_htmlpop' );
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

<?php 
}	
    else
	{   
    ?>	
   		  
	  <link rel='stylesheet' id='vpc_customizer-stylesp-css'  href='<?php echo plugin_dir_url( __FILE__ ); ?>/bootstrap/bootstrap.css?ver=4.9.10' type='text/css' media='all' />
<link rel='stylesheet' id='vpc_customizer-stylespdddd-css'  href='<?php echo plugin_dir_url( __FILE__ ); ?>/bootstrap/dataTables.bootstrap.min.css?ver=4.9.11' type='text/css' media='all' />  
	  <div class="listiong_creator_container">


 <?php 

		 global $wpdb;		
		 $tablename = $wpdb->prefix ."city_states_templates";		 
		 $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE templates_meta_key = 'citi_templates'");					
      	
   ?> 	
	  
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

				     <td class="cateditbtn"><a href="<?php echo home_url("wp-admin/admin.php?page=city_temp&cat_id=".$serv->ID."");?>">Edit Template</a></th>

			     </tr>
				    
				  <?php }
		  ?>	
       </tbody>

   <tfoot>

      <tr>	    

			 <th>ID</th>

			 <th>Category Name</th>

			 <th>Category Slug</th>			

			 <th>Date Added</th>	

             <th> </th>	 

		  </tr>

   </tfoot>

</table>			  
		 
	<?php } ?> 
	 </div> 
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	 
	 <script>
		   $(document).ready(function() {

			$('#example').DataTable();

		} );
     </script>
	 </div>
<?php }