<?php
namespace App;

class Utils
{
    
    public static function getOptions($options, $key, $default = null) {
        return !empty($options) && isset($options[$key]) ? $options[$key] : $default;
    }
}
