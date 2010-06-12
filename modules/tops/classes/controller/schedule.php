<?php

class controller_schedule extends Controller_Template
{
    function action_index()
    {
        $this->request->title = "Schedule Page";
        require_once(dirname(__FILE__).'/../../../../_inc/include.data.php'); 
        $this->template->content = View::factory('schedule/index',array(
                    'eventTypes' => $eventTypes,
                    'borderWidth' => $borderWidth,
                    'days' => $days,
                    'rooms' => $rooms,
                    'hourData' => $hourData,
                    'hourHeight' => $hourHeight,
                    'data' => $data,
        ));

    }
}
