<?php // loading modernizr and jquery, and reply script
add_action('init', 'theme_scripts_and_styles');
function theme_scripts_and_styles() {
  global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
  if (!is_admin()) {

//    // register main stylesheet
    wp_register_style( 'fawesome-stylesheet', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '', 'all' );
    wp_register_style( 'jui-stylesheet', 'https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css', array(), '', 'all' );
    wp_register_style( 'multidatespicker-css', HB_PLUGIN_URL . 'assets/datepicker/jquery-ui.multidatespicker.css', array(), '', 'all' );
    wp_register_style( 'fancy-css', HB_PLUGIN_URL . 'assets/fancybox/jquery.fancybox.min.css', array(), '', 'all');
    wp_register_style( 'hotel-stylesheet', HB_PLUGIN_URL . 'assets/css/style.css', array(), '', 'all' );
   
    wp_register_script( 'jui-js', 'https://code.jquery.com/ui/1.10.4/jquery-ui.js', array( 'jquery' ), '', true );
    wp_register_script( 'multidatespicker-js', HB_PLUGIN_URL. 'assets/datepicker/jquery-ui.multidatespicker.js', array( 'jquery' ), '', true );
    wp_register_script( 'fancy-js', HB_PLUGIN_URL . 'assets/fancybox/jquery.fancybox.min.js', array(), '', 'all');
    wp_register_script( 'hotel-js', HB_PLUGIN_URL. 'assets/js/main.js', array( 'jquery' ), '', true );
	
    // enqueue styles and scripts
//    wp_enqueue_style( 'theme-bootstrap' );
	wp_enqueue_style( 'fawesome-stylesheet' );
	wp_enqueue_style( 'jui-stylesheet' );
	wp_enqueue_style( 'multidatespicker-css' );
	wp_enqueue_style( 'fancy-css' );
	wp_enqueue_style( 'hotel-stylesheet' );
	/*
    I recommend using a plugin to call jQuery
    using the google cdn. That way it stays cached
    and your site will load faster.
    */
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jui-js' );
	wp_enqueue_script( 'multidatespicker-js' );
	wp_enqueue_script( 'fancy-js' );
	wp_enqueue_script( 'hotel-js' );
      
	$theme_array = array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'path' => HB_PLUGIN_URL );
	wp_localize_script( 'hotel-js', 'Theme', $theme_array );
  }else{
    wp_register_style( 'hoteladmin-stylesheet', HB_PLUGIN_URL . 'assets/css/admin.css', array(), '', 'all' );
	wp_enqueue_style( 'hoteladmin-stylesheet' );
  }
}

/*
    $options
    hotelbookings_theme_emailoptions
    hotelbookings_theme_options
*/
function themeOptions($option , $key) {
	$options = get_option( $option ); 
	return $options[$key];
}
function get_hotel_name(){
    return themeOptions('hotelbookings_theme_options','hotelinfotitle');
}
function get_hotel_admin_email(){
    return themeOptions('hotelbookings_theme_options','adminemail');
}
function get_hotel_description(){
    return themeOptions('hotelbookings_theme_options','hotelinfodesc');
}
function get_hotel_email_subject(){
    return themeOptions('hotelbookings_theme_emailoptions','subject');
}
function get_hotel_email_template(){
    return themeOptions('hotelbookings_theme_emailoptions','template');
}


/*Pagenation*/
function pagination_nav($wp_query) {
    $output ="";
    $total_pages = $wp_query->max_num_pages;
    if ( $total_pages > 1 ) { $current_page = max(1, get_query_var('paged')); 
        $output = paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text'    => __('PREVIOUS','hotelbookings'),
            'next_text'    => __('NEXT','hotelbookings'),
        ));
         return $output;
    }
}




function load_post_template($template) {
    global $post;

    if ($post->post_type == "promotions" && $template !== locate_template(array("single-promotion.php"))){
      
        return plugin_dir_path( __FILE__ ) . "templates/single-promotion.php";
    }

    return $template;
}

add_filter('single_template', 'load_post_template');



//function get_custom_post_type_template( $archive_template ) {
//     global $post;
//
//     if ( is_post_type_archive ( 'roomtypes' ) ) {
//          $archive_template = plugin_dir_path( __FILE__ ) . 'templates/booking.php';
//     }
//     return $archive_template;
//}
//
//add_filter( 'archive_template', 'get_custom_post_type_template' ) ;



function register_my_session(){
    if( ! session_id() ) {
        session_start();
    }
}

add_action('init', 'register_my_session');




 /*********************
 MENUS & NAVIGATION
*********************/
function icon_navigation() {
// display the wp3 menu if available
 wp_nav_menu(array(
    'container' => false,                           // remove nav container
    'container_class' => false,           // class of container (should you choose to use it)
    'menu' => __( 'Icons' ),  // nav name
    'menu_class' => 'icon-navigation',         // adding custom nav class
    'theme_location' => 'icon-navigation',                 // where it's located in the theme
    'before' => '',                                 // before the menu
    'after' => '',                                  // after the menu
    'link_before' => '<span>',                            // before each link
    'link_after' => '</span>',                             // after each link
    'depth' => 0,
));
} /* end theme main nav */
function menu_creation(){
    register_nav_menus(
        array('icon-navigation' => __('The Icon List' ))
    );
}
add_action('init','menu_creation', 10); 


add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_nav_menu_objects( $items, $args ) {
	// loop
	foreach( $items as &$item ) {
		// vars
		$icon = get_field('menu_icon', $item);
		// append icon
		if( $icon ) {
			$item->title .= ' '.wp_get_attachment_image($icon,'full');
		}
	}
	// return
	return $items;
}




