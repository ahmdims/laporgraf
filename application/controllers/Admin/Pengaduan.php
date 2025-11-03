<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->userdata('role') != 'admin') {
            redirect('auth');
        }
        $this->load->model('Pengaduan_model');
        $this->load->model('Tanggapan_model');
    }

    public function index()
    {
        $data['title'] = 'Kelola Laporan Masuk';
        $data['pengaduan_list'] = $this->Pengaduan_model->get_all();
        $this->load->view('templates/header', $data);
        $this->load->view('admin/pengaduan/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id_pengaduan)
    {
        $data['title'] = 'Detail Pengaduan';
        $data['pengaduan'] = $this->Pengaduan_model->get_by_id($id_pengaduan);
        if (!$data['pengaduan']) {
            $this->session->set_flashdata('error', 'Pengaduan tidak ditemukan.');
            redirect('admin/pengaduan');
        }
        $data['balasan_list'] = $this->Tanggapan_model->get_tanggapan_by_pengaduan($id_pengaduan);
        $data['sudah_ditanggapi'] = count($data['balasan_list']) > 0;
        $this->load->view('templates/header', $data);
        $this->load->view('admin/pengaduan/detail', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id_pengaduan)
    {
        $this->Pengaduan_model->delete($id_pengaduan);
        $this->session->set_flashdata('success', 'Pengaduan berhasil dihapus.');
        redirect('admin/pengaduan');
    }
}
