<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_model
{
    public function getAllUser()
    {
        $queryUser = "SELECT `tb_user`.`id`,`name`,`email`,`password`,`image`,`tb_user`.`is_active`,`tb_user`.`date_created`,`tb_user_role`.`role`
                        FROM `tb_user` JOIN `tb_user_role`
                          ON `tb_user`.`role_id` = `tb_user_role`.`id`                    
                    ";

        return $this->db->query($queryUser)->result_array();
        // return $this->db->get('tb_user')->result_array();
    }

    public function getUserById($id)
    {
        return $this->db->get_where('tb_user', ['id' => $id])->row_array();
    }

    public function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_user', $data);
    }
}
