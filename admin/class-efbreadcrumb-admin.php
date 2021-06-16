<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.upwork.com/fl/anushkakrajasingha
 * @since      1.0.0
 *
 * @package    Efbreadcrumb
 * @subpackage Efbreadcrumb/admin
 */

/**
 * The admin-specific functionality of the plugin.
 * @package    Efbreadcrumb
 * @subpackage Efbreadcrumb/admin
 * @author     Anushka Rajasingha <anudevscs@gmail.com>
 */
class Efbreadcrumb_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Efbreadcrumb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Efbreadcrumb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/efbreadcrumb-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Efbreadcrumb_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Efbreadcrumb_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        wp_enqueue_media();
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/efbreadcrumb-admin.js', array( 'jquery' ), $this->version, false );

	}

    public function efbreadcrumbAdminMenu() {
            add_menu_page(  $this->plugin_name, EFBREADCRUMB_NAMETITLE, 'administrator', $this->plugin_name,  array( $this, 'efbreadcrumbAdminSettings' ), 'dashicons-chart-area', 26 );
    }

    public function efbreadcrumbAdminSettings(){
	    require_once('partials/efbreadcrumb-admin-display.php');
    }



    public function efbreadcrumbAdminInit(){

        add_settings_section(
            EFBREADCRUMB_VARPREFIX.'_section',
            '',
            array($this,'selected_cat_callback'),
            'efbreadcrumb_og'
        );

        // Add the field with the names and function to use for our new
        // settings, put it in our new section
        add_settings_field(
            EFBREADCRUMB_VARPREFIX.'selected_cat',
            'Remove Breadcrumb menu from selected categories.',
            array($this,'selected_cat_callback_function'),
            'efbreadcrumb_og',
            EFBREADCRUMB_VARPREFIX.'_section'
        );

        add_settings_field(
            EFBREADCRUMB_VARPREFIX.'root_elm',
            'Select the root element option.',
            array($this,'root_elm_callback_function'),
            'efbreadcrumb_og',
            EFBREADCRUMB_VARPREFIX.'_section'
        );

        add_settings_field(
            EFBREADCRUMB_VARPREFIX.'separator',
            'Custom separator for menu item.',
            array($this,'separator_callback_function'),
            'efbreadcrumb_og',
            EFBREADCRUMB_VARPREFIX.'_section'
        );

        add_settings_field(
            EFBREADCRUMB_VARPREFIX.'thumbnail',
            'Thumbnail for Breadcrumb menu.',
            array($this,'thumbnail_callback_function'),
            'efbreadcrumb_og',
            EFBREADCRUMB_VARPREFIX.'_section'
        );

        register_setting( 'efbreadcrumb_og', EFBREADCRUMB_VARPREFIX.'selected_cat' );
        register_setting( 'efbreadcrumb_og', EFBREADCRUMB_VARPREFIX.'root_elm' );
        register_setting( 'efbreadcrumb_og', EFBREADCRUMB_VARPREFIX.'root_elm_text' );
        register_setting( 'efbreadcrumb_og', EFBREADCRUMB_VARPREFIX.'separator' );
        register_setting( 'efbreadcrumb_og', EFBREADCRUMB_VARPREFIX.'thumbnail' );


    }

    public function selected_cat_callback(){

    }

    public function selected_cat_callback_function() {

        $catlist = get_categories();

        $selected_cat = get_option(EFBREADCRUMB_VARPREFIX.'selected_cat'); //var_dump( $selected_cat );
          If(!$selected_cat){
              $selected_cat=array();
          }
        ?>
        <select id="<?php echo EFBREADCRUMB_VARPREFIX.'selected_cat'; ?>" name="<?php echo EFBREADCRUMB_VARPREFIX.'selected_cat' ;?>[]" multiple="multiple">
<?php
            if ($catlist) {

                foreach ($catlist as $cat)
                { //var_dump($cat);
                    ?>
                    <option value="<?php echo $cat->term_id; ?>" <?php echo ( in_array( $cat->term_id, $selected_cat ) ? 'selected' : '' ); ?> >
                        <?php echo $cat->name; ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select>
<?php

    }

    public function root_elm_callback_function(){
	    $selected = get_option(EFBREADCRUMB_VARPREFIX.'root_elm');
	    ?>
        <select id="<?php echo EFBREADCRUMB_VARPREFIX.'root_elm'; ?>" name="<?php echo EFBREADCRUMB_VARPREFIX.'root_elm' ;?>" >
            <option <?php echo ($selected == '0' ? 'selected' : ''); ?> value="0">Home (Default)</option>
            <option <?php echo ($selected == '1' ? 'selected' : ''); ?> value="1">No Text</option>
            <option <?php echo ($selected == '2' ? 'selected' : ''); ?> value="2">Custom Text</option>
        </select>
        <br/>
        <div id="ctrl_root_elm_text" ><input style=" <?php echo ($selected == '2' ? '' : 'display: none;'); ?>" id="<?php echo EFBREADCRUMB_VARPREFIX.'root_elm_text';?>" name="<?php echo EFBREADCRUMB_VARPREFIX.'root_elm_text';?>"  type="text" value="<?php echo get_option(EFBREADCRUMB_VARPREFIX.'root_elm_text') ?>"/></div>
<?php
    }

    public function separator_callback_function(){
        echo '<input required placeholder=">>" type="text" name="'.EFBREADCRUMB_VARPREFIX.'separator'.'" value="'.get_option(EFBREADCRUMB_VARPREFIX.'separator').'" />';
    }

    public function thumbnail_callback_function(){
	    ?>

	    <input id="uld_image" type="url" size="36" name="<?php echo EFBREADCRUMB_VARPREFIX.'thumbnail';?>" value="<?php echo get_option(EFBREADCRUMB_VARPREFIX.'thumbnail');?>" />
        <input id="btn_upload" class="button" type="button" value="Upload Thumbnail" />
<?php
    }


}
