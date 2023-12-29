<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

class Home extends BaseController
{
    public function index(): string
    {
        $transModel = new TransaksiModel();
        $date = date('Y-m-d');
        $today = $transModel->where('date', $date)->findAll();
        $sales = $transModel->where('date', $date)->countAllResults();
        if ($sales == 0) {
            $sls = $sales;
        } else {
            $sls = $sales - 1;
        }


        $todayRev = 0;
        foreach ($today as $key) {
            $todayRev += $key['total_final'];
        }

        $labelWeek = array();
        $batas = 6;
        $isiWeek = array();
        $salesWeek = array();
        $d = 0;
        while ($batas >= 0) {
            // Buat label dashboard week
            $valWeek = 0;
            array_push($labelWeek, date('Y-m-d', strtotime($batas . ' days ago')));

            // buat dashboard week revenue
            $isi = $transModel->where('date', $labelWeek[$d])->findAll();
            foreach ($isi as $key) {
                $valWeek += $key['total_final'];
            }
            array_push($isiWeek, $valWeek);

            // Buat dashboard week sales
            $dataSalesWeek = $transModel->where('date', $labelWeek[$d])->where('total_final !=', null)->countAllResults();

            array_push($salesWeek, $dataSalesWeek);

            $batas--;
            $d++;
        }

        $data = [
            'todayRev'  => $todayRev,
            'salesToday' => $sls,
            'labelWeek' => $labelWeek,
            'isiWeek'   => $isiWeek,
            'salesWeek' => $salesWeek

        ];
        return view('dashboard', $data);
    }

    public function month()
    {
        $transModel = new TransaksiModel();
        $date = date('Y-m');
        $month = $transModel->like('date', $date)->findAll();
        $sales = $transModel->like('date', $date)->countAllResults();

        if ($sales == 0) {
            $sls = $sales;
        } else {
            $sls = $sales - 1;
        }


        $monthRev = 0;
        foreach ($month as $key) {
            $monthRev += $key['total_final'];
        }

        $bulan_ini = date('Y-m'); // Mendapatkan tahun dan bulan saat ini (misalnya, "2023-10")
        $jumlah_hari = date('t'); // Mendapatkan jumlah hari dalam bulan ini

        $label = array();
        $isiRev = array();
        $salesMonth = array();

        for ($hari = 1; $hari <= $jumlah_hari; $hari++) {
            $tanggal = $bulan_ini . '-' . sprintf('%02d', $hari); // Membuat format "YYYY-MM-DD"
            $label[] = $tanggal;

            // buat dashboard month revenue
            $valMonth = 0;
            $isi = $transModel->where('date', $tanggal)->findAll();
            foreach ($isi as $key) {
                $valMonth += $key['total_final'];
            }
            $isiRev[] = $valMonth;

            // dashboard data sales Month
            $dataSalesMonth = $transModel->where('date', $tanggal)->where('total_final !=', null)->countAllResults();

            $salesMonth[] = $dataSalesMonth;
        }

        $data = [
            'slsMonth'  => $sls,
            'monthRev'  => $monthRev,
            'label'     => $label,
            'isiRev'    => $isiRev,
            'salesMonth' => $salesMonth
        ];
        return view('dashboard', $data);
    }

    public function year()
    {
        $transModel = new TransaksiModel();
        $date = date('Y');
        $year = $transModel->like('date', $date)->findAll();
        $sales = $transModel->like('date', $date)->where('total_final !=', null)->countAllResults();

        $yearRev = 0;
        foreach ($year as $key) {
            $yearRev += $key['total_final'];
        }

        $label = array();
        $isiRev = array();
        $salesYear = array();

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $bulans = $date . '-' . sprintf('%02d', $bulan); // Membuat format "YYYY-MM"
            $label[] = $bulans;

            // buat dashboard month revenue
            $valYear = 0;
            $isi = $transModel->like('date', $bulans)->findAll();
            foreach ($isi as $key) {
                $valYear += $key['total_final'];
            }
            $isiRev[] = $valYear;

            // dashboard data sales Month
            $dataSalesYear = $transModel->like('date', $bulans)->where('total_final !=', null)->countAllResults();

            $salesYear[] = $dataSalesYear;
        }

        $data = [
            'slsYear'  => $sales,
            'yearRev'  => $yearRev,
            'label'     => $label,
            'isiRev'    => $isiRev,
            'salesYear' => $salesYear
        ];

        return view('dashboard', $data);
    }
}
