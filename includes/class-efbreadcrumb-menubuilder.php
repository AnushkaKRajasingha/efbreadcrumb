<?php


class Efbreadcrumb_MenuBuilder
{

    private $plugin_name;
    private $version;

    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function my_breadcrumb() {

        $selected_cat = get_option(EFBREADCRUMB_VARPREFIX.'selected_cat');
        $categories = get_the_category();
        foreach ($categories as $cat){ if(in_array($cat->term_id, $selected_cat)) return ; }
        $root_elm = get_option(EFBREADCRUMB_VARPREFIX.'root_elm');
        $root_elm_text = get_option(EFBREADCRUMB_VARPREFIX.'root_elm_text');

        switch ($root_elm){
            case "0" :
                $root_elm_text ='Home';
                break;
            case "1" :
                $root_elm_text ='';
                break;
            case "2" :
                $root_elm_text = $root_elm_text;
                break;
            default :
                $root_elm_text = "H";
        }

        $separator = get_option(EFBREADCRUMB_VARPREFIX.'separator'); if(!empty($separator)) $separator = '<span class="sep">'. $separator .'</span>';
        $thumbnail = get_option(EFBREADCRUMB_VARPREFIX.'thumbnail');

        ob_start();

        echo "<div class='".EFBREADCRUMB_VARPREFIX."menu"."'>";
        if(!empty($thumbnail)){
            global $_wp_additional_image_sizes;
            echo '<img src="'.$thumbnail.'" alt="Efbreadcrumb" width="'. get_option( 'thumbnail_size_w' ).'"  height="'. get_option( 'thumbnail_size_h' ).'" />';
        }
        echo '<a href="'.home_url().'" rel="nofollow">'.$root_elm_text.'</a>';
        if(!empty($root_elm_text)) echo ' '.$separator.' ';
        if (is_category() || is_single()) {
            the_category($separator);
            if (is_single()) {
                echo ' '.$separator.' ';
                the_title();
            }
        } elseif (is_page()) {
            echo ' '.$separator.' ';
            echo the_title();
        } elseif (is_search()) {
            echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
            echo '"<em>';
            echo the_search_query();
            echo '</em>"';
        }
        echo "</div>";
        $output = ob_get_clean();
        return $output;
    }





}