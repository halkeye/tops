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
        $id = Arr::get($_REQUEST, 'id');
        if (!$id) die("no id provided");

        $room = ORM::factory('room')->find($id);
        if ($room->loaded())
        {
            unset($_REQUEST['id']);
            $room->values($_REQUEST);
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

        $room->name = Arr::get($_REQUEST, 'name');
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
        $id = Arr::get($_REQUEST, 'id');
        if (!$id) die("no id provided");

        $day = ORM::factory('day')->find($id);
        if ($day->loaded())
        {
            unset($_REQUEST['id']);
            $day->values($_REQUEST);
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

        $day->day = Arr::get($_REQUEST, 'name');
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

        $type->values($_REQUEST);
        $data = $this->_handleCRUDChange($type, $data);

        $this->request->response = JSON::encode($data);

        return;
    }

    function action_typeUpdate()
    {
        $data = array('success'=>0);
        $this->auto_render = FALSE;
        $id = Arr::get($_REQUEST, 'id');
        if (!$id) die("no id provided");

        $type = ORM::factory('eventType')->find($id);
        if ($type->loaded())
        {
            unset($_REQUEST['id']);
            $type->values($_REQUEST);
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
        $email = $this->session->get('account_email');

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
            $errors = array_values($item->validate()->errors('', TRUE));
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
}
