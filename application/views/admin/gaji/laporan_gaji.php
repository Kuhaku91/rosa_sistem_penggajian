<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
   <div class="card-body">
     <div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead class="thead-dark">
           <tr>
            <th class="text-center">No</th>
            <th class="text-center">NIK</th>
            <th class="text-center">Nama Guru</th>
            <th class="text-center">Jenis Kelamin</th>
            <th class="text-center">Jabatan</th>
            <th class="text-center">Status</th>
            <th class="text-center">Photo</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
         <?php $no=1; foreach($pegawai as $p) : ?>
         <tr>
          <td class="text-center"><?php echo $no++ ?></td>
          <td class="text-center"><?php echo $p->nik ?></td>
          <td class="text-center"><?php echo $p->nama_pegawai ?></td>
          <td class="text-center"><?php echo $p->jenis_kelamin ?></td>
          <td class="text-center"><?php echo $p->jabatan ?></td>
          <td class="text-center"><?php echo $p->status ?></td>
          <td><img src="<?php echo base_url().'photo/'.$p->photo?>" width="50px"></td>
          <td>
            <center>
              <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/laporan_gaji/cetak_gaji/'.$p->id_pegawai) ?>"><i class="fas fa-eye"></i></a>
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
