<?php

class M_penjualan extends CI_Model
{
	protected $_table = 'penjualan'; //tabel penjualan

	public function lihat() //method lihat
	{
		// mengembalikan nilai yang didapatkan dari tabel penjualan 
		// result : berfungsi untuk mengambil semua data hasil query
		return $this->db->get($this->_table)->result();
	}

	public function jumlah() //method jumlah
	{
		// variabel query menampung data yang didapatkan dari tabel penjualan
		$query = $this->db->get($this->_table);
		// mengembalikan nilai dari jumlah rows dalam tabel penjualan
		return $query->num_rows();
	}

	public function lihat_no_penjualan($no_penjualan) //lihat no penjualan
	{
		// row : mengambil satu data dari hasil query
		// datanya berdasarkan no_penjualan dalam tabel penjualan
		return $this->db->get_where($this->_table, ['no_penjualan' => $no_penjualan])->row();
	}
	public function buatkode()
	{
		$this->db->select('RIGHT(penjualan.no_penjualan,6) as no_penjualan', FALSE);
		$this->db->order_by('no_penjualan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('penjualan');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->no_penjualan) + 1;
		} else {
			$kode = 1;
		}
		$batas = str_pad($kode, 6, "0", STR_PAD_LEFT);
		$kodetampil = "PJ" . $batas;
		return $kodetampil;
	}
	public function tambah($data) //method tambah
	{
		// insert/menambahkan ke tabel penjualan
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($no_penjualan) //method hapus
	{
		// delete/hapus data berdasarkan no penjualan
		return $this->db->delete($this->_table, ['no_penjualan' => $no_penjualan]);
	}
}
