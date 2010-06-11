<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 

<head> 
<?php echo html::style('static/css/openidLogin.css', NULL, TRUE) ?>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /> 
<title>Access Denied</title> 
</head> 

<body> 
<div style="margin-left: 40%; margin-right: 40%;">
    Login with:
    <form action="<?php echo url::site('auth/tryAuth') ?>?login" method="post">
        <input type="hidden" name="type" value="google"/>
        <input type="submit" id="google" value="" class="provider"/>
    </form>

    <form action="<?php echo url::site('auth/tryAuth') ?>?login" method="post">
        <input type="hidden" name="type" value="yahoo"/>
        <input type="submit" id="yahoo" value="" class="provider" />
    </form>
</div>
</body> 
</html> 
