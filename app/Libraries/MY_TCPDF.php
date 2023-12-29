<?php

namespace App\Libraries;

use TCPDF;

class MY_TCPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        if ($this->page == 1) {
            $this->SetMargins(0, 40, 14);

            // Logo
            $image_file = ROOTPATH . 'public/assets/img/logo.png';

            /**
             * width : 50
             */
            $this->Image($image_file, '', 5, 20);
            // Set font
            $this->SetFont('helvetica', 'B', 14);
            $this->SetX(72);
            $this->Cell(0, 2, "Rumah Makan Padang", 0, 1, '', 0, '', 0);

            // Title
            $this->SetFont('helvetica', '', 10);
            $this->SetX(40);
            $this->Cell(0, 2, 'Alamat : Jl. AMD Rt 005/02 Sasakpanjang Kec. Tajurhalang Kab. Bogor Jawa Barat', 0, 1, '', 0, '', 0);
            $this->SetX(58);
            $this->Cell(0, 2, 'HP. 081281951034  Email : maassaadahm@yahoo.com', 0, 1, '', 0, '', 0);

            // QRCODE,H : QR-CODE Best error correction
            $this->write2DBarcode(base_url(), 'QRCODE,H', 0, 5, 20, 20, ['position' => 'R'], 'N');

            $style = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
            $this->Line(15, 30, 195, 30, 'S');
        }
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        // $this->SetY(-15);
        // Set font
        // $this->SetFont('helvetica', 'I', 8);
        // Page number
        // $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
