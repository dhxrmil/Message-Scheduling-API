<?php

class Msgmodel extends CI_Model
{
    public function insert($recipients, $msgtitle, $msg, $date, $time)
    {
        $sql = $this->db->query("INSERT INTO msgtable(recipients, msgtitle, msg, date, time) values ('$recipients', '$msgtitle', '$msg', '$date', '$time')");
    }

    public function show()
    {
        $sqls = $this->db->query("SELECT `id`, `recipients`, `msgtitle`, `msg`, `date`, 	
        TIME_FORMAT(time ,'%H:%i')as Time, `updatetime` FROM `msgtable` "); 
        return $sqls->result_array();
    }
}