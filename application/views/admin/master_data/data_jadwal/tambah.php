<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
    <span class="pull-right-container">
      <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('admin/master_data/data_jadwal') ?>"><i class="fa fa-arrow-left"></i> Tambah Jadwal </a>
    </span>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <?= $this->session->flashdata('pesan_jadwal_add') ?>
    <div class="col-md-12">
      <div class="box">

        <form method="POST" action="<?= base_url('admin/master_data/data_jadwal/simpan')?>" enctype="multipart/form-data">

          <div class="box-body">

            <div class="form-group">
              <label class="control-label" for="kelas">Kelas</label>
              <select class="form-control" name="kelas" id="kelas" required>
                <option selected disabled>Pilih Kelas</option>
                <?php foreach ($kelas as $key => $value): ?>
                  <option value="<?= $value->id ?>"><?= $value->nama_kelas ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('kelas','<span class="help-block"></span>') ?>
            </div>
            <div class="form-group">
              <label class="control-label" for="mapel">Mapel</label>
              <select class="form-control" name="mapel" id="mapel" required>
                <option selected disabled>Pilih Mapel</option>
                <?php foreach ($mapel as $key => $value): ?>
                  <option value="<?= $value->id ?>"><?= $value->nama_mapel ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('mapel','<span class="help-block"></span>') ?>
            </div>
            <div class="form-group">
              <label class="control-label" for="guru">Guru</label>
              <select class="form-control" name="guru" id="guru" required>
                <option selected disabled>Pilih Guru</option>
                <?php foreach ($pegawai as $key => $value): ?>
                  <option value="<?= $value->id_pegawai ?>"><?= $value->nama_pegawai ?></option>
                <?php endforeach ?>
              </select>
              <?= form_error('guru','<span class="help-block"></span>') ?>
            </div>
            <div class="form-group">
              <label class="control-label" for="datepicker">Tanggal Jadwal</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right input-datepicker" name="tanggal">
                <?= form_error('tanggal','<span class="help-block"></span>') ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label" for="jam">Jam Mengajar</label>
              <select class="form-control" name="jam" id="jam" required>
                <option selected disabled>Pilih Jam Mengajar</option>
                  <option value="1">07.00 - 07.45</option>
                  <option value="2">07.45 - 08.30</option>
                  <option value="3">08.30 - 09.15</option>
                  <option value="4">09.15 - 10.00</option>
                  <option value="5">10.15 - 11.00</option>
                  <option value="6">11.00 - 11.45</option>
                  <option value="7">11.45 - 12.30</option>
                  <option value="8">13.00 - 13.45</option>
                  <option value="9">13.45 - 14.30</option>
              </select>
              <?= form_error('jam','<span class="help-block"></span>') ?>
            </div>

          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success" >Simpan</button>
            <button type="reset" class="btn btn-warning" >Reset</button>
            <a href="<?php echo base_url('admin/master_data/data_jadwal')?>" class="btn btn-default">Kembali</a>
          </div>

        </form>

      </div>

    </div>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="box">
      <div class="box-header">
        Kelas
      </div>
      <div class="box-body">

      </div>
    </div>
  </div>

</div>

</section>