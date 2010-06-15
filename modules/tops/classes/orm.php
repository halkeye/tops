<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM 
{
    public function name_unique(Validate $data, $field)
    {
        if ($this->unique_key_exists($field, $data[$field]))
        {
            $data->error($field, 'name_unique', array($data[$field]));
        }
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
}
