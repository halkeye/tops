<?php defined('SYSPATH') OR die('No direct access allowed.');

class controller_admin extends Controller_Template 
{
    public $template = 'adminTemplate';
    protected $session;
    
    function before()
    {
        $ret = parent::before();

        $this->session = Session::instance();

        $this->requireAuth();

        $this->template->currentPage = str_replace(array('Edit', 'Create', 'Save'), '', $this->request->action);
        $this->template->title = "index";
        $this->template->account = new StdClass;
        $this->template->account->displayName = $this->session->get('account_displayName');
        $this->template->account->email = $this->session->get('account_email');
        return $ret;
    }

    function after()
    {
        if (class_exists('DebugToolbar'))
        {
            echo DebugToolbar::render();
        }
        return parent::after();
    }

    function action_index()
    {
        $this->template->content = View::factory('admin/index');
    }

    /*
 ____                           
|  _ \ ___   ___  _ __ ___  ___ 
| |_) / _ \ / _ \| '_ ` _ \/ __|
|  _ < (_) | (_) | | | | | \__ \
|_| \_\___/ \___/|_| |_| |_|___/
    */
    function action_rooms()
    {
        $rooms = ORM::factory('room')->find_all();

        $this->template->content = View::factory('admin/roomList', array(
                'rooms' => $rooms,
        ));
    }

    function action_roomUpdate()
    {
        $data = array('success'=>0);
        $this->auto_render = FALSE;
        $id = Arr::get($_POST, 'id');
        if (!$id) die("no id provided");

        $room = ORM::factory('room')->find($id);
        if ($room->loaded())
        {
            unset($_POST['id']);
            $room->values($_POST);
            $data = $this->_handleCRUDChange($room, $data);
        }
        else
        {
            $data['message'] = "Unable to find room";
        }

        $this->request->response = JSON::encode($data);

        return;
    }
    
    function action_roomCreate()
    {
        $data = array('success'=>0);
        $this->auto_render = FALSE;
        $room = ORM::factory('room');

        unset($_POST['id']);
        $room->values($_POST);
        $data = $this->_handleCRUDChange($room, $data);

        $this->request->response = JSON::encode($data);

        return;
    }

    /*
 ____                  
|  _ \  __ _ _   _ ___ 
| | | |/ _` | | | / __|
| |_| | (_| | |_| \__ \
|____/ \__,_|\__, |___/
             |___/     
    */
    function action_days()
    {
        $days = ORM::factory('day')->find_all();

        $this->template->content = View::factory('admin/daysList', array(
                'days' => $days,
        ));
    }

    function action_dayUpdate()
    {
        $data = array('success'=>0);
        $this->auto_render = FALSE;
        $id = Arr::get($_POST, 'id');
        if (!$id) die("no id provided");

        $day = ORM::factory('day')->find($id);
        if ($day->loaded())
        {
            unset($_POST['id']);
            $day->values($_POST);
            $data = $this->_handleCRUDChange($day, $data);
        }
        else
        {
            $data['message'] = "Unable to find day";
        }



        $this->request->response = JSON::encode($data);

        return;
    }
    
    function action_dayCreate()
    {
        $data = array('success'=>0);
        $this->auto_render = FALSE;
        $day = ORM::factory('day');

        unset($_POST['id']);
        $day->values($_POST);
        $data = $this->_handleCRUDChange($day, $data);

        $this->request->response = JSON::encode($data);

        return;
    }

    /*
 _____                 _     _____                      
| ____|_   _____ _ __ | |_  |_   _|   _ _ __   ___  ___ 
|  _| \ \ / / _ \ '_ \| __|   | || | | | '_ \ / _ \/ __|
| |___ \ V /  __/ | | | |_    | || |_| | |_) |  __/\__ \
|_____| \_/ \___|_| |_|\__|   |_| \__, | .__/ \___||___/
                                  |___/|_|              
    */

    function action_types()
    {
        $types = ORM::factory('eventType')->find_all();

        $this->template->content = View::factory('admin/typeList', array(
                'types' => $types,
        ));
    }

    function action_typeCreate()
    {
        $data = array('success'=>0);
        $this->auto_render = FALSE;
        $type = ORM::factory('eventType');

        unset($_POST['id']);
        $type->values($_POST);
        $data = $this->_handleCRUDChange($type, $data);

        $this->request->response = JSON::encode($data);

        return;
    }

