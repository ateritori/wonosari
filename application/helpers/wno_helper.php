<?php

function is_login()
{
    $ci3 = get_instance();
    if (!$ci3->session->userdata('userid')) {
        redirect('auth');
    } else {

        $jenis = $ci3->session->userdata('jenis');

        $menu = $ci3->uri->segment(1);
        $queryMenu = $ci3->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $user_akses = $ci3->db->get_where('user_access_menu', ['role_id' => $jenis, 'menu_id' => $menu_id]);

        if ($user_akses->num_rows() < 1) {
            redirect('auth/block');
        } else {
        }
    }
}
