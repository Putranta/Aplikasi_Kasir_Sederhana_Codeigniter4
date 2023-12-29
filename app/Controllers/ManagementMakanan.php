<?php

namespace App\Controllers;

use App\Models\MenuModel;

class ManagementMakanan extends BaseController
{
    public function index(): string
    {
        $menu = new MenuModel();
        $data = [
            'menu'      => $menu->orderBy('id_menu', 'desc')->findAll(),
            'makanan'   => $menu->where('jenis', 1)->orderBy('id_menu', 'desc')->findAll(),
            'minuman'   => $menu->where('jenis', 2)->orderBy('id_menu', 'desc')->findAll(),
        ];
        return view('managementmakanan', $data);
    }
    public function create()
    {
        $menu = new MenuModel();
        $gambar = $this->request->getFile('img');
        $rules = $this->validate([
            'img' => 'uploaded[img]'
        ]);

        if (!$rules) {
            $namaGambar = '';
        } else {
            $namaGambar = $gambar->getRandomName();
            $gambar->move("img/", $namaGambar);
        }

        $menu->insert([
            'nama_menu' => $this->request->getPost('nama_menu'),
            'jenis' => $this->request->getPost('jenis'),
            'harga' => $this->request->getPost('harga'),
            'img' => $namaGambar,
        ]);

        return redirect()->back()->with('success', 'Daftar Menu Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $menu = new MenuModel();
        $gambar = $this->request->getFile('img');
        $oldImg = $this->request->getPost('oldImg');
        $rules = $this->validate([
            'img' => 'uploaded[img]'
        ]);

        if (!$rules) {
            $namaGambar = $oldImg;
        } else {
            $namaGambar = $gambar->getRandomName();
            $gambar->move("img/", $namaGambar);

            if ($oldImg != "") {
                unlink("img/" . $oldImg);
            }
        }

        $menu->update($id, [
            'nama_menu' => $this->request->getPost('nama_menu'),
            'jenis' => $this->request->getPost('jenis'),
            'harga' => $this->request->getPost('harga'),
            'img' => $namaGambar,
        ]);

        return redirect()->back()->with('success', 'Daftar Menu Berhasil Diupdate');
    }

    public function hapus($id)
    {
        $menu = new MenuModel();
        $oldImg = $this->request->getPost('oldImg');
        if ($oldImg != "") {
            unlink("img/" . $oldImg);
        }
        $menu->delete($id);
        return redirect()->back()->with('success', 'Daftar Menu Berhasil Dihapus');
    }
}
