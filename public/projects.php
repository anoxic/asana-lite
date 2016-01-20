<?php
require "../lib/load.php";

$model = [];
$model["workspaces"] = Asana::workspaces();

if (!empty($_REQUEST['workspace'])) {
    $model["projects"] = Asana::projects($_REQUEST['workspace']);
    foreach ($model["workspaces"] as &$ws) {
        if ($ws->id == $_REQUEST['workspace'])
            $ws->selected = true;
    }
} else {
    $model['no_workspace'] = true;
}

render("projects",$model);

