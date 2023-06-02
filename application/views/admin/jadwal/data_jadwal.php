<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title." ".DATE('d M Y',strtotime($tanggal)) ?></h1>
  </div>
  <?php echo $this->session->flashdata('pesan_jadwal')?>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
    <div class="card-body d-sm-flex align-items-center justify-content-between">

      <form class="form-inline">

        <div class="">
          <input type="date" name="tanggal" class="form-control" >
          <button type="submit" class="btn btn-success">
            <i class="fas fa-eye"></i> LIHAT
          </button>
        </div>

      </form>

      <div>
        <a href="<?= base_url() ?>admin/data_jadwal/add" class="btn btn-success">
          <i class="fas fa-plus"></i> TAMBAH DATA
        </a>
      </div>

    </div>
  </div>
</div>

<?php foreach ($data_jadwal as $key => $value): ?>
  <div class="container-fluid">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="card-title">
          <h3>Kelas <?= $value['kelas'] ?></h3>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-sm text-center" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>JAM</th>
                <th>Mapel</th>
                <th>Pengajar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($value['jam'] as $key_jam => $value_jam): ?>
                <tr>
                  <td><?= $key_jam ?></td>
                  <?php foreach ($value_jam as $key_isi => $value_isi): ?>
                    <td><?= $value_isi['mapel'] ?></td>
                    <td><?= $value_isi['guru'] ?></td>
                  <?php endforeach ?>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach ?>