<?php get_header(); ?>
<?php while(have_posts()): the_post(); $tid = get_post_thumbnail_id(); $timage = wp_get_attachment_image_src($tid,'full'); ?>
<!--Update Booking-->
<?php if(isset($_REQUEST['booking_confirm'])): ?>
   <?php
    $total_fare = $_POST['total_fare'];
    $vistor_details = $_SESSION['vistor_details'];
    $room_details = $_SESSION['room_details'];
    $booking_details = $_SESSION['booking_details'];
/*   print_r($booking_details);
    echo "<br>====<br>";
    print_r($room_details);
    echo "<br>====<br>";
    print_r($vistor_details);
    echo "<br>====<br>"; */

$post_title = "Booking";
$user = get_current_user_id();
   $my_post = array(
        'post_title'	=> $post_title,
        'post_type'		=> 'bookings',
        'post_author'	=> $user,
        'post_status'	=> 'publish'
    );
// insert the post into the database
    $post_id = wp_insert_post( $my_post );
    $update_post_title = array(
        'ID' =>$post_id,
        'post_title'	=> "#".$post_id." ".$post_title,
    );
    wp_update_post($update_post_title);
    $meta_fields = array(
        'room_type' => get_the_title($room_details['room']),
        'fare_booked' => $booking_details['booking_price'],
        'dates_booked' => selected_dates_range($booking_details['bookingdate']),
        'nights' => $booking_details['promotionnights'],
        'persons' => $booking_details['persons'],
        'company_name' => $vistor_details['company_name'],
        'first_name' => $vistor_details['firstname'],
        'middle_name' => $vistor_details['middlename'],
        'last_name' => $vistor_details['lastname'],
        'postcode' => $vistor_details['postcode'],
        'street' => $vistor_details['street'],
        'city' => $vistor_details['city'],
        'country' => $vistor_details['country'],
        'phone' => $vistor_details['phone'],
        'email' => $vistor_details['vemail'],
        'date_of_birth' => $vistor_details['DOB'],
        
        //'upsells' => $ctt,
    );

   foreach($meta_fields as $meta_key => $value){
        update_post_meta($post_id,$meta_key,$value);
    }

    $headers = array('Content-Type: text/html; charset=UTF-8');
    $email_content = get_hotel_email_template();
    $email_subject = get_hotel_email_subject();

    $email_content = str_replace("[Firstname]",$vistor_details['firstname'],$email_content);
    $email_content = str_replace("[Lastname]",$vistor_details['lastname'],$email_content);

    $emailID = get_hotel_admin_email();
    $emailClient = $vistor_details['vemail'];
    
    $wp_admin_subject = "New booking with number #".$post_id." ".$post_title;
    $wp_admin_content = "You have New reservation";
    
    $wp_admin_email = wp_mail($emailID , $wp_admin_subject,$wp_admin_content, $headers);
    $wp_client_email = wp_mail($emailClient , $email_subject,$email_content, $headers);

?>
<div class="sections-thankyou">
    <div class="container">
         <?php if($wp_client_email) : ?>
          <h2>Your booking Is Sucussesful.. Our agent will contact you</h2>
         <?php else : ?>
          <h2>Unable to Bookyou through Reservation: Please Contact Site Admin.</h2>
          <?php endif; ?>
    </div>
</div>
<!--ConfirmBookin-->
<?php elseif(isset($_REQUEST['next_view'])): ?>
<?php
    $_SESSION['vistor_details'] = $_POST;
    $vistor_details = $_SESSION['vistor_details'];
    $room_details = $_SESSION['room_details'];
    $booking_details = $_SESSION['booking_details'];
    /*print_r($vistor_details);
    echo "<br>====<br>";
    print_r($room_details);
    echo "<br>====<br>";
    print_r($booking_details);
    echo "<br>====<br>";*/
