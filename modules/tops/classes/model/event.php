<?php defined('SYSPATH') OR die('No direct access allowed.');

class Model_Event extends ORM
{
    public $_table_name = 'events';
    public $_table_names_plural = TRUE;
    public $_foreign_key_suffix = 'Id';
    public $_primary_val = 'name';

    protected $_rules = array(
            'name'    => array('not_empty' => array()),
            'roomId'  => array('not_empty' => array(), 'numeric' => array()),
            'length'  => array('numeric' => array()),
            #'time'    => array('regex' => array('/\d{3,4}/')),
    );

    protected $_callbacks = array(
            #'time' => array('_time_constraint'),
    );

    protected $_filters = array(
            TRUE       => array('trim' => array()),
    );

    protected $_belongs_to = array(
            'room' => array(),
            'eventType1Obj' => array('foreign_key'=>'eventType1', 'model'=>'eventType'),
            'day' => array(),
    );
    
    public function _time_constraint(Validate $data, $field)
    {
        $timeSpans = array();
        for($span = 0; $span <= $data['length']; $span++)
            $timeSpans[] = $data['time'] + $span*30;

        $conflictTime = (bool) DB::select(array('COUNT("*")', 'total_count'))
            ->from($this->_table_name)
            ->where('dayId', '=', $data['dayId'])
            ->where('roomId', '=', $data['dayId'])
            ->where('time', 'IN', $timeSpans)
            ->where($this->_primary_key, '!=', $this->pk())
            ->execute($this->_db)
            ->get('total_count');

        if ($conflictTime)
            $data->error($field, 'conflict_time', array($data[$field]));
    }

    public function __toString() { return $this->name; }
    public function value() { return $this->name; }
}

