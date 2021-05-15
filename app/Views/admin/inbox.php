<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Inbox Data Pallet</h1>

    <!-- Notifikasi Inbox-->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-delay="100000">
        <div class="toast-body">
            Masuk Palet dari Site WH-PUMA dengan jumlah 50
            <div class="mt-2 pt-2 border-top">
                <button type="button" class="btn btn-primary btn-sm">Take action</button>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-decline="toast">Decline</button>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>