<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-8 col-lg-7">

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Controlling PalLet</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                    <hr>

                </div>
            </div>

            <!-- Bar Chart
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>

                </div>
            </div> -->

        </div>

        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Stock Pallet</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <!-- <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> JPS
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> MSP
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> MAA
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-mbp"></i> MBP
                        </span> -->
                        <!-- <?php foreach($pie['labels'] as $k => $v): ?>
                            <span class="mr-2">
                                <i class="fas fa-circle text-mbp"></i> <?= $v ?>
                            </span>
                        <?php endforeach ?> -->
                    </div>
                    <hr>

                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>

<?= $this->section('page_js') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var data_area = <?= json_encode($area) ?>; 
    var data_pie = <?= json_encode($pie) ?>;
</script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>/js/demo/chart-area-demo.js?t=13"></script>
<script src="<?= base_url(); ?>/js/demo/chart-pie-demo.js?t=13"></script>
<!-- <script src="<?= base_url(); ?>/js/demo/chart-bar-demo.js?t=12"></script> -->

<?= $this->endSection() ?>