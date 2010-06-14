<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Event extends ORM
{
    public $_table_name = 'events';
    public $_table_names_plural = TRUE;
    public $_foreign_key_suffix = 'Id';
    public $_primary_val = 'name';

    protected $_rules = array(
            'name'    => array('not_empty' => array()),
            'textColor' => array('color' => array()),
            'bgColor' => array('color' => array()),
    );

    protected $_callbacks = array(
            'name' => array('_unique'),
    );

    protected $_filters = array(
            TRUE       => array('trim' => array()),
            'bgColor'       => array('Model_Eventtype::mkcolor' => array()),
            'textColor'       => array('Model_Eventtype::mkcolor' => array()),
    );
    
    public function _unique(Validate $data, $field)
    {
        if ($this->unique_key_exists($field, $data[$field]))
        {
            $data->error($field, $field.'_unique', array($data[$field]));
        }
    }
    public static function mkcolor($value)
    {
        if (strpos($value, '#') !== 0)
            $value = "#$value";
        return $value;
    }

    /**
     * Tests if a unique key value exists in the database.
     *
     * @param   mixed    the value to test
     * @return  boolean
     */
    public function unique_key_exists($field, $value)
    {
        return (bool) DB::select(array('COUNT("*")', 'total_count'))
            ->from($this->_table_name)
            ->where($field, '=', $value)
            ->where($this->_primary_key, '!=', $this->pk())
            ->execute($this->_db)
            ->get('total_count');
    }

    public function __toString() { return $this->name; }
    public function value() { return $this->name; }
}

