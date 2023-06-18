<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?= $title." ".$user->nama_pegawai ?>
    <span class="pull-right-container">
      <a class="btn btn-sm btn-success pull-right" href="<?php echo base_url('admin/master_data/data_pegawai/') ?>"><i class="fa fa-arrow-left"></i> KEMBALI </a>
    </span>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">

        <form method="POST" action="<?php echo base_url('admin/master_data/data_pegawai/update_aksi')?>" enctype="multipart/form-data">

          <div class="box-body">

            <div class="form-group <?= form_error('nuptk') ?>">
              <input type="hidden" class="form-control" id="id_pegawai" placeholder="Masukkan NUPTK" name="id_pegawai" value="<?= $user->id_pegawai; ?>">
            </div>

            <div class="form-group <?= form_error('nuptk') ?>">
              <label for="nik">NUPTK</label>
              <input type="number" class="form-control" id="nik" placeholder="Masukkan NUPTK" name="nik" maxlength="16" minlength="16" required  value="<?= $user->nik; ?>">
              <?= form_error('nik','<span class="help-block"></span>') ?>
            </div>

            <div class="form-group <?= form_error('nama','has-error') ?>">
              <label class="control-label" for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" value="<?= $user->nama_pegawai; ?>">
              <?= form_error('nama','<span class="help-block"></span>') ?>
            </div>

            <div class="form-group <?= form_error('username','has-error') ?>">
              <label class="control-label" for="username">Username</label>
              <input type="text" class="form-control" id="username" placeholder="Masukkan Username" name="username" value="<?= $user->username; ?>">
              <?= form_error('username','<span class="help-block"></span>') ?>
            </div>

            <div class="form-group <?= form_error('password','has-error') ?>">
              <label class="control-label" for="password">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Masukkan Password" name="password">
              <?= form_error('password','<span class="help-block"></span>') ?>
            </div>

            <div class="form-group <?= form_error('jenis_kelamin','has-error') ?>">
              <label class="control-label" for="jenis_kelamin">Jenis Kelamin</label>
              <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                <option value="Laki-Laki"  <?= $user->jenis_kelamin=="Laki-Laki"?'selected':''; ?>>Laki-Laki</option>
                <option value="Perempuan"  <?= $user->jenis_kelamin=="Perempuan"?'selected':''; ?>>Perempuan</option>
              </select>
            </div>

            <div class="form-group <?= form_error('akses','has-error') ?>">
              <label class="control-label" for="akses">Akses</label>
              <select class="form-control" id="akses" name="akses">
                <option value="1" <?= $user->hak_akses=='1'?'selected':'' ?>>Admin</option>
                <option value="2" <?= $user->hak_akses=='2'?'selected':'' ?>>Guru</option>
              </select>
            </div>

            <div class="form-group <?= form_error('foto','has-error') ?>">
              <label class="control-label" for="foto">Foto</label>
              <input type="file" class="form-control" id="foto" placeholder="Masukkan Foto" name="foto">
              <?= form_error('foto','<span class="help-block"></span>') ?>
            </div>

          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-success" >Simpan</button>
            <button type="reset" class="btn btn-warning" >Reset</button>
            <a href="<?php echo base_url('admin/master_data/data_pegawai')?>" class="btn btn-default">Kembali</a>
          </div>
        </form>

      </div>
    </div>
  </div>
</section>