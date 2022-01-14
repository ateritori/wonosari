<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('userid')])->row_array();

        $data['title'] = "Input Usulan - Sistem  Perencanaan Pembangunan Kalurahan Wonosari";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('user/usulan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules('masalah', 'Masalah', 'required');
        $this->form_validation->set_rules('potensi', 'Potensi', 'required');
        $this->form_validation->set_rules('uraian', 'Uraian', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('biaya', 'Biaya', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Semua Form Wajib Diisi</strong>');
            redirect('user/index');
        } else {
            $this->_tambah();
        }
    }

    private function _tambah()
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
            $config['allowed_types']        = 'pdf|doc|docx';
            $config['max_size']             = 1024;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('proposal')) :
                $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Proposal Harus Diisi</strong>');
                redirect('user/index');
                die;
            else :
                $proposal = $this->upload->data('file_name');
            endif;

        endif;

        $userid = $_SESSION['user'];

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
            'status_verifikasi' => 1,
        );

        $this->db->insert('usulan', $data_usulan);

        $queryOlahusulan = "SELECT id from usulan ORDER BY ID DESC LIMIT 1";
        $lastUsulan = $this->db->query($queryOlahusulan)->row_array();
        $latest = $lastUsulan['id'];

        $savelatest = array(
            'kode_usulan' => $latest,
        );

        $this->db->insert('olah_usulan', $savelatest);
        $this->session->set_flashdata('message', '<strong class="alert alert-success" role="alert">Data Usulan Berhasil Ditambah</strong>');
        redirect('user/index', $userid);
    }

    public function edit()
    {
        $this->form_validation->set_rules('masalah', 'Masalah', 'required');
        $this->form_validation->set_rules('potensi', 'Potensi', 'required');
        $this->form_validation->set_rules('uraian', 'Uraian', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required');
        $this->form_validation->set_rules('biaya', 'Biaya', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Semua Form Wajib Diisi</strong>');
            redirect('user/index');
        } else {
            $this->_edit();
        }
    }
    private function _edit()
    {
        $idusulan = $this->input->post('idusulan');
        $masalah = $this->input->post('masalah');
        $potensi = $this->input->post('potensi');
        $uraian = $this->input->post('uraian');
        $jumlah = $this->input->post('jumlah');
        $panjang = $this->input->post('panjang');
        $lebar = $this->input->post('lebar');
        $tinggi = $this->input->post('tinggi');
        $biaya = $this->input->post('biaya');

        $userid = $_SESSION['user'];

        $upload_file = $_FILES['proposal']['name'];

        if ($upload_file) {
            $config['upload_path']          = './assets/file';
            $config['allowed_types']        = 'pdf|doc|docx';
            $config['max_size']             = 1024;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('proposal')) {
                $new_file = $this->upload->data('file_name');
                $this->db->set('file', $new_file);
            } else {
                $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert">Upload Foto Gagal, Hanya boleh file (pdf/word) berekstensi : pdf/doc/docx maksimal 1Mb</strong>');
                redirect('user/index', $userid);
            }
        }


        $this->db->set('masalah', $masalah);
        $this->db->set('potensi', $potensi);
        $this->db->set('usulan', $uraian);
        $this->db->set('jumlah', $jumlah);
        $this->db->set('panjang', $panjang);
        $this->db->set('lebar', $lebar);
        $this->db->set('tinggi', $tinggi);
        $this->db->set('biaya', $biaya);
        $this->db->set('status_verifikasi', 1);

        $this->db->where('id', $idusulan);
        $this->db->update('usulan');

        $this->db->set('status', 1);

        $this->db->where('id', $idusulan);
        $this->db->update('olah_usulan');

        $this->session->set_flashdata('message', '<strong class="alert alert-success" role="alert">Data Usulan Berhasil Diubah</strong>');
        redirect('user/index', $userid);
    }

    public function hapus()
    {
        $idusulan = $this->input->post('idusulan');
        $userid = $_SESSION['user'];

        $this->db->set('aktif', 0);
        $this->db->where('id', $idusulan);
        $this->db->update('usulan');

        $this->session->set_flashdata('message', '<strong class="alert alert-success" role="alert">Data Usulan Berhasil Dihapus</strong>');
        redirect('user/index', $userid);
    }

    public function profil()
    {
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('userid')])->row_array();

        $data['title'] = "Profil User - Sistem  Perencanaan Pembangunan Kalurahan Wonosari";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('user/profil', $data);
        $this->load->view('templates/footer');
    }
    
    public function editprofil()
    {
        $iduser = $this->input->post('iduser');
        $namauser = $this->input->post('namauser');
        $username = $this->input->post('username');

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
                redirect('user/profil', $iduser);
            }
        }

        $cek_username = $this->db->get_where('user', ['id' => $iduser])->row_array();
        $dtusername = $cek_username['username'];
        
        if($dtusername == $username) :
            $redir = "user/profil";
            $ucap = '<strong class="alert alert-success" role="alert"> Data Profil Berhasil Diubah </strong>';
        else:
            $this->db->set('username', $username);
            $ucap = '<div class="alert alert-success" role="alert">Data Username Berhasil Diubah, Silakan Login untuk Melanjutkan</div>';
            $redir = "auth";
        endif;

        $this->db->set('dibuat', date('d-m-Y H:i:s'));
        $this->db->set('nama', $namauser);
        $this->db->where('id', $iduser);
        $this->db->update('user');

        $this->session->set_flashdata('message', $ucap);
        redirect($redir, $iduser);
    }

    public function ubahpassword()
    {    
        $this->form_validation->set_rules('passwordlama', 'Passwordlama', 'required');
        $this->form_validation->set_rules('passwordbaru1', 'Passwordbaru1', 'required');
        $this->form_validation->set_rules('passwordbaru2', 'Passwordbaru2', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Semua Form Wajib Diisi</strong>');
            redirect('user/profil');
        } else {
            $this->_ubahpassword();
        }     
    }

    private function _ubahpassword(){
        $iduser = $this->input->post('iduser');
        $passwordlama = $this->input->post('passwordlama');
        $passwordbaru1 = $this->input->post('passwordbaru1');
        $passwordbaru2 = $this->input->post('passwordbaru2');

        $queryubahpassword = "SELECT password from user WHERE id=$iduser";
        $passwordl = $this->db->query($queryubahpassword)->row_array();

        if(password_verify($passwordlama, $passwordl['password'])) :
            if($passwordbaru1 == $passwordbaru2) :
                $this->db->set('password', password_hash($passwordbaru2, PASSWORD_BCRYPT));
                $this->db->set('dibuat', date('d-m-Y H:i:s'));
                $this->db->where('id', $iduser);
                $this->db->update('user');
                $this->session->set_flashdata('message', '<strong class="alert alert-success" role="alert">Password Berhasil Dirubah</strong>');
                    redirect('user/profil');
                else :
                    $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert">Password Baru Salah, Silakan Ulangi!</strong>');
                    redirect('user/profil');
            endif;
        else:
            $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert">Password Lama Salah, Silakan Ulangi!</strong>');
            redirect('user/profil');
        endif;
    }
    

}
