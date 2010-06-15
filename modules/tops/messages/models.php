<?php defined('SYSPATH') or die('No direct script access.');

return array(
	'name_unique'    => ':field must a unique name',
	'time' => array( 
        'conflict_time'  => 'time provided must not conflict with other items on the same day/room/time combo',
    ),
);
