<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
    <span class="pull-right-container">
      <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('admin/master_data/data_gaji/') ?>"><i class="fa fa-arrow-left"></i> KEMBALI </a>
    </span>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">

        <form method="POST" action="<?php echo base_url('admin/master_data/data_gaji/update_aksi')?>" enctype="multipart/form-data">

          <div class="box-body">

            <div class="form-group <?= form_error('id','has-error') ?>">
              <input type="hidden" class="form-control" id="id" placeholder="Masukkan Nama Gaji" name="id" value="<?= $gaji->id ?>">
            </div>
            <div class="form-group <?= form_error('nama_gaji','has-error') ?>">
              <label class="control-label" for="nama_gaji">Gaji</label>
              <input type="text" class="form-control" id="nama_gaji" placeholder="Masukkan Nama Gaji" name="nama_gaji" value="<?= $gaji->nama_gaji ?>">
              <?= form_error('nama_gaji','<span class="help-block"></span>') ?>
            </div>
            <div class="form-group <?= form_error('nominal','has-error') ?>">
              <label class="control-label" for="nominal">Nominal</label>
              <input type="number" class="form-control" id="nominal" placeholder="Masukkan Nominal Gaji" name="nominal" value="<?= $gaji->nominal ?>">
              <?= form_error('nominal','<span class="help-block"></span>') ?>
            </div>

          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success" >Simpan</button>
            <button type="reset" class="btn btn-warning" >Reset</button>
            <a href="<?php echo base_url('admin/master_data/data_gaji')?>" class="btn btn-default">Kembali</a>
          </div>

        </form>

      </div>
    </div>
  </div>
</section>