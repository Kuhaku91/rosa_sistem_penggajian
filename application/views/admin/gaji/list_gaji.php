<?php foreach ($guru as $key => $value) { ?>
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">List Data Gaji <?php echo $value->nama_pegawai; ?></h1>
    <a href="<?php echo base_url('admin/laporan_gaji')?>" class="btn btn-info">Kembali</a>
  </div>

</div>
<?php } ?>