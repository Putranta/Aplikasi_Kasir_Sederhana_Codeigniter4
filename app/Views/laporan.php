<?= $this->extend('layout/index') ?>
<?= $this->section('content') ?>
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
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Laporan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <form action="<?= base_url() ?>/Laporan" method="post">
        <div class="input-group input-group-sm mb-1 ">
            <div class="input-group mb-1">
                <input type="date" class="form-control" value="<?= $tglAwal ?>" name="TglAwal" required>
                <span class="input-group-text">-</span>
                <input type="date" class="form-control" value="<?= $tglAkhir ?>" name="TglAkhir" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mb-2" style="width: 100%;"><i class="bi bi-funnel"></i>Filter</button>

    </form>

    <form action="<?= base_url() ?>/Laporan/cetak" target=" _blank" method="post">
        <input type="hidden" name="TglAwal" value="<?= $tglAwal ?>">
        <input type="hidden" name="TglAkhir" value="<?= $tglAkhir ?>">
        <input type="submit" value="Print PDF" class="btn btn-primary" style="width: 100%;" data-target="blank"></input>
    </form>

    <div class="card">
        <div class="card-body">

            <h5 class="card-title">Laporan <span>|RM Padang</span></h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Id Trans</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($laporan as $data) : ?>
                        <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $data['id_transaksi'] ?></td>
                            <td><?= $data['date'] ?></td>
                            <td><?= uang($data['total_final']) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>

            </table>
        </div>


    </div>



</main>

<?= $this->endSection(); ?>