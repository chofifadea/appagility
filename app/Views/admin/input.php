<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Input Data Pallet</h1>
    <!-- DataTales Example -->
    <form action="<?= base_url() ?>/input" method="POST" id="form-1">
        <?= csrf_field(); ?>
        <div class="row g-3">
            <div class="col-md-10">
                <label for="pallet_name" class="form-label">Nama Pallet</label>
                <!-- <input type="text" class="form-control <?= ($validation->hasError('pallet_name')) ? 'is-invalid' : ''; ?>" id="pallet_name" name="pallet_name" autofocus> -->
                <select class="form-control" id="pallet" name="pallet" style="width: 100%;">
                    <option value="">Pilih Pallet</option>
                    <?php foreach($list_pallet as $item): ?>
                        <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback" for='pallet'>
                    <?= $validation->getError('pallet_name'); ?>
                </div>
            </div>
            <div class="col-md-10">
                <label for="quantity" class="form-label">Jumlah</label>
                <input type="number" class="form-control <?= ($validation->hasError('quantity')) ? 'is-invalid' : ''; ?>" id="quantity" name="quantity" placeholder="Qty Masuk">
                <div class="invalid-feedback" for='quantity'>
                    <?= $validation->getError('quantity'); ?>
                </div>
            </div>
            <div class="col-10">
                <label for="site" class="form-label">Asal</label>
                <select class="form-control" name="from_site" id="from_site" style="width: 100%;" >
                    <option value="">Pilih Site</option>
                    <?php foreach($list_site as $item): ?>
                        <?php if($item['tipe'] == 'vendor'): ?>
                            <option value="<?= $item['id'] ?>" ><?= $item['nama'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback" for='site'>
                    <?= $validation->getError('site'); ?>
                </div>
            </div>
            <div class="col-10">
                <label for="site" class="form-label">Tujuan</label>
                <!-- <input type="text" class="form-control <?= ($validation->hasError('site')) ? 'is-invalid' : ''; ?>" id="site" placeholder="Site" name="site"> -->
                <select class="form-control" name="site" id="site" style="width: 100%;" <?= $sess->data['tipe'] == 'superadmin' ? '' : 'disabled=""' ?>>
                    <option value="">Pilih Site</option>
                    <?php foreach($list_site as $item): ?>
                        <?php if($item['tipe'] == 'warehouse'): ?>
                            <option value="<?= $item['id'] ?>" <?= $sess->data['tipe'] != 'superadmin' && $sess->data['id_site'] == $item['id'] ? 'selected' : '' ?>><?= $item['nama'] ?></option>
                        <?php endif ?>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback" for='site'>
                    <?= $validation->getError('site'); ?>
                </div>
            </div>
            <div class="col-10">
                <label for="information" class="form-label">Nama Driver</label>
                <input type="text" class="form-control <?= ($validation->hasError('information')) ? 'is-invalid' : ''; ?>" id="nama_driver" placeholder="Nama Driver" name="nama_driver">
                <div class="invalid-feedback" for='nama_driver'>
                    <?= $validation->getError('nama_driver'); ?>
                </div>
            </div>
            <div class="col-10">
                <label for="information" class="form-label">Nomor Plat Mobil</label>
                <input type="text" class="form-control <?= ($validation->hasError('no_plat_mobil')) ? 'is-invalid' : ''; ?>" id="no_plat_mobil" placeholder="Nomor Plat Mobil" name="no_plat_mobil">
                <div class="invalid-feedback" for='no_plat_mobil'>
                    <?= $validation->getError('no_plat_mobil'); ?>
                </div>
            </div>
            <div class="col-10">
                <label for="information" class="form-label">Keterangan</label>
                <input type="text" class="form-control <?= ($validation->hasError('information')) ? 'is-invalid' : ''; ?>" id="information" placeholder="Keterangan" name="information">
                <div class="invalid-feedback">
                    <?= $validation->getError('information'); ?>
                </div>
            </div>
            <div class="col-10">
                <label for="tgl" class="form-label">Tanggal</label>
                <input type="date" class="form-control id="tgl" placeholder="" name="tgl">
                <div class="invalid-feedback" for='tgl'>
                    <?= $validation->getError('tgl'); ?>
                </div>
            </div>
            <div class="col-10">
                <button type="submit" value="Simpan Data" class="btn btn-primary mt-3">Save Data</button>
            </div>
        </div>
    </form>

</div>
<?= $this->endSection(); ?>


<?= $this->section('page_js') ?>
<script type="text/javascript" src="<?= base_url() ?>/js/page-trans-1.js"></script>
<?= $this->endSection() ?>