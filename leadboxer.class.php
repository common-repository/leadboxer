<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

//The Main class of the  LeadBoxer Plug-in
if (!class_exists('Leadboxer')) {
	class Leadboxer {

		public function __construct() {

		}

		public static function register_plugin_scripts() {

			    $dataset = get_option('leadboxer_dataset');
			    if(!$dataset) $dataset = 'test.com';

			    if ( !is_admin() ) {
			 		wp_enqueue_script( 'leadboxerscript', '//script.leadboxer.com/?dataset=' . $dataset, array(), null, true );
			    }
		}

		public function plugin_admin_add_page() {

			add_submenu_page( 'options-general.php', __( "LeadBoxer",'leadboxer'),__( "LeadBoxer",'leadboxer'), 'manage_options', 'leadboxer', array( $this, 'add_settings' ));

		}


		public function add_settings() {

                $option = 'leadboxer_dataset';
				$save = isset($_GET['save']) ?  $_GET['save'] : '';
				$name = isset($_GET['dataset']) ?  $_GET['dataset'] : get_option($option);

				if($save) update_option($option, $name);

				print '<div class="wrap">
				<h2>' . __( "LeadBoxer Settings",'leadboxer') . '</h2>

				<h4>' . __( "Plugin Configuration",'leadboxer') . '</h4>
				<p>If you have not done so yet, start by registering for a free trial at <a href="https://www.leadboxer.com?utm_source=wp-plugin">LeadBoxer</a><br>
				You will receive an email which contains your dataset ID.<br>
				To get things setup you need to copy/paste your LeadBoxer dataset ID in the field below and click Save</p>

				<form action="">

				<input type="hidden" name="page" value="leadboxer">

				<div class="fieldwrap">
				<label class="" for="dataset">' . __( "Enter your dataset ID here",'leadboxer') . '</label><br />
				<input type="text" name="dataset" size="80" value="' . $name . '" id="dataset" spellcheck="false" autocomplete="off" />
				</div>

				<br />
				<div id="action">
				<span class="spinner"></span>
				<input name="save" type="submit" class="button button-primary button-large" id="save" accesskey="p" value="' . __( "Save",'leadboxer') . '" />
				</div>
				<div class="clear"></div>

				</form>
				<p>You can verify a succesfull install by first visiting the homepage of this Wordpress site, then login at <a href="https://app.leadboxer.com?utm_source=wp-plugin">app.leadboxer.com</a><br>
				You should see your visit there as a first lead.</p>

				</div>';
		}


		public function true_load_plugin_textdomain() {
			load_plugin_textdomain( 'leadboxer-en', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}


	   public function run() {

			add_action( 'plugins_loaded', array( $this, 'true_load_plugin_textdomain'));
			add_action('admin_menu',  array( $this, 'plugin_admin_add_page' ));
			add_action( 'wp_enqueue_scripts', array( 'Leadboxer', 'register_plugin_scripts' ) );
       }
    }
}

?>