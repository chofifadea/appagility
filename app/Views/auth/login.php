<?= $this->extend('auth/templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body-login p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><b>Control Pallet Agility</b></h1>
                                    <h2 class="h6 text-gray-900 mb-4">Please login for using this app</h2>
                                </div>
                                <form class="user" id="form-login">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Username" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                        </div>
                                    </div>
                                    <div class="alert alert-danger" id="error-msg" style="display: none;">
                                        
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block" onclick="coba_login()" id="btn-login">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection(); ?>

<?= $this->section('page_js') ?>
    <script type="text/javascript" src="<?= base_url() ?>/js/page-login.js"></script>
<?= $this->endSection() ?>