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
        $rooms = ORM::factory('room')
            ->find_all();

        $this->template->content = View::factory('admin/roomList', array(
                'rooms' => $rooms,
        ));
    }

    function action_roomUpdate()
    {
        $data = array('success'=>0);
        $this->auto_render = FALSE;
        $id = Arr::get($_POST, 'id');
        $name = Arr::get($_POST, 'name');

        $room = ORM::factory('room')->find($id);
        if ($room->loaded())
        {
            $room->name = $name;
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

        $room->name = Arr::get($_POST, 'name');
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
        $name = Arr::get($_POST, 'name');

        $day = ORM::factory('day')->find($id);
        if ($day->loaded())
        {
            $day->day = $name;
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

        $day->day = Arr::get($_POST, 'name');
        $data = $this->_handleCRUDChange($day, $data);

        $this->request->response = JSON::encode($data);

        return;
    }



    function action_types()
    {
        $this->template->content = 'hello, world!';
    }

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

    private function _handleCRUDChange($room, $data)
    {
        if (!$room->check())
        {
            $errors = array_values($room->validate()->errors('', TRUE));
            $data['message'] = "Unable to save room";
            if ($errors)
                $data['message'] .= ": - " . implode(', - ', $errors);
        }
        else
        {
            $room->save();
            if ($room->saved())
            {
                $data['name'] = $room->value();
                $data['id'] = $room->pk();
                $data['success'] = 1;
            }
            else
                $data['message'] = "Unknowing saving error";

        }
        return $data;
    }
}
