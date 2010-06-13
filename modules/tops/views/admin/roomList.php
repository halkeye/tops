<?php defined('SYSPATH') OR die('No direct access allowed.');

echo View::factory('admin/_CRUD', array(
            'singleName' => 'Room',
            'pluralName' => 'Rooms',
            'modelName' => 'room',
            'items' => $rooms,
            'fields' => array(
                'name'       => array('name'=>'Name',            'type'=>'text'),
            ),
));

