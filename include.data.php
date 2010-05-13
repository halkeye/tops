<?php
date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
$hourHeight = 50;

function getDBH()
{

    $config = parse_ini_file('.my.cnf');
    $link = mysql_connect('localhost', $config['user'], $config['password']);
    if (!$link) { die('Could not connect: ' . mysql_error()); }
    $result = mysql_select_db('tops',$link);
    if (!$result) { die('Error selecting db: ' . mysql_errno($link) . ": " . mysql_error($link)); }
    return $link;
}
$link = getDBH();
$result = mysql_query("SELECT * FROM eventTypes", $link);
if (!$result) { die('Invalid query: ' . mysql_errno($link) . ": " . mysql_error($link)); }

while ($row = mysql_fetch_assoc($result)) {
    $eventTypes[$row['id']] = $row;
}

mysql_close($link);
