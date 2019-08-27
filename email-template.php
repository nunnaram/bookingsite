    <?php if(isset($_POST['email_temp_sub'])){
        update_option( 'hotelbookings_theme_emailoptions', $_POST['hotelbookings_options'] );
        //print_r($_POST['hotelbookings_options']) ;
        $page_url = menu_page_url('email_template', 0);
        //header('location:'. $page_url . '&status=settings-updated');
        //exit;
    } ?>
    <div class="email-template">
        <?php if ( ! isset( $_REQUEST['settings-updated'] ) ) $_REQUEST['settings-updated'] = false;?>
        <div class="wrap">
            <h2><?php _e('Email Settings', 'hotelbookings'); ?></h2>
            <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
            <div class="updated fade">
                <p><strong><?php _e('Options saved', 'hotelbookings'); ?></strong></p>
            </div>
            <?php endif; ?>
            <form method="post" action="">
                <?php $options = get_option( 'hotelbookings_theme_emailoptions' ); ?>
                <div class="theme-options-tabs current" id="general-tab">
                    <table class="form-table" style="max-width: 800px;">
                        <tr valign="top">
                            <th scope="row"><?php _e('Email Subject', 'hotelbookings'); ?></th>
                            <td>
                                <input id="hotelbookings_email_subject" class="regular-text" type="text" name="hotelbookings_options[subject]" value="<?php echo esc_attr_e( $options['subject'] ); ?>" />
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e('Email Template', 'hotelbookings'); ?></th>
                            <td><label class="description" for="hotelbookings_options[template]"></label>
                                <?php $settings = array('media_buttons'=>true,'textarea_rows'=>'15', 'textarea_name' => 'hotelbookings_options[template]'); 
                                    $eid =  'hotelbookings_options_template';
                                  wp_editor( $options['template'], $eid, $settings );
                            ?>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"></th>
                            <td>
                                <p class="submit">
                                    <input name="email_temp_sub" type="submit" class="button-primary" value="<?php _e('Save', 'hotelbookings'); ?>" />
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
