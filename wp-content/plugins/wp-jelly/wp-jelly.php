<?php
/*
Plugin Name: WP Jelly
Plugin URI: https://wpjelly.com/
Description: Import theme, plugin and content in one go.
Version: 1.1.3
Author: WP Jelly
*/

if( !function_exists('is_plugin_active') ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

define( 'WP_JELLY_VERSION', '1.1.3' );
define( 'WP_JELLY_BASE', plugin_basename( __FILE__ ) );
define( 'WP_JELLY_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_JELLY_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_JELLY_AST', plugin_dir_url( __FILE__ ).'assets/' );
define( 'WP_JELLY_IMG', plugin_dir_url( __FILE__ ).'assets/images' );
define( 'WP_JELLY_CSS', plugin_dir_url( __FILE__ ).'assets/css' );
define( 'WP_JELLY_JS', plugin_dir_url( __FILE__ ).'assets/js' );
define( 'WP_JELLY_INC', plugin_dir_path( __FILE__ ).'core/includes' );
define( 'WSE_EX_EDIT_CSS', plugin_dir_url( __FILE__ ).'assets/editor/css/' );
define( 'WSE_EX_EDIT_JS', plugin_dir_url( __FILE__ ).'assets/editor/js/' );
define( 'WSE_EX_EDIT_IMG', plugin_dir_url( __FILE__ ).'assets/editor/image/' );

define( 'WP_JELLY_MAX_ENTRIES_PER_REQUEST', 5 );
define( 'WP_JELLY_MIN_MEMORY_LIMIT', 128 * 1024 * 1024 );

require 'core/lib/support.php';
require 'core/admin/reset-site.php';
require 'core/admin/xml-parser.php';
require 'core/admin/import-state-check.php';
require 'core/admin/import-ajax-calls.php';
require 'core/admin/import-theme-setup.php';
require 'core/admin/import-plugin-setup.php';
require 'core/admin/import-xml-setup.php';
require 'core/admin-checklist/checklist-setup.php';
require 'core/admin/admin-settings.php';
require 'core/template-importer/template-importer-setup.php';
require 'core/template-importer/editor/class-editor-template-importer-editor.php';
require 'core/template-importer/editor/class-template-support.php';

new wpjellyXMLSetupImporter();

register_activation_hook( __FILE__, 'wpjellyChecklistPluginInitCheckListData' );

function run_bsm_export() {
	$plugin = new bsm_export();
	$plugin->run();
}

run_bsm_export();

add_action( 'admin_init', function() {
	if ( did_action( 'elementor/loaded' ) ) {
		remove_action( 'admin_init', [ \Elementor\Plugin::$instance->admin, 'maybe_redirect_to_getting_started' ] );
	}
	delete_transient( 'wpforms_activation_redirect' );
}, 1 );

add_filter( 'woocommerce_prevent_automatic_wizard_redirect', 'wpjelly_filter_woocommerce_prevent_automatic_wizard_redirect', 10, 1 );
function wpjelly_filter_woocommerce_prevent_automatic_wizard_redirect( $false ) {
    return true;
};

add_action( 'init', 'wpjellyInit', 1 );
function wpjellyInit() {
    header( "Access-Control-Allow-Origin: *" );
    header( "Access-Control-Expose-Headers: Content-Length, X-JSON" );
    header( "Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS" );
    header( "Access-Control-Allow-Headers: *" );
}

add_action( 'admin_init', 'wpjellyCheckConfiguration', 1 );
function wpjellyCheckConfiguration() {
	$current_limit = ini_get( 'memory_limit' );
    if ( !empty( $current_limit ) ) {
        $current_limit_int = wp_convert_hr_to_bytes( $current_limit );

        if ( $current_limit_int > 0 ) {
            if ( $current_limit_int < WP_JELLY_MIN_MEMORY_LIMIT ) {
                add_action( 'admin_notices', 'wpjellyShowMemoryLimitNotice' );
            }
        }
    }
}

function wpjellyShowMemoryLimitNotice() {
?>
    <div class='notice notice-error'>
        <p><?php echo sprintf( __( 'Current <strong>PHP memory limit</strong> is %s and needs to be increased. The site may not be imported. You may contact your hosting provider for more information.' ), ini_get( 'memory_limit' ) ); ?></p>
    </div>
<?php
}

require 'vendor/plugin-update-checker/plugin-update-checker.php';
    $myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://plugin-update-control-other-hosting.s3-us-west-1.amazonaws.com/wpjelly_importer_update.json',
   __FILE__
);
