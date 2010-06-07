<?php
define('TOPS_PAGE',1);
session_start();

if (!$_SESSION['id'])
{
    /* Not logged in */
    header('Location: openID/tryAuth.php');
    exit();
}

include_once('config/authorizedUsers.php');
if (!@$authorizedUsers[$_SESSION['id']])
{
    header('Location: accessDenied.php');
    exit();
}

$title = "Admin Page";
$baseURL = "../";
include_once('../header.php');
include_once('../footer.php');
