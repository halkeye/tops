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
            $data = $this->_handleRoomChange($room, $data);
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
        $data = $this->_handleRoomChange($room, $data);

        $this->request->response = JSON::encode($data);

        return;
    }

    private function _handleRoomChange($room, $data)
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
                $data['name'] = $room->name;
                $data['id'] = $room->pk();
                $data['success'] = 1;
            }
            else
                $data['message'] = "Unknowing saving error";

        }
        return $data;
    }

    function action_days()
    {
        $this->template->content = 'hello, world!';
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
}
