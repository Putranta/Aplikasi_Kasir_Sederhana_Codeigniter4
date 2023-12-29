<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Libraries\MY_TCPDF as TCPDF;

class Laporan extends BaseController
{
    public function index(): string
    {
        $laporan = new TransaksiModel();
        $data = [
            'laporan'   => $laporan->where('total !=', 0)->orderBy('date', 'desc')->findAll(),
            'tglAwal'   => null,
            'tglAkhir'  => null
        ];
        return view('laporan', $data);
    }

    public function filter()
    {
        $transaksi = new TransaksiModel();
        $tglAwal = $this->request->getPost('TglAwal');
        $tglAkhir = $this->request->getPost('TglAkhir');

        $laporan = $transaksi->where('date >=', $tglAwal)->where('date <=', $tglAkhir)->where('total !=', 0)->orderBy('date', 'desc')->findAll();
        $data = [
            'laporan'   => $laporan,
            'tglAwal'   => $tglAwal,
            'tglAkhir'  => $tglAkhir
        ];
        return view('laporan', $data);
    }

    public function cetak()
    {
        $transaksi = new TransaksiModel();
        $tglAwal = $this->request->getPost('TglAwal');
        $tglAkhir = $this->request->getPost('TglAkhir');

        if ($tglAwal == null) {
            $laporan = $transaksi->where('total !=', 0)->orderBy('id_transaksi', 'desc')->findAll();
        } else {
            $laporan = $transaksi->where('date >=', $tglAwal)->where('date <=', $tglAkhir)->where('total !=', 0)->orderBy('id_transaksi', 'desc')->findAll();
        }



        $data = [
            'title'     => 'Laporan Keuangan',
            'laporan'       => $laporan,
            'tglAwal'   => $tglAwal,
            'tglAkhir'  => $tglAkhir,

        ];
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Laporan Keuangan');
        $pdf->SetSubject('');
        $pdf->SetKeywords('');


        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        //view mengarah ke invoice.php
        $html = view('cetak/cetakLaporan', $data);

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------
        $this->response->setContentType('application/pdf');
        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $pdf->Output('Laporan.pdf', 'I');
    }
}
