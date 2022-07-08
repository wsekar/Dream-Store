<?php

class M_kategori extends CI_Model
{
    protected $_table = 'kategori'; //tabel kategori

    public function lihat()
    {
        // mengembalikan nilai yang didapatkan dari tabel kategori 
        // result : berfungsi untuk mengambil semua data hasil query
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function jumlah()
    {
        // variabel query menampung data yang didapatkan dari tabel kategori
        $query = $this->db->get($this->_table);
        $query = $this->db->get($this->_table);
        // mengembalikan nilai dari jumlah rows dalam tabel kategori
        return $query->num_rows();
    }

    public function lihat_id($kode_kategori)
    {
        // row : mengambil satu data dari hasil query
        // datanya berdasarkan kode_kategori dalam tabel kategori
        $query = $this->db->get_where($this->_table, ['kode_kategori' => $kode_kategori]);
        return $query->row();
    }

    public function lihat_nama_kategori($nama_kategori)
    {
        // row : mengambil satu data dari hasil query
        $query = $this->db->select('*'); //select all
        $query = $this->db->where(['nama_kategori' => $nama_kategori]); //keywordnya nama_kategori
        $query = $this->db->get($this->_table); //mendapatkan tabel kategori
        return $query->row();
    }
    public function buatkode()
    {
        $this->db->select('RIGHT(kategori.kode_kategori,6) as kode_kategori', FALSE);
        $this->db->order_by('kode_kategori', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('kategori');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_kategori) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $kodetampil = "KG" . $batas;
        return $kodetampil;
    }
    public function tambah($data)
    {
        // insert/menambahkan ke tabel kategori
        return $this->db->insert($this->_table, $data);
    }
    public function ubah($data, $kode_kategori)
    {
        $query = $this->db->set($data); //set data yang akan diubah
        $query = $this->db->where(['kode_kategori' => $kode_kategori]); //keywordnya di kode_kategori
        $query = $this->db->update($this->_table); //yang diupdate tabel kategori
        return $query;
    }

    public function hapus($kode_kategori)
    {
        // delete/hapus data berdasarkan id
        return $this->db->delete($this->_table, ['kode_kategori' => $kode_kategori]);
    }
}
