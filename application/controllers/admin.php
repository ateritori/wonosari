<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('userid')])->row_array();

        $data['title'] = "Halaman Admin - Sistem  Perencanaan Pembangunan Kalurahan Wonosari";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $this->form_validation->set_rules('ketusul', 'Ketusul', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Semua Form Wajib Diisi</strong>');
            redirect('admin/index');
        } else {
            $this->_edit();
        }
    }
    private function _edit()
    {
        $idusulan = $this->input->post('idusulan');
        $ketusul = $this->input->post('ketusul');
        $proses = $this->input->post('proses');

        $this->db->set('status', $proses);
        $this->db->set('ket', $ketusul);
        $this->db->where('id', $idusulan);
        $this->db->update('olah_usulan');

        $this->db->set('status_verifikasi', 0);
        $this->db->where('id', $idusulan);
        $this->db->update('usulan');

        $this->session->set_flashdata('message', '<strong class="alert alert-success" role="alert">Data Proses Berhasil Disimpan</strong>');
        redirect('admin/index');
    }
}
