<?php
/**
 * render() takes a view name, and a model and renders a mustache template
 *
 * @param $view  string  The view name, which will be used to fetch the actual view
 * @param $model array   An array containing all of the fields that will be passed to mustache for render
 *
 * @return string
 */
function render($view,$model)
{
    $m = new Mustache_Engine([
        'loader' => new Mustache_Loader_FilesystemLoader(PREFIX.'/views'),
    ]);
    $tpl = $m->loadTemplate($view);
    header("Content-Type: text/html; charset=utf-8");
    echo minify_output($tpl->render($model));
}
