    <?php if(isset($_POST['settings_temp_sub'])){
        update_option( 'hotelbookings_theme_options', $_POST['hotelbookings_options'] );
        //print_r($_POST['hotelbookings_options']) ;
        $page_url = menu_page_url('email_template', 0);
        //header('location:'. $page_url . '&status=settings-updated');
        //exit;
    } ?>
    <div class="settings-template">
        <?php if ( ! isset( $_REQUEST['settings-updated'] ) ) $_REQUEST['settings-updated'] = false;?>
        <div class="wrap">
            <h2><?php _e('Settings', 'hotelbookings'); ?></h2>
            <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
            <div class="updated fade">
                <p><strong><?php _e('Options saved', 'hotelbookings'); ?></strong></p>
            </div>
            <?php endif; ?>
            <form method="post" action="">
                <?php $options = get_option( 'hotelbookings_theme_options' ); ?>
                <div class="theme-options-tabs current" id="general-tab-1">
                    <table class="form-table" style="max-width: 800px;">
                        <tr valign="top">
                            <th scope="row"><?php _e('Admin Email', 'hotelbookings'); ?></th>
                            <td>
                                <input id="hotelbookings_adminemail" class="regular-text" type="text" name="hotelbookings_options[adminemail]" value="<?php echo esc_attr_e( $options['adminemail'] ); ?>" />
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Hotel Information', 'hotelbookings'); ?></th>
                            <td>
                            <label for=""><strong>Title</strong></label>
                            <input id="hotelbookings_hotelinfotitle" class="regular-text" type="text" name="hotelbookings_options[hotelinfotitle]" value="<?php echo esc_attr_e( $options['hotelinfotitle'] ); ?>" />
                            <label for=""><strong>Description</strong></label>
                            <?php $settings = array('media_buttons'=>true,'textarea_rows'=>'15', 'textarea_name'=>'hotelbookings_options[hotelinfodesc]','wpautop'=>true);
                                  wp_editor( $options['hotelinfodesc'], 'hotelbookings_options_hotelinfodesc', $settings );
                            ?>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"></th>
                            <td>
                                <p class="submit">
                                    <input name="settings_temp_sub" type="submit" class="button-primary" value="<?php _e('Save', 'hotelbookings'); ?>" />
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>