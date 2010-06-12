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
		$this->auto_render = FALSE;
        $id = Arr::get($_POST, 'id');
        $name = Arr::get($_POST, 'name');
        $rooms = ORM::factory('room')->find_all();

        $this->request->response = JSON::encode(array('id'=>$id, 'name'=>$name, 'success'=>1));

        return;
        die();
        $this->request->getParam();

        $this->template->content = View::factory('admin/roomList', array(
                'rooms' => $rooms,
        ));
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
