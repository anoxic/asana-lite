<?php
/**
 * call() makes a simple call to Asana's api
 * 
 * @param $method string  HTTP request method
 * @param $path   string  The path requested, after the API endpoint
 * @param $data   array   An array of data to be included in the request
 *
 * @return array  [$code,$headers,$body]
 */
function call($method, $path, $data)
{
    $endpoint = "https://app.asana.com/api/1.0";
    $token = conf("token");
    $data = count($data) ? "?" . http_build_query($data) : "";
    list($code, $headers, $body) = http(
        $method,
        "$endpoint/$path$data",
        null,
        "Authorization: Bearer $token"
    );
    return [$code,$headers,json_decode($body)];
}
