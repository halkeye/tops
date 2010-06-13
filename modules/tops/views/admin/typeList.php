<?php defined('SYSPATH') OR die('No direct access allowed.');

echo View::factory('admin/_CRUD', array(
            'singleName' => 'Event Type',
            'pluralName' => 'Event Types',
            'nameFieldLabel' => 'Name',
            'nameFieldType' => 'text',
            'modelName' => 'type',
            'items' => $types,
));

