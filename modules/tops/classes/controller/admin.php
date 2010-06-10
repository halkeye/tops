<?php

class controller_admin extends Controller_Template 
{
	public $template = 'adminTemplate';
    protected $session;
    
    function before()
    {
        $this->session = Session::instance();
        $this->requireAuth();

        #$this->requireAdmin();
		$ret = parent::before();
        $this->template->currentPage = str_replace(array('Edit', 'Create', 'Save'), '', $this->request->action);
        $this->template->title = "index";
        $this->template->account = new StdClass;
        $this->template->account->fname = "Gavin";
        $this->template->account->lname = "Mogan";
        $this->template->account->email = "halkeye@gmail.com";
        return $ret;
    }

    function action_index()
    {
		$this->template->content = 'hello, world!';
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
        #    $this->session->set('redirected_from', url::current());
        #    url::redirect('openid/tryAuth');
        #    exit();
        }
        $email = $this->session->get('account_email');
        $email = 'halkeye@gmail.com';

        $emails = Kohana::config("googleAuth.emails");
        if (isset($emails[$email]) && $emails[$email])
        {
            return TRUE;
        }

        die(url::redirect('system/accessDenied'));
        exit();
    }

}
