<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Schedule_model');
        $this->load->library('form_validation');
    }


    public function index()
    {
        $data['title'] = 'Schedule';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

        $data['schedule'] = $this->db->get('tb_schedule')->result_array();
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('date', 'Date', 'required');
        $this->form_validation->set_rules('time_start', 'Time Start', 'required');
        $this->form_validation->set_rules('time_end', 'Time End', 'required');
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('classroom', 'Clasroom', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('schedule/index', $data);;
            $this->load->view('templates/footer');
        } else {
            $data = [
                'event' => 'Phase Academia 2020',
                'date' => $this->input->post('date'),
                'time_start' => $this->input->post('time_start'),
                'time_end' => $this->input->post('time_end'),
                'type' => $this->input->post('type'),
                'classroom' => $this->input->post('classroom')
            ];

            $this->Schedule_model->addSchedule($data);
            $this->session->set_flashdata('message', 'New Schedule Added');
            redirect('schedule');
        }
    }


    public function scheduleDetail($id)
    {
        $data['title'] = 'Detail Schedule';
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['schedule'] = $this->Schedule_model->getScheduleById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('schedule/detail', $data);;
        $this->load->view('templates/footer');
    }


    public function getSchedule()
    {
        $id = $this->input->post('id');
        $schedule = $this->db->get_where('tb_schedule', ['id' => $id])->row_array();
        echo json_encode($schedule);
    }


    public function updateSchedule()
    {
        $id = $this->input->post('id');
        $data = [
            'title' => $this->input->post('title'),
            'date' => $this->input->post('date'),
            'time_start' => $this->input->post('time_start'),
            'time_end' => $this->input->post('time_end'),
            'type' => $this->input->post('type'),
            'classroom' => $this->input->post('classroom')
        ];
        $this->Schedule_model->updateSchedule($id, $data);
        $this->session->set_flashdata('message', 'Schedule Updated');
        redirect('schedule');
    }
}
