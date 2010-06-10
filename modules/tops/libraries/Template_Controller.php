<?php defined('SYSPATH') or die('No direct script access.');

class Template_Controller extends Controller
{
    protected $view = null;
    protected $auth = null;
    protected $layoutFile = "template";
	// Session instance
	protected $session;

    function __construct()
    {
        parent::__construct();
        Event::add('system.post_controller', array($this, 'renderTemplate'));
        /* Session Instance */
        $this->session = Session::instance();

        /* Auth to handle */

        /* Base Template Stuff */
        $this->view = new View($this->layoutFile);
        /* Default Content */
        $this->view->content = "";
        /* Default Title */
        $this->view->title = "";
        /* Menu options */
        $this->view->menu    = array();

        /* Messages to show */
        $this->view->messages = array();

        /* Errors to show */
        $this->view->errors = array();

        $this->view->profiler = '';
        
    }

    public function renderTemplate()
    {
        if (!$this->view)
            return; // Don't do anything now

        if (!isset($this->view->heading))
            $this->view->heading = ucfirst(Router::$controller);
        if (!isset($this->view->subheading))
            $this->view->subheading = ucfirst(Router::$method);

        $session_messages = $this->session->get_once('messages');
        if ($session_messages) 
            $this->view->messages = array_merge($session_messages, $this->view->messages);
        $session_errors = $this->session->get_once('errors');
        if ($session_errors) 
            $this->view->errors = array_merge($session_errors, $this->view->errors);

        $this->view->set_global('isLoggedIn', !!$this->session->get('account_id'));
        /* store the user */
        $this->view->set_global('account', '');
        if ($this->session->get('account_id'))
        {
            $obj = new StdClass();
            $obj->id    = $this->session->get('account_id');
            $obj->fname = $this->session->get('account_fname');
            $obj->email = $this->session->get('account_email');
            $obj->lname = $this->session->get('account_lname');
            $this->view->set_global('account', $obj);
        }
        
        // Displays the view
        $this->view->render(TRUE);
    }

    protected function addMessage($message)
    {
        $messages = $this->session->get('messages') or array();
        $messages[] = $message;
        $this->session->set_flash('messages',  $messages);
    }
    
    protected function addError($error)
    {
        $errors = $this->session->get('errors') or array();
        $errors[] = $error;
        $this->session->set_flash('errors',  $errors);
    }

    /**
     * Redirect a user to a location, unless a session variable is set
     * @param string $where Where to redirect the user if nothing else is set
     */
    function _redirect($where = '')
    {
        $location = $this->session->get_once('redirected_from');
        if (!$location) $location = $where;
        url::redirect($location);
        return;
    }

    protected function requireAdmin()
    {
        if (!$this->session->get('account_id'))
        {
            $this->session->set('redirected_from', url::current());
            url::redirect('openid/tryAuth');
            exit();
        }
        $email = $this->session->get('account_email');
        $emails = Kohana::config("auth.emails");
        if (isset($emails[$email]) && $emails[$email])
        {
            return TRUE;
        }

        url::redirect('system/accessDenied');
        exit();
    }

    public function accessDenied()
    {
        $this->view->title = Kohana::lang('auth.accessDenied_title');
        $this->view->heading = Kohana::lang('auth.accessDenied_heading');
        $this->view->subheading = Kohana::lang('auth.accessDenied_subheading');
        $this->view->content = new View('global/accessDenied');
    }

}
