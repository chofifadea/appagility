<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Output Data Pallet</h1>

    <!-- DataTales Example -->
    <form class="row g-3" action="/transactions/save" method="post">
        <?= csrf_field(); ?>
        <div class="col-md-6">
            <label for="pallet_name" class="form-label">Nama Pallet</label>
            <input type="text" class="form-control" id="pallet_name" name="pallet_name" autofocus>
        </div>
        <div class="col-md-6">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="quantity" name="quantity">
        </div>
        <div class="col-12">
            <label for="site" class="form-label">Tujuan</label>
            <input type="text" class="form-control" id="site" placeholder="Site" name="site">
        </div>
        <div class="col-12">
            <label for="information" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="information" placeholder="" name="information">
        </div>
        <div class="col-md-6">
            <label for="created_at" class="form-label">Date</label>
            <input type="text" class="form-control" id="created_at" name="date">
        </div>
        <!-- <div class="col-md-4">
            <label for="inputVendor" class="form-label">Vendor</label>
            <select class="form-select" id="autoSizingSelect">
                <option selected>Choose...</option>
                <option value="1">MSP</option>
                <option value="2">JPS</option>
                <option value="3">MBP</option>
                <option value="3">MAA</option>
            </select>
        </div> -->
        <select class="form-control col-md-4 mt-4">
            <option selected>Choose</option>
            <option value="1">MSP</option>
            <option value="2">JPS</option>
            <option value="3">MBP</option>
            <option value="3">MAA</option>
        </select>

        <!-- <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Check me out
                </label>
            </div>
        </div> -->

        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-3">Lanjut</button>
        </div>
    </form>
</div>


<?= $this->endSection(); ?>