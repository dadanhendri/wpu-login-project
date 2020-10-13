<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Obat_model extends CI_model
{
    public function getAllObat()
    {
        return $this->db->get('tb_obat')->result();
    }

    public function tambahData($data)
    {
        $this->db->insert_batch('tb_obat', $data);
    }
}
