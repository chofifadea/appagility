<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= empty($page_title) ? 'Transactions' : $page_title ?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaction</h6>
        </div>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pallet Name</th>
                            <th>Information</th>
                            <th>From Site</th>
                            <th>To Site</th>
                            <th>Quantity</th>
                            <th>Transport</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Approved By</th>
                            <th>Approved At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row['nama_pallet'] ?></td>
                                <td><?= $row['information'] ?></td>
                                <td><?= $row['nama_site_asal'] ?></td>
                                <td><?= $row['nama_site_tujuan'] ?></td>
                                <td><?= $row['quantity'] ?></td>
                                <td><?= $row['nama_driver'] . ' - ' . $row['no_plat_mobil'] ?></td>
                                <td><?= $row['nama_creator'] ?></td>
                                <td><?= $row['created_at'] ?></td>
                                <td><?= $row['nama_approver'] ?></td>
                                <td><?= $row['approved_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<?= $this->endSection(); ?>