<?php

class Wordpress_Seo_Internal_Linking_Settings_Import_Export {

    private $update_settings;

    public function __construct(){

        $this->update_settings = "";
        if( isset( $_POST[ 'wp_sil_import' ] ) ){
            $this->update_settings = $this->importSilData( $_POST[ 'wp_sil_import' ] );
        }

    }

    public function renderImportExport(){
        ?>
        <div class="wp_sil_options_fields">
            <div class="wp_sil_import_fields">
                <h3>Import Settings</h3>
                <?php
                    if( "" !== $this->update_settings ){
                        $this->wpb_admin_notice_bar( $this->update_settings );
                    }
                ?>
                <form name="import_settings" action="" method="post" id="wp_sil_import_settings_form">
                    <div class="wp_sil_import_settings_group">
                        <table>
                            <tr>
                                <td>
                                    <label for="wp_sil_input_data">Import Data:</label>
                                </td>
                                <td>
                                    <textarea name="wp_sil_import[data]" id="wp_sil_input_data" placeholder="Put your serialized data here..." rows="10" cols="100"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Append Data?:</label>
                                </td>
                                <td>
                                    <input type="checkbox" name="wp_sil_import[append]" checked="checked" />
                                    <span class="wp_sil_info_help" title="If checked, data will be appended to your existing keywords list + replaces old links as well.">?</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="wp_sil_import_save_button">
                        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Import Linking Data' ); ?>" />
                    </div>
                </form>
            </div>
            <hr/>
            <div class="wp_sil_import_fields">
                <h3>Export Settings</h3>
                    <div class="wp_sil_import_settings_group">
                        <table>
                            <tr>
                                <td>
                                    <button class="button button-secondary copy-export-data">Copy Export Data</button>
                                    <input type="hidden" id="wp_sil_plugin_options" value="<?php echo str_replace('"', "'", maybe_serialize( get_option( 'wp_sil_plugin_options' ) ) ); ?>" />
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } 

    public function importSilData( $data ){

        $data['data'] = unserialize( stripslashes( $data['data'] ) );

        if( ! isset( $data['data']['keyword'] ) || 
            ! isset( $data['data']['link'] ) ||
            ! isset( $data['data']['priority'] )
        ) {
            return 'improper';
        }

        if( isset( $data['append'] ) && "on" == $data['append'] ){
            
            $data['data'] = $this->merge_sil_array( get_option( 'wp_sil_plugin_options' ), $data['data'] );

        }


        if( update_option( 'wp_sil_plugin_options', $data['data'] ) ) {
            return true;
        }

        return false;

    }

    public function merge_sil_array( $x, $y ){
        $result = [];
        foreach( $x as $key => $val ) {
            $result[$key] = $y[ $key ] + $x[ $key ];
        }
        return $result;
    }

    public function wpb_admin_notice_bar( $action ) {
        if( true === $action ){
            echo '<div class="notice notice-success is-dismissible">
                <p>Data has been imported successfully!!</p>
                </div>';
        }

        if( false === $action ){
            echo '<div class="notice notice-warning is-dismissible">
                <p>Import data is identical to existing data!</p>
                </div>';
        }

        if( 'improper' === $action ){
            echo '<div class="notice notice-error is-dismissible">
                <p>Please verify the data once, it seems the data is not properly formated!</p>
                </div>';
        }

    }

}
