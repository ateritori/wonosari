<?php
defined('BASEPATH') or exit('No direct script access allowed');

class bantuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('userid')])->row_array();
        if($data['user']) :
            $data['title'] = "Halaman Bantuan - Sistem  Perencanaan Pembangunan Kalurahan Wonosari";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/top_bar', $data);
            $this->load->view('bantuan/index', $data);
            $this->load->view('templates/footer');
            else :
                redirect('auth');
            endif;
    }
}