?>
<div class="bookingconfirm">
    <div class="container">
        <div class="bookingconfirm-wrap">
            <div class="bookingconfirm-room-details">
                <h2><?php _e("Kamer informatie","hotelbookings"); ?></h2>
                <hr>
                <div class="room-price-blk clearfix">
                    <strong class="room-price-blk-left"><?php echo get_the_title($room_details['room']);  ?></strong>
                    <span class="room-price-blk-right"><?php echo $booking_details['booking_price'];  ?></span>
                </div>
                <ul>
                    <li><strong><?php _e("Datum","hotelbookings"); ?> : </strong><?php echo selected_dates_range($booking_details['bookingdate']); ?></li>
                    <li><strong><?php _e("Aantal nachten","hotelbookings");?> : </strong><?php echo $booking_details['promotionnights'];  ?></li>
                    <li><strong><?php _e("Aantal personen","hotelbookings");?> : </strong><?php echo $booking_details['persons'];  ?></li>
                </ul>
            </div>
            <div class="bookingconfirm-upsell-details">
                <h2><?php _e("Aanvullend","hotelbookings"); ?></h2>
                <hr>
                <?php foreach($room_details['upsells'] as $upsell): ?>
                <div class="upsell-price-blk clearfix">
                    <strong class="upsell-price-blk-left"><?php echo get_the_title($upsell);  ?></strong>
                    <span class="upsell-price-blk-right"><?php echo get_field('upsell_price',$upsell); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="bookingconfirm-Personal-details">
               <h2><?php _e("Persoonlijke informatie","hotelbookings"); ?></h2>
                <hr>
                <ul>
                    <?php if($vistor_details['company_name']): ?>
                    <li><strong><?php _e("Title","hotelbookings"); ?> :</strong> <?php echo $vistor_details['company_name']; ?></li>
                    <?php endif; ?>
                    <li><strong><?php _e("Naam","hotelbookings"); ?> :</strong> <?php echo $vistor_details['firstname']; ?><?php echo $vistor_details['middlename']; ?><?php echo $vistor_details['lastname']; ?></li>
                    <li><strong><? _e("Postcode :","hotelbookings");?></strong> <?php echo $vistor_details['postcode']; ?></li>
                    <li><strong><?php _e("Huisnummer","hotelbookings"); ?> :</strong> <?php echo $vistor_details['hnumber']; ?></li>
                    <li><strong><?php _e("straat","hotelbookings"); ?> :</strong> <?php echo $vistor_details['street']; ?></li>
                    <li><strong><?php _e("Woonplaats","hotelbookings"); ?> :</strong> <?php echo $vistor_details['city']; ?></li>
                    <li><strong><?php _e("Land","hotelbookings"); ?> :</strong> <?php echo $vistor_details['country']; ?></li>
                    <li><strong><?php _e("Telefoonnummer","hotelbookings"); ?> :</strong> <?php echo $vistor_details['phone']; ?></li>
                    <li><strong><?php _e("E-Mailadress","hotelbookings");?> :</strong> <?php echo $vistor_details['vemail']; ?></li>
                    <li><strong><?php _e("Geboortedatum","hotelbookings");?> :</strong> <?php echo $vistor_details['DOB']; ?></li>
                </ul>
            </div> 
              <div class="bookingconfirm-Fare-details">
               <h2><?php _e("Totaal te voldoen","hotelbookings"); ?><strong><?php echo get_booking_total($booking_details['booking_price'],$booking_details['promotionnights'],$room_details['upsells']); ?></strong></h2>
                <hr>
                <form action="" method="post">
                    <input type="hidden" name="total_fare" value="<?php echo get_booking_total($booking_details['booking_price'],$booking_details['promotionnights'],$room_details['upsells']); ?>">
                    <input type="submit" name="booking_confirm" value="Bevestig boeking">
                </form>
            </div>
        </div>
    </div>
</div>

<!--UserInfo-->
<?php elseif(isset($_REQUEST['proceed_booking'])): ?>
<?php 
    $_SESSION['room_details'] = $_POST;
    $room_details = $_SESSION['room_details'];
    $booking_details = $_SESSION['booking_details'];
    /*print_r($_SESSION['room_details']);
    echo "<br>====<br>";
    print_r($_SESSION['booking_details']);*/
