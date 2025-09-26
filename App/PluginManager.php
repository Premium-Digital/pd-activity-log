<?php
namespace PdActivityLog;

use PdActivityLog\Helpers;
use PdActivityLog\Updater;
use PdActivityLog\ActivityLoggerHooks;

class PluginManager
{
    
    public function __construct()
    {
        new Actions();
        new Settings();
        new Helpers();
        new ActivityLoggerHooks();
        Updater::init();
    }

    public static function activate()
    {
        \flush_rewrite_rules();
    }

}