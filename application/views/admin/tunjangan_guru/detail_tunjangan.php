<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?> <?= $nama_guru->nama_pegawai; ?></h1>
    <div>
      <a href="<?= base_url() ?>admin/set_tunjangan" class="tambah btn btn-sm btn-warning mb-3" >
        <i class="fas fa-arrow-left"></i> 
        Kembali
      </a>
      <button type="button" class="tambah btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#myModal">
        <i class="fas fa-plus"></i> 
        Tambah Tunjangan
      </button>
    </div>
  </div>

  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="judul">Tambah Data Tunjangan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <form action="<?= base_url() ?>admin/set_tunjangan/simpan_tunjangan" method="POST">
          <!-- Modal body -->
          <div class="modal-body">
            <div id="tampil_modal">
              <div class="form-group">
                <label for="email">Tunjangan</label>
                <select name="tunjangan" class="form-control">
                  <?php foreach($tunjangan as $key => $value){ ?>
                    <option value="<?= $value->id ?>"><?= $value->nama_gaji ?></option>
                  <?php  } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="email">Jumlah</label>
                <input type="number" class="form-control" name="jumlah" placeholder="Masukan Jumlah Tunjangan">
              </div>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn btn-sm btn-success" name="id" value="<?= $id_guru ?>">Simpan</button>
            <button type="button" class="btn btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <?php echo $this->session->flashdata('pesan_tunjangan')?>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
   <div class="card-body">
     <div class="table-responsive">
       <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
         <thead class="thead-dark">
           <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama Tunjangan</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1; ?>
          <?php foreach ($data_tunjangan as $key => $value): ?>
            <tr>
              <td><?= $i; ?></td>
              <td><?= $value->nama_gaji ?></td>
              <td><?= $value->jumlah ?></td>
              <td>
                <center>
                  <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/set_tunjangan/hapus/'.$value->id_guru.'/'.$value->id_tunjangan.'/'.$value->jumlah) ?>"><i class="fas fa-trash"></i></a>
                </center>
              </td>
            </tr>
            <?php $i++; ?>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>