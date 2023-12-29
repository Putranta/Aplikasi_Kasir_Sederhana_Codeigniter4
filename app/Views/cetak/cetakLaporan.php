<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=<?= base_url("fontawesome-free/css/all.min.css") ?>>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <style>
        p,
        span,
        table {
            font-size: 12px
        }

        table {
            width: 100%;
            border: 1px solid #dee2e6;
        }

        table#tb-item tr th,
        table#tb-item tr td {
            border: 1px solid #000
        }
    </style>
</head>

<body>
    <?php
    function rupiah($angka)
    {
        if ($angka != null) {
            $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
            return $hasil_rupiah;
        }
    }
    function uang($angka)
    {
        if ($angka != null) {
            $hasil_rupiah = number_format($angka, 0, '', '.');
            return $hasil_rupiah;
        }
    }
    date_default_timezone_set('Asia/Jakarta');
    ?>

    <?php if ($tglAwal == null) { ?>
        <h4 style="text-align: center;">Laporan Keuangan</h4>
    <?php } else { ?>
        <h4 style="text-align: center;">Laporan Keuangan Tgl <?= date('d M Y', strtotime($tglAwal)) ?> s/d
            <?= date('d M Y', strtotime($tglAkhir)) ?></h4>
    <?php } ?>

    <table style="text-align: center;" id="tb-item" cellpadding="4">

        <tr style="background-color:#a9a9a9">
            <th width="5%">No</th>
            <th width="20%">No trans</th>
            <th width="35%">Tanggal</th>
            <th width="40%">Harga</th>
        </tr>

        <?php
        $no = 1;
        $total = 0;
        ?>
        <?php foreach ($laporan as $dat) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <?= $dat['id_transaksi'] ?>
                </td>
                <td>
                    <?= date('d M Y', strtotime($dat['date'])) ?>
                </td>
                <td>
                    <?= uang($dat['total_final']) ?>
                    <?php $total += $dat['total_final'] ?>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
    <p></p>
    <table id="tb-tot" cellpadding="4">
        <tr>
            <th width="50%"> </th>
            <th width="23%">Total Pemasukan</th>
            <th width="25%" class="text-center">: <?= rupiah($total) ?></th>
        </tr>
    </table>



    <script src=<?= base_url("js/jquery.min.js") ?>></script>
    <!-- Bootstrap 4 -->
    <script src=<?= base_url("js/bootstrap.bundle.min.js") ?>></script>
    <!-- AdminLTE App -->
    <script src=<?= base_url("js/adminlte.min.js") ?>></script>
    <!-- AdminLTE for demo purposes -->
    <script src=<?= base_url("js/demo.js") ?>></script>
    <script src=<?= base_url("js/jquery-ui.min.js") ?>></script>
    <!-- fullCalendar 2.2.5 -->
    <script src=<?= base_url("js/moment.min.js") ?>></script>


    <!-- section javascript custom -->
    <?= $this->renderSection('script'); ?>
</body>

</html>