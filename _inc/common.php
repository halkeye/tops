<?php
date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);

class DBH
{
    private static $instance;
    public function getInstance()
    {
        if (!DBH::$instance)
            DBH::$instance = new DBH();
        return DBH::$instance;
    }

    private $handle;
    public function getHandle()
    {
        if ($this->handle)
            return $this->handle;
        $config = parse_ini_file('.my.cnf');
        $this->handle = mysql_pconnect('localhost', $config['user'], @$config['password']);
        if (!$this->handle) { die('Could not connect: ' . mysql_error()); }
        $result = mysql_select_db('tops',$this->handle);
        if (!$result) { die('Error selecting db: ' . mysql_errno($this->handle) . ": " . mysql_error($this->handle)); }
        return $this->handle;
    }
}
