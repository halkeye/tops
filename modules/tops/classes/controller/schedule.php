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

            $query = DB::Query(Database::SELECT, "SELECT e.*, (UNIX_TIMESTAMP(e.endTime)-UNIX_TIMESTAMP(e.startTime))/60/30 as length,r.name AS roomName,date(e.startTime) as eventDate FROM events e JOIN rooms r ON (e.roomId=r.id)");
            $result = $query->execute();
            do {
                $day = strtotime($result->get('eventDate'));
                $eventData = array(
                    'name' => $result->get('name'),
                    'length' => (int)$result->get('length'),
                    'startTime' => strtotime($result->get('startTime')),
                    'endTime' => strtotime($result->get('endTime')),
                );
                foreach (range(1,4) as $i)
                {
                    $eventTypeName = $result->get('eventType'.$i) ? $eventTypes[$result->get('eventType'.$i)]['nameKey'] : 'closed';
                    $eventData['type'][$eventTypeName] = 1;
                }
                $eventData['type'] = array_keys($eventData['type']);

                $data[$result->get('roomName')][$day][strtotime($result->get('startTime'))] = $eventData;
            } while ($result->next() && $result->valid());
        }

        {
            $query = DB::Query(Database::SELECT, "SELECT UNIX_TIMESTAMP(date(startTime)) as day,        max(hour(endTime)) as maxHour,        max(minute(endTime)) as maxMin,        min(hour(startTime)) as minHour,        min(minute(startTime)) as minMin        from events group by date(startTime)");
            $result = $query->execute();
            $hourData = $result->as_array('day');
        }
        $days = array_keys($hourData);
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
        if (class_exists('DebugToolbar'))
        {
            echo DebugToolbar::render();
        }

    }
}
