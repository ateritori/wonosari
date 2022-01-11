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

        $data['title'] = "Halaman User - Sistem  Perencanaan Pembangunan Kalurahan Wonosari";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $masalah = $this->input->post('masalah');
        $potensi = $this->input->post('potensi');
        $uraian = $this->input->post('uraian');
        $jumlah = $this->input->post('jumlah');
        $panjang = $this->input->post('panjang');
        $lebar = $this->input->post('lebar');
        $tinggi = $this->input->post('tinggi');
        $biaya = $this->input->post('biaya');
        $proposal = $_FILES['proposal'];

        if ($proposal = '') :
        else :
            $config['upload_path']          = './assets/file';
            $config['allowed_types']        = 'pdf|docx|rtf';
            $config['max_size']             = 100;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('proposal')) :
                echo "Upload Proposal/ Dokumen Pendukung <b>GAGAL</b>";
                die;
            else :
                $proposal = $this->upload->data('file_name');
            endif;

        endif;

        $kode_rt = $_SESSION['kode_rt'];
        $kode_padukuhan = $_SESSION['kode_padukuhan'];
        $userid = $_SESSION['user'];

        $status = 1;

        $data_usulan = array(
            'masalah' => $masalah,
            'potensi' => $potensi,
            'usulan' => $uraian,
            'jumlah' => $jumlah,
            'panjang' => $panjang,
            'lebar' => $lebar,
            'tinggi' => $tinggi,
            'biaya' => $biaya,
            'user' => $userid,
            'file' => $proposal,
        );

        $this->db->insert('usulan', $data_usulan);

        $queryOlahusulan = "SELECT id from usulan ORDER BY ID DESC LIMIT 1";
        $lastUsulan = $this->db->query($queryOlahusulan)->row_array();
        $latest = $lastUsulan['id'];

        $savelatest = array(
            'kode_usulan' => $latest,
        );

        $this->db->insert('olah_usulan', $savelatest);
        redirect('user/index', $userid);
    }

    public function edit()
    {
        $masalah = $this->input->post('masalah');
        $potensi = $this->input->post('potensi');
        $uraian = $this->input->post('uraian');
        $jumlah = $this->input->post('jumlah');
        $panjang = $this->input->post('panjang');
        $lebar = $this->input->post('lebar');
        $tinggi = $this->input->post('tinggi');
        $biaya = $this->input->post('biaya');
        $proposal = $_FILES['proposal'];

        if ($proposal = '') :
            $config['upload_path']          = './assets/file';
            $config['allowed_types']        = 'pdf|docx|rtf';
            $config['max_size']             = 100;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('proposal')) :
                echo "Upload Proposal/ Dokumen Pendukung <b>GAGAL</b>";
                die;
            else :
                $proposal = $this->upload->data('file_name');
            endif;
        else :
        endif;

        $kode_rt = $_SESSION['kode_rt'];
        $kode_padukuhan = $_SESSION['kode_padukuhan'];
        $userid = $_SESSION['user'];

        $status = 1;

        $dataeditusul = array(
            'masalah' => $masalah,
            'potensi' => $potensi,
            'usulan' => $uraian,
            'jumlah' => $jumlah,
            'panjang' => $panjang,
            'lebar' => $lebar,
            'tinggi' => $tinggi,
            'biaya' => $biaya,
            'user' => $userid,
            'file' => $proposal,
        );

        $where = array('id' => $userid);
        $this->db->where($where);
        $this->db->update('usulan', $dataeditusul);

        $queryOlahusulan = "SELECT id from usulan ORDER BY ID DESC LIMIT 1";
        $lastUsulan = $this->db->query($queryOlahusulan)->row_array();
        $latest = $lastUsulan['id'];

        $savelatest = array(
            'kode_usulan' => $latest,
        );

        $where = array('id' => $userid);
        $this->db->where($where);
        $this->db->update('olah_usulan', $savelatest);
        redirect('user/index', $userid);
    }
}
