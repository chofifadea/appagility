<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content') ?>
<div class="container-fluid">
    <h3 class="text-gray-800 mb-2">Manajemen Master Pengguna</h3>

    <div class="card shadow mb-4">
        <div class="card-header py-3" style="display: flex; justify-content: space-between;">
            <h4 class="m-0 font-weight-bold text-primary">Data Pengguna</h4>
            <button class="btn btn-primary" id="btn-add"><i class="fa fa-plus"></i> Tambah</button>
        </div>
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table-dt" width='100%' cellspacing='0'>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Warehouse</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rows as $row): ?>
                            <tr>
                                <td col-name='username' is-plain='1'><?= $row['username'] ?></td>
                                <td col-name='nama' is-plain='1'><?= $row['nama'] ?></td>
                                <td><?= $row['nama_site'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-success btn-edit" data-id="<?= $row['id'] ?>"><i class="fa fa-edit"></i> Edit</button>
                                    <button type="button" class="btn btn-danger btn-hapus" data-id="<?= $row['id'] ?>" data-url="<?= base_url() ?>/pengguna/hapus"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                                <input type="hidden" col-name='id_site' is-plain='1' value="<?= $row['id_site'] ?>"/>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="modal-form1" role="dialog">
   <div class="modal-dialog" role="document">
        <form class="modal-content" id="form-input" create-action="<?= base_url() ?>/pengguna" update-action='<?= base_url() ?>/pengguna/update' method="post">
            <input type="hidden" name="id" id="id"/>
       <!-- <div class="modal-content"> -->
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button type="button" class="close" data-dismiss='modal' aria-label="close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" id="nama"/>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" name="username" id="username"/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" name="password" type="text"/>
                    </div>
                    <div class="form-group">
                        <label>Site</label>
                        <select class="form-control" id="id_site" name="id_site">
                            <option value="">Pilih Site</option>
                            <?php foreach($list_site as $item): ?>
                                <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <label class="alert alert-danger" id="err-msg" style="flex: 1"></label>
                <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                <button type="button" class="btn btn-secondary" id="btn-cancel">Batal</button>
            </div>
        </form>
       <!-- </div> -->
   </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('page_js') ?>
    <script type="text/javascript" src="<?= base_url() ?>/js/page-crud-1.js?t=12"></script>
<?= $this->endSection() ?>