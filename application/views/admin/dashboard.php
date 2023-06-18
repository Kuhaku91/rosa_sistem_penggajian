<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $pegawai_admin ?></h3>

          <p>Admin dan Guru</p>
        </div>
        <div class="icon">
          <i class="ion ion-person"></i>
        </div>
        <a href="<?= base_url('admin/data_pegawai') ?>" class="small-box-footer">Menu <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    

  </div>
</section>
      <!-- /.content -->