<?php
/**
 * conf() fetches a config setting
 *
 * Each config setting is store in plaintext, inside a file 
 * config/<setting>, withing the area specified by PREFIX.
 *
 * @param $setting string The setting name
 * @return string
 */
function conf($setting)
{
    return trim(file_get_contents(PREFIX."/config/$setting"));
}