    function action_typeUpdate()
    {
        $data = array('success'=>0);
        $this->auto_render = FALSE;
        $id = Arr::get($_POST, 'id');
        if (!$id) die("no id provided");

        $type = ORM::factory('eventType')->find($id);
        if ($type->loaded())
        {
            unset($_POST['id']);
            $type->values($_POST);
            $data = $this->_handleCRUDChange($type, $data);
        }
        else
        {
            $data['message'] = "Unable to find eventType";
        }

        $this->request->response = JSON::encode($data);
        return;
    }
    /*
 _____                 _       
| ____|_   _____ _ __ | |_ ___ 
|  _| \ \ / / _ \ '_ \| __/ __|
| |___ \ V /  __/ | | | |_\__ \
|_____| \_/ \___|_| |_|\__|___/
    */
    function action_events()
    {
        $events = ORM::factory('event')
            ->with('eventType1')
            ->find_all();

        $rooms = ORM::factory('room')->find_all();
        $days = ORM::factory('day')->find_all();
        $types = ORM::factory('eventType')->find_all();

        $this->template->content = View::factory('admin/eventList', array(
                'events' => $events,
                'rooms' => $rooms,
                'days' => $days,
                'types' => $types,
        ));
    }
    
    function action_eventCreate()
    {
        $data = array('success'=>0);
        $this->auto_render = FALSE;
        $event = ORM::factory('event');

        unset($_POST['id']);
        $event->values($_POST);
        $data = $this->_handleCRUDChange($event, $data);

        $this->request->response = JSON::encode($data);

        return;
    }

    function action_eventUpdate()
    {
        $data = array('success'=>0);
        $this->auto_render = FALSE;
        $id = Arr::get($_POST, 'id');
        if (!$id) die("no id provided");

        $event = ORM::factory('event')->find($id);
        if ($event->loaded())
        {
            unset($_POST['id']);
            $event->values($_POST);
            $data = $this->_handleCRUDChange($event, $data);
            if ($data['success'])
            {
                $data['roomId.name'] = (string)$event->room;
                $data['dayId.name'] = (string)$event->day;
                $data['eventType1.name'] = (string)$event->eventType1Obj;
            }
        }
        else
        {
            $data['message'] = "Unable to find event";
        }

        $this->request->response = JSON::encode($data);
        return;
    }
                               
    /*
 _   _ _   _ _ _ _   _           
| | | | |_(_) (_) |_(_) ___  ___ 
| | | | __| | | | __| |/ _ \/ __|
| |_| | |_| | | | |_| |  __/\__ \
 \___/ \__|_|_|_|\__|_|\___||___/
     */

    function requireAuth()
    {
        if (!$this->session->get('account_id'))
        {
            $this->session->set('redirected_from', $this->request->uri);
            $this->request->redirect('auth/login');
            return false;
        }
        $email = strtolower($this->session->get('account_email'));

        $emails = Kohana::config("googleAuth.emails");
        if (isset($emails[$email]) && $emails[$email])
        {
            return TRUE;
        }

        $this->request->redirect('system/accessDenied');
        return false;
    }

    private function _handleCRUDChange($item, $data)
    {
        if (!$item->check())
        {
            $errors = array_values($item->validate()->errors('models', TRUE));
            $data['message'] = "Unable to save item";
            if ($errors)
                $data['message'] .= ": - " . implode(', - ', $errors);
        }
        else
        {
            $item->save();
            if ($item->saved())
            {
                $data = $item->as_array();
                unset($data[0]);
                $data['asString'] = (string) $item;
                $data['success'] = 1;
            }
            else
                $data['message'] = "Unknowing saving error";

        }
        return $data;
    }

