<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
    <span class="pull-right-container">
      <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('admin/master_data/data_kelas/') ?>"><i class="fa fa-arrow-left"></i> KEMBALI </a>
    </span>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">

        <form method="POST" action="<?php echo base_url('admin/master_data/data_kelas/tambah_aksi')?>" enctype="multipart/form-data">

          <div class="box-body">

            <div class="form-group <?= form_error('nama_kelas','has-error') ?>">
              <label class="control-label" for="nama_kelas">Kelas</label>
              <input type="text" class="form-control" id="nama_kelas" placeholder="Masukkan Nama Kelas" name="nama_kelas">
              <?= form_error('nama_kelas','<span class="help-block"></span>') ?>
            </div>

          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success" >Simpan</button>
            <button type="reset" class="btn btn-warning" >Reset</button>
            <a href="<?php echo base_url('admin/master_data/data_kelas')?>" class="btn btn-default">Kembali</a>
          </div>

        </form>

      </div>
    </div>
  </div>
</section>