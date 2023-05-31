<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>
  <?php echo $this->session->flashdata('set_tunjangan')?>
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
            <th class="text-center">Tanggal Masuk</th>
            <th class="text-center">Status</th>
            <th class="text-center">Hak Akses</th>
            <th class="text-center">Photo</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
         <?php $no=1; foreach($guru as $key => $value) : ?>
         <tr>
          <td class="text-center"><?php echo $no++ ?></td>
          <td class="text-center"><?php echo $value->nik ?></td>
          <td class="text-center"><?php echo $value->nama_pegawai ?></td>
          <td class="text-center"><?php echo $value->jenis_kelamin ?></td>
          <td class="text-center"><?php echo $value->jabatan ?></td>
          <td class="text-center"><?php echo $value->tanggal_masuk ?></td>
          <td class="text-center"><?php echo $value->status ?></td>
          <?php if($value->hak_akses=='1') { ?>
            <td class="text-center">Admin</td>
          <?php } else { ?>
            <td class="text-center">Guru</td>
          <?php } ?>
          <td><img src="<?php echo base_url().'photo/'.$value->photo?>" width="50px"></td>
          <td>
            <center>
              <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/set_tunjangan/detail/'.$value->id_pegawai) ?>"><i class="fas fa-eye"></i></a>
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
