<?php
function add_categories() {  
?>
 <div id="categoryformid" class="listiong_creator_container">

<?php

if(isset($_POST['addnewcat']))  
   {	
    if(!empty($_POST['catfirstname']))
	{
	   global $wpdb;		
	   $tablename = $wpdb->prefix ."tmj_services"; 
	  		  
	   $services = $wpdb->get_results("SELECT * FROM $tablename WHERE cat_name = '".$_POST['catfirstname']."'");	
	 
	   	
	   if(!empty($services))
	   {	  
		   echo "<div class='errormessage'>Category Name Already available Please try another Name.</div>";		   	
	   } 
	   else
	   {
	        $sharp = $wpdb->insert( $tablename, array(            
				'cat_name' => $_POST['catfirstname'],
				'cat_thumnail' => $_POST['catthumbnail'],
				'cat_slug' => sanitize_title($_POST['catfirstname']),
				'business_Query_keywords' => $_POST['business_Query_keywords'],
				'dt_added' => date("Y/m/d")
				)            
			);
			
			
		
            //echo $wpdb->last_query;
            
           // $wpdb->last_result;
 
            //$wpdb->last_error;
			
			
			
		    echo "<div class='success-message'>Category Is Successfully Added.</div>";	 
	   }	   
	}	
   }  


if(isset($_POST['updatebtncat']))
{
    if(!empty($_POST['catfirstname']))
	{
	   global $wpdb;		
	   $tablename = $wpdb->prefix ."tmj_services";
	  		  
	   $services = $wpdb->get_results("SELECT * FROM $tablename WHERE cat_name = '".$_POST['catfirstname']."' AND ID != '".$_GET['editcat']."'");	
	 
	   	
	   if(!empty($services))
	   {			   
		   echo "<div class='errormessage'>Category Name Already available Please try another Name.</div>";	  

	   } 	
	   else
	   {
	   	   $imageurl = $_POST['catthumbnail'];
	       global $wpdb; 
	       $tablename = $wpdb->prefix ."tmj_services";			  
		   $successupdate = $wpdb->query("UPDATE $tablename SET cat_thumnail= '".$_POST['catthumbnail']."',cat_name= '".$_POST['catfirstname']."',cat_slug= '".sanitize_title($_POST['catfirstname'])."',business_Query_keywords='".$_POST['business_Query_keywords']."' WHERE ID = '".$_POST['updatedcatid']."'");       
		   echo "<div class='success-message'>Category updated successfully.</div>";	  
	   }
    }  
}	

 	?>
	 
	 <h2>Create New Category</h2>  
	 
	 <?php
	 if(!empty($_GET['editcat']))
	 {
	   $valuemain = $_GET['editcat'];
	    global $wpdb;		
	   $tablename = $wpdb->prefix ."tmj_services";
	  		  
	   $servicesupdate = $wpdb->get_results("SELECT * FROM $tablename WHERE ID = '".$_GET['editcat']."'");	 
       
       if(!empty($servicesupdate[0]->cat_thumnail))
       {	       	
	     $imagesrcoops = $servicesupdate[0]->cat_thumnail;
	   }
	   else
	   {
	   	
         $imagesrcoops = plugin_dir_url( __FILE__ ).'/images/Placeholder.jpg';
	   }	  
	   
	   
	  /* if(!empty($servicesupdate[0]->cat_features_img))
       {	       	
	     $imagesrcoops2 = $servicesupdate[0]->cat_features_img;
	   }
	   else
	   {
	   	
         $imagesrcoops2 = plugin_dir_url( __FILE__ ).'/images/Placeholder.jpg';
	   }*/
	   
	 }	
	 else
	 {
	      $imagesrcoops = plugin_dir_url( __FILE__ ).'/images/Placeholder.jpg';
	      $imagesrcoops2 = plugin_dir_url( __FILE__ ).'/images/Placeholder.jpg';
	 }
	 ?>
	 
	 <form class="formaddcatlist" name="addcatlist" method="POST">
    	    <label for="catfirst">Category name:</label>
    	   <input type="text"  class="form-control" name="catfirstname" value="<?php echo $servicesupdate[0]->cat_name;?>" required>
           <label for="catfirst"> Busniess Listing Keywords For Query</label>
            <p class="tmj-small-info">Multiple keywords be separated by commas like (example1,example2,example3)</p>
    	    <input type="text"  class="form-control" name="business_Query_keywords" value="<?php echo $servicesupdate[0]->business_Query_keywords;?>" required>
    	   <input type="hidden"  class="form-control" name="updatedcatid" value="<?php echo $_GET['editcat'];?>" required>
           <div class="catthumbnaildiv">
            <label for="catfirst">Category Image:</label>
    	    <input type="hidden" id="image_url" class="form-control" name="catthumbnail" value="<?php echo $servicesupdate[0]->cat_thumnail;?>">	    
    	    <img id="upload-btn" class="imageuploadsharp" src="<?php echo $imagesrcoops;?>">
    	  </div> 	
    	  <!-- <div class="catthumbnaildiv">
            <label for="catfirst">Feature Category Image:</label>
    	    <input type="hidden" id="cat_features_img" class="form-control" name="cat_features_img" value="<?php echo $servicesupdate[0]->cat_features_img;?>">	    
    	    <img id="upload-btn2" class="imageuploadsharp" src="<?php echo $imagesrcoops2;?>">
    	  </div>-->
	   <br>	   	  
	   <?php
	   if(!empty($_GET['editcat']))
	   { ?>
	    <input type="submit" class="updatelifemain" name="updatebtncat" value="Update"> 	   
	   <?php }	
	   else
	   { ?>
	    <input type="submit" class="updatelifemain" name="addnewcat" value="Add"> 
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