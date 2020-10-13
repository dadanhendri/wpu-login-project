<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Obat_model');
    }

    public function index()
    {
        $data['title'] = 'Latihan Multi Insert';
        $this->load->view('templates/header', $data);
        $this->load->view('home', $data);
        $this->load->view('templates/footer');
    }

    public function ambilData()
    {
        $dataObat = $this->Obat_model->getAllObat();
        echo json_encode($dataObat);
    }

    public function tambah()
    {
        $kode_obat = $this->input->post('kode_obat', true);
        $nama_obat = $this->input->post('nama_obat', true);
        $harga_obat = $this->input->post('harga_obat', true);
        $keterangan_obat = $this->input->post('keterangan_obat', true);
        if ($kode_obat != '' && $nama_obat != '' && $harga_obat != '' && $keterangan_obat != '') {
            $data = [];
            foreach ($kode_obat as $key => $ko) {
                $data[] = array(
                    "kode_obat" => $kode_obat[$key],
                    "nama_obat" => $nama_obat[$key],
                    "harga_obat" => $harga_obat[$key],
                    "keterangan_obat" => $keterangan_obat[$key],
                    "is_active" => 1
                );
            }
            $this->Obat_model->tambahData($data);
            echo "Data berhasil ditambahkan";
        } else {
            echo "All fields are Required";
        }
    }
}
