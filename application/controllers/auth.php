<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('userid', 'Userid', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = "Login-Sistem Perencanaan Pembangunan Kalurahan";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $userid = $this->input->post('userid');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $userid])->row_array();

        if ($user) {
            //usernya ada
            if ($user['aktif'] == 1) {
                //jika user nya aktif
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'userid' => $user['username'],
                        'role_id' => $user['jenis']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['jenis'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user', $user);
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">UserID Tidak Aktif!</div>');
                redirect('Auth');
            }
        } else {
            //userid belum terdaftar
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">UserID Belum Terdaftar!</div>');
            redirect('Auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('userid');
        $this->session->unset_userdata('jenis');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="danger">Berhasil Log Out!</div>');
        redirect('Auth');
    }
}
