<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_model
{

    public function getAllMenu()
    {
        return $this->db->get_where('tb_user_menu', ['is_active' => 1])->result_array();
    }

    public function getMenuById($id)
    {
        return $this->db->get_where('tb_user_menu', ['id' => $id])->row_array();
    }

    public function updateMenu($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_user_menu', $data);
    }


    public function getAllSubmenu()
    {
        $querySubMenu = "SELECT `tb_user_sub_menu`.*,`tb_user_menu`.`menu`
                           FROM `tb_user_sub_menu` JOIN `tb_user_menu`
                             ON `tb_user_sub_menu`.`menu_id` = `tb_user_menu`.`id`
                          WHERE `tb_user_sub_menu`.`is_active` = 1
                        ";
        return $this->db->query($querySubMenu)->result_array();
    }

    public function getSubMenuById($id)
    {
        return $this->db->get_where('tb_user_sub_menu', ['id' => $id])->row_array();
    }

    public function updateSubMenu($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_user_sub_menu', $data);
    }
}
