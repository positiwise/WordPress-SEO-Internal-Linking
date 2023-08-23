<?php

class WordpressSeoInternalLinkingKeywords
{

    private $wp_sil_options;
    private $update_settings;

    public function __construct() {
        if( isset( $_POST['wp_sil_plugin_options'] ) ) {
            $this->update_settings = $this->saveWpSilOptions( $_POST['wp_sil_plugin_options'] );
        }

        $this->wp_sil_options = get_option( 'wp_sil_plugin_options' );
    }

    public function renderKeywordsSettings() {
        $options = $this->wp_sil_options;
        $keywords = ( isset( $options['keyword'] ) && !empty( $options['keyword'] ) ) ? $options['keyword'] : [];
        $links = ( isset( $options['link'] ) && !empty( $options['link'] ) ) ? $options['link'] : [];
        $priority = ( isset( $options['priority'] ) && !empty( $options['priority'] ) ) ? $options['priority'] : [];

        $last_key = array_key_last( $keywords );

        if( "" !== $this->update_settings ){
            $this->wpb_admin_notice_bar( $this->update_settings );
        }

        ?>
        <div class="wrap">

            <form action="" method="post">
                <div class="wp_sil_options_fields" data-key="<?php echo $last_key ?? 0; ?>">
                        <table class="wp_sil_setting_table">
                            <tr>
                                <td>Keyword</td>
                                <td>URL</td>
                                <td>Priority?</td>
                            </tr>
                            <?php if( "" === $options ){ ?>
                            <tr class="wp_sil_setting_row">
                                <td>
                                    <input class='wp_sil_keyword' name='wp_sil_plugin_options[keyword][0]' type='text' placeholder='Keyword' />
                                </td>
                                <td>
                                    <input class='wp_sil_link' name='wp_sil_plugin_options[link][0]' type='url' placeholder='Link URL' />
                                </td>
                                <td>
                                    <input class='wp_sil_priority' name='wp_sil_plugin_options[priority][0]' type='checkbox' />
                                </td>
                            </tr>
                            <?php } ?>
                            <?php foreach( $keywords as $key => $word ) { ?>
                                <tr class="wp_sil_setting_row" id="<?php echo $key; ?>">
                                    <td>
                                        <input class='wp_sil_keyword' name='wp_sil_plugin_options[keyword][<?php echo $key; ?>]' type='text' placeholder='Keyword' value='<?php echo $keywords[$key]; ?>' />
                                    </td>
                                    <td>
                                        <input class='wp_sil_link' name='wp_sil_plugin_options[link][<?php echo $key; ?>]' type='url' placeholder='Link URL' value='<?php echo $links[$key]; ?>' />
                                    </td>
                                    <td>
                                        <input class='wp_sil_priority' name='wp_sil_plugin_options[priority][<?php echo $key; ?>]' type='checkbox' <?php echo ( isset( $priority[$key] ) && "on" == $priority[$key] ) ? 'checked=checked' : ''; ?> />
                                    </td>
                                    <?php if( 0 !== $key ) { ?>
                                        <td>
                                            <a class='wp_sil_remove_row button button-secondary' data-rem-id='<?php echo $key; ?>'>- Remove</a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>

                        </table>
                    <div class="wp_sil_add_row">
                        <a class='button button-secondary'>+ Add Row</a>
                    </div>
                    <div class="wp_sil_options_save_button">
                        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save Keywords Settings' ); ?>" />
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

    public function saveWpSilOptions( $options ){

        if( ! isset( $options['keyword'] ) || 
            ! isset( $options['link'] ) ||
            ! isset( $options['priority'] )
        ) {
            return 'improper';
        }

        if( update_option( 'wp_sil_plugin_options', $options ) ) {
            return true;
        }

        return false;

    }

    public function wpb_admin_notice_bar( $action ) {
        if( true === $action ){
            echo '<div class="notice notice-success is-dismissible">
                <p>Keywords have been saved successfully!!</p>
                </div>';
        }

        if( false === $action ){
            echo '<div class="notice notice-warning is-dismissible">
                <p>Keywords are identical to existing data!</p>
                </div>';
        }

        if( 'improper' === $action ){
            echo '<div class="notice notice-error is-dismissible">
                <p>Please verify the data once, it seems the data is not properly formated!</p>
                </div>';
        }

    }

}
