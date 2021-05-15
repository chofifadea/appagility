<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Output Data Pallet</h1>
    <!-- DataTales Example -->
    <form action="<?= base_url('transactions-output') ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="row g-3">
            <div class="col-md-10">
                <label for="pallet_name" class="form-label">Nama Pallet</label>
                <input type="text" class="form-control <?= ($validation->hasError('pallet_name')) ? 'is-invalid' : ''; ?>" id="pallet_name" name="pallet_name" autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('pallet_name'); ?>
                </div>
            </div>
            <div class="col-md-10">
                <label for="quantity" class="form-label">Jumlah</label>
                <input type="number" class="form-control <?= ($validation->hasError('quantity')) ? 'is-invalid' : ''; ?>" id="quantity" name="quantity">
                <div class="invalid-feedback">
                    <?= $validation->getError('quantity'); ?>
                </div>
            </div>
            <div class="col-10">
                <label for="site" class="form-label">Tujuan</label>
                <input type="text" class="form-control <?= ($validation->hasError('site')) ? 'is-invalid' : ''; ?>" id="site" placeholder="Site" name="site">
                <div class="invalid-feedback">
                    <?= $validation->getError('site'); ?>
                </div>
            </div>
            <div class="col-10">
                <label for="information" class="form-label">Keterangan</label>
                <input type="text" class="form-control <?= ($validation->hasError('information')) ? 'is-invalid' : ''; ?>" id="information" placeholder="" name="information">
                <div class="invalid-feedback">
                    <?= $validation->getError('information'); ?>
                </div>
            </div>
            <div class="col-10">
                <button type="submit" value="Simpan Data" class="btn btn-primary mt-3">Save Data</button>
            </div>
        </div>
    </form>
    <?= form_close(); ?>
</div>


<?= $this->endSection(); ?>