<?php

namespace App\Controllers;

use App\Models\DetailTransaksi;
use App\Models\MenuModel;
use App\Models\TransaksiModel;
use CodeIgniter\HTTP\Request;

class Pembayaran extends BaseController
{
    public function index()
    {
        $menu = new MenuModel();
        $transaksi = new TransaksiModel();
        $detailTr = new DetailTransaksi();
        $total = 0;

        $id = $transaksi->selectMax('id_transaksi')->find();
        foreach ($id as $key) {
            $id_tr = $key['id_transaksi'];
        }

        $detail = $detailTr->getDetail($id_tr);

        foreach ($detail as $value) {
            $total += $value['total'];
        }

        $transaksi->update($id_tr, [
            'total'     => $total,

        ]);

        $data = [
            'menu'      => $menu->orderBy('id_menu', 'desc')->findAll(),
            'id_tr'     => $id_tr,
            'detailTr'  => $detail,
            'total'     => $transaksi->where('id_transaksi', $id_tr)->find()
        ];
        return view('pembayaran', $data);
    }

    public function pilih($id)
    {
        $menu = new MenuModel();
        $detailTr = new DetailTransaksi();

        $qty = $this->request->getPost('qty');
        $pilihMenu = $menu->where('id_menu', $id)->find();
        foreach ($pilihMenu as $key) {
            $harga = $key['harga'] * $qty;
        }

        $detailTr->insert([
            'id_trans'      => $this->request->getPost('id_trans'),
            'id_menu_menu'  => $id,
            'qty'           => $qty,
            'total'         => $harga
        ]);

        return redirect()->back();
    }

    public function disc()
    {
        $trans = new TransaksiModel();
        $disc = floatval($this->request->getPost('disc'));
        $total = floatval($this->request->getPost('total'));
        $id = $this->request->getPost('id_trans');

        $hargaTot = $total - ($total * $disc / 100);

        $trans->update($id, [
            'total_final' => $hargaTot,
            'discount'    => $disc
        ]);
        return redirect()->back();
    }


    public function bayar()
    {

        function uang($angka)
        {
            if ($angka != null) {
                $hasil_rupiah = number_format($angka, 0, '', '.');
                return $hasil_rupiah;
            }
        }
        $transaksi = new TransaksiModel();

        $id = $this->request->getPost('id_trans');
        $total = floatval($this->request->getPost('total'));
        $total_final = floatval($this->request->getPost('total_final'));
        $bayar = floatval($this->request->getPost('bayar'));

        if ($total_final == null) {
            $kembalian = $bayar - $total;
            $transaksi->update($id, [
                'total_final'   => $total,
                'date'  => $this->request->getPost('date')
            ]);
        } else {
            $kembalian = $bayar - $total_final;
        }

        $transaksi->insert([
            'total' => 0,
            'date'  => $this->request->getPost('date')
        ]);

        return redirect()->back()->with('bayar', 'Kembalian : ' . uang($kembalian));
    }

    public function hapus($id)
    {
        $detailTr = new DetailTransaksi();
        $detailTr->delete($id);
        return redirect()->back();
    }
}
