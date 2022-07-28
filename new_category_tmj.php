<?php
//ob_clean();
//ob_start();
function new_category_tmj_page_cat(){ 
	
?>
<div class="custom-head">Categories</div>
 <div id="categoryformid" class="listiong_creator_container boder-none">    	
 <?php 
 if(isset($_GET['deletecat']))
	{
	  $delete = $_GET['deletecat'];
	  global $wpdb;
	  $tablename = $wpdb->prefix ."tmj_services";	 
	  $deleted = $wpdb->delete( $tablename, array( 'ID' => $_GET['deletecat'] ) );			
	 	 	
	  $redirecturl = admin_url('admin.php?page=new_category_tmj&del=success');	
	  header('location: '.$redirecturl);	
	  exit;
	}	
	
	if(isset($_GET['del']))
	{
	   echo "<div class='success-message deletecat_tmj'>Category Is Deleted Successfully.</div>";	  
	}
 ?>	
	 <a class="updatelifemain cataddbuttons" href="<?php echo admin_url('admin.php?page=add_categories');?>">Add New Category</a>
 	 
 <link rel='stylesheet' id='vpc_customizer-stylesp-css'  href='<?php echo plugin_dir_url( __FILE__ ); ?>/bootstrap/bootstrap.css?ver=4.9.10' type='text/css' media='all' />
<link rel='stylesheet' id='vpc_customizer-stylespdddd-css'  href='<?php echo plugin_dir_url( __FILE__ ); ?>/bootstrap/dataTables.bootstrap.min.css?ver=4.9.11' type='text/css' media='all' />  
	  <div class="listiong_creator_containerfff">
	  
	  <table id="example" class="table table-striped table-bordered" style="width:100%">

	   <thead>

		  <tr>	    

			 <th>ID</th>

			 <th>Category Name</th>			 

			  <th>Category Slug</th>	

			   <th>Busniess Listing Keywords For Query</th>	 	 

			 <th>Date Added</th>
			 <th></th>
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

					 <td><?php echo $serv->business_Query_keywords;?></td>						

					 <td><?php echo $serv->dt_added;?></td> 	
					  
					 <td><a href="<?php echo admin_url('admin.php?page=add_categories&editcat='.$serv->ID.'');?>">Edit</a></td>  
					  
		             <td><a href="<?php echo admin_url('admin.php?page=new_category_tmj&deletecat='.$serv->ID.'');?>">Delete</a></td> 		          

			     </tr>
				    
				  <?php }
		  ?>	
       </tbody>

   <tfoot>

          <tr>	    

			 <th>ID</th>

			 <th>Category Name</th>

			 <th>Category Slug</th>	

			 <th>Busniess Listing Keywords For Query</th>
      

			 <th>Date Added</th>	
             <th></th>
			 <th></th> 		

		  </tr>

   </tfoot>
</table>	
	 </div>  
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	 
	 <script>
		   $(document).ready(function() {

			$('#example').DataTable();

		} );
     </script>
<?php }