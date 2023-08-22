<?php

class Wordpress_Seo_Internal_Linking_Settings_Import_Export {

    public function __construct(){
        if( isset( $_POST[ 'wp_sil_import' ] ) ){
            $this->importSilData( $_POST[ 'wp_sil_import' ] );
        }
    }

    public function renderImportExport(){
        ?>
        <div class="wp_sil_options_fields">
            <div class="wp_sil_import_fields">
                <p>Import Settings</p>
                <form name="import_settings" action="" method="post">
                    <div class="wp_sil_import_settings_group">
                        <table>
                            <tr>
                                <td>
                                    <label>Import Data:</label>
                                </td>
                                <td>
                                    <textarea name="wp_sil_import[data]" rows="10" cols="50"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Append Data?:</label>
                                </td>
                                <td>
                                    <input type="checkbox" name="wp_sil_import[append]" />
                                    <span class="wp_sil_info_help" title="If checked, data will be appended to your existing keywords list + replaces new links as well.">?</span>
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
                <p>Export Settings</p>
                    <div class="wp_sil_import_settings_group">
                        <table>
                            <tr>
                                <td>
                                    <label>Export Data:</label>
                                </td>
                                <td>
                                    <textarea rows="10" cols="50"><?php echo maybe_serialize( get_option( 'wp_sil_plugin_options' ) ); ?></textarea>
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

        if( isset( $data['append'] ) && "on" == $data['append'] ){
            
            $data['data'] = $this->merge_sil_array( get_option( 'wp_sil_plugin_options' ), unserialize( stripslashes( $data['data'] ) ) );

            $data['data'] = serialize( $data['data'] );

        }

        update_option( 'wp_sil_plugin_options', unserialize( stripslashes( $data['data'] ) ) );
        
    }

    function merge_sil_array( $x, $y ){
        $result = [];
        foreach( $x as $key => $val ) {
            $result[$key] = $y[ $key ] + $x[ $key ];
        }
        return $result;
    }

}
