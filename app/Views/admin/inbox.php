<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Inbox Data Pallet</h1>

    <div style="" class="row">
        <?php if(count($rows) == 0): ?>
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <p style="font-style: italic; text-align: center;">Tidak ada data</p>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?php foreach($rows as $row): ?>
            <!-- Notifikasi Inbox-->
            <div class="col-12 col-xl-3 col-lg-4 col-md-6 mb-10 inbox-col" style="margin-bottom: 1rem;">
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-delay="100000">
                    <div class="toast-body">
                        <div style="min-height: 70px;">
                            Masuk Palet <b><?= $row['nama_pallet'] ?></b> dari Site <b><?= $row['nama_wh_tujuan'] ?></b> 
                            <?= $is_superadmin ? 'ke Site <b>' . $row['nama_wh_asal'] . '</b>': '' ?> 
                            dengan jumlah <?= $row['quantity'] ?>
                            
                        </div>
                        <small><?= date('d M Y H:i', strtotime($row['created_at'])) ?></small>
                        <div class="mt-2 pt-2 border-top">
                            <button type="button" class="btn btn-primary btn-sm btn-approve" data-id="<?= $row['id'] ?>">Take action</button>
                            <button type="button" class="btn btn-secondary btn-sm btn-reject" data-bs-decline="toast" data-id="<?= $row['id'] ?>">Decline</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    
</div>

<?= $this->endSection(); ?>

<?= $this->section('page_js') ?>
    <script type="text/javascript" src="<?= base_url() ?>/js/page-inbox-1.js?t=11"></script>
<?= $this->endSection() ?>