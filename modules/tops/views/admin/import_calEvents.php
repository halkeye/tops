<?php defined('SYSPATH') OR die('No direct access allowed.'); 
echo "<h1>Calendar List Feed</h1>";
echo Form::open('admin/import', array('method'=>'post'));
foreach ($events as $event)
{
    echo "<div>";
    echo Form::checkbox("events[]", json_encode($event), FALSE);
    echo " ";
    echo htmlentities($event->title);
    echo "</div>";
}
echo "<br/>";
echo Form::submit("submit","Select Calendar");
echo Form::close();
