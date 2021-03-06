<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Room extends ORM
{
    public $_table_name = 'rooms';
    public $_table_names_plural = TRUE;
    public $_foreign_key_suffix = 'Id';
    protected $_table_columns = array (
            'id' => 
            array (
                'type' => 'int',
                'min' => '-2147483648',
                'max' => '2147483647',
                'column_name' => 'id',
                'column_default' => NULL,
                'data_type' => 'int',
                'is_nullable' => false,
                'ordinal_position' => 1,
                'comment' => '',
                'extra' => 'auto_increment',
                'key' => 'PRI',
                'privileges' => 'select,insert,update,references',
                ),
            'name' => 
            array (
                'type' => 'string',
                'column_name' => 'name',
                'column_default' => '',
                'data_type' => 'varchar',
                'is_nullable' => false,
                'ordinal_position' => 2,
                'character_maximum_length' => '255',
                'collation_name' => 'latin1_swedish_ci',
                'comment' => '',
                'extra' => '',
                'key' => '',
                'privileges' => 'select,insert,update,references',
                ),
            );

    protected $_rules = array(
            'name'    => array('not_empty' => array()),
    );

    protected $_callbacks = array(
            'name' => array('name_unique'),
    );

    protected $_filters = array(
            TRUE       => array('trim' => array()),
    );
     
    public function __toString() { return $this->name; }
    public function value() { return $this->name; }
}
