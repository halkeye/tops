<?php

class controller_admin extends Controller_Template 
{
	public $template = 'adminTemplate';
    
    function before()
    {
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

}
