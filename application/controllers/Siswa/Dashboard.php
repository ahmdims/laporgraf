<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') != 'siswa') {
            redirect('auth');
        }
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data['title'] = 'Siswa Dashboard';
        $data['user'] = $this->session->userdata('nama');
        $userId = $this->session->userdata('user_id');

        $data['pengaduan_saya'] = $this->Dashboard_model->count_pengaduan_by_user($userId);
        $data['pengaduan_diproses'] = $this->Dashboard_model->count_pengaduan_by_user($userId, '0');
        $data['pengaduan_selesai'] = $this->Dashboard_model->count_pengaduan_by_user($userId, '1');

        $this->load->view('templates/header', $data);
        $this->load->view('siswa/dashboard', $data);
        $this->load->view('templates/footer');
    }
}