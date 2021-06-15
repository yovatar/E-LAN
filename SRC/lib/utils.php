<?php

/**
 * checks recursively if a needle is in an array
 * @source https://stackoverflow.com/questions/4128323/in-array-and-multidimensional-array
 * @param mixed $needle what's searched
 * @param array $haystack where it's searched
 * @return bool
 */
function in_array_r(mixed $needle, array $haystack, bool $strict = false)
{
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}

/**
 * get $_FILES reformatted
 * @return array [0=>[["tmp_name"=>"a"],["tmp_name"=>"b"],["tmp_name"=>"c"]]],1=>[["tmp_name"=>"x"],["tmp_name"=>"y"],["tmp_name"=>"z"]]]
 */
function getFormattedUpload()
{
    $tmp = [];
    foreach ($_FILES as $name => $files) {
        $tmp[$name] = reformatFiles($files);
    }
    return $tmp;
}

/**
 * turns a file array inside out
 * @param array $files ["tmp_name"=>["a","b","c"]] ($_FILES default format)
 * @return array files [["tmp_name"=>"a"],["tmp_name"=>"b"],["tmp_name"=>"c"]]
 */
function reformatFiles(array $files)
{
    // Declare an empty array
    $tmp = [];
    // Turn files inside out
    foreach ($files as $propertyName => $values) {
        for ($i = 0; $i < count($values); $i++) {
            $tmp[$i][$propertyName] = $values[$i];
        }
    }
    return $tmp;
}

/**
 * Set a flash message
 * @param string|int $key
 * @param null|bool|int|float|string|array $value
 * @param bool $append will try to append value to the key
 * @return void
 */
function flashMessage($key, $value, $append = false)
{
    if ($append) {
        if (empty($_SESSION["flash"][$key])) $_SESSION["flash"][$key] = [];
        $_SESSION["flash"][$key] += $value;
    } else {
        $_SESSION["flash"][$key] = $value;
    }
}

/**
 * Stores a toast as a flash message
 * @param string $message
 * @param string $type currently supports 'info', 'error', 'success', 'warning'
 * @return void
 */
function toast($message, $type = 'info')
{
    switch ($type) {
        case 'warning':
            $type = 'warnings';
            break;
        case 'error':
            $type = 'errors';
            break;
        case 'success':
            $type = 'successes';
            break;
        case 'info':
            $type = 'infos';
            break;
        default:
            $type = 'infos';
    }
    if (empty($_SESSION["flash"]["toasts"][$type])) $_SESSION["flash"]["toasts"][$type] = [];
    array_push($_SESSION["flash"]["toasts"][$type],$message);
}
