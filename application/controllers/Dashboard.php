<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//pengambiilan data user login sesuai dengan rolenya
		if ($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'dashboard'; //mendeklarasikan yang aktif yaitu dashboard
		$this->load->model('M_barang'); //load model M_barang
		$this->load->model('M_kasir'); //load model M_kasir
		$this->load->model('M_penjualan'); //load model M_penjualan
		$this->load->model('M_pengguna'); //load model M_pengguna
		$this->load->model('M_toko'); //load model M_toko
		// $this->load->model('M_detail_penjualan'); //load model M_toko
	}
	public function index()
	{
		$this->data['title'] = 'Halaman Dashboard'; //menampilkan text 'Halaman Dashboard'
		$this->data['jumlah_barang'] = $this->M_barang->jumlah(); //mengambil jumlah barang dari method jumlah dalam model M_barang
		$this->data['jumlah_kasir'] = $this->M_kasir->jumlah(); //mengambil jumlah kasir dari method jumlah dalam model M_kasir
		$this->data['jumlah_penjualan'] = $this->M_penjualan->jumlah(); //mengambil jumlah penjualan dari method jumlah dalam model M_penjualan
		$this->data['jumlah_pengguna'] = $this->M_pengguna->jumlah(); //mengambil jumlah pengguna dari method jumlah dalam model M_pengguna
		$this->data['toko'] = $this->M_toko->lihat(); //mengambil data toko dari lihat dalam model M_toko
		$this->data['graph'] = $this->M_barang->graph(); //mengambil data toko dari lihat dalam model M_toko
		// $this->data['lihat_stok'] = $this->M_barang->get_data_stok(); //mengambil data toko dari lihat dalam model M_toko
		// $this->data['jumlah_jual'] = $this->M_detail_penjualan->jumlah_jual(); //mengambil data toko dari lihat dalam model M_toko
		$this->load->view('dashboard', $this->data); //load view atau menampilkan halaman dashboard dengan data-data yang telah disebutkan sebelumnya
	}
}
