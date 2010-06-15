<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Eventtype extends ORM
{
    public $_table_name = 'eventTypes';
    public $_table_names_plural = TRUE;
    public $_foreign_key_suffix = 'Id';
    public $_primary_val = 'name';

    protected $_rules = array(
            'name'    => array('not_empty' => array()),
            'textColor' => array('color' => array()),
            'bgColor' => array('color' => array()),
    );

    protected $_callbacks = array(
            'name' => array('name_unique'),
            'nameKey' => array('name_unique'),
    );

    protected $_filters = array(
            TRUE       => array('trim' => array()),
            'bgColor'       => array('Model_Eventtype::mkcolor' => array()),
            'textColor'       => array('Model_Eventtype::mkcolor' => array()),
    );
    
    public static function mkcolor($value)
    {
        if (strpos($value, '#') !== 0)
            $value = "#$value";
        return $value;
    }

    public function __toString() { return $this->name; }
    public function value() { return $this->name; }
}

