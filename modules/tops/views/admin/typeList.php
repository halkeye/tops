<?php defined('SYSPATH') OR die('No direct access allowed.');

echo View::factory('admin/_CRUD', array(
            'singleName' => 'Event Type',
            'pluralName' => 'Event Types',
            'modelName' => 'type',
            'items' => $types,
            'fields' => array(
                'name'      => array('name'=>'Name',            'type'=>'text'),
                'nameKey'   => array('name'=>'CSS Key',         'type'=>'text'),
                'textColor' => array('name'=>'Text Color',      'type'=>'text'),
                'bgColor'   => array('name'=>'Highlight Color', 'type'=>'text'),
            ),
));

