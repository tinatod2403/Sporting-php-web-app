<?php

if (!function_exists('active_class')) {
    /**
     * @param $keys
     * @return string
     */
    function active_class($keys): string
    {
        $keys = (array)$keys;
        $active = false;

        foreach ($keys as $key) {
            if (strpos(url()->current(), $key) !== false) {
                $active = true;
            }
        }
        return $active ? 'active' : '';
    }
}

if (!function_exists('is_active_route')) {
    /**
     * @param $keys
     * @return string
     */
    function is_active_route($keys): string
    {
        $keys = (array)$keys;
        $active = false;

        foreach ($keys as $key) {
            if (strpos(url()->current(), $key) !== false) {
                $active = true;
            }
        }
        return $active ? 'true' : 'false';
    }
}

if (!function_exists('show_class')) {
    /**
     * @param $keys
     * @return string
     */
    function show_class($keys): string
    {
        $keys = (array)$keys;
        $active = false;

        foreach ($keys as $key) {
            if (strpos(url()->current(), $key) !== false) {
                $active = true;
            }
        }
        return $active ? 'show' : '';
    }
}
