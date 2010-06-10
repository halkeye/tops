<?php

class controller_admin extends Controller_Template 
{
    public $template = 'adminTemplate';
    protected $session;
    
    function before()
    {
        $ret = parent::before();

        $this->session = Session::instance();
        if ($this->request->action == 'rpx')
            return $ret;

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
        $this->template->content = 'hello, world!';
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
            $this->request->redirect('https://tops.rpxnow.com/openid/v2/signin?token_url='.urlencode(url::site('auth/rpx', 'http')));
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
