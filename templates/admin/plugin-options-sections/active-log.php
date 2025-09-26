<?php
    $activeLog = get_option('pd_activity_log_enabled', false);
?>

<tr class="plugin-settings__row">
    <th scope="row" class="plugin-settings__label">
        <label for="pd_activity_log_enabled" class="plugin-settings__label-text">
            <?php echo __('Enable Activity Logging', 'pd-activity-log'); ?>
        </label>
    </th>
    <td class="plugin-settings__input">
        <input 
            type="checkbox" 
            name="pd_activity_log_enabled" 
            id="pd_activity_log_enabled" 
            value="1" 
            <?php checked($activeLog, true); ?>
        >
    </td>
</tr>