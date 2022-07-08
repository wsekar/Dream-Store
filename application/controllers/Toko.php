<?php

class Toko extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_toko'); //load model M_toko
		$this->data['aktif'] = 'toko'; //mendeklarasikan yang aktif yaitu toko
	}

	public function index()
	{
		$this->data['title'] = 'Profil Toko'; //membuat judul Profil Toko
		$this->data['toko'] = $this->M_toko->lihat(); //mengambil data toko dari method lihat dalam model M_toko
		$this->load->view('toko', $this->data); //load viewnya
	}

	public function proses_ubah() //proses ubah toko
	{
		$data = [
			'nama_toko' => $this->input->post('nama_toko'), // isi field nama_toko
			'nama_pemilik' => $this->input->post('nama_pemilik'), // isi field nama_pemiliki
			'no_telepon' => $this->input->post('no_telepon'), // isi field no_telepon
			'alamat' => $this->input->post('alamat'), // isi field alamat
		];

		if ($this->M_toko->ubah($data)) { //jika benar memanggil fungsi pada model M_toko
			//membuat session flashdata/notifikasi bahwa data berhasil diubah
			$this->session->set_flashdata('success', 'Profil Toko <strong>Berhasil</strong> Diubah!');
			redirect('toko'); //redirect ke controller toko
		} else { //jika tidak maka
			//membuat session flashdata/notifikasi bahwa data gagal diubah
			$this->session->set_flashdata('error', 'Profil Toko <strong>Gagal</strong> Diubah!');
			redirect('toko'); //redirect ke controller toko
		}
	}
}
