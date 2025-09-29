<?php
/**
 * Plugin Name: PD Activity Log
 * Description: Monitor user (administrator) activities like editing posts, pages, products etc.
 * Version: 1.0.5
 * Author: kkarasiewicz
 * Text Domain: pd-activity-log
 */

namespace PdActivityLog;
use PdActivityLog\PluginManager;


if (!defined('WPINC')) {
    die;
}

if (!defined('PD_ACTIVITY_LOG_PLUGIN_DIR_PATH')) {
    define('PD_ACTIVITY_LOG_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
}

if (!defined('PD_ACTIVITY_LOG_PLUGIN_DIR_URL')) {
    define('PD_ACTIVITY_LOG_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));
}

if (!defined('PD_ACTIVITY_LOG_REPO_URL')) {
    define('PD_ACTIVITY_LOG_REPO_URL', 'https://github.com/Premium-Digital/pd-activity-log');
}

require PD_ACTIVITY_LOG_PLUGIN_DIR_PATH . 'vendor/autoload.php';

class PdActivityLog
{
    public function __construct()
    {
        load_plugin_textdomain('pd-activity-log', false, dirname(plugin_basename(__FILE__)) . '/languages');
        new PluginManager();
    }
}

new PdActivityLog();

register_activation_hook(__FILE__, ['PdActivityLog\PluginManager', 'activate']);
