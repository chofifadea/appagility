<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Inbox Data Pallet</h1>

    <div style="" class="row">
        <?php foreach($rows as $row): ?>
            <!-- Notifikasi Inbox-->
            <div class="col-12 col-xl-3 col-lg-4 col-md-6 mb-10" style="margin-bottom: 1rem;">
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-delay="100000">
                    <div class="toast-body">
                        <div style="min-height: 70px;">
                            Masuk Palet dari Site <b><?= $row['nama_wh_tujuan'] ?></b> 
                            <?= $is_superadmin ? 'ke Site <b>' . $row['nama_wh_asal'] . '</b>': '' ?> 
                            dengan jumlah <?= $row['quantity'] ?>
                            
                        </div>
                        <small><?= date('d M Y H:i', strtotime($row['created_at'])) ?></small>
                        <div class="mt-2 pt-2 border-top">
                            <button type="button" class="btn btn-primary btn-sm">Take action</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-decline="toast">Decline</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    
</div>


<?= $this->endSection(); ?>