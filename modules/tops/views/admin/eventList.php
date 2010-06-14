<?php defined('SYSPATH') OR die('No direct access allowed.');

$roomOptions = array();
foreach ($rooms as $room)
    $roomOptions[$room->pk()] = (string)$room;

$dayOptions = array();
foreach ($days as $day)
    $dayOptions[$day->pk()] = (string)$day;

$typeOptions = array(0=>'--closed--');
foreach ($types as $type)
    $typeOptions[$type->pk()] = (string)$type;

echo View::factory('admin/_CRUD', array(
            'singleName' => 'Event',
            'pluralName' => 'Events',
            'modelName' => 'event',
            'items' => $events,
            'fields' => array(
                'roomId'     => array('name'=>'Room',   'type'=>'select', 'options'=>$roomOptions),
                'dayId'      => array('name'=>'Day',    'type'=>'select', 'options'=>$dayOptions),
                'time'       => array('name'=>'Time',   'type'=>'text'),
                'name'       => array('name'=>'Name',   'type'=>'text'),
                'length'     => array('name'=>'Length', 'type'=>'text'),
                'eventType1' => array('name'=>'Type',   'type'=>'select', 'options'=>$typeOptions),
            ),
));

