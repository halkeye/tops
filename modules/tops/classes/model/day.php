<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Day extends ORM
{
    public $_table_day = 'days';
    public $_table_days_plural = TRUE;
    public $_foreign_key_suffix = 'Id';
    public $_primary_val = 'day';

    protected $_table_columns = array (
            'id' => 
            array (
                'type' => 'int',
                'min' => '-2147483648',
                'max' => '2147483647',
                'column_day' => 'id',
                'column_default' => NULL,
                'data_type' => 'int',
                'is_nullable' => false,
                'ordinal_position' => 1,
                'comment' => '',
                'extra' => 'auto_increment',
                'key' => 'PRI',
                'privileges' => 'select,insert,update,references',
                ),
            'day' => 
            array (
                'type' => 'string',
                'column_day' => 'day',
                'column_default' => '',
                'data_type' => 'varchar',
                'is_nullable' => false,
                'ordinal_position' => 2,
                'character_maximum_length' => '255',
                'collation_day' => 'latin1_swedish_ci',
                'comment' => '',
                'extra' => '',
                'key' => '',
                'privileges' => 'select,insert,update,references',
                ),
            );
        

    #protected $_has_many = array('events' => array('through' => 'event'));

    protected $_rules = array(
            'day'    => array('not_empty' => array(), 'date'=>array()),
    );

    protected $_callbacks = array(
            'day' => array('day_unique'),
    );

    protected $_filters = array(
            TRUE       => array('trim' => array()),
    );
    
    public function day_unique(Validate $data, $field)
    {
        if ($this->unique_key_exists($data[$field]))
        {
            $data->error($field, 'day_unique', array($data[$field]));
        }
    }

    /**
     * Tests if a unique key value exists in the database.
     *
     * @param   mixed    the value to test
     * @return  boolean
     */
    public function unique_key_exists($value)
    {
        return (bool) DB::select(array('COUNT("*")', 'total_count'))
            ->from($this->_table_day)
            ->where('day', '=', $value)
            ->where($this->_primary_key, '!=', $this->pk())
            ->execute($this->_db)
            ->get('total_count');
    }

    public function __toString() { return $this->day; }
    public function value() { return $this->day; }
}

