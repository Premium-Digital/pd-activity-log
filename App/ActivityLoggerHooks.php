<?php

namespace PdActivityLog;

use PdActivityLog\Helpers;

class ActivityLoggerHooks {

    private $logger;

    public function __construct() {
        $this->logger = Logger::getInstance();
        $this->init();
    }

    public function init() {
        add_action('save_post', [$this, 'handleSavePost'], 10, 3);
        add_action('before_delete_post', [$this, 'handleDeletePost']);
        add_action('trashed_post', [$this, 'handleTrashedPost']);
    }

    private function shouldLog(object $post): bool {
        if (!$this->logger->isLoggingEnabled()) {
            return false;
        }

        if (in_array($post->post_type, ['revision', "nav_menu_item"], true)) {
            return false;
        }

        if (in_array($post->post_status, ['auto-draft'], true)) {
            return false;
        }

        if (!Helpers::getCurrentUser()) return false;

        return in_array('administrator', (array) Helpers::getCurrentUser()->roles);
    }

    public function handleSavePost($postId, $post, $update) {
        $post = get_post($postId);
        if (!$post) return;
        if (!$this->shouldLog($post)) return;
        if ($post->post_status === 'trash') return;

        $action = $update ? 'update' : 'create';
    
        $this->logger->addLog(
            $postId,
            $post->post_type,
            $action,
            Helpers::getCurrentUser()->ID,
            Helpers::getCurrentUser()->data->user_login,
            ["User " . Helpers::getCurrentUser()->data->user_login . " performed {$action} on post ID {$postId}."],
        );
    }


    public function handleDeletePost($postId) {
        $post = get_post($postId);
        if (!$post) return;
        if (!$this->shouldLog($post)) return;

        $this->logger->addLog(
            $postId,
            $post->post_type,
            'delete',
            Helpers::getCurrentUser()->ID,
            Helpers::getCurrentUser()->data->user_login,
            ["User " . Helpers::getCurrentUser()->data->user_login . " performed delete on {$post->post_type} {$post->post_title}."],
        );
    }

    public function handleTrashedPost($postId) {
        $post = get_post($postId);
        if (!$post) return;
        if (!$this->shouldLog($post)) return;

        $this->logger->addLog(
            $postId,
            $post->post_type,
            'trash',
            Helpers::getCurrentUser()->ID,
            Helpers::getCurrentUser()->data->user_login,
            ["User " . Helpers::getCurrentUser()->data->user_login . " performed trash on post ID {$postId}."],
        );
    }

}
