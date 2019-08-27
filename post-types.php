<?php
function load_post_types() { 
    
    register_post_type( 'roomtypes', 
        // let's now add all the options for this post type
        array( 'labels' => array(
            'name' => __( 'Kamers' ), /* This is the Title of the Group */
            'singular_name' => __( 'Kamer' ), /* This is the individual type */
            'all_items' => __( 'Kamers' ), /* the all items menu item */
            'add_new' => __( 'Add New' ), /* The add new menu item */
            'add_new_item' => __( 'Add New' ), /* Add New Display Title */
            'edit' => __( 'Research' ), /* Edit Dialog */
            'edit_item' => __( 'Edit Kamer' ), /* Edit Display Title */
            'view_item' => __( 'View Kamer' ), /* View Display Title */
            'search_items' => __( 'Zoeken Kamer' ), /* Search Custom Type Title */ 
            'not_found' =>  __( 'Nothing found in the Database.' ), /* This displays if there are no entries yet */ 
            'not_found_in_trash' => __( 'Nothing found in Trash' ), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
            ), /* end of arrays */
            'description' => __( 'This is the kamer post type' ), /* Custom Type Description */
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'query_var' => true,
            'show_in_menu' => 'hotel_booking',
            'menu_icon' => 'dashicons-admin-network', /* the icon for the custom post type menu */
            'rewrite'	=> array( 'slug' => 'kamer', 'with_front' => false ), /* you can specify its url slug */
            'has_archive' => 'category-kamer', /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
            /* the next one is important, it tells what's enabled in the post editor */
            'supports' => array( 'title','thumbnail','editor' )
        ) /* end of options */
    ); /* end of register post type */     
    
    register_post_type( 'upsells', 
        // let's now add all the options for this post type
        array( 'labels' => array(
            'name' => __( 'Upsells' ), /* This is the Title of the Group */
            'singular_name' => __( 'upsell' ), /* This is the individual type */
            'all_items' => __( 'Upsells' ), /* the all items menu item */
            'add_new' => __( 'Add New' ), /* The add new menu item */
            'add_new_item' => __( 'Add New' ), /* Add New Display Title */
            'edit' => __( 'Research' ), /* Edit Dialog */
            'edit_item' => __( 'Edit upsell' ), /* Edit Display Title */
            'view_item' => __( 'View upsell' ), /* View Display Title */
            'search_items' => __( 'Zoeken upsell' ), /* Search Custom Type Title */ 
            'not_found' =>  __( 'Nothing found in the Database.' ), /* This displays if there are no entries yet */ 
            'not_found_in_trash' => __( 'Nothing found in Trash' ), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
            ), /* end of arrays */
            'description' => __( 'This is the upsell post type' ), /* Custom Type Description */
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'query_var' => true,
            'show_in_menu' => 'hotel_booking',
            'menu_icon' => 'dashicons-admin-network', /* the icon for the custom post type menu */
            'rewrite'	=> array( 'slug' => 'upsell', 'with_front' => false ), /* you can specify its url slug */
            'has_archive' => 'category-upsell', /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
            /* the next one is important, it tells what's enabled in the post editor */
            'supports' => array( 'title','thumbnail','editor' )
        ) /* end of options */
    ); /* end of register post type */   
    
    register_post_type( 'promotions', 
        // let's now add all the options for this post type
        array( 'labels' => array(
            'name' => __( 'Promoties' ), /* This is the Title of the Group */
            'singular_name' => __( 'Promotie' ), /* This is the individual type */
            'all_items' => __( 'Promoties' ), /* the all items menu item */
            'add_new' => __( 'Add New' ), /* The add new menu item */
            'add_new_item' => __( 'Add New' ), /* Add New Display Title */
            'edit' => __( 'Research' ), /* Edit Dialog */
            'edit_item' => __( 'Edit Promotie' ), /* Edit Display Title */
            'view_item' => __( 'View Promotie' ), /* View Display Title */
            'search_items' => __( 'Zoeken Promotie' ), /* Search Custom Type Title */ 
            'not_found' =>  __( 'Nothing found in the Database.' ), /* This displays if there are no entries yet */ 
            'not_found_in_trash' => __( 'Nothing found in Trash' ), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
            ), /* end of arrays */
            'description' => __( 'This is the Promotie post type' ), /* Custom Type Description */
            'public' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'query_var' => true,
            'show_in_menu' => 'hotel_booking',
            'menu_icon' => 'dashicons-admin-network', /* the icon for the custom post type menu */
            'rewrite'	=> array( 'slug' => 'promotion', 'with_front' => false ), /* you can specify its url slug */
            'has_archive' => 'category-promotie', /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
            /* the next one is important, it tells what's enabled in the post editor */
            'supports' => array( 'title','thumbnail','editor' )
        ) /* end of options */
    ); /* end of register post type */   
    
    register_post_type( 'bookings', 
        // let's now add all the options for this post type
        array( 'labels' => array(
            'name' => __( 'Bookings' ), /* This is the Title of the Group */
            'singular_name' => __( 'Booking' ), /* This is the individual type */
            'all_items' => __( 'Bookings' ), /* the all items menu item */
            'add_new' => __( 'Add New' ), /* The add new menu item */
            'add_new_item' => __( 'Add New' ), /* Add New Display Title */
            'edit' => __( 'Research' ), /* Edit Dialog */
            'edit_item' => __( 'Edit Booking' ), /* Edit Display Title */
            'view_item' => __( 'View Booking' ), /* View Display Title */
            'search_items' => __( 'Zoeken Booking' ), /* Search Custom Type Title */ 
            'not_found' =>  __( 'Nothing found in the Database.' ), /* This displays if there are no entries yet */ 
            'not_found_in_trash' => __( 'Nothing found in Trash' ), /* This displays if there is nothing in the trash */
            'parent_item_colon' => ''
            ), /* end of arrays */
            'description' => __( 'This is the Booking post type' ), /* Custom Type Description */
            'public' => false,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'show_ui' => true,
            'query_var' => true,
            'show_in_menu' => 'hotel_booking',
            'menu_icon' => 'dashicons-admin-network', /* the icon for the custom post type menu */
            'rewrite'	=> array( 'slug' => 'booking', 'with_front' => false ), /* you can specify its url slug */
            'has_archive' => 'category-promotie', /* you can rename the slug here */
            'capability_type' => 'post',
            'hierarchical' => false,
            /* the next one is important, it tells what's enabled in the post editor */
            'supports' => array( 'title' )
        ) /* end of options */
    ); /* end of register post type */  
} 
add_action( 'init', 'load_post_types');
?>
