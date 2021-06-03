<?php

namespace App;


class Session {

    protected static $session_started = false;

    protected static function start_session() {
        if ( ! static::$session_started) {
            session_start();
            static::$session_started = true;
        }
    }

    public static function set($key, $value) {
        static::start_session();
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        static::start_session();

        $value = null;

        if (!empty($_SESSION[$key])) {
            $value = $_SESSION[$key];
        }

        return $value;
    }

    public static function forget($key) {
        static::start_session();

        if (!empty($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function authorize($user_id) {
        static::set('authorized', true);
        static::set('user_id', $user_id);
    }

    public static function is_authorized() {
        return null !== static::get('authorized');
    }

}
