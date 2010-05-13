<?php
date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
$hourHeight = 50;
$borderWidth = 1;

function getDBH()
{

    $config = parse_ini_file('.my.cnf');
    $link = mysql_connect('localhost', $config['user'], $config['password']);
    if (!$link) { die('Could not connect: ' . mysql_error()); }
    $result = mysql_select_db('tops',$link);
    if (!$result) { die('Error selecting db: ' . mysql_errno($link) . ": " . mysql_error($link)); }
    return $link;
}
$link = getDBH();
$result = mysql_query("SELECT * FROM eventTypes", $link);
if (!$result) { die('Invalid query: ' . mysql_errno($link) . ": " . mysql_error($link)); }

while ($row = mysql_fetch_assoc($result)) {
    $eventTypes[$row['id']] = $row;
}


$result = mysql_query("select e.*,r.name as roomName from events e left join rooms r on (e.roomId=r.id)", $link);
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
