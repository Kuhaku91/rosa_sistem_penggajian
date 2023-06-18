<!-- Begin Page Content -->
<section class="content-header">
  <h1>
    <?php echo $title?>
  </h1>
</section>

<section class="content">

  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <form method="POST" action="<?php echo base_url('ganti_password/ganti_password_aksi')?>">
          <div class="box-body">

            <div class="form-grup">
              <label>Password Baru</label>
              <input type="password" name="passBaru" class="form-control">
              <?php echo form_error('paasBaru', '<div class="text-small text-danger"> </div>')?>
            </div>

            <div class="form-grup">
              <label>Ulangi Password Baru</label>
              <input type="password" name="ulangPass" class="form-control">
              <?php echo form_error('ulangPass', '<div class="text-small text-danger"> </div>')?>
            </div>

          </div>
          <div class="box-footer">
            <button type="submint" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</section>

<!-- /.container-fluid -->