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

echo "<h1>Calendar List Feed</h1>";
echo Form::open('admin/import', array('method'=>'post'));
{
    #function  roomSort($a, $b)
    #{
    #    return strcmp($a->name, $b->name);
    #}

    #uasort($rooms, 'roomSort');
    $rooms = array();
    $rooms['default'] = 'User Provided Rooms';
    #foreach ($exisingRooms as $room)
    #{
    #    $rooms[$room->id] = (string)$room;
    #}


    echo "<div>Room:</div>";
    echo "<div>" . 
        Form::select("selectedCalendar", array())
        . "</div>"
}

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
