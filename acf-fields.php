<?php 
function my_acf_add_local_field_groups_rooms() {
/*Roomtype Fields*/
acf_add_local_field_group(array(
	'key' => 'hotel_images',
	'title' => 'Hotel Images',
	'fields' => array(
		array(
			'key' => 'hotelimages',
			'label' => 'Images',
			'name' => 'hotelimages',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 3,
			'layout' => 'table',
			'button_label' => '',
			'sub_fields' => array(
				array(
					'key' => 'image',
					'label' => 'Image',
					'name' => 'image',
					'type' => 'image',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
                    'return_format' => 'id',
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'roomtypes',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));
acf_add_local_field_group( array(
    'key' => 'roomoptions',
    'title' => 'Room Options',
    'fields' => array (
           array (
            'key' => 'rm_facilities',
            'label' => 'Room facilities',
            'name' => 'rm_facilities',
            'type' => 'textarea',
        ),
           array (
            'key' => 'rm_persons',
            'label' => 'Number of persons',
            'name' => 'rm_persons',
            'type' => 'number',
        ),
           array (
            'key' => 'rm_size',
            'label' => 'Number of m2',
            'name' => 'rm_size',
            'type' => 'number',
        )
    ),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'roomtypes',
            ),
        ),
    ),
)                 
);
	
}

/*Upsell Fields*/
function my_acf_add_local_field_groups_upsell() {
    acf_add_local_field_group( array(
        'key' => 'upsellprice',
        'title' => 'Upsell Price',
        'fields' => array (
               array (
                'key' => 'upsell_price',
                'label' => 'Price',
                'name' => 'upsell_price',
                'type' => 'text',
            )
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'upsells',
                ),
            ),
        ),
    )                 
    );
}
/*Promotions Fields*/
function my_acf_add_local_field_groups_promotion() {
    acf_add_local_field_group( array(
        'key' => 'promotion_options',
        'title' => 'Promotion Options',
        'fields' => array (
            array(
                'key' => 'promotiondetails',
                'label' => 'Promotion details',
                'name' => 'promotiondetails',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => '',
                'sub_fields' => array(
                    array(
                        'key' => 'promotiondetail',
                        'label' => 'Promotion detail',
                        'name' => 'promotiondetail',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
            ),
           array (
                'key' => 'pm_nights',
                'label' => 'Set number of nights',
                'name' => 'pm_nights',
                'type' => 'number',
                 'wrapper' => array(
                    'width' => '20',
                    'class' => '',
                    'id' => '',
                ),
            ),
           array (
                'key' => 'pm_sdate',
                'label' => 'Start Date',
                'name' => 'pm_sdate',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
               'wrapper' => array(
                    'width' => '40',
                    'class' => '',
                    'id' => '',
                ),
            ),
           array (
                'key' => 'pm_edate',
                'label' => 'End Date',
                'name' => 'pm_edate',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
                'first_day' => 1,
                'wrapper' => array(
                    'width' => '40',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array(
                'key' => 'nopromotions',
                'label' => 'Promotions not avialiable on',
                'name' => 'nopromotions',
                'type' => 'multi_dates_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_input' => 1,
            ),
            array (
                'key' => 'pm_breakfast',
                'label' => 'Include Breakfast',
                'name' => 'pm_breakfast',
                'type' => 'true_false',
            ),
            array(
                'key' => 'link_sells',
                'label' => 'Link upsells',
                'name' => 'link_sells',
                'type' => 'relationship',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'upsells',
                ),
                'taxonomy' => '',
                'filters' => array(
                    0 => 'search',
                    1 => 'post_type',
                    2 => 'taxonomy',
                ),
                'elements' => '',
                'min' => '',
                'max' => '',
                'return_format' => 'id',
            ),
            array(
                'key' => 'link_rooms',
                'label' => 'Select Rooms',
                'name' => 'link_rooms',
                'type' => 'relationship',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'roomtypes',
                ),
                'taxonomy' => '',
                'filters' => array(
                    0 => 'search',
                    1 => 'post_type',
                    2 => 'taxonomy',
                ),
                'elements' => '',
                'min' => '',
                'max' => '',
                'return_format' => 'id',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'promotions',
                ),
            ),
        ),
    )                 
    );
    
   acf_add_local_field_group( array(
    'key' => 'price_group',
    'title' => 'Price Group',
    'fields' => array (
        array(
			'key' => 'weekdays',
			'label' => 'Monday – Thursday (maandag t/m donderdag)',
			'name' => 'weekdays',
			'type' => 'group',
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'weekdays_price',
					'label' => 'Price for two',
					'name' => 'weekdays_price',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
				),		
                array(
					'key' => 'weekdays_extra_person',
					'label' => 'Single price',
					'name' => 'weekdays_extra_person',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
				),
			),
		),       
        array(
			'key' => 'weekends',
			'label' => 'Friday & Sunday ( Vrijdag en Zondag)',
			'name' => 'weekends',
			'type' => 'group',
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'weekends_price',
					'label' => 'Price for two',
					'name' => 'weekends_price',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
				),		
                array(
					'key' => 'weekends_extra_person',
					'label' => 'Single price',
					'name' => 'weekends_extra_person',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
				),
			),
		),       
        array(
			'key' => 'saturdays',
			'label' => 'Saturday ( Zaterdag)',
			'name' => 'saturdays',
			'type' => 'group',
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'saturday_price',
					'label' => 'Price for two',
					'name' => 'saturday_price',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
				),		
                array(
					'key' => 'saturday_extra_person',
					'label' => 'Single price',
					'name' => 'saturday_extra_person',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
				),
			),
		),
       ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'promotions',
                ),
            ),
        ),
    )  
    );
}



