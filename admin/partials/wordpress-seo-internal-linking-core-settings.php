<?php

class WordpressSeoInternalLinkingCoreSettings
{
    private $wp_sil_core_options;
    private $update_settings;

    public function __construct() {
        if( isset( $_POST['wp_sil_core_settings'] ) ) {
            $this->update_settings = $this->saveWpSilOptions( $_POST['wp_sil_core_settings'] );
        }

        $this->wp_sil_core_options = get_option( 'wp_sil_plugin_core_options' );

    }

    public function renderCoreSettings() {

        $trubleshoot    = ( isset( $this->wp_sil_core_options['trubleshoot'] ) ) ? $this->wp_sil_core_options['trubleshoot'] : "";
        $target         = ( isset( $this->wp_sil_core_options['target'] ) ) ? $this->wp_sil_core_options['target'] : "";
        $count          = ( isset( $this->wp_sil_core_options['count'] ) ) ? $this->wp_sil_core_options['count'] : "2";

        if( "" !== $this->update_settings ){
            $this->wpb_admin_notice_bar( $this->update_settings );
        }

        ?>
        <div class="wrap">

            <form action="" method="post">
                <div class="wp_sil_options_fields" data-key="<?php echo $last_key ?? 0; ?>">
                        <table class="wp_sil_setting_table wp_sil_core_settings">
                        
                            <tr class="wp_sil_setting_row">
                                <th>
                                    <div>Enable Trubleshooting?</div>
                                </th>
                                <td>
                                    <input type="checkbox" name="wp_sil_core_settings[trubleshoot]" <?php echo ( "on" == $trubleshoot ) ? 'checked="checked"' : "" ; ?> />
                                    <span class="wp_sil_info_help" title="This will temporarily remove all linkings until unchecked and saved.">?</span>
                                </td>
                            </tr>

                            <tr class="wp_sil_setting_row">
                                <th>
                                    <div>Target</div>
                                </th>
                                <td>
                                    <select name="wp_sil_core_settings[target]">
                                        <option value="" <?php echo ( "" == $target ) ? 'selected="selected"' : ''; ?>>Same Window</option>
                                        <option value="_blank" <?php echo ( "_blank" == $target ) ? 'selected="selected"' : ''; ?>>New Window</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="wp_sil_setting_row">
                                <th>
                                    <div>Number of Target Keywords</div>
                                </th>
                                <td>
                                    <input type="number" name="wp_sil_core_settings[count]" placeholder="Number of Target Keywords" value="<?php echo $count; ?>" name="wp_sil_core_settings" />
                                    <span class="wp_sil_info_help" title="Maximum how many keywords do you want to target in each paragraph?">?</span>
                                </td>
                            </tr>

                        </table>
                    <div class="wp_sil_options_save_button">
                        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save Core Settings' ); ?>" />
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

    public function saveWpSilOptions( $coreOptions ) {

        if( get_option( 'wp_sil_plugin_core_options' ) === $coreOptions ) {
            return true;
        }

        if( update_option( 'wp_sil_plugin_core_options', $coreOptions ) ) {
            return true;
        }

        return false;

    }

    public function wpb_admin_notice_bar( $action ) {
        if( true === $action ){
            echo '<div class="notice notice-success is-dismissible">
                <p>Settings has been saved successfully!!</p>
                </div>';
        }

        if( false === $action ){
            echo '<div class="notice notice-error is-dismissible">
                <p>Some Error Occured! Please try again!</p>
                </div>';
        }

    }

}
