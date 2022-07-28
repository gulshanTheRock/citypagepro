<?php
/*
Plugin Name: City Page Pro new
Plugin URI: https://www.rejoinwebsolution.com/
Description: A brief description of the Plugin.
Version: 1.1
Author: rejoinweb
Author URI: https://www.rejoinwebsolution.com/
. . 
*/
function addvariablehead()
{
  echo '<script>var city_proplugin_url="'.plugin_dir_url( __FILE__ ).'";</script>';
}
function wptuts_styles_with_the_lott()
{
  wp_register_style('custom-style', plugin_dir_url( __FILE__ ) . 'css/frontend.css');
  wp_enqueue_style('custom-style' );
  echo '<script>var city_proplugin_url="'.plugin_dir_url( __FILE__ ).'";</script>';
  wp_enqueue_script( 'my-great-custom', plugin_dir_url( __FILE__ ) . 'bootstrap/custom.js', array( 'jquery' ), '12.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'wptuts_styles_with_the_lott' );

function tmj_customizer_script()
{
    wp_enqueue_style('vpc_customizer-stylesj', plugin_dir_url( __FILE__ ) . 'css/styles.css');
}
add_action('admin_enqueue_scripts', 'tmj_customizer_script');

function my_admin_scriptss() {
    wp_enqueue_script( 'my-great-script', plugin_dir_url( __FILE__ ) . 'bootstrap/bootstrap.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'my-great-scripthh', plugin_dir_url( __FILE__ ) . 'bootstrap/jquery.dataTables.min.js', array( 'jquery' ), '11.0.0', true );
    wp_enqueue_script( 'my-great-scriptuu', plugin_dir_url( __FILE__ ) . 'bootstrap/dataTables.bootstrap.min.js', array( 'jquery' ), '12.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'my_admin_scriptss' );

function wptuts_styles_with_the_lot()
{
  /*wp_register_style('custom-style', plugin_dir_url( __FILE__ ) . 'css/styles.css');
  wp_enqueue_style('custom-style' );*/
}
add_action( 'wp_enqueue_scripts', 'wptuts_styles_with_the_lot' );

add_action('admin_menu', 'at_alphansotech_menu');
function at_alphansotech_menu()
{
  add_menu_page('forms_list', 'City Page Pro', 'manage_options', 'Setting_listing');
  add_submenu_page('Setting_listing', 'Settings', 'Settings', 'administrator', 'Setting_listing','sd_display_sub_menu_page');
  add_submenu_page('Setting_listing', 'Categories', 'Categories', 'manage_options','new_category_tmj', 'new_category_tmj_page_cat' );
  add_submenu_page('Setting_listing', 'Add new Category', 'Add new Category', 'administrator', 'add_categories','add_categories');
  add_submenu_page('Setting_listing', 'Category Page Template', 'Category Page Template', 'manage_options','cat_templates', 'business_listing_pages' );
  add_submenu_page('Setting_listing', 'State Page Template', 'State Page Template', 'administrator', 'state_temp','state_display_sub_menu_page');
  add_submenu_page('Setting_listing', 'City Page Template', 'City Page Template', 'administrator', 'city_temp','city_display_sub_menu_page');
  add_submenu_page('Setting_listing', 'Business Details Page Template', 'Business Details Page Template', 'administrator', 'business_template','business_display_sub_menu_page');
 add_submenu_page('Setting_listing', 'Features Listing', 'Features Listing', 'manage_options','new_category_tmj_listing_bus', 'new_category_tmj_listing_bus' );
  add_submenu_page('Setting_listing', 'Add new Features Listing', 'Add Features Listing', 'administrator', 'features_listing','business_feature_listing');
}

function tmj_services_activation_files()
{
  global $wpdb;
  global $import_db_version;
  $table_name = $wpdb->prefix . 'business_cities';
  $sql = "CREATE TABLE IF NOT EXISTS $table_name  (
           `ID` int(11) NOT NULL AUTO_INCREMENT,
          `City` varchar(256) NOT NULL,
          `city_slug` text NOT NULL,
          `state_name` varchar(256) NOT NULL,
          `state_short` varchar(256) NOT NULL,
          `zip` varchar(256) NOT NULL,
          `status` enum('A','D') NOT NULL,
          UNIQUE KEY id (ID)) $charset_collate;";
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
  dbDelta( $sqlorder);

   global $wpdb;
   $tablename = $wpdb->prefix ."business_cities";

  $tabledata = $wpdb->get_results("SELECT * FROM $tablename");

  if(empty($tabledata))
  {
    include_once "wp_business_cities.php";
    foreach($wp_business_cities as $values)
    {
      $ID = $values['ID'];
      $City = $values['City'];
      $city_slug = $values['city_slug'];
      $state_name = $values['state_name'];
      $state_short = $values['state_short'];
      $zip = $values['zip'];
      $status = $values['status'];

      $wpdb->insert( $tablename, array(
        'City' => $City,
        'city_slug' => $city_slug,
        'state_name' => $state_name,
        'state_short' => $state_short,
        'zip' => $zip ,
        'status' => $status,
        )
      );
    }
  }
  add_option( 'import_db_version', $import_db_version );
}
register_activation_hook( __FILE__, 'tmj_services_activation_files' );

function tmj_services_activation()
{
  $cat_meta_api_key = "bbbbae8c-ec06-48b2-8744-3a35cf334136";
  $cat_meta_listings = 10;

  update_option( 'cat_tmj_meta_api_key',$cat_meta_api_key);
  update_option( 'cat_tmj_meta_key_perpage',$cat_meta_listings);

 global $wpdb;
  global $import_db_version;
  $table_name = $wpdb->prefix . 'tmj_services';
  $sql = "CREATE TABLE IF NOT EXISTS $table_name  (
          `ID` int(11) NOT NULL AUTO_INCREMENT,
          `cat_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
          `cat_slug` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
          `business_Query_keywords` text COLLATE utf8_unicode_ci NOT NULL,
          `cat_thumnail` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
          `cat_template` text COLLATE utf8_unicode_ci NOT NULL,
          `meta_titles` varchar(356) COLLATE utf8_unicode_ci NOT NULL,
          `meta_keywords` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
          `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
          `livedata_type` text COLLATE utf8_unicode_ci NOT NULL,
         `bycat_ids` varchar(356) COLLATE utf8_unicode_ci NOT NULL,
         `business_listing_ids` varchar(356) COLLATE utf8_unicode_ci NOT NULL,
         `dt_added` date NOT NULL,
          UNIQUE KEY id (ID)) $charset_collate;";
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
  dbDelta( $sqlorder);

  $insertsql = "INSERT INTO `".$table_name."` (`ID`, `cat_name`, `cat_slug`, `business_Query_keywords`, `cat_thumnail`, `cat_template`, `meta_titles`, `meta_keywords`, `meta_description`, `livedata_type`, `bycat_ids`, `business_listing_ids`, `dt_added`) VALUES (43, 'Dentist', 'dentist', 'Dental,dentist,dds', '".plugin_dir_url( __FILE__ ) ."images/24hr-1.jpg', '<h1>{category} in {city}, {state-short} {state} {zip} </h1>\r\n\r\n{map}\r\n\r\n{business_listings}', '{city}, {state-short} Emergency Dentist - {zip} 24 Hour Dental Office', '{city}, {state-short} Emergency Dentist - {zip} 24 Hour s Dental Offices', '{city}, {state-short} Emergency Dentist - {zip} 24 Hour Dental Office', '', '', '', '2019-04-25');";

  $wpdb->query($insertsql);

  add_option( 'import_db_version', $import_db_version );
}
register_activation_hook( __FILE__, 'tmj_services_activation' );

function business_cities_activation()
{
  global $wpdb;
  global $import_db_version;
  $table_name = $wpdb->prefix . 'city_states_templates';
  $sql = "CREATE TABLE IF NOT EXISTS $table_name  (
      `id` mediumint(56) NOT NULL AUTO_INCREMENT,
          `templates_meta_key` text COLLATE utf8_unicode_ci NOT NULL,
          `templates_value` text COLLATE utf8_unicode_ci NOT NULL,
          `meta_titles` varchar(356) COLLATE utf8_unicode_ci NOT NULL,
          `meta_keywords` varchar(356) COLLATE utf8_unicode_ci NOT NULL,
          `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
          UNIQUE KEY id (id)) $charset_collate;";
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
  dbDelta( $sqlorder);

  global $wpdb;

  $insertsql ="INSERT INTO `".$table_name."` (`id`, `templates_meta_key`, `templates_value`, `meta_titles`, `meta_keywords`, `meta_description`) VALUES (1, 'state_temp', '<h2 style=\\\"color: red;\\\">{state_name} {category_name} Local Directory</h2>\r\n\r\n{city_list}', '{category} Services in {state}', '{category} Services in {state}', '{category} Services in {state}'),(2, 'category_temp', '{category_name} Directory\r\n\r\n{state_list}', 'Find Local {category_name} Services', 'Find Local {category_name} Services', 'Find Local {category_name} Services'),(3, 'business_tamplate', '<h1>{business-name} in {business-city}, {business-state-short} {business-zip}</h1>\r\n{business-map}\r\n<h2><strong>{business-name}</h2>\r\n<h3>{business-address}</h3>\r\n<h4>{business-phone}</h4>\r\n<h5>{business-website}</strong></h5>', '{business-name} in {business-city}, {business-state-short} {business-zip} - 24 Hour Dentist', '{business-name} in {business-city}, {business-state-short} {business-zip} - 24 Hour Dentist', '{business-name} in {business-city}, {business-state-short} {business-zip} - 24 Hour Dentist'),(4, 'citi_templates', '', '{category} Services in {city}, {state-short} {zip}', 'City,Template,Metasss', 'City Template Meta Setting,City Template Meta Setting,City Template Meta Setting,City Template Meta Setting,City Template Meta Setting,City Template Meta Setting,City Template Meta Setting,City Template Meta Setting,City Template Meta Setting,City Template Meta Setting,City Template Meta Setting');";

  $wpdb->query($insertsql);

  add_option( 'import_db_version', $import_db_version );
}
register_activation_hook( __FILE__, 'business_cities_activation' );



function featured_listing_activation()
{   global $wpdb;
      global $import_db_version;
      $table_name = $wpdb->prefix . 'feature_bus_listing';
      $sql = "CREATE TABLE IF NOT EXISTS $table_name  (
          `id` mediumint(56) NOT NULL AUTO_INCREMENT,
              `business_name` varchar(356) COLLATE utf8_unicode_ci NOT NULL,
              `business_category` varchar(356) COLLATE utf8_unicode_ci NOT NULL,
              `business_name_slug` varchar(356) COLLATE utf8_unicode_ci NOT NULL,
              `business_list_thumb` text COLLATE utf8_unicode_ci NOT NULL,
              `list_phone_number` varchar(360) COLLATE utf8_unicode_ci NOT NULL,
              `list_description` text COLLATE utf8_unicode_ci NOT NULL,
              `date_added` date NOT NULL,
              UNIQUE KEY id (id)) $charset_collate;";
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
  dbDelta( $sqlorder);

  global $wpdb;

  add_option( 'import_db_version', $import_db_version );
}
register_activation_hook( __FILE__, 'featured_listing_activation' );

//function to create table on activation of plugin
function create_auto_account_page_business()
{
  $localbusiness_page = get_option('local_creator_business_page');
  if(empty($localbusiness_page))
  {
      $current_user = wp_get_current_user();
      // create post object
      global $wpdb;
       if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'tmj-cat'", 'ARRAY_A' ) )
       {
        $current_user = wp_get_current_user();
        // create post object
        $page = array(
          'post_title'  => __( 'Business' ),
          'post_status' => 'publish',
          'post_author' => $current_user->ID,
          'post_type'   => 'page',
        );
        // insert the post into the database
         $postinsert= wp_insert_post( $page );
         update_post_meta($postinsert,'_wp_page_template','tmj-business-template.php');

        update_option( 'local_creator_business_page',$postinsert);
      }
  }
}
register_activation_hook( __FILE__, 'create_auto_account_page_business' );

function wpse255804_add_page_template_business ($templates) {
    $templates['tmj-cat-template.php'] = 'Business';
    return $templates;
}
add_filter ('theme_page_templates', 'wpse255804_add_page_template_business');

function get_auto_template_business( $template ) {
    $post = get_post();
    $page_template = get_post_meta( $post->ID, '_wp_page_template', true );
    if( $page_template == 'tmj-business-template.php' ){
        return plugin_dir_path(__FILE__) . "templates/tmj-business-template.php";
    }
    return $template;
}

function add_auto_templates_business() {
        add_filter( 'page_template', 'get_auto_template_business', 1 );
}
add_action( 'wp_loaded', 'add_auto_templates_business' );

//function to create table on activation of plugin
function create_auto_account_page()
{
   $page_cat_id_get = get_option('local_creator_page_cat_id');
   if(empty($page_cat_id_get))
   {
       $current_user = wp_get_current_user();
      // create post object
      global $wpdb;
      if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'tmj-cat'", 'ARRAY_A' ) )
      {
        $current_user = wp_get_current_user();
        // create post object
        $page = array(
          'post_title'  => __( 'USA' ),
          'post_status' => 'publish',
          'post_author' => $current_user->ID,
          'post_type'   => 'page',
        );
        // insert the post into the database
        $postinsert= wp_insert_post( $page );
        update_post_meta($postinsert,'_wp_page_template','tmj-cat-template.php');
        update_option( 'local_creator_page_cat_id',$postinsert);
      }
   }
}
register_activation_hook( __FILE__, 'create_auto_account_page' );

function wpse255804_add_page_template ($templates) {
    $templates['tmj-cat-template.php'] = 'Tmj category';
    return $templates;
}
add_filter ('theme_page_templates', 'wpse255804_add_page_template');

function get_auto_template( $template ) {
  $post = get_post();
  $page_template = get_post_meta( $post->ID, '_wp_page_template', true );
  if( $page_template == 'tmj-cat-template.php' )
  {
      return plugin_dir_path(__FILE__) . "templates/tmj-cat-template.php";
  }
  return $template;
}

function add_auto_templates() {
  add_filter( 'page_template', 'get_auto_template', 1 );
}
add_action( 'wp_loaded', 'add_auto_templates' );

add_action('init', 'custom_rewrite_rulemain', 10, 0);
function custom_rewrite_rulemain() {
  $page_cat_id = get_option('local_creator_page_cat_id');
  $post = get_post($page_cat_id);
  $slug = $post->post_name;

  add_rewrite_rule('^'.$slug.'/([^/]*)/([^/]*)/([^/]*)/([^/]*)/?','index.php?page_id='.$page_cat_id.'&type=$matches[1]&state_cities=$matches[2]&citicode=$matches[3]&page_number=$matches[4]','top');

  add_rewrite_rule('^'.$slug.'/([^/]*)/([^/]*)/([^/]*)/?','index.php?page_id='.$page_cat_id.'&type=$matches[1]&state_cities=$matches[2]&citicode=$matches[3]','top');

  add_rewrite_rule('^'.$slug.'/([^/]*)/([^/]*)/?','index.php?page_id='.$page_cat_id.'&type=$matches[1]&state_cities=$matches[2]','top');

  add_rewrite_rule('^'.$slug.'/([^/]*)/?','index.php?page_id='.$page_cat_id.'&type=$matches[1]','top');
}

add_filter('query_vars', 'foo_my_query_vars');
function foo_my_query_vars($vars){
    $vars[] = 'type';
    $vars[] = 'state_cities';
    $vars[] = 'citicode';
    $vars[] = 'page_number';
    return $vars;
}

add_action('init', 'custom_rewrite_rulemain_business', 10, 0);
function custom_rewrite_rulemain_business() {
  $page_cat_id = get_option('local_creator_business_page');
  $postt= get_post($page_cat_id);

  $slug = $postt->post_name;

  add_rewrite_rule('^'.$slug.'/([^/]*)/([^/]*)/?','index.php?page_id='.$page_cat_id.'&sluglist=$matches[1]&buinessid=$matches[2]','top');
  add_rewrite_rule('^'.$slug.'/([^/]*)/?','index.php?page_id='.$page_cat_id.'&sluglist=$matches[1]','top');
}

add_filter('query_vars', 'foo_my_query_vars_businesss');
function foo_my_query_vars_businesss($vars){
  $vars[] = 'sluglist';
  $vars[] = 'buinessid';
  return $vars;
}

// returns the root directory path of particular plugin
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'cat_templates.php');
require_once(ROOTDIR . 'Setting_listing.php');
require_once(ROOTDIR . 'state_temp.php');
require_once(ROOTDIR . 'city_temp.php');
require_once(ROOTDIR . 'business_template.php');
require_once(ROOTDIR . 'categories_tmj.php');
require_once(ROOTDIR . 'add_newcat.php');
require_once(ROOTDIR . 'new_category_tmj.php');
require_once(ROOTDIR . 'feature-listing-business.php');
require_once(ROOTDIR . 'add-new-feature-list.php');


function get_home_path_auto() {
  $home    = set_url_scheme( get_option( 'home' ), 'http' );
  $siteurl = set_url_scheme( get_option( 'siteurl' ), 'http' );
  if ( ! empty( $home ) && 0 !== strcasecmp( $home, $siteurl ) ) {
      $wp_path_rel_to_home = str_ireplace( $home, '', $siteurl ); /* $siteurl - $home */
      $pos = strripos( str_replace( '\\', '/', $_SERVER['SCRIPT_FILENAME'] ), trailingslashit( $wp_path_rel_to_home ) );
      $home_path = substr( $_SERVER['SCRIPT_FILENAME'], 0, $pos );
      $home_path = trailingslashit( $home_path );
  } else {
      $home_path = ABSPATH;
  }
  return str_replace( '\\', '/', $home_path );
}

function hstngr_register_widget() {
  register_widget( 'hstngr_widget' );
}
add_action( 'widgets_init', 'hstngr_register_widget' );

class hstngr_widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      // widget ID
      'hstngr_widget',
      // widget name
      __('Local Page Category widget', ' hstngr_widget_domain'),
      // widget description
      array( 'description' => __( 'Local Page Creator widget', 'hstngr_widget_domain' ), )
    );
  }
  public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title']);
    echo $args['before_widget'];
    //if title is present
    if ( ! empty( $title ) )
      echo $args['before_title'] . $title . $args['after_title'];
    //output

    global $wpdb;

    $tablename = $wpdb->prefix ."tmj_services";
    $sic_cat = $wpdb->get_results("SELECT DISTINCT cat_slug,cat_name,ID FROM $tablename ");
    echo "<ul class='catlistswidget tmjsidebar'>";
    foreach($sic_cat as $k=>$catgory)
    {
      if($k % 10 == 0 && $k != 0)
      {
       echo "</ul><ul class='catlistswidget'>";
      }
     $page_cat_id = get_option('local_creator_page_cat_id');
     $post = get_post($page_cat_id);
     $slug = $post->post_name;
     echo "<li class='tmjsidebarli'><a href='".home_url(''.$slug.'/'.$catgory->cat_slug)."'>".$catgory->cat_name."</a></li>";
    }
    echo "</ul>";
    echo $args['after_widget'];
  }

  public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) )
    $title = $instance[ 'title' ];
    else
    $title = __( 'Default Title', 'hstngr_widget_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <?php
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    return $instance;
  }
}

function replace_text($text)
{
   global $wpdb;
   $tablename = $wpdb->prefix ."tmj_services";
   $cat_type = get_query_var("type");
   $state_cities = get_query_var("state_cities");
   $citicode = get_query_var("citicode");
   $page_id_main = get_query_var("page_id");
   $pageno = get_query_var("page_number");

   if(strpos($text, '{category_name}')!==false or strpos($text, '{category}')!==false or strpos($text, '{state-short}')!==false or strpos($text, '{state_list}')!==false)
   {
     $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE cat_slug = '".$cat_type."'");		if(!empty($cat_id)){
			 $globalcatthumb = $cat_id[0]->cat_thumnail;
			 $globalid = $cat_id[0]->ID;		}
   }

   if(strpos($text, '{category_name}')!==false)
   {
    $text = str_replace('{category_name}', $cat_id[0]->cat_name, $text);
   }
   if(strpos($text, '{category}')!==false)
   {
    $text = str_replace('{category}',$cat_id[0]->cat_name, $text);
   }
   if(strpos($text, '{state-short}')!==false)
   {
    $text = str_replace('{state-short}',strtoupper($state_cities), $text);
   }

   global $wpdb;

   if(strpos($text, '{state_list}')!==false)
   {
     $tablename = $wpdb->prefix ."business_cities";
     $statemain = $wpdb->get_results("SELECT DISTINCT state_name,state_short FROM $tablename ");

     $htmllist = '';
     $htmllist.='<div class="mainlistofcat">';
     $htmllist.='<ul class="catlistscate">';
     foreach($statemain as $k=>$listmain)
     {
        if($k % 20 == 0 && $k != 0)
        {
          $htmllist.="</ul><ul class='catlistscate'>";
        }
        $page_cat_id = get_option('local_creator_page_cat_id');
        $post = get_post($page_cat_id);
        $slug = $post->post_name;
        $htmllist.="<li><a href='".home_url(''.$slug.'/'.$cat_type.'/'.strtolower($listmain->state_short))."'>".$cat_id[0]->cat_name.' in '.$listmain->state_name."</a></li>";
     }
     $htmllist.='</ul>';
     $htmllist.='</div>';

     $text = str_replace('{state_list}',$htmllist,$text);
   }

   if(strpos($text, '{state_name}')!==false or strpos($text, '{state}')!==false)
   {
     $state_cities = get_query_var("state_cities");
     $tablenamestate = $wpdb->prefix ."business_cities";
     $statemain = $wpdb->get_results("SELECT * FROM $tablenamestate WHERE state_short = '".strtoupper($state_cities)."'");

     if(strpos($text, '{state_name}')!==false)
     {
       $text = str_replace('{state_name}',$statemain[0]->state_name,$text);
     }

    if(strpos($text, '{state}')!==false)
    {
     $text = str_replace('{state}',$statemain[0]->state_name, $text);
    }
  }

   if(strpos($text, '{city_list}')!==false)
   {
     $tablenamestate = $wpdb->prefix ."business_cities";
     $statecities= $wpdb->get_results("SELECT * FROM $tablenamestate WHERE state_short = '".strtoupper($state_cities)."' AND status = 'A'");

     $htmlcity = '';
     $htmlcity.='<div class="mainlistofcat">';
     $htmlcity.='<ul class="catlistscate">';
     foreach($statecities as $k=>$listcity)
     {
        if($k % 20 == 0 && $k != 0)
        {
          $htmlcity.="</ul><ul class='catlistscate'>";
        }
        $page_cat_id = get_option('local_creator_page_cat_id');
        $post = get_post($page_cat_id);
        $slug = $post->post_name;
        $htmlcity.="<li><a href='".home_url(''.$slug.'/'.$cat_type.'/'.$state_cities.'/'.$listcity->city_slug)."'>".$listcity->City."</a></li>";
     }
     $text = str_replace('{city_list}',$htmlcity,$text);
   }

   if(strpos($text, '{city}')!==false or strpos($text, '{zip}')!==false)
   {
    global $wpdb;
    $tablename = $wpdb->prefix ."business_cities";
    $cat_id_citicode = $wpdb->get_results("SELECT * FROM $tablename WHERE city_slug = '".$citicode."' AND state_short = '".strtoupper($state_cities)."' ");

    $text = str_replace('{city}',$cat_id_citicode[0]->City, $text);
    $text = str_replace('{zip}',$cat_id_citicode[0]->zip, $text);
   }

   if(strpos($text, '{map}')!==false)
   {
     $maphtml = '<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="330" id="gmap_canvas" src="https://maps.google.com/maps?q='.$cat_id_citicode[0]->City.''.$state_cities.'&t=&z=16&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><style>.mapouter{position:relative;text-align:right;height:330px;width:100%;}.lic{color:red;background-color:white;padding:10px;position:absolute;z-index:999;border-radius: 20px 20px 0 0;right:60px;bottom:0;}.gmap_canvas {overflow:hidden;background:none!important;height:330px;width:100%;}</style></div>';

     $text =  str_replace('{map}',$maphtml, $text);
   }


   /*if(strpos($text, '{features_business_listings}')!==false)
   {
           $text = str_replace('{features_business_listings}',features_business_listfeature($globalid), $text);
   }*/


   if(strpos($text, '{business_listings}')!==false or strpos($text, '{business-name}')!==false or strpos($text, '{business-city}')!==false or strpos($text, '{business-zip}')!==false or strpos($text, '{business-state-short}')!==false or strpos($text, '{business-address}')!==false or strpos($text, '{business-phone}')!==false or strpos($text, '{business-website}')!==false or  strpos($text, '{business-map}')!==false)
   {
     $btntextlist ='';
	  $cat_tmj_enablelisting = get_option('cat_tmj_enablelisting');
	 if($cat_tmj_enablelisting == 1){
        $btntextlist = '<div id="showlisting">
        <button type="button" class="viewbutton">View Local Listings</button>
        </div><style>.parentlistloop {display: none;}</style>';

		}
		$htmlbuslist =getSponsoredList($pageno);
     $text = str_replace('{business_listings}',$btntextlist.'<div class="parentlistloop">'.$htmlbuslist.'</div>', $text);

     $sluglist = get_query_var("sluglist");
     $idbuniness = get_numerics_tmj($sluglist);

     if(!empty($idbuniness) && $sluglist != '')
     {
        $getstateshort = array_reverse(explode('-',$sluglist));
        $stateshort = $getstateshort[1];
        $businessid = $idbuniness[0];
        $url = '&act=get_business_listing&ids='.$businessid.'&state='.$stateshort;
        $resltdata = parcelly_remote_curl($url);
        $text = str_replace('{business-name}',$resltdata->recs[0]->business_name, $text);
        $text = str_replace('{business-city}',$resltdata->recs[0]->City, $text);
        $text = str_replace('{business-zip}',$resltdata->recs[0]->ZIP_Code, $text);
        $text = str_replace('{business-state-short}',$resltdata->recs[0]->State_Code, $text);
        $text = str_replace('{business-address}',$resltdata->recs[0]->Address, $text);
        $text = str_replace('{business-phone}',formatPhoneNumber($resltdata->recs[0]->Phone), $text);
        $http = "http://";
        $finallink = $resltdata->recs[0]->Web;
        $fianlmost = $http.$finallink;
		$hreflink='';
        if(!empty($resltdata->recs[0]->Web))
        {
           $hreflink = '<a target="_blank" href='.$fianlmost.'>'.$fianlmost.'</a>';
        }

        $text = str_replace('{business-website}',$hreflink, $text);

        $maphtml = '</br><div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="330" id="gmap_canvas" src="https://maps.google.com/maps?q='.str_replace('#','',$resltdata->recs[0]->Address).''.$resltdata->recs[0]->City.''.$resltdata->recs[0]->ZIP_Code.'&t=&z=16&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><style>.mapouter{position:relative;text-align:right;height:330px;width:100%;}.lic{color:red;background-color:white;padding:10px;position:absolute;z-index:999;border-radius: 20px 20px 0 0;right:60px;bottom:0;}.gmap_canvas {overflow:hidden;background:none!important;height:330px;width:100%;}</style></div></br>';

        $text =  str_replace('{business-map}',$maphtml, $text);
     }
   }
   /*$text = process_spun($text);*/
   return $text;
}
add_filter('the_content', 'replace_text');

$page_cat_id = get_option('local_creator_page_cat_id');

global $wpdb;




function getSponsoredList($page)
{
  global $wpdb;
  $tablename = $wpdb->prefix ."tmj_services";
  $cat_type = get_query_var("type");
  $state_cities = get_query_var("state_cities");
  $citicode = get_query_var("citicode");
  $page_id_main = get_query_var("page_id");

  $cat_id = $wpdb->get_results("SELECT ID,cat_thumnail FROM $tablename WHERE cat_slug = '".$cat_type."'");

  if(!empty($cat_id))
  {
    $globalcatthumb = $cat_id[0]->cat_thumnail;

    $globalid = $cat_id[0]->ID;

  }

  $chk_cat_tmj_meta_key_perpage = get_option('cat_tmj_meta_key_perpage');
  if(!empty($chk_cat_tmj_meta_key_perpage))
  {
    $rec_pp = get_option('cat_tmj_meta_key_perpage');
  }
  else
  {
   // $rec_pp = 2;
  }

  if($page<=0 or $page=='')
    $page=1;

    // $previousPage = $page-1;
    // $nextPage = $page+1;
    // $startLimit = ($page-1)*$rec_pp;
    // $num_recs = $total_pages = 0;

    $and='';
    $tablename = $wpdb->prefix ."tmj_services";if(isset($globalid))
    {
      $siccat = $wpdb->get_results("SELECT business_Query_keywords,livedata_type,bycat_ids,business_listing_ids FROM $tablename WHERE ID = '".$globalid."'");
      if(!empty($siccat))
      {
        $datatype = $siccat[0]->livedata_type;
        $bycat_ids = $siccat[0]->bycat_ids;
        $business_listing_ids = $siccat[0]->business_listing_ids;
        $business_Query_keywords = urlencode($siccat[0]->business_Query_keywords);
      }
    }
    $query_string = '';
    if($citicode!='')
    {
      $city = '';
      $query_string .= '&city='.$citicode;
    }

    if($state_cities!='')
    {
      $query_string .= '&state='.$state_cities;
    }
    if($citicode!='')
    {
      $url = "&act=get_business_listing&cat=".$business_Query_keywords."&num_recs=".$rec_pp."&page=".$page.$query_string;
        $resltdatabus = parcelly_remote_curl($url);
    }


    $listing = '';
	      $tablenamebuslist1 = $wpdb->prefix ."feature_bus_listing";                    $servicesupdate = $wpdb->get_results("SELECT * FROM $tablenamebuslist1 WHERE business_category = '".$globalid."'");        if(!empty($servicesupdate) && $page==1)      {          foreach($servicesupdate as $valbus)        {          $urlk= home_url()."/business/"."featu-business-".$valbus->id;           $urlk= home_url($slug_bus.'/'.sanitize_title($valbus->business_name.'-'.$valbus->id));          $listing.= "<div class='listingloop divclass features_listing_list flist-bus".$valbus->id."'><div class='col-md-2'><div class='catimagereoundround'><img class='catimagereound' src='".$valbus->business_list_thumb."'></div></div><div class='col-md-6 top-marginclass'><h2 class='titlelist'>".replace_text($valbus->business_name)."</h2><div class='tdiscription'>".replace_text($valbus->list_description)."</div><h2 class='titlelistphomrr'>Phone : ".$valbus->list_phone_number."</h2></div><div class='col-md-3 top-marginclass'></div><div class='ribbon'><span>FEATURED</span></div></div>";        }      }
    if(isset($resltdatabus->recs) and count($resltdatabus->recs) > 0)
    {
      $totalRecs = $resltdatabus->cntNxtPage;
      $page_cat_id = get_option('local_creator_business_page');
      $postt= get_post($page_cat_id);
      $slug_bus = $postt->post_name;

      foreach($resltdatabus->recs as $values)
      {
         $listing.="<div class='listingloop divclass".$values->ID."'>";
         $listing.="<div class='col-md-2'>";
         $listing.="<div class='catimagereoundround'><img class='catimagereound' src=".$globalcatthumb."></div>";
         $listing.="</div>";
         $listing.="<div class='col-md-6 top-marginclass'>";
         $listing.="<h2 class='titlelist'>".$values->business_name."</h2>";
         $listing.="<div class='tdiscription'><div class='industryaddres'>".$values->Address.", ".$values->City.", ".$values->State_Code."</div><div class='industry'>".$values->Industry."</div></div>";
         $listing.="</div>";
         $listing.="<div class='col-md-3 top-marginclass'>";
         //$listing.="<a href='#' class='viewbutton'>View Contact</a>";
         $listing.="<a href=".home_url($slug_bus.'/'.sanitize_title($values->business_name.'-'.$values->State_Code.'-'.$values->ID))." class='viewbutton'>View Details</a>";
         $listing.="</div>";

         $listing.="</div>";
      }

      if($totalRecs > 0 || $page!=1)
      {
        $page_cat_id = get_option('local_creator_page_cat_id');
        $cat_tmj_enablelisting = get_option('cat_tmj_enablelisting');
        $post = get_post($page_cat_id);
        $slug = $post->post_name;

        $homeurlslug = home_url();

        $mailurl_list = $homeurlslug.'/'.$slug.'/'.$cat_type.'/'.$state_cities.'/'.$citicode;

        $listing .= '<div class="col-sm-12 loadMore-pagination">';
		if($cat_tmj_enablelisting == 1){
        $listing .= '<div id="loadMore" style="">
        <button type="button" class="viewbutton">View More</button>
        </div><style>.page__pagination.text-center {display: none;}</style>';

		}
             $listing .= '   <div class="page__pagination text-center">';
        if($page!=1)
        {
          $prevPage = $page-1;
          $listing .= '<a href="'.$mailurl_list.'/'.$prevPage.'" class="pagination-prev tmj-page-btn" onclick="getSponsoredList('.$prevPage.');">Previous</a>';
        }
        else
        {
          $listing .= '<span class="pagination-prev tmj-page-btn disable-nav-btn">Previous</span>';
        }

        if($totalRecs>0)
        {
          $nextPage = $page+1;
          $listing .= '<a href="'.$mailurl_list.'/'.$nextPage.'" class="pagination-next tmj-page-btn" onclick="getSponsoredList('.$nextPage.');">Next</a>';
        }
        else
        {
          $listing .= '<span class="pagination-next tmj-page-btn disable-nav-btn">Next</span>';
        }
        $listing .= '</div>
            </div>';
      }
    }
    else if($page <= 1)
    {		if($listing == ''){
			$listing .= '<div class="no-recs-found">No listing(s) added yet.</div>';		}
    }
    return $listing;
}

function sharp_miancheck_slug()
{
    remove_action( 'wp_head', '_wp_render_title_tag', 1 );
    function theme_slug_render_title()
    {
      global $wpdb;
      $cat_type = get_query_var("type");
      $state_cities = get_query_var("state_cities");
      $citicode = get_query_var("citicode");
      $sluglist = get_query_var("sluglist");

      $metafinaltitle ='';
      if(!empty($cat_type) && !empty($state_cities) && !empty($citicode))
      {
        global $wpdb;
        $tablename = $wpdb->prefix ."tmj_services";

        $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE cat_slug = '".$cat_type."'");

        $statemetatitle = $cat_id[0]->meta_titles;
        $metafinaltitle = replace_text($statemetatitle);

        $meta_keywords = $cat_id[0]->meta_keywords;
        $meta_keywords = replace_text($meta_keywords);

        $meta_description = $cat_id[0]->meta_description;
        $meta_description = replace_text($meta_description);
      }
      else if(!empty($cat_type) && !empty($state_cities))
      {
        global $wpdb;
        $tablename = $wpdb->prefix ."city_states_templates";
        $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE templates_meta_key = 'state_temp'");

        $statemetatitle = $cat_id[0]->meta_titles;
        $metafinaltitle = replace_text($statemetatitle);

        $meta_keywords = $cat_id[0]->meta_keywords;
        $meta_keywords = replace_text($meta_keywords);

        $meta_description = $cat_id[0]->meta_description;
        $meta_description = replace_text($meta_description);
      }
      else if(!empty($cat_type))
      {
        global $wpdb;
        $tablename = $wpdb->prefix ."city_states_templates";
        $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE templates_meta_key = 'category_temp'");

        $statemetatitle = $cat_id[0]->meta_titles;
        $metafinaltitle = replace_text($statemetatitle);

        $meta_keywords = $cat_id[0]->meta_keywords;
        $meta_keywords = replace_text($meta_keywords);

        $meta_description = $cat_id[0]->meta_description;
        $meta_description = replace_text($meta_description);
      }
      else if(!empty($sluglist))
      {
        global $wpdb;
        $tablename = $wpdb->prefix ."city_states_templates";
        $cat_id = $wpdb->get_results("SELECT * FROM $tablename WHERE templates_meta_key = 'business_tamplate'");


        $statemetatitle = $cat_id[0]->meta_titles;
        $metafinaltitle = replace_text($statemetatitle);


        $meta_keywords = $cat_id[0]->meta_keywords;
        $meta_keywords = replace_text($meta_keywords);


        $meta_description = $cat_id[0]->meta_description;
        $meta_description = replace_text($meta_description);
      }
      ?>
      <title><?php echo $metafinaltitle;?></title>
      <meta name="keywords" content="<?php echo $meta_keywords;?>">
      <meta name="description" content="<?php echo $meta_description;?>">
      <?php
    }
    add_action( 'wp_head', 'theme_slug_render_title' );
}

// Setting a custom timeout value for cURL. Using a high value for priority to ensure the function runs after any other added to the same action hook.
add_action('http_api_curl', 'sar_custom_curl_timeout', 9999, 1);
function sar_custom_curl_timeout( $handle ){
  curl_setopt( $handle, CURLOPT_CONNECTTIMEOUT, 11); // 30 seconds. Too much for production, only for testing.
  curl_setopt( $handle, CURLOPT_TIMEOUT, 11); // 30 seconds. Too much for production, only for testing.
  curl_setopt($handle, CURLOPT_REFERER, getDomain(get_site_url()));
}
// Setting custom timeout for the HTTP request
add_filter( 'http_request_timeout', 'sar_custom_http_request_timeout', 9999 );
function sar_custom_http_request_timeout( $timeout_value ) {
  return 11; // 30 seconds. Too much for production, only for testing.
}
// Setting custom timeout in HTTP request args
add_filter('http_request_args', 'sar_custom_http_request_args', 9999, 1);
function sar_custom_http_request_args( $r ){
  $r['timeout'] = 11; // 30 seconds. Too much for production, only for testing.
  return $r;
}

function parcelly_remote_curl($url = NULL)
{
  $apikey = get_option('cat_tmj_meta_api_key');
  $maincurl =  'https://fiorecarpentry.org/blapi/api.php?key='.$apikey.'';
  $urlpass = $maincurl.$url;
  $request = wp_remote_get($urlpass);
  if( is_wp_error( $request ) ) {
    return false;
  }
  $body = wp_remote_retrieve_body( $request);
  $result = json_decode($body);
  return $result;
}

function my_remove_array_item_tmj( $array, $item ) {
  $index = array_search($item, $array);
  if ( $index !== false ) {
    unset( $array[$index] );
  }
  return $array;
}

function get_numerics_tmj($str) {
  $matches = array_reverse(explode('-',$str));
  return $matches;
}

function get_numerics_tmj1($str) {
  preg_match_all('/\d+/', $str, $matches);
  return $matches[0];
}

function formatPhoneNumber($phone)
{
  if(preg_match('/(\d{3})(\d{3})(\d{4})$/',$phone,$matches))
  {
    $result = '(' . $matches[1] . ') ' .$matches[2] . '-' . $matches[3];
    return $result;
  }
  else if(preg_match('/^\+\d(\d{3})(\d{3})(\d{4})$/',$phone,$matches))
  {
    $result = '(' . $matches[1] . ') ' .$matches[2] . '-' . $matches[3];
    return $result;
  }
  else
  {
    return $phone;
  }
}

function process_spun($text)
{
  return preg_replace_callback(
      '/\{(((?>[^\{\}]+)|(?R))*)\}/x',
      'replace_spun',
      $text
  );
}
function replace_spun($text)
{
  $text = process_spun($text[1]);
  $parts = explode('|', $text);
  return $parts[array_rand($parts)];
}

function getDomain($url){
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';
    if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
        return $regs['domain'];
    }
    return FALSE;
}
