<?php

class Penjualan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//pengambiilan data user login sesuai dengan rolenya
		if ($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		date_default_timezone_set('Asia/Jakarta'); //membuat fungsi date time
		$this->load->model('M_barang'); //load mode M_barang
		$this->load->model('M_penjualan'); //load mode M_penjualan
		$this->load->model('M_detail_penjualan'); //load mode M_detail_penjualan
		$this->load->helper('tanggal'); //load helper tanggal
		$this->data['aktif'] = 'penjualan'; //mendeklarasikan yang aktif yaitu penjualan
	}

	public function index()
	{
		$this->data['title'] = 'Data Penjualan';
		//mengambil data penjualan dari method lihat dalam model M_penjualan
		$this->data['all_penjualan'] = $this->M_penjualan->lihat();
		//load view ke halaman penjualan/lihat
		$this->load->view('penjualan/lihat', $this->data);
	}

	public function tambah() //method tambah
	{
		$this->data['title'] = 'Tambah Penjualan';
		//mengambil data barang dari method lihat_stok dalam model M_barang
		$this->data['all_barang'] = $this->M_barang->lihat_stok();
		//load view halaman penjualan/tambah
		$this->load->view('penjualan/tambah', $this->data);
	}

	public function proses_tambah() //proses tambah
	{
		$jumlah_barang_dibeli = count($this->input->post('nama_barang_hidden'));

		$data_penjualan = [
			'no_penjualan' => $this->input->post('no_penjualan'),
			'nama_kasir' => $this->input->post('nama_kasir'),
			'tgl_penjualan' => $this->input->post('tgl_penjualan'),
			'jam_penjualan' => $this->input->post('jam_penjualan'),
			'total' => $this->input->post('total_hidden'),
		];

		$data_detail_penjualan = [];

		for ($i = 0; $i < $jumlah_barang_dibeli; $i++) {
			array_push($data_detail_penjualan, ['nama_barang' => $this->input->post('nama_barang_hidden')[$i]]);
			$data_detail_penjualan[$i]['no_penjualan'] = $this->input->post('no_penjualan');
			$data_detail_penjualan[$i]['harga_barang'] = $this->input->post('harga_barang_hidden')[$i];
			$data_detail_penjualan[$i]['jumlah_barang'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_penjualan[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
			$data_detail_penjualan[$i]['sub_total'] = $this->input->post('sub_total_hidden')[$i];
		}

		if ($this->M_penjualan->tambah($data_penjualan) && $this->M_detail_penjualan->tambah($data_detail_penjualan)) {
			for ($i = 0; $i < $jumlah_barang_dibeli; $i++) {
				$this->M_barang->min_stok($data_detail_penjualan[$i]['jumlah_barang'], $data_detail_penjualan[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Penjualan</strong> Berhasil Dibuat!');
			redirect('penjualan');
		} else {
			$this->session->set_flashdata('success', 'Invoice <strong>Penjualan</strong> Berhasil Dibuat!');
			redirect('penjualan');
		}
	}

	public function detail($no_penjualan)
	{
		$this->data['title'] = 'Detail Penjualan';
		$this->data['penjualan'] = $this->M_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['all_detail_penjualan'] = $this->M_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['no'] = 1;

		$this->load->view('penjualan/detail', $this->data);
	}

	public function hapus($no_penjualan)
	{
		if ($this->M_penjualan->hapus($no_penjualan) && $this->M_detail_penjualan->hapus($no_penjualan)) {
			$this->session->set_flashdata('success', 'Invoice Penjualan <strong>Berhasil</strong> Dihapus!');
			redirect('penjualan');
		} else {
			$this->session->set_flashdata('error', 'Invoice Penjualan <strong>Gagal</strong> Dihapus!');
			redirect('penjualan');
		}
	}


	public function get_all_barang()
	{
		$data = $this->M_barang->lihat_nama_barang($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function keranjang_barang()
	{
		$this->load->view('penjualan/keranjang');
	}
}
