<?php

class M_barang extends CI_Model
{
    protected $_table = 'barang';

    public function lihat()
    {
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function jumlah()
    {
        $query = $this->db->get($this->_table);
        return $query->num_rows();
    }

    public function lihat_stok()
    {
        $query = $this->db->get_where($this->_table, 'stok > 1');
        return $query->result();
    }

    public function lihat_id($kode_barang)
    {
        $query = $this->db->get_where($this->_table, ['kode_barang' => $kode_barang]);
        return $query->row();
    }

    public function lihat_nama_barang($nama_barang)
    {
        $query = $this->db->select('*');
        $query = $this->db->where(['nama_barang' => $nama_barang]);
        $query = $this->db->get($this->_table);
        return $query->row();
    }
    public function buatkode()
    {
        $this->db->select('RIGHT(barang.kode_barang,6) as kode_barang', FALSE);
        $this->db->order_by('kode_barang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('barang');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_barang) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $kodetampil = "BR" . $batas;
        return $kodetampil;
    }
    public function tambah($data)
    {
        return $this->db->insert($this->_table, $data);
    }

    public function min_stok($stok, $nama_barang)
    {
        $query = $this->db->set('stok', 'stok-' . $stok, false);
        $query = $this->db->where('nama_barang', $nama_barang);
        $query = $this->db->update($this->_table);
        return $query;
    }

    public function ubah($data, $kondisi)
    {
        $this->db->update('barang', $data, $kondisi);
        return TRUE;
    }

    public function hapus($kode_barang)
    {
        return $this->db->delete($this->_table, ['kode_barang' => $kode_barang]);
    }
    public function graph()
    {
        $data = $this->db->query("SELECT nama_barang, stok FROM barang");
        return $data->result();
    }
}
