<?php

class M_pengguna extends CI_Model
{
	protected $_table = 'pengguna'; //tabel pengguna

	public function lihat() //method lihat
	{
		// mengembalikan nilai yang didapatkan dari tabel pengguna
		// result : berfungsi untuk mengambil semua data hasil query
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah() //method jumlah
	{
		// variabel query menampung data yang didapatkan dari tabel pengguna
		$query = $this->db->get($this->_table);
		// mengembalikan nilai dari jumlah rows dalam tabel pengguna
		return $query->num_rows();
	}

	public function lihat_id($id) //lihat id
	{
		// row : mengambil satu data dari hasil query
		// datanya berdasarkan id dalam tabel pengguna
		$query = $this->db->get_where($this->_table, ['id' => $id]);
		return $query->row();
	}

	public function lihat_username($username_pengguna) //lihat username
	{
		// row : mengambil satu data dari hasil query
		// datanya berdasarkan username_pengguna dalam tabel pengguna
		$query = $this->db->get_where($this->_table, ['username_pengguna' => $username_pengguna]);
		return $query->row();
	}
	public function buatkode()
	{
		$this->db->select('RIGHT(pengguna.kode_pengguna,2) as kode_pengguna', FALSE);
		$this->db->order_by('kode_pengguna', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('pengguna');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode_pengguna) + 1;
		} else {
			$kode = 1;
		}
		$batas = str_pad($kode, 2, "0", STR_PAD_LEFT);
		$kodetampil = "ADMIN-" . $batas;
		return $kodetampil;
	}
	public function tambah($data)
	{
		// insert/menambahkan ke tabel penjualan
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id)
	{
		$query = $this->db->set($data); //set data yang akan diubah
		$query = $this->db->where(['id' => $id]); //keywordnya di idnya
		$query = $this->db->update($this->_table); //yang diupdate tabel pengguna
		return $query;
	}

	public function hapus($id)
	{
		// delete/hapus data berdasarkan id
		return $this->db->delete($this->_table, ['id' => $id]);
	}
}
