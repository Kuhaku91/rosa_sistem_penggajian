<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <!-- Data Gaji Pokok -->
  <div class="row">
    <?= $this->session->flashdata('pesan_gaji_pokok') ?>
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Gaji Pokok
          </h3>
        </div>
        
        <form action="<?= base_url('admin/master_data/data_gaji/gaji_pokok') ?>" method="POST">
          <div class="box-body">
            <div class="form-group">
              <input type="number" class="form-control" name="gaji_pokok" id="gaji_pokok" value="<?= $gaji_pokok ?>" placeholder="GAJI PER JAM">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
  <!-- Data Potongan Gaji -->
  <div class="row">
    <?= $this->session->flashdata('pesan_potongan_gaji') ?>
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">
            Potongan Gaji
          </h3>
        </div>
        <div class="box-body">
          <table class="table table-bordered table-striped text-center table-datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Potongan</th>
                <th>Nominal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              foreach($potongan as $key => $value):
                ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $value->potongan ?></td>
                  <td><?= $value->nominal ?></td>
                  <td>
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#potong_gaji_<?= $no; ?>">
                      <i class="glyphicon glyphicon-pencil"></i>
                    </button>

                    <div class="modal fade" id="potong_gaji_<?= $no; ?>">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <form method="POST" action="<?= base_url('admin/master_data/data_gaji/potongan_gaji').'/'.$value->id ?>">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Ubah Potongan Gaji</h4>
                              </div>
                              <div class="modal-body">
                                <input type="number" class="form-control" name="potong_gaji" id="potong_gaji" value="<?= $value->nominal ?>" placeholder="GAJI PER JAM">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">TUTUP</button>
                                <button type="submit" class="btn btn-info">UPDATE</button>
                              </div>
                            </div>
                          </form>

                        </div>
                      </div>

                    </td>
                  </tr>
                  <?php 
                  $no++;
                endforeach;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Data Gaji Tunjangan -->
    <div class="row">
      <?= $this->session->flashdata('pesan_gaji') ?>
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">
              Data Gaji Tambahan
            </h3>
            <a class="btn btn-sm btn-success pull-right" href="<?php echo base_url('admin/master_data/data_gaji/tambah') ?>"><i class="fa fa-plus"></i> Tambah Gaji </a>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped text-center table-datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NAMA GAJI</th>
                  <th>NOMINAL GAJI</th>
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no=1;
                foreach($gaji as $key => $value):
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $value->nama_gaji ?></td>
                    <td><?= $value->nominal ?></td>
                    <td>
                      <center>
                        <a class="btn btn-sm btn-warning" href="<?= base_url('admin/master_data/data_gaji/update_data/'.$value->id) ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                        <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/master_data/data_gaji/delete_data/'.$value->id) ?>"><i class="glyphicon glyphicon-trash"></i></a>
                      </center>
                    </td>
                  </tr>
                  <?php 
                  $no++;
                endforeach;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>