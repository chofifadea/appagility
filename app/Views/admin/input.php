<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Data Pallet</h1>

    <!-- DataTales Example -->
    <form class="row g-3">
        <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Nama Pallet</label>
            <input type="email" class="form-control" id="inputEmail4">
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Jumlah</label>
            <input type="password" class="form-control" id="inputPassword4">
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Tujuan</label>
            <input type="text" class="form-control" id="inputAddress">
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Site">
        </div>
        <div class="col-md-6">
            <label for="inputCity" class="form-label">Date</label>
            <input type="text" class="form-control" id="inputCity">
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">Vendor</label>
            <select class="form-select" id="autoSizingSelect">
                <option selected>Choose...</option>
                <option value="1">MSP</option>
                <option value="2">JPS</option>
                <option value="3">MAA</option>
                <option value="3">MBP</option>
            </select>
        </div>

        <div class="col-12">
            <!-- <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Check me out
                </label>
            </div> -->
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-3">Input</button>
        </div>
    </form>
</div>


<?= $this->endSection(); ?>