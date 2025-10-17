<div class="plugin-settings">
    <h1 class="plugin-settings__title"><?php echo esc_html(get_admin_page_title()); ?></h1>

    <form method="post" action="options.php" class="plugin-settings__form">
        <?php
        settings_fields('pd_activity_log_options_group');
        ?>

        <table class="plugin-settings__table">
            <?php
                include(PD_ACTIVITY_LOG_PLUGIN_DIR_PATH . "templates/admin/plugin-options-sections/active-log.php");
            ?>
        </table>

        <?php submit_button(__('Save Settings', 'pd-activity-log'), 'primary', 'submit', true, ['class' => 'plugin-settings__submit']); ?>
    </form>
</div>