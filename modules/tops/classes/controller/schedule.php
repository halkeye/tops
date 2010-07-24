<?php

class controller_schedule extends Controller_Template
{
    function action_index()
    {
        $this->request->title = "Schedule Page";

        $hourHeight = 50;
        $borderWidth = 1;

        $db = Database::instance();
        {
            $query = DB::Query(Database::SELECT, 'SELECT * FROM eventTypes', 'Model_User');
            $result = $query->execute();
            $eventTypes = $result->as_array('id');
        }
        {

            $query = DB::Query(Database::SELECT, "SELECT e.*,r.name AS roomName,d.day as eventDate FROM events e JOIN rooms r ON (e.roomId=r.id) JOIN days d ON (e.dayId=d.id)");
            $result = $query->execute();
            do {
                $day = strtotime($result->get('eventDate'));
                $eventData = array(
                    'name' => $result->get('name'),
                    'length' => $result->get('length'),
                );
                foreach (range(1,4) as $i)
                {
                    $eventTypeName = $result->get('eventType'.$i) ? $eventTypes[$result->get('eventType'.$i)]['nameKey'] : 'closed';
                    $eventData['type'][$eventTypeName] = 1;
                }
                $eventData['type'] = array_keys($eventData['type']);

                $data[$result->get('roomName')][$day][$result->get('time')] = $eventData;
            } while ($result->next() && $result->valid());
        }

        $hourData = array();
        $days = array();
        foreach (array_keys($data) as $room)
        {
            foreach (array_keys($data[$room]) as $day)
            {
                if (!isset($hourData["$day"])) { $hourData["$day"] = array('max'=>0, 'min'=> 2500); }
                $hourData["$day"]['max'] = (int) @max($hourData[$day]['max'], max(array_keys($data[$room][$day])));
                $hourData["$day"]['min'] = (int) @min($hourData[$day]['min'], min(array_keys($data[$room][$day])));
                array_push($days, $day);
            }
            $matches = array();
            $hourData[$day]['maxHour'] = $hourData[$day]['maxMin'] = $hourData[$day]['minHour'] = $hourData[$day]['minMin'] = 0;
            preg_match('/(\d{2})(\d{2})/', $hourData[$day]['max'], $matches);
            if ($matches)
                list($junk, $hourData[$day]['maxHour'], $hourData[$day]['maxMin']) = $matches;
            preg_match('/(\d{2})(\d{2})/', $hourData[$day]['min'], $matches);
            if ($matches)
                list($junk, $hourData[$day]['minHour'], $hourData[$day]['minMin']) = $matches;
        }
        $days = array_unique($days);
        $rooms = array_keys($data);
        sort($rooms);


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
