<?php
function new_category_tmj_page(){
	if(isset($_POST['addnewcat']))
   {
    if(!empty($_POST['catfirstname']))
	{
	   global $wpdb;		
	   $tablename = $wpdb->prefix ."tmj_services";	
		
	  $wpdb->insert( $tablename, array(            
            'cat_name' => $_POST['catfirstname'],
            'cat_slug' => sanitize_title($_POST['catfirstname']),
            'dt_added' => date("Y/m/d")
            )            
        );	
	  
	}	
   }  
?>
 <div id="categoryformid" class="listiong_creator_container">
	 
	 <h2>Create New Category</h2>    	 
	 
	 <form class="formaddcatlist" name="addcatlist" method="POST">
	    <label for="catfirst">Category name:</label>
	   <input type="text"  class="form-control" name="catfirstname" value="" required>
	   <br>	 
	   <input type="submit" class="updatelifemain" name="addnewcat" value="Add"> 
	</form>

</div>

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
	 </div>  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	 
	 <script>
		   $(document).ready(function() {

			$('#example').DataTable();

		} );
     </script>
<?php } 

 