<?php

if (! function_exists('convertToCollection')) {
    function convertToCollection($array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = r_collect($value);
                $array[$key] = $value;
            }
        }

        return collect($array);
    }
}

if (! function_exists('ddd')) {
    function ddd(...$args)
    {
        http_response_code(500);
        call_user_func_array('dd', $args);
    }
}