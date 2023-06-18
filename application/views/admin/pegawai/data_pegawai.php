<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <?php echo $title?>
  </h1>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
        </div>

        <div class="box-body">
          <table id="datatable" class="table table-bordered table-hover">
            <thead class="thead-dark">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">NUPTK</th>
                <th class="text-center">Nama Guru</th>
                <th class="text-center">Jenis Kelamin</th>
                <th class="text-center">Photo</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; ?> 
              <?php foreach($pegawai as $p) : ?>
                <tr>
                  <td class="text-center"><?php echo $no++ ?></td>
                  <td class="text-center"><?php echo $p->nik ?></td>
                  <td class="text-center"><?php echo $p->nama_pegawai ?></td>
                  <td class="text-center"><?php echo $p->jenis_kelamin ?></td>
                  <td>
                    <center>
                      <img src="<?php echo base_url().'photo/'.$p->photo?>" width="50px">
                    </center>
                  </td>
                  <td>
                    <center>
                      <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/data_pegawai/update_data/'.$p->id_pegawai) ?>"><i class="fa fa-edit"></i></a>
                      <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/data_pegawai/delete_data/'.$p->id_pegawai) ?>"><i class="fa fa-trash"></i></a>
                    </center>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</section>