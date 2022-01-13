<?php
defined('BASEPATH') or exit('No direct script access allowed');

class profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('userid')])->row_array();

        $data['title'] = "Halaman Profil - Sistem  Perencanaan Pembangunan Kalurahan Wonosari";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('profil', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $this->form_validation->set_rules('namauser', 'Namauser', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Nama User Wajib Diisi</strong>');
            redirect('profil/index');
        } else {
            $this->_edit();
        }
    }
    private function _edit()
    {
        $iduser = $this->input->post('iduser');
        $namauser = $this->input->post('namauser');

        $upload_image = $_FILES['foto']['name'];

        if ($upload_image) {
            $config['upload_path']          = './assets/img/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $new_foto = $this->upload->data('file_name');
                $this->db->set('foto', $new_foto);
            } else {
                $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert">Upload Foto Gagal, Hanya boleh file : gif/jpg/png maksimal 1Mb</strong>');
                redirect('profil/index', $iduser);
            }
        }

        $this->db->set('nama', $namauser);
        $this->db->where('id', $iduser);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<strong class="alert alert-success" role="alert">Data Profil Berhasil Diubah</strong>');
        redirect('profil/index', $iduser);
    }
}
