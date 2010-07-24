<?php defined('SYSPATH') OR die('No direct access allowed.'); 
echo "<h1>Calendar List Feed</h1>";
echo Form::open('admin/import', array('method'=>'post'));
echo Form::select("selectedCalendar", $calendars, $selectedCal);
echo "<br/>";
echo Form::submit("submit","Select Calendar");
echo Form::close();
