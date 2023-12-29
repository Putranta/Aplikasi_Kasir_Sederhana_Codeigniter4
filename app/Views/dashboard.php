<?= $this->extend('layout/index') ?>
<?= $this->section('content') ?>
<main id="main" class="main">
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
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card info-card sales-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="<?= base_url() ?>/Dashboard">Today</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url() ?>/Dashboard-month">This Month</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url() ?>/Dashboard-year">This Year</a></li>
                                </ul>
                            </div>
                            <!-- sales Today -->
                            <?php if (current_url() == base_url('Dashboard') or current_url() == base_url('/')) : ?>
                                <div class="card-body">
                                    <h5 class="card-title">Sales <span>| Today</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $salesToday ?> Transaksi</h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- sales Bulan ini -->
                            <?php if (current_url() == base_url('Dashboard-month')) : ?>
                                <div class="card-body">
                                    <h5 class="card-title">Sales <span>| This Month</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $slsMonth ?> Transaksi</h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- sales year -->
                            <?php if (current_url() == base_url('Dashboard-year')) : ?>
                                <div class="card-body">
                                    <h5 class="card-title">Sales <span>| This Year</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= $slsYear ?> Transaksi</h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Revenue Card -->
                    <div class="col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="<?= base_url() ?>/Dashboard">Today</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url() ?>/Dashboard-month">This Month</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url() ?>/Dashboard-year">This Year</a></li>
                                </ul>
                            </div>
                            <!-- Revenue Today -->
                            <?php if (current_url() == base_url('Dashboard') or current_url() == base_url('/')) : ?>
                                <div class="card-body">
                                    <h5 class="card-title">Revenue <span>| Today</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= rupiah($todayRev) ?></h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>

                            <!-- Revenue This month -->
                            <?php if (current_url() == base_url('Dashboard-month')) : ?>
                                <div class="card-body">
                                    <h5 class="card-title">Revenue <span>| This Month</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= rupiah($monthRev) ?></h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>


                            <!-- Revenue This Year -->
                            <?php if (current_url() == base_url('Dashboard-year')) : ?>
                                <div class="card-body">
                                    <h5 class="card-title">Revenue <span>| This Year</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?= rupiah($yearRev) ?></h6>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div><!-- End Revenue Card -->

                <!-- Reports -->
                <div class="col-12">
                    <div class="card">

                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>

                                <li><a class="dropdown-item" href="<?= base_url() ?>/Dashboard">This Week</a></li>
                                <li><a class="dropdown-item" href="<?= base_url() ?>/Dashboard-month">This Month</a></li>
                                <li><a class="dropdown-item" href="<?= base_url() ?>/Dashboard-year">This Year</a></li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <!-- Chart Week -->
                            <?php if (current_url() == base_url('Dashboard') or current_url() == base_url('/')) : ?>
                                <h5 class="card-title">Reports <span>/This Week</span></h5>
                                <div id="reportsChart"></div>
                            <?php endif ?>

                            <!-- Chart month -->
                            <?php if (current_url() == base_url('Dashboard-month')) : ?>
                                <h5 class="card-title">Reports <span>/This Month</span></h5>
                                <div id="reportsMonth"></div>
                            <?php endif ?>

                            <!-- Chart Year -->
                            <?php if (current_url() == base_url('Dashboard-year')) : ?>
                                <h5 class="card-title">Reports <span>/This Year</span></h5>
                                <div id="reportsYear"></div>
                            <?php endif ?>
                        </div>
                    </div>
                </div><!-- End Reports -->
            </div>
        </div><!-- End Left side columns -->

    </section>
</main><!-- End #main -->
<?= $this->endSection(); ?>

<?= $this->section('script') ?>
<?php if (current_url() == base_url('Dashboard') or current_url() == base_url('/')) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#reportsChart"), {
                series: [{
                    name: 'Sales',
                    data: [
                        <?php $c = 0;
                        while ($c <= 6) { ?>
                            <?= $salesWeek[$c]; ?>,
                            <?php $c++ ?>
                        <?php    } ?>
                    ],
                }, {
                    name: 'Revenue',
                    data: [
                        <?php $b = 0;
                        while ($b <= 6) { ?>
                            <?= $isiWeek[$b]; ?>,
                            <?php $b++ ?>
                        <?php    } ?>
                    ]
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                markers: {
                    size: 4
                },
                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    type: 'datetime',
                    categories: [
                        <?php $a = 6;
                        while ($a >= 0) { ?> '<?= date('Y-m-d', strtotime($a . ' days ago')) ?>',
                        <?php $a--;
                        } ?>
                    ]
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy'
                    },
                }
            }).render();
        });
    </script>
<?php endif; ?>

<?php if (current_url() == base_url('Dashboard-month')) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#reportsMonth"), {
                series: [{
                    name: 'Sales',
                    data: [
                        <?php foreach ($salesMonth as $slsMonth) : ?> <?= $slsMonth ?>,
                        <?php endforeach ?>
                    ],
                }, {
                    name: 'Revenue',
                    data: [
                        <?php foreach ($isiRev as $isi) : ?> <?= $isi ?>,
                        <?php endforeach ?>
                    ]
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                markers: {
                    size: 4
                },
                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    type: 'datetime',
                    categories: [
                        <?php foreach ($label as $tanggal) : ?> '<?= $tanggal ?>',
                        <?php endforeach ?>
                    ]
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy'
                    },
                }
            }).render();
        });
    </script>
<?php endif; ?>

<?php if (current_url() == base_url('Dashboard-year')) : ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#reportsYear"), {
                series: [{
                    name: 'Sales',
                    data: [
                        <?php foreach ($salesYear as $slsYear) : ?> <?= $slsYear ?>,
                        <?php endforeach ?>
                    ],
                }, {
                    name: 'Revenue',
                    data: [
                        <?php foreach ($isiRev as $isi) : ?> <?= $isi ?>,
                        <?php endforeach ?>
                    ]
                }],
                chart: {
                    height: 350,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                },
                markers: {
                    size: 4
                },
                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                xaxis: {
                    type: 'datetime',
                    categories: [
                        <?php foreach ($label as $bln) : ?> '<?= $bln ?>',
                        <?php endforeach ?>
                    ]
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy'
                    },
                }
            }).render();
        });
    </script>
<?php endif; ?>
<?= $this->endSection() ?>