?>
<section class="personaldetails">
    <div class="container">
        <h2><?php _e("UW GEGEVENS","hotelbookings"); ?></h2>
        <div class="personaldetails-wrap clearfix">
            <div class="personaldetails-left">
                <form action="" method="post">
                    <div class="input_wrap vtype">
                        <span class="input-radio">
                            <input type="radio" id="private_pt" name="person_type" value="private">
                            <label for="private_pt"><?php _e("Prive","hotelbookings");?></label>
                        </span>
                        <span class="input-radio">
                            <input type="radio" id="company_pt" name="person_type" value="company">
                            <label for="company_pt"><?php _e("Zakelijk","hotelbookings");?></label>
                        </span>
                        <input style="display:none" name="company_name" class="companyname">
                    </div>
                    <h3><?php _e("Contactgegevens","hotelbookings"); ?></h3>
                    <div class="input_wrap">
                        <div class="vfield v30">
                            <label for=""><?php _e("Aanhef","hotelbookings");?></label>
                            <select name="vtitle" id="">
                                <option value="Dhr.">Dhr.</option>
                                <option value="Mevr.">Mevr.</option>
                            </select>
                        </div>
                        <div class="vfield vright v65">
                            <label for=""><?php _e("Voornaam","hotelbookings");?></label>
                            <input type="text" name="firstname">
                        </div>
                    </div>
                    <div class="input_wrap">
                        <div class="vfield v30">
                            <label for=""><?php _e("tussenvoegsel","hotelbookings");?></label>
                            <input type="text" name="middlename">
                        </div>
                        <div class="vfield vright v65">
                            <label for=""><?php _e("Achternaam","hotelbookings");?></label>
                            <input type="text" name="lastname">
                        </div>
                    </div>
                    <div class="input_wrap">
                        <div class="vfield v30">
                            <label for=""><?php _e("Postcode","hotelbookings");?></label>
                            <input type="text" name="postcode">
                        </div>
                    </div>
                    <div class="input_wrap">
                        <label for=""><?php _e("Straat en huisnummer","hotelbookings");?></label>
                        <input type="text" name="street">
                    </div>
                    <div class="input_wrap">
                        <label for=""><?php _e("Woonplaats","hotelbookings"); ?></label>
                        <input type="text" name="city">
                    </div>
                    <div class="input_wrap">
                        <label for=""><?php _e("Land","hotelbookings"); ?></label>
                        <select name="country" id="">
                            <option value="netherlands">Nederland</option>
                        </select>
                    </div>
                    <div class="input_wrap">
                        <label for=""><?php _e("Telefoonnummer","hotelbookings"); ?></label>
                        <input type="text" name="phone">
                    </div>
                    <div class="input_wrap">
                        <label for=""><?php _e("E-Mailadress","hotelbookings"); ?></label>
                        <input type="text" name="vemail">
                    </div>
                    <div class="input_wrap">
                        <label for=""><?php _e("Geboortedatum","hotelbookings"); ?></label>
                        <input type="date" name="DOB">
                    </div>
                    <div class="input_wrap">
                        <input type="checkbox" id="terms_pt" name="terms">
                        <label for="terms_pt"><?php _e("Akkoord met voorwaaden","hotelbookings"); ?></label>
                    </div>
                    <div class="input_wrap">
                        <input type="checkbox" id="registration_pt" name="registration">
                        <label for="registration_pt"><?php _e("Aanmelden voor de nieuwsbrief","hotelbookings"); ?></label>
                    </div>
                    <div class="submit-blk">
                        <input type="submit" name="next_view" value="volgende">
                    </div>
                </form>
            </div>
            <div class="personaldetails-right">
                <div class="image">
                    <?php echo wp_get_attachment_image(get_post_thumbnail_id($room_details['room']),'large') ?>
                </div>
                <div class="room-info">
                    <div class="booking-info">
                        <h3><?php _e("UW Boeking bij","hotelbookings"); ?><?php echo get_hotel_name(); ?></h3>
                        <div class="booking-info-details">
                            <ul>
                                <li><strong>Datum : </strong><?php echo selected_dates_range($booking_details['bookingdate']); ?></li>
                                <li><strong>Aantal nachten : </strong><?php echo $booking_details['promotionnights'];  ?></li>
                                <li><strong>Aantal personen : </strong><?php echo $booking_details['persons'];  ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="room-price-blk clearfix">
                        <strong class="room-price-blk-left"><?php echo get_the_title($room_details['room']);  ?></strong>
                        <span class="room-price-blk-right"><?php echo $booking_details['booking_price'];  ?></span>
                    </div>
                    <?php if(count($room_details['upsells'])>0) : ?>
                    <hr><?php _e("Aanvullend","hotelbookings"); ?>
                    <hr>
                    <?php foreach($room_details['upsells'] as $upsell): ?>
                    <div class="upsell-price-blk clearfix">
                        <strong class="upsell-price-blk-left"><?php echo get_the_title($upsell);  ?></strong>
                        <span class="upsell-price-blk-right"><?php echo get_field('upsell_price',$upsell); ?></span>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <hr>
                    <div class="total-price-blk clearfix">
                        <strong class="upsell-price-blk-left"><?php _e("Totaal te voldoen","hotelbookings"); ?></strong>
                        <span class="upsell-price-blk-right"><?php echo get_booking_total($booking_details['booking_price'],$booking_details['promotionnights'],$room_details['upsells']); ?></span>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Selection of Rooms-->
