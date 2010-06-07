<?php
define('TOPS_PAGE',1);
session_start();
$title = "Access Denied";
$baseURL = "../";
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" /> 
<title>Access Denied</title> 
</head> 
 
<body> 
<div style="text-align: center">
    <h1>Access Denied</h1> 
 
    <img src="<?php echo $baseURL; ?>img/accessDenied.gif" alt="accessDenied" />

	<p>
        Your login is not permitted in this section. <br/>
    <?php if ($_SESSION['id']): ?>
        Please get an admin to add the following id to the authorizedUsers file:
        <ul>
            <li style="white-space:nowrap;"><?php echo htmlentities($_SESSION['id']) ?></li>
        </ul>
    <?php endif ?>
    </p>
</div> 
 
</body> 
</html> 
