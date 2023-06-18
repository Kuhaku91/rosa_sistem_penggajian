<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
    <span class="pull-right-container">
      <a class="btn btn-sm btn-success pull-right" href="<?php echo base_url('admin/master_data/data_kelas/tambah') ?>"><i class="fa fa-plus"></i> Tambah Kelas </a>
    </span>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <?= $this->session->flashdata('pesan_kelas') ?>
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <table class="table table-bordered table-striped text-center table-datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Kelas</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              foreach($kelas as $key => $value):
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $value->nama_kelas ?></td>
                  <td>
                    <center>
                      <a class="btn btn-sm btn-warning" href="<?= base_url('admin/master_data/data_kelas/update_data/'.$value->id) ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                      <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/master_data/data_kelas/delete_data/'.$value->id) ?>"><i class="glyphicon glyphicon-trash"></i></a>
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