<?php

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //pengambiilan data user login sesuai dengan rolenya
        if ($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
        $this->data['aktif'] = 'kategori';
        $this->load->model('M_kategori'); //load model M_kategori
    }

    public function index()
    {
        $this->data['title'] = 'Data Kategori';
        $this->data['all_kategori'] = $this->M_kategori->lihat();
        $this->data['no'] = 1;

        $this->load->view('kategori/lihat', $this->data);
    }

    public function tambah()
    {
        if ($this->session->login['role'] == 'kasir') {
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('penjualan');
        }

        $this->data['title'] = 'Tambah Kategori';

        $this->load->view('kategori/tambah', $this->data);
    }

    public function proses_tambah()
    {
        if ($this->session->login['role'] == 'kasir') {
            $this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
            redirect('penjualan');
        }

        $data = [
            'kode_kategori' => $this->input->post('kode_kategori'),
            'nama_kategori' => $this->input->post('nama_kategori'),

        ];

        if ($this->M_kategori->tambah($data)) {
            $this->session->set_flashdata('success', 'Data Kategori <strong>Berhasil</strong> Ditambahkan!');
            redirect('kategori');
        } else {
            $this->session->set_flashdata('error', 'Data Kategori <strong>Gagal</strong> Ditambahkan!');
            redirect('kategori');
        }
    }

    public function ubah($kode_kategori)
    {
        if ($this->session->login['role'] == 'kasir') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('penjualan');
        }

        $this->data['title'] = 'Ubah Kategori';
        $this->data['kategori'] = $this->M_kategori->lihat_id($kode_kategori);

        $this->load->view('kategori/ubah', $this->data);
    }

    public function proses_ubah($kode_kategori)
    {
        if ($this->session->login['role'] == 'kasir') {
            $this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
            redirect('penjualan');
        }

        $data = [
            'kode_kategori' => $this->input->post('kode_kategori'),
            'nama_kategori' => $this->input->post('nama_kategori'),

        ];

        if ($this->M_kategori->ubah($data, $kode_kategori)) {
            $this->session->set_flashdata('success', 'Data Kategori <strong>Berhasil</strong> Diubah!');
            redirect('kategori');
        } else {
            $this->session->set_flashdata('error', 'Data Kategori <strong>Gagal</strong> Diubah!');
            redirect('kategori');
        }
    }

    public function hapus($kode_kategori)
    {
        if ($this->session->login['role'] == 'kasir') {
            $this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
            redirect('penjualan');
        }

        if ($this->M_kategori->hapus($kode_kategori)) {
            $this->session->set_flashdata('success', 'Kategori <strong>Berhasil</strong> Dihapus!');
            redirect('kategori');
        } else {
            $this->session->set_flashdata('error', 'Data Kategori <strong>Gagal</strong> Dihapus!');
            redirect('kategori');
        }
    }
}
