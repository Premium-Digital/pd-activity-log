<?php

namespace PdActivityLog;

class Helpers
{
    public static function getCurrentUser() {
        $userId = get_current_user_id();
        return $userId ? get_userdata($userId) : null;
    }
    
}