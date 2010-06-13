<?php defined('SYSPATH') OR die('No direct access allowed.');


echo View::factory('admin/_CRUD', array(
            'singleName' => 'Day',
            'pluralName' => 'Days',
            'nameFieldLabel' => 'Date',
            'nameFieldType' => 'date',
            'modelName' => 'day',
            'items' => $days,
));
