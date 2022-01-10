<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('userid')])->row_array();

        $this->form_validation->set_rules('usulan', 'Usulan', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Halaman User - Sistem  Perencanaan Pembangunan Kalurahan Wonosari";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/top_bar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else {
            echo "Data Berhasil Disimpan";
        }
    }
}
