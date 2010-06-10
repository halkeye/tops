<?php
class System_Controller extends Controller_Core
{
    public function accessDenied()
    {
        $image = url::site('static/img/accessDenied.gif');

        $this->session = Session::instance();
        $email = $this->session->get('account_email');
        if ($email) 
            $email = " <b>($email)</b>";
        else
            $email = "";

        print <<<HEREDOC
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 

<head> 
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /> 
<title>Access Denied</title> 
</head> 

<body> 
<div style="text-align: center">
<h1>Access Denied</h1> 

<img src="$image" alt="accessDenied" />

<p>Your login is not permitted in this section.</p>
<p>Let the admin know what your email address$email is.</p>
</div> 
</body> 
</html> 
HEREDOC;
    }
}
