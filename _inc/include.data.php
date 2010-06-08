<?php
include_once(dirname(__FILE__) . '/common.php');
$hourHeight = 50;
$borderWidth = 1;

$link = DBH::getInstance()->getHandle();
$result = mysql_query("SELECT * FROM eventTypes", $link);
if (!$result) { die('Invalid query: ' . mysql_errno($link) . ": " . mysql_error($link)); }

while ($row = mysql_fetch_assoc($result)) {
    $eventTypes[$row['id']] = $row;
}


$result = mysql_query("SELECT e.*,r.name AS roomName,d.day as eventDate FROM events e JOIN rooms r ON (e.roomId=r.id) JOIN days d ON (e.dayId=d.id)", $link);
if (!$result) { die('Invalid query: ' . mysql_errno($link) . ": " . mysql_error($link)); }

while ($row = mysql_fetch_assoc($result)) {
    $day = strtotime($row['eventDate']);
    $eventData = array(
        'name' => $row['name'],
        'length' => $row['length'],
    );
    foreach (range(1,4) as $i)
    {
        $eventTypeName = $row['eventType'.$i] ? $eventTypes[$row['eventType'.$i]]['nameKey'] : 'closed';
        $eventData['type'][$eventTypeName] = 1;
    }
    $eventData['type'] = array_keys($eventData['type']);

    $data[$row['roomName']][$day][$row['time']] = $eventData;
}

$hourData = array();
$days = array();
foreach (array_keys($data) as $room)
{
    foreach (array_keys($data[$room]) as $day)
    {
        if (!isset($hourData["$day"])) { $hourData["$day"] = array('max'=>0, 'min'=> 2500); }
        $hourData["$day"]['max'] = (int) @max($hourData[$day]['max'], max(array_keys($data[$room][$day])));
        $hourData["$day"]['min'] = (int) @min($hourData[$day]['min'], min(array_keys($data[$room][$day])));
        array_push($days, $day);
    }
    $matches = array();
    preg_match('/(\d{2})(\d{2})/', $hourData[$day]['max'], $matches);
    list($junk, $hourData[$day]['maxHour'], $hourData[$day]['maxMin']) = $matches;
    preg_match('/(\d{2})(\d{2})/', $hourData[$day]['min'], $matches);
    list($junk, $hourData[$day]['minHour'], $hourData[$day]['minMin']) = $matches;
}
$days = array_unique($days);
$rooms = array_keys($data);
sort($rooms);


mysql_close($link);
