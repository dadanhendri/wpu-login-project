<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_model extends CI_model
{
    public function addSchedule($data)
    {
        $this->db->insert('tb_schedule', $data);
    }

    public function getScheduleById($id)
    {
        return $this->db->get_where('tb_schedule', ['id' => $id])->row_array();
    }
}
