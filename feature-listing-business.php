<?php
function business_feature_listing() {  
?>
 <div id="categoryformid" class="listiong_creator_container">

<?php

if(isset($_POST['addnewcatbus']))  
{
    if(!empty($_POST['business_name']))
    {
       global $wpdb;		
	   $tablename = $wpdb->prefix ."feature_bus_listing"; 
	   $services = $wpdb->get_results("SELECT * FROM $tablename WHERE business_name = '".$_POST['business_name']."'");
	   
	   
	     if(!empty($services))
	   {	  
		   echo "<div class='errormessage'>Business Name already exits in feature listing.</div>";		   	
	   } 
	   else
	   {
	        $sharp = $wpdb->insert( $tablename, array(            
				'business_name' => $_POST['business_name'],
				'business_list_thumb' => $_POST['business_list_thumb'],
				'business_category' => $_POST['listingcategory'],
				'list_phone_number' => $_POST['list_phone_number'],
				'list_description' => $_POST['list_description'],
				'business_name_slug' => sanitize_title($_POST['business_name']),
				'date_added' => date("Y/m/d") 
				)            
			);
			
		
           // echo $wpdb->last_query;
            
           // $wpdb->last_result;
 
            //$wpdb->last_error;
			
			
			
		   echo "<div class='success-message'>Business list Is Successfully Added.</div>";	  
	   }	
	   
	   
	   
    }
}    


if(isset($_POST['updatenewcatbus']))
{
    if(!empty($_POST['business_name']))
	{
	   
	       $imageurl = $_POST['business_list_thumb'];
	       global $wpdb; 
	       $tablename = $wpdb->prefix ."feature_bus_listing";			  
		   $successupdate = $wpdb->query("UPDATE $tablename SET business_list_thumb= '".$_POST['business_list_thumb']."',business_category='".$_POST['listingcategory']."',list_description='".$_POST['list_description']."',list_phone_number='".$_POST['list_phone_number']."',business_name= '".$_POST['business_name']."' WHERE id = '".$_POST['updatedcatid']."'");      
		   
		  //echo  $wpdb->last_query;
		   echo "<div class='success-message'>Category updated successfully.</div>";	  
	   
    }  
}	
 	?>
	 <h2>Features - Business Listings</h2>  
	 
	 <?php
	 if(!empty($_GET['editcat']))
	 {
	   $valuemain = $_GET['editcat'];
	    global $wpdb;		
	   $tablename = $wpdb->prefix ."feature_bus_listing";
	  		  
	   $servicesupdate = $wpdb->get_results("SELECT * FROM $tablename WHERE id = '".$_GET['editcat']."'");	 
       
       if(!empty($servicesupdate[0]->business_list_thumb))
       {	       	
	     $imagesrcoops = $servicesupdate[0]->business_list_thumb;
	   }
	   else
	   {
	   	
         $imagesrcoops = plugin_dir_url( __FILE__ ).'/images/Placeholder.jpg';
	   }	  
	   
	 }	
	 else
	 {
	      $imagesrcoops = plugin_dir_url( __FILE__ ).'/images/Placeholder.jpg';
	      
	 }
	 ?>
		 <form class="formaddcatlist" name="addcatlist" method="POST">
    	    <label for="catfirst">Business name:</label>
    	   <input type="text"  class="form-control" name="business_name" value="<?php echo $servicesupdate[0]->business_name;?>" required>
           <!--<label for="catfirst"> Busniess Address</label>
    	    <input type="text"  class="form-control" name="business_Query_keywords" value="<?php echo $servicesupdate[0]->business_Query_keywords;?>" required>-->
    	   <input type="hidden"  class="form-control" name="updatedcatid" value="<?php echo $_GET['editcat'];?>" required>
    	   
    	    <div class="catthumbnaildiv">
            <label for="catfirst">Listing category</label>
            <?php 
    	        global $wpdb;		
	            $tablename = $wpdb->prefix ."tmj_services";
	            $serviceslist = $wpdb->get_results("SELECT * FROM $tablename");
	           ?>
    	    <select class="listingcategorycss" name="listingcategory">
    	        <?php 
    	          foreach( $serviceslist as $servi)
    	          { ?>
    	              <option value="<?php echo $servi->ID;?>" <?php if($servicesupdate[0]->business_category == $servi->ID){ echo "selected";}?>><?php echo $servi->cat_name;?></option>
    	          <?php }
    	        ?>
    	    </select>
    	  </div> 
    	  
    	   <div class="catthumbnaildiv">
             <label for="catfirst">Phone Number:</label>
    	     <input type="text" id="list_phone_number" class="form-control" name="list_phone_number" value="<?php echo $servicesupdate[0]->list_phone_number;?>">	  
    	  </div> 	
    	  
    	  
    	  
    	   <div class="catthumbnaildiv">
             <label for="catfirst">Description:</label>
             
             <textarea id="list_description" class="form-control" name="list_description">
               <?php echo $servicesupdate[0]->list_description;?>
            </textarea> 
    	  </div>
    	  
    	  
           <div class="catthumbnaildiv">
            <label for="catfirst">Feature Busniess Listing Image:</label>
    	    <input type="hidden" id="image_url" class="form-control" name="business_list_thumb" value="<?php echo $servicesupdate[0]->business_list_thumb;?>">	    
    	    <img id="upload-btn" class="imageuploadsharp" src="<?php echo $imagesrcoops;?>">
    	  </div> 	
	   
	   <br>	   	  
	   <?php
	   if(!empty($_GET['editcat']))
	   { ?>
	    <input type="submit" class="updatelifemain" name="updatenewcatbus" value="Update"> 	   
	   <?php }	
	   else
	   { ?>
	    <input type="submit" class="updatelifemain" name="addnewcatbus" value="Add"> 
	   <?php  }	 
	   ?>
	</form>

</div>
<?php
// jQuery
wp_enqueue_script('jquery');
// This will enqueue the Media Uploader script
wp_enqueue_media();
?>


<script type="text/javascript">
jQuery(document).ready(function($){
    $('#upload-btn').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#image_url').val(image_url);      
            $('#upload-btn').attr('src',image_url);
        });
    });
    
    
   /*   $('#upload-btn2').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#cat_features_img').val(image_url);      
            $('#upload-btn2').attr('src',image_url);
        });
    });*/
    
});
</script>
		 
		 

<?php }	