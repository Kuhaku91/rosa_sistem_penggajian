<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
    <span class="pull-right-container">
      <a class="btn btn-sm btn-success pull-right" href="<?php echo base_url('admin/master_data/data_pegawai/tambah') ?>"><i class="fa fa-plus"></i> Tambah User </a>
    </span>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <?= $this->session->flashdata('data user') ?>
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <table class="table table-bordered table-striped text-center table-datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>NUPTK</th>
                <th>NAMA</th>
                <th>USERNAME</th>
                <th>JENIS KELAMIN</th>
                <th>FOTO</th>
                <th>AKSI</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              foreach($user as $key => $value):
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $value->nik ?></td>
                  <td><?= $value->nama_pegawai ?></td>
                  <td><?= $value->username ?></td>
                  <td><?= $value->jenis_kelamin ?></td>
                  <td>
                    <img src="<?php echo base_url().'foto/'.$value->photo?>" width="50px">
                  </td>
                  <td>
                    <center>
                      <a class="btn btn-sm btn-warning" href="<?= base_url('admin/master_data/data_pegawai/update_data/'.$value->id_pegawai) ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                      <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/master_data/data_pegawai/delete_data/'.$value->id_pegawai) ?>"><i class="glyphicon glyphicon-trash"></i></a>
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