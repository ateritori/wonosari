<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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

        $data['title'] = "Proses Usulan - Sistem  Perencanaan Pembangunan Kalurahan Wonosari";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $this->form_validation->set_rules('ketproses', 'Ketproses', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Semua Form Wajib Diisi</strong>');
            redirect('admin/index');
        } else {
            $this->_simpan();
        }
    }
    private function _simpan()
    {
        $idusulan = $this->input->post('idusulan');
        $ketproses = $this->input->post('ketproses');
        $proses = $this->input->post('proses');

        $this->db->set('status', $proses);
        $this->db->set('ket', $ketproses);
        $this->db->where('id', $idusulan);
        $this->db->update('olah_usulan');

        $this->db->set('status_verifikasi', 0);
        $this->db->where('id', $idusulan);
        $this->db->update('usulan');

        $this->session->set_flashdata('message', '<strong class="alert alert-success" role="alert">Data Proses Berhasil Disimpan</strong>');
        redirect('admin/index');
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
            redirect('admin/index');
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
                redirect('admin/index');
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
        redirect('admin/index', $userid);
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
            redirect('admin/index');
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
                redirect('admin/index', $userid);
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
        redirect('admin/index', $userid);
    }

    public function hapus()
    {
        $idusulan = $this->input->post('idusulan');
        $userid = $_SESSION['user'];

        $this->db->set('aktif', 0);
        $this->db->where('id', $idusulan);
        $this->db->update('usulan');

        $this->session->set_flashdata('message', '<strong class="alert alert-success" role="alert">Data Usulan Berhasil Dihapus</strong>');
        redirect('admin/index', $userid);
    }

    public function user()
    {
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('userid')])->row_array();

        $data['title'] = "Manajemen User - Manajemen User - Sistem  Perencanaan Pembangunan Kalurahan Wonosari";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('admin/manage_user', $data);
        $this->load->view('templates/footer');
    }

    public function tambahuser()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password1', 'Password1', 'required');
        $this->form_validation->set_rules('password2', 'Password2', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Semua Form Wajib Diisi</strong>');
            redirect('admin/user');
        } else {
            $this->_tambahuser();
        }
    }

    private function _tambahuser()
    {
        $userid = $this->input->post('userid');
        $username = $this->input->post('username');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        $nama = $this->input->post('nama');
        $level = $this->input->post('level');
        $lembaga = $this->input->post('lembaga');
        $sublembaga = $this->input->post('sublembaga');
        $foto = $_FILES['foto'];

        if ($password1 == $password2) :
            $password = password_hash($password2, PASSWORD_BCRYPT);
        else :
            $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Password 1 harus sama dengan Password 2</strong>');
            redirect('admin/user');
        endif;

        if ($foto = '') :
        else :
            $config['upload_path']          = './assets/img';
            $config['allowed_types']        = 'jpg|gif|png';
            $config['max_size']             = 1024;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) :
                $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Foto Harus Diisi</strong>');
                redirect('admin/user');
                die;
            else :
                $foto = $this->upload->data('file_name');
            endif;

        endif;

        $data_user = array(
            'nama' => $nama,
            'username' => $username,
            'password' => $password,
            'jenis' => $level,
            'kode_padukuhan' => $lembaga,
            'kode_rt' => $sublembaga,
            'aktif' => 1,
            'dibuat' => date('d-m-Y H:i:s'),
            'foto' => $foto,
        );

        $this->db->insert('user', $data_user);
        $this->session->set_flashdata('message', '<strong class="alert alert-success" role="alert">Data User Berhasil Ditambah</strong>');
        redirect('admin/user', $userid);
    }

    public function edituser()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('lembaga', 'Lembaga', 'required');
        $this->form_validation->set_rules('sublembaga', 'sublembaga', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert"> Semua Form Wajib Diisi</strong>');
            redirect('admin/user');
        } else {
            $this->_edituser();
        }
    }

    private function _edituser()
    {
        $userid = $this->input->post('userid');
        $username = $this->input->post('username');
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');
        $nama = $this->input->post('nama');
        $jenis = $this->input->post('level');
        $lembaga = $this->input->post('lembaga');
        $sublembaga = $this->input->post('sublembaga');
        $aktif = $this->input->post('aktif');
        $foto = $_FILES['foto']['name'];

        if ($foto) {
            $config['upload_path']          = './assets/img/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $new_foto = $this->upload->data('file_name');
                $this->db->set('foto', $new_foto);
            } else {
                $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert">Upload Foto Gagal, Hanya boleh file : gif/jpg/png maksimal 1Mb</strong>');
                redirect('admin/user', $userid);
            }
        }

        if (($password1 == '') or ($password2 == '')) :

        else :
            if ($password1 == $password2) :
                $password = password_hash($password2, PASSWORD_BCRYPT);
                $this->db->set('password', $password);
            else :
                $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert">Password Tidak Sama/strong>');
                redirect('admin/user', $userid);
            endif;
        endif;


        $this->db->set('nama', $nama);
        $this->db->set('username', $username);
        $this->db->set('jenis', $jenis);
        $this->db->set('kode_padukuhan', $lembaga);
        $this->db->set('kode_rt', $sublembaga);
        $this->db->set('aktif', $aktif);
        $this->db->set('dibuat', date('d-m-Y H:i:s'));

        $this->db->where('id', $userid);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<strong class="alert alert-success" role="alert">Data User Berhasil Diubah</strong>');
        redirect('admin/user', $userid);
    }

    public function hapususer()
    {
        $userid = $this->input->post('iduser');

        $this->db->set('aktif', 0);
        $this->db->set('dibuat', date('d-m-Y H:i:s'));

        $this->db->where('id', $userid);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<strong class="alert alert-danger" role="alert">Data User Berhasil Di Non-Aktifkan</strong>');
        redirect('admin/user', $userid);
    }
}
