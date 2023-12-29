<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksi extends Model
{
    protected $table            = 'detail_transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['id_trans', 'id_menu_menu', 'qty', 'total'];

    public function getDetail($id_tr)
    {
        return $this->db->table('detail_transaksi')
            ->select('detail_transaksi.*, menu.nama_menu, menu.harga') // Pilih kolom yang Anda butuhkan
            ->join('menu', 'detail_transaksi.id_menu_menu = menu.id_menu', 'left')
            ->where('id_trans', $id_tr)
            ->get()
            ->getResultArray();
    }

    public function getAll()
    {
        return $this->db->table('detail_transaksi')
            ->join('menu', 'detail_transaksi.id_menu_menu = menu.id_menu', 'left')
            ->join('transaksi', 'detail_transaksi.id_trans = transaksi.id_transaksi', 'left')
            ->get()
            ->getResultArray();
    }
}
