<?php

namespace PdActivityLog;

class Actions
{
    public function __construct()
    {
        add_action( 'wp_enqueue_scripts', [$this, 'registerStylesAndScripts']);
        add_action( 'admin_enqueue_scripts', [ $this, 'registerAdminStylesAndScripts' ]);
    }

    public function registerStylesAndScripts()
    {
        //styles
        wp_enqueue_style( 'pd-activity-log-styles', PD_ACTIVITY_LOG_PLUGIN_DIR_URL . 'dist/front.css' );

        //scripts
        wp_enqueue_script( 'pd-activity-log-scripts', PD_ACTIVITY_LOG_PLUGIN_DIR_URL . 'dist/front.js', array(), null, true );
    }

    public function registerAdminStylesAndScripts()
    {
        //styles
        wp_enqueue_style( 'pd-activity-log-admin-styles', PD_ACTIVITY_LOG_PLUGIN_DIR_URL . 'dist/admin.css' );

        //scripts
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'pd-activity-log-admin-scripts', PD_ACTIVITY_LOG_PLUGIN_DIR_URL . 'dist/admin.js', array('jquery'), null, true );
    }

    public function loadTranslations()
    {
        load_plugin_textdomain( 'pd-activity-log', false, PD_ACTIVITY_LOG_PLUGIN_DIR_URL . '/languages' );
    }

}