<?php
/**
 * http() is a simple wrapper around fopen and the stream_* functions
 *
 * @param $method  string (required) Can be OPTIONS, GET, HEAD, POST, PUT, DELETE or TRACE
 * @param $uri     string (required) The request URI, using either http or https for the protocol
 * @param $content array  (optional) The request body
 * @param $header  array  (optional) Any headers to send with the request
 * @param $other_options
 *                 array  (optional) Any extra HTTP Context options
 *
 * @return array [$status_code, $headers, $body];
 */
function http($method, $uri, $content = null, $header = null, $other_options = null)
{
    $options = ['http'=>compact('method','content','header')];
    if (is_array($other_options)) $options += $other_options;
    $stream = fopen($uri, 'r', false, stream_context_create($options));
    $headers = stream_get_meta_data($stream)['wrapper_data'];
    $body = stream_get_contents($stream);
    $status_code = count($headers) ? substr($headers[0], 9, 3) : false;
    fclose($stream);
    return [$status_code, $headers, $body];
}
