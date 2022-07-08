<?php

class Kasir extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//pengambiilan data user login sesuai dengan rolenya
		if ($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'kasir';
		$this->load->model('M_kasir'); //load model M_kasir
	}

	public function index()
	{
		$this->data['title'] = 'Data Kasir'; //buat judul
		$this->data['all_kasir'] = $this->M_kasir->lihat(); //mengambil data kasir dari method lihat dalam model M_kasir
		$this->data['no'] = 1;

		$this->load->view('kasir/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'kasir') { //jika login sebagai kasir
			//tidak dapat menambahkan data kasir
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan'); //redirect ke penjualan
		}

		$this->data['title'] = 'Tambah Kasir';
		//load view halaman kasir/tambah
		$this->load->view('kasir/tambah', $this->data);
	}

	public function proses_tambah()
	{
		if ($this->session->login['role'] == 'kasir') { //jika login sebagai kasir
			//tidak dapat menambahkan data kasir dan akan redirect ke penjualan
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [ //variabel data menampung array berikut
			'kode_kasir' => $this->input->post('kode_kasir'),
			'nama_kasir' => $this->input->post('nama_kasir'),
			'username_kasir' => $this->input->post('username_kasir'),
			'password_kasir' => $this->input->post('password_kasir'),
			'email_kasir' => $this->input->post('email_kasir'),
			'jenis_kelamin_kasir' => $this->input->post('jenis_kelamin_kasir'),
		];

		if ($this->M_kasir->tambah($data)) { //benar mengambil method tambah pada model M_kasir
			//membuat session flashdata/notifikasi bahwa data berhasil ditambah
			$this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Ditambahkan!');
			// redirect ke kasir
			redirect('kasir');
		} else {
			//membuat session flashdata/notifikasi bahwa data gagal ditambah
			$this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Ditambahkan!');
			// redirect ke kasir
			redirect('kasir');
		}
	}

	public function ubah($id)
	{
		if ($this->session->login['role'] == 'kasir') {
			//jika login sebagai kasir
			//tidak dapat mengubah data kasir dan akan redirect ke penjualan
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Ubah Kasir';
		$this->data['kasir'] = $this->M_kasir->lihat_id($id);

		$this->load->view('kasir/ubah', $this->data);
	}

	public function proses_ubah($id)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [
			'kode_kasir' => $this->input->post('kode_kasir'),
			'nama_kasir' => $this->input->post('nama_kasir'),
			'username_kasir' => $this->input->post('username_kasir'),
			'password_kasir' => $this->input->post('password_kasir'),
			'email_kasir' => $this->input->post('email_kasir'),
			'jenis_kelamin_kasir' => $this->input->post('jenis_kelamin_kasir'),
		];

		if ($this->M_kasir->ubah($data, $id)) {
			$this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Diubah!');
			redirect('kasir');
		} else {
			$this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Diubah!');
			redirect('kasir');
		}
	}

	public function hapus($id)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('penjualan');
		}

		if ($this->M_kasir->hapus($id)) {
			$this->session->set_flashdata('success', 'Data Kasir <strong>Berhasil</strong> Dihapus!');
			redirect('kasir');
		} else {
			$this->session->set_flashdata('error', 'Data Kasir <strong>Gagal</strong> Dihapus!');
			redirect('kasir');
		}
	}
}
