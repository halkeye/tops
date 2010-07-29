<?php defined('SYSPATH') OR die('No direct access allowed.'); 
function eventsSortFull($a, $b)
{
    return
        strcmp($a->title, $b->title) + 
        strcmp($a->startTime, $b->startTime) +
        strcmp($a->where, $b->where);
}
function eventsSortNoRoom($a, $b)
{
    return
        strcmp($a->title, $b->title) + 
        strcmp($a->startTime, $b->startTime);
}
usort($events, "eventsSortNoRoom");

echo "<h2>Events</h2>";
echo Form::open('admin/import_doImport', array('method'=>'post'));
{
    function  roomSort($a, $b)
    {
        return strcmp($a->name, $b->name);
    }

    uasort($existingRooms, 'roomSort');
    $rooms = array();
    $rooms['default'] = 'Calendar Provided Rooms';
    foreach ($existingRooms as $room)
    {
        $rooms[$room->id] = (string)$room;
    }


    echo "<h3>Room:</h3>";
    echo "<div>" . 
        Form::select("room", $rooms)
        . "</div>";
}

echo '<h3>Events:</h3>';
foreach ($events as $event)
{
    echo "<div>";
    echo Form::checkbox("events[]", json_encode($event), TRUE);
    echo " ";
    echo htmlentities(sprintf("%s @ %s (%s)", $event->title, date('Y-m-d H:i:s', $event->startTime), $event->where));
    echo "</div>";
}
echo "<br/>";
echo Form::hidden("doImport", 1);
echo Form::submit("submit","Import Selected");
echo Form::close();
