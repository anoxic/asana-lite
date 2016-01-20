<?php
require "../lib/load.php";

$model = ["workspaces"=>Asana::workspaces()];
render("workspaces",$model);

