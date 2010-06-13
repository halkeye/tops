<?php defined('SYSPATH') OR die('No direct access allowed.');

echo View::factory('admin/_CRUD', array(
            'singleName' => 'Room',
            'pluralName' => 'Rooms',
            'nameFieldLabel' => 'Name',
            'nameFieldType' => 'text',
            'modelName' => 'room',
            'items' => $rooms,
));
