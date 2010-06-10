<?php

class controller_schedule extends Controller_Template
{
    function action_index()
    {
		$this->template->content = View::factory('schedule/index');
    }
}
