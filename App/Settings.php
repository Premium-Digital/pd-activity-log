<?php

namespace PdActivityLog;

class Settings
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'addAdminMenu']);
        add_action('admin_init', [$this, 'registerSettings']);
    }

    public function addAdminMenu() {
        add_menu_page(
            'PD Activity Log Settings',
            'PD Activity Log',
            'manage_options',
            'pd_activity_log_settings',
            [$this, 'renderSettingsPage'],
            'dashicons-list-view',
            150
        );

        add_submenu_page(
            'pd_activity_log_settings',
            'Logs',
            'Logs',
            'manage_options',
            'pd_activity_log_logs',
            [$this, 'renderLogsPage']
        );
    }

    public function renderSettingsPage() {
        ob_start();
        include(PD_ACTIVITY_LOG_PLUGIN_DIR_PATH . 'templates/admin/options-page-template.php');
        echo ob_get_clean();
    }

    public function renderLogsPage() {
        require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';

        $table = new ActivityLogsTable();
        $table->prepare_items();

        echo '<div class="wrap"><h1>' . esc_html__("Activity Logs", "pd-activity-log") . '</h1>';
        echo '<form method="post">';
        $table->search_box('Search Logs', 'log_search');
        $table->display();
        echo '</form>';
        echo '</div>';
    }

    public function registerSettings() {
        // przykładowe ustawienia, jeśli w przyszłości będziesz chciał np. włączyć/wyłączyć monitorowanie
        register_setting('pd_activity_log_options_group', 'pd_activity_log_enabled', [
            'type' => 'boolean',
            'default' => true,
            'sanitize_callback' => 'boolval'
        ]);
    }

    public static function saveOption(string $key, $value) {
        update_site_option('pd_activity_log_' . $key, $value);
    }
}
