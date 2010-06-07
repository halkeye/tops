<?php
define('TOPS_PAGE',1);
session_start();
$title = "Access Denied";
$baseURL = "../";
include_once('../header.php');
?>
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
<?
include_once('../footer.php');
