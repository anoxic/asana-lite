<?php
/**
 * minify_output() takes in a string buffer and returns minified html.
 *
 * This uses a simplified minification routine, and is really only intended for
 * simpler applications. This does not minify CSS or Javascript.
 *
 * @param $buffer string
 * @return string
 */
function minify_output($buffer)
{
    $search = array(
        '/([<>])[\t ]+/s',
        '/[\t ]+([<>])/s',
        '/ +/',
        '/[\n\r]+/',
    );
    $replace = array(
        '\\1',
        '\\1',
        ' ',
        "\n",
    );
    $buffer = preg_replace($search, $replace, $buffer);
    
    return $buffer;
}