<?php elseif(isset($_REQUEST['promotionitem'])):
    $promtion_id = $_REQUEST['promotionid'];
    $pomotion_nights = $_REQUEST['promotionnights'];
    $pomotion_bookingdates = $_REQUEST['bookingdate'];
    $no_rooms = $_REQUEST['persons'];
    $no_persons = $_REQUEST['rooms'];
    $booking_price = $_REQUEST['booking_price'];
    $promtion_rooms = get_room_for_promotions($promtion_id);
    $promtion_upsells = get_upsells_for_promotions($promtion_id);
?>
<form name="selectrooms" action="" method="post">
    <div class="section-roomselect">
        <?php $_SESSION['booking_details'] = $_POST; ?>
        <!--        <input type="hidden" name="promotion_info" value="<?php print_r($_POST); ?>">-->
        <div class="promotions-section">
            <div class="container">
                <div class="promotions-list">
                    <?php 
                    $title = get_the_title($promtion_id);
                    $link = get_the_permalink($promtion_id); 
                    $tid = get_post_thumbnail_id($promtion_id);
                    $turl = wp_get_attachment_url($tid,'full');    
                ?>
                    <div class="promotion clearfix">
                        <div class="promotion-image" style="background-image:url(<?php echo $turl; ?>)"></div>
                        <div class="promotion-info clearfix">
                            <div class="promotion-info-left">
                                <div class="promotion-detail">
                                    <?php echo _e('Boek het arrangement ','hotelbookings'); ?><br>
                                    <?php echo $title ?>,<?php echo $pomotion_nights ?>-Daags
                                </div>
                                <div class="promotion-title"></div>
                                <div class="promotion-features">
                                    <?php   if(have_rows('promotiondetails', $promtion_id)): ?>
                                    <ul>
                                        <?php while(have_rows('promotiondetails', $promtion_id)): the_row(); ?>
                                        <li><?php echo get_sub_field('promotiondetail'); ?></li>
                                        <?php endwhile; ?>
                                    </ul>
                                    <?php  endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rooms-section">
            <div class="container">
                <h2><?php _e("Select Rooms","hotelbookings"); ?></h2>
                <div class="room-wrap">
                    <?php foreach($promtion_rooms as $room): ?>
                    <div class="room clearfix">
                        <div class="room-images">
                            <a data-fancybox="gallery-<?php echo $room; ?>" class="main-image" href="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($room),'full')[0] ?>"><?php echo wp_get_attachment_image(get_post_thumbnail_id($room),'large') ?></a>
                            <?php if(have_rows('hotelimages',$room)): while(have_rows('hotelimages',$room)): the_row(); 
                            $imageurl = wp_get_attachment_image_src(get_sub_field('image'),'full');
                        ?>
                            <a class="thumb-image" href="<?php echo $imageurl[0]; ?>" data-fancybox="gallery-<?php echo $room; ?>"><?php echo wp_get_attachment_image(get_sub_field('image'),'thumbnail') ?></a>
                            <?php endwhile; endif; ?>
                        </div>
                        <div class="room-info">
                            <h3><?php echo get_the_title($room); ?></h3>
                            <div class="room-info-meta">
                                <div><strong><?php _e("m2:","hotelbookings");?></strong><?php echo get_field('rm_size',$room); ?></div>
                                <div><strong><?php _e("Personen:","hotelbookings");?></strong><?php echo get_field('rm_persons',$room); ?></div>
                            </div>
                            <div class="room-info-desc">
                                <p><?php echo get_field('rm_facilities',$room); ?></p>
                            </div>
                            <div class="radio-btn"><input type="radio" name="room" value="<?php echo $room; ?>" id="room-<?php echo $room; ?>">
                                <label for="room-<?php echo $room; ?>"><?php echo _e('Select Room','hotelbookings'); ?></label></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php if($promtion_upsells): ?>
        <div class="upsells-section">
            <div class="container">
                <h2><?php _e("Select Upsell","hotelbookings"); ?></h2>
                <div class="upsell-wrap">
                    <?php foreach($promtion_upsells as $upsell): ?>
                    <div class="upsell clearfix">
                        <div class="upsell-image">
                            <?php echo wp_get_attachment_image(get_post_thumbnail_id($upsell),'large') ?>
                        </div>
                        <div class="upsell-info">
                            <h3><?php echo get_the_title($upsell); ?></h3>
                            <div class="upsell-info-meta">
                                <strong><?php _e("Prijs:","hotelbookings"); ?></strong><?php echo get_field('upsell_price',$upsell); ?>
                            </div>
                            <div class="room-info-desc"></div>
                            <div class="select-btn">
                                <input type="checkbox" name="upsells[]" value="<?php echo $upsell; ?>" id="up-<?php echo $upsell; ?>">
                                <label for="up-<?php echo $upsell; ?>"><?php echo _e('Add Upsell','hotelbookings'); ?></label>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="container">
            <input type="submit" value="Book" name="proceed_booking">
        </div>
    </div>
