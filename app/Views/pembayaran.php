<?= $this->extend('layout/index') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

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

<div class="swal2" data-swal="<?= Session('bayar'); ?>"></div>
<main id="main" class="main" style="min-height: 80vh;">
    <div class="pagetitle">
        <h1>Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Pembayaran</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tansaksi <span>|Makan & Minum</span></h5>

                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th class="text-center">Qty</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($menu as $data) : ?>
                                <tr>
                                    <td><?= $data['nama_menu'] ?></td>
                                    <td><?= uang($data['harga']) ?></td>
                                    <form action="<?= base_url() ?>/pembayaran/pilih/<?= $data['id_menu'] ?>" method="post">
                                        <input type="hidden" name="id_trans" value="<?= $id_tr ?>">
                                        <td class="text-center">
                                            <input type="number" name="qty" value="1" required style="width: 60px;">
                                        </td>
                                        <td class="text-center">

                                            <button type="submit" class="btn btn-sm btn-success"><i class="
            bi bi-plus-lg"></i></button>

                                        </td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                    </table>
                </div>
            </div>


        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">No Transaksi <span>| <?= $id_tr ?></span></h5>
                    <div class="activity">
                        <table class="table" style="min-height: 20vh;">
                            <thead>
                                <tr>
                                    <th scope="col">Pesanan</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($detailTr as $data) : ?>
                                    <tr>
                                        <td><?= $data['nama_menu'] ?></td>
                                        <td><?= $data['qty'] ?></td>
                                        <td><?= uang($data['harga']) ?></td>
                                        <td><?= uang($data['total']) ?></td>
                                        <td><a href="<?= base_url() ?>/transaksi/hapus/<?= $data['id'] ?>"><i class="bi bi-trash text-danger"></i></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php foreach ($total as $tot) : ?>
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="row mb-2">
                                        <label class="col-sm-4 col-form-label">SubTotal</label>
                                        <div class="col-sm-8">
                                            <!-- Value yang diganti -->
                                            <input type="text" class="form-control" value="<?= uang($tot['total']) ?>" disabled>
                                        </div>
                                    </div>
                                    <form action="<?= base_url() ?>/disc" method="post">
                                        <div class="row mb-2">

                                            <label class="col-sm-4 col-form-label">Discount (%)</label>
                                            <div class="col-3">
                                                <input type="hidden" name="id_trans" value="<?= $id_tr ?>">
                                                <input type="hidden" name="total" value="<?= $tot['total'] ?>">
                                                <input type="number" name="disc" class="form-control" value="<?= $tot['discount'] ?>" max="100">
                                            </div>
                                            <div class="col-5">
                                                <!-- Value yang diganti -->
                                                <button type="submit" class="btn btn-info">=></button>
                                            </div>

                                        </div>
                                    </form>
                                    <div class="row mb-2">
                                        <label class="col-sm-4 col-form-label">Total Harga</label>
                                        <div class="col-sm-8">
                                            <!-- Value yang diganti -->
                                            <?php if ($tot['total_final'] == null) { ?>
                                                <input type="text" class="form-control" value="<?= rupiah($tot['total']) ?>" disabled>
                                            <?php  } else { ?>
                                                <input type="text" class="form-control" value="<?= rupiah($tot['total_final']) ?>" disabled>
                                            <?php   }     ?>

                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBayar"><i class="ri-money-line"></i> Bayar
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                    </div><!-- End Right side columns -->

                </div>
            </div>
        </div>
    </div>


</main>




<!-- Modal Bayar -->
<div class="modal fade" id="modalBayar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog">
        <form action="<?= base_url() ?>/bayar" method="post">
            <input type="hidden" name="id_trans" value="<?= $id_tr ?>">
            <input type="hidden" name="total" value="<?= $tot['total'] ?>" id="">
            <input type="hidden" name="total_final" value="<?= $tot['total_final'] ?>" id="">
            <input type="date" hidden name="date" value="<?= date('Y-m-d') ?>">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label">Total Harga</label>
                        <div class="col-sm-8">
                            <!-- Value yang diganti -->
                            <!-- Value yang diganti -->
                            <?php if ($tot['total_final'] == null) { ?>
                                <input type="text" class="form-control" value="<?= rupiah($tot['total']) ?>" disabled>

                            <?php  } else { ?>
                                <input type="text" class="form-control" value="<?= rupiah($tot['total_final']) ?>" disabled>

                            <?php   }     ?>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-4 col-form-label">Total Bayar</label>
                        <div class="col-sm-8">
                            <!-- Value yang diganti -->
                            <?php if ($tot['total_final'] == null) { ?>
                                <input type="number" class="form-control" name="bayar" required min="<?= $tot['total'] ?>">
                            <?php  } else { ?>
                                <input type="number" class="form-control" name="bayar" required min="<?= $tot['total_final'] ?>">
                            <?php   }     ?>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('script') ?>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    new DataTable('#example');
</script>

<script>
    const swal2 = $('.swal2').data('swal');
    if (swal2) {
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: '<?= Session('bayar'); ?>',
            showConfirmButton: true,
        })
    }
</script>

<?= $this->endSection() ?>