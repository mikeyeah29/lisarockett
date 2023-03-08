<?php

class RWDCalenderDbModel
{
    private $table;
    private $wpdb;

    //constructor
    public function __construct($table)
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table = $wpdb->prefix . $table;
    }

    //create method
    public function create($data)
    {
        if ($this->wpdb->insert($this->table, $data)) {
            return true;
        }
        return false;
    }

    //read method
    public function read($where = null)
    {
        if ($where == null) {
            return $this->wpdb->get_results("SELECT * FROM $this->table");
        }

        // RWD_Helpers::dd("SELECT * FROM $this->table WHERE $where");

        return $this->wpdb->get_results("SELECT * FROM $this->table WHERE $where");
    }

    //update method
    public function update($data, $where)
    {
        if ($this->wpdb->update($this->table, $data, $where)) {
            return true;
        }
        return false;
    }

    //delete method
    public function delete($where)
    {
        if ($this->wpdb->delete($this->table, $where)) {
            return true;
        }
        return false;
    }
}

?>