</form>
<?php else: ?>
<!--Promotion Details-->
<div class="hpage-banner" style="background-image:url(<?php echo $timage[0]; ?>)">
    <title><?php the_title(); ?></title>
</div>
<div class="section-promotion-detail clearfix">
    <div class="container">
        <div class="section-promotion-info">
            <h2><?php echo get_hotel_name(); ?></h2>
            <div class="package-details">
                <strong><?php _e('Dit arrangement bevat:','hotelbookings'); ?></strong>
                <div class="package-details-wrap">
                    <?php if(have_rows('promotiondetails')): ?>
                    <ul>
                        <?php while(have_rows('promotiondetails')): the_row();?>
                        <li><?php  echo get_sub_field('promotiondetail'); ?></li>
                        <?php endwhile; ?>
                    </ul>
                    <?php  endif; ?>
                </div>
            </div>
            <h3>
                <a href="#overview"><?php _e('Beschrijving','hotelbookings'); ?></a>
                <a href="#hotelinfo"><?php _e('Over','hotelbookings'); ?> <?php echo get_hotel_name(); ?></a>
            </h3>
            <div id="overview">
                <?php the_content(); ?>
            </div>
            <div class="features">
                <h3><?php _e('Belangrijke informatie','hotelbookings'); ?></h3>
                <?php echo  icon_navigation(); ?>
            </div>
        </div>
        <div class="section-promotion-avialbility">
            <h2><?php _e('Boek direct','hotelbookings'); ?></h2>
            <form action="" name="promotion_form" class="hotel_site_form" method="post">
                <div class="input-wrapper">
                    <label for=""><?php _e('Personen','hotelbookings'); ?></label>
                    <div class="change-events">
                        <input required type="text" id="hb-persons" value="2" name="persons" min="1">
                        <div class="change-persons"><i class="fa fa-plus-square" aria-hidden="true"></i><i class="fa fa-minus-square" aria-hidden="true"></i></div>
                    </div>
                </div>
                <div class="input-wrapper">
                    <label for=""><?php _e('Kamers','hotelbookings'); ?></label>
                    <div class="change-events">
                        <input required type="text" id="hb-rooms" value="1" name="rooms" min="1">
                        <div class="change-rooms"><i class="fa fa-plus-square" aria-hidden="true"></i><i class="fa fa-minus-square" aria-hidden="true"></i></div>
                    </div>
                </div>
                <div class="input-wrapper">
                    <label for=""><?php _e('Selecteer Data','hotelbookings'); ?></label>
                    <input required type="hidden" id="bookingdate" name="bookingdate" placeholder="<?php _e('Chekin datum','hotelbookings'); ?>">
                    <div id="calender" class="hotel-booking-price-cal"></div>
                </div>
                <div class="price-box">
                    <span><?php _e('Vanaf','hotelbookings'); ?></span>
                    <div id="hb_pprice">€ <span><?php echo get_promotion_price(get_the_ID()); ?></span></div>
                    <input type="hidden" name="booking_price" value="<?php echo get_promotion_price(get_the_ID()); ?>">
                    <span id="fare_message"><?php _e('per persoon','hotelbookings'); ?></span>
                </div>
                <input type="hidden" name="promotionnights" value="<?php echo get_field('pm_nights'); ?>">
                <input type="hidden" name="promotionid" id="promotion_id" value="<?php echo get_the_ID(); ?>">
                <input type="submit" name="promotionitem" value="<?php _e('Boek','hotelbookings'); ?>">
            </form>
            <div class="promotion-details">
                <h2><?php _e('Promotietiming','hotelbookings'); ?></h2>
                <div class="start_date"><strong><?php _e('Startdatum:','hotelbookings'); ?></strong><?php echo get_field('pm_sdate'); ?></div>
                <div class="end_date"><strong><?php _e('Einddatum:','hotelbookings'); ?></strong><?php echo get_field('pm_edate'); ?></div>
            </div>
        </div>
        <div id="hotelinfo" class="hotel_description">
                <h2><?php echo get_hotel_name(); ?></h2>
                <?php echo get_hotel_description(); ?>
            </div>
    </div>
