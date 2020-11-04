<?php

namespace AcfEngine\Core;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class AdminMenu
{
    public function __construct()
    {
        $this->init();
        add_action( 'acf/init', function () {
            acf_add_options_sub_page( array(
                'page_title'  => __( 'ACF Engine Settings' ),
                'menu_title'  => __( 'Settings' ),
                'parent_slug' => ACF_ENGINE_TEXT_DOMAIN,
            ) );
        } );
    }
    
    public function init()
    {
        add_action( 'admin_menu', [ $this, 'menu' ] );
        /* highlight ACF Engine main menu */
        add_filter(
            'parent_file',
            [ $this, 'setParentMenu' ],
            10,
            2
        );
    }
    
    public function setParentMenu( $parent_file )
    {
        global  $submenu_file, $current_screen ;
        $cpts = [
            'acfg_post_type',
            'acfg_taxonomy',
            'acfg_options_page',
            'acfg_block_type',
            'acfg_template',
            'acfg_component',
            'acfg_render_code'
        ];
        if ( in_array( $current_screen->post_type, $cpts ) ) {
            $parent_file = 'acf-engine';
        }
        return $parent_file;
    }
    
    public function menu()
    {
        \add_menu_page(
            'ACF Engine',
            'ACF Engine',
            'edit_posts',
            ACF_ENGINE_TEXT_DOMAIN,
            [ $this, 'pageDashboard' ],
            'dashicons-airplane',
            81.98765432099999
        );
        \add_submenu_page(
            ACF_ENGINE_TEXT_DOMAIN,
            'ACF Engine',
            'Dashboard',
            'edit_posts',
            ACF_ENGINE_TEXT_DOMAIN
        );
        \add_submenu_page(
            ACF_ENGINE_TEXT_DOMAIN,
            'Post Types',
            'Post Types',
            'edit_posts',
            'edit.php?post_type=acfg_post_type'
        );
        \add_submenu_page(
            ACF_ENGINE_TEXT_DOMAIN,
            'Taxonomies',
            'Taxonomies',
            'edit_posts',
            'edit.php?post_type=acfg_taxonomy'
        );
        \add_submenu_page(
            ACF_ENGINE_TEXT_DOMAIN,
            'Options Pages',
            'Options Pages',
            'edit_posts',
            'edit.php?post_type=acfg_options_page'
        );
        \add_submenu_page(
            ACF_ENGINE_TEXT_DOMAIN,
            'Block Types',
            'Block Types',
            'edit_posts',
            'edit.php?post_type=acfg_block_type'
        );
        \add_submenu_page(
            ACF_ENGINE_TEXT_DOMAIN,
            'Templates',
            'Templates',
            'edit_posts',
            'edit.php?post_type=acfg_template'
        );
        $plugin = new \AcfEngine\Plugin();
    }
    
    public function pageDashboard()
    {
        $d = new Dashboard();
        $d->render();
    }

}