/*
    Promotions details
    get_promotion_price -- get the week days price
    get_promotion_price_weekends -- get the price for Friday & Sunday ( Vrijdag en Zondag)
    get_promotion_price_saturdays -- get the price for Saturday.
*/

function get_promotion_price($id, $members=2){
    $price = 0;
    if(have_rows('weekdays',$id)): while(have_rows('weekdays',$id)): the_row();
    if($members == 2){
        $price = get_sub_field('weekdays_price');
    }else{
        $price = get_sub_field('weekdays_extra_person');
    }
    endwhile; endif;
    return $price;
}
function get_promotion_price_weekends($id, $members=2){
     $price = 0;
    if(have_rows('weekends',$id)): while(have_rows('weekends',$id)): the_row();
    if($members == 2){
        $price = get_sub_field('weekends_price');
    }else{
        $price = get_sub_field('weekends_extra_person');
    }
    endwhile; endif;
    return $price;
}
function get_promotion_price_saturdays($id, $members=2){
     $price = 0;
    if(have_rows('saturdays',$id)): while(have_rows('saturdays',$id)): the_row();
    if($members == 2){
        $price = get_sub_field('saturday_price');
    }else{
        $price = get_sub_field('saturday_extra_person');
    }
    endwhile; endif;
    return $price;
}

function get_room_for_promotions($pid){
    return get_field('link_rooms',$pid);
}
function get_upsells_for_promotions($pid){
    return get_field('link_sells',$pid);
}

function selected_dates_range($dates){
    $date_array = explode(",",$dates);
    $count= count($date_array);
    $start_date = $date_array[0];
    $end_date = $date_array[$count - 1];
    return get_selected_date_string($start_date, $end_date);
}

function get_selected_date_string($start_date, $end_date){
    $start_date = strtotime($start_date);
    $end_date = strtotime($end_date);
    $start_date = date_i18n('l d F Y',$start_date);
    $end_date = date_i18n('l d F Y',$end_date);
    
    return $start_date." - ".$end_date;
}

function get_booking_total($price ,$nights, $upsells){
    $upsell_price = 0;
     foreach($upsells as $upsell): 
        $upsell_price = $upsell_price +  get_field('upsell_price',$upsell);
     endforeach; 
    return ($price*$nights)+$upsell_price;
}


function promotions_postsshortcode(){
    $output = '';
     $output .= '<div class="promotions-list">';
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $catquery = new WP_Query( 
                array( 'post_type' => 'promotions', 
                        'posts_per_page' => 5,
                        'paged' => $paged,
                     )
            );
    while($catquery->have_posts()) : $catquery->the_post(); 
    $title = get_the_title();
    $link = get_the_permalink(); 
    $pid = get_the_ID();
    $tid = get_post_thumbnail_id();
    $turl = wp_get_attachment_url($tid,'full');
    
    $output .= '<div class="promotion clearfix">
                <div class="promotion-image" style="background-image:url('.$turl.')"></div>
                <div class="promotion-info clearfix"><div class="promotion-info-left"><div class="promotion-title">'.get_the_title().'</div><div class="promotion-features">';
    if(have_rows('promotiondetails')):
     $output .= '<ul>';
        while(have_rows('promotiondetails')): the_row();
        $output .="<li>".get_sub_field('promotiondetail')."</li>";
        endwhile;
     $output .= '</ul>';
    endif;
     $output .= '</div></div><div class="promotion-info-right">';
        $output .= '<div class="price">€ '.get_promotion_price($pid,2).'</div>';
        $output .= '<a class="button" href="'.$link.'">'.__('Meer','hotelbookings').'</a>';
     $output .= '</div></div></div>';
    endwhile; wp_reset_query();

    $output .="<div class='post-navigation'>".pagination_nav($catquery)."</div>";
$output .= '</div>';
    return $output;
}

add_shortcode('load-promotions', 'promotions_postsshortcode');


add_action( 'wp_ajax_calculate_fares', 'calculate_fares' );
add_action( 'wp_ajax_nopriv_calculate_fares', 'calculate_fares' );


function calculate_fares(){
    $result = array();
//	$result['status'] = 0;
    $hb_persons = $_POST['hb_persons'];
    $hb_rooms = $_POST['hb_rooms'];
    $pid = $_POST['hb_pid'];
    if($hb_persons == 1){
            $week_price = get_promotion_price($pid,1); // Monday to Thursday
            $weekend_price = get_promotion_price_weekends($pid,1); // Friday and Sunday
            $saturday_price = get_promotion_price_saturdays($pid,1); // Saturday
    }else{
        if(($hb_persons % 2)==0){
            $week_price = get_promotion_price($pid)*$hb_rooms; // Monday to Thursday
            $weekend_price = get_promotion_price_weekends($pid)*$hb_rooms; // Friday and Sunday
            $saturday_price = get_promotion_price_saturdays($pid)*$hb_rooms; // Saturday
        }else{
            $week_price = (get_promotion_price($pid)*($hb_rooms-1)) + get_promotion_price($pid,1); // Monday to Thursday
            $weekend_price = (get_promotion_price_weekends($pid)*($hb_rooms-1)) + get_promotion_price_weekends($pid,1); // Friday and Sunday
            $saturday_price = (get_promotion_price_saturdays($pid)*($hb_rooms-1)) + get_promotion_price_weekends($pid,1); // Saturday
        }
    }
    
    $calendarPrices =  array('w0'=>"$weekend_price", 'w1' => "$week_price", 'w2'=>"$week_price", 'w3'=> "$week_price",'w4'=>"$week_price", 'w5'=>"$weekend_price", 'w6'=>"$saturday_price");
    $result['calendarPrices'] = $calendarPrices;
	$result['status'] = 1;
	echo json_encode($result);
//	print_r($calendarPrices);
	die();
}


?>
