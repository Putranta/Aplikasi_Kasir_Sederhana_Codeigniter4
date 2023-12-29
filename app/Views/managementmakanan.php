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
        <h1>Management Makanan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Management Makanan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#managementmodal"><i class="
            bi bi-plus-lg"></i>
        </button>
        <div class="card-body">
            <h5 class="card-title">Menu <span>|Makan & Minum</span></h5>

            <!-- Default Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">Semua</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="false">Makanan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                        type="button" role="tab" aria-controls="contact" aria-selected="false">Minuman</button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 7%;">No</th>
                                <th scope="col" style="width: 18%;">Foto</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($menu as $data) : ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td>
                                    <img src="<?= base_url() ?>/img/<?= $data['img'] ?>" width="100px" alt="">
                                </td>
                                <td><?= $data['nama_menu'] ?></td>
                                <td><?= uang($data['harga']) ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#edit<?= $data['id_menu'] ?>"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus<?= $data['id_menu'] ?>"><i
                                            class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                    </table>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 7%;">No</th>
                                <th scope="col" style="width: 18%;">Foto</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($makanan as $data) : ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td>
                                    <img src="<?= base_url() ?>/img/<?= $data['img'] ?>" width="100px" alt="">
                                </td>
                                <td><?= $data['nama_menu'] ?></td>
                                <td><?= uang($data['harga']) ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#edit<?= $data['id_menu'] ?>"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus<?= $data['id_menu'] ?>"><i
                                            class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                    </table>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 7%;">No</th>
                                <th scope="col" style="width: 18%;">Foto</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($minuman as $data) : ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td>
                                    <img src="<?= base_url() ?>/img/<?= $data['img'] ?>" width="100px" alt="">
                                </td>
                                <td><?= $data['nama_menu'] ?></td>
                                <td><?= uang($data['harga']) ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#edit<?= $data['id_menu'] ?>"><i
                                            class="bi bi-pencil-square"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus<?= $data['id_menu'] ?>"><i
                                            class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                    </table>
                </div>
            </div><!-- End Default Tabs -->

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="managementmodal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url() ?>/menu/create" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Management Makanan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_menu" id="inputText" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="img" id="inputGroupFile02">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Jenis</label>
                            <div class="col-sm-10">
                                <select id="inputState" name="jenis" class="form-select" required>
                                    <option selected value="1">Makanan</option>
                                    <option value="2">Minuman</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form><!-- End Horizontal Form -->
            </div>
        </div>
    </div>

</main>

<?php foreach ($menu as $opsi) : ?>
<!-- Modal Edit -->
<div class="modal fade" id="edit<?= $opsi['id_menu'] ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url() ?>/menu/edit/<?= $opsi['id_menu'] ?>" method="post"
                enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="oldImg" value="<?= $opsi['img'] ?>">
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama_menu" id="inputText" required
                                value="<?= $opsi['nama_menu'] ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="img" id="inputGroupFile02">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Jenis</label>
                        <div class="col-sm-10">
                            <select id="inputState" name="jenis" class="form-select" required>
                                <?php if ($opsi['jenis'] == 1) { ?>
                                <option selected value="1">Makanan</option>
                                <option value="2">Minuman</option>
                                <?php   } else { ?>
                                <option selected value="2">Minuman</option>
                                <option value="1">Makanan</option>
                                <?php  }   ?>

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" name="harga" value="<?= $opsi['harga'] ?>" class="form-control"
                                required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form><!-- End Horizontal Form -->
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="hapus<?= $opsi['id_menu'] ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url() ?>/menu/hapus/<?= $opsi['id_menu'] ?>" method="post"
                enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="oldImg" value="<?= $opsi['img'] ?>">
                    Hapus menu <strong><?= $opsi['nama_menu'] ?></strong>?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form><!-- End Horizontal Form -->
        </div>
    </div>
</div>
<?php endforeach; ?>

<?= $this->endSection(); ?>


<?= $this->Section('script'); ?>

<?= $this->endSection(); ?>