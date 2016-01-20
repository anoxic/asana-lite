<?php
require "../lib/load.php";

$model = [];
$model["workspaces"] = Asana::workspaces();

if (!empty($_REQUEST['workspace'])) {
    foreach ($model["workspaces"] as &$ws) {
        if ($ws->id == $_REQUEST['workspace']) $ws->selected = true;
    }
} else {
    $model['no_workspace'] = true;
    goto render;
}

$model["projects"] = Asana::projects($_REQUEST['workspace']);

if (!empty($_REQUEST['project'])) {
    foreach ($model["projects"] as &$p) {
        if ($p->id == $_REQUEST['project']) $p->selected = true;
    }
} else {
    $model['no_project'] = true;
    goto render;
}

if ($_REQUEST['project'] == 'me') {
    $model["tasks"] = Asana::tasks("me",null,$_REQUEST['workspace']);
    $model["me"] = true;
} else {
    $model["tasks"] = Asana::tasks(null,$_REQUEST['project'],$_REQUEST['workspace']);
}

foreach ($model["tasks"] as &$t) {
    if (substr($t->name, -1) == ":")
        $t->title = true;
}

render:
render("tasks",$model);


