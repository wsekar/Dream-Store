<?php


class Barang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'barang';
		$this->load->model('M_barang');
		$this->load->library('upload');
	}

	public function index()
	{
		$this->data['title'] = 'Data Barang';
		$this->data['all_barang'] = $this->M_barang->lihat();
		$this->data['no'] = 1;

		$this->load->view('barang/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Tambah Barang';

		$this->load->view('barang/tambah', $this->data);
	}

	public function proses_tambah()
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}
		if ($this->input->method() === 'post') {
			$kode_barang = $this->input->post('kode_barang', TRUE);
			$nama_barang = $this->input->post('nama_barang', TRUE);
			$foto_barang = $this->input->post('foto_barang', TRUE);
			$harga_jual = $this->input->post('harga_jual', TRUE);
			$stok = $this->input->post('stok', TRUE);
			$satuan = $this->input->post('satuan', TRUE);
			$deskripsi = $this->input->post('deskripsi', TRUE);
			$config['upload_path']          = './assets/images/'; //tempat penyimpanan
			$config['allowed_types']        = 'jpeg|jpg|png|PNG'; //tipe yang ingin diinsert
			$config['max_size']             = 10000; //ukuran file maksimal
			$config['max_width']            = 10000; //lebar maksimal
			$config['max_height']           = 10000; //tinggi maksimal
			$config['file_name'] = $_FILES['foto_barang']['name'];
			$this->upload->initialize($config);
			if (!empty($_FILES['foto_barang']['name'])) {
				if ($this->upload->do_upload('foto_barang')) {
					$foto_barang = $this->upload->data();
					$data = array(
						'foto_barang' => $foto_barang['file_name'],
						'kode_barang' => $kode_barang,
						'nama_barang' => $nama_barang,
						'harga_jual' => $harga_jual,
						'stok' => $stok,
						'satuan' => $satuan,
						'deskripsi' => $deskripsi,
					);

					if ($this->M_barang->tambah($data)) {
						$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Ditambahkan!');
						redirect('barang');
					} else {
						$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Ditambahkan!');
						redirect('barang');
					}
				}
			}
		}
	}


	public function ubah($kode_barang)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}

		$this->data['title'] = 'Ubah Barang';
		$this->data['barang'] = $this->M_barang->lihat_id($kode_barang);

		$this->load->view('barang/ubah', $this->data);
	}

	public function proses_ubah()
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('penjualan');
		}


		$kode_barang  = $this->input->post('kode_barang');
		$nama_barang = $this->input->post('nama_barang');
		$harga_jual = $this->input->post('harga_jual');
		$stok = $this->input->post('stok');
		$satuan = $this->input->post('satuan');
		$deskripsi = $this->input->post('deskripsi');

		$path = './assets/images';

		$kondisi = array('kode_barang' => $kode_barang);
		// get foto
		$config['upload_path'] = './assets/images';
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$config['max_size'] = '2048';  //2MB max
		$config['max_width'] = '4480'; // pixel
		$config['max_height'] = '4480'; // pixel
		$config['file_name'] = $_FILES['foto_barang']['name'];

		$this->upload->initialize($config);
		if (!empty($_FILES['foto_barang']['name'])) {
			if ($this->upload->do_upload('foto_barang')) {
				$foto_barang = $this->upload->data();
				$data = array(
					'foto_barang' => $foto_barang['file_name'],
					'nama_barang' => $nama_barang,
					'harga_jual' => $harga_jual,
					'stok' => $stok,
					'satuan' => $satuan,
					'deskripsi' => $deskripsi,
				);
				// hapus foto pada direktori
				@unlink($path . $this->input->post('foto_lama'));

				$this->M_barang->ubah($data, $kondisi);
				$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
				redirect('barang');
			} else {
				$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Dihapus!');
				redirect('barang');
			}
		} else {
			$nama_barang = $this->input->post('nama_barang', TRUE);
			$harga_jual = $this->input->post('harga_jual', TRUE);
			$stok = $this->input->post('stok', TRUE);
			$satuan = $this->input->post('satuan', TRUE);
			$deskripsi = $this->input->post('deskripsi', TRUE);
			$data = array(
				'nama_barang' => $nama_barang,
				'harga_jual' => $harga_jual,
				'stok' => $stok,
				'satuan' => $satuan,
				'deskripsi' => $deskripsi,
			);
			@unlink($path . $this->input->post('foto_lama'));

			$this->M_barang->ubah($data, $kondisi);
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Diubah!');
			redirect('barang');
		}
	}

	public function hapus($kode_barang)
	{
		if ($this->session->login['role'] == 'kasir') {
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('penjualan');
		}

		if ($this->M_barang->hapus($kode_barang)) {
			$this->session->set_flashdata('success', 'Data Barang <strong>Berhasil</strong> Dihapus!');
			redirect('barang');
		} else {
			$this->session->set_flashdata('error', 'Data Barang <strong>Gagal</strong> Dihapus!');
			redirect('barang');
		}
	}
}
