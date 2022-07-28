<?php
function sd_display_sub_menu_page() {	            		  
?>	
     <div id="checkboxlistcontainerppp" class="listiong_creator_container">
     	<?php 
     	if(isset($_POST['sharpcat_forms_gernal']))
		{
	        $cat_meta_api_key = $_POST['cat_meta_api_key'];
	        $cat_meta_listings = $_POST['cat_meta_listings_perpage'];
	        $enablelisting = $_POST['enablelisting'];

	       
	         update_option( 'cat_tmj_meta_api_key',$cat_meta_api_key);	
	         update_option( 'cat_tmj_meta_key_perpage',$cat_meta_listings);	
	         update_option( 'cat_tmj_enablelisting',$enablelisting);	

	         echo "<div class='success-message'>Details are updated successfully.</div>";	  
		}	      
     	?>
       <h2>Gernal Settings</h2>
     <form class="gernalsetform" method="POST" action="<?php echo admin_url('admin.php?page=Setting_listing/#checkboxlistcontainerppp');?>">  
        <?php 
         $url = "&act=get_business_listing&page=1&state=ak";
         $response_tmj = parcelly_remote_curl($url);
         
        // echo "<pre>";
         //   print_r($response_tmj);
         //echo "</pre>";
         
         if(!empty($response_tmj->error))
         {
             $messageshow = "your Api key is invalid or your Subscription is expired , Please contact to support.";
             $classshow = "helpred";
         }
         else
         {
             $messageshow = "Now you are connected to city pro.";
             $classshow = "helpgreen";
         }
        ?>
     	<span class="spantitiles">Api Key</span>
       <input type="text" class="form-control categoryformmain" name="cat_meta_api_key" value="<?php echo get_option('cat_tmj_meta_api_key');?>">
       <p class="<?php echo $classshow;?>"><?php echo $messageshow;?></p>
       <span class="spantitiles">Listings No. Per Page</span>
       <input type="number" class="form-control categoryformmain" name="cat_meta_listings_perpage" value="<?php echo get_option('cat_tmj_meta_key_perpage');?>">    
       <b>By Default 10 Posts will be shown.</b>      
       <span class="spantitiles"> <input type="checkbox" class="form-control" name="enablelisting" value="1" <?php echo (get_option('cat_tmj_enablelisting') == 1)?'checked':'';?>>Hide Listings from Human Vistors</span>
	   <br>
        <input type="submit" name="sharpcat_forms_gernal" class="tnj_buttons" value="update">	
		
     </form>  
     </div>	

	 <div id="checkboxlistcontainer"  class="listiong_creator_container">

	 	<?php 
        global $wpdb;
	    $tablename = $wpdb->prefix ."business_cities"; 
	    $sic_cat = $wpdb->get_results("SELECT DISTINCT state_name FROM $tablename "); 
	    
	          if(isset($_POST['deselectallstates']))  
			  {  	
					global $wpdb; 
				    $tablename = $wpdb->prefix ."business_cities";
    				 $successupdate = $wpdb->query("UPDATE $tablename SET status= 'D'");	

				     echo "<div class='success-message'>All States are de-selected successfully.</div>";	  
			   }	

	              foreach($sic_cat as $k=>$catgory)
        		  {				 			   
        			     if($k == 0) 
        				  {	 
        				    $firstate = $catgory->state_name;
        				  }	
        	       }

	            if(isset($_POST['sharplistupdate']))  
				{  	
			        $statename = $_POST['state_selectbx'];
			        $hiddenstate = $_POST['hiddenstate'];
					global $wpdb; 
				    $tablename = $wpdb->prefix ."business_cities";
					
    				  $successupdate = $wpdb->query("UPDATE $tablename SET status= 'D' WHERE state_name='".$hiddenstate."'");	
    				  if(!empty($_POST['citiescheck']))
    				  {	
    					foreach($_POST['citiescheck'] as $changeid)
    					{ 		    
    						$successupdate = $wpdb->query("UPDATE $tablename SET status='A' WHERE ID='".$changeid."'"); 
    
    
    					}
    				  }	

				  echo "<div class='success-message'>Cities updated successfully.</div>";	  
			   }	

	 	?>
	      	  
	      <h2> <span class="iconify" data-icon="dashicons:arrow-right-alt2" data-inline="false"></span> Enable and Disable cities in <span class="currentstatename"><?php echo $firstate;?></span></h2> 
		   <select id="stateselection" name="state_selectbx">  
			  <?php 			
			  foreach($sic_cat as $k=>$catgory)
			  {				 			   
			     if($k == 0) 
				  {	 
				    $firstate = $catgory->state_name;
				  }	
				 echo "<option value='".$catgory->state_name."'>".$catgory->state_name."</option>"; 
			  }					
			 ?>	 
		 </select>
		 </br> <label><input type="checkbox" name="sampleselectall" class="selectall"/> Select all</label>
		 <div id="checkboxlist" class="cities_list_enable">
		   <form  name="updatelist" method="POST" action="<?php echo admin_url('admin.php?page=Setting_listing/#checkboxlistcontainer');?>">
		     <div class="state_cities_form">
			  <?php 
				  global $wpdb;
				  $tablename = $wpdb->prefix ."business_cities";			  
				  $sic_citi = $wpdb->get_results("SELECT ID,City,status FROM $tablename WHERE state_name = '".$firstate."'");		  
				  
				  
				  
				   echo "<ul class='catlistsmain'>";
					  foreach($sic_citi as $k=>$catgory)
					  {				 			   
						  if($k % 20 == 0 && $k != 0) 
						  {	 
						   echo "</ul><ul class='catlistsmain'>";
						  }	
                          $checked = '';						  
						  if($catgory->status == 'A')
						  {
							  $checked = 'Checked';
						  }						  
						  echo "<li><label><input class='cat-checkbox' name='citiescheck[]' type='checkbox' value=".$catgory->ID." ".$checked.">".$catgory->City."</label></li>"; 
					  }
				   echo "</ul>";	
			  ?>	
			  </div>
			  <input type="hidden" class="hiddenstate" name="hiddenstate" value="<?php echo $firstate;?>">
			 <div class="submitbuttontnj"> 
              <input type="submit" name="sharplistupdate" class="tnj_buttons" value="update">		
              <input type="submit" name="deselectallstates" class="tnj_buttons" value="De-select all States">
			 </div> 
		   </form>
		 </div>
		 
	 </div>
<script>
  jQuery(document).ready(function(){

      jQuery('input[name="sampleselectall"]').click(function(){

            if(jQuery(this).prop("checked") == true){               
				jQuery('.cat-checkbox').attr('checked','checked');
            }

            else if(jQuery(this).prop("checked") == false){               
				  jQuery('.cat-checkbox').removeAttr('checked');
            }

        });

 });

 jQuery( document ).ready(function() {	 
	  
	 jQuery('#stateselection').on('change', function() {
        var path = "<?php echo $path = get_home_path_auto();?>";    
		var formdata = {selectedval:this.value,tmjpostcodeserch:'tmjpostcodeserch',path:path};
        jQuery.ajax({
										  type:'POST',
										  data: formdata,
										  url: '<?php echo plugin_dir_url( __FILE__ );?>/tmj_ajax.php', 
										  dataType:'json', 
										  success: function(data)
										  {
                                             
											 var json_obj =  JSON.stringify(data);
											 var finalstatus = JSON.parse(json_obj);
											 var tablesdata = finalstatus.htmlmain;
											 var currentcity = finalstatus.currentcity;

											 jQuery('.state_cities_form').html(tablesdata); 
											 jQuery('.currentstatename').html(currentcity); 
											 jQuery('.hiddenstate').val(currentcity); 

										  }    



					});			
     });
  });	 
</script>	
 
<?php }	