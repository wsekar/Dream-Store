<?php

class M_toko extends CI_Model
{
	protected $_table = 'data_toko'; //tabel data_toko

	public function lihat() //method lihat
	{
		//mengembalikan nilai dari data tabel data_toko dengan id=1
		// row : mengambil satu data dari hasil query
		return $this->db->get_where($this->_table, ['id' => 1])->row();
	}

	public function ubah($data) //method ubah
	{
		//variabel query menampung data yang dipanggil dari database
		$query = $this->db->set($data); //dari database meng-set variabel data
		$query = $this->db->where(['id' => 1]); //dengan id=1
		$query = $this->db->update($this->_table); //mengupdate isi tabel data_toko
		//mengembalikan nilai dari variabel query
		return $query;
	}
}
