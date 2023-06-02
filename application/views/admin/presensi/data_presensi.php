<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title." ".DATE('d M Y',strtotime($tanggal)) ?></h1>
  </div>
  <?php echo $this->session->flashdata('pesan_presensi')?>
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
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($value['jam'] as $key_jam => $value_jam): ?>
                <tr>
                  <td>
                    <?php if ($value_jam->jam==1): ?>
                      07.30 - 08.15
                    <?php elseif ($value_jam->jam==2): ?>
                      08.15 - 09.00
                    <?php elseif ($value_jam->jam==3): ?>
                      09.00 - 09.45
                    <?php elseif ($value_jam->jam==4): ?>
                      10.00 - 10.45
                    <?php elseif ($value_jam->jam==5): ?>
                      10.45 - 11.30
                    <?php elseif ($value_jam->jam==6): ?>
                      11.30 - 12.15
                    <?php elseif ($value_jam->jam==7): ?>
                      12.45 - 13.30
                    <?php elseif ($value_jam->jam==8): ?>
                      13.30 - 14.15
                    <?php elseif ($value_jam->jam==9): ?>
                      14.15 - 15.00
                    <?php endif ?>
                  </td>
                  <td>
                    <?php
                    $data_mapel = $this->ModelJadwal->get_data_row_id($value_jam->id_mapel);
                    echo $data_mapel[1]['nama_mapel'];
                    ?>
                  </td>
                  <td>
                    <?php
                    $data_mapel = $this->ModelPegawai->get_data_row_id($value_jam->id_mapel);
                    echo $data_mapel[2]['nama_pegawai'];
                    ?>
                  </td>
                  <td>
                    <a href="<?= base_url() ?>admin/presensi/isi/<?= $value_jam->id ?>" class="btn btn-sm btn-info">Presensi</a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>
<script type="text/javascript">
  
</script>