<?php defined('SYSPATH') OR die('No direct access allowed.');

echo View::factory('admin/_CRUD', array(
            'singleName' => 'Day',
            'pluralName' => 'Days',
            'modelName' => 'day',
            'items' => $days,
            'fields' => array(
                'day'       => array('name'=>'Date',            'type'=>'date'),
            ),
));

