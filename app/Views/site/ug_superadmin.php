<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Cara Menggunakan Website Control Pallet</h1>
    <h6>Sebagai Super Admin</h6>
    <!-- <title>Sebagai Super Admin</title> -->

    <ol>
        <li>Dashboard merupakan jumlah seluruh data pallet yang berada pada seluruh site warehouse.</li>
        <li>Mater User digunakan unutk menginput dan mendaftarkan akun site yang akan digunakan oleh site warehouse.</li>
        <li>Master Pallet adalah menu untuk menginput data pallet sesuai dari nama vendor pallet tersebut.</li>
        <li>Master Site merupakan menu untuk melakukan input data site.</li>
        <li>Transactions merupakan menu data history dari seluruh site warehouse.</li>
    </ol>
    
</div>
<!-- /.container-fluid -->


<?= $this->endSection(); ?>