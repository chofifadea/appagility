<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Cara Menggunakan Website Control Pallet</h1>
    <h6>Sebagai Admin Site</h6>
    <!-- <title>Sebagai Admin Site</title> -->
    </head>

    <ol>
        <li>Dashboard merupakan jumlah seluruh data pallet yang berada pada warehouse.</li>
        <li>Input data pallet dilakukan hanya jika warehouse melakukan stok langsung dari vendor.</li>
        <li>Untuk Output data pallet dilakukan jika terdapat perpindahan barang dari site ke site lain.</li>
        <li>Transactions adalah data history dari semua transaksi pallet yang dilakukan pada warehouse.</li>
        <li>Notifikasi adalah pemberitahuan jika terdapat pallet yang akan masuk dari site lain.</li>
        <li>Inbox adalah pesan masuk yang isinya sama seperti pada notifikasi, dan di Inbox dapat dilakukan confirm jika pallet tersebut telah diterima warehouse dan decline untuk menolak jika pallet tidak diterima.</li>
</div>
<!-- /.container-fluid -->


<?= $this->endSection(); ?>