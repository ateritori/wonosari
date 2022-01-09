<?php
defined('BASEPATH') or exit('No direct script access allowed');

class c_hash extends CI_Controller
{
    public function index()
    {
        $nama = "123";
        $hash_nama = $this->hash_string($nama);
        echo "Nama Anda : " . $nama . "<br>";
        echo $hash_nama;
    }
}
