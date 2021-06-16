<?php
class Efbreadcrumb_Shortcode
{
    private $plugin_name;
    private $version;

    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_shortcode('EFBreadcrumb' , array($this,'breadcrumb_menu_func'));

    }

    public function breadcrumb_menu_func($atts ){
        $a = shortcode_atts( array(
            'foo' => 'something',
            'bar' => 'something else',
        ), $atts );

        return apply_filters(EFBREADCRUMB_VARPREFIX.'_buildmenu',EFBREADCRUMB_VARPREFIX.'menubuilf_func',$a);

    }
}