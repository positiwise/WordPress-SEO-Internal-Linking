<?php

class Wordpress_Seo_Internal_Linking_Admin_Settings {

    private $wp_sil_nevigation_links;

    public function __construct(){

        $page_link = "?page=wp-seo-internal-linking-plugin";

        $this->wp_sil_nevigation_links = [
            "Settings" => $page_link,
            "Keywords" => $page_link . "&tab=keywords-links",
            "Import / Export" => $page_link . "&tab=import-export",
        ];

    }

    public function addAdminSettings(){
        add_options_page( 
            'WP SEO Internal Linking Settings',
            'WP SEO Internal Linking Settings',
            'manage_options',
            'wp-seo-internal-linking-plugin',
            array( $this, 'renderPluginSettings' ) 
        );
    }

    public function renderPluginSettings(){
        ?>
        <div class="wrap wp_sil_options_head_wrap">
            <h2><?php _e( "WordPress SEO Internal Linking Settings", "wordpress-seo-internal-linking" ); ?></h2>
            <p>Configure Plugin Settings Here</p>
            <div class="wp_sil_nevigation_links">
                <?php
                    foreach( $this->wp_sil_nevigation_links as $nevigation_link => $nevigation_url ){
                        echo "<a href='" . $nevigation_url . "'><div class='navigation_link_wrap'>" . $nevigation_link . "</div></a>";
                    }
                ?>
            </div>
        </div>
        <?php
        if ( isset( $_GET['tab'] ) && 'import-export' == $_GET['tab'] ) {

            require_once 'wordpress-seo-internal-linking-settings-import-export.php';
            $import_export_page = new Wordpress_Seo_Internal_Linking_Settings_Import_Export();
            $import_export_page->renderImportExport();

        } else if ( isset( $_GET['tab'] ) && 'keywords-links' == $_GET['tab'] ) {
            
            require_once 'wordpress-seo-internal-linking-keywords.php';
            $import_export_page = new WordpressSeoInternalLinkingKeywords();
            $import_export_page->renderKeywordsSettings();

        } else {

            require_once 'wordpress-seo-internal-linking-core-settings.php';
            $import_export_page = new WordpressSeoInternalLinkingCoreSettings();
            $import_export_page->renderCoreSettings();

        }
    }  

}
