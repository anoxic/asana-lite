<?php
/**
 * A class that wraps around Asana's API
 * with minimal sugar or magic.
 */
class Asana
{ 
    /**
     * Asana::workspaces() fetches available workspaces for the authed user
     *
     * @return array
     */
    public static function workspaces()
    {
        list($code, $headers, $body) = call("GET", "workspaces");
        return $body->data;
    }

    /**
     * Asana::projects() fetches available projects for the
     * authed user within the specified workspace
     *
     * @param  $workspace string  The workspace when the project list should be fetched from
     *
     * @return array
     */
    public static function projects($workspace)
    {
        $options = [
            "workspace"=>$workspace,
            "archived"=>false,
        ];
        list($code, $headers, $body) = call("GET", "projects", $options);
        return $body->data;
    }

    /**
     * Asana::tasks() fetches incomplete tasks for a project or assignee.
     * One of either the $assignee or $project must be included.
     *
     * @param  $asignee   mixed|null  If included, which assignee to select tasks from
     * @param  $project   mixed|null  If included, which project to select tasks from
     * @param  $workspace string      The workspace to operate within
     *
     * @return array
     */
    public static function tasks($assignee, $project, $workspace)
    {
        $options = [
            "workspace"=>$workspace,
            "completed_since"=>"now"
        ];
        if ($assignee) $options['assignee'] = $assignee;
        if ($project) $options['project'] = $project;
        list($code, $headers, $body) = call("GET", "tasks", $options);
        return $body->data;
    }
}