    public function action_import()
    {
        $this->template->content = "Muahhaa";
        $my_calendar = 'http://www.google.com/calendar/feeds/default/private/full';
        if (!isset($_SESSION['cal_token'])) 
        {
            if (isset($_GET['token'])) 
            {
                // You can convert the single-use token to a session token.
                $session_token = Zend_Gdata_AuthSub::getAuthSubSessionToken($_GET['token']);
                // Store the session token in our session.
                $_SESSION['cal_token'] = $session_token;
            } else {
                // Display link to generate single-use token
                $url = url::site('admin/import', TRUE);
                $googleUri = Zend_Gdata_AuthSub::getAuthSubTokenUri($url,$my_calendar, 0, 1);
                $this->template->content =  "Click <a href='$googleUri'>here</a> to authorize this application.";
                return;
            }
        }

        // Create an authenticated HTTP Client to talk to Google.
        $client = Zend_Gdata_AuthSub::getHttpClient($_SESSION['cal_token']);
        // Create a Gdata object using the authenticated Http Client
        $this->cal = new Zend_Gdata_Calendar($client);

        $this->template->content = "";

        if (isset($_POST['selectedCalendar']))
            $_SESSION['selectedCal'] = $_POST['selectedCalendar'];

        $this->_fetchCalendarCache();
        $this->importSelectCal();


        if ($_SESSION['selectedCal'])
        {
            $this->_fetchEventsCache($_SESSION['selectedCal']);
            $this->template->content .= View::factory('admin/import_calEvents', array(
                        'events'=>$_SESSION['eventsCache'][$_SESSION['selectedCal']],
                        'existingRooms' => ORM::factory('room')->find_all()->as_array(),
            ));
        }
    }

    public function action_import_doImport()
    {
        if (isset($_POST['deleteExisting']) && $_POST['deleteExisting'])
        {
            ORM::Factory('event')->delete_all();
        }
        $events = array();
        foreach ($_POST['events'] as $rawEvent)
        {
            $data = json_decode($rawEvent, TRUE);
            $event = ORM::Factory('event');

            if ($_POST['room'] == 'default')
            {
                if (!isset($roomNameCache[$data['where']]))
                {
                    $room = ORM::factory('room', array('name' => $data['where']));
                    if ($room->loaded())
                        $roomNameCache[$data['where']] = $room->id;
                    else
                    {
                        $room = ORM::factory('room');
                        $room->save();
                        $roomNameCache[$data['where']] = $room->id;
                    }
                }
                $event->roomId = $roomNameCache[$data['where']];
            }
            else
                $event->roomId = $_POST['room'];

            $event->name = $data['title'];
            $event->startTime = date('c', $data['startTime']);
            $event->endTime   = date('c', $data['endTime']);
            $resultData = array();
            $this->_handleCRUDChange($event, $resultData);
            $events[] = $resultData;
            
        }
        $this->template->content = "Import Successful:<br/><pre>".var_export($events,1)."</pre>";
    }

    public function importSelectCal()
    {
        $data = array(
                'calendars' => $_SESSION['calendars'],
                'selectedCal' => $_SESSION['selectedCal'],
        );
        $this->template->content .= View::factory('admin/selectCalendar', $data);
    }

    public function _fetchCalendarCache()
    {
        if (!isset($_SESSION['calendars']))
        {
            try {
                $listFeed = $this->cal->getCalendarListFeed();
            } catch (Zend_Gdata_App_Exception $e) {
                $this->template->content =  "Error: " . $e->getMessage();
                return true;
            }

            $_SESSION['calendars'] = array();
            foreach ($listFeed as $calendar)
            {
                $user = str_replace('http://www.google.com/calendar/feeds/default/', '', $calendar->id);
                $user = str_replace('/','', $user);
                $_SESSION['calendars'][$user] = (string) $calendar->title;
            }
        }

        if (!isset($_SESSION['selectedCal']) || !$_SESSION['selectedCal'] || !$_SESSION['calendars'][$_SESSION['selectedCal']])
            $_SESSION['selectedCal'] = '';
    }

    public function _fetchEventsCache($calendar)
    {
        if (
                !isset($_SESSION['eventsCache']) || 
                !isset($_SESSION['eventsCache'][$calendar])
          )
        {
            $query = $this->cal->newEventQuery();
            $query->setUser($calendar);
            $query->setVisibility('private');
            $query->setProjection('full');
            $query->setOrderby('starttime');
            $query->setFutureevents('true');

            // Retrieve the event list from the calendar server
            try {
                $eventFeed = $this->cal->getCalendarEventFeed($query);
            } catch (Zend_Gdata_App_Exception $e) {
                $this->template->content =  "Error: " . $e->getMessage();
                return true;
            }

            $events = array();
            // Iterate through the list of events, outputting them as an HTML list
            foreach ($eventFeed as $event) {
                array_push($events, (object) array(
                            'title' => (string) $event->title,
                            'where' => (string) $event->Where[0],
                            'startTime' => strtotime($event->when[0]->startTime),
                            'endTime' => strtotime($event->when[0]->endTime),
                ));
            }
            $_SESSION['eventsCache'][$calendar] = $events;
        }
    }
}