</div>

<?php 
    $week_price = get_promotion_price(get_the_ID()); // Monday to Thursday
    $weekend_price = get_promotion_price_weekends(get_the_ID()); // Friday and Sunday
    $saturday_price = get_promotion_price_saturdays(get_the_ID()); // Saturday
    $disable_dates_array =  get_field('nopromotions');
    $nights = get_field('pm_nights');
    $end_date =  get_field('pm_edate');
    foreach($disable_dates_array as $disable_date){
        $disable_dates .= "'".$disable_date."',";
    }
 ?>
<script type='text/javascript'>
    /* <![CDATA[ */
    var calendarPrices = {
        0: '<?php echo $weekend_price; ?>',
        1: '<?php echo $week_price; ?>',
        2: '<?php echo $week_price; ?>',
        3: '<?php echo $week_price; ?>',
        4: '<?php echo $week_price; ?>',
        5: '<?php echo $weekend_price; ?>',
        6: '<?php echo $saturday_price; ?>'
    };
    var disabledDates = [<?php echo $disable_dates; ?>];
    var promotion_nights = [<?php echo $nights; ?>];
    var promotion_ends = [<?php echo $end_date; ?>];
    /* ]]> */

</script>
<?php endif; ?>
<?php endwhile; ?>
<?php get_footer(); ?>
