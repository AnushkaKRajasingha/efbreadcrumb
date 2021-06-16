<?php
/**
 * @link       https://www.upwork.com/fl/anushkakrajasingha
 * @since      1.0.0
 *
 * @package    Efbreadcrumb
 * @subpackage Efbreadcrumb/includes
 */

/**
 * @since      1.0.0
 * @package    Efbreadcrumb
 * @subpackage Efbreadcrumb/includes
 * @author     Anushka Rajasingha <anudevscs@gmail.com>
 */
class Efbreadcrumb {

	/**
	 * @since    1.0.0
	 * @access   protected
	 * @var      Efbreadcrumb_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'EFBREADCRUMB_VERSION' ) ) {
			$this->version = EFBREADCRUMB_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'efbreadcrumb';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->set_shortcode();


	}

	/**
	 * Dependencies loader of the plugin
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-efbreadcrumb-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-efbreadcrumb-i18n.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-efbreadcrumb-menubuilder.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-efbreadcrumb-shortcode.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-efbreadcrumb-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-efbreadcrumb-public.php';

		$this->loader = new Efbreadcrumb_Loader();

	}

	/**
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Efbreadcrumb_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	private function set_shortcode(){
	    $shortcode = new Efbreadcrumb_Shortcode( $this->get_plugin_name(), $this->get_version() );
    }

	/**
	 * admin area's  functionality Hooks
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Efbreadcrumb_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'efbreadcrumbAdminMenu' );
        $this->loader->add_action( 'admin_init', $plugin_admin, 'efbreadcrumbAdminInit' );



	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Efbreadcrumb_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$plugin_breadcrumbmenu = new Efbreadcrumb_MenuBuilder( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_filter(EFBREADCRUMB_VARPREFIX.'_buildmenu', $plugin_breadcrumbmenu,'my_breadcrumb');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Efbreadcrumb_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
