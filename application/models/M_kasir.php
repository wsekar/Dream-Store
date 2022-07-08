<?php

class M_kasir extends CI_Model
{
	protected $_table = 'kasir'; //tabel kasir

	public function lihat()
	{
		// mengembalikan nilai yang didapatkan dari tabel kasir
		// result : berfungsi untuk mengambil semua data hasil query
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah()
	{
		// variabel query menampung data yang didapatkan dari tabel kasir
		$query = $this->db->get($this->_table);
		// mengembalikan nilai dari jumlah rows dalam tabel kasir
		return $query->num_rows();
	}

	public function lihat_id($id)
	{
		// row : mengambil satu data dari hasil query
		// datanya berdasarkan id dalam tabel kasir
		$query = $this->db->get_where($this->_table, ['id' => $id]);
		return $query->row();
	}

	public function lihat_username($username_kasir)
	{
		// row : mengambil satu data dari hasil query
		// datanya berdasarkan username_pengguna dalam tabel kasir
		$query = $this->db->get_where($this->_table, ['username_kasir' => $username_kasir]);
		return $query->row();
	}
	public function buatkode()
	{
		$this->db->select('RIGHT(kasir.kode_kasir,2) as kode_kasir', FALSE);
		$this->db->order_by('kode_kasir', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('kasir');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode_kasir) + 1;
		} else {
			$kode = 1;
		}
		$batas = str_pad($kode, 2, "0", STR_PAD_LEFT);
		$kodetampil = "KASIR-" . $batas;
		return $kodetampil;
	}
	public function tambah($data)
	{
		// insert/menambahkan ke tabel kasir
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id)
	{
		$query = $this->db->set($data); //set data yang akan diubah
		$query = $this->db->where(['id' => $id]); //keywordnya di idnya
		$query = $this->db->update($this->_table); //yang diupdate tabel kasir
		return $query;
	}

	public function hapus($id)
	{
		// delete/hapus data berdasarkan id
		return $this->db->delete($this->_table, ['id' => $id]);
	}
}