function my_acf_add_local_field_groups_icons(){
    acf_add_local_field_group(array(
	'key' => 'menu_image',
	'title' => 'menu image',
	'fields' => array(
		array(
			'key' => 'menu_icon',
			'label' => 'Menu icon',
			'name' => 'menu_icon',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'id',
			'preview_size' => 'thumbnail',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'nav_menu_item',
				'operator' => '==',
				'value' => 'location/icon-navigation',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));
}



/*Promotions Fields*/
function my_acf_add_local_field_groups_booking() {

    acf_add_local_field_group(array(
        'key' => 'gooking_options',
        'title' => 'Booking Options',
        'fields' => array(
            array(
                'key' => 'room_details',
                'label' => 'Room details',
                'name' => '',
                'type' => 'accordion',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'open' => 0,
                'multi_expand' => 0,
                'endpoint' => 0,
            ),
            array(
                'key' => 'room_type',
                'label' => 'Room type',
                'name' => 'room_type',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'fare_booked',
                'label' => 'Fare Booked',
                'name' => 'fare_booked',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),         
            array(
                'key' => 'dates_booked',
                'label' => 'Dates Booked',
                'name' => 'dates_booked',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'nights',
                'label' => 'Nights',
                'name' => 'nights',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'persons',
                'label' => 'Persons',
                'name' => 'persons',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'upsells',
                'label' => 'Upsells',
                'name' => 'upsells',
                'type' => 'relationship',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'upsells',
                ),
                'taxonomy' => '',
                'filters' => array(
                    0 => 'search',
                    1 => 'post_type',
                    2 => 'taxonomy',
                ),
                'elements' => '',
                'min' => '',
                'max' => '',
                'return_format' => 'id',
            ),
            array(
                'key' => 'Personal Details',
                'label' => 'Pesonal Details',
                'name' => '',
                'type' => 'accordion',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'open' => 0,
                'multi_expand' => 0,
                'endpoint' => 0,
            ),
            array(
                'key' => 'company_name',
                'label' => 'Company Name',
                'name' => 'company_name',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),          
            array(
                'key' => 'first_name',
                'label' => 'First Name',
                'name' => 'first_name',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '40',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'middle_name',
                'label' => 'Middle Name',
                'name' => 'middle_name',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '20',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'last_name',
                'label' => 'Last Name',
                'name' => 'last_name',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '40',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'postcode',
                'label' => 'Postcode',
                'name' => 'postcode',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'street',
                'label' => 'Street and House number',
                'name' => 'street',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'city',
                'label' => 'City',
                'name' => 'city',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'country',
                'label' => 'Country',
                'name' => 'country',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'phone',
                'label' => 'Phone',
                'name' => 'phone',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'email',
                'label' => 'Email',
                'name' => 'email',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'date_of_birth',
                'label' => 'Date Of Birth',
                'name' => 'date_of_birth',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'bookings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
}


add_action('acf/init', 'my_acf_add_local_field_groups_rooms');
add_action('acf/init', 'my_acf_add_local_field_groups_upsell');
add_action('acf/init', 'my_acf_add_local_field_groups_promotion');
add_action('acf/init', 'my_acf_add_local_field_groups_booking');
add_action('acf/init', 'my_acf_add_local_field_groups_icons');