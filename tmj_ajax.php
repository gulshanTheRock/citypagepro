<?php 

$path = $_POST["path"];

include_once($path.'/wp-config.php' );
if($_POST["tmjpostcodeserch"] == 'tmjpostcodeserch')
{  
	$tmjpostcodeserch = $_POST["tmjpostcodeserch"];    
	$selectedval = $_POST["selectedval"];  
	
	global $wpdb;
	$tablename = $wpdb->prefix ."business_cities";			  
	$sic_citi = $wpdb->get_results("SELECT ID,City,status FROM $tablename WHERE state_name = '".$selectedval."'");
	
    if(!empty($sic_citi))
    {		
	 $html = "<ul class='catlistsmain'>";
					  foreach($sic_citi as $k=>$catgory)
					  {				 			   
						  if($k % 20 == 0 && $k != 0) 
						  {	 
						  $html.="</ul><ul class='catlistsmain'>"; 
						  }		
                          $checked = '';						  
						  if($catgory->status == 'A')
						  {
							  $checked = 'Checked';
						  }						  
						  $html.="<li><label><input class='cat-checkbox' name='citiescheck[]' type='checkbox' value=".$catgory->ID." ".$checked.">".$catgory->City."</label></li>"; 
					  }
		$html.="</ul>"; 
	}
	else
	{
		$html = "Sorry Not Recode Found for ".$selectedval."";
	}	
	echo json_encode(array('htmlmain' => $html,'currentcity'=>$selectedval));	

}

if($_POST["updatenewvar"] == 'updatenewvar' && !empty($_POST['catismainchange']))
{
      $catid = $_POST['catismainchange'];
      $catvalue = $_POST['catvalue'];
      
      global $wpdb; 
	  $tablename = $wpdb->prefix ."tmj_services";
	  $successupdate = $wpdb->query("UPDATE $tablename SET livedata_type= '".$catvalue."' WHERE ID ='".$catid."'");	

	  if(!empty($successupdate))
	  {
	  	 $update = "<div class='successmessagetmj'>catgory Updated successfully</div>";
	  }	  

	  echo json_encode(array('htmlmain' => $update));   

}

if($_POST["updatebylist"] == 'updatebylist' && !empty($_POST['bycatlist']))
{
     $listofcatids = implode(',',$_POST['bycatlist']);
     $catid = $_POST['catismainchange'];
       global $wpdb; 
     $tablename = $wpdb->prefix ."tmj_services";
	 $successupdate = $wpdb->query("UPDATE $tablename SET bycat_ids= '".$listofcatids."' WHERE ID ='".$catid."'");	

     if(!empty($successupdate))
	  {
	  	 $update = "<div class='successmessagetmj'>catgory Updated successfully</div>";
	  }	  

	  echo json_encode(array('htmlmain' => $update));  
}	


if($_POST["upbusinesslist"] == 'upbusinesslist' && !empty($_POST['mainidvar']))
{
     $businesslists = $_POST['mainidvar']; 
     $catismainchange = $_POST['catismainchange']; 
     
     global $wpdb; 
     $tablename = $wpdb->prefix ."tmj_services"; 

     $collectcat= $wpdb->get_results("SELECT business_listing_ids FROM $tablename WHERE ID = '".$catismainchange."'");       
     
    

     if(!empty($collectcat[0]->business_listing_ids))
     {	
         $avalbalearray = explode(',',$collectcat[0]->business_listing_ids);
	     if(in_array($businesslists,$avalbalearray))
	     {  			 
			 $avalbalearray = my_remove_array_item_tmj( $avalbalearray, $businesslists ); 
	        
		global $wpdb;  
		$tablename = $wpdb->prefix ."tmj_services";
		$successupdate = $wpdb->query("UPDATE $tablename SET business_listing_ids= '".implode(',',$avalbalearray)."' WHERE ID ='".$catismainchange."'");
	     }
	     else 
	  {
	    array_push($avalbalearray,$businesslists);
	    global $wpdb;  
	    $tablename = $wpdb->prefix ."tmj_services";
		$successupdate = $wpdb->query("UPDATE $tablename SET business_listing_ids= '".implode(',',$avalbalearray)."' WHERE ID ='".$catismainchange."'");
	   } 
	  }
	  else
	  {
          global $wpdb;  
		  $tablename = $wpdb->prefix ."tmj_services";
		  $successupdate = $wpdb->query("UPDATE $tablename SET business_listing_ids= '".$businesslists."' WHERE ID ='".$catismainchange."'");
	  }  
     
      if(!empty($successupdate))
	  {
	  	 $update = "<div class='successmessagetmj'>catgory Updated successfully</div>";
	  }	  

	  echo json_encode(array('htmlmain' => $update));  
}	

if($_POST["getbusinesslist"] == 'getbusinesslist' && !empty($_POST['selectedval']))
{


   $catidslect = $_POST['selectedval']; 

   $currentid = $_POST['currentid']; 
  
   $url = "&act=get_business_listing&cat=".$catidslect."&page=1";
   $resltdatabus = json_decode(parcelly_remote_curl($url));

   $html="";
   foreach($resltdatabus->recs as $values)
   {

   	                   global $wpdb;
		               $tablename = $wpdb->prefix ."tmj_services";			  
		               $sicss = $wpdb->get_results("SELECT business_listing_ids FROM $tablename WHERE ID = '".$currentid."'");               

		               $avalbalearray = explode(',',$sicss[0]->business_listing_ids);
	                   if(in_array($values->ID,$avalbalearray))
		               {
	                      $checked = "checked";
		               } 
		               else
		               {
		              	  $checked = "";
		               }
      $html.='<label><input class="boxbusinesslist slectedbylistbox" data-id="'.$values->ID.'" name="businesslist[]" type="checkbox" value="'.$values->ID.'" '.$checked.'>'.$values->business_name.'</label>';
   }

   echo json_encode(array('htmlmain' => $html));  
	              
}
if(isset($_POST['act']) && $_POST['act'] == 'getSponsoredList'){
	echo getSponsoredList($_POST['page']);
}
?>