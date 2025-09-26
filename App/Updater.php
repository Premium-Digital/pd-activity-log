<?php

namespace PdActivityLog;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

class Updater
{
    public static function init()
    {
        if (!defined('PD_ACTIVITY_LOG_REPO_URL')) {
            error_log('[PD Extra Widgets] Constant PD_ACTIVITY_LOG_REPO_URL is not defined.');
            return;
        }

        if (!class_exists(PucFactory::class)) {
            error_log('[PD Extra Widgets] Plugin Update Checker is not available.');
            return;
        }

        $pluginFile = PD_ACTIVITY_LOG_PLUGIN_DIR_PATH . '/pd-activity-log.php';

        $updateChecker = PucFactory::buildUpdateChecker(
            PD_ACTIVITY_LOG_REPO_URL,
            $pluginFile,
            'pd-activity-log'
        );

        $updateChecker->getVcsApi()->enableReleaseAssets();
    }
}