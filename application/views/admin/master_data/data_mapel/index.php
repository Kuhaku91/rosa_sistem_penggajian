<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
    <span class="pull-right-container">
      <a class="btn btn-sm btn-success pull-right" href="<?php echo base_url('admin/master_data/data_mapel/tambah') ?>"><i class="fa fa-plus"></i> Tambah Mapel </a>
    </span>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <?= $this->session->flashdata('pesan_mapel') ?>
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <table class="table table-bordered table-striped text-center table-datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>MAPEL</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              foreach($mapel as $key => $value):
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $value->nama_mapel ?></td>
                  <td>
                    <center>
                      <a class="btn btn-sm btn-warning" href="<?= base_url('admin/master_data/data_mapel/update_data/'.$value->id) ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                      <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/master_data/data_mapel/delete_data/'.$value->id) ?>"><i class="glyphicon glyphicon-trash"></i></a